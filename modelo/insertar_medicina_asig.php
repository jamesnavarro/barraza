<?php
require("conexion.php");

session_start();
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i:s a',time() - 3600*date('I'));

       $consulta= "select * from actividad where archivo='".$_GET["cod"]."' and orden_servicio='".$_POST["autorizacion"]."' limit 1";
       $result=  mysql_query($consulta);
       while($fila=  mysql_fetch_array($result)){
       $id_emp=$fila['orden_externa'];
       $user=$fila['user'];
       }
       
       $s = "SELECT * FROM medicamentos where codigo=".$_POST["medi"]." ";
$fi =  mysql_query($s);
$p= $fi["precio_med"];
     
        $orden = $_GET["cod"];
        $precio = $p;
        $insumo = $_POST["medi"];
        $descripcion = '';
	$numero = $_POST["numero"];
        $fecha = date("Y-m-d");
        $autorizacion = $_POST["autorizacion"];
        $factura = 'nada';
        $fecha_reg= date("Y-m-d");
            if(isset($_GET['editar'])){
    $query= "select * from medicamentos_asig  where id=".$_GET['editar']."";                     
    $resultado=  mysql_query($query);
    while($rows=  mysql_fetch_array($resultado)){
    
    $cantidad=$rows['cantidad'];
    $cant_restante=$rows['cantidad_rest'];
    $cant_usada=$rows['cantidad_usada'];
    
    } 
    if($numero<$cant_usada){
         echo '<script lanquage="javascript">alert("La cantidad digitada es menor a la cantidad usada");location.href="../vistas/?id=add_atenciones&cod='.$_GET["cod"].'"</script>';
    }else{
    if($numero>$cantidad){
        $ct = $numero - $cantidad;
        $ctr = $ct + $cant_restante;
    }else{
        $ct = $cantidad - $numero;
        $ctr = $cant_restante - $ct;
    }
            $sql = "UPDATE `medicamentos_asig` SET `cantidad` = '".$numero."', `cantidad_rest` = '".$ctr."', `rel_atencion` = '".$autorizacion."' WHERE `id` = '".$_GET['editar']."'";
            mysql_query($sql, $conexion);
                 $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES ('".$_SESSION['k_username']." Modifico el Medicamento ".$insumo."  ', '".$autorizacion."', '".$_SESSION['k_username']."', 'Atenciones')";
mysql_query($sqlr);
            }
        }else{
              $query= "select count(*) from medicamentos_asig where cod_med='".$_POST["medi"]."' and rel_atencion='".$_POST["autorizacion"]."'";                     
    $resultado=  mysql_query($query);
    while($rows=  mysql_fetch_array($resultado)){
    $existe=$rows['count(*)'];
    } 
    if($existe!=0){
             echo '<script lanquage="javascript">alert("Este medicamento ya existe en esta orden interna, si va agregar mas por favor edite la cantidad");location.href="../vistas/?id=add_atenciones&cod='.$_GET["cod"].'"</script>';
    
    }else{
	$sql = "INSERT INTO `medicamentos_asig`(`facturado`,`numero_orden`, `cod_med`, `cantidad`, `cantidad_rest`, `sub_precio_m`, `fecha_asig`, `rel_atencion`, `info`, `fecha_registro`, `autorizacion`, `asignado_a`)";
        $sql.= "VALUES ('".$factura."','".$orden."', '".$insumo."', '".$numero."', '".$numero."', '".$precio."', '".$fecha."', '".$autorizacion."', '".$descripcion."', '".$fecha_reg."', '".$id_emp."', '".$user."')";
	mysql_query($sql, $conexion);
        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES ('".$_SESSION['k_username']." Registro el Medicamento ".$insumo."  ', '".$autorizacion."', '".$_SESSION['k_username']."', 'Atenciones')";
mysql_query($sqlr);
        }

        
    }
        echo "<script language='javascript' type='text/javascript'>";
      
        echo "location.href='../vistas/?id=add_atenciones&cod=".$orden."'";
      
        echo "</script>";

?>
 