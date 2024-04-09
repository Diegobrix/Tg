<?php
   require_once(__DIR__."/../../../../conf/defineSourcePath.php");
   require_once(__DIR__."/getDataFromDB.php");
   date_default_timezone_set('America/Sao_Paulo');

   $file = __DIR__."/temp_data/day_suggestions.json";
   if(!file_exists(__DIR__.'/temp_data/day_suggestions.json'))
   {
      $dateAssign = date('m/d/Y h:i:s a', time());   
      $data = [['DateAssign' => $dateAssign], getData($conn)];

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

   function getData($conn)
   {
      $stmtRecipes = $conn -> prepare("SELECT * FROM `receita` LIMIT 50;");
      $stmtRecipes -> execute();

      if($stmtRecipes -> rowCount() > 0)
      {
         $recipesRaw = $stmtRecipes->fetchAll(PDO::FETCH_ASSOC);
         $recipes = [];
         $i = 0;

         foreach($recipesRaw as $raw)
         {
            $recipes[$i]['idSuggestion'] = $raw['idReceita'];
            $recipes[$i]['titleSuggestion'] = $raw['tituloReceita'];
            $recipes[$i]['thumbSuggestion'] = $raw['fotoReceita'];
            $i += 1;
         

         $suggestions = randomizeSuggestions($recipes);
         return $suggestions;
      }
   }

   function randomizeSuggestions($recipes, $randomizedIndexes = array(), $randomic = array(), $i = 0)
   { 
      if(($i < sizeof($recipes)) && ($i < 5))
      {
         $random = rand(0, sizeof($recipes) - 1);
         if(in_array($random, $randomizedIndexes))
         {
            return randomizeSuggestions($recipes, $randomizedIndexes, $randomic, $i);
         }
         
         array_push($randomizedIndexes, $random);
         array_push($randomic, $recipes[$random]);
         $i += 1;
         return randomizeSuggestions($recipes, $randomizedIndexes, $randomic, $i);
      }

      return $randomic;
   }