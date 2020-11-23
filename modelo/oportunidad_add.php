<?php 
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

        $id_empp = $_POST["empresa"];
        if(isset($_GET['cont'])){$id_con =$_GET['cont'];}else{$id_con = '';}
    
        $numero = $_POST["oportunidad"];
        $tipo = $_POST["tipo"];
        $tom = $_POST["toma_contacto"];
        $descr = $_POST["descripcion"];
        $use = $_POST["usuario"];$area = $_POST["area"];
        $cam = $_POST["campana"];
        $mone = $_POST["moneda_opo"];
        $cantidad = $_POST["cantidad"];
        $etapas_opo = $_POST["etapa"];
        $probabilidad = $_POST["probabilidad"];
        $pasos = $_POST["paso"];
        $fecha_cierre_opo = $_POST["fecha"];
        $fecha_mod_opo =  date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $fecha_registro_opo = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];

 
            
        if(isset($_GET['editar'])){
                  $sql = "UPDATE `sis_oportunidades` SET `area`='".$area."',`nombre_opo`='".$numero."',`id_empresa`='".$id_empp."',`tipo_opo`='".$tipo."',`toma_opo`='".$tom."',`descripcion_opo`='".$descr."',`asignado_opo`='".$use."',`campana_opo`='".$cam."',`moneda_opo`='".$mone."',`cantidad`='".$cantidad."',`etapas_opo`='".$etapas_opo."',`probabilidad`='".$probabilidad."',`paso_opo`='".$pasos."',`fecha_opo`='".$fecha_cierre_opo."', `fecha_mod_opo`='".$fecha_mod_opo."' WHERE `id_oportunidad`='".$_GET['editar']."'  and asignado_opo='".$_SESSION['k_username']."';";
      
                mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=ver_oportunidades&cod='.$_GET['editar'].'"</script>'; 

        }else{


       $sql = "INSERT INTO sis_oportunidades (`id_contacto`, `nombre_opo`, `id_empresa`, `tipo_opo`, `toma_opo`, `descripcion_opo`, `asignado_opo`, `campana_opo`, `moneda_opo`, `cantidad`, `etapas_opo`, `probabilidad`, `paso_opo`, `fecha_opo`, `area`, `fecha_registro`, `fecha_mod_opo`) ";

        $sql.= "VALUES ('".$id_con."', '".$numero."', '".$id_empp."','".$tipo."', '".$tom."', '".$descr."', '".$use."', '".$cam."', '".$mone."', '".$cantidad."', '".$etapas_opo."', '".$probabilidad."', '".$pasos."', '".$fecha_cierre_opo."','".$area."', '".$fecha_registro_opo."', '".$fecha_mod_opo."')";

	mysql_query($sql, $conexion);

            $status = "ok";
$s = "SELECT max(id_oportunidad) FROM sis_oportunidades";
$fi =mysql_fetch_array(mysql_query($s));
$maximo= $fi["max(id_oportunidad)"];
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_oportunidades&cod='.$maximo.'"</script>'; 

        }
                    