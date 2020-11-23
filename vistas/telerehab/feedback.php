<?php 

$request=mysqli_query($conexion,'select count(*) from feedback where deleted_at is null order by created_at DESC');
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


<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">
<!-- -->
                	
								
<!-- -->								
								
								
                        <div class="span12 widget dark stacked" id="panelconsulta">

                            <header>
                                <h4 class="title">Lista de Feedbacks</h4>
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
                                        <label class="control-label">Buscar </label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <select  class="span8"  name="nombre" id="select2_1">
                                                 <option value=''>Seleccione el nombre...</option>
                                                         <?php
                                                            require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM feedback where deleted_at is  null order by created_at DESC";                     
                                                            $result=  mysqli_query($conexion,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['description'];
                                                            echo"<option value=".$valor1.">".$valor1."</option>";
                                                             }
                                                           
                                                            ?>
                                            </select>
                                                </div>
                                                <div class="span4">
                                                    
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
    
    

    $request=mysqli_query($conexion,"SELECT * FROM feedback where comment like '%".$_POST['nombre']."%' ");
}else{
$request=mysqli_query($conexion,"SELECT f.*,p.first_name,p.last_name FROM `feedback` f, users u, profiles p where f.patient_id=u.id and u.id=p.user_id
 and  f.deleted_at is null  order by created_at DESC");
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Id'.'</th>';             
              $table = $table.'<th width="20%">'.'Paciente'.'</th>';
              $table = $table.'<th width="35%">'.'Descripción'.'</th>';
              $table = $table.'<th width="15%">'.'Fecha de creación'.'</th>';
              
			  $table = $table.'<th width="15%" class="hidden-phone">'.'Ver comentarios..'.'</th>';
              
			  $table = $table.'<th width="5%" class="hidden-phone">'.'Eliminar'.'</th>';
             
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{       
                
                
            $table = $table.'<tr><td width="5%">'.$row['id'].'</td>
                <td width="20%"><a href="../vistas/?id=ejercicio&cod='.$row['id'].'">'.$row['first_name']." ".$row['first_name'].'</font></td>
                <td width="50%">'.$row['comment'].'</td>
                    <td width="15%">'.$row["created_at"].'</td>
              
                            <td width="5%" class="hidden-phone"><a href="../vistas/?id=vercomentarios_feedback&cod='.$row["id"].'"><img src="../imagenes/nota.png"></a></td>
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
