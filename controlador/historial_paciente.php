<?php

include "../modelo/conexion.php";

    $consulta= "select * from ordenes WHERE  id=".$_GET["codigo"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
     
        $id_paciente=$fila['id_paciente'];
}

$consulta2= "select * from historialclinico WHERE  id_paciente=".$id_paciente."";
$result2=  mysql_query($consulta2);
while($fila2=  mysql_fetch_array($result2)){
     
        $id=$fila2['id_historia'];
}
if(isset($id)){
 
      echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=add_atenciones&cod=".$_GET['codigo']."'";
     
        echo "</script>";
}else{
    $xo=$_GET['codigo'];
  
    echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=historial_clinico&codigo=".$_GET['codigo']."'";
     
        echo "</script>";
    
}
?>
