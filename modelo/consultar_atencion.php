<?php
include "../modelo/conexion.php";


if(isset($_GET["asunto"])){
$consulta= "select * from actividad WHERE  Subject='".$_GET["asunto"]."'";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_ta=$fila['Id'];
$asunto=$fila['Subject'];
$fecha_vencimiento=$fila['fecha_v_ta'];
$cod_aten=$fila['cod_aten'];
$fecha_inicio=$fila['fecha_i_ta'];
$obs=$fila['obs'];
$prioridad_act=$fila['prioridad_ta'];
$asignado=$fila['user_ta'];
$descripcion_act=$fila['descripcion_ta'];
$estado_act=$fila['estado_ta'];
$relacion_act=$fila['relacionado_ta'];
$id_seleccionado=$fila['id_seleccionado_ta'];
$id_contacto=$fila['id_contacto_ta'];
$id_empresa_a=$fila['id_empresa'];
$fecha_registro=$fila['fecha_reg_ta'];
$fecha_registro_mod=$fila['fecha_mod_ta'];
$paciente=$fila['id_paciente'];
$porcentaje=$fila['porcentaje'];
$tratamiento=$fila['inf_adicional'];
$orden_ser=$fila['orden_servicio'];
$pa=$fila['PA'];
$pulso=$fila['PULSO'];
$fr=$fila['FR'];
$valoracion=$fila['Valoracion'];  
$archivo=$fila['archivo'];
$registro_m=$fila['fecha_mod_ta'];
$duracion=$fila['duracion'];
$pru=$fila['prueba_realizada'];
 }}
 if(isset($_GET["codigo"])){
$consulta= "select * from actividad WHERE  Id=".$_GET["codigo"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_ta=$fila['Id'];
$asunto=$fila['Subject'];
$fecha_vencimiento=$fila['EndTime'];
$cod_aten=$fila['cod_aten'];
//$m1=$fila['minuto_v_ta'];
//$me1=$fila['meridiano_v_ta'];
$fecha_inicio=$fila['StartTime'];
//$h2=$fila['hora_i_ta'];
//$m2=$fila['minuto_i_ta'];
//$me2=$fila['meridiano_i_ta'];
$prioridad_act=$fila['prioridad'];
$asignado=$fila['user'];
$descripcion_act=$fila['Description'];
$estado_act=$fila['estado'];
$relacion_act=$fila['relacionado'];
$id_seleccionado=$fila['id_seleccionado'];
$id_contacto=$fila['id_contacto'];
$id_empresa_a=$fila['id_empresa'];
$fecha_registro=$fila['fecha_reg_ta'];
$fecha_reg_mod=$fila['fecha_mod_ta'];
$orden_ser=$fila['orden_servicio'];
$paciente=$fila['id_paciente'];$porcentaje=$fila['porcentaje']; $tratamiento=$fila['inf_adicional'];  
$pa=$fila['PA'];
$pulso=$fila['PULSO'];
$obs=$fila['obs'];
$fr=$fila['FR'];
$valoracion=$fila['Valoracion'];
$archivo=$fila['archivo'];$dias=$fila['cada'];
$registro_m=$fila['fecha_mod_ta'];
$duracion=$fila['duracion'];$up=$fila['editar'];
$pru=$fila['prueba_realizada'];
 }}else{
    $consulta= "select * from actividad order by Id DESC limit 1";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_ta=$fila['Id'];
$asunto=$fila['Subject'];
$fecha_vencimiento=$fila['EndTime'];
$cod_aten=$fila['cod_aten'];
$archivo=$fila['archivo'];
//$m1=$fila['minuto_v_ta'];
//$me1=$fila['meridiano_v_ta'];
$fecha_inicio=$fila['StartTime'];
//$h2=$fila['hora_i_ta'];
//$m2=$fila['minuto_i_ta'];
//$me2=$fila['meridiano_i_ta'];
$prioridad_act=$fila['prioridad'];
$asignado=$fila['user'];
$descripcion_act=$fila['Description'];
$estado_act=$fila['estado'];
$relacion_act=$fila['relacionado'];
$id_seleccionado=$fila['id_seleccionado'];
$id_contacto=$fila['id_contacto'];
$id_empresa_a=$fila['id_empresa'];
$fecha_registro=$fila['fecha_reg_ta'];
$fecha_reg_mod=$fila['fecha_mod_ta'];
$paciente=$fila['id_paciente'];
$obs=$fila['obs'];
$porcentaje=$fila['porcentaje'];
$tratamiento=$fila['inf_adicional'];
$orden_ser=$fila['orden_servicio'];
$pa=$fila['PA'];
$pulso=$fila['PULSO'];
$fr=$fila['FR'];
$valoracion=$fila['Valoracion'];
$registro_m=$fila['fecha_mod_ta'];
$duracion=$fila['duracion'];
$pru=$fila['prueba_realizada'];
 }}
  if(isset($_GET["ord"])){
$consulta= "select * from actividad WHERE  orden_servicio=".$_GET["orde"]." group by orden_servicio";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_ta=$fila['Id'];
$asunto=$fila['Subject'];
$fecha_vencimiento=$fila['EndTime'];
$cod_aten=$fila['cod_aten'];
//$m1=$fila['minuto_v_ta'];
//$me1=$fila['meridiano_v_ta'];
$fecha_inicio=$fila['StartTime'];
//$h2=$fila['hora_i_ta'];
//$m2=$fila['minuto_i_ta'];
//$me2=$fila['meridiano_i_ta'];
$prioridad_act=$fila['prioridad'];
$obs=$fila['obs'];
$asignado=$fila['user'];
$descripcion_act=$fila['Description'];
$estado_act=$fila['estado'];
$relacion_act=$fila['relacionado'];
$id_seleccionado=$fila['id_seleccionado'];
$id_contacto=$fila['id_contacto'];
$id_empresa_a=$fila['id_empresa'];
$fecha_registro=$fila['fecha_reg_ta'];
$fecha_reg_mod=$fila['fecha_mod_ta'];
$orden_ser=$fila['orden_servicio'];
$paciente=$fila['id_paciente'];$porcentaje=$fila['porcentaje']; $tratamiento=$fila['inf_adicional'];  
$pa=$fila['PA'];
$pulso=$fila['PULSO'];
$fr=$fila['FR'];
$valoracion=$fila['Valoracion'];
$archivo=$fila['archivo'];
$registro_m=$fila['fecha_mod_ta'];
$duracion=$fila['duracion'];
$pru=$fila['prueba_realizada'];
 }}
?>