<?php
   require_once(__DIR__."/../../../../../conf/defineSourcePath.php");
   require_once(__DIR__."/./DashboardData.php");

   //region Recipes
   $stmtRecipes = $conn -> prepare("SELECT idReceita as id, tituloReceita as titulo, fotoReceita as thumb, (SELECT descricaoCategoria FROM categoria WHERE idCategoria = categoriaReceita) AS categoria, autor FROM `receita` LIMIT 100;");
   $stmtRecipes -> execute();

   $recipes = new DashboardData("recipes.json");
   if($recipes->generateDataset(json_encode($stmtRecipes->fetchAll(PDO::FETCH_ASSOC))))
   {
      $recipes = null;
   }
   //endregion
   
   //region Categories
   $stmtCategories = $conn -> prepare("SELECT idCategoria as id, descricaoCategoria as titulo FROM `categoria` LIMIT 100;");
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

   //region Videos
   $stmtVideos = $conn -> prepare("SELECT idVideo as id, titVideo as titulo, descricaoVideo as descricao, urlVideo as thumb FROM `video` LIMIT 100;");
   $stmtVideos -> execute();

   $videos = new DashboardData("videos.json");
   if($videos->generateDataset(json_encode($stmtVideos->fetchAll(PDO::FETCH_ASSOC))))
   {
      $videos = null;
   }
   //endregion

   //region Ingredients
   $stmtIngredients = $conn -> prepare("SELECT idIngrediente as id, descricaoIngrediente as titulo FROM `ingrediente` LIMIT 100;");
   $stmtIngredients -> execute();

   $ingredients = new DashboardData("ingredients.json");
   if($ingredients->generateDataset(json_encode($stmtIngredients->fetchAll(PDO::FETCH_ASSOC))))
   {
      $ingredients = null;
   }

   //endregion