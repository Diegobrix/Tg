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
   <script defer src="../../../src/js/pages/hamburger-menu.js"></script>
</head>
<body>
   <header>
      <section class="mobile_header-container">
         <button class="btn_exit"></button>
         <h1 class="current_data_show-display">Receitas</h1>
         <button id="mobile_menu--handler"></button>

         <nav class="mobile-menu" aria-hidden="true">
            <button id="btn_close"></button>
            <ul>
               <li class="nav_item" data-current="true" data-item-index="1">Receitas</li>
               <li class="nav_item" data-current="false" data-item-index="2">Ingredientes</li>
               <li class="nav_item" data-current="false" data-item-index="3">Categorias</li>
               <li class="nav_item" data-current="false" data-item-index="4">Vídeos</li>
            </ul>
         </nav>
      </section>
      <section></section>
   </header>
</body>
</html>