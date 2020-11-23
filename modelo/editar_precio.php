<?php 
ini_set('max_execution_time', 9000);
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I')); 
//print "&nbsp;$hora&nbsp;"; 
?>
<?php
session_start();
include "../modelo/conexion.php";
$status = "";
$n = $_POST["cant"];
        $c = 0;
        for($x=1; $x<=$n; $x=$x+1){
         
  if ($_POST["tipo$x"]=='atencion') {
       $precio =$_POST["precio$x"];
       $cop =$_POST["preciocop$x"];
        $anexo = $_POST["anexo$x"];
        $ate = $_POST["ate$x"];
        
        $consulta3= "select * from actividad where `Id` = '".$_POST["id$x"]."'";
         $result3=  mysql_query($consulta3);
            while($fila=  mysql_fetch_array($result3)){ 
            $os=$fila['orden_servicio'];
            }
        
       $sql = "UPDATE `actividad` SET `cod_aten` = '".$ate."', `precio_total` = '".$precio."', `cuota_pagada` = '".$cop."', `anexo` = '".$anexo."' WHERE orden_servicio = '".$os."'";
       mysql_query($sql, $conexion);
          

  }
  //20528850
if ($_POST["tipo$x"]=='alquiler') {
 $precio =$_POST["precio$x"];
        $anexo = $_POST["anexo$x"];
       $sql = "UPDATE `equipos_asig` SET `precio_a` = '".$precio."', `inf` = '".$anexo."' WHERE `id_equipo_a` = '".$_POST["id$x"]."'";
       mysql_query($sql, $conexion);
       
}
  
if ($_POST["tipo$x"]=='insumo') {
 $precio =$_POST["precio$x"];
        $anexo = $_POST["anexo$x"];
       $sql = "UPDATE `insumos_asignados` SET `sub_precio` = '".$precio."', `inf_adicional` = '".$anexo."' WHERE `id_ia` = '".$_POST["id$x"]."'";
       mysql_query($sql, $conexion);
       
        }
  
if ($_POST["tipo$x"]=='medicina') {
 $precio =$_POST["precio$x"];
        $anexo = $_POST["anexo$x"];
       $sql = "UPDATE `medicamentos_asig` SET `sub_precio_m` = '".$precio."', `info` = '".$anexo."' WHERE `id` = '".$_POST["id$x"]."'";
       mysql_query($sql, $conexion);
       
   }
        }

        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=facturacion_autorizacion&factura=".$_GET['factura']."&t=FAC'";
        echo "</script>";
    
    