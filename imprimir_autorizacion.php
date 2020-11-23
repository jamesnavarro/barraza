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
$queEmp = "select * from cups where id_autorizacion='".$_GET['imprimir']."'";

$fila =mysql_fetch_array(mysql_query($queEmp));
$consulta = mysql_query($queEmp, $conexion);
echo mysql_error();
while($fila = mysql_fetch_array($consulta)){
//    $to = $fila["a.cantidad*a.precio_a*a.meses"];
//    $orden_ser=$fila['numero_orden_a'];
//    $mes=$fila['mes'];
//    $names=$fila['nombre'];
    
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
$dapartamento=$fila['dapartamento'];
$municipio=$fila['municipio'];
}

////////////////////////////////////
 if(isset($_GET["imprimir"])){
$consulta= "SELECT * FROM autorizacion WHERE numero_orden=".$_GET["imprimir"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_autorizacion=$fila['id_autorizacion'];
$regimenA=$fila['regimen'];
$origen_atencion=$fila['origen_atencion'];
$tipo_servicio=$fila['tipo_servicio'];
$prioridad=$fila['prioridad'];
$ubicacion=$fila['ubicacion'];
$servicio=$fila['servicio'];
$cama=$fila['cama'];
$manejo=$fila['manejo'];
$justificacion=$fila['justificacion'];
$diagnostico1=$fila['diagnostico1'];
$descripcion1=$fila['descripcion1'];
$diagnostico2=$fila['diagnostico2'];
$descripcion2=$fila['descripcion2'];
$nombre_solicita=$fila['nombre_solicita'];
$indicativo=$fila['indicativo'];
$numero = $fila['numero'];
$extencion=$fila['extencion'];
$fecha=$fila['fecha'];
$hora=$fila['hora'];
$numero_orden=$fila['numero_orden'];
            $entidad=$fila['entidad_codigo'];                     
 }}

/////////////////////////////////////
$consulta= "select b.*, c.* from  pacientes b, sis_empresa c where b.id_paciente='".$_GET['imprimir']."' and b.id_empresa=c.rips";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){

    $nombrepaciente=$fila['apellidos'].' '.$fila['apellido2'].' '.$fila['nombres'].' '.$fila['nombre2'];
    $cc=$fila['numero_doc'];
    $doc=$fila['documento'];
    $tel=$fila['tel_1'].'  '.$fila['tel_3'];
    $enfermedad=$fila['descripcion_enf'];
    $empresa=$fila['nombre_emp'];
    $nit=$fila['nit_emp'];
    $direccion=$fila['direccionr_emp'];
    $tel_oficina=$fila['tel_oficina_emp'];
    $or=$fila['orden'];
    $fn=$fila['fecha_nacimiento'];
    $dir=$fila['direccion1'];
    $dep=$fila['departamento'];
    $mun=$fila['municipio'];
    $cel=$fila['celular'];
    $email=$fila['email1'];
    $enf=$fila['enfermedad'];
    $desc=$fila['descripcion_enf'];
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
$titles = array(                
                                'num'=>'<b>Items</b>',
				'codigo'=>'<b>Codigo CUPS</b>',
                                'cantidad'=>'<b>Cantidad</b>',
                                'descripcion'=>'<b>Descripcion</b>',
 
                                
				
                                
                                
			);

$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);


$txttit = "<b>                                                                      INTERNACION DOMICILIARIA BARRAZA\n";
$txttit.= "                                                           SOLICITUD DE AUTORIZACION DE SERVICIO DE SALUD\n";
$txttit.= "\n";
$txttit.= "Numero de solicitud $id_autorizacion                       fecha:$fecha     Hora:$hora\n";
$pdf->ezText($txttit, 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("INFORMACION DEL PRESTADOR", 10);
$pdf->ezText("Nombre : $nombre_emp                         Nit:*  $nit_emp ", 8);
$pdf->ezText("Codigo :                                                                                       Direccion presatador: $dir_emp", 8);
$pdf->ezText("Telefono : $tel_1                                                                    Departamento : $dapartamento   Municipio : $municipio", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("ENTIDAD A LA QUE SE LE SOLICITA (pagador): $entidad", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("DATOS DEL PACIENTE", 10);
$pdf->ezText("<b>Nombre del Paciente : </b>".$nombrepaciente, 8);
$pdf->ezText("$doc : $cc                                                      <b>Fecha de Nacimiento : $fn</b>", 8);
$pdf->ezText("<b>Direccion de Residencia Habitual: $dir</b>             Telefono  : $tel", 8);
$pdf->ezText("<b>Departamento: $dep</b>             Municipio  : $mun",8);
$pdf->ezText("<b>Celular: $cel</b>             Email  : $email",8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Cobertura en salud : $regimenA", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("INFORMACION DE LA ATENCION Y SERVICIOS SOLICITADOS", 10);
$pdf->ezText("Origen de la Atencion : $origen_atencion", 8);
$pdf->ezText("Tipo de servicios solicitados : $tipo_servicio", 8);
$pdf->ezText("Prioridad de la : $prioridad", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Ubicacion del Paciente al momento de la solicitud de autorizacion :", 8);
$pdf->ezText("$ubicacion", 8);
//$pdf->ezText("Servicio : $servicio", 8);
//$pdf->ezText("Cama : $cama", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Manejo Integral segun Guia de: $manejo", 8);
$pdf->ezText("\n", 10);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Justificacion Clinica:", 8);
$pdf->ezText("$justificacion", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("Impresion Diagnostica:", 8);
$pdf->ezText("Diagnostico Principal         : $enf   Descripcion: $desc", 8);
$pdf->ezText("Diagnostico relacionado 1 : $diagnostico1  Descripcion: $descripcion1", 8);
$pdf->ezText("Diagnostico relacionado 2 : $diagnostico2  Descripcion: $descripcion2", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("INFORMACION DE LA PERSONA QUE SOLICITA", 10);
$pdf->ezText("Nombre de que solicita: $nombre_solicita ", 8);
$pdf->ezText("Telefono : $indicativo $numero $extencion", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".$hora."\n\n", 10);
$pdf->ezStream();
?>