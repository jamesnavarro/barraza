<?php

include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
require '../modelo/consulta_contacto_potencial.php';
    $consulta= "select * from autorizacion WHERE  numero_orden=".$_GET["autorizar"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
     
$id_orden = $fila['numero_orden'];
}
    $consulta2= "select * from ordenes WHERE  id=".$_GET["autorizar"]."";
$result2=  mysql_query($consulta2);
while($fila2=  mysql_fetch_array($result2)){
     
$idpaci = $fila2['id_paciente'];
}
   if(isset($id_orden)){     
        if($id_orden == $_GET["autorizar"]){
                        require '../vistas/mostrar_autorizacion.php';
                        
                        }else{
                            require '../vistas/Autorizacion.php'; 
                        }}else{
                            require '../vistas/Autorizacion.php'; 
                        }
?>
