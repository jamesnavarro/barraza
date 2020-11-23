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

$queEmp = "SELECT a.*, b.fecha_mod_ta, b.duracion, (select cant_ins from actividad where Id=visita_numero) as vis, concat('Localizacion: ',a.localizacion,'\nEstadio: ',a.estadio,'\nClarificacion: ',a.clarificacion,'\nDimension: ',a.dimencion,'\nBase de la herida: ',a.base_herida,'\nCant. de exusado :',a.cant_exusado,'\nPiel Circundante: ',a.piel_circundante,'\nPiel Color: ',a.piel_color,'\nSignos de Infeccion :',a.infeccion,'\nCaracteristica de Tejido: ',a.tejido,'\nExusado: ',a.exusado,'\nCaracteristica de Piel:',a.c1,' ',a.c2,' ',a.c3,' ',a.c4,' ',a.c5,'\nOlor: ',a.olor,'\nDolor: ',a.dolor) as car FROM curaciones a, actividad b WHERE a.orden_interna='".$_GET['imprimir']."'  and a.orden_interna=b.orden_servicio group by visita_numero";

$fila =mysql_fetch_array(mysql_query($queEmp));
$consulta1 = mysql_query($queEmp, $conexion);
echo mysql_error();
$iva=$to*0.16;
$neto=$to-$iva;
////////////////////////////////

$consulta2= "select * from inf_empresa";
$result=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result)){

$web_emp=$fila['web_emp'];
$nombre_emp=$fila['nombre'];
$nit_emp=$fila['nit_emp'];
$tel_1=$fila['telefono_1'];
$tel_3=$fila['telefono_3'];
$fact_1=$fila['factura_inicial'];
$fact_2=$fila['factura_final'];
$dir_emp=$fila['direccion'];
$email_emp=$fila['email'];

}

////////////////////////////////////
$consultae= "select a.*, b.*, c.* from actividad a, pacientes b, sis_empresa c where a.orden_servicio='".$_GET['imprimir']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.orden_servicio";
$resulte=  mysql_query($consultae);
while($filax=  mysql_fetch_array($resulte)){

    $nombre=$filax['nombres'].' '.$filax['nombre2'].' '.$filax['apellidos'].' '.$filax['apellido2'];
    $cc=$filax['numero_doc'];
    $tel=$filax['tel_1'].'-'.$filax['tel_3'];
    $enfermedad=$filax['descripcion_enf'];
    $empresa=$filax['nombre_emp'];
    $nit=$filax['nit_emp'];
    $direccion=$filax['direccionr_emp'];
    $tel_oficina=$filax['tel_oficina_emp'];
    $user=$filax['user'];
    $orden_ext=$filax['orden_externa'];
}


/////////////////////////////////////



///////////////////////////////////////////

$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
$ixx = 0;
$total = 0;
while($datatmp = mysql_fetch_assoc($resEmp)) { 
	$ixx = $ixx+1;
	$data[] = array_merge($datatmp, array('num'=>$ixx));
        	$datatmp["clarificacion"]=utf8_decode($datatmp["clarificacion"]);
$datatmp["car"]=utf8_decode($datatmp["car"]);
}
$titles = array(                
                                
				
                                'vis'=>'<b>Visita</b>',
                                'fecha_mod_ta'=>'<b>Fecha de Atencion</b>',
                           
				'curacion_no'=>'<b>Curacion #</b>',
                                'localizacion'=>'<b>Localizacion</b>', 
                                'car'=>'<b>Detalles de la Curacion</b>',
                                
                                
			);

$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);


$txttit = "<b>                                                                          $nombre_emp                                   \n";
$txttit.= "                                                                                   SEGUIMIENTO DE HERIDAS \n";
$pdf->ezText($txttit, 8);
$img_graph = ImageCreatefrompng('idb.png');
$pdf->addImage($img_graph,35,780,45,45);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("PACIENTE : $nombre      CEDULA : $cc      TEL : $tel", 8);
$pdf->ezText("EMPRESA : $empresa   NIT : $nit", 8);
$pdf->ezText("Autorizacion : $orden_ext", 8);
$pdf->ezText("___________________________________________________________________________________________\n", 10);
////$pdf->ezText("Factura de Venta      : $num_fact", 10);
//$pdf->ezText("Paciente      : $nombre      C.C: $cc", 8);
//$pdf->ezText("Diagnostico : $enfermedad \n", 8);
//$pdf->ezText("Forma de Pago         : $forma_pago a $me mes(es),     Fecha Vencimiento: $fv .    Orden Externa: $or ", 8);
//$pdf->ezText("___________________________________________________________________________________________", 10);
//
//$pdf->ezText("Servicios Prestados\n", 10);
//$pdf->ezText("<b>Descripcion del Equipo: </b>".$names, 10);
//$pdf->ezText("\n", 10);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n", 5);
$pdf->ezText("______________________                     _____________________________  ", 10);
$pdf->ezText("Firma del Responsable                             Firma del Usuario y/o Acudiente\n", 10);
$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".$hora."\n\n", 10);
$pdf->ezStream();
?>