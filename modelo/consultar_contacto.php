<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select * from sis_contacto WHERE  id_contacto=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$idc=$fila['id_contacto'];
$idemp=$fila['id_empresa'];
$nombre=$fila['nombre_cont'];
$apellido=$fila['apellido_cont'];
//$empresa=$fila['nombre_emp'];
$toma=$fila['toma_contacto'];
$camp=$fila['id_campana'];
//$nombre_camp=$fila['nombre_cam'];
$cargo=$fila['cargo'];
$departamento=$fila['departamento'];
$informa_a = $fila['informa_a'];
$llamar=$fila['llamar'];
$estado=$fila['estado'];
$fecha=$fila['fecha'];
$tel1=$fila['tel_oficina'];
$fax=$fila['fax'];
$movil=$fila['celular'];
$tel2=$fila['tel_casa'];
$tel3=$fila['tel_alt'];
$asistente=$fila['nombre_asistente'];
$tel_asist=$fila['tel_asistente'];
$user=$fila['usuario'];$area_act=$fila['area_user'];
$dep=$fila['departamento_cont'];
$muni=$fila['municipio'];
$dir1=$fila['direccionf'];
$dir2=$fila['direccione'];
$ema1=$fila['email1'];
$ema2=$fila['email2'];
$ema3=$fila['email3'];
$inf=$fila['informacion'];
$registro_m=$fila['fecha_modificacion'];
$registro=$fila['fecha_registro'];
 $tipo =$fila['tipo'];                                
 }}
 if($idemp==0){
     $idempresa='';
$empresa='';
 }else{
$consulta2= "select * from sis_empresa WHERE  id_empresa=".$idemp."";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idempresa=$fila['id_empresa'];
$empresa=$fila['nombre_emp'];
}}
if($informa_a==0){
    $idinforma='';
$informa='';
}else{
$consulta3= "select * from sis_contacto WHERE  id_contacto=".$informa_a."";
$result3=  mysql_query($consulta3);
while($filac=  mysql_fetch_array($result3)){
$idinforma=$filac['id_contacto'];
$informa=$filac['nombre_cont'].' '.$filac['apellido_cont'];
}}
?>
