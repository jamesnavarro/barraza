<form action="" method="post" name="fcontacto">
                        <header><h3> <input type="submit" name="botoncl" value="Nuevo"/>   </h3></header>
                       </form>
<?php 
                       
$request=Connection::runQuery('select * from pacientes where id_empresa="'.$rips.'"');
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              $table = $table.'<th>'.'estado'.'</th>';
              $table = $table.'<th>'.'Documento'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
              $table = $table.'<th>'.'Email'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
 
           $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
                
              if($modulo_rCL=='Clientes' && $ver_rCL=='Habilitado'){$ver='<a href="../vistas/contacto_potencial.php?codigo='.$row["id_paciente"].'">';}else{$a='';}
           if($modulo_rCL=='Clientes' && $editar_rCL=='Habilitado'){$b='<a href="../form_editar/formulario_editar_contacto_potencial.php?codigo='.$row["id_paciente"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rCL=='Clientes' && $eliminar_rCL=='Habilitado'){$c='<a href="../vistas/mostrar_clientespotencial.php?eliminar_pot='.$row["id_paciente"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
          
          
           
           
           $table = $table.'<tr><td>'.$ver.''.$row["nombres"].' '.$row["apellidos"].'<font></a></td>
               <td>'.$row["estado"].'</font></td><td>'.$row["numero_doc"].'</font></td>
                   <td>'.$row['tel_1'].'</font></td><td>'.$row['email1'].'</font></td><td>'.$row['asignado_a'].'</font></td>
                       <td>'.$b.'</td>
                           </tr>';
		
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
                       
                       ?>
