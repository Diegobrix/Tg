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
         <section aria-labelledby="most_recent-section_title">
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
      </main>
   </body>
</html>