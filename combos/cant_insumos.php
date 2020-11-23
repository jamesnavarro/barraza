<?php
session_start();

include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegido"])) {

    $con= 'SELECT * FROM insumos_asignados  where id_ia="'.$_POST['elegido'].'"';
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){

    $nombre1=$f['cant_restante'];
    
    
    $rpta= $nombre1;
    }
  	
}

	
echo $rpta;
?>