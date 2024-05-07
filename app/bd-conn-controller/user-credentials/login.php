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
            require_once(__DIR__."/../temp_data/random_token.php");
            require_once(__DIR__."/../temp_data/CredentialsGenerator.php");

            session_start();
            $_SESSION['token'] = getRandomToken(4);
            $_SESSION['id'] = $result['idUsuario'];

            $data = array();
            $data['id'] = $result['idUsuario'];
            $data['username'] = $result['nomeUsuario'];
            $data['email'] = $result['emailUsuario'];

            $filepath = $_SESSION['token'].".json";

            $credentials = new CredentialsGenerator(__DIR__);
            $file = $credentials->generateCredentialsFile($filepath, $data);
            header("location: ../../pages/admin/admin_homePage.php");
         }
         else
         {
            //status = 1 - Senha incorreta
            header("location: ../../pages/credentials.php?status=1");
         }
      }
      else
      {
         //status = 0 - Usuário não encontrado
         header("location: ../../pages/credentials.php?status=0");
      }
   }