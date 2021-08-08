function mostrar(id) {
  var otro_municipio=document.getElementById("otro_municipio");
  var selector= document.getElementById('optionUbicacion');
    if (id == "otro") {

        otro_municipio.style="display:blok";
        otro_municipio.style="margin-top:5px";
      document.querySelector('#otro_municipio').required = true;
      document.querySelector('#optionUbicacion').required = false;
        selector.style="margin-top:5px";

    }
    if (id != "otro") {
        otro_municipio.style="display:none";
        selector.style="margin-top:30px;";

    }
}
