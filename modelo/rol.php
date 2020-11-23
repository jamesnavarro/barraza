<?php
session_start();
require("conexion.php");
$status = ""; 
$p1= $_POST["rol"];  
$p2= $_POST["descr"];
if(isset($_GET['editar'])){  
    $sql = "UPDATE `roles` SET `nombre`='".$p1."',`descripcion`='".$p2."', modificado_por='".$_SESSION['k_username']."' WHERE `id_roles` = ".$_GET["editar"].";";        
    mysql_query($sql, $conexion);    
    echo '<script lanquage="javascript">alert("Se ha Editado el rol");location.href="../vistas/?id=rol"</script>'; 
    }else{       
        $sql = "INSERT INTO `roles` (`nombre`, `descripcion`, `creado_por`, `modificado_por`, `fecha_registro`)";      
        $sql.= "VALUES ('".$p1."','".$p2."','".$_SESSION['k_username']."','".$_SESSION['k_username']."', '".date("Y-m-d H:i:s")."')";     
        mysql_query($sql, $conexion);  
        $status = "ok";       
        echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=rol"</script>'; 
        }             ?>

	                   