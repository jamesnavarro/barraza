<?php
include "../../modelo/conexion.php";
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
           
           
             $request1=mysql_query('SELECT regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado, (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-01%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $ene = mysql_fetch_array($request1);
             if($row["regimen"]!='4'){
                 $enero = $ene['autorizacion'];
                 $fenero = $ene['facturado'];
                 if($enero=='Pendiente'){
                     $led1 = '<img src="../../imagenes/ledrojo.gif">'; 
                 }else{
                         $led1 = '';
                     }
                     }else{
                         $enero = $ene['total'];$led1 = '';   
                     }
             
             $request2=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado, (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-02%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $feb = mysql_fetch_array($request2);
             if($row["regimen"]!='4'){$febrero = $feb['autorizacion'];$ffebrero = $feb['facturado'];if($febrero=='Pendiente'){$led2 = '<img src="../../imagenes/ledrojo.gif">';}else{$led2 = '';}}else{$febrero = $feb['total'];$led2 = '';}
             
             $request3=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado,  (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-03%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $mar = mysql_fetch_array($request3);
             if($row["regimen"]!='4'){$marzo = $mar['autorizacion'];$fmarzo = $mar['facturado'];if($marzo=='Pendiente'){$led3 = '<img src="../../imagenes/ledrojo.gif">';}else{$led3 = '';}}else{$marzo = $mar['total'];$led3 = '';}
             
             $request4=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado,  (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-04%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $abr = mysql_fetch_array($request4);
             if($row["regimen"]!='4'){$abril = $abr['autorizacion'];$fabril = $abr['facturado'];if($abril=='Pendiente'){$led4 = '<img src="../../imagenes/ledrojo.gif">';}else{$led4 = '';}}else{$abril = $abr['total'];$led4 = '';}
             
             $request5=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado,  (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-05%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $may = mysql_fetch_array($request5);
             if($row["regimen"]!='4'){$mayo = $may['autorizacion'];$fmayo = $may['facturado'];if($mayo=='Pendiente'){$led5 = '<img src="../../imagenes/ledrojo.gif">';}else{$led5 = '';}}else{$mayo = $may['autorizacion'];$led5 = '';}
             
             $request6=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado, (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-06%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $jun = mysql_fetch_array($request6);
             if($row["regimen"]!='4'){$junio = $jun['autorizacion'];$fjunio = $jun['facturado'];if($junio=='Pendiente'){$led6 = '<img src="../../imagenes/ledrojo.gif">';}else{$led6 = '';}}else{$junio = $jun['total'];$led6 = '';}
             
             $request7=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado, (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-07%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $jul = mysql_fetch_array($request7);
             if($row["regimen"]!='4'){$julio = $jul['autorizacion'];$fjulio = $jul['facturado'];if($julio=='Pendiente'){$led7 = '<img src="../../imagenes/ledrojo.gif">';}else{$led7 = '';}}else{$julio = $jul['total'];$led7 = '';}
             
             $request8=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado, (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-08%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $ago = mysql_fetch_array($request8);
            if($row["regimen"]!='4'){ $agosto = $ago['autorizacion'];$fagosto = $ago['facturado'];if($agosto=='Pendiente'){$led8 = '<img src="../../imagenes/ledrojo.gif">';}else{$led8 = '';}}else{$agosto = $ago['total'];$led8 = '';}
             
             $request9=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado, (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-09%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $sep = mysql_fetch_array($request9);
             if($row["regimen"]!='4'){$septiembre = $sep['autorizacion'];$fseptiembre = $sep['facturado'];if($septiembre=='Pendiente'){$led9 = '<img src="../../imagenes/ledrojo.gif">';}else{$led9 = '';}}else{$septiembre = $sep['total'];$led9 = '';}
             
             $request10=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado, (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-10%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $oct = mysql_fetch_array($request10);
             if($row["regimen"]!='4'){$octubre = $oct['autorizacion'];$foctubre = $oct['facturado'];if($octubre=='Pendiente'){$led10 = '<img src="../../imagenes/ledrojo.gif">';}else{$led10 = '';}}else{$octubre = $oct['total'];$led10 = '';}
             
             $request11=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado, (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-11%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $nov = mysql_fetch_array($request11);
            if($row["regimen"]!='4'){ $noviembre = $nov['autorizacion'];$fnoviembre = $nov['facturado'];if($noviembre=='Pendiente'){$led11 = '<img src="../../imagenes/ledrojo.gif">';}else{$led11 = '';}}else{$noviembre = $nov['total'];$led11 = '';}
             
             $request12=mysql_query('SELECT  regimen,a.autorizacion,b.id,a.fecha_a,a.fecha_f ,a.facturado, (select total from recibo_caja where orden_int=b.id) as total FROM equipos_asig a, ordenes b, pacientes c WHERE a.fecha_a like "'.$ano.'-12%" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$row["id_paciente"].' group by b.id desc ');
             $dic = mysql_fetch_array($request12);
            if($row["regimen"]!='4'){$diciembre = $dic['autorizacion'];$fdiciembre = $dic['facturado'];if($diciembre=='Pendiente'){$led12 = '<img src="../../imagenes/ledrojo.gif">';}else{$led12 = '';}}else{$diciembre= $dic['total'];$led12 = '';}
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
            if($enero==''){if($ene1 > $actual){$enero = $enero;}else{if($ene1.'-%' < $in['fecha_a']){$enero = '';}else{$enero = '</a><img src="../../imagenes/falta.png">';}}}else{$enero = $enero;}
        if($febrero==''){if($feb1 > $actual){$febrero = $febrero;}else{if($feb1.'-%' < $in['fecha_a']){$febrero = '';}else{$febrero = '</a><img src="../../imagenes/falta.png">';}}}else{$febrero = $febrero;}
             if($marzo==''){if($mar1 > $actual){$marzo = $marzo;}else{if($mar1.'-%' < $in['fecha_a']){$marzo = '';}else{$marzo = '</a><img src="../../imagenes/falta.png">';}}}else{$marzo = $marzo;}
             if($abril==''){if($abr1 > $actual){$abril = $abril;}else{if($abr1.'-%' < $in['fecha_a']){$abril = '';}else{$abril = '</a><img src="../../imagenes/falta.png">';}}}else{$abril = $abril;}
              if($mayo==''){if($may1 > $actual){$mayo = $mayo;}else{if($may1.'-%' < $in['fecha_a']){$mayo = '';}else{$mayo = '</a><img src="../../imagenes/falta.png">';}}}else{$mayo = $mayo;}
               if($junio==''){if($jun1 > $actual){$junio = $junio;}else{if($jun1.'-%' < $in['fecha_a']){$junio = '';}else{$junio = '</a><img src="../../imagenes/falta.png">';}}}else{$junio = $junio;}
                if($julio==''){if($jul1 > $actual){$julio = $julio;}else{if($jul1.'-%' < $in['fecha_a']){$julio = '';}else{$julio = '</a><img src="../../imagenes/falta.png">';}}}else{$julio = $julio;}
                 if($agosto==''){if($ago1 > $actual){$agosto = $agosto;}else{if($ago1.'-%' < $in['fecha_a']){$agosto = '';}else{$agosto = '</a><img src="../../imagenes/falta.png">';}}}else{$agosto = $agosto;}
                  if($septiembre==''){if($sep1 > $actual){$septiembre = $septiembre;}else{if($sep1.'-%' < $in['fecha_a']){$septiembre = '';}else{$septiembre = '</a><img src="../../imagenes/falta.png">';}}}else{$septiembre = $septiembre;}
                     if($octubre==''){if($oct1 > $actual){$octubre = $octubre;}else{if($oct1.'-%' < $in['fecha_a']){$octubre = '';}else{$octubre = '</a><img src="../../imagenes/falta.png">';}}}else{$octubre = $octubre;}
                      if($noviembre==''){if($nov1 > $actual){$noviembre = $noviembre;}else{if($nov1.'-%' < $in['fecha_a']){$noviembre = '';}else{$noviembre = '</a><img src="../../imagenes/falta.png">';}}}else{$noviembre = $noviembre;}
                       if($diciembre==''){if($dic1 > $actual){$diciembre = $diciembre;}else{if($dic1.'-%' < $in['fecha_a']){$diciembre = '';}else{$diciembre = '</a><img src="../../imagenes/falta.png">';}}}else{$diciembre = $diciembre;}
      
   
            if($row["estado_alq"]==''){$est='<img src="../../imagenes/ok.png">';$es = ''; $mo = '';}else{$mo = 'Fecha Retiro:'.$row["retirado"].'';$es = '<strike><font color="red">';$est='<img src="../../imagenes/cancelar.png">';}
           $table = $table.'<tr><td>'.$in['fecha_a'].'</td><td>'.$row['numero_doc'].'</td>'
                   . '<td title="'.$row["motivo_ret"].'">'.$ver.' '.$es.' '.$color.''.$row["nombres"].' '.$row["apellidos"].' '.$row["apellido2"].'<font></a><br>'.$mo.'<br> '.$row["motivo_ret"].'</td><td>'.number_format($in['deposito_alq']).'<font></a></td>'
                   . '<td>'.$in["equi"].'</font></td><td>'.$color.''.$r.'</font></td>
                      <td >'.$led1.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$ene["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$ene["fecha_a"].' al '.$ene["fecha_f"].'">'.$enero.'</a><br>'.$fenero.'</td>
                      <td>'.$led2.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$feb["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$feb["fecha_a"].' al '.$feb["fecha_f"].'">'.$febrero.'</a><br>'.$ffebrero.'</td>
                      <td>'.$led3.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$mar["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$mar["fecha_a"].' al '.$mar["fecha_f"].'">'.$marzo.'</a><br>'.$fmarzo.'</td>'
                   . '<td>'.$led4.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$abr["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$abr["fecha_a"].' al '.$abr["fecha_f"].'">'.$abril.'</a><br>'.$fabril.'</td>
                     <td>'.$led5.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$may["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$may["fecha_a"].' al '.$may["fecha_f"].'">'.$mayo.'</a><br>'.$fmayo.'</td>
                     <td>'.$led6.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$jun["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$jun["fecha_a"].' al '.$jun["fecha_f"].'">'.$junio.'</a><br>'.$fjunio.'</td>
                     <td>'.$led7.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$jul["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$jul["fecha_a"].' al '.$jul["fecha_f"].'">'.$julio.'</a><br>'.$fjulio.'</td>
                     <td>'.$led8.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$ago["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$ago["fecha_a"].' al '.$ago["fecha_f"].'">'.$agosto.'</a><br>'.$fagosto.'</td>
                     <td>'.$led9.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$sep["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$sep["fecha_a"].' al '.$sep["fecha_f"].'">'.$septiembre.'</a><br>'.$fseptiembre.'</td>
                     <td>'.$led10.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$oct["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$oct["fecha_a"].' al '.$oct["fecha_f"].'">'.$octubre.'</a><br>'.$foctubre.'</td>
                     <td>'.$led11.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$nov["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$nov["fecha_a"].' al '.$nov["fecha_f"].'">'.$noviembre.'</a><br>'.$fnoviembre.'</td>
                     <td>'.$led12.'<a href="../../vistas/?id=add_detalle_alquiler&cod='.$dic["id"].'&codigo_pac='.$row["id_paciente"].'" title="'.$dic["fecha_a"].' al '.$dic["fecha_f"].'">'.$diciembre.'</a><br>'.$fdiciembre.'</td>
                          <td>'.$est.'</td><td><input type="checkbox" name="valor'.$cont.'" value="'.$row["id_paciente"].'"></td>                     
               </tr>';
	}
        $table = $table.'<tr>
                    <td><label><i>Total de Archivos: </i></label> <input type="text" name="cant"  style="width:20px;height:20px;"  value="'.$cont.'"><input type="submit" name="rep"></td>
                </tr>';
        echo $table;