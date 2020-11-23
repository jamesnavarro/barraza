<?php
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
require 'modelo/conexion.php';
require_once('class.ezpdf');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);



$queEmp = "select * from actividad where estado='Completada'  and orden_servicio='".$_GET['imprimir']."' group by orden_servicio";
$queEmp2 = "select *,CONCAT('Fecha de Registro: ',fecha_mod_ta,'\nValoracion :',Valoracion,' Tratamiento :', inf_adicional) as resumen from actividad where estado='Completada' and orden_servicio='".$_GET['imprimir']."' order by Id";


$fila =mysql_fetch_array(mysql_query($queEmp));
$consulta = mysql_query($queEmp, $conexion);
echo mysql_error();

$fila2 =mysql_fetch_array(mysql_query($queEmp2));
$consulta2 = mysql_query($queEmp2, $conexion);
echo mysql_error();

while($fila = mysql_fetch_array($consulta)){
   $descripcion = $fila["Description"];
   $codigo=$fila['cod_aten'];
}

while($fila2 = mysql_fetch_array($consulta2)){
   $descripcion2 = $fila2["Description"];
   $codigo2=$fila2['cod_aten'];
}

////////////////////////////////

$consultae= "select * from actividad a, pacientes b, sis_empresa c where a.orden_servicio='".$_GET['imprimir']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.orden_servicio";
$resulte=  mysql_query($consultae);
while($filax=  mysql_fetch_array($resulte)){

    $nombre= utf8_decode( $filax['nombres'].' '.$filax['nombre2'].' '.$filax['apellidos'].' '.$filax['apellido2']);
    $cc=$filax['numero_doc'];
    $tel=$filax['tel_1'].'-'.$filax['tel_3'];
    $enfermedad=$filax['descripcion_enf'];
    $empresa=$filax['nombre_emp'];
    $nit=$filax['nit_emp'];
    $doc=$filax['documento'];
    $direccion=$filax['direccionr_emp'];
    $tel_oficina=$filax['tel_oficina_emp'];
    $user=$filax['user'];
     $dep = mysql_query("select * from usuarios where usuario='".$user."' ");
    $d = mysql_fetch_array($dep);
}

///////////////////////////////////////////

$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
$ixx = 0;
$total = 0;
while($datatmp = mysql_fetch_assoc($resEmp)) { 
	$ixx = $ixx+1;
	$data[] = array_merge($datatmp, array('num'=>$ixx));
       
        //$total = 'num' * 'coTelefono';
}

$resEmp2 = mysql_query($queEmp2, $conexion) or die(mysql_error());
$totEmp2 = mysql_num_rows($resEmp2);
$ixx2 = 0;
$total2 = 0;
while($datatmp2 = mysql_fetch_assoc($resEmp2)) { 
	$ixx2 = $ixx2+1;
	$datatmp2["resumen"]=utf8_decode($datatmp2["resumen"]);
        $data2[] = $datatmp2;
       
}
$titles = array(                
                                
				
                                'cant'=>'<b>Cantidad de Atenciones</b>',
				'cod_aten'=>'<b>Codigo.</b>',
                                'Description'=>'<b>Atencion</b>', 
                                'orden_externa'=>'<b>Autorizacion</b>',
   
                                
			);
$titles2 = array(                
                               
                                
                                'cant_ins'=>'<b>Visita #</b>',
				
                                'resumen'=>'Resumen de valoracion y Tratamiento',
                                
                                'cant_ins'=>'<b>Visita.</b>',
                                
                               
                                
                                
			);
$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>520
			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>520
			);


$txttit = "<b>                                                                      INTERNACION DOMICILIARIA BARRAZA\n";
$txttit.= "                                                                               ATENCIONES PRESTADAS\n";
$txttit.= "";

$pdf->ezText($txttit, 8);
$img_graph = ImageCreatefrompng('imagenes/idb.png');
$pdf->addImage($img_graph,35,780,45,45);
$pdf->ezText("___________________________________________________________________________", 12);
$pdf->ezText("PACIENTE : $nombre      $doc : $cc      TEL : $tel", 8);
$pdf->ezText("EMPRESA : $empresa   NIT : $nit", 8);
$pdf->ezText("___________________________________________________________________________", 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n", 2);
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText("\n\n", 5);
$pdf->ezImage("img_barraza/".$d['ruta'], 0, 100, 'none', 'left');
$pdf->ezText("______________________                     _____________________________  ", 10);
$pdf->ezText("Firma del Responsable                            Firma del Usuario y/o Acudiente", 10);
$pdf->ezText($d['nombre'].' '.$d['apellido'], 10);
$pdf->ezText($d['cargo'].'', 10);
$pdf->ezText("\n", 2);
$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y")."<b>Hora:</b> ".$hora."", 6);
$pdf->ezStream();
?>