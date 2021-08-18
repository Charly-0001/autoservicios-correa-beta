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

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
  // For security, start by assuming the visitor is NOT authorized.
  $isValid = False;


  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username.
  // Therefore, we know that a user is NOT logged in if that Session variable is blank.
  if (!empty($UserName)) {
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login.
    // Parse the strings into arrays.
    $arrUsers = Explode(",", $strUsers);
    $arrGroups = Explode(",", $strGroups);
    if (in_array($UserName, $arrUsers)) {
      $isValid = true;
    }
    // Or, you may restrict access to only certain users based on their username.
    if (in_array($UserGroup, $arrGroups)) {
      $isValid = true;
    }
    if (($strUsers == "") && true) {
      $isValid = true;
    }
  }
  return $isValid;
}
$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0)
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo);
  exit;
}

/*termino de validacion para no entrar a utras paginas con la url*/
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

/*INFORMACION DE LA PAGINA*/
$query_info = "SELECT * FROM sitio_web";
$info = mysqli_query($conexion2,$query_info) or die(mysqli_error($conexion2));
$row_info = mysqli_fetch_assoc($info);
$totalRows_info = mysqli_num_rows($info);



/*//////////////////////////////////////////ACTUALIZAR INFORMACION/////////////////*/
/*/////////////////////////////////////////////////////////////////////*/


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit_generales")) {

$newlogo=$_FILES ["imagen"]["name"];
if($newlogo==""){
  $newlogo=$row_info['Logo'];
}
else{
  $dir="../img/".$row_info['Logo']; //ubicación en el host (EJ, /imagenes/foto.jpg)
  if(file_exists($dir)) //verifica que el archivo existe
   {
   if(unlink($dir)){ // si es true, llama la función
  //echo "El archivo fue borrado";
   }
   }
  else{
   echo "Este archivo no existe";} //si no, lo avisa.

   $newlogo=$_FILES ["imagen"]["name"];
    move_uploaded_file ($_FILES ["imagen"]["tmp_name"],"../img/".$newlogo);
  }
$horaAtencion='';
if($_POST['init']!="" and $_POST['end']!=""){
  $horarioInit=$_POST['init'];
  $horarioEnd=$_POST['end'];
  $horaAtencion='De '.$horarioInit.' - '.$horarioEnd;
}
else{
  $horaAtencion=$row_info['Horario_atencion'];
}
$email=$_POST['email'];
$empresa_actual=$row_info['Nombre_Empresa'];
$empresa=$_POST['nombre'];



  $updateSQL = sprintf("UPDATE sitio_web SET
    Ubicacion=%s,Horario_atencion=%s,Email=%s,
      Nombre_Empresa=%s, Logo=%s, facebook=%s,whatsap=%s
      WHERE Nombre_Empresa='$empresa_actual' ",
      GetSQLValueString($_POST['ubicacion'],"text"),
      GetSQLValueString($horaAtencion, "text"),
      GetSQLValueString($email, "text"),
      GetSQLValueString($empresa, "text"),
      GetSQLValueString($newlogo,"text"),
      GetSQLValueString($_POST['facebook'], "text"),
      GetSQLValueString($_POST['whatsap'], "text"));


  $Result1 = mysqli_query($conexion2,$updateSQL) or die(mysqli_error($conexion2));

  $updateGoTo = 'siteupdate.php?';
  header(sprintf("Location: %s",$updateGoTo.'resultado='.'Actualizacion-correcta'));
}

/*//////////////////////////////////////////ACTUALIZAR BANNERS/////////////////*/
/*/////////////////////////////////////////////////////////////////////*/


if ((isset($_POST["MM_updateBanner"])) && ($_POST["MM_updateBanner"] == "edit_banners")) {

$id_empresa=$row_info['id'];

$newBaner_1=$_FILES ["banner_1"]["name"];
if($newBaner_1==""){
  $newBaner_1=$row_info['Banner_1'];
}
else{
  $dir="../img/banner/".$row_info['Banner_1']; //ubicación en el host (EJ, /imagenes/foto.jpg)
  if(file_exists($dir)) //verifica que el archivo existe
   {
   if(unlink($dir)){ // si es true, llama la función
  //echo "El archivo fue borrado";
   }
   }
  else{
   echo "Este archivo no existe";} //si no, lo avisa.

   $newBaner_1="Banner-1".$_FILES ["banner_1"]["name"];
    move_uploaded_file ($_FILES ["banner_1"]["tmp_name"],"../img/banner/".$newBaner_1);
}


//BANER 2
$newBaner_2=$_FILES ["banner_2"]["name"];
if($newBaner_2==""){
  $newBaner_2=$row_info['Banner_2'];
}
else{
  $dir="../img/banner/".$row_info['Banner_2']; //ubicación en el host (EJ, /imagenes/foto.jpg)
  if(file_exists($dir)) //verifica que el archivo existe
   {
   if(unlink($dir)){ // si es true, llama la función
  //echo "El archivo fue borrado";
   }
   }
  else{
   echo "Este archivo no existe";} //si no, lo avisa.

   $newBaner_2="Banner-2".$_FILES ["banner_2"]["name"];
    move_uploaded_file ($_FILES ["banner_2"]["tmp_name"],"../img/banner/".$newBaner_2);
}

//BANER 3
$newBaner_3=$_FILES ["banner_3"]["name"];
if($newBaner_3==""){
  $newBaner_3=$row_info['Banner_3'];
}
else{
  $dir="../img/banner/".$row_info['Banner_3']; //ubicación en el host (EJ, /imagenes/foto.jpg)
  if(file_exists($dir)) //verifica que el archivo existe
   {
   if(unlink($dir)) {// si es true, llama la función
  //echo "El archivo fue borrado";
   }
   }
  else{
   echo "Este archivo no existe";} //si no, lo avisa.

   $newBaner_3="Banner-3".$_FILES ["banner_3"]["name"];
    move_uploaded_file ($_FILES ["banner_3"]["tmp_name"],"../img/banner/".$newBaner_3);
}


  $updateSQL = sprintf("UPDATE sitio_web SET
    Banner_1=%s,Banner_2=%s,Banner_3=%s WHERE sitio_web.id=$id_empresa",
      GetSQLValueString($newBaner_1,"text"),
      GetSQLValueString($newBaner_2,"text"),
      GetSQLValueString($newBaner_3,"text"));


  $Result1 = mysqli_query($conexion2,$updateSQL) or die(mysqli_error($conexion2));

  $updateGoTo = 'siteupdate.php?';
  header(sprintf("Location: %s",$updateGoTo.'resultado='.'Actualizacion-correcta-de-baners'));
}


//LISTA DE TIPS
$query_Tip = "SELECT * FROM tips  ORDER BY tips.id ASC";
$Tip = mysqli_query($conexion2,$query_Tip) or die(mysqli_error($conexion2));
$row_Tip = mysqli_fetch_assoc($Tip);
$totalRows_Tip = mysqli_num_rows($Tip);

//AGREGAR TIP
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addTip")) {


  $insertSQL = sprintf("INSERT INTO tips (Tip)
                                    VALUES (%s)",
                       GetSQLValueString($_POST['Tip'],"text"));

                       $Result1 = mysqli_query($conexion2,$insertSQL ) or die(mysqli_error($conexion2));
                       $insertGoTo = "siteupdate.php";
                       if (isset($_SERVER['QUERY_STRING']))
                       {
                         $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
                         $insertGoTo .= $_SERVER['QUERY_STRING'];
                       }
                       header(sprintf("Location: %s", $insertGoTo.'resultado=Registrado-correctamente'));


                     }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ventas</title>
<link href="../img/logo.ico" rel="icon" />
<link href="css/estilosadmin.css" rel="stylesheet" type="text/css" />
<link href="../fontawesome/css/all.css" rel="stylesheet">
<script type="text/javascript" src="js/update_site_web.js"></script>
</head>

<body>
  <header>
    <?php include("includes/header.php"); ?>
  </header>



  <div class="contenido">



<h1>Configuración Generales</h1>
  <button type="edid_generales" name="generales" id="abrir_generales" onclick="javascript:return mostrar();" title="Logotipo y redes sociales">Abrir Generales <i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
  <button  name="generales" id="cerrar_generales" onclick="javascript:return cerrar();" style="display:none;">Cerrar Generales <i class="fa fa-angle-double-up" aria-hidden="true"></i>
</button>
  <form class="logotipo" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="generales" id="generales" style="display:none;">
<ul>
  <h3 style="color:#000;text-align:left;">Logotipo</h3>
  <img src="../img/<?php echo $row_info['Logo']?> " alt="" style="height:80px; float:left; cursor:pointer;"onclick="document.getElementById('imagen').click()" title="Actualizar logo">
  <hr style="width:96%; border:none;">
  <input type="file" name="imagen"id="imagen" placeholder="Imagen" title="Seleciona una imagen del producto" value="<?php echo $row_info['logo']?>" style="display:none;">

<div class="informacionEmpresa">
  <div class="nombre">
    <label for="empresa">Empresa</label>
    <input type="text" name="nombre" value="<?php echo $row_info['Nombre_Empresa']?>">
  </div>
  <div class="Correo">
    <label for="correo">Correo</label>
    <input type="email" name="email" value="<?php echo $row_info['Email']?>">
  </div>
  <div class="ubicacion">
    <label for="ubicacion">Ubicacion</label>
    <input type="text" name="ubicacion" value="<?php echo $row_info['Ubicacion']?>">
  </div>
  <div class="whatsap">
    <label for="whatsap">Whatsapp</label>
    <input type="phone" name="whatsap" value="<?php echo $row_info['whatsap']?>">
  </div>
  <div class="facebook">
    <label for="facebook">Facebook</label>
    <input type="link" name="facebook" value="<?php echo $row_info['facebook']?>">
  </div>
  <div class="horadioatencion">
    <label for="horario">Horario de Atención <?php echo $row_info['Horario_atencion']?> </label>
    <input type="time" name="init" value="">
    <input type="time" name="end" value="">
  </div>
</div>

    <button type="submit" class="btn_Guardar"><i class="fas fa-check"></i> Guardar</button>
    <input type="hidden" name="MM_update" value="edit_generales">

</ul>
</form>
<hr style="width:96%; border:none;">


<h1>Configuración Avanzada</h1>
  <button type="edid_avanzada" name="avanzada" id="abrir_avanzada" onclick="javascript:return mostrarAvanzada();" title="Baners y Tips">Abrir Avanzada <i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
  <button  name="avanzada" id="cerrar_avanzada" onclick="javascript:return cerrarAvanzada();" style="display:none;">Cerrar Avanzada <i class="fa fa-angle-double-up" aria-hidden="true"></i>
</button>
<hr style="width:96%; border:none;">

  <div class="Banners">
    <form class="banners" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="avazada" id="avanzada" style="display:none;">
    <ul>
  <h3 style="color:#000;text-align:left;">Banner 1</h3>
  <img src="../img/banner/<?php echo $row_info['Banner_1']?> " alt="" style="height:100px; float:left; cursor:pointer;"onclick="document.getElementById('banner_1').click()" title="Actualizar Banner 1">
  <hr style="width:96%; border:none;">
  <input type="file" name="banner_1"id="banner_1"  title="Seleciona un banner de 1400 X 500px" value="<?php echo $row_info['Banner_1']?>" style="display:none;">

  <h3 style="color:#000;text-align:left;">Banner 2 </h3>
  <img src="../img/banner/<?php echo $row_info['Banner_2']?> " alt="" style="height:100px; float:left; cursor:pointer;"onclick="document.getElementById('banner_2').click()" title="Actualizar Banner 2">
  <hr style="width:96%; border:none;">
  <input type="file" name="banner_2"id="banner_2"  title="Seleciona un banner de 1400 X 500px" value="<?php echo $row_info['Banner_1']?>" style="display:none;">

  <h3 style="color:#000;text-align:left;">Banner 3 </h3>
  <img src="../img/banner/<?php echo $row_info['Banner_3']?> " alt="" style="height:100px; float:left; cursor:pointer;"onclick="document.getElementById('banner_3').click()" title="Actualizar Banner 3">
  <hr style="width:96%; border:none;">
  <input type="file" name="banner_3"id="banner_3"  title="Seleciona un banner de 1400 X 500px" value="<?php echo $row_info['Banner_1']?>" style="display:none;">

  <button type="submit" class="btn_Guardar"><i class="fas fa-check"></i> Guardar</button>
  <input type="hidden" name="MM_updateBanner" value="edit_banners">

</ul>
</form>
</div>

<div id="Tips" style="display:none;">
  <h1>Tips para el cliente</h1>
  <button class="btn-abrir-popup"  id="btn-abrir-popup" ><i class="fas fa-plus"></i> </button>
<hr style="width:96%; border:none;">
<div class="Lista_Tips">
  <table>

  <?php do { ?>
    <tr>
      <td>
        <p><?php echo $row_Tip['Tip']?></p>
      </td>
      <td>
          <a <?php if($_SESSION['tipo']=="Master"){ ?> href="tips_delete.php?Tip=<?php echo base64_encode($row_Tip['Id']); ?>"onClick="javascript:return eliminar();" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?> ><i class="fas fa-trash" style="color:red; float: right; "></i> </a>
      </td>

    </tr>

          <?php } while ($row_Tip = mysqli_fetch_assoc($Tip)); ?>
      </div>
    </div>
</table>
</div>

</div>

<!--FORMULARIO ADD-PRODUCTO EMERGENTE-->
<div class="overlay" id="overlay">
			<div class="popup" id="popup">

				<h1>+ TIP</h1>
				<form action="<?php echo $editFormAction; ?>"  method="post" name="addTip" id="addTip">
					<div class="contenedor-inputs">

            <label for="Tip">Tip</label>
            <textarea name="Tip" rows="4" style="width:96%;"></textarea>
            <br>

					</div>
          <a href="" id="btn-cerrar-popup"><button type="button" class="btn-submit"><i class="fas fa-times"></i> Cancelar</button></a>
					<button type="submit" class="btn-submit"><i class="fas fa-check"></i> Guardar</button>
          <input type="hidden" name="MM_insert" value="addTip" />
				</form>
			</div>
		</div>

    <script src="js/popup.js"></script>


<hr style="width:96%; border:none;">

  </div>

  <footer>
    <div class="logo">
      <img src="../img/logo.png" alt="" title="logotipo" >
    </div>
    <div id="copyright">
      Copyright&nbsp&copy;&nbsp;2021 - Todos los derechos reservados</div>
  </footer>

</body>
</html>
