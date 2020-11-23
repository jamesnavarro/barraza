<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select * from sis_empresa WHERE `id_empresa`=".$_GET["cod"];
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_empresa=  $fila['id_empresa']; 
 $_SESSION['id_emp']=$id_empresa;
$nombre_emp=$fila['nombre_emp'];
$web_empe=$fila['web_emp'];
$simbolo=$fila['simbolo_emp'];
$miembro=$fila['miembro_emp'];
$propietario=$fila['propietario_emp'];
$industria=$fila['industria_emp'];
$tipo=$fila['tipo_emp'];
$usuario=$fila['usuario'];
$area_act=$fila['area_user'];
$te1=$fila['tel_oficina_emp'];
$fax1=$fila['fax_emp'];
$cel_emp=$fila['celular_emp'];
$empleados=$fila['empleados_emp'];
$puntaje=$fila['puntaje_emp'];
$nit=$fila['nit_emp'];
$ingre=$fila['ingresos_emp'];
$depa=$fila['departameto_emp'];
$munici=$fila['municipio_emp'];
$dire1=$fila['direccionr_emp'];
$dire2=$fila['direccione_emp'];
$emai1=$fila['email1_emp'];
$emai2=$fila['email2_emp'];
$emai3=$fila['email3_emp'];
$info=$fila['inf_emp'];
$registr=$fila['fecha_registro'];
$registr_mo=$fila['fecha_modificacion'];
$rips=$fila['rips'];
}                          

 }
?>
