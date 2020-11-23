<?php
session_start();

include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegido"])) {

    $con= 'SELECT * FROM medicamentos_asig  where id="'.$_POST['elegido'].'"';
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){

    $nombre1=$f['cantidad_rest'];
    
    
    $rpta= $nombre1;
    }
  	
}

	
echo $rpta;
?>