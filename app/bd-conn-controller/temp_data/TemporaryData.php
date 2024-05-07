<?php
   class TemporaryData
   {
      private $filename;
      public function __construct($filename)
      {
         $this->filename = __DIR__."/./data/".$filename.".json";
      }

      public function generateTempData($data)
      {
         if(file_exists($this->filename))
         {
            unlink($this->filename);
         }

         return file_put_contents($this->filename, $data);
      }
   }