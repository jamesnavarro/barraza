<?php
session_start();
require("conexion.php");$status = ""; 
$noticia= $_POST["noticia"];   $estado= $_POST["estado"];      
if(isset($_GET['editar'])){  
    $sql = "UPDATE `noticias` SET `noticia`='".$noticia."', `estado`='".$estado."' WHERE `id_noticias` = ".$_GET["editar"].";"; 
    mysql_query($sql, $conexion);     
    echo '<script lanquage="javascript">alert("Se ha Editado la noticia");location.href="../vistas/?id=noticias"</script>'; 
    }else{         
        $sql = "INSERT INTO `noticias` (`noticia`, `estado`)";  
        $sql.= "VALUES ('".$noticia."','".$estado."')";      
        mysql_query($sql, $conexion);    
        $status = "ok";    
        echo '<script lanquage="javascript">alert("Se ha Guardado exitosamente");location.href="../vistas/?id=noticias"</script>';     
        }             ?>	
