<?php
include "../../modelo/conexion.php";


   $con= "SELECT * FROM `departamentos` where cod_dep='".$_POST["dep"]."' and cod_mun='".$_POST["mun"]."'  limit 1 ";
    $res=  mysql_query($con);
    
    $f=  mysql_fetch_array($res);
    $dep=$f['nombre_dep'];
    $mun=$f['nombre_mun'];
    
    
  	
echo $dep.', '.$mun;


