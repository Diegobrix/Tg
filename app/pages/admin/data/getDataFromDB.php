<?php
   require_once("../../../conf/defineSourcePath.php");
   $contentData = json_decode(file_get_contents(__DIR__."/../../../bd-conn-controller/temp_data/data/content_data.json"), true);

   //region PopularCategory
   $stmtPopularCategory = $conn->prepare("SELECT c.descricaoCategoria AS category_desc, (SELECT COUNT(r.idReceita) FROM `receita` AS `r` WHERE r.categoriaReceita = c.idCategoria) AS most_pop_category_amount FROM `categoria` AS `c` WHERE idCategoria = :most_popular_category;");
   $stmtPopularCategory->bindParam(":most_popular_category", $contentData[0]['most_popular_category']);
   $stmtPopularCategory->execute();

   if($stmtPopularCategory->rowCount() > 0)
   {
      $mostPopularCategory = $stmtPopularCategory->fetch(PDO::FETCH_ASSOC);

      $popularCategory = $mostPopularCategory['category_desc'];
      $popularCategoryAmount = $mostPopularCategory['most_pop_category_amount'];
   }
   //endregion

   //region LastRecipe
   $stmtLastRecipe = $conn->prepare("SELECT tituloReceita AS last_recipe_title, fotoReceita AS last_recipe_thumb FROM `receita` WHERE idReceita = :last_recipe;");
   $stmtLastRecipe->bindParam(":last_recipe", $contentData[0]['last_recipe']);
   $stmtLastRecipe->execute();

   if($stmtLastRecipe->rowCount() > 0)
   {
      $lastRecipe = $stmtLastRecipe->fetch(PDO::FETCH_ASSOC);

      $lastRecipeTitle = $lastRecipe['last_recipe_title'];
      $lastRecipeThumb = $lastRecipe['last_recipe_thumb'];
   }
   //endregion
   
   //region Video and Category
   $stmtWidgetsDisplay = $conn->prepare("SELECT (SELECT COUNT(idCategoria) FROM `categoria`) AS categories_amount ,(SELECT COUNT(idVideo) FROM `video`) AS videos_amount;");
   $stmtWidgetsDisplay->execute();

   if($stmtWidgetsDisplay->rowCount() > 0)
   {
      $widgets = $stmtWidgetsDisplay->fetch(PDO::FETCH_ASSOC);

      $categoriesAmount = $widgets['categories_amount'];
      $videosAmount = $widgets['videos_amount'];
   }
   //endregion

   //region Top Categories
   $categoriesId = array();
   for($i = 0; $i < count($contentData[1]); $i++)
   {
      array_push($categoriesId, $contentData[1][$i]['category']);
   }
   
   $categoriesImploded = implode(',', $categoriesId);

   $stmtTopCategories = $conn->prepare("SELECT descricaoCategoria FROM `categoria` WHERE idCategoria IN ($categoriesImploded);");
   $stmtTopCategories->execute();

   if($stmtTopCategories->rowCount() > 0)
   {
      $categories = $stmtTopCategories->fetchAll(PDO::FETCH_ASSOC);
   }
   //endregion

   //region Recipes
   function getRecipes($conn)
   {
      $stmtRecipes = $conn->prepare("SELECT idReceita, tituloReceita AS title, fotoReceita AS recipeThumb, categoriaReceita, autor FROM `receita` LIMIT 100;");
      $stmtRecipes->execute();

      if($stmtRecipes->rowCount() > 0)
      {
         $recipes = $stmtRecipes->fetchAll(PDO::FETCH_ASSOC);
         return $recipes;
      }
   }
   //endregion