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
                    date_default_timezone_set("America/Bogota" ) ; 
                    $hora = date('H:i:s',time() - 3600*date('I'));
                    $ced = $_GET['ced'];
                    $nom = trim($_GET['nom']);
                    $no2 = trim($_GET['no2']);
                    $ape = trim($_GET['ape']);
                    $ap2 = trim($_GET['ap2']);
                    $dir = trim($_GET['dir']);
                    $bar = $_GET['bar'];
                    $mun = $_GET['mun'];
                    $dep = $_GET['dep'];
                    $tel = $_GET['tel'];
                    $cel = $_GET['cel'];
                    $fam = $_GET['fam'];
                    $tfa = $_GET['tfa'];
                    $fin = $_GET['fin'];
                    $fde = $_GET['fde'];
                    $emp = $_GET['emp'];
                    $est = $_GET['est'];
                    $depo = $_GET['depo'];
                    $sub = $_GET['sub'];
                    $enf = $_GET['enf'];
                    $obs = $_GET['obs'];
                    $fecha_modi      = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
                    $cons= "SELECT * FROM `departamentos` where id='".$mun."' ";
                    $res=  mysql_query($cons);
                    $g = mysql_fetch_array($res);
                    $muni = $g['cod_mun'];
                    

                    $comprobar = mysql_num_rows(mysql_query("SELECT * FROM pacientes WHERE numero_doc = '".$ced."'"));
                    if($comprobar == 0){
                    $ok = mysql_query("INSERT INTO pacientes "
                            . "(`barrio`,`fecha_mod`,`fecha_reg`,`documento`,"
                            . " `numero_doc`,"
                            . "`nombres`,"
                            . "`nombre2`,"
                            . "`apellidos`,"
                            . "`apellido2`,"
                            . " `direccion1`,"
                            . " `departamento`,"
                            . " `municipio`,"
                            . " `tel_1`,"
                            . " `celular`,"
                            . " `nombre_acudiente`,"
                            . " `telefono_acudiente`,"
                            . "`id_empresa`,"
                            . "`estado`,"
                            . "`deposito_alq`,"
                            . "`subcodigo`,"
                            . "`enfermedad`,"
                            . "`descripcion_enf`)"
                            . "VALUES('$bar','$fecha_modi','$fecha_modi','CC','$ced','$nom','$no2','$ape','$ap2','$dir',"
                            . "'$dep','$muni','$tel','$cel','$fam','$tfa','$emp','$est','$depo','$sub','$enf','$obs') ") or die(mysql_error());
                    echo $ok;
                    
                    }
            break;
        case 1:
            date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
                    $ced = $_GET['ced'];
                    $nom = trim($_GET['nom']);
                    $no2 = trim($_GET['no2']);
                    $ape = trim($_GET['ape']);
                    $ap2 = trim($_GET['ap2']);
                    $dir = trim($_GET['dir']);
                    $bar = $_GET['bar'];
                    $mun = $_GET['mun'];
                    $dep = $_GET['dep'];
                    $tel = $_GET['tel'];
                    $cel = $_GET['cel'];
                    $fam = $_GET['fam'];
                    $tfa = $_GET['tfa'];
                    $fin = $_GET['fin'];
                    $fde = $_GET['fde'];
                    $emp = $_GET['emp'];
                    $est = $_GET['est'];
                    $depo = $_GET['depo'];
                    $sub = $_GET['sub'];
                    $enf = $_GET['enf'];
                    $obs = $_GET['obs'];
        
                    $fecha_modi      = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
                    $cons= "SELECT * FROM `departamentos` where id='".$mun."' ";
                    $res=  mysql_query($cons);
                    $g = mysql_fetch_array($res);
                    $muni = $g['cod_mun'];

                    $ok = mysql_query("update pacientes set  nombres='".$nom."' ,"
                            . "fecha_mod='".$fecha_modi."',"
                            . "nombre2='".$no2."',"
                            . "apellidos='".$ape."',"
                            . "apellido2='".$ap2."',"
                            . "direccion1='".$dir."',"
                            . "departamento='".$dep."',"
                            . "municipio='".$muni."',"
                            . "tel_1='".$tel."',"
                            . "celular='".$cel."',"
                            . "nombre_acudiente='".$fam."',"
                            . "telefono_acudiente='".$tfa."',"
                            . "id_empresa='".$emp."',"
                            . "estado='".$est."',"
                            . "deposito_alq='".$depo."',"
                            . "subcodigo='".$sub."',"
                            . "barrio='".$bar."',"
                            . "enfermedad='".$enf."',"
                            . "descripcion_enf='".$obs."' where numero_doc='".$ced."' ");
                    mysql_error();
                    echo $ok+1;
           break;
        case 2:
                   include 'mostrar_tabla.php';
           break;
        case 3:
                    $cod = $_GET['codigo'];
                    $resultado = mysql_query("DELETE FROM contactos WHERE nitcc ='".$cod."' ");
                    echo $resultado;
        break;
        case 4:
            date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
        function edad($edad){
       list($anio,$mes,$dia) = explode("-",$edad);
       $anio_dif = date("Y") - $anio;
       $mes_dif = date("m") - $mes;
       $dia_dif = date("d") - $dia;
       if ($dia_dif < 0 || $mes_dif < 0)
       $anio_dif--;
       return $anio_dif +1;
       }
                   $vr=$_GET['naci'];
                    $edad = edad($vr);
                    $ced = $_GET['ced'];
                    $nom = trim($_GET['nom']);
                    $no2 = trim($_GET['no2']);
                    $ape = trim($_GET['ape']);
                    $ap2 = trim($_GET['ap2']);
                    $dir = trim($_GET['dir']);
                    $mun = $_GET['mun'];
                    $dep = $_GET['dep'];
                    $tel = $_GET['tel'];
                    $cel = $_GET['cel'];
                    $fam = $_GET['fam'];
                    $tfa = $_GET['tfa'];
                    $fin = $_GET['fin'];
                    $fde = $_GET['fde'];
                    $emp = $_GET['emp'];
                    $est = $_GET['est'];
                    $depo = $_GET['depo'];
                    $sub = $_GET['sub'];
                    $enf = $_GET['enf'];
                    $obs = $_GET['obs'];
                    $alta = $_GET['alta'];
                    $doc = $_GET['doc'];
                    $regi = $_GET['regi'];
                    $tipo = $_GET['tipo'];
                    $sexo = $_GET['sexo'];
                    $naci = $_GET['naci'];
                    $civi = $_GET['civi'];
                    $ocup = $_GET['ocup'];
                    $bar = $_GET['bar'];
                    $email = $_GET['email'];
                    $pare = $_GET['pare'];
                    $aco2 = $_GET['aco2'];
                    $tela = $_GET['tela'];
                    $par2 = $_GET['par2'];
                    $enf2 = $_GET['enf2'];
                    $obs2 = $_GET['obs2'];
                    $prof = $_GET['prof'];
                    $zona = $_GET['zona'];
                     $cont = $_GET['cont'];
                     $cov = $_GET['cov'];
                     $obscov = $_GET['obscov'];
                    $cons= "SELECT * FROM `departamentos` where id='".$mun."' ";
                    $res=  mysql_query($cons);
                    $g = mysql_fetch_array($res);
                    $muni = $g['cod_mun'];
                    $fecha_modi      = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];

                    $comprobar = mysql_num_rows(mysql_query("SELECT * FROM pacientes WHERE numero_doc = '".$ced."'"));
                    if($comprobar == 0){
                    $ok = mysql_query("INSERT INTO pacientes "
                            . "(`contracto`, `fecha_reg`,`fecha_mod`,`documento`,"
                            . " `numero_doc`,"
                            . "`nombres`,"
                            . "`nombre2`,"
                            . "`apellidos`,"
                            . "`apellido2`,"
                            . " `direccion1`,"
                            . " `departamento`,"
                            . " `municipio`,"
                            . " `tel_1`,"
                            . " `celular`,"
                            . " `nombre_acudiente`,"
                            . " `telefono_acudiente`,"
                            . "`id_empresa`,"
                            . "`estado`,"
                            . "`deposito_alq`,"
                            . "`subcodigo`,"
                            . "`enfermedad`,"
                            . "`regimen`,"
                            . "`tipo_s`,"
                            . "`sexo`,"
                            . "`fecha_nacimiento`,"
                            . "`civil`,"
                            . "`ocupacion`,"
                            . "`cedula_acudiente`,"
                            . "`dir_pariente`,"
                            . "`parentesco2`,"
                            . "`parentesco`,"
                            . "`diagnostico2`,"
                            . "`descripcion_diag2`,"
                            . "`tel_empresa`,"
                            . "`barrio`,"
                            . "`email1`,"
                             . "`alta`,"
                             . "`edad`,"
                             . "`zona`,"
                            . "`descripcion_enf`,`covid`,`obscovid`)"
                            . "VALUES('$cont','$fecha_modi','$fecha_modi','$doc','$ced','$nom','$no2','$ape','$ap2','$dir',"
                            . "'$dep','$muni','$tel','$cel','$fam','$tfa','$emp','$est','$depo','$sub','$enf',"
                            . "'$regi','$tipo','$sexo','$naci','$civi','$ocup','$aco2','$tela','$par2','$pare','$enf2','$obs2','$prof','$bar','$email','$alta','$edad','$zona','$obs','$cov','$obscov') ") or die(mysql_error());
                    echo $ok;
                    
                    }
            break;
        case 5:
            date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
        function edad($edad){
       list($anio,$mes,$dia) = explode("-",$edad);
       $anio_dif = date("Y") - $anio;
       $mes_dif = date("m") - $mes;
       $dia_dif = date("d") - $dia;
       if ($dia_dif < 0 || $mes_dif < 0)
       $anio_dif--;
       return $anio_dif +1;
       }
          $vr=$_GET['naci'];
        $edad = edad($vr);
                    $zona = $_GET['zona'];
                    $ced = $_GET['ced'];
                    $nom = $_GET['nom'];
                    $no2 = $_GET['no2'];
                    $ape = $_GET['ape'];
                    $ap2 = $_GET['ap2'];
                    $dir = $_GET['dir'];
                    $mun = $_GET['mun'];
                    $dep = $_GET['dep'];
                    $tel = $_GET['tel'];
                    $cel = $_GET['cel'];
                    $fam = $_GET['fam'];
                    $tfa = $_GET['tfa'];
                    $fin = $_GET['fin'];
                    $fde = $_GET['fde'];
                    $emp = $_GET['emp'];
                    $est = $_GET['est'];
                    $depo = $_GET['depo'];
                    $sub = $_GET['sub'];
                    $enf = $_GET['enf'];
                    $obs = $_GET['obs'];
                    $alta = $_GET['alta'];
                    $doc = $_GET['doc'];
                    $regi = $_GET['regi'];
                    $tipo = $_GET['tipo'];
                    $sexo = $_GET['sexo'];
                    $naci = $_GET['naci'];
                    $civi = $_GET['civi'];
                    $ocup = $_GET['ocup'];
                    $bar = $_GET['bar'];
                    $email = $_GET['email'];
                    $pare = $_GET['pare'];
                    $aco2 = $_GET['aco2'];
                    $tela = $_GET['tela'];
                    $par2 = $_GET['par2'];
                    $enf2 = $_GET['enf2'];
                    $obs2 = $_GET['obs2'];
                    $prof = $_GET['prof'];
                     $cont = $_GET['cont'];
                     $cov = $_GET['cov'];
                     $obscov = $_GET['obscov'];
                    $cons= "SELECT * FROM `departamentos` where id='".$mun."' ";
                    $res=  mysql_query($cons);
                    $g = mysql_fetch_array($res);
                    $muni = $g['cod_mun'];
                     $fecha_modi      = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        
                    $ok = mysql_query("update pacientes set nombres='".$nom."' ,"
                            . "contracto='".$cont."',"
                            . "documento='".$doc."',"
                            . "nombre2='".$no2."',"
                            . "fecha_mod='".$fecha_modi."',"
                            . "apellidos='".$ape."',"
                            . "apellido2='".$ap2."',"
                            . "direccion1='".$dir."',"
                            . "edad='".$edad."',"
                            . "departamento='".$dep."',"
                            . "municipio='".$muni."',"
                            . "tel_1='".$tel."',"
                            . "celular='".$cel."',"
                            . "nombre_acudiente='".$fam."',"
                            . "telefono_acudiente='".$tfa."',"
                            . "id_empresa='".$emp."',"
                            . "estado='".$est."',"
                            . "deposito_alq='".$depo."',"
                            . "subcodigo='".$sub."',"
                            . "enfermedad='".$enf."',"
                            . "descripcion_enf='".$obs."',"
                            . "regimen='".$regi."',"
                            . "tipo_s='".$tipo."',"
                            . "sexo='".$sexo."',"
                            . "fecha_nacimiento='".$naci."',"
                            . "civil='".$civi."',"
                            . "ocupacion='".$ocup."',"
                            . "barrio='".$bar."',"
                            . "email1='".$email."',"
                            . "nombre_acudiente='".$fam."',"
                            . "telefono_acudiente='".$tfa."',"
                            . "cedula_acudiente='".$aco2."',"
                            . "dir_pariente='".$tela."',"
                            . "parentesco='".$pare."',"
                            . "parentesco2='".$par2."',"
                            . "diagnostico2='".$enf2."',"
                            . "descripcion_diag2='".$obs2."',"
                            . "zona='".$zona."',"
                            . "tel_empresa='".$prof."',"
                            . "covid='".$cov."',"
                            . "obscovid='".$obscov."'"
                            . " where numero_doc='".$ced."' ") or die(mysql_error());
     
                    echo $ok+1;
           break;
        case 6:
                    $prof = $_GET['prof'];
                    $ced = $_GET['ced'];
                    $con1 = $_GET['con1'];
                    $obs1 = $_GET['obs1'];
                    $con2 = $_GET['con2'];
                    $obs2 = $_GET['obs2'];
                    $con3 = $_GET['con3'];
                    $obs3 = $_GET['obs3'];
                    $con5 = $_GET['con5'];
                    $obs5 = $_GET['obs5'];
                    $con6 = $_GET['con6'];
                    $obs6 = $_GET['obs6'];
                    $con7 = $_GET['con7'];
                    $obs7 = $_GET['obs7'];
                    $con8 = $_GET['con8'];
                    $obs8 = $_GET['obs8'];
                    $con9 = $_GET['con9'];
                    $obs9 = $_GET['obs9'];
                    $con4 = $_GET['con4'];
                    $obs4 = $_GET['obs4'];
                    $con10 = $_GET['con10'];
                    $obs10 = $_GET['obs10'];
                    $con11 = $_GET['con11'];
                    $obs11 = $_GET['obs11'];
                     $idcon = $_GET['idcon'];
                     if($idcon==''){
                        $ver =  mysql_query("INSERT INTO `pacientes_condiciones` (`cedula`, `profesional`, `cond1`, `obs1`, `cond2`, `obs2`, `cond3`, `obs3`, `cond4`, `obs4`, `cond5`, `obs5`, `cond6`, `obs6`, `cond7`, `obs7`, `cond8`, `obs8`, `cond9`, `obs9`, `cond10`, `obs10`, `cond11`, `obs11`) "
                                 . "VALUES ('$ced', '$prof', '$con1', '$obs1', '$con2', '$obs2', '$con3', '$obs3', '$con4', '$obs4', '$con5', '$obs5', '$con6', '$obs6', '$con7', '$obs7', '$con8', '$obs8', '$con9', '$obs9', '$con10', '$obs10', '$con11', '$obs11');");
//                         $quer = mysql_query("select max(id_condicion) from pacientes_condiciones");
//                         $r = mysql_fetch_row($quer);
                         echo $id = mysql_insert_id();
                     }else{
                         
                         $ver = mysql_query("UPDATE `pacientes_condiciones` SET `profesional` = '$prof', `cond1` = '$con1', `obs1` = '$obs1', `cond2` = '$con2', `obs2` = '$obs2', `cond3` = '$con3', `obs3` = '$obs3', `cond4` = '$con4', `obs4` = '$obs4', `cond5` = '$con5', `obs5` = '$obs5', `cond6` = '$con6', `obs6` = '$obs6', `cond7` = '$con7', `obs7` = '$obs7', `cond8` = '$con8', `obs8` = '$obs8', `cond9` = '$con9', `obs9` = '$obs9', `cond10` = '$con10', `obs10` = '$obs10', `cond11` = '$con11', `obs11` = '$obs11' WHERE `id_condicion` = '$idcon';") or die(mysql_error());
                         echo $id = $ver;
                     }
            
            break;
case 7:
    $ced = $_GET['ced'];
    $result = mysql_query("select * from pacientes_condiciones where cedula='$ced' ");
    $r = mysql_fetch_row($result);
    $p = array();
    $p[0] = $r[0];
    $p[1] = $r[1];
    $p[2] = $r[2];
    $p[3] = $r[3];
    $p[4] = $r[4];
    $p[5] = $r[5];
    $p[6] = $r[6];
    $p[7] = $r[7];
    $p[8] = $r[8];
    $p[9] = $r[9];
    $p[10] = $r[10];
    $p[11] = $r[11];
    $p[12] = $r[12];
    $p[13] = $r[13];
    $p[14] = $r[14];
    $p[15] = $r[15];
    $p[16] = $r[16];
    $p[17] = $r[17];
    $p[18] = $r[18];
    $p[19] = $r[19];
    $p[20] = $r[20];
    $p[21] = $r[21];
    $p[22] = $r[22];
    $p[23] = $r[23];
    $p[24] = $r[24];
    $p[25] = $r[25];
    echo json_encode($p);
    
    
    
    break;
 case 8:
                
                    $ced = $_GET['ced'];

                    $enc1 = $_GET['enc1'];
                    $enc2 = $_GET['enc2'];
                    $enc3 = $_GET['enc3'];
                    $enc4 = $_GET['enc4'];
                    $enc5 = $_GET['enc5'];
                    $enc6 = $_GET['enc6'];
                    $enc7 = $_GET['enc7'];
                    $enc8 = $_GET['enc8'];
                    $enc9 = $_GET['enc9'];
                    $enc10 = $_GET['enc10'];
                    $enc11 = $_GET['enc11'];
                    $enc12 = $_GET['enc12'];
                    $enc13 = $_GET['enc13'];
                    $enc14 = $_GET['enc14'];
                    $enc15 = $_GET['enc15'];
                    $enc16 = $_GET['enc16'];
                    $enc17 = $_GET['enc17'];
                    $enc18 = $_GET['enc18'];
                    $enc19 = $_GET['enc19'];
                    $enc20 = $_GET['enc20'];
                    $enc21 = $_GET['enc21'];
                    $enc22 = $_GET['enc22'];
                    $enc23 = $_GET['enc23'];
                    
                     $idcon = $_GET['idenc'];
                     if($idcon==''){
                        $ver =  mysql_query("INSERT INTO `encuestas` (`cedula`, `enc1`, `enc2`, `enc3`, `enc4`, `enc5`, `enc6`, `enc7`, `enc8`, `enc9`, `enc10`, `enc11`, `enc12`, `enc13`, `enc14`, `enc15`, `enc16`, `enc17`, `enc18`, `fechareg`, `por`, `enc19`, `enc20`, `enc21`, `enc22`, `enc23`) "
                                 . "VALUES ('$ced', '$enc1', '$enc2', '$enc3', '$enc4', '$enc5', '$enc6', '$enc7', '$enc8', '$enc9', '$enc10', '$enc11', '$enc12', '$enc13', '$enc14', '$enc15', '$enc16', '$enc17', '$enc18', '".date("Y-m-d H:i:s")."', '".$_SESSION['k_username']."', '$enc19', '$enc20', '$enc21', '$enc22', '$enc23');") or die(mysql_error());

                         $id = mysql_insert_id();
                         $error = $ver;
                     }else{
                         
                         $ver = mysql_query("UPDATE `encuestas` SET `enc1` = '$enc1', `enc2` = '$enc2', `enc3` = '$enc3', `enc4` = '$enc4', `enc5` = '$enc5', `enc6` = '$enc6', `enc7` = '$enc7', `enc8` = '$enc8', `enc9` = '$enc9', `enc10` = '$enc10', `enc11` = '$enc11', `enc12` = '$enc12', `enc13` = '$enc13', `enc14` = '$enc14', `enc15` = '$enc15', `enc16` = '$enc16', `enc17` = '$enc17', `enc18` = '$enc18', `enc19` = '$enc19', `enc20` = '$enc20', `enc21` = '$enc21', `enc22` = '$enc22', `enc23` = '$enc23' WHERE `id_encuesta` = '$idcon';") or die(mysql_error());
                         $id = $idcon;
                         $error = $ver;
                     }
                     $p = array();
                     $p[0] = $id;
                     $p[1] = $error;
                     echo json_encode($p);
            
            break;
case 9:
    $ced = $_GET['ced'];
    $result = mysql_query("select * from encuestas where cedula='$ced' ");
    $r = mysql_fetch_row($result);
    $p = array();
    $p[0] = $r[0];
    $p[1] = $r[1];
    $p[2] = $r[2];
    $p[3] = $r[3];
    $p[4] = $r[4];
    $p[5] = $r[5];
    $p[6] = $r[6];
    $p[7] = $r[7];
    $p[8] = $r[8];
    $p[9] = $r[9];
    $p[10] = $r[10];
    $p[11] = $r[11];
    $p[12] = $r[12];
    $p[13] = $r[13];
    $p[14] = $r[14];
    $p[15] = $r[15];
    $p[16] = $r[16];
    $p[17] = $r[17];
    $p[18] = $r[18];
    $p[19] = $r[19];
    $p[20] = $r[20];
    $p[21] = $r[21];
    $p[22] = $r[22];
    $p[23] = $r[23];
    $p[24] = $r[24];
    $p[25] = $r[25];
    $p[26] = $r[26];

    echo json_encode($p);
    
    
    
    break;
}
}else{
    echo 'x';
}
?>