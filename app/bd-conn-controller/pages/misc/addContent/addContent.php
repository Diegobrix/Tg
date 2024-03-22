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

   function addContent($conn, $table, $content, $column)
   {
      $stmt = $conn -> prepare("INSERT INTO `".$table."`(".$column.") VALUES(:content);");
      $stmt -> bindParam(":content", $content);
      $stmt -> execute();

      if($stmt -> rowCount() > 0)
      {
         return true;
      }

      return false;
   }