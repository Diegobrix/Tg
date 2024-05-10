<?php
   require_once(__DIR__.'/SearchRecipe.php');

   function getSearchedRecipes($searchTerm)
   { 
      $filePath = __DIR__.'/../../../pages/admin/data/datasets/recipes.json';
      if(json_validate(file_get_contents($filePath)))
      {
         $search = new SearchRecipe($filePath);
         $result = $search->getRecipes('Macarrão');

         return $result;
      }
      return null;
   }

   function json_validate($json)
   {
      json_decode($json);

      return json_last_error() === JSON_ERROR_NONE;
   }