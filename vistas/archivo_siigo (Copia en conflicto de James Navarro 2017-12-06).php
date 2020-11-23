<?php
include "../modelo/conexion.php";
unlink("reporte.txt");
$ar = fopen("reporte.txt","a")or
        die("error");
unlink("archivo2.txt");
$arc = fopen("archivo2.txt","a")or
        die("error");
$inicial = $_POST['inicial'];
$final   = $_POST['final'];
$co = $final - $inicial;
for($f=$inicial;$f<=$final;$f++){
    

$req1=("SELECT * FROM actividad a, atenciones b WHERE  a.cod_aten=b.codigo_atencion AND a.relacionado='".$f."' GROUP BY a.orden_servicio");    
$request1=  mysql_query($req1);
$facturas = mysql_query("select * from facturas where numero_factura=".$f." ");  
$fa = mysql_fetch_array($facturas);
$fecha = $fa['fecha_registro'];
$id_paciente = $fa['id_paciente'];
$arch=$fa['orden_int'];
$empresas = mysql_query("select * from sis_empresa a, pacientes b where a.rips=b.id_empresa and  b.id_paciente=".$id_paciente." ");  
$em = mysql_fetch_array($empresas);
$nite = $em['nit_emp'];
$NOMEMP = $em['nombre_emp'];
        $ano = substr($fecha,0, -6);
        $mes = substr($fecha,5, -3);
        $dia = substr($fecha,8);
$c1=0;
$tot = 0;
$cc = 0;
$fact = strlen($f);
if($fact>4){
    $factu = '000000'.$f;
}else{
    $factu = '0000000'.$f;
}
    while($row=mysql_fetch_array($request1))
	{     
$c1=$c1+1;
$ar = fopen("reporte.txt","a")or
        die("error");

//cuenta--------------------------------
$cu = strlen($row['cuenta']);
$t_cu = 10 - $cu;
$cero = '';
for($a=1;$a<=$t_cu;$a++){
    $cero=$cero.'0';
}
$cue = $row['cuenta'].$cero;
//valor--------------------------------
$total = $row['precio_total']*$row['cant'];
$tot += $total;
$pr = strlen($total);
$t_pr = 13 - $pr;
$cero1 = '';
for($a=1;$a<=$t_pr;$a++){
    $cero1=$cero1.'0';
}
$pre = $cero1.$total.'00';
//cantidades--------------------------
$cc +=$row['cant'];
$ca = strlen($row['cant']);
$t_ca = 10 - $ca;
$cero2 = '';
for($a=1;$a<=$t_ca;$a++){
    $cero2=$cero2.'0';
}
$can = $cero2.$row['cant'].'00000';
//-------------------------------------
$des = substr($row['Description'],0,50);
$de = strlen($des);
$t_de = 50 - $de;
$cero3 = '';
for($a=1;$a<=$t_de;$a++){
    $cero3=$cero3.' ';
}
$des = $des.$cero3;
//--------------------------------------
//cuenta--------------------------------
$ni = strlen($nite);
$t_ni = 13 - $ni;
$cero4 = '';
for($a=1;$a<=$t_ni;$a++){
    $cero4=$cero4.'0';
}
$nit = $cero4.$nite;
//--------------------------------------

fputs($ar,'F');
//fputs($ar,",");
fputs($ar,'001');
//fputs($ar,",");
fputs($ar,$factu);
//fputs($ar,",");
fputs($ar,"0000".$c1);
//fputs($ar,",");
fputs($ar,$nit);
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$cue);
//fputs($ar,",");
fputs($ar,"0000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
//fputs($ar,",");
fputs($ar,"0001000");
//fputs($ar,",");
fputs($ar,$des);
//fputs($ar,",");
fputs($ar,"C");
//fputs($ar,",");
fputs($ar,$pre);
//fputs($ar,",");
fputs($ar,"000000000000000");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"0001");
//fputs($ar,",");
fputs($ar,"001");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$can);
//fputs($ar,",");
fputs($ar,"0");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,"00000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
fputs($ar,"000000");
fputs($ar,chr(13).chr(10));
fclose($ar);


	}
$req2=("SELECT * FROM insumos a, insumos_asignados b WHERE  a.codigo=b.cod_insumo AND b.facturado='".$f."' ");    
$request2=  mysql_query($req2);

$c2=$c1;

$tot2 = $tot;
$cc2 = 0;
    while($row=mysql_fetch_array($request2))
	{     
$c2=$c2+1;
$ar = fopen("reporte.txt","a")or
        die("error");

//cuenta--------------------------------
$cu = strlen($row['cuenta']);
$t_cu = 10 - $cu;
$cero = '';
for($a=1;$a<=$t_cu;$a++){
    $cero=$cero.'0';
}
$cue = $row['cuenta'].$cero;
//valor--------------------------------
$total = $row['sub_precio']*$row['cantidad'];
$tot2 += $total;
$pr = strlen($total);
$t_pr = 13 - $pr;
$cero1 = '';
for($a=1;$a<=$t_pr;$a++){
    $cero1=$cero1.'0';
}
$pre = $cero1.$total.'00';
//cantidades--------------------------
$cc2 +=$row['cantidad'];
$ca = strlen($row['cantidad']);
$t_ca = 10 - $ca;
$cero2 = '';
for($a=1;$a<=$t_ca;$a++){
    $cero2=$cero2.'0';
}
$can = $cero2.$row['cantidad'].'00000';
//-------------------------------------
$des = substr($row['nombre_insumo'],0,50);
$de = strlen($des);
$t_de = 50 - $de;
$cero3 = '';
for($a=1;$a<=$t_de;$a++){
    $cero3=$cero3.' ';
}
$des = $des.$cero3;
//--------------------------------------
//cuenta--------------------------------
$ni = strlen($nite);
$t_ni = 13 - $ni;
$cero4 = '';
for($a=1;$a<=$t_ni;$a++){
    $cero4=$cero4.'0';
}
$nit = $cero4.$nite;
//--------------------------
$cot = strlen($c2);
$t_con = 5 - $cot;
$cero5 = '';
for($a=1;$a<=$t_con;$a++){
    $cero5=$cero5.'0';
}
$cont = $cero5.$c2;
//--------------------------
fputs($ar,'F');
//fputs($ar,",");
fputs($ar,'001');
//fputs($ar,",");
fputs($ar,$factu);
//fputs($ar,",");
fputs($ar,$cont);
//fputs($ar,",");
fputs($ar,$nit);
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$cue);
//fputs($ar,",");
fputs($ar,"0000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
//fputs($ar,",");
fputs($ar,"0001000");
//fputs($ar,",");
fputs($ar,$des);
//fputs($ar,",");
fputs($ar,"C");
//fputs($ar,",");
fputs($ar,$pre);
//fputs($ar,",");
fputs($ar,"000000000000000");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"0001");
//fputs($ar,",");
fputs($ar,"001");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$can);
//fputs($ar,",");
fputs($ar,"0");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,"00000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
fputs($ar,"000000");
fputs($ar,chr(13).chr(10));
fclose($ar);


	}  
        
$req3=("SELECT * FROM medicamentos a, medicamentos_asig b WHERE  a.codigo_int=b.cod_med AND b.facturado='".$f."' ");    
$request3=  mysql_query($req3);

$c3=$c2;

$tot3 = $tot2;
$cc3 = 0;
    while($row=mysql_fetch_array($request3))
	{     
$c3=$c3+1;
$ar = fopen("reporte.txt","a")or
        die("error");

//cuenta--------------------------------
$cu = strlen($row['cuenta']);
$t_cu = 10 - $cu;
$cero = '';
for($a=1;$a<=$t_cu;$a++){
    $cero=$cero.'0';
}
$cue = $row['cuenta'].$cero;
//valor--------------------------------
$total = $row['sub_precio_m']*$row['cantidad'];
$tot3 += $total;
$pr = strlen($total);
$t_pr = 13 - $pr;
$cero1 = '';
for($a=1;$a<=$t_pr;$a++){
    $cero1=$cero1.'0';
}
$pre = $cero1.$total.'00';
//cantidades--------------------------
$cc3 +=$row['cantidad'];
$ca = strlen($row['cantidad']);
$t_ca = 10 - $ca;
$cero2 = '';
for($a=1;$a<=$t_ca;$a++){
    $cero2=$cero2.'0';
}
$can = $cero2.$row['cantidad'].'00000';
//-------------------------------------
$des = substr($row['nombre_medicamento'],0,50);
$de = strlen($des);
$t_de = 50 - $de;
$cero3 = '';
for($a=1;$a<=$t_de;$a++){
    $cero3=$cero3.' ';
}
$des = $des.$cero3;
//--------------------------------------
//cuenta--------------------------------
$ni = strlen($nite);
$t_ni = 13 - $ni;
$cero4 = '';
for($a=1;$a<=$t_ni;$a++){
    $cero4=$cero4.'0';
}
$nit = $cero4.$nite;
//--------------------------
$cot = strlen($c3);
$t_con = 5 - $cot;
$cero5 = '';
for($a=1;$a<=$t_con;$a++){
    $cero5=$cero5.'0';
}
$cont = $cero5.$c3;
//--------------------------
fputs($ar,'F');
//fputs($ar,",");
fputs($ar,'001');
//fputs($ar,",");
fputs($ar,$factu);
//fputs($ar,",");
fputs($ar,$cont);
//fputs($ar,",");
fputs($ar,$nit);
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$cue);
//fputs($ar,",");
fputs($ar,"0000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
//fputs($ar,",");
fputs($ar,"0001000");
//fputs($ar,",");
fputs($ar,$des);
//fputs($ar,",");
fputs($ar,"C");
//fputs($ar,",");
fputs($ar,$pre);
//fputs($ar,",");
fputs($ar,"000000000000000");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"0001");
//fputs($ar,",");
fputs($ar,"001");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$can);
//fputs($ar,",");
fputs($ar,"0");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,"00000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
fputs($ar,"000000");
fputs($ar,chr(13).chr(10));
fclose($ar);


	} 


$req4=("SELECT * FROM alquiler a, equipos_asig b WHERE  a.codigo=b.cod_equipo AND b.numero_orden_a='".$arch."' ");    
$request4=  mysql_query($req4);

$c4=$c3;

$tot4 = $tot3;
$cc4 = 0;
    while($row=mysql_fetch_array($request4))
	{     
$c4=$c4+1;
$ar = fopen("reporte.txt","a")or
        die("error");

//cuenta--------------------------------
$cu = strlen($row['cuenta']);
$t_cu = 10 - $cu;
$cero = '';
for($a=1;$a<=$t_cu;$a++){
    $cero=$cero.'0';
}
$cue = $row['cuenta'].$cero;
//valor--------------------------------
$total = $row['precio_a']*$row['cantidad'];
$tot4 += $total;
$pr = strlen($total);
$t_pr = 13 - $pr;
$cero1 = '';
for($a=1;$a<=$t_pr;$a++){
    $cero1=$cero1.'0';
}
$pre = $cero1.$total.'00';
//cantidades--------------------------
$cc4 +=$row['cantidad'];
$ca = strlen($row['cantidad']);
$t_ca = 10 - $ca;
$cero2 = '';
for($a=1;$a<=$t_ca;$a++){
    $cero2=$cero2.'0';
}
$can = $cero2.$row['cantidad'].'00000';
//-------------------------------------
$des = substr($row['nombre'],0,50);
$de = strlen($des);
$t_de = 50 - $de;
$cero3 = '';
for($a=1;$a<=$t_de;$a++){
    $cero3=$cero3.' ';
}
$des = $des.$cero3;
//--------------------------------------
//cuenta--------------------------------
$ni = strlen($nite);
$t_ni = 13 - $ni;
$cero4 = '';
for($a=1;$a<=$t_ni;$a++){
    $cero4=$cero4.'0';
}
$nit = $cero4.$nite;
//--------------------------
$cot = strlen($c4);
$t_con = 5 - $cot;
$cero5 = '';
for($a=1;$a<=$t_con;$a++){
    $cero5=$cero5.'0';
}
$cont = $cero5.$c4;
//--------------------------
fputs($ar,'F');
//fputs($ar,",");
fputs($ar,'001');
//fputs($ar,",");
fputs($ar,$factu);
//fputs($ar,",");
fputs($ar,$cont);
//fputs($ar,",");
fputs($ar,$nit);
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$cue);
//fputs($ar,",");
fputs($ar,"0000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
//fputs($ar,",");
fputs($ar,"0001000");
//fputs($ar,",");
fputs($ar,$des);
//fputs($ar,",");
fputs($ar,"C");
//fputs($ar,",");
fputs($ar,$pre);
//fputs($ar,",");
fputs($ar,"000000000000000");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"0001");
//fputs($ar,",");
fputs($ar,"001");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$can);
//fputs($ar,",");
fputs($ar,"0");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,"00000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
fputs($ar,"000000");
fputs($ar,chr(13).chr(10));
fclose($ar);


	}  
//-------------------------    
        //------------------equipos de ventas
//
$req5=("select * from equipos_ventas a, productos b where a.cod_equipo=b.codigo and a.numero_orden_a='".$arch."' ");    
$request5=  mysql_query($req5);

$c5=$c4;

$tot5 = $tot4;
    while($row=mysql_fetch_array($request5))
	{     
$c5=$c5+1;
$ar = fopen("reporte.txt","a")or
        die("error");

//cuenta--------------------------------
$cu = strlen($row['cuenta']);
$t_cu = 10 - $cu;
$cero = '';
for($a=1;$a<=$t_cu;$a++){
    $cero=$cero.'0';
}
$cue = $row['cuenta'].$cero;
//valor--------------------------------
$total = $row['precio_a']*$row['cantidad'];
$tot4 += $total;
$pr = strlen($total);
$t_pr = 13 - $pr;
$cero1 = '';
for($a=1;$a<=$t_pr;$a++){
    $cero1=$cero1.'0';
}
$pre = $cero1.$total.'00';
//cantidades--------------------------
$cc4 +=$row['cantidad'];
$ca = strlen($row['cantidad']);
$t_ca = 10 - $ca;
$cero2 = '';
for($a=1;$a<=$t_ca;$a++){
    $cero2=$cero2.'0';
}
$can = $cero2.$row['cantidad'].'00000';
//-------------------------------------
$des = substr($row['nombre'],0,50);
$de = strlen($des);
$t_de = 50 - $de;
$cero3 = '';
for($a=1;$a<=$t_de;$a++){
    $cero3=$cero3.' ';
}
$des = $des.$cero3;
//--------------------------------------
//cuenta--------------------------------
$ni = strlen($nite);
$t_ni = 13 - $ni;
$cero4 = '';
for($a=1;$a<=$t_ni;$a++){
    $cero4=$cero4.'0';
}
$nit = $cero4.$nite;
//--------------------------
$cot = strlen($c5);
$t_con = 5 - $cot;
$cero5 = '';
for($a=1;$a<=$t_con;$a++){
    $cero5=$cero5.'0';
}
$cont = $cero5.$c5;
//--------------------------
fputs($ar,'F');
//fputs($ar,",");
fputs($ar,'001');
//fputs($ar,",");
fputs($ar,$factu);
//fputs($ar,",");
fputs($ar,$cont);
//fputs($ar,",");
fputs($ar,$nit);
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$cue);
//fputs($ar,",");
fputs($ar,"0000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
//fputs($ar,",");
fputs($ar,"0001000");
//fputs($ar,",");
fputs($ar,$des);
//fputs($ar,",");
fputs($ar,"C");
//fputs($ar,",");
fputs($ar,$pre);
//fputs($ar,",");
fputs($ar,"000000000000000");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"0001");
//fputs($ar,",");
fputs($ar,"001");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,$can);
//fputs($ar,",");
fputs($ar,"0");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,"00000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
fputs($ar,"000000");
fputs($ar,chr(13).chr(10));
fclose($ar);


	}  
//-------------------------   
$ca = strlen($cc);
$t_ca = 10 - $ca;
$cero2 = '';
for($a=1;$a<=$t_ca;$a++){
    $cero2=$cero2.'0';
}
$can = $cero2.$cc.'00000';
//--------------------------
$ct = $c5+1;
$cot = strlen($ct);
$t_c = 5 - $cot;
$cero8 = '';
for($a=1;$a<=$t_c;$a++){
    $cero8=$cero8.'0';
}
$contt = $cero8.($c5+1);
$t_cx = 3 - $cot;
$cero9 = '';
for($a=1;$a<=$t_cx;$a++){
    $cero9=$cero9.'0';
}
$contx = $cero9.$ct;
//--------------------------
$to = strlen($tot4);
$t_co = 13 - $to;
$cero6 = '';
for($a=1;$a<=$t_co;$a++){
    $cero6=$cero6.'0';
}
$tota = $cero6.$tot4.'00';
//------------------------
$EP = strlen($NOMEMP);
$t_ep = 50 - $EP;
$cero7 = '';
for($a=1;$a<=$t_ep;$a++){
    $cero7=$cero7.' ';
}
$emp = $NOMEMP.$cero7;
$ar = fopen("reporte.txt","a")or
        die("error");
fputs($ar,'F');
//fputs($ar,",");
fputs($ar,'001');
//fputs($ar,",");
fputs($ar,$factu);
//fputs($ar,",");
fputs($ar,$contt);
//fputs($ar,",");
fputs($ar,$nit);
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,"1305050000");
//fputs($ar,",");
fputs($ar,"0000000000000");
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
//fputs($ar,",");
fputs($ar,"0001000");
//fputs($ar,",");
fputs($ar,$emp);
//fputs($ar,",");
fputs($ar,"D");
//fputs($ar,",");
fputs($ar,$tota);
//fputs($ar,",");
fputs($ar,"000000000000000");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"0001");
//fputs($ar,",");
fputs($ar,"001");
//fputs($ar,",");
fputs($ar,"0000");
//fputs($ar,",");
fputs($ar,"000");
//fputs($ar,",");
fputs($ar,"000000000000000");
//fputs($ar,",");
fputs($ar,'F');
//fputs($ar,",");
fputs($ar,'001');
//fputs($ar,",");
fputs($ar,$factu);
//fputs($ar,",");
fputs($ar,$contx);
//fputs($ar,",");
fputs($ar,$ano.$mes.$dia);
fputs($ar,"000100");
fputs($ar,chr(13).chr(10));
fclose($ar);



for($i=1;$i<=$ct;$i++){
    $arc = fopen("archivo2.txt","a")or
        die("error");
fputs($arc," 000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000  00000000000        00    00000000000          00000000000000000000000000000000000000000000 000000000000000 00000000000000000000000000000000000000000000000 000000000000000000 0000000000000000000000000 0000                                                                                    0000000000000000000000000000000000000000000000000000000000                    000000000000000000000000000000      000000000000                                                 000000000000000");
fputs($arc,chr(13).chr(10));
fclose($arc);
}
}
        echo 'Se genero el archivo con exito --> Descargar <a href="../vistas/descarga.php?id=reporte.txt" > facturas.txt</a> <br>';
         echo 'Se genero el archivo con exito --> Descargar <a href="../vistas/descarga.php?id=archivo2.txt" > Archivo-2.txt</a> <br>';
         echo '<a href="../vistas/rango.php">Regresar</a>';

?>
