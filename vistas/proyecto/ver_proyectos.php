<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_proyecto.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalle del Proyecto</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Nombre:</b><?php  echo $nombre_pro;  ?> </li>
                                                <li><b>Fecha Inicio:</b><?php  echo $fecha_i;  ?></li>
                                               <li><b>Fecha Fin:</b><?php  echo $fecha_f;  ?></li>
                                                <li><b>Asignado a:</b><?php  echo $usuario_p;  ?> </li>
                                                <li><b>Prioridad:</b><?php  echo $prioridad_pro;  ?></li>
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Estado:</b><?php  echo $estado_pro;  ?></li>
                                                
                                                <li><b>Fecha de Registro:</b><?php  echo $fecha_registro_pro;  ?></li>
                                                <li><b>Fecha de Modificacion:</b><?php  echo $fecha_mod_pro;  ?></li>
                                                 <?php if($id_c_p!=0){
                                                    echo '<b>Contacto </b>:';
                                                 $sql1 = "SELECT * FROM sis_contacto where id_contacto=".$id_c_p."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente = $fila1["id_contacto"];$nombre_cli = $fila1["nombre_cont"].' '.$fila1["apellido_cont"];
                                                echo '<a href="../vistas/?id=ver_contacto&cod='.$id_cliente.'">'.$nombre_cli.'</a>';}  ?>
                                                <?php if($id_e_p!=0){
                                                    echo '<b>Empresa </b>:';
                                                 $sql1 = "SELECT * FROM sis_empresa where id_empresa=".$id_e_p."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente1 = $fila1["id_empresa"];$nombre_cli1 = $fila1["nombre_emp"];
                                                echo '<a href="../vistas/?id=ver_empresa&cod='.$id_cliente1.'">'.$nombre_cli1.'</a>';}  ?>
                                                 <li><b>Descripcion: </b>:<?php  echo $descripcion_pro;  ?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                            
                                                <a href="../vistas/?id=proyecto&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                                <a href="../vistas/?id=proyectos&del=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/eliminar.png"></a>
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
require '../vistas/proyecto/actividades.php';
 }
 ?>
