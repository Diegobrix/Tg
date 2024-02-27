<?php
   class AdminPagesConstructor
   {
      public $dataPath = __DIR__."/../../bd-conn-controller/temp_data/data/";
      public $page;
      private $token;

      function __construct($admin_token, $page = "_admin_data")
      {
         $this->page = $admin_token.$page;
      }

      public function getAdminData()
      {
         return $this->generateFile($this->dataPath.$this->page.".json");
      }

      public function getContentData($page)
      {
         return $this->generateFile($this->dataPath.$page.".json");
      }

      private function generateFile($file)
      {
         if(!file_exists($file))
         {
            return null;   
         }

         $encodedData = json_decode(file_get_contents($file), true);
         return $encodedData;
      }
   }