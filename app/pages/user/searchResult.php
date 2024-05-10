<?php
   $searchedTerm = filter_input(INPUT_GET, 'searchTerm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   if((!isset($searchedTerm)) || ($searchedTerm == ''))
   {
      //Voltar para home
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
               <input type="text" name="" id="searchbar" placeholder="Macarrão">
            </div>
            <h1>Resultados para "Macarrão"</h1>
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
               <?php
                  require_once('../../bd-conn-controller/pages/recipeSearch/idealSearch.php');
               ?>
               <div class="result">
                  <figure>
                     <img src="../../../assets/images/teste_receita.jpg" alt="">
                  </figure>
                  <div class="result-details">
                     <h2 class="result-title">Macarrão</h2>
                     <span class="result-description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt, cumque. Quaerat praesentium suscipit alias hic? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt, cumque. Quaerat praesentium suscipit alias hic? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt, cumque. Quaerat praesentium suscipit alias hic?</span>
                     <a href="">Ver receita ></a>
                  </div>
               </div>
               <?php
               ?>
            </div>
            <?php
               print("<pre>".print_r(getSearchedRecipes(''), true)."</pre>");
            ?>
         </section>
      </main>
   </body>
</html>