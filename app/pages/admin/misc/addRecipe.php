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
            <section data-step="0"></section>
            <section data-step="1"></section>
            <section data-step="2"></section>
            <section data-step="3"></section>
         </form>
      </main>
      <footer>
         <div class="steps-wrapper">
            <div class="step" data-step="0" data-current="true" data-already="false"></div>
            <div class="step" data-step="1" data-current="false" data-already="false"></div>
            <div class="step" data-step="2" data-current="false" data-already="false"></div>
            <div class="step" data-step="3" data-current="false" data-already="false"></div>
         </div>
         <button class="step-handler btn_prev" data-action="prev">< Anterior</button>
         <button class="step-handler btn_next" data-action="next">Próximo ></button>
      </footer>
   </body>
</html>