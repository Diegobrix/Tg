<?php
  class MediaSaver
  {
    private $baseUrl = __DIR__."/../../../../../assets/images/recipes/";
    private $dirTitle;
    function __construct($dirTitle)
    {
      $title = explode(' ', $dirTitle);
      $this->dirTitle = uniqid().'@'.implode("_", $title);
    }

    public function getNewDirName()
    {
      return $this->dirTitle;
    }

    public function saveMedia($content, $type = "image", $dirName = null)
    {
      if($type == "video")
      {
        return $this->saveVideo($content);
      }

      return $this->saveImage($content, $dirName);
    }

    private function saveImage($content, $dirname = null)
    {
      $targetDir = $this->baseUrl.$this->dirTitle;
      if($dirname != null)
      {
        $targetDir = $dirname;
      }

      if(!$this->createDir($dirname!=null?$this->baseUrl.$targetDir:$targetDir))
      {
        return null;
      }

      if($content == "no_image.png")
      {
        copy($this->baseUrl."no_image.png", $targetDir."/"."no_image.png");
        return $this->dirTitle."/no_image.png";
      }
      
      $file = $this->moveFile($content, $targetDir, $dirname!=null);
      return $file;
    }
    
    private function saveVideo($content, $noRecipe = false)
    {
      $baseUrl = __DIR__."/../../../../../assets/videos/";
      $targetDir = $baseUrl.$this->dirTitle."/";
      if($noRecipe == true)
      {
        $targetDir = $baseUrl;
      }
      
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

      return true;
    }

    private function moveFile($file, $targetDir, $relativePath = false)
    {
      $img = $file['name'];
      $tmpName = $file['tmp_name'];

      $imgTitle = explode(' ', $img);


      $finalName = uniqid()."_".implode('_', $imgTitle);
      $dirname = iconv("UTF-8","Windows-1256",$targetDir);
      if(move_uploaded_file($tmpName, $relativePath?$this->baseUrl.$dirname."/".$finalName:$dirname."/".$finalName))
      {

        return $this->getNewDirName()."/".$finalName;
      }

      return null;
    }
  }