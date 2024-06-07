<?php
   require_once(__DIR__."/./Recipe.php");

   function getRecentRecipes()
   {
      $r = new Recipe(null, getConn());
      $recipes = $r->getRecentRecipes();

      return $recipes;
   }

   function getRecipe($recipeId)
   {
      $r = new Recipe($recipeId, getConn());
      $recipe = $r->getRecipe();
      //Voltar despois

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
      require_once(__DIR__."/../../../_conn/conn.php");
      return $conn;
   }