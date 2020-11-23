<?php
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));




    if (isset($_POST["equipo"])){
if ($_POST["equipo"] == "" && $_POST["empresa"] == "") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/alquiler_precios.php"</script>';
}else{
    if (isset($_GET['editar'])){
        $atencion = $_POST["equipo"];

        $precio = $_POST["precio"];
        $date = date('d/m/Y').' '.  date('h:m:s');
         $sql = "UPDATE `precios_alquiler` SET `id_alquiler`='".$atencion."',`precio_alquiler`='".$precio."',`fecha_registro_a`='".$date."' WHERE  `id_precio_a`='".$_GET['editar']."'";
         mysql_query($sql);
       $status = "ok";
       
       echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=precios_alquiler&cod=".$_GET['cod']."'";
     
        echo "</script>";
}else{

	
	$atencion = $_POST["equipo"];
  
        $precio = $_POST["precio"];
        $fecha = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `precios_alquiler` (`id_empresa`, `id_alquiler`, `precio_alquiler`, `fecha_registro_a`)";

        $sql.= "VALUES ('".$_GET['cod']."', '".$atencion."', '".$precio."', '".$fecha."')";

	mysql_query($sql, $conexion);
      

	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=precios_alquiler&cod=".$_GET['cod']."'";
        echo "</script>";
}
}}

?>
 