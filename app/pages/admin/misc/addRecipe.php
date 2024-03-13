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
      <script defer src="../../../../src/js/pages/misc/addRecipes/form_step.js"></script>
      <script defer src="../../../../src/js/pages/misc/addRecipes/header_step.js"></script>
      <script defer src="../../../../src/js/pages/misc/addRecipes/step-controller.js"></script>
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
         <form action="" method="POST" enctype="multipart/form-data">
            <section class="form_step" data-step="0" data-current="true">
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
               <div>
                  <figure class="img_thumb">
                     <input type="file" name="recipe_thumb" id="recipeThumb">
                     <img src="">
                  </figure>
               </div>
            </section>
            <section class="form_step" data-step="2" data-current="false">
               <h2>Adicionar Ingredientes</h2>
               <nav>
                  <button class="add_ingredient"></button>
                  <div class="search_bar">
                     <span>
                        <i></i>
                        <input type="text">
                     </span>
                  </div>
                  <button class="ingredients_edit"></button>
               </nav>
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