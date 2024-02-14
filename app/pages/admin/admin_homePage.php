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
         //Tirar Despois
         $number = 100.6;
         //echo number_format((float)$number, 2, ".");
      ?>
      <header>
         <div class="greetings-wrapper">
            <button id="mobile_menu--handler">
            </button>
            <h1>Olá, <span class="username">Fulano</span></h1>
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
                  <p class="recipes_amount-display">1200</p>
                  <button class="options-handler"></button>
               </div>
               <div class="popular_category--wrapper">
                  <h2>Principal Categoria</h2>
                  <p class="popular_category-display">Ao mosso</p>
                  <div>
                     <p class="popular_category_amount-display">55</p>
                     <span>Receitas</span>
                  </div>
               </div>
               <div class="most_recent_recipe--wrapper">
                  <h2>Última Receita Adicionada</h2>
                  <p class="most_recent_recipe-display">Lorem ipsum sit dolor</p>
                  <figure>
                     <img src="../../../assets/images/teste.jpg" alt="Foto da última receita adicionada" class="last_recipe_thumb-display">
                  </figure>
               </div>
            </div>
            <section class="categories--wrapper">
               <div class="categories--label">
                  <h2>Top Categorias</h2>
               </div>
               <div class="categories-container">
                  <button class="options-handler"></button>
                  <!-- Trazer as Categorias Pelo PHP -->
                  <div class="category">
                     <div class="bar bigger" style="--bar-size: 1;" data-recipes-amount="10"></div>
                     <p class="category-title">Ao mosso</p>
                  </div>
                  <div class="category">
                     <div class="bar" style="--bar-size: .5;" data-recipes-amount="5"></div>
                     <p class="category-title">Ao mosso</p>
                  </div>
                  <div class="category">
                     <div class="bar" style="--bar-size: .87;" data-recipes-amount="8"></div>
                     <p class="category-title">Ao mosso</p>
                  </div>
                  <div class="category">
                     <div class="bar" style="--bar-size: .7;" data-recipes-amount="7"></div>
                     <p class="category-title">Ao mosso</p>
                  </div>
                  <div class="category">
                     <div class="bar" style="--bar-size: .66;" data-recipes-amount="6"></div>
                     <p class="category-title">Ao mosso</p>
                  </div>
               </div>
            </section>
         </section>
         <section class="other_options-wrapper">
            <div class="videos-widget">
               <h2>Vídeos</h2>
               <p class="videos_amount">7</p>
               <button class="options-handler"></button>
            </div>
            <div class="categories-widget">
               <h2>Categorias</h2>
               <p class="categories_amount">6</p>
               <button class="options-handler"></button>
            </div>
            <div class="suggestions_container">
               <span>Sugestão do Dia</span>
               <div class="suggestions--wrapper">
                  <div class="suggestion" data-current_step="1" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="true"></div>
                  <div class="suggestion" data-current_step="2" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="false"></div>
                  <div class="suggestion" data-current_step="3" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="false"></div>
                  <div class="suggestion" data-current_step="4" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="false"></div>
                  <div class="suggestion" data-current_step="5" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="false"></div>
                  <div class="suggestion" data-current_step="6" style="--thumb: url(../../../../assets/images/teste.jpg);" aria-current="false"></div>
                  <button class="btn-handler btn-prev"><</button>
                  <button class="btn-handler btn-next">></button>
               </div>
            </div>
         </section>
      </main>
   </body>
</html>