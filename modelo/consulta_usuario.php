<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select * from usuarios WHERE id=".($_GET["cod"])."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$idus=$fila['id'];
$user_u=$fila['usuario'];
$password_u=$fila['password'];
$descripcion_u=$fila['descripcion'];
$email_u=$fila['email'];
$nombre_u=$fila['nombre'];
$apellido_u=$fila['apellido'];
$cedula=$fila['cedula'];
$administrador_u = $fila['administrador'];
$estado_empleado=$fila['estado_empleado'];
$cargo_u=$fila['cargo'];
$area_u=$fila['area'];
$tel_u=$fila['telefono'];
$movil_u=$fila['celular'];
$dir_u=$fila['direccion'];
$pais=$fila['pais'];
$ciudad=$fila['ciudad'];
$municipio_u=$fila['municipio'];
$roles=$fila['id_roles'];
$registro_u=$fila['fecha'];
                                 
 }}else{
$consulta= "select * from usuarios order by id DESC limit 1";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$idus=$fila['id'];
$user_u=$fila['usuario'];
$password_u=$fila['password'];
$descripcion_u=$fila['descripcion'];
$email_u=$fila['email'];
$nombre_u=$fila['nombre'];
$cedula=$fila['cedula'];
$apellido_u=$fila['apellido'];
$administrador_u = $fila['administrador'];
$estado_empleado=$fila['estado_empleado'];
$cargo_u=$fila['cargo'];
$area_u=$fila['area'];
$tel_u=$fila['telefono'];
$movil_u=$fila['celular'];
$dir_u=$fila['direccion'];
$pais=$fila['pais'];
$ciudad=$fila['ciudad'];
$municipio_u=$fila['municipio'];
$roles=$fila['id_roles'];
$registro_u=$fila['fecha'];
 }}

?>
