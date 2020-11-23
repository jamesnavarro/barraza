<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_incidencia.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalle de la Novedad</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Radicado :</b><?php  echo $_GET['cod'];  ?> </li>
                                                <li><b>Asunto           :</b><?php  echo $asunto_i;  ?></li>
                                               <li><b>Prioridad          :</b><?php  echo $prioridad_i;  ?></li>
                                                <li><b>Estado       :</b><?php  echo $estado_i;  ?> </li>
                                                <li><b>Tipo :</b><?php  echo $tipo_i;  ?></li>
                                                <li><b>Fuente :</b><?php  echo $fuente_i;  ?></li>
                                                 <?php if($id_contacto_i!=0){
                                                    echo '<b>Contacto </b>:';
                                                 $sql1 = "SELECT * FROM sis_contacto where id_contacto=".$id_contacto_i."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente = $fila1["id_contacto"];$nombre_cli = $fila1["nombre_cont"].' '.$fila1["apellido_cont"];
                                                echo '<a href="../vistas/?id=ver_contacto&cod='.$id_cliente.'">'.$nombre_cli.'</a>';}  ?>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Asignado a:</b><?php  echo $asignado_i;  ?></li>
                                           <?php
if($id_paciente!=0){ ECHO '<b>Paciente </b>:';
                                                 $sql1 = "SELECT * FROM pacientes where id_paciente=".$id_paciente."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente = $fila1["id_paciente"];$nombre_cli = $fila1["nombres"].' '.$fila1["apellidos"];
                                                 echo '<a href="../vistas/?id=ver_paciente&cod='.$id_cliente.'">'.$nombre_cli.'</a>'; }  ?>
                                                <li><b>Fecha de Registro:</b><?php  echo $fecha_registro_i;  ?></li>
<li><b>Fecha de Modificacion:</b><?php  echo $fecha_mod_i; ?></li>
<li><b>Registrado por:</b><?php  echo $registrado_por; ?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               <li><b>Descripcion: </b>:<?php  echo $descripcion_i;  ?></li>
                                                <li><b>Solucion: </b>:<?php  echo $registro_i;  ?></li>
                                                <a href="../vistas/?id=incidencia&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                                <a href="../vistas/?id=incidencias&del=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/eliminar.png"></a>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/incidencia.jpg">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
 <?php
 if(isset($_GET['cod'])){
require '../vistas/incidencias/actividades.php';

 }
 ?>