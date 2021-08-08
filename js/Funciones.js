// JavaScript Document
function mostrarReloj(){
   var d = new Date();
   var r = d.toLocaleTimeString();
   return document.getElementById("reloj").innerHTML=r;
}
