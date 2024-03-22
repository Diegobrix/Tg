<?php
   header("Access-Control-Allow-Origin: *");
   require_once(__DIR__."/../../../../../conf/finishApi.php");
   
   $response = array();
   $response['status'] = "failed";
   
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once("./verifyContent/verifyContentExists.php");
      require_once(__DIR__."/../../../../../conf/defineSourcePath.php");


   }
   else
   {
      finishHim($response, "Método Incorreto");
   }

   echo json_encode($response);