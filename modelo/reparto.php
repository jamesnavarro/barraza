<?php

session_start();
require("conexion.php");
$status = "";

            $u_1= $_POST["1"];
            $u_2= $_POST["2"];
            $u_3= $_POST["3"];
            $u_4= $_POST["4"];
            $u_5= $_POST["5"];
           
            

        if(isset($_GET['editar'])){
            
                $sql = "UPDATE `detalle_despacho` SET `destino_cliente` = '".$u_1."', `nombre_cliente` = '".$u_2."', `factura_cliente` = '".$u_3."', `cantidad` = '".$u_4."', `direccion_cliente` = '".$u_5."' WHERE `id_det_despacho` =  ".$_GET["editar"].";";
  
             mysql_query($sql, $conexion);
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente el usuario");location.href="../vistas/?id=remesas&cod='.$_GET['cod'].'"</script>'; 
        }else{



            $sql = "INSERT INTO `detalle_despacho` (`destino_cliente`, `nombre_cliente`, `factura_cliente`, `cantidad`, `direccion_cliente`, `id_remesa`)";
            $sql.= "VALUES ('".$u_1."', '".$u_2."', '".$u_3."', '".$u_4."', '".$u_5."', '".$_GET['cod']."');";
            mysql_query($sql, $conexion);

            $status = "ok";


            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el detalle del reparto");location.href="../vistas/?id=remesas&cod='.$_GET['cod'].'"</script>'; 
        }

        
     


?>



	
      
       
    
  
