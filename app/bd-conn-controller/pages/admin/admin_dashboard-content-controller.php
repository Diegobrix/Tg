<?php
   class ContentController
   {
      private $basePath = __DIR__."/../../../pages/admin/data/datasets/";
      private $content = [];

      
      function __construct()
      {
         $this->content[0] = json_decode(file_get_contents($this->basePath."/recipes.json"), true);
         $this->content[1] = json_decode(file_get_contents($this->basePath."/ingredients.json"), true);
         $this->content[2] = json_decode(file_get_contents($this->basePath."/categories.json"), true);
         $this->content[3] = json_decode(file_get_contents($this->basePath."/videos.json"), true);
      }

      public function defineContentType($contentType)
      {
         if(($contentType < sizeof($this->content)) && ($contentType >= 0))
         {
            return $this->content[$contentType];
         }
         
         return null;
      }      
   }