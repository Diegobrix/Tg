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
      require_once("./getDataFromDB.php");
      
      //$daySuggestions = new DaySuggestions($recipes);
   }