<?php 
include('../../modelo/conexion.php');


                    $est= $_GET['estado'];
                    $emp = $_GET['empresa'];
                    $int = $_GET['interna'];
                    $ext = $_GET['externa'];
                    $nom = $_GET['nombre'];
                    $ape = $_GET['apellido'];
                    $ced = $_GET['cedula'];
                    $fac = $_GET['facturadas'];
                    $rev = $_GET['revisadas'];
                    $use = $_GET['user'];
                    $desde = $_GET['desde'];
                    $hasta = $_GET['hasta'];
                    $adminx = $_GET['admin'];
                    $bcov = $_GET['bcov'];
                    $btom = $_GET['btom'];
                    $bres = $_GET['bres'];
                    $mun = $_GET['mun'];
                    
                    if($est==""){$linea='';}else{if($est==99){$linea='a.id_contacto>=99 and ';}else if($est==0){$linea='a.id_contacto="" and ';$fac='activa';}else{$linea='a.id_contacto>0 and a.id_contacto<=98 and';$fac='activa';}}
                    if($rev=='x'){$revidas=' and a.Location="" ';}else if($rev=='Revisado'){$revidas=' and a.Location="Revisado" ';}else{$revidas='';}
                    if($desde=='' && $hasta==''){$f='';}else{$f ='a.fecha_reg_ta>="'.$desde.'" and a.fecha_reg_ta<="'.$hasta.'" and ';}
                    $colx = 'and '.$linea.' '.$f.'  concat(b.nombres," ",b.nombre2) like "%'.$nom.'%" and   concat(b.apellidos," ",b.apellido2) like "%'.$ape.'%"  and a.prioridad like "'.$fac.'%" '.$revidas.' and b.numero_doc like "'.$ced.'%" and b.id_empresa like "'.$emp.'%" and a.orden_servicio like "'.$int.'%" and a.orden_externa like "'.$ext.'%" ';

if(isset($_GET['page'])){

                    $page = $_GET['page'];
                    $fi = $_GET['filas'];

            }else{
                    $page = 1;
                    $fi = 5;
            }
            if($_GET['facturadas']=='No Facturable'){
                $colx = ' and a.prioridad="No Facturable" ';
            }else{
                $colx = $colx;
            }
            $request=mysql_query("SELECT a.id_paciente FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and a.user LIKE '%".$use."%' and b.municipio like '".$mun."%' and b.covid like '".$bcov."%' and a.prueba_realizada like '".$btom."%' and a.resultado like '".$bres."%' $colx group by orden_servicio desc");
            if($request){
                    $request = mysql_num_rows($request);
                    $num_items = $request;
            }else{
                    $num_items = 0;
            }
            $rows_by_page = $fi;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarAtenciones(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarAtenciones(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarAtenciones(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarAtenciones(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }echo '<b>Total de Registros: (<font color="red">'.$num_items.'</font>)</b>';
                ?>
                        <a href="../vistas/excel_ordenes.php?<?php echo 'estado='.$est.'&empresa='.$emp.'&interna='.$int.'&externa='.$ext.'&nombre='.$nom.'&apellido='.$ape.'&cedula='.$ced.'&facturadas='.$fac.'&revisadas='.$rev.'&user='.$use.'&desde='.$desde.'&hasta='.$hasta.'&admin='.$adminx; ?>"><button>Exportar Excel</button></a> 
                <?php        
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                            <table class="table table-bordered table-condensed table-hover">
<!--                            <table class="table table-bordered table-striped table-hover" id="">-->
                                <thead>
                                    <tr  BGCOLOR="#C3D9FF">
                                        <th>#O.I</th>
                                        <th>#O.E</th>
                                        <th>ATENCIONES</th>
                                        <th>CANT.</th>
                                        <th>PORC.</th>
                                        <th>ESTADO</th>
                                        <th>REVISADO</th>
                                        <th>FACTURADO</th>
                                        <th>CEDULA</th>
                                        <th>PACIENTE</th>
                                        <th>FECHA DE INGRESO</th>
                                        <th>FECHA ATENCION</th>
                                        <th>ASIGNADO A</th>
                                        <th>FIRMAS</th>
                                        
                                    </tr>
                                </thead>
                     
                                    <?php
                                    $table = '';
                                    
                                        if($est==""){
                                            $linea='';
                                        }else{
                                            if($est==99){
                                                $linea='a.id_contacto>=99 and ';
                                            }else if($est==0){
                                                $linea='a.id_contacto="" and ';$fac='activa';  
                                            }else{
                                                $linea='a.id_contacto>0 and a.id_contacto<=98 and';$fac='activa';   
                                            }
                                            }
                                        if($desde=='' && $hasta==''){$f='';}else{$f ='a.fecha_reg_ta>="'.$desde.'" and a.fecha_reg_ta<="'.$hasta.'" and ';}
                                         if($rev=='x'){$revidas=' and a.Location="" ';}else if($rev=='Revisado'){$revidas=' and a.Location="Revisado" ';}else{$revidas='';}
                                        $col = ' and '.$linea.' '.$f.' concat(b.nombres," ",b.nombre2) like "%'.$nom.'%" and  concat(b.apellidos," ",b.apellido2) like "%'.$ape.'%" and a.prioridad like "'.$fac.'%" '.$revidas.' and b.numero_doc like "'.$ced.'%" and b.id_empresa like "'.$emp.'%" and a.orden_servicio like "'.$int.'%" and a.orden_externa like "'.$ext.'%" ';
             if($_GET['facturadas']=='No Facturable'){
                $col = ' and a.prioridad="No Facturable" ';
            }else{
                $col = $col;
            }
          $sql = mysql_query("SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id  and a.user LIKE '".$use."%' and b.municipio like '".$mun."%'   and b.covid like '".$bcov."%' and a.prueba_realizada like '".$btom."%' and a.resultado like '".$bres."%'  $col group by orden_servicio desc ".$limit);
			$item = 0;
			if(mysql_num_rows($sql)>0){
$a=date("H:i").':00';
$tt=0;
	while($row=mysql_fetch_array($sql))
	{    
            $tt = $tt + 1;
           if($row["Location"]=='Revisado'){$led = '<img src="../images/ok.png" alt="ver" height="10px" width="10px">';}else{
           if($row["est_motivo"]=='inactiva'){$led = '<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px">';}else{
           if($row["id_contacto"]>=99){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='<img src="../imagenes/pro.png" alt="ver" height="20px" width="20px">';}}} 
           $ver2='<a href="../vistas/?id=ver_orden_interna&ord='.$row["orden_servicio"].'">';
           $ver='<a href="../vistas/?id=ver_orden_externa&codigo='.$row["orden_externa"].'">';
          
           if($row["id_contacto"]!=''){$por='<td class="hidden-phone">'.number_format($row["id_contacto"]).' %<font></a></td>';}else{$por='<td class="hidden-phone">0 %</td>';}
          
           if(date("Y-m-d") > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d") == $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d") < $row['EndTime']){$color='<font color="black">';}
           if($row["id_contacto"]>98){
               $et ='Completado';
               
           }else{
               if($row["id_contacto"]==""){$et ='No iniciada';}else{$et ='En Proceso';}
               
               }
               //EMP023
               if($row["id_empresa"]=='EMP023'){
                   //$sa = 'No Facturado';
                   $editable = 'Abierto'.$row["id_empresa"];
                   //mysql_query("update actividad set prioridad='activa',Location='', editar='1' where orden_servicio='".$row["orden_servicio"]."' ");
               }else{
                   $editable = 'Cerrada'.$row["id_empresa"];
               }
           if($row["prioridad"]=='activa'){$sa = 'No Facturado';}else{$sa =$row["prioridad"];}
           if($row["seguir"]=='Si'){$se = '<a href="javascript:void();" onclick="Receta('.$row["orden_servicio"].')"><font color="red">Requiere Seguir</font></a>';}else{if($row["seguir"]=='No'){$se ='<font color="red">Retirado</font>';}else{$se ='<font color="green">'.$row["seguir"].'</font>';}}
           $req2=mysql_query('select count(*) from reportes where id_orden='.$row["orden_servicio"].' and estado="Reportado"  ');
                                        $re = mysql_fetch_row($req2);
                                        if($re[0]!=0){
                                            $caso =  '<i>Reclamos: '.$num_inc = $re[0].'</i> <img src="../imagenes/ledrojo.gif">';
                                        }else{ 
                                            $caso = '';  
                                        }
                  if($row['editar']==1){$e='*';}else{$e='';} 
                  if($row["efectivo"]<=95){
                      $col = 'red';
                  }else{
                      $col= 'green';
                  }
                  if($adminx=='admin'){
                      $btn = '<button onclick="cambiar_est('.$row["orden_servicio"].')">Quitar</button>';
                  }else{
                       $btn = $_GET['admin'];
                  }
                  if($row['desc_motivo']=='esta orden se encuentra'){
                      $porque ='';
                  }else{
                      $porque = $row['desc_motivo'];
                  }
                  if($row['covid']=='Si'){
                      $imgcovid ='<img src="../imagenes/virus.png">';
                  }else{
                      $imgcovid = '';
                  }
                  if($row['prueba']=='Si'){
                      $pruebas = 'Fecha Prueba:'.$row['fechaprueba'].' - Res:'.$row['resultado'];
                  }else{
                      $pruebas = '';
                  }
           if($row['firms']==0){$f='<img src="../imagenes/tarea.png">';}else{$f='<img src="../imagenes/ok.png">';}
           $table = $table.'<tr id="'.$row["orden_servicio"].'"><td width="5%">'.$led.' '.$ver2.''.$row["orden_servicio"].' '.$e.'<font></a><br>'.$btn.'</td>'
                   . '<td width="5%">'.$ver2.''.$row["orden_externa"].'<font></a></td>'
                   . '<td class="hidden-phone">'.$row["Description"].'<br>'.$caso.' <a href="../vistas/firmas_digitadas.php?oi='.$row["orden_servicio"].'" target="_blanck">'.$f.'</a><i><font color="red">'.$pruebas.'</font></i></td>'
                   . '<td width="5%">'.$row["cant"].'<font></a></td>'.$por.'</td>'
                   . '<td class="hidden-phone">'.$ver2.''.$et.'<font></a><br>'.$se.' <br>'.$editable.'</td>'
                   . '<td class="hidden-phone">'.$row["Location"].'<font></a></td>'
                   . '<td class="hidden-phone">'.$sa.'</a><br><b id="d'.$row["orden_servicio"].'">'.$porque.'</b></td><td class="hidden-phone">'.$row["numero_doc"].'<font></a></td>
               <td width="15%">'.$imgcovid.'<a href="../vistas/?id=ver_paciente&cod='.$row["id_paciente"].'">'.$row["nombres"].' '.$row["nombre2"].' '.$row["apellidos"].' '.$row["apellido2"].'</a></td><td class="hidden-phone">'.$row["fecha_reg_ta"].'<font></a></td>
               <td class="hidden-phone">'.$row["StartTime"].' al '.$row["EndTime"].'<font></a></td><td class="hidden-phone">'.$row["user"].'<br><b>Efec: <font color="'.$col.'">'.$row["efectivo"].'% </font><b></td>
                   <td class="hidden-phone"><a href="../vistas/firmas.php?oi='.$row["orden_servicio"].'" target="_blanck">'.$f.'</a></td>    </tr>';  
        }
        $table = $table.'</table>';
        echo $table;
        echo 'Total de ordenes por mes '.$tt;
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                              
                            </table>
                        
