<?php
require("conexion.php");

session_start();
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i:s a',time() - 3600*date('I'));
if ($_POST["insumo2"] == "" || $_POST["numero"]==""){
    echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=add_detalle_alquiler&cod='.$_GET["orden"].'"</script>';
}else{
       $pac = mysql_query("SELECT b.id_empresa FROM pacientes a, sis_empresa b where a.id_empresa=b.rips and a.id_paciente=".$_GET["pac"]." ");
        $pa =  mysql_fetch_array($pac);
        $id_empresa= $pa["id_empresa"];
     

        $autorizacion = $_POST["autorizacion"];
        $rel = $_POST["oi"];
        $id_paciente =$_GET["pac"];
        $descripcion_alquiler =$_GET["descrip"];
        $orden = $_GET["orden"];
        $precio = $_POST["precio_alq"];
        $insumo = $_POST["insumo2"];
	$numero = $_POST["numero"];
        $factura = 'nada';
        $estado = 'alquilado';
        $cont = '1';
        
        $fecha_reg= date("Y-m-d").' '.$hora;
	$sql = "INSERT INTO `equipos_asig`(`facturado`, `numero_orden_a`, `cod_equipo`, `cantidad`, `precio_a`, `fecha_a`, `fecha_f`, `rel_atencion`, `autorizacion`, `fecha_reg`, `estado_a`, `meses`, `id_paciente`, `descripcion_equipo`)";
        $sql.= "VALUES ('".$factura."', '".$orden."', '".$insumo."', '".$numero."', '".$precio."', '".$_GET['fi']."', '".$_GET['ff']."', '".$rel."', '".$autorizacion."', '".$fecha_reg."', '".$estado."', '".$cont."', '".$id_paciente."', '".$descripcion_alquiler."')";
        mysql_query($sql);
        
        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES ('".$_SESSION['k_username']." Registro el equipo ".$insumo." de la Orden  ".$_GET['orden']." ', '".$_GET['orden']."', '".$_SESSION['k_username']."', 'Archivo General')";
mysql_query($sqlr);

        $estado2= 'En proceso';
        $sqlr = "UPDATE `ordenes` SET `estado_ord`='".$estado2."' WHERE `id`='".$_GET['orden']."';";
         mysql_query($sqlr);
       
	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
      
        echo "location.href='../vistas/?id=add_detalle_alquiler&cod=".$_GET["orden"]." '";
      
        echo "</script>";
        
    
}
?>
 