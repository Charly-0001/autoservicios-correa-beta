var nombre = document.getElementById('nombre_producto');
var ixsmagen =document.getElementById('imacgen');


imadgen.oninvalid = function(event) {
    event.target.setCustomValidity('Coloque una imagen para de su producto');
}
