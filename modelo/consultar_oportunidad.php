<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select * from sis_oportunidades a, sis_empresa b WHERE a.id_empresa=b.id_empresa and  a.id_oportunidad=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_oport=$fila['id_oportunidad'];
$nombre_oport=$fila['nombre_opo'];
$nombre_emp_oport=$fila['nombre_emp'];
//$nombre_cont_oport=$fila['nombre_cont'];
//$apellido_cont_oport=$fila['apellido_cont'];
$id_empresa_oport=$fila['id_empresa'];
$tipo_oport=$fila['tipo_opo'];
$toma_oport=$fila['toma_opo'];
$descripcion_oport=$fila['descripcion_opo'];
$user=$fila['asignado_opo'];$area=$fila['area'];
$campana_oport=$fila['campana_opo'];
$moneda_oport=$fila['moneda_opo'];
$cantidad_oport=$fila['cantidad'];
$etapas_oport=$fila['etapas_opo'];
$probabilidad_oport=$fila['probabilidad'];
$paso_oport=$fila['paso_opo']; 
$fecha_oport=$fila['fecha_opo']; 
$id_contacto_oport=$fila['id_contacto']; 
$fecha_registro_oport=$fila['fecha_registro'];
$fecha_m_oport=$fila['fecha_mod_opo'];
 }}

?>
