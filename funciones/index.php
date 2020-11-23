<?php


if(isset($_SESSION['k_username'])){
include '../vistas/mostrar_todo.php';
}else{header("location:../index.php");}
?>
