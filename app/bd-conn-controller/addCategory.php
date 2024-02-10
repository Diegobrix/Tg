<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once("../_conn/conn.php");

      if (isset($conn)) {
         $category = filter_input(INPUT_GET, "category", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

         $stmt = $conn->prepare("SELECT * FROM `categoria` WHERE descricaoCategoria = :category;");
         $stmt->bindParam(":category", $category);
         $stmt->execute();

         if ($stmt->rowCount() == 0) {
            CreateCategory($conn, $category);
         } else {
            //Já Exeste;
         }
      }

      function CreateCategory($conn, $category)
      {
         $stmt = $conn->prepare("INSERT INTO `categoria`(descricaoCategoria) VALUES(:category);");
         $stmt->bindParam(":category", $category);
         $stmt->execute();
      }
   }

   __halt_compiler();