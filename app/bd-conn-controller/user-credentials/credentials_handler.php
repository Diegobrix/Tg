<?php
   function VerifyCredentials($conn, $email)
   {
      $stmt = $conn -> prepare("SELECT * FROM `administrador` WHERE emailUsuario = :email");
      $stmt -> bindParam(":email", $email);
      $stmt -> execute();
      return $stmt;
   }

   function VerifyPassword($dbPassword, $password)
   {
      return password_verify($password, $dbPassword)?true:false;
   }
   