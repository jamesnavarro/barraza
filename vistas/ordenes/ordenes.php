<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
?>
<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title"><span class="icon icone-crop"></span>Ordenes Internas</h4>
                     <span class="label label-important"></span>
                </header>
               
                    <section id="collapse1" class="body collapse in">
                        <div class="body-inner">
                            <div class="tabbable" style="margin-bottom: 25px;">
                              <span id="panel">
                              <?php
                                  include 'estados.php';
                              ?>
                              </span> 
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab10">
                                        <div class="row-fluid">
                                            <div class="span12 widget lime">
                                                <section class="body">
                                                    <div class="body-inner no-padding">
                                                        <?php
                                                         include '../vistas/pagina_principal/en_proceso.php';
                                                         ?>
                                                     </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane <?php if(isset($_GET['up'])){echo 'active';} ?>" id="tab11">
                                         <div class="row-fluid">
                                           <div class="span12 widget lime">
                                                <section class="body">
                                                    <div class="body-inner no-padding">
                                                         <?php
                                                          include '../vistas/pagina_principal/completados.php';
                                                         ?>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="tab-pane <?php if(isset($_GET['up'])){echo 'active';} ?>" id="tab12">
                                         <div class="row-fluid">
                                           <div class="span12 widget lime">
                                                <section class="body">
                                                    <div class="body-inner no-padding">
                                                         <?php
                                                         include '../vistas/pagina_principal/a_facturar.php';
                                                         ?>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>    
                </section>


            </div>
        </div>
    </section>
 </div>



