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
      <script defer src="../../../../src/js/pages/misc/admin-step-controller.js"></script>
   </head>
   <body>
      <header>
         <nav>

         </nav>
      </header>
      <main>
         <form action="" method="POST" enctype="multipart/form-data">
            <section class="form_step" data-step="0" data-current="true">
               <label for="txtTitle">Título</label>
               <input required type="text" name="recipe_title" id="txtTitle">
               <label for="txtDescription">Descrição</label>
               <textarea required name="recipe_description" id="txtDescription"></textarea>
            </section>
            <section class="form_step" data-step="1" data-current="false">

               <input required type="text" name="test">
            </section>
            <section class="form_step" data-step="2" data-current="false"></section>
            <section class="form_step" data-step="3" data-current="false"></section>
            
            <div class="form_footer">
               <button type="button" class="step-handler btn_prev" data-action="prev">< Anterior</button>
               <button type="button" class="step-handler btn_next" data-action="next">Próximo ></button>
               <button type="submit" class="step-handler btn_finish" data-action="finish">Finalizar</button>
            </div>
         </form>
         <div class="steps-wrapper">
            <div class="step" data-step="0" data-current="true" data-already="false"></div>
            <div class="step" data-step="1" data-current="false" data-already="false"></div>
            <div class="step" data-step="2" data-current="false" data-already="false"></div>
            <div class="step" data-step="3" data-current="false" data-already="false"></div>
         </div>
      </main>
   </body>
</html>