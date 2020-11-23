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
<head>



    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
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
				$.post("../modelo/add_producto.php", { elegido: elegido }, function(data){
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
   })
});
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
while($fila2=  mysql_fetch_array($result2)){
$id_rips=$fila2['id_empresa'];       
$empr = mysql_query("select * from sis_empresa where rips='$id_rips' ");
$e = mysql_fetch_array($empr);

 } 
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
  $_SESSION['id_emp_pro']=$e['id_empresa'];
 $_SESSION['ide']=$empresar; 
 $_SESSION['ord']=$orden_interna; ?>

<body onload="doScroll()" onunload="window.name=document.body.scrollTop">
                
		<article class="module width_full">
                    <header><h3>
                            <a href="../vistas/?id=ventas"><input type="button" name="cancelar" value="Todas las ventas" onclick=></a>
                      <?php if($_SESSION["k_username"] == 'admin'){ if($fact!='Facturado'){if ($est=='Completada' && $autorizacion != 'Pendiente'){echo '<a href="../vistas/facturacion_alquiler.php?fact='.$orden_interna.'"><input type=image src="../imagenes/facturar.gif" width="60" height="20"></a>';}} } 
                      if($fact!='Facturado'){if($regimen==4){}else{}} ?> 
                        </h3></header>
                                        <h4 class="inf">Paciente :<a href="../vistas/?id=ver_paciente&cod=<?php echo ($idp); ?>"><?php 
                                        echo "$nombre".' '."$apellido".' '."$apellido2";
                                        $_SESSION['nnn'] = "$nombre".' '."$apellido";
                                        ?> </a></h4><br>
                                        
 
                                       
				
                                    
                                       
                       
		</article>

                    <article class="module width_full">
                        
                        <form name="f1" action="../vistas/?id=add_detalle_venta&cod=<?php echo $_GET['cod'] ?>&editar=<?php echo $_GET['cod'] ?>"  class="span12 widget shadowed dark form-horizontal bordered" method="post" enctype="multipart/form-data">  
                            <header><h4 class="title">informacion de la venta
                            </h4>
                         
                        </header>
                            <table class="table table-bordered table-striped table-hover" id="">
                                <tr>
                                    <td><label>Fecha de pedido :</label><td><input name="fia" type="text" value="<?php echo $fi ?>"></td>
                                    <td><label>Fecha de entrega del producto :</label><td><input  id="datepicker2"  name="fp" class="tcal" type="text" value="<?php echo $fp ?>"></td>
                                </tr>
                                <tr>
                                    <td><label>Fecha a cancelar :</label><td><input  name="ffa" type="text" value="<?php echo $ff ?>"></td>
                                    <td><label>Llamada ? :</label><td><select name="llamada">
                                            <?php if(isset($llamada)){ echo '<option value="'.$llamada.'">'.$llamada.'<option>'; }?>
                                            <option value="Realizada">Realizada</option>
                                            <option value="Pendiente">Pendiente</option>
                                            <option value="No Aplica">No Aplica</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><label>Autorizacion </label> <td><input  name="ordena" type="text" value="<?php echo $autorizacion ?>"> </td>
                                    <td><label>Entregado a :</label><td><input  name="pedido" type="text" value="<?php echo $num_pedido ?>" placeholder="nombre de la persona "></td>
                                </tr>
                                <tr>
                                <td><label>Estado : </label> <td><select name="estado" style="width:150px;">
                                                                    <option value="<?php if(isset($est)){echo $est;}?>"><?php if(isset($est)){echo $est;}?></option>
                                                                   <?php if ($est='En proceso'){echo '<option value="Entregado">Entregado</option>';} ?>
                                                                   <?php if ($est!='Completada'){echo '<option value="Cancelado">Cancelado</option>';} ?>
                                                                   
                                                               </select> <input name="editar" type="submit" value="Guardar"></td>
                                <td>Observaciones : <td><input name="obs"  value="<?php echo $obs ?>" style="width: 500px;"></td>
                                </tr>
                            </table>
                           
                            
                      
                        </form>

                       
		</article>
		 
                  
             
               
                <article class="module width_full">
			
                        
                        
<?php 

    include '../vistas/ventas/productos_ventas.php';

if(isset($_GET['editar'])){
    include "../modelo/conexion.php";
    $fi= $_POST["fia"];
    $ff= $_POST["ffa"];
    $orden= $_POST["ordena"];
        $estado= $_POST["estado"];
        $sqlr = "UPDATE `ordenes` SET `fecha_pedido`='".$_POST['fp']."',`llamada`='".$_POST['llamada']."',`num_pedido`='".$_POST['pedido']."',`obs`='".$_POST['obs']."',`estado_ord`='".$estado."',`fecha_registro`='".$fi."', `fecha_final`='".$ff."', `orden`='".$orden."' WHERE `id`='".$_GET['editar']."';";
         mysql_query($sqlr);
         
         $sql3 = "UPDATE `equipos_ventas` SET `fecha_a`='".$fi."', `fecha_f`='".$ff."', `autorizacion`='".$orden."' WHERE `numero_orden_a`='".$_GET['editar']."';";
         mysql_query($sql3);
         echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=add_detalle_venta&cod=".$_GET['editar']."'";
        echo "</script>";
}

 if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM equipos_ventas WHERE id_equipo_a='$Codigo'";
        mysql_query($sql, $conexion);
                $a2 = '<a href="../vistas/?id=add_detalle_venta&cod='.$_GET["cod"].'">Venta # '.$_GET['cod'].'</a>';
         $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`) ";
            $sqlr.= "VALUES ('Se elimino un equipo de la venta', '".$a2."', '".$_SESSION['k_username']."')";
            mysql_query($sqlr, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=add_detalle_venta&cod='.$_GET["cod"].'"</script>'; 
    }
?>    
		</article> 
