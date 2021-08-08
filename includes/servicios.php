<?php require_once('Connections/conexion2.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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

$maxRows_servicios = 6;
$pageNum_servicios = 0;
if (isset($_GET['pageNum_servicios'])) {
  $pageNum_servicios = $_GET['pageNum_servicios'];
}
$startRow_servicios = $pageNum_servicios * $maxRows_servicios;


$query_servicios = "SELECT * FROM productos_servicios WHERE Tipo='servicio' ORDER BY RAND()";
$query_limit_servicios = sprintf("%s LIMIT %d, %d", $query_servicios, $startRow_servicios, $maxRows_servicios);
$servicios = mysqli_query($conexion2,$query_limit_servicios ) or die(mysql_error($conexion2));
$row_servicios = mysqli_fetch_assoc($servicios);
$totalRows_servicios = mysqli_num_rows($servicios);
if (isset($_GET['totalRows_servicios'])) {
  $totalRows_servicios = $_GET['totalRows_servicios'];
} else {

}
$totalPages_servicios = ceil($totalRows_servicios/$maxRows_servicios)-1;
?>

        <div class="publicidad_servis">
            <?php do { ?>
              <div class="cont-servis">
                <input type="button" value="Reservar" onClick=location.href='reserva_wat_bd.php?id=<?php echo $row_servicios['id']; ?>' class="button" />
            <a href="reservar.php?id=<?php echo $row_servicios['id']; ?>"><img src="imagenes/servicios/<?php echo $row_servicios['Imagen']; ?>" alt="<?php echo $row_servicios['Nombre']; ?>"/></a>

              <p><a href="reserva.php?id=<?php echo $row_servicios['id']; ?>"><?php echo $row_servicios['Nombre']; ?></a></p>


              </div>
              <?php } while ($row_servicios = mysqli_fetch_assoc($servicios)); ?>

            </div>

<?php
mysqli_free_result($servicios);
?>
