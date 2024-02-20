<?php
   require_once("../../../conf/defineSourcePath.php");

   $stmt = $conn->prepare("SELECT COUNT(DISTINCT idReceita) AS recipes_amount, (SELECT categoriaReceita FROM receita GROUP BY categoriaReceita ORDER BY COUNT(idReceita) DESC LIMIT 1) AS most_popular_category, (SELECT idReceita FROM receita ORDER BY idReceita DESC LIMIT 1) AS last_recipe FROM receita;");
   $stmt->execute();

   if($stmt->rowCount() > 0)
   {
      $data = $stmt -> fetch(PDO::FETCH_ASSOC);

      require_once(__DIR__."/../../temp_data/TemporaryData.php");
      $temp = new TemporaryData("content_data");
      $content = array();
      
      $content[0] = $data;
      $stmtCategories = $conn->prepare("SELECT categoriaReceita, COUNT(idReceita) AS amount FROM receita GROUP BY categoriaReceita;");
      $stmtCategories->execute();

      $i = 0;
      if($stmtCategories->rowCount() > 0)
      {
         $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

         foreach($categories as $cat)
         {
            $content[1][$i] = $cat;
            $i += 1;
         }
      }

      $temp->generateTempData(json_encode($content));
   }