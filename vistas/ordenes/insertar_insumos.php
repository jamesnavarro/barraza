<?php
require("../../modelo/conexion.php");
require '../../modelo/consultar_paciente.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i:s a',time() - 3600*date('I'));


       
       $s = "SELECT * FROM insumos where codigo=".$_POST["insumo2"]." ";
       $fi =mysql_query($s);
       $p= $fi["precio_ins"];

        $orden = $_GET["cod"];
        $insumo = $_POST["insumo2"];
        $descripcion = '';
	$numero = $_POST["numero"];
        $autorizacion = $_POST["autorizacion"];
        $fecha = date("Y-m-d");
        $factura = 'nada';
        $precio = $p;
        $fecha_reg= date("Y-m-d");
        if(isset($_GET['editar'])){
    $query= "select a.*, b.* from insumos_asignados a, insumos b where a.cod_insumo=b.codigo and a.id_ia=".$_GET['editar']."";                     
    $resultado=  mysql_query($query);
    while($rows=  mysql_fetch_array($resultado)){
    
    $cantidad=$rows['cantidad'];
    $cant_restante=$rows['cant_restante'];
    $cant_usada=$rows['cant_usada'];
    
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
        $sql = "UPDATE `insumos_asignados` SET `cod_insumo` = '".$insumo."', `cantidad` = '".$numero."', `cant_restante` = '".$ctr."', `rel_atencion` = '".$autorizacion."' WHERE `id_ia` = '".$_GET['editar']."'";
        mysql_query($sql, $conexion);

        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
        $sqlr.= "VALUES ('".$_SESSION['k_username']." Modifico el insumo ".$insumo."  ', '".$autorizacion."', '".$_SESSION['k_username']."', 'Atenciones')";
        mysql_query($sqlr);
            }
        }else{
         $query= "select count(*) from insumos_asignados where cod_insumo='".$_POST["insumo2"]."' and rel_atencion='".$_POST["autorizacion"]."'";                     
    $resultado=  mysql_query($query);
    $rows=  mysql_fetch_array($resultado);
    $existe=$rows['count(*)'];
    
    if($existe!=0){
             echo '<script lanquage="javascript">alert("Este insumo ya existe en esta orden interna, si va agregar mas por favor edite la cantidad");location.href="../vistas/?id=add_atenciones&cod='.$_GET["cod"].'"</script>';
    
    }else{
        $mv = mysql_query('select * from movimientos where orden_servicio='.$autorizacion.' ');
        $c = mysql_num_rows($mv);
        if($c==0){
            $sqlm = "INSERT INTO `movimientos` (`id_operaciones`,`id_usuario`, `orden_servicio`, `fecha_mov`, `id_bod`) ";
            $sqlm.= "VALUES ('2', '".$_SESSION['id_user']."', '".$autorizacion."', '".$fecha_reg."', '1')";
            mysql_query($sqlm);
    
        }else{
            $ma = mysql_fetch_array($mv);
            $id_mov = $ma['id_mov'];
        }
        $sqlmi = "INSERT INTO `movimientos_items` (`id_mov`,`codigo`, `cant`) ";
        $sqlmi.= "VALUES ('$id_mov', '".$insumo."', '".$numero."')";
        mysql_query($sqlmi);
        
	$sql = "INSERT INTO `insumos_asignados`(`facturado`,`numero_orden`, `cod_insumo`, `cantidad`, `cant_restante`, `sub_precio`, `fecha_asignacion`, `rel_atencion`,  `inf_adicional`, `fecha_registro`, `autorizacion`, `asignado_a`)";
        $sql.= "VALUES ('".$factura."','".$orden."', '".$insumo."', '".$numero."', '".$numero."', '".$precio."', '".$fecha."', '".$autorizacion."', '".$descripcion."', '".$fecha_reg."', '".$id_emp."', '".$user."')";
        mysql_query($sql);
        
        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
        $sqlr.= "VALUES ('".$_SESSION['k_username']." Registro el insumo ".$_POST["insumo2"]."  ', '".$_POST["autorizacion"]."', '".$_SESSION['k_username']."', 'Atenciones')";
        mysql_query($sqlr);
        }
	}

    
    

?>
 