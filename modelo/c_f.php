<?php
session_start();
include "../modelo/conexion.php";
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

	
	$factura = $_POST["factura"];
        
        $orden_int = $_POST["orden_int"];
        
        $forma_pago = $_POST["forma_pago"];
        $meses = $_POST["meses"];
        if(isset($_POST["pendiente"])){$pago_pendiente = $_POST["pendiente"];}else{$pago_pendiente = 'No';}
        $total = $_POST["total"];
        $info = $_POST["info"];
        $fi = $_POST["fechai"];
        $ff = $_POST["fechaf"];
        $fr = $_POST["fechar"];
        $cp = $_POST["copagos"];
                       $numero = $_POST["total"]-$_POST["copagos"]; 
$cambio = valorEnLetras($numero); 






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

elseif ($u==51) {$ru = "Cincuenta y un ";} 
elseif ($u==52) {$ru = "Cincuenta y dos ";} 
elseif ($u==53) {$ru = "Cincuenta y tres ";} 
elseif ($u==54) {$ru = "Cincuenta y cuatro ";} 
elseif ($u==55) {$ru = "Cincuenta y cinco ";} 
elseif ($u==56) {$ru = "Cincuenta y seis ";} 
elseif ($u==57) {$ru = "Cincuenta y siete ";} 
elseif ($u==58) {$ru = "Cincuenta y ocho ";} 
elseif ($u==59) {$ru = "Cincuenta y nueve ";} 
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

elseif ($u==71) {$ru = "Setenta y un ";} 
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
      //if($factura<3000){
      //       $sql = "UPDATE `recibo_caja` SET `saldo`='".$numero."',`letras`='".$cambio."', `copagos`='".$cp."',`forma_pago`='".$forma_pago."',`meses`='".$meses."',`pago_pendiente`='".$pago_pendiente."',`total`='".$total."',`informacion`='".$info."',`fechai`='".$fi."',`fechaf`='".$ff."',`fecha_registro`='".$fr."' WHERE  `numero_recibo`='".$factura."';";
     
      //}else{
             $sql = "UPDATE `facturas` SET `letras`='".$cambio."', `copagos`='".$cp."',`forma_pago`='".$forma_pago."',`meses`='".$meses."',`pago_pendiente`='".$pago_pendiente."',`total`='".$total."',`informacion`='".$info."',`fechai`='".$fi."',`fechaf`='".$ff."',`fecha_registro`='".$fr."' WHERE  `numero_factura`='".$factura."' and estado='';";
     
      //}
       mysql_query($sql);
       
            $consulta= "select * from actividad WHERE relacionado=".$factura." and factura='' ";                     
            $result=  mysql_query($consulta);
            while($fila=  mysql_fetch_array($result)){
            $oi=$fila['orden_servicio'];
                        $insu = "UPDATE `insumos_asignados` SET `facturado`='".$factura."' WHERE  `rel_atencion`='".$oi."' ";
                        mysql_query($insu);
                        $med = "UPDATE `medicamentos_asig` SET `facturado`='".$factura."' WHERE  `rel_atencion`='".$oi."' ";
                        mysql_query($med);
                       
                        $lab = "UPDATE `laboratorio_asig` SET `facturado`='".$factura."' WHERE  `rel_atencion`='".$oi."'";
                        mysql_query($lab);
                        $pro = "UPDATE `productos_vendidos` SET `facturado`='".$factura."' WHERE  `rel_atencion`='".$oi."'";
                        mysql_query($pro);      
            }
       
if($_POST['cambio']!=''){

             $consulta= "select * from actividad WHERE relacionado=".$factura." and factura='OLD' ";                     
            $result=  mysql_query($consulta);
            while($fila=  mysql_fetch_array($result)){
            $oi=$fila['orden_servicio'];
                  if($_POST['cambio']!=''){
if($_POST['cambio']==0){
    $c = '';
                        $sqlr = "UPDATE `actividad` SET `prioridad`='activa', relacionado='".$c."' WHERE `orden_servicio`='".$oi."';";
                        mysql_query($sqlr);
                        
                        $insu = "UPDATE `insumos_asignados` SET `facturado`='".$c."' WHERE  `rel_atencion`='".$oi."'";
                        mysql_query($insu);
                        $med = "UPDATE `medicamentos_asig` SET `facturado`='".$c."' WHERE  `rel_atencion`='".$oi."'";
                        mysql_query($med);
                       
                        $lab = "UPDATE `laboratorio_asig` SET `facturado`='".$c."' WHERE  `rel_atencion`='".$oi."'";
                        mysql_query($lab);
                        $pro = "UPDATE `productos_vendidos` SET `facturado`='".$c."' WHERE  `rel_atencion`='".$oi."'";
                        mysql_query($pro);    
                        
                        $sqlf = "UPDATE `facturas` SET `numero_factura`='".$c."' WHERE  `numero_factura`='".$factura."';";
                        mysql_query($sqlf);
                        }else{
                        $c = $_POST['cambio'];
                        $sqlr = "UPDATE `actividad` SET `prioridad`='Facturado', relacionado='".$c."', factura='' WHERE `orden_servicio`='".$oi."';";
                        mysql_query($sqlr);
                        
                        $insu = "UPDATE `insumos_asignados` SET `facturado`='".$c."' WHERE  `rel_atencion`='".$oi."'  ";
                        mysql_query($insu);
                        $med = "UPDATE `medicamentos_asig` SET `facturado`='".$c."' WHERE  `rel_atencion`='".$oi."'";
                        mysql_query($med);
                       
                        $lab = "UPDATE `laboratorio_asig` SET `facturado`='".$c."' WHERE  `rel_atencion`='".$oi."'";
                        mysql_query($lab);
                        $pro = "UPDATE `productos_vendidos` SET `facturado`='".$c."' WHERE  `rel_atencion`='".$oi."'";
                        mysql_query($pro);    
                        
                        $sqlf = "UPDATE `facturas` SET `numero_factura`='".$c."', estado='' WHERE  `numero_factura`='".$factura."';";
                        mysql_query($sqlf);
}
            }
      if($_POST['cambio']==0){
    echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=facturas'";
        echo "</script>";  
}else{
      echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=facturacion_finalizada&fact=".$_POST['cambio']."&t=".$_GET['t']." '";
        echo "</script>";  
}
       
}}
//     if($factura<3000){   
//       $a2 = '<a href="../vistas/?id=facturacion_finalizada&fact='.$factura.'">Factura # '.$factura.'</a>';
//         $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`) ";
//            $sqlr.= "VALUES ('Se modifico la factura', '".$a2."', '".$_SESSION['k_username']."')";
//            mysql_query($sqlr, $conexion);
//            
//        echo "<script language='javascript' type='text/javascript'>";
//        echo "location.href='../vistas/?id=facturacion_autorizacion&fact=".$factura."'";
//        echo "</script>";
//     }else{
         $a2 = '<a href="../vistas/?id=facturacion_finalizada&fact='.$factura.'">Factura # '.$factura.'</a>';
         $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`) ";
            $sqlr.= "VALUES ('Se modifico la factura', '".$a2."', '".$_SESSION['k_username']."')";
            mysql_query($sqlr, $conexion);
            $t = $_GET['t'];
        echo "<script language='javascript' type='text/javascript'>";
         echo "location.href='../vistas/?id=facturas'";
        echo "</script>";
     //}
    ?>