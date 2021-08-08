<?php require_once('Connections/conexion2.php'); ?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
  global $conexion2;
  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conexion2,$theValue) : mysqli_escape_string($conexion2, $theValue);

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


//***********************************************************
//***********************************************************
function OptenerNombreCategoria($identificador)
{
	
	global $conexion2;
	
	$query_ConsultaFuncion = sprintf("SELECT *FROM 24impulsojalpancat where 24impulsojalpancat.idCategorias=%s",$identificador);
	$ConsultaFuncion =mysqli_query ($conexion2,$query_ConsultaFuncion )or die (mysqli_error($conexion2));
	$row_ConsultaFuncion =mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre'] ;
	mysqli_free_result($ConsultaFuncion);
}

//***********************************************************
//***********************************************************
function ObtenerEstado($id)
{
	if($id==0)echo "Inactivo";
	if($id==1) echo "Activo"; 
}

?>
	
					
				
				