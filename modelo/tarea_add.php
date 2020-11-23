<?php
require("conexion.php");
session_start();

$status = "";

            $u_1= $_POST["asunto"];
            $id_cli= $_POST["contacto"];
            if(isset($_POST["paciente"])){$id_pac= $_POST["paciente"];}else{$id_pac='';}
            $u_2= $_POST["fecha"];
            $u_22= $_POST["fecha2"];
            $u_3= $_POST["hora"];
            $u_33= $_POST["hora2"];
            $pri= $_POST["prioridad"];
            $u_4= $_POST["area"];
            $u_6= $_POST["usuario"];
            $u_7= $_POST["aviso"];
            $u_8= $_POST["desc"];
            $u_9= $_POST["estado"];
            $u_10= $_POST["relacionado"];
            $u_11= $_POST["con"];
            $u_12= 'Tarea';
            $user = $_SESSION['k_username'];
            $color='-5';
            $null ='';
           
            if(isset($_GET['empr'])){$id_empr =$_GET['empr'];}else{$id_empr='';}
            $fecha = $u_2;$fecha2 = $u_22;
            $ano = substr($fecha ,-4);
            $mes = substr($fecha,0,-8);
            $dia = substr($fecha ,3,-5);
            $date = $ano.'-'.$mes.'-'.$dia;
            
            $ano2 = substr($fecha2 ,-4);
            $mes2 = substr($fecha2,0,-8);
            $dia2 = substr($fecha2 ,3,-5);
            $date2 = $ano2.'-'.$mes2.'-'.$dia2;
            
            $registro = date("Y-m-d H:i:s");
//            $hora2 = date("H:i",$m=strtotime('+'.$_POST["duracion"].' minutes'));
            $fi = $date.' '.$u_3.':00';
            $ff = $date2.' '.$u_33.':00';

        if(isset($_GET['editar'])){
            
                $sql = "UPDATE `actividades` SET `id_contacto` = '".$id_cli."',`Subject` = '".$u_1."', `Description` = '".$u_8."', `StartTime` = '".$fi."', `EndTime` = '".$ff."', `IsAllDayEvent` = '".$null."', `Color` = '".$u_10."', `RecurringRule` = '".$u_11."', `estado` = '".$u_9."', `prioridad` = '".$pri."', `relacionado` = '".$u_10."', `id_seleccionado` = '".$u_11."', `user` = '".$u_6."', `area_act` = '".$u_4."', `aviso` = '".$u_7."', `mod_user` = '".$user."' WHERE `Id` =  ".$_GET["editar"]."  and user='".$_SESSION['k_username']."';";
  
             mysql_query($sql, $conexion);
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente");location.href="../vistas/?id=ver_tarea&cod='.$_GET['editar'].'"</script>'; 
        }else{



            $sql = "INSERT INTO `actividades` (`id_paciente`,`id_contacto`, `Subject`, `Description`, `StartTime`, `EndTime`, `IsAllDayEvent`, `Color`, `estado`, `prioridad`, `relacionado`, `id_seleccionado`, `user`, `tarea`, `area_act`, `aviso`, `fecha_reg_ta`, `reg_user`, `mod_user`)";
            $sql.= "VALUES ('".$id_pac."','".$id_cli."', '".$u_1."', '".$u_8."', '".$fi."', '".$ff."', '".$null."', '".$color."', '".$u_9."', '".$pri."', '".$u_10."', '".$u_11."', '".$u_6."', '".$u_12."', '".$u_4."', '".$u_7."', '".$registro."', '".$user."', '".$user."');";
            mysql_query($sql, $conexion);

            $status = "ok";
            $sql1 = "SELECT MAX(Id) as id FROM actividades";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idll1 = $fila1["id"];


            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=ver_tarea&cod='.$idll1.'"</script>'; 
        }
?>
