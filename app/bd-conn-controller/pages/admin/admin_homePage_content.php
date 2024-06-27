<?php
   function fetchCategory($conn, $categoriesId, $current = 0, $categories = array())
   {
      $category = $categoriesId;
      if(!is_array($category))
      {
         $category = array($categoriesId);
      }

      if($current < sizeof($category))
      {
         $stmt = $conn->prepare("SELECT descricaoCategoria AS `description`, (SELECT COUNT(idReceita) FROM `receita` WHERE categoriaReceita = :id) AS amount FROM `categoria` WHERE idCategoria = :id;");
         $stmt->bindParam(':id', $category[$current]);
         $stmt->execute();

         if($stmt->rowCount() > 0)
         {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($results as $result)
            {
               $categories[$current]['title'] = $result['description'];
               $categories[$current]['amount'] = $result['amount'];
            }
         }

         $current += 1;
         return fetchCategory($conn, $categoriesId, $current, $categories);
      }

      return $categories;
   }

   function fetchRecipe($conn, $recipeId)
   {
      $stmt = $conn->prepare("SELECT tituloReceita AS title, fotoReceita AS thumb FROM `receita` WHERE idReceita = :id;");
      $stmt->bindParam(':id', $recipeId);
      $stmt->execute();

      if($stmt->rowCount() > 0)
      {
         $result = $stmt->fetch(PDO::FETCH_ASSOC);

         $recipe = array();
         $recipe[0]['title'] = $result['title'];
         $recipe[0]['thumb'] = $result['thumb'];

         return $recipe;
      }

      return null;
   }