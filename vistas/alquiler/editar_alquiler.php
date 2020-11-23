<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_alquiler.php';
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>

		
            <form name="insertar22" action="../modelo/editar_alquiler_proceso.php?editar=<?php echo $_GET['codigo'] ?>&arch=<?php echo $_GET['arch']; ?>" method="post"  class="span12 widget shadowed dark form-horizontal bordered" enctype="multipart/form-data">
                	<header><h4 class="title">Editar alquiler</h4></header>
                        <table>
                                                          <tr>
                                                            <td align="right"><label>autorizacion:</label></td>
                                                            <td><input type="text" name="autorizacion" style="width:200px;height:20px;" value="<?php echo $autorizacion ?>"/></td>
                                                          </tr>
							<tr>
                                                            <td align="right"><label>fecha de inicial del alquiler:</label></td>
                                                            <td><input type="text" name="fecha_reg" readonly style="width:200px;height:20px;" value="<?php echo $fecha_reg ?>"/></td>
                                                          </tr>
                                                       
                                                        <tr align="right">
                                                           <td><label>Nombre del equipo: </label></td>
                                                           <td><input type="text" name="nombre" readonly style="width:400px;height:20px;" value="<?php echo $nombre ?>"/></td>
                                                        </tr>
                                                  
                                                          
                                                        <tr>
                                                            <td align="right"><label>Codigo del Equipo :  </label></td>
                                                            <td><input type="text" name="codigo" readonly style="width:100px;height:20px;" value="<?php echo $cod_equipo ?>"/>
                                                                <label>Cantidad :  </label><input type="text" name="cantidad"  style="width:50px;height:20px;" value="<?php echo $cantidad ?>"/>
                                                          </tr>
                                                        <tr>
                                                           <td align="right"><label>referencia del equipo :</label></td>
                                                           <td><textarea name="inf" style="width:100%;height:100px;" rows="4"><?php echo $equipo ?></textarea></td>
                                                          </tr>
                                                           <tr>
                                                            <td align="right"><label>Valor del alquiler : $ </label></td>
                                                            <td><input type="text" name="valora" style="width:100px;height:20px;" value="<?php echo $precio_a ?>"/>
                                                          </tr>
                                                          <tr>
                                                            <td align="right"><label>Valor adicional : $ </label></td>
                                                            <td><input type="text" name="valor" style="width:100px;height:20px;" value=""/>
                                                          </tr>
                                                          <tr>
                                                            <td align="right"><label>Pagos hechos : $ </label></td>
                                                            <td><input type="text" name="copagos" style="width:100px;height:20px;" value="<?php echo $copagos ?>"/>
                                                          </tr>
                                                           <tr>
                                                            <td  align="right"><label>Meses asignado :</label></td>
                                                            <td><input type="text" name="mes" readonly style="width:50px;height:20px;" value="<?php echo $meses ?>"/> Mes(es)</td>
                                                          </tr>
                                                          <tr>
                                                            <td align="right"><label>fecha inicial :</label></td>
                                                            <td><input type="text" name="mes1"  style="width:100px;height:20px;" value="<?php echo $fecha_a ?>"/>
                                                          </tr>
                                                         
                                                          <tr>
                                                            <td align="right"><label>fecha final:</label></td>
                                                            <td><input type="text" name="mes2" style="width:100px;height:20px;" value="<?php echo $fecha_f; ?>"/></td>
                                                          </tr>
                                                         <tr>
                                                            <td><label>Asignar mes  :</label></td>
                                                            <td><select name="asig_mes" style="width:50px;height:20px;">
                                                                  <option value="0">0</option>
                                                                    <option value="1">1</option>
                                                                   <option value="2">2</option>
                                                                   <option value="3">3</option>r
                                                                   <option value="4">4</option>
                                                                   <option value="5">5</option>
                                                                   <option value="6">6</option>
                                                                   <option value="7">7</option>
                                                                   <option value="8">8</option>
                                                                   <option value="9">9</option>
                                                                   <option value="10">10</option>
                                                                   <option value="11">11</option>
                                                                   <option value="12">12</option>
                                                                   
                                                               </select></td>
                                                          </tr>
                                                        <tr>
                                                            <td><label>Estado :</label></td>
                                                            <td><select name="estado" style="width:200px;height:20px;">
                                                                    <option value="<?php if(isset($estado)){echo $estado;}?>"><?php if(isset($estado)){echo $estado;}?></option>
                                                                   <?php if ($estado='alquilado'){echo '<option value="alquilado">alquilado</option>';} ?>
                                                                   <?php if ($estado!='terminado'){echo '<option value="terminado">terminado</option>';} ?>
                                                                   
                                                               </select></td>
                                                          </tr>
                                                        
                                                         
                                                          <tr><td><input type="submit" name="enviar" value="Guardar" class="alt_btn" onclick="">
                                                                  <a href="../vistas/alquiler_de_productos.php?codigo=<?php echo $_GET['codigo'] ?>"><input type="button" value="Cancelar"></a>
					                          <input type='reset' name='close' value='Limpiar'></td></tr>
                                                          
                                                     </table></form>

