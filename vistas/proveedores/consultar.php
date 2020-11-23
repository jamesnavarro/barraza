<?php
include('../../modelo/conexion.php');

$query = mysql_query('SELECT * FROM proveedors where tipo="proveedor" and nitcc="'.$_POST['id'].'" ');
$f = mysql_fetch_array($query);
$p = array();
$p[0] = $f['nitcc'];
$p[1] = $f['nombre'];
$p[2] = $f['direccion'];
$p[3] = $f['telefono'];
$p[4] = $f['contacto'];
$p[5] = $f['tel_contacto'];
$p[6] = $f['email1'];
$p[7] = $f['email2'];
$p[8] = $f['observaciones'];
$p[9] = $f['depa'];
$p[10] = $f['muni'];
$p[12] = 1;
$p[14] = $f['banco'];
$p[15] = $f['numero_cuenta'];
echo json_encode($p);
exit();