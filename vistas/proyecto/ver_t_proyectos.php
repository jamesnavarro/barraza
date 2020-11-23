<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_proyecto_t.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Tareas del Proyecto</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Nombre:</b><?php  echo $nombre_tarea;  ?> </li>
                                                <li><b>Fecha Inicio:</b><?php  echo $fecha_inicial;  ?></li>
                                               <li><b>Fecha Fin:</b><?php  echo $fecha_final;  ?></li>
                                                <li><b>Area Asignada:</b><?php  echo $area;  ?> </li>
                                                <li><b>Asignado a:</b><?php  echo $usuario;  ?> </li>
                                                <li><b>Prioridad:</b><?php  echo $prioridad;  ?></li>
                                                <b>Proyecto </b>:<?php
                                                 $sql1 = "SELECT * FROM sis_proyecto where id_proyecto=".$id_proyecto."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente = $fila1["id_proyecto"];$nombre_cli = $fila1["nombre_pro"];
                                                 echo '<a href="../vistas/?id=ver_proyectos&cod='.$id_cliente.'">'.$nombre_cli.'</a>';  ?>
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Estado:</b><?php  echo $estado_tarea;  ?></li>
                                                 <li><b>Porcentaje(%):</b><?php  echo $porcentaje_tarea;  ?></li>
                                                  <li><b> Duracion :</b><?php  echo $duracion_horas;  ?></li>
                                                   <li><b> Ocupacion en (%):</b><?php  echo $ocupacion;  ?></li>
                                                
                                                <li><b>Fecha de Registro:</b><?php  echo $fecha_r;  ?></li>
                                                <li><b>Fecha de Modificacion:</b><?php  echo $fecha_m;  ?></li>
                                                 <li><b>Descripcion: </b>:<?php  echo $descripcion_tarea;  ?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                            
                                                <a href="../vistas/?id=ver_proyectos&up1=<?php  echo $_GET["cod"];  ?>&cod=<?php  echo $id_proyecto;  ?>"><img src="../imagenes/modificar.png"></a>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/proyecto.jpg">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
   <?php
 if(isset($_GET['cod'])){
require '../vistas/proyecto/tareas.php';
 }
 ?>
