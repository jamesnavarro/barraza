<?php
$servidorbd = "localhost";
$usuarioBaseDatos = "softmed1_idb";
$claveBaseDatos = "jnavarro0318";
$baseDatos = "softmed1_bkidb";

//
//$servidorbd = "softmediko.com";
//$usuarioBaseDatos = "softmedi_idb";
//$claveBaseDatos = "jnavarro0318";
//$baseDatos = "softmedi_barraza";

$conexion = mysql_connect($servidorbd,$usuarioBaseDatos,$claveBaseDatos);

if (!$conexion)
die('No se Puede Conectar: ' . mysql_error());

mysql_select_db($baseDatos,$conexion);
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
ini_set('max_execution_time', 50000);
?>