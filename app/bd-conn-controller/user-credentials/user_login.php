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

            $tempAdmin = new TemporaryData("admin_data");

            $adminData = array();
            $adminData['idUser'] = $dbHash['idUsuario'];
            $adminData['username'] = $dbHash['nomeUsuario'];
            $adminData['userEmail'] = $dbHash['emailUsuario'];

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