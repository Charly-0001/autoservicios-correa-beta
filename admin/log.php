<?php require_once('../Connections/conexion2.php'); ?>
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
<?php



function getRealIP()
{

    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }

}



//log de acceso a la web
function initlog()
{
	global $database_conexion2, $conexion2;
$Nombre="initlog";
$Tipo="sistema";

$ip=getRealIP();
$user=gethostname();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$page= "URL-" . $host . $url;
$ubicacion=$ip.'-'.$user.'-'.$page;

$descripcion="Acceso a la web-".$user;

	$query_loginlog = sprintf("INSERT INTO logs (Fecha,Nombre_log,Tipo,Ubicacion,Descripcion)
                                    VALUES (NOW(),%s,%s,%s,%s)",
                       GetSQLValueString($Nombre, "text"),
                       GetSQLValueString($Tipo, "text"),
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($descripcion, "text"));
	$loginlog = mysqli_query( $conexion2,$query_loginlog) or die(mysqli_error());


	mysqli_free_result($ConsultaFuncion);
}
//log de Cerrar cecion
function serrarlog()
{
	global $database_conexion2, $conexion2;
$Nombre="close-User";
$Tipo="sistema";

$ip=getRealIP();
$user=gethostname();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$page= "URL-" . $host . $url;
$ubicacion=$ip.'-'.$user.'-'.$page;

$descripcion="Secion serrada-".$user;

	$query_loginlog = sprintf("INSERT INTO logs (Fecha,Nombre_log,Tipo,Ubicacion,Descripcion)
                                    VALUES (NOW(),%s,%s,%s,%s)",
                       GetSQLValueString($Nombre, "text"),
                       GetSQLValueString($Tipo, "text"),
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($descripcion, "text"));
	$loginlog = mysqli_query( $conexion2,$query_loginlog) or die(mysqli_error());
	mysqli_free_result($ConsultaFuncion);

}

//log de registro de servicio/producto
function createlog($tipo,$nombre)
{
	global $database_conexion2, $conexion2;
$Nombre="createlog";
$Tipo="servidor";

$ip=getRealIP();
$user=gethostname();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$page= "URL-" . $host . $url;
$ubicacion=$ip.'-'.$user.'-'.$page;

$descripcion="Registro de ".$tipo.'::'.$nombre;

	$query_loginlog = sprintf("INSERT INTO logs (Fecha,Nombre_log,Tipo,Ubicacion,Descripcion)
                                    VALUES (NOW(),%s,%s,%s,%s)",
                       GetSQLValueString($Nombre, "text"),
                       GetSQLValueString($Tipo, "text"),
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($descripcion, "text"));
	$loginlog = mysqli_query( $conexion2,$query_loginlog) or die(mysqli_error());

echo '<script type="text/javascript">console.log("Producto registrado");</script>';
	mysqli_free_result($ConsultaFuncion);
}

//log de modificacion de servicio/producto
function editlog($tipo,$id,$nombre)
{
	global $database_conexion2, $conexion2;
$Nombre="editlog";
$Tipo="servidor";

$ip=getRealIP();
$user=gethostname();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$page= "URL-" . $host . $url;
$ubicacion=$ip.'-'.$user.'-'.$page;

$descripcion="Actualizacion del ".$tipo.'::'.$id.'::'.$nombre;

	$query_loginlog = sprintf("INSERT INTO logs (Fecha,Nombre_log,Tipo,Ubicacion,Descripcion)
                                    VALUES (NOW(),%s,%s,%s,%s)",
                       GetSQLValueString($Nombre, "text"),
                       GetSQLValueString($Tipo, "text"),
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($descripcion, "text"));
	$loginlog = mysqli_query( $conexion2,$query_loginlog) or die(mysqli_error());


	mysqli_free_result($ConsultaFuncion);
}

//log de eliminar
function deletelog($tipo,$id,$nombre)
{
	global $database_conexion2, $conexion2;
$Nombre="deletelog";
$Tipo="servidor";

$ip=getRealIP();
$user=gethostname();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$page= "URL-" . $host . $url;
$ubicacion=$ip.'-'.$user.'-'.$page;

$descripcion="Eliminación de ".$tipo.'::'.$id.'::'.$nombre;

	$query_loginlog = sprintf("INSERT INTO logs (Fecha,Nombre_log,Tipo,Ubicacion,Descripcion)
                                    VALUES (NOW(),%s,%s,%s,%s)",
                       GetSQLValueString($Nombre, "text"),
                       GetSQLValueString($Tipo, "text"),
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($descripcion, "text"));
	$loginlog = mysqli_query( $conexion2,$query_loginlog) or die(mysqli_error());

echo '<script type="text/javascript">console.log("Eliminacion de información");</script>';
	mysqli_free_result($ConsultaFuncion);
}

//log de acceso administrativo
function loginlog($admin)
{
	global $database_conexion2, $conexion2;
$Nombre="loginlog";
$Tipo="sistema";

$ip=getRealIP();
$user=gethostname();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$page= "URL-" . $host . $url;
$ubicacion=$ip.'-'.$user.'-'.$page;

$descripcion="Acceso al sistema-".$admin;

	$query_loginlog = sprintf("INSERT INTO logs (Fecha,Nombre_log,Tipo,Ubicacion,Descripcion)
                                    VALUES (NOW(),%s,%s,%s,%s)",
                       GetSQLValueString($Nombre, "text"),
                       GetSQLValueString($Tipo, "text"),
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($descripcion, "text"));
	$loginlog = mysqli_query( $conexion2,$query_loginlog) or die(mysqli_error());
echo '<script type="text/javascript">console.log("Acceso correcto");</script>';

	//return $mensaje;
	mysqli_free_result($ConsultaFuncion);
}


//log de Error de acceso
function errorlog($admin)
{
	global $database_conexion2, $conexion2;
$Nombre="errorlog";
$Tipo="sistema";

$ip=getRealIP();
$user=gethostname();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$page= "URL-" . $host . $url;
$ubicacion=$ip.'-'.$user.'-'.$page;

$descripcion="Error de acceso al sistema-".$admin;

	$query_loginlog = sprintf("INSERT INTO logs (Fecha,Nombre_log,Tipo,Ubicacion,Descripcion)
                                    VALUES (NOW(),%s,%s,%s,%s)",
                       GetSQLValueString($Nombre, "text"),
                       GetSQLValueString($Tipo, "text"),
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($descripcion, "text"));
	$loginlog = mysqli_query( $conexion2,$query_loginlog) or die(mysqli_error());
echo '<script type="text/javascript">console.log("Error de acceso al sistema");</script>';

	mysqli_free_result($ConsultaFuncion);
}

//log de envio de correos
function emaillog($email)
{
	global $database_conexion2, $conexion2;
$Nombre="emaillog";
$Tipo="sistema";

$ip=getRealIP();
$user=gethostname();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$page= "URL-" . $host . $url;
$ubicacion=$ip.'-'.$user.'-'.$page;

$descripcion="envio de correo-".$email;

	$query_loginlog = sprintf("INSERT INTO logs (Fecha,Nombre_log,Tipo,Ubicacion,Descripcion)
                                    VALUES (NOW(),%s,%s,%s,%s)",
                       GetSQLValueString($Nombre, "text"),
                       GetSQLValueString($Tipo, "text"),
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($descripcion, "text"));
	$loginlog = mysqli_query( $conexion2,$query_loginlog) or die(mysqli_error());
echo '<script type="text/javascript">console.log("Envio de Email");</script>';

	mysqli_free_result($ConsultaFuncion);
}

//log de envio de whatsaps
function whatsaplog($phone)
{
	global $database_conexion2, $conexion2;
$Nombre="emaillog";
$Tipo="sistema";

$ip=getRealIP();
$user=gethostname();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$page= "URL-" . $host . $url;
$ubicacion=$ip.'-'.$user.'-'.$page;

$descripcion="envio de correo-".$phone;

	$query_loginlog = sprintf("INSERT INTO logs (Fecha,Nombre_log,Tipo,Ubicacion,Descripcion)
                                    VALUES (NOW(),%s,%s,%s,%s)",
                       GetSQLValueString($Nombre, "text"),
                       GetSQLValueString($Tipo, "text"),
                       GetSQLValueString($ubicacion, "text"),
                       GetSQLValueString($descripcion, "text"));
	$loginlog = mysqli_query( $conexion2,$query_loginlog) or die(mysqli_error());
echo '<script type="text/javascript">console.log("Envio de whatsapp");</script>';

	mysqli_free_result($ConsultaFuncion);
}

?>
