<?php 
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I')); 
//print "&nbsp;$hora&nbsp;"; 
?>
<?php
session_start();
include "../modelo/conexion.php";
$status = "";

        
  if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo = 'Tareas';
        $acceso = $_POST["acceso"];
        $eliminar = $_POST["eliminar"];
        $editar = $_POST["editar"];
        $exportar = $_POST["exportar"];
        $importar = $_POST["importar"];
        $listar = $_POST["listar"];
        $ver = $_POST["ver"];
       
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso."', `eliminar` = '".$eliminar."', `editar` = '".$editar."', `exportar` = '".$exportar."', `importar` = '".$importar."', `listar` = '".$listar."', `ver` = '".$ver."', `fecha_modificacion` = '".$fecha_modificacion_rol."' WHERE `area` = '".$area."' and `modulo` = '".$modulo."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo1 = 'Llamadas';
        $acceso1= $_POST["acceso1"];
        $eliminar1 = $_POST["eliminar1"];
        $editar1 = $_POST["editar1"];
        $exportar1 = $_POST["exportar1"];
        $importar1 = $_POST["importar1"];
        $listar1 = $_POST["listar1"];
        $ver1 = $_POST["ver1"];
       
        $fecha_modificacion_rol1 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso1."', `eliminar` = '".$eliminar1."', `editar` = '".$editar1."', `exportar` = '".$exportar1."', `importar` = '".$importar1."', `listar` = '".$listar1."', `ver` = '".$ver1."', `fecha_modificacion` = '".$fecha_modificacion_rol1."' WHERE `area` = '".$area."' and `modulo` = '".$modulo1."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";

    }
    if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo2 = 'Reuniones';
        $acceso2 = $_POST["acceso2"];
        $eliminar2 = $_POST["eliminar2"];
        $editar2 = $_POST["editar2"];
        $exportar2 = $_POST["exportar2"];
        $importar2 = $_POST["importar2"];
        $listar2 = $_POST["listar2"];
        $ver2 = $_POST["ver2"];
       
        $fecha_modificacion_rol2 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso2."', `eliminar` = '".$eliminar2."', `editar` = '".$editar2."', `exportar` = '".$exportar2."', `importar` = '".$importar2."', `listar` = '".$listar2."', `ver` = '".$ver2."', `fecha_modificacion` = '".$fecha_modificacion_rol2."' WHERE `area` = '".$area."' and `modulo` = '".$modulo2."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo3 = 'Notas';
        $acceso3 = $_POST["acceso3"];
        $eliminar3 = $_POST["eliminar3"];
        $editar3 = $_POST["editar3"];
        $exportar3 = $_POST["exportar3"];
        $importar3 = $_POST["importar3"];
        $listar3 = $_POST["listar3"];
        $ver3 = $_POST["ver3"];
       
        $fecha_modificacion_rol3 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso3."', `eliminar` = '".$eliminar3."', `editar` = '".$editar3."', `exportar` = '".$exportar3."', `importar` = '".$importar3."', `listar` = '".$listar3."', `ver` = '".$ver3."', `fecha_modificacion` = '".$fecha_modificacion_rol3."' WHERE `area` = '".$area."' and `modulo` = '".$modulo3."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo4 = 'Contactos';
        $acceso4 = $_POST["acceso4"];
        $eliminar4 = $_POST["eliminar4"];
        $editar4 = $_POST["editar4"];
        $exportar4 = $_POST["exportar4"];
        $importar4 = $_POST["importar4"];
        $listar4 = $_POST["listar4"];
        $ver4 = $_POST["ver4"];
       
        $fecha_modificacion_rol4 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso4."', `eliminar` = '".$eliminar4."', `editar` = '".$editar4."', `exportar` = '".$exportar4."', `importar` = '".$importar4."', `listar` = '".$listar4."', `ver` = '".$ver4."', `fecha_modificacion` = '".$fecha_modificacion_rol4."' WHERE `area` = '".$area."' and `modulo` = '".$modulo4."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo5 = 'Empresas';
        $acceso5 = $_POST["acceso5"];
        $eliminar5 = $_POST["eliminar5"];
        $editar5 = $_POST["editar5"];
        $exportar5 = $_POST["exportar5"];
        $importar5 = $_POST["importar5"];
        $listar5 = $_POST["listar5"];
        $ver5 = $_POST["ver5"];
       
        $fecha_modificacion_rol5 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso5."', `eliminar` = '".$eliminar5."', `editar` = '".$editar5."', `exportar` = '".$exportar5."', `importar` = '".$importar5."', `listar` = '".$listar5."', `ver` = '".$ver5."', `fecha_modificacion` = '".$fecha_modificacion_rol5."' WHERE `area` = '".$area."' and `modulo` = '".$modulo5."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo6 = 'Incidencias';
        $acceso6 = $_POST["acceso6"];
        $eliminar6 = $_POST["eliminar6"];
        $editar6 = $_POST["editar6"];
        $exportar6 = $_POST["exportar6"];
        $importar6 = $_POST["importar6"];
        $listar6 = $_POST["listar6"];
        $ver6 = $_POST["ver6"];
       
        $fecha_modificacion_rol6 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso6."', `eliminar` = '".$eliminar6."', `editar` = '".$editar6."', `exportar` = '".$exportar6."', `importar` = '".$importar6."', `listar` = '".$listar6."', `ver` = '".$ver6."', `fecha_modificacion` = '".$fecha_modificacion_rol6."' WHERE `area` = '".$area."' and `modulo` = '".$modulo6."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo7 = 'Casos';
        $acceso7 = $_POST["acceso7"];
        $eliminar7 = $_POST["eliminar7"];
        $editar7 = $_POST["editar7"];
        $exportar7 = $_POST["exportar7"];
        $importar7 = $_POST["importar7"];
        $listar7 = $_POST["listar7"];
        $ver7 = $_POST["ver7"];
       
        $fecha_modificacion_rol7 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso7."', `eliminar` = '".$eliminar7."', `editar` = '".$editar7."', `exportar` = '".$exportar7."', `importar` = '".$importar7."', `listar` = '".$listar7."', `ver` = '".$ver7."', `fecha_modificacion` = '".$fecha_modificacion_rol7."' WHERE `area` = '".$area."' and `modulo` = '".$modulo7."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo8 = 'Oportunidades';
        $acceso8 = $_POST["acceso8"];
        $eliminar8 = $_POST["eliminar8"];
        $editar8 = $_POST["editar8"];
        $exportar8 = $_POST["exportar8"];
        $importar8 = $_POST["importar8"];
        $listar8 = $_POST["listar8"];
        $ver8 = $_POST["ver8"];
       
        $fecha_modificacion_rol8 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso8."', `eliminar` = '".$eliminar8."', `editar` = '".$editar8."', `exportar` = '".$exportar8."', `importar` = '".$importar8."', `listar` = '".$listar8."', `ver` = '".$ver8."', `fecha_modificacion` = '".$fecha_modificacion_rol8."' WHERE `area` = '".$area."' and `modulo` = '".$modulo8."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
    if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo9 = 'Campañas';
        $acceso9 = $_POST["acceso9"];
        $eliminar9 = $_POST["eliminar9"];
        $editar9 = $_POST["editar9"];
        $exportar9 = $_POST["exportar9"];
        $importar9 = $_POST["importar9"];
        $listar9 = $_POST["listar9"];
        $ver9 = $_POST["ver9"];
       
        $fecha_modificacion_rol9 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso9."', `eliminar` = '".$eliminar9."', `editar` = '".$editar9."', `exportar` = '".$exportar9."', `importar` = '".$importar9."', `listar` = '".$listar9."', `ver` = '".$ver9."', `fecha_modificacion` = '".$fecha_modificacion_rol9."' WHERE `area` = '".$area."' and `modulo` = '".$modulo9."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
     if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo91 = 'Productos';
        $acceso91 = $_POST["acceso91"];
        $eliminar91 = $_POST["eliminar91"];
        $editar91 = $_POST["editar91"];
        $exportar91 = $_POST["exportar91"];
        $importar91 = $_POST["importar91"];
        $listar91 = $_POST["listar91"];
        $ver91 = $_POST["ver91"];
       
        $fecha_modificacion_rol91 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso91."', `eliminar` = '".$eliminar91."', `editar` = '".$editar91."', `exportar` = '".$exportar91."', `importar` = '".$importar91."', `listar` = '".$listar91."', `ver` = '".$ver91."', `fecha_modificacion` = '".$fecha_modificacion_rol91."' WHERE `area` = '".$area."' and `modulo` = '".$modulo91."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
     if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo92 = 'Proyectos';
        $acceso92 = $_POST["acceso92"];
        $eliminar92 = $_POST["eliminar92"];
        $editar92 = $_POST["editar92"];
        $exportar92 = $_POST["exportar92"];
        $importar92 = $_POST["importar92"];
        $listar92 = $_POST["listar92"];
        $ver92 = $_POST["ver92"];
       
        $fecha_modificacion_rol92 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso92."', `eliminar` = '".$eliminar92."', `editar` = '".$editar92."', `exportar` = '".$exportar92."', `importar` = '".$importar92."', `listar` = '".$listar92."', `ver` = '".$ver92."', `fecha_modificacion` = '".$fecha_modificacion_rol92."' WHERE `area` = '".$area."' and `modulo` = '".$modulo92."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
     if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo93 = 'Configuracion';
        $acceso93 = $_POST["acceso93"];
        $eliminar93 = $_POST["eliminar93"];
        $editar93 = $_POST["editar93"];
        $exportar93 = $_POST["exportar93"];
        $importar93 = $_POST["importar93"];
        $listar93 = $_POST["listar93"];
        $ver93 = $_POST["ver93"];
       
        $fecha_modificacion_rol93 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso93."', `eliminar` = '".$eliminar93."', `editar` = '".$editar93."', `exportar` = '".$exportar93."', `importar` = '".$importar93."', `listar` = '".$listar93."', `ver` = '".$ver93."', `fecha_modificacion` = '".$fecha_modificacion_rol93."' WHERE `area` = '".$area."' and `roles_accion`.`modulo` = '".$modulo93."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
      if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo931 = 'Atenciones';
        $acceso931 = $_POST["acceso931"];
        $eliminar931 = $_POST["eliminar931"];
        $editar931 = $_POST["editar931"];
        $exportar931 = $_POST["exportar931"];
        $importar931 = $_POST["importar931"];
        $listar931 = $_POST["listar931"];
        $ver931 = $_POST["ver931"];
       
        $fecha_modificacion_rol93 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso931."', `eliminar` = '".$eliminar931."', `editar` = '".$editar931."', `exportar` = '".$exportar931."', `importar` = '".$importar931."', `listar` = '".$listar931."', `ver` = '".$ver931."', `fecha_modificacion` = '".$fecha_modificacion_rol93."' WHERE `area` = '".$area."' and `roles_accion`.`modulo` = '".$modulo931."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
      if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo932= 'Alquiler';
        $acceso932 = $_POST["acceso932"];
        $eliminar932 = $_POST["eliminar932"];
        $editar932 = $_POST["editar932"];
        $exportar932 = $_POST["exportar932"];
        $importar932 = $_POST["importar932"];
        $listar932 = $_POST["listar932"];
        $ver932 = $_POST["ver932"];
       
        $fecha_modificacion_rol93 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso932."', `eliminar` = '".$eliminar932."', `editar` = '".$editar932."', `exportar` = '".$exportar932."', `importar` = '".$importar932."', `listar` = '".$listar932."', `ver` = '".$ver932."', `fecha_modificacion` = '".$fecha_modificacion_rol93."' WHERE `area` = '".$area."' and `roles_accion`.`modulo` = '".$modulo932."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
      if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo933 = 'Ventas';
        $acceso933 = $_POST["acceso933"];
        $eliminar933 = $_POST["eliminar933"];
        $editar933 = $_POST["editar933"];
        $exportar933 = $_POST["exportar933"];
        $importar933 = $_POST["importar933"];
        $listar933 = $_POST["listar933"];
        $ver933 = $_POST["ver933"];
       
        $fecha_modificacion_rol93 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso933."', `eliminar` = '".$eliminar933."', `editar` = '".$editar933."', `exportar` = '".$exportar933."', `importar` = '".$importar933."', `listar` = '".$listar933."', `ver` = '".$ver933."', `fecha_modificacion` = '".$fecha_modificacion_rol93."' WHERE `area` = '".$area."' and `roles_accion`.`modulo` = '".$modulo933."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
          if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo934 = 'Pacientes';
        $acceso934 = $_POST["acceso934"];
        $eliminar934 = $_POST["eliminar934"];
        $editar934 = $_POST["editar934"];
        $exportar934 = $_POST["exportar934"];
        $importar934 = $_POST["importar934"];
        $listar934 = $_POST["listar934"];
        $ver934 = $_POST["ver934"];
       
        $fecha_modificacion_rol93 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso934."', `eliminar` = '".$eliminar934."', `editar` = '".$editar934."', `exportar` = '".$exportar934."', `importar` = '".$importar934."', `listar` = '".$listar934."', `ver` = '".$ver934."', `fecha_modificacion` = '".$fecha_modificacion_rol93."' WHERE `area` = '".$area."' and `roles_accion`.`modulo` = '".$modulo934."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
              if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo935 = 'Facturacion';
        $acceso935 = $_POST["acceso935"];
        $eliminar935 = $_POST["eliminar935"];
        $editar935 = $_POST["editar935"];
        $exportar935 = $_POST["exportar935"];
        $importar935 = $_POST["importar935"];
        $listar935 = $_POST["listar935"];
        $ver935 = $_POST["ver935"];
       
        $fecha_modificacion_rol93 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso935."', `eliminar` = '".$eliminar935."', `editar` = '".$editar935."', `exportar` = '".$exportar935."', `importar` = '".$importar935."', `listar` = '".$listar935."', `ver` = '".$ver935."', `fecha_modificacion` = '".$fecha_modificacion_rol93."' WHERE `area` = '".$area."' and `roles_accion`.`modulo` = '".$modulo935."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
              if (isset($_GET['editar'])) {
	$area ='CRM';
	$modulo936 = 'Documentacion';
        $acceso936 = $_POST["acceso936"];
        $eliminar936 = $_POST["eliminar936"];
        $editar936 = $_POST["editar936"];
        $exportar936 = $_POST["exportar936"];
        $importar936 = $_POST["importar936"];
        $listar936 = $_POST["listar936"];
        $ver936 = $_POST["ver936"];
       
        $fecha_modificacion_rol93 = date("Y-m-d").' '.$hora;
       $sql = "UPDATE  `roles_accion` SET `acceso` = '".$acceso936."', `eliminar` = '".$eliminar936."', `editar` = '".$editar936."', `exportar` = '".$exportar936."', `importar` = '".$importar936."', `listar` = '".$listar936."', `ver` = '".$ver936."', `fecha_modificacion` = '".$fecha_modificacion_rol93."' WHERE `area` = '".$area."' and `roles_accion`.`modulo` = '".$modulo936."' and `roles_accion`.`id_roles` = '".$_GET['editar']."'";
       
       mysql_query($sql, $conexion);
       $status = "ok";
        
    }
       echo '<script lanquage="javascript">alert("Se ha editado exitosamente");location.href="../vistas/?id=rol&codigo='.$_GET['editar'].' "</script>'; 
  
     
    ?>