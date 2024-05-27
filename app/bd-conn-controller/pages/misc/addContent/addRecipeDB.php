<?php
   require_once(__DIR__."/../../../../../conf/defineSourcePath.php");

   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      $recipeTitle = filter_input(INPUT_POST, "recipe_title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeDescription = filter_input(INPUT_POST, "recipe_description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeBenefits = filter_input(INPUT_POST, "recipe_benefits", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeCategory = filter_input(INPUT_POST, "category", FILTER_SANITIZE_NUMBER_INT);
      $recipeAuthor = filter_input(INPUT_POST, "recipe_author", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeSource = filter_input(INPUT_POST, "recipe_source", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeEditor = filter_input(INPUT_POST, "recipe_editor", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $waysToDo = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS)["waytodo"];
      $recipeWayToDo = "";
      if($waysToDo != null)
      {
         $recipeWayToDo = implode('', $waysToDo);
      }

      require_once(__DIR__."/MediaSaver.php");
      // $mSaver = new MediaSaver($recipeTitle);
      $mSaver = new MediaSaver('Teste');

      if((isset($_FILES['recipe_thumb'])) && ($_FILES['recipe_thumb']['name'] != ""))
      {
         $photo = $mSaver->saveMedia($_FILES['recipe_thumb']);
      }
      else {
         $photo = $mSaver->saveMedia("no_image.png");
      }

      $recipeDate = date('Y-m-d');

      $stmtRecipe = $conn -> prepare("INSERT INTO `receita`(`tituloReceita`, `descricaoReceita`, `beneficiosReceita`, `modoDePreparoReceita`, `fotoReceita`, `categoriaReceita`, `editor`, `autor`, `fonte`, `dataReceita`) VALUES(:tit, :recipeDesc, :benefits, :way, :photo, :category, :editor, :author, :source, :recipeDate);");
      $stmtRecipe -> execute(array(
         ":tit" => $recipeTitle,
         ":recipeDesc" => $recipeDescription,
         ":benefits" => $recipeBenefits,
         ":way" => $recipeWayToDo,
         ":photo" => $photo,
         ":category" => $recipeCategory,
         ":editor" => $recipeEditor,
         ":author" => $recipeAuthor,
         ":source" => $recipeSource,
         ":recipeDate" => $recipeDate
      ));
   
      if($stmtRecipe -> rowCount() > 0)
      {
         $id = $conn -> lastInsertId();
         if(isset($_FILES['recipe_video']))
         {
            $videoTitle = filter_input(INPUT_POST, "video_title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $videoDescription = filter_input(INPUT_POST, "video_description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $video = null;
            if((isset($_FILES['recipe_video'])) && ($_FILES['recipe_video']['name'] != ""))
            {
               $video = $mSaver->saveMedia($_FILES['recipe_video'], "video");
            }
            
            if($video != null)
            {
               $stmtVideo = $conn -> prepare("INSERT INTO `video`(`titVideo`, `descricaoVideo`, `urlVideo`) VALUES(:videoTitle, :videoDescription, :videoUrl);");
               $stmtVideo -> execute(array(
                  ":videoTitle" => $videoTitle,
                  ":videoDescription" => $videoDescription,
                  ":videoUrl" => $video
               ));

               if($stmtVideo -> rowCount() > 0)
               {
                  $videoId = $conn->lastInsertId();
                  $stmtVideoRecipe = $conn -> prepare("INSERT INTO `videoreceita` VALUES (:idReceita, :idVideo);");
                  $stmtVideoRecipe -> execute(array(
                     ":idReceita" => $id,
                     ":idVideo" => $videoId
                  ));

                  if($stmtVideoRecipe -> rowCount() <= 0)
                  {
                     die("Erro ao Cadastrar o Vídeo");
                  }
               }
            }
         }
         
         $ingredients = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS)["ingredient"];
         $recipeIngredients = array();
         if($ingredients != null)
         {
            foreach($ingredients as $ingredient)
            {
               $tmpIngredient = explode("/", $ingredient);
               $recipeIngredients[] = "(".$id.", ".$tmpIngredient[0].", ".$tmpIngredient[2].", ".$tmpIngredient[3].")";
            }
            
            $stmtIngredientRecipe = $conn -> prepare("INSERT INTO `ingredienteReceita` VALUES ".implode(", ", $recipeIngredients));
            $stmtIngredientRecipe -> execute();
   
            if($stmtIngredientRecipe -> rowCount() > 0)
            {
               header("location: ../../../../pages/admin/admin_homePage.php");
            }
         }  
      }
   }