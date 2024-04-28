<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Receita</title>

      <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css"/>
      <link rel="stylesheet" type="text/css" href="../../../src/css/pages/recipe-styles.css"/>

      <script src="../../../src/js/pages/hamburger-menu.js"></script>
   </head>
   <body>
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
         <img src="../../../assets/images/teste_receita.jpg" alt="">
         <img src="../../../assets/images/teste_receita.jpg" alt="">
         <!-- <section aria-label="Resumo da receita">
            <figure class="img_thumb">
               <img src="../../../assets/images/teste_receita.jpg" alt="">
            </figure>
            <div class="abstract_content-container">
               <h1 class="recipe-title">Macarrrrão</h1>
               <p class="recipe_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo quibusdam quia vel. Provident natus officia, odit quam facilis recusandae quas molestiae aperiam magnam numquam ullam perferendis, eum, in reprehenderit tempore.
               Reiciendis vel earum commodi quidem ipsa saepe eos maxime exercitationem repellendus veniam aspernatur dignissimos voluptas sit id libero voluptates alias dolores, inventore nihil quis autem officiis. Libero autem minima ullam?</p>
               <span class="recipe_category">Massas</span>
            </div>
         </section>
         <section aria-label="Ingredientes e modo de preparo">
            <section aria-labelledby="ingredients_section-title" class="ingredients_section">
               <h2 id="ingredients_section-title">Ingredientes</h2>
               <div>
                  <div class="amount_ingredients-wrapper">
                     <span>É o suficiente?</span>
                     <button class="amount-handler" data-action="plus"></button>
                     <span class="amount-display">1</span>
                     <button class="amount-handler" data-action="minus"></button>
                  </div>
                  <ul class="ingredients-container">
                     <template id="ingredients-template">
                        <li>
                           <span class="ingredient-title"></span>
                           <span class="ingredient-amount">
                              <span class="amount-unit"></span>
                           </span>
                        </li>
                     </template>
                     <li>
                        <span class="ingredient-title">Ovo</span>
                        <span class="ingredient-amount">6<span class="amount-unit">un</span></span>
                     </li>
                     <li>
                        <span class="ingredient-title">Farinha</span>
                        <span class="ingredient-amount">100<span class="amount-unit">g</span></span>
                     </li>
                     <li>
                        <span class="ingredient-title">Leite</span>
                        <span class="ingredient-amount">50<span class="amount-unit">ml</span></span>
                     </li>
                     <li>
                        <span class="ingredient-title">Fermento</span>
                        <span class="ingredient-amount">8<span class="amount-unit">g</span></span>
                     </li>
                     <li>
                        <span class="ingredient-title">Açúcar</span>
                        <span class="ingredient-amount">520<span class="amount-unit">g</span></span>
                     </li>
                  </ul>      
               </div>
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
                        <li>
                           <span class="sequence-index">1</span>
                           <span class="waytodo-description">Aqueça uma frigideira em fogo médio</span>
                        </li>
                        <li>
                           <span class="sequence-index">2</span>
                           <span class="waytodo-description">Aqueça uma frigideira em fogo médio</span>
                        </li>
                        <li>
                           <span class="sequence-index">3</span>
                           <span class="waytodo-description">Aqueça uma frigideira em fogo médio</span>
                        </li>
                        <li>
                           <span class="sequence-index">4</span>
                           <span class="waytodo-description">Aqueça uma frigideira em fogo médio</span>
                        </li>
                     </ul>
                  </div>
               </section>
            </section>
         </section> -->
      </main>
   </body>
</html>