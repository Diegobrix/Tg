<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      require_once(__DIR__."/../../../conf/defineSourcePath.php");

      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $stmt = $conn->prepare("SELECT * FROM `administrador` WHERE emailUsuario = :email;");
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      if($stmt->rowCount() > 0)
      {
         $result = $stmt->fetch(PDO::FETCH_ASSOC);

         if(password_verify($password, $result['senhaUsuario']))
         {
            header(__DIR__."/../../pages/admin/admin_homePage.php");
         }
         else
         {
            //e_msg = 1 - Senha incorreta
            header(__DIR__."/../../pages/credentials.php?page=1&e_msg=1");
         }
      }
      else
      {
         //e_msg = 0 - Usuário não encontrado
         header(__DIR__."/../../pages/credentials.php?page=1&e_msg=0");
      }
   }