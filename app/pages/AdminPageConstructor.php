<?php
   class AdminPageConstructor
   {
      public function __construct()
      {
      }

      public function getAdminData($token)
      {
         $file = $this->getFile($token);
         if($file == null)
         {
            return null;
         }

         return json_decode(file_get_contents($file), true);
      }

      private function getFile($token)
      {
         $dir = __DIR__."/../bd-conn-controller/temp_data/data/";
         $pattern = '/^admin_'.$token.'\.json$/';

         $files = scandir($dir);
         $found = null;

         foreach($files as $file)
         {
            if(preg_match($pattern, $file, $matches))
            {
               $found = $matches[0];
            }
         }

         return $dir.$found;
      }
   }