<?php
   $suggestionsFilePath = __DIR__."/./temp_data/suggestions.json";
   if(!file_exists($suggestionsFilePath))
   {
      generateSuggestions();
   }
   else
   {
      $snapshotJson = json_decode(file_get_contents(__DIR__."/../../../bd-conn-controller/temp_data/data/admin_data.json"), true);
      $loginSnapshot = $snapshotJson['login_snapshot'];

      try
      {
         $datetimeLogin = DateTime::createFromFormat('d-m-Y H:i', $loginSnapshot);
      
         if($datetimeLogin instanceof DateTime)
         {
            $currentDatetime = new DateTime();
            $dateTimeDiff = $currentDatetime->diff($datetimeLogin);

            if(($dateTimeDiff->h > 24) || ($dateTimeDiff->days > 0))
            {
               unlink($suggestionsFilePath);
               generateSuggestions();
            }
         }
      }
      catch(DateError $e)
      {
         die();
      }
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

      require(__DIR__."/./DaySuggestions.php");
      $daySuggestions = new DaySuggestions(getRecipes($lastId, $conn));
      $randomized = $daySuggestions->getSuggestions();

      $suggestionsFilePath = __DIR__."/temp_data/day_suggestions.json";
      file_put_contents($suggestionsFilePath, json_encode($randomized));
   }