<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_nota.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalle de la nota</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Asunto           :</b><?php  echo $asunto_no;  ?></li>
                                                <b>Adjunto :</b> <?php if(isset($_GET['cod'])){ echo '<a href="../vistas/?id=ver_notas&cod='.$_GET['cod'].'&archivo='.$adjunto.'" >'.$adjunto.'</a>' ;}  ?>
                                               
                                                <li><b>Area de         :</b><?php  echo $area;  ?> </li>
                                                <li><b>Asignado a :</b><?php  echo $user_no;  ?></li>
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Relacionado con:</b><?php  echo $seleccion_no;  ?></li>
                                                <b>Detalle:</b><?php  echo $ver;  ?>
                                                <li><b>Fecha de Registro:</b><?php  echo $fecha_r_no.' por '.$reg;  ?></li>
                                                <li><b>Fecha de Modificacion:</b><?php  echo $fecha_m_no.' por '.$mod;  ?></li>
                                                <?php if($id_paciente!=0){  echo '<b>Contacto </b>:';
                                                 $sql1 = "SELECT * FROM pacientes where id_paciente=".$id_paciente."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_c = $fila1["id_paciente"];$name = $fila1["nombres"].' '.$fila1["apellidos"];
                                                echo '<a href="../vistas/?id=ver_paciente&cod='.$id_c.'">'.$name.'</a>'; } ?>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                                
                                                 <li><b>Nota : </b>:<?php  echo $nota_no;  ?></li>
       <?php  if($_SESSION['k_username']==$user_no || $_SESSION['admin']=='Si'){     ?>
                                                <a href="../vistas/?id=nota&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                                <a href="../vistas/?id=notas&del=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/eliminar.png"></a>
       <?php }   ?>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/notas.jpg">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
