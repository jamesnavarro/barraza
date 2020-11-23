<?php 
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

      	$nombre_c = $_POST["nombre_cam"];
        $estado_cam = $_POST["estado_cam"];
        $fecha_i_c = $_POST["fecha_inicio_c"];
        $fecha_f_c = $_POST["fecha_fin_c"];
        $tipo_cam = $_POST["tipo_cam"];
        $moneda_cam = $_POST["moneda_cam"];
        $presupuesto = $_POST["presupuesto_cam"];
        $ingreso_cam = $_POST["ingresos"];
        $costo_cam = $_POST["costo"];
        $costo_e_cam = $_POST["costo_esp"];
        $impresiones = $_POST["impresiones"];
        $objectivo = $_POST["objectivo_cam"];
        $descripcion_cam = $_POST["descripcion_cam"];
     
         if(isset($_GET['cont'])){$id_cont_cam = $_GET['cont'];}else{$id_cont_cam = '';}
        if(isset($_GET['empr'])){$id_emp_cam = $_GET['empr'];}else{$id_emp_cam = '';}
      
        $fecha_registro_cam = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $fecha_mod_cam = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $asignado_cam = $_POST["usuario"];
        $area = $_POST["area"];
        if($fecha_i_c > $fecha_f_c){
        echo '<script lanquage="javascript">alert("La fecha inicial es es mayor a la fecha final");location.href="../vistas/formulario_campana.php"</script>';
        }else{

 
            
        if(isset($_GET['editar'])){
                 $sql = "UPDATE `sis_campana` SET `nombre_cam`='".$nombre_c."',`estado_cam`='".$estado_cam."',`fecha_inicio_cam`='".$fecha_i_c."',`fecha_fin_cam`='".$fecha_f_c."',`tipo_cam`='".$tipo_cam."',`moneda_cam`='".$moneda_cam."',`presupuesto_cam`='".$presupuesto."',`ingreso_cam`='".$ingreso_cam."',`costo_real_cam`='".$costo_cam."',`costo_esp_cam`='".$costo_e_cam."',`impresiones_cam`='".$impresiones."',`objectivo_cam`='".$objectivo."',`descripcion_cam`='".$descripcion_cam."',`asignado_cam`='".$asignado_cam."',`id_contacto`='".$id_cont_cam ."',`id_empresa`='".$id_emp_cam."',`fecha_mod_cam`='".$fecha_mod_cam."' WHERE `id_campana`='".$_GET['editar']."' and asignado_cam='".$_SESSION['k_username']."';";
      
                mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=ver_campanas&cod='.$_GET['editar'].'"</script>'; 

        }else{


       $sql = "INSERT INTO `sis_campana`(`area`, `nombre_cam`, `estado_cam`, `fecha_inicio_cam`, `fecha_fin_cam`, `tipo_cam`, `moneda_cam`, `presupuesto_cam`, `ingreso_cam`, `costo_real_cam`, `costo_esp_cam`, `impresiones_cam`, `objectivo_cam`, `descripcion_cam`, `asignado_cam`, `id_contacto`, `id_empresa`, `fecha_registro_cam`, `fecha_mod_cam`)";

        $sql.= "VALUES ('".$area."','".$nombre_c."', '".$estado_cam."', '".$fecha_i_c."','".$fecha_f_c."', '".$tipo_cam."', '".$moneda_cam."', '".$presupuesto."', '".$ingreso_cam."', '".$costo_cam."', '".$costo_e_cam."', '".$impresiones."', '".$objectivo."', '".$descripcion_cam."', '".$asignado_cam."', '".$id_cont_cam."', '".$id_emp_cam."', '".$fecha_registro_cam."', '".$fecha_mod_cam."')";

	mysql_query($sql, $conexion);

            $status = "ok";
$s = "SELECT max(id_campana) FROM sis_campana";
$fi =mysql_fetch_array(mysql_query($s));
$maximo= $fi["max(id_campana)"];
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_campanas&cod='.$maximo.'"</script>'; 

        }}
                    