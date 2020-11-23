<?php 
include "../modelo/conexion.php";
?>
<head>
    <script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1").change(function () {
   		$("#combo1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/combo1.php", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				$("#combo3").html("");
			});			
        });
   })
	// Parametros para el combo2
	$("#combo2").change(function () {
   		$("#combo2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("combo2.php", { elegido: elegido }, function(data){
				$("#combo3").html(data);
			});			
        });
   })
});
function alquiler_new(page){
    var ano = $("#ano").val();
    var mes = $("#mes").val();
    var orden = $("#orden1").val();
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var regimen = $("#regimen").val();
    var estado = $("#estado").val();
    var documento = $("#documento").val();
    var empresa = $("#empresa").val();
    $("#cargando").html('<img src="../../images/guardando.gif"> Cargando...');
    $.ajax({
        type:'GET',
        data:'page='+page+'&ano='+ano+'&mes='+mes+'&orde='+orden+'&nombre='+nombre+'&apellido='+apellido+'&regimen='+regimen
        +'&estado='+estado+'&documento='+documento+'&empresa='+empresa,
        url:'../vistas/alquiler/lista_alquiler_enproceso.php',
        success: function(datos){
            $("#mostrar_alquiler").html(datos);
            $("#cargando").html('');
        }
    });
    
}
function facturar(){
    var c = confirm("Esta seguro de facturar estos alquileres?");
    if(c){
        document.getElementById("myForm").submit();
        
        }
    }
</script>
</head>
<body onload="alquiler_new(1)">

    <article class="module width_full">
	<header>
            <h3>Equipos Alquilados</h3>
        </header>
        <div class="module_content">
            
                <div>
                    <table class="table table-bordered table-striped table-hover" id="">
                        <tr>
                            <td> <select id="empresa">
                                                        <option value="">Seleccione la empresa</option>
                                                        <?php
                                                        $query = mysql_query("select * from sis_empresa where cliente='Si'");
                                                        while ($row = mysql_fetch_array($query)) {
                                                            echo '<option value="'.$row['rips'].'">'.$row['rips'].'-'.$row['nombre_emp'].'</option>';
                                                        }
                                                        ?>
                                                    </select></td>
                            <td></td>
                        </tr>
                        <tr>
                       
                            <td>
                                <input placeholder="No. Documento" id="documento" style="width:130px;height:20px;">
                            </td>
                            <td>
                                 
                                <select id="estado" style="width:180px;">
                                    <option value="">No Facturado</option>
                                    <option value="Facturado">Facturado</option>
                                    
                                </select>
                            </td>
                        
                        </tr>
                        <tr>
                           
                                <td>
                                    <input placeholder="Nombre" id="nombre" style="width:130px;height:20px;">
                                </td>
                                <td>
                                   
                                
                                    <select id="regimen" style="width:180px;">
                                        <option value="">--Seleccione Regimen--</option>
                                        <option value="1">Contributivo</option>
                                        <option value="2">Subsidiado</option>
                                        <option value="4">Particular</option>
                                        <option value="3">Vinculado</option>
                                        <option value="5">Otro</option>
                                        <option value="7">Desplazado con afilacion al regimen contributivo</option>
                                        <option value="8">Desplazado con afilacion al regimen subsidiado</option>
                                        <option value="9">Desplazado no asegurado</option>
                                        <option value="No aplica">No aplica</option>
                                    </select>
                                </td>
                        </tr>
                        <tr>
                            <td>
                                <input placeholder="Apellido" id="apellido" style="width:130px;height:20px;">
                            </td>
                            <td>
                                <input placeholder="Año" id="ano" style="width:130px;height:20px;" value="<?php echo date("Y") ?>">
                                
                                 <select id="mes" style="width:130px;">
                                    <option value="<?php echo date("%") ?>">Cualquier Mes</option>
                                    <option value="<?php echo date("01") ?>">Enero</option>
                                    <option value="<?php echo date("02") ?>">Febrero</option>
                                    <option value="<?php echo date("03") ?>">Marzo</option>
                                    <option value="<?php echo date("04") ?>">Abril</option>
                                    <option value="<?php echo date("05") ?>">Mayo</option>
                                    <option value="<?php echo date("06") ?>">Junio</option>
                                    <option value="<?php echo date("07") ?>">Julio</option>
                                    <option value="<?php echo date("08") ?>">Agosto</option>
                                    <option value="<?php echo date("09") ?>">Septiembre</option>
                                    <option value="<?php echo date("10") ?>">Octubre</option>
                                    <option value="<?php echo date("11") ?>">Noviembre</option>
                                    <option value="<?php echo date("12") ?>">Diciembre</option>
                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                                <input placeholder="Autorizacion" id="orden1" style="width:130px;height:20px;">
                            </td>
                            <td>
                             
                                                </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="button" name="buscar" value="Buscar" class="alt_btn" onclick="alquiler_new(1)">
                                <input type="reset" value="Limpiar">
                            </td>
                            <td id="cargando"></td>
                        </tr>
                    </table>
                                        
                                        
                                 
                                    
                                                        
				    </div>
<form id="myForm" action="../vistas/?id=all_alquiler&codi=facturar" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-striped table-hover" id="">

             <thead >
             <tr BGCOLOR="#C3D9FF">
             <th>No.CC.</th>
             <th>Paciente.</th>
             <th>Regimen</th>
             <th>Ult. Orden</th>
             <th>Rango de Fecha</th>
             <th>Ultimo Mes</th>
             <th>Estado</th>
             <th>Facturado?</th>
             <th>Editar</th> 
             <th>Eliminar</th>
             <th>Facturar</th>
             <th>Recibo</th>
             </tr>
             </thead>
             <tbody id="mostrar_alquiler">
                 
             </tbody>


      
</table> 
            

            </form>
            <?php
        if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sqlx = "DELETE FROM ordenes WHERE id='$Codigo'";
         mysql_query($sqlx, $conexion);
         $sql = "DELETE FROM equipos_asig WHERE numero_orden_a='$Codigo'";
         mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=all_alquiler"</script>'; 
    }
    
 
    

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
elseif($G6==1) { $I6="Millón "; } 
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
if(isset($_GET['codi'])){
    if(isset($_POST["cant"]))
    {
                 //Consulta del ultima factura
                $sql1 = "SELECT MAX(numero_factura) as id_inc FROM facturas where tipo='FAC' and estado='' ";
                $fila1 =mysql_fetch_array(mysql_query($sql1)); 
                $factura = $fila1["id_inc"]+1;

        $n = $_POST["cant"];
        $grantotal = 0;
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["valor$x"])){
                include "../modelo/conexion.php";
                $sqlr = "UPDATE `ordenes` SET `facturado`='Facturado' WHERE `id`='".$_POST["valor$x"]."';";
                mysql_query($sqlr);
         
        
                       //se consulta el id del paciente  
                $sql2 = "select * from ordenes WHERE id='".$_POST["valor$x"]."'";
                $fila2 =mysql_fetch_array(mysql_query($sql2));
                $paciente = $fila2["id_paciente"];

                $sql2p = "select * from pacientes WHERE id_paciente='".$paciente."'";
                $pa =mysql_fetch_array(mysql_query($sql2p));
                $emp = $pa["id_empresa"];


                //consultamos todos los datos de los equipos asignado
                $sql13 = "SELECT * FROM equipos_asig WHERE numero_orden_a='".$_POST["valor$x"]."' limit 1";
                $fila13 =mysql_fetch_array(mysql_query($sql13));
                $fi = $fila13["fecha_a"];
                $fv = $fila13["fecha_f"];
                $autorizacion = $fila13["autorizacion"];
                                  //Consulta el total de los equipos asignados
                $sql11 = "SELECT sum(precio_a*cantidad) as total FROM equipos_asig WHERE numero_orden_a='".$_POST["valor$x"]."'";
                $fila11 =mysql_fetch_array(mysql_query($sql11));
                $total = $fila11["total"];
                $grantotal += $total;
                mysql_query("update equipos_asig set facturado='".$factura."', tipo_factura='FAC' where  numero_orden_a='".$_POST["valor$x"]."' ");


       
        
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
                $grantotal += $total;



        
            }   
        }    
        
        if($_POST["tipo"]=='FAC'){
        // insert de facturas
                $orden_int = '';
                $orden_ext = '';
                $forma_pago = '';
                $meses = '';
               $pago_pendiente = 'No';        
                $fecha_venc = date("Y-m-d",strtotime("$fi + 1 month"));
                $info = '';
                $copagos = 0;
                $fecha_reg= date("Y-m-d");
                $cambio = valorEnLetras($total); 

                $alquiler= 'alquiler';
                $sql = "INSERT INTO `facturas`(`id_empresa`,`copagos`,`cod_alquiler`, `fechai`, `fechaf`,`letras`,`numero_factura`, `id_paciente`, `orden_int`, `orden_ext`, `forma_pago`, `meses`, `pago_pendiente`, `fecha_ven`, `total`, `informacion`, `fecha_registro`,`tipo`)";
                $sql.= "VALUES ('".$emp."','".$copagos."','".$alquiler."','".$fi."', '".$fv."','".$cambio."','".$factura."', '0', '".$orden_int."', '".$orden_ext."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$fecha_venc."', '".$grantotal."', '".$info."', '".$fecha_reg."','FAC')";
                mysql_query($sql);
                echo 'Se ha generado la Factura No :'.$factura.'<br>';
        }else{
                    $orden_int = '';
                    $orden_ext = '';
                    $forma_pago = '';
                    $meses = '';
                    $pago_pendiente = 'No';        
                    $fecha_venc = date("Y-m-d",strtotime("$fi + 1 month"));
                    $info = '';
                    $copagos = 0;
                    $fecha_reg= date("Y-m-d");

                    $cambio = valorEnLetras($total); 

                    $alquiler= 'alquiler';
                    $sql = "INSERT INTO `recibo_caja`(`copagos`,`cod_alquiler`, `fechai`, `fechaf`,`letras`,`numero_recibo`, `id_paciente`, `orden_int`, `orden_ext`, `forma_pago`, `meses`, `pago_pendiente`, `fecha_ven`, `total`, `informacion`, `fecha_registro`,`tipo`)";
                    $sql.= "VALUES ('".$copagos."','".$alquiler."','".$fi."', '".$fv."','".$cambio."','".$factura."', '".$paciente."', '".$orden_int."', '".$orden_ext."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$fecha_venc."', '".$grantotal."', '".$info."', '".$fecha_reg."','FAC')";
                    mysql_query($sql);
                    echo ' Se ha generado el Recibo de Caja es :'.$factura.'<br>';

        }
        
    }
     echo '<a href="../vistas/?id=all_alquiler">Presione aqui para confirmar</a>';
}
?>

                                               
                                  </fieldset>   
				</div>
                       
		</article>
