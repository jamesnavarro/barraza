<?php 
include "../modelo/conexion.php";
require '../modelo/consulta_ordenes.php';
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
                  $sql1 = "select max(id) from ordenes";
        $fila =mysql_fetch_array(mysql_query($sql1));
        $max=$fila['max(id)'];
        
        
?>
<!doctype html>
<html lang="en">

<head>
<script> 
var ventana_secundaria 

function abrirVentana(){  
ventana_secundaria = window.open("../vistas/form_actividades.php","miventana","width=500,height=480,menubar=no") 
} 
function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/form_contacto_potencial.php","miventana","width=850,height=400,menubar=no") 
} 
function abrirVentana2(){  
ventana_secundaria = window.open("../vistas/form_oportunidades.php","miventana","width=500,height=520,menubar=no") 
}
function abrirVentana3(){  
ventana_secundaria = window.open("../vistas/form_caso.php","miventana","width=500,height=540,menubar=no") 
}
function abrirVentana4(){  
ventana_secundaria = window.open("../vistas/form_incidencia.php?cod=<?php echo $idc ?>","miventana","width=500,height=620,menubar=no") 
}
function abrirVentana5(){  
ventana_secundaria = window.open("../vistas/form_contacto.php?codigo=<?php echo $idc ?>","miventana","width=500,height=420,menubar=no") 
}
function abrirVentana6(){  
ventana_secundaria = window.open("../vistas/form_proyecto.php?codigo=<?php echo $idc ?>","miventana","width=500,height=420,menubar=no") 
}


function doScroll(){
    if (window.name) window.scrollTo(0, window.name);
}

</script>


 <script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1").change(function () {
   		$("#combo1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_insumos.php", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				$("#combo3").html("");
			});			
        });
   })
});
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo3").change(function () {
   		$("#combo3 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_medicina.php", { elegido: elegido }, function(data){
				$("#combo4").html(data);
				$("#combo5").html("");
			});			
        });
   })
});
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo5").change(function () {
   		$("#combo5 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_equipo.php", { elegido: elegido }, function(data){
				$("#combo6").html(data);
				$("#combo7").html("");
			});			
        });
   })
});
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo7").change(function () {
   		$("#combo7 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_lab.php", { elegido: elegido }, function(data){
				$("#combo8").html(data);
				$("#combo9").html("");
			});			
        });
   })
});
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo9").change(function () {
   		$("#combo9 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_ventas.php", { elegido: elegido }, function(data){
				$("#combo10").html(data);
				$("#combo11").html("");
			});			
        });
   });
        $("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../combos/precio_alquiler.php", { elegido: elegido }, function(data){
				$("#precio_alq").val(data);
                                if(data==0){
                                    $("#precio_alq").attr("readonly", false);
                                }
				
			});			
        });
   });
});
</script>

<script language='javascript'>
function contacto()
{
catPaises = window.open('../vistas/form_pacientes.php', 'contacto', 'width=500,height=600');
}
function insumos()
{
catPaises = window.open('../vistas/agregar_insumos.php', 'contacto', 'width=500,height=600');
}
function medicina()
{
catPaises = window.open('../vistas/agregar_medicina.php', 'contacto', 'width=500,height=600');
}
function laboratorio()
{
catPaises = window.open('../vistas/agregar_lab.php', 'contacto', 'width=500,height=600');
}
function productos()
{
catPaises = window.open('../vistas/agregar_producto.php', 'contacto', 'width=500,height=600');
}
function alquiler()
{
catPaises = window.open('../seleccion/equipos.php', 'contacto', 'width=800,height=600');
}
function reasignar()
{
catPaises = window.open('../vistas/reasignar.php?orden=<?php echo $_GET["codigo"] ?>&pac=<?php echo $_SESSION['nnn'] ?>', 'contacto', 'width=700,height=400');
}
function empresa()
{
catPaises = window.open('../vistas/form_empresa.php', 'contacto', 'width=500,height=600');
}
function seleccionar()
{
catPaises = window.open('../vistas/seleccionar.php', 'contacto', 'width=1000,height=600');
}
function usuario()
{
catPaises = window.open('../seleccion/usuario.php', 'contacto', 'width=1000,height=600');
}
function atencion()
{
catPaises = window.open('../seleccion/atenciones.php', 'contacto', 'width=1000,height=600');
}
function resumen()
{
catPaises = window.open('../vistas/resumen_atenciones.php?orden=<?php echo $_GET["codigo"] ?>&pac=<?php echo $_SESSION['nnn'] ?>', 'contacto', 'width=1000,height=600');
}
function detalles()
{
catPaises = window.open('../vistas/resumen_detalles.php?orden=<?php echo $_GET["codigo"] ?>', 'contacto', 'width=1200,height=600');
}
function detalles2()
{
catPaises = window.open('../vistas/resumen_detalles_1.php?orden=<?php echo $_GET["codigo"] ?>', 'contacto', 'width=1000,height=600');
}
function consulta()
{
catPaises = window.open('../controlador/historial_consulta.php?codigo=<?php echo $_GET["codigo"] ?>', 'contacto', 'width=800,height=600');
}
function editar()
{
catPaises = window.open('../vistas/form_proyecto_1.php?codigo=<?php echo $_GET["codigo"] ?>', 'contacto', 'width=800,height=600');
}
function editar()
{
catPaises = window.open('../vistas/reasignar.php?codigo=<?php echo $_GET["codigo"] ?>', 'contacto', 'width=800,height=600');
}
function curaciones()
{
catPaises = window.open('../vistas/form_proyecto_1.php?codigo=<?php echo $_GET["codigo"] ?>', 'contacto', 'width=800,height=600');
}
function doScroll(){
    if (window.name) window.scrollTo(0, window.name);
}
</script>
<script language="javascript" type="text/javascript">
function datos(val1, val2, val3){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
}
function datos3(val1, val2, val3){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
}
function datos4(val1, val2, val3){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
}
function datos5(val1, val2, val3){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
}
function user(val6){
    document.getElementById('valor6').value = val6;
    
}
function dato(val7, val8){
    document.getElementById('valor7').value = val7;
    document.getElementById('valor8').value = val8;
}
function datos2(val3, val4, val5){
    
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
    document.getElementById('valor5').value = val5;
}
function aten(x, y){
    document.getElementById('num1').value = x;
    document.getElementById('num2').value = y;
}
</script>
    <script> 
var ventana_secundaria 

function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/estado_orden.php?cod=<?php  echo $_GET["codigo"] ?>","miventana","width=500,height=400,menubar=no") 
} 
function abrirVentana11(){  
ventana_secundaria = window.open("../vistas/view_estado.php?cod=<?php  echo $_GET["codigo"] ?>","miventana","width=500,height=400,menubar=no") 
} 
function autorizacion(){  
ventana_secundaria = window.open("../vistas/add_orden.php?cod=<?php  echo $_GET["codigo"] ?>","miventana","width=500,height=200,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>

</head>
<?php

$consultar= "select count(cod_aten) as total from actividad where orden_servicio='".$orden_interna."' group by cod_aten";
$resultr=  mysql_query($consultar);
$t='';
while($fila=  mysql_fetch_array($resultr)){
$to=$fila['total'];
$t = $t + 1;
 }
////////////////////////////////////
 if($_SESSION["admin"] == 'Si'){
$consulta= "select sum(cant_med) as total from actividad where estado='Completada' and archivo='".$orden_interna."' ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$total=$fila['total'];  
}
 }else{
    $consulta= "select sum(porcentaje) as total from actividad where estado='Completada' and user='".$_SESSION["k_username"]."' and archivo='".$orden_interna."' ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$total=$fila['total']; 
}}
 ///////////////////////
 $consulta3= "select * from ordenes where id='".$orden_interna."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){ 
$fi=$fila['fecha_registro'];
$ff=$fila['fecha_final'];
$autorizacion=$fila['orden'];
$est=$fila['estado_ord'];
$fact=$fila['facturado'];
$fp=$fila['fecha_pedido'];
$llamada=$fila['llamada'];
$num_pedido=$fila['num_pedido'];
$obs=$fila['obs'];
$id_paciente=$fila['id_paciente'];
 }
 //////////////////////////////
 $consulta2= "select * from ordenes where orden='".$orden_interna."'";
$result2=  mysql_query($consulta2);
while($fila2=  mysql_fetch_array($result2)){
$user=$fila2['user'];                               
 } 
 
  $cons= "select * from pacientes where id_paciente='".$id_paciente."'";
$result2=  mysql_query($cons);
$fila2=  mysql_fetch_array($result2);
$id_rips=$fila2['id_empresa'];                               
 $empr = mysql_query("select * from sis_empresa where rips='$id_rips' ");
$e = mysql_fetch_array($empr);
 $_SESSION['id_emp_pro']=$e['id_empresa'];
 
 $_SESSION['rip']=$id_rips;
  //////////////////////////////
  if($_SESSION["admin"] == 'Si'){
       $consulta4= "select * from actividad where archivo='".$orden_interna."'";
  }else{
       $consulta4= "select * from actividad where archivo='".$orden_interna."' and user='".$_SESSION['k_username']."'";
  }

$result2=  mysql_query($consulta4);
while($fila2=  mysql_fetch_array($result2)){
$oo=$fila2['orden_servicio'];                               
 } 
 $_SESSION['ide']=$empresar; 
 $_SESSION['ord']=$orden_interna; ?>

<body onload="doScroll()" onunload="window.name=document.body.scrollTop">
    <div class="clear"></div>
        <article class="module width_full">
            <header>
                <h3>
                    <a href="../vistas/?id=all_alquiler"><input type="button" name="cancelar" value="Todos los alquileres" onclick=></a><?php if($_SESSION["k_username"] == 'admin'){ if($fact!='Facturado'){if ($est=='Completada' && $autorizacion != 'Pendiente'){echo '<a href="../vistas/facturacion_alquiler.php?fact='.$orden_interna.'"><input type=image src="../imagenes/facturar.gif" width="60" height="20"></a>';}} } if($fact!='Facturado'){if($regimen==4){echo '<a href="../vistas/?id=facturacion_recibo_caja&fact='.$orden_interna.'"><input type="button" name="cancelar" value="Recibo de caja" onclick=></a>';}else{}} ?> 
                </h3>
            </header>
            <h4>Paciente :
                <a href="../vistas/?id=ver_paciente&cod=<?php echo ($idp); ?>"><?php echo "$nombre".' '."$nombre2".' '."$apellido".' '."$apellido2"; $_SESSION['nnn'] = "$nombre".' '."$apellido";?> </a>
            </h4><br>
        </article>
        <article class="module width_full">
            <table width="100%">
                <tr BGCOLOR="#4E8CCF">
                    <th>
                        <font color="white">Informacion del alquiler</font>
                    </th>
                </tr>
            </table> 
            <form name="f1" action="../vistas/?id=add_detalle_alquiler&cod=<?php echo $_GET['cod'] ?>&editar=<?php echo $_GET['cod'] ?>" method="post" enctype="multipart/form-data">  
                <table class="table table-bordered table-striped table-hover" id="">
                    <tr>
                        <td><label>Fecha Inicial :</label><td><input  name="fia" type="text" value="<?php echo $fi ?>"></td>
                        <td><label>Fecha Pedido :</label><td><input  name="fp" id="datepicker2" type="text" value="<?php echo $fp ?>"></td>
                    </tr>
                    <tr>
                        <td><label>Fecha Final :</label><td><input  name="ffa" type="text" value="<?php echo $ff ?>"></td>
                        <td><label>Llamada ? :</label>
                        <td>
                            <select name="llamada">
                                <?php if(isset($llamada)){ echo '<option value="'.$llamada.'">'.$llamada.'<option>'; }?>
                                <option value="Realizada">Realizada</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="No Aplica">No Aplica</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Autorizacion :</label> <td><input  name="ordena" type="text" value="<?php echo $autorizacion ?>"> </td>
                        <td><label>No. Pedido :</label><td><input  name="pedido" type="text" value="<?php echo $num_pedido ?>"></td>
                    </tr>
                    <tr>
                    <td><label>Estado : </label> 
                        <td>
                            <select name="estado" style="width:130px;">
                                <option value="<?php if(isset($est)){echo $est;}?>"><?php if(isset($est)){echo $est;}?></option>
                                <?php if ($est='En proceso'){echo '<option value="En proceso">En proceso</option>';} ?>
                                <?php if ($est!='Completada'){echo '<option value="Completada">Completada</option>';} ?>
                            </select> 
                            <input name="editar" type="submit" value="Guardar">
                        </td>
                        <td><label>Observaciones :</label>  
                        <td>
                            <input name="obs"  value="<?php echo $obs ?>" style="width: 500px;">
                        </td>
                    </tr>
                </table>
            </form>
        </article>
	<article class="module width_full">
            <table width="100%">
                <tr BGCOLOR="#4E8CCF">
                    <th>
                        <font color="white">Equipos de soporte</font>
                    </th>
                </tr>
            </table> 
            <?php 
            if(isset($_POST['alquiler'])){
            $vari=$_POST["alquiler"];
            if ($vari == "Agregar Equipo"){
            include '../vistas/form_alquiler.php';
            }
            }else{
            include '../funciones/alquileres.php';
            }
            if(isset($_GET['editar'])){
            include "../modelo/conexion.php";
            $fi= $_POST["fia"];
            $ff= $_POST["ffa"];
            $orden= $_POST["ordena"];
            $estado= $_POST["estado"];
            $sqlr = "UPDATE `ordenes` SET `fecha_pedido`='".$_POST['fp']."',`llamada`='".$_POST['llamada']."',`num_pedido`='".$_POST['pedido']."',`obs`='".$_POST['obs']."',`estado_ord`='".$estado."',`fecha_registro`='".$fi."', `fecha_final`='".$ff."', `orden`='".$orden."' WHERE `id`='".$_GET['editar']."';";
            mysql_query($sqlr);
            $sql3 = "UPDATE `equipos_asig` SET `fecha_a`='".$fi."', `fecha_f`='".$ff."', `autorizacion`='".$orden."' WHERE `numero_orden_a`='".$_GET['editar']."';";
            mysql_query($sql3);
            $a2 = '<a href="../vistas/?id=add_detalle_alquiler&cod='.$_GET["cod"].'">Alquiler # '.$_GET['cod'].'</a>';
            $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`, `id_cotizacion`) ";
            $sqlr.= "VALUES ('Se modifico el encabezado del alquiler:', 'Archivo General', '".$_SESSION['k_username']."', '".$_GET['cod']."')";
            mysql_query($sqlr, $conexion);
            echo "<script language='javascript' type='text/javascript'>";
            echo "location.href='../vistas/?id=add_detalle_alquiler&cod=".$_GET['editar']."'";
            echo "</script>";
            }
            if(isset($_GET['eliminar']))
            {
            $Codigo=$_GET['eliminar'];
            $sql = "DELETE FROM equipos_asig WHERE id_equipo_a='$Codigo'";
            mysql_query($sql, $conexion);
            $a2 = '<a href="../vistas/?id=add_detalle_alquiler&cod='.$_GET["cod"].'">Alquiler # '.$_GET['cod'].'</a>';
            $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`, `id_cotizacion`) ";
            $sqlr.= "VALUES ('Se elimino un equipo del alquiler  de la orden ".$_GET['cod']." :', 'Archivo General', '".$_SESSION['k_username']."', '".$_GET["cod"]."')";
            mysql_query($sqlr, $conexion);
            echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=add_detalle_alquiler&cod='.$_GET["cod"].'"</script>'; 
            }
            ?>    
	</article> 
        <?php ?>
	<div class="spacer"></div>
</body>
</html>