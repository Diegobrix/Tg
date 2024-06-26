<?php
   session_start();

   if((!isset($_SESSION['id'])) || (is_null($_SESSION['id'])))
   {
      session_destroy();
      session_unset();
      header("location: ../credentials.php");
   }

   require_once("../AdminPageConstructor.php");
   $pageConstructor = new AdminPageConstructor();

   $admin = $pageConstructor->getAdminData($_SESSION['token']);

   if($admin == null)
   {
      header("location: ../credentials.php");
   }
?>
<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Admin - Home Page</title>

      <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css"/>
      <link rel="stylesheet" type="text/css" href="../../../src/css/pages/admin/admin_homePage-styles.css"/>

      <script defer src="../../../src/js/pages/hamburger-menu.js"></script>
      <script type="module" defer src="../../../src/js/pages/admin/admin_homePage/video_controller.js"></script>
      <script defer src="../../../src/js/pages/admin/admin_homePage/admin_homePage_responsive.js"></script>
   </head>
   <body>
      <?php 
         require_once("../../bd-conn-controller/pages/admin/admin_homePage_bd.php");
         require_once("../../bd-conn-controller/pages/admin/admin_homePage_content.php");

         $content = json_decode(file_get_contents('../../bd-conn-controller/temp_data/data/content_data.json'), true);
         if($content != null)
         {
            $recipeSectionContent = $content[0];
            $categoriesSectionContent = $content[1];

            $categories = fetchCategory($conn, $recipeSectionContent['most_popular_category']);
            $mostPopularCategory = $categories[0];

            $recipes = fetchRecipe($conn, $recipeSectionContent['last_recipe']);
            $lastRecipe = $recipes[0]; 
         }
         else
         {
            header("Refresh: 0");
         }
      ?>
      <header>
         <div class="greetings-wrapper">
            <button id="mobile_menu--handler">
            </button>
            <h1>Olá, <span class="username"><?=$admin['username']?></span></h1>
         </div>
         <div class="desktop-menu">
            <ul>
               <li><a href="./admin_dashboard.php?content-type=Receitas&content-type-id=0">Receitas</a></li>
               <li><a href="./admin_dashboard.php?content-type=Categorias&content-type-id=2">Categorias</a></li>
            </ul>
         </div>
         <button class="logout"><a href="../../../conf/logout.php">Sair</a></button>
      </header>
      <aside class="mobile-menu" aria-expanded="false">
         <button id="btn_close"></button>
         <ul>
            <li><a href="./admin_dashboard.php?content-type-id=0">Receitas</a></li>
            <li><a href="./admin_dashboard.php?content-type-id=2">Categorias</a></li>
         </ul>
         <button class="logout"><a href="../../../conf/logout.php">Sair</a></button>
      </aside>
      <div class="backdrop"></div>
      <main>
         <section>
            <div class="recipes_overview--wrapper">
               <div class="recipes--wrapper">
                  <h2>Receitas</h2>
                  <p class="recipes_amount-display"><?=$content != null?$recipeSectionContent['recipes_amount']:0?></p>
                  <button id="recipes-extra_options-handler" class="options-handler" popovertarget="recipes-extra_options"></button>

                  <div popover anchor="recipes-extra_options-handler" id="recipes-extra_options" class="extra_options">
                     <a href="./misc/addRecipe.php" class="option">Add. Receita</a>
                     <a href="./admin_dashboard.php?content-type-id=0" class="option">Todas receitas</a>
                  </div>
               </div>
               <div class="popular_category--wrapper">
                  <h2>Categoria Preferida</h2>
                  <p class="popular_category-display"><?=$mostPopularCategory['title']?></p>
                  <div>
                     <p class="popular_category_amount-display"><?=$mostPopularCategory['amount']?></p>
                     <span>Receitas</span>
                  </div>
               </div>
               <div class="most_recent_recipe--wrapper">
                  <h2>Última Receita Adicionada</h2>
                  <p class="most_recent_recipe-display"><?=$lastRecipe['title']?></p>
                  <figure>
                     <img src="../../../assets/images/recipes/<?=htmlspecialchars($lastRecipe['thumb'])?>" alt="Foto da última receita adicionada" class="last_recipe_thumb-display">
                  </figure>
               </div>
            </div>
            <section class="categories--wrapper">
               <div class="categories--label">
                  <h2>Top Categorias</h2>
               </div>
               <div class="categories-container">
                  <button id="top_categories-extra_options-handler" class="options-handler" popovertarget="top_categories-extra_options"></button>
                     <?php
                        $topCategoriesId = array();
                        for($i = 0; $i < sizeof($categoriesSectionContent); $i++)
                        {
                           $topCategoriesId[$i] = $categoriesSectionContent[$i]['category'];
                        }

                        $topCategories = fetchCategory($conn, $topCategoriesId);
                        foreach($topCategories as $category)
                        {            
                     ?>
                           <div class="category">
                              <div class="bar <?=$category['amount']/$mostPopularCategory['amount']==1?'bigger':''?>" style="--bar-size: <?=number_format((float)$category['amount']/$mostPopularCategory['amount'], 2, '.');?>" data-recipes-amount="<?=$category['amount']?>"></div>
                              <p class="category-title"><?=$category['title']?></p>
                           </div>
                     <?php
                        }
                     ?>
                  <div popover anchor="top_categories-extra_options-handler" id="top_categories-extra_options" class="extra_options">
                     <a href="./admin_dashboard.php?content-type-id=2">Todas categorias</a>
                  </div>
               </div>
            </section>
         </section>
         <section class="other_options-wrapper">
            <div class="videos-widget">
               <?php
                  $videos = json_decode(file_get_contents("./data/datasets/videos.json"), true);
                  $categories = json_decode(file_get_contents("./data/datasets/categories.json"), true);
                  
                  if($videos != null)
                  {
                     $videosAmount = sizeof($videos);
                  }
                  if($categories != null)
                  {
                     $categoriesAmount = sizeof($categories);
                  }
               ?>
               <h2>Vídeos</h2>
               <p class="videos_amount"><?=$videos != null?$videosAmount:0?></p>
               <button id="videos-extra_options-handler" class="options-handler" popovertarget="videos-extra_options"></button>

               <div popover anchor="videos-extra_options-handler" id="videos-extra_options" class="extra_options">
                  <button class="option" id="add_video-handler">Add. Vídeo</button>
                  <a href="./admin_dashboard.php?content-type-id=3" class="option">Todos vídeos</a>
               </div>
               <dialog id="video_modal">
                  <form action="../../bd-conn-controller/pages/admin/addVideoDB.php" method="POST" enctype="multipart/form-data">
                     <div class="video_modal_steps_display-container">
                        <i class="step_display" data-current="true" data-step="0"></i>
                        <i class="step_display" data-current="false" data-step="1"></i>
                     </div>
                     <section class="video_modal-step" data-current="true" data-step="0">
                        <h2>Deseja Adicionar um Vídeo para essa Receita?</h2>
                        <input type="file" id="flVideo" accept="video/*" name="recipe_video">
                        <div class="section_controller">
                           <button type="button" class="btn_video_cancel">Não quero</button>
                           <label for="flVideo">Add Vídeo</label>
                        </div>
                     </section>
                     <section class="video_modal-step" data-current="false" data-step="1">
                        <label for="txtVideoTitle">Título</label>
                        <input required type="text" name="video_title" id="txtVideoTitle">
                        <label for="txtVideoDescription">Descrição</label>
                        <textarea required name="video_description" id="txtVideoDescription" cols="30" rows="5"></textarea>
                        <div class="video_recipe">
                           <template id="recipe_indicator-template">
                              <div class="choosed_recipe">
                                 <input type="hidden" class="input_id" value="" name="recipe_choosed_id">
                                 <input type="hidden" class="input_title" name="recipe_choosed_title">
                                 <span></span>
                                 <button type="button" class="remove_recipe"></button>
                              </div>
                           </template>
                           <div class="recipe_indicator_container"></div>
                           <button type="button" class="add_recipe-video_modal" popovertarget="recipes_list">Associar a uma receita?</button>
                        </div>
                        <div popover id="recipes_list">
                           <h2>Selecionar Receita</h2>
                           <div class="recipes_container">
                              <?php
                                 require_once('../../bd-conn-controller/GetContent.php');
                                 $content = new GetContent($conn);
                                 $recipes = $content->getRecipes();
                                 $i = 0;
                                 if($recipes != null)
                                 {
                                    foreach($recipes as $recipe)
                                    {
                              ?>
                                       <div class="recipe">
                                          <label for="recipe_<?=$recipe['id']?>"><?=$recipe['title']?></label>
                                          <input type="checkbox" id="recipe_<?=$recipe['id']?>" data-label="<?=$recipe['title']?>" value="<?=$recipe['id']?>"/>
                                       </div>
                              <?php
                                       $i += 1;
                                    }
                                 }
                     
                              ?>
                           </div>
                           <?php
                              if($i > 0)
                              {
                           ?>
                                 <div class="list_controller-container">
                                    <button type="button" class="controller" popovertarget="recipes_list" id="btn_cancel">Cancelar</button>
                                    <button type="button" class="controller" popovertarget="recipes_list" id="btn_save">Salvar</button>
                                 </div>
                           <?php
                              }
                           ?>
                        </div>
                        <div class="section_controller">
                           <button type="button" class="btn_video_cancel">Perder o vídeo</button>
                           <button type="submit" id="btn_send_video">Finalizar</button>
                        </div>
                     </section>
                  </form>
               </dialog>
            </div>
            <div class="categories-widget">
               <h2>Categorias</h2>
               <p class="categories_amount"><?=$categories != null?$categoriesAmount:0?></p>
               <button id="categories-extra_options-handler" class="options-handler" popovertarget="category-extra_options"></button>

               <div popover anchor="categories-extra_options-handler" id="category-extra_options" class="extra_options">
                  <a href="./admin_dashboard.php?content-type-id=2" class="option">Todas categorias</a>
               </div>
            </div>
            <div class="suggestions_container">
               <span>Sugestões do Dia</span>
                  <div class="suggestions--wrapper">
                     <?php
                        require_once("./data/datasetsGenerator.php");
                        require("./data/daySuggestions.php");
                     
                        $daySuggestions = json_decode(file_get_contents("./data/datasets/temp_data/day_suggestions.json"), true);
                        for($i = 0; $i < sizeof($daySuggestions); $i++)
                        {
                     ?>
                           <div class="suggestion" data-current_step="<?=$i?>" id="suggestion_<?=$i?>" style="--thumb: url(../../../../../assets/images/recipes/<?=htmlspecialchars($daySuggestions[$i]['thumb'])?>);" aria-current="<?=$i==0?'true':'else'?>">
                              <a class="suggestion_handler-prev suggestion_handler<?=$i==0?' first':''?>" href="#suggestion_<?=$i-1?>"><</a>
                              <p class="suggestion_title"><?=$daySuggestions[$i]['title']?></p>
                              <a class="suggestion_handler-next suggestion_handler<?=$i>=sizeof($daySuggestions)-1?' last':''?>" href="#suggestion_<?=$i+1?>">></a>
                           </div>
                     <?php
                        }
                     ?>
                  </div>
               </div>
            </div>
         </section>
      </main>
   </body>
</html>