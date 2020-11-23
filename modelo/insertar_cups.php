<?php
require("conexion.php");
session_start();
$status = "";
$sql1 = "SELECT MAX(id_nota) as id_inc FROM sis_notas";
$fila1 =mysql_fetch_array(mysql_query($sql1));
if($fila1["id_inc"]==0){
 $id_n = 4000000;   
}else{
$id_n = $fila1["id_inc"]+1;
}
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

if ($_POST["cups"] == "" || $_POST["cant"] == "" || $_POST["descr"] == "") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=autorizacion&autorizar='.$_GET['autorizar'].'"</script>';
}else{
	
	$a = $_POST['cups'];
        $b = $_POST['cant'];
        $c = $_POST['descr'];
      

	$sql = "INSERT INTO `cups`(`codigo`, `cantidad`, `descripcion`, `id_autorizacion`)";

        $sql.= "VALUES ('".$a."','".$b."', '".$c."','".$_GET['add']."')";

	mysql_query($sql);

	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=autorizacion&autorizar=".$_GET['autorizar']."'";
     
        echo "</script>";
        
        
}
?>
 