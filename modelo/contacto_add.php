<?php
require("conexion.php");
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$status = "";
        $contacto = $_POST["contacto"];
        $nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];
//	$empresa = $_POST["empresa"];
        if(isset($_POST["empresa"])){$id_emp = $_POST["empresa"];}else{$id_emp = '';}
        if(isset($_POST["toma_contacto"])){$toma = $_POST["toma_contacto"];}else{$toma = '';}
        if(isset($_POST["campaña"])){$campana = $_POST["campaña"];}else{$campana = '';}
        if(isset($_POST["cargo"])){$cargo = $_POST["cargo"];}else{$cargo ='';}
        if(isset($_POST["departamento1"])){$departamento = $_POST["departamento1"];}else{$departamento = '';}
        if(isset($_POST['informa'])){$informa = $_POST['informa'];}else{$informa = '';}
        if(isset($_POST["llamada"])){$llamar = $_POST["llamada"];}else{$llamar ='';}
        if(isset($_POST["est"])){$estad = $_POST["est"];}else{$estad = '';}
        if(isset($_POST["fecha"])){$fecha = $_POST["fecha"];}else{$fecha = '';}
        $tel_oficina = $_POST["telefono"];
        if(isset($_POST["fax"])){$fax = $_POST["fax"];}else{$fax = '';}
        if(isset($_POST["celular"])){$celular = $_POST["celular"];}else{$celular = '';}
        if(isset($_POST["tel_casa"])){$tel_casa = $_POST["tel_casa"];}else{$tel_casa = '';}
        if(isset($_POST["tel_alt"])){$tel_alt = $_POST["tel_alt"];}else{$tel_alt = '';}
        if(isset($_POST["asistente"])){$nom_asistente = $_POST["asistente"];}else{$nom_asistente = '';}
        if(isset($_POST["tel_asistente"])){$tel_asistente = $_POST["tel_asistente"];}else{$tel_asistente = '';}
        $usuario = $_POST["usuario"];$area = $_POST["area"];
        if(isset($_POST["departamento"])){$depart = $_POST["departamento"];}else{$depart = '';}
        if(isset($_POST["municipio"])){$municipio = $_POST["municipio"];}else{$municipio ='';}
        if(isset($_POST["direccion1"])){$direccionf = $_POST["direccion1"];}else{$direccionf = '';}
        if(isset($_POST["direccion2"])){$direccione = $_POST["direccion2"];}else{$direccione = '';}
        if(isset($_POST["email1"])){$email1 = $_POST["email1"];}else{$email1 ='';}
        if(isset($_POST["email2"])){$email2 = $_POST["email2"];}else{$email2 = '';}
        if(isset($_POST["email3"])){$email3 = $_POST["email3"];}else{$email3 = '';}
        if(isset($_POST["info"])){$informacion = $_POST["info"];}else{$informacion = '';}
        $fecha_registro = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $fecha_registro_m = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        

        if(isset($_GET['editar'])){
            
                  $sql = "UPDATE `sis_contacto` SET `tipo` = '".$contacto."',`area_user` = '".$area."',`nombre_cont` = '".$nombre."', `apellido_cont` = '".$apellido."', `id_empresa` = '".$id_emp."', `toma_contacto` = '".$toma."', `id_campana` = '".$campana."', `cargo` = '".$cargo."', `departamento` = '".$departamento."', `informa_a` = '".$informa."', `llamar` = '".$llamar."', `estado` = '".$estad."', `fecha` = '".$fecha."', `tel_oficina` = '".$tel_oficina."', `fax` = '".$fax."', `celular` = '".$celular."', `tel_casa` = '".$tel_casa."', `tel_alt` = '".$tel_alt."', `nombre_asistente` = '".$nom_asistente."', `tel_asistente` = '".$tel_asistente."', `usuario` = '".$usuario."', `departamento_cont` = '".$depart."', `municipio` = '".$municipio."', `direccionf` = '".$direccionf."', `direccione` = '".$direccione."', `email1` = '".$email1."', `email2` = '".$email2."', `email3` = '".$email3."', `informacion` = '".$informacion."', `fecha_modificacion` = '".$fecha_registro_m."' WHERE `id_contacto` = '".$_GET["editar"]."';";
       
             mysql_query($sql, $conexion);
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=ver_contacto&cod='.$_GET['editar'].'"</script>'; 
        }else{

	$sql = "INSERT INTO sis_contacto (tipo, area_user, nombre_cont,apellido_cont,id_empresa,toma_contacto, id_campana, cargo, departamento, informa_a, llamar, estado, fecha,tel_oficina, fax, celular, tel_casa, tel_alt, nombre_asistente, tel_asistente, usuario, departamento_cont, municipio, direccionf, direccione, email1,email2, email3,informacion,fecha_registro,fecha_modificacion) ";

        $sql.= "VALUES ('".$contacto."','".$area."','".$nombre."', '".$apellido."', '".$id_emp."', '".$toma."', '".$campana."', '".$cargo."', '".$departamento."', '".$informa."', '".$llamar."', '".$estad."', '".$fecha."', '".$tel_oficina."',
            '".$fax."', '".$celular."', '".$tel_casa."', '".$tel_alt."', '".$nom_asistente."', '".$tel_asistente."', '".$usuario."', '".$depart."', '".$municipio."',
                '".$direccionf."', '".$direccione."', '".$email1."', '".$email2."', '".$email3."', '".$informacion."', '".$fecha_registro."', '".$fecha_registro_m."')";

	mysql_query($sql, $conexion);
        
    

        $status = "ok";
        $sql1 = "SELECT MAX(id_contacto) as id FROM sis_contacto";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idll1 = $fila1["id"];
if(isset($_GET["casos"])){$caso= $_GET["casos"];
        $sql = "INSERT INTO `sis_casos_mas` (`id_caso`, `id_contacto`)";
        $sql.= "VALUES ('".$_GET["casos"]."', '".$idll1."')";
	mysql_query($sql, $conexion);
        }
        if(isset($_GET["incidencia"])){$incidencia= $_GET["incidencia"];
        $sql = "INSERT INTO `sis_incidencias_mas` (`id_incidencia`, `id_contacto`)";
        $sql.= "VALUES ('".$_GET["incidencia"]."', '".$idll1."')";
	mysql_query($sql, $conexion);
        }
        if(isset($_GET["oportunidad"])){$oportunidad= $_GET["oportunidad"];
        $sql = "INSERT INTO `sis_oportunidades_mas` (`id_oportunidad`, `id_contacto`)";
        $sql.= "VALUES ('".$_GET["oportunidad"]."', '".$idll1."')";
	mysql_query($sql, $conexion);
        }
          $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES ('".$_SESSION['k_username']." registro al paciente  ', '".$idll1."', '".$_SESSION['k_username']."', 'Archivo General')";
mysql_query($sqlr);
            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_contacto&cod='.$idll1.'"</script>'; 
        }
?>
