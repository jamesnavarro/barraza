<script src="../vistas/telerehab/funciones.js"></script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">	
								
                        <div class="span12 widget dark stacked" id="panelconsulta">

                            <header>
                                <h4 class="title">Lista de Sesiones</h4>
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
  <?php  if(isset($_GET['idt'])){ $active = '';$activex = '';$activey = 'in active';  ?>
    <li class="active"><a data-toggle="tab" href="#menu1">Crear Sesiones</a></li>
  <?php  }else{
      $active = 'active';
      $activex = 'in active';
      $activey = '';
  }   ?>
  <li class="<?php echo $active ?>"><a data-toggle="tab" href="#home">Listado</a></li>

</ul>
                                         <div class="tab-content">
  <div id="home" class="tab-pane fade <?php echo $activex ?>">
    <h3>Listado detallado de Sesiones</h3>
    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        
                        <div class="span12 widget lime">

                            
                            <section class="body">

                                <div class="body-inner no-padding">

 <table class="table table-bordered table-striped table-hover" id="tabla_ajax_se">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Titulo de la sesion</th>
                        <th>Descripcion</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="mostrar_sesion">
                    
                </tbody>
            </table>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>
  </div>
  <div id="menu1" class="tab-pane fade <?php echo $activey ?>">
    <h3>Formulario de sesiones</h3>
        <div class="control-group">
        <label class="control-label">Id</label>
        <div class="controls"><input type="text" id="ideje"  class="span12"  disabled ></div>
        <div class="control-group">
        <label class="control-label">Titulo de la sesion</label>
        <div class="controls"><input type="text" id="titulo"  class="span12"  required></div>
        <label></label><div class="controls"> </div>
        <label class="control-label">Descripcion de la sesion</label>
        <div class="controls"><input type="text" id="descripcion"  class="span12"  required></div>
        <label></label><div class="controls"> </div>
        <label class="control-label">Tratamiento</label>
        <div class="controls"><input type="text" id="estado"  value="<?php echo $_GET['idt'] ?>" class="span12" disabled></div>
        <label></label><div class="controls"> </div>
        <button type="button" id="guardar" onclick="guardar_eje(<?php echo $_GET['ord'] ?>);"><img src="../images/nuevo.png" width="15px"> Guardar</button>
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

