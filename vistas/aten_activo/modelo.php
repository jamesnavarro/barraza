<?php
include '../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){
    $idp = $_GET['id_p'];
    $bar = $_GET['barrio'];
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $dir = $_GET['dir'];
    mysql_query("update pacientes set barrio='$bar', direccion1='$dir', lat='$lat', lng='$lng' where id_paciente='$idp' ");
    $query = mysql_query("select * from barrios where nombre_barrio like '%".$bar."%' ");
    $b = mysql_fetch_array($query);
    IF($b){
        mysql_query("update barrios set nombre_barrio='$bar' where id_barrio='$b[0]'");
                
    }else{
         $ver=mysql_query("insert into barrios (`departamendo_b`,`municipio_b`,`nombre_barrio`) values ('ATLANTICO','BARRANQUILLA','$bar')") or die(mysql_error());
                
    }
    echo $b['nombre_barrio'];
}


