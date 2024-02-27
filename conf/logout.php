<?php
   session_start();
   if(isset($_SESSION) || isset($_SESSION['admin_id']))
   {
      unlink("../app/bd-conn-controller/temp_data/data/".$_SESSION['admin_token']."_admin_data.json");

      session_unset();
      session_destroy();

      //Direcionar para home do usuário não logado
   }