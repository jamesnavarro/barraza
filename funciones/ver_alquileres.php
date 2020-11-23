<?php  $_SESSION['o']= $idp;           
$request=mysql_query("SELECT *, a.facturado FROM equipos_asig a, alquiler b, ordenes c WHERE c.id=a.numero_orden_a and a.cod_equipo=b.codigo and a.id_paciente='".$idp."'  group by a.numero_orden_a");

if($request){
//    echo'<hr>';
  $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';      
              $table = $table.'<th>'.'# Orden Interna'.'</th>';   
               $table = $table.'<th>'.'# Orden Externa'.'</th>';  
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Equipo'.'</th>';
              $table = $table.'<th>'.'Tipo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
              $table = $table.'<th>'.'Fecha Inicial'.'</th>';
              $table = $table.'<th>'.'Fecha Final'.'</th>';
              $table = $table.'<th>'.'Factura #'.'</th>';
              $table = $table.'<th>'.'Facturar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total4=0;$co = 0;
	while($row=mysql_fetch_array($request))
	{       $co +=1;
            $fact = mysql_query("select * from facturas where orden_int='".$row["id"]."' ");
            $f = mysql_fetch_array($fact);
             if($row['facturado']=='nada'){
                if($crear_fac=='Habilitado'){
                    $fa = '';
                $check = '<input type="checkbox" name="valor'.$co.'" value="'.$row["numero_orden_a"].'">'; 
                }else{
                    $check='';
                    $fa = $row['facturado'];
                }
            }else{$check=''; $fa = $row['facturado'];}
            
             $ver='<a href="../vistas/?id=alquiler_prod&codigo='.$row["id_equipo_a"].'&arch='.$_GET['cod'].'">';
             $ver21='<a href="../vistas/?id=add_detalle_alquiler&cod='.$row["numero_orden_a"].'&codigo_pac='.$row["id_paciente"].'">';
            $subtotal =$row['cantidad'] *$row['precio_a'] ;
            $total4= $total4 + $subtotal;
            $table = $table.'<tr><td>'.$ver21.''.$row["oi"].'<font></a> '.$row["numero_orden_a"].'</td>
               <td>'.$row["orden"].'</font></td><td>'.$row["cod_equipo"].'</font></td><td>'.$ver.''.$row["nombre"].'</font></td><td>'.$row["tipo"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['fecha_a'].'</font></td><td>'.$row['fecha_f'].'</font></td>'
                    . '<td><a href="../vistas/?id=facturacion_2&fact='.$fa.'">'.$fa.'</a></td><td>'.$check.'</td>         
                           </tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total4;
}

       
                       ?>
<table style="float: right;">
                <tr>
                    <td><label><i>Total de Alquileres: </i></label> <input type="text" name="canti"  style="width:20px;height:20px;"  value="<?php echo $co; ?>"><input type="submit" name="buscar" value="Facturar" class="alt_btn"></td>
                </tr>
                
            </table>  