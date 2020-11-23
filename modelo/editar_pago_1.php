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
         
        $sql10 = "SELECT * FROM facturas where `numero_factura`='".$_GET['editar']."'";
        $fila10 =mysql_fetch_array(mysql_query($sql10));
        $oe = $fila10["orden_ext"];
        $oi = $fila10["orden_int"];
        
       $sql1 = "SELECT * FROM actividad where `orden_externa`='".$oe."'";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $archivo = $fila1["archivo"];
        
        
       $sql = "UPDATE `facturas` SET `pago_pendiente` = '".$asunto_n."' WHERE `numero_factura` ='".$_GET['editar']."'";
       mysql_query($sql, $conexion);
           $sql31 = "UPDATE `actividad` SET `Location`='', `prioridad`='activa' WHERE  `orden_externa`='".$oe."'";
         mysql_query($sql31);
         
         $sql3 = "UPDATE `ordenes` SET `estado_ord`='En proceso', `estado_2`='En proceso', `facturado`='No Facturado' WHERE  `id`='".$archivo."'";
         mysql_query($sql3);
         
       $status = "ok";
       echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=facturacion_finalizada&fact=".$_GET['editar']."&t=".$_GET['t']." '";
        echo "</script>";
    
    ?>