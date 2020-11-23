<?php 
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I')); 
//print "&nbsp;$hora&nbsp;"; 
?>
<?php
session_start();
include "../modelo/conexion.php";
$status = "";

        

        $asunto_n = 'Si';
         
       
      
       $sql = "UPDATE `facturas` SET `pago_pendiente` = '".$asunto_n."' WHERE `numero_factura` ='".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=facturacion_2&fact=".$_GET['editar']."'";
        echo "</script>";
    
    ?>