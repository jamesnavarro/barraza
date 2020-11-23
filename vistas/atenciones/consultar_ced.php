<?php
include('../../modelo/conexion.php');

$query = mysql_query('select * from empleados where cedula="'.$_POST['id'].'" ');
$f = mysql_fetch_array($query);
$p = array();
$p[0] = $f['id_emp'];
$p[1] = $f['nombres_emp'];
$p[2] = $f['apellidos_emp'];
echo json_encode($p);
exit();