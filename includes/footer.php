
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "mensaje")) {

$whats = $_POST['whatsapp'];

                                      $insertGoTo = "https://api.whatsapp.com/send?phone=524411010082&text=$whats";
                                      if (isset($_SERVER['QUERY_STRING'])) {
                                        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
                                        $insertGoTo .= $_SERVER['QUERY_STRING'];
                                      }
                                      header(sprintf ("Location: %s", $insertGoTo));
                                    }
?>

    <div class="footer-left">
      <div class="logo_footer">
    <img src="img/logo.png" alt="">
      </div>
      <h4>Politicas de privacidad</h4>
      <div class="coopy">
        <h4>© 2021 Autoservicios correa. Todos los derechos reservados</h4>
      </div>
    </div>


    <div class="footer-center">
        <h4>¡Reserva tu cita hoy mismo!</h4>
        <h4><i class="fab fa-whatsapp" style="color:#00bb2d;"></i> Pregunta sin compromiso </h4>

        <form  action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" method="post" name="mensaje"  >
          <input type="text" name="whatsapp" value="">

        <input id="btn_reserbacion" value="Whatsapp" type="submit"/>
        <input type="hidden" name="MM_insert"   value="mensaje" />
        </form>
    </div>

    <div class="footer_right">
        <h4>¡Siguenos en nuestras redes sociales para compartir tus opiniones!</h4>
        <div class="redesSociales">
          <img src="img/facebook.png" alt="facebook">
          <img src="img/whatsApp.png" alt="">
        </div>
    </div>
