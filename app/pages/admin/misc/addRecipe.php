<?php
   session_start();
   if((!isset($_SESSION['id'])) || ($_SESSION['id'] == null))
   {
      session_unset();
      session_destroy();
      header("location: ../../credentials.php");
   }

   require_once("../../AdminPageConstructor.php");
   $pageConstructor = new AdminPageConstructor();

   $admin = $pageConstructor->getAdminData($_SESSION['token']);

   if($admin == null)
   {
      header("location: ../../credentials.php");
   }
?>
<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      <title>Admin - Adicionar Receita</title>

      <!-- CSS -->
      <link rel="stylesheet" type="text/css" href="../../../../src/css/reset.css" />
      <link rel="stylesheet" type="text/css" href="../../../../src/css/pages/addRecipe/addRecipe-styles.css" />

      <!-- JS -->
      <script defer src="../../../../src/js/pages/misc/addRecipes/thumb_handler.js"></script>
      <script defer src="../../../../src/js/pages/misc/addRecipes/editIngredient.js"></script>
      <script defer src="../../../../src/js/pages/hamburger-menu.js"></script>
      <script defer src="../../../../src/js/pages/exitPage.js"></script>
      <script defer type="module" src="../../../../src/js/pages/misc/addRecipes/step-controller.js"></script>
      <script defer type="module" src="../../../../src/js/pages/misc/addRecipes/addIngredientDialog_controller.js"></script>
      <script defer type="module" src="../../../../src/js/pages/misc/addRecipes/categories_controller.js"></script>
      <script defer type="module" src="../../../../src/js/pages/misc/addRecipes/search_ingredients.js"></script>
      <script defer type="module" src="../../../../src/js/pages/misc/addRecipes/toDoModal_controller.js"></script>
   </head>
   <body>
      <header>
         <div class="header_head">
            <button id="mobile_menu--handler"></button>
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
                  <p>Autor e Fonte</p>
               </div>
            </li>
            <li class="step_display" data-step="2" data-current="false">
               <i class="step-icon">3</i>
               <div class="step_description--wrapper">
                  <span>Passo 3</span>
                  <p>Benefícios e Categoria</p>
               </div>
            </li>
            <li class="step_display" data-step="3" data-current="false">
               <i class="step-icon">4</i>
               <div class="step_description--wrapper">
                  <span>Passo 4</span>
                  <p>Adicionar Ingredientes</p>
               </div>
            </li>
         </ul>

         <aside class="mobile-menu" aria-expanded="false">
            <div class="menu-controller">
               <button class="btn_back" aria-label="Sair da Página"></button>
               <button id="btn_close" aria-label="Fechar Menu"></button>
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
                     <p>Autor e Fonte</p>
                  </div>
               </li>
               <li class="step_display" data-step="2" data-current="false">
                  <i class="step-icon">3</i>
                  <div class="step_description--wrapper">
                     <span>Passo 3</span>
                     <p>Benefícios e Categoria</p>
                  </div>
               </li>
               <li class="step_display" data-step="3" data-current="false">
                  <i class="step-icon">4</i>
                  <div class="step_description--wrapper">
                     <span>Passo 4</span>
                     <p>Adicionar Ingredientes</p>
                  </div>
               </li>
            </ul>
         </aside>
         <div class="backdrop"></div>
      </header>
      <main>
         <form id="form" action="../../../bd-conn-controller/pages/misc/addContent/addRecipeDB.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="recipe_editor" value="<?= $_SESSION['id'] ?>">
            <?php
            require_once("../../../bd-conn-controller/pages/misc/getContent/getRecipeData.php");
            $categories = getCategories($conn);
            ?>
            <section class="form_step" data-step="0" data-current="true">
               <h2 class="section_title">Adicionar Receita</h2>
               <div class="input-group">
                  <label for="txtTitle">Título</label>
                  <input required type="text" name="recipe_title" id="txtTitle">
               </div>
               <div class="input-group">
                  <label for="txtDescription">Descrição</label>
                  <textarea required name="recipe_description" id="txtDescription"></textarea>
               </div>
               <div class="input-group">
                  <p>Modo de Preparo</p>
                  <div class="ways_to_do-container">
                     <template id="todo-template">
                        <div class="waytodo">
                           <input type="hidden" name="waytodo[]" class="waytodo_input" value="">
                           <h3 class="waytodo_content"></h3>
                        </div>
                     </template>
                  </div>
                  <button type="button" class="add_waytodo" id="todo-handler">
                     <i></i>
                     Add. Etapa
                  </button>
               </div>
               <dialog id="way_to_do-modal">
                  <h2>Add. Etapa</h2>
                  <div class="decoration-container">
                     <i class="decoration" id="category_modal-decoration"></i>
                  </div>
                  <textarea name="step_description" id="todo_content" cols="30" rows="10"></textarea>
                  <button type="button" id="btn-set_step">Concluir</button>
               </dialog>
            </section>
            <section class="form_step" data-step="1" data-current="false">
               <div class="input-group">
                  <label for="txtAuthor">Autor</label>
                  <input required type="text" name="recipe_author" id="txtAuthor">
               </div>
               <div class="input-group">
                  <label for="txtSource">Fonte para a Receita</label>
                  <input type="text" name="recipe_source" id="txtSource" placeholder="e. url de um site">
               </div>
               <div class="input-group group-indicated_for">
                  <p>Esta receita é mais indicada para</p>
                  <div class="inputs">
                     <label>
                        <input type="radio" name="indicated_for" value="pre" checked>
                        Pré-diabetes
                     </label>
                     <label>
                        <input type="radio" name="indicated_for" value="diabetes">
                        Diabetes
                     </label>
                  </div>
               </div>
            </section>
            <section class="form_step" data-step="2" data-current="false">
               <h2 class="section_title">Add Receita</h2>
               <div class="input-group">
                  <label for="txtBenefits">Benefícios</label>
                  <textarea required name="recipe_benefits" id="txtBenefits"></textarea>
               </div>
               <div class="input-wrapper">
                  <div class="input-group">
                     <h2 class="thumb_label">Add. Imagem</h2>
                     <figure class="img_thumb" data-empty="true">
                        <input type="file" name="recipe_thumb" id="recipeThumb" accept="image/*">
                        <img id="thumb_preview" src="" alt="empty">
                     </figure>
                  </div>
                  <div class="input-group category_select_group">
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
                           foreach ($categories as $category) {
                           ?>
                              <li>
                                 <input class="category" type="radio" name="category" value="<?= $category['id'] ?>" id="category-<?= $category['id'] ?>" data-label="<?= $category['category'] ?>">
                                 <label for="category-<?= $category['id'] ?>"><?= $category['category'] ?></label>
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
                  <div class="decoration-container">
                     <i class="decoration" id="category_modal-decoration"></i>
                  </div>
                  <div>
                     <input type="text" name="category_title" id="add_category_input">
                     <button type="button" id="add_category_sender">Finalizar</button>
                  </div>
               </dialog>
            </section>
            <section class="form_step" data-step="3" data-current="false">
               <h2 class="section_title">Adicionar<br>Ingredientes</h2>
               <nav class="ingredients-controller">
                  <button type="button" class="add_ingredient"></button>
                  <div class="search_bar" aria-hidden="true">
                     <i></i>
                     <input type="text" name ="ingredientName" id="txtSearchIngredient">
                     <div class="ingredient_suggestions-container">
                        <template data-template>
                           <div class="suggestion hide">
                              <div class="ingredient"></div>
                           </div>
                        </template>
                     </div>
                  </div>
                  <button type="button" class="ingredients_edit"></button>
               </nav>
               <div>
                  <h3>Ingredientes</h3>
                  <div class="ingredients">
                     <template id="ingredient_template">
                        <button type="button" class="ingredient">
                           <span class="ingredient_title"></span>
                           <!-- Explicação - value=(<id do ingrediente>/<titulo do ingrediente>/<amount>/<id da medida>) -->
                           <input type="hidden" name="ingredient[]">
                           <div class="btn_remove" aria-hidden="true"></div>
                        </button>
                     </template>
                  </div>
               </div>
               <dialog id="ingredient-modal">
                  <input type="hidden" id="ingredient_id" id="ingredient_id">
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
            <dialog id="video_modal">
               <div class="video_modal_steps_display-container">
                  <i class="step_display" data-current="true" data-step="0"></i>
                  <i class="step_display" data-current="false" data-step="1"></i>
               </div>
               <section class="video_modal-step" data-current="true" data-step="0">
                  <h2>Deseja Adicionar um Vídeo para essa Receita?</h2>
                  <input type="file" id="flVideo" accept="video/*" name="recipe_video">
                  <div class="section_controller">
                     <button type="button" class="btn_video_cancel">Não quero</button>
                     <label for="flVideo">Add Vídeo</label>
                  </div>
               </section>
               <section class="video_modal-step" data-current="false" data-step="1">
                  <label for="txtVideoTitle">Título</label>
                  <input required type="text" name="video_title" id="txtVideoTitle">
                  <label for="txtVideoDescription">Descrição</label>
                  <textarea required name="video_description" id="txtVideoDescription" cols="30" rows="10"></textarea>
                  <div class="section_controller">
                     <button type="button" class="btn_video_cancel">Perder o vídeo</button>
                     <button type="submit" id="btn_send_video">Finalizar</button>
                  </div>
               </section>
            </dialog>
            <div class="form_footer-container">
               <div class="steps-wrapper">
                  <div class="step" data-step="0" data-current="true" data-already="false"></div>
                  <div class="step" data-step="1" data-current="false" data-already="false"></div>
                  <div class="step" data-step="2" data-current="false" data-already="false"></div>
                  <div class="step" data-step="3" data-current="false" data-already="false"></div>
               </div>
               <div class="form_footer">
                  <button type="button" class="step-handler btn_prev" data-action="prev">< Anterior</button>
                  <button type="button" class="step-handler btn_next" data-action="next">Próximo ></button>
                  <button class="step-handler btn_finish" data-action="finish">Finalizar</button>
               </div>
            </div>
         </form>
      </main>
   </body>

</html>