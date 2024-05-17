<?php
   require_once(__DIR__.'/../../../../../conf/defineSourcePath.php');

   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
      $title = filter_input(INPUT_POST, 'recipe-title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $description = filter_input(INPUT_POST, 'recipe-description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $stmt = $conn->prepare("UPDATE `receita` SET tituloReceita = :tit, descricaoReceita = :descr WHERE idReceita = :id;");
      $stmt->execute(array(
         ":tit" => $title,
         ":descr" => $description,
         ":id" => $id
      ));

      if($stmt->rowCount() > 0)
      {
         echo "sucesso!";
      }
      else
      {
         echo "Error";
      }
   }