 <form action="" method="post" name="fcontacto">
                        <header><h3><input type="submit" name="boc" value="Nuevo">  <a href="../vistas/formulario_contactos.php?codigo=<?php echo $idc ?>"><INPUT TYPE="button" VALUE="Formulario Complecto"></a></h3></header>
  
                       </form> 
                    
<?php
$request=Connection::runQuery('select * from sis_contacto where id_empresa="'.$id_empresa.'"');
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              $table = $table.'<th>'.'Cargo'.'</th>';
              $table = $table.'<th>'.'Celular'.'</th>';
              $table = $table.'<th>'.'Correo'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
                  $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
                
                if($modulo_rC=='Contacto' && $ver_rC=='Habilitado'){
                    if($modulo_rC=='Contacto' && $editar_rC=='Habilitado'){
                    if($modulo_rC=='Contacto' && $eliminar_rC=='Habilitado'){
                    $table = $table.'<tr><td><a href="../vistas/contacto.php?codigo='.$row["id_contacto"].'">'.$row["nombre_cont"].' '.$row["apellido_cont"].'</a></td>
                    <td>'.$row['cargo'].'</td><td>'.$row['celular'].'</td><td>'.$row['email1'].'</a></td><td>'.$row['tel_oficina'].'</td>
                        <td><a href="../form_editar/formulario_editar_contactos.php?codigo='.$row["id_contacto"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td><a href="../modelo/eliminar.php?eliminar_con_e='.$row["id_contacto"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                }else{
                    $table = $table.'<tr><td><a href="../vistas/contacto.php?codigo='.$row["id_contacto"].'">'.$row["nombre_cont"].' '.$row["apellido_cont"].'</a></td>
                    <td>'.$row['cargo'].'</td><td>'.$row['celular'].'</td><td>'.$row['email1'].'</a></td><td>'.$row['tel_oficina'].'</td>
                        <td><a href="../form_editar/formulario_editar_contactos.php?codigo='.$row["id_contacto"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td></td></tr>';
                }
                }else{
                    if($modulo_rC=='Contacto' && $eliminar_rC=='Habilitado'){
                    $table = $table.'<tr><td><a href="../vistas/contacto.php?codigo='.$row["id_contacto"].'">'.$row["nombre_cont"].' '.$row["apellido_cont"].'</a></td>
                    <td>'.$row['cargo'].'</td><td>'.$row['celular'].'</td><td>'.$row['email1'].'</a></td><td>'.$row['tel_oficina'].'</td>
                        <td></td>
                            <td><a href="../modelo/eliminar.php?eliminar_con_e='.$row["id_contacto"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                }else{
                    $table = $table.'<tr><td><a href="../vistas/contacto.php?codigo='.$row["id_contacto"].'">'.$row["nombre_cont"].' '.$row["apellido_cont"].'</a></td>
                    <td>'.$row['cargo'].'</td><td>'.$row['celular'].'</td><td>'.$row['email1'].'</a></td><td>'.$row['tel_oficina'].'</td>
                        <td></td>
                            <td></td></tr>';
                }
                }
                }else{
                    if($modulo_rC=='Contacto' && $editar_rC=='Habilitado'){
                    if($modulo_rC=='Contacto' && $eliminar_rC=='Habilitado'){
                    $table = $table.'<tr><td>'.$row["nombre_cont"].' '.$row["apellido_cont"].'</td>
                    <td>'.$row['cargo'].'</td><td>'.$row['celular'].'</td><td>'.$row['email1'].'</a></td><td>'.$row['tel_oficina'].'</td>
                        <td><a href="../form_editar/formulario_editar_contactos.php?codigo='.$row["id_contacto"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td><a href="../modelo/eliminar.php?eliminar_con_e='.$row["id_contacto"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                }else{
                    $table = $table.'<tr><td>'.$row["nombre_cont"].' '.$row["apellido_cont"].'</td>
                    <td>'.$row['cargo'].'</td><td>'.$row['celular'].'</td><td>'.$row['email1'].'</a></td><td>'.$row['tel_oficina'].'</td>
                        <td><a href="../form_editar/formulario_editar_contactos.php?codigo='.$row["id_contacto"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>
                            <td></td></tr>';
                }
                }else{
                    if($modulo_rC=='Contacto' && $eliminar_rC=='Habilitado'){
                    $table = $table.'<tr><td>'.$row["nombre_cont"].' '.$row["apellido_cont"].'</td>
                    <td>'.$row['cargo'].'</td><td>'.$row['celular'].'</td><td>'.$row['email1'].'</a></td><td>'.$row['tel_oficina'].'</td>
                        <td></td>
                            <td><a href="../modelo/eliminar.php?eliminar_con_e='.$row["id_contacto"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                }else{
                    $table = $table.'<tr><td>'.$row["nombre_cont"].' '.$row["apellido_cont"].'</td>
                    <td>'.$row['cargo'].'</td><td>'.$row['celular'].'</td><td>'.$row['email1'].'</a></td><td>'.$row['tel_oficina'].'</td>
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
