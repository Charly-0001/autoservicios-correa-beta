<?php require_once('../Connections/conexion2.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
global $conexion2;
  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conexion2,$theValue) : mysqli_escape_string($conexion2,$theValue);

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

if ((isset($_GET['Id'])) && ($_GET['Id'] != "")) {

  $query_producto = sprintf("SELECT * FROM productos_servicios WHERE productos_servicios.Id=%s",GetSQLValueString(base64_decode($_GET['Id']),"int"));
  $producto = mysqli_query($conexion2,$query_producto ) or die(mysqli_error($conexion2));
  $row_producto = mysqli_fetch_assoc($producto);
  $totalRows_producto = mysqli_num_rows($producto);

  $dir="../imagenes/Servicios/".$row_producto['Imagen']; //ubicación en el host (EJ, /imagenes/foto.jpg)
  if(file_exists($dir)) //verifica que el archivo existe
   {
   if(unlink($dir)) // si es true, llama la función
  echo "El archivo fue borrado";
   }
  else{
   echo "Este archivo no existe";} //si no, lo avisa.

  $deleteSQL = sprintf("DELETE FROM productos_servicios WHERE
    productos_servicios.Id=%s",GetSQLValueString(base64_decode($_GET['Id']),"int"));


  $Result1 = mysqli_query($conexion2,$deleteSQL) or die(mysqli_error($conexion2));

  $deleteGoTo = "cat_servicios.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
