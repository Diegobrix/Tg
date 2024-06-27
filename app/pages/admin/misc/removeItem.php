<?php
   $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
   $type = filter_input(INPUT_GET, 'content-type', FILTER_SANITIZE_NUMBER_INT);
   $tables = ['receita', 'ingrediente', 'categoria', 'video'];

   