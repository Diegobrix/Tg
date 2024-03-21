<?php
   function verifyIfExists($conn, $table, $content, $column)
   {
      $stmt = $conn -> prepare("SELECT * FROM `".$table."` WHERE ".$column." = :content;");
      $stmt -> bindParam(":content", $content);
      $stmt -> execute();

      if($stmt -> rowCount() > 0)
      {
         return true;
      }

      return false;
   }