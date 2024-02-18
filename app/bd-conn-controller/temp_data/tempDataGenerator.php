<?php
   class TemporaryData {
      private $url;

      public function __construct($file_name) {
         $this->url = $file_name;
      }

      public function generateTempData($data)
      {
         $path = "../temp_data/data/".$this->url.".json";

         try
         {
            if(file_exists($path))
            {
               unlink($path);
            }

            file_put_contents($path, $data);
         }
         catch(Exception $e)
         {
            return false;
         }

         return true;
      }
   }