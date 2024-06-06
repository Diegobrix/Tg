<?php
   class Recipe
   {
      private $id;
      private $conn;

      function __construct($id, $conn)
      {
         $this->id = $id;
         $this->conn = $conn;
      }

      public function getRecipe()
      {
         $stmt = $this->conn->prepare("SELECT * FROM `receita` WHERE idReceita = :recipeId;");
         $stmt -> bindParam(":recipeId", $this->id);
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $recipe = array();
            $recipe['id'] = $result['idReceita'];
            $recipe['title'] = $result['tituloReceita'];
            $recipe['description'] = $result['descricaoReceita'];
            $recipe['benefits'] = $result['beneficiosReceita'];
            $recipe['waytodo'] = $result['modoDePreparoReceita'];
            $recipe['source'] = $result['fonte'];
            $recipe['suitedFor'] = $result['indicadaPara'];
            $recipe['pic'] = $result['fotoReceita'];
            $recipe['data'] = $result['dataReceita'];
            $recipe['author'] = $result['autor'];

            
            $recipe['category'] = $this->getRecipeCategory($result['categoriaReceita']);
            $recipe['ingredients'] = $this->getIngredients($result['idReceita']);
            $recipe['editor'] = $this->getRecipeEditor($result['editor']);


            $video = $this->getRecipeVideo($result['idReceita']);
            if($video != null)
            {
               $recipe['video'] = $video;
            }

            return $recipe;
         }

         return null;
      }

      #region Get Ingredients
      private function getIngredients($recipeId)
      {
         $data = $this->itemExists($recipeId, 'ingredientereceita', 'idReceita');
         if($data != null)
         {
            return $this->getIngredientsFromDB($data);
         }

         return null;
      }

      private function getIngredientsFromDB($data, $current = 0, $ingredients = array())
      {
         if($current < sizeof($data))
         {
            $ingredients[$current] = $this->getIngredientName($data[$current]['idIngrediente']).'@'.$data[$current]['qtdeIngrediente'].'~'.$this->getIngredientUnit($data[$current]['medida']).'|';
            $current += 1;
            return $this->getIngredientsFromDB($data, $current, $ingredients);
         }

         return implode('', $ingredients);
      }

      private function getIngredientUnit($unitId)
      {
         $stmt = $this->conn->prepare("SELECT descricaoMedida AS unit FROM `medida` WHERE idMedida = :id;");
         $stmt->bindParam(":id", $unitId);
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['unit'];
         }

         return null;
      }

      private function getIngredientName($ingredientId)
      {
         $stmt = $this->conn->prepare("SELECT descricaoIngrediente AS ingredient FROM `ingrediente` WHERE idIngrediente = :id;");
         $stmt->bindParam(":id", $ingredientId);
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['ingredient'];
         }

         return null;
      } 
      #endregion

      #region Get Author
      private function getRecipeEditor($editorId)
      {
         $stmt = $this->conn->prepare("SELECT nomeUsuario AS username FROM `administrador` WHERE idUsuario = :id");
         $stmt->bindParam(":id", $editorId);
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['username'];
         }

         return null;
      }
      #endregion

      #region Get Category
      private function getRecipeCategory($categoryId)
      {
         $stmt = $this->conn->prepare("SELECT descricaoCategoria AS categoria FROM `categoria` WHERE idCategoria = :id;");
         $stmt->bindParam(":id", $categoryId);
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['categoria'];
         }

         return null;
      }
      #endregion

      #region Get Video
      private function getRecipeVideo($recipeId)
      {
         $videoDB = $this->itemExists($recipeId, 'videoreceita', 'idReceita');
         if($videoDB != false)
         {
            $stmt = $this->conn->prepare("SELECT * FROM `video` WHERE idVideo = :id;");
            $stmt->bindParam(":id", $videoDB['idVideo']);

            if($stmt -> rowCount() > 0)
            {
               $result = $stmt -> fetch(PDO::FETCH_ASSOC);
               return $result;
            }
         }
         return null;
      }
      #endregion

      public function itemExists($id, $table, $column)
      {
         $stmt = $this->conn->prepare("SELECT * FROM `".$table."` WHERE `".$column."` = :id;");
         $stmt->bindParam(":id", $id);
         $stmt->execute();
         
         if($stmt->rowCount() > 0)
         {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
         }
         
         return false;
      }
      
      public function addToTemp($recipe)
      {
         return false;
      }

      function __destruct()
      {
         $this->conn = null;
         $this->id = null;
      }
   }