<?php
   require_once(__DIR__."/../../../../../conf/defineSourcePath.php");
   require_once(__DIR__."/./DashboardData.php");

   //region Recipes
   $stmtRecipes = $conn -> prepare("SELECT idReceita, tituloReceita, fotoReceita, (SELECT descricaoCategoria FROM categoria WHERE idCategoria = categoriaReceita) AS categoria, autor FROM `receita` LIMIT 100;");
   $stmtRecipes -> execute();

   $recipes = new DashboardData("recipes.json");
   if($recipes->generateDataset(json_encode($stmtRecipes->fetchAll(PDO::FETCH_ASSOC))))
   {
      $recipes = null;
   }
   //endregion
   
   //region Categories
   $stmtCategories = $conn -> prepare("SELECT * FROM `categoria` LIMIT 100;");
   $stmtCategories -> execute();

   if($stmtCategories -> rowCount() > 0)
   {
      $categories = new DashboardData("categories.json");
      if($categories->generateDataset(json_encode($stmtCategories->fetchAll(PDO::FETCH_ASSOC))))
      {
         $categories = null;
      }
   }
   //endregion

   $stmtVideos = $conn -> prepare("SELECT * FROM `video` LIMIT 100;");
   $stmtVideos -> execute();

   $videos = new DashboardData("videos.json");
   if($videos->generateDataset(json_encode($stmtVideos->fetchAll(PDO::FETCH_ASSOC))))
   {
      $videos = null;
   }