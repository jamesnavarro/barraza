<?php
session_start();require("conexion.php");$status = ""; 
$area= $_POST["sub"];             
if(isset($_GET['editar'])){   
    $sql = "UPDATE `cargos` SET `nombre_cargo`='".$area."' WHERE `id_cargo` = ".$_GET["editar"].";";
    mysql_query($sql, $conexion);      
    echo '<script lanquage="javascript">alert("Se ha Editado la sublinea");location.href="../vistas/?id=areas"</script>';   
    }else{      
        $sql = "INSERT INTO `cargos` (`nombre_cargo`)";   
        $sql.= "VALUES ('".$area."')";       
        mysql_query($sql, $conexion);     
        $status = "ok";            
        echo '<script lanquage="javascript">alert("Se ha Guardado exitosamente");location.href="../vistas/?id=areas"</script>';     
        }           
        ?>
	                   