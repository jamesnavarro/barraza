<?php
session_start();
include "../modelo/conexion.php";
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if (isset($_POST["nombre"])) {
 $dias = $_POST["dias"]+1;
$fecha = date('Y-m-d');
$nuevafecha = strtotime( '+'.$dias.' day' , strtotime($fecha));
$vencimiento = date('Y-m-d' , $nuevafecha);
        $descripcion_t = $_POST["descripcion"];
	
        $tratamiento = $_POST["tratamiento"];
        $PA = $_POST["PA"];
	$PULSO = $_POST["PULSO"];
        $FR = $_POST["FR"];
        $Valoracion = $_POST["Valoracion"];
        $fecha_mod_t= $_POST["fecha"];
        $time = $_POST["hora"];
        $pru = $_POST["pru"];
        if($_POST["Valoracion"]==''){
            $estado_t = $_POST["estado"];
        }else{
            $estado_t = 'Completada';
        }
        $sql1x = "SELECT * FROM actividad where Id='".$_GET["cod"]."'";
        $fi =mysql_fetch_array(mysql_query($sql1x));
        $contador = $fi["contador"];
        $acceso = $fi["acceso"];
        $a = $fi["orden_servicio"];
        $arc = $fi["archivo"];
        $codaten = $fi["cod_aten"];
        $analizar = mysql_query("select count(*) from actividad where archivo ='$arc' and cod_aten='$codaten' and user='".$_SESSION['k_username']."'  and id_contacto<=98 and orden_servicio!='$a' and id_contacto!='' ");
        $h = mysql_fetch_array($analizar);
        if($h[0]>0){
            echo '<script lanquage="javascript">alert("Debes de terminar primero las atenciones de la misma descripcion  .");location.href="../vistas/?id=ver_orden_interna&ord='.$a.' "</script>';
        }else{
        $vdias = $fi["vdias"]+1;
        if($contador>=$vdias && $acceso==date("Y-m-d")){
               echo '<script lanquage="javascript">alert("Usted no puede ingresar mas de 2 atenciones diarias");location.href="../vistas/?id=ver_orden_interna&ord='.$a.' "</script>';

        }else{
            if($fecha_mod_t==date("Y-m-d")){
                $puntos = 1;
            }else{
                $puntos = 0;
            }
        $sql = "UPDATE `actividad` SET `urgente`='No',`Description`='".$descripcion_t."',`estado`='".$estado_t."',`fecha_mod_ta`='".$fecha_mod_t."',`inf_adicional`='".$tratamiento."',`PA`='".$PA."',`PULSO`='".$PULSO."',`FR`='".$FR."',`Valoracion`='".$Valoracion."', `duracion`='".$time."', `registro`='".date("Y-m-d")."' , `puntos`='".$puntos."', `prueba_realizada`='".$pru."'  WHERE `Id`='".$_GET["cod"]."';";
        mysql_query($sql) or die(mysql_error());
       
        $sql1 = "SELECT * FROM actividad where Id='".$_GET["cod"]."'";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $a = $fila1["orden_servicio"];
        $b = $fila1["cant_ins"];
        $archivo = $fila1["archivo"];
        $fechafin = $fila1["EndTime"];
        $positivo = $fila1["positivo"];
        $negativo = $fila1["negativo"];
        $contador = $fila1["contador"];
        $acceso = $fila1["acceso"];
        $c = $fila1["cant"];
        
         $sql1r = "SELECT sum(puntos) FROM actividad where orden_servicio='".$a."'";
        $p =mysql_fetch_array(mysql_query($sql1r));
        $d = $c - $p[0];
        $px = $d/$c;
        $to = $px * 100;
        $tx = 100 - $to;

        if($_SESSION["area"]!='OFICINA'){
            if($acceso==date("Y-m-d")){
                $sql2 = "UPDATE `actividad` SET `efectivo`='".$tx."',`escore`='".$p[0]."',`vencimiento`='".$vencimiento."',`id_seleccionado`='".$b."', contador=contador+1, acceso='".date("Y-m-d")."' WHERE  `orden_servicio`='".$a."'";
                mysql_query($sql2);
            }else{
                $sql2 = "UPDATE `actividad` SET `efectivo`='".$tx."',`escore`='".$p[0]."',`vencimiento`='".$vencimiento."',`id_seleccionado`='".$b."', contador=1, acceso='".date("Y-m-d")."' WHERE  `orden_servicio`='".$a."'";
                 mysql_query($sql2);
            }
        }
       $sql2 = "UPDATE `actividad` SET `efectivo`='".$tx."',`escore`='".$p[0]."',`vencimiento`='".$vencimiento."',`id_seleccionado`='".$b."' WHERE  `orden_servicio`='".$a."'";
                 mysql_query($sql2);

        
            $consulta= "select sum(porcentaje) as total from actividad where estado='Completada' and orden_servicio='".$a."' ";
            $result=  mysql_query($consulta);
            while($fila=  mysql_fetch_array($result)){
            $total=$fila['total'];
            if($fechafin > date("Y-m-d")){
                $pos = $total;
                $neg = $negativo;
            }else{
                $pos = $positivo;
                $neg = $total-$positivo;
            }
            $sql3 = "UPDATE `actividad` SET `id_contacto`='".$total."',`positivo`='".$pos."',`negativo`='".$neg."' WHERE `orden_servicio`='".$a."';";
            mysql_query($sql3) or die(mysql_error());
 }
 
 $sql10 = "SELECT * FROM actividad where `Id`='".$_GET["cod"]."' limit 1";
        $fila10 =mysql_fetch_array(mysql_query($sql10));
        $oe = $fila10["orden_externa"];
        $arch = $fila10["archivo"];
        $os = $fila10["orden_servicio"];
        $paciente = $fila10["id_paciente"];
        
        $sql21 = "SELECT sum(cant_med) AS suma FROM actividad where estado='Completada' and `archivo`='".$arch."' limit 1";
        $fila21 =mysql_fetch_array(mysql_query($sql21));
        $suma = $fila21["suma"];
        
        $sql20 = "SELECT count(orden_externa) AS oe FROM actividad where `orden_externa`='".$oe."' limit 1";
        $fila20 =mysql_fetch_array(mysql_query($sql20));
        $cont = $fila20["oe"];
    
        $sql40 = "SELECT count(orden_externa) FROM actividad where estado='Completada' and `orden_externa`='".$oe."'";
        $fila40 =mysql_fetch_array(mysql_query($sql40));
        $contc = $fila40["count(orden_externa)"];
        
        $total = 100 * $contc / $cont;
        
         $sql30 = "UPDATE `actividad` SET `por_ext`='".$total."' WHERE  `orden_externa`='".$oe."'";
         mysql_query($sql30);
         
         if($total > 98){
             $sql31 = "UPDATE `actividad` SET `aviso`='Completada' WHERE  `orden_externa`='".$oe."'";
         mysql_query($sql31);
         }
         
        $sql32 = "UPDATE `pacientes` SET `ultima_atencion`='".$fecha."' WHERE  `id_paciente`='".$paciente."'";
         mysql_query($sql32);
         
}}
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=ver_orden_interna&ord=".$os."'";
        echo "</script>";
    }
    ?>