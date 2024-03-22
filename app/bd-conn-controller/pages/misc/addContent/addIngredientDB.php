<?php
   header("Access-Control-Allow-Origin: *");
   require_once(__DIR__."/../../../../../conf/finishApi.php");

   $response = array();
   $response['status'] = "failed";

   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once(__DIR__."/../../../../_conn/conn.php");
      require_once("./addContent.php");

      if(isset($conn))
      {
         $jsonData = file_get_contents("php://input");
         $data = json_decode($jsonData, true);

         if($data != null)
         {
            $ingredient = $data["ingredient_title"];
            if(!verifyIfExists($conn, "ingrediente", strtolower($ingredient), "descricaoIngrediente"))
            {
               if(addContent($conn, "ingrediente", $ingredient, "descricaoIngrediente"))
               {
                  $response['status'] = "success";
               }
            }
            else
            {
               finishHim($response, "Ingrediente já cadastrado!");
            }
         }
      }
   }
   
   echo json_encode($response);