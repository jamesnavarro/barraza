<?php
require("conexion.php");

$status = "";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
//if ($_POST["asunto_caso"] == "") {
//     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/formulario_casos.php"</script>';
//}else{

//$_GET['codigo']=;
if (isset($_GET['codigo'])){
    $consulta= "select * from historialclinico WHERE  id_paciente=".$_GET["codigo"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
     
        $id_historia=$fila['id_historia'];
        $idpa=$fila['id_paciente'];
        $motivo = $fila['Motivo'];
        $cancer = $fila['Cancer'];
        $diabetes = $fila['Diabetes'];
        $ataques = $fila['Ataques'];
        $hipertencion = $fila['Hipertencion1'];
        $emfermedades = $fila['Emfermedades1'];
        $tuberculosis = $fila['Tuberculosis'];
        $otras = $fila['Otras'];
        $especifique = $fila['Especifique'];
        $alcohol = $fila['Alcohol'];
        $tabaco = $fila['Tabaco'];
        $drogas = $fila['Drogas'];
        $cancer1 = $fila['Cancer1'];
        $ataques1 = $fila['Ataques1'];
        $diabetes1 = $fila['Diabetes1'];
        $hiper = $fila['Hipertencion'];
        $emfermedades1 = $fila['emfermedades'];
        $tuberculosis1 = $fila['Tuberculosis1'];
        $otras1 = $fila['Otras1'];
        $especifique1 = $fila['Especifique1'];
        $medicamentos = $fila['Medicamentos'];
        $alergias = $fila['Alergias'];
        $cuales1 = $fila['Cuales1'];
        $cuales2 = $fila['Cuales2'];
        $cuales3 = $fila['Cuales3'];
        
        $laboratorios = $fila['Laboratorios'];
        $cuales4 = $fila['Cuales4'];
        $cuales5 = $fila['Cuales5'];
        $cuales6 = $fila['Cuales6'];
        $otros = $fila['Otros'];
        $cuales7 = $fila['Cuales7'];
        $cuales8 = $fila['Cuales8'];
        $cuales9 = $fila['Cuales9'];
        $ooo = $fila['orden'];
        $Fecha_registro = $fila['fecha_registro'];
}

}else{
    if(isset($_GET['paciente'])){
	$Motivo= 'Historial '.$_POST['paciente'].'';
        $Cancer1 = $_POST['Cancer'];
        $Diabetes1 = $_POST['Diabetes'];
        $Ataques1 = $_POST['Ataques'];
        $Hipertencion1 = $_POST['Hipertencion'];
        $Emfermedades1 = $_POST['Emfermedades'];
        $Tuberculosis1 = $_POST['Tuberculosis'];
        $Otras = $_POST['Otras'];
        if (isset($_POST['Especifique'])){$Especifique = $_POST['Especifique'];}else {$Especifique = '';}
        $Alcohol = $_POST['Alcohol'];
        $Tabaco = $_POST['Tabaco'];
        $Drogas = $_POST['Drogas'];
        $Cancer = $_POST['Cancer1'];
        $Ataques = $_POST['Ataques1'];
        $Diabetes = $_POST['Diabetes1'];
        $Hipertencion = $_POST['Hipertencion1'];
        $Emfermedades = $_POST['Emfermedades1'];
        $Tuberculosis = $_POST['Tuberculosis1'];
        $Otras1 = $_POST['Otras1'];
        if (isset($_POST['Especifique1'])){$Especifique1 = $_POST['Especifique1'];}else {$Especifique1 = '';}
        $Medicamentos = $_POST['Medicamentos'];
        $Alergias = $_POST['Alergias'];
        if (isset ($_POST['Cuales1'])){$Cuales1 = $_POST['Cuales1'];}else{$Cuales1 = '';}
         if (isset ($_POST['Cuales2'])){$Cuales2 = $_POST['Cuales2'];}else{$Cuales2 = '';}
        if (isset ($_POST['Cuales3'])){$Cuales3 = $_POST['Cuales3'];}else{$Cuales3 = '';}
        
        $Laboratorios = $_POST['Laboratorios'];
        if (isset ($_POST['Cuales4'])){$Cuales4 = $_POST['Cuales4'];}else{$Cuales4 = '';}
         if (isset ($_POST['Cuales5'])){$Cuales5 = $_POST['Cuales5'];}else{$Cuales5 = '';}
        if (isset ($_POST['Cuales6'])){$Cuales6 = $_POST['Cuales6'];}else{$Cuales6 = '';}
        $Otros = $_POST['Otros'];
         if (isset ($_POST['Cuales7'])){$Cuales7 = $_POST['Cuales7'];}else{$Cuales7 = '';}
         if (isset ($_POST['Cuales8'])){$Cuales8 = $_POST['Cuales8'];}else{$Cuales8 = '';}
       if (isset ($_POST['Cuales9'])){$Cuales9 = $_POST['Cuales9'];}else{$Cuales9 = '';}
        
        $fecha_registro = date('Y-m-d').' '.$hora;
        $orden = $_GET["paciente"];
	

	$sql = "INSERT INTO `historialclinico` (`id_paciente`, `Motivo`, `Cancer`, `Diabetes`, `Ataques`, `Hipertencion`, `Emfermedades`, `Tuberculosis`, `Otras`, `Especifique`, `Alcohol`, `Tabaco`, `Drogas`, `Cancer1`, `Ataques1`, `Diabetes1`, `Hipertencion1`, `emfermedades1`, `Tuberculosis1`, `Otras1`, `Especifique1`, `Medicamentos`, `Alergias`, `Cuales1`, `Cuales2`, `Cuales3`, `Laboratorios`, `Cuales4`, `Cuales5`, `Cuales6`, `Otros`, `Cuales7`, `Cuales8`, `Cuales9`, `fecha_registro`, `orden`)";

        $sql.= "VALUES ('".$_POST['paciente']."', '".$Motivo."','".$Cancer."','".$Diabetes."','".$Ataques."','".$Hipertencion."','".$Emfermedades."','".$Tuberculosis."','".$Otras."','".$Especifique."','".$Alcohol."','".$Tabaco."','".$Drogas."','".$Cancer1."','".$Ataques1."','".$Diabetes1."','".$Hipertencion1."','".$Emfermedades1."','".$Tuberculosis1."','".$Otras1."','".$Especifique1."','".$Medicamentos."','".$Alergias."','".$Cuales1."','".$Cuales2."','".$Cuales3."','".$Laboratorios."','".$Cuales4."','".$Cuales5."','".$Cuales6."','".$Otros."','".$Cuales7."','".$Cuales8."','".$Cuales9."','".$fecha_registro."','".$orden."')";

        mysql_query($sql);

	$status = "ok";
        $sql1 = "SELECT MAX(id_historia) as id FROM historialclinico";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idll1 = $fila1["id"];
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/mostrar_historial.php?orde=".$_GET["paciente"]."'";
     
        echo "</script>";
        
  
}}
if (isset($_GET['orde'])){
    $consulta= "select * from historialclinico WHERE  orden=".$_GET["orde"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
     
        $id_historia=$fila['id_historia'];
        $idpa=$fila['id_paciente'];
        $motivo = $fila['Motivo'];
        $cancer = $fila['Cancer'];
        $diabetes = $fila['Diabetes'];
        $ataques = $fila['Ataques'];
        $hipertencion = $fila['Hipertencion1'];
        $emfermedades = $fila['Emfermedades1'];
        $tuberculosis = $fila['Tuberculosis'];
        $otras = $fila['Otras'];
        $especifique = $fila['Especifique'];
        $alcohol = $fila['Alcohol'];
        $tabaco = $fila['Tabaco'];
        $drogas = $fila['Drogas'];
        $cancer1 = $fila['Cancer1'];
        $ataques1 = $fila['Ataques1'];
        $diabetes1 = $fila['Diabetes1'];
        $hiper = $fila['Hipertencion'];
        $emfermedades1 = $fila['emfermedades'];
        $tuberculosis1 = $fila['Tuberculosis1'];
        $otras1 = $fila['Otras1'];
        $especifique1 = $fila['Especifique1'];
        $medicamentos = $fila['Medicamentos'];
        $alergias = $fila['Alergias'];
        $cuales1 = $fila['Cuales1'];
        $cuales2 = $fila['Cuales2'];
        $cuales3 = $fila['Cuales3'];
        
        $laboratorios = $fila['Laboratorios'];
        $cuales4 = $fila['Cuales4'];
        $cuales5 = $fila['Cuales5'];
        $cuales6 = $fila['Cuales6'];
        $otros = $fila['Otros'];
        $cuales7 = $fila['Cuales7'];
        $cuales8 = $fila['Cuales8'];
        $cuales9 = $fila['Cuales9'];
        $oo = $fila['orden'];
        $Fecha_registro = $fila['fecha_registro'];
}}
?>
 