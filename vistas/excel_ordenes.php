<?php 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_ordenes.xls");
?>
<?php 
include '../modelo/conexion.php';
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
                    
                    if($est==""){$linea='';}else{if($est==99){$linea='a.id_contacto>=99 and ';}else if($est==0){$linea='a.id_contacto="" and ';$fac='activa';}else{$linea='a.id_contacto>0 and a.id_contacto<=98 and';$fac='activa';}}
                    if($rev=='x'){$revidas=' and a.Location="" ';}else if($rev=='Revisado'){$revidas=' and a.Location="Revisado" ';}else{$revidas='';}
                    if($desde=='' && $hasta==''){$f='';}else{$f ='a.fecha_reg_ta>="'.$desde.'" and a.fecha_reg_ta<="'.$hasta.'" and ';}
                    $colx = 'and '.$linea.' '.$f.'  concat(b.nombres," ",b.nombre2) like "%'.$nom.'%" and   concat(b.apellidos," ",b.apellido2) like "%'.$ape.'%"  and a.prioridad like "'.$fac.'%" '.$revidas.' and b.numero_doc like "'.$ced.'%" and b.id_empresa like "'.$emp.'%" and a.orden_servicio like "'.$int.'%" and a.orden_externa like "'.$ext.'%" ';

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
                                        <th>Cumplimiento</th>
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
          $sql = mysql_query("SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id  and a.user LIKE '".$use."%' $col group by orden_servicio desc ".$limit);
			$item = 0;
			if(mysql_num_rows($sql)>0){
$a=date("H:i").':00';
$tt=0;
	while($row=mysql_fetch_array($sql))
	{    
            $tt = $tt + 1;
           if($row["Location"]=='Revisado'){$led = '';}else{
           if($row["est_motivo"]=='inactiva'){$led = '';}else{
           if($row["id_contacto"]>=99){$led='';}else{$led='';}}} 
           $ver2='';
           $ver='';
          
           if($row["id_contacto"]!=''){$por='<td class="hidden-phone">'.number_format($row["id_contacto"]).' %<font></a></td>';}else{$por='<td class="hidden-phone">0 %</td>';}
          
           if(date("Y-m-d") > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d") == $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d") < $row['EndTime']){$color='<font color="black">';}
           if($row["id_contacto"]>98){
               $et ='Completado';
               
           }else{
               if($row["id_contacto"]==""){$et ='No iniciada';}else{$et ='En Proceso';}
               
               }
           if($row["prioridad"]=='activa'){$sa = 'No Facturado';}else{$sa =$row["prioridad"];}
           if($row["seguir"]=='Si'){$se = 'Requiere Seguir';}else{if($row["seguir"]=='No'){$se ='<font color="red">Retirado</font>';}else{$se ='<font color="green">'.$row["seguir"].'</font>';}}
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
                      $btn = '';
                  }else{
                       $btn = $_GET['admin'];
                  }
                  if($row['desc_motivo']=='esta orden se encuentra'){
                      $porque ='';
                  }else{
                      $porque = $row['desc_motivo'];
                  }
           if($row['firms']==0){$f='';}else{$f='';}
           $table = $table.'<tr id="'.$row["orden_servicio"].'"><td width="5%">'.$row["orden_servicio"].' '.$e.'</td>'
                   . '<td width="5%" style="mso-number-format:"0">'.utf8_decode($row["orden_externa"].'.').'<font></a></td>'
                   . '<td class="hidden-phone">'.$row["Description"].''.$caso.'</a></td>'
                   . '<td width="5%">'.$row["cant"].'<font></a></td>'.$por.'</td>'
                   . '<td class="hidden-phone">'.$et.'<font></a>'.$se.'</td>'
                   . '<td class="hidden-phone">'.$row["Location"].'<font></a></td>'
                   . '<td class="hidden-phone">'.$sa.'<b id="d'.$row["orden_servicio"].'">'.$porque.'</b></td>'
                   . '<td class="hidden-phone">'.$row["numero_doc"].'<font></a></td>
               <td width="15%">'.$row["nombres"].' '.$row["nombre2"].' '.$row["apellidos"].' '.$row["apellido2"].'</td>'
                   . '<td class="hidden-phone">'.$row["fecha_reg_ta"].'<font></a></td>
               <td class="hidden-phone">'.$row["StartTime"].' al '.$row["EndTime"].'<font></a></td>'
                   . '<td class="hidden-phone">'.$row["user"].'<td><b>Efec: <font color="'.$col.'">'.$row["efectivo"].'% </font><b></td>
                       </tr>';  
        }
        $table = $table.'</table>';
        echo $table;
        echo 'Total de ordenes por mes '.$tt;
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
