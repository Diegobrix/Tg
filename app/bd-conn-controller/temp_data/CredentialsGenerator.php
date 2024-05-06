<?php
   class CredentialsGenerator
   {
      private $basepath;
      public function __construct($basepath)
      {
         $this->basepath = $basepath;         
      }

      public function generateCredentialsFile($filename, $data)
      {
         date_default_timezone_set('America/Sao_Paulo');

         $file = $this->basepath."/../temp_data/data/admin_".$filename;
         return file_put_contents($file, json_encode($data));         
      }
   }