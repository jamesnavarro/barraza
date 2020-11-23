<?php
//include('../../modelo/conexion.php');
//
//$query = mysql_query('select * from movimientos  where id_mov="'.$_POST['id'].'" ');
//$f = mysql_fetch_array($query);
$p = array();
$p[0] = $f['id_operaciones'];
$p[1] = $f['id_usuario'];
$p[2] = $f['orden_servicio'];
$p[3] = $f['fecha_reg'];
$p[4] = $f['id_bod'];
$p[5] = $f['grupo'];

echo json_encode($p);
exit();
    $array = array(0 => 'hola',1 => 'james');

    echo json_encode($array);