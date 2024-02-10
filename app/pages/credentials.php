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
      <canvas id="background-elements-canvas">
      </canvas>
      <main>
         <section class="form--container" id="signup" aria-labelledby="signup-title">
            <form action="../bd-conn-controller/user-credentials/user_register.php" method="POST">
               <h2 id="signup-title">Cadastre-se</h2>
               <div class="form-group">
                  <input required type="text" id="txt-register-name" name="name" placeholder="John Doe">
               </div>
               <div class="form-group">
                  <input required type="email" id="txt-register-email" name="email" placeholder="John@john.com">
               </div>
               <div class="form-group">
                  <input required type="password" pattern=".{3,}" id="txt-register-password" name="password" placeholder="Senha...">
               </div>
               <div class="form-group">
                  <input required type="password" pattern=".{3,}" id="txt-register-password-confirm" name="password-confirm" placeholder="Confirmar Senha...">
               </div>
               <input type="submit" value="Criar Conta">
            </form>
         </section>
         <section class="form--container" id="signin" aria-labelledby="signin-title">
            <form action="../bd-conn-controller/user-credentials/user_login.php" method="POST">
               <h2 id="signin-title">Entrar</h2>
               <div class="form-group">
                  <input required type="email" id="txt-login-email" name="email" placeholder="John@john.com">
               </div>
               <div class="form-group">
                  <input required type="password" pattern=".{3,}" id="txt-login-password" name="password" placeholder="Senha...">
               </div>
               <input type="submit" value="Entrar">
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