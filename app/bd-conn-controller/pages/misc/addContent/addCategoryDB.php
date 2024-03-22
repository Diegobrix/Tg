<?php
   header("Access-Control-Allow-Origin: *");
   require_once(__DIR__."/../../../../../conf/finishApi.php");
   
   $response = array();
   $response['status'] = "failed";
   
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once("./verifyContent/verifyContentExists.php");
      require_once(__DIR__."/../../../../../conf/defineSourcePath.php");

      $rawData = file_get_contents("php://input");
      $data = json_decode($rawData, true);

      if($data != null)
      {
         if(!verifyIfExists($conn, "categoria", $data['category_title'], "descricaoCategoria"))
         {
            $stmt = $conn -> prepare("INSERT INTO `categoria`(descricaoCategoria) VALUES(:content);");
            $stmt -> bindParam(":content", $data['category_title']);
            $stmt -> execute();

            if($stmt -> rowCount() > 0)
            {
               //Cadastrou com sucesso
               $response['status'] = "success";
            }
            else
            {
               //Erro ao cadastrar
            }
         }
         else
         {
            finishHim($response, "A categoria informada já cadastrada no sistema!");
         }
      }

      echo json_encode($response);
   }
   else
   {
      finishHim($response, "Método Incorreto");
   }