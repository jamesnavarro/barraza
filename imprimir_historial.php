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
$queEmp = "select * from historialclinico  where id_paciente='".$_GET['imprimir']."'";
    

$fila =mysql_fetch_array(mysql_query($queEmp));
$consulta = mysql_query($queEmp, $conexion);
echo mysql_error();
while($fila = mysql_fetch_array($consulta)){
//    $to = $fila["a.cantidad*a.precio_a*a.meses"];
//    $orden_ser=$fila['numero_orden_a'];
//    $mes=$fila['mes'];
//    $names=$fila['nombre'];
    
}

////////////////////////////////////
 if(isset($_GET["imprimir"])){
$consulta= "SELECT * FROM historialclinico WHERE id_paciente=".$_GET["imprimir"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_histoh=$fila['id_historia'];
$id_pacienteh=$fila['id_paciente'];
//$motivoh=$fila['Motivo'];
$cancer1h=$fila['Cancer1'];
$Diabetes1h=$fila['Diabetes1'];
$ataques1h=$fila['Ataques1'];
$hipertencion1h=$fila['Hipertencion1'];
$emfermedades1h=$fila['Emfermedades1'];
$tuberculosis1h=$fila['Tuberculosis1'];
$otras1h=$fila['Otras1'];
$especifique1h=$fila['Especifique1'];
$alcoholh=$fila['Alcohol'];
$tabacoh=$fila['Tabaco'];
$drogash=$fila['Drogas'];
$cancerh=$fila['Cancer'];
$ataquesh=$fila['Ataques'];
$diabetesh= $fila['Diabetes'];
$hipertencionh=$fila['Hipertenion'];
$enfermedadesh=$fila['emfermedades'];
$tuberculosish=$fila['Tuberculosis'];
$otrash=$fila['Otras'];
$especifiqueh=$fila['Especifique'];
$medicamentosh= $fila['Medicamentos'];
$alergiash=$fila['Alergias'];
$cuales1h=$fila['Cuales1'];
$cuales2h=$fila['Cuales2'];
$ecuales4h=$fila['Cuales3'];
$concienteh=$fila['Conciente'];
$somnolientoh=$fila['Somnoliento'];
$fch=$fila['FC'];
$tah=$fila['TA'];
$frh=$fila['FR'];
$pulsoh=$fila['PULSO'];
$axilarh=$fila['Axilar'];
$actualh=$fila['Actual'];
$laboratoriosh=$fila['Laboratorios'];
$cuales4h=$fila['Cuales4'];
$cuales5h=$fila['Cuales5'];
$cuales6h=$fila['Cuales6'];
$otrosh=$fila['Otros'];
$cuales7h=$fila['Cuales7'];
$cuales8h=$fila['Cuales8'];
$cuales9h=$fila['Cuales9'];
$motivo2h=$fila['Motivo2'];
$motivo3h=$fila['Motivo3'];
$fechah=$fila['fecha_registro'];
$horah=$fila['orden'];
//            $entidad=$fila['entidad_codigo'];                     
 }}


$consultae= "select a.*, b.*, c.* from actividad a, pacientes b, sis_empresa c where a.id_paciente='".$_GET['imprimir']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.orden_servicio";
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
                                'id_historia'=>'<b>Items</b>',
				'id_paciente'=>'<b>Pacientes</b>',
                            
 
                                
				
                                
                                
			);

$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);


$txttit = "<b>                                                   INTERNACION DOMICILIARIA BARRAZA\n";
$txttit.= "                                                             HISTORIA CLINICA\n";
$txttit.= "___________________________________________________________________________________";
$pdf->ezText($txttit, 11);
$pdf->ezText("\n", 5);
//$img_graph = ImageCreatefrompng('idb.png');
$pdf->addImage($img_graph,35,780,45,45);
$pdf->ezText("PACIENTE       : $nombre     ", 8);
$pdf->ezText("CEDULA          : $cc", 8);
$pdf->ezText("EDAD               : $edad ", 8);
$pdf->ezText("DIRECCION     : $direccione  TEL : $tel  $municipio - $departamento   ", 8);
$pdf->ezText("DIAGNOSTICO: $enfermedad", 8);
$pdf->ezText("ASEGURADORA: $empresa", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("HISTORIAL FAMILIAR", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("CANCER............................... : $cancer1h                                                   DIABETES : $Diabetes1h ", 8);
$pdf->ezText("ATAQUES DEL CORAZON.. : $ataques1h                                          HIPERTENCION : $hipertencion1h", 8);
$pdf->ezText("ENFERMEDADES RENALES: $emfermedades1h                                         TUBERCULOSIS : $tuberculosis1h", 8);
$pdf->ezText("OTRAS.................................. : $otras1h                                            DESCRIPCION : $especifique1h", 8);
//$pdf->ezText("__________________________________________________________________________________ _________", 10);
//$pdf->ezText("Telefono : $tel_1                                                                    Departamento : $dapartamento   Municipio : $municipio", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("ANTECEDENTES PERSONALES: ", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("ALCOHOL........................... : $alcoholh                                                      DIABETES : $diabetesh ", 8);
$pdf->ezText("TABACO............................. : $tabacoh                                             HIPERTENCION : $hipertencionh ", 8);
$pdf->ezText("DROGAS............................ : $drogash                                            TUBERCULOSIS : $tuberculosish ", 8);
$pdf->ezText("OTRAS................................ : $otrash                                               ESPECIFIQUE : $especifiqueh ", 8);
$pdf->ezText("ATAQUES DEL CORAZON : $ataquesh                                          MEDICAMENTOS : $medicamentosh ", 8);
$pdf->ezText("ENFERMEDADES.............. : $enfermedadesh                                                        CANCER : $cancerh ", 8);
$pdf->ezText("ALERGIAS.......................... : $alergiash                                                DESCRIPCION : $cuales1h  $cuales2h  $ecuales4h ", 8);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("EXAMENES COMPLEMENTARIOS", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("LABORATORIOS :$laboratoriosh", 8);
$pdf->ezText("DESCRIPCION:$cuales4h  $cuales5h  $cuales6h ", 8);
$pdf->ezText("OTROS : $otrosh", 8);
$pdf->ezText("DESCRIPCION: $cuales7h  $cuales8h $cuales9h", 8);
$pdf->ezText("\n", 10);
$pdf->ezText("___________________________________________________________________________________________", 10);
$pdf->ezText("<b>Fecha de Impresion:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".$hora."\n\n", 10);
$pdf->ezStream();
?>