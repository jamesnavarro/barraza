<header><form action="../modelo/insertar_ventas.php?orden=<?php echo $orden_interna ?>" method="post" name="fcontacto">
                                <select name="insumo2" id="combo9" style="width:25%;">	
                                                          <option value="">Seleccione el producto</option>
                                                          <?php
                                                            include "../modelo/conexion.php";
                                                            $consulta= 'SELECT * FROM productos order by nombre';                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['codigo_interno'];
                                                            $valor2=$fila['nombre'];
                                                            $valor3=$fila['tipo'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2.' ('.$valor3.")</option>";
                                                            
                                                            }
                                                            ?>

                                                            
                                                            
                                                        </select> 
                                                         Cantidad <input type="text" style="width:10%;" name="numero">
                                          Asignado a la Orden Interna :<select name="autorizacion" style="width:60px;height:20px;">
                                                                   <?php
                                                           
                                                            $consulta= "SELECT * FROM `actividad` WHERE archivo='".$orden_interna."' group by orden_servicio desc order by orden_servicio desc";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['orden_servicio'];
                                                            $valor2=$fila['orden_servicio'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select>
                                <input type="submit" name="bosa" value="Agregar"/>
                             <textarea name="precio" id="combo10" style="width:1px; height:1px;" ></textarea></form></header>
<?php 
    $_SESSION['o']= $idp;           
$request=Connection::runQuery("SELECT a.*, b.*, c.* FROM productos_vendidos a, productos b, ordenes c WHERE c.id=a.numero_orden_v  and a.cod_pro=b.codigo_interno and a.numero_orden_v='".$orden_interna."'  group by a.id_venta");

if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
       
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Equipo'.'</th>';
          
              $table = $table.'<th>'.'Cantidad'.'</th>';
              
              $table = $table.'<th>'.'Fecha Asig.'.'</th>';
             
              
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total=0;
	while($row=mysql_fetch_array($request))
	{       
                
          if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../vistas/detalle_ordenes.php?eliminar_v='.$row["id_venta"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
        
          
           
            $subtotal1 =$row['cantidad'] *$row['precio'] ;
            $total= $total + $subtotal1;
            $table = $table.'<tr><td>'.$row["rel_atencion"].'<font></a></td></td>
               <td>'.$row["codigo_interno"].'</font></td><td>'.$row["nombre"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['fecha_a'].'</font></td>
               
                           <td>'.$c.'</td></tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
        
}

        if(isset($_GET['eliminar_v']))
    {
        $Codigo=$_GET['eliminar_v'];
        $sql = "DELETE FROM productos_vendidos WHERE id_venta='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/detalle_ordenes.php?codigo='.$orden_interna.'"</script>'; 
    }
                       ?>
