<form action="" method="post" name="fcontacto">
                        <header><h3> <input type="submit" name="bpr" value="Nuevo"/>  </h3></header>
                       </form> 
<?php 
                       
$request=Connection::runQuery("SELECT * FROM sis_proyecto WHERE id_empresa=".$id_empresa."");
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              $table = $table.'<th>'.'Fecha Inicio'.'</th>';
              $table = $table.'<th>'.'Fecha Fin'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              //$table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
                
                if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){
                    if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){
                    if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id_proyecto"].'">'.$row["nombre_pro"].'</a></td>
                    <td>'.$row['fecha_inicial'].'</td><td>'.$row['fecha_final'].'</td><td>'.$row['estado_pro'].'</td>
                                <td>'.$row['usuario'].'</td>
                                    
                                        <td><a href="../modelo/eliminar.php?eliminar_pro='.$row["id_proyecto"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                }else{
                    $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id_proyecto"].'">'.$row["nombre_pro"].'</a></td>
                    <td>'.$row['fecha_inicial'].'</td><td>'.$row['fecha_final'].'</td><td>'.$row['estado_pro'].'</td>
                                <td>'.$row['usuario'].'</td>
                                   
                                        <td></td></tr>';
                }
                }else{
                    if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id_proyecto"].'">'.$row["nombre_pro"].'</a></td>
                    <td>'.$row['fecha_inicial'].'</td><td>'.$row['fecha_final'].'</td><td>'.$row['estado_pro'].'</td>
                                <td>'.$row['usuario'].'</td>
                                    <td></td>
                                        <td><a href="../modelo/eliminar.php?eliminar_pro='.$row["id_proyecto"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                }else{
                    $table = $table.'<tr><td><a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id_proyecto"].'">'.$row["nombre_pro"].'</a></td>
                    <td>'.$row['fecha_inicial'].'</td><td>'.$row['fecha_final'].'</td><td>'.$row['estado_pro'].'</td>
                                <td>'.$row['usuario'].'</td>
                                    <td></td>
                                        <td></td></tr>';
                }
                }
                }else{
                    if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){
                    if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){
                    $table = $table.'<tr><td>'.$row["nombre_pro"].'</td>
                    <td>'.$row['fecha_inicial'].'</td><td>'.$row['fecha_final'].'</td><td>'.$row['estado_pro'].'</td>
                                <td>'.$row['usuario'].'</td>
                                   
                                        <td><a href="../modelo/eliminar.php?eliminar_pro='.$row["id_proyecto"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                }else{
                    $table = $table.'<tr><td>'.$row["nombre_pro"].'</td>
                    <td>'.$row['fecha_inicial'].'</td><td>'.$row['fecha_final'].'</td><td>'.$row['estado_pro'].'</td>
                                <td>'.$row['usuario'].'</td>
                                    
                                        <td></td></tr>';
                }
                }else{
                    if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){
                    $table = $table.'<tr><td>'.$row["nombre_pro"].'</td>
                    <td>'.$row['fecha_inicial'].'</td><td>'.$row['fecha_final'].'</td><td>'.$row['estado_pro'].'</td>
                                <td>'.$row['usuario'].'</td>
                                    <td></td>
                                        <td><a href="../modelo/eliminar.php?eliminar_pro='.$row["id_proyecto"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                }else{
                    $table = $table.'<tr><td>'.$row["nombre_pro"].'</td>
                    <td>'.$row['fecha_inicial'].'</td><td>'.$row['fecha_final'].'</td><td>'.$row['estado_pro'].'</td>
                                <td>'.$row['usuario'].'</td>
                                    <td></td>
                                        <td></td></tr>';
                }
                }
                }
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
                       
                       ?>
