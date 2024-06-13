<?php
   // ini_set('display_errors', 1);
   // ini_set('display_startup_errors', 1);
   // error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>TG</title>

      <!-- CSS Styles -->
      <link rel="stylesheet" type="text/css" href="src/css/reset.css">
      <link rel="stylesheet" type="text/css" href="src/css/pages/user/user_homepage-styles.css">

      <script defer src="./src/js/pages/hamburger-menu.js"></script>
      <script type="module" defer src="./src/js/pages/user/homePage/recipeHandler.js"></script>
   </head>
   <body>
      <header>
         <div class="header_head-wrapper">
            <button id="mobile_menu--handler"></button>
            <a href="" class="logo"><span>DIABETES</span><br>Sob Controle</a>
         </div>
         <nav class="mobile-menu" aria-expanded="false">
            <button id="btn_close"></button>
         </nav>
         <div class="bg"></div>
         <div class="desktop-menu">   
         </div>
      </header>
      <main>
         <section aria-labelledby="section-title">
            <h2 id="section-title">Sugestões do dia</h2>
            <div class="carousel-container">
               <div class="suggestions-container">
                  <?php
                     $file = './app/pages/admin/data/datasets/temp_data/day_suggestions.json';
                     if(file_exists($file))
                     {
                        $daySuggestions = json_decode(file_get_contents($file), true);
                     }
                     else
                     {
                        echo 'Erro ao exibir as sugestões do dia!';
                     }

                     if((isset($daySuggestions)) && ($daySuggestions != null))
                     {
                        for($i = 0; $i < sizeof($daySuggestions) - 1; $i++)
                        {
                  ?>
                           <div class="suggestion">
                              <a href="./app/pages/user/recipe.php?id=<?=$daySuggestions[$i]['id']?>">
                                 <figure>
                                    <img src="./assets/images/recipes/<?=htmlspecialchars($daySuggestions[$i]['thumb'])?>" alt="teste">
                                 </figure>
                                 <div class="banner_content-container">
                                    <h1 class="sugestion-title"><?=$daySuggestions[$i]['title']?></h1>
                                    <p class="suggestion-description"><?=$daySuggestions[$i]['description']?></p>
                                 </div>
                              </a>
                           </div>
                  <?php
                        }
                     }
                  ?>
               </div>
               <div class="displayers-container">
                  <i class="displayer d-1"></i>
                  <i class="displayer d-2"></i>
                  <i class="displayer d-3"></i>
                  <i class="displayer d-4"></i>
                  <i class="displayer d-5"></i>
                  <i class="displayer d-6"></i>
               </div>
            </div>
         </section>
         <section aria-labelledby="most_recent_section-title">
            <h2 id="most_recent_section-title">Receitas Recentes</h2>
            <div class="recipes-container">
               <?php
                  require_once('./app/bd-conn-controller/pages/user/getRecipeDB.php');
                  $recipes = getRecentRecipes();

                  if($recipes != null)
                  {
                     foreach($recipes as $recipe)
                     {
               ?>
                        <div class="recipe">
                           <a href="./app/pages/user/recipe.php?id=<?=$recipe['id']?>">
                              <figure>
                                 <img src="./assets/images/recipes/<?=htmlspecialchars($recipe['thumb'])?>" alt="">
                              </figure>
                              <div class="recipe-details">
                                 <h3><?=$recipe['title']?></h3>
                                 <p><?=$recipe['benefits']?></p>
                              </div>
                           </a>
                        </div>
               <?php
                     }
                  }
               ?>
            </div>
         </section>
         <section aria-labelledby="videos_section-title">
            <h2 id="videos_section-title">Vídeos</h2>
            <div class="videos-container">
               <?php
                  require('./app/_conn/conn.php');
                  require_once("./app/bd-conn-controller/GetContent.php");
                  $content = new GetContent($conn);
                  $videos = $content->getVideos();

                  if((isset($videos)) && ($videos != null))
                  {
                     foreach($videos as $video)
                     {
               ?>
                        <div class="video">
                           <a href="./app/pages/user/recipe.php?id=<?=$video['id']?>">
                              <figure>
                                 <img src="./assets/images/recipes/<?=htmlspecialchars($video['url'])?>" alt="">
                              </figure>
                              <div class="recipe-details">
                                 <h3><?=$video['title']?></h3>
                              </div>
                           </a>
                        </div>
               <?php
                     }
                  }
               ?>
            </div>
         </section>
         <section aria-labelledby="categories_section-title">
            <h2 id="categories_section-title">Categorias</h2>
            <div class="filters-container">
               <?php
                  $content = new GetContent($conn);
                  $categories = $content->getCategories();

                  if($categories != null)
                  {
                     $i = 0;
                     foreach($categories as $category)
                     {
                        if($i < 5)
                        {
               ?>
                           <button class="category" data-id="<?=$category['id']?>"><?=$category['title']?></button>
               <?php
                           $i += 1;
                        }
                     }

                     if($i > 0)
                     {
               ?>
                        <button class="all_categories">Ver todas ></button>
               <?php
                     }
                  }
               ?>
            </div>
            <div class="category_recipes-container">
               <template id="recipe_by_category-template">
                  <div class="recipe">
                     <a href="">
                        <figure>
                           <img src="" alt="">
                        </figure>
                        <div class="recipe-details">
                           <h3 class="recipe-title"></h3>
                           <p class="recipe-benefits"></p>
                        </div>
                     </a>
                  </div>
               </template>
               <div class="results-container">
                  <?php
                     $recipes = getRecentRecipes(9);
                     if($recipes != null)
                     {
                        foreach($recipes as $recipe)
                        {   
                  ?>
                           <div class="recipe">
                              <a href="./app/pages/user/recipe.php?id=<?=$recipe['id']?>">
                                 <figure>
                                    <img src="./assets/images/recipes/<?=htmlspecialchars($recipe['thumb'])?>" alt="">
                                 </figure>
                                 <div class="recipe-details">
                                    <h3 class="recipe-title"><?=$recipe['title']?></h3>
                                    <p class="recipe-category"><?=$recipe['category']?></p>
                                 </div>
                              </a>
                           </div>
                  <?php
                        }
                     }
                  ?>
               </div>
            </div>
         </section>
      </main>
      <footer>
         <a href="" class="logo"><span>DIABETES</span><br>Sob Controle</a>
         <div class="topics">
            <div class="topic topic_pages">
               <p class="topic-title">SOBRE O SITE</p>
               <ul>
                  <li><a href="">Home</a></li>
                  <li><a href="">Receitas</a></li>
                  <li><a href="">Vídeos</a></li>
               </ul>
            </div>
            <div class="topic topic_credentials">
               <p class="topic-title">ADMINISTRADOR</p>
               <ul>
                  <li><a href="./app/pages/credentials.php">É um editor?</a></li>
               </ul>
            </div>
         </div>
      </footer>
   </body>
</html>