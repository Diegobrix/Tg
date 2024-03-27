<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
      <title>Admin - Adicionar Receita</title>

      <!-- CSS -->
      <link rel="stylesheet" type="text/css" href="../../../../src/css/reset.css" />
      <link rel="stylesheet" type="text/css" href="../../../../src/css/pages/addRecipe/addRecipe-styles.css" />

      <!-- JS -->
      <script defer type="module" src="../../../../src/js/pages/misc/addRecipes/step-controller.js"></script>
      <script defer src="../../../../src/js/pages/misc/addRecipes/thumb_handler.js"></script>
      <script defer type="module" src="../../../../src/js/pages/misc/addRecipes/addIngredientDialog_controller.js"></script>
      <script defer type="module" src="../../../../src/js/pages/misc/addRecipes/categories_controller.js"></script>
      <script defer type="module" src="../../../../src/js/pages/misc/addRecipes/search_ingredients.js"></script>
      <script defer src="../../../../src/js/pages/misc/addRecipes/search_ingredients.js"></script>
      <script defer src="../../../../src/js/pages/misc/addRecipes/editIngredient.js"></script>
   </head>
   <body>
      <header>
         <div class="header_head">
            <button class="btn_back"></button>
            <h1>Adicionar Receita</h1>
         </div>
         <ul class="steps_descriptions">
            <li class="step_display" data-step="0" data-current="true">
               <i class="step-icon">1</i>
               <div class="step_description--wrapper">
                  <span>Passo 1</span>
                  <p>Informações Básicas</p>
               </div>
            </li>
            <li class="step_display" data-step="1" data-current="false">
               <i class="step-icon">2</i>
               <div class="step_description--wrapper">
                  <span>Passo 2</span>
                  <p>Benefícios e Categoria</p>
               </div>
            </li>
            <li class="step_display" data-step="2" data-current="false">
               <i class="step-icon">3</i>
               <div class="step_description--wrapper">
                  <span>Passo 3</span>
                  <p>Adicionar Ingredientes</p>
               </div>
            </li>
         </ul>
      </header>
      <main>
         <form action="#" method="GET" enctype="multipart/form-data">
            <?php
               require_once("../../../bd-conn-controller/pages/misc/addContent/addRecipeDB.php");
               $categories = getCategories($conn);
            ?>
            <section class="form_step" data-step="0" data-current="false">
               <div class="input-group">
                  <label for="txtTitle">Título</label>
                  <input required type="text" name="recipe_title" id="txtTitle">
               </div>
               <div class="input-group">
                  <label for="txtDescription">Descrição</label>
                  <textarea required name="recipe_description" id="txtDescription"></textarea>
               </div>
            </section>
            <section class="form_step" data-step="1" data-current="false">
               <div class="input-group">
                  <label for="txtBenefits">Benefícios</label>
                  <textarea required name="recipe_benefits" id="txtBenefits"></textarea>
               </div>
               <div class="input-wrapper">
                  <div class="input-group">
                     <figure class="img_thumb" data-empty="true">
                        <input type="file" name="recipe_thumb" id="recipeThumb" accept="image/*">
                        <img id="thumb_preview" src="" alt="empty">
                     </figure>
                  </div>
                  <div class="input-group">
                     <h3>Categoria</h3>
                     <div class="custom_select" id="category_custom_select">
                        <label class="select_face" for="categorySelectHandler">
                           <input type="checkbox" id="categorySelectHandler">
                           <h4 id="selectedCategory">Selecione uma Categoria </h4>
                           <div class="chevrons">
                              <i class="chevron chevron_down"></i>
                              <i class="chevron chevron_up"></i>
                           </div>
                        </label>
                        <ul id="categoryOptionsContainer" class="options" aria-hidden="true">
                           <template class="category_template">
                              <li>
                                 <input class="category" type="radio" name="category" data-label="">
                                 <label for=""></label>
                              </li>
                           </template>
                           <?php
                              foreach($categories as $category)
                              {
                           ?>
                              <li>
                                 <input class="category" type="radio" name="category" value="<?=$category['id']?>" id="category-<?=$category['id']?>" data-label="<?=$category['category']?>">
                                 <label for="category-<?=$category['id']?>"><?=$category['category']?></label>
                              </li>
                           <?php
                              }
                           ?>
                        </ul>
                     </div>
                     <button class="btn_add_category" type="button">Add. Categoria</button>
                  </div>
               </div>
               <dialog id="add_category-modal">
                  <h2>Crie uma<br> nova categoria</h2>
                  <input type="text" name="category_title" id="add_category_input">
                  <button type="button" id="add_category_sender">Finalizar</button>
               </dialog>
            </section>
            <section class="form_step" data-step="2" data-current="true">
               <h2>Adicionar<br>Ingredientes</h2>
               <nav class="ingredients-controller">
                  <button type="button" class="add_ingredient"></button>
                  <div class="search_bar">
                     <i></i>
                     <input type="text" name ="ingredientName" id="txtSearchIngredient">
                     <div class="ingredient_suggestions-container">
                        <template data-template>
                           <div class="suggestion hide">
                              <div class="ingredient">

                              </div>
                           </div>
                        </template>
                     </div>
                  </div>
                  <button type="button" class="ingredients_edit"></button>
               </nav>
               <h3>Ingredientes</h3>
               <div class="ingredients">
                  <!-- <template id="ingredient_template">
                     <button class="ingredient">
                        <span class="ingredient_title"></span>
                     </button>
                  </template> -->
                  <button class="ingredient" id="7">
                     <span class="ingredient_title">novo</span>
                     <input type="hidden" name="ingredient">
                     <div class="btn_remove" aria-hidden="true"></div>
                     <div class="ingredient_details" aria-hidden="true">
                        <input type="text" name="ingredient_amount">
                     </div>
                  </button>
                  <button class="ingredient" id="8">
                     <span class="ingredient_title">sal</span>
                     <input type="hidden" name="ingredient">
                     <div class="btn_remove" aria-hidden="true"></div>
                     <div class="ingredient_details" aria-hidden="true">
                        <input type="text" name="ingredient_amount">
                     </div>
                  </button>
               </div>
               <dialog id="add_ingredient-modal">
                  <h2>Crie um<br> novo ingrediente</h2>
                  <input type="text" name="ingredient_name" id="txtIngredient">
                  <div class="amount-wrapper" aria-hidden="true">
                     <h3>Quantidade:</h3>
                     <div>
                        <input type="text" name="ingredient_amount" id="txtIngredientAmount">
                        <select name="amount_unit" id="slcUnit">
                           <?php
                              $units = getUnits($conn);
                              if(isset($units))
                              {
                                 foreach($units as $unit)
                                 {
                           ?>
                                    <option value="<?=$unit['id']?>"><?=$unit['unit']?></option>
                           <?php
                                 }
                              }
                           ?>
                        </select>
                     </div>
                  </div>
                  <button type="button" data-current-action="next" id="add_ingredient_modal_controller">Próximo</button>
               </dialog>
            </section>
            <div class="form_footer">
               <button class="step-handler btn_prev" data-action="prev">< Anterior</button>
               <button class="step-handler btn_next" data-action="next">Próximo ></button>
               <button type="submit" class="step-handler btn_finish" data-action="finish">Finalizar</button>
            </div>
         </form>
         <div class="steps-wrapper">
            <div class="step" data-step="0" data-current="true" data-already="false"></div>
            <div class="step" data-step="1" data-current="false" data-already="false"></div>
            <div class="step" data-step="2" data-current="false" data-already="false"></div>
         </div>
      </main>
   </body>
</html>