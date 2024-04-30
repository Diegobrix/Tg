<?php
   class GetContent {
      private $conn;
      function __construct($conn)
      {
         $this->conn = $conn;
      }

      public function getRecipes($limit = null)
      {
         $recipes = $this->getContent("receita", $limit);
         if($recipes != null)
         {
            return $recipes;
         }

         return null;
      }

      public function getCategories($limit = null)
      {
         $categories = $this->getContent("categoria", $limit);
         if($categories != null)
         {
            return $categories;
         }

         return null;
      }

      public function getIngredients($limit = null)
      {
         
      }

      public function getVideos($limit = null)
      {

      }

      private function getContent($table, $limit = null)
      {
         $query = "SELECT * FROM `".$table."`;";
         if($limit != null)
         {
            $query = "SELECT * FROM `".$table."` LIMIT ".$limit.";";
         }

         $stmt = $this->conn->prepare($query);
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
         }

         return null;
      } 
   }