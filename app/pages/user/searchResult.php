<?php
   $searchedTerm = filter_input(INPUT_GET, 'searchedTerm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   if((!isset($searchedTerm)) || ($searchedTerm == null))
   {
      $searchedTerm = '';
   }
?>
<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
      <title>Resultado da Pesquisa</title>

      <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css"/>
      <link rel="stylesheet" type="text/css" href="../../../src/css/pages/searchResult-styles.css"/>

      <script defer src="../../../src/js/pages/user/searchResults/contentDisplayController.js"></script>
      <script defer src="../../../src/js/pages/user/searchResults/responsiveContentController.js"></script>
      <script defer src="../../../src/js/pages/hamburger-menu.js"></script>
      <script type="module" defer src="../../../src/js/pages/user/searchResults/searchDisplay.js"></script>
   </head>
   <body>
      <header>
         <div class="header_head-wrapper">
            <button id="mobile_menu--handler"></button>
            <a href="" class="logo"><span>DIABETES</span><br>Sob Controle</a>
         </div>
         <nav class="mobile-menu" aria-expanded="false">
            <button id="btn_close" aria-label="Fechar Menu"></button>
            <button class="btn_exit">Voltar ao início</button>
         </nav>
         <div class="bg"></div>
         <nav class="desktop-menu" aria-expanded="false">
            <ul>
               <li>Voltar ao Inicio</li>
            </ul>
         </nav>
         <hr>
      </header>
      <main>
         <section class="search-container">
            <div class="searchbar-wrapper">
               <i class="searchbar-icon"></i>
               <input type="text" name="searchbar" id="searchbar" placeholder="<?=$searchedTerm?>">
            </div>
            <h1>Resultados para "<?=$searchedTerm?>"</h1>
         </section>
         <div class="options-container">
            <button class="filter-controller">Filtros</button>
            <div class="display_mode-container">
               <button class="display_mode list-display" data-mode="list" aria-selected="false"></button>
               <button class="display_mode grid-display" data-mode="grid" aria-selected="true"></button>
            </div>
         </div>
         <section class="results-container">
            <section class="filters-container">
            </section>
            <div class="results_display-container">
               <template id="result-template">
                  <div class="result">
                     <figure>
                        <img class="recipe-thumb" src="" alt="">
                     </figure>
                     <div class="result-details">
                        <h2 class="result-title"></h2>
                        <span class="result-description"></span>
                        <a class="recipe-link" href="">Ver receita ></a>
                     </div>
                  </div>
               </template>
               <template id="no_results-template">
                  <div class="no_result">
                     <i></i>
                     <div class="no_result-description">
                        <h2>Desculpe, nenhum registro encontrado para "<?=$searchedTerm?>"</h2>
                        <p>Você pode tentar um termo ou filtro diferente!</p>
                     </div>
                  </div>
               </template>
               <div class="result">
                  <figure>
                     <img class="recipe-thumb" src="../../../assets/images/recipes/66300ebb307fcMacarr&amp;atilde;o_de_teste/66300ebb30e98_teste_receita.jpg" alt="">
                  </figure>
                  <div class="result-details">
                     <h2 class="result-title">Macarrão de teste</h2>
                     <span class="result-description">Testando uma receita de macarrão</span>
                     <a class="recipe-link" href="./recipe.php?id=38">Ver receita &gt;</a>
                  </div>
               </div>
               <div class="result">
                  <figure>
                     <img class="recipe-thumb" src="../../../assets/images/recipes/66300ebb307fcMacarr&amp;atilde;o_de_teste/66300ebb30e98_teste_receita.jpg" alt="">
                  </figure>
                  <div class="result-details">
                     <h2 class="result-title">Macarrão de teste</h2>
                     <span class="result-description">Testando uma receita de macarrão</span>
                     <a class="recipe-link" href="./recipe.php?id=38">Ver receita &gt;</a>
                  </div>
               </div>
               <div class="result">
                  <figure>
                     <img class="recipe-thumb" src="../../../assets/images/recipes/66300ebb307fcMacarr&amp;atilde;o_de_teste/66300ebb30e98_teste_receita.jpg" alt="">
                  </figure>
                  <div class="result-details">
                     <h2 class="result-title">Macarrão de teste</h2>
                     <span class="result-description">Testando uma receita de macarrão</span>
                     <a class="recipe-link" href="./recipe.php?id=38">Ver receita &gt;</a>
                  </div>
               </div>
               <div class="result">
                  <figure>
                     <img class="recipe-thumb" src="../../../assets/images/recipes/66300ebb307fcMacarr&amp;atilde;o_de_teste/66300ebb30e98_teste_receita.jpg" alt="">
                  </figure>
                  <div class="result-details">
                     <h2 class="result-title">Macarrão de teste</h2>
                     <span class="result-description">Testando uma receita de macarrão</span>
                     <a class="recipe-link" href="./recipe.php?id=38">Ver receita &gt;</a>
                  </div>
               </div>
            </div>
         </section>
      </main>
   </body>
</html>