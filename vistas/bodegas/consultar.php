<?php
include('../../modelo/conexion.php');

$query = mysql_query('select * from bodegas  where codigo_bod="'.$_POST['id'].'" ');
$f = mysql_fetch_array($query);
$p = array();
$p[0] = $f['id_bodega'];
$p[1] = $f['codigo_bod'];
$p[2] = $f['bodega'];
$p[3] = $f['estado_bod'];
$p[4] = $f['Observacion'];

echo json_encode($p);
exit();