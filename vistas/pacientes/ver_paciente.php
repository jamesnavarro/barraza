<style>
    b{
        color: #000;
        font-family: "Times New Roman";
        font-size: 15px;
    }
</style>
<script type="text/javascript" language="javascript" src="../vistas/clientes/funciones.js?v=1.0"></script>
<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_paciente.php';


 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Informacion del Paciente</h4>
                                <button type="button" onclick="formulario_sub(<?php echo $numero_doc ?>,'<?php echo $empresar ?>')"><img src="../imagenes/modificar.png"> Editar</button>
                                <button type="button" onclick="consentimiento(<?php echo $_GET['cod'] ?>)"><img src="../imagenes/modificar.png"> Consentimiento Informado</button>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <table class="table table-bordered table-striped table-hover" >
                    <tr>
                        <td>
                            <strong>Nombre Del Contacto:</strong>
                        </td>
                        <td >
                            <?php  echo $nombre.' '. $nombre2.' '.$apellido.' '. $apellido2;  ?>
                        </td>
                        <td>
                            <strong> Esp. Que Ordena Tratamiento:</strong>
                        </td>
                        <td>
                            <?php  echo $tel_empresa;  ?>
                        </td>
                        
                    </tr>
                    <tr>
                        <td >
                            <strong>Empresa De Salud </strong>
                        </td>
                        <td>
                            <?php $sql1 = "SELECT * FROM sis_empresa where rips='".$empresar."'";
                            $fila1 =mysql_fetch_array(mysql_query($sql1));
                            $id_cliente = $fila1["id_empresa"];$nombre_cli = $fila1["nombre_emp"];
                            echo '<a href="../vistas/?id=ver_empresa&cod='.$id_cliente.'">'.$nombre_cli.'</a>';  ?>
                        </td>
                        <td>
                            <strong>Ocupacion :</strong>
                        </td>
                         <td>
                            <?php  echo $ocupacion;  ?>
                        </td>
                        
                    </tr>
                    <tr>
                        <td >
                            <strong>Documento :</strong>
                        </td>
                        <td>
                            <?php  echo $documento. ' '.$numero_doc;  ?>
                        </td>
                        <td>
                            <strong>Estado Civil :</strong>
                        </td>
                          <td>
                            <?php  echo $civil;  ?>
                        </td>
                         
                    </tr>
                    <tr>
                        <td >
                            <strong>Regimen :</strong>
                        </td>
                        <td >
                            <?php 
                            if($regimen==''){echo "Sin Asignar";}
                            if($regimen=='1'){echo "Contributivo";}
                            if($regimen=='2'){echo "Subsidiado";}
                            if($regimen=='3'){echo "Vinculado";}
                            if($regimen=='4'){echo "Particular";}
                            if($regimen=='5'){echo "Otro";}
                            if($regimen=='7'){echo "Plan Complementario";}
                            if($regimen=='8'){echo "Poliza";}
                            if($regimen=='9'){echo "Arl";}
                            if($regimen=='NO APLICA'){echo 'No Aplica';}
                            ?>
                        </td>
                        <td >
                            <strong>Tipo:</strong>
                        </td>
                        <td >
                            <?php  echo $tipo_s;  ?>
                        </td>
                    <tr>
                        <td>
                            <strong>Direccion Principal : </strong>
                        </td>
                        <td>
                            <?php  echo $dir1;  ?>
                        </td>
                         <td>
                            <strong>Zona: </strong>
                        </td>
                          <td>
                            <?php if($zona=='U'){echo "Urbano";}if($zona=='R'){echo "Rural";}  ?>
                          </td></tr>
                    <tr>
                        <td><strong>Barrio:</strong> </td>
                        <td> <?php ECHO '<font color="red">('.$barrio.')</font>';  ?></td>
                         <td><strong><?php echo $municipio;  ?></strong> </td>
                         <td> </td>
                    </tr>
                   
                    <tr>
                        <td>
                            <strong>Sexo :</strong>
                        </td>
                           <td >
                            <?php  echo $sexo;  ?>
                        </td>
                           <td >
                            <strong>Nombre Del Responsable :</strong>
                        </td>
                           <td>
                            <?php echo "$nombre_acu".' ('."$parentesco_acu"; ?>)
                        </td>
                       
                    </tr>
                     <tr>
                        <td>
                            <strong>Fecha De Nacimiento :</strong>
                        </td>
                           <td >
                            <?php  echo $fecha_n;  ?>
                        </td>
                           <td >
                            <strong>Telefono Del Responsable :</strong>
                        </td>
                           <td>
                            <?php  echo $telefono_acu;  ?>
                        </td>
                        
                     </tr><tr>
                         <td>
                            <strong>Tel Oficina : </strong>
                        </td>
                        <td>
                            <?php  echo $tel2;  ?>
                        </td>
                         <td>
                            <strong>Tel Residencia: </strong>
                        </td>
                        <td>
                            <?php  echo $tel1;  ?>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <strong>Edad :</strong>
                        </td>
                           <td >
                            <?php echo $edad; ?>
                        </td>
                           <td >
                            <strong>Nombre Del Acompañante:</strong>
                        </td>
                           <td>
                            <?php echo "$cedula_acu".' ('."$parentesco_acu2"; ?>)
                        </td>
                        
                    </tr>
                        <tr>
                        <td>
                            <strong>Remitido Por :</strong>
                        </td>
                           <td >
                            <?php  echo $empresa_la;  ?>
                        </td>
                           <td >
                            <strong>Telefono Acompañante :</strong>
                        </td>
                           <td>
                            <?php  echo $dir_pariente;  ?>
                        </td>
                       
                    </tr>
                        <tr>
                            <td>
                            <strong>Estado </strong>
                        </td>
                           <td >
                            <?php  echo $estado;  ?>
                               <?php 
                                    if (isset($idp)){
                                    $consulta2= "select * from historialclinico WHERE  id_paciente=".$idp."";
                                    $result2=  mysql_query($consulta2);
                                    while($fila=  mysql_fetch_array($result2)){
                                    $m=$fila['Motivo'];
                                    $id_hist=$fila['id_historia'];
                                    }}
                                ?>
                        </td>
                        <td>
                            <strong>Fecha De Modificacion:</strong>
                        </td>
                           <td >
                            <?php  echo $registro_mod;  ?>
                        </td>
                         
                        </tr>
                        <tr>
                         <td>
                            <strong>Email :</strong>
                        </td>
                        <td>
                            <?php  echo $ema2;  ?>
                        </td>
                        <td>
                            <strong>Celular :</strong>
                        </td>
                        <td>
                            <?php  echo $celular;  ?>
                        </td>
                       
                    </tr>
                        <tr>
                          <td >
                            <strong>Diagnostico Principal :</strong>
                        </td>
                           <td>
                            <?php  echo $enfermedad;  ?>
                        </td>
                           <td >
                            <strong>Descripcion Del Diagnostico Principal:</strong>
                        </td>
                           <td>
                            <font color="blue"><?php  echo $descripcion_enf;  ?></font>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <strong>Diagnostico 2 :</strong>
                        </td>
                        <td>
                            <?php  echo $diagnostico;  ?>
                        </td>
                         <td>
                            <strong>Descripcion Del Diagnostico:</strong>
                        </td>
                         <td>
                            <font color="blue"><?php  echo $descripcion_diag2;  ?></font>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <strong>Motivo De Desvinculacion Del Paciente: </strong>
                        </td>
                        <td>
                            <?php  echo $inf2;  ?>
                        </td>
                         <td>
                            <strong>SubCodigo Cryogas:</strong>
                        </td>
                        <td>
                             <font color="blue"><?php  echo $subcodigo;  ?></font>   
                        </td>
                    </tr>
                </table><br>
                                        
                                      
                                        <div class="span3">
                                            <ul class="arrow">
                                     
                                                <li><strong>Historial </strong>:</li><a href="../vistas/?id=mostrar_historial&cod=<?php echo $_GET["cod"]; ?>"><?php if (isset($id_hist)){ echo "$m";} ?></a>, aqui puede ver todos los procedimientos y atenciones que se le han realizado al paciente
                                
                                                
                                           
                                            </ul>
                                            
                                        </div>

                                     
                                     
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
<?php
// require_once '../vistas/alquiler/detalle_ordenes_alquiler.php';
if($acceso_alq=='Habilitado')       { ?>
  <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Alquileres del Paciente</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">  
                                        <form name="buscarA" action="../vistas/?id=ver_paciente&cod=<?php echo $_GET['cod']; ?>&codia=facturar" method="post" enctype="multipart/form-data">
<?php
include '../funciones/ver_alquileres.php';
?>
                                            </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
  <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Ventas del Paciente</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">  
                                        <table class="table table-bordered table-striped table-hover" id="">
                                            <thead BGCOLOR="#C3D9FF">
                                            <th>Orden Int</th>
                                            <th>Autorizacion</th>
                                            <th>fecha registro</th>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Factura</th>
                                            
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = mysql_query('SELECT * FROM facturas a, equipos_ventas b, productos c WHERE a.orden_int=b.numero_orden_a AND b.cod_equipo=c.codigo AND a.cod_alquiler="ventas" AND a.id_paciente="'.$_GET['cod'].'" ');
                                                while($r = mysql_fetch_array($result)){
                                                    echo '<tr>'
                                                    . '<td>'.$r['orden_int'].'</td>'
                                                            . '<td>'.$r['orden_ext'].'</td>'
                                                            . '<td>'.$r['fecha_registro'].'</td>'
                                                            . '<td>'.$r['nombre'].'</td>'
                                                            . '<td>'.$r['precio_a'].'</td>'
                                                            . '<td>'.$r['cantidad'].'</td>'
                                                            . '<td><a href="../vistas/?id=facturacion_v&fact='.$r['numero_factura'].'" target="_blank">'.$r['numero_factura'].'</a></td>';
                                                }
                                                
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    
                    <!--/ END List Styling -->
<?php }
 if(isset($_GET['cod'])){
     require '../vistas/pacientes/soporte.php';
     
//require '../vistas/pacientes/actividades.php';



 }
 ?>
       
                    <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                <div class="span12 widget dark stacked">
                   
                     <header>
                                <h4 class="title">Archivos Generados</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                    <a href='../vistas/?id=autorizacion&autorizar=<?php echo $idp ?>'><input type="button" name="cancelar" value="Generar Autorizacion"></a>
                        <hr>
                       <?php

include '../funciones/ordenes_pacientes.php'; 
$sql1 = "SELECT MAX(orden) as id FROM ordenes where id_paciente='".$idp."'";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idt1 = $fila1["id"];
       
?>
		</div>
                                    </div>
                           </section>
                    </div>
               <?php  
                             
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
if(isset($_GET['fact'])){
     if($_GET['fact']=='PARTICULARES'){
        include "../modelo/conexion.php";
$sql1 = "SELECT MAX(numero_recibo) as id_inc FROM recibo_caja";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$factura = $fila1["id_inc"]+1;

    if(isset($_POST["cant"]))
    {
        $n = $_POST["cant"];
        
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["valor$x"])){
                include "../modelo/conexion.php";
                $sqlr = "UPDATE `actividad` SET `prioridad`='Facturado', relacionado='".$factura."' WHERE `orden_servicio`='".$_POST["valor$x"]."';";
                mysql_query($sqlr);
          $con = mysql_query("select * from insumos_asignados where rel_atencion='".$_POST["valor$x"]."' ");
                       while ($i = mysql_fetch_array($con)){
                           $sle = mysql_query("select precio from precios_insumos a, insumos b where a.id_insumo=b.id and a.id_empresa=".$_GET['emp']." and b.codigo='".$i['cod_insumo']."' ");
                           $p = mysql_fetch_array($sle);
                           
                           $insus = "UPDATE `insumos_asignados` SET `sub_precio`='".$p['precio']."' WHERE  `rel_atencion`='".$i['rel_atencion']."' and cod_insumo='".$i['cod_insumo']."'  ";
                            mysql_query($insus);
                           }
                       $conm = mysql_query("select * from medicamentos_asig where rel_atencion='".$_POST["valor$x"]."' ");
                       while ($i = mysql_fetch_array($conm)){
                           $slex = mysql_query("select precio_med from medicamentos where codigo_int='".$i['cod_med']."' ");
                           $p = mysql_fetch_array($slex);
                           $insux = "UPDATE `medicamentos_asig` SET `sub_precio_m`='".$p['precio_med']."' WHERE  `rel_atencion`='".$i['rel_atencion']."' and cod_med='".$i['cod_med']."' ";
                           mysql_query($insux);
                           
                       }
                        $insu = "UPDATE `insumos_asignados` SET `facturado`='".$factura."' WHERE  `rel_atencion`='".$_POST["valor$x"]."'";
                        mysql_query($insu);
                        $med = "UPDATE `medicamentos_asig` SET `facturado`='".$factura."' WHERE  `rel_atencion`='".$_POST["valor$x"]."'";
                        mysql_query($med);
                       
                        $lab = "UPDATE `laboratorio_asig` SET `facturado`='".$factura."' WHERE  `rel_atencion`='".$_POST["valor$x"]."'";
                        mysql_query($lab);
                        $pro = "UPDATE `productos_vendidos` SET `facturado`='".$factura."' WHERE  `rel_atencion`='".$_POST["valor$x"]."'";
                        mysql_query($pro);
        

         echo 'La Orden No. :'.$_POST["valor$x"].' ha sido Facturada, El No. de Factura es :'.$factura.'<br>';
        
            }   
          
        } 

        
    }
            $sql11 = "SELECT sum(precio_total) FROM `actividad` WHERE relacionado='".$factura."' and estado='Completada'";
$fila11 =mysql_fetch_array(mysql_query($sql11));
$totala = $fila11["sum(precio_total)"];



            $sql1i = "SELECT sum(cant_usada * sub_precio)  FROM `insumos_asignados` WHERE facturado='".$factura."'";
            $fila1i =mysql_fetch_array(mysql_query($sql1i));
            $totali = $fila1i["sum(cant_usada * sub_precio)"];

            $sql1m = "SELECT sum(cantidad_usada * sub_precio_m) FROM `medicamentos_asig` WHERE facturado='".$factura."'";
$fila1m =mysql_fetch_array(mysql_query($sql1m));
$totalm = $fila1m["sum(cantidad_usada * sub_precio_m)"];
$total = $totala + $totali + $totalm;
$cambio = valorEnLetras($total); 

        $forma_pago = '';
        $meses = '1';
        $pago_pendiente = 'No';        

        $copagos = 0;
        $fecha_reg= date("Y-m-d");

        $sql13 = "SELECT min(fecha_mod_ta), max(fecha_mod_ta) FROM actividad WHERE relacionado='".$factura."' and estado='Completada'";
        $fila13 =mysql_fetch_array(mysql_query($sql13));
        $fi = $fila13["min(fecha_mod_ta)"];
        $fv = $fila13["max(fecha_mod_ta)"];
           $c = 'atenciones';
   	$sql = "INSERT INTO `recibo_caja`(`cod_alquiler`,`copagos`,`letras`,`fechai`, `fechaf`,`numero_recibo`, `id_paciente`, `forma_pago`, `meses`, `pago_pendiente`, `total`, `fecha_registro`)";
        $sql.= "VALUES ('".$c."','".$copagos."','".$cambio."','".$fi."', '".$fv."','".$factura."', '".$_GET['cod']."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$total."', '".$fecha_reg."')";
	mysql_query($sql) or die(mysql_error());
    
    
     echo '<a href="../vistas/?id=ver_paciente&cod='.$_GET['cod'].'">Presione aqui para confirmar los recibos</a>';
    }ELSE{
   
     include "../modelo/conexion.php";
     
$sql1 = "SELECT MAX(numero_factura) as id_inc FROM facturas where tipo='".$_POST['tipo']."' and estado='' ";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$factura = $fila1["id_inc"]+1;

    if(isset($_POST["cant"]))
    {
        $n = $_POST["cant"];
        
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["valor$x"])){
                include "../modelo/conexion.php";
                $sqlr = "UPDATE `actividad` SET `prioridad`='Facturado', relacionado='".$factura."',tipo_factura='".$_POST['tipo']."' WHERE `orden_servicio`='".$_POST["valor$x"]."';";
                mysql_query($sqlr);
                
                       $con = mysql_query("select * from insumos_asignados where rel_atencion='".$_POST["valor$x"]."' ");
                       while ($i = mysql_fetch_array($con)){
                           $sle = mysql_query("select precio from precios_insumos a, insumos b where a.id_insumo=b.id and a.id_empresa=".$_GET['emp']." and b.codigo='".$i['cod_insumo']."' ");
                           $p = mysql_fetch_array($sle);
                           
                           $insus = "UPDATE `insumos_asignados` SET `sub_precio`='".$p['precio']."' WHERE  `rel_atencion`='".$i['rel_atencion']."' and cod_insumo='".$i['cod_insumo']."'  ";
                            mysql_query($insus);
                           }
                       $conm = mysql_query("select * from medicamentos_asig where rel_atencion='".$_POST["valor$x"]."' ");
                       while ($i = mysql_fetch_array($conm)){
                           $slex = mysql_query("select precio_med from medicamentos where codigo_int='".$i['cod_med']."' ");
                           $p = mysql_fetch_array($slex);
                           $insux = "UPDATE `medicamentos_asig` SET `sub_precio_m`='".$p['precio_med']."' WHERE  `rel_atencion`='".$i['rel_atencion']."' and cod_med='".$i['cod_med']."' ";
                           mysql_query($insux);
                           
                       }
                               
         
                        $insu = "UPDATE `insumos_asignados` SET `facturado`='".$factura."',tipo_factura='".$_POST['tipo']."' WHERE  `rel_atencion`='".$_POST["valor$x"]."'";
                        mysql_query($insu);
                        $med = "UPDATE `medicamentos_asig` SET `facturado`='".$factura."',tipo_factura='".$_POST['tipo']."' WHERE  `rel_atencion`='".$_POST["valor$x"]."'";
                        mysql_query($med);
                       
                        $lab = "UPDATE `laboratorio_asig` SET `facturado`='".$factura."',tipo_factura='".$_POST['tipo']."' WHERE  `rel_atencion`='".$_POST["valor$x"]."'";
                        mysql_query($lab);
                        $pro = "UPDATE `productos_vendidos` SET `facturado`='".$factura."',tipo_factura='".$_POST['tipo']."' WHERE  `rel_atencion`='".$_POST["valor$x"]."'";
                        mysql_query($pro);

         echo 'La Orden No. :'.$_POST["valor$x"].' ha sido Facturada, El No. de Factura es :'.$factura.'<br>';
            }   
        } 
        
    }
            $sql11 = "SELECT sum(precio_total) FROM `actividad` WHERE relacionado='".$factura."' and tipo_factura='".$_POST['tipo']."' and estado='Completada'";
$fila11 =mysql_fetch_array(mysql_query($sql11));
$totala = $fila11["sum(precio_total)"];



            $sql1i = "SELECT sum(cant_usada * sub_precio)  FROM `insumos_asignados` WHERE facturado='".$factura."' and tipo_factura='".$_POST['tipo']."' and factura='' ";
$fila1i =mysql_fetch_array(mysql_query($sql1i));
$totali = $fila1i["sum(cant_usada * sub_precio)"];

            $sql1m = "SELECT sum(cantidad_usada * sub_precio_m) FROM `medicamentos_asig` WHERE facturado='".$factura."'  and tipo_factura='".$_POST['tipo']."'  and factura='' ";
$fila1m =mysql_fetch_array(mysql_query($sql1m));
$totalm = $fila1m["sum(cantidad_usada * sub_precio_m)"];
$total = $totala + $totali + $totalm;
$cambio = valorEnLetras($total); 

        $forma_pago = '';
        $meses = '1';
        $pago_pendiente = 'No';        

        $copagos = 0;
        $fecha_reg= date("Y-m-d");
        $sql13 = "SELECT min(fecha_mod_ta), max(fecha_mod_ta) FROM actividad WHERE relacionado='".$factura."' and estado='Completada' and factura='' ";
        $fila13 =mysql_fetch_array(mysql_query($sql13));
        $fi = $fila13["min(fecha_mod_ta)"];
        $fv = $fila13["max(fecha_mod_ta)"];
        
        $sql134 = "SELECT id_empresa FROM pacientes WHERE id_paciente='".$_GET['cod']."'";
        $e =mysql_fetch_array(mysql_query($sql134));
        $idemp = $e[0];
        
        if($total!=0){
   	$sql = "INSERT INTO `facturas`(`tipo`,`copagos`,`letras`,`fechai`, `fechaf`,`numero_factura`, `id_paciente`, `forma_pago`, `meses`, `pago_pendiente`, `total`, `fecha_registro`, `id_empresa`)";
        $sql.= "VALUES ('".$_POST['tipo']."','".$copagos."','".$cambio."','".$fi."', '".$fv."','".$factura."', '".$_GET['cod']."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$total."', '".$fecha_reg."', '".$idemp."')";
	mysql_query($sql);
        }
    
     echo '<a href="../vistas/?id=ver_paciente&cod='.$_GET['cod'].'">Presione aqui para confirmar</a>';
    }
}
//facturar la parte de alquileres


if(isset($_GET['codia'])){
    $sql1 = "SELECT MAX(numero_factura) as id_inc FROM facturas where tipo='FAC' and estado='' ";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$factura = $fila1["id_inc"]+1;

    if(isset($_POST["canti"]))
    {
        $n = $_POST["canti"];
        $totalt = 0;
        $orden_int = '';$orden_ext='';$paciente ='';
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["valor$x"])){
                include "../modelo/conexion.php";
                $sqlr = "UPDATE `ordenes` SET `facturado`='Facturado' WHERE `id`='".$_POST["valor$x"]."';";
                mysql_query($sqlr);
         
        
       //se consulta el id del paciente  
$sql2 = "select * from ordenes WHERE id='".$_POST["valor$x"]."'";
$fila2 =mysql_fetch_array(mysql_query($sql2));
$paciente = $fila2["id_paciente"];

                  //Consulta del ultima factura

//consultamos todos los datos de los equipos asignado
$sql13 = "SELECT * FROM equipos_asig WHERE numero_orden_a='".$_POST["valor$x"]."' limit 1";
$fila13 =mysql_fetch_array(mysql_query($sql13));
$fi = $fila13["fecha_a"];
$fv = $fila13["fecha_f"];
$autorizacion = $fila13["autorizacion"];

mysql_query("update equipos_asig set facturado=".$factura." where  numero_orden_a=".$_POST["valor$x"]." ");

                  //Consulta el total de los equipos asignados
$sql11 = "SELECT sum(precio_a) as total FROM equipos_asig WHERE facturado='".$factura."'";
$fila11 =mysql_fetch_array(mysql_query($sql11));
$total = $fila11["total"];
$totalt = $total;

        $orden_int = $_POST["valor$x"];
        $orden_ext = $autorizacion;
        $forma_pago = '';
        $meses = '';
       $pago_pendiente = 'No';        
        $fecha_venc = date("Y-m-d",strtotime("$fi + 1 month"));
        $info = '';
//        $subtotal = $_POST["subtotal"];
//	$iva = $_POST["iva"];
 
        
 

                
       



    //se guarda la factura


      
       
        
            }   
      if(isset($_POST["valorp$x"])){
                include "../modelo/conexion.php";
                $sqlr = "UPDATE `ordenes` SET `facturado`='Facturado' WHERE `id`='".$_POST["valorp$x"]."';";
                mysql_query($sqlr);
         
        
       //se consulta el id del paciente  
$sql2 = "select * from ordenes WHERE id='".$_POST["valorp$x"]."'";
$fila2 =mysql_fetch_array(mysql_query($sql2));
$paciente = $fila2["id_paciente"];
                 

        
                  //Consulta del ultima factura
$sql1 = "SELECT MAX(numero_recibo) as id_inc FROM recibo_caja";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$factura = $fila1["id_inc"]+1;
//consultamos todos los datos de los equipos asignado
$sql13 = "SELECT * FROM equipos_asig WHERE numero_orden_a='".$_POST["valorp$x"]."' limit 1";
$fila13 =mysql_fetch_array(mysql_query($sql13));
$fi = $fila13["fecha_a"];
$fv = $fila13["fecha_f"];
$autorizacion = $fila13["autorizacion"];
                  //Consulta el total de los equipos asignados
$sql11 = "SELECT sum(precio_a) as total FROM equipos_asig WHERE numero_orden_a='".$_POST["valorp$x"]."'";
$fila11 =mysql_fetch_array(mysql_query($sql11));
$total = $fila11["total"];



        $orden_int = $_POST["valorp$x"];
        $orden_ext = $autorizacion;
        $forma_pago = '';
        $meses = '';
       $pago_pendiente = 'No';        
        $fecha_venc = date("Y-m-d",strtotime("$fi + 1 month"));
        $info = '';
//        $subtotal = $_POST["subtotal"];
//	$iva = $_POST["iva"];
 
        $copagos = 0;
        $fecha_reg= date("Y-m-d");

                
       
$cambio = valorEnLetras($total); 

        $alquiler= 'alquiler';
   	$sql = "INSERT INTO `recibo_caja`(`copagos`,`cod_alquiler`, `fechai`, `fechaf`,`letras`,`numero_recibo`, `id_paciente`, `orden_int`, `orden_ext`, `forma_pago`, `meses`, `pago_pendiente`, `fecha_ven`, `total`, `informacion`, `fecha_registro`)";
        $sql.= "VALUES ('".$copagos."','".$alquiler."','".$fi."', '".$fv."','".$cambio."','".$factura."', '".$paciente."', '".$orden_int."', '".$orden_ext."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$fecha_venc."', '".$total."', '".$info."', '".$fecha_reg."')";
	mysql_query($sql);
        echo 'La Orden No. :'.$_POST["valorp$x"].' ha sido Facturada, El No. de Recibo de Caja es :'.$factura.'<br>';
       
        
            }   
        }
        $copagos = 0;
        $fecha_reg= date("Y-m-d");
        $cambio = valorEnLetras($totalt); 
         $sql134 = "SELECT id_empresa FROM pacientes WHERE id_paciente='".$paciente."'";
        $e =mysql_fetch_array(mysql_query($sql134));
        $idemp = $e[0];
          $alquiler= 'alquiler';
   	$sql = "INSERT INTO `facturas`(`copagos`,`cod_alquiler`, `fechai`, `fechaf`,`letras`,`numero_factura`, `id_paciente`, `orden_int`, `orden_ext`, `forma_pago`, `meses`, `pago_pendiente`, `fecha_ven`, `total`, `informacion`, `fecha_registro`, `id_empresa`, `tipo`)";
        $sql.= "VALUES ('".$copagos."','".$alquiler."','".$fi."', '".$fv."','".$cambio."','".$factura."', '".$paciente."', '".$orden_int."', '".$orden_ext."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$fecha_venc."', '".$total."', '".$info."', '".$fecha_reg."', '".$idemp."','FAC')";
	mysql_query($sql);
        echo 'La Orden No. :'.$_POST["valor$x"].' ha sido Facturada, El No. de Factura es :'.$factura.'<br>';
    }
     echo '<script>alert("se han generado las facturas de alquileres");location.href="../vistas/?id=ver_paciente&cod='.$_GET['cod'].' "; </script>';
}
?>