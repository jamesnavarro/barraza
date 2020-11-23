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
if($_SESSION['admin']=='Si'){
    $queEmp = "select * from actividad where estado='Completada'  and id_paciente='".$_GET['imprimir']."' group by orden_servicio";
$queEmp2 = "select a.*, b.* from actividad a, evolucion b where a.estado='Completada' and a.orden_servicio=b.id_orden and a.id_paciente='".$_GET['imprimir']."' group by a.archivo";
}else{
   $queEmp = "select * from actividad where estado='Completada' and user='".$_SESSION['k_username']."' and orden_servicio='".$_GET['imprimir']."' group by orden_servicio";
$queEmp2 = "select a.*, b.* from actividad a, evolucion b where a.estado='Completada' and a.user='".$_SESSION['k_username']."' and a.orden_servicio=b.id_orden and a.id_paciente='".$_GET['imprimir']."' group by a.archivo";}

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

$consultae= "select a.*, b.*, c.* from actividad a, pacientes b, sis_empresa c where a.id_paciente='".$_GET['imprimir']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.orden_servicio";
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
	
        $data2[] = array_merge($datatmp2, array('num2'=>$ixx2));
        //$total = 'num' * 'coTelefono';
}
$titles = array(                
                                
				
                                'cant'=>'<b>Cantidad de Atenciones</b>',
				'cod_aten'=>'<b>Codigo.</b>',
                                'Description'=>'<b>Atencion</b>', 
                                'orden_externa'=>'<b>Autorizacion</b>',
    'StartTime'=>'<b>Fecha Inicial</b>',
    'EndTime'=>'<b>Fecha Final</b>',
                                
			);
$titles2 = array(                
                               
                                
                                'num2'=>'<b>Items</b>',
                                'orden_externa'=>'<b>Autorizacion</b>',
				'fecha'=>'<b>Fecha de Registro.</b>',
                                'descripcion'=>'<b>Descripcion</b>',
                                
                                
                                
			);
$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);
$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);


$txttit = "<b>                                                                      INTERNACION DOMICILIARIA BARRAZA\n";
$txttit.= "                                                                               EVOLUCION DEL PACIENTE\n";
$txttit.= "";

$pdf->ezText($txttit, 8);
$pdf->ezText("PACIENTE : $nombre      CEDULA : $cc      TEL : $tel", 8);
$pdf->ezText("EMPRESA : $empresa   NIT : $nit", 8);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n", 10);
$pdf->ezTable($data2, $titles2, '', $options2);

$pdf->ezText("\n\n", 5);
$pdf->ezText(" ", 10);
$pdf->ezText("\n", 10);
$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".$hora."\n\n", 10);
$pdf->ezStream();
?>