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


//LISTA DE PRODUCTOS
$query_productos = "SELECT * FROM productos_servicios WHERE productos_servicios.Tipo='Producto' ORDER BY productos_servicios.id ASC";
$productos = mysqli_query($conexion2,$query_productos) or die(mysqli_error($conexion2));
$row_productos = mysqli_fetch_assoc($productos);
$totalRows_productos = mysqli_num_rows($productos);

//AGREGAR PRODUCTO
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addproducto")) {

$imagen=$_FILES ["imagen"]["name"];
	move_uploaded_file ($_FILES ["imagen"]["tmp_name"],"../imagenes/productos/".$imagen);

  $Tipo="producto";

  $insertSQL = sprintf("INSERT INTO productos_servicios (Codigo,Nombre,Precio,Stock,Stock_max,Stock_min,Codigo_proveedor,Descripcion_corta,Imagen,Tipo,puntos)
                                    VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
                       GetSQLValueString($_POST['codigo'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['precio'], "double"),
                       GetSQLValueString($_POST['stock'], "double"),
                       GetSQLValueString($_POST['stock_max'], "double"),
                       GetSQLValueString($_POST['stock_min'], "double"),
                       GetSQLValueString($_POST['codigo_proveedor'], "text"),
                       GetSQLValueString($_POST['descripcion_corta'],"text"),
                       GetSQLValueString($imagen,"text"),
                       GetSQLValueString($Tipo,"text"),
                      GetSQLValueString($_POST['puntos'],"int"));

                       $Result1 = mysqli_query($conexion2,$insertSQL ) or die(mysqli_error($conexion2));
                       $insertGoTo = "productos.php";
                       if (isset($_SERVER['QUERY_STRING']))
                       {
                         $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
                         $insertGoTo .= $_SERVER['QUERY_STRING'];
                       }
                       header(sprintf("Location: %s", $insertGoTo));
                       require_once('log.php');
                     $registro = createlog($Tipo,$_POST['nombre']);

                     }


//BUSCADOR
$busca="";

if(isset ($_POST['busca'])){
$busca=$_POST['busca'];

$query_buscaprocuct=("SELECT * FROM productos_servicios WHERE productos_servicios.Tipo='Producto' AND productos_servicios.nombre Like '%".$busca."%'");

$buscaprocuct=mysqli_query($conexion2,$query_buscaprocuct) or die(mysqli_error($conexion2));
$row_buscaprocuct = mysqli_fetch_assoc($buscaprocuct);
$totalRows_buscaprocuct = mysqli_num_rows($buscaprocuct);
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
    move_uploaded_file ($_FILES ["imagen"]["tmp_name"],"../imagenes/productos/".$imagen);
  }


   $Tipo="producto";

  $updateSQL = sprintf("UPDATE productos_servicios SET
      Codigo=%s,Nombre=%s,Precio=%s,Stock=%s,Stock_max=%s,
      Stock_min=%s,Codigo_proveedor=%s,Descripcion_corta=%s,Imagen=%s,Tipo=%s, puntos=%s
      WHERE Id=$ID",
      GetSQLValueString($_POST['codigo'], "text"),
      GetSQLValueString($_POST['nombre'], "text"),
      GetSQLValueString($_POST['precio'], "double"),
      GetSQLValueString($_POST['stock'], "double"),
      GetSQLValueString($_POST['stock_max'], "double"),
      GetSQLValueString($_POST['stock_min'], "double"),
      GetSQLValueString($_POST['codigo_proveedor'], "text"),
      GetSQLValueString($_POST['descripcion_corta'],"text"),
      GetSQLValueString($imagen,"text"),
      GetSQLValueString($Tipo,"text"),
      GetSQLValueString($_POST['puntos'],"int"));


  $Result1 = mysqli_query($conexion2,$updateSQL) or die(mysqli_error($conexion2));

  $updateGoTo = 'productos.php?';
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
	rc = confirm("DESEA ELIMINAR UN PRODUCTO?");
	return rc;

}

function noautorizado ()
{
	rc = alert("Funcion solo para administradores");
	return rc;

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
    <div class="buscador"><?php include("buscadores/bsProductos.php");//Creacion de buscador ?></div>

    <a href="Stock-bajo.php?p=<?php echo base64_encode($_SESSION['MM_idAdmin'])?>" target="_blank"> <button type="submit" ><i class="fas fa-file-invoice" style="font-size:25px; cursor:pointer;" title="Lista de productos bajos en existencia"></i> </button></a>
  </div>

  <div class="contProductos">
  <?php if($busca!=""){ ?>
    <?php if($row_buscaprocuct==0){?> <h1>NO SE ENCONTRO EL PRODUCTO</h1> <?php }?>

    <?php if($row_buscaprocuct>0){?>
      <?php do { ?>
          <div class="producto">
            <div class="imagen">
              <img src="../imagenes/productos/<?php echo $row_buscaprocuct['Imagen']; ?>" alt="">
            </div>
            <div class="nombre">
              <?php echo $row_buscaprocuct['Nombre']; ?>
            </div>
            <p><?php echo $row_buscaprocuct['Descripcion_corta']; ?></p>
            <div class="btn">
              <a <?php if($_SESSION['tipo']=="Master"){ ?> href="productos.php?id=<?php echo base64_encode($row_buscaprocuct['Id']); ?>" class="btn-abrir-popup-edit" id="btn-abrir-popup" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?>>
                <i class="fas fa-edit" style="float:left;"></i></a>
              <a <?php if($_SESSION['tipo']=="Master"){ ?> href="producto_delete.php?Id=<?php echo base64_encode($row_buscaprocuct['Id']); ?>"onClick="javascript:return eliminar();" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?>><i class="fas fa-trash" style="color:red; float: right;"></i> </a>
            </div>
          </div>

      <?php } while ($row_buscaprocuct= mysqli_fetch_assoc($buscaprocuct));
      ?>
    <?php }?>
      <?php }?>


      <!--****************************************************************************-->
      <?php if($busca==""){//Solo si cumple que el buscador no tenga texto?>
      <?php if ($totalRows_productos > 0) { // muestra productos cuando la consulta es mayor a cero
        ?>
        <?php do { ?>
          <div class="producto">
            <div class="imagen">
              <img src="../imagenes/productos/<?php echo $row_productos['Imagen']; ?>" alt="">
            </div>
            <div class="nombre">
              <?php echo $row_productos['Nombre']; ?>
            </div>
            <p><?php echo $row_productos['Descripcion_corta']; ?></p>
            <div class="btn">
              <a <?php if($_SESSION['tipo']=="Master"){ ?> href="productos.php?id=<?php echo base64_encode($row_productos['Id']); ?>" class="btn-abrir-popup-edit" id="btn-abrir-popup" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?>>
                <i class="fas fa-edit" style="float:left;"></i></a>
              <a <?php if($_SESSION['tipo']=="Master"){ ?> href="producto_delete.php?Id=<?php echo base64_encode($row_productos['Id']); ?>"onClick="javascript:return eliminar();" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?> ><i class="fas fa-trash" style="color:red; float: right;"></i> </a>
            </div>
          </div>



        <?php } while ($row_productos = mysqli_fetch_assoc($productos)); ?>
      <?php }
      ?>
    <?php }?>
  </div>
</div>



<!--****************************************************************************-->
<?php if($_SESSION['tipo']=="Master"){ ?>
<!--FORMULARIO ADD-PRODUCTO EMERGENTE-->
<div class="overlay" id="overlay">
			<div class="popup" id="popup">

				<h1>+ Inventario</h1>
				<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="addproducto" id="addproducto">
					<div class="contenedor-inputs">
            <label for="Nombre">Producto</label>
						<input style="width:96%; float:left;" title="Nombre del producto" type="text" name="nombre" maxlength="200" placeholder="Nombre" required >
            <label for="Codigo">Código</label>
            <input style="width:40%; float:left;" title="Codigo de barras" type="text" name="codigo" placeholder="7254639">
            <hr style="width:96%;border:none;">



            <hr style="width:96%;">
            <label for="precio">Precio</label>
						<input style="width:23%; float:left;" type="number" name="precio"  placeholder="0.00" min="0.01" required step="0.01" title="Precio a la venta" pattern="^\d+(?:\.\d{1,2})?$" onblur="
  this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
            <label for="puntos">Puntos</label>
            <input style="width:23%; float:left;" type="number" name="puntos"  placeholder="0" min="0" required step="1" title="Puntos por venta" pattern="^\d+(?:\.\d{1,2})?$" onblur="
this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">


            <hr style="width:96%; border:none;">
            <label for="existencia">Existencia</label>
						<input style="width:15%; float:left;" type="number" name="stock" placeholder="0" title="existencia" min="0" required
              pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
            <label for="minimo">Min</label>
						<input style="width:15%; float:left;" type="number" name="stock_min" placeholder="0" title="minimo en existencia para realisar pedido" required id="minimo"
              pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'" >

            <label for="maximo">Max</label>
						<input style="width:15%; float:left;" type="number" name="stock_max" placeholder="0" title="Maximo a pedir" required
              pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">
            <hr style="width:96%; ">


            <label for="codigo_provedor">Cod.proveedor</label>
						<input style="width:17%; float:left;" type="text" name="codigo_proveedor" placeholder="2548" title="codigo en caso de tenerlo">
            <hr style="width:96%; border:none;">
            <label for="Imagen">Imagen</label>
						<input style="width:96%; height: 40px;float:left;" type="file" name="imagen"id="imagen" placeholder="Imagen" title="Seleciona una imagen del producto" required>
            <hr style="width:96%; border:none;">


            <label for="descripcion">Descripción corta</label>
            <textarea name="descripcion_corta" rows="2" style="width:96%;"></textarea>
            <br>

					</div>
          <a href="" id="btn-cerrar-popup"><button type="button" class="btn-submit"><i class="fas fa-times"></i> Cancelar</button></a>
					<button type="submit" class="btn-submit"><i class="fas fa-check"></i> Guardar</button>
          <input type="hidden" name="MM_insert" value="addproducto" />
				</form>
			</div>
		</div>


    <!--FORMULARIO ACTUALIZAR-PRODUCTO EMERGENTE-->

<?php if($ID!=0){ ?>

      <div class="overlay-edit" id="overlay" style="  ">
      			<div class="popup-edit" id="popup">

              <h1>Edit Inventario</h1>
      				<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="actualizar" id="actualizar" style="overflow: scroll;max-height:500px;">
      					<div class="contenedor-inputs">
                  <label for="Nombre">Producto</label>
      						<input style="width:96%; float:left;" title="Nombre del producto" type="text" name="nombre" maxlength="200" placeholder="Nombre" required value="<?php echo $row_productoedit['Nombre']?>">
                  <label for="Codigo">Código</label>
                  <input style="width:40%; float:left;" title="Codigo de barras" type="text" name="codigo" placeholder="7254639" value="<?php echo $row_productoedit['Codigo']?>">
                  <hr style="width:96%;border:none;">



                  <hr style="width:96%;">
                  <label for="precio">Precio</label>
      						<input style="width:23%; float:left;" type="number" name="precio" placeholder="0.00" min="0.01" required step="0.01" title="Precio a la venta" pattern="^\d+(?:\.\d{1,2})?$" onblur="
        this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"
        value="<?php echo $row_productoedit['Precio']?>">

                  <label for="precio">Puntos</label>
                  <input style="width:23%; float:left;" type="number" name="puntos" placeholder="0" min="0" required step="1" title="Puntos por venta" pattern="^\d+(?:\.\d{1,2})?$" onblur="
this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"
value="<?php echo $row_productoedit['puntos']?>">


                  <hr style="width:96%; border:none;">
                  <label for="existencia">Existencia</label>
      						<input style="width:15%; float:left;" type="number" name="stock" placeholder="0.00" title="existencia" min="0" required="required" value="<?php echo $row_productoedit['Stock']?>">
                  <label for="minimo">Min</label>
      						<input style="width:15%; float:left;" type="number" name="stock_min" placeholder="0" title="minimo en existencia para realisar pedido"value="<?php echo $row_productoedit['Stock_min']?>">
                  <label for="maximo">Max</label>
      						<input style="width:15%; float:left;" type="number" name="stock_max" placeholder="0" title="Maximo a pedir"value="<?php echo $row_productoedit['Stock_max']?>">
                  <hr style="width:96%; ">


                  <label for="codigo_provedor">Cod.proveedor</label>
      						<input style="width:17%; float:left;" type="text" name="codigo_proveedor" placeholder="2548" title="codigo en caso de tenerlo" value="<?php echo $row_productoedit['Codigo_proveedor']?>" >
                  <hr style="width:96%; border:none;">

                  <img src="../imagenes/productos/<?php echo $row_productoedit['Imagen']?>" style="height:80px; position: absolute">
      						<input style="width:40%; height: 40px;float:left; " type="file" name="imagen"id="imagen" placeholder="Imagen" title="Seleciona una imagen del producto" value="<?php echo $row_productoedit['Imagen']?>">
                  <hr style="width:96%; border:none;">


                  <label for="descripcion">Descripción corta</label>
                  <textarea name="descripcion_corta" rows="2" style="width:96%;"><?php echo $row_productoedit['Descripcion_corta']?></textarea>
                  <br>
      					</div>
                <a href="productos.php" id="btn-cerrar-popup"><button type="button" class="btn-submit"><i class="fas fa-times"></i> Cancelar</button></a>
      					<button type="submit" class="btn-submit"><i class="fas fa-check"></i> Guardar</button>
                <input type="hidden" name="MM_update" value="actualizar" />
      				</form>
      			</div>
      		</div>
          <?php }?>

    <script src="js/popup.js"></script>
    <script src="js/valid_producto.js"></script>
<?php }?>
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

mysqli_free_result($productos);
?>
