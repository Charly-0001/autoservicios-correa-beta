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

//LISTA DE SERVICIOS
$query_servicios = "SELECT * FROM productos_servicios WHERE productos_servicios.Tipo='Servicio' ORDER BY productos_servicios.id ASC";
$servicios = mysqli_query($conexion2,$query_servicios) or die(mysqli_error($conexion2));
$row_servicios = mysqli_fetch_assoc($servicios);
$totalRows_servicios = mysqli_num_rows($servicios);


//LISTA DE PRODUCTOS
$query_productos = "SELECT * FROM productos_servicios WHERE productos_servicios.Tipo='producto' ORDER BY productos_servicios.id ASC";
$productos = mysqli_query($conexion2,$query_productos) or die(mysqli_error($conexion2));
$row_productos = mysqli_fetch_assoc($productos);
$totalRows_productos = mysqli_num_rows($productos);
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Servicios</title>
<link href="img/logo.ico" rel="icon" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="css/slideshow.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/colorbox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/carousel.css" media="screen" />
<link rel="stylesheet" href="css/shadowbox.css">
<link href="fontawesome/css/all.css" rel="stylesheet">
<!-- CSS Part End-->
<!-- JS Part Start-->
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/tabs.js"></script>
<script type="text/javascript" src="js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="js/cloud_zoom.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery.dcjqaccordion.js"></script>


<!-- JS Part End-->
</head>
<body>

  <header>
    <?php include("includes/header.php"); ?>
  </header>

  <div class="contenido">
    <div class="Cat-servis">
      <h1>Catalogo <b>De Servicios</b></h1>
        <?php do { ?>
          <div class="cont-servis">
            <input type="button" value="Reservar" onClick=location.href='reserva_wat_bd.php?id=<?php echo $row_servicios['Id']; ?>' class="button" />
        <a href="reservar.php?id=<?php echo $row_servicios['Id']; ?>"><img src="imagenes/Servicios/<?php echo $row_servicios['Imagen']; ?>" alt="<?php echo $row_servicios['Nombre']; ?>"/></a>

          <p><a href="reserva.php?id=<?php echo $row_servicios['Id']; ?>"><?php echo $row_servicios['Nombre']; ?></a></p>


          </div>
          <?php } while ($row_servicios = mysqli_fetch_assoc($servicios)); ?>


</div>
<hr style="width:96%; border:none;">
<div class="product">
    <h1>Productos que te <b>Pueden Interesar</b> </h1>
        <?php do { ?>
          <div class="cont-produc">
        <a href="reservar.php?id=<?php echo $row_productos['Id']; ?>"><img src="imagenes/productos/<?php echo $row_productos['Imagen']; ?>" alt="<?php echo $row_productos['Nombre']; ?>"/></a>

          <h3><?php echo $row_productos['Nombre']; ?></h3>
          <p><?php echo $row_productos['Descripcion_corta']; ?> </p>


          </div>
          <?php } while ($row_productos = mysqli_fetch_assoc($productos)); ?>

        </div>
  </div>


    <?php
    mysqli_fetch_assoc($productos);
    ?>
<hr style="width:96%; border:none;">
  <footer>
    <?php include("includes/footer.php");?>
  </footer>
</body>
</html>
