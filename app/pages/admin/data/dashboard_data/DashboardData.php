<?php
   class DashboardData
   {
      private $filename;
      function __construct($filename)
      {
         $this->filename = $filename;
      }

      public function generateDataset($data)
      {
         $path = __DIR__."/datasets/";
         if(!file_exists($path.$this->filename))
         {
            if(file_put_contents($path.$this->filename, $data))
            {
               return true;
            }
            else
            {
               return false;
            }
         }

         return null;
      }

      function __destruct()
      {
         $this->filename = null;
      }
   }
