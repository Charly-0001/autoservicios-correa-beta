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

//AGREGAR USUARIO
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addusuario")) {

$imagen=$_FILES ["imagen"]["name"];
	move_uploaded_file ($_FILES ["imagen"]["tmp_name"],"../img/usuarios/".$imagen);
  $forgot_pass_identity="";
  $contrasena=$_POST['password'];

  $insertSQL = sprintf("INSERT INTO administracion (Nombre_completo,Email,Password,phone,	forgot_pass_identity,created,tipo,foto,estado)
                                    VALUES (%s,%s,'%s',%s,%s,NOW(),%s,%s,%s)",
                       GetSQLValueString($_POST['Nombre_completo'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       password_hash($contrasena, PASSWORD_DEFAULT),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($forgot_pass_identity, "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($imagen,"text"),
                       GetSQLValueString($_POST['estado'],"text"));

                       $Result1 = mysqli_query($conexion2,$insertSQL ) or die(mysqli_error($conexion2));
                       $insertGoTo = "mi-perfil.php";
                       if (isset($_SERVER['QUERY_STRING']))
                       {
                         $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
                         $insertGoTo .= $_SERVER['QUERY_STRING'];
                       }
                       header(sprintf("Location: %s", $insertGoTo));
                       require_once('log.php');
                     $registro = createlog($Tipo,$_POST['nombre']);

                     }

//INFORMACION DE USUARIO
$ID=$_SESSION['MM_idAdmin'];
$query_perfil = sprintf("SELECT * FROM administracion WHERE administracion.Id=%s", GetSQLValueString($ID, "int"));
$perfil = mysqli_query($conexion2,$query_perfil ) or die(mysqli_error($conexion2));
$row_perfil = mysqli_fetch_assoc($perfil);
$totalRows_perfil = mysqli_num_rows($perfil);

//LISTA DE USUARIOS
$perfil= $row_perfil['Id'];
$query_usuarios = "SELECT * FROM administracion WHERE Id!=$perfil ORDER BY administracion.Nombre_completo ASC ";
$usuarios = mysqli_query($conexion2,$query_usuarios) or die(mysqli_error($conexion2));
$row_usuarios = mysqli_fetch_assoc($usuarios);
$totalRows_usuarios = mysqli_num_rows($usuarios);

/*//////////////////////////////////////////ACTUALIZAR-PERFIL/////////////////*/
/*/////////////////////////////////////////////////////////////////////*/
$p = "0";
if (isset($_GET["p"])) {
  $p =base64_decode( $_GET["p"]);
}



$query_perfiledit = sprintf("SELECT * FROM administracion WHERE administracion.Id=%s", GetSQLValueString($p, "int"));
$perfiledit = mysqli_query($conexion2,$query_perfiledit ) or die(mysqli_error($conexion2));
$row_perfiledit = mysqli_fetch_assoc($perfiledit);
$totalRows_perfiledit = mysqli_num_rows($perfiledit);


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "actualizarperfil")) {

$imagen=$_FILES ["foto"]["name"];
if($imagen==""){
  $imagen=$row_perfiledit['foto'];
}
else{
  $dir="../img/usuarios/".$row_perfiledit['foto']; //ubicación en el host (EJ, /imagenes/foto.jpg)
  if(file_exists($dir)) //verifica que el archivo existe
   {
   if(unlink($dir)){ // si es true, llama la función
  //echo "El archivo fue borrado";
   }
   }
  else{
   //echo "Este archivo no existe";
   } //si no, lo avisa.

   $imagenperfil=$_FILES ["foto"]["name"];
    move_uploaded_file ($_FILES ["foto"]["tmp_name"],"../img/usuarios/".$imagenperfil);
  }

  $forgot_pass_identity="";
  $contrasena=$_POST['password'];
  if($contrasena!=""){


  $updateSQL = sprintf("UPDATE administracion SET
      Nombre_completo=%s,Email=%s,Password='%s',phone=%s,forgot_pass_identity=%s,
      tipo=%s,foto=%s,estado=%s WHERE Id=$p",
      GetSQLValueString($_POST['Nombre_completo'], "text"),
      GetSQLValueString($_POST['Email'], "text"),
      password_hash($contrasena, PASSWORD_DEFAULT),
      GetSQLValueString($_POST['phone'], "text"),
      GetSQLValueString($forgot_pass_identity, "text"),
      GetSQLValueString($_POST['tipo'], "text"),
      GetSQLValueString($imagen,"text"),
      GetSQLValueString($_POST['estado'],"text"));
}
else{
  $updateSQL = sprintf("UPDATE administracion SET
      Nombre_completo=%s,Email=%s,phone=%s,forgot_pass_identity=%s,
      tipo=%s,foto=%s,estado=%s WHERE Id=$p",
      GetSQLValueString($_POST['Nombre_completo'], "text"),
      GetSQLValueString($_POST['Email'], "text"),
      GetSQLValueString($_POST['phone'], "text"),
      GetSQLValueString($forgot_pass_identity, "text"),
      GetSQLValueString($_POST['tipo'], "text"),
      GetSQLValueString($imagen,"text"),
      GetSQLValueString($_POST['estado'],"text"));
}
  $Result1 = mysqli_query($conexion2,$updateSQL) or die(mysqli_error($conexion2));

  $updateGoTo = 'mi-perfil.php?';
  header(sprintf("Location: %s",$updateGoTo.'resultado='.'Actualizacion-correcta'));
}



/*//////////////////////////////////////////ACTUALIZAR-USUARIO/////////////////*/
/*/////////////////////////////////////////////////////////////////////*/
$id = "0";
if (isset($_GET["id"])) {
  $id =base64_decode( $_GET["id"]);
}



$query_useredit = sprintf("SELECT * FROM administracion WHERE administracion.Id=%s", GetSQLValueString($id, "int"));
$useredit = mysqli_query($conexion2,$query_useredit ) or die(mysqli_error($conexion2));
$row_useredit = mysqli_fetch_assoc($useredit);
$totalRows_useredit = mysqli_num_rows($useredit);


if ((isset($_POST["MM_updateuser"])) && ($_POST["MM_updateuser"] == "actualizaruser")) {

$imagen=$_FILES ["fotouser"]["name"];
if($imagen==""){
  $imagen=$row_useredit['foto'];
}
else{
  $dir="../img/usuarios/".$row_useredit['foto']; //ubicación en el host (EJ, /imagenes/foto.jpg)
  if(file_exists($dir)) //verifica que el archivo existe
   {
   if(unlink($dir)){ // si es true, llama la función
  //echo "El archivo fue borrado";
   }
   }
  else{
   //echo "Este archivo no existe";
   } //si no, lo avisa.

   $imagenuser=$_FILES ["fotouser"]["name"];
    move_uploaded_file ($_FILES ["fotouser"]["tmp_name"],"../img/usuarios/".$imagenuser);
  }

  $forgot_pass_identity="";
  $contrasena=$_POST['password'];
  if($contrasena!=""){


  $updateSQL = sprintf("UPDATE administracion SET
      Nombre_completo=%s,Email=%s,Password='%s',phone=%s,forgot_pass_identity=%s,
      tipo=%s,foto=%s,estado=%s WHERE Id=$id",
      GetSQLValueString($_POST['Nombre_completo'], "text"),
      GetSQLValueString($_POST['Email'], "text"),
      password_hash($contrasena, PASSWORD_DEFAULT),
      GetSQLValueString($_POST['phone'], "text"),
      GetSQLValueString($forgot_pass_identity, "text"),
      GetSQLValueString($_POST['tipo'], "text"),
      GetSQLValueString($imagen,"text"),
      GetSQLValueString($_POST['estado'],"text"));
}
else{
  $updateSQL = sprintf("UPDATE administracion SET
      Nombre_completo=%s,Email=%s,phone=%s,forgot_pass_identity=%s,
      tipo=%s,foto=%s,estado=%s WHERE Id=$id",
      GetSQLValueString($_POST['Nombre_completo'], "text"),
      GetSQLValueString($_POST['Email'], "text"),
      GetSQLValueString($_POST['phone'], "text"),
      GetSQLValueString($forgot_pass_identity, "text"),
      GetSQLValueString($_POST['tipo'], "text"),
      GetSQLValueString($imagen,"text"),
      GetSQLValueString($_POST['estado'],"text"));
}
  $Result1 = mysqli_query($conexion2,$updateSQL) or die(mysqli_error($conexion2));

  $updateGoTo = 'mi-perfil.php?';
  header(sprintf("Location: %s",$updateGoTo.'resultado='.'Actualizacion-correcta'));
}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Usuarios</title>
<link href="../img/logo.ico" rel="icon" />
<link href="css/estilosadmin.css" rel="stylesheet" type="text/css" />
<link href="../fontawesome/css/all.css" rel="stylesheet">

<script>
function noautorizado ()
{
  rc = alert("Funcion solo para administradores");
  return rc;

}

function imprimir(){
  rc=print();
  return rc;
}
</script>
</head>

<body>
  <header>
    <?php include("includes/header.php"); ?>
  </header>





  <div class="contenido">

    <div class="cont-perfil">
    <div class="foto-perfil">
    <img src="../img/usuarios/<?php echo $row_perfil['foto']?>" alt="foto-perfil">
    </div>
    <div class="info-perfil">
    <h1>Usuario <?php echo $row_perfil['tipo']?></h1>
    <h2><?php echo $row_perfil['Nombre_completo']?></h2>
    <p><?php echo $row_perfil['Email']?></p>
    <p><?php echo $row_perfil['phone']?></p>
    <a href="mi-perfil.php?p=<?php echo base64_encode($row_perfil['Id'])?>"> <button id="actualizarperfil" type="button" name="perfil">Actualizar</button></a>
    </div>
    </div>

    <div class="lista-users">
      <div class="contenido_header">
        <button<?php if($_SESSION['tipo']=="Master"){ ?> <?php } else{?> onClick="javascript:return noautorizado();"<?php }?> class="btn-abrir-popup" id="btn-abrir-popup"><i class="fas fa-plus"></i> </button>
      </div>

      <table>
      <H1>Usuarios Registrados</H1>
      <a href="usuarios-pdf.php?p=<?php echo base64_encode($row_perfil['Id'])?>" target="_blank" > <button type="submit" ><i class="fas fa-download"></i> </button></a>
        <tr>
        <th></th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Tel.</th>
          <th>Estado</th>
          <th>Tipo</th>
          <th></th>
        </tr>
        <?php do { ?>
        <tr>
          <td><img src="../img/usuarios/<?php echo $row_usuarios['foto']?>" alt="">  </td>
          <td><?php echo $row_usuarios['Nombre_completo'] ?> </td>
          <td><?php echo $row_usuarios['Email'] ?></td>
          <td><?php echo $row_usuarios['phone'] ?></td>
          <td><?php echo $row_usuarios['estado'] ?></td>
          <td><?php echo $row_usuarios['tipo'] ?></td>
          <td>
            <a <?php if($_SESSION['tipo']=="Master"){ ?>  href="mi-perfil.php?id=<?php echo base64_encode($row_usuarios['Id']); ?>" class="btn-abrir-popup-edit" id="btn-abrir-popup" <?php } else{?> onClick="javascript:return noautorizado();"<?php }?>>
              <i class="fas fa-edit" style="float:left;"></i></a>
          </td>
        </tr>
        <?php } while ($row_usuarios= mysqli_fetch_assoc($usuarios));
      ?>
      </table>
    </div>


  </div>




      <!--****************************************************************************-->
      <!--FORMULARIO EDIT-PERFIL EMERGENTE-->
      <?php if($p!=0){ ?>

        <div class="overlay-edit" id="overlay" style="">
        			<div class="popup-edit" id="popup">

      				<h1>ACTUALIZAR PERFIL</h1>
      				<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="actualizarperfil" id="actualizar">
      					<div class="contenedor-inputs">
                  <img src="../img/usuarios/<?php echo $row_perfil['foto']?>" alt="" style="height:100px;cursor:pointer; float:left"onclick="document.getElementById('foto').click()" />

                  <i class="fa fa-camera" style="float:left; margin-top: 70px;cursor:pointer; " onclick="document.getElementById('foto').click()"></i>
      						<input style="width:50%; height: 40px;float:left; display:none" type="file" name="foto"id="foto" title="Seleciona una imagen de perfil">
                  <hr style="width:96%;">


                  <label for="Nombre">Nombre completo</label>
      						<input value="<?php echo $row_perfil['Nombre_completo']?>" style="width:96%; float:left; background:#ccc;" title="Nombre del usuario" type="text" name="Nombre_completo" maxlength="200" placeholder="Nombre del usuario" required >
                  <label for="Email">Enail</label>
                  <input value="<?php echo $row_perfil['Email']?>" style="width:96%; float:left; background:#ccc;" title="Email" type="text" name="Email" placeholder="Email@gmail.com">





                  <label for="password">Nueva contraseña</label>
      						<input style="width:96%; float:left; background:#ccc;" type="password" name="password"  placeholder="Nueva contraseña"  title="Contraseña minimo 8 caracteres solo en caso de queresrse cambiar">
                  <hr style="width:96%;">


                  <hr style="width:96%; border:none;">
                  <label for="Phone">Tell.</label>
      						<input value="<?php echo $row_perfil['phone']?>" style="width:50%; float:left; background:#ccc;" type="phone" name="phone" placeholder="4411010082" title="Telefono de contacto"  maxlength="10" required
                  pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'" >
                  <hr style="width:96%; ">
                  <label for="">Tipo</label>
      						<select class="tipo" name="tipo"
                  title="TRABAJADOR: Solo visualización
    MASTER:Todos los permisos" required <?php if($_SESSION['tipo']=="Trabajador"){ ?>disabled<?php }?> >
                    <option value="<?php echo $row_perfil['tipo']?>"><?php echo $row_perfil['tipo']?></option>
                    <option value="Trabajador">Trabajador</option>
                    <option value="Master">Master</option>
                  </select>

                  <label for="estado">Estado</label>
                  <select class="estado" name="estado" title="Estado en que se encuentra en la organización" required>
                    <option value="<?php echo $row_perfil['estado']?>"><?php echo $row_perfil['estado']?></option>
                    <option value="ALTA">ALTA</option>
                    <option value="BAJA">BAJA</option>
                  </select>


                  <hr style="width:96%; border:none;">



      					</div>
                <a href="mi-perfil.php"><button type="button" class="btn-submit"><i class="fas fa-times"></i> Cancelar</button></a>
      					<button type="submit" class="btn-submit"><i class="fas fa-check"></i> Guardar</button>
                <input type="hidden" name="MM_update" value="actualizarperfil" />
      				</form>
      			</div>
      		</div>
          <?php }?>


          <!--****************************************************************************-->
          <?php if($_SESSION['tipo']=="Master"){ ?>
          <!--FORMULARIO ADD-USUARIO EMERGENTE-->
          <div class="overlay" id="overlay">
          			<div class="popup" id="popup">

          				<h1>+ USUARIO</h1>
          				<form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="addusuario" id="addusuario">
          					<div class="contenedor-inputs">

                      <label for="Nombre">Nombre completo</label>
          						<input style="width:96%; float:left; background:#ccc;" title="Nombre del usuario" type="text" name="Nombre_completo" maxlength="200" placeholder="Nombre del usuario" required >
                      <label for="Email">Enail</label>
                      <input style="width:96%; float:left; background:#ccc;" title="Email" type="text" name="Email" placeholder="Email@gmail.com">
                      <hr style="width:96%;border:none;">



                      <hr style="width:96%;">
                      <label for="password">Contraseña</label>
          						<input style="width:96%; float:left; background:#ccc;" type="password" name="password"  placeholder="contraseña" required  title="Contraseña minimo 8 caracteres">
                      <hr style="width:96%;">


                      <hr style="width:96%; border:none;">
                      <label for="Phone">Tell.</label>
          						<input style="width:50%; float:left; background:#ccc;" type="phone" name="phone" placeholder="4411010082" title="Telefono de contacto"  maxlength="10" required
                      pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'" >
                      <hr style="width:96%; ">
                      <label for="">Tipo</label>
          						<select class="tipo" name="tipo"
                      title="TRABAJADOR: Solo visualización,
        MASTER:Todos los permisos" required>
                        <option value=""></option>
                        <option value="Trabajador">Trabajador</option>
                        <option value="Master">Master</option>
                      </select>

                      <label for="maximo">Estado</label>
                      <select class="estado" name="estado" title="Estado en que se encuentra en la organización" required>
                        <option value=""></option>
                        <option value="ALTA">ALTA</option>
                        <option value="BAJA">BAJA</option>
                      </select>


                      <hr style="width:96%; border:none;">
                      <label for="Imagen">Imagen</label>
          						<input style="width:96%; height: 40px;float:left;" type="file" name="imagen"id="imagen" placeholder="Imagen" title="Seleciona una imagen de perfil">
                      <hr style="width:96%; border:none;">


          					</div>
                    <a href="mi-perfil.php" id="btn-cerrar-popup"><button type="button" class="btn-submit"><i class="fas fa-times"></i> Cancelar</button></a>
          					<button type="submit" class="btn-submit"><i class="fas fa-check"></i> Guardar</button>
                    <input type="hidden" name="MM_insert" value="addusuario" />
          				</form>
          			</div>
          		</div>



          <!--****************************************************************************-->
          <!--FORMULARIO EDIT-USER EMERGENTE-->
          <?php if($id!=0){ ?>

            <div class="overlay-edit" id="overlay" style="">
                  <div class="popup-edit" id="popup">

                  <h1>ACTUALIZAR USUARIO</h1>
                  <form action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="actualizarusuario" id="actualizar">
                    <div class="contenedor-inputs">
                      <img src="../img/usuarios/<?php echo $row_useredit['foto']?>" alt="" style="height:100px;cursor:pointer; float:left"onclick="document.getElementById('fotouser').click()" />

                      <i class="fa fa-camera"style="float:left; margin-top: 70px;cursor:pointer; " onclick="document.getElementById('fotouser').click()" ></i>
                      <input style="width:50%; height: 40px;float:left;display:none" type="file" name="fotouser"id="fotouser"  title="Seleciona una imagen de perfil">
                      <hr style="width:96%;">


                      <label for="Nombre">Nombre completo</label>
                      <input value="<?php echo $row_useredit['Nombre_completo']?>" style="width:96%; float:left; background:#ccc;" title="Nombre del usuario" type="text" name="Nombre_completo" maxlength="200" placeholder="Nombre del usuario" required >
                      <label for="Email">Enail</label>
                      <input value="<?php echo $row_useredit['Email']?>" style="width:96%; float:left; background:#ccc;" title="Email" type="text" name="Email" placeholder="Email@gmail.com">





                      <label for="password">Nueva contraseña</label>
                      <input style="width:96%; float:left; background:#ccc;" type="password" name="password"  placeholder="Nueva contraseña"  title="Contraseña minimo 8 caracteres solo en caso de queresrse cambiar">
                      <hr style="width:96%;">


                      <hr style="width:96%; border:none;">
                      <label for="Phone">Tell.</label>
                      <input value="<?php echo $row_useredit['phone']?>" style="width:50%; float:left; background:#ccc;" type="phone" name="phone" placeholder="4411010082" title="Telefono de contacto"  maxlength="10" required
                      pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'" >
                      <hr style="width:96%; ">
                      <label for="">Tipo</label>
                      <select class="tipo" name="tipo"
                      title="TRABAJADOR: Solo visualización
          MASTER:Todos los permisos" required>
                        <option value="<?php echo $row_useredit['tipo']?>"><?php echo $row_useredit['tipo']?></option>
                        <option value="Trabajador">Trabajador</option>
                        <option value="Master">Master</option>
                      </select>

                      <label for="estado">Estado</label>
                      <select class="estado" name="estado" title="Estado en que se encuentra en la organización" required>
                        <option value="<?php echo $row_useredit['estado']?>"><?php echo $row_useredit['estado']?></option>
                        <option value="ALTA">ALTA</option>
                        <option value="BAJA">BAJA</option>
                      </select>


                      <hr style="width:96%; border:none;">



                    </div>
                    <a href="mi-perfil.php" id="btn-cerrar-popup"><button type="button" class="btn-submit"><i class="fas fa-times"></i> Cancelar</button></a>
                    <button type="submit" class="btn-submit"><i class="fas fa-check"></i> Guardar</button>
                    <input type="hidden" name="MM_updateuser" value="actualizaruser" />
                  </form>
                </div>
              </div>
              <?php }?>
            <?php }?>



      <script src="js/popup.js"></script>
      <script src="js/valid_producto.js"></script>

  <footer>
    <div class="logo">
      <img src="../img/<?php echo $row_info['Logo']?>" alt="" title="logotipo" >
    </div>
    <div id="copyright">
      Copyright&nbsp&copy;&nbsp;2021 - Todos los derechos reservados</div>
  </footer>

</body>
</html>
