<?php require_once('../Connections/conexion2.php'); ?><!--INSTANCIAMOS LA CONEXION-->

<!--VALIDAMOS EL ACCESO POR URL-->
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
global $conexion2;
  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conexion2, $theValue) : mysqli_escape_string($conexion2, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<!--FIN DE VALIDACION DE ACCESO-->
<?php


// *** VALIDACION DE CAMPOS DE ACCESO.
if (!isset($_SESSION)) {
  session_start();
}

if($_SESSION['audio']==""){
?>
<audio controls preload="auto|metadata|auto" autoplay style="display:none;" >
    <source src="../acceso_denegado.wav" type="audio/mpeg"  />
    <source src="acceso_permitido.wav" type="audio/ogg" />
    <source src="acceso_permitido.wav" type="audio/wav" />
    Lo que pongas aquí se muestra si el navegador no soporta la etiqueta audio.
</audio>

<?php
$_SESSION['audio']="";
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Email'])) {
  $loginUsername=$_POST['Email'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "ventas.php";
  $MM_redirectLoginFailed = "error.php";
  $MM_redirecttoReferrer = false;


  $LoginRS__query=sprintf("SELECT * FROM administracion WHERE Email=%s OR Nombre_completo=%s",
    GetSQLValueString($loginUsername, "text"),
    GetSQLValueString($loginUsername, "text"));

  $LoginRS = mysqli_query( $conexion2,$LoginRS__query) or die(mysqli_error());
  $row_LoginRS = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if($row_LoginRS['estado']=="ALTA"){//VERIFICAR ALTA EN EL SISTEMA
  if ($row_LoginRS   && password_verify($password, $row_LoginRS['Password'])) {
     $loginStrGroup = "";

	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	  $_SESSION['MM_idAdmin'] = $row_LoginRS["Id"];
	  $_SESSION['MM_id'] = $row_LoginRS["Id"];
    $_SESSION['tipo']=$row_LoginRS["tipo"];
    $_SESSION['audio']=$loginUsername;

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
    }
    require_once('log.php');
    $nombreUsuario = loginlog( $_SESSION['MM_Username']);
    header("Location: " . $MM_redirectLoginSuccess );
  }
  ///contraseña incorrecta
}//ALTA/BAJA
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="css/estilosadmin.css" rel="stylesheet" type="text/css">
 <!--<link href="https://allfont.es/allfont.css?fonts=agency-fb" rel="stylesheet" type="text/css" />-->
<link href="../fontawesome/css/all.css" rel="stylesheet">


<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      var icono1 = document.getElementById("iconpass");
      var icono2 = document.getElementById("ocultar_pass");
      if(tipo.type == "password"){
          tipo.type = "text";
          icono1.style="display:none";
          icono2.style="display:block";

      }else{
          tipo.type = "password";
          icono1.style="display:auto";
          icono2.style="display:none";
      }
  }
</script>
<script type="text/javascript">
console.log('Usuario no detectado');
  //alert("Usuario no detectado");
</script>
</head>

<body>
  <?php $logo=logocorreas(); ?>
  <header>
    <div class="cont-header">
    <div class="fondo">
      <img src="../img/header.png" alt="" title="logotipo" height="120px" width="100%">
    </div>
    <div class="logo">
      <img src="../img/<?php echo $logo ?>" alt="" title="logotipo" >
    </div>
      </div>

  </header>
  <div class="error">
  <h3>Error de acceso revisa que tus datos sean correctos</h3>
  </div>
  <div class="contenido">
    <div class="targeta">
      <div class="transparencia">

        </div>
      <form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" id="form1">
        <h2>Administración Autoservicio Correa´s</h2>
          <label for=""> <i class="fas fa-user"></i> Usuario</label>
            <br>
          <input type="Text" name="Email"  size="32" placeholder="hola@gmail.com / Nombre completo" required title="E-mail"/>
            <br>
          <label for="password"> <i class="fas fa-key"></i> Password</label>
          <br>
          <div class="con_pass">
            <input class="form-control" type="password" name="Password" id="password" required title="Contraseña" class="form-control"/>
            <button  type="button" onclick="mostrarContrasena()" id="mstrpass"><i class="fa fa-eye" id="iconpass"></i><i class="fa fa-eye-slash" id="ocultar_pass"></i> </button>
          </div>
          <br>
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <div class="recordPass">
            <a href=""><i class="fas fa-unlock-alt"></i> Olvide mi contraseña</a>
          </div>
          <td><button type="submit" id="btnIngresar">Ingresar</bottom></td>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>

  </div><!--Fin Targeta-->


</div><!--Fin contenido-->
<footer>
  <div class="logo">
    <img src="../img/logo.png" alt="" title="logotipo" >
  </div>
  <div id="copyright">
    Copyright&nbsp&copy;&nbsp;2021 - Todos los derechos reservados</div>
</footer>
</body>
</html>