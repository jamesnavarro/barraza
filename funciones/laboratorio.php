    <header><form action="../modelo/insertar_lab_asig.php?orden=<?php echo $orden_interna ?>" method="post" name="fcontacto">
                                <select name="insumo2" id="combo7" style="width:25%;">	
                                                          <option value="">Seleccione uno..</option>
                                                          <?php
                                                            include "../modelo/conexion.php";
                                                            $consulta= "select * from laboratorio group by nombre_lab";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cod_lab'];
                                                            $valor2=$fila['nombre_lab'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
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
                             <textarea name="precio" id="combo8" style="width:1px; height:1px;" ></textarea>
                                </form></header>
<?php 
    $_SESSION['o']= $idp;           
$request=Connection::runQuery("SELECT a.*, b.*, c.* FROM laboratorio_asig a, laboratorio b, ordenes c WHERE c.id=a.numero_orden_lab  and a.cod_lab=b.cod_lab and a.numero_orden_lab='".$orden_interna."'  group by a.id_lab_a");

if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
        
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Equipo'.'</th>';
          
              $table = $table.'<th>'.'Cantidad'.'</th>';
//              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
              $table = $table.'<th>'.'Fecha Asig.'.'</th>';
            
//               $table = $table.'<th>'.'Subtotal $'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total=0;
	while($row=mysql_fetch_array($request))
	{       
                
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id"].'">';}else{$ver='';}
           if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){$b='<a href="../form_editar/form_medicina.php?editar='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../modelo/eliminar.php?lab='.$row["id_lab_a"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
        
          
           
            $subtotal1 =$row['cantidad'] *$row['precio_lab'] ;
            $total= $total + $subtotal1;
            $table = $table.'<tr><td>'.$row["rel_atencion"].'<font></a></td></td>
               <td>'.$row["cod_lab"].'</font></td><td>'.$row["nombre_lab"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['fecha_lab'].'</font></td>
               
                           <td>'.$c.'</td></tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        echo 'Neto a Pagar = '.$total;
        
}

       
                       ?>
