<?php
   class DaySuggestions
   {
      private $recipes;

      function __construct($recipes)
      {
         $this->recipes = $recipes;
      }

      private $randomized = array();
      public function getSuggestions()
      {
         $randomizedRecipes = $this->randomizeSuggestion($this->recipes, $this->randomized);
         return $randomizedRecipes;
      }

      private function randomizeSuggestion($recipes, $randomized, $loopIndex = 0)
      {
         if($loopIndex < 6)
         {
            $recipe = random_int(1, $recipes[count($recipes) - 1]['idReceita']);
            
            if($loopIndex < 6)
            {
               if(in_array($recipe, $randomized))
               {
                  return $this->randomizeSuggestion($recipes, $randomized, $loopIndex);
               }

               array_push($randomized, $recipe);

               $loopIndex++;
               return $this->randomizeSuggestion($recipes, $randomized, $loopIndex);
            }
         }

         return $randomized;
      }
   }