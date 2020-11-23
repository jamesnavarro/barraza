<?php if($fact!='Facturado' || $fact!='No Facturado'){  ?>
<header><form action="../modelo/insertar_equipo_asig.php?orden=<?php echo $orden_interna ?>&fi=<?php echo $fi ?>&ff=<?php echo $ff ?>&pac=<?php echo $idp ?>&descrip=<?php echo $descr_alq ?>" method="post" name="fcontacto">
                                <select name="insumo2" id="select2_1" style="width:25%;" required>	
                                                          <option value="">Seleccione el equipo</option>
                                                          <?php
                                                            include "../modelo/conexion.php";
                                                            $consulta= 'SELECT a.*, b.*, c.* FROM alquiler a, precios_alquiler b, sis_empresa c WHERE b.id_empresa=c.id_empresa and c.rips="'.$id_rips.'" and a.id=b.id_alquiler';                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['codigo'];
                                                            $valor2=$fila['nombre'];
                                                            $valor3=$fila['tipo'];
                                                            $descr_alq=$valor2;

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>

                                                            
                                                            
                                                        </select> 
                                 Cantidad <input type="text" style="width:10%;" name="numero" required>  <input type="submit" name="bosa" value="Agregar"/>
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
                              
                           </form></header>
<?php }
    $_SESSION['o']= $idp;           
$request=mysql_query("SELECT a.*, b.*, c.* FROM equipos_asig a, alquiler b, ordenes c WHERE c.id=a.numero_orden_a and a.cod_equipo=b.codigo and a.numero_orden_a='".$orden_interna."'  group by a.id_equipo_a");

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
              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
 
              $table = $table.'<th>'.'Fecha Inicial'.'</th>';
               $table = $table.'<th>'.'Fecha Final'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total4=0;
	while($row=mysql_fetch_array($request))
	{       
                
           $ver='<a href="../vistas/?id=alquiler_prod&codigo='.$row["id_equipo_a"].'&arch='.$_GET['cod'].'">';
           if($editar_prod=='Habilitado'){$b='<a href="../form_editar/form_medicina.php?editar='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($eliminar_prod=='Habilitado'){$c='<a href="../vistas/?id=add_detalle_alquiler&eliminar='.$row["id_equipo_a"].'&cod='.$_GET["cod"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
        
          
           
            $subtotal =$row['cantidad'] *$row['precio_a'] ;
            $total4= $total4 + $subtotal;
            $table = $table.'<tr><td>'.$row["oi"].'<font></a></td>
               <td>'.$row["cod_equipo"].'</font></td><td>'.$ver.''.$row["nombre"].'</font></td><td>'.$row["tipo"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['precio_a'].'</font></td><td>'.$row['fecha_a'].'</font></td><td>'.$row['fecha_f'].'</font></td>
               
                           <td>'.$c.'</td></tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total4;
}

       
                       ?>