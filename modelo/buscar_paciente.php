 <div class="span4">
     <input type="text" name="nombre" class="span8" placeholder="Digite el nombre del paciente">
                                        </div>
                                        <div class="span4">
                                            <select  name="empresa"  class="span8"   id="select2_2">
                                                <option value=''>Buscar por empresa</option>
                                                <?php
                                                require '../modelo/conexion.php';
                                                $consulta= "SELECT * FROM `sis_empresa` where cliente='Si' ";                     
                                                $result=  mysql_query($consulta);
                                                while($fila=  mysql_fetch_array($result)){
                                                $valor1c=$fila['nombre_emp'];
                                                $rips=$fila['rips'];
                                                echo"<option value=".$rips.">".$valor1c."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="span4">
                                            <input type="submit" class="btn" name="Buscar" value="Buscar">
                                            
                                        </div>