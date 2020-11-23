<?php
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));



    if (isset($_POST["atencion"])){
if ($_POST["atencion"] == "") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/atenciones_precios.php"</script>';
}else{
    if (isset($_GET['editar'])){
        $atencion = $_POST["atencion"];
     
        $precio = $_POST["precio"];
        $date = date('d/m/Y').' '.  date('h:m:s');
         $sql = "UPDATE `precios_atenciones` SET `id_atencion`='".$atencion."',`id_empresa`='".$_GET['cod']."',`precio`='".$precio."',`fecha_registro_pr`='".$date."' WHERE  `id_precio`='".$_GET['editar']."'";
         mysql_query($sql);
       $status = "ok";
       
       echo "<script language='javascript' type='text/javascript'>";
       echo "location.href='../vistas/?id=precios_atenciones&cod=".$_GET['cod']."'";
     
        echo "</script>";
}else{
	
	$atencion = $_POST["atencion"];
   
        $precio = $_POST["precio"];
        $fecha = date("Y-m-d").' '.$hora;
        
	

	$sql = "INSERT INTO `precios_atenciones` (`id_atencion`, `id_empresa`, `precio`, `fecha_registro_pr`)";

        $sql.= "VALUES ('".$atencion."', '".$_GET['cod']."', '".$precio."', '".$fecha."')";

	mysql_query($sql, $conexion);
      

	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=precios_atenciones&cod=".$_GET['cod']."'";
        echo "</script>";
        
    }}}

?>
 