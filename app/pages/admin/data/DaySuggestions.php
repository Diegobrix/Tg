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
         $suggestions = $this->convertSuggestionId($this->randomizeSuggestion($this->recipes, $this->randomized), $this->recipes);
         return $suggestions;
      }

      private function randomizeSuggestion($recipes, $randomized, $loopIndex = 0, $attempt = 0)
      {
         $maxAttempts = 50;
         if ($attempt >= $maxAttempts)
         {
            return $randomized;
         }
        
         $random = random_int(1, count($recipes));
         if(in_array($random, $randomized))
         {
            return $this->randomizeSuggestion($recipes, $randomized, $loopIndex, $attempt + 1);
         }
         else
         {
            if($loopIndex < 6)
            {
               array_push($randomized, $random);
               $loopIndex += 1;

               return $this->randomizeSuggestion($recipes, $randomized, $loopIndex, $attempt);
            }
         }

         return $randomized;
      }

      private function convertSuggestionId($suggestions, $recipes)
      {
         $suggestion = array();
         $i = 0;
         foreach($suggestions as $s)
         {
            $suggestion[$i] = array(
               $recipes[$s - 1]['idReceita'],
               $recipes[$s - 1]['title'], 
               $recipes[$s - 1]['recipeThumb']
            );
            $i+= 1;
         }

         return $suggestion;
      }
   }