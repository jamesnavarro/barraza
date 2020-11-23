<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select * from sis_proyecto  WHERE  id_proyecto=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_pro=$fila['id_proyecto'];
$nombre_pro=$fila['nombre_pro'];
$fecha_i=$fila['fecha_inicial'];
$fecha_f=$fila['fecha_final'];
$usuario_p=$fila['usuario'];$area=$fila['area'];
$prioridad_pro=$fila['prioridad_pro'];
$descripcion_pro=$fila['descripcion_pro'];
$estado_pro=$fila['estado_pro'];
$id_c_p=$fila['id_contacto'];
$id_e_p=$fila['id_empresa'];
//$nom_c_p=$fila['nombre_cont'];
//$ape_c_p=$fila['apellido_cont'];
//$nom_e_p=$fila['nombre_emp'];
$fecha_registro_pro=$fila['fecha_registro_pro'];
$fecha_mod_pro=$fila['fecha_mod_p'];


 }}

?>
