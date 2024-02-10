<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once("../_conn/conn.php");

      if(isset($conn))
      {
         $ingredient = filter_input(INPUT_POST, "ingredient", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

         $stmt = $conn -> prepare("SELECT * FROM `ingrediente` WHERE descricaoIngrediente = :ingredient");
         $stmt -> bindParam(":ingredient", $ingredient);
         $stmt -> execute();

         if($stmt -> rowCount() == 0)
         {
            CreateIngredient($conn, $ingredient);
            
         }
         else
         {
            //Exeste;
         }

         function CreateIngredient($conn, $ingredient)
         {
            $insertStmt = $conn -> prepare("INSERT INTO `ingrediente`(descricaoIngrediente) value(:ingredient)");
            $insertStmt -> bindParam(":ingredient", $ingredient);
            $insertStmt -> execute();
         }
      }      
   }

   __halt_compiler();