<?php
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
require 'modelo/conexion.php';
require_once('class.ezpdf');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);





////////////////////////////////

$consultae= "select a.*, b.*, c.*  from actividad a, pacientes b, sis_empresa c where a.id_paciente=".$_GET['imprimir']." and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.orden_servicio";
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

///////////////////////////////////////////



$txttit = "<b>                                                   INTERNACION DOMICILIARIA BARRAZA\n";
$txttit.= "                                                          ATENCIONES PRESTADAS\n";
$txttit.= "___________________________________________________________________________________";
$pdf->ezText($txttit, 11);
$img_graph = ImageCreatefrompng('idb.png');
$pdf->addImage($img_graph,35,780,45,45);
$pdf->ezText("\n", 5);
$pdf->ezText("PACIENTE       : $nombre     ", 8);
$pdf->ezText("CEDULA          : $cc", 8);
$pdf->ezText("EDAD               : $edad ", 8);
$pdf->ezText("DIRECCION     : $direccione  TEL : $tel  $municipio - $departamento   ", 8);
$pdf->ezText("DIAGNOSTICO: $enfermedad", 8);
$pdf->ezText("EMPRESA        : $empresa", 8);
$pdf->ezText( "___________________________________________________________________________________________", 10);
$pdf->ezText("\n", 5);
//$archivo = mysql_query("select * from actividad where  id_paciente=".$_GET['imprimir']." ");
//$resEmp2 = mysql_query($queEmp2, $conexion) or die(mysql_error());
//while ($arc = mysql_affected_rows($archivo))


$queEmp2 = "select *, CONCAT('ORDEN INTERNA:',orden_servicio ,'\n_______________________________________________________________________________________________________________________________________________________________________', '\nAUTORIZACION : ',orden_externa ,'\nATENCION         : ', Description, '\nCANTIDAD         : ', cant, '\nAtendido por: ', (select concat(nombre,' ', apellido) from usuarios where usuario=user) ,'\nregistro         : ',EndTime, '\n\n* Valoracion :',Valoracion,' \n* Tratamiento :', inf_adicional,'\n_______________________________________________________________________________________________________________________________________________________________________') as resumen  from actividad where estado='Completada' and id_paciente=".$_GET['imprimir']." group by id order by archivo, cant_ins ";



$ixx2 = 0;
$total2 = 0;
$resEmp2 = mysql_query($queEmp2, $conexion) or die(mysql_error());
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$ixx2 = $ixx2+1;
        $resumen = utf8_decode($datatmp2["resumen"]);
$datatmp2["resumen"]=strtoupper($resumen);
 $orden = $datatmp2["orden_servicio"];
        $data2[] = $datatmp2;
}

$titles2 = array(                
				'cant_ins'=>'<b>Visita. </b>',
                                'resumen'=>'<b>Resumen de valoracion y Tratamiento</b>',        
			);

$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText( "___________________________________________________________________________________________", 10);
$pdf->ezText("\n\n", 5);
$pdf->ezText("______________________                     _____________________________  ", 10);
$pdf->ezText("Firma del Responsable                             Firma del Usuario y/o Acudiente\n", 10);
$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".$hora."\n\n", 10);
$pdf->ezStream();
?>