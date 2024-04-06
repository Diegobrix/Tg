<?php
   require_once(__DIR__."/../../../bd-conn-controller/pages/misc/addContent/MediaSaver.php");

   $recipeTitle = filter_input(INPUT_POST, "recipe_title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $mSaver = new MediaSaver($recipeTitle);

   if((isset($_FILES['recipe_thumb'])) && ($_FILES['recipe_thumb']['name'] != ""))
   {
      $photo = $mSaver->saveMedia($_FILES['recipe_thumb']);
   }
   else {
      $photo = $mSaver->saveMedia("no_image.png");
   }

   $video = null;
   if((isset($_FILES['recipe_video'])) && ($_FILES['recipe_video']['name'] != ""))
   {
      $video = $mSaver->saveMedia($_FILES['recipe_video'], "video");
   }

   print_r($photo);