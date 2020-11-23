<?php 
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

$nombre_p = $_POST["nombre"];
        $fecha_inicial = $_POST["fecha_inicial"];
        $prioridad_p = $_POST["prioridad"];
        $descripcion_p = $_POST["descripcion"];
        $estado_p = $_POST["estado"];
        $fecha_fin = $_POST["fin"];
        if(isset($_GET['cont'])){$id_cont_pro = $_GET['cont'];}else{$id_cont_pro = '';}
        if(isset($_GET['empr'])){$id_emp_pro = $_GET['empr'];}else{$id_emp_pro = '';}
      
        $fecha_registro_p = date("Y-m-d"). ''.$hora.' por '.$_SESSION['k_username'];
       $fecha_mod_p = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username']; 
        $usuario_pro = $_POST["usuario"];$area = $_POST["area"];


 
            
        if(isset($_GET['editar'])){
               $sql = "UPDATE `sis_proyecto` SET `nombre_pro`='".$nombre_p."',`fecha_inicial`='".$fecha_inicial."',`fecha_final`='".$fecha_fin."',`usuario`='".$usuario_pro."',`prioridad_pro`='".$prioridad_p."',`descripcion_pro`='".$descripcion_p."',`estado_pro`='".$estado_p."',`id_contacto`='".$id_cont_pro."',`id_empresa`='".$id_emp_pro."',`fecha_registro_pro`='".$fecha_registro_p."',`fecha_mod_p`='".$fecha_mod_p."' WHERE `id_proyecto`='".$_GET['editar']."' and usuario='".$_SESSION['k_username']."';";
      
       mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=ver_proyectos&cod='.$_GET['editar'].'"</script>'; 

        }else{

$sql = "INSERT INTO `sis_proyecto`(`nombre_pro`, `fecha_inicial`, `fecha_final`, `usuario`, `prioridad_pro`, `descripcion_pro`, `estado_pro`, `id_contacto`, `id_empresa`, `fecha_registro_pro`, `fecha_mod_p`)";

        $sql.= "VALUES ('".$nombre_p."', '".$fecha_inicial."','".$fecha_fin."', '".$usuario_pro."', '".$prioridad_p."', '".$descripcion_p."', '".$estado_p."', '".$id_cont_pro."', '".$id_emp_pro."', '".$fecha_registro_p."', '".$fecha_mod_p."')";

	mysql_query($sql, $conexion);

            $status = "ok";
$s = "SELECT max(id_proyecto) FROM sis_proyecto";
$fi =mysql_fetch_array(mysql_query($s));
$maximo= $fi["max(id_proyecto)"];
   
$sql2 = "INSERT INTO `sis_proyecto_mas` (`id_proyecto`, `id_contacto`, `id_empresa`)";
        $sql2.= "VALUES ('".$maximo."', '".$id_cont_pro."', '".$id_emp_pro."')";
	mysql_query($sql2, $conexion);
        
        
            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_proyectos&cod='.$maximo.'"</script>'; 

        }
                    