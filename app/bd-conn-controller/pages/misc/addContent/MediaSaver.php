<?php
  class MediaSaver
  {
    private $baseUrl = __DIR__."/../../../../../assets/images/recipes/";
    private $dirTitle;
    function __construct($dirTitle)
    {
      $title = explode(' ', $dirTitle);
      $this->dirTitle = uniqid().implode("_", $title);
    }

    public function saveMedia($content, $type = "image")
    {
      if($type == "video")
      {
        return $this->saveVideo($content);
      }

      return $this->saveImage($content);
    }

    private function saveImage($content)
    {
      $targetDir = $this->baseUrl.$this->dirTitle;
      if(!$this->createDir($targetDir))
      {
        return null;
      }

      if($content == "no_image.png")
      {
        copy($this->baseUrl."no_image.png", $targetDir."/"."no_image.png");
        return $this->dirTitle."/no_image.png";
      }
      
      $file = $this->moveFile($content, $targetDir);
      return $file;
    }
    
    private function saveVideo($content)
    {
      $targetDir = $this->baseUrl.$this->dirTitle."/video/";
      if(!$this->createDir($targetDir))
      {
        return null;
      }

      $originalFilename = explode(' ', $content);
      $finalFilename = implode('_', $originalFilename);

      $file = $this->moveFile($finalFilename, $targetDir);
      return $file;
    }

    private function createDir($dirName)
    {
      if(!file_exists($dirName))
      {
        if(mkdir($dirName))
        {
          return true;
        }

        return false;
      }
    }

    private function moveFile($file, $targetDir)
    {
      $img = $file['name'];
      $tmpName = $file['tmp_name'];

      $imgTitle = explode(' ', $img);

      $finalName = uniqid()."_".implode('_', $imgTitle);
      $dirname = iconv("UTF-8","Windows-1256",$targetDir);
      if(move_uploaded_file($tmpName, $dirname."/".$finalName))
      {
        return $this->dirTitle."/".$finalName;
      }

      return null;
    }
  }