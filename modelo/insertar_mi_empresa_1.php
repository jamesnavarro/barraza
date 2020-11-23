<?php
session_start();
require("conexion.php");
$status = "";

            $res= $_POST["resolucion"];

           
        if(isset($_GET['co'])){

                $sql = "UPDATE `rangos_facturas` SET `resolucion`='".$res."' WHERE `id_rango` = ".$_GET["co"].";";
                 mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=mi_empresa"</script>'; 

        }else{


            $sql = "INSERT INTO `rangos_facturas` (`resolucion`)";
            $sql.= "VALUES ('".$res."')";
            mysql_query($sql, $conexion);

            $status = "ok";

    echo '<script lanquage="javascript">alert("Se ha guardado Satisfactoriamente");location.href="../vistas/?id=mi_empresa"</script>'; 

        }