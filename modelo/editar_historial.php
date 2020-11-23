<?php
session_start();
include "../modelo/conexion.php";
$status = "";
if (isset($_GET['paciente'])){
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
       
       $sql = "UPDATE `historialclinico` SET `Cancer1` = '".$Cancer1."', `Diabetes1` = '".$Diabetes1."', `Ataques1` = '".$Ataques1."', `Hipertencion1` = '".$Hipertencion1."', `Emfermedades1` = '".$Emfermedades1."', `Tuberculosis1` = '".$Tuberculosis1."', `Otras1` = '".$Otras."', `Especifique1` = '".$Especifique."', `Alcohol` = '".$Alcohol."', `Tabaco` = '".$Tabaco."', `Drogas` = '".$Drogas."', `Cancer` = '".$Cancer."', `Ataques` = '".$Ataques."', `Diabetes` = '".$Diabetes."', `Hipertencion` = '".$Hipertencion."', `emfermedades` = '".$Emfermedades."', `Tuberculosis` = '".$Tuberculosis."', `Otras` = '".$Otras1."', `Especifique` = '".$Especifique1."', `Medicamentos` = '".$Medicamentos."', `Alergias` = '".$Alergias."', `Cuales1` = '".$Cuales1."', `Cuales2` = '".$Cuales2."', `Cuales3` = '".$Cuales3."', `Laboratorios` = '".$Laboratorios."', `Cuales4` = '".$Cuales4."', `Cuales5` = '".$Cuales5."', `Cuales6` = '".$Cuales6."', `Otros` = '".$Otros."', `Cuales7` = '".$Cuales7."', `Cuales8` = '".$Cuales8."', `Cuales9` = '".$Cuales9."' WHERE `ORDEN`='".$_GET['paciente']."';";
      
       mysql_query($sql);
       $status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=mostrar_historial&cod=".$_POST["paciente"]."'";
     
        echo "</script>";
    }
    ?>