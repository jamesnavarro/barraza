<?phpinclude('../../modelo/conexion.php');$rec = $_GET['rec'];$ced = $_GET['ced'];$nom = $_GET['nom'];$est = $_GET['est'];$fec = $_GET['fec'];$use = $_GET['use'];if($rec==''){    $idr = '';}else{    $idr = " and id_recibo='$rec' ";}$req=  mysql_query("select count(*), sum(total)  from recibo_caja a, pacientes b where"        . " a.id_paciente=b.id_paciente and b.numero_doc like '".$ced."%' and concat(nombres,' ',apellidos) like '%".$nom."%' and "        . "a.estado like '%".$est."%' and a.fecha_registro like '".$fec."%' and a.usuario like '%".$use."%' $idr " ); if($req){	$ry = mysql_fetch_row($req);	$num_items = $ry[0];}else{	$num_items = 0;}$rows_by_page = 10;$last_page = ceil($num_items/$rows_by_page);if(isset($_GET['page'])){	$page = $_GET['page'];}else{	$page = 1;}//Esta es la cadena limit que anexaremos a nuestra consulta$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; echo '</td>';     $request=  mysql_query("select *, a.estado, a.fecha_registro,a.usuario  from recibo_caja a, pacientes b where"        . " a.id_paciente=b.id_paciente and b.numero_doc like '".$ced."%' and concat(nombres,' ',apellidos) like '%".$nom."%' and "        . "a.estado like '%".$est."%' and a.fecha_registro like '".$fec."%' and a.usuario like '%".$use."%' $idr order by id_recibo desc " );if($request){//    echo'<hr>';        $table = '';	while($row=mysql_fetch_array($request))	{                 $c='<a  href="#"  onclick="formulario('.$row["id_recibo"].')" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">Ver</a>';                     $table = $table.'<tr><td>'.$row["id_recibo"].'<font></a></td><td>'.$row["estado"].'</td></td>               <td>'.$row["numero_doc"].'<font></a></td><td>'.$row["nombres"].' '.$row["apellidos"].'</font></td>'                   . '<td>'.number_format($row['copagos']).'</td>'                   . '<td>'.number_format($row['total']).'</td>'                   . '<td>'.($row['usuario']).'</td>'                   . '<td>'.$row['fecha_registro'].'</font></td>                                              <td>'.$c.'</td></tr>';	}        $table = $table.'';        echo $table;        }echo '<tr><td colspan="9">';  if($page>1){?>                        <img src="../images/at1.png"  onclick="MostrarProc(1)" style="cursor: pointer;">                        <img src="../images/at2.png"  onclick="MostrarProc(<?php echo $page - 1;?>)" style="cursor: pointer;">                <?php                }else{                        ?><img src="../images/at1.png"> <img src="../images/at2.png"><?php                }                ?>                        (Pagina <?php echo $page;?> de <?php echo $last_page;?>)<input type="hidden" id="page" value="<?php echo $page; ?>">                <?php                if($page<$last_page){?>                        <img src="../images/sig1.png"  onclick="MostrarProc(<?php echo $page + 1;?>)" style="cursor: pointer;">                        <img src="../images/sig2.png" onclick="MostrarProc(<?php echo $last_page;?>)" style="cursor: pointer;">                <?php                }else{                        ?><img src="../images/sig1.png"> <img src="../images/sig2.png"> <?php                }                echo 'Cantidad de Recibos='.$num_items.'  | Total Recaudado = '.number_format($ry[1]).' |   ';                if($fec!=''){                    echo '<a target="_blank" href="../vistas/recibos/reporte.php?&rec='.$rec.'&ced='.$ced.'&nom='.$nom.'&est='.$est.'&fec='.$fec.'&use='.$use.'">Imprimir Reporte</a>';                }                                              ?>