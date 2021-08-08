<?php require_once('Connections/conexion2.php'); ?><!--INSTANCIAMOS LA CONEXION-->
<?php
/*INFORMACION DE LA PAGINA*/
$query_info = "SELECT * FROM sitio_web";
$info = mysqli_query($conexion2,$query_info) or die(mysqli_error($conexion2));
$row_info = mysqli_fetch_assoc($info);
$totalRows_info = mysqli_num_rows($info);
 ?>

<div class="cont-header">
<div class="fondo">
  <img src="img/header.png" alt="" title="logotipo" height="120px" width="100%">
</div>
<div class="logo">
  <img src="img/<?php echo $row_info['Logo']?>" alt="" title="logotipo" >
</div>
<div class="redesSociales">
  <a href="https://www.facebook.com/FasTi-351733776019239"> <img src="img/facebook.png" alt="facebook"></a>
  <a href="https://api.whatsapp.com/send?phone=524411010082&text=¡Hola que tal!" black> <img src="img/whatsApp.png" alt=""></a>
</div>
<?php include("menu.php"); ?>
  </div>
  <!--<script src="http://localhost:35729/livereload.js" charset="utf-8">//Plugin para poder correr la web en tiempo real -->
  </script>
