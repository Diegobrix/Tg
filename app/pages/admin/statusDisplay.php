<?php
   $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_NUMBER_INT);
   if($status == null)
   {
      $status = 1;
   }

   $status_msgs = ['Item editado com sucesso', 'Erro ao Editar o Item', 'Receita cadastrada com sucesso', 'Erro ao cadastrar a receita'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Status</title>

      <link rel="stylesheet" type="text/css" href="../../../src/css/reset.css"/>
      <link rel="stylesheet" type="text/css" href="../../../src/css/pages/status/status-styles.css"/>
   </head>
   <body>
      <main>
         <figure>
            <i class="display-icon <?=$status==0?'success':'failure'?>"></i>
         </figure>
         <div class="status-container">
            <h1 class="status-head"><?=$status==0?'Sucesso':'Falha'?></h1>
            <p><?=$status_msgs[0]?></p>
         </div>
      </main>
      <p class="redirect"><a href="">Não foi redirecionado clique aqui!</a></p>
   </body>
</html>