<?php
require("conexion.php");

$status = "";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

    if(isset($_GET['autorizar'])){
	if (isset($_POST['regimen'])){$regimen = $_POST['regimen'];}else {$regimen = '';}
        if (isset ($_POST['origen'])){$origen = $_POST['origen'];}else{$origen = '';}
        if (isset ($_POST['tipo'])){$tipo = $_POST['tipo'];}else{$tipo = '';}
        if (isset ($_POST['prioridad'])){$prioridad = $_POST['prioridad'];}else{$prioridad = '';}
        if (isset ($_POST['ubicacion'])){$ubicacion = $_POST['ubicacion'];}else{$ubicacion = '';}
        $servicio = $_POST['servicio'];
        $cama = '';
//        $Manejo = $_POST['manejo'];
        $justificacion = $_POST['justificacion'];
        $diagnostico1 = $_POST['diagnostico1'];
        $descripcion1 = $_POST['descripcion1'];
        $diagnostico2 = $_POST['diagnostico2'];
        $descripcion2 = $_POST['descripcion2'];
        $Nomb = $_POST['Nomb'];
        $indicativo = $_POST['indicativo'];
        $numero = $_POST['numero'];
        $extencion = $_POST['extencion'];
        $entidad = $_POST['entidad'];
        $fecha_registro = date('Y-m-d');
        $orden = $_GET["autorizar"];
	 $estado = 'No Aprobado';

	$sql = "INSERT INTO `autorizacion` (`estado_auto`, `regimen`, `origen_atencion`, `tipo_servicio`, `prioridad`, `ubicacion`, `servicio`, `cama`,`justificacion`, `diagnostico1`, `descripcion1`, `diagnostico2`, `descripcion2`, `nombre_solicita`, `indicativo`, `numero`, `extencion`, `fecha`, `hora`, `numero_orden`, `entidad_codigo`)";

        $sql.= "VALUES ('".$estado."', '".$regimen."', '".$origen."','".$tipo."','".$prioridad."','".$ubicacion."','".$servicio."','".$cama."','".$justificacion."','".$diagnostico1."','".$descripcion1."','".$diagnostico2."','".$descripcion2."','".$Nomb."','".$indicativo."','".$numero."','".$extencion."','".$fecha_registro."','".$hora."','".$orden."','".$entidad."')";

        mysql_query($sql);

	$status = "ok";
       
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=mostrar_autorizacion&autorizar=".$_GET["autorizar"]."'";
     
        echo "</script>";
        
  
}
?>
 