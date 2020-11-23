<?php
include "../modelo/conexion.php";
$rpta="";
if ($_POST["car"]!='p') {
  
 $rpta= $rpta.'
            <option value="seleccione">Seleccione</option>
            <option value="1">1. Contributivo</option>
            <option value="2">2. Subsidiado</option>
            <option value="4">4. Particular</option>
            <option value="3">3. Vinculado</option>
            <option value="5">5. Otro</option>
            <option value="7">7. Desplazado con afilacion al regimen contributivo</option>
            <option value="8">8. Desplazado con afilacion al regimen subsidiado</option>
            <option value="9">9. Desplazado no asegurado</option>
            <option value="no_aplica">No Aplica</option>
            ';

  	
}else{
    $rpta= $rpta.'<option value="0">No aplica</option>';
}	
echo $rpta;
?>
       