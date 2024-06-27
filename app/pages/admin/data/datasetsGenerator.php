<?php
   require_once(__DIR__."/../../../../conf/defineSourcePath.php");
   require_once(__DIR__."/../../../bd-conn-controller/DataHandler.php");
   require_once(__DIR__."/../../../bd-conn-controller/GetContent.php");

   $filepath = __DIR__."/datasets/";
   $datasets = ['recipes.json', 'categories.json', 'ingredients.json', 'videos.json'];

   foreach($datasets as $dataset)
   {
      generateDataset($filepath, $dataset, $conn);
   }

   function generateDataset($filepath, $dataset, $conn)
   {
      if(!file_exists($filepath.$dataset))
      {
         $file = new DataHandler($dataset);
         $data = new GetContent($conn);

         switch($dataset)
         {
            case 'recipes.json':
               return $file->generateDataset(json_encode($data->getRecipes()));
               break;
            case 'categories.json':
               return $file->generateDataset(json_encode($data->getCategories()));
               break;
            case 'ingredients.json':
               return $file->generateDataset(json_encode($data->getIngredients()));
               break;
            case 'videos.json':
               return $file->generateDataset(json_encode($data->getVideos()));
               break;
         }
      }

      unlink($filepath.$dataset);
      return generateDataset($filepath, $dataset, $conn);
   }