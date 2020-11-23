<?php
include "../../modelo/conexion.php";
$ord = $_POST['ord'];
$result =  mysql_query("select count(*) FROM ordenes WHERE orden='$ord'");
$m = mysql_fetch_row($result);
echo $m[0];


