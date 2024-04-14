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
   $choosedType= filter_input(INPUT_GET, 'content-type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $choosedTypeId= filter_input(INPUT_GET, 'content-type-id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
         <button id="mobile_menu--handler"></button>
         <h1 class="current_data_show-display"><?=$choosedType?></h1>
         <button class="btn_exit"></button>

         <nav class="mobile-menu" aria-expanded="false">
            <button id="btn_close"></button>
            <ul>
               <li class="nav_item" data-current="<?=$choosedTypeId==0?'true':'false'?>" data-item-index="1">Receitas</li>
               <li class="nav_item" data-current="<?=$choosedTypeId==1?'true':'false'?>" data-item-index="2">Ingredientes</li>
               <li class="nav_item" data-current="<?=$choosedTypeId==2?'true':'false'?>" data-item-index="3">Categorias</li>
               <li class="nav_item" data-current="<?=$choosedTypeId==3?'true':'false'?>" data-item-index="4">Vídeos</li>
            </ul>
         </nav>
         <div class="bg"></div>
      </section>
      <section class="desktop_menu">
         <button class="btn_exit"></button>
         <h2 class="username-display"><?=$user['username']?></h2>
         <ul>
            <li class="nav_item" data-current="<?=$choosedTypeId==0?'true':'false'?>" data-item-index="1">Receitas</li>
            <li class="nav_item" data-current="<?=$choosedTypeId==1?'true':'false'?>" data-item-index="2">Ingredientes</li>
            <li class="nav_item" data-current="<?=$choosedTypeId==2?'true':'false'?>" data-item-index="3">Categorias</li>
            <li class="nav_item" data-current="<?=$choosedTypeId==3?'true':'false'?>" data-item-index="4">Vídeos</li>
         </ul>
      </section>
   </header>
   <main>
      <section id="searchbar-container">
         <div class="searchbar">
            <label for="txtSearchRecipe">
               <i></i>
            </label>
            <input type="text" name="" id="txtSearchRecipe" placeholder="Buscar...">
         </div>
         <div>
            <select name="" id="">
               <option selected disabled>Filtrar</option>
            </select>
         </div>
      </section>
      <section class="filters_applied-container">
         
      </section>
      <article class="content-container">
         <div class="content">
            <figure>
               <img src="../../../assets/images/teste.jpg" alt="">
            </figure>
            <h3 class="content_title">Calma lá paizão</h3>
            <span class="content_category">Ao mosso</span>
            <button class="extra_content-handler"></button>
         </div>
         <div class="content">
            <figure>
               <img src="../../../assets/images/teste.jpg" alt="">
            </figure>
            <h3 class="content_title">Calma lá paizão</h3>
            <span class="content_category">Ao mosso</span>
            <button class="extra_content-handler"></button> 
         </div>
      </article>
   </main>
</body>
</html>