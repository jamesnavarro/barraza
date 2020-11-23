
                                                     
             <form name="f1" action="../modelo/insertar_equipo_asig.php" method="post" enctype="multipart/form-data">   
                <table bgcolor="white">
                     
                    
                                                        <tr>
                                                           <td> <label>Orden externa :</label><input type="text" name="orden_ext" style="width:25%;" value=""></td> 
                                                        </tr>
							
                                                        <tr>
                                                            <td><label>Fecha Inicio :<font color="red"> *</font> </label><input type="text" name="fecha_inicial" class="tcal" style="width:70px;height:20px;">(año-mes-dia, ej: 2013-01-31)</td>
                                                        </tr>
                                                           <tr>
                                                            <td><label>Fecha Final :<font color="red"> *</font> </label><input type="text" name="fecha_final" class="tcal" style="width:70px;height:20px;">(año-mes-dia, ej: 2013-01-31)</td></tr>
                                                           
                                                        
                                                                                                                
                                                         <tr>
                                                            <td bgcolor='yellow'><label>Copagos : $ </label><input type="text" name="copagos"  style="width:100px;height:20px;" value=""/>
                                                          </tr>
                                                          <tr><td><input type="submit" name="enviar" value="Guardar" class="alt_btn" onclick="">
					                          <input type="reset" value="Limpiar"></td></tr>
                                                          
                                                     </table></form>