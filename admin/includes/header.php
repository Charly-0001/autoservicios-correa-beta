
<?php
/*INFORMACION DE LA PAGINA*/
$query_info = "SELECT * FROM sitio_web";
$info = mysqli_query($conexion2,$query_info) or die(mysqli_error($conexion2));
$row_info = mysqli_fetch_assoc($info);
$totalRows_info = mysqli_num_rows($info);
 ?>
<div class="cont-header">
<div class="fondo">
  <img src="../img/header.png" alt="" title="logotipo" height="120px" width="100%">
</div>
<div class="logo">
  <img src="../img/<?php echo $row_info['Logo']?>" alt="" title="logotipo" >
</div>
<?php include("menu.php"); ?>
<?php include("includes/usuario.php"); ?>
  </div>

  <!--  <script src="http://localhost:35729/livereload.js" charset="utf-8">//Plugin para poder correr la web en tiempo real
    </script>-->
