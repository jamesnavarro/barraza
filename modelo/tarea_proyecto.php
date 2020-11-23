<?php 
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

$nombre_p = $_POST["nombre"];
        $fecha_inicial = $_POST["fecha"];
        $fecha_fin = $_POST["fecha2"];
        $cant= $_POST["cant"];
        $duracion = $_POST["duracion"];
        $porcentaje = $_POST["porcentaje"];
        $ocupacion = $_POST["ocupacion"];
        $orden = $_POST["orden"];
        $prioridad_p = $_POST["prioridad"];
        $descripcion_p = $_POST["descripcion"];
        $estado_p = $_POST["estado"];
        
        $id_proyecto = $_GET['cod'];
       
        $fecha_registro_p = date("Y-m-d").''.$hora.' por '.$_SESSION['k_username'];
       $fecha_mod_p = date("Y-m-d").''.$hora.' por '.$_SESSION['k_username']; 
        $usuario_pro = $_POST["usuario"];$area = $_POST["area"];
  
        if(isset($_GET['editar'])){
               $sql = "UPDATE `sis_proyecto_tarea` SET `nombre_tarea` = '".$nombre_p."', `fecha_inicial` = '".$fecha_inicial."', `fecha_final` = '".$fecha_fin."', `asiginado` = '".$usuario_pro."', `area` = '".$area."', `estado_tarea` = '".$estado_p."', `porcentaje_tarea` = '".$porcentaje."', `prioridad` = '".$prioridad_p."', `cant_tareas` = '".$cant."', `duracion_horas` = '".$duracion."', `orden` = '".$orden."', `descripcion_tarea` = '".$descripcion_p."', `ocupacion` = '".$ocupacion."', `fecha_m` = '".$fecha_mod_p."' WHERE `id_tp` ='".$_GET['editar']."'  and asignado='".$_SESSION['k_username']."';";
      
       mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=ver_proyectos&cod='.$_GET['cod'].'"</script>'; 

        }else{

$sql = "INSERT INTO `sis_proyecto_tarea` (`id_proyecto`, `nombre_tarea`, `fecha_inicial`, `fecha_final`, `asiginado`, `area`, `estado_tarea`, `porcentaje_tarea`, `prioridad`, `cant_tareas`, `duracion_horas`, `orden`, `descripcion_tarea`, `ocupacion`, `fecha_r`, `fecha_m`)";

        $sql.= "VALUES ('".$id_proyecto."','".$nombre_p."', '".$fecha_inicial."','".$fecha_fin."', '".$usuario_pro."', '".$area."', '".$estado_p."', '".$porcentaje."', '".$prioridad_p."', '".$cant."', '".$duracion."', '".$orden."', '".$descripcion_p."', '".$ocupacion."', '".$fecha_registro_p."', '".$fecha_mod_p."')";

	mysql_query($sql, $conexion);

            $status = "ok";

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_proyectos&cod='.$_GET['cod'].'"</script>'; 

        }
                    