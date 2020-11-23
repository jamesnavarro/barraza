<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){

$consulta= "SELECT a.*, b.* FROM pacientes a, ordenes b WHERE a.id_paciente=b.id_paciente and b.id=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
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
$registro_mod=$fila['fecha_mod'];
$registro=$fila['fecha_reg']; 
$orden_interna=$fila['id']; 
$orden_servicio=$fila['orden'];
$orden_int = $orden_servicio + 1;
$barrio=$fila['barrio'];
                                 
 }}
 

?>
