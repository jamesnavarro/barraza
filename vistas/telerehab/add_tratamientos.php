  
<?php
  $sql1 = "select max(orden_servicio) from actividad";
        $fila =mysqli_fetch_array(mysqli_query($conexion,$sql1));
        $max=$fila['max(orden_servicio)']+1;
?>

<!-- panel asig-->
<div class="row-fluid" id="panelasignar">
<section class="body">
	<div class="body-inner">
<div  class="span12 widget dark stacked" >
 <header>
                                <h4 class="title">Asignar  Tratamiento</h4>
                                <!-- START Toolbar -->
                                
                                <!--/ END Toolbar -->
                            </header>
							   <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

								  <form class="span12  form-horizontal bordered" action="<?php echo '../modelo/tratamiento_asig.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            
                            <section class="body">
                                        <div class="control-group">
										<label class="control-label">Orden Interna</label>
										<div class="controls"><input type="text" name="orden" readonly style="width:25%;" value="<?php if(isset($_GET["edit"])){echo $_GET["edit"];}else{echo $max; } ?>" required> 
                                            </div>
											<label></label><div class="controls"> </div>
											<label class="control-label">Título</label>
                                            <div class="controls"><input type="text" name="asunto" value="" class="span6"  required></div>
                                                                                       
                                             <label></label><div class="controls"> </div>
                                              
                                             <label class="control-label">Paciente</label>
                                            <div class="controls">
											<input  type="hidden" name="idpaciente" value="<?php echo $idp;?>" >
											<input id="country_name" class="form-control span12" value="<?php echo $_SESSION['nnn'];?>" required />  
											</div>
											<label></label><div class="controls"> </div>
											<label class="control-label">Duración</label>
                                            <div class="controls"><input type="text" name="duration" value="" class="span2"  required></div>
											 </div>
                                            
                                         <!-- Form Action -->
                                    <div class="form-actions">
                                        
                                       <?php
                                            echo '<button type="submit" class="btn btn-primary">Siguiente</button>';
                                         ?>
                                        
                            
                                    </div><!--/ Form Action -->
                               
                            </section>
                        </form>	
								
								
								
								</div>
								</section>
							
</div>	
	</div>
	</section>
</div> 


<!--fin panel asig -->


<script>



 $("#btncancelar").click(function() {
        //Do stuff when clicked
		//alert("fjdkgdf");
		$('#panelcrear').hide();
		$('#panelconsulta').show();
		
    });
	
$("#btnasignar").click(function() {
        //Do stuff when clicked
		//alert("fjdkgdf");
		$('#panelasignar').show();
		$('#panelconsulta').hide();
		
    });
 $("#btncancelarasig").click(function() {
        //Do stuff when clicked
		//alert("fjdkgdf");
		$('#panelasignar').hide();
		$('#panelconsulta').show();
		
    });
$("#btncancelarasig1").click(function() {
        //Do stuff when clicked
		//alert("fjdkgdf");
		$('#panelasignar').hide();
		$('#panelconsulta').show();
		
    });	
$("#btncancelar1").click(function() {
        //Do stuff when clicked
		//alert("fjdkgdf");
		$('#panelcrear').hide();
		$('#panelconsulta').show();
		
    });
function eliminar(ide){
	
	if(confirm("¿Seguro desea eliminar este registro?")){
	
 $.ajax({
            type: "POST",
            url: "../modelo/ejercicio.php",
            data: { idel : ide,op:'deltr' },
            success: function(ok1) {            
                if(ok1==1){
				alert("Eliminado exitosamente");
			//location.href='<?php echo $_SERVER["REQUEST_URI"];?>';
			            location.reload();
				}   }
        });
	}
	}
/*autocompletar*/
$('#country_name').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			url : 'telerehab/process_json.php',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term,
						   type: 'country'
						},
						 success: function( data ) {
							 //alert(data);
							 response( $.map( data, function( item ) {
								return {
									label: item,
									value: item
								}
							}));
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });
/*fin auto*/

</script>
