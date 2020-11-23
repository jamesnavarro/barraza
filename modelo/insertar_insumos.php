<?php
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

    if (isset($_POST["nombre"])&& isset($_POST["codigo"])){
if ($_POST["nombre"] == "" && $_POST["codigo"] == "") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=insumos"</script>';
}else{
    if (isset($_GET['editar'])){
	$nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
$precio = $_POST["precio"];

       $fecha_mod_p = date("Y-m-d").''.$hora.' por '.$_SESSION['k_username'];
     
       
      
       $sql = "UPDATE `insumos` SET `nombre_insumo`='".$nombre."',`codigo`='".$codigo."',`precio_ins`='".$precio."',`f_modificacion`='".$fecha_mod_p."' WHERE `id`='".$_GET['editar']."';";
       mysql_query($sql);
       $con= "SELECT * FROM insumos WHERE `id`='".$_GET['editar']."'";
$res=  mysql_query($con);
while($f=  mysql_fetch_array($res)){
$nombre=$f['nombre_insumo'];
$codigo=$f['codigo'];
$precio=$f['precio_ins'];
}
       $status = "ok";
            echo '<script lanquage="javascript">alert("Datos actualizados : '.$nombre.', codigo: '.$codigo.', precio :'.$precio.'");location.href="../vistas/?id=insumos"</script>';

    }else{
	
	$nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $precio = $_POST["precio"];
        $fecha_registro_p = date("Y-m-d").''.$hora.  
       $fecha_mod_p = date("Y-m-d").''.$hora. 
	

	$sql = "INSERT INTO `insumos`(`codigo`, `nombre_insumo`, `precio_ins`, `f_modificacion`, `f_registro`)";

        $sql.= "VALUES ('".$codigo."','".$nombre."','".$precio."', '".$fecha_registro_p."', '".$fecha_mod_p."')";

	mysql_query($sql);

	$status = "ok";
         echo "<script language='javascript' type='text/javascript'>";
      
        echo "location.href='../vistas/?id=insumos'";
      
        echo "</script>";
        
        
    }}}
?>
 