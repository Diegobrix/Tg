<?php
   function finishHim($response, $error_msg)
   {
      $response['msg'] = $error_msg;
      die(json_encode($response));
   }