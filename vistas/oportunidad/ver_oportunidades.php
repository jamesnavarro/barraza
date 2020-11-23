<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_oportunidad.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalle de la Oportunidad</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Nombre Oportunidad:</b><?php  echo $nombre_oport;  ?> </li>
                                                <b>Empresa:</b><?php  echo '<a href="../vistas/?id=ver_empresa&cod='.$id_empresa_oport.'">'.$nombre_emp_oport.'</a>';  ?>
                                               <li><b>Tipo:</b><?php  echo $tipo_oport;  ?></li>
                                                <li><b>Toma de contacto:</b><?php  echo $toma_oport;  ?> </li>
                                                <li><b>Campaña:</b><?php  echo $campana_oport;  ?></li>
                                                <li><b>Probabilidad (%):</b><?php  echo $probabilidad_oport;  ?></li>
                                                <?php if($id_contacto_oport!=0){
                                                    echo '<b>Contacto </b>:';
                                                 $sql1 = "SELECT * FROM sis_contacto where id_contacto=".$probabilidad_oport."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente = $fila1["id_contacto"];$nombre_cli = $fila1["nombre_cont"].' '.$fila1["apellido_cont"];
                                                echo '<a href="../vistas/?id=ver_contacto&cod='.$id_cliente.'">'.$nombre_cli.'</a>';}  ?>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Asignado a:</b><?php  echo $user;  ?></li>
                                                <li><b> Cantidad: (COP $):</b><?php  echo $cantidad_oport;  ?></li>
                                                <li><b>Fecha de cierre:</b><?php  echo $fecha_oport;  ?></li>
                                                <li><b>Próximo paso:</b><?php  echo $paso_oport;  ?></li>
                                                <li><b>Etapa de ventas:</b><?php  echo $etapas_oport;  ?></li>

                                                <li><b>Fecha de Registro:</b><?php  echo $fecha_registro_oport;  ?></li>
                                                <li><b>Fecha de Modificacion:</b><?php  echo $fecha_m_oport;  ?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                                 
                                                 <li><b>Descripcion: </b>:<?php  echo $descripcion_oport;  ?></li>
                                               
                                                <a href="../vistas/?id=oportunidad&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                                <a href="../vistas/?id=oportunidades&del=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/eliminar.png"></a>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/oportunidad.jpg">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
   <?php
 if(isset($_GET['cod'])){
require '../vistas/oportunidad/actividades.php';
 }
 ?>