<form action="" method="post" name="fcontacto">
                        <header><h3> <input type="submit" name="bca" value="Nuevo"/>  </h3></header>
                       </form> 
<?php 
                       
$request=Connection::runQuery('select * from sis_casos where id_CONTACTO='.$idc);
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Nuevo'.'</th>';
              $table = $table.'<th>'.'Asunto'.'</th>';
              
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Fecha de creacion'.'</th>';
              $table = $table.'<th>'.'Usuario Asignado'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
               $table = $table.'<th>'.'Eliminar'.'</th>'; 
              
           $table = $table.'</tr>';

$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
               
        if($modulo_rE=='Empresa' && $ver_rE=='Habilitado'){
            if($modulo_rCA=='Casos' && $ver_rCA=='Habilitado'){
            if($modulo_rCA=='Casos' && $editar_rCA=='Habilitado'){
             if($modulo_rCA=='Casos' && $eliminar_rCA=='Habilitado'){$table = $table.'<tr><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['id_caso'].'</a></td><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td><a href="../form_editar/formulario_editar_casos.php?codigo='.$row["id_caso"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td><a href="../modelo/eliminar.php?eliminar_c='.$row["id_caso"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               }else{
                   $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['id_caso'].'</a></td><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td><a href="../form_editar/formulario_editar_casos.php?codigo='.$row["id_caso"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td></td></tr>';
               }
        }else{
             if($modulo_rCA=='Casos' && $eliminar_rCA=='Habilitado'){$table = $table.'<tr><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['id_caso'].'</a></td><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td></td>
                            <td><a href="../modelo/eliminar.php?eliminar_c='.$row["id_caso"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               }else{
                   $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['id_caso'].'</a></td><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['asunto_caso'].'</a></td>><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td></td>
                            <td></td></tr>';
               }
        }
        }else{
            if($modulo_rCA=='Casos' && $editar_rCA=='Habilitado'){
             if($modulo_rCA=='Casos' && $eliminar_rCA=='Habilitado'){$table = $table.'<tr><td>'.$row['id_caso'].'</td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td><a href="../form_editar/formulario_editar_casos.php?codigo='.$row["id_caso"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td><a href="../modelo/eliminar.php?eliminar_c='.$row["id_caso"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               }else{
                   $table = $table.'<tr><td>'.$row['id_caso'].'</td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td><a href="../form_editar/formulario_editar_casos.php?codigo='.$row["id_caso"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td></td></tr>';
               }
        }else{
             if($modulo_rCA=='Casos' && $eliminar_rCA=='Habilitado'){$table = $table.'<tr><td>'.$row['id_caso'].'</td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td></td>
                            <td><a href="../modelo/eliminar.php?eliminar_c='.$row["id_caso"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               }else{
                   $table = $table.'<tr><td>'.$row['id_caso'].'</td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td></td>
                            <td></td></tr>';
               }
        }
        } }else{
            if($modulo_rCA=='Casos' && $ver_rCA=='Habilitado'){
            if($modulo_rCA=='Casos' && $editar_rCA=='Habilitado'){
             if($modulo_rCA=='Casos' && $eliminar_rCA=='Habilitado'){$table = $table.'<tr><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['id_caso'].'</a></td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td><a href="../form_editar/formulario_editar_casos.php?codigo='.$row["id_caso"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td><a href="../modelo/eliminar.php?eliminar_c='.$row["id_caso"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               }else{
                   $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['id_caso'].'</a></td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td><a href="../form_editar/formulario_editar_casos.php?codigo='.$row["id_caso"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td></td></tr>';
               }
        }else{
             if($modulo_rCA=='Casos' && $eliminar_rCA=='Habilitado'){$table = $table.'<tr><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['id_caso'].'</a></td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td></td>
                            <td><a href="../modelo/eliminar.php?eliminar_c='.$row["id_caso"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               }else{
                   $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_caso.php?codigo='.$row["id_caso"].'">'.$row['id_caso'].'</a></td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td></td>
                            <td></td></tr>';
               }
        }
        }else{
            if($modulo_rCA=='Casos' && $editar_rCA=='Habilitado'){
             if($modulo_rCA=='Casos' && $eliminar_rCA=='Habilitado'){$table = $table.'<tr><td>'.$row['id_caso'].'</td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td><a href="../form_editar/formulario_editar_casos.php?codigo='.$row["id_caso"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td><a href="../modelo/eliminar.php?eliminar_c='.$row["id_caso"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               }else{
                   $table = $table.'<tr><td>'.$row['id_caso'].'</td><td>'.$row['asunto_caso'].'</a></td><td>
                    '.$_SESSION['empresa'].'</td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td><a href="../form_editar/formulario_editar_casos.php?codigo='.$row["id_caso"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td></td></tr>';
               }
        }else{
             if($modulo_rCA=='Casos' && $eliminar_rCA=='Habilitado'){$table = $table.'<tr><td>'.$row['id_caso'].'</td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</a></td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td></td>
                            <td><a href="../modelo/eliminar.php?eliminar_c='.$row["id_caso"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               }else{
                   $table = $table.'<tr><td>'.$row['id_caso'].'</td><td>'.$row['asunto_caso'].'</a></td><td>'.$row['prioridad_caso'].'</td><td>'.$row['estado_caso'].'</td>
                        <td>'.$row['asignado_caso'].'</td><td></td>
                            <td></td></tr>';
               }
        }
        } 
        }
        
		
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
                       
                       ?>
