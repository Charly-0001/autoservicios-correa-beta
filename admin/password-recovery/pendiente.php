<?php include('app_logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Password Reset PHP</title>
 <link rel="stylesheet" href="main.css">
</head>
<body>

 <form class="login-form" action="login.php" method="post" style="text-align: center;">
  <p>
   Enviamos un correo electrónico a  <b><?php echo $_GET['email'] ?></b> para ayudarlo a recuperar su cuenta.
  </p>
     <p>Inicie sesión en su cuenta de correo electrónico y haga clic en el enlace que le enviamos para restablecer su contraseña</p>
 </form>

</body>
</html>
