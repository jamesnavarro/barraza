<form action="" method="post" name="fcontacto">
                        <header><h3> <input type="submit" name="bin" value="Nuevo"/>  </h3></header>
                       </form> 
<?php 
                       
$request=Connection::runQuery('select * from sis_incidencias where id_CONTACTO='.$idc);
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
                
                  $table = $table.'<th>'.'Usuario'.'</th>';
                  $table = $table.'<th>'.'Editar'.'</th>';
               $table = $table.'<th>'.'Eliminar'.'</th>';
                  $table = $table.'</tr>';
                  $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{     
            if($modulo_rIN=='Incidencias' && $ver_rIN=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_incidencia.php?codigo='.$row["id_incidencia"].'">';}else{$ver='';}
           if($modulo_rIN=='Incidencias' && $editar_rIN=='Habilitado'){$b='<a href="../form_editar/formulario_editar_incidencia.php?codigo='.$row["id_incidencia"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rIN=='Incidencias' && $eliminar_rIN=='Habilitado'){$c='<a href="../modelo/eliminar.php?eliminar_i='.$row["id_incidencia"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
          
           
           
           $table = $table.'<tr><td>'.$ver.''.$row["id_incidencia"].'<font></a></td></td>
               <td>'.$ver.''.$row["asunto_inc"].'</font></td><td>'.$row["estado_inc"].'</font></td><td>'.$row['tipo_inc'].'</font></td>
                   <td>'.$row['prioridad_inc'].'</font></td><td>'.$row['asignado_inc'].'</font></td>
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';
            
            
        }
        
	$table = $table.'</table>';
        
	echo $table;
        
}
                       
?>