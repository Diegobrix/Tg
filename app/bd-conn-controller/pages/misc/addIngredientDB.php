<?php
   header("Access-Control-Allow-Origin: *");
   $response = array();
   $response['status'] = "failed";

   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once(__DIR__."/../../../_conn/conn.php");

      if(isset($conn))
      {
         $jsonData = file_get_contents("php://input");
         $data = json_decode($jsonData, true);
         
         //region functions
         function verifyIngredient($conn, $ingredient)
         {
            $stmt = $conn -> prepare("SELECT * FROM `ingrediente` WHERE descricaoIngrediente = :ingredient;");
            $stmt -> bindParam(":ingredient", $ingredient);
            $stmt -> execute();

            if($stmt -> rowCount() > 0)
            {
               return false;
            }

            return true;
         }

         function registerIngredient($conn, $ingredient)
         {
            $stmt = $conn -> prepare("INSERT INTO `ingrediente`(descricaoIngrediente) VALUES(:ingredient);");
            $stmt -> bindParam(":ingredient", $ingredient);
            $stmt -> execute();

            if($stmt -> rowCount() > 0)
            {
               return true;
            }

            return false;
         }
         //endregion

         if($data != null)
         {
            $ingredient = $data["ingredient_title"];
            if(verifyIngredient($conn, strtolower($ingredient)))
            {
               if(registerIngredient($conn, $data['ingredient_title']))
               {
                  $response['status'] = "success";
               }
            }
            else
            {
               $response['error'] = "Ingrediente já cadastrado!";
            }
         }
      }
   }
   
   echo json_encode($response);