<?php require_once('../Connections/conexion2.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
   if (PHP_VERSION < 7) {
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

// *** Restringir el acceso a la página: conceda o deniegue el acceso a esta página
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
  // Por seguridad, comience asumiendo que el visitante NO está autorizado.
  $isValid = False;

  // Cuando un visitante inicia sesión en este sitio, la variable de sesión MM_Username se establece igual a su nombre de usuario.
  // Por lo tanto, sabemos que un usuario NO está conectado si esa variable de sesión está en blanco.
  if (!empty($UserName)) {
    // Además de iniciar sesión, puede restringir el acceso solo a ciertos usuarios en función de una identificación establecida cuando inician sesión.
    // Analice las cadenas en matrices.
    $arrUsers = Explode(",", $strUsers);
    $arrGroups = Explode(",", $strGroups);
    if (in_array($UserName, $arrUsers)) {
      $isValid = true;
    }
    // O puede restringir el acceso solo a ciertos usuarios según su nombre de usuario.
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


//LISTA DE SERVICIOS
$query_servicios = "SELECT * FROM productos_servicios WHERE productos_servicios.Tipo='servicio' ORDER BY productos_servicios.id ASC";
$servicios = mysqli_query($conexion2,$query_servicios) or die(mysqli_error($conexion2));
$row_servicios = mysqli_fetch_assoc($servicios);
$totalRows_servicios = mysqli_num_rows($servicios);

//AGREGAR SERVICIOS
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addservicios")) {

$imagen=$_FILES ["imagen"]["name"];
	move_uploaded_file ($_FILES ["imagen"]["tmp_name"],"../imagenes/Servicios/".$imagen);
  $Tipo="servicio";

  $insertSQL = sprintf("INSERT INTO productos_servicios (Codigo,Nombre,Precio,Stock,Stock_max,Stock_min,Codigo_proveedor,Descripcion_corta,Descripcion_larga,Duracion_minima,Imagen,Tipo,puntos)
                                    VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
                       GetSQLValueString("NULL", "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['precio'], "double"),
                       GetSQLValueString("NULL", "double"),
                       GetSQLValueString("NULL", "double"),
                       GetSQLValueString("NULL", "double"),
                       GetSQLValueString("NULL", "text"),
                       GetSQLValueString($_POST['descripcion_corta'],"text"),
                       GetSQLValueString($_POST['descripcion_larga'],"text"),
                       GetSQLValueString($_POST['duracion'],"int"),
                       GetSQLValueString($imagen,"text"),
                       GetSQLValueString($Tipo,"text"),
                      GetSQLValueString($_POST['puntos'],"int"));

                       $Result1 = mysqli_query($conexion2,$insertSQL ) or die(mysqli_error($conexion2));
                       $insertGoTo = "cat_servicios.php";
                       if (isset($_SERVER['QUERY_STRING']))
                       {
                         $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
                         $insertGoTo .= $_SERVER['QUERY_STRING'];
                       }
                       header(sprintf("Location: %s", $insertGoTo));
                     }


//BUSCADOR
$busca="";

if(isset ($_POST['busca'])){
$busca=$_POST['busca'];

$query_buscaservicio=("SELECT * FROM productos_servicios WHERE productos_servicios.Tipo='Servicio' AND productos_servicios.nombre Like '%".$busca."%'");

$buscaservicio=mysqli_query($conexion2,$query_buscaservicio) or die(mysqli_error($conexion2));
$row_buscaservicio = mysqli_fetch_assoc($buscaservicio);
$totalRows_buscaservicio = mysqli_num_rows($buscaservicio);
}


/*//////////////////////////////////////////ACTUALIZAR/////////////////*/
/*/////////////////////////////////////////////////////////////////////*/
$ID = "0";
if (isset($_GET["id"])) {
  $ID =base64_decode( $_GET["id"]);
}



$query_productoedit = sprintf("SELECT * FROM productos_servicios WHERE productos_servicios.Id=%s", GetSQLValueString($ID, "int"));
$productoedit = mysqli_query($conexion2,$query_productoedit ) or die(mysqli_error($conexion2));
$row_productoedit = mysqli_fetch_assoc($productoedit);
$totalRows_productoedit = mysqli_num_rows($productoedit);


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "actualizar")) {

$imagen=$_FILES ["imagen"]["name"];
if($imagen==""){
  $imagen=$row_productoedit['Imagen'];
}
else{
  $dir="../imagenes/productos/".$row_productoedit['Imagen']; //ubicación en el host (EJ, /imagenes/foto.jpg)
  if(file_exists($dir)) //verifica que el archivo existe
   {
   if(unlink($dir)){ // si es true, llama la función
  //echo "El archivo fue borrado";
   }
   }
  else{
  //echo "Este archivo no existe";
  } //si no, lo avisa.

   $imagen=$_FILES ["imagen"]["name"];
    move_uploaded_file ($_FILES ["imagen"]["tmp_name"],"../imagenes/Servicios/".$imagen);
  }

   $Tipo="Servicio";

  $updateSQL = sprintf("UPDATE productos_servicios SET
      Codigo=%s,Nombre=%s,Precio=%s,Stock=%s,Stock_max=%s,
      Stock_min=%s,Codigo_proveedor=%s,Descripcion_corta=%s,
      Descripcion_larga=%s,Duracion_minima=%s,Imagen=%s,Tipo=%s,puntos=%s
      WHERE Id=$ID",
      GetSQLValueString("NULL", "text"),
      GetSQLValueString($_POST['nombre'], "text"),
      GetSQLValueString($_POST['precio'], "double"),
      GetSQLValueString("NULL", "double"),
      GetSQLValueString("NULL", "double"),
      GetSQLValueString("NULL", "double"),
      GetSQLValueString("NULL", "text"),
      GetSQLValueString($_POST['descripcion_corta'],"text"),
      GetSQLValueString($_POST['descripcion_larga'],"text"),
      GetSQLValueString($_POST['duracion'],"int"),
      GetSQLValueString($imagen,"text"),
      GetSQLValueString($Tipo,"text"),
      GetSQLValueString($_POST['puntos'],"int"));


  $Result1 = mysqli_query($conexion2,$updateSQL) or die(mysqli_error($conexion2));

  $updateGoTo = 'cat_servicios.php?';
  header(sprintf("Location: %s",$updateGoTo.'resultado='.'Actualizacion-correcta'));
}

?>
<!--termino de validacion para no entrar a utras paginas con la url-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ver los productos</title>
<link href="../img/logo.ico" rel="icon" />
<link href="css/estilosadmin.css" rel="stylesheet" type="text/css" />
<link href="../fontawesome/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="http://localhost:35729/livereload.js">
<script>
function eliminar ()
{
	rc = confirm("¿DESEA ELIMINAR UN SERVICIO?");
	return rc;

}

function noautorizado ()
{
	rc = alert("Funcion solo para administradores");
	return rc;

}

</script>


<script>
function countChars(obj){
    document.getElementById("charNum").innerHTML = 700-obj.value.length+' Descripción completa';
}

function descripcionCorta(obj){
  document.getElementById("charcorta").innerHTML =100-obj.value.length +' Descripción corta';
}
</script>

<script>
function countCharsedit(obj){
    document.getElementById("charNumedit").innerHTML = 700-obj.value.length+' Descripción completa';
}

function descripcionCortaedit(obj){
  document.getElementById("charcortaedit").innerHTML =100-obj.value.length +' Descripción corta';
}
</script>

</head>

<body>


<header>
  <?php include("includes/header.php"); ?>
</header>
<!--****************************************************************************-->
<div class="contenido">
  <div class="contenido_header">
    <button <?php if($_SESSION['tipo']=="Master"){ ?> <?php } else{?> onClick="javascript:return noautorizado();"<?php }?>class="btn-abrir-popup"  id="btn-abrir-popup" ><i class="fas fa-plus"></i> </button>
    <div class="buscador"><?php include("buscadores/bsServicios.php");//Creacion de buscador ?></div>
    <?php include("includes/btn_servicios.php");?>
  </div>


  <div class="contProductos">
  <?php if($busca!=""){ ?>
    <?php if($row_buscaservicio==0){?> <h1>NO SE ENCONTRO El SERVICIO</h1> <?php }?>

    <?php if($row_buscaservicio>0){?>
      <?php do { ?>
          <div class="producto">
            <div class="imagen">
              <img src="../imagenes/Servicios/<?php echo $row_buscaservicio['Imagen']; ?>" alt="">
            </div>
            <div class="nombre">
              <?php echo $row_buscaservicio['Nombre']; ?>
            </div>
            <p><?php echo $row_buscaservicio['Descripcion_corta']; ?></p>
            <div class="btn">
              <a <?php if($_SESSION['tipo']=="Master"){ ?> href="cat_servicios.php?id=<?php echo base64_encode($row_buscaservicio['Id']); ?>" class="btn-abrir-popup-edit" id="btn-abrir-popup" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?>>
                <i class="fas fa-edit" style="float:left;"></i></a>
              <a <?php if($_SESSION['tipo']=="Master"){ ?> href="servicio_delete.php?Id=<?php echo base64_encode($row_buscaservicio['Id']); ?>"onClick="javascript:return eliminar();" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?>><i class="fas fa-trash" style="color:red; float: right;"></i> </a>
            </div>
          </div>

      <?php } while ($row_buscaservicio= mysqli_fetch_assoc($buscaservicio));
      ?>
    <?php }?>
      <?php }?>


      <!--****************************************************************************-->
      <?php if($busca==""){//Solo si cumple que el buscador no tenga texto?>
      <?php if ($totalRows_servicios > 0) { // muestra productos cuando la consulta es mayor a cero
        ?>
        <?php do { ?>
          <div class="producto">
            <div class="imagen">
              <img src="../imagenes/Servicios/<?php echo $row_servicios['Imagen']; ?>" alt="">
            </div>
            <div class="nombre">
              <?php echo $row_servicios['Nombre']; ?>
            </div>
            <p><?php echo $row_servicios['Descripcion_corta']; ?></p>
            <div class="btn">
              <a <?php if($_SESSION['tipo']=="Master"){ ?> href="cat_servicios.php?id=<?php echo base64_encode($row_servicios['Id']); ?>" class="btn-abrir-popup-edit" id="btn-abrir-popup" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?>>
                <i class="fas fa-edit" style="float:left;"></i></a>
              <a <?php if($_SESSION['tipo']=="Master"){ ?> href="servicio_delete.php?Id=<?php echo base64_encode($row_servicios['Id']); ?>"onClick="javascript:return eliminar();" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?> ><i class="fas fa-trash" style="color:red; float: right;"></i> </a>
            </div>
          </div>



        <?php } while ($row_servicios = mysqli_fetch_assoc($servicios)); ?>
      <?php }
      ?>
    <?php }?>
  </div>
</div>



<!--****************************************************************************-->
<?php if($_SESSION['tipo']=="Master"){ ?>
<!--FORMULARIO ADD-SERVICIO EMERGENTE-->
<div class="overlay" id="overlay">
			<div class="popup" id="popup">

				<h1>+ Servicios</h1>
				<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="addservicios" id="addproducto">
					<div class="contenedor-inputs">
            <label for="Nombre">Servicio</label>
						<input style="width:96%; float:left;" title="Nombre del servicio" type="text" name="nombre" maxlength="200" placeholder="Nombre" required >

            <hr style="width:96%;border:none;">



            <hr style="width:96%;">
            <label for="precio">Precio</label>
						<input style="width:15%; float:left;" type="number" name="precio"  placeholder="0.00" min="0.01" required step="0.01" title="Precio a la venta" pattern="^\d+(?:\.\d{1,2})?$" onblur="
              this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
            <label for="Duracion">Duracion</label>
            <input style="width:15%; float:left;" type="number" name="duracion"  placeholder="Minutos" min="0.01" required step="0.01" title="Duración estimada" pattern="^\d+(?:\.\d{1,2})?$" onblur="
              this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
              <label for="Puntos">Puntos</label>
              <input style="width:10%; float:left;" type="number" name="puntos"  placeholder="1" min="0.01" required step="0.01" title="Puntos acomulados para el cliente" pattern="^\d+(?:\.\d{1,2})?$" onblur="
                this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">

            <hr style="width:96%; ">


            <label for="Imagen">Imagen</label>
						<input style="width:96%; height: 40px;float:left;" type="file" name="imagen"id="imagen" placeholder="Imagen" title="Cargar imajen del servicio" required>
            <hr style="width:96%; border:none;">


            <label for="descripcion" id="charcorta">Descripción corta</label>
            <textarea name="descripcion_corta" rows="2" style="width:96%;" onkeyup="descripcionCorta(this);" maxlength="100" title="Coloca una descripcion breve de no mas de 100 caracteres"></textarea>
            <br>

            <label for="descripcion" id="charNum">Descripción completa</label>
            <textarea name="descripcion_larga" rows="4" style="width:96%;" onkeyup="countChars(this);" maxlength="700" title="Coloca una descripcion completa de no mas de 700 caracteres"></textarea>
            <br>

					</div>
          <a href="" id="btn-cerrar-popup"><button type="button" class="btn-submit"><i class="fas fa-times"></i> Cancelar</button></a>
					<button type="submit" class="btn-submit"><i class="fas fa-check"></i> Guardar</button>
          <input type="hidden" name="MM_insert" value="addservicios" />
				</form>
			</div>
		</div>


    <!--FORMULARIO ACTUALIZAR-PRODUCTO EMERGENTE-->

<?php if($ID!=0){ ?>

      <div class="overlay-edit" id="overlay" style="  ">
      			<div class="popup-edit" id="popup" >

              <h1><i class="fas fa-pen" style="font-size:20px;"></i> Servicio</h1>
      				<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="actualizar" id="actualizar" style="overflow: scroll;max-height:500px;">
      					<div class="contenedor-inputs">
                  <label for="Nombre">Servicio</label>
      						<input style="width:96%; float:left;" title="Nombre del producto" type="text" name="nombre" maxlength="200" placeholder="Nombre" required value="<?php echo $row_productoedit['Nombre']?>">




                  <hr style="width:96%;">
                  <label for="precio">Precio</label>
      						<input style="width:15%; float:left;" type="number" name="precio" placeholder="0.00" min="0.01" required step="0.01" title="Precio a la venta" pattern="^\d+(?:\.\d{1,2})?$" onblur="
        this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"
        value="<?php echo $row_productoedit['Precio']?>">
        <label for="precio">Duración</label>
        <input style="width:15%; float:left;" type="number" name="duracion" placeholder="0.00" min="0.01" required step="0.01" title="Duracion en minutos" pattern="^\d+(?:\.\d{1,2})?$" onblur="
        this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"
        value="<?php echo $row_productoedit['Duracion_minima']?>">
        <label for="Puntos">Puntos</label>
        <input style="width:10%; float:left;" type="number" name="puntos"  placeholder="1" min="0.01" required step="0.01" title="Puntos acomulados para el cliente" pattern="^\d+(?:\.\d{1,2})?$" onblur="
          this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"
          value="<?php echo $row_productoedit['puntos']?>">

                  <hr style="width:96%; border:none;">

                  <img src="../imagenes/Servicios/<?php echo $row_productoedit['Imagen']?>" style="height:80px; position: absolute">
      						<input style="width:40%; height: 40px;float:left; " type="file" name="imagen"id="imagen" placeholder="Imagen" title="Seleciona una imagen del producto" value="<?php echo $row_productoedit['Imagen']?>">
                  <hr style="width:96%; border:none;">


                  <label for="descripcion" id="charcortaedit">Descripción corta</label>
                  <textarea name="descripcion_corta" rows="2" style="width:96%;" onkeyup="descripcionCortaedit(this);" maxlength="100"><?php echo $row_productoedit['Descripcion_corta']?></textarea>

                  <label for="descripcion" id="charNumedit">Descripción larga</label>
                  <textarea name="descripcion_larga" rows="4" style="width:96%;" onkeyup="countCharsedit(this);" maxlength="700"><?php echo $row_productoedit['Descripcion_larga']?></textarea>
                  <br>
      					</div>
                <a href="cat_servicios.php" id="btn-cerrar-popup"><input type="button" class="btn-submit" value="Cancelar"></a>
      					<input type="submit" class="btn-submit" value="Actualizar">
                <input type="hidden" name="MM_update" value="actualizar" />
      				</form>
      			</div>
      		</div>
          <?php }?>

    <script src="js/popup.js"></script>
    <script src="js/valid_producto.js"></script>
  <?php }?>
    <script src="js\contChart.js"></script>

  <footer>
    <div class="logo">
      <img src="../img/logo.png" alt="" title="logotipo" >
    </div>
    <div id="copyright">
      Copyright&nbsp&copy;&nbsp;2021 - Todos los derechos reservados
    </div>
  </footer>

</body>

</html>
<?php

mysqli_free_result($servicios);
?>
