
function validar(value) {
  var tipo=document.getElementById('tipo_usuario');
  if(value=="perfil"){
    location.href ="mi-perfil.php";
  }
if(value=="cerrar_turno"){
  location.href ="delete_SESSION.PHP";
}
if (value=="add") {
  location.href="mi-perfil.php?new=user";
}
}
