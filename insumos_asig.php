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
$queEmp ="SELECT a.rel_atencion, a.autorizacion, a.cod_insumo, b.nombre_insumo, a.cantidad, a.cant_usada, max(d.fecha_mod_ta), min(d.fecha_mod_ta) FROM insumos_asignados a, insumos b, actividad d WHERE d.orden_servicio=a.rel_atencion and a.cod_insumo=b.codigo and a.rel_atencion='".$_GET['imp']."' and d.fecha_mod_ta!=''  group by a.id_ia";
$queEmp2 ="SELECT a.rel_atencion, a.autorizacion, a.cod_med, b.nombre_medicamento, a.cantidad, a.cantidad_usada, max(d.fecha_mod_ta), min(d.fecha_mod_ta) FROM medicamentos_asig a, medicamentos b, actividad d WHERE d.orden_servicio=a.rel_atencion  and a.cod_med=b.codigo_int and a.rel_atencion='".$_GET['imp']."' and d.fecha_mod_ta!='' group by a.id";

$fila =mysql_fetch_array(mysql_query($queEmp));
$consulta = mysql_query($queEmp, $conexion);
echo mysql_error();

$fila2 =mysql_fetch_array(mysql_query($queEmp2));
$consulta2 = mysql_query($queEmp2, $conexion);
echo mysql_error();

while($fila = mysql_fetch_array($consulta)){
    $to = $fila["a.cantidad*a.sub_precio"] + $to;

    
}
$iva=$to*0.16;
$neto=$to-$iva;
////////////////////////////////

$consulta= "select * from inf_empresa";
$result=  mysql_query($consulta);
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
$consulta= "select a.*, b.*, c.* from actividad a, pacientes b, sis_empresa c where c.rips=b.id_empresa and a.id_paciente=b.id_paciente and a.orden_servicio='".$_GET['imp']."' group by a.user";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){

    $user=$fila['user'];
    $Description=$fila['Description'];
    $nombre=$fila['nombres'].' '.$fila['nombre2'].' '.$fila['apellidos'].' '.$fila['apellido2'];
    $cc=$fila['numero_doc'];
    $emp=$fila['nombre_emp'];
    $nit=$fila['nit_emp'];
}


/////////////////////////////////////

$firma = 'files/'.$_GET['user'].'.png';

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
	$data2[] = array_merge($datatmp2, array('num'=>$ixx2));
        //$total = 'num' * 'coTelefono';
}
$titles = array(                
                                'num'=>'<b>Items</b>',
                                'rel_atencion'=>'<b>Orden Int.</b>',
                                'autorizacion'=>'<b>Autorizacion.</b>',
				'cod_insumo'=>'<b>Codigo</b>',
				'nombre_insumo'=>'<b>Descripcion</b>',
				'cantidad'=>'<b>Cant. Asig</b>',
                                'cant_usada'=>'<b>Cant. Usadas</b>',
                                'min(d.fecha_mod_ta)'=>'<b>Fecha de Comienzo</b>',
                                'max(d.fecha_mod_ta)'=>'<b>Fecha Final</b>',
                                
				
                                
                                
			);

$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);
			$titles2 = array(                
                                'num'=>'<b>Items</b>',
                                'rel_atencion'=>'<b>Orden Int.</b>',
                                'autorizacion'=>'<b>Autorizacion.</b>',
				'cod_med'=>'<b>Codigo</b>',
				'nombre_medicamento'=>'<b>Descripcion</b>',
				'cantidad'=>'<b>Cant. Asig</b>',
                                'cantidad_usada'=>'<b>Cant. Usadas</b>',
                                'min(d.fecha_mod_ta)'=>'<b>Fecha de Comienzo</b>',
                                'max(d.fecha_mod_ta)'=>'<b>Fecha Final</b>',
                                
				
                                
                                
			);

$options2 = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);

$txttit = "<b>                                 $nombre_emp\n";
$txttit.= "                     INSUMOS Y MEDICAMENTOS UTILIZADOS EN LA ATENCION \n";


$pdf->ezText($txttit, 12);
$img_graph = ImageCreatefrompng('idb.png');
$pdf->addImage($img_graph,35,780,45,45);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Paciente : ".utf8_decode($nombre), 10);
$pdf->ezText("C.C         : $cc", 10);
$pdf->ezText("Empresa : $emp      Nit : $nit", 10);

$pdf->ezText("Atencion : $Description", 10);

$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Insumos Utilizados por: $user\n", 10);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n", 10);
$pdf->ezText("Medicamentos Utilizados\n", 10);
$pdf->ezTable($data2, $titles2, '', $options2);
$pdf->ezText("\n\n\n", 10);
//$pdf->ezText("<b>Entregado por : __________________________________", 10);
//$pdf->ezText("\n", 10);
$pdf->ezImage($firma, 0, 120, 'none', 'left');
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("\n", 10);
$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".$hora."\n\n", 10);
$pdf->ezStream();
?>