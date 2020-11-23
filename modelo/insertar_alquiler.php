<?php
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));



    if (isset($_POST["nombre"])&& isset($_POST["codigo"])){
if ($_POST["nombre"] == "" && $_POST["codigo"] == "") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=prod_alquiler"</script>';
}else{
    if (isset($_GET['editar'])){
	$nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $forma = $_POST["tipo"];
        $precio = $_POST["precio"];
       $sql = "UPDATE `alquiler` SET `nombre`='".$nombre."',`codigo`='".$codigo."',`tipo`='".$forma."',`precio`='".$precio."' WHERE `id`='".$_GET['editar']."';";
      
       mysql_query($sql);
       $status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=prod_alquiler'";
        echo "</script>";
    }else{
	
	$nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $forma = $_POST["tipo"];
        $sale = $_POST["precio"];
        $fecha_registro_p = date("Y-m-d").''.$hora ;
	

	$sql = "INSERT INTO `alquiler`(`codigo`, `nombre`, `tipo`, `precio`, `fecha`)";

        $sql.= "VALUES ('".$codigo."','".$nombre."', '".$forma."', '".$sale."', '".$fecha_registro_p."')";

	mysql_query($sql);

	$status = "ok";
         echo "<script language='javascript' type='text/javascript'>";
      
        echo "location.href='../vistas/?id=prod_alquiler'";
      
        echo "</script>";
        
    }
}}
?>
 