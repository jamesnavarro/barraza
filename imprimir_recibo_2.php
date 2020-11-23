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
$queEmp = "SELECT a.*, b.*, b.cantidad*b.precio_a*b.meses, d.*, (a.meses) as mes, c.* FROM recibo_caja a, equipos_asig b, ordenes c, alquiler d WHERE d.codigo=b.cod_equipo and c.id_paciente=a.id_paciente and b.numero_orden_a=a.orden_int  and c.id=b.rel_atencion and a.numero_recibo=".$_GET['imprimir']."";
$fila =mysql_fetch_array(mysql_query($queEmp));
$consulta = mysql_query($queEmp, $conexion);
echo mysql_error();
while($fila = mysql_fetch_array($consulta)){
    $to = $fila["b.cantidad*b.precio_a*b.meses"];
    $orden_ser=$fila['numero_orden_a'];
    $mes=$fila['meses'];
    $names=$fila['inf'];
    $factura=$fila['numero_recibo'];
    $orden=$fila['orden_int'];
    $inf=$fila['imformacion'];
    $letras=$fila['letras'];
    $forma_pago=$fila['forma_pago'];
    $meses=$fila['mes'];
    $fv=$fila['fecha_ven'];
     $oe=$fila['orden_ext'];
     $total2=$fila['total'];
     $fi=$fila['fecha_registro'];
     $ff=$fila['fecha_final'];
     $copagos=$fila['copagos'];
}

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
$consulta = "select * from recibo_caja a, pacientes b where a.id_paciente=b.id_paciente and a.numero_recibo='".$_GET['imprimir']."'";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){

    $nombre=$fila['nombres'].' '.$fila['nombre2'].' '.$fila['apellidos'].' '.$fila['apellido2'];
    $cc=$fila['numero_doc'];
    $tel=$fila['tel_1'].'-'.$fila['tel_3'];
    $enfermedad=$fila['descripcion_enf'];
    $codigo=$fila['enfermedad'];
    $empresa=$fila['nombre_emp'];
    $nit=$fila['nit_emp'];
    $direccion=$fila['direccionr_emp'];
    $tel_oficina=$fila['tel_oficina_emp'];
    $or=$fila['rel_atencion'];
}


$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);
$ixx = 0;
$total = 0;
while($datatmp = mysql_fetch_assoc($resEmp)) { 
	$ixx = $ixx+1;
	$data[] = array_merge($datatmp, array('num'=>$ixx));
        //$total = 'num' * 'coTelefono';
}
$titles = array(                
                                'num'=>'<b>Items</b>',
//                                'numero_orden_a'=>'<b>Orden Int.</b>',
				'cod_equipo'=>'<b>Rips</b>',
				'nombre'=>'<b>Descripcion</b>',
 				'cantidad'=>'<b>Cantidad</b>',
  //                              'meses'=>'<b>Meses</b>',
   //                             'fecha_a'=>'<b>Fecha Inicial</b>',
    //                            'fecha_f'=>'<b>Fecha Final</b>',
                                'precio_a'=>'<b>Precio Unidad</b>',
                                'b.cantidad*b.precio_a*b.meses'=>'<b>Neto a Pagar</b>',
                                
				
                                
                                
			);

$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);

$total = $total2 -$copagos;

$txttit = "<b>                                                                                    nit: $nit_emp                                                   Forma de Pago : $forma_pago a $meses mes(es)\n";
$txttit.= "                                                                              $dir_emp                                        Fecha Vencimiento: $fv\n";
$txttit.= "                                                                          Tel: $tel_1 - $tel_3 \n";
$txttit.= "                                                                  E-mail: $email_emp  \n";
//$txttit.= "                                                   Factura Autorizada Resolucion DIAN 20000129687 del: $fact_1 al $fact_2 </b>\n";
$txttit.= "                                                                                  Regimen Comun";
$pdf->ezText("                                       $nombre_emp           Recibo de caja No $factura ", 10);
$pdf->ezText($txttit, 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Empresa      : $empresa ,                       Telefono:$tel_oficina", 10);
$pdf->ezText("Nit                : $nit", 8);
$pdf->ezText("Paciente      : $nombre      C.C: $cc", 8);
$pdf->ezText("Diagnostico :$codigo - $enfermedad                      Autorizacion: $oe  Fecha de Atencion del: $fi  al  $ff", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);

$pdf->ezText("Servicios Prestados\n", 10);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
//$pdf->ezText("Copagos :  $copagos                   Servicios :                  Materiales y Medicamentos :", 8);
$pdf->ezText("                                                                                                                           Total Neto a Pagar $ ".$total, 10);
$pdf->ezText("<b>Son: $letras", 10);
$pdf->ezText("__________________________________________________________________________________________", 10);
$pdf->ezText("<b>Informacion Adicional: $inf \n", 10);

$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".$hora."", 10);
//$pdf->ezText("<b>Favor consignar a la cuenta Corriente banco de OCCIDENTE No. 800-57712-4- Sucursal Barranquuilla o Girar cheque Cruzado a primer beneficiario a nombre de INTERNACION DOMICILIARIA BARRAZA LTDA.</b>", 8);


$pdf->ezText("\n", 10);
$pdf->ezText("___________________", 10);
$pdf->ezText("RECIBI COMFORME        ", 10);
$pdf->ezText("C.C:        ", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("                                       $nombre_emp           Recibo de caja No $factura ", 10);
$pdf->ezText($txttit, 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Empresa      : $empresa ,                       Telefono:$tel_oficina", 10);
$pdf->ezText("Nit                : $nit", 8);
$pdf->ezText("Paciente      : $nombre      C.C: $cc", 8);
$pdf->ezText("Diagnostico :$codigo - $enfermedad                      Autorizacion: $oe  Fecha de Atencion del: $fi  al  $ff", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);

$pdf->ezText("Servicios Prestados\n", 10);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("___________________________________________________________________________________________", 10);
//$pdf->ezText("Copagos :  $copagos                   Servicios :                  Materiales y Medicamentos :", 8);
$pdf->ezText("                                                                                                                           Total Neto a Pagar $ ".$total, 10);
$pdf->ezText("<b>Son: $letras", 10);
$pdf->ezText("__________________________________________________________________________________________", 10);
$pdf->ezText("<b>Informacion Adicional: $inf \n", 10);

$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".$hora."", 10);
//$pdf->ezText("<b>Favor consignar a la cuenta Corriente banco de OCCIDENTE No. 800-57712-4- Sucursal Barranquuilla o Girar cheque Cruzado a primer beneficiario a nombre de INTERNACION DOMICILIARIA BARRAZA LTDA.</b>", 8);


$pdf->ezText("\n", 10);
$pdf->ezText("___________________", 10);
$pdf->ezText("RECIBI COMFORME        ", 10);
$pdf->ezText("C.C:        ", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezStream();
?>