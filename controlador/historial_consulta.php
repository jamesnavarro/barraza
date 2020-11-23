<?php
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
require '../modelo/consultar_paciente.php';
    $consulta= "select * from motivo_consulta WHERE  id_paciente=".$_GET["pac"]." group by id_paciente";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$motivo2 = $fila['hallazgos'];
$id_orden = $fila['id_orden'];
}
$consulta2= "select * from ordenes WHERE  id=".$_GET["cod"]."";
$result2=  mysql_query($consulta2);
$fila2=  mysql_fetch_array($result2);  
$idpaci = $fila2['id_paciente'];

   if(isset($motivo2)){     
        if($motivo2 != ''){
                        require '../vistas/mostrar_historial_1.php';
                        
                        }else{
                            require '../vistas/historial_clinico_1.php'; 
                        }}else{
                            require '../vistas/historial_clinico_1.php'; 
                        }
?>
