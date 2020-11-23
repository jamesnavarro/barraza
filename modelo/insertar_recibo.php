<?php
require("conexion.php");
session_start();
$status = "";


date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));


	
	$paciente = $_POST["paciente"];
        $numero = $_POST["numero"];
        $empresa = $_POST["empresa"];
        $valor = $_POST["valor"];
        $descripcion = $_POST["descripcion"];
         $fecha_registro_n = date("Y-m-d").' '.$hora;

	$sql = "INSERT INTO `recibo_caja` (`paciente`, `cedula`, `empresa`, `producto`, `valor`, `fecha_reg`)";
        $sql.= "VALUES ('".$paciente."','".$numero."', '".$empresa."', '".$descripcion."','".$valor."', '".$fecha_registro_n."')";
	mysql_query($sql, $conexion);

	$sql1 = "SELECT MAX(id_recibo) as id FROM recibo_caja";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $id_n = $fila1["id"];

        $status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/mostrar_recibo.php?recibo=".$id_n."'";
     
        echo "</script>";
        
        

?>
 