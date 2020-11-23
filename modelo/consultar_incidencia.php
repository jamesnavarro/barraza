<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select * from sis_incidencias WHERE  id_incidencia=".$_GET["cod"]."";
$result=  mysql_query($consulta);
$fila=  mysql_fetch_array($result);
$id_i=$fila['id_incidencia'];
$prioridad_i=$fila['prioridad_inc'];
$tipo_i=$fila['tipo_inc'];
$fuente_i=$fila['fuente_inc'];
$categoria_i=$fila['categoria_inc'];
$lanzamiento_i=$fila['lanzamiento_inc'];
$asunto_i=$fila['asunto_inc'];
$descripcion_i=$fila['descripcion_inc'];
$registro_i=$fila['registro_inc'];
$asignado_i=$fila['asignado_inc'];
$estado_i=$fila['estado_inc'];
$resolucion_i=$fila['resolucion_inc'];
$id_contacto_i=$fila['id_contacto'];
//$nombre_cont_i=$fila['nombre_cont'];
$id_empresa_i=$fila['id_empresa'];
$correg=$fila['corregido_inc'];
//$nombre_emp_i=$fila['nombre_emp'];
$fecha_registro_i=$fila['fecha_registro_inc'];
$fecha_mod_i=$fila['fecha_mod_reg'];
$id_paciente=$fila['id_paciente'];
$registrado_por=$fila['registrado_por'];
if($categoria_i=='Otros'){
    $dis = '';
}else{
    $dis = 'readonly';
}
}
?>
