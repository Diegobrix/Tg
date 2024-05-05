<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title>Entre ou Crie seu Perfil</title>
      <link rel="icon" type="image/x-icon" href="http://localhost/favicon.ico">
      <!-- CSS -->
      <link rel="stylesheet" type="text/css" href="../../src/css/reset.css"/>
      <link rel="stylesheet" type="text/css" href="../../src/css/pages/credentials/credentials-styles.css">
      <!-- JS -->
      <script defer src="../../src/js/pages/credentials/credentials-canvas-controller.js"></script>
      <script defer src="../../src/js/pages/credentials/credentials-controller.js"></script>
   </head>
   <body>
      <?php
         $status_msg = ["Usuário não Encontrado", "Senha incorreta"];

         $status = filter_input(INPUT_GET, 'e_msg', FILTER_SANITIZE_NUMBER_INT);
         $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);

         if($status == null)
         {
            $status = '';
         }
      ?>
      <canvas id="background-elements-canvas">
      </canvas>
      <main>
         <section class="form--container" id="signup" aria-labelledby="signup-title">
            <form class="form" action="../bd-conn-controller/user-credentials/register.php" method="POST">
               <h2 id="signup-title">Cadastre-se</h2>
               <div class="form-group">
                  <input required type="text" id="txt-register-name" name="name" placeholder="John Doe">
               </div>
               <div class="form-group">
                  <input required type="email" id="txt-register-email" name="email" placeholder="John@john.com">
               </div>
               <div class="form-group">
                  <input required type="password" pattern=".{3,}" id="txt-register-password" name="password" placeholder="Senha..." autocomplete="on">
               </div>
               <div class="form-group">
                  <input required type="password" pattern=".{3,}" id="txt-register-password-confirm" name="password-confirm" placeholder="Confirmar Senha..." autocomplete="on">
               </div>
               <div class="error_display-wrapper">
                  <?php
                     if($page == 0)
                     {
                  ?>
                        <p><?=$status?></p>
                  <?php
                     }
                  ?>
               </div>
               <input type="submit" id="signup_form_submit" class="form_submit" value="Criar Conta"/>
            </form>
         </section>
         <section class="form--container" id="signin" aria-labelledby="signin-title">
            <form action="../bd-conn-controller/user-credentials/login.php" method="POST" id="signin-form" class="form">
               <h2 id="signin-title">Entrar</h2>
               <div class="form-group">
                  <input required type="email" id="txt-login-email" name="email" placeholder="John@john.com">
               </div>
               <div class="form-group">
                  <input required type="password" pattern=".{3,}" id="txt-login-password" name="password" placeholder="Senha..." autocomplete="on">
               </div>
               <div class="error_display-wrapper">
                  <?php
                     if($page == 1)
                     {
                  ?>
                        <p><?=$status?></p>
                  <?php
                     }
                  ?>
               </div>
               <input type="submit" id="signin_form_submit" class="form_submit" value="Entrar"/>
            </form>
         </section>
         <section class="advice-wrapper" data-state="signup">
            <section class="login--wrapper" cur-state="false">
               <h2>Bem-Vindo(a), Novamente!</h2>
               <h3>Acesse sua conta em poucos cliques</h3>
               <div class="icon--wrapper">
                  <object data="../../assets/icons/smile-signin.svg" type="image/svg+xml"></object> 
               </div>
               <button class="panel--handler">Não Possui uma conta ainda?</button>
            </section>
            <section class="signup--wrapper" cur-state="true">
               <h2>Bem-Vindo(a)</h2>
               <h3>Comece a sua jornada conosco! Preencha os campos para criar a sua conta</h3>
               <div class="icon--wrapper">
                  <object data="../../assets/icons/smile-signup.svg" type="image/svg+xml"></object> 
               </div>
               <button class="panel--handler">Já Possui uma conta?</button>
            </section>
         </section>
      </main>
   </body>
</html>