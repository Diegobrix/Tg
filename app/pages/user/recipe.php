<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>Receita</title>

      <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css"/>
      <link rel="stylesheet" type="text/css" href="../../../src/css/pages/recipe-styles.css"/>
   </head>
   <body>
      <header>
         <a href="" class="logo"><span>DIABETES</span><br>Sob Controle</a>
         <hr>
      </header>
      <main>
         <aside>
            <figure class="recipe_thumb">
               <img src="../../../assets/images/recipes/">
            </figure>
            <section aria-label="Ingredientes da receita">
               <h2>Ingredientes</h2>
               <div class="ingredients-container">
                  <template id="ingredients-template"></template>
               </div>
            </section>
         </aside>
         <section aria-label="Dados da receita">
            <section aria-label="Resumo da receita">
               <h1 class="recipe_title"></h1>
               <p class="recipe_description"></p>
            </section>
            <section aria-label="Modo de preparo da receita">
               <h2>Modo de Preparo</h2>
               <div class="waytodo-container">
                  <template id="waytodo-template"></template>
               </div>
            </section>
         </section>
      </main>
   </body>
</html>