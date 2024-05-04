<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      $userEmail = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $userPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   }