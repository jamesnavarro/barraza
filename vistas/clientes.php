<?php 
include('../modelo/conexion.php');
?>
<script type="text/javascript" language="javascript" src="../vistas/clientes/funciones.js?v=1.4"></script>

<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title">Lista de Pacientes</h4>
                        <ul class="toolbar pull-left">
                            <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                        </ul>
                </header>
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
  
                            <div class="control-group">
                
                                <div class="controls">
                                    <div class="row-fluid">
                                        <div style="float: left;width: 80%;">
                                                    <input type="text" placeholder="Nombres" class="span3" id="buscar_cliente" onkeypress="return l(even)"  onpaste="return false" title="Buscar por Nombres"  data-toggle="tooltip" data-placement="bottom"/>
                                                    <input type="text" placeholder="Apelidos" class="span3" id="apellido" onkeypress="return l(even)"  onpaste="return false" title="Buscar por Apellidos"  data-toggle="tooltip" data-placement="bottom"/>
                                                    
                                                    <select id="empresa" title="Seleccione la empresa de salud" data-toggle="tooltip" data-placement="bottom" class="span2">
                                                       <option value="">Empresas</option>
                                                        <?php
                                                           $query = mysql_query("select * from sis_empresa where cliente='Si' ");
                                                           while($s = mysql_fetch_array($query)){
                                                               echo '<option value="'.$s['rips'].'">'.$s['nombre_emp'].'</option>';
                                                           }
                                                        ?>
                                                    </select>
                                                    <select id="estado" title="Seleccione Estado del Paciente" data-toggle="tooltip" data-placement="bottom" class="span2">
                                                        <option value="">Estados</option>
                                                        <option value="Activo">Activo</option>
                                                        <option value="No Activo">No Activo</option>
                                                         
                                                    </select>
                                                        
                                                </div>
                                                <div style="float: right;width: 20%">
                                                   <input type="button" value="Buscar" onclick="MostrarClientes(1)" class="btn btn-primary"/>
                                                </div>
                                    </div>
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
            $estado = '';
            $empresa = '';
            include '../vistas/clientes/mostrar_tabla.php';
            ?>
        </div>
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Subir archivo en excel</h4>
      </div>
      <div class="modal-body">
        <form id="subida">
                <table>
                <tr>
                    <td><input type="file" id="foto" name="foto" accept=".csv"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span id="msg2">Cargar datos</span>
                    </td>

                </tr>

                </table>
            <button  class="btn btn-success btn-next"  id="boton" data-last="Finish">Subir archivo<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button>
          
        </form>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Subir Ordenes Internas por excel</h4>
      </div>
      <div class="modal-body">
        <form id="subida2">
                <table>
                <tr>
                    <td><input type="file" id="fotoo" name="foto" accept=".csv"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span id="msgo">Cargar datos</span>
                    </td>

                </tr>

                </table>
            <button  class="btn btn-success btn-next"  id="botono" data-last="Finish">Subir Ordenes<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button>
          
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>