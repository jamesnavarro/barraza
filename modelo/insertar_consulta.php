<?php
require("conexion.php");

$status = "";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if (isset($_GET['editar'])){
    $consulta= "select a.*, b.* from motivo_consulta a, pacientes b WHERE a.id_paciente=b.id_paciente and  a.id_orden=".$_GET['editar']." ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$fisico = $fila['fisico'];    
$motivo = $fila['asunto'];
$conciente= $fila['conciente'];
$somnoliento= $fila['somnoliento'];
$nn= $fila['nombres'].' '.$fila['apellidos'];
$enf = $fila['descripcion_enf'];
$doc = $fila['numero_doc'];
$fc = $fila['fc'];
$ta = $fila['ta'];
$fr = $fila['fr'];
$pULSO = $fila['pulso'];
$axilar = $fila['axilar'];
$actual = $fila['peso'];
$motivo2 = $fila['hallazgos'];
$motivo3 = $fila['terapia'];
$orde = $fila['id_orden'];
$Fecha_registro = $fila['fecha_registro'];
}}else{
if (isset($_GET['cod'])){
    $consulta= "select a.*, b.* from motivo_consulta a, pacientes b WHERE a.id_paciente=b.id_paciente and  a.id_paciente=".$_GET['pac']." ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$fisico = $fila['fisico'];    
$motivo = $fila['asunto'];
$conciente= $fila['conciente'];
$somnoliento= $fila['somnoliento'];
$nn= $fila['nombres'].' '.$fila['apellidos'];
$enf = $fila['descripcion_enf'];
$doc = $fila['numero_doc'];
$fc = $fila['fc'];
$ta = $fila['ta'];
$fr = $fila['fr'];
$pULSO = $fila['pulso'];
$axilar = $fila['axilar'];
$actual = $fila['peso'];
$motivo2 = $fila['hallazgos'];
$motivo3 = $fila['terapia'];
$Fecha_registro = $fila['fecha_registro'];
}

}else{
if(isset($_GET['paciente'])){
$consulta= 'Consulta de Orden #'.$_POST['ord'].'';
$Motivo = $_POST['Motivo'];
$Conciente= $_POST['Conciente'];
$Somnoliento= $_POST['Somnoliento'];
$FC = $_POST['FC'];
$TA = $_POST['TA'];
$FR = $_POST['FR'];
$PULSO = $_POST['PULSO'];
$Axilar = $_POST['Axilar'];
$Actual = $_POST['Actual'];
$Motivo2 = $_POST['Motivo2'];
$Motivo3 = $_POST['Motivo3'];
$orden = $_POST['ord'];
$fisico = $_POST['fisico'];
        
        $fecha_registro = date('Y-m-d').' '.$hora;
        
	

	$sql = "INSERT INTO `motivo_consulta` (`fisico`,`id_paciente`, `consulta`, `asunto`, `conciente`, `somnoliento`, `fc`, `ta`, `fr`, `pulso`, `axilar`, `peso`, `hallazgos`, `terapia`, `fecha_registro`, `id_orden`)";

        $sql.= "VALUES ('".$fisico."','".$_GET["paciente"]."', '".$consulta."', '".$Motivo."','".$Conciente."','".$Somnoliento."','".$FC."','".$TA."','".$FR."','".$PULSO."','".$Axilar."','".$Actual."','".$Motivo2."','".$Motivo3."','".$fecha_registro."','".$orden."')";

        mysql_query($sql);

	$status = "ok";
        $sql1 = "SELECT MAX(id_historia) as id FROM historialclinico";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idll1 = $fila1["id"];
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/mostrar_historial_1.php?cod=".$orden."&pac=".$_GET['pac']." '";
     
        echo "</script>";
        
}
}}
?>
 