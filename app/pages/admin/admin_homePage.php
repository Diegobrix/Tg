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
      <script defer src="../../../src/js/pages/admin/admin_homePage/admin_homePage_responsive.js"></script>

      <style>
         :root {
            overflow: visible;
         }
      </style>
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
            //Recarregar a página
         }
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
                  <p class="recipes_amount-display"><?=$content != null?$recipeSectionContent['recipes_amount']:0?></p>
                  <button id="recipes-extra_options-handler" class="options-handler" popovertarget="recipes-extra_options"></button>

                  <div popover anchor="recipes-extra_options-handler" id="recipes-extra_options" class="extra_options">
                     <a href="./misc/addRecipe.php" class="option">Add. Receita</a>
                     <a href="./admin_dashboard.php?content-type=Receitas&content-type-id=0" class="option">Todas receitas</a>
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
                     <div class="category">
                        <div class="bar bigger style="--bar-size: 1;" data-recipes-amount="<?=$currentAmount?>"></div>
                        <p class="category-title">Ao mosso</p>
                     </div>
                  <div popover anchor="top_categories-extra_options-handler" id="top_categories-extra_options" class="extra_options">
                     <a href="./admin_dashboard.php?content-type=Categorias&content-type-id=2">Todas categorias</a>
                  </div>
               </div>
            </section>
         </section>
         <section class="other_options-wrapper">
            <div class="videos-widget">
               <h2>Vídeos</h2>
               <p class="videos_amount"></p>
               <button id="videos-extra_options-handler" class="options-handler" popovertarget="videos-extra_options"></button>

               <div popover anchor="videos-extra_options-handler" id="videos-extra_options" class="extra_options">
                  <a href="" class="option">Add. Vídeo</a>
                  <a href="" class="option">Todos vídeos</a>
               </div>
            </div>
            <div class="categories-widget">
               <h2>Categorias</h2>
               <p class="categories_amount">1</p>
               <button id="categories-extra_options-handler" class="options-handler" popovertarget="category-extra_options"></button>

               <div popover anchor="categories-extra_options-handler" id="category-extra_options" class="extra_options">
                  <a href="" class="option">Add. Categoria</a>
                  <a href="./admin_dashboard.php?content-type=Categorias&content-type-id=2" class="option">Todas categorias</a>
               </div>
            </div>
            <div class="suggestions_container">
               <span>Sugestões do Dia</span>
               <div class="suggestions--wrapper">
                  <?php
                     require_once("./data/datasetsGenerator.php");
                     require_once("./data/daySuggestions.php");
                     $suggestions = getSuggestions();

                     print("<pre>".print_r($suggestions, true)."</pre>");
                  ?>
               </div>
            </div>
         </section>
      </main>
   </body>
</html>