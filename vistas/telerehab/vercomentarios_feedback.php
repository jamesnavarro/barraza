<?php
 if(isset($_GET['cod'])){
require '../modelo/feedback_ver.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalle del Feeback</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span9">
                                            <ul class="arrow">
                                                <li><b>Título           :</b><?php  echo $description;  ?></li>
                                                <li><b>Fecha de creación:</b><?php  echo $fecha_crea;  ?></li>
												<li><b>Paciente:</b><?php  echo $paciente;  ?></li>
												<li><b>Profesional:</b><?php  echo $profesional;  ?></li>
                                                <li><b>Video: <a href="telerehab/ventana.php?vide=<?php echo $video;?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=600'); return false;">Click Aquí</a> 
</b> </li>
                                                <li><b>Fecha de actualización:</b><?php  echo $fecha_act;  ?></li>
                                                
                                            </ul>


											</div>
                                   
                                        <div class="span3">
                                            <img src="../imagenes/reunion.png">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
  <?php
 if(isset($_GET['cod'])){
require '../vistas/telerehab/commentsl.php';
 }
 ?>