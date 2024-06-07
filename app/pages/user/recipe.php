<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>Receita</title>

      <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css"/>
      <link rel="stylesheet" type="text/css" href="../../../src/css/pages/advice-styles.css"/>
      <link rel="stylesheet" type="text/css" href="../../../src/css/pages/recipe-styles.css"/>

      <script defer src="../../../src/js/pages/hamburger-menu.js"></script>
      <script defer src="../../../src/js/pages/user/recipe/ingredients_amount_controller.js"></script>
   </head>
   <body>
      <?php
         $recipeId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

         if($recipeId == null)
         {
            //Redirecionar Usuario a tela principal...
            //header();
         }

         require_once("../../bd-conn-controller/pages/user/getRecipeDB.php");
         $recipe = getRecipe($recipeId);
      ?>
      <header>
         <div class="header_head-wrapper">
            <button id="mobile_menu--handler"></button>
            <a href="../../../index.php" class="logo"><span>DIABETES</span><br>Sob Controle</a>
         </div>
         <nav class="mobile-menu" aria-expanded="false">
            <button id="btn_close"></button>
         </nav>
         <div class="bg"></div>
         <hr>
      </header>
      <main>
         <?php
            include_once('./clinical_advice.php');
         ?>
         <section aria-label="Resumo da receita">
            <figure class="img_thumb">
               <img src="../../../assets/images/recipes/<?=htmlspecialchars($recipe['pic'])?>" alt="">
            </figure>
            <div class="abstract_content-container">
               <div class="title-container">
                  <h1 class="recipe-title"><?=$recipe['title']?></h1>
                  <p>por <span class="recipeAuthor"><?=$recipe['author']?></span><br>editado por <span class="recipeEditor"><?=$recipe['editor']?></span></p>
                  <div class="divider-wrapper">
                     <div class="horizontal-divider"></div>
                     <div class="vertical-divider"></div>
                     <div class="vertical-divider"></div>
                     <div class="horizontal-divider"></div>
                  </div>
               </div>
               <div class="description-container">
                  <p class="recipe-description"><?=$recipe['description']?></p>
                  <div class="categories-container">
                     <span class="recipe-category">Pré-Diabetes</span>
                     <span class="recipe-category"><?=$recipe['category']?></span>
                  </div>
               </div>
            </div>
         </section>
         <section aria-label="Ingredientes e modo de preparo">
            <section aria-labelledby="ingredients_section-title" class="ingredients_section">
               <h2 id="ingredients_section-title">Ingredientes</h2>
               <div>
                  <ul class="ingredients-container">
                     <?php
                        $ingredients = fitData($recipe['ingredients']);

                        foreach($ingredients as $ingredient)
                        {
                           $amountDetails = explode('~', $ingredient[1]);
                     ?>
                           <li>
                              <span class="ingredient-title"><?=$ingredient[0]?></span>
                              <span class="ingredient-amount"><span class="amount"><?=$amountDetails[0]?></span><span class="amount-unit"><?=$amountDetails[1]?></span></span>
                           </li>
                     <?php
                        }
                     ?>
                  </ul> 
                  <div class="amount_controller-wrapper">
                     <span>É o suficiente?</span>
                     <button class="amount-handler" data-action="plus"></button>
                     <span class="amount-display" data-amount="1"></span>
                     <button class="amount-handler" data-action="minus"></button>
                  </div>     
               </div>
            </section>
            <section aria-labelledby="waytodo_section-title">
               <h2 id="waytodo_section-title">Modo de Preparo</h2>
               <div>
                  <ul class="waytodo-container">
                     <?php
                        $waytodos = fitData($recipe['waytodo']);

                        foreach($waytodos as $waytodo)
                        {
                     ?>
                           <li>
                              <span class="sequence-index"><?=$waytodo[0]?></span>
                              <span class="waytodo-description"><?=$waytodo[1]?></span>
                           </li>
                     <?php
                        }
                     ?>
                  </ul>
               </div>
            </section>
         </section>
      </main>
   </body>
</html>