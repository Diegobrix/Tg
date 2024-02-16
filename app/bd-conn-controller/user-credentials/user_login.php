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
            $userData = array();
            $userData['userId'] = $dbHash['idUsuario'];
            $userData['userName'] = $dbHash['nomeUsuario'];
            $userData['userEmail'] = $dbHash['emailUsuario'];

            $admin_data = json_encode($userData);
            $adminPath = "../pages/admin/admin_temp_data/admin_cred_data.json";

            if(file_exists($adminPath))
            {
               unlink($adminPath);
            }

            file_put_contents($adminPath, $admin_data);
         }
         else
         {
            echo"Senha Erralda";
         }
      }
      else
      {

      }
   }