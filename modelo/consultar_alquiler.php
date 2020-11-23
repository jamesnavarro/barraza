<?php
include "../modelo/conexion.php";

if(isset($_GET["codigo"])){
$consulta= "select a.*, b.* from equipos_asig a, alquiler b WHERE  a.cod_equipo=b.codigo and a.id_equipo_a=".$_GET["codigo"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id=$fila['id_equipo_a'];
$numero_orden=$fila['numero_orden_a'];
$cod_equipo=$fila['cod_equipo'];
$cantidad=$fila['cantidad'];
$precio_a=$fila['precio_a'];
$fecha_a=$fila['fecha_a'];
$fecha_f=$fila['fecha_f'];
$inf=$fila['inf'];
$fecha_reg=$fila['fecha_reg'];
$estado=$fila['estado_a'];
$meses=$fila['meses'];
$nombre=$fila['nombre'];
$rel_atencion=$fila['rel_atencion'];
$autorizacion=$fila['autorizacion'];
$valor=$fila['precio_a'];
$equipo=$fila['descripcion_equipo'];
$copagos=$fila['copagos'];
                                
 }}else{
   $consulta= "select a.*, b.* from equipos_asig a, alquiler b WHERE  a.cod_equipo=b.codigo order by id_equipo_a DESC limit 1";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id=$fila['id_equipo_a'];
$numero_orden=$fila['numero_orden_a'];
$cod_equipo=$fila['cod_equipo'];
$cantidad=$fila['cantidad'];
$precio_a=$fila['precio_a'];
$fecha_a=$fila['fecha_a'];
$fecha_f=$fila['fecha_f'];
$inf=$fila['inf'];
$fecha_reg=$fila['fecha_reg'];
$estado=$fila['estado_a'];
$meses=$fila['meses'];
$nombre=$fila['id_paciente'];
$rel_atencion=$fila['rel_atencion'];
$autorizacion=$fila['autorizacion'];
$valor=$fila['precio_a'];  
$equipo=$fila['descripcion_equipo'];
$copagos=$fila['copagos'];
 }
 }
?>
