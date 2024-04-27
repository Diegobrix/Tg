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
         <section aria-label="Resumo da receita">
            <figure class="img_thumb">
               <img src="" alt="">
            </figure>
            <div class="abstract_content-container">
               <h1 class="recipe-title"></h1>
               <p class="recipe_description"></p>
               <span class="recipe_category"></span>
            </div>
         </section>
         <section aria-label="Ingredientes e modo de preparo">
            <section aria-labelledby="ingredients_section-title" class="ingredients_section">
               <h2 id="ingredients_section-title">Ingredientes</h2>
               <div class="ingredients-container">
                  <template id="ingredients-template">

                  </template>
               </div>
               <section aria-labelledby="waytodo_section-title">
                  <h2 id="waytodo_section-title">Modo de Preparo</h2>
                  <div class="waytodo-container">
                     <template id="waytodo-template">
                        
                     </template>
                  </div>
               </section>
            </section>
         </section>
      </main>
   </body>
</html>