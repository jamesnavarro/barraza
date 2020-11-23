<?php 

$request=mysqli_query($conexion,'select count(*) from exercises where deleted_at is null order by created_at DESC');
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
                                <h4 class="title">Crear  Comentario</h4>
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
								  <form class="span12  form-horizontal bordered" action="<?php echo '../modelo/comments_add.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            
                            <section class="body">
                                        <div class="control-group">
                                           
                                             <label></label><div class="controls"> </div>
                                                <input type="hidden" name="fecha" value="">		
												<input type="hidden"	 name="ide" value="<?php echo $id_lla;?>">
                                                  <label class="control-label">Descripción</label>
                                            <div class="controls"><textarea name="desc" class="span6" required rows="6"></textarea></div>
											<label></label><div class="controls"> <hr></div>
											
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
								<section>
							
</div>	
	</div>
	</section>
</div> 



<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">
<button id="btncrear" class="btn btn-primary">CREAR COMENTARIO</button>
                                <div class="body-inner">
<!-- -->
                	
								
<!-- -->								
								
								
                        <div class="span12 widget dark stacked" id="panelconsulta">

                            <header>
                                <h4 class="title">Lista de comentarios</h4>
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
                             <!--/ Help Text -->
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
$request=mysqli_query($conexion,"select * from comments where feedback_id=$id_lla and deleted_at is null  order by created_at DESC");
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Id'.'</th>';             
              
              $table = $table.'<th width="45%">'.'Comentario'.'</th>';
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
                <td width="50%">'.$row['comment'].'</td>
                    <td width="15%">'.$row["created_at"].'</td>
               <td width="5%" class="hidden-phone"><a href="../vistas/?id=ejercicio&cod='.$row["id"].'"><img src="../imagenes/modificar.png"></a></td>
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
            data: { idel : ide,op:'del' },
            success: function(ok1) {            
                if(ok1==1){
				alert("Eliminado exitosamente");
			//location.href='<?php echo $_SERVER["REQUEST_URI"];?>';
			            location.reload();
				}   }
        });
	}
	}

	
</script>
