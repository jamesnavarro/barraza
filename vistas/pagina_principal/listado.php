 <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                  
                                             
                                        
                                        <table style="border:1px solid #000000;width: 100%" bgcolor="afcae3">
                                             <tr>
                                               
                                            
                                            <td><label># ORDEN externa</label></td>
                                                <td><input name="orden" style="width:130px;height:30px;"></td>
                                                <td><label>Estado de la orden:</label></td>
                                                           <td><select name="estado" style="width:130px;height:30px;">
                                                                   <option value="">..Todas...</option>
                                          <?php if(isset($_GET['no-iniciada'])){echo '<option value="0" selected>No Iniciada</option>';}else{echo '<option value="0">No Iniciada</option>';}  ?>   
                                         <?php if(isset($_GET['en-proceso'])){echo '<option value="97" selected>En proceso</option>';}else{echo '<option value="97">En proceso</option>';}  ?>  
                                           <?php if(isset($_GET['completadas'])||isset($_GET['completadas-ok'])||isset($_GET['facturadas'])){echo '<option value="99" selected>Completada</option>';}else{echo '<option value="99">Completada</option>';}  ?>                          
                                                                   

                                                               </select></td>
                                                </tr>
                                                
                                                 <tr>
                                                 <td><label># documento:</label></td>
                                                           <td><input name="documento" style="width:130px;height:30px;"></td>
                                                           <td><label>Facturadas :</label></td>
                                                           <td><select name="fact" style="width:130px;height:30px;">
                                                                   <option value="">..Todas...</option>
                                                                   
                                                                  
                                            <?php if(isset($_GET['completadas-ok']) || isset($_GET['completadas']) || isset($_GET['en-proceso']) || isset($_GET['no-iniciada'])){echo ' <option value="activa" selected>No Facturado</option>';}else{echo ' <option value="activa">No Facturado</option>';}  ?>                          
                                            <?php if(isset($_GET['facturadas'])){echo '<option value="Facturado" selected>Facturado</option>';}else{echo '<option value="Facturado">Facturado</option>';}  ?>                          
                                           

                                                               </select></td>
                                                 </tr> 
                                                           <tr>
                                                 <td><label>Nombres:</label></td>
                                                           <td><input name="nombre" style="width:130px;height:30px;"></td>
                                                           <td><label>Ordenes Revisadas :</label></td>
                                                           <td><select name="facturas" style="width:130px;height:30px;">
                                                                   <?php if(isset($_GET['completadas-ok']) ||isset($_GET['facturadas'])){echo '<option value="Revisado">Revisadas</option>';}  ?>   
                                                                   <option value="">..Todas...</option>
                                                                   <option value="Revisado">Revisadas</option>
                                                                   
                                                                   

                                                               </select></td>
                                                               
                                                           </tr> 
                                                           <tr>
                                                 <td><label>Apellidos:</label></td>
                                                           <td><input name="apellido" style="width:130px;height:30px;"></td>
                                                           <td><label>asignado a :</label></td>
                                                           <td><select name="archivo" style="width:130px;height:30px;">
                                                                   <option value="">..Todas..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `usuarios`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['usuario'];
                                                        
                                                         

                                                            echo"<option value='".$valor1."'>".$valor1."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></td>
                                                           </tr> 
                                                           <tr>
                                                               <td><label>Empresa :</label></td>
                                                               <td>
                                                                   <select name="empresa" style="width:150px;">
                                                                   
                                                          <option value="">Todas..</option>
                                                          <?php
                                                            include "../modelo/conexion.php";
                                                            $consulta= "select * from sis_empresa where cliente='Si'";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['rips'];
                                                            $valor2=$fila['nombre_emp'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                            
                                                            
                                                        </select>
                                                               </td>
                                                               <td><label>Fecha de ingreso Del :</label></td><td><input name="desde" type="text" placeholder="2013/12/01" value="" style="width:80px;"></td>
                                                           </tr>
                                            
                                            <tr>
                                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                    <input type="reset" value="Limpiar"></td><td><input name="oi" type="hidden" placeholder="Ord. Interna"  value="" style="width:80px;"></td>
                                                <td><label>Hasta :</label></td><td><input name="hasta" type="text" placeholder="2013/12/30" value="" style="width:80px;"></td>
                                              
                                               
                                            </tr>
                                        </table>                  
				    </div></form>