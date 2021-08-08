
  <img src="../img/error.png" alt="">
<p>Intente ingresar después, si el problema persiste comuníquese a el área de sistemas.</p>
  <?php
  function error($error)
  {
    if($error=="404"){
      echo "404: pagina no encontrada";
    }
    elseif($error=="501"){
      echo "501:Pagina en desarrollo";
    }
  }
  ?>
