<?php
   /*
   session_start();

   if(isset($_SESSION))
   {
      $lvl = $_SESSION['lvl'];

		if($lvl != "A")
		{
         session_destroy();
			header("location: <Caminho para volta>");
		}
   }
   */

   require_once("AdminPagesConstructor.php");
   $pageConstructor = new AdminPagesConstructor();
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

      <script defer src="../../../src/js/hamburger-menu.js"></script>
      <script defer src="../../../src/js/pages/admin_homePage/widget-details-handler.js"></script>
      <script defer src="../../../src/js/pages/admin_homePage/admin_homePage_controller.js"></script>
   </head>
   <body>
      <?php 
         require_once("../../bd-conn-controller/pages/admin/admin_homePage_bd.php");
         require_once("./data/getDataFromDB.php");
         
         //Tirar Despois
         //$number = 100.6;
         //echo number_format((float)$number, 2, ".");
      ?>
      <header>
         <div class="greetings-wrapper">
            <button id="mobile_menu--handler">
            </button>
            <h1>Olá, <span class="username"><?=$user['username']?></span></h1>
         </div>
         <div class="desktop-menu" aria-hidden="false">
            <ul></ul>
         </div>
      </header>
      <aside class="mobile-menu" aria-expanded="false">
      </aside>
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
                     <img src="../../../assets/images/<?=$lastRecipeThumb?>" alt="Foto da última receita adicionada" class="last_recipe_thumb-display">
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
               <span>Sugestão do Dia</span>
               <div class="suggestions--wrapper">
                  <?php
                     require_once("./data/daySuggestionsController.php");


                  ?>
                  <div class="suggestion" data-current_step="1" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="true"></div>
                  <div class="suggestion" data-current_step="2" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="false"></div>
                  <div class="suggestion" data-current_step="3" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="false"></div>
                  <div class="suggestion" data-current_step="4" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="false"></div>
                  <div class="suggestion" data-current_step="5" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="false"></div>
                  <div class="suggestion" data-current_step="6" style="--thumb: var(--neutral-200);" aria-current="false"></div>
                  <button class="btn-handler btn-prev"><</button>
                  <button class="btn-handler btn-next">></button>
               </div>
            </div>
         </section>
      </main>
   </body>
</html>