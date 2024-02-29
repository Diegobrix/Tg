<?php
   require_once(__DIR__."/../../../../../conf/defineSourcePath.php");
   require_once(__DIR__."/./DashboardData.php");

   $stmtRecipes = $conn -> prepare("SELECT * FROM `receita` LIMIT 100;");
   $stmtRecipes -> execute();

   if($stmtRecipes -> rowCount() > 0)
   {
      $recipes = new DashboardData("recipes.json");
      $recipes->generateDataset(json_encode($stmtRecipes->fetchAll(PDO::FETCH_ASSOC)));
   }