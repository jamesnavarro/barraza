<?php
require("conexion.php");

$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

if (isset($_GET['codigo'])){
    $consulta= "select a.*, b.nombres, b.apellidos from ordenes a, pacientes b WHERE a.id_paciente=b.id_paciente and a.id=".$_GET["codigo"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
    $idorden=$fila['id'];
$orden=$fila['orden'];
$id_pac=$fila['id_paciente'];
$names=$fila['nombres'];
$apells=$fila['apellidos'];
$estadoord=$fila['estado_ord'];
$true='true';
}

}

else{
    if (isset($_POST["paciente"])){
if ($_POST["paciente"] == "") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=add_ventas"</script>';
}else{
	
	
        $codigo = $_POST["paciente"];
        
        $esta = $_POST["estado"];
        $esta2 = $_POST["estado"];
        $fi = $_POST["fi"];
        $ff = $_POST["ff"];
        $llamada = 'Pendiente';
        
        $motivo = 'Esta orden se encuentra en proceso';
        $facturado = 'No Facturado';
        if($_POST["orden"]==''){
            $orden= 'Pendiente';
        }else{
            $orden = $_POST["orden"];
        }
	$sqlv = "SELECT MAX(oi) as oi FROM ordenes";
        $filav =mysql_fetch_array(mysql_query($sqlv));
         $oi = $filav["oi"]+1;


	$sql = "INSERT INTO `ordenes`(`llamada`, `orden`, `oi`, `id_paciente`, `fecha_registro`, `fecha_final`, `estado_ord`, `estado_2`, `motivo`, `facturado`)";

        $sql.= "VALUES ('".$llamada."', '".$orden."', '".$oi."','".$codigo."','".$fi."','".$ff."','".$esta."','".$esta2."','".$motivo."','".$facturado."')";

	mysql_query($sql);

	$status = "ok";
        $sql1 = "SELECT MAX(id) as id FROM ordenes";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idt1 = $fila1["id"];
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=add_detalle_venta&cod=".$idt1."'";
     
        echo "</script>";
        
}}}

?>
 