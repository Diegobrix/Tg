<?php
   function finishHim($response, $error_msg)
   {
      $response['error'] = $error_msg;
      die(json_encode($response));
   }