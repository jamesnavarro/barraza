<a href="../vistas/formulario_contacto_potencial.php?codigo=<?php echo $idc ?>"><INPUT TYPE="button" VALUE="Formulario Complecto" class="alt_btn"></a>
<fieldset style="width:100%; float:center; margin-right: 3%;">
            <form name="insertar5" action="../modelo/insertar_contacto_potencial_1.php" method="post" enctype="multipart/form-data">
                <br><div><label>Toma de Contacto :</label>
                <select name="toma_contacto" id="lead_source" title='' tabindex="106" style="width:130px;height:20px;" >
                                                                    <option label="" value=""></option>
                                                                    <option label="Llamada en Frío" value="Llamada en Frío">Llamada en Frío</option>
                                                                    <option label="Cliente Existente" value="Cliente Existente">Cliente Existente</option>
                                                                    <option label="Auto Generado" value="Auto Generado">Auto Generado</option>
                                                                    <option label="Empleado" value="Empleado">Empleado</option>
                                                                    <option label="Partner" value="Partner">Partner</option>
                                                                    <option label="Relaciones Públicas" value="Relaciones Públicas">Relaciones Públicas</option>
                                                                    <option label="Correo Directo" value="Correo Directo">Correo Directo</option>
                                                                    <option label="Conferencia" value="Conferencia">Conferencia</option>
                                                                    <option label="Exposición" value="Exposición">Exposición</option>
                                                                    <option label="Sitio Web" value="Sitio Web">Sitio Web</option>
                                                                    <option label="Recomendación" value="Recomendación">Recomendación</option>
                                                                    <option label="Email" value="Email">Email</option>
                                                                    <option label="Campaña" value="Campaña">Campaña</option>
                                                                    <option label="Otro" value="Otro">Otro</option>
                                                                    </select></div><br>
                                                                    <div><label>Campaña :</label>
                                                          <select name="campaña" style="width:130px;height:20px;">
                                                        <option value=""></option>
                                                        <?php
                                                        include "../modelo/conexion.php";
                                                        $consulta= "select * from sis_campana order by id_campana asc";                     
                                                        $result=  mysql_query($consulta);
                                                        while($fila=  mysql_fetch_array($result)){
                                                          $nom=$fila['nombre_cam'];
                                                          $id = $fila['id_campana'];
                                                          
                                                         
                                 
                                                          echo"<option value='".$id."'>".$nom."</option>";
                                                                                      }
                                                             ?>
                                                          </select>
                                                                    </div><br><label>Descripcion : *</label>
                                                          <textarea name="descripcion_pot" style="width:40%;" rows="6"></textarea><br><br><br><br><br><br>
                                                          <label>Referido por : *</label>
                                                          <input type="text" name="referido" style="width:350px;height:20px;"/><br><br>
                                                        <label>Nombre : *</label>
                                                           <input type="text" name="nombre" value="<?php echo $_SESSION['n1']; ?>" style="width:350px;height:20px;"/><br><br>
                                                           <label>Apellidos : *</label>
                                                            <input type="text" name="apellido" value="<?php echo $_SESSION['a1']; ?>" style="width:350px;height:20px;"/><br><br>
                                                            <label>Empresa :</label>
                                                           <input type="text" name="empresa" value="<?php echo $_SESSION['empresa']?>" style="width:350px;height:20px;"/><br><br>
                                                           <div><label>Llamar :</label>
                                                           <select name="llamada" style="width:130px;height:20px;">
                                                                   
                                                                   <option value="Si">Si</option>
                                                                   <option value="No">No</option>
                                                               </select></div><br>
                                                           
                                                           <div><label>Estado :</label>
                                                            <td><select name="estado_pot" style="width:130px;height:20px;">
                                                                   <option value="Nuevo">Nuevo</option>
                                                                   <option value="Asignado">Asignado</option>
                                                                   <option value="En proceso">En proceso</option>
                                                                   <option value="Convertido">Convertido</option>
                                                                   <option value="Reciclado">Reciclado</option>
                                                                   <option value="Muerto">Muerto</option>
                                                                   
                                                               
                                                               </select></div><br>
                                                              
                                                            <label>Cargo :</label>
                                                            <input type="text" name="cargo" style="width:350px;height:20px;"/><br><br>
                                                            <label>Departamento :</label>
                                                            <input type="text" name="departamento1" style="width:350px;height:20px;"/><br><br>
                                                            <div><label>Descripcion de estado :</label>
                                                           <textarea name="descripcion_est_pot" style="width:40%;" rows="6"></textarea></div><br><br><br><br><br><br>
                                                           <label>Telefono Oficina:</label>
                                                           <input type="text" name="telefono" style="width:350px;height:20px;"/><br><br>
                                                           <label>Fax:</label>
                                                            <input type="text" name="fax" style="width:350px;height:20px;"/><br><br>
                                                            <label>Celular:</label>
                                                          <input type="text" name="celular" style="width:350px;height:20px;"/><br><br>
                                                          <label>Telefono Casa:</label>
                                                          <input type="text" name="tel_casa" style="width:350px;height:20px;"/><br><br>
                                                          <label>Telefono Alternativo:</label>
                                                          <input type="text" name="tel_alt" style="width:350px;height:20px;"/><br><br>
                                                          <label>Asignado a :</label>
                                                          <input type="text"  name="usuario" value="<?php echo $_SESSION['k_username']; ?>" style="width:350px;height:20px;"><br><br>
               
                  <input type="submit" name="Guardar" title="guardar datos" class="alt_btn" value="Guardar">
					                        
                </form>
		    </fieldset>
