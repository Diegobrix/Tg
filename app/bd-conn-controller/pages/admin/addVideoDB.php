<?php
   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      require_once(__DIR__.'/../../../../conf/defineSourcePath.php');
      require_once(__DIR__.'/../misc/addContent/MediaSaver.php');

      $videoTitle = filter_input(INPUT_POST, 'video_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $videoDescription = filter_input(INPUT_POST, 'video_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeChoosed = filter_input(INPUT_POST, 'recipe_choosed_id', FILTER_SANITIZE_SPECIAL_CHARS);  
      $recipeTitle = filter_input(INPUT_POST, 'recipe_choosed_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $video = null;
      if((isset($_FILES['recipe_video'])) && ($_FILES['recipe_video']['name'] != ""))
      {
         $title = null;
         $type = 'video_noRecipe';
         if($recipeTitle != null)
         {
            $title = $recipeTitle;
            $type = 'video';
         }

         $mSaver = new MediaSaver($title);
         $video = $mSaver->saveMedia($_FILES['recipe_video'], $type);
      }

      if($video != null)
      {
         $stmt = $conn->prepare('INSERT INTO `video`(`titVideo`, `descricaoVideo`, `urlVideo`) VALUES(:videoTitle, :videoDescription, :videoUrl);');
         $stmt->execute(array(
            ':videoTitle' => $videoTitle,
            ':videoDescription' => $videoDescription,
            ':videoUrl' => $video
         ));

         if($stmt->rowCount() > 0)
         {
            if($recipeChoosed != null)
            {
               $idVideo = $conn->lastInsertId();
               $stmtVideoReceita = $conn->prepare('INSERT INTO `videoreceita` VALUES(:recipeId, :videoId);');
               $stmtVideoReceita->execute(array(
                  ':recipeId' => $recipeChoosed,
                  ':videoId' => $idVideo
               ));
   
               if($stmtVideoReceita->rowCount() > 0)
               {
                  header("location: ../../../pages/admin/admin_homePage.php?status=0");
               }
               else
               {
                  header("location: ../../../pages/admin/admin_homePage.php?status=1");
               }
            }

            header("location: ../../../pages/admin/admin_homePage.php?status=0");
         }
         else
         {
            header("location: ../../../pages/admin/admin_homePage.php?status=1");
         }
      }
   }