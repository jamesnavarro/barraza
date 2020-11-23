<?php 
include('../modelo/conexion.php');
?>
<script type="text/javascript" language="javascript" src="../vistas/clientes/funciones.js"></script>

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
                                                    <input type="text" placeholder="año" class="span1" id="ano" value="<?php echo date("Y"); ?>"  title="Buscar por año"  data-toggle="tooltip" data-placement="bottom"/> 
                                                    <select id="mes" title="Seleccione el mes" data-toggle="tooltip" data-placement="bottom" class="span2">
                                                        <option value="">Todos</option>
                                                        <option value="01">Enero</option>
                                                        <option value="02">Febrero</option>
                                                        <option value="03">Marzo</option>
                                                        <option value="04">Mayo</option>
                                                        <option value="05">Abril</option>
                                                        <option value="06">Junio</option>
                                                        <option value="07">Julio</option>
                                                        <option value="08">Agosto</option>
                                                        <option value="09">Septiembre</option>
                                                        <option value="10">Octubre</option>
                                                        <option value="11">Noviembre</option>
                                                        <option value="12">Diciembre</option>
                                                         
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

