<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_campana.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalle de la Campaña</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Nombre:</b><?php  echo $nombre_ca;  ?> </li>
                                                <li><b>Estado:</b><?php  echo $estado_ca;  ?></li>
                                               <li><b>Fecha Inicio:</b><?php  echo $fecha_i_ca;  ?></li>
                                                <li><b>Fecha Fin</b><?php  echo $fecha_f_ca;  ?> </li>
                                                <li><b>Tipo :</b><?php  echo $tipo_ca;  ?></li>
                                                <li><b>Presupuesto:</b><?php  echo $presupuesto_ca;  ?></li>
                                                <?php if($id_cont_c!=0){
                                                    echo '<b>Contacto </b>:';
                                                 $sql1 = "SELECT * FROM sis_contacto where id_contacto=".$id_cont_c."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente = $fila1["id_contacto"];$nombre_cli = $fila1["nombre_cont"].' '.$fila1["apellido_cont"];
                                                echo '<a href="../vistas/?id=ver_contacto&cod='.$id_cliente.'">'.$nombre_cli.'</a>';}  ?>
                                                <?php if($id_emp_c!=0){
                                                    echo '<b>Empresa </b>:';
                                                 $sql1 = "SELECT * FROM sis_empresa where id_empresa=".$id_emp_c."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente1 = $fila1["id_empresa"];$nombre_cli1 = $fila1["nombre_emp"];
                                                echo '<a href="../vistas/?id=ver_empresa&cod='.$id_cliente1.'">'.$nombre_cli1.'</a>';}  ?>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Ingresos Esperados: </b><?php  echo $ingreso_ca;  ?></li>
                                                <li><b>Coste Real:</b><?php  echo $costo_r;  ?></li>
                                                <li><b>Coste Esperado: </b><?php  echo $costo_e;  ?></li>
                                                <li><b>Fecha Modificación:</b><?php  echo $fecha_m_cam;  ?></li>
                                                <li><b>Fecha Alta: </b><?php  echo $fecha_registro_cas;  ?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                                 <li><b>Asignada a: </b>:<?php  echo $asig;  ?></li>
                                                 <li><b>Objetivo: </b>:<?php  echo $obj;  ?></li>
                                                 <li><b>Descripcion: </b>:<?php  echo $des;  ?></li>
                                                
                                                <a href="../vistas/?id=campana&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                                <a href="../vistas/?id=campanas&del=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/eliminar.png"></a>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/campana.jpg">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
