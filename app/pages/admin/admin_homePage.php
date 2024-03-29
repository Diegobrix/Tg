<?php
   session_start();
   if((!isset($_SESSION['admin_id'])) || ($_SESSION['admin_id'] == false))
   {
      session_unset();
      session_destroy();
		header("location: ../credentials.php");
   }

   require_once("AdminPagesConstructor.php");
   $pageConstructor = new AdminPagesConstructor($_SESSION['admin_token']);
   $user = $pageConstructor->getAdminData();

   if($user == null)
   {
      session_unset();
      session_destroy();

      die();
   }

   $content = $pageConstructor->getContentData("content_data");
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
      <script defer src="../../../src/js/pages/admin/admin_homePage/widget-details-handler.js"></script>
      <script defer src="../../../src/js/pages/admin/admin_homePage/admin_homePage_controller.js"></script>
      <script defer src="../../../src/js/pages/admin/admin_homePage/admin_homePage_responsive.js"></script>
      <script defer src="../../../src/js/pages/admin/menu-controller.js"></script>
   </head>
   <body>
      <?php 
         require_once("../../bd-conn-controller/pages/admin/admin_homePage_bd.php");
         require_once("./data/getDataFromDB.php");
      ?>
      <header>
         <div class="greetings-wrapper">
            <button id="mobile_menu--handler">
            </button>
            <h1>Olá, <span class="username"><?=$user['username']?></span></h1>
         </div>
         <div class="desktop-menu" aria-hidden="false">
            <ul>
               <li>Receitas</li>
               <li>Categorias</li>
            </ul>
         </div>
         <button class="logout"><a href="../../../conf/logout.php">Sair</a></button>
      </header>
      <aside class="mobile-menu" aria-expanded="false">
         <button id="btn_close"></button>
         <ul>
            <li>Receitas</li>
            <li>Categorias </li>
         </ul>
         <button class="logout"><a href="../../../conf/logout.php">Sair</a></button>
      </aside>
      <div class="backdrop"></div>
      <main>
         <section>
            <div class="recipes_overview--wrapper">
               <div class="recipes--wrapper">
                  <h2>Receitas</h2>
                  <p class="recipes_amount-display"><?=$content[0]['recipes_amount']?></p>
                  <button class="options-handler"></button>
               </div>
               <div class="popular_category--wrapper">
                  <h2>Categoria Preferida</h2>
                  <p class="popular_category-display"><?=$popularCategory?></p>
                  <div>
                     <p class="popular_category_amount-display"><?=$popularCategoryAmount?></p>
                     <span>Receitas</span>
                  </div>
               </div>
               <div class="most_recent_recipe--wrapper">
                  <h2>Última Receita Adicionada</h2>
                  <p class="most_recent_recipe-display"><?=$lastRecipeTitle?></p>
                  <figure>
                     <img src="../../../assets/images/recipes/<?=$lastRecipeThumb?>" alt="Foto da última receita adicionada" class="last_recipe_thumb-display">
                  </figure>
               </div>
            </div>
            <section class="categories--wrapper">
               <div class="categories--label">
                  <h2>Top Categorias</h2>
               </div>
               <div class="categories-container">
                  <button class="options-handler"></button>
                  <?php
                     for($i = 0; $i < count($categories); $i++)
                     {
                        $currentAmount = $contentData[1][$i]['amount'];
                  ?>
                     <div class="category">
                        <div class="bar <?=$currentAmount/$popularCategoryAmount==1?'bigger':''?>" style="--bar-size: <?=number_format((float)$currentAmount/$popularCategoryAmount, 2, '.')?>;" data-recipes-amount="<?=$currentAmount?>"></div>
                        <p class="category-title"><?=implode($categories[$i])?></p>
                     </div>
                  <?php
                     }
                  ?>
               </div>
            </section>
         </section>
         <section class="other_options-wrapper">
            <div class="videos-widget">
               <h2>Vídeos</h2>
               <p class="videos_amount"><?=$videosAmount?></p>
               <button class="options-handler"></button>
            </div>
            <div class="categories-widget">
               <h2>Categorias</h2>
               <p class="categories_amount"><?=$categoriesAmount?></p>
               <button class="options-handler"></button>
            </div>
            <div class="suggestions_container">
               <span>Sugestões do Dia</span>
               <div class="suggestions--wrapper">
                  <?php
                     require_once("./data/daySuggestionsController.php");
                     $suggestions = __DIR__."/data/temp_data/day_suggestions.json";

                     if(file_exists($suggestions))
                     {
                        try
                        {
                           $suggestionsJson = json_decode(file_get_contents($suggestions), true);
                           $i = 1;

                           foreach($suggestionsJson as $json)
                           {
                  ?>
                              <div class="suggestion" data-current_step="<?=$i?>" style="--thumb: <?=$json[2] != null ?'url(../../../../assets/images/recipes/'.$json[2].')':'var(--neutral-500)'?>;" aria-current="<?=$i == 1?'true':'false'?>">
                                 <p class="suggestion_title"><?=$json[1]?></p>
                              </div>
                  <?php
                              $i+= 1;
                           }
                        }
                        catch(ValueError $e)
                        {
                           header("Refresh:0");
                        }
                     }
                  ?>
                  <button class="btn-handler btn-prev"><</button>
                  <button class="btn-handler btn-next">></button>
               </div>
            </div>
         </section>
      </main>
   </body>
</html>