<?php 
    $_SESSION['c']= $idp; 
     if($_SESSION["area"] == 'OFICINA'){
$request=mysql_query("select a.*, b.*, sum(a.porcentaje) as total from actividad a, ordenes b where b.id=a.archivo and a.archivo='".$_GET['cod']."' group by a.orden_servicio order by a.orden_servicio");
     }else{
      $request=mysql_query("select a.*, b.*, sum(a.porcentaje) as total from actividad a, ordenes b where a.user='".$_SESSION['k_username']."' and b.id=a.archivo and b.estado_ord='En proceso' and a.estado='No iniciada' and a.archivo='".$_GET['cod']."' group by a.orden_servicio order by a.orden_servicio");
    
     }
if($request){
//    echo'<hr>';
   $table = '<table class="table table-bordered table-striped table-hover" id="">';

              $table = $table.'<thead>';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
                    $table = $table.'<th>Urgente</th>';
              $table = $table.'<th>'.'Atencion'.'</th>';
              $table = $table.'<th>'.'# Orden Int.'.'</th>';
              $table = $table.'<th>'.'# Orden Ext.'.'</th>';
              $table = $table.'<th>'.'Visita #'.'</th>';
              $table = $table.'<th>'.'Fecha Inicio'.'</th>';
              $table = $table.'<th>'.'Fecha Fin'.'</th>';
               $table = $table.'<th>'.'Cada'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Por.(%)'.'</th>';
              $table = $table.'<th>'.'Cant.'.'</th>';
              if($_SESSION["area"] == 'OFICINA'){ $table = $table.'<th>'.'Up'.'</th>';}
             if($_SESSION["area"] == 'OFICINA'){$table = $table.'<th>'.'Del'.'</th>';}
             if($_SESSION["area"] == 'OFICINA'){$table = $table.'<th>'.'Insumos.'.'</th>';}
             if($_SESSION["area"] == 'OFICINA'){$table = $table.'<th>'.'Medicina.'.'</th>';}
             $table = $table.'<th>'.'Ins.'.'</th>';
              $table = $table.'<th>'.'Ate.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
             if($row["relacionado"]==null){
               $fact = 0;
           }else{
               $fact = $row["relacionado"];
           }
           if($_SESSION["area"] == 'OFICINA'){ 
               if($row['relacionado']!=null){
              $fac = ' (Factura N° <a target="_blank" href="../vistas/?id=facturacion_finalizada&fact='.$row['relacionado'].'">'.$row['relacionado'].'</a>)';
          }else{
              $fac='';
          }
           if($row['Location']=='Revisado'){
                $MasMed='<a href="javascript:void(0);" onclick="medicinas_add('.$row["orden_servicio"].','.$_GET["cod"].',2,1,'.$fact.')"><img src="../images/medicina2.png" alt="ver" height="20px" width="20px"title="Medicamentos Adicionales sin afectar inventario" data-toggle="tooltip"></a>';
                $MasIns='<a href="javascript:void(0);" onclick="insumos_add('.$row["orden_servicio"].','.$_GET["cod"].',1,1,'.$fact.')" title="Insumos Adicionales sin afectar inventario" data-toggle="tooltip"><img src="../images/insumo2.png" alt="ver" height="20px" width="20px"></a>';
           }else{
               $MasIns = '';
               $MasMed = '';
           }}else{
               $MasIns = '';
               $MasMed = '';
               $fac='';
           }
          
          if($row['est_motivo']=='activa'){$ver='<a href="../vistas/?id=llenar_atencion&codigo='.$row["Id"].'&orden_servicio='.$row["orden_servicio"].'">';}else{$ver='';}
          if($_SESSION["area"] == 'OFICINA'){$b='<a href="../vistas/?id=add_atenciones&cod='.$_GET["cod"].'&edit='.$row["orden_servicio"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($_SESSION["area"] == 'OFICINA'){ if($row['id_contacto']==''){$c='<a href="../vistas/?id=add_atenciones&del='.$row["orden_servicio"].'&cod='.$_GET['cod'].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='<img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px">';}}else{$c='';}
           if($_SESSION["area"] == 'OFICINA'){$in='<a href="javascript:void(0);" onclick="insumos_add('.$row["orden_servicio"].','.$_GET["cod"].',1,0,'.$fact.')" title="Agregar Insumos" data-toggle="tooltip"><img src="../images/insumos.png" alt="ver" height="20px" width="20px"></a>';}else{$in='';}
           if($_SESSION["area"] == 'OFICINA'){$me='<a href="javascript:void(0);" onclick="medicinas_add('.$row["orden_servicio"].','.$_GET["cod"].',2,0,'.$fact.')"><img src="../images/medicina.png" alt="ver" height="20px" width="20px" title="Agregar Medicamentos" data-toggle="tooltip"></a>';}else{$me='';}
           if(date("Y-m-d").' '.$hora > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d").' '.$hora <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="black">';}
          
           if($_SESSION["area"] == 'OFICINA'){$precio= '<td>$ '.$color.''.$row['precio_total'].'</font></td>'; }else{$precio='';}
           if($row['Location']==''){
               $rev = 'Sin Revisar';
           }else{
               $rev = $row['Location'];
           }
          if($row['id_contacto']==''){
              $p = 0;
          }else{
              $p= number_format($row['id_contacto']); 
          }
          if($row["urgente"]=='Si'){
                                            $ur = $row["urgente"].'<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px"> <b><font color="red">Urgente</font></b>';
                                        }else{
                                            $ur = ''.$row["urgente"];
                                        }
               $var= 100 - $row['total'];
            $table = $table.'<tr><td>'.$ur.'<td>'.$ver.''.$color.''.$row['Description'].' </font><br>Estado: <b>'.$rev.'</b></a>'.$fac.'</td><td>'.$color.''.$row['orden_servicio'].'</font></td><td>'.$ver.''.$color.''.$row['orden_externa'].'</font></td><td>'.$ver.''.$color.''.$row["cant_ins"].'<font></a></td></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td>
                   <td>'.$color.''.$row["cada"].' Dias</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td><td>'.$color.''.$p.'%</font></td>
                       <td>'.$color.''.$row['cant'].'</font><td>'.$b.'</td><td>'.$c.'</td><td>'.$in.' '.$MasIns.'</td><td>'.$me.' '.$MasMed.'</td>'
                    . '<td><a target="_blank" href="../insumos_asig.php?imp='.$row["orden_servicio"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a>'
                    . '<td><a target="_blank" href="../resumen_atenciones.php?imprimir='.$row["orden_servicio"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a></td></tr>';   
          
		
               
	}
        
        
	$table = $table.'</table>';
        
	echo $table;
        
        $requestx=mysql_query('select count(*) from actividad where archivo="'.$_GET['cod'].'"');
        $requestx = mysql_fetch_row($requestx);
	$num_itemsx = $requestx[0];
        $total2=$num_itemsx*$total2;
        
     
}

       
                       ?>

 <div class="progress progress-striped active"><div class="bar" style="width: <?php if($total==''){echo 0;}else{echo $total;} ?>%"></div> </div>
 <?php if($total==''){echo 0;}else{echo number_format($total);} ?> % Completada 