<?php
   class RecipeSuggestion
   {
      function __construct()
      {
      }

      public function getRandomizedRecipes()
      {
         $recipes = json_decode(file_get_contents(__DIR__."/./datasets/recipes.json"), true);
         return $this->randomizeRecipes($recipes, 6);
      }

      private function randomizeRecipes($recipes, $amount, $current = 0, $indexes = array(), $randomized = array())
      {
         if($current < $amount)
         { 
            $random = rand(0, sizeof($recipes) - 1);

            if(!in_array($random, $indexes))
            {
               array_push($indexes, $random);
               array_push($randomized, $recipes[$random]);
               $current += 1;
            }

            return $this->randomizeRecipes($recipes, $amount, $current, $indexes, $randomized);
         }

         return $randomized;
      }
   }