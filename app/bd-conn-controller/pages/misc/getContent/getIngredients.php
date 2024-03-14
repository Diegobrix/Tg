<?php
   header("Access-Control-Allow-Origin: *");
   require_once(__DIR__."/../../../../../conf/finishApi.php");

   $response = array();
   $response['status'] = "failed";

   if($_SERVER['REQUEST_METHOD'] == "POST")
   {  

   }
   else
   {
      finishHim();
   }

   echo json_encode($response);