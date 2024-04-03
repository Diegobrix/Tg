<?php
   function saveImage($imgInput, $type = "image")
   {
      $tmp = $imgInput["tmp_name"];
      $img = $imgInput["name"];
      
      $baseDir = __DIR__."/../../../../../assets/images/recipes/".$img."/";
      $targetDir = $baseDir;
      if($type == "video")
      {
        $targetDir = $baseDir."video/";
      }

      if (!file_exists($targetDir)) {
          mkdir($targetDir, 0777, true);
      }

      $finalName = uniqid() . '_' . $img;

      if (move_uploaded_file($tmp, $targetDir . $finalName)) {
          return $finalName;
      }
      
      return "no_image.php";
   }