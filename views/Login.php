<?php
session_start();
define('BASE_URL', '/schoollibrary');
require_once __DIR__ . '/../Config/verify_csrf.php';
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

?>
<!DOCTYPE html>
<html lang="pt-BR">
   
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>School Library | Login</title>
   <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="./css/login.css">
   <link rel="stylesheet" href="../public/fonts/fonts.css">
   <link rel="shortcut icon" href="../public/img/favicon-colegio.ico" type="image/x-icon"/>
</head>

<body>
<form action="<?php echo BASE_URL; ?>/Controllers/LoginController.php" method="POST">
   <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" autocomplete="off">
      <div class="container-login">
         <div class="img-box">
            <img src="../public/img/imag-login.png" alt="login" class="imag-login">
         </div>
         <div class="content-box">
            <div class="form-box">
               <h2 class="text-login">Login</h2>
               <div class="input-box">
               <input type="text" name="matricula" placeholder="Informe sua Matrícula" maxlength="9" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
               </div>
               <div class="input-box">
                  <input type="password" name="ss" id="ss" class="form__input-text" placeholder="Senha" required />
                  <i class="form__input-icon fas fa-eye" data-password-eye></i>
               </div>
               <?php
               ?>
               <?php
               if (!empty($_SESSION['error'])) {
                  echo '<div class="alert alert-danger text-center" role="alert">' . $_SESSION['error'] . '</div>';
                  unset($_SESSION['error']);
               }
               ?>
               <div class="input-box">
                  <input type="submit" name="btnToEnter" value="Entrar">
                  <div id="caps-lock-alert">Caps Lock Ativado</div>
                  <p id="versao">Versão Beta: 1.0.0</p>
               </div>
            </div>
         </div>
      </div>
   </form>
</body>

<script src="../public/js/view_password.js"></script>
<script src="../public/js/CapsLock.js"></script>
</html>