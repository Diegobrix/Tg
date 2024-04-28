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
         <div class="b"></div>
         <hr>
      </header>
      <main>
         <section aria-label="Resumo da receita">
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
      </main>
   </body>
</html>