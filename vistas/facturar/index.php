<!--<script type="text/javascript" language="javascript" src="../vistas/facturar/funciones.jsv=1.3">-->
<script>
$(function() {
        $('#empresa').change(function(){
		MostrarEm();
	});
         $('#pacientex').keyup(function(){
		MostrarEm();
	});
 
    });
    function seleccionar(orden){
         var id = $('#'+orden).is(":checked");
         //alert(orden+' '+id);
        $.ajax({
				type: 'GET',
				data: 'orden='+orden+'&id='+id+'&sw=4',
				url: '../vistas/facturar/acciones.php',
				success: function(data){
						console.log(data);
                                                MostrarEm();
						
				}
			});
    }
    function est(orden){
         //alert(orden+' '+id);
         var c = confirm("Estas seguro de cambiar el estado a Revisado");
         if(c){
        $.ajax({
				type: 'GET',
				data: 'orden='+orden+'&sw=5',
				url: '../vistas/facturar/acciones.php',
				success: function(data){
						alert(data);
                                                MostrarEm();
						
				}
			});
                    }
    }
function MostrarEm(){
    var empresa = $('#empresa').val();
    var paciente = $('#pacientex').val();

 var ini = $('#ini').val();
 var fin = $('#fin').val();
  var est = $('#est').val();
   var cod = $('#cod').val();
   var sel = $('#sel').val();
		$.ajax({
				type: 'GET',
				data: 'empresa='+empresa+'&paciente='+paciente+'&ini='+ini+'&fin='+fin+'&est='+est+'&cod='+cod+'&sel='+sel+'&sw=1',
				url: '../vistas/facturar/tabla.php',
				success: function(data){
                   
						$('#mostrar').html(data);
						
				}
			});
		return false;
}
function up_orden(id){
    var emp = $("#empr").val();
    var nemp = $("#nempr").val();

        var tx = $("#pagos").val();
        var sub = $("#subpagos").val();
        var co = $("#copagos").val();
        var factura =  $("#factura").val();
        var precios = $("#precio"+id).val();
        var copago = $("#copago"+id).val();
        //var copagos = $("#copagos").val();
        var cod = $("#co"+id).val();
        var de = $("#de"+id).val();
        var oe = $("#oe"+id).val();
        var pr = $("#pr"+id).val();
        var cop = $("#cop"+id).val();
        var c = confirm("Estas seguro de hacer este cambio?..");
        if(c){
                        $.ajax({
				type: 'GET',
				data: 'id='+id+'&cod='+cod+'&emp='+emp+'&cop='+cop+'&de='+de+'&fact='+factura+'&oe='+oe+'&pr='+pr+'&precio='+precios+'&copago='+copago+'&sw=0',
				url: '../vistas/facturar/acciones.php',
				success: function(d){
                                     alert(d);
                                     MostrarEm();
                                } 
			});
                    }
}
function PreFactura(){
    var regi = $("#regi").val();
    if(regi==''){
        alert("Debes de seleccionar el regimen");
        return false;
    }
    $.ajax({
                type: 'GET',
                data: 'sw=2',
                url: '../vistas/facturar/acciones.php',
                success: function(d){
                     Facturar(d);
                } 
        });
}
function Facturar(factura){
    var emp = $("#empresa").val();
        con = confirm("Esta seguro de Facturar estas consultas? Fact:"+factura);
    if(con){
        var tx = $("#pagos").val();
        var sub = $("#subpagos").val();
        var co = $("#copagos").val();
        var re = $("#registro").val();
        var regi = $("#regi").val();
       $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var precios = $("#precio"+id).val();
                                var copago = $("#copago"+id).val();
                                $.ajax({
				type: 'GET',
				data: 'id='+id+'&emp='+emp+'&reg='+re+'&fact='+factura+'&regi='+regi+'&precio='+precios+'&copago='+copago+'&sw=1',
				url: '../vistas/facturar/acciones.php',
				success: function(){
                                    
                                } 
			});
		});
                $.ajax({
                            type: 'GET',
                            data: 'emp='+emp+'&factura='+factura+'&total='+tx+'&reg='+re+'&regi='+regi+'&copago='+co+'&subpago='+sub+'&sw=3',
                            url: '../vistas/facturar/acciones.php',
                            success: function(d){
                                alert("Se ha generado la factura No."+d);
                                MostrarEm();
                            } 
                        });
                    }else{
                        return false;
                    }
}
function autorizaciones(){
    var c = confirm("Estas seguro de cambiar el numero de autorizacion");
         if(c){
     var aut = $("#aut").val();
    $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                               
                               
                                $.ajax({
				type: 'GET',
				data: 'id='+id+'&aut='+aut+'&sw=6',
				url: '../vistas/facturar/acciones.php',
				success: function(){
                                    
                                } 
			});
		});
            }
}
function autorizaciones2(){
    var c = confirm("Estas seguro de cambiar el numero de autorizacion");
         if(c){
     var aut = $("#pre").val();
    $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                               
                               
                                $.ajax({
				type: 'GET',
				data: 'id='+id+'&aut='+aut+'&sw=7',
				url: '../vistas/facturar/acciones.php',
				success: function(){
                                    
                                } 
			});
		});
            }
}
</script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Atenciones por empresas</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                              <!-- Help Text -->
                              <div class="" action="" method="post" id="" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Buscar</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <select id="empresa">
                                                        <option value="">Seleccione la empresa</option>
                                                        <?php
                                                        $query = mysql_query("select * from sis_empresa where cliente='Si'");
                                                        while ($row = mysql_fetch_array($query)) {
                                                            echo '<option value="'.$row['rips'].'">'.$row['nombre_emp'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                  
                                            </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <label class="control-label">Paciente</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <input  type="text" id="pacientex" value="" placeholder="Cedula o Nombre">
                                                   
                                            </div>
                                            </div>
                                        </div>
                                         <label class="control-label">Regimen</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                   <select id="regi" style="width:220px;">       
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Contributivo">1. Contributivo</option>
                                                                    <option value="Subsidiado">2. Subsidiado</option>
                                                                    <option value="Particular">4. Particular</option>
                                                                    <option value="Vinculado">3. Vinculado</option>
                                                                    <option value="Otro">5. Otro</option>
                                                                    <option value="Plan Complementario">7. Plan Complementario</option>
                                                                    <option value="Poliza">8. Poliza</option>
                                                                    <option value="Arl">9. Arl</option>
                                                                    <option value="No aplica">No aplica</option>
                                                                </select>
                                                   
                                            </div>
                                            </div>
                                        </div>
                                          <label class="control-label">Estado</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <select id="est" style="width:220px;" onchange="MostrarEm()">       
                                                                  
                                                                    <option value="Revisado">Revisado</option>
                                                                    <option value="">Sin Revisar</option>
                                                                
                                                                </select>
                                                   
                                            </div>
                                            </div>
                                            <label class="control-label">Seleccionadas</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                   <select id="sel" style="width:220px;" onchange="MostrarEm()">       
                                                                  
                                                                    <option value="0">Sin seleccionar</option>
                                                                    <option value="1">Seleccionadas</option>
                                                                
                                                                </select>
                                                   
                                            </div>
                                            </div>
                                        </div>
                                        <label class="control-label">Fecha de Inicio</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <input  type="text" id="ini" value="<?php echo date("Y/m/01") ?>" >
                                                  
                                            </div>
                                            </div>
                                        </div>
                                        <label class="control-label">Fecha Final</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <input  type="text" id="fin" value="<?php echo date("Y/m/d") ?>" >
                                                 
                                            </div>
                                            </div>
                                        </div>
                                        <label class="control-label">Codigo Atencion</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <input  type="text" id="cod" value="" >
                                                   
                                            </div>
                                            </div>
                                        </div>
                                        <label class="control-label">Fecha de Registro</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <input  type="date" id="registro" value="<?php echo date("Y-m-d") ?>" >
                                                    <button type="button" onclick="MostrarEm()">Buscar</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div><!--/ Help Text -->
 <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                              

                           
                                
                                <div class="tab-content">

                                    <div class="" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding" id="mostrar">
                                    
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

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