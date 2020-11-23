<?php
 if(isset($_GET['cod'])){
require '../modelo/llamada_ver.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Registro de llamada</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Asunto           :</b><?php  echo $asunto_lla;  ?></li>
                                                <li><b>Fecha Programada:</b><?php  echo $fecha_inicio_lla;  ?></li>
                                                <li><b>Duración         :</b><?php  echo $duracion;  ?> Minutos</li>
                                                <li><b>Asignado a :</b><?php  echo $asignado_lla;  ?></li>
                                                <li><b>Estado :</b><?php  echo $estado_2_lla;  ?></li>
                                                <?php if($id_empresa_lla!=0){  echo '<b>Empresa </b>:';
                                                 $sql1 = "SELECT * FROM sis_empresa where id_empresa=".$id_empresa_lla."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_e = $fila1["id_empresa"];$namee = $fila1["nombre_emp"];
                                                echo '<a href="../vistas/?id=ver_empresa&cod='.$id_e.'">'.$namee.'</a>'; } ?>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Aviso :</b><?php  echo $aviso_lla;  ?> </li>
                                                
                                                <b> Relacionado con:  </b><?php  echo $ver;  ?>
                                                
                                                <li><b>Fecha de Registro:</b><?php  echo $fecha_registro_lla;  ?></li>
                                                <li><b>Fecha de Modificacion:</b><?php  echo $fecha_registro_mod_lla;  ?></li>
                                                <?php if($id_contacto_lla!=0){  echo '<b>Contacto </b>:';
                                                 $sql1 = "SELECT * FROM sis_contacto where id_contacto=".$id_contacto_lla."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_c = $fila1["id_contacto"];$name = $fila1["nombre_cont"].' '.$fila1["apellido_cont"];
                                                echo '<a href="../vistas/?id=ver_contacto&cod='.$id_c.'">'.$name.'</a>'; } ?>
                                                <?php if($id_paciente!=0){  echo '<b>Paciente </b>:';
                                                 $sql1 = "SELECT * FROM pacientes where id_paciente=".$id_paciente."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_c = $fila1["id_paciente"];$name = $fila1["nombres"].' '.$fila1["apellidos"];
                                                echo '<a href="../vistas/?id=ver_paciente&cod='.$id_c.'">'.$name.'</a>'; } ?>
                                                
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Registrado por :</b><?php  echo $reg_user;  ?></li>
                                                <li><b>Modificado por :</b><?php  echo $mod_user;  ?></li>
                                                <li><b>Detalle </b>:<?php  echo $descripcion_lla;  ?></li>
                                                <?php  if($_SESSION['k_username']==$asignado_lla || $_SESSION['admin']=='Si'){     ?>
                                                <a href="../vistas/?id=llamada&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                                <a href="../vistas/?id=llamadas&del=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/eliminar.png"></a>
                                                <?php  }    ?>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/llamada1.png">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
  <?php
 if(isset($_GET['cod'])){
require '../vistas/llamadas/detalles.php';
 }
 ?>