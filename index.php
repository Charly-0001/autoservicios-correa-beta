
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title></title>
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
  <link href="https://allfont.es/allfont.css?fonts=agency-fb" rel="stylesheet" type="text/css" />

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
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5d31f5e35432b600120d5a43&product=custom-share-buttons"></script>

<!-- JS Part End-->
</head>
<body>
  <header>
    <?php include("includes/header.php"); ?>
  </header>

  <!-- Header Parts Start-->

<div class="contenido">
  <div class="banner">
<?php include("includes/slider.php"); ?>
  </div>
  <?php include("includes/llamar.php");?>

  <div class="targeta_home">
    <?php include("includes/targetas_home.php");?>
  </div>

<div class="por_que_nos_prefieren">
  <div class="conten">
    <h1>Por Que <b>Nos Prefieren</b> </h1>

    <div class="expertos">
      <div class="icon">
        <img src="img/iconos/mecanico.png" alt="">
      </div>
      <div class="text">
          <h2>Expertos <b>En Mecánica</b> </h2>
          <p>Actualizacion constante y capacitaciones de las nuevas tecnologias.</p>
      </div>
    </div>

    <div class="Rasonables">
      <div class="icon">
        <img src="img/iconos/dinero.png" alt="">
      </div>
      <div class="text">
          <h2>Precio <b>Razonables</b> </h2>
          <p>Ajustamos nuestros precios a tus nececidades recomendando lo mejor.</p>
      </div>
    </div>

    <div class="confianza">
      <div class="icon">
      <img src="img/iconos/dinero.png" alt="">
      </div>
      <div class="text">
          <h2>Confianza Con <b>El Cliente</b> </h2>
          <p>Recomendaciones y seguimiento para su veiculo.</p>
      </div>
    </div>

    <div class="rapidos">
      <div class="icon">
        <img src="img/iconos/velocidad.jpg" alt="">
      </div>
      <div class="text">
          <h2>Servicios <b>Rapidos</b> </h2>
          <p>Reserva en linea y opten fecha y hora evitando perder tu valioso tiempo</p>
      </div>
    </div>

  </div>
  <div class="imagen">
    <img src="img\prqnspfieren.png" alt="Autoserevicio_correa´s">
  </div>

</div>

<div class="banner">
  <div class="tips">
    <h1>Demuestra amor a tu veiculo</h1>
    <p>Tip 1</p>
    <p>Tip 2</p>
    <p>Tip 3</p>
  </div>
  <div class="fondo">
    <img src="img/proteje-tu-auto.png" alt="">
  </div>

</div>

  <h1>Servicios <b>Que Prestamos</b></h1>
<?php include("includes/servicios.php"); ?>
</div>


<hr style="width:96%; border:none;">
  <footer>
    <?php include("includes/footer.php");?>
  </footer>



</body>
</html>
