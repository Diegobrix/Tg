<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>Receita</title>

      <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css"/>
      <link rel="stylesheet" type="text/css" href="../../../src/css/pages/recipe-styles.css"/>

      <script defer src="../../../src/js/pages/hamburger-menu.js"></script>
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
            <a href="" class="logo"><span>DIABETES</span><br>Sob Controle</a>
         </div>
         <nav class="mobile-menu" aria-expanded="false">
            <button id="btn_close"></button>
            <ul>
               <li class="nav_item" data-current="<?=$choosedTypeId==0?'true':'false'?>" data-item-index="1"><a href="?content-type=Receitas&content-type-id=0">Receitas</a></li>
               <li class="nav_item" data-current="<?=$choosedTypeId==1?'true':'false'?>" data-item-index="2"><a href="?content-type=Ingredientes&content-type-id=1">Ingredientes</a></li>
               <li class="nav_item" data-current="<?=$choosedTypeId==2?'true':'false'?>" data-item-index="3"><a href="?content-type=Categorias&content-type-id=2">Categorias</a></li>
               <li class="nav_item" data-current="<?=$choosedTypeId==3?'true':'false'?>" data-item-index="4"><a href="?content-type=Vídeos&content-type-id=3">Vídeos</a></li>
            </ul>
         </nav>
         <div class="bg"></div>
         <hr>
      </header>
      <main>
         <section aria-label="Resumo da receita">
            <figure class="img_thumb">
               <img src="../../../assets/images/recipes/" alt="">
            </figure>
            <div class="abstract_content-container">
               <h1 class="recipe-title"></h1>
               <p>por <span class="recipeAuthor"></span></p>
               <div class="divider-wrapper">
                  <div class="horizontal-divider"></div>
                  <div class="vertical-divider"></div>
                  <div class="horizontal-divider"></div>
               </div>
               <p class="recipe-description"></p>
               <span class="recipe-category"></span>
            </div>
         </section>
         <section aria-label="Ingredientes e modo de preparo">
            <section aria-labelledby="ingredients_section-title" class="ingredients_section">
               <h2 id="ingredients_section-title">Ingredientes</h2>
               <div>
                  <ul class="ingredients-container">
                     <template id="ingredients-template">
                        <li>
                           <span class="ingredient-title"></span>
                           <span class="ingredient-amount">
                              <span class="amount-unit"></span>
                           </span>
                        </li>
                     </template>
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
                     <template id="waytodo-template">
                        <li>
                           <span class="sequence-index"></span>
                           <span class="waytodo-description"></span>
                        </li>
                     </template>
                  </ul>
               </div>
            </section>
         </section>
      </main>
   </body>
</html>