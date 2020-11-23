<form action="" method="post" name="fcontacto">
                        <header><h3> <input type="submit" name="bop" value="Nuevo"/>  </h3></header>
                       </form> 
<?php 
                       
$request=Connection::runQuery('select * from sis_oportunidades where id_empresa='.$id_empresa);
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              
              $table = $table.'<th>'.'Etapas de ventas'.'</th>';
              
              $table = $table.'<th>'.'Cantidad'.'</th>';
              $table = $table.'<th>'.'Fecha Cierre'.'</th>';
              $table = $table.'<th>'.'Asignado a Usuario '.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Eliminar '.'</th>';
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
               if($modulo_rO=='Oportunidades' && $ver_rO=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_oportunidades.php?codigo='.$row["id_oportunidad"].'">';}else{$ver='';}
           if($modulo_rO=='Oportunidades' && $editar_rO=='Habilitado'){$b='<a href="../form_editar/formulario_editar_oportunidad.php?codigo='.$row["id_oportunidad"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rO=='Oportunidades' && $eliminar_rO=='Habilitado'){$c='<a href="../vistas/mostrar_oportunidades.php?eliminar_op='.$row["id_oportunidad"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
         
          
           
           
           $table = $table.'<tr><td>'.$ver.''.$row["nombre_opo"].'<font></a></td></td>
               <td>'.$ver.''.$row["etapas_opo"].'</font></td><td>'.$row["cantidad"].'</font></td><td>'.$row["fecha_opo"].'</font></td>
                   <td>'.$row['asignado_opo'].'</font></td>
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';
		
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}

                       
                       ?>