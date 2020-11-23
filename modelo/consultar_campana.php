<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select * from sis_campana WHERE id_campana=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_ca=$fila['id_campana'];
$nombre_ca=$fila['nombre_cam'];
$estado_ca=$fila['estado_cam'];
$fecha_i_ca=$fila['fecha_inicio_cam'];
$fecha_f_ca=$fila['fecha_fin_cam'];
$tipo_ca=$fila['tipo_cam'];
$moneda_ca=$fila['moneda_cam'];
$presupuesto_ca=$fila['presupuesto_cam'];
$ingreso_ca=$fila['ingreso_cam'];
$costo_r=$fila['costo_real_cam'];
$costo_e=$fila['costo_esp_cam'];
$imp=$fila['impresiones_cam'];
$obj=$fila['objectivo_cam'];
$des=$fila['descripcion_cam'];
$asig=$fila['asignado_cam'];
$id_cont_c=$fila['id_contacto'];
$id_emp_c=$fila['id_empresa'];
$area=$fila['area'];
//$apellido_c_c=$fila['apellido_cont'];
$fecha_m_cam=$fila['fecha_mod_cam'];
$fecha_registro_cas=$fila['fecha_registro_cam']; 
 }}

?>
