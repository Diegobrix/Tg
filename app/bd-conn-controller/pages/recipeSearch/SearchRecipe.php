<?php
   class SearchRecipe
   {
      private $jsonData;
      public function __construct($recipesFile)
      {
         $this->jsonData = json_decode(file_get_contents($recipesFile), true, 512, JSON_UNESCAPED_UNICODE); 
      }

      public function getRecipes($searchTerm)
      {
         $recipes = $this->fitData($this->jsonData);
         $similarities = $this->calculateSimilarity($recipes, $searchTerm);

         $searchResult = $this->getSearchResult($similarities);
         return $searchResult;
      }

      private function fitData($data, $current = 0, $recipes = array())
      {
         if($current < sizeof($data))
         {
            $recipes[$current]['id'] = $data[$current]['id'];
            $recipes[$current]['title'] = $data[$current]['title'];

            $current += 1;
            return $this->fitData($data, $current, $recipes);
         }

         return $recipes;
      }

      private function calculateSimilarity($recipes, $searchedTerm, $current = 0, $similarities = array())
      {
         if($current < sizeof($recipes))
         {
            similar_text(strtolower($searchedTerm), html_entity_decode(strtolower($recipes[$current]['title']), ENT_QUOTES, 'UTF-8'), $percent);
            $similarities[$current]['similarity'] = number_format($percent);
            $similarities[$current]['id'] = $recipes[$current]['id'];
            $similarities[$current]['title'] = $recipes[$current]['title'];


            $current += 1;
            return $this->calculateSimilarity($recipes, $searchedTerm, $current, $similarities);
         }

         return $similarities;
      }

      private function getSearchResult($similarities)
      {
         $results = array();
         $i = 0;
         foreach($similarities as $sim)
         {
            if((float) $sim['similarity'] >= 40)
            {
               $results[$i] = $sim;
            }
            $i += 1;
         }

         return $results;
      }

      public function json_validate($json)
      {
         json_decode($json);

         return json_last_error() === JSON_ERROR_NONE;
      }
   }