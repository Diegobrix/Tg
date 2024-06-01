<?php
   class GetContent {
      private $conn;
      function __construct($conn)
      {
         $this->conn = $conn;
      }

      public function getRecipes($limit = '100')
      {
         $recipes = $this->getContent("receita", $limit);
         if($recipes != null)
         {
            $data = array();
            $i = 0;
            foreach($recipes as $recipe)
            {
               $data[$i]['id'] = $recipe['idReceita'];
               $data[$i]['title'] = $recipe['tituloReceita'];
               $data[$i]['thumb'] = $recipe['fotoReceita'];
               $data[$i]['description'] = $recipe['descricaoReceita'];
               $data[$i]['category'] = $this->getCategory($recipe['categoriaReceita']);
               $data[$i]['editor'] = $recipe['editor'];
               $data[$i]['author'] = $recipe['autor'];
               $data[$i]['suitedFor'] = $recipe['indicadaPara'];
               $data[$i]['date'] = $recipe['dataReceita'];

               $i += 1;
            }

            return $data;         
         }

         return null;
      }

      public function getCategories($limit = '100')
      {
         $categories = $this->getContent("categoria", $limit);
         if($categories != null)
         {
            $data = array();
            $i = 0;
            foreach($categories as $category)
            {
               $data[$i]['id'] = $category['idCategoria'];
               $data[$i]['title'] = $category['descricaoCategoria'];

               $i += 1;
            }

            return $data;
         }

         return null;
      }

      private function getCategory($categoryId)
      {
         $stmt = $this->conn->prepare("SELECT descricaoCategoria AS categoria FROM `categoria` WHERE idCategoria = :id;");
         $stmt->bindParam(':id', $categoryId);
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['categoria'];
         }

         return null;
      }

      public function getIngredients($limit = '100')
      {
         $ingredients = $this->getContent("ingrediente", $limit);
         if($ingredients != null)
         {
            $data = array();
            $i = 0;
            foreach($ingredients as $ingredient)
            {
               $data[$i]['id'] = $ingredient['idIngrediente'];
               $data[$i]['title'] = $ingredient['descricaoIngrediente'];

               $i += 1;
            }
            return $data;
         }

         return null;
      }

      public function getVideos($limit = '100')
      {
         $videos = $this->getContent("video", $limit);
         if($videos != null)
         {
            $data = array();
            $i = 0;
            foreach($videos as $video)
            {
               $data[$i]['id'] = $video['idVideo'];
               $data[$i]['title'] = $video['titVideo'];
               $data[$i]['description'] = $video['descricaoVideo'];
               $data[$i]['url'] = $video['urlVideo'];

               $i += 1;
            }

            return $data;
         }

         return null;
      }

      private function getContent($table, $limit = '100')
      {
         $stmt = $this->conn->prepare("SELECT * FROM `".$table."` LIMIT 100;");
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
         }

         return null;
      } 
   }