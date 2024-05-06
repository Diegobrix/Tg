<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once(__DIR__."/../../../conf/defineSourcePath.php");

      $username = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $passwordConfirm = filter_input(INPUT_POST, 'password-confirm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      if($password == $passwordConfirm)
      {
         $stmt = $conn->prepare("SELECT * FROM `administrador` WHERE emailUsuario = :email;");
         $stmt->bindParam(':email', $email);
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            //status = 2 - Usuário já cadastrado no sistema
            header("location: ../../pages/credentials.php?status=2");
         }
         else
         {
            $stmtRegister = $conn->prepare("INSERT INTO `administrador`(nomeUsuario, emailUsuario, senhaUsuario) VALUES(:username, :email, :pass);");
            $stmtRegister->execute(array(
               ":username" => $username,
               ":email" => $email,
               ":pass" => password_hash($password, PASSWORD_DEFAULT)
            ));

            if($stmtRegister->rowCount() > 0)
            {
               header("location: ../../pages/credentials.php?status=3");
            }
         }
      }
   }