<?php
         include '../modelo/conexion.php';
         if(isset($_POST['asesor'])){
              $request=mysql_query('SELECT * FROM `usuarios` where  estado_empleado = "'.$_POST['estado'].'" and concat(nombre," ",apellido) like "%'.$_POST['asesor'].'%" ');
         }else{
    $request=mysql_query('SELECT * FROM `usuarios` where estado_empleado = "Activo" order by nombre ');
         }
    ?>
<table class="table table-bordered table-striped table-hover" id="">
            <thead >
            <tr BGCOLOR="#C3D9FF">
                
              <th width="10%">No Documento</th>
              <th width="30%">Nombre del Vendedor</th>
              <th width="30%">Usuario</th>
              <th width="30%">Estado</th>
              </tr>
              </thead>
	
    
   <?php
	while($rowk=mysql_fetch_array($request))
	{    
            
           ?> 
           <tr>
                <td width="5%"><?php echo $rowk['cedula'];?></font></td>
                  <td width="30%"><a href="../vistas/a_usuarios.php?codigo=<?php echo $rowk["id"]?>"><?php echo $rowk['nombre'].' '.$rowk['apellido'];?></a></td>
                  <td width="5%"><?php echo $rowk['usuario'];?></font></td><td width="5%"><?php echo $rowk['estado_empleado'];?></font></td>
            </tr>
           	
        <?php          
	} 	
        ?> 
 </table>

