
<!--Funcion para modificar el formulario de solicitud de ofertas -->
<script type="text/javascript" src="js/user.js"></script>

<div class="menu_user">
  <?php $nombreUsuario = ObtenerNombreUsuario( $_SESSION['MM_idAdmin']); ?>
  <?php if($_SESSION['tipo']=="Master"){?> <i class="fas fa-user"></i><i class="fas fa-unlock" style="font-size:10px;" ></i><?php } else{?><i class="fas fa-user-lock"></i><?php } ?></p6>
<input type="text" id='tipo_usuario' value="<?php echo $_SESSION['tipo']?>" style="display:none;">
  <select class="usuario" id="valid_user" onChange="validar(this.value);">
    <option disabled><?php echo $_SESSION['tipo']?></option>
    <option ><?php echo $nombreUsuario ?></option>
    <option value="perfil"> Perfil</option>
    <?php if($_SESSION['tipo']=='Master'){?>
    <option  value="add" >+ Usuario</option><?php }?>
    <option value="cerrar_turno">X Cerrar turno</option>
  </select>

</div >
