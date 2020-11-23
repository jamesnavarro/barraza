<?php 

$request=mysqli_query($conexion,'select count(*) from treatments where deleted_at is null order by created_at DESC');
if($request){
	$request = mysqli_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 10;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
?>  

<div class="row-fluid" id="panelcrear">
<section class="body">
	<div class="body-inner">
<div  class="span12 widget dark stacked" >
 <header>
                                <h4 class="title">Crear  Tratamientos</h4>
                                <!-- START Toolbar -->
                                
                                <!--/ END Toolbar -->
                            </header>
							   <section id="collapse1" class="body collapse in">

                                <div class="body-inner">
								<div class="row-fluid">
                                                <div class="span12">
										  <a href='#' class="btn btn-warning" id="btncancelar">Cancelar</a>		
												</div>
												</div>
								  <form class="span12  form-horizontal bordered" action="<?php echo '../modelo/tratamiento_add.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            
                            <section class="body">
                                        <div class="control-group">
                                            <label class="control-label">Título</label>
                                            <div class="controls"><input type="text" name="asunto" value="" class="span6"  required></div>
                                                                                       
                                             <label></label><div class="controls"> </div>
                                              
                                             <label class="control-label">Descripcion</label>
                                            <div class="controls"><textarea name="desc" class="span6" required rows="6"></textarea></div>
											<label></label><div class="controls"> </div>
											<label class="control-label">Duración</label>
                                            <div class="controls"><input type="text" name="duration" value="" class="span2"  required></div>
											 </div>
                                            
                                         <!-- Form Action -->
                                    <div class="form-actions">
                                        
                                       <?php
                                            echo '<button type="submit" class="btn btn-primary">Guardar</button>';
                                         ?>
                                        
                                        <a  href='#' class="btn btn-warning" id="btncancelar1">Cancelar</a>
                                    </div><!--/ Form Action -->
                               
                            </section>
                        </form>	
								
								
								
								</div>
								</section>
							
</div>	
	</div>
	</section>
</div> 



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
								<div class="row-fluid">
                                                <div class="span12">
										  <a href='#' class="btn btn-warning" id="btncancelarasig">Cancelar</a>		
												</div>
												</div>
								  <form class="span12  form-horizontal bordered" action="<?php echo '../modelo/tratamiento_asig.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            
                            <section class="body">
                                        <div class="control-group">
                                            <label class="control-label">Título</label>
                                            <div class="controls"><input type="text" name="asunto" value="" class="span6"  required></div>
                                                                  <input type="hidden" name="idtratamiento" value="" >                     
                                             <label></label><div class="controls"> </div>
                                              
                                             <label class="control-label">Paciente</label>
                                            <div class="controls"><input id="country_name" class="form-control span12" required/></div>
											<label></label><div class="controls"> </div>
											<label class="control-label">Duración</label>
                                            <div class="controls"><input type="text" name="duration" value="" class="span2"  required></div>
											 </div>
                                            
                                         <!-- Form Action -->
                                    <div class="form-actions">
                                        
                                       <?php
                                            echo '<button type="submit" class="btn btn-primary">Guardar</button>';
                                         ?>
                                        
                                        <a  href='#' class="btn btn-warning" id="btncancelarasig1">Cancelar</a>
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
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">
<!-- -->
                	
								
<!-- -->								
								
								
                        <div class="span12 widget dark stacked" id="panelconsulta">

                            <header>
                                <h4 class="title">Lista de Tratamientos</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse2" href="#collapse2"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">
                                            <!-- Normal Tabs -->

                              <!-- Help Text -->
                              <form class="" action="" method="post" id="" enctype="multipart/form-data">
                                    <div class="control-group">
                                       
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                  <a href='#' class="btn btn-success" id="btncrear">Crear Tratamiento</a>
												  </div>
                                                <div class="span4">
                                                  <a href='#' class="btn btn-success" id="btnasignar">Asignar Tratamiento</a>  
                                                </div>
                                                <div class="span4">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </form><!--/ Help Text -->
 <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                                <div class="tab-content">

                                    <div class="" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php

//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['nombre']) || isset($_POST['fecha']) || isset($_POST['user'])){
    $fecha = $_POST['fecha'];
    
    

    $request=mysqli_query($conexion,"SELECT * FROM datos where nombre like '%".$_POST['nombre']."%' and documento like '%".$_POST['user']."%' and estado like '%".$_POST['fecha']."%'");
}else{
$request=mysqli_query($conexion,"select * from treatments where deleted_at is null  order by created_at DESC");
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Id'.'</th>';             
              $table = $table.'<th width="20%">'.'Título'.'</th>';
              $table = $table.'<th width="50%">'.'Descripción'.'</th>';
              $table = $table.'<th width="15%">'.'Fecha de creación'.'</th>';
              $table = $table.'<th width="5%" class="hidden-phone">'.'Editar..'.'</th>';
              $table = $table.'<th width="5%" class="hidden-phone">'.'Eliminar'.'</th>';
             
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
                
                
            $table = $table.'<tr><td width="5%">'.$row['id'].'</td>
                <td width="20%"><a href="../vistas/?id=ver_tratamiento&cod='.$row['id'].'">'.utf8_encode($row['title']).'</font></td>
                <td width="50%">'.utf8_encode($row['description']).'</td>
                    <td width="15%">'.$row["created_at"].'</td>
               
                            <td width="5%" class="hidden-phone"><a href="../vistas/?id=tratamiento&cod='.$row["id"].'"><img src="../imagenes/modificar.png"></a></td>
                                <td width="5%" class="hidden-phone"><a href="#" onclick="eliminar('.$row["id"].');" ><img src="../imagenes/eliminar.png"></a></td></tr>';   
      
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

     
}
?>
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

<script>
$('#panelcrear').hide();
$('#panelasignar').hide();
 $("#btncrear").click(function() {
        //Do stuff when clicked
		//alert("fjdkgdf");
		$('#panelcrear').show();
		$('#panelconsulta').hide();
		
    });
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
