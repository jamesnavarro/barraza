<?php
session_start();
date_default_timezone_set("America/Bogota" ) ; 
        $hora = date('h:i a',time() - 3600*date('I'));
include 'modelo/conexion.php';
$sql = "UPDATE `usuarios` SET `online` = '0', ingreso='".date("Y-m-d").' '.$hora."' WHERE `id` = ".$_SESSION["id_user"].";";
    mysql_query($sql, $conexion);
if(!isset($_SESSION['k_username'])){

header("location:index.php");
} else {

session_unset();
session_destroy();
header("location:index.php");
}
?>