<?php
require("conexion.php");

session_start();
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i:s a',time() - 3600*date('I'));
if ($_POST["insumo2"] == "" || $_POST["numero"]==""){
    echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=add_detalle_venta&cod='.$_GET["orden"].'"</script>';
}else{
    
        $autorizacion = $_POST["autorizacion"];
        $rel = $_POST["oi"];
        $orden = $_GET["orden"];
        $precio = $_POST["precio"];
        $insumo = $_POST["insumo2"];
	$numero = $_POST["numero"];
        $factura = 'nada';
        $estado = 'Pedido';
        $cont = '1';
        
        $fecha_reg= date("Y-m-d").' '.$hora;
	$sql = "INSERT INTO `equipos_ventas`(`facturado`, `numero_orden_a`, `cod_equipo`, `cantidad`, `precio_a`, `fecha_a`, `fecha_f`, `rel_atencion`, `autorizacion`, `fecha_reg`, `estado_a`, `meses`)";
        $sql.= "VALUES ('".$factura."', '".$orden."', '".$insumo."', '".$numero."', '".$precio."', '".$_GET['fi']."', '".$_GET['ff']."', '".$rel."', '".$autorizacion."', '".$fecha_reg."', '".$estado."', '".$cont."')";
        mysql_query($sql);
        
        $estado2= 'Pedido';
        $sqlr = "UPDATE `ordenes` SET `estado_ord`='".$estado2."' WHERE `id`='".$_GET['orden']."';";
         mysql_query($sqlr);
       
	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
      
        echo "location.href='../vistas/?id=add_detalle_venta&cod=".$_GET["orden"]."'";
      
        echo "</script>";
        
    
}
?>
 