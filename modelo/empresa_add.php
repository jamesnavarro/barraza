<?php
require("conexion.php");
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$status = "";

        $nombre = $_POST["nombre_emp"];
	$web = $_POST["web"];$rips = $_POST["rips"];
	if(isset($_POST["simbolo"])){$simbolo = $_POST["simbolo"];}else{$simbolo = '';}
        if(isset($_POST["miembro"])){$miembro = $_POST["miembro"];}else{$miembro = '';}
        if(isset($_POST["propietario"])){$propietario = $_POST["propietario"];}else{$propietario = '';}
        if(isset($_POST["industria"])){$industria = $_POST["industria"];}else{$industria = '';}
        if(isset($_POST["tipo"])){$tipo = $_POST["tipo"];}else{$tipo = '';}
        if(isset($_POST["usuario"])){$usuario = $_POST["usuario"];}else{$usuario = '';}
        if(isset($_POST["telefono_emp"])){$telefono_emp = $_POST["telefono_emp"];}else{$telefono_emp = '';}
        if(isset($_POST["fax_emp"])){$fax_emp = $_POST["fax_emp"];}else{$fax_emp = '';}
        if(isset($_POST["celular_emp"])){$celular_emp = $_POST["celular_emp"];}else{$celular_emp = '';}
        if(isset($_POST["empleado"])){$empleado = $_POST["empleado"];}else{$empleado = '';}
        if(isset($_POST["puntaje"])){$puntaje = $_POST["puntaje"];}else{$puntaje ='';}
        if(isset($_POST["nit"])){$nit = $_POST["nit"];}else{$nit = $_POST["nit"];}
        if(isset($_POST["ingreso"])){$ingreso = $_POST["ingreso"];}else{$ingreso = '';}
        if(isset($_POST["departamento_emp"])){$departamento_emp = $_POST["departamento_emp"];}else{$departamento_emp = '';}
        if(isset($_POST["municipio_emp"])){$municipio_emp = $_POST["municipio_emp"];}else{$municipio_emp = '';}
        if(isset($_POST["direccion_emp"])){$direccion_emp = $_POST["direccion_emp"];}else{$direccion_emp = '';}
        if(isset($_POST["direccion_emp1"])){$direccion_emp1 = $_POST["direccion_emp1"];}else{$direccion_emp1 = '';}
        if(isset($_POST["email_emp1"])){$email_emp1 = $_POST["email_emp1"];}else{$email_emp1 = '';}
        if(isset($_POST["email_emp2"])){$email_emp2 = $_POST["email_emp2"];}else{$email_emp2 = '';}
        if(isset($_POST["email_emp3"])){$email_emp3 = $_POST["email_emp3"];}else{$email_emp3 = '';}
        if(isset($_POST["inf_emp"])){$inf_emp = $_POST["inf_emp"];}else{$inf_emp = '';}
        if(isset($_POST["area"])){$area = $_POST["area"];}else{$area = '';}
        $fecha_registro = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $fecha_registro_mo = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];

        if(isset($_GET['editar'])){
            
                 $sql = "UPDATE `sis_empresa` SET `area_user`='".$area."',`rips`='".$rips."', `nombre_emp`='".$nombre."',`web_emp`='".$web."',`simbolo_emp`='".$simbolo."',`miembro_emp`='".$miembro."',`propietario_emp`='".$propietario."',`industria_emp`='".$industria."',`tipo_emp`='".$tipo."',`usuario`='".$usuario."',`tel_oficina_emp`='".$telefono_emp."',`fax_emp`='".$fax_emp."',`celular_emp`='".$celular_emp."',`empleados_emp`='".$empleado."',`puntaje_emp`='".$puntaje."',`nit_emp`='".$nit."',`ingresos_emp`='".$ingreso."',`departameto_emp`='".$departamento_emp."',`municipio_emp`='".$municipio_emp."',`direccionr_emp`='".$direccion_emp."',`direccione_emp`='".$direccion_emp1."',`email1_emp`='".$email_emp1."',`email2_emp`='".$email_emp2."',`email3_emp`='".$email_emp3."',`inf_emp`='".$inf_emp."',`fecha_modificacion`='".$fecha_registro_mo."' WHERE `id_empresa` = '".$_SESSION['id_emp']."';";
       
             mysql_query($sql, $conexion);
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=ver_empresa&cod='.$_GET['editar'].'"</script>'; 
        }else{

	$sql = "INSERT INTO `sis_empresa`(`rips`, `area_user`, `nombre_emp`, `web_emp`, `simbolo_emp`, `miembro_emp`, `propietario_emp`, `industria_emp`, `tipo_emp`, `usuario`, `tel_oficina_emp`, `fax_emp`, `celular_emp`, `empleados_emp`, `puntaje_emp`, `nit_emp`, `ingresos_emp`, `departameto_emp`, `municipio_emp`, `direccionr_emp`, `direccione_emp`, `email1_emp`, `email2_emp`, `email3_emp`, `inf_emp`, `fecha_modificacion`, `fecha_registro`, `cliente`)";
        $sql.= "VALUES ('".$rips."','".$area."', '".$nombre."', '".$web."', '".$simbolo."', '".$miembro."', '".$propietario."', '".$industria."', '".$tipo."', '".$usuario."', '".$telefono_emp."', '".$fax_emp."',
            '".$celular_emp."', '".$empleado."', '".$puntaje."', '".$nit."', '".$ingreso."', '".$departamento_emp."', '".$municipio_emp."', '".$direccion_emp."', '".$direccion_emp1."',
                '".$email_emp1."', '".$email_emp2."', '".$email_emp3."', '".$inf_emp."', '".$fecha_registro_mo."', '".$fecha_registro."','Si')";
        mysql_query($sql, $conexion);

            $status = "ok";
            $sql1 = "SELECT MAX(id_empresa) as id FROM sis_empresa";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idll1 = $fila1["id"];


            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_empresa&cod='.$idll1.'"</script>'; 
        }
?>
