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
   $choosedTypeId= filter_input(INPUT_GET, 'content-type-id', FILTER_SANITIZE_NUMBER_INT);

   require_once("./data/dashboard_data/dashboardHelper.php");
   require_once("../../bd-conn-controller/pages/admin/admin_dashboard-content-controller.php");
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
      <?php
         $content = new ContentController();
         
         $contentType = null;
         if((isset($choosedTypeId)) && ($choosedTypeId != null))
         {
            $contentType = $content->defineContentType($choosedTypeId);
         }
      ?>
      <section class="mobile_header-container">
         <button id="mobile_menu--handler"></button>
         <h1 class="current_data_show-display"><?=$choosedType?></h1>
         <button class="btn_exit"></button>

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
      </section>
      <section class="desktop_menu">
         <button class="btn_exit"></button>
         <h2 class="username-display"><?=$user['username']?></h2>
         <ul>
            <li class="nav_item" data-current="<?=$choosedTypeId==0?'true':'false'?>" data-item-index="1"><a href="?content-type=Receitas&content-type-id=0">Receitas</a></li>
            <li class="nav_item" data-current="<?=$choosedTypeId==1?'true':'false'?>" data-item-index="2"><a href="?content-type=Ingredientes&content-type-id=1">Ingredientes</a></li>
            <li class="nav_item" data-current="<?=$choosedTypeId==2?'true':'false'?>" data-item-index="3"><a href="?content-type=Categorias&content-type-id=2">Categorias</a></li>
            <li class="nav_item" data-current="<?=$choosedTypeId==3?'true':'false'?>" data-item-index="4"><a href="?content-type=Vídeos&content-type-id=3">Vídeos</a></li>
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
         <?php
         if($contentType != null)
         {
            print_r($contentType);
            $typeLabel = strtolower(substr($choosedType, 0, -1));
            foreach($contentType as $data)
            { 
         ?>
            <div class="content" id="<?=$typeLabel.'_'.$data['id']?>">
               <div class="content_title-wrapper">
                  <?php
                     if(($choosedTypeId == 0) || ($choosedTypeId == 3))
                     {
                  ?>
                        <figure>
                           <img src="../../../assets/images/recipes/<?=$choosedTypeId == 3?'video/'.$data['thumb']:$data['thumb']?>" alt="">
                        </figure>
                  <?php
                     }
                  ?>
                  <h3 class="content_title"><?=$data['titulo']?></h3>
               </div>
               <?php
                  if($choosedTypeId == 0)
                  {
               ?>
                  <span class="content_category"><?=$data['categoria']?></span>
               <?php
                  }
               ?>
               <button class="extra_content-handler"></button>
               <div id="<>" popover class="extra_content-wrapper">
                  <a href="">Ver <?=strtolower(substr($choosedType, 0, -1))?></a>
                  <a href="">Editar</a>
               </div>
            </div>
         <?php
            }
         }
         ?>
      </article>
   </main>
</body>
</html>