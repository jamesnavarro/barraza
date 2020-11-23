<?php
include "../../modelo/conexion.php";
$query = mysql_query('select count(*), orden_servicio from actividad where orden_externa="'.$_GET['oe'].'" and archivo!="'.$_GET['archivo'].'" ');
$ok = mysql_fetch_array($query);
echo $ok['orden_servicio'];

