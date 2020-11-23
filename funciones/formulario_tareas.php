 <font color="red">Aviso: (*)Indica un campo requerido</font><form name="formulario" action="../modelo/insertar_tarea.php" method="post" enctype="multipart/form-data" >
     <div>
                                                           <div><label>Asunto : <font color="red"> *</font></label></<div>
                                                           <div><input type="text" name="asunto" style="width:350px;height:20px;"/></div>
                                                       
                                                      
                                                     
                                                           <div><label>Fecha Inicio : <font color="red"> *</font></label></div>
                                                           <div><input type="text" name="fechai" class="tcal" style="width:80px;height:20px;"/>
                                                              <select name="hora"  style="width:40px;height:20px;" size="2">
                                                                   <option value="00">00</option>
                                                                   <option value="01">01</option>
                                                                   <option value="02">02</option>
                                                                   <option value="03">03</option>
                                                                   <option value="04">04</option>
                                                                   <option value="05">05</option>
                                                                   <option value="06">06</option>
                                                                   <option value="07">07</option>
                                                                   <option value="08" SELECTED DEFAULT>08</option>
                                                                   <option value="09">09</option>
                                                                   <option value="10">10</option>
                                                                   <option value="11">11</option>
                                                                   <option value="12">12</option>
                                                                   <option value="13">13</option>
                                                                   <option value="14">14</option>
                                                                   <option value="15">15</option>
                                                                   <option value="16">16</option>
                                                                   <option value="17">17</option>
                                                                   <option value="18">18</option>
                                                                   <option value="19">19</option>
                                                                   <option value="20">20</option>
                                                                   <option value="21">21</option>
                                                                   <option value="22">22</option>
                                                                   <option value="23">23</option>
                                                                   
                                                               </select>
                                                               :<select name="minuto"  style="width:40px;height:20px;" size="2">
                                                                   <option value="00" SELECTED DEFAULT>00</option>
                                                                   <?php 
                                                                   for ($i=1; $i<=9; $i++) {
                                                                   echo '<option value='..0.$i.'>'..0.$i.'</option>';
                                                                   }
                                                                   for ($i=10; $i<=59; $i++) {
                                                                   echo '<option value='.$i.'>'.$i.'</option>';
                                                                   }
                                                                   ?>
                                                                  
                                                                   
                                                               </select>
                                                               
                                                               (hora/minutos 24H)
                                                         </div>
                                                         
                                                          
                                                           <div><label>Fecha Vencimiento : <font color="red"> *</font></label></div>
                                                           <td><input type="text" name="fechav" class="tcal" style="width:80px;height:20px;"/>
                                                                <select name="hora2"  style="width:40px;height:20px;" size="2">
                                                                  <option value="00">00</option>
                                                                   <option value="01">01</option>
                                                                   <option value="02">02</option>
                                                                   <option value="03">03</option>
                                                                   <option value="04">04</option>
                                                                   <option value="05">05</option>
                                                                   <option value="06">06</option>
                                                                   <option value="07">07</option>
                                                                   <option value="08" SELECTED DEFAULT>08</option>
                                                                   <option value="09">09</option>
                                                                   <option value="10">10</option>
                                                                   <option value="11">11</option>
                                                                   <option value="12">12</option>
                                                                   <option value="13">13</option>
                                                                   <option value="14">14</option>
                                                                   <option value="15">15</option>
                                                                   <option value="16">16</option>
                                                                   <option value="17">17</option>
                                                                   <option value="18">18</option>
                                                                   <option value="19">19</option>
                                                                   <option value="20">20</option>
                                                                   <option value="21">21</option>
                                                                   <option value="22">22</option>
                                                                   <option value="23">23</option>
                                                                   
                                                               </select>
                                                               :<select name="minuto2"  style="width:40px;height:20px;" size="2">
                                                                 <option value="00" SELECTED DEFAULT>00</option>
                                                                  <?php 
                                                                   for ($i=0; $i<=9; $i++) {
                                                                   echo '<option value='..0.$i.'>'..0.$i.'</option>';
                                                                   }
                                                                   for ($i=10; $i<=59; $i++) {
                                                                   echo '<option value='.$i.'>'.$i.'</option>';
                                                                   }
                                                                   ?>
                                                                   
                                                                  
                                                                   
                                                               </select>
                                                               (hora/minutos 24H)
                                                         </div>
                                                         
                                                            <div><label>Prioridad :</label></div>
                                                            <div><select name="prioridad" style="width:130px;height:20px;">
                                                                   <option value="Alta">Alta</option>
                                                                   <option value="Media">Media</option>
                                                                   <option value="Baja">Baja</option>
                                                               </select></div>
                                                          
                                                            <div><label>Asignado a : </label>
                                                           <select name="user" style="width:130px;height:20px;">
                                                                   <option value="<?php echo $_SESSION['k_username']?>"><?php echo $_SESSION['k_username']?></option>
                                                                   
                                                                    <?php
                                                                    include "../modelo/conexion.php";
                                                                    $consulta= "select * from usuarios order by id asc";                     
                                                                    $result=  mysql_query($consulta);
                                                                    while($fila=  mysql_fetch_array($result)){
                                                                    $valor=$fila['usuario'];
                                                                    if($_SESSION['k_username']==$valor){}else{
                                                                    echo"<option value='".$valor."'>".$valor."</option>";}
                                                                    }
                                                                    ?>
                                                            
                                                    </select></div><br>
                                                         
                                                           <div><label>Descripcion :</label></div>
                                                           <div><textarea name="descripcion" style="width:90%;" rows="8"></textarea></div>
                                                         
                                                           <div><label>Estado :</label></div>
                                                           <td><select name="estado" style="width:130px;height:20px;">
                                                                   <option value="No iniciada">No iniciada</option>
                                                                   <option value="En proceso">En proceso</option>
                                                                   <option value="Completada">Completada</option>
                                                                   <option value="Pendiente">Pendiente</option>
                                                                   <option value="Aplazada">Aplazada</option>
                                                               </select></div>
                                                        
                                                            <div><label>Relacionado con :</label></div>
                                                           <div><select name="relacionado" id="combo1_1" style="width:130px;height:20px;">
                                                                  <option value="">Seleccione Uno..</option>
                                                                  <option value="Cuenta">Cuenta</option>
                                                                   <option value="Incidencia">Incidencia</option>
                                                                   <option value="Caso">Caso</option>
                                                                   <option value="Contacto">Contacto</option>
                                                                   <option value="Cliente potencial">Cliente potencial</option>
                                                                   <option value="Oportunidad">Oportunidad</option>
                                                                   <option value="Producto">Producto</option>
                                                                   <option value="Proyecto">Proyecto</option>
                                                                   <option value="Presupuesto">Presupuesto</option>
                                                                   <option value="Tarea">Tarea</option>
                                                               
                                                               </select>
                                                            <select name="seleccion"  style="width:130px;height:20px;" id="combo2">
                                                                <option value="<?php if(isset($_GET['tarea_e'])){echo $_GET['tarea_e'];}if(isset($_GET['tarea'])){echo $_SESSION['id_empresa'];}?>"><?php if(isset($_GET['tarea'])){echo $_SESSION['empresa'];}if(isset($_GET['tarea_e'])){echo $_SESSION['nombre_emp'];} ?></option>
                                                                   <option value=""></option>
                                                        <?php
                                                        
                                                        ?>
                                                    </select></div>
                                                     
                                                            <div><label>nombre contacto : *</label></div>
                                                            <div><select name="contacto_t">
                                                         <option value="<?php if(isset($_GET['tarea'])){echo $_GET['tarea'];}?>"><?php if(isset($_GET['tarea'])){echo $_SESSION['nombre'];} ?></option>
                                                        <option value="">Seleccione el contacto</option>
                                                        <?php
                                                        include "../modelo/conexion.php";
                                                        $consulta= "select * from sis_contacto order by id_contacto asc";                     
                                                        $result=  mysql_query($consulta);
                                                        while($fila=  mysql_fetch_array($result)){
                                                          $valor=$fila['nombre_cont'];
                                                          $valor2=$fila['apellido_cont'];
                                                          $id2 = $fila['id_contacto'];
                                                         
                                 
                                                          echo"<option value='".$id2."'>".$valor.' '.$valor2."</option>";
                                                                                      }
                                                            $_SESSION['idca']=$id_ca;
                                                            $_SESSION['fe_re_ca']=$fecha_registro_cam; ?>
                                                    </select></div>
                                                         
                                                            <div><label>Empresa  :</label></div>
                                                            <div><select name="emp">
                                                         <option value="<?php if(isset($_GET['tarea_e'])){echo $_GET['tarea_e'];}if(isset($_GET['tarea'])){echo $_SESSION['id_empresa'];}?>"><?php if(isset($_GET['tarea'])){echo $_SESSION['empresa'];}if(isset($_GET['tarea_e'])){echo $_SESSION['nombre_emp'];} ?></option>
                                                        <option value="">Seleccione la empresa</option>
                                                        <?php
                                                        include "../modelo/conexion.php";
                                                        $consulta= "select * from sis_empresa order by id_empresa asc";                     
                                                        $result=  mysql_query($consulta);
                                                        while($fila=  mysql_fetch_array($result)){
                                                          $valor=$fila['nombre_emp'];
                                                         
                                                          $id2 = $fila['id_empresa'];
                                                         
                                 
                                                          echo"<option value='".$id2."'>".$valor."</option>";
                                                                                      }
                                                            $_SESSION['idca']=$id_ca;
                                                            $_SESSION['fe_re_ca']=$fecha_registro_cam; ?>
                                                    </select></div>
                                                         <div><input type="submit" name="enviar" value="Guardar" class="alt_btn" onclick="">
					                          <input type='reset' name='close' value='Limpiar'></div>
                                                          
                                                     </div></form>
