<?php
   header("Access-Control-Allow-Origin: *");
   require_once(__DIR__."/../../../../../conf/finishApi.php");

   $response = array();
   $response['status'] = "failed";

   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      $data = json_decode(file_get_contents("php://input"), true);
      if(sizeof($data) <= 0)
      {
         finishHim();
      }
   }
   else
   {
      finishHim();
   }

   $response["data"] = $data['teste'];
   echo json_encode($response);