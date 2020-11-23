<?php
include "../modelo/conexion.php";

if(isset($_GET["up1"])){
    $consulta= "select * from sis_proyecto_tarea  WHERE  id_tp=".$_GET["up1"]."";
}else{
    $consulta= "select * from sis_proyecto_tarea  WHERE  id_tp=".$_GET["cod"]."";
}

$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$nombre_tarea=$fila['nombre_tarea'];
$fecha_inicial=$fila['fecha_inicial'];
$fecha_final=$fila['fecha_final'];
$usuario=$fila['asiginado'];$area=$fila['area'];
$estado_tarea=$fila['estado_tarea'];
$porcentaje_tarea=$fila['porcentaje_tarea'];
$prioridad=$fila['prioridad'];
$cant_tareas=$fila['cant_tareas'];
$duracion_horas=$fila['duracion_horas'];
$orden=$fila['orden'];
$descripcion_tarea=$fila['descripcion_tarea'];
$ocupacion=$fila['ocupacion'];
$fecha_r=$fila['fecha_r'];
$fecha_m=$fila['fecha_m'];
$id_proyecto=$fila['id_proyecto'];

 }

?>
