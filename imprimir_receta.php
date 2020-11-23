<?php
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
require 'modelo/conexion.php';
require_once('class.ezpdf');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);

@mysql_query("SET collation_connection = utf8_spanish_ci;");

    $queEmp = "select * from actividad where orden_servicio='".$_GET['imprimir']."'  group by orden_servicio";
$queEmp2 = "select *, concat(a.descripcion,'\n Fecha de Registro: ',a.fecha) as de from receta a, actividad b WHERE a.id_orden=b.orden_servicio and a.id_orden='".$_GET['imprimir']."' group by a.descripcion";


$fila =mysql_fetch_array(mysql_query($queEmp));
$consulta = mysql_query($queEmp, $conexion);
echo mysql_error();

$fila2 =mysql_fetch_array(mysql_query($queEmp2));
$consulta2 = mysql_query($queEmp2, $conexion);
echo mysql_error();

////////////////////////////////

$consultae= "select a.*, b.*, c.* from actividad a, pacientes b, sis_empresa c where a.orden_servicio='".$_GET['imprimir']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.orden_servicio";
$resulte=  mysql_query($consultae);
while($filax=  mysql_fetch_array($resulte)){

     $nombre=$filax['nombres'].' '.$filax['nombre2'].' '.$filax['apellidos'].' '.$filax['apellido2'];
    $cc=$filax['numero_doc'];
    $tel=$filax['tel_1'].'-'.$filax['tel_3'];
    $enfermedad=$filax['descripcion_enf'];
    $empresa=$filax['nombre_emp'];
    $nit=$filax['nit_emp'];  
    $direccione=$filax['direccion1'];
    $tel_oficina=$filax['tel_oficina_emp'];
    $user=$filax['user'];   $edad=$filax['edad'];
    
    $dep = mysql_query("select * from departamentos where cod_dep=".$filax['departamento']." ");
    $d = mysql_fetch_array($dep);
    $departamento = $d['nombre_dep'];
    $mun = mysql_query("select * from departamentos where cod_mun=".$filax['municipio']." and   cod_dep=".$filax['departamento']."");
    $m = mysql_fetch_array($mun);
    $municipio = $m['nombre_mun'];
    
}
if(isset($user)){
 $sqla = "SELECT * FROM usuarios where usuario='".$user."'";
                $filaa =mysql_fetch_array(mysql_query($sqla, $conexion));
                $np= $filaa["nombre"].' '.$filaa["apellido"];
$cargo= $filaa["cargo"];
$firma= $filaa["ruta"];
}
///////////////////////////////////////////

$resEmp2 = mysql_query($queEmp2, $conexion) or die(mysql_error());
$totEmp2 = mysql_num_rows($resEmp2);
$ixx2 = 0;
$total2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$ixx2 = $ixx2+1;
        $a = utf8_decode($datatmp2["de"]);
	$datatmp2["de"]=strtoupper($a);
        $data2[] = array_merge($datatmp2, array('num2'=>$ixx2));
        //$total = 'num' * 'coTelefono';
}
$titles2 = array(                
                               
                                
                              
                                'de'=>'<b>DESCRIPCION DE LA RECETA MEDICA</b>',
                                
                                
                                
			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);


$txttit = "<b>                                             INTERNACION DOMICILIARIA BARRAZA\n";
$txttit.= "                                                          RECETA MEDICA\n";
$txttit.= "___________________________________________________________________________________";
$pdf->ezText($txttit, 11);
$pdf->ezText("\n", 5);
$img_graph = ImageCreatefrompng('idb.png');
$pdf->addImage($img_graph,35,780,45,45);
$pdf->ezText("PACIENTE          : $nombre     ", 8);
$pdf->ezText("CEDULA             : $cc", 8);
$pdf->ezText("EDAD                  : $edad ", 8);
$pdf->ezText("DIRECCION        : $direccione  TEL : $tel  $municipio - $departamento   ", 8);
$pdf->ezText("DIAGNOSTICO   : $enfermedad", 8);
$pdf->ezText("ASEGURADORA: $empresa $firma", 8);
$pdf->ezText( "___________________________________________________________________________________________", 10);
$pdf->ezText("\n", 5);
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText( "___________________________________________________________________________________________", 10);
$pdf->ezText("\n\n", 5);
$pdf->ezText(" ", 10);
$pdf->ezText("\n\n\n\n\n\n\n\n\n", 10);
$pdf->ezText("<b>_________________________                                                       ___________________________</b> ", 10);
$pdf->ezText("<b>Firma de Profesional:                                                                       Firma del Acudiente     </b>", 10);
$pdf->ezText("$np", 8);
$pdf->ezText("$cargo", 8);
$img_graph2 = ImageCreatefrompng(''.$firma.'');
$pdf->addImage($img_graph2,45,480,45,45);
$pdf->ezStream();
?>