<?php
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
      $userEmail = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $userPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      try
      {
         require_once("../../_conn/conn.php");
         require_once("../../bd-conn-controller/user-credentials/credentials_handler.php");
      }
      catch(Exception $e)
      {
         die();
      }

      $stmt = VerifyCredentials($conn, $userEmail);

      if($stmt -> rowCount() > 0)
      {
         $dbHash = $stmt -> fetch(PDO::FETCH_ASSOC);
         $isCorrect = VerifyPassword($dbHash['senhaUsuario'], $userPassword);

         if($isCorrect)
         {
            require_once("../temp_data/TemporaryData.php");
            require_once("../temp_data/random_token.php");

            session_start();
            $_SESSION['admin_token'] = getRandomToken(4);
            $_SESSION['admin_id'] = $dbHash['idUsuario'];

            $tempAdmin = new TemporaryData($_SESSION['admin_token']."_admin_data");

            date_default_timezone_set('America/Sao_Paulo');

            $adminData = array();
            $adminData['idUser'] = $dbHash['idUsuario'];
            $adminData['username'] = $dbHash['nomeUsuario'];
            $adminData['userEmail'] = $dbHash['emailUsuario'];
            $adminData['login_snapshot'] = date('d-m-Y h:i');

            if($tempAdmin->generateTempData(json_encode($adminData)))
            {
               header("location: __DIR__/../../../pages/admin/admin_homePage.php");
            }
         }
         else
         {
            echo"Senha Erralda";
         }
      }
      else
      {
         echo"Usuário Desconhecido!";
      }
   }