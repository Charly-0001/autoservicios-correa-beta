var correo = document.getElementById('correo');
var terminal = document.getElementById('terminal');
var password = document.getElementById('password');



password.oninvalid = function(event) {
   event.target.setCustomValidity('Ingrese su contraseña');
}

correo.oninvalid = function(event) {
    event.target.setCustomValidity('Deve ingresar su correo');
}

terminal.oninvalid = function(event) {
    event.target.setCustomValidity('Ingrese la terminal en la que se encuentra');
}
