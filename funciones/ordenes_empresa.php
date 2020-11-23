


			
                        
<?php 

$request=mysql_query("SELECT a.*, b.nombres, b.apellidos FROM ordenes a, pacientes b where a.id_paciente=b.id_paciente and b.id_paciente='".$idp."'");
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              $table = $table.'<th>'.'# Orden Seguro'.'</th>';
              $table = $table.'<th>'.'Nombre del Paciente'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Fecha de Registro'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'<th>'.'facturar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/detalle_ordenes.php?codigo='.$row["id"].'">';}else{$ver='';}
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver2='<a href="../vistas/contacto_potencial.php?codigo='.$row["id_paciente"].'">';}else{$ver2='';}
           if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){$b='<a href="../vistas/reg_orden.php?codigo='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../modelo/eliminar.php?orden='.$row["id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
              if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$d='<a href="../vistas/facturacion.php?fact='.$row["id"].'"><img src="../imagenes/fact.gif" alt="ver" height="20px" width="20px"></a>';}else{$d='';}

          
          
           
            $table = $table.'<tr><td>'.$ver.''.$row["id"].'<font></a></td><td>'.$row["orden"].'<font></a></td></td>
               <td>'.$ver2.''.$row["nombres"].' '.$row["apellidos"].'</font></td><td>'.$row["estado_ord"].'<font></a></td><td>'.$row["fecha_registro"].'</font></td>
                   
                       <td>'.$b.'</td>
                           <td>'.$c.'</td><td>'.$d.'</td></tr>';   
               
           
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
                                                              if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM ordenes WHERE id='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/reg_orden.php"</script>'; 
    }   
}?>
             

