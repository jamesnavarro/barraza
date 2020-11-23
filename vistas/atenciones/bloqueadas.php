<?php 
include('../modelo/conexion.php');
?>
<script type="text/javascript" language="javascript" src="../vistas/atenciones/funciones.js"></script>

<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title">Ordenes Bloquedas / Anuladas</h4>
                        <ul class="toolbar pull-left">
                            <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                        </ul>
                </header>
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
  
                            <div class="control-group">
                
                     <br>
                                     
                        <div class="tabbable" style="margin-bottom: 25px;">
                            <div class="tab-content">
                                <div class="" id="tab1">
                                    <div class="row-fluid">
                                        <div class="span12 widget lime">
                                            <section class="body">
                                                <div class="body-inner no-padding">
                                                       <p id="msg"></p>
                                                       <table  class="table table-bordered table-striped table-hover" id="">
                                                           <thead>
                                                              <th>O.I</th>
                                                              <TH>O.E</TH>
                                                              <th>DESCRIPCION ATENCION</th>
                                                              <th>PORC. %</th>
                                                              <th>Vencimiento</th>
                                                              <th>PACIENTE</th>
                                                              <th>ESTADO</th>
                                                              <th>USUARIO</th>
                                                           </thead>
                                                           <tr>
                                                               <td><input type="text" id="interna" value="" style="width:50px" onkeyup="MostrarBloquedas(1);"></td>
                                                               <td><input type="text" id="externa" value="" style="width:50px" onkeyup="MostrarBloquedas(1);"></td>
                                                               <td><input type="text" id="atencion" value="" style="width:100%" onkeyup="MostrarBloquedas(1);"></td>
                                                               <td><input type="text" id="" value="" style="width:40px" disabled></td>
                                                               <td><input type="date" id="fecha" value="<?php echo date("Y-m-d") ?>" style="width:100%" onchange="MostrarBloquedas(1);"></td>
                                                               <td><input type="text" id="paciente" value="" style="width:100%" onkeyup="MostrarBloquedas(1);"></td>
                                                               <td><input type="text" id="" value="" style="width:40px" disabled></td>
                                                               <td><input type="text" id="asignado" value="" style="width:70px" onclick="list_user()" onchange="MostrarBloquedas(1);"></td>
                                                           </tr>
                                                           <tbody id="mostrar_bloqueadas">
                                                               
                                                           </tbody>
                                                       </table>
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
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Desbloquear Atencion</b></h4>
            </div>
              <div class="modal-body" id="lista_mov">
  
	             Orden Interna:
                    <input type="text" class="form-control" id="oi" /> 
                    <br>
                    Fecha de Vencimiento
                    <input type="date" class="form-control" id="fv" /> 
                
            </div>
              <div class="modal-footer">
                  <input type="button" id="save" onclick="update_orden()" class="btn btn-success" value="Guardar" />
                </div>
          </div>
        </div>
      </div>



