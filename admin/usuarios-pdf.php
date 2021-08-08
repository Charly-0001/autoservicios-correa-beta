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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$p = "0";
if (isset($_GET["p"])) {
  $p =base64_decode( $_GET["p"]);
}



$query_perfil = sprintf("SELECT * FROM administracion WHERE administracion.Id=%s", GetSQLValueString($p, "int"));
$perfil = mysqli_query($conexion2,$query_perfil ) or die(mysqli_error($conexion2));
$row_perfil = mysqli_fetch_assoc($perfil);
$totalRows_perfilt = mysqli_num_rows($perfil);

//LISTA DE USUARIOS

$query_usuarios = "SELECT * FROM administracion ORDER BY administracion.Nombre_completo ASC ";
$usuarios = mysqli_query($conexion2,$query_usuarios) or die(mysqli_error($conexion2));
$row_usuarios = mysqli_fetch_assoc($usuarios);
$totalRows_usuarios = mysqli_num_rows($usuarios);

$query_sistema = "SELECT * FROM sitio_web ";
$sistema = mysqli_query($conexion2,$query_sistema) or die(mysqli_error($conexion2));
$row_sistema = mysqli_fetch_assoc($sistema);
$totalRows_sistema = mysqli_num_rows($sistema);



require('fpdf/fpdf.php');
$pdf=new FPDF('L','pt','Letter');//lo que estamos haciendo es crear el objeto FPDF
$pdf->AddPage();//añadimos una página.
$pdf->SetFont('Arial','',1);// le damos formato al texto diciendo el tipo de letra, si es en negrita o no, y el tamaño de la letra.
$pdf->ln(10); //Espacio de arriba hacia abajo

$pdf->SetDrawColor(232,246,251);//Colocar color
$pdf->SetLineWidth(110);//ancho de la linea
$pdf->Line(0,10,750,10);//Margen izquierdo,Espacio en x izquierdo,tamaño de la linea, espacio en x derecho
$pdf->Image('../img/'.$row_sistema['Logo'],30,10,100);
$pdf->Cell(300,0,'-');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(300,10,'Lista de Usuarios');//empezamos a escribir el contenido de la página. Empezamos diciendo el ancho de la celda donde vamos a escribir, el alto de la celda, y el contenido de la celda.
$pdf->ln(10);

$pdf->SetFont('Arial','',12);
$pdf->Cell(59,50,'Usuario:');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(200,50,$row_perfil['Nombre_completo']);

$pdf->ln(15);
$pdf->SetFont('Arial','',12);
$pdf->Cell(52,50,'Tipo:');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(600,50,$row_perfil['tipo']);


$pdf->SetFont('Arial','',12);
$pdf->Cell(45,50,'Total:');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,50,$totalRows_usuarios);

$pdf->ln(15);//salto de linea
$pdf->ln(15);//salto de linea
$pdf->SetFillColor(0,0,0);
$pdf->Cell(200,60,'Nombre');
$pdf->Cell(170,60,'Email');
$pdf->Cell(80,60,'Tel.');
$pdf->Cell(70,60,'Estado');
$pdf->Cell(70,60,'Tipo');

$pdf->ln(20);//salto de linea con separacion entre linea y linea
$pdf->SetDrawColor(61,174,233);//Colocar color
$pdf->SetLineWidth(2);//ancho de la linea
$pdf->Line(30,130,750,130);//Margen izquierdo,Espacio en x izquierdo,tamaño de la linea, espacio en x derecho



foreach ($usuarios as $row_usuarios) {
  $pdf->SetFont('Arial','',12);
  $pdf->SetFillColor(0,0,0);
  $pdf->Cell(200,60,$row_usuarios['Nombre_completo']);
  $pdf->Cell(170,60,$row_usuarios['Email']);
  $pdf->Cell(80,60,$row_usuarios['phone']);
  $pdf->Cell(70,60,$row_usuarios['estado']);
  $pdf->Cell(70,60,$row_usuarios['tipo']);
  $pdf->ln(15);

}



$pdf->Output('prueba','I');//lo que hace es cerrar el archivo y enviarlo al navegador.



?>
