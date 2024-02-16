<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      $userName = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
      $userEmail = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $userPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $passwordConfirm = filter_input(INPUT_POST, "password-confirm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      if ($userPassword != $passwordConfirm)
      {
         //Senhas Deferentes HEADER;
      }
      else
      {
         try
         {
            require_once("../../_conn/conn.php");
            require_once("./credentials_handler.php");
         }
         catch(Exception $e)
         {
            die();
         }

         $stmt = VerifyCredentials($conn, $userEmail);

         if ($stmt->rowCount() == 0)
         {
            $stmtRegister = $conn->prepare("INSERT INTO `administrador`(nomeUsuario, emailUsuario, senhaUsuario) VALUES(:userName, :userEmail, :userPass);");
            $stmtRegister->execute(array(
               ":userName" => $userName,
               ":userEmail" => $userEmail,
               ":userPass" => password_hash($userPassword, PASSWORD_DEFAULT)
            ));

            header("location: ../../pages/login.php");
            exit();
         }
         else
         {
            //Exeste;
         }
      }
   }
