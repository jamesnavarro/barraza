<?php 
                       
$request=Connection::runQuery("SELECT a.*, b.* FROM actividad a, ordenes b WHERE b.estado_ord='Pendiente' and b.orden='".$orden."' and a.id_paciente=b.id_paciente and a.orden_servicio=b.orden group by a.Id");
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'# Orden'.'</th>';
              $table = $table.'<th>'.'Visitas'.'</th>';
              $table = $table.'<th>'.'Fecha Inicio'.'</th>';
              $table = $table.'<th>'.'Fecha Fin'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Porcentaje(%)'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["Id"].'">';}else{$ver='';}
           if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){$b='<a href="../form_editar/formulario_editar_proyecto.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../modelo/eliminar.php?act='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
           if(date("Y-m-d").' '.$hora > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d").' '.$hora <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="black">';}
          
           if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
           
            $table = $table.'<tr><td>'.$color.''.$row['orden_servicio'].'</font></td><td>'.$ver.''.$color.''.$row["Subject"].'<font></a></td></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td><td>'.$color.''.$row['porcentaje'].'%</font></td>
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';   
               
           }
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
       
                       ?>
