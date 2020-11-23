<?php
include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegido"])) {
   $con= "SELECT * FROM enfermedades where codigo_enf='".$_POST["elegido"]."' ";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['descripcion'];
    $nombre1=$f['descripcion'];
    
    
    $rpta= $rpta.'<textarea name="descripcion_enf"  style="width:90%;" rows="8">'.$nombre1.'</textarea>';
    }
  	
}	
echo $rpta;
?>