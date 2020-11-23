<?php
require("conexion.php");
session_start();
$status = "";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if (isset($_POST["acceso"])) {
	


        $area = 'CRM';
	$modulo = 'Tareas';
        $acceso = $_POST["acceso"];
        $eliminar = $_POST["eliminar"];
        $editar = $_POST["editar"];
        $exportar = $_POST["exportar"];
        $importar = $_POST["importar"];
        $listar = $_POST["listar"];
        $ver = $_POST["ver"];
       
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        
	

	$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso1"])) {
	


$area = 'CRM';
	$modulo = 'Llamadas';
        $acceso = $_POST["acceso1"];
        $eliminar = $_POST["eliminar1"];
        $editar = $_POST["editar1"];
        $exportar = $_POST["exportar1"];
        $importar = $_POST["importar1"];
        $listar = $_POST["listar1"];
        $ver = $_POST["ver1"];
        
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso2"])) {
	


$area = 'CRM';
	$modulo = 'Reuniones';
        $acceso = $_POST["acceso2"];
        $eliminar = $_POST["eliminar2"];
        $editar = $_POST["editar2"];
        $exportar = $_POST["exportar2"];
        $importar = $_POST["importar2"];
        $listar = $_POST["listar2"];
        $ver = $_POST["ver2"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso3"])) {
	


$area = 'CRM';
	$modulo = 'Notas';
        $acceso = $_POST["acceso3"];
        $eliminar = $_POST["eliminar3"];
        $editar = $_POST["editar3"];
        $exportar = $_POST["exportar3"];
        $importar = $_POST["importar3"];
        $listar = $_POST["listar3"];
        $ver = $_POST["ver3"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso4"])) {
	


$area = 'CRM';
	$modulo = 'Contactos';
        $acceso = $_POST["acceso4"];
        $eliminar = $_POST["eliminar4"];
        $editar = $_POST["editar4"];
        $exportar = $_POST["exportar4"];
        $importar = $_POST["importar4"];
        $listar = $_POST["listar4"];
        $ver = $_POST["ver4"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso5"])) {
	


$area = 'CRM';
	$modulo = 'Empresa';
        $acceso = $_POST["acceso5"];
        $eliminar = $_POST["eliminar5"];
        $editar = $_POST["editar5"];
        $exportar = $_POST["exportar5"];
        $importar = $_POST["importar5"];
        $listar = $_POST["listar5"];
        $ver = $_POST["ver5"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso6"])) {
	


$area = 'CRM';
	$modulo = 'Incidencias';
        $acceso = $_POST["acceso6"];
        $eliminar = $_POST["eliminar6"];
        $editar = $_POST["editar6"];
        $exportar = $_POST["exportar6"];
        $importar = $_POST["importar6"];
        $listar = $_POST["listar6"];
        $ver = $_POST["ver6"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	

$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso7"])) {
	


$area = 'CRM';
	$modulo = 'Casos';
        $acceso = $_POST["acceso7"];
        $eliminar = $_POST["eliminar7"];
        $editar = $_POST["editar7"];
        $exportar = $_POST["exportar7"];
        $importar = $_POST["importar7"];
        $listar = $_POST["listar7"];
        $ver = $_POST["ver7"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso8"])) {
	


$area = 'CRM';
	$modulo = 'Oportunidades';
        $acceso = $_POST["acceso8"];
        $eliminar = $_POST["eliminar8"];
        $editar = $_POST["editar8"];
        $exportar = $_POST["exportar8"];
        $importar = $_POST["importar8"];
        $listar = $_POST["listar8"];
        $ver = $_POST["ver8"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso9"])) {
	


$area = 'CRM';
	$modulo = 'Campañas';
        $acceso = $_POST["acceso9"];
        $eliminar = $_POST["eliminar9"];
        $editar = $_POST["editar9"];
        $exportar = $_POST["exportar9"];
        $importar = $_POST["importar9"];
        $listar = $_POST["listar9"];
        $ver = $_POST["ver9"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso9"])) {
	


$area = 'CRM';
	$modulo = 'Productos';
        $acceso = $_POST["acceso91"];
        $eliminar = $_POST["eliminar91"];
        $editar = $_POST["editar91"];
        $exportar = $_POST["exportar91"];
        $importar = $_POST["importar91"];
        $listar = $_POST["listar91"];
        $ver = $_POST["ver91"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso9"])) {
	


$area = 'CRM';
	$modulo = 'Proyectos';
        $acceso = $_POST["acceso92"];
        $eliminar = $_POST["eliminar92"];
        $editar = $_POST["editar92"];
        $exportar = $_POST["exportar92"];
        $importar = $_POST["importar92"];
        $listar = $_POST["listar92"];
        $ver = $_POST["ver92"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";

        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";

	mysql_query($sql, $conexion);

	$status = "ok";
}
if (isset($_POST["acceso9"])) {
$area = 'CRM';
	$modulo = 'Configuracion';
        $acceso = $_POST["acceso93"];
        $eliminar = $_POST["eliminar93"];
        $editar = $_POST["editar93"];
        $exportar = $_POST["exportar93"];
        $importar = $_POST["importar93"];
        $listar = $_POST["listar93"];
        $ver = $_POST["ver93"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";
        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";
	mysql_query($sql, $conexion);
	$status = "ok";
}
if (isset($_POST["acceso9"])) {
$area = 'CRM';
	$modulo = 'Atenciones';
        $acceso = $_POST["acceso931"];
        $eliminar = $_POST["eliminar931"];
        $editar = $_POST["editar931"];
        $exportar = $_POST["exportar931"];
        $importar = $_POST["importar931"];
        $listar = $_POST["listar931"];
        $ver = $_POST["ver931"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";
        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";
	mysql_query($sql, $conexion);
	$status = "ok";
}
if (isset($_POST["acceso9"])) {
$area = 'CRM';
	$modulo = 'Alquiler';
        $acceso = $_POST["acceso932"];
        $eliminar = $_POST["eliminar932"];
        $editar = $_POST["editar932"];
        $exportar = $_POST["exportar932"];
        $importar = $_POST["importar932"];
        $listar = $_POST["listar932"];
        $ver = $_POST["ver932"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";
        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";
	mysql_query($sql, $conexion);
	$status = "ok";
}
if (isset($_POST["acceso9"])) {
$area = 'CRM';
	$modulo = 'Ventas';
        $acceso = $_POST["acceso933"];
        $eliminar = $_POST["eliminar933"];
        $editar = $_POST["editar933"];
        $exportar = $_POST["exportar933"];
        $importar = $_POST["importar933"];
        $listar = $_POST["listar933"];
        $ver = $_POST["ver933"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";
        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";
	mysql_query($sql, $conexion);
	$status = "ok";
}

if (isset($_POST["acceso9"])) {
$area = 'CRM';
	$modulo = 'Pacientes';
        $acceso = $_POST["acceso934"];
        $eliminar = $_POST["eliminar934"];
        $editar = $_POST["editar934"];
        $exportar = $_POST["exportar934"];
        $importar = $_POST["importar934"];
        $listar = $_POST["listar934"];
        $ver = $_POST["ver934"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";
        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";
	mysql_query($sql, $conexion);
	$status = "ok";
}
if (isset($_POST["acceso9"])) {
$area = 'CRM';
	$modulo = 'Facturacion';
        $acceso = $_POST["acceso935"];
        $eliminar = $_POST["eliminar935"];
        $editar = $_POST["editar935"];
        $exportar = $_POST["exportar935"];
        $importar = $_POST["importar935"];
        $listar = $_POST["listar935"];
        $ver = $_POST["ver935"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";
        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";
	mysql_query($sql, $conexion);
	$status = "ok";
}
if (isset($_POST["acceso9"])) {
$area = 'CRM';
	$modulo = 'Documentacion';
        $acceso = $_POST["acceso936"];
        $eliminar = $_POST["eliminar936"];
        $editar = $_POST["editar936"];
        $exportar = $_POST["exportar936"];
        $importar = $_POST["importar936"];
        $listar = $_POST["listar936"];
        $ver = $_POST["ver936"];
        $fecha_modificacion_rol = date("Y-m-d").' '.$hora;
        
	
$sql = "INSERT INTO `roles_accion` (`area`, `id_roles`, `modulo`, `acceso`, `eliminar`, `editar`, `exportar`, `importar`, `listar`, `ver`, `fecha_modificacion`)";
        $sql.= "VALUES ('".$area."','".$_GET['codigo']."', '".$modulo."', '".$acceso."', '".$eliminar."', '".$editar."', '".$exportar."', '".$importar."', '".$listar."', '".$ver."', '".$fecha_modificacion_rol."')";
	mysql_query($sql, $conexion);
	$status = "ok";
}
          echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=rol'";
     
        echo "</script>";

        

?>
 