<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
require '../modelo/consultar_alquiler.php';
if(isset($_GET["codigo"])){
$consulta= "select a.*, b.* from ordenes a, pacientes b WHERE a.id_paciente=b.id_paciente and id=".$numero_orden."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){

$lastname=$fila['apellidos'];
$name=$fila['nombres'];
$id=$fila['id_paciente'];
                                
 }}
?>
<head>

<script language='javascript'>
function recarga()
{
catPaises = window.open('../vistas/recarga_de_ox.php?equipo=<?php echo $cod_equipo ?>&orden=<?php echo $numero_orden ?>', 'contacto', 'width=500,height=400');
}
function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>
</head>
                
		<article class="module width_full">
			<header><h3>detalles de alquiler</h3></header>
                        
                        
				<div class="module_content">
                                        <h4 class="inf">Autorizacion # <?php 
                                        echo "$autorizacion";
                                        if(date("Y-m-d") > $fecha_f){ echo '( <font color="red">La fecha limite esta vencida</font> )';}

                                        ?> </h4><br>
                                        

                                        <hr>
                                        <a href="../vistas/?id=editar_alq&codigo=<?php echo $_GET['codigo']; ?>&arch=<?php echo $_GET['arch']; ?>"> <input type="button" name="enviar" value="Editar / Adicionar" class="alt_btn"></a><?php  if(isset($_GET['fact'])){}else{if($estado=='terminado' && $autorizacion!='Pendiente'){ ?><a href="../vistas/facturacion_alquiler.php?fact=<?php echo $rel_atencion; ?>"> <input type="button" name="enviar" value="Facturar" class="alt_btn"></a><?php ;}} ?>
                                        <a href="../vistas/?id=recibo_de_alquiler&codigo=<?php echo $id; ?>&alq=<?php echo $_GET['codigo']; ?>"> <input type="button" name="enviar" value="Recibo de Caja" class="alt_btn"></a>
                                        <a target="_blank" href="../imprimir_recargas_ox.php?equipo=<?php echo $cod_equipo; ?>&orden=<?php echo $numero_orden; ?>"> <input type="button" name="enviar" value="Autorizar Recargas" class="alt_btn"></a>
                                        <a href="../vistas/?id=add_detalle_alquiler&cod=<?php echo $_GET['arch']; ?>"> <input type="button" name="enviar" value="Volver al Archivo" class="alt_btn"></a> 
                                       <input type="button" name="enviar" value="Generar Autorizarion" class="alt_btn" onclick="recarga()"><hr><br>
                                    <fieldset style="width:100%; float:center; margin-right: 3%;"> 
                                     <fieldset style="width:48%; float:left; margin-right: 3%;"> 
                                         
                                                   <table bgcolor='white'>
                                                       
                                                       <tr>
                                                           <td><label>Paciente : </label></td>
                                                           <td><?php 
                                                          echo '<a href="../vistas/?id=ver_paciente&cod='.$id.'">'.$name.' '.$lastname.'</a>'; ?></td>
                                                        </tr>
							<tr>
                                                           <td><label>Producto : </label></td>
                                                           <td><?php 
                                                           echo "$nombre";?></td>
                                                        </tr>
                                                        <tr>
                                                           <td><label>Cantidad : </label></td>
                                                           <td><?php 
                                                           echo "$cantidad";?></td>
                                                        </tr>
                                                        <tr>
                                                           <td><label>Valor del alquiler : </label></td>
                                                           <td><?php echo '$';
                                                           echo "$valor";?></td>
                                                        </tr>
                                                         <tr>
                                                           <td><label>Fecha inicial de registro :</label></td>
                                                           <td><?php echo "$fecha_reg" ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td><label>fecha :</label></td>
                                                            <td><?php echo "$fecha_a" ?> al <?php echo "$fecha_f" ?></td>
                                                            <td><?php 
                                                            ?></td>
                                                          </tr>
                                                          <tr>
                                                            <td><label>duración en meses:</label></td>
                                                            <td><?php echo "$meses"; ?></td>
                                                          </tr>
                                                          <tr>
                                                           <td><label>estado :</label></td>
                                                            <td><?php echo "$estado";
                                                            ?></td>
                                                          </tr>
                                                          <tr>
                                                                <td><label>Codigo del Equipo:</label></td>
                                                                <td><?php echo "$cod_equipo" ?></td>
                                                              </tr>
                                                              <tr>
                                                                <td><label>Autorización:</label></td>
                                                                <td><?php if($autorizacion == 'Pendiente'){echo '<font color="red">Pendiente</font>';}else{echo "$autorizacion";}?></td>
                                                              </tr>
                                                              <tr>
                                                                <td><label>referencia del equipo:</label></td>
                                                                <td><?php echo "$equipo" ?></td>
                                                              </tr>
                                                              <tr>
                                                           <td><label>Pagos Hechos :</label></td>
                                                            <td><?php echo '$';echo "$copagos";
                                                            ?></td>
                                                          </tr>
                                                          <tr>
                                                           <td><label>estado de la cuenta :</label></td>
                                                            <td><?php $t = $valor-$copagos; if($t==0){echo 'Pago por adelantado';}else{echo 'Pendiente por cobrar';}
                                                            ?></td>
                                                          </tr>
              
                 
                                                     </table>
                                        <?php  $t = substr("$fecha_a",0, -3); ?>
                                     
						</fieldset>
                                        <fieldset style="width:48%; float:right;"> 
                                            <header><b>Fecha de alquiler</b></header>
                                            <table border='2' bgcolor="white" width=100% >
                                                <tr height=70px>
                                                                <td bgcolor='<?php  if($t == date("2013-01") ||$t == date("2014-01") ){echo 'yellow';} ?>'>Enero:<?php  if($t == date("2013-01") ||$t == date("2014-01")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                                <td bgcolor='<?php  if($t == date("2013-02")||$t == date("2014-02")){echo 'yellow';} ?>'>Febrero:<?php  if($t == date("2013-02")||$t == date("2014-02")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                                <td bgcolor='<?php  if($t == date("2013-03")||$t == date("2014-03")){echo 'yellow';} ?>'>Marzo:<?php  if($t == date("2013-03")||$t == date("2014-03")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                              </tr>
                                                               <tr height=70px>
                                                                <td bgcolor='<?php  if($t == date("2013-04")||$t == date("2014-04")){echo 'yellow';} ?>'>Abril:<?php  if($t == date("2013-04")||$t == date("2014-04")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                                <td bgcolor='<?php  if($t == date("2013-05")||$t == date("2014-05")){echo 'yellow';} ?>'>Mayo:<?php  if($t == date("2013-05")||$t == date("2014-05")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                                <td bgcolor='<?php  if($t == date("2013-06")||$t == date("2014-06")){echo 'yellow';} ?>'>Junio:<?php  if($t == date("2013-06")||$t == date("2014-06")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                              </tr>
                                                               <tr height=70px>
                                                                <td bgcolor='<?php  if($t == date("2013-07")||$t == date("2014-07")){echo 'yellow';} ?>'>Julio:<?php  if($t == date("2013-07")||$t == date("2014-07")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                                <td bgcolor='<?php  if($t == date("2013-08")||$t == date("2014-08")){echo 'yellow';} ?>'>Agosto:<?php  if($t == date("2013-08")||$t == date("2014-08")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                                <td bgcolor='<?php  if($t == date("2013-09")||$t == date("2014-09")){echo 'yellow';} ?>'>Septiembre:<?php  if($t == date("2013-09")||$t == date("2014-09")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                              </tr>
                                                               <tr height=70px>
                                                                <td bgcolor='<?php  if($t == date("2013-10")||$t == date("2014-10")){echo 'yellow';} ?>'>Octubre:<?php  if($t == date("2013-10")||$t == date("2014-10")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                                <td bgcolor='<?php  if($t == date("2013-11")||$t == date("2014-11")){echo 'yellow';} ?>'>Noviembre:<?php  if($t == date("2013-11")||$t == date("2014-11")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                                <td bgcolor='<?php  if($t == date("2013-12")||$t == date("2014-12")){echo 'yellow';} ?>'>Diciembre:<?php  if($t == date("2013-12")||$t == date("2014-12")){echo '<br><b>'.$fecha_a.' al '.$fecha_f.'</b>';} ?></td>
                                                              </tr>
                                            </table>
                                        </fieldset>
						</fieldset>
                                       <hr><br>
                        
                                      
                                    
				
                       
		</article></form>
                    
                <br>
            
		</div>

</body>

</html>
