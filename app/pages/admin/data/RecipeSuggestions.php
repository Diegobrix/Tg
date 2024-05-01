<?php
   class RecipeSuggestion
   {
      function __construct()
      {
      }

      public function getDaySuggestions($file)
      {
      }

      private function getRecipes()
      {
         
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