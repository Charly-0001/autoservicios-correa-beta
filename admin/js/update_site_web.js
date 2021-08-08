function mostrar() {
  var abrir_generales=document.getElementById("abrir_generales");
  var cerrar_generales=document.getElementById("cerrar_generales");
  var form_generales =document.getElementById('generales');

        form_generales.style="display:blok";
        abrir_generales.style="display:none";
        cerrar_generales.style="display:blok";
}


function cerrar() {
  var abrir_generales=document.getElementById("abrir_generales");
  var cerrar_generales=document.getElementById("cerrar_generales");
  var form_generales =document.getElementById('generales');

        form_generales.style="display:none";
        abrir_generales.style="display:blok";
        cerrar_generales.style="display:none";
}


function mostrarAvanzada() {
  var abrir_avanzada=document.getElementById("abrir_avanzada");
  var cerrar_avanzada=document.getElementById("cerrar_avanzada");
  var form_avanzada =document.getElementById('avanzada');
  var tips=document.getElementById('Tips');

        form_avanzada.style="display:blok";
        abrir_avanzada.style="display:none";
        cerrar_avanzada.style="display:blok";
        tips.style="display:blok";
}

function cerrarAvanzada() {
  var abrir_avanzada=document.getElementById("abrir_avanzada");
  var cerrar_avanzada=document.getElementById("cerrar_avanzada");
  var form_avanzada =document.getElementById('avanzada');
  var tips=document.getElementById('Tips');

        form_avanzada.style="display:none";
        abrir_avanzada.style="display:blok";
        cerrar_avanzada.style="display:none";
        tips.style="display:none"
}
