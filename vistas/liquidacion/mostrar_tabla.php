<?php              
if(isset($_GET['fi'])){
                    $fi = $_GET['fi'];
                    $ff = $_GET['ff'];
                    include('../../modelo/conexion.php');
                    if($_GET['fi']!=''){
                        $colx = ' and StartTime between "'.$fi.'" and "'.$ff.'"';
                    }else{
                        $colx='';
                    }
                    if($_GET['ord']!=''){
                        $ord = ' and a.orden_servicio = "'.$_GET['ord'].'" ';
                    }else{
                        $ord= '';
                    }
            }else{
                    $colx='';
                    $ord= '';
            }
if(isset($_GET['page'])){

                    $page = $_GET['page'];
                    $user_u = $_GET['user'];
            }else{
                    $page = 1;
                     $user_u = $user_u;
            }
            $request=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, sis_empresa c WHERE b.id_empresa=c.rips and a.user="'.$user_u.'" '.$colx.' '.$ord.' and a.id_paciente=b.id_paciente group by a.orden_servicio order by orden_servicio desc ');
            if($request){
                    $request = mysql_num_rows($request);
                    $num_items = $request;
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page); ?>
            <div style="float:left">
               <?php if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarLiq(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarLiq(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarLiq(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarLiq(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }echo 'Total de Registros: ('.$num_items.')';
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?></div>

                        
                            <table class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                <th>Orden Int.</th>
                                <th>Nombre</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Final</th>
                                <th>Atencion</th> 
                                <th>Cantidad</th>
                                <th>Evolucion</th>
                                <th>% Total</th>
                                <th>Liq.</th> 
                                <th>Pend.</th> 
                            </thead>
                     
                                    <?php
                            
                                    $sqld = mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, sis_empresa c WHERE b.id_empresa=c.rips and a.user="'.$user_u.'" '.$colx.' '.$ord.' and a.id_paciente=b.id_paciente group by a.orden_servicio order by orden_servicio desc '.$limit);
        $a=date("H:i").':00';
        $cont=0;
        $sum = 0;
        $sum2 = 0;
        
	while($row=mysql_fetch_array($sqld))
	{       $cont = $cont + 1 ;
              $req3=mysql_query('select count(*) from evolucion where id_orden='.$row["orden_servicio"].'  ');
              $ev = mysql_fetch_array($req3);
              if($ev[0]==0){
                  $evo = '';
                  $f = 'disabled';
              }else{
                  $evo = '<button type="button" class="btn-primary" onclick="evolucion('.$row["orden_servicio"].');">Evolucion</button>';
                  if($row["id_contacto"]>='99'){$f = ''; }else{$f = 'disabled';}
              }
                                        
        
               $ver2='<button type="button" '.$f.' onclick="atenciones('.$row["orden_servicio"].','.$row["pendientes"].','.$row["id_liq"].');">';
               $ver='<a href="../vistas/?id=ver_paciente&cod='.$row["id_paciente"].'" target="_blank">';
          if($row["id_contacto"]!=''){$por=''.number_format($row["id_contacto"]).'';}else{$por='0';}
          if($row["id_contacto"]>='99'){$liq = '<input type="checkbox" name="orden'.$cont.'" value="'.$row["orden_servicio"].'">'; } else {$liq = ''; }
           if($row["id_liq"]!=0){$pend=''.number_format($row["pendientes"]).''; $liq=$row["id_liq"]; }else{$pend='';$liq='';}
           $sum = $sum + $row["positivo"];
           $sum2 = $sum2 + $row["negativo"];
           if(date("Y-m-d") > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d")== $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d") < $row['EndTime']){$color='<font color="black">';}
           $tp = $row["positivo"] + $row["negativo"];
           echo '<tr><td>'.$ver2.''.$row["orden_servicio"].'</button></td><td>'.$ver.''.$row["nombres"].' '.$row["apellidos"].'<font></a></td>
              <td>'.$color.''.$row["StartTime"].'</font></td> <td>'.$color.''.$row["EndTime"].'</font></td>'
                   . '<td>'.$row["Description"].'</font></td>'
                   . '<td>'.$row["cant"].'</font></td>'
                   . '<td>'.$evo.'</td>
                    
                        <td>'.$por.' %</td><td>'.$liq.'</td><td>'.$pend.'</td>
</tr>';
                 
	}
			
                                    
                                    ?>
                              
                            </table>
                        
