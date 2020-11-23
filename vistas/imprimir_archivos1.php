<?php

include "../modelo/conexion.php";
unlink("US000000.txt");
$ar = fopen("US000000.txt","a")or
        die("error");
$req1=("select a.*, b.*, (b.id_empresa) as r, c.* from facturas a, pacientes b, sis_empresa c WHERE  a.pago_pendiente='No' and a.numero_factura >='".$_POST['desde']."' and a.numero_factura <='".$_POST['hasta']."' and b.regimen='".$_POST['regimen']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='".$_GET['codigo']."' group by b.id_paciente");
    $request1=  mysql_query($req1);
    $c1=0;
    while($row=mysql_fetch_array($request1))
	{     
$c1=$c1+1;
$ar = fopen("US000000.txt","a")or
        die("error");
        
fputs($ar,$row['documento']);
fputs($ar,",");
fputs($ar,$row['numero_doc']);
fputs($ar,",");
fputs($ar,$row['r']);
fputs($ar,",");
fputs($ar,"2");
fputs($ar,",");
fputs($ar,$row['apellidos']);
fputs($ar,",");
fputs($ar,$row['apellido2']);
fputs($ar,",");
fputs($ar,$row['nombres']);
fputs($ar,",");
fputs($ar,$row['nombre2']);
fputs($ar,",");
fputs($ar,$row['edad']);
fputs($ar,",");
fputs($ar,"1");
fputs($ar,",");
fputs($ar,$row['sexo']);
fputs($ar,",");
fputs($ar,$row['departamento']);
fputs($ar,",");
fputs($ar,$row['municipio']);
fputs($ar,",");
fputs($ar,$row['zona']);
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
        echo 'los datos US fueron generado exitosamente, total de archivos : '.$c1.'';
        echo '<a href="../vistas/descarga.php?id=US000000.txt" >Descargar US</a> <br>';

?>
<?php

include "../modelo/conexion.php";
unlink("AM000000.txt");
$ar = fopen("AM000000.txt","a")or
        die("error");
$req2=("SELECT a.numero_factura, b.inf, c.documento, c.numero_doc, d.autorizacion, e.codigo, e.nombre_medicamento, e.forma,
    e.concentracion, d.cantidad_usada, d.sub_precio_m, d.cantidad_usada*d.sub_precio_m, g.nombre_emp  FROM facturas a,
    inf_empresa b, pacientes c, medicamentos_asig d, medicamentos e, sis_empresa g WHERE  a.pago_pendiente='No' and a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <= '".$_POST['hasta']."' and a.numero_factura=d.facturado and  c.regimen='".$_POST['regimen']."' and a.id_paciente=c.id_paciente  and  d.cod_med=e.codigo_int and c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."' order by  d.id");
    $request2=  mysql_query($req2);
    $c2=0;
    while($row=mysql_fetch_array($request2))
	{     
$c2=$c2+1;
$ar = fopen("AM000000.txt","a")or
        die("error");
        $rest = substr($row['forma'], 0, -10);
         $nombre_medicamento = substr($row['nombre_medicamento'], 0, -10);
         $ccc = strlen($row['concentracion']);
         if($ccc>10){
             $concentracion = substr($row['concentracion'], 0, -5);
         }else{
             $concentracion = $row['concentracion'];
         }
          
          
fputs($ar,$row['numero_factura']);
fputs($ar,",");
fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,$row['documento']);
fputs($ar,",");
fputs($ar,$row['numero_doc']);
fputs($ar,",");
fputs($ar,$row['autorizacion']);
fputs($ar,",");
fputs($ar,$row['codigo']);
fputs($ar,",");
fputs($ar,"2");
fputs($ar,",");
fputs($ar,$nombre_medicamento);
fputs($ar,",");
fputs($ar,'');
fputs($ar,",");
fputs($ar,$concentracion);
fputs($ar,",");
fputs($ar,"UND");
fputs($ar,",");
fputs($ar,$row['cantidad_usada']);
fputs($ar,",");
fputs($ar,$row['sub_precio_m']);
fputs($ar,",");
fputs($ar,$row['d.cantidad_usada*d.sub_precio_m']);
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
        echo 'los datos AM fueron generado exitosamente, total de archivos : '.$c2.'';
        echo '<a href="../vistas/descarga.php?id=AM000000.txt" >Descargar AM</a> <br>';

?>
<?php

include "../modelo/conexion.php";
unlink("AT000000.txt");
$ar = fopen("AT000000.txt","a")or
        die("error");
$consulta= "select * from facturas WHERE numero_factura >= ".$_POST['desde']." and numero_factura <= ".$_POST['hasta']."";
$result=  mysql_query($consulta);
$c3=0;
while($fila=  mysql_fetch_array($result)){
$fact=$fila['numero_factura'];
$req4=("SELECT a.numero_factura, c.documento, c.numero_doc, d.autorizacion, e.codigo, e.nombre, d.cantidad, d.precio_a, d.cantidad*d.precio_a, g.nombre_emp  FROM facturas a,
     pacientes c, equipos_asig d, alquiler e, sis_empresa g WHERE  a.numero_factura ='".$fact."'
      and a.id_paciente=c.id_paciente  and d.autorizacion=a.orden_ext
    and d.cod_equipo=e.codigo and c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."'");
$request4=  mysql_query($req4);
   
    while($row=mysql_fetch_array($request4))
	{     
$c3=$c3+1;    

$ar = fopen("AT000000.txt","a")or
        die("error");
        $cod1x = substr($row['nombre'],0, -10);
fputs($ar,$row['numero_factura']);
fputs($ar,",");
fputs($ar,"080010311801");
fputs($ar,",");
fputs($ar,$row['documento']);
fputs($ar,",");
fputs($ar,$row['numero_doc']);
fputs($ar,",");
fputs($ar,$row['autorizacion']);
fputs($ar,",");
fputs($ar,"1");

fputs($ar,",");
fputs($ar,$row['codigo']);
fputs($ar,",");
fputs($ar,$cod1x);
fputs($ar,",");
fputs($ar,$row['cantidad']);
fputs($ar,",");
fputs($ar,$row['precio_a']);
fputs($ar,",");
fputs($ar,$row['d.cantidad*d.precio_a']);
fputs($ar,chr(13).chr(10));
fclose($ar);


}
$req4x=("SELECT a.numero_factura, c.documento, c.numero_doc, d.autorizacion, e.codigo, e.nombre_insumo, d.cant_usada, d.sub_precio, d.cant_usada*d.sub_precio, e.id  FROM facturas a,
    pacientes c, insumos_asignados d, insumos e WHERE  a.numero_factura ='".$fact."'
    and a.id_paciente=c.id_paciente  and a.numero_factura=d.facturado
    and d.cod_insumo=e.codigo");
$request4x=  mysql_query($req4x);
   
    while($row=mysql_fetch_array($request4x))
	{     
$c3=$c3+1;    

$ar = fopen("AT000000.txt","a")or
        die("error");
        $cod1x = substr($row['nombre_insumo'],0, -10);
fputs($ar,$row['numero_factura']);
fputs($ar,",");
fputs($ar,"080010311801");
fputs($ar,",");
fputs($ar,$row['documento']);
fputs($ar,",");
fputs($ar,$row['numero_doc']);
fputs($ar,",");
fputs($ar,$row['autorizacion']);
fputs($ar,",");
fputs($ar,"1");

fputs($ar,",");
fputs($ar,$row['codigo']);
fputs($ar,",");
fputs($ar,$cod1x);
fputs($ar,",");
fputs($ar,$row['cant_usada']);
fputs($ar,",");
fputs($ar,$row['sub_precio']);
fputs($ar,",");
fputs($ar,$row['d.cant_usada*d.sub_precio']);
fputs($ar,chr(13).chr(10));
fclose($ar);


}
$req4xx=("SELECT a.numero_factura, c.documento, c.numero_doc, d.autorizacion, e.codigo, e.nombre, d.cantidad, d.precio_a, d.cantidad*d.precio_a, g.nombre_emp  FROM facturas a,
     pacientes c, equipos_ventas d, productos e, sis_empresa g WHERE  a.numero_factura ='".$fact."'
      and a.id_paciente=c.id_paciente  and d.autorizacion=a.orden_ext
    and d.cod_equipo=e.codigo and c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."'");
$request4xx=  mysql_query($req4xx);
   
    while($row=mysql_fetch_array($request4xx))
	{     
$c3=$c3+1;    

$ar = fopen("AT000000.txt","a")or
        die("error");
        $cod1x = substr($row['nombre'],0, -10);
fputs($ar,$row['numero_factura']);
fputs($ar,",");
fputs($ar,"080010311801");
fputs($ar,",");
fputs($ar,$row['documento']);
fputs($ar,",");
fputs($ar,$row['numero_doc']);
fputs($ar,",");
fputs($ar,$row['autorizacion']);
fputs($ar,",");
fputs($ar,"1");

fputs($ar,",");
fputs($ar,$row['codigo']);
fputs($ar,",");
fputs($ar,$cod1x);
fputs($ar,",");
fputs($ar,$row['cantidad']);
fputs($ar,",");
fputs($ar,$row['precio_a']);
fputs($ar,",");
fputs($ar,$row['d.cantidad*d.precio_a']);
fputs($ar,chr(13).chr(10));
fclose($ar);


}
        }
        echo 'los datos AT fueron generado exitosamente, total de archivos : '.$c3.'';
        echo '<a href="../vistas/descarga.php?id=AT000000.txt" >Descargar AT</a> <br>';

?>
<?php

include "../modelo/conexion.php";
unlink("AF000000.txt");
$ar = fopen("AF000000.txt","a")or
        die("error");
$req5=("SELECT b.inf, b.nombre, b.nit_emp, c.numero_doc, a.numero_factura, a.fecha_registro, f.StartTime, f.EndTime, a.*,
    g.rips, g.simbolo_emp, a.total FROM facturas a, inf_empresa b, pacientes c, actividad f, sis_empresa g
    WHERE  a.pago_pendiente='No' and a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <='".$_POST['hasta']."' and a.id_paciente=c.id_paciente and 
    c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."' and c.regimen='".$_POST['regimen']."' and f.relacionado=a.numero_factura group by  a.numero_factura");
    $request5=  mysql_query($req5);
    $c4=0;
    while($row=mysql_fetch_array($request5))
	{     
$c4=$c4+1;    

$ar = fopen("AF000000.txt","a")or
        die("error");

$ano = substr($row['fechai'],0, -6);
$mes = substr($row['fechai'],5, -3);
$dia = substr($row['fechai'],8);
$dato1 = $dia.'/'.$mes.'/'.$ano;

$ano1 = substr($row['fechai'],0, -6);
$mes1 = substr($row['fechai'],5, -3);
$dia1 = substr($row['fechai'],8);
$dato2 = $dia1.'/'.$mes1.'/'.$ano1;

$ano2 = substr($row['fechai'],0, -6);
$mes2 = substr($row['fechai'],5, -3);
$dia2 = substr($row['fechai'],8);
$dato3 = $dia2.'/'.$mes2.'/'.$ano2;

fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,$row['nombre']);
fputs($ar,",");
fputs($ar,"NI");
fputs($ar,",");
fputs($ar,$row['nit_emp']);
fputs($ar,",");
fputs($ar,$row['numero_factura']);
fputs($ar,",");
fputs($ar,$dato1 );
fputs($ar,",");
fputs($ar,$dato2);
fputs($ar,",");
fputs($ar,$dato3);
fputs($ar,",");
fputs($ar,$row['rips']);
fputs($ar,",");
fputs($ar,$row['simbolo_emp']);
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,$row['total']);
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
        $req5x=("SELECT b.inf, b.nombre, b.nit_emp, c.numero_doc, a.numero_factura, a.fecha_registro, f.fecha_a, f.fecha_f, a.*,
    g.rips, g.simbolo_emp, a.total FROM facturas a, inf_empresa b, pacientes c, equipos_asig f, sis_empresa g
    WHERE  a.pago_pendiente='No' and a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <= '".$_POST['hasta']."' and a.id_paciente=c.id_paciente and 
    c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."' and c.regimen='".$_POST['regimen']."' and f.numero_orden_a=a.orden_int group by  a.numero_factura");
    $request5x=  mysql_query($req5x);

    while($row=mysql_fetch_array($request5x))
	{     
$c4=$c4+1;    

$ar = fopen("AF000000.txt","a")or
        die("error");

$ano = substr($row['fechai'],0, -6);
$mes = substr($row['fechai'],5, -3);
$dia = substr($row['fechai'],8);
$dato1 = $dia.'/'.$mes.'/'.$ano;

$ano1 = substr($row['fechai'],0, -6);
$mes1 = substr($row['fechai'],5, -3);
$dia1 = substr($row['fechai'],8);
$dato2 = $dia1.'/'.$mes1.'/'.$ano1;

$ano2 = substr($row['fechai'],0, -6);
$mes2 = substr($row['fechai'],5, -3);
$dia2 = substr($row['fechai'],8);
$dato3 = $dia2.'/'.$mes2.'/'.$ano2;

fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,$row['nombre']);
fputs($ar,",");
fputs($ar,"NI");
fputs($ar,",");
fputs($ar,$row['nit_emp']);
fputs($ar,",");
fputs($ar,$row['numero_factura']);
fputs($ar,",");
fputs($ar,$dato1 );
fputs($ar,",");
fputs($ar,$dato2);
fputs($ar,",");
fputs($ar,$dato3);
fputs($ar,",");
fputs($ar,$row['rips']);
fputs($ar,",");
fputs($ar,$row['simbolo_emp']);
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,$row['total']);
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
        
          $req5xx=("SELECT b.inf, b.nombre, b.nit_emp, c.numero_doc, a.numero_factura, a.fecha_registro, f.fecha_a, f.fecha_f, a.*,
    g.rips, g.simbolo_emp, a.total FROM facturas a, inf_empresa b, pacientes c, equipos_ventas f, sis_empresa g
    WHERE  a.pago_pendiente='No' and a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <= '".$_POST['hasta']."' and a.id_paciente=c.id_paciente and 
    c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."' and c.regimen='".$_POST['regimen']."' and f.numero_orden_a=a.orden_int group by  a.numero_factura");
    $request5xx=  mysql_query($req5xx);

    while($row=mysql_fetch_array($request5xx))
	{     
$c4=$c4+1;    

$ar = fopen("AF000000.txt","a")or
        die("error");

$ano = substr($row['fechai'],0, -6);
$mes = substr($row['fechai'],5, -3);
$dia = substr($row['fechai'],8);
$dato1 = $dia.'/'.$mes.'/'.$ano;

$ano1 = substr($row['fechai'],0, -6);
$mes1 = substr($row['fechai'],5, -3);
$dia1 = substr($row['fechai'],8);
$dato2 = $dia1.'/'.$mes1.'/'.$ano1;

$ano2 = substr($row['fechai'],0, -6);
$mes2 = substr($row['fechai'],5, -3);
$dia2 = substr($row['fechai'],8);
$dato3 = $dia2.'/'.$mes2.'/'.$ano2;

fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,$row['nombre']);
fputs($ar,",");
fputs($ar,"NI");
fputs($ar,",");
fputs($ar,$row['nit_emp']);
fputs($ar,",");
fputs($ar,$row['numero_factura']);
fputs($ar,",");
fputs($ar,$dato1 );
fputs($ar,",");
fputs($ar,$dato2);
fputs($ar,",");
fputs($ar,$dato3);
fputs($ar,",");
fputs($ar,$row['rips']);
fputs($ar,",");
fputs($ar,$row['simbolo_emp']);
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,$row['total']);
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
        
        echo 'los datos AF fueron generado exitosamente, total de archivos : '.$c4.'';
        echo '<a href="../vistas/descarga.php?id=AF000000.txt" >Descargar AF</a> <br>';

?>
<?php

include "../modelo/conexion.php";
unlink("AP000000.txt");
$ar = fopen("AP000000.txt","a")or
        die("error"); 
$req6=("SELECT a.numero_factura, b.inf, c.documento, c.numero_doc,  f.StartTime, f.orden_externa, f.cod_aten, f.*, c.enfermedad,
    f.precio_total, a.* FROM facturas a, inf_empresa b, pacientes c, actividad f, sis_empresa g, atenciones h WHERE  a.pago_pendiente='No' and a.numero_factura >= '".$_POST['desde']."' and
    a.numero_factura <= '".$_POST['hasta']."' and c.regimen='".$_POST['regimen']."'  and h.codigo_atencion=f.cod_aten and h.tipo=1 and f.id_paciente=c.id_paciente  and  c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."' and f.relacionado=a.numero_factura  GROUP BY f.orden_servicio");
    $request6=  mysql_query($req6);
    $c5=0;
    
    while($row=mysql_fetch_array($request6))
	{     
$c5=$c5+1;   

$ar = fopen("AP000000.txt","a")or
        die("error");
$ano11 = substr($row['fechai'],0, -6);
$mes11 = substr($row['fechai'],5, -3);
$dia11 = substr($row['fechai'],8);
$dato22 = $dia11.'/'.$mes11.'/'.$ano11;
$cod = substr($row['cod_aten'],0, -2);
fputs($ar,$row['numero_factura']);
fputs($ar,",");
fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,$row['documento']);
fputs($ar,",");
fputs($ar,$row['numero_doc']);
fputs($ar,",");
fputs($ar,$dato22);
fputs($ar,",");
fputs($ar,$row['orden_externa']);
fputs($ar,",");
fputs($ar,$cod);
fputs($ar,",");
fputs($ar,"1");
fputs($ar,",");
fputs($ar,"2");
fputs($ar,",");
fputs($ar,",");
fputs($ar,$row['enfermedad']);
fputs($ar,",");
fputs($ar,",");
fputs($ar,",");
fputs($ar,",");
fputs($ar,$row['precio_total']*$row['cant']);
fputs($ar,chr(13).chr(10));
fclose($ar);


    }
        echo 'los datos AP fueron generado exitosamente, total de archivos : '.$c5.'';
        echo '<a href="../vistas/descarga.php?id=AP000000.txt" >Descargar AP</a> <br>';

?>
<?php

include "../modelo/conexion.php";
unlink("AC000000.txt");
$ar = fopen("AC000000.txt","a")or
        die("error");
$req7=("SELECT a.numero_factura, b.inf, c.documento, c.numero_doc, f.*, f.StartTime, f.orden_externa, f.cod_aten, c.enfermedad,
    f.precio_total FROM facturas a, inf_empresa b, pacientes c, actividad f, sis_empresa g, atenciones h WHERE  a.pago_pendiente='No' and a.numero_factura >= '".$_POST['desde']."' and
    a.numero_factura <= '".$_POST['hasta']."' and c.regimen='".$_POST['regimen']."'  and h.codigo_atencion=f.cod_aten and h.tipo=2 and f.id_paciente=c.id_paciente  and  c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."' and f.relacionado=a.numero_factura  GROUP BY f.orden_servicio");
    $request7=  mysql_query($req7);
    $c6=0;
    while($row=mysql_fetch_array($request7))
	{     
$c6=$c6+1;   

$ar = fopen("AC000000.txt","a")or
        die("error");
$ano111 = substr($row['StartTime'],0, -6);
$mes111 = substr($row['StartTime'],5, -3);
$dia111 = substr($row['StartTime'],8);
$dato222 = $dia111.'/'.$mes111.'/'.$ano111;
$cod1 = substr($row['cod_aten'],0, -2);
fputs($ar,$row['numero_factura']);
fputs($ar,",");
fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,$row['documento']);
fputs($ar,",");
fputs($ar,$row['numero_doc']);
fputs($ar,",");
fputs($ar,$dato222);
fputs($ar,",");
fputs($ar,$row['orden_externa']);
fputs($ar,",");
fputs($ar,$cod1);
fputs($ar,",");
fputs($ar,"10");
fputs($ar,",");
fputs($ar,"15");
fputs($ar,",");
fputs($ar,$row['enfermedad']);
fputs($ar,",");
fputs($ar,",");
fputs($ar,",");
fputs($ar,",");
fputs($ar,"1");
fputs($ar,",");
fputs($ar,$row['precio_total']*$row['cant']);
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,$row['precio_total']*$row['cant']);
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
        echo 'los datos AC fueron generado exitosamente, total de archivos : '.$c6.'';
        echo '<a href="../vistas/descarga.php?id=AC000000.txt" >Descargar AC</a> <br>';

?>
<?php

include "../modelo/conexion.php";
unlink("CT000000.txt");
$req=("select * from inf_empresa");
    $request=  mysql_query($req);
    while($row=mysql_fetch_array($request))
	{     

$ar = fopen("CT000000.txt","a")or
        die("error");
fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,date("d/m/Y"));
fputs($ar,",");
fputs($ar,"US000000");
fputs($ar,",");
fputs($ar,$c1);
fputs($ar,chr(13).chr(10));
fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,date("d/m/Y"));
fputs($ar,",");
fputs($ar,"AM000000");
fputs($ar,",");
fputs($ar,$c2);
fputs($ar,chr(13).chr(10));
fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,date("d/m/Y"));
fputs($ar,",");
fputs($ar,"AT000000");
fputs($ar,",");
fputs($ar,$c3);
fputs($ar,chr(13).chr(10));
fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,date("d/m/Y"));
fputs($ar,",");
fputs($ar,"AF000000");
fputs($ar,",");
fputs($ar,$c4);
fputs($ar,chr(13).chr(10));
fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,date("d/m/Y"));
fputs($ar,",");
fputs($ar,"AP000000");
fputs($ar,",");
fputs($ar,$c5);
fputs($ar,chr(13).chr(10));
fputs($ar,$row['inf']);
fputs($ar,",");
fputs($ar,date("d/m/Y"));
fputs($ar,",");
fputs($ar,"AC000000");
fputs($ar,",");
fputs($ar,$c6);
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
        echo 'los datos CT fueron generado exitosamente...........................: ';
         echo '<a href="../vistas/descarga.php?id=CT000000.txt" >Descargar CT</a><BR>';
////////////////////////////////////////////////
?>
<a href="../vistas/?id=archivos&codigo=<?php echo $_GET["codigo"] ?>">regresar</a>