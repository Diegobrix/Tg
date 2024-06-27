<?php

use function PHPSTORM_META\type;

   require_once(__DIR__."/./Recipe.php");

   function getRecentRecipes($limit = 5)
   {
      $r = new Recipe(null, getConn());
      $recipes = $r->getRecentRecipes($limit);

      return $recipes;
   }

   function getRecipe($recipeId)
   {
      $r = new Recipe($recipeId, getConn());
      $recipe = $r->getRecipe();

      return $recipe;
   }

   function fitData($data)
   {
      $data = rtrim($data, '|');
      $finalData = formatAdjustedData(explode('|', $data));

      return $finalData;
   }

   function formatAdjustedData($arr, $current = 0, $data = array())
   {  
      if($current < sizeof($arr))
      {
         $data[$current] = explode('@', $arr[$current]);
         $current += 1;
         return formatAdjustedData($arr, $current, $data);
      }
      return $data;
   }

   function getConn()
   {
      require(__DIR__."/../../../_conn/conn.php");
      return $conn;
   }