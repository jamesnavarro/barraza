<?php
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));


    if (isset($_POST["nombre"])&& isset($_POST["codigo"])){
if ($_POST["nombre"] == "" && $_POST["codigo"] == "") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=atenciones"</script>';
}else{
	if (isset($_GET['editar'])){
        $atencion = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $tipo = $_POST["tipo"];
        $precio = $_POST["precio"];
         $sql = "UPDATE `atenciones` SET `valor`='".$precio."',`nombre_atencion`='".$atencion."',`codigo_atencion`='".$codigo."',`tipo`='".$tipo."' WHERE  `id_atencion`='".$_GET['editar']."'";
         mysql_query($sql);
       $status = "ok";
       
       echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=atenciones'";
     
        echo "</script>";
}else{
	$atencion = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $tipo = $_POST["tipo"];
        $fecha = date("Y-m-d");
        
	

	$sql = "INSERT INTO `atenciones`(`nombre_atencion`, `tipo`, `codigo_atencion`, `fecha_registro`,`valor`)";

        $sql.= "VALUES ('".$atencion."','".$tipo."','".$codigo."', '".$fecha."','$precio')";

	mysql_query($sql);

	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=atenciones'";
     
        echo "</script>";
        
}}}

?>
 