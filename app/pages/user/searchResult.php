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
      <script defer src="../../../src/js/pages/hamburger-menu.js"></script>
      <script defer src="../../../src/js/pages/user/searchResults/searchDisplay.js"></script>
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
         <section class="results-container">
            <div class="options-container">
               <div class="filter_add-wrapper">
                  <select name="" id="" class="filter-select">
                     <option selected disabled value="#">Filtros</option>
                  </select>
               </div>
               <div class="display_mode-container">
                  <button class="display_mode list-display" data-mode="list" aria-selected="true"></button>
                  <button class="display_mode grid-display" data-mode="grid" aria-selected="false"></button>
               </div>
            </div>
            <div class="filters-container">
            </div>
            <div class="results_display-container">
               <template id="result-template">
                  <div class="result">
                     <figure>
                        <img class="recipe-thumb" src="" alt="">
                     </figure>
                     <div class="result-details">
                        <h2 class="result-title"></h2>
                        <span class="result-description"></span>
                        <a href="">Ver receita ></a>
                     </div>
                  </div>
               </template>
            </div>
         </section>
      </main>
   </body>
</html>