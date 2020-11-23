<?php
session_start();
include "../modelo/conexion.php";
$status = "";
if (isset($_GET['editar'])){
    
     $consulta= "select * from equipos_asig WHERE `id_equipo_a`='".$_GET['editar']."'";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['precio_a'];
                                                            $orden=$fila['numero_orden_a'];
                                                            
                                                            }
                                                            
        $copagos = $_POST["copagos"];
	$inf = $_POST["inf"];
        $mes = $_POST["mes"] + $_POST["asig_mes"];
        $asig_mes = $_POST["asig_mes"];
        $mes2 = $_POST["mes2"];
        $estado= $_POST["estado"];
         $cantidad= $_POST["cantidad"];
         $autorizacion= $_POST["autorizacion"];
        $fecha_f = date("Y-m-d",strtotime("$mes2 + $asig_mes month"));
        $precio = $valor1 + $_POST["valor"];
        $sql = "UPDATE `equipos_asig` SET `cantidad`='".$cantidad ."',`autorizacion`='".$autorizacion ."',`copagos`='".$copagos ."',`fecha_f`='".$fecha_f ."',`estado_a`='".$estado."',`meses`='".$mes."',`precio_a`='".$precio."', `descripcion_equipo`='".$inf."' WHERE `id_equipo_a`='".$_GET['editar']."';";
         mysql_query($sql);
         
         
         
       $status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=alquiler_prod&codigo=".$_GET['editar']."&arch=".$_GET['arch']."'";
        echo "</script>";
    }
    ?>