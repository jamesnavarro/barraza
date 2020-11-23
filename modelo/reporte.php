<?php
session_start();
require("conexion.php");
$status = "";        
if(isset($_GET['editar'])){  
    $sql = "UPDATE `reportes` SET `descripcion`='".$_POST["desc"]."', `solucion`='".$_POST["solu"]."', `estado`='".$_POST["estado"]."', `asignado_r`='".$_SESSION['k_username']."' WHERE `id_reporte` = ".$_GET["editar"].";"; 
    mysql_query($sql, $conexion);     
    echo '<script lanquage="javascript">alert("Se ha Editado la sublinea");location.href="../vistas/?id=ver_orden_interna&ord='.$_POST["orden"].' "</script>'; 
    }else{         
        $sql = "INSERT INTO `reportes` (`id_orden`,`descripcion`, `estado`, `asignado_r`, `asignado_m`, `f_reg`)";  
        $sql.= "VALUES ('".$_POST["orden"]."','".$_POST["desc"]."','".$_POST["estado"]."','".$_SESSION['k_username']."','".$_GET['u']."', '".date("Y-m-d").' '.$hora."')";      
        mysql_query($sql, $conexion);    
        $status = "ok";    
        echo '<script lanquage="javascript">alert("Se ha Guardado exitosamente");location.href="../vistas/?id=ver_orden_interna&ord='.$_POST["orden"].' "</script>';     
        }             ?>	
