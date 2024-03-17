<?php
   header("Access-Control-Allow-Origin: *");
   require_once(__DIR__."/../../../../../conf/defineSourcePath.php");
   require_once(__DIR__."/../../../../../conf/finishApi.php");

   $response = array();
   $stmt = $conn -> prepare("SELECT idIngrediente AS 'id', descricaoIngrediente AS 'ingredient' FROM `ingrediente`;");
   $stmt -> execute();

   if($stmt -> rowCount() > 0)
   {    
      $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

      foreach($result as $res)
      {
         $response['ingredient'] = $res;
      }
   }

   echo json_encode($response);