<?php
   require_once(__DIR__."/../../../../conf/defineSourcePath.php");
   require_once(__DIR__."/getDataFromDB.php");
   date_default_timezone_set('America/Sao_Paulo');

   $file = __DIR__."/temp_data/day_suggestions.json";
   if(!file_exists(__DIR__.'/temp_data/day_suggestions.json'))
   {
      $dateAssign = date('m/d/Y h:i:s a', time());   
      $data = [['DateAssign' => $dateAssign], ['True' => 'false']];

      createSuggestionsFile($file, $data);
   }
   else
   {
      if(verifyTimePassed($file))
      {
         $dateAssign = date('m/d/Y h:i:s a', time());   
         $data = [['DateAssign' => $dateAssign], $recipesData];

         createSuggestionsFile($file, $data);
      }
   }

   function verifyTimePassed($file)
   {
      if(file_exists($file) && (is_readable($file)))
      {
         $data = json_decode(file_get_contents($file), true);

         if(($data) && (isset($data[0]['DateAssign'])))
         {
            $lastDateAssign = new DateTime($data[0]['DateAssign']);
            $curDate = new DateTime();

            $lastDateAssign->add(new DateInterval('P1D'));
            return $curDate >= $lastDateAssign;
         }
      }
   }

   function createSuggestionsFile($file, $data)
   {
      file_put_contents($file, json_encode($data));
   }