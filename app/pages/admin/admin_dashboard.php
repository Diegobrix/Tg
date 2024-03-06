<?php
   session_start();
   if((!isset($_SESSION['admin_id'])) || ($_SESSION['admin_id'] == false))
   {
      session_unset();
      session_destroy();
		header("location: ../credentials.php");
   }

   require_once("AdminPagesConstructor.php");
   $pageConstructor = new AdminPagesConstructor($_SESSION['admin_token']);
   $user = $pageConstructor->getAdminData();

   if($user == null)
   {
      session_unset();
      session_destroy();

      die();
   }

   $content = $pageConstructor->getContentData("content_data");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Admin - Dashboard</title>

   <!-- CSS -->
   <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css" />
   <link rel="stylesheet" type="text/css" href="../../../src/css/pages/admin/admin_dashboard-styles.css" />

   <!-- JS -->
   <script defer src="../../../src/js/pages/admin/admin_dashboard/generateStats.js"></script>
   <script defer src="../../../src/js/pages/admin/admin_dashboard/generateList.js"></script>
   <script defer src="../../../src/js/pages/admin/menu-controller.js"></script>
   
   <script defer src="../../../src/js/sessionController.js"></script>
</head>
<body>
</body>
   <header>
      <nav>
         <div class="header-controller">
            <button class="btn-back"></button>
            <h2>olá, <span class="username"><?=$user['username']?></span></h2>
         </div>
         <ul aria-expanded="true">
            <li data-current="true" data-link="recipes">Receitas</li>
            <li data-current="false" data-link="categories">Categorias</li>
            <li data-current="false" data-link="videos">Vídeos</li>
            <li data-current="false" data-link="ingredients">Ingredientes</li>
         </ul>
         <div class="stats-wrapper">
            <div class="stats">
               <div class="stat_bar" data-legend="recipes"></div>
               <div class="stat_bar" data-legend="categories"></div>
               <div class="stat_bar" data-legend="videos"></div>
               <div class="stat_bar" data-legend="ingredients"></div>
            </div>
            <div class="stats_legends">
               <div class="legend-wrapper legend_recipe">
                  <span></span>
                  <p>Receitas</p>
               </div>
               <div class="legend-wrapper legend_category">
                  <span></span>
                  <p>Categorias</p>
               </div>
               <div class="legend-wrapper legend_video">
                  <span></span>
                  <p>Vídeos</p>
               </div>
               <div class="legend-wrapper legend_ingredient">
                  <span></span>
                  <p>Ingredientes</p>
               </div>
            </div>
         </div>
         <button id="mobile_menu--handler"></button>
      </nav>
   </header>
   <section>
      <nav class="search_navigation--wrapper">
         <div>
            <span></span>
            <input type="text" name="search" id="txtDashboardSearch" placeholder="Pesquisar">
         </div>
         <div class="add-container">
            <button class="btn_menu_add"></button>
            <ul class="dropdown_menu" aria-hidden="true">
               <li>Nova receita</li>
               <li>Nova categoria</li>
            </ul>
         </div>
      </nav>
      <main>
         <div id="result--wrapper">
         </div>
      </main>
   </section>
</html>