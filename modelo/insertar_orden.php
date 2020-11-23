<?php
require("conexion.php");

$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

if (isset($_GET['cod'])){
    $consulta= "select a.*, b.nombres, b.apellidos from ordenes a, pacientes b WHERE a.id_paciente=b.id_paciente and a.id=".$_GET["cod"]."";
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
 

	if (isset($_POST["orden"])){$orden = $_POST["orden"];}else{$orden='';}
	
        $codigo = $_POST["paciente"];
        $fecha = date("Y-m-d").' '.$hora;
        $esta = $_POST["estado"];
        $esta2 = $_POST["estado"];
        $motivo = 'Esta orden se encuentra en proceso';
        $facturado = 'No Facturado';
        
	

	$sql = "INSERT INTO `ordenes`(`orden`, `id_paciente`, `fecha_registro`, `estado_ord`, `estado_2`, `motivo`, `facturado`)";

        $sql.= "VALUES ('".$orden."','".$codigo."','".$fecha."','".$esta."','".$esta2."','".$motivo."','".$facturado."')";

	mysql_query($sql);

	$status = "ok";
        $sql1 = "SELECT MAX(id) as id FROM ordenes";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idt1 = $fila1["id"];
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=historial_paciente&codigo=".$idt1."'";
     
        echo "</script>";
        
}

?>
 