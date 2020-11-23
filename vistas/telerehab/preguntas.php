<script src="../vistas/telerehab/preguntas.js"></script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">	
								
                        <div class="span12 widget dark stacked" id="panelconsulta">

                            <header>
                                <h4 class="title">Lista de Preguntas</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse2" href="#collapse2"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">
                                            <!-- Normal Tabs -->
 <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                                <div class="tab-content">

                                    <div class="" id="tab1">

                                         <!-- START Row -->
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Listado de Preguntas</a></li>
  <li><a data-toggle="tab" href="#menu1">Crear Pregunta</a></li>
</ul>
                                         <div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>Lista</h3>
    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        
                        <div class="span12 widget lime">

                            
                            <section class="body">

                                <div class="body-inner no-padding">
<?php
if(isset($_GET['ids'])){ ?>
 <button onclick="add_sesiones_preguntas(<?php echo $_GET['ids'].','.$_GET['idpa'] ?>)">Agregar preguntas a las sesiones</button> <a href="../vistas/?id=ver_orden_interna&ord=<?php echo $_GET['ord'] ?>">  Volver a la orden</a>
<?php
} ?>
 <?php
if(isset($_GET['ide'])){ ?>
 <button onclick="add_ejercicios_preguntas(<?php echo $_GET['ide'].','.$_GET['idpa'] ?>)">Agregar preguntas a los ejercicios</button> <a href="../vistas/?id=ver_orden_interna&ord=<?php echo $_GET['ord'] ?>">  Volver a la orden</a>
<?php
} ?>
 <table class="table table-bordered table-striped table-hover" id="tabla_ajax_pr">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Descripcion</th>
                        <th>Creado</th>
                        <th>Add Preguntas</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="mostrar_preguntas">
                    
                </tbody>
            </table>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Crear Preguntas | Formulario</h3>
        <div class="control-group">
        <label class="control-label">Id</label>
        <div class="controls"><input type="text" id="ideje"  class="span12"  disabled ></div>
        <div class="control-group">
        <label></label><div class="controls"> </div>
        <label class="control-label">Descripcion de la Preguntas</label>
        <div class="controls"><input type="text" id="descripcion"  class="span12"  required></div>
        <label></label><div class="controls"> </div>
        <button type="button" id="guardar" onclick="guardar_pre();"  data-toggle="tab" href="#home"><img src="../images/nuevo.png" width="15px"> Guardar</button>
       </div>
  </div>

</div>
                    

                    <!--/ END Row -->

                                    </div>


                                </div>

                            </div><!--/ Normal Tabs -->

                                        

                                </div>

                              

                            </section>

                        </div>

                                    

<!--                                    Insumos-->

      

                    </div>

  

                            </section></div>

