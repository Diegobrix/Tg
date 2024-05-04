<?php
   session_start();
   $choosedTypeId= filter_input(INPUT_GET, 'content-type-id', FILTER_SANITIZE_NUMBER_INT);

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
   <script defer src="../../../src/js/pages/admin/admin_dashboard/modalController.js"></script>
   <script defer src="../../../src/js/pages/exitPage.js"></script>
   <script defer src="../../../src/js/pages/admin/admin_dashboard/contentVisibilityController.js"></script>
</head>
<body>
   <?php
      $pageTitle = ['Receitas', 'Ingredientes', 'Categorias', 'Videos'];
      $choosedType = $pageTitle[$choosedTypeId];

      $content = new ContentController();      
      $contentType = null;
      if((isset($choosedTypeId)) && ($choosedTypeId != null))
      {
         $choosedId = $choosedTypeId;
      }
      else
      {
         $choosedId = 0;
      }

      $contentType = $content->defineContentType($choosedId);
   ?>
   <header>
      <section class="mobile_header-container">
         <button id="mobile_menu--handler"></button>
         <h1 class="current_data_show-display"><?=$choosedType?></h1>
         <button class="btn_back"></button>

         <nav class="mobile-menu" aria-expanded="false">
            <button id="btn_close"></button>
            <ul>
               <li class="nav_item" data-current="<?=$choosedTypeId==0?'true':'false'?>" data-item-index="1"><a href="?content-type-id=0">Receitas</a></li>
               <li class="nav_item" data-current="<?=$choosedTypeId==1?'true':'false'?>" data-item-index="2"><a href="?content-type-id=1">Ingredientes</a></li>
               <li class="nav_item" data-current="<?=$choosedTypeId==2?'true':'false'?>" data-item-index="3"><a href="?content-type-id=2">Categorias</a></li>
               <li class="nav_item" data-current="<?=$choosedTypeId==3?'true':'false'?>" data-item-index="4"><a href="?content-type-id=3">Vídeos</a></li>
            </ul>
         </nav>
         <div class="bg"></div>
      </section>
      <section class="desktop_menu">
         <div class="header_head-wrapper">
            <button class="btn_back"></button>
            <h2 class="username-display"><?=$user['username']?></h2>
         </div>
         <ul>
            <li class="nav_item" data-current="<?=$choosedTypeId==0?'true':'false'?>" data-item-index="1"><a href="?content-type-id=0">Receitas</a></li>
            <li class="nav_item" data-current="<?=$choosedTypeId==1?'true':'false'?>" data-item-index="2"><a href="?content-type-id=1">Ingredientes</a></li>
            <li class="nav_item" data-current="<?=$choosedTypeId==2?'true':'false'?>" data-item-index="3"><a href="?content-type-id=2">Categorias</a></li>
            <li class="nav_item" data-current="<?=$choosedTypeId==3?'true':'false'?>" data-item-index="4"><a href="?content-type-id=3">Vídeos</a></li>
         </ul>
         <div class="stats-container">
            <div class="bar">
               <?php
                  $recipesAmount = sizeof($content->defineContentType(0));
                  $ingredientsAmount = sizeof($content->defineContentType(1));
                  $categoriesAmount = sizeof($content->defineContentType(2));
                  $videosAmount = sizeof($content->defineContentType(3));

                  $amounts = [$recipesAmount, $ingredientsAmount, $categoriesAmount, $videosAmount];

                  $bigger = $recipesAmount;
                  for($i = 0; $i < 4; $i++)
                  {
                     if($amounts[$i] > $bigger)
                     {
                        $bigger = $amounts[$i];
                     }
                  }
               ?>
               <div aria-amount="<?=$recipesAmount?>" style="--stat_amount: <?=number_format((float)$recipesAmount/$bigger, 2, '.');?>;" class="stat stat_recipes"></div>
               <div aria-amount="<?=$ingredientsAmount?>" style="--stat_amount: <?=number_format((float)$ingredientsAmount/$bigger, 2, '.');?>;" class="stat stat_ingredients"></div>
               <div aria-amount="<?=$categoriesAmount?>" style="--stat_amount: <?=number_format((float)$categoriesAmount/$bigger, 2, '.');?>;" class="stat stat_categories"></div>
               <div aria-amount="<?=$videosAmount?>" style="--stat_amount: <?=number_format((float)$videosAmount/$bigger, 2, '.');?>;" class="stat stat_videos"></div>
            </div>
            <div class="stats_legend-container">
               <div class="stat_legend-wrapper">
                  <i class="stat-thumb stat_recipes-thumb"></i>
                  <span>Receitas</span>
               </div>
               <div class="stat_legend-wrapper">
                  <i class="stat-thumb stat_ingredients-thumb"></i>
                  <span>Ingredientes</span>
               </div>
               <div class="stat_legend-wrapper">
                  <i class="stat-thumb stat_categories-thumb"></i>
                  <span>Categorias</span>
               </div>
               <div class="stat_legend-wrapper">
                  <i class="stat-thumb stat_videos-thumb"></i>
                  <span>Vídeos</span>
               </div>
            </div>
         </div>
      </section>
   </header>
   <main>
      <section id="searchbar-container">
         <div class="searchbar">
            <label for="txtSearchRecipe">
               <i></i>
            </label>
            <input type="text" id="txtSearchRecipe" placeholder="Buscar <?=strtolower($choosedType)?>...">
         </div>
         <div>
            <select id="">
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
            //require_once("./data/dashboard_data/dashboard_");
            $typeLabel = strtolower(substr($choosedType, 0, -1));
            foreach($contentType as $data)
            { 
         ?>
            <div class="content" id="<?=$typeLabel.'_'.$data['id']?>" aria-hidden="false">
               <div class="content_title-wrapper">
                  <?php
                     if(($choosedTypeId == 0) || ($choosedTypeId == 3))
                     {
                  ?>    <figure>
                  <?php
                        if($choosedTypeId == 3)
                        {
                           $video = explode('/', $data['url']);
                           $videoUrl = implode('/video/', $video);
                  ?>
                           <video>
                              <source src="../../../assets/images/recipes/<?=htmlspecialchars($videoUrl)?>" type="video/mp4">
                              Seu navegador não suporta o elemento de vídeo.
                           </video>
                  <?php
                        }
                        else
                        {
                           $thumb = $data['thumb'];
                  ?>
                           <img src="../../../assets/images/recipes/<?=htmlspecialchars($thumb)?>" alt="">
                  <?php
                        }
                  ?>
                        </figure>
                  <?php
                     }
                  ?>
                  <h3 class="content_title"><?=$data['title']?></h3>
               </div>
               <?php
                  if($choosedTypeId == 0)
                  {
               ?>
                  <span class="content_category"><?=$data['categoria']?></span>
               <?php
                  }
                  if($choosedTypeId == 3)
                  {
               ?>
                     <dialog id="video-modal">
                        <h2 class="video_title"><?=$data['title']?></h2>
                        <div class="decoration-container">
                           <i class="decoration"></i>
                        </div>
                        <video controls>
                           <source src="../../../assets/images/recipes/<?=htmlspecialchars($videoUrl)?>" type="video/mp4">
                        </video>
                     </dialog>
               <?php
                  }
                  else
                  {
               ?>
                     <button id="<?=$data['id'].'-extra_content-handler'?>" class="extra_content-handler" popovertarget="<?=$data['id'].'-extra_content'?>"></button>
               <?php
                  }
               ?>
               <div id="<?=$data['id'].'-extra_content'?>" anchor="<?=$data['id'].'-extra_content-handler'?>" popover class="extra_content-wrapper">
                  <?php
                     if($choosedTypeId == 0)
                     {
                  ?>
                        <a href="../user/recipe.php?id=<?=$data['id']?>">Ver <?=strtolower(substr($choosedType, 0, -1))?></a>
                  <?php
                     }
                  ?>   
                  <a href="">Editar</a>
               </div>
            </div>
         <?php
            }
         }
         else
         {
         ?>
            <span class="empty_msg">Desculpe<br>Não há registros no momento!</span>
         <?php
         }
         ?>
      </article>
   </main>
</body>
</html>