<?php
include('../../modelo/conexion.php');
$query = mysql_query('select (max(id)+1) as ultimo from usuarios ');
$f = mysql_fetch_array($query);
echo  $f['ultimo'];
