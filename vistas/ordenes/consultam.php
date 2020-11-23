<?php
include "../../modelo/conexion.php";
if(isset($_GET['arc'])){
    $query = mysql_query('select * from medicamentos a, medicamentos_asig b where a.codigo_int=b.cod_med and b.id="'.$_GET['cod'].'" ');
}else{
    $query = mysql_query('select * from medicamentos where codigo_int="'.$_GET['cod'].'" ');
}

$ok = mysql_fetch_array($query);
$p = array();
$p[0] = $ok['cant_disponible'];
$p[1] = $ok['nombre_medicamento'];
$p[2] = $ok['codigo_int'];

echo json_encode($p);
exit();