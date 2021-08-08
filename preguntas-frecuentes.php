
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

  <!-- Header Parts Start-->
<div class="contenido">
  <div class="preguntas-header">
    <h2>Preguntas frecuentes</h2>
    <h1>¿Cómo podemos ayudarte?</h1>
    <div id="buscador_form">
    <form name="form1"  action="buscar-pregunta" id="cdr">
    <input name="busca" type="text" placeholder="Buscar pregunta"  id="busqueda">
    <button type="submit" name="buscar"><i class="fa fa-search" aria-hidden="true"></i> </button>
    </form>
    </div>
  </div>

  <div class="cont-preguntas">
    <h2>Aquí puedes ver las preguntas más frecuentes.</h2>
    <div class="pregunta-1">
      <h4>¿Qué promociones tienen actualmente?</h4><i class="fa fa-angle-double-down" aria-hidden="true" id="abrir-respuesta-1"></i>
      <div class="respuesta">
        <ul>
          <li>Oferta 1</li>
          <li>Oferta 2</li>
        </ul>
      </div>
    </div>

    <div class="pregunta-1">
      <h4>¿Cuales bujías son mejores?</h4><i class="fa fa-angle-double-down" aria-hidden="true" id="abrir-respuesta-1"></i>
      <div class="respuesta">
        <ul>
          <li>Oferta 1</li>
          <li>Oferta 2</li>
        </ul>
      </div>
    </div>

    <div class="pregunta-1">
      <h4>¿Cuanto dura una bujía de platino?</h4><i class="fa fa-angle-double-down" aria-hidden="true" id="abrir-respuesta-1"></i>
      <div class="respuesta">
        <ul>
          <li>Oferta 1</li>
          <li>Oferta 2</li>
        </ul>
      </div>
    </div>


    <div class="pregunta-1">
      <h4>¿Cuando debo afinar mi vehiculo?</h4><i class="fa fa-angle-double-down" aria-hidden="true" id="abrir-respuesta-1"></i>
      <div class="respuesta">
        <ul>
          <li>Oferta 1</li>
          <li>Oferta 2</li>
        </ul>
      </div>
    </div>

    <div class="pregunta-1">
      <h4>¿Cuando devo cambiar el aceite del motor?</h4><i class="fa fa-angle-double-down" aria-hidden="true" id="abrir-respuesta-1"></i>
      <div class="respuesta">
        <ul>
          <li>Oferta 1</li>
          <li>Oferta 2</li>
        </ul>
      </div>
    </div>

    <div class="pregunta-1">
      <h4>¿Cuando devo cambiar el aceite de transmision?</h4><i class="fa fa-angle-double-down" aria-hidden="true" id="abrir-respuesta-1"></i>
      <div class="respuesta">
        <ul>
          <li>Oferta 1</li>
          <li>Oferta 2</li>
        </ul>
      </div>
    </div>

    <div class="pregunta-1">
      <h4>¿Cuando debo cambier la suspención?</h4><i class="fa fa-angle-double-down" aria-hidden="true" id="abrir-respuesta-1"></i>
      <div class="respuesta">
        <ul>
          <li>Oferta 1</li>
          <li>Oferta 2</li>
        </ul>
      </div>
    </div>

    <div class="pregunta-1">
      <h4>¿Cuando debo cambiar las balatas?</h4><i class="fa fa-angle-double-down" aria-hidden="true" id="abrir-respuesta-1"></i>
      <div class="respuesta">
        <ul>
          <li>Oferta 1</li>
          <li>Oferta 2</li>
        </ul>
      </div>
    </div>


  </div>
</div>





<footer>
  <?php include("includes/footer.php");?>
</footer>
</body>
</html>
