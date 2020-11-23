<?php
include('../../modelo/conexion.php');
$query = mysql_query('select (max(codigo_bod)+1) as ultimo from bodegas ');
$f = mysql_fetch_array($query);
echo  $f['ultimo'];
