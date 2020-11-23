<?php 
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I')); 
//print "&nbsp;$hora&nbsp;"; 
?>
<?php
session_start();
include "../modelo/conexion.php";
$status = "";

        
  if (isset($_GET["edit"])) {
	
        $Motivo = $_POST['Motivo'];
$Conciente= '';
$Somnoliento=  '';
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


       $sql = "UPDATE `motivo_consulta` SET `fisico` = '".$fisico."',`asunto` = '".$Motivo."', `conciente` = '".$Conciente."', `somnoliento` = '".$Somnoliento."', `fc` = '".$FC."', `ta` = '".$TA."', `fr` = '".$FR."', `pulso` = '".$PULSO."', `axilar` = '".$Axilar."', `peso` = '".$Actual."', `hallazgos` = '".$Motivo2."', `terapia` = '".$Motivo3."' WHERE `id_orden` = '".$orden."'";
       
       mysql_query($sql, $conexion);
       
         $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                  $sqlr.= "VALUES ('anamnesis modificada por ".$_SESSION['k_username']."  ', '".$_GET["edit"]."', '".$_SESSION['k_username']."', 'Atenciones')";
                  mysql_query($sqlr);
       $status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/mostrar_historial_1.php?cod=".$orden."&pac=".$_GET['pac']."'";
     
        echo "</script>";
    }
    ?>