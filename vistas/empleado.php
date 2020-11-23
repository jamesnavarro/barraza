<?php  require '../modelo/consulta_usuario.php'; ?>
 <script> 
var ventana_secundaria 
function change_pass(){  
ventana_secundaria = window.open("../vistas/form_contrasena.php","miventana","width=500,height=200,menubar=no") 
} 
</script>
<article class="module width_full">
<header><h3>Informacion del empleado</h3></header><hr>
<h4 class="inf">Empleado :<?php 
echo "$nombre_u".' '."$apellido_u";
?> (<?php echo $user_u ?>)</h4><br>


<hr>
    <?php  if(($_SESSION['k_username']) == 'admin'){ ?><a href="../vistas/?id=user&cod=<?php echo ($idus); ?>"> <input type="button" name="enviar" value="Editar" class="alt_btn"></a><?php } ?>
<input type="button" name="crear" value="Cambiar Contraseña" onclick="change_pass()">

<hr><br>



<table class="table table-bordered table-striped table-hover">
<tr>
<th style="width: 100px"><label>Nombre :</label></th>
<td><?php echo "$nombre_u".' '."$apellido_u"; ?></td>
<th style="width: 200px"><label>identificador :</label></th>
<td><?php echo "$user_u"; $_SESSION['id_usuario']=$idus; ?></td>
</tr>
<tr>
<th><label>Cedula :</label></th>
<td><?php echo "$cedula"; ?></td>
<th><label>Email :</label></th>
<td><?php echo "$email_u"; ?></td>
</tr>
<tr>
<th><label>Informacion Adicional:</label></th>
<td><?php echo "$descripcion_u"; ?></td>
<th><label>Administracion del sistema :</label></th>
<td><?php echo "$administrador_u"; ?></td>
</tr>
<tr>
<th style="width: 150px"><label>Estado del empleado:</label></th>
<td><?php echo "$estado_empleado"; ?></td>

<th><label>tel. celular:</label></th>
<td><?php echo "$movil_u"; ?></td>
</tr>

<tr>
<th><label>Ocupación:</label></th>
<td><?php echo "$cargo_u"; ?></td>
<th><label>Telefono:</label></th>
<td><?php echo "$tel_u"; ?></td>
</tr>


<tr>
<th><label>ciudad:</label></th>
<td><?php echo "$ciudad"; ?></td>
<th><label>Direccion:</label></th>
<td><?php echo "$dir_u"; ?></td>
</tr>
<tr>
<th><label>Municipio:</label></th>
<td><?php echo "$municipio_u"; ?></td>

<th><label>Fecha de registro:</label></th>
<td><?php echo "$registro_u"; ?></td>
</tr>
</table>





                                       <hr><br>
                        
                                       
                       
		</article>
              <article class="module width_full">
			<header  onload="recargar()"><h3>Pacientes a cargo</h3></header>
                        <hr>
                        <?php 
                        if(isset($_POST["boc"])){
 $var=$_POST["boc"];
if ($var == "Nuevo"){
    include '../vistas/form_contacto_2.php';
}

}  else {
   include '../funciones/mostrar_contacto_1.php'; 
}

                       
                       ?>
		</article>


