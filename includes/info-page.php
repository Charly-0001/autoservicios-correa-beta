<?php require_once('Connections/conexion2.php'); ?>
<?php
/*INFORMACION DE LA PAGINA*/
$query_info = "SELECT * FROM sitio_web";
$info = mysqli_query($conexion2,$query_info) or die(mysqli_error($conexion2));
$row_info = mysqli_fetch_assoc($info);
$totalRows_info = mysqli_num_rows($info);
?>
