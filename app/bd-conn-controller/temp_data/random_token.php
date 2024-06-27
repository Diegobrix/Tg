<?php
   function getRandomToken($size)
   {
      $possibleChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $token = array();

      for($i = 0; $i < $size; $i++)
      {
         array_push($token, $possibleChars[rand(0, strlen($possibleChars) - 1)]);
      }

      return implode($token);
   }