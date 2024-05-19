<?php
   require_once(__DIR__.'/../../../../../conf/defineSourcePath.php');

   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
      $title = filter_input(INPUT_POST, 'recipe-title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $description = filter_input(INPUT_POST, 'recipe-description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $originalContent = filter_input(INPUT_POST, 'originalImg', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $originalLocalData = explode('/', $originalContent);
      $originalTitleWithCrypto = explode('@', $originalLocalData[0]);
      
      $originalTitle = $originalTitleWithCrypto[1];

      require_once(__DIR__.'/./MediaSaver.php');
      $mSaver = new MediaSaver($title);
      $newTitle = $mSaver->getNewDirName();

      $recipesBasePath = __DIR__.'/../../../../../assets/images/recipes/';
      $changeImg = false;

      $tit = $originalLocalData[0];

      if($originalTitle != $title)
      {
         echo 'deferentes';
         if(file_exists($recipesBasePath.$title))
         {
            rename($recipesBasePath.$title, $recipesBasePath.$newTitle);
            $tit = $newTitle;
            $changeImg = true;
         }
      }

      $photo = $recipesBasePath.$tit.'/'.$originalLocalData[1];
      if((isset($_FILES['recipe_thumb'])) && ($_FILES['recipe_thumb']['name'] != ""))
      {
         if(file_exists($recipesBasePath.$tit.'/'.$originalLocalData[1]))
         {
            unlink($recipesBasePath.$tit.'/'.$originalLocalData[1]);
         }

         $photo = $mSaver->saveMedia($_FILES['recipe_thumb'], "image", $tit);
         $changeImg = true;
      }

      $query = 'UPDATE `receita` SET tituloReceita = :tit, descricaoReceita = :descript WHERE idReceita = :id;';
      $data = array(
         ':tit' => $title,
         ':descript' => $description,
         ':id' => $id
      );
      if($changeImg)
      {
         $query = 'UPDATE `receita` SET tituloReceita = :tit, descricaoReceita = :descript, fotoReceita = :img WHERE idReceita = :id;';
         $data = array(
            ':tit' => $title,
            ':descript' => $description,
            ':img' => $photo,
            ':id' => $id
         );
      }

      $stmt = $conn->prepare($query);
      $stmt->execute($data);

      if($stmt->rowCount() > 0)
      {
         echo 'Sucersso';
      }
      else
      {
         echo 'Error';
      }
   }