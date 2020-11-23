<?php
include('../../modelo/conexion.php');
session_start();
// sw = 
// 0 Insertar
// 1 Actualizar
// 2 Mostrar
// 3 Eliminar
if(isset($_SESSION['k_username'])){
switch ($_GET['sw']) {
        case 0:
                    $ord = $_GET['ord'];
                    $pro = $_GET['pro'];
                    $ate = $_GET['ate'];
                    $can = $_GET['can'];
                    $pen = $_GET['pen'];
                    $und = $_GET['und'];
                    $liq = $_GET['liq'];
                    $obs = $_GET['obs'];
                    $fi = $_GET['fi'];
                    $ff = $_GET['ff'];
                    $tot = $can * $und;
                    $hoy = date("Y-m-d");

                    $ok = mysql_query("INSERT INTO liquidaciones "
                            . "(`orden`,`usuario`,`atencion`,`cantidad`,"
                            . " `valor`,"
                            . "`total`,"
                            . "`tipo`,"
                            . "`observacion`,"
                            . "`fechain`,"
                            . " `fechafi`,"
                            . " `pendientes`,`fecha_registro`)"
                            . "VALUES('$ord','$pro','$ate','$can','$und','$tot','$liq','$obs','$fi',"
                            . "'$ff','$pen','$hoy') ") or die(mysql_error());
                    
                    $max = mysql_query("select max(id_liq) from liquidaciones");
                    $m = mysql_fetch_array($max);
                    
                    mysql_query("update actividad set id_liq='$m[0]', pendientes='$pen' where orden_servicio='$ord' ");
                    
                    echo $ok;
                    
                  
            break;
            case 1:
                
            break;
}
}else{
    echo 'x';
}
?>