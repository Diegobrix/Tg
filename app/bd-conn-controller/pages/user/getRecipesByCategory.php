<?php
   header("Access-Control-Allow-Origin: *");
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

      require_once(__DIR__.'/./Recipe.php');
      $category = new Recipe(null, $conn);
      if($search->json_validate(file_get_contents($filePath)))
      {
         $result = $search->getRecipesByCategory($jsonData['category']);
         if($result != null)
         {
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
         else
         {
            finishHim($response, 'Não há receitas que correspondam à categoria');
         }
      }
   }
   else
   {
      finishHim($response, 'Método incorreto');
   }