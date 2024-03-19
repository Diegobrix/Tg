<?php
   header("Access-Control-Allow-Origin: *");
   $response = array();
   $response['status'] = "failed";

   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once(__DIR__."/../../../_conn/conn.php");

      if(isset($conn))
      {
         $jsonData = file_get_contents("php://input");
         $data = json_decode($jsonData, true);

         
      }
   }
   
   echo json_encode($response);