<?php
session_start();
include "../modelo/conexion.php";
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I')); 
if (isset($_POST["nombre_emp"])) {
$id_emp=  $_GET['editar']; 
$nombre=$_POST["nombre_emp"];
$web=$_POST["web"];
$siglas=$_POST["simbolo"];
$prop=$_POST["propietario"];
$ni=$_POST["nit"];
$facti=$_POST["fact1"];
$factf=$_POST["fact2"];
$te1=$_POST["telefono_emp"];
$fax1=$_POST["fax_emp"];
$cel_emp=$_POST["celular_emp"];
$depa=$_POST["departamento_emp"];
$munici=$_POST["municipio_emp"];
$dire1=$_POST["direccion_emp"];
$emai1=$_POST["email_emp1"];
$info=$_POST["inf_emp"];
     
       
      
        $sql = "UPDATE `inf_empresa` SET `nombre`='".$nombre."',`web_emp`='".$web."',`siglas`='".$siglas."',`gerente`='".$prop."',`nit_emp`='".$ni."',`telefono_1`='".$te1."',`telefono_2`='".$fax1."',`telefono_3`='".$cel_emp."',`dapartamento`='".$depa."',`municipio`='".$munici."',`direccion`='".$dire1."',`email`='".$emai1."',`factura_inicial`='".$facti."',`factura_final`='".$factf."',`inf`='".$info."' WHERE `id_emp` = '".$_GET['editar']."';";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=mi_empresa'";
        echo "</script>";
    }
    ?>