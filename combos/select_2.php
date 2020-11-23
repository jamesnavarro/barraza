<?php
include "../modelo/conexion.php";
$rpta="";
if ($_POST["car2"]!='p') {
  
 $rpta= $rpta.'
           <option value="seleccione">Seleccione</option>
           <option value="Cotizante">Cotizante</option>
           <option value="Beneficiario">Beneficiario</option>
           <option value="no_aplica">No Aplica</option>
           ';

  	
}else{
    $rpta= $rpta.'<option value="0">No aplica</option>';
}	
echo $rpta;
?>
       