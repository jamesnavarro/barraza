<?php
require("conexion.php");
session_start();
$status = "";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if ($_POST["numero"] == ""||$_POST["name"]==""||$_POST["usuario"]=="") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=add_atenciones&cod='.$_POST["archivo"].'"</script>';
}else{
	
        if(isset($_GET["edit"])){
                    $n = $_POST["numero"];
                    $urg = $_POST["urg"];
        
        $fecha_inicial = $_POST["fecha_inicial"];
        $fecha_fin = $_POST["fecha_final"];
        $orden = $_POST["orden"];
        $u = $orden.''.$_POST["atencion2"];
        $descripcion = $_POST["descripcion"];
        $estado = 'No iniciada';   
        $idpacientes = $_POST["paciente"];
        $vdias = $_POST["vdias"];
        $fecha_r = date("Y/m/d");
        $fecha_m = '';
	$tarea = "Visita";
        $archivo = $_POST["archivo"];
        $inf = $_POST["atencion2"];
        $orden_ext = $_POST["orden_ext"];
        $usuario = $_POST["usuario"];
        $total = $_POST["precioss"];
        $obs= $_POST["obs"];   $dias= $_POST["dias"];
        $prucov= $_POST["prucov"];
        $fecpru= $_POST["fecpru"];
        $respru= $_POST["respru"];
        $color='6';
        $es ='activa';
        $mo ='esta orden se encuentra';
        $priorida ='activa';
        $por = 100 / $n;
        $porcentaje = $por;
        
        $sqla = "SELECT count(*) FROM actividad where orden_servicio='".$_POST["orden"]."'";
        $filaa =mysql_fetch_array(mysql_query($sqla));
        $cant = $filaa["count(*)"];
       
        
         if($_POST["numero"]==$cant){
             $sqlu = "UPDATE `actividad` SET  `vdias`='".$vdias."',`urgente`='".$urg."', `cada`='".$dias."', `obs`='".$obs."', `cod_aten`='".$inf."', `Description`='".$descripcion."',`cant`='".$_POST["numero"]."',`StartTime`='".$fecha_inicial."',`EndTime`='".$fecha_fin."',`user`='".$usuario."',`orden_externa`='".$orden_ext."',`prueba`='".$prucov."',`fechaprueba`='".$fecpru."',`resultado`='".$respru."'  WHERE  `orden_servicio`='".$_POST["orden"]."'";
             mysql_query($sqlu);
                 $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES ('Orden $orden ,  Modificada por ".$_SESSION['k_username']."  ', '".$_GET['edit']."', '".$_SESSION['k_username']."', 'Atenciones')";
mysql_query($sqlr);
         }else{
        if($_POST["numero"]>$cant){
            $ct = $_POST["numero"] - $cant;
            for($x=1; $x<=$ct; $x=$x+1){
                $sqla = "SELECT max(Id), max(cant_ins) FROM actividad where orden_servicio='".$_POST["orden"]."'";
                $filaa =mysql_fetch_array(mysql_query($sqla));
                $maxid = $filaa["max(Id)"];
                $canti = $filaa["max(cant_ins)"]+ 1;
                $c = $cant + $x;
                $porcentaje = $por;
                $asunto_t='Visita # '.$c.' a '.$_POST["name"];
                include "../modelo/conexion.php";
                $sql = "INSERT INTO `actividad`(`urgente`,`cada`, `prioridad`, `Subject`, `StartTime`, `EndTime`, `tarea`, `Description`, `color`, `estado`, `fecha_reg_ta`, `fecha_mod_ta`, `id_paciente`, `porcentaje`, `orden_servicio`, `precio_total`, `cod_aten`, `cant`, `cant_ins`, `id_empresa`, `user`, `orden_externa`, `archivo`, `est_motivo`, `desc_motivo`, `prueba`, `fechaprueba`, `resultado`)";
                $sql.= "VALUES ('".$urg."','".$dias."','".$priorida."','".$asunto_t."', '".$fecha_inicial."', '".$fecha_fin."', '".$tarea."', '".$descripcion."', '".$color."', '".$estado."', '".$fecha_r."', '".$fecha_m."', '".$idpacientes."', '".$porcentaje."', '".$orden."', '".$total."', '".$inf."', '".$n."', '".$canti."', '".$u."', '".$usuario."', '".$orden_ext."', '".$archivo."', '".$es."', '".$mo."', '".$prucov."', '".$fecpru."', '".$respru."')";
                mysql_query($sql);
                
                $sqlu = "UPDATE `actividad` SET `vdias`='".$vdias."',`cada`='".$dias."',`cod_aten`='".$inf."', `Description`='".$descripcion."', `porcentaje`='".$porcentaje."',`cant`='".$_POST["numero"]."',`StartTime`='".$fecha_inicial."',`EndTime`='".$fecha_fin."',`user`='".$usuario."',`orden_externa`='".$orden_ext."' WHERE  `orden_servicio`='".$_POST["orden"]."'";
                mysql_query($sqlu);
            }
            $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES ('Orden $orden ,Fue Modificada la cantidad por ".$_SESSION['k_username']."  ', '".$_GET['edit']."', '".$_SESSION['k_username']."', 'Atenciones')";
mysql_query($sqlr);
        }else{
            $ct =  $cant - $_POST["numero"];
           
            for($x=1; $x<=$ct; $x=$x+1){
                $sqla = "SELECT max(Id) FROM actividad where orden_servicio='".$_POST["orden"]."'";
                $filaa =mysql_fetch_array(mysql_query($sqla));
                $maxid = $filaa["max(Id)"];
                
                $id = $maxid; 
              
               include "../modelo/conexion.php";
               $sql2 = "DELETE FROM actividad WHERE Id='".$id."'";
               mysql_query($sql2);
            
            $sqlu = "UPDATE `actividad` SET `porcentaje`='".$porcentaje."', `cant`='".$_POST["numero"]."',`StartTime`='".$fecha_inicial."',`EndTime`='".$fecha_fin."',`user`='".$usuario."',`orden_externa`='".$orden_ext."' WHERE  `orden_servicio`='".$_POST["orden"]."'";
            mysql_query($sqlu);
                
            }
         }}

        $esta= 'En proceso';
        $sql2 = "UPDATE `ordenes` SET `estado_ord`='".$esta."', `estado_2`='".$esta."' WHERE  `id`='".$_POST["archivo"]."'";
         mysql_query($sql2);

	$sql1 = "SELECT count(cod_aten) as can FROM actividad where archivo='".$_POST["archivo"]."'";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idp = $fila1["can"];
        
        $porc = 100 / $idp;
        for($x=1; $x<=$idp; $x=$x+1){ 
         $sql2 = "UPDATE `actividad` SET `cant_med`='".$porc."' WHERE  `archivo`='".$_POST["archivo"]."'";
         mysql_query($sql2);
        }
	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=add_atenciones&cod=".$_POST["archivo"]."'";
        echo "</script>";
            
        }else{
                $sql1 = "select max(orden_servicio) from actividad";
        $fila =mysql_fetch_array(mysql_query($sql1));
        $max=$fila['max(orden_servicio)']+1;
        
	$n = $_POST["numero"];
        $urg = $_POST["urg"];
        $por = 100 / $n;
        $precioss = $_POST["precioss"];
        for($x=1; $x<=$n; $x=$x+1){  
        $fecha_inicial = $_POST["fecha_inicial"];
        $fecha_fin = $_POST["fecha_final"];
        $orden = $max;
        $u = $orden.''.$_POST["atencion2"];
        $descripcion = $_POST["descripcion"];
        $estado = 'No iniciada';   
        $idpacientes = $_POST["paciente"];
        $fecha_r = date("Y/m/d");
        $fecha_m = '';
	$tarea = "Visita";
        $obs= $_POST["obs"];
        $dias= $_POST["dias"];
        $vdias= $_POST["vdias"];
        $archivo = $_POST["archivo"];
        $inf = $_POST["atencion2"];
        $orden_ext = $_POST["orden_ext"];
        $usuario = $_POST["usuario"];
        $aviso='En proceso';
        $color='6';
        $es ='activa';
        $mo ='esta orden se encuentra';
        $asunto_t='Visita # '.$x.' a '.$_POST["name"];
        $porcentaje = $por;
        $prucov= $_POST["prucov"];
        $fecpru= $_POST["fecpru"];
        $respru= $_POST["respru"];
        
	$sql = "INSERT INTO `actividad`(`vdias`,`urgente`,`cada`, `obs`,`prioridad`,`aviso`,`Subject`, `StartTime`, `EndTime`, `tarea`, `Description`, `color`, `estado`, `fecha_reg_ta`, `fecha_mod_ta`, `id_paciente`, `porcentaje`, `orden_servicio`, `precio_total`, `cod_aten`, `cant`, `cant_ins`, `id_empresa`, `user`, `orden_externa`, `archivo`, `est_motivo`, `desc_motivo`, `prueba`, `fechaprueba`, `resultado`)";
        $sql.= "VALUES ('".$vdias."','".$urg."','".$dias."','".$obs."','".$es."','".$aviso."','".$asunto_t."', '".$fecha_inicial."', '".$fecha_fin."', '".$tarea."', '".$descripcion."', '".$color."', '".$estado."', '".$fecha_r."', '".$fecha_m."', '".$idpacientes."', '".$porcentaje."', '".$orden."', '".$precioss."', '".$inf."', '".$n."', '".$x."', '".$u."', '".$usuario."', '".$orden_ext."', '".$archivo."', '".$es."', '".$mo."', '".$prucov."', '".$fecpru."', '".$respru."')";
        mysql_query($sql);
        
} 
$sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES ('Orden $orden registrada por ".$_SESSION['k_username']."  ', '".$_GET['cod']."', '".$_SESSION['k_username']."', 'Archivo General')";
mysql_query($sqlr);

        $esta= 'En proceso';
        $sql2 = "UPDATE `ordenes` SET `estado_ord`='".$esta."', `estado_2`='".$esta."' WHERE  `id`='".$_POST["archivo"]."'";
         mysql_query($sql2);

	$sql1 = "SELECT count(cod_aten) as can FROM actividad where archivo='".$_POST["archivo"]."'";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idp = $fila1["can"];
        
        $porc = 100 / $idp;
        for($x=1; $x<=$idp; $x=$x+1){ 
         $sql2 = "UPDATE `actividad` SET `cant_med`='".$porc."' WHERE  `archivo`='".$_POST["archivo"]."'";
         mysql_query($sql2);
        }
	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=add_atenciones&cod=".$_POST["archivo"]."'";
        echo "</script>";
        }
        
}
?>