<?php 
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$prioridad_inc = $_POST["prioridad"];
        $tipo_inc = $_POST["tipo"];
        $fuente_inc = $_POST["fuente"];
        $categoria_inc = $_POST["categoria"];
        $lanzamiento_incx = $_POST["lanzamiento"];
        $asunto_inc = $_POST["asunto"];
        $descripcion_inc = $_POST["descripcion"];
        $registro_inc = $_POST['registro'];
        $asignado_inc = $_POST['usuario'];
        $estado_inc = $_POST['estado'];
        $resolucion_inc = $_POST['resolucion'];
        $corregido_inc = $_POST['corregido'];
        $lanzamiento_inc = $_POST['otros'];
        if(!isset($_GET['pac'])){$paciente = $_POST['paciente'];}else{$paciente = $_GET['pac'];}
        if(isset($_GET['cont'])){$id_contacto_inc = $_GET['cont'];}else{$id_contacto_inc ='';}
        if(isset($_GET['empr'])){$id_empresa_inc = $_GET['empr'];}else{$id_empresa_inc ='';}
        $fecha_registro_inc = date("Y-m-d").' '.$hora;
        $fecha_m_inc = date("Y-m-d").' '.$hora;
if($estado_inc=='Solucionado'){
    $reg = " ,`fecha_mod_reg`='".$fecha_m_inc."' ";
    
}else{
    $reg = '';
}
 
            
        if(isset($_GET['editar'])){
               $sql = "UPDATE `sis_incidencias` SET `prioridad_inc`='".$prioridad_inc."',`tipo_inc`='".$tipo_inc."',`fuente_inc`='".$fuente_inc."',`categoria_inc`='".$categoria_inc."',`lanzamiento_inc`='".$lanzamiento_inc."',`asunto_inc`='".$asunto_inc."',`descripcion_inc`='".$descripcion_inc."',`registro_inc`='".$registro_inc."',`asignado_inc`='".$asignado_inc."',`estado_inc`='".$estado_inc."',`resolucion_inc`='".$resolucion_inc."',`corregido_inc`='".$corregido_inc."',`id_contacto`='".$id_contacto_inc."',`id_empresa`='".$id_empresa_inc."' ".$reg." WHERE `id_incidencia`='".$_GET['editar']."' ;";
               $ver =  mysql_query($sql, $conexion) or die(mysql_error());

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente '.$ver.'  ");location.href="../vistas/?id=ver_incidencias&cod='.$_GET['editar'].'" </script>'; 

        }else{


   $sql = "INSERT INTO `sis_incidencias`(`registrado_por`,`id_paciente`, `prioridad_inc`, `tipo_inc`, `fuente_inc`, `categoria_inc`, `lanzamiento_inc`, `asunto_inc`, `descripcion_inc`, `registro_inc`, `asignado_inc`, `estado_inc`, `resolucion_inc`, `corregido_inc`, `id_contacto`, `id_empresa`, `fecha_registro_inc`, `fecha_mod_reg`)";

        $sql.= "VALUES ('".$_SESSION['k_username']."', '".$paciente."','".$prioridad_inc."', '".$tipo_inc."','".$fuente_inc."', '".$categoria_inc."', '".$lanzamiento_inc."', '".$asunto_inc."', '".$descripcion_inc."', '".$registro_inc."', '".$asignado_inc."', '".$estado_inc."', '".$resolucion_inc."', '".$corregido_inc."', '".$id_contacto_inc."', '".$id_empresa_inc."', '".$fecha_registro_inc."', '".$fecha_m_inc."')";

	mysql_query($sql, $conexion);

            $status = "ok";
$s = "SELECT max(id_incidencia) FROM sis_incidencias";
$fi =mysql_fetch_array(mysql_query($s));
$maximo= $fi["max(id_incidencia)"];
   if(isset($_GET["prod"])){
    
       $sql = "INSERT INTO `sis_incidencias_mas` (`id_incidencia`, `id_producto`)";
        $sql.= "VALUES ('".$maximo."', '".$_GET["prod"]."')";
	mysql_query($sql, $conexion);
echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_productos&cod='.$_GET["prod"].'"</script>'; 
        }

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_incidencias&cod='.$maximo.'"</script>'; 

        }
                    