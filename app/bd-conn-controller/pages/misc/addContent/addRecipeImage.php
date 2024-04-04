<?php
   function saveImage($recipeTitle, $imgInput, $type = "image")
   {
      $tmp = $imgInput["tmp_name"];
      $img = $imgInput["name"];
      
      $baseDir = __DIR__."/../../../../../assets/images/recipes/".$recipeTitle."/";
      $targetDir = $baseDir;
      if($type == "video")
      {
        $targetDir = $baseDir."video/";
      }
      if (!file_exists($targetDir)) {
          mkdir($targetDir, 0777, true);
      }

      
      $finalName = uniqid() . '_' . $img;
      if((!isset($img)) || ($img == ""))
      {
        $finalName = "no_image.png";
      }
      
      if (move_uploaded_file($tmp, $targetDir . $finalName)) {
        $finalPath = $recipeTitle."/".$finalName;
        return [$finalName, $finalPath];
      }
      else
      {
        if(copy(__DIR__."/../../../../../assets/images/recipes/no_image.png", $targetDir."no_image.png"))
        {
          return [$finalName, $recipeTitle."/no_image.png"];
        }
      }
   }