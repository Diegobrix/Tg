<?php
   function saveImage($imgInput)
   {
      $tmp = $imgInput["tmp_name"];
      $img = $imgInput["name"];
      $targetDir = __DIR__."/../../../../../assets/images/recipes/";

      if (!file_exists($targetDir)) {
          mkdir($targetDir, 0777, true);
      }

      $finalName = uniqid() . '_' . $img;

      if (move_uploaded_file($tmp, $targetDir . $finalName)) {
          return $finalName;
      }
      
      return "no_image.php";
   }