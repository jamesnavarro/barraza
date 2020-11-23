<?php 
include('../../modelo/conexion.php');
?>
<script type="text/javascript" language="javascript" src="../vistas/reportesate/funciones.js?v=1.1"></script>
<script type="text/javascript" language="javascript" src="../vistas/reportesate/chart.js?v=1.1"></script>
   <div class="">
	
	<div class="">

	    <div class="">
	
	      <div class="">
	      	
	      	<div class="">
	      		
	      		<div class="">
						
					<div class="">
						<i class="icon-table"></i>
						<h3>
                                                  Formulario de Reportes
                                                    <span id="imp"></span>
                                                    
                                                </h3>
                                                
					</div> <!-- /widget-header -->
					
					<div class="">
						<!--   codigo aqui james        -->
                                                <div class="form-group">
                                                <div class="col-lg-1">
                                                    <input type="text" style="width:90px" class="form-control" id="ano" value="<?php echo date("Y") ?>"  onpaste="return false"/>
                                                    <label>Año</label>
                                                </div>
                                          
                                                    <div class="col-lg-1">
                                                    <select id="mes" style="width:90px"  class="form-control">
                                                        <option value="">Todos</option>
                                                        <?php
                                                          for($i=1;$i<=12;$i++){
                                                              $num = str_pad($i, 2, "0", STR_PAD_LEFT);
                                                              echo '<option value="'.$num.'">'.$num.'</option>';
                                                          }
                                                        ?>
                                                    </select>
                                                    <label>Mes</label>
                                                </div>
                                                    <div class="col-lg-3">
                                                   <select id="empresa" style="width:270px" class="form-control">
                                                    <option value="">Seleccione</option>
                                                    <?php
                                                    $query = mysql_query("select * from sis_empresa where cliente='Si'");
                                                    while ($row = mysql_fetch_array($query)) {
                                                        echo '<option value="'.$row['rips'].'">'.$row['nombre_emp'].'</option>';
                                                    }


                                                    ?>
                                                </select>
                                                    <label>Empresa</label>
                                                </div>
                                                    <div class="col-lg-2">
                                                   <select id="usuario" style="width:200px" class="form-control">
                                                    <option value="">Seleccione</option>
                                                    <?php
                                                    $query2 = mysql_query("select * from usuarios where estado_empleado='Activo'");
                                                    while ($row = mysql_fetch_array($query2)) {
                                                        echo '<option value="'.$row['usuario'].'">'.$row['nombre'].' '.$row['apellido'].'</option>';
                                                    }


                                                    ?>
                                                </select>
                                                    <label>Profesional</label>
                                                </div>
                                                     <div class="col-lg-2">
                                                   <select id="estado" style="width:200px" class="form-control">
                                                       <option value="">Todas</option>
                                                       <option value="No iniciada">No iniciada</option>
                                                       <option value="En proceso">En proceso</option>
                                                       <option value="Completada">Completada</option>
                                                       <option value="Anulada">Anulada</option>
                                                    
                                                    
                                                </select>
                                                    <label>Estado de Citas</label>
                                                </div>
                                                    <div class="col-lg-2">
                                                        <button onclick="GenerarReporte()">Generar Reporte</button>
                                                </div>
                                                    </div>
                                                <br>
                                                <br><br>
    <p id="msg"></p>
        <div id="mostrar">

        </div>
        		
		    </div> <!-- /span12 -->     	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->



