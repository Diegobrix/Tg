<?php
   require_once(__DIR__."/./Recipe.php");

   function getRecipe($recipeId)
   {
      $r = new Recipe($recipeId, getConn());
      $recipe = $r->getRecipe();

      //Voltar despois
      if($recipe != null)
      {
         $r->addToTemp($recipe);
         return $recipe;
      }

      
   }

   function getConn()
   {
      require_once(__DIR__."/../../../_conn/conn.php");
      return $conn;
   }