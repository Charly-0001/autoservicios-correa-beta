<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion2 = "localhost";
$database_conexion2 = "correas";
$username_conexion2 = "root";
$password_conexion2 = "Qwerty123";
$conexion2 = mysqli_connect($hostname_conexion2, $username_conexion2, $password_conexion2,$database_conexion2) or trigger_error(mysqli_error(),E_USER_ERROR);


?>
<?php
if( is_file("includes/funciones.php")){
	include("includes/funciones.php");
}
else{

}
?>
