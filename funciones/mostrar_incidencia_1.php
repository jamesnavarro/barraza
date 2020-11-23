<form action="" method="post" name="fcontacto">
                        <header><h3> <input type="submit" name="bin" value="Nuevo"/>  </h3></header>
                       </form> 
<?php 
                       
$request=Connection::runQuery('select * from sis_incidencias where id_empresa='.$id_empresa);
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

                  $table = $table.'<thead>';
                  $table = $table.'<tr>';
                  $table = $table.'<th>'.'Num.'.'</th>';
                  $table = $table.'<th>'.'Asunto'.'</th>';
                  $table = $table.'<th>'.'Estado'.'</th>';
                  $table = $table.'<th>'.'Tipo'.'</th>';
                  $table = $table.'<th>'.'prioridad'.'</th>';
                  $table = $table.'<th>'.'Corregido en Lanzamiento'.'</th>';
                  $table = $table.'<th>'.'Usuario'.'</th>';
                  $table = $table.'<th>'.'Editar'.'</th>';
               $table = $table.'<th>'.'Eliminar'.'</th>';
                  $table = $table.'</tr>';
                  $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{     
            
            
            if($modulo_rIN=='Incidencias' && $ver_rIN=='Habilitado'){
                if($modulo_rIN=='Incidencias' && $editar_rIN=='Habilitado'){
                if($modulo_rIN=='Incidencias' && $eliminar_rIN=='Habilitado'){
                $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_incidencia.php?codigo='.$row["id_incidencia"].'">'.$row['id_incidencia'].'</a></td>
                  <td><a href="../vistas/mostrar_detalle_incidencia.php?codigo='.$row["id_incidencia"].'">'.$row['asunto_inc'].'</a></td>
                      <td>'.$row['estado_inc'].'</a></td><td>'.$row['tipo_inc'].'</a></td><td>'.$row['prioridad_inc'].'</td><td>'.$row['lanzamiento_inc'].'</td>
                          <td>'.$row['asignado_inc'].'</td><td><a href="empleados.php?codigo='.$row["id_incidencia"].'">
                              <img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td><a href="../modelo/eliminar.php?eliminar_in='.$row["id_incidencia"].'">
                                  <img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
            }else{
                $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_incidencia.php?codigo='.$row["id_incidencia"].'">'.$row['id_incidencia'].'</a></td>
                  <td><a href="../vistas/mostrar_detalle_incidencia.php?codigo='.$row["id_incidencia"].'">'.$row['asunto_inc'].'</a></td>
                      <td>'.$row['estado_inc'].'</a></td><td>'.$row['tipo_inc'].'</a></td><td>'.$row['prioridad_inc'].'</td><td>'.$row['lanzamiento_inc'].'</td>
                          <td>'.$row['asignado_inc'].'</td><td><a href="empleados.php?codigo='.$row["id_incidencia"].'">
                              <img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td></td></tr>';
            }
            }else{
                if($modulo_rIN=='Incidencias' && $eliminar_rIN=='Habilitado'){
                $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_incidencia.php?codigo='.$row["id_incidencia"].'">'.$row['id_incidencia'].'</a></td>
                  <td><a href="../vistas/mostrar_detalle_incidencia.php?codigo='.$row["id_incidencia"].'">'.$row['asunto_inc'].'</a></td>
                      <td>'.$row['estado_inc'].'</a></td><td>'.$row['tipo_inc'].'</a></td><td>'.$row['prioridad_inc'].'</td><td>'.$row['lanzamiento_inc'].'</td>
                          <td>'.$row['asignado_inc'].'</td><td><a href="empleados.php?codigo='.$row["id_incidencia"].'">
                              <img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td><a href="../modelo/eliminar.php?eliminar_in='.$row["id_incidencia"].'">
                                  <img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
            }else{
                $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_incidencia.php?codigo='.$row["id_incidencia"].'">'.$row['id_incidencia'].'</a></td>
                  <td><a href="../vistas/mostrar_detalle_incidencia.php?codigo='.$row["id_incidencia"].'">'.$row['asunto_inc'].'</a></td>
                      <td>'.$row['estado_inc'].'</a></td><td>'.$row['tipo_inc'].'</a></td><td>'.$row['prioridad_inc'].'</td><td>'.$row['lanzamiento_inc'].'</td>
                          <td>'.$row['asignado_inc'].'</td><td></td><td></td></tr>';
            }
            }
            }else{
                if($modulo_rIN=='Incidencias' && $editar_rIN=='Habilitado'){
                if($modulo_rIN=='Incidencias' && $eliminar_rIN=='Habilitado'){
                $table = $table.'<tr><td>'.$row['id_incidencia'].'</td>
                  <td>'.$row['asunto_inc'].'</td>
                      <td>'.$row['estado_inc'].'</a></td><td>'.$row['tipo_inc'].'</a></td><td>'.$row['prioridad_inc'].'</td><td>'.$row['lanzamiento_inc'].'</td>
                          <td>'.$row['asignado_inc'].'</td><td><a href="empleados.php?codigo='.$row["id_incidencia"].'">
                              <img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td><a href="../modelo/eliminar.php?eliminar_in='.$row["id_incidencia"].'">
                                  <img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
            }else{
                $table = $table.'<tr><td>'.$row['id_incidencia'].'</td>
                  <td>'.$row['asunto_inc'].'</td>
                      <td>'.$row['estado_inc'].'</a></td><td>'.$row['tipo_inc'].'</a></td><td>'.$row['prioridad_inc'].'</td><td>'.$row['lanzamiento_inc'].'</td>
                          <td>'.$row['asignado_inc'].'</td><td><a href="empleados.php?codigo='.$row["id_incidencia"].'">
                              <img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td></td></tr>';
            }
            }else{
                if($modulo_rIN=='Incidencias' && $eliminar_rIN=='Habilitado'){
                $table = $table.'<tr><td>'.$row['id_incidencia'].'</td>
                  <td>'.$row['asunto_inc'].'</td>
                      <td>'.$row['estado_inc'].'</a></td><td>'.$row['tipo_inc'].'</a></td><td>'.$row['prioridad_inc'].'</td><td>'.$row['lanzamiento_inc'].'</td>
                          <td>'.$row['asignado_inc'].'</td><td><a href="empleados.php?codigo='.$row["id_incidencia"].'">
                              <img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td><a href="../modelo/eliminar.php?eliminar_in='.$row["id_incidencia"].'">
                                  <img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
            }else{
                $table = $table.'<tr><td>'.$row['id_incidencia'].'</td>
                  <td>'.$row['asunto_inc'].'</td>
                      <td>'.$row['estado_inc'].'</a></td><td>'.$row['tipo_inc'].'</a></td><td>'.$row['prioridad_inc'].'</td><td>'.$row['lanzamiento_inc'].'</td>
                          <td>'.$row['asignado_inc'].'</td><td></td><td></td></tr>';
            }
            }
            }
              
        }
        
	$table = $table.'</table>';
        
	echo $table;
        
}
                       
                       ?>