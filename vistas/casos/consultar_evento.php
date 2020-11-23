<?php
include '../../modelo/conexion.php';


$result = mysql_query("select * from eventos_sub where id_evento='".$_POST['rad']."' ");
$f = mysql_fetch_array($result);

$p = array();
$p[0] = $f[0];
$p[1] = $f[1];
$p[2] = $f[2];
$p[3] = $f[3];
$p[4] = $f[4];
$p[5] = $f[5];
$p[6] = $f[6];
$p[7] = $f[7];
$p[8] = $f[8];
$p[9] = $f[9];
$p[10] = $f[10];
$p[11] = $f[11];
$p[12] = $f[12];
$p[13] = $f[13];
$p[14] = $f[14];
$p[15] = $f[15];


echo json_encode($p);
exit();

