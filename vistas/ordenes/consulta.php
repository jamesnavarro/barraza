<?php
include "../../modelo/conexion.php";
if(isset($_GET['arc'])){
    $query = mysql_query('select * from insumos a, insumos_asignados b where a.codigo=b.cod_insumo and b.id_ia="'.$_GET['cod'].'" ');
}else{
    $query = mysql_query('select * from insumos where codigo="'.$_GET['cod'].'" ');
}

$ok = mysql_fetch_array($query);
$p = array();
$p[0] = $ok['cant_disponible'];
$p[1] = $ok['nombre_insumo'];
$p[2] = $ok['codigo'];

echo json_encode($p);
exit();