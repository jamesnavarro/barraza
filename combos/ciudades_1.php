<?php
include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegidoc"])) {
   $con= "SELECT * FROM `departamentos` where nombre_dep='".$_POST["elegidoc"]."' order by `id`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['cod_mun'];
    $nombre1=$f['nombre_mun'];
    
    
    $rpta= $rpta.'<option value="'.$nombre1.'">'.$nombre1.'</option>';
    }
  	
}	
echo $rpta;
?>