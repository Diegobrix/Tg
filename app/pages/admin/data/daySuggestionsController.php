<?php
   $suggestionsFilePath = __DIR__."/temp_data/day_suggestions.json";
   if(!file_exists($suggestionsFilePath))
   {
      generateSuggestions();
   }
   else
   {
      unlink($suggestionsFilePath);
      generateSuggestions();
   }

   function generateSuggestions()
   {
      require(__DIR__."/../../../../conf/defineSourcePath.php");
      require_once(__DIR__."/./getDataFromDB.php");

      $contentData = json_decode(file_get_contents(__DIR__."/../../../bd-conn-controller/temp_data/data/content_data.json"), true);
      if($contentData[0]['recipes_amount']<=100)
      {
         $lastId = 1;
      }
      else
      {
         $lastId = $contentData['recipes_amount'];
      }

      require(__DIR__."/DaySuggestions.php");
      $daySuggestions = new DaySuggestions(getRecipes($lastId, $conn));
      $randomized = $daySuggestions->getSuggestions();

      print_r($randomized);
      $suggestionsFile = __DIR__."/temp_data/day_suggestions.json";
      file_put_contents($suggestionsFile, json_encode($randomized));
   }