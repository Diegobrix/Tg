<?php
   require_once(__DIR__."/RecipeSuggestions.php"); 

   function getSuggestions()
   {
      $recipeSuggestion = new RecipeSuggestion();

      $suggestions = $recipeSuggestion->getDaySuggestions(" ");

      return $suggestions;
   }