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
      <script defer src="../../../src/js/pages/user/searchResults/filtersController.js"></script>
      <script defer src="../../../src/js/pages/hamburger-menu.js"></script>
      <script type="module" defer src="../../../src/js/pages/user/searchResults/searchDisplay.js"></script>
   </head>
   <body>
      <header>
         <div class="header_head-wrapper">
            <button id="mobile_menu--handler"></button>
            <a href="../../../index.php" class="logo"><span>DIABETES</span><br>Sob Controle</a>
         </div>
         <nav class="mobile-menu" aria-expanded="false">
            <button id="btn_close" aria-label="Fechar Menu"></button>
            <button class="btn_exit">Voltar ao início</button>
         </nav>
         <div class="bg"></div>
         <nav class="desktop-menu" aria-expanded="false">
            <ul>
               <li><a href="../../../index.php">Home</a></li>
               <li><a href="../../../index.php">Todas as Receitas</a></li>
               <li><a href="../../../index.php">Categorias</a></li>
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
            <button class="filter_controller-handler">Filtros</button>
            <div class="display_mode-container">
               <button class="display_mode list-display" data-mode="list" aria-selected="false"></button>
               <button class="display_mode grid-display" data-mode="grid" aria-selected="true"></button>
            </div>
         </div>
         <div class="filters-container">
            <template id="filter-template">
               <button class="filter" data-type=""><span class="filter-label"></span><i></i></button>
            </template>
            <div class="filters"></div>
         </div>
         <div class="filters_setting-container" data-mobile="false" aria-hidden="false">
            <div class="container-head">
               <h2>Filtros</h2>
               <hr>
            </div>
            <div class="filter-container">
               <div class="filter_setting">
                  <div class="setting-thumb">
                     <h3>Categoria</h3>
                     <i class="chevron close"></i>
                  </div>
                  <div class="options-container categories_option-container" aria-expanded="false">
                     <template id="categories-template">
                        <label>
                           <input type="checkbox" name="category_option">
                        </label>
                     </template>
                     <label>
                        <input type="checkbox" name="category_option" id="category_all" checked>
                        Todas
                     </label>
                  </div>
               </div>
               <hr>
               <div class="filter_setting">
                  <div class="setting-thumb">
                     <h3>Condição Atual</h3>
                     <i class="chevron close"></i>
                  </div>
                  <div class="options-container" aria-expanded="false">
                     <label>
                        <input type="checkbox" name="health_condition_option" id="health_pre">
                        Pré-diabetes
                     </label>
                     <label>
                        <input type="checkbox" name="health_condition_option" id="health_diabetes">
                        Diabetes
                     </label>
                     <label>
                        <input type="checkbox" name="health_condition_option" id="health_all" checked>
                        Não importa
                     </label>
                  </div>
               </div>
            </div>
            <div class="apply-container">
               <button class="btn_filter_apply">Ver <span class="recipes_amount"></span> Receitas</button>
            </div>
         </div>
         <section class="results-container">
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
            </div>
         </section>
      </main>
   </body>
</html>