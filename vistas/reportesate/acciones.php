<?php
include('../../modelo/conexion.php');
session_start();
function valorEnLetras($x) 
{ 
if ($x<0) { $signo = "menos ";} 
else      { $signo = "";} 
$x = abs ($x); 
$C1 = $x; 

$G6 = floor($x/(1000000));  // 7 y mas 

$E7 = floor($x/(100000)); 
$G7 = $E7-$G6*10;   // 6 

$E8 = floor($x/1000);  
$G8 = $E8-$E7*100;   // 5 y 4 

$E9 = floor($x/100); 
$G9 = $E9-$E8*10;  //  3 

$E10 = floor($x); 
$G10 = $E10-$E9*100;  // 2 y 1 


$G11 = round(($x-$E10)*100,0);  // Decimales 
////////////////////// 

$H6 = unidades($G6); 

if($G7==1 AND $G8==0) { $H7 = "Cien "; } 
else {    $H7 = decenas($G7); } 

$H8 = unidades($G8); 

if($G9==1 AND $G10==0) { $H9 = "Cien "; } 
else {    $H9 = decenas($G9); } 

$H10 = unidades($G10); 

if($G11 < 10) { $H11 = "0".$G11; } 
else { $H11 = $G11; } 

///////////////////////////// 
    if($G6==0) { $I6=" "; } 
elseif($G6==1) { $I6="Millon "; } 
         else { $I6="Millones "; } 
          
if ($G8==0 AND $G7==0) { $I8=" "; } 
         else { $I8="Mil "; } 
          
$I10 = "Pesos "; 
$I11 = "ML. "; 

$C3 = $signo.$H6.$I6.$H7.$H8.$I8.$H9.$H10.$I10.$I11; 

return $C3; //Retornar el resultado 

} 

function unidades($u) 
{ 
    if ($u==0)  {$ru = " ";} 
elseif ($u==1)  {$ru = "Un ";} 
elseif ($u==2)  {$ru = "Dos ";} 
elseif ($u==3)  {$ru = "Tres ";} 
elseif ($u==4)  {$ru = "Cuatro ";} 
elseif ($u==5)  {$ru = "Cinco ";} 
elseif ($u==6)  {$ru = "Seis ";} 
elseif ($u==7)  {$ru = "Siete ";} 
elseif ($u==8)  {$ru = "Ocho ";} 
elseif ($u==9)  {$ru = "Nueve ";} 
elseif ($u==10) {$ru = "Diez ";} 

elseif ($u==11) {$ru = "Once ";} 
elseif ($u==12) {$ru = "Doce ";} 
elseif ($u==13) {$ru = "Trece ";} 
elseif ($u==14) {$ru = "Catorce ";} 
elseif ($u==15) {$ru = "Quince ";} 
elseif ($u==16) {$ru = "Dieciseis ";} 
elseif ($u==17) {$ru = "Decisiete ";} 
elseif ($u==18) {$ru = "Dieciocho ";} 
elseif ($u==19) {$ru = "Diecinueve ";} 
elseif ($u==20) {$ru = "Veinte ";} 

elseif ($u==21) {$ru = "Veintiun ";} 
elseif ($u==22) {$ru = "Veintidos ";} 
elseif ($u==23) {$ru = "Veintitres ";} 
elseif ($u==24) {$ru = "Veinticuatro ";} 
elseif ($u==25) {$ru = "Veinticinco ";} 
elseif ($u==26) {$ru = "Veintiseis ";} 
elseif ($u==27) {$ru = "Veintisiente ";} 
elseif ($u==28) {$ru = "Veintiocho ";} 
elseif ($u==29) {$ru = "Veintinueve ";} 
elseif ($u==30) {$ru = "Treinta ";} 

elseif ($u==31) {$ru = "Treintayun ";} 
elseif ($u==32) {$ru = "Treintaydos ";} 
elseif ($u==33) {$ru = "Treintaytres ";} 
elseif ($u==34) {$ru = "Treintaycuatro ";} 
elseif ($u==35) {$ru = "Treintaycinco ";} 
elseif ($u==36) {$ru = "Treintayseis ";} 
elseif ($u==37) {$ru = "Treintaysiete ";} 
elseif ($u==38) {$ru = "Treintayocho ";} 
elseif ($u==39) {$ru = "Treintaynueve ";} 
elseif ($u==40) {$ru = "Cuarenta ";} 

elseif ($u==41) {$ru = "Cuarentayun ";} 
elseif ($u==42) {$ru = "Cuarentaydos ";} 
elseif ($u==43) {$ru = "Cuarentaytres ";} 
elseif ($u==44) {$ru = "Cuarentaycuatro ";} 
elseif ($u==45) {$ru = "Cuarentaycinco ";} 
elseif ($u==46) {$ru = "Cuarentayseis ";} 
elseif ($u==47) {$ru = "Cuarentaysiete ";} 
elseif ($u==48) {$ru = "Cuarentayocho ";} 
elseif ($u==49) {$ru = "Cuarentaynueve ";} 
elseif ($u==50) {$ru = "Cincuenta ";} 

elseif ($u==51) {$ru = "Cincuentayun ";} 
elseif ($u==52) {$ru = "Cincuentaydos ";} 
elseif ($u==53) {$ru = "Cincuentaytres ";} 
elseif ($u==54) {$ru = "Cincuentaycuatro ";} 
elseif ($u==55) {$ru = "Cincuentaycinco ";} 
elseif ($u==56) {$ru = "Cincuentayseis ";} 
elseif ($u==57) {$ru = "Cincuentaysiete ";} 
elseif ($u==58) {$ru = "Cincuentayocho ";} 
elseif ($u==59) {$ru = "Cincuentaynueve ";} 
elseif ($u==60) {$ru = "Sesenta ";} 

elseif ($u==61) {$ru = "Sesentayun ";} 
elseif ($u==62) {$ru = "Sesentaydos ";} 
elseif ($u==63) {$ru = "Sesentaytres ";} 
elseif ($u==64) {$ru = "Sesentaycuatro ";} 
elseif ($u==65) {$ru = "Sesentaycinco ";} 
elseif ($u==66) {$ru = "Sesentayseis ";} 
elseif ($u==67) {$ru = "Sesentaysiete ";} 
elseif ($u==68) {$ru = "Sesentayocho ";} 
elseif ($u==69) {$ru = "Sesentaynueve ";} 
elseif ($u==70) {$ru = "Setenta ";} 

elseif ($u==71) {$ru = "Setentayun ";} 
elseif ($u==72) {$ru = "Setentaydos ";} 
elseif ($u==73) {$ru = "Setentaytres ";} 
elseif ($u==74) {$ru = "Setentaycuatro ";} 
elseif ($u==75) {$ru = "Setentaycinco ";} 
elseif ($u==76) {$ru = "Setentayseis ";} 
elseif ($u==77) {$ru = "Setentaysiete ";} 
elseif ($u==78) {$ru = "Setentayocho ";} 
elseif ($u==79) {$ru = "Setentaynueve ";} 
elseif ($u==80) {$ru = "Ochenta ";} 

elseif ($u==81) {$ru = "Ochentayun ";} 
elseif ($u==82) {$ru = "Ochentaydos ";} 
elseif ($u==83) {$ru = "Ochentaytres ";} 
elseif ($u==84) {$ru = "Ochentaycuatro ";} 
elseif ($u==85) {$ru = "Ochentaycinco ";} 
elseif ($u==86) {$ru = "Ochentayseis ";} 
elseif ($u==87) {$ru = "Ochentaysiete ";} 
elseif ($u==88) {$ru = "Ochentayocho ";} 
elseif ($u==89) {$ru = "Ochentaynueve ";} 
elseif ($u==90) {$ru = "Noventa ";} 

elseif ($u==91) {$ru = "Noventayun ";} 
elseif ($u==92) {$ru = "Noventaydos ";} 
elseif ($u==93) {$ru = "Noventaytres ";} 
elseif ($u==94) {$ru = "Noventaycuatro ";} 
elseif ($u==95) {$ru = "Noventaycinco ";} 
elseif ($u==96) {$ru = "Noventayseis ";} 
elseif ($u==97) {$ru = "Noventaysiete ";} 
elseif ($u==98) {$ru = "Noventayocho ";} 
else            {$ru = "Noventaynueve ";} 
return $ru; //Retornar el resultado 
} 

function decenas($d) 
{ 
    if ($d==0)  {$rd = "";} 
elseif ($d==1)  {$rd = "Ciento ";} 
elseif ($d==2)  {$rd = "Doscientos ";} 
elseif ($d==3)  {$rd = "Trescientos ";} 
elseif ($d==4)  {$rd = "Cuatrocientos ";} 
elseif ($d==5)  {$rd = "Quinientos ";} 
elseif ($d==6)  {$rd = "Seiscientos ";} 
elseif ($d==7)  {$rd = "Setecientos ";} 
elseif ($d==8)  {$rd = "Ochocientos ";} 
else            {$rd = "Novecientos ";} 
return $rd; //Retornar el resultado 
}
switch ($_GET['sw']) {
        case 1:
                    $nombre = $_GET['nombre'];
                    $nit = $_GET['nit'];
                    $telefono_emp   = $_GET['tel'];
                    $rips    = $_GET['cod'];
                    $codigo    = $_GET['id'];
                    $cli    = $_GET['cli'];
                    $direccion_emp    = $_GET['dir'];
                    $email_emp1    = $_GET['ema'];
                    $con    = $_GET['con'];
                    $pc1    = $_GET['pc1'];
                    $pc2    = $_GET['pc2'];
                    $pc3    = $_GET['pc3'];
                    $ph1    = $_GET['ph1'];
                    $ph2    = $_GET['ph2'];
                    $ph3    = $_GET['ph3'];
                    $tp1    = $_GET['tp1'];
                    $tp2    = $_GET['tp2'];
                    $tp3    = $_GET['tp3'];
                 
                    if(($_GET['id'])!=''){
            
                 $sql = "UPDATE `sis_empresa` SET `rips`='".$rips."',"
                         . " `nombre_emp`='".$nombre."',"
                         . "`propietario_emp`='".$con."',"
                         . "`tel_oficina_emp`='".$telefono_emp."',"
                         . "`nit_emp`='".$nit."',"
                         . "`direccionr_emp`='".$direccion_emp."',"
                         . "`cliente`='".$cli."',"
                         . "`pc_1`='".$pc1."',"
                         . "`pc_2`='".$pc2."',"
                         . "`pc_3`='".$pc3."',"
                         . "`ph_1`='".$ph1."',"
                         . "`ph_2`='".$ph2."',"
                         . "`ph_3`='".$ph3."',"
                         . "`tp_1`='".$tp1."',"
                         . "`tp_2`='".$tp2."',"
                         . "`tp_3`='".$tp3."',"
                         . "`email1_emp`='".$email_emp1."',`fecha_modificacion`='".$fecha_registro."' WHERE `id_empresa` = '".$codigo."';";
       
             mysql_query($sql, $conexion);
             echo 'up'; 
        }else{

	$sql = "INSERT INTO `sis_empresa`(`cliente`,`rips`, `nombre_emp`, `propietario_emp`, `tel_oficina_emp`, `nit_emp`, `direccionr_emp`,  `email1_emp`,  `fecha_modificacion`, `fecha_registro`)";
        $sql.= "VALUES ('".$cli."','".$rips."', '".$nombre."', '".$con."', '".$telefono_emp."', '".$nit."', '".$direccion_emp."', 
                '".$email_emp1."', '".$fecha_registro."', '".$fecha_registro."')";
        $ok = mysql_query($sql, $conexion);

     
            $sql1 = "SELECT MAX(id_empresa) as id FROM sis_empresa";
            $fila1 =mysql_fetch_array(mysql_query($sql1));
            $idll1 = $fila1["id"];


            echo $ok; 
        }
           break;
        case 2:
                   include 'mostrar_tabla.php';
           break;
        case 3:
                    $cod = $_GET['codigo'];
                    $resultado = mysql_query("DELETE FROM sis_empresa WHERE id_empresa = '$cod' ") or die(mysql_error());
                    echo $resultado;
        break;
        case 4:
                    $cod = $_GET['id'];
                    $consulta= "select * from sis_empresa WHERE `id_empresa`=".$cod;
                    $result=  mysql_query($consulta);
                    $fila=  mysql_fetch_array($result);
                    $p = array();
                    $p[0]=  $fila['id_empresa']; 
                    $p[1]=$fila['nombre_emp'];
                    $p[2]=$fila['propietario_emp'];
                    $p[3]=$fila['tel_oficina_emp'];
                    $p[4]=$fila['celular_emp'];
                    $p[5]=$fila['nit_emp'];
                    $p[6]=$fila['departameto_emp'];
                    $p[7]=$fila['municipio_emp'];
                    $p[8]=$fila['direccionr_emp'];
                    $p[9]=$fila['direccione_emp'];
                    $p[10]=$fila['email1_emp'];
                    $p[11]=$fila['fecha_registro'];
                    $p[12]=$fila['fecha_modificacion'];
                    $p[13]=$fila['rips'];
                    $p[14]=$fila['cliente'];
                    $p[15]=$fila['pc_1'];
                    $p[16]=$fila['ph_1'];
                    $p[17]=$fila['tp_1'];
                    $p[18]=$fila['pc_2'];
                    $p[19]=$fila['ph_2'];
                    $p[20]=$fila['tp_2'];
                    $p[21]=$fila['pc_3'];
                    $p[22]=$fila['ph_3'];
                    $p[23]=$fila['tp_3'];
                    echo json_encode($p);
                    exit();
        break;
        case 5:
                    $cod = $_GET['id'];
                    mysql_query("update precios_atenciones set"
                            . " pagos='".$_GET['pago']."',"
                            . " precio='".$_GET['precio']."',"
                            . "por='".$_SESSION['k_username']."'"
                            . " where id_precio='".$cod."'  ");
         
        break;
            case 6:
                    $cod = $_GET['id'];
                    mysql_query("update precios_insumos set"
                            . " precio='".$_GET['precio']."',"
                            . "por='".$_SESSION['k_username']."'"
                            . " where id_precio='".$cod."'  ");
         
        break;
     case 7:
                    $cod = $_GET['id'];
                    mysql_query("update precios_medicina set"
                            . " precio='".$_GET['precio']."',"
                            . "por='".$_SESSION['k_username']."'"
                            . " where id_precio='".$cod."'  ");
         
        break;
         case 8:
                    $med = $_GET['med'];
                    $pre = $_GET['pre'];
                    $emp = $_GET['emp'];
                    $consulta= "select count(*) from precios_medicina WHERE `id_insumo`='".$med."' and `id_empresa`='".$emp."' ";
                    $result=  mysql_query($consulta);
                    $c = mysql_fetch_array($result);
                    
                    if($c[0]==0){
                      $sql = "INSERT INTO `precios_medicina`(`id_empresa`,`id_insumo`, `precio`, `por`)";
                      $sql.= "VALUES ('".$emp."','".$med."', '".$pre."', '".$_SESSION['k_username']."')";
                      echo $ok = mysql_query($sql, $conexion);
                    }else{
                        echo 'no';
                    }
                    
         
        break;
    case 9:
                    //C01BD01
                    $cod = $_GET['cod'];
                    $consulta= "select * from medicamentos WHERE `codigo`='".$cod."'";
                    $result=  mysql_query($consulta);
                    $r = ''; $co = ''; $no = '';
                    while($f=  mysql_fetch_array($result)){
                        $r = $r.'<option value="'.$f[0].'">'.$f[3].' - '.$f[4].'</option>';
                        $co = $f['codigo'];
                        $no = $f['nombre_medicamento'];
                    }
                    $p = array();
                    $p[0] = $r; 
                    $p[1] = $co;
                    $p[2] = $no;
                    echo json_encode($p);
                    exit();
        break;
            case 10:
                    //C01BD01
                    $cod = $_GET['cod'];
                    $consulta= "select * from laboratorio WHERE `cod_lab`='".$cod."'";
                    $result=  mysql_query($consulta);
                    $r = ''; $co = ''; $no = '';
                    while($f=  mysql_fetch_array($result)){
                        $r = $r.'<option value="'.$f[0].'">'.$f[1].' - '.$f[2].'</option>';
                        $co = $f['cod_lab'];
                        $no = $f['nombre_lab'];
                    }
                    $p = array();
                    $p[0] = $r; 
                    $p[1] = $co;
                    $p[2] = $no;
                    echo json_encode($p);
                    exit();
        break;
                 case 11:
                    $med = $_GET['med'];
                    $pre = $_GET['pre'];
                    $emp = $_GET['emp'];
                    $consulta= "select count(*) from precios_laboratorio WHERE `id_insumo`='".$med."' and `id_empresa`='".$emp."' ";
                    $result=  mysql_query($consulta);
                    $c = mysql_fetch_array($result);
                    
                    if($c[0]==0){
                      $sql = "INSERT INTO `precios_laboratorio`(`id_empresa`,`id_insumo`, `precio`, `por`)";
                      $sql.= "VALUES ('".$emp."','".$med."', '".$pre."', '".$_SESSION['k_username']."')";
                      $ok = mysql_query($sql, $conexion);
                      echo $ok;
                    }else{
                        echo 'no';
                    }
                    
         
        break;
        case 13:
                $sqlr = "UPDATE `actividad` SET `prioridad`='Facturado', relacionado='".$_GET['fact']."' WHERE `orden_servicio`='".$_GET["id"]."';";
                mysql_query($sqlr);
        break;
        case 14:
                 //buscamos el numero maximo de factura
                   $sql1 = "SELECT ultima as id_inc FROM mi_empresa";
                   $fila1 =mysql_fetch_array(mysql_query($sql1));
                   echo  $factura = $fila1["id_inc"]+1;
        break;
        case 15:
                  $total = $_GET['total'];
                  $copagos = $_GET['copago'];
                  $emp = $_GET['emp'];
                  $factura = $_GET['factura'];
                  
                  $fi = date("Y-m-d");
                  $fv = date("Y-m-d");
                  $forma_pago = '';
                  $meses = '1';
                  $pago_pendiente = 'No';  
                  $fecha_reg = date("Y-m-d");
                  $re = mysql_query("select sum(precio_total), sum(cuota_pagada) from actividad where relacionado='".$factura."' ");
                  $p = mysql_fetch_array($re);
                  $t = $p[0] - $p[1];
                  $cambio = valorEnLetras($t); 
                  $sql = "INSERT INTO `facturas`(`copagos`,`letras`,`fechai`, `fechaf`,`numero_factura`, `id_empresa`, `forma_pago`, `meses`, `pago_pendiente`, `total`, `fecha_registro`)";
                  $sql.= "VALUES ('".$p[1]."','".$cambio."','".$fi."', '".$fv."','".$factura."', '".$emp."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$t."', '".$fecha_reg."')";
	          mysql_query($sql);
                  
                  $sqlr = "UPDATE `mi_empresa` SET `ultima`='".$factura."'";
                  mysql_query($sqlr);
        break;
        case 16:
                $sqlr = "UPDATE `actividad` SET orden_externa='".$_GET['oe']."',precio_total='".$_GET['pr']."' WHERE `orden_servicio`='".$_GET["id"]."';";
                mysql_query($sqlr);
        break;
        case 17:
                $sqlr = "UPDATE `facturas` SET ult_rips='".$_GET['rip']."' WHERE `numero_factura`='".$_GET["fact"]."';";
               echo $ok = mysql_query($sqlr);
        break;
        case 18:
                $sqlr = "UPDATE `facturas` SET ult_rips='0' WHERE `numero_factura`='".$_GET["fact"]."';";
               echo $ok = mysql_query($sqlr);
        break;
}

?>