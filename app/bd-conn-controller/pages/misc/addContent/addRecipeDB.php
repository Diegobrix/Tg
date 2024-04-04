<?php
   require_once(__DIR__."/../../../../../conf/defineSourcePath.php");

   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      $recipeTitle = filter_input(INPUT_POST, "recipe_title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeDescription = filter_input(INPUT_POST, "recipe_description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeBenefits = filter_input(INPUT_POST, "recipe_benefits", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeWayToDo = filter_input(INPUT_POST, "recipe_wayToDo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $recipeCategory = filter_input(INPUT_POST, "category", FILTER_SANITIZE_NUMBER_INT);
      $recipeAuthor = filter_input(INPUT_POST, "author_id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      require_once(__DIR__."/addRecipeImage.php");

      $photo = "no_image.php";
      if(isset($_FILES['recipe_thumb']))
      {
         $photo = saveImage($_FILES['recipe_thumb']);
      }

      $stmtRecipe = $conn -> prepare("INSERT INTO `receita`(`tituloReceita`, `beneficiosReceita`, `modoDePreparoReceita`, `fotoReceita`, `categoriaReceita`, `autor`) VALUES(:tit, :benefits, :way, :photo, :category, :author);");
      $stmtRecipe -> execute(array(
         ":tit" => $recipeTitle,
         ":benefits" => $recipeBenefits,
         ":way" => $recipeWayToDo,
         ":photo" => $photo[0],
         ":category" => $recipeCategory,
         ":author" => $recipeAuthor
      ));

      if($stmtRecipe -> rowCount() > 0)
      {
         $id = $conn -> lastInsertId();

         if(isset($_FILES['recipe_video']))
         {
            $videoTitle = filter_input(INPUT_POST, "video_title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $videoDescription = filter_input(INPUT_POST, "video_description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $video = saveImage($_FILES['recipe_video'], "video"); 
            $stmtVideo = $conn -> prepare("INSERT INTO `video`(`titVideo`, `descricaoVideo`, `urlVideo`) VALUES(:videoTitle, :videoDescription, :videoUrl);");
            $stmtVideo -> execute(array(
               ":videoTitle" => $videoTitle,
               ":videoDescription" => $videoDescription,
               ":videoUrl" => $video[1]
            ));

            if($stmtVideo -> rowCount() > 0)
            {
               $stmtVideoRecipe = $conn -> prepare("INSERT INTO `videoreceita` VALUES (:idReceita, :idVideo);");
               $stmtVideoRecipe -> execute(array(
                  ":idReceita" => $id,
                  ":idVideo" => $conn->lastInsertId
               ));

               if($stmtVideoRecipe -> rowCount() <= 0)
               {
                  die("Erro ao Cadastrar o Vídeo");
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