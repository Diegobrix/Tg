<?php
   $_dns = "mysql:host=localhost;dbname=tg";
   $_usr = "root";
   $_pwd = "";

   try
   {
      $conn = new PDO($_dns, $_usr, $_pwd);
   }
   catch(PDOException $e)
   {
      echo "Erro ao tentar realizar a conexão com o banco de dados";
   }