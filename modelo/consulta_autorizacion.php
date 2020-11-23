<?php
include "../modelo/conexion.php";

//if(isset($_GET["codigo"])){
$consulta= "select * from inf_empresa";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_emp=$fila['id_emp'];
$nombre_emp=$fila['nombre'];
$web_emp=$fila['web_emp'];
$siglas=$fila['siglas'];
$gerente=$fila['gerente'];
$nit_emp=$fila['nit_emp'];
$telefono_1=$fila['telefono_1'];
$telefono_2=$fila['telefono_2'];
$telefono_3=$fila['telefono_3'];
$factura_inicial=$fila['factura_inicial'];
$factura_final=$fila['factura_final'];
$dapartamento=$fila['dapartamento'];
$municipio=$fila['municipio'];
$direccion=$fila['direccion'];
$email=$fila['email'];
$infi=$fila['inf'];


 
}                             
if(isset($_GET["autorizar"])){
$consulta= "SELECT a.*, c.nombre_emp FROM pacientes a, sis_empresa c WHERE  a.id_empresa=c.rips and a.id_paciente=".$_GET["autorizar"]."";
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
$nombre_acu=$fila['nombre_acudiente'];
$cedula_acu=$fila['cedula_acudiente'];
$telefono_acu=$fila['telefono_acudiente'];
$parentesco_acu=$fila['parentesco'];
$empresa=$fila['nombre_emp'];  


 }}
 if(isset($_GET["autorizar"])){
$consulta= "SELECT * FROM autorizacion WHERE numero_orden=".$_GET["autorizar"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_autorizacion=$fila['id_autorizacion'];
$regimenA=$fila['regimen'];
$origen_atencion=$fila['origen_atencion'];
$tipo_servicio=$fila['tipo_servicio'];
$prioridad=$fila['prioridad'];
$ubicacion=$fila['ubicacion'];
$servicio=$fila['servicio'];
$cama=$fila['cama'];
$manejo=$fila['manejo'];
$justificacion=$fila['justificacion'];
$diagnostico1=$fila['diagnostico1'];
$descripcion1=$fila['descripcion1'];
$diagnostico2=$fila['diagnostico2'];
$descripcion2=$fila['descripcion2'];
$nombre_solicita=$fila['nombre_solicita'];
$indicativo=$fila['indicativo'];
$numero = $fila['numero'];
$extencion=$fila['extencion'];
$fechaa=$fila['fecha'];
$horaa=$fila['hora'];
$numero_orden=$fila['numero_orden'];
$entidad=$fila['entidad_codigo'];
$estado_auto=$fila['estado_auto'];
                                 
 }}
?>
