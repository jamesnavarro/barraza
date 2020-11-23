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

    $queEmp = 
"select a.rel_atencion, a.cod_insumo,b.nombre_insumo, a.cantidad, a.sub_precio, a.cantidad*a.sub_precio, a.fecha_registro from insumos_asignados a, insumos b where a.asignado_a='".$_GET['user']."' and  a.cod_insumo=b.codigo and a.rel_atencion='".$_GET['imprimir']."' union 
 select a.rel_atencion, b.codigo, b.nombre_medicamento, a.cantidad, a.sub_precio_m, a.cantidad*a.sub_precio_m, a.fecha_registro from medicamentos_asig a, medicamentos b where a.asignado_a='".$_GET['user']."' and b.codigo_int=a.cod_med and a.rel_atencion='".$_GET['imprimir']."'";



$fila =mysql_fetch_array(mysql_query($queEmp));
$consulta = mysql_query($queEmp, $conexion);
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
$consulta= "select a.*, b.* from actividad a, pacientes b where a.id_paciente=b.id_paciente and a.orden_servicio='".$_GET['imprimir']."' group by a.user";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){

    $user=$fila['user'];
    $Description=$fila['Description'];
    $nombre=$fila['nombres'].' '.$fila['nombre2'].' '.$fila['apellidos'].' '.$fila['apellido2'];
    $cc=$fila['numero_doc'];
}


/////////////////////////////////////

$firma = 'files/'.$_GET['user'].'.jpg';

///////////////////////////////////////////

$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
$ixx = 0;
$total = 0;
while($datatmp = mysql_fetch_assoc($resEmp)) { 
	$ixx = $ixx+1;
	$data[] = array_merge($datatmp, array('num'=>$ixx));
//        $total = 'num' * 'coTelefono';
}
$titles = array(                
                                'num'=>'<b>Items</b>',
                                'rel_atencion'=>'<b>Orden Int.</b>',
				'cod_insumo'=>'<b>Codigo</b>',
				'nombre_insumo'=>'<b>Descripcion</b>',
				'cantidad'=>'<b>Cantidad</b>',
                                'fecha_registro'=>'<b>Fecha de Entrega</b>',
                                
                                
				
                                
                                
			);

$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);

$txttit = "<b>                                 $nombre_emp\n";
$txttit.= "                                  ENTREGA DE INSUMOS Y MEDICAMENTOS \n";


$pdf->ezText($txttit, 12);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Paciente      : $nombre", 10);
$pdf->ezText("C.C              : $cc", 10);
$pdf->ezText("Atencion : $Description", 10);

$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Insumos Asignados a: $user\n", 10);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
//$pdf->ezText("<b>Entregado por : __________________________________", 10);
//$pdf->ezText("\n", 10);
$pdf->ezImage($firma, 0, 120, 'none', 'left');
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("En este documento, me responsabilizo de todos los materiales,insumos y medicamentos que se me han asignado y entregado para ser utilizados y diligenciados en la hoja de consumo para la antencion del paciente mencionado", 10);
$pdf->ezText("\n", 10);
$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".$hora."\n\n", 10);
$pdf->ezStream();
?>