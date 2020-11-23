<?php
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));


    if (isset($_POST["nombre"])&& isset($_POST["codigo"])){
if ($_POST["nombre"] == "" && $_POST["codigo"] == "") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=enfermedades"</script>';
}else{
    if (isset($_GET['editar'])){
	$nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $sex = $_POST["sexo"];
       $limite1 = $_POST["sup"];
        $limite2 = $_POST["inf"];


       $fecha_mod_p = date("Y-m-d").''.$hora.' por '.$_SESSION['k_username'];
     
       
      
       $sql = "UPDATE `enfermedades` SET `descripcion`='".$nombre."',`codigo_enf`='".$codigo."',`sexo`='".$sex."',`lim_inf`='".$limite1."',`lim_sup`='".$limite2."' WHERE `id_enfermedad`='".$_GET['editar']."';";
      
       mysql_query($sql);
       $status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=enfermedades'";
        echo "</script>";
    }else{
	
	$nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $sex = $_POST["sexo"];
        $limite1 = $_POST["sup"];
        $limite2 = $_POST["inf"];
        $fecha_reg = date("Y-m-d").''.$hora; 
	

	$sql = "INSERT INTO `enfermedades`(`codigo_enf`, `descripcion`, `sexo`, `lim_inf`, `lim_sup`, `fecha_reg`)";

        $sql.= "VALUES ('".$codigo."','".$nombre."', '".$sex."', '".$limite1."', '".$limite2."', '".$fecha_reg."')";

	mysql_query($sql);

	$status = "ok";
         echo "<script language='javascript' type='text/javascript'>";
      
        echo "location.href='../vistas/?id=enfermedades'";
      
        echo "</script>";
        
        
}}}
?>
 