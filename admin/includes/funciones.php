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
function ObtenerNombreUsuario($id)
{
	global $database_conexion2, $conexion2;

	$query_ConsultaFuncion = sprintf("SELECT * FROM administracion WHERE administracion.Id= %s", $id);

	$ConsultaFuncion = mysqli_query( $conexion2,$query_ConsultaFuncion) or die(mysqli_error());
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);

	return $row_ConsultaFuncion['Nombre_completo'];
	mysqli_free_result($ConsultaFuncion);
}
//********************************************************
//*********************************************************
function logocorreas(){
  global $database_conexion2, $conexion2;

	$query_ConsultaLogo = sprintf("SELECT * FROM sitio_web");

	$ConsultaLogo = mysqli_query( $conexion2,$query_ConsultaLogo) or die(mysqli_error());
	$row_ConsultaLogo = mysqli_fetch_assoc($ConsultaLogo);
	$totalRows_ConsultaLogo = mysqli_num_rows($ConsultaLogo);

	return $row_ConsultaLogo['Logo'];
	mysqli_free_result($ConsultaLogo);
}
?>
