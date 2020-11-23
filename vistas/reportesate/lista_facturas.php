<?php
if(isset($_GET['nombre'])){
            include('../../modelo/conexion.php'); 
                if($_GET['nombre']!=''){
                        $colx = '  and a.id_empresa='.$_GET['nombre'].' '; 
                }else{
                        $colx='';
                }
            }else{
                    $colx='';
            }
            if($_GET['tipo']==''){
                        $tipo = '';
                }else{
                     if($_GET['tipo']=='Consulta'){
                         $tipo = ' and a.id_paciente=0 ';
                      }else{
                         $tipo = ' and a.id_paciente!=0 ';
                      }
                }
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
            if($_GET['f1']!=''){
                    $f1 = $_GET['f1'];
                    $f2 = $_GET['f2'];
                    $fecha = ' and a.fecha_registro between "'.$f1.'" and  "'.$f2.'" ';
            }else{
                    $fecha = '';
            }
$request=mysql_query("SELECT count(*) FROM facturas a, sis_empresa b where a.id_empresa=b.id_empresa $fecha  $colx $tipo order by a.numero_factura desc ");
            if($request){
                    $request = mysql_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 20;

            $last_page = ceil($num_items/$rows_by_page);

            
            
                if($page>1){?>
                        <img src="../images/at1.png"  onclick="MostrarFact(1)" style="cursor: pointer;">
                        <img src="../images/at2.png"  onclick="MostrarFact(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/at1.png"> <img src="../images/at2.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <input type="hidden" id="page" value="<?php echo $page;?>" style="width: 30px">
                <?php
                if($page<$last_page){?>
                        <img src="../images/sig1.png"  onclick="MostrarFact(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/sig2.png" onclick="MostrarFact(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/sig1.png"> <img src="../images/sig2.png"> <?php
                }
                echo '<button onclick="imprimir_informe1();"> Imprimir Reporte</button>';
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                            <table class="table table-bordered table-condensed table-hover">
                               <thead>
                                    <tr bgcolor="#ecf0f5">
                                        <th>No. Factura</th>
                                        <th>Fecha de Documento</th>
                                        <th>Nombre de la Empresa</th>
                                        <th>Documento Paciente</th>
                                        <th>Pacientes</th>
                                        <th>Total</th>
                                        <th>Coopago y Cuotas Moderadoras</th>
                                        <th>Neta a pagar</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   
                                    $sql = mysql_query("SELECT *, a.fecha_registro FROM facturas a, sis_empresa b where a.id_empresa=b.id_empresa $colx $fecha $tipo order by a.numero_factura desc  ".$limit);
			$item = 0;
			if(mysql_num_rows($sql)>0){
				while($mostrar = mysql_fetch_array($sql)){
					$item = $item+1;
                                        $pa = mysql_query("select * from pacientes where id_paciente=".$mostrar['id_paciente']." ");
                                        $p = mysql_fetch_array($pa);
                                        if($mostrar['id_paciente']==0){
                                            $pacientes = 'CONSULTA EXTERNA';
                                            $m = '';
                                            $cc = 'CONSULTA EXTERNA';
                                         }else{
                                            $m = '-';
                                            $pacientes = $p['nombres'].' '.$p['apellidos'];
                                            $cc = $p['numero_doc'];
                                        }
					echo '<tr>
                                    <td>'.$mostrar['numero_factura'].'</td>
                                        <td>'.$mostrar['fecha_registro'].'</td>
                                    <td>'.$mostrar['nombre_emp'].'</td>'
                                                . '<td>'.$cc.'</td>'
                                                . ' <td>'.$pacientes.'</td>'
                                                . '<td>'.number_format($mostrar['copagos']+$mostrar['total']).'</td>'
                                                 . '<td>'.$m.' '.number_format($mostrar['copagos']).'</td>'
                                                . '<td>'.number_format($mostrar['total']).'</td>';
                                        }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...'.$sql.'</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                        
