<?php

session_start();
require("conexion.php");
$status = "";

            $cliente= $_POST["cliente"];
            $placa = $_POST["placa"];
            $destino= $_POST["destino"];
            $flete= $_POST["flete"];
            $valor_ad= $_POST["valor_ad"];
            $tipo_ad= $_POST["tipo_ad"];
            $cobra= $_POST["cobra"];
            $pago= $_POST["pago"];
            $adicional= $_POST["adicional"];
            $in= $_POST["in"];
            $out= $_POST["out"];
            $guia= $_POST["guia"];
            $obs= $_POST["obs"];
            $user = $_SESSION["k_username"];
        if(isset($_GET['editar'])){
           
                $sql = "UPDATE `remesa` SET `id_cliente` = '".$cliente."', `id_vehiculo` = '".$placa."', `destino` = '".$destino."', `v_flete` = '".$flete."', `v_anticipo` = '".$valor_ad."', `tipo_ad` = '".$tipo_ad."', `cobrado` = '".$cobra."', `pagado` = '".$pago."', `nota` = '".$adicional."', `fecha_i` = '".$in."', `fecha_f` = '".$out."', `guia` = '".$guia."', `observacion` = '".$obs."', `user` = '".$user."' WHERE `id_remesa` = ".$_GET["editar"].";";
           
             mysql_query($sql, $conexion);
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la Remesa '.$_GET['editar'].'");location.href="../vistas/?id=lista"</script>'; 
        }else{
            $sql = "INSERT INTO `remesa` (`id_cliente`, `id_vehiculo`, `destino`, `v_flete`, `v_anticipo`, `tipo_ad`, `cobrado`, `pagado`, `nota`, `fecha_i`, `fecha_f`, `guia`, `observacion`, `user`)";
            $sql.= "VALUES ('".$cliente."', '".$placa."', '".$destino."',  '".$flete."', '".$valor_ad."', '".$tipo_ad."', '".$cobra."', '".$pago."', '".$adicional."', '".$in."', '".$out."', '".$guia."', '".$obs."', '".$user."')";
            mysql_query($sql, $conexion);

            $status = "ok";
            $sql21 = "SELECT max(id_remesa) FROM remesa";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $max= $fila21["max(id_remesa)"];

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente la Remesa");location.href="../vistas/?id=remesas&cod='.$max.'"</script>'; 
        }

        
     


?>



	
      
       
    
  
