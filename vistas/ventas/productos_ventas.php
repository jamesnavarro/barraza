<?php if($fact!='Facturado' || $fact!='No Facturado'){  ?>
<form action="../modelo/insertar_equipo_ventas.php?orden=<?php echo $orden_interna ?>&fi=<?php echo $fi ?>&ff=<?php echo $ff ?>"  class="span12 widget shadowed dark form-horizontal bordered" method="post" name="fcontacto">
    <header><h4 class="title">productos vendidos</h4></header>
                                <select name="insumo2" id="select2_1" style="width:25%;">	
                                                          <option value="">Seleccione el producto</option>
                                                          <?php
                                                            include "../modelo/conexion.php";
                                                            $consulta= 'SELECT * FROM productos a, precios_ventas b where a.id=b.id_venta and b.id_empresa='.$e['id_empresa'].' ';                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['codigo'];
                                                            $valor2=$fila['nombre'];
                                                            $valor3=$fila['tipo'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."--".$valor3."</option>";
                                                            
                                                            }
                                                            ?>

                                                            
                                                            
                                                        </select> 
    Cantidad <input required type="text" style="width:10%;" name="numero">  <input type="submit" name="bosa" value="Agregar"/>
                                 # Archivo :<input name="oi" type="text" readonly style="width:40px;" value="<?php echo $max; ?>"> Autorizacion<select name="autorizacion" style="width:130px;">
                                                                   <?php
                                                           
                                                            $consulta= "SELECT * FROM `ordenes` WHERE id='".$orden_interna."'";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['orden'];
                                                            $valor2=$fila['orden'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select>
                              
                                 <p id="precio"></p></form>
<?php }
    $_SESSION['o']= $idp;           
$request=mysql_query("SELECT *, b.tipo FROM equipos_ventas a, productos b, ordenes c WHERE c.id=a.numero_orden_a and a.cod_equipo=b.codigo and a.numero_orden_a='".$orden_interna."'  group by a.id_equipo_a");

if($request){
//    echo'<hr>';
    $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Equipo'.'</th>';
              $table = $table.'<th>'.'Tipo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
//              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
 
              $table = $table.'<th>'.'Fecha de pedido'.'</th>';
               $table = $table.'<th>'.'Fecha a cancelar'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total4=0;
	while($row=mysql_fetch_array($request))
	{       
                
           $ver='';
           if($editar_prod=='Habilitado'){$b='<a href="../form_editar/form_medicina.php?editar='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($eliminar_prod=='Habilitado'){$c='<a href="../vistas/?id=add_detalle_venta&eliminar='.$row["id_equipo_a"].'&cod='.$_GET["cod"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
        
          
           
            $subtotal =$row['cantidad'] *$row['precio_a'] ;
            $total4= $total4 + $subtotal;
            $table = $table.'<tr><td>'.$row["oi"].'<font></a></td>
               <td>'.$row["cod_equipo"].'</font></td><td>'.$ver.''.$row["nombre"].'</font></td><td>'.$row["tipo"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['fecha_a'].'</font></td><td>'.$row['fecha_f'].'</font></td>
               
                           <td>'.$c.'</td></tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total4;
}

       
                       ?>