<?php
include('../../modelo/conexion.php');

$query = mysql_query('select * from operaciones where id_operaciones="'.$_POST['id'].'" ');
$f = mysql_fetch_array($query);
$p = array();
$p[0] = $f['id_operaciones'];
$p[1] = $f['descripcion'];
echo json_encode($p);
exit();