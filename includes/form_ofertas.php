<?php require_once('Connections/conexion2.php'); ?>
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



//SOLICITAR UNA OFERTA
if ((isset($_POST["oferta"])) && ($_POST["oferta"] == "opteneroferta")) {

$ubicacion ="";
if($_POST['ubicacion']!='otro'){
  $ubicacion=$_POST['ubicacion'];
}
else {
  $ubicacion=$_POST['otro_municipio'];
}
  $insertSQL = sprintf("INSERT INTO ofertas (Nombre,Apeido,Email,Ubicacion)
                                    VALUES (%s,%s,%s,%s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apeido'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($ubicacion,"text"));

                       $Result1 = mysqli_query($conexion2,$insertSQL ) or die(mysqli_error());
                       if(!$Resultl){
                         print '<script language="JavaScript">';
                         print 'confirm("Resiviras ofertas por correo?");';
                         print '</script>'; }
                     }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>


    <!--Funcion para modificar el formulario de solicitud de ofertas -->
    <script type="text/javascript" src="js/optener_ofertas.js"></script>
  </head>
  <body>
    <div class="optener_ofertas">
      <div class="transparencia">
        </div>
        <h1>Optener ofertas</h1>
        	<form action="<?php echo $editFormAction; ?>"  method="post" name="opteneroferta" id="opteneroferta">

            <input type="text" name="nombre"  placeholder="Nombre" required title="Nombre"/>


            <input type="text" name="apeido"  placeholder="Primer apeido" required title="Nombre"/>


            <input type="email" name="email"  placeholder="Email" required title="Correo electronico"/>


            <select class="ubicacion" name="ubicacion"  onChange="mostrar(this.value);" title="Lugar de donde de ubicación" id="optionUbicacion" required>
              <option disabled selected value="">selecciona tu Municipio</option>
              <option value="Jalpan de serra">Jalpan de serra</option>
              <option value="Landa de matamoros">Landa de matamoros</option>
              <option value="Pinal de Amoles">Pinal de Amoles</option>
              <option value="otro">Otro</option>
            </select>
            <input type="text" name="otro_municipio" id="otro_municipio" style="display:none;"  placeholder="Municipio"  title="Escribe tu municipio"/>

            <button type="submit" class="btn-submit"><i class="fas fa-check"></i> Registrarme</button>
            <input type="hidden" name="oferta" value="opteneroferta" />
      </form>
    </div>
  </body>
</html>
