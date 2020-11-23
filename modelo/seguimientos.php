<?php 
session_start();
require("conexion.php");
$status = "";

        if(isset($_GET['editar'])){           
                $sql = "UPDATE `seguimientos` SET `descripcion` = '".$_POST["desc"]."' WHERE `id`= ".$_GET["editar"]." ;";               
                mysql_query($sql, $conexion);
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente el seguimiento");location.href="../vistas/?id=ver_incidencias&cod='.$_GET["cod"].'"</script>'; 
        }else{
        $sql = "INSERT INTO `seguimientos` (`user`,`id_incidencia`,`descripcion`, `registrado_por`)";
        $sql.= "VALUES ('".$_POST["asignado"]."', '".$_GET["cod"]."','".$_POST["desc"]."', '".$_SESSION['k_username']."')";
	mysql_query($sql, $conexion);
            $status = "ok";
            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el seguimiento");location.href="../vistas/?id=ver_incidencias&cod='.$_GET["cod"].'"</script>'; 

        }
                    
        
        
        
        