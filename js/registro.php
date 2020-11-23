<?php
 
//Configuracion de la conexion a base de datos
  $bd_host = "localhost"; 
  $bd_usuario = "root"; 
  $bd_password = ""; 
  $bd_base = "templados"; 
 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 
 
//variables POST
  $id=$_POST['id'];
  $valor=$_POST['valor'];

 
//registra los datos del empleados
  $sql="UPDATE `referencias` SET `costo_mt`='".$valor."' WHERE `id_referencia` = ".$id.";";
mysql_query($sql,$con) or die('Error. '.mysql_error());
 

?>
