<?php 
include('../../modelo/conexion.php');
?>
<script type="text/javascript" language="javascript" src="../vistas/reportesate/funciones.js?v=1.2"></script>
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
                                                  Generar Reporte de Efectividad
                                                    <span id="imp"></span>
                                                    
                                                </h3>
                                                
					</div> <!-- /widget-header -->
					
					<div class="">
						<!--   codigo aqui james        -->
                                                <div class="form-group">
                                                <div class="col-lg-1">
                                                    <input type="text" style="width:90px" class="form-control" id="f1" value="<?php echo date("Y/01/01") ?>"  onpaste="return false"/>
                                                    <label>Fecha Inicial</label>
                                                </div>
                                                    <div class="col-lg-1">
                                                    <input type="text" style="width:90px" class="form-control" id="f2" value="<?php echo date("Y/m/31") ?>"  onpaste="return false"/>
                                                    <label>Fecha Inicial</label>
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
                                                   <select id="estado" style="width:200px" class="form-control" disabled>
                                                       <option value="Completada">Completada</option>
                                                       <option value="No iniciada">No iniciada</option>
                                                       <option value="En proceso">En proceso</option>
                                                       <option value="Anulada">Anulada</option>  
                                                </select>
                                                    <label>Estado de Atenciones</label>
                                                </div>
                                                    <div class="col-lg-2">
                                                        <button onclick="GenerarReporteEfe()">Generar Reporte</button>
                                                </div>
                                                    </div>
                                                <br>
                                                <br><br>
    <p id="msg"></p>
        <div id="mostrar_efe">

        </div>
        		
		    </div> <!-- /span12 -->     	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->



