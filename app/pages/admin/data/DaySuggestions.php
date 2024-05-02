<?php
   require_once(__DIR__."/RecipeSuggestions.php"); 
   date_default_timezone_set('America/Sao_Paulo');
   $path = __DIR__."/./datasets/temp_data/day_suggestions.json";

   if(!file_exists($path))
   {
      $recipeSuggestion = new RecipeSuggestion();
      $suggestions = $recipeSuggestion->getRandomizedRecipes();
      createSuggestionsFile($suggestions, $path);
   }
   else
   {
      verifyTimeElapsed($path);
   }

   #region Create File
   function createSuggestionsFile($data, $path)
   {      
      if(file_exists($path))
      {
         unlink($path);
      }
      
      $creationTime = new DateTime();

      array_push($data, $creationTime->format('Y-m-d H:i:s'));
      return file_put_contents($path, json_encode($data));
   }
   #endregion
   #region Verify if Time Elapsed
   function verifyTimeElapsed($suggestionsJson)
   {
      $json = json_decode(file_get_contents($suggestionsJson), true);
      print("<pre>".print_r($json, true)."</pre>");

      $originalTime = new DateTime($json[sizeof($json) -1]);
      $now = new DateTime();

      $timeDiff = $now->diff($originalTime);

      return ($timeDiff->days > 0 || $timeDiff->h >= 24);
   }
   #endregion