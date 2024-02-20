<?php
   require_once("../../../conf/defineSourcePath.php");

   $stmt = $conn->prepare("SELECT DISTINCT COUNT(idReceita) AS 'recipes_amount' FROM receita");
   $stmt->execute();

   if($stmt->rowCount() > 0)
   {
      $data = $stmt -> fetch(PDO::FETCH_ASSOC);

      require_once(__DIR__."/../../temp_data/TemporaryData.php");
      $temp = new TemporaryData("content_data");

      $temp->generateTempData(json_encode($data));
   }