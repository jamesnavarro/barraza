<?php 
include('../modelo/conexion.php');
?>
<script type="text/javascript" language="javascript" src="../vistas/bodegas/funciones.js"></script>

<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title">Parametros del Inventario</h4>
                        <ul class="toolbar pull-left">
                            <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                        </ul>
                </header>
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
  
                            <div class="control-group">
                
                                <div class="controls">
                                    <div class="row-fluid">
                                     
                                               <div style="float: left;">
                                                    <input type="search" autofocus placeholder="Buscar Bodega" id="buscar_caja" onkeypress="return l(even)"  onpaste="return false"/>
                                                </div>
                                                <div style="float: right;">
                                                    <input type="button" value="Nueva Bodega" onclick="formulario_bod(0)" class="btn btn-primary"/>
                                                </div>
                                                <br>
                                                <hr>
                                    </div>
                            </div>
                     <br>
                                     
                        <div class="tabbable" style="margin-bottom: 25px;">
                            <div class="tab-content">
                                <div class="" id="tab1">
                                    <div class="row-fluid">
                                        <div class="span12 widget lime">
                                            <section class="body">
                                                <div class="body-inner no-padding">
                                                       <p id="msg"></p>
        <div id="mostrar">
            <?php 
            include '../vistas/bodegas/mostrar_tabla.php';
            ?>
        </div>
                                                </div>
                                            </section>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div><hr>
                
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
 <div class="modal fade" id="modalMov" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registrar Tipo de Movimientos</b></h4>
            </div>
              <div class="modal-body" id="lista_mov">
  
	        
            
                <div id="mensajem"></div>
                
                <br />
                <div id="contenidoRegistro"></div>
                
            </div>
              <div class="modal-footer">
                    Nombre del Movimiento:
                    <input type="text" class="form-control" id="mov" /> 
                    <input type="hidden" class="form-control" id="sw" value="4"/>
                    <input type="hidden" class="form-control" id="idm"/>
                    <input type="button" id="Add_Mov" class="btn btn-success" value="Guardar" />
                </div>
          </div>
        </div>
      </div>



