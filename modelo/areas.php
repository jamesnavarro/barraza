<?php
session_start();
require("conexion.php");$status = ""; 
$area= $_POST["area"];        
if(isset($_GET['editar'])){  
    $sql = "UPDATE `areas` SET `area`='".$area."' WHERE `id` = ".$_GET["editar"].";"; 
    mysql_query($sql, $conexion);     
    echo '<script lanquage="javascript">alert("Se ha Editado la sublinea");location.href="../vistas/?id=areas"</script>'; 
    }else{         
        $sql = "INSERT INTO `areas` (`area`)";  
        $sql.= "VALUES ('".$area."')";      
        mysql_query($sql, $conexion);    
        $status = "ok";    
        echo '<script lanquage="javascript">alert("Se ha Guardado exitosamente");location.href="../vistas/?id=areas"</script>';     
        }             ?>	
