<?php
   $video = filter_input(INPUT_POST, "recipe_video", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   echo $video;