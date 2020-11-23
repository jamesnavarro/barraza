<?php 
include "../../modelo/conexion.php";
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte.xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

?>
<table class="james" border="1" cellpadding="0" cellspacing="0">

     
             <tr BGCOLOR="#C3D9FF">
             <td>Fecha Ingreso.</td>
             <td>Documento.</td>
             <td>Paciente.</td>
             <td>Deposito.</td>
             <td>Equipos.</td>
             <td>Regimen</td>
             <td>Enero</td>
             <td>Febrero</td>
             <td>Marzo</td>
             <td>Abril</td>
             <td>Mayo</td>
             <td>Junio</td>
             <td>Julio</td>
             <td>Agosto</td>
             <td>Septiembre</td>
             <td>Octubre</td>
             <td>Novienbre</td>
             <td>Diciembre</td>
              <td>E</td>
             </tr>
      
            <?php

$nom =$_GET["nombre"];
$ape =$_GET["apellido"];
$reg =$_GET["regimen"];
$doc =$_GET["documento"];
$orden =$_GET["orden"];
$emp =$_GET["empresa"];
$ano =$_GET["ano"];
$estado =$_GET["estado"];
$request=mysql_query('SELECT estado_alq,a.autorizacion, b.orden,c.numero_doc ,c.regimen,c.motivo_ret,c.retirado,c.nombres,c.apellidos,c.apellido2,c.id_paciente, max(b.fecha_registro) as a, max(b.fecha_final) as b FROM equipos_asig a, ordenes b, pacientes c WHERE '
        . 'c.estado_pac="" and a.fecha_a LIKE "'.$ano.'%" and estado_alq = "'.$estado.'"'
        . ' and c.numero_doc like "%'.$doc.'%" and c.regimen like "%'.$reg.'%" and c.id_empresa  like "%'.$emp.'%"'
        . ' and c.nombres like "%'.$nom.'%" and c.apellidos like "%'.$ape.'%" and a.autorizacion like "'.$orden.'%"  and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a group by b.id_paciente ');

 $a=date("H:i").':00'; 
 $cont = 0;
 $table ='';
 $table = $table.'<tr><td colspan="19">';
 while($row=mysql_fetch_array($request))
	{    
     $cont = $cont + 1 ;
         $ver='<a href="../../vistas/?id=alquileres_pac&codigo='.$row["id_paciente"].'">';
      
           $color='';
           if($row["orden"] =='Pendiente'){$led='<img src="../../imagenes/led.gif" alt="ver" height="10px" widtd="10px">';}else{$led='';}
           
           
             $request1=mysql_query('SELECT regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f , (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-01%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $ene = mysql_fetch_array($request1);
             if($row["regimen"]!='4'){
                 $enero = $ene['autorizacion'];
                 if($enero=='Pendiente'){
                     $led1 = ''; 
                 }else{
                         $led1 = '';
                     }
                     }else{
                         $enero = $ene['total'];$led1 = '';   
                     }
             
             $request2=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f , (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-02%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $feb = mysql_fetch_array($request2);
             if($row["regimen"]!='4'){$febrero = $feb['autorizacion'];if($febrero=='Pendiente'){$led2 = '<img src="../../imagenes/ledrojo.gif">';}else{$led2 = '';}}else{$febrero = $feb['total'];$led2 = '';}
             
             $request3=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,  (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-03%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $mar = mysql_fetch_array($request3);
             if($row["regimen"]!='4'){$marzo = $mar['autorizacion'];if($marzo=='Pendiente'){$led3 = '<img src="../../imagenes/ledrojo.gif">';}else{$led3 = '';}}else{$marzo = $mar['total'];$led3 = '';}
             
             $request4=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,  (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-04%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $abr = mysql_fetch_array($request4);
             if($row["regimen"]!='4'){$abril = $abr['autorizacion'];if($abril=='Pendiente'){$led4 = '<img src="../../imagenes/ledrojo.gif">';}else{$led4 = '';}}else{$abril = $abr['total'];$led4 = '';}
             
             $request5=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,  (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-05%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $may = mysql_fetch_array($request5);
             if($row["regimen"]!='4'){$mayo = $may['autorizacion'];if($mayo=='Pendiente'){$led5 = '<img src="../../imagenes/ledrojo.gif">';}else{$led5 = '';}}else{$mayo = $may['autorizacion'];$led5 = '';}
             
             $request6=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f , (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-06%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $jun = mysql_fetch_array($request6);
             if($row["regimen"]!='4'){$junio = $jun['autorizacion'];if($junio=='Pendiente'){$led6 = '<img src="../../imagenes/ledrojo.gif">';}else{$led6 = '';}}else{$junio = $jun['total'];$led6 = '';}
             
             $request7=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f , (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-07%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $jul = mysql_fetch_array($request7);
             if($row["regimen"]!='4'){$julio = $jul['autorizacion'];if($julio=='Pendiente'){$led7 = '<img src="../../imagenes/ledrojo.gif">';}else{$led7 = '';}}else{$julio = $jul['total'];$led7 = '';}
             
             $request8=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f , (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-08%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $ago = mysql_fetch_array($request8);
            if($row["regimen"]!='4'){ $agosto = $ago['autorizacion'];if($agosto=='Pendiente'){$led8 = '<img src="../../imagenes/ledrojo.gif">';}else{$led8 = '';}}else{$agosto = $ago['total'];$led8 = '';}
             
             $request9=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f , (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-09%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $sep = mysql_fetch_array($request9);
             if($row["regimen"]!='4'){$septiembre = $sep['autorizacion'];if($septiembre=='Pendiente'){$led9 = '<img src="../../imagenes/ledrojo.gif">';}else{$led9 = '';}}else{$septiembre = $sep['total'];$led9 = '';}
             
             $request10=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f , (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-10%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $oct = mysql_fetch_array($request10);
             if($row["regimen"]!='4'){$octubre = $oct['autorizacion'];if($octubre=='Pendiente'){$led10 = '<img src="../../imagenes/ledrojo.gif">';}else{$led10 = '';}}else{$octubre = $oct['total'];$led10 = '';}
             
             $request11=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f , (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-11%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $nov = mysql_fetch_array($request11);
            if($row["regimen"]!='4'){ $noviembre = $nov['autorizacion'];if($noviembre=='Pendiente'){$led11 = '<img src="../../imagenes/ledrojo.gif">';}else{$led11 = '';}}else{$noviembre = $nov['total'];$led11 = '';}
             
             $request12=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f , (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-12%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $dic = mysql_fetch_array($request12);
            if($row["regimen"]!='4'){$diciembre = $dic['autorizacion'];if($diciembre=='Pendiente'){$led12 = '<img src="../../imagenes/ledrojo.gif">';}else{$led12 = '';}}else{$diciembre= $dic['total'];$led12 = '';}
           if($row["autorizacion"]=='Pendiente'){$aut = '<font color="purple">Pendiente';}else{$aut = $row["autorizacion"];}
           
            if($row["regimen"]==''){$r= "Sin Asignar";}
           if($row["regimen"]=='1'){$r= "Contributivo";}
            if($row["regimen"]=='2'){$r= "Subsidiado";}
            if($row["regimen"]=='3'){$r="Vinculado";}
            if($row["regimen"]=='4'){$r= "Particular";}
            if($row["regimen"]=='5'){$r= "Otro";}
            if($row["regimen"]=='7'){$r= "Desplazado con afilación al regimen Contributivo";}
            if($row["regimen"]=='8'){$r="Desplazado con afilación al regimen Subsidiado";}
            if($row["regimen"]=='9'){$r= "Desplazado no asegurado";}
            if($row["regimen"]=='NO APLICA'){$r=$row["regimen"];}
            $actual = $ano.'-'.date("m");
            $ene1 = $ano.'-01';
            $feb1 = $ano.'-02';
            $mar1 = $ano.'-03';
            $abr1 = $ano.'-04';
            $may1 = $ano.'-05';
            $jun1 = $ano.'-06';
            $jul1 = $ano.'-07';
            $ago1 = $ano.'-08';
            $sep1 = $ano.'-09';
            $oct1 = $ano.'-10';
            $nov1 = $ano.'-11';
            $dic1 = $ano.'-12';
            $fec = mysql_query("SELECT a.fecha_reg, a.fecha_a,c.deposito_alq ,(select nombre from alquiler where codigo=a.cod_equipo) as equi FROM equipos_asig a, ordenes b, pacientes c WHERE c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='".$row["id_paciente"]."' group by b.id asc limit 1");
    $in = mysql_fetch_array($fec); 
            if($enero==''){if($ene1 > $actual){$enero = $enero;}else{if($ene1.'-%' < $in['fecha_a']){$enero = '';}else{$enero = '</a>PENDIENTE';}}}else{$enero = $enero;}
        if($febrero==''){if($feb1 > $actual){$febrero = $febrero;}else{if($feb1.'-%' < $in['fecha_a']){$febrero = '';}else{$febrero = '</a>PENDIENTE';}}}else{$febrero = $febrero;}
             if($marzo==''){if($mar1 > $actual){$marzo = $marzo;}else{if($mar1.'-%' < $in['fecha_a']){$marzo = '';}else{$marzo = '</a>PENDIENTE';}}}else{$marzo = $marzo;}
             if($abril==''){if($abr1 > $actual){$abril = $abril;}else{if($abr1.'-%' < $in['fecha_a']){$abril = '';}else{$abril = '</a>PENDIENTE';}}}else{$abril = $abril;}
              if($mayo==''){if($may1 > $actual){$mayo = $mayo;}else{if($may1.'-%' < $in['fecha_a']){$mayo = '';}else{$mayo = '</a>PENDIENTE';}}}else{$mayo = $mayo;}
               if($junio==''){if($jun1 > $actual){$junio = $junio;}else{if($jun1.'-%' < $in['fecha_a']){$junio = '';}else{$junio = '</a>PENDIENTE';}}}else{$junio = $junio;}
                if($julio==''){if($jul1 > $actual){$julio = $julio;}else{if($jul1.'-%' < $in['fecha_a']){$julio = '';}else{$julio = '</a>PENDIENTE';}}}else{$julio = $julio;}
                 if($agosto==''){if($ago1 > $actual){$agosto = $agosto;}else{if($ago1.'-%' < $in['fecha_a']){$agosto = '';}else{$agosto = '</a>PENDIENTE';}}}else{$agosto = $agosto;}
                  if($septiembre==''){if($sep1 > $actual){$septiembre = $septiembre;}else{if($sep1.'-%' < $in['fecha_a']){$septiembre = '';}else{$septiembre = '</a>PENDIENTE';}}}else{$septiembre = $septiembre;}
                     if($octubre==''){if($oct1 > $actual){$octubre = $octubre;}else{if($oct1.'-%' < $in['fecha_a']){$octubre = '';}else{$octubre = '</a>PENDIENTE';}}}else{$octubre = $octubre;}
                      if($noviembre==''){if($nov1 > $actual){$noviembre = $noviembre;}else{if($nov1.'-%' < $in['fecha_a']){$noviembre = '';}else{$noviembre = '</a>PENDIENTE';}}}else{$noviembre = $noviembre;}
                       if($diciembre==''){if($dic1 > $actual){$diciembre = $diciembre;}else{if($dic1.'-%' < $in['fecha_a']){$diciembre = '';}else{$diciembre = '</a>PENDIENTE';}}}else{$diciembre = $diciembre;}
      
   
            if($row["estado_alq"]==''){$est='<img src="../../imagenes/ok.png">';$es = ''; $mo = '';}else{$mo = 'Fecha Retiro:'.$row["retirado"].'';$es = '<strike><font color="red">';$est='<img src="../../imagenes/cancelar.png">';}
           $table = $table.'<tr><td>'.$in['fecha_a'].'</td><td>'.$row['numero_doc'].'</td>'
                   . '<td title="'.$row["motivo_ret"].'">'.$es.' '.$color.''.$row["nombres"].' '.$row["apellidos"].' '.$row["apellido2"].'<font></a><br>'.$mo.'<br> '.$row["motivo_ret"].'</td><td>'.number_format($in['deposito_alq']).'<font></a></td>'
                   . '<td>'.$in["equi"].'</font></td><td>'.$color.''.$r.'</font></td>
                      <td '.$enero.'</a></td>
                      <td>'.$febrero.'</a></td>
                      <td>'.$marzo.'</a></td>'
                   . '<td>'.$abril.'</a></td>
                     <td>'.$mayo.'</a></td>
                     <td>'.$junio.'</a></td>
                     <td>'.$julio.'</a></td>
                     <td>'.$agosto.'</a></td>
                     <td>'.$septiembre.'</a></td>
                     <td>'.$octubre.'</a></td>
                     <td>'.$noviembre.'</a></td>
                     <td>'.$diciembre.'</a></td>
                          <td>'.$row["estado_alq"].'</td>                     
               </tr>';
	}

        echo $table;
        ?>
  </table>