<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_caso.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalle del Caso</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Radicado :</b><?php  echo $_GET['cod'];  ?> </li>
                                                <li><b>Asunto           :</b><?php  echo $asunto_cas;  ?></li>
                                               <li><b>Lugar          :</b><?php  echo $prioridad_cas;  ?></li>
                                                <li><b>fecha del caso :</b><?php  echo $estado_cas;  ?> </li>
                                                <li><b>Asistente 1 :</b><?php  echo $tipo_cas;  ?></li>
                                                 <li><b>Asistente 2 :</b><?php  echo $tipo_cas2;  ?></li>
                                                  <li><b>Asistente3 :</b><?php  echo $tipo_cas3;  ?></li>
                                                <?php if($id_contacto_caso!=0){  echo '<b>Contacto </b>:';
                                                 $sql1 = "SELECT * FROM sis_contacto where id_contacto=".$id_contacto_caso."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_c = $fila1["id_contacto"];$name = $fila1["nombre_cont"].' '.$fila1["apellido_cont"];
                                                echo '<a href="../vistas/?id=ver_contacto&cod='.$id_c.'">'.$name.'</a>'; } ?>
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Asignado a:</b><?php  echo $asignado_caso;  ?></li>
                                                <b>Paciente </b>:<?php
                                                 $sql2 = "SELECT * FROM pacientes where id_paciente=".$id_paciente."";
                                                $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                $id_cliente = $fila2["id_paciente"];$nombr = $fila2["nombres"].' '.$fila2["apellidos"];
                                                 echo '<a href="../vistas/?id=ver_paciente&cod='.$id_cliente.'">'.$nombr.'</a>';  ?>
                                                <li><b>Fecha de Registro:</b><?php  echo $fecha_registro_caso;  ?></li>
                                                <li><b>Fecha de Modificacion:</b><?php  echo $fecha_mod_caso;  ?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                                
                                                 <li><b>Observaciones: </b>:<?php  echo $descripcion_cas;  ?></li>
                                                 <li><b>Compromisos: </b>:<?php  echo $resolucion_cas;  ?></li>
                                                    <?php  if($_SESSION['k_username']==$asignado_caso || $_SESSION['admin']=='Si'){     ?>
                                                <a href="../vistas/?id=caso&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                                <a href="../vistas/?id=casos&del=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/eliminar.png"></a>
                                        <button><a href="../vistas/imp_casos.php?cod=<?php echo $_GET['cod']; ?>" title="" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/word.png"> Exportar</a></button>                                                  
  <?php  }  ?>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/casos.jpg">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
 <?php
 if(isset($_GET['cod'])){
require '../vistas/casos/actividades.php';

 }
 ?>