<?php
   class AdminPagesConstructor
   {
      private $dataPath = __DIR__."/../../bd-conn-controller/temp_data/data/admin_data.json";

      function __construct()
      {
      }

      public function getAdminData()
      {
         if(!file_exists($this->dataPath))
         {
            return null;   
         }

         $adminData = json_decode(file_get_contents($this->dataPath), true);
         return $adminData;
      }
   }