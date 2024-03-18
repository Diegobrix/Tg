<?php
   require_once(__DIR__."/../../../../conf/defineSourcePath.php");
  

   function getCategories($conn)
   {
      $stmtCategories = $conn -> prepare("SELECT idCategoria AS 'id', descricaoCategoria AS 'category' FROM `categoria`;");
      $stmtCategories -> execute();

      if($stmtCategories -> rowCount() > 0)
      {
         $categories = $stmtCategories -> fetchAll(PDO::FETCH_ASSOC);
      }

      return $categories;
   }
   
   function getUnits($conn)
   {
      $stmtUnits = $conn -> prepare("SELECT idMedida AS 'id', descricaoMedida AS 'unit' FROM `medida`;");
      $stmtUnits -> execute();

      if($stmtUnits -> rowCount() > 0)
      {
         $units = $stmtUnits -> fetchAll(PDO::FETCH_ASSOC);
      }

      return $units;
   }