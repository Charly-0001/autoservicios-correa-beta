<?php require_once('../Connections/conexion2.php'); ?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


//termino de validacion para no entrar a utras paginas con la url


//LISTA DE CLIENTES
$query_clientes = "SELECT * FROM clientes ORDER BY clientes.Nombre ASC";
$clientes = mysqli_query($conexion2,$query_clientes) or die(mysqli_error($conexion2));
$row_clientes = mysqli_fetch_assoc($clientes);
$totalRows_clientes = mysqli_num_rows($clientes);


//AGREGAR CLIENTE
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addcliente")) {

$imagen=$_POST['Nombre'].$_FILES ["foto"]["name"];
	move_uploaded_file ($_FILES ["foto"]["tmp_name"],"../imagenes/clientes/".$imagen);
$Tipo="registro_Clientes";
$insertSQL = sprintf("INSERT INTO clientes (registro,Nombre,Apeido_paterno,Apeido_materno,Telefono,Pais,Estado,Municipio,Codigo_Postal,Email,foto)
                                    VALUES (NOW(),%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Apeido_paterno'], "text"),
                       GetSQLValueString($_POST['Apeido_Materno'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['pais'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['municipio'],"text"),
                       GetSQLValueString($_POST['CP'],"text"),
                       GetSQLValueString($_POST['email'],"text"),
                       GetSQLValueString($imagen,"text"));

                       $Result1 = mysqli_query($conexion2,$insertSQL ) or die(mysqli_error($conexion2));
                       $insertGoTo = "clientes.php";
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

$query_buscacliente=("SELECT * FROM clientes WHERE clientes.Nombre Like '%".$busca."%'");

$buscacliente=mysqli_query($conexion2,$query_buscacliente) or die(mysqli_error($conexion2));
$row_buscacliente = mysqli_fetch_assoc($buscacliente);
$totalRows_buscacliente = mysqli_num_rows($buscacliente);
}


/*//////////////////////////////////////////ACTUALIZAR/////////////////*/
/*/////////////////////////////////////////////////////////////////////*/
$ID = "0";
if (isset($_GET["id"])) {
  $ID =base64_decode( $_GET["id"]);
}



$query_clienteedit = sprintf("SELECT * FROM clientes WHERE clientes.Id=%s", GetSQLValueString($ID, "int"));
$clienteedit = mysqli_query($conexion2,$query_clienteedit ) or die(mysqli_error($conexion2));
$row_clienteedit = mysqli_fetch_assoc($clienteedit);
$totalRows_clienteedit = mysqli_num_rows($clienteedit);


if ((isset($_POST["MM_updatecliente"])) && ($_POST["MM_updatecliente"] == "actualizarcliente")) {

$imagen=$_FILES ["fotocliente"]["name"];
if($imagen==""){
  $imagen=$row_clienteedit['foto'];
}
else{
  $dir="../imagenes/clientes/".$row_clienteedit['foto']; //ubicación en el host (EJ, /imagenes/foto.jpg)
  if(file_exists($dir)) //verifica que el archivo existe
   {
   if(unlink($dir)){ // si es true, llama la función
  //echo "El archivo fue borrado";
    }
   }
  else{
   //echo "Este archivo no existe";
 } //si no, lo avisa.

   $imagencliente=$_FILES ["fotocliente"]["name"];
    move_uploaded_file ($_FILES ["fotocliente"]["tmp_name"],"../imagenes/clientes/".$imagen);
  }

   $Tipo="Actualizacion_cliente";

  $updateSQL = sprintf("UPDATE clientes SET
      Nombre=%s,Apeido_paterno=%s,Apeido_materno=%s,Telefono=%s,Pais=%s,
      Estado=%s,Municipio=%s,Codigo_Postal=%s,Email=%s,foto=%s
      WHERE Id=$ID",
      GetSQLValueString($_POST['Nombre'], "text"),
      GetSQLValueString($_POST['Apeido_paterno'], "text"),
      GetSQLValueString($_POST['Apeido_materno'], "text"),
      GetSQLValueString($_POST['telefono'], "text"),
      GetSQLValueString($_POST['pais'], "text"),
      GetSQLValueString($_POST['estado'], "text"),
      GetSQLValueString($_POST['municipio'], "text"),
      GetSQLValueString($_POST['CP'],"text"),
      GetSQLValueString($_POST['email'],"text"),
      GetSQLValueString($imagen,"text"));


  $Result1 = mysqli_query($conexion2,$updateSQL) or die(mysqli_error($conexion2));

  $updateGoTo = 'clientes.php?';
  header(sprintf("Location: %s",$updateGoTo.'resultado='.'Actualizacion-correcta'));
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Clientes</title>
<link href="../img/logo.ico" rel="icon" />
<link href="css/estilosadmin.css" rel="stylesheet" type="text/css" />
<link href="../fontawesome/css/all.css" rel="stylesheet">


</head>

<body>
  <header>
    <?php include("includes/header.php"); ?>
  </header>



  <div class="contenido">
    <div class="contenido_header">
      <button <?php if($_SESSION['tipo']=="Master"){ ?> <?php } else{?> onClick="javascript:return noautorizado();"<?php }?>class="btn-abrir-popup"  id="btn-abrir-popup" ><i class="fas fa-plus"></i> </button>
      <div class="buscador"><?php include("buscadores/bsCliente.php");//Creacion de buscador ?></div>

    </div>

    <div class="contClientes">
      <div class="listaClientes">
        <!--****************************************************************************-->
        <?php if($busca!=""){//Solo si cumple que el buscador no tenga texto?>
        <?php if ($totalRows_clientes > 0) { // muestra productos cuando la consulta es mayor a cero
          ?>
          <p><?php echo $totalRows_buscacliente ?> resultados de la busqueda de <?php echo $busca?></p>
          <table>
            <tr>
              <th>Fech.Reg</th>
              <th>Nombre</th>
              <th>Tel.</th>
              <th>Dirección</th>
              <th>Frecuencia</th>
              <th>Puntos</th>
              <th></th>
            </tr>
            <?php do { ?>
              <tr>
                <td style="max-width:100px;"><?php echo $row_buscacliente['registro'] ?></td>
                <td><?php echo $row_buscacliente['Nombre'] ?> <?php echo $row_buscacliente['Apeido_paterno'] ?> <?php echo $row_buscacliente['Apeido_materno'] ?></td>
                <td> <a href="tel:<?php echo $row_buscacliente['Telefono'] ?>"></a> </td>
                <td><?php echo $row_buscacliente['Municipio'] ?> - <?php echo $row_buscacliente['Estado'] ?> - <?php echo $row_buscacliente['Pais'] ?> - <?php echo $row_buscacliente['Codigo_postal'] ?></td>

                <?php //LISTA DE COMPRAS POR CLIENTE
                $query_compras = "SELECT * FROM ventas where ventas.Id_cliente='%".$row_buscacliente['Id']."%'";
                $compras = mysqli_query($conexion2,$query_compras) or die(mysqli_error($conexion2));
                $row_compras = mysqli_fetch_assoc($compras);
                $totalRows_compras = mysqli_num_rows($compras); ?>

                <td> <?php echo $totalRows_compras ?></td>
                <td><?php echo $row_buscacliente['puntos'] ?></td>
                <td><a href="clientes.php?id=<?php echo base64_encode($row_buscacliente['Id']); ?>"> <button type="submit"><i class="fas fa-edit"></i> </button></a> </td>
              </tr>
            <?php } while ($row_buscacliente= mysqli_fetch_assoc($buscacliente));?>
          </table>
        <?php } ?>
      <?php }?>

        <!--****************************************************************************-->
        <?php if($busca==""){//Solo si cumple que el buscador no tenga texto?>
        <?php if ($totalRows_clientes > 0) { // muestra productos cuando la consulta es mayor a cero
          ?>
          <table>
            <tr>
              <th>Fech.Reg</th>
              <th>Nombre</th>
              <th>Tel.</th>
              <th>Dirección</th>
              <th>Frecuencia</th>
              <th>Puntos</th>
              <th></th>
            </tr>
            <?php do { ?>
              <tr>
                <td style="max-width:100px;"><?php echo $row_clientes['registro'] ?></td>
                <td><?php echo $row_clientes['Nombre'] ?> <?php echo $row_clientes['Apeido_paterno'] ?> <?php echo $row_clientes['Apeido_materno'] ?></td>
                <td><a href="Tel:<?php echo $row_clientes['Telefono'] ?>"><?php echo $row_clientes['Telefono'] ?></a> </td>
                <td><?php echo $row_clientes['Municipio'] ?> - <?php echo $row_clientes['Estado'] ?> - <?php echo $row_clientes['Pais'] ?> - <?php echo $row_clientes['Codigo_postal'] ?></td>

                <?php //LISTA DE COMPRAS POR CLIENTE
                $query_compras = "SELECT * FROM ventas where ventas.Id_cliente='%".$row_clientes['Id']."%'";
                $compras = mysqli_query($conexion2,$query_compras) or die(mysqli_error($conexion2));
                $row_compras = mysqli_fetch_assoc($compras);
                $totalRows_compras = mysqli_num_rows($compras); ?>

                <td> <?php echo $totalRows_compras ?></td>
                <td><?php echo $row_clientes['puntos'] ?></td>
                <td><a href="clientes.php?id=<?php echo base64_encode($row_clientes['Id']); ?>"> <button type="submit"><i class="fas fa-edit" style="cursor:pointer;"></i> </button></a> </td>
              </tr>
            <?php } while ($row_clientes= mysqli_fetch_assoc($clientes));?>
          </table>
        <?php } ?>
      <?php }?>


      </div>
    </div>
  </div>


  <!--****************************************************************************-->
  <?php if($_SESSION['tipo']=="Master"){ ?>
  <!--FORMULARIO ADD-CLIENTE EMERGENTE-->
  <div class="overlay" id="overlay">
  			<div class="popup" id="popup">

  				<h1>+ Cliente</h1>
  				<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="addcliente" id="addcliente">
  					<div class="contenedor-inputs">

              <i class="fa fa-camera" style="float:center; margin-top: 3px;cursor:pointer; font-size: 25px;" onclick="document.getElementById('foto').click()"></i>
              <input style="width:30px; height: 30px;float:left; display:none" type="file" name="foto"id="foto" title="Seleciona una imagen de perfil">
              <hr style="width:96%;">

              <label for="Nombre">Nombre |Apeido |Apeido </label>

              <hr style="width:96%;border:none;">
  						<input style="width:30%; float:left;" title="Nombre" type="text" name="Nombre" maxlength="200" placeholder="Nombre" required >
              <input style="width:30%; float:left;" title="Apeido_Paterno" type="text" name="Apeido_paterno" maxlength="200" placeholder="Apeido paterno" required >
              <input style="width:30%; float:left;" title="Apeido_Materno" type="text" name="Apeido_Materno" maxlength="200" placeholder="Apeido Materno" required >
              <hr style="width:96%; border:none;">

              <label for="Telefono">Tell: </label>
              <input style="width:40%; float:left;" title="Telefono" type="tel" name="telefono" maxlength="10"minlength="10" placeholder="4411020082">
              <hr style="width:96%;border:none;">


              <label for="Pais">Pais</label>
  						<input style="width:20%; float:left;" type="text" name="pais" placeholder="México" title="Pais de origen" title="pais">
              <label for="Estado">Estado</label>
              <input style="width:20%; float:left;" type="text" name="estado" title="Estado de origen" placeholder="Estado">
              <hr style="width:96%; border:none;">

              <label for="Municipio">Municipio</label>
              <input style="width:25%; float:left;" type="text" name="municipio" title="Municipio de origen" placeholder="Municipio" >
              <label for="CP">CP</label>
              <input style="width:17%; float:left;" type="text" name="CP" placeholder="76315" title="Codigo postal" maxlength="5"minlength="5">
              <hr style="width:96%; border:none;">




              <label for="Email">Email</label>
              <input type="email" name="email" placeholder="cliente@gmail.com">
              <br>

  					</div>
            <a href="" id="btn-cerrar-popup"><button type="button" class="btn-submit"><i class="fas fa-times"></i> Cancelar</button></a>
  					<button type="submit" class="btn-submit"><i class="fas fa-check"></i> Guardar</button>
            <input type="hidden" name="MM_insert" value="addcliente"/>
  				</form>
  			</div>
  		</div>


      <!--FORMULARIO EDITAR-CLIENTE-->

  <?php if($ID!=0){ ?>

        <div class="overlay-edit" id="overlay" style="  ">
        			<div class="popup-edit" id="popup">

                <h1>Edit Cliente</h1>
        				<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="actualizarcliente" id="actualizar">
        					<div class="contenedor-inputs">

                    <img src="../imagenes/clientes/<?php echo $row_clienteedit['foto']?>" alt="" style="height:100px;cursor:pointer; float:center; position:relative;;"onclick="document.getElementById('fotocliente').click()" />

                    <i class="fa fa-camera" style="float:center; relative;margin-top: 70px;cursor:pointer; " onclick="document.getElementById('fotocliente').click()"></i>
        						<input style="width:50%; height: 40px;float:left; display:none" type="file" name="fotocliente"id="fotocliente" title="Seleciona una imagen de perfil">
                    <hr style="width:96%;">


                    <label for="Nombre">Nombre |Apeido |Apeido </label>

                    <hr style="width:96%;border:none;">
        						<input style="width:30%; float:left;" title="Nombre" type="text" name="Nombre" maxlength="200" placeholder="Nombre" required value="<?php echo $row_clienteedit['Nombre']; ?>">
                    <input style="width:30%; float:left;" title="Apeido_Paterno" type="text" name="Apeido_paterno" maxlength="200" placeholder="Apeido paterno" required value="<?php echo $row_clienteedit['Apeido_paterno']; ?>">
                    <input style="width:30%; float:left;" title="Apeido_Materno" type="text" name="Apeido_materno" maxlength="200" placeholder="Apeido Materno" required value="<?php echo $row_clienteedit['Apeido_materno']; ?>">
                    <hr style="width:96%; border:none;">

                    <label for="Telefono">Tell: </label>
                    <input style="width:40%; float:left;" title="Telefono" type="tel" name="telefono" placeholder="4411020082" maxlength="10"minlength="10"  value="<?php echo $row_clienteedit['Telefono']; ?>">
                    <hr style="width:96%;border:none;">


                    <label for="Pais">Pais</label>
        						<input style="width:20%; float:left;" type="text" name="pais" placeholder="México" title="Pais de origen" title="pais" value="<?php echo $row_clienteedit['Pais']; ?>">
                    <label for="Estado">Estado</label>
                    <input style="width:20%; float:left;" type="text" name="estado" title="Estado de origen" placeholder="Estado" value="<?php echo $row_clienteedit['Estado']; ?>">
                    <hr style="width:96%; border:none;">

                    <label for="Municipio">Municipio</label>
                    <input style="width:25%; float:left;" type="text" name="municipio" title="Municipio de origen" placeholder="Municipio" value="<?php echo $row_clienteedit['Municipio']; ?>" >
                    <label for="CP">CP</label>
                    <input style="width:17%; float:left;" type="text" name="CP" placeholder="76315" title="Codigo postal" maxlength="5"minlength="5" value="<?php echo $row_clienteedit['Codigo_postal']; ?>">
                    <hr style="width:96%; border:none;">




                    <label for="Email">Email</label>
                    <input type="email" name="email" placeholder="cliente@gmail.com" value="<?php echo $row_clienteedit['Email']; ?>">

                    <br>
        					</div>
                  <a href="clientes.php" id="btn-cerrar-popup"><button type="button" class="btn-submit"><i class="fas fa-times"></i> Cancelar</button></a>
        					<button type="submit" class="btn-submit"><i class="fas fa-check"></i> Guardar</button>
                  <input type="hidden" name="MM_updatecliente" value="actualizarcliente" />
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
      Copyright&nbsp&copy;&nbsp;2021 - Todos los derechos reservados</div>
  </footer>

</body>
</html>
