<!DOCTYPE html>
<html lang="pt-BR">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Admin - Dashboard</title>

   <!-- CSS -->
   <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css" />
   <link rel="stylesheet" type="text/css" href="../../../src/css/pages/admin/admin_dashboard-styles.css" />
</head>
<body>
</body>
   <header>
      <nav>
         <div class="header-controller">
            <button class="btn-back"></button>
            <h2>olá <span class="username">Fulano</span></h2>
         </div>
         <ul aria-expanded="true">
            <li data-current="true">Receitas</li>
            <li data-current="false">Categorias</li>
            <li data-current="false">Vídeos</li>
            <li data-current="false">Ingredientes</li>
         </ul>
         <button id="mobile_menu--handler"></button>
      </nav>
   </header>
   <section>
      <nav class="search_navigation--wrapper">
         <div>
            <span></span>
            <input type="text" name="search" id="txtDashboardSearch" placeholder="Pesquisar">
         </div>
         <div>
            <select name="filter-categories" id="categories">
               <option value="#" selected disabled>Filtrar</option>
               <option value="most_recent">Mais Recente</option>
               <option value="older">Mais Antigo</option>
            </select>
         </div>
      </nav>
      <main>
         <div id="result--wrapper">
            <div class="result">
               <figure>
                  <img src="../../../assets/images/teste.jpg" alt="">
               </figure>
               <h2 class="result-title">Chorume ao molho branco</h2>
               <span class="result-category">Ao mosso</span>
               <button class="result_handler"></button>
            </div>
         </div>
      </main>
   </section>
</html>