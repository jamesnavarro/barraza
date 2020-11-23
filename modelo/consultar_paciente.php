<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select * from pacientes WHERE  id_paciente=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila= mysql_fetch_array($result)){
$idp=$fila['id_paciente'];
$documento=$fila['documento'];
$numero_doc=$fila['numero_doc'];
$empresar=$fila['id_empresa'];
$regimen=$fila['regimen'];
$nombre=$fila['nombres'];
$apellido=$fila['apellidos'];
$nombre2=$fila['nombre2'];
$apellido2=$fila['apellido2'];
$edad=$fila['edad'];
$zona=$fila['zona'];
$sexo=$fila['sexo'];
$fecha_n=$fila['fecha_nacimiento'];
$estado=$fila['estado'];
$empresa_la=$fila['empresa_lab'];
$tel_empresa=$fila['tel_empresa'];
$asignado = $fila['asignado_a'];
$enfermedad=$fila['enfermedad'];
$descripcion_enf=$fila['descripcion_enf'];
$diagnostico=$fila['diagnostico2'];
$descripcion_diag2=$fila['descripcion_diag2'];
$tel1=$fila['tel_1'];
$tel2=$fila['tel_2'];
$tel3=$fila['tel_3'];
$celular=$fila['celular'];
$dep=$fila['departamento'];
$muni=$fila['municipio'];
$dir1=$fila['direccion1'];
$dir2=$fila['direccion2'];
$ema1=$fila['email1'];
$ema2=$fila['email2'];
$ema3=$fila['email3'];
$inf=$fila['informacion'];
$inf2=$fila['porque'];
$registro_mod=$fila['fecha_mod'];
$registro=$fila['fecha_reg']; 
$nombre_acu=$fila['nombre_acudiente'];
$cedula_acu=$fila['cedula_acudiente'];
$telefono_acu=$fila['telefono_acudiente'];
$parentesco_acu=$fila['parentesco'];
$subcodigo=$fila['subcodigo'];
$civil=$fila['civil'];
$tipo_s=$fila['tipo_s'];
$ocupacion=$fila['ocupacion'];
$dir_pariente=$fila['dir_pariente'];
$parentesco_acu2=$fila['parentesco2'];    
$alta=$fila['alta'];  
$barrio=$fila['barrio'];  

$munici = mysql_query("select * from departamentos where cod_dep='".$dep."' and cod_mun='".$muni."' ");
$m = mysql_fetch_array($munici);
$municipio = $m['nombre_dep'].' - '.$m['nombre_mun'];
 }
 
if(isset($empresar)){
$consulta2= "select * from sis_empresa WHERE  rips='".$empresar."'";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idempresa=$fila['id_empresa'];
$empresax=$fila['nombre_emp'];
}
}
}



?>
