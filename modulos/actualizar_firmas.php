<?php
include "../modelo/conexion.php";
session_start();

        $sql = "UPDATE `actividad` SET `firms`='1'  WHERE `orden_servicio`='".$_POST["oi"]."';";
        mysql_query($sql) or die(mysql_error());
        
        echo '<b style="color:red;">Se ha actualizado la firma con exito, no se olvide de subir el archivo.</b>';
