var gasto = document.getElementById('gasto');


gasto.oninvalid = function(event) {
    event.target.setCustomValidity('Cantidad invalida');
}
