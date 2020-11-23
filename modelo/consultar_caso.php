<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select *, (a.id_empresa) as p from sis_casos a, pacientes b WHERE a.id_empresa=b.id_paciente and  a.id_caso=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_c=$fila['id_caso'];
$prioridad_cas=$fila['prioridad_caso'];
$estado_cas=$fila['estado_caso'];
$tipo_cas=$fila['tipo_caso'];$tipo_cas2=$fila['asistente2'];$tipo_cas3=$fila['asistente3'];
$asunto_cas=$fila['asunto_caso'];
$descripcion_cas=$fila['descripcion_caso'];
$resolucion_cas=$fila['resolucion_caso'];
$asignado_caso=$fila['asignado_caso'];
$id_p=$fila['p'];
$nom_emp_cas=$fila['nombres'].' '.$fila['apellidos'];
//$_SESSION['nombre_emp_caso']=$nom_emp_cas;
$id_contacto_caso=$fila['id_contacto'];
$fecha_registro_caso=$fila['fecha_registro_caso']; 
$fecha_mod_caso=$fila['fecha_mod_caso'];$id_paciente=$fila['id_paciente'];

 }}

?>
