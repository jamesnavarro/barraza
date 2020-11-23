<?php 
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
 $prioridad_c = $_POST["prioridad"];
        $estado_c = $_POST["estado"];
        $tipo_c = $_POST["tipo"];$tipo_c2 = $_POST["tipo2"];$tipo_c3 = $_POST["tipo3"];
        $asunto_c = $_POST["asunto"];
        $desc_c = $_POST["descripcion"];
        $resolucion_c = $_POST["resolucion"];
        $asignado_c = $_POST["usuario"];$area = $_POST["area"];
        $empresa_c = $_POST['empresa'];
        if(isset($_GET['cont'])){$contacto_c = $_GET['cont'];}else{$contacto_c = '';}
        $fecha_registro_caso = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $fecha_mod_caso = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];

 
            
        if(isset($_GET['editar'])){
               $sql = "UPDATE `sis_casos` SET `prioridad_caso`='".$prioridad_c."',`estado_caso`='".$estado_c."',`tipo_caso`='".$tipo_c."',`asistente2`='".$tipo_c2."',`asistente3`='".$tipo_c3."',`asunto_caso`='".$asunto_c."',`descripcion_caso`='".$desc_c."',`resolucion_caso`='".$resolucion_c."',`asignado_caso`='".$asignado_c."',`id_empresa`='".$empresa_c."',`fecha_mod_caso`='".$fecha_mod_caso."' WHERE  `id_caso`='".$_GET['editar']."'  and asignado_caso='".$_SESSION['k_username']."';";
      
       mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=ver_casos&cod='.$_GET['editar'].'"</script>'; 

        }else{


      $sql = "INSERT INTO `sis_casos`(`asistente2`,`asistente3`,`area`, `prioridad_caso`, `estado_caso`, `tipo_caso`, `asunto_caso`, `descripcion_caso`, `resolucion_caso`, `asignado_caso`, `id_empresa`, `id_contacto`, `fecha_registro_caso`, `fecha_mod_caso`)";
        $sql.= "VALUES ('".$tipo_c2."','".$tipo_c3."','".$area."','".$prioridad_c."', '".$estado_c."','".$tipo_c."', '".$asunto_c."', '".$desc_c."', '".$resolucion_c."', '".$asignado_c."', '".$empresa_c."', '".$contacto_c."', '".$fecha_registro_caso."', '".$fecha_mod_caso."')";
	mysql_query($sql);

            $status = "ok";
$s = "SELECT max(id_caso) FROM sis_casos";
$fi =mysql_fetch_array(mysql_query($s));
$maximo= $fi["max(id_caso)"];

        $sql1 = "INSERT INTO `sis_casos_mas` (`id_caso`, `id_contacto`)";
        $sql1.= "VALUES ('".$maximo."', '".$contacto_c."')";
	mysql_query($sql1, $conexion);
        
         if(isset($_GET["prod"])){
    
       $sql2 = "INSERT INTO `sis_casos_mas` (`id_caso`, `id_producto`)";
        $sql2.= "VALUES ('".$maximo."', '".$_GET["prod"]."')";
	mysql_query($sql2, $conexion);
         echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_productos&cod='.$_GET["prod"].'"</script>'; 

        }
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_casos&cod='.$maximo.'"</script>'; 

        }
                    