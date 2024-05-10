<?php
   require_once(__DIR__."/../../../../conf/defineSourcePath.php");
   $response = array();
   $response['status'] = 'failed';

   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $jsonData = json_decode(file_get_contents("php://input"), true);

      if($jsonData == null)
      {
         finishHim($response, 'Dados Inválidos');
      }

      require_once(__DIR__."/SearchRecipe.php");
      $filePath = __DIR__.'/../../../pages/admin/data/datasets/recipes.json';
      
      if(file_exists($filePath))
      {
         $search = new SearchRecipe($filePath);
         if($search->json_validate(file_get_contents($filePath)))
         {
            $result = $search->getRecipes($jsonData['searchedTerm']);
            
            $response['status'] = 'success';
            $response['data'] = array();
            $i = 0;

            foreach($result as $r)
            {
               $response['data'][$i] = $r;
               $i += 1;
            }

            echo json_encode($response);
         }
      }
      else
      {
         finishHim($response, 'Falha ao buscar o arquivo com receitas');
      }
   }
   else
   {
      finishHim($response, 'Método incorreto');
   }