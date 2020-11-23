<?php
include "../modelo/conexion.php";
ini_set('max_execution_time', 9000000);
unlink("US000000.txt");
$ar = fopen("US000000.txt","a")or
        die("error");
$req1=("select b.documento,b.numero_doc,b.apellidos,b.apellido2,b.nombres,b.nombre2,b.edad,b.sexo,b.departamento,b.municipio,b.zona, (b.id_empresa) as r, c.* from facturas a, pacientes b, sis_empresa c WHERE  a.numero_factura >='".$_POST['desde']."' and a.numero_factura <='".$_POST['hasta']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='".$_GET['codigo']."' group by b.id_paciente");
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
    inf_empresa b, pacientes c, medicamentos_asig d, medicamentos e, sis_empresa g WHERE  a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <= '".$_POST['hasta']."' and a.numero_factura=d.facturado  and a.id_paciente=c.id_paciente  and  d.cod_med=e.codigo_int and c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."' order by  d.id");
    $request2=  mysql_query($req2);
    $c2=0;
    while($row=mysql_fetch_array($request2))
	{     
$c2=$c2+1;
$ar = fopen("AM000000.txt","a")or
        die("error");
        $rest = substr($row['forma'], 0, 10);
        $nombre_medicamento = substr($row['nombre_medicamento'], 0, 10);
        $concentracion = substr($row['concentracion'], 0, 5);
         
          
          
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
fputs($ar,$nombre_medicamento);
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
$ar = fopen("AT000000.txt","a") or die("error");
$c3=0;
$req4=("SELECT a.numero_factura, c.documento, c.numero_doc, d.autorizacion, e.codigo, e.nombre, d.cantidad, d.precio_a, d.cantidad*d.precio_a, g.nombre_emp  FROM facturas a,
     pacientes c, equipos_ventas d, productos e, sis_empresa g WHERE  a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <= '".$_POST['hasta']."'
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
    pacientes c, insumos_asignados d, insumos e WHERE  a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <= '".$_POST['hasta']."'
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

$req4Y=("SELECT d.facturado, c.documento, c.numero_doc, d.autorizacion, e.codigo, e.nombre, d.cantidad, d.precio_a, d.cantidad*d.precio_a  FROM 
     pacientes c, equipos_asig d, alquiler e WHERE  d.facturado >= '".$_POST['desde']."' and d.facturado <= '".$_POST['hasta']."'
      and d.id_paciente=c.id_paciente 
    and d.cod_equipo=e.codigo");
$request4Y=  mysql_query($req4Y);
   
    while($row=mysql_fetch_array($request4Y))
	{     
$c3=$c3+1;    

$ar = fopen("AT000000.txt","a")or
        die("error");
        $cod1x = substr($row['nombre'],0, -10);
fputs($ar,$row['facturado']);
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

        echo 'los datos AT fueron generado exitosamente, total de archivos : '.$c3.'';
        echo '<a href="../vistas/descarga.php?id=AT000000.txt" >Descargar AT</a> <br>';


unlink("AF000000.txt");
$ar = fopen("AF000000.txt","a")or
        die("error");
$req5=("SELECT a.copagos, b.inf, b.nombre, b.nit_emp, c.numero_doc, a.numero_factura, a.fecha_registro, f.StartTime, f.EndTime, a.*,
    g.rips, g.simbolo_emp, a.total, c.contracto FROM facturas a, inf_empresa b, pacientes c, actividad f, sis_empresa g
    WHERE  a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <='".$_POST['hasta']."' and a.id_paciente=c.id_paciente and 
    c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."' and f.relacionado=a.numero_factura group by  a.numero_factura union 
        SELECT a.copagos, b.inf, b.nombre, b.nit_emp, c.numero_doc, a.numero_factura, a.fecha_registro, f.fecha_a, f.fecha_f, a.*,
    g.rips, g.simbolo_emp, a.total, c.contracto FROM facturas a, inf_empresa b, pacientes c, equipos_asig f, sis_empresa g
    WHERE  a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <= '".$_POST['hasta']."' and a.id_paciente=c.id_paciente and 
    c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."'  and f.numero_orden_a=a.orden_int group by  a.numero_factura union
        SELECT a.copagos, b.inf, b.nombre, b.nit_emp, c.numero_doc, a.numero_factura, a.fecha_registro, f.fecha_a, f.fecha_f, a.*,
    g.rips, g.simbolo_emp, a.total, c.contracto FROM facturas a, inf_empresa b, pacientes c, equipos_ventas f, sis_empresa g
    WHERE  a.numero_factura >= '".$_POST['desde']."' and a.numero_factura <= '".$_POST['hasta']."' and a.id_paciente=c.id_paciente and 
    c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."'  and f.numero_orden_a=a.orden_int group by  a.numero_factura");
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
fputs($ar,"900231731");
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
fputs($ar,$row['contracto']);
fputs($ar,",");
fputs($ar,"");
fputs($ar,",");
fputs($ar,"");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,$row['copagos']);
fputs($ar,",");
fputs($ar,($row['total']-$row['copagos']));
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
        echo 'los datos AF fueron generado exitosamente, total de archivos : '.$c4.'';
        echo '<a href="../vistas/descarga.php?id=AF000000.txt" >Descargar AF</a> <br>';


unlink("AP000000.txt");
$ar = fopen("AP000000.txt","a")or
        die("error"); 

    $c5=0;
  for($i=$_POST['desde'];$i<=$_POST['hasta'];$i++){
      $req6=mysql_query("SELECT a.numero_factura, b.inf, c.documento, c.numero_doc,  f.StartTime, f.orden_externa,
    f.cod_aten, c.enfermedad,
    f.precio_total, a.fechai FROM facturas a, inf_empresa b, pacientes c, actividad f,
    sis_empresa g, atenciones h WHERE f.registro!='' and a.numero_factura = '".$i."'  and h.codigo_atencion=f.cod_aten and h.tipo=1 "
        . "and f.id_paciente=c.id_paciente  and  c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."'"
        . " and f.relacionado=a.numero_factura ");
       while($row=mysql_fetch_array($req6))
	{     
$c5=$c5+1;   

$ar = fopen("AP000000.txt","a")or
        die("error");
$ano11 = substr($row['fechai'],0, -6);
$mes11 = substr($row['fechai'],5, -3);
$dia11 = substr($row['fechai'],8);
$dato22 = $dia11.'/'.$mes11.'/'.$ano11;
$mystring = $row['cod_aten'];
$findme   = '-';
$pos = strpos($mystring, $findme);
if ($pos === false) {
    $cod = substr($row['cod_aten'],0, 6);
} else {
    $cod = $row['cod_aten'];
}
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
fputs($ar,$row['precio_total']);
fputs($ar,chr(13).chr(10));
fclose($ar);


    }
  }  
   
        echo 'los datos AP fueron generado exitosamente, total de archivos : '.$c5.'';
        echo '<a href="../vistas/descarga.php?id=AP000000.txt" >Descargar AP</a> <br>';


unlink("AC000000.txt");
$ar = fopen("AC000000.txt","a")or
        die("error");
$c6=0;
for($j=$_POST['desde'];$j<=$_POST['hasta'];$j++){
$req7=("SELECT a.numero_factura, b.inf, c.documento, c.numero_doc, a.fechai, f.orden_externa, f.cod_aten, c.enfermedad,
    f.precio_total FROM facturas a, inf_empresa b, pacientes c, actividad f, sis_empresa g, atenciones h WHERE f.registro!='' and a.numero_factura = '".$j."'  and h.codigo_atencion=f.cod_aten and h.tipo=2 and f.id_paciente=c.id_paciente  and  c.id_empresa=g.rips and g.id_empresa='".$_GET['codigo']."' and f.relacionado=a.numero_factura ");
    $request7=  mysql_query($req7);
    
    while($row=mysql_fetch_array($request7))
	{     
$c6=$c6+1;   

$ar = fopen("AC000000.txt","a")or
        die("error");
$ano111 = substr($row['fechai'],0, -6);
$mes111 = substr($row['fechai'],5, -3);
$dia111 = substr($row['fechai'],8);
$dato222 = $dia111.'/'.$mes111.'/'.$ano111;
//$ca = $row['COUNT(cod_aten)'];
$mystring = $row['cod_aten'];
$findme   = '-';
$pos = strpos($mystring, $findme);
if ($pos === false) {
    $cod1 = substr($row['cod_aten'],0, 6);
} else {
    $cod1 = $row['cod_aten'];
}

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
fputs($ar,$row['precio_total']);
fputs($ar,",");
fputs($ar,"0");
fputs($ar,",");
fputs($ar,$row['precio_total']);
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
}
        echo 'los datos AC fueron generado exitosamente, total de archivos : '.$c6.'';
        echo '<a href="../vistas/descarga.php?id=AC000000.txt" >Descargar AC</a> <br>';


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

