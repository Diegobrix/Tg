<?php
   require_once(__DIR__."/../../../../conf/defineSourcePath.php");
   require_once(__DIR__."/getDataFromDB.php");
   date_default_timezone_set('America/Sao_Paulo');

   $state = "false";

   $dateAssign = ['DateAssign' => date('m/d/Y h:i:s a', time())];   
   $recipesData = ['Key' => 'Value'];

   $data = [$dateAssign, $recipesData];
   if(!file_exists(__DIR__.'/temp_data/day_suggestions.json'))
   {
      file_put_contents(__DIR__.'/temp_data/day_suggestions.json', json_encode($data));
   }