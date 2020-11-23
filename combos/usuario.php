<?php
include "../modelo/conexion.php";
$rpta="";


   $con= "SELECT * FROM usuarios WHERE area='".$_POST["elegido"]."'";
    $res=  mysql_query($con);
   $rpta= $rpta.'<option value="">Seleccione</option>';
    while($f=  mysql_fetch_array($res)){

    $usuario=$f['usuario'];
    $rpta= $rpta.'<option value="'.$usuario.'">'.$usuario.'</option>
        
        ';
    }
 
	
echo $rpta;