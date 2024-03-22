<?php
   header("Access-Control-Allow-Origin: *");
   require_once(__DIR__."/../../../../../conf/finishApi.php");
   
   $response = array();
   $response['status'] = "failed";
   
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once("./addContent.php");
      require_once(__DIR__."/../../../../../conf/defineSourcePath.php");

      $rawData = file_get_contents("php://input");
      $data = json_decode($rawData, true);

      $response['data'] = $data;

      if($data != null)
      {
         $category = strtolower($data['category_title']);

         if(!verifyIfExists($conn, "categoria", $category, "descricaoCategoria"))
         {
            if(addContent($conn, "categoria", $category, "descricaoCategoria"))
            {
               $response['status'] = "success";
               $response['data'] = ["id" => $conn->lastInsertId(), "category" => $data['category_title']];
            }
            else
            {
               finishHim($response, "Erro ao cadastrar a categoria no banco de dados");
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