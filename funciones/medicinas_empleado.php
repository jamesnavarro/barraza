
<?php 
         
$request=Connection::runQuery("SELECT a.*, b.nombre_medicamento, c.* FROM medicamentos_asig a, medicamentos b, ordenes c where c.estado_ord='En proceso' and a.numero_orden=c.id and a.asignado_a='".$user_u."' and a.cod_med=b.codigo_int group by a.id");

if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
  
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Nombre Insumo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
//              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
              $table = $table.'<th>'.'Fecha Asig.'.'</th>';

              if($_SESSION["admin"] == 'Si'){$table = $table.'<th>'.'Eliminar'.'</th>';}
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total3=0;
	while($row=mysql_fetch_array($request))
	{       
                
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/detalle_ordenes.php?codigo='.$row["numero_orden"].'">';}else{$ver='';}
           if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){$b='<a href="../form_editar/form_medicina.php?editar='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($_SESSION["admin"] == 'Si'){$c='<td><a href="../modelo/eliminar.php?medicinas='.$row["id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td>';}else{$c='';}
           
        
          
           
            $subtotal =$row['cantidad'] *$row['sub_precio_m'] ;
            $total3= $total3 + $subtotal;
            $table = $table.'<tr><td>'.$ver.''.$row["rel_atencion"].'<font></a></td></td>
               <td>'.$row["cod_med"].'</font></td><td>'.$row["nombre_medicamento"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['fecha_asig'].'</font></td>
                           '.$c.'</tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
      }

       
                       ?>
