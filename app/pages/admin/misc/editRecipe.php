<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>Editar Receita</title>

      <link rel="stylesheet" type="text/css" href="../../../../src/css/reset.css"/>
      <link rel="stylesheet" type="text/css" href="../../../../src/css/pages/misc/edit-recipe-styles.css"/>

      <script defer src="../../../../src/js/pages/hamburger-menu.js"></script>
      <script defer src="../../../../src/js/pages/user/recipe/ingredients_amount_controller.js"></script>
      <script defer src="../../../../src/js/pages/misc/addRecipes/thumb_handler.js"></script>
      <script defer src="../../../../src/js/pages/misc/editRecipe/form_editHandler.js"></script>
      <script defer src="../../../../src/js/pages/misc/editRecipe/dialogController.js"></script>
   </head>
   <body>
      <?php
         $recipeId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

         if($recipeId == null)
         {
            //Redirecionar Usuario a tela principal...
            //header();
         }

         require_once("../../../bd-conn-controller/pages/user/getRecipeDB.php");
         $recipe = getRecipe($recipeId);
      ?>
      <header>
         <div class="header_head-wrapper">
            <button id="mobile_menu--handler"></button>
            <a href="" class="logo"><span>DIABETES</span><br>Sob Controle</a>
         </div>
         <nav class="mobile-menu" aria-expanded="false">
            <button id="btn_close"></button>
         </nav>
         <div class="bg"></div>
         <h1>Editar Receita</h1>
         <hr>
      </header>
      <main>
         <form action="../../../bd-conn-controller/pages/misc/addContent/editRecipeDB.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$recipeId?>">
            <input type="hidden" name="originalImg" value="<?=htmlspecialchars($recipe['pic'])?>">
            <section aria-label="Resumo da receita">
               <figure class="img_thumb">
                  <div class="bg"></div>
                  <input type="file" name="recipe_thumb" id="recipeThumb" accept="image/*">
                  <img id="thumb_preview" src="../../../../assets/images/recipes/<?=htmlspecialchars($recipe['pic'])?>" alt="empty">
               </figure>
               <div class="abstract_content-container">
                  <div class="title-container">
                     <input type="text" required pattern="\w{1, }" name="recipe-title" id="recipeTitle" value="<?=$recipe['title']?>" placeholder="Insira um novo título...">
                     <div class="divider-wrapper">
                        <div class="horizontal-divider"></div>
                        <div class="vertical-divider"></div>
                        <div class="vertical-divider"></div>
                        <div class="horizontal-divider"></div>
                     </div>
                  </div>
                  <div class="description-container">
                     <textarea class="recipe-description" name="recipe-description" required pattern="\w{1, }" placeholder="Insira uma nova descrição..."><?=$recipe['description']?></textarea>
                     <span class="recipe-category"><?=$recipe['category']?></span>
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
                  </div>
               </section>
               <section aria-labelledby="waytodo_section-title">
                  <h2 id="waytodo_section-title">Modo de Preparo</h2>
                  <button type="button" id="waytodo_edit-handler"></button>
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
            <dialog id="waytodo-dialog">
               <div class="decoration-container">
                  <i class="decoration" id="category_modal-decoration"></i>
               </div>
               <h2>Editar Modo de Preparo</h2>
               <div class="waytodo-container">
                  <?php
                     $waytodos = fitData($recipe['waytodo']);
                     foreach($waytodos as $waytodo)
                     {
                  ?>
                        <li>
                           <span class="sequence-index"><?=$waytodo[0]?></span>
                           <input type="text" name="todo[]" class="waytodo-description" value="<?=$waytodo[1]?>"/>
                        </li>
                  <?php
                     }
                  ?>
               </div>
               <button type="button" class="add_waytodo">Add. Etapa</button>
            </dialog>
            <div class="form-controller">
               <button type="submit">Salvar Receita</button>
            </div>
         </form>
      </main>
   </body>
</html>