<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
  // For security, start by assuming the visitor is NOT authorized.
  $isValid = False;


  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username.
  // Therefore, we know that a user is NOT logged in if that Session variable is blank.
  if (!empty($UserName)) {
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login.
    // Parse the strings into arrays.
    $arrUsers = Explode(",", $strUsers);
    $arrGroups = Explode(",", $strGroups);
    if (in_array($UserName, $arrUsers)) {
      $isValid = true;
    }
    // Or, you may restrict access to only certain users based on their username.
    if (in_array($UserGroup, $arrGroups)) {
      $isValid = true;
    }
    if (($strUsers == "") && true) {
      $isValid = true;
      if($_SESSION['audio']!=""){
      ?>
      <audio controls preload="auto|metadata|auto" autoplay style="display:none;" >
          <source src="../acceso_permitido.wav" type="audio/mpeg"  />
          <source src="acceso_permitido.wav" type="audio/ogg" />
          <source src="acceso_permitido.wav" type="audio/wav" />
          Lo que pongas aquí se muestra si el navegador no soporta la etiqueta audio.
      </audio>

      <?php
      $_SESSION['audio']="";
    }
    }
  }
  return $isValid;
}
$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];

  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0)
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo);
  exit;
}
?>
<!--termino de validacion para no entrar a utras paginas con la url-->
<?php require_once('../Connections/conexion2.php'); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ventas</title>
<link href="../img/logo.ico" rel="icon" />
<link href="css/estilosadmin.css" rel="stylesheet" type="text/css" />
<link href="../fontawesome/css/all.css" rel="stylesheet">


</head>

<body>
  <header>
    <?php include("includes/header.php"); ?>
  </header>





  <div class="contenido">
    <h1>CONTRO DE VENTAS  </h1>

    <div class="errores">
    <?php require_once('404.php');
    ?>
    <h1><?php $noimplementada=error("501") ?></h1>
    </div>

  </div>

  <footer>
    <div class="logo">
      <img src="../img/logo.png" alt="" title="logotipo" >
    </div>
    <div id="copyright">
      Copyright&nbsp&copy;&nbsp;2021 - Todos los derechos reservados</div>
  </footer>

</body>
</html>
