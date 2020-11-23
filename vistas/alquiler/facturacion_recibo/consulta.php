<?php 
if(isset($_GET['fact'])){
$consulta3= "select * from recibo_caja where numero_recibo='".$_GET['fact']."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){

$paciente=$fila['id_paciente'];
$num_fact=$fila['numero_recibo'];
$forma_pago=$fila['forma_pago'];
$me=$fila['meses'];
$fv=$fila['fecha_ven'];
$inf=$fila['informacion'];
$fr=$fila['fecha_registro'];
$p=$fila['pago_pendiente'];
$arch=$fila['orden_int'];
$ord_ext=$fila['orden_ext'];
$valor=$fila['total'];
$copagos=$fila['copagos'];
$tipo=$fila['cod_alquiler'];
}}

if(isset($_GET['fact'])){
$consulta2= "select * from equipos_asig where numero_orden_a='".$arch."'";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$id_equipo_a=$fila['id_equipo_a'];
$cod_equipo=$fila['cod_equipo'];
}}

$consulta= "select * from inf_empresa";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){

$web_emp=$fila['web_emp'];
$nombre_emp=$fila['nombre'];
$nit_emp=$fila['nit_emp'];
$tel_1=$fila['telefono_1'];
$tel_3=$fila['telefono_3'];
$fact_1=$fila['factura_inicial'];
$fact_2=$fila['factura_final'];
$dir_emp=$fila['direccion'];
$email_emp=$fila['email'];

}
if(isset($_GET['fact'])){
$consulta2= "select a.*, b.*, c.* from equipos_asig a, pacientes b, sis_empresa c, ordenes d where d.id='".$arch."' and d.id=a.numero_orden_a and d.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.id_equipo_a";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){

$orden_int=$fila['id_equipo_a'];
$orden_ext=$fila['rel_atencion'];
$nombre_seguro=$fila['nombre_emp'];
$nit_seguro=$fila['nit_emp'];
$telefono_seguro=$fila['tel_oficina_emp'];
$direccion_seguro=$fila['direccionr_emp'];
$nombre_paciente=$fila['nombres'].' '.$fila['nombre2'].' '.$fila['apellidos'].' '.$fila['apellido2'];
$cedula_paciente=$fila['numero_doc'];
$diagnostico=$fila['enfermedad'];
$enfermedad=$fila['descripcion_enf'];

}}
?>