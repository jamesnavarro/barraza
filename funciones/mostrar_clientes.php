<form action="" method="post" name="fcontacto">
                        <header><h3> <input type="submit" name="botoncl" value="Nuevo"/>  </h3></header>
                       </form> 
<?php 
 
$request=Connection::runQuery('select * from sis_contacto_potencial where id_contacto='.$idc);
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              $table = $table.'<th>'.'Referido por'.'</th>';
              $table = $table.'<th>'.'Toma de Contacto'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
              $table = $table.'<th>'.'Email'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>'; 
              $table = $table.'<th>'.'Eliminar'.'</th>';
              
           $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
                
                if($modulo_rCL=='Clientes' && $ver_rCL=='Habilitado'){
                    if($modulo_rCL=='Clientes' && $editar_rCL=='Habilitado'){
                    if($modulo_rCL=='Clientes' && $eliminar_rCL=='Habilitado'){
                    $table = $table.'<tr><td><a href="../vistas/contacto_potencial.php?codigo='.$row["id_contacto_pot"].'">'.$row["nombre_pot"].' '.$row["apellido_pot"].'</a></td><td>'.$row['referido_por'].'</td><td>'.$row['toma_contacto_pot'].'</a></td><td>'.$row['tel_oficina_pot'].'</a></td><td>'.$row['email1_pot'].'</td><td>'.$row['usuario'].'</td><td><a href="../form_editar/formulario_editar_contacto_potencial.php?codigo='.$row["id_contacto_pot"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td><a href="../modelo/eliminar.php?eliminar_cpo='.$row["id_contacto_pot"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               
                }else{
                    $table = $table.'<tr><td><a href="../vistas/contacto_potencial.php?codigo='.$row["id_contacto_pot"].'">'.$row["nombre_pot"].' '.$row["apellido_pot"].'</a></td><td>'.$row['referido_por'].'</td><td>'.$row['toma_contacto_pot'].'</a></td><td>'.$row['tel_oficina_pot'].'</a></td><td>'.$row['email1_pot'].'</td><td>'.$row['usuario'].'</td><td><a href="../form_editar/formulario_editar_contacto_potencial.php?codigo='.$row["id_contacto_pot"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td></td></tr>';
               
                }
                }else{
                    if($modulo_rCL=='Clientes' && $eliminar_rCL=='Habilitado'){
                    $table = $table.'<tr><td><a href="../vistas/contacto_potencial.php?codigo='.$row["id_contacto_pot"].'">'.$row["nombre_pot"].' '.$row["apellido_pot"].'</a></td><td>'.$row['referido_por'].'</td><td>'.$row['toma_contacto_pot'].'</a></td><td>'.$row['tel_oficina_pot'].'</a></td><td>'.$row['email1_pot'].'</td><td>'.$row['usuario'].'</td><td></td><td><a href="../modelo/eliminar.php?eliminar_cpo='.$row["id_contacto_pot"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               
                }else{
                    $table = $table.'<tr><td><a href="../vistas/contacto_potencial.php?codigo='.$row["id_contacto_pot"].'">'.$row["nombre_pot"].' '.$row["apellido_pot"].'</a></td><td>'.$row['referido_por'].'</td><td>'.$row['toma_contacto_pot'].'</a></td><td>'.$row['tel_oficina_pot'].'</a></td><td>'.$row['email1_pot'].'</td><td>'.$row['usuario'].'</td><td></td><td></td></tr>';
               
                }
                }
                }else{
                    if($modulo_rCL=='Clientes' && $editar_rCL=='Habilitado'){
                    if($modulo_rCL=='Clientes' && $eliminar_rCL=='Habilitado'){
                    $table = $table.'<tr><td><a href="../vistas/contacto_potencial.php?codigo='.$row["id_contacto_pot"].'">'.$row["nombre_pot"].' '.$row["apellido_pot"].'</a></td><td>'.$row['referido_por'].'</td><td>'.$row['toma_contacto_pot'].'</a></td><td>'.$row['tel_oficina_pot'].'</a></td><td>'.$row['email1_pot'].'</td><td>'.$row['usuario'].'</td><td><a href="../form_editar/formulario_editar_contacto_potencial.php?codigo='.$row["id_contacto_pot"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td><a href="../modelo/eliminar.php?eliminar_cpo='.$row["id_contacto_pot"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               
                }else{
                    $table = $table.'<tr><td>'.$row["nombre_pot"].' '.$row["apellido_pot"].'</td><td>'.$row['referido_por'].'</td><td>'.$row['toma_contacto_pot'].'</a></td><td>'.$row['tel_oficina_pot'].'</a></td><td>'.$row['email1_pot'].'</td><td>'.$row['usuario'].'</td><td><a href="../form_editar/formulario_editar_contacto_potencial.php?codigo='.$row["id_contacto_pot"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td><td></td></tr>';
               
                }
                }else{
                    if($modulo_rCL=='Clientes' && $eliminar_rCL=='Habilitado'){
                    $table = $table.'<tr><td>'.$row["nombre_pot"].' '.$row["apellido_pot"].'</td><td>'.$row['referido_por'].'</td><td>'.$row['toma_contacto_pot'].'</a></td><td>'.$row['tel_oficina_pot'].'</a></td><td>'.$row['email1_pot'].'</td><td>'.$row['usuario'].'</td><td></td><td><a href="../modelo/eliminar.php?eliminar_cpo='.$row["id_contacto_pot"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               
                }else{
                    $table = $table.'<tr><td>'.$row["nombre_pot"].' '.$row["apellido_pot"].'</td><td>'.$row['referido_por'].'</td><td>'.$row['toma_contacto_pot'].'</a></td><td>'.$row['tel_oficina_pot'].'</a></td><td>'.$row['email1_pot'].'</td><td>'.$row['usuario'].'</td><td></td><td></td></tr>';
               
                }
                }
                }
		
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
                       
                       ?> 