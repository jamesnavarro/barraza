<?php
session_start();
require("conexion.php");
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$status = "";

            $producto= strtoupper($_POST["producto"]);
            $tipo_p = strtoupper($_POST["linea"]);
            $codigo= $_POST["codigo"];
            $referencia= $_POST["referencia"];
            $costo= $_POST["costo"];
            $fecha_mod_opo = date('Y-m-d');
            
            
            
        if(isset($_GET['editar'])){
                

                $sql = "UPDATE `productos` SET  `codigo_interno`='".$referencia."', `nombre`='".$producto."',`tipo`='".$tipo_p."',`codigo`='".$codigo."', `f_registro`='".$fecha_mod_opo.' '.$hora."', `precio`='".$costo."' WHERE `id` = ".$_GET["editar"].";";
                 mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion del producto '.$_POST["producto"].'");location.href="../vistas/?id=ver_productos&cod='.$_GET['editar'].'"</script>'; 

        }else{


            $sql = "INSERT INTO `productos` ( `codigo_interno`,  `nombre`, `tipo`, `codigo`, `f_registro`,`precio`)";
            $sql.= "VALUES ( '".$referencia."',  '".$producto."', '".$tipo_p."', '".$codigo."', '".$fecha_mod_opo.' '.$hora."', '".$costo."')";
            mysql_query($sql, $conexion);

            $status = "ok";

            $sql21 = "SELECT max(id) FROM productos";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $max= $fila21["max(id)"];

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el producto ");location.href="../vistas/?id=ver_productos&cod='.$max.'"</script>'; 

        }
                   