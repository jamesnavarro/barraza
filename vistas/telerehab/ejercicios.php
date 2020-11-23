<script src="../vistas/telerehab/funciones_ejercicio.js"></script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">	
								
                        <div class="span12 widget dark stacked" id="panelconsulta">

                            <header>
                                <h4 class="title">Lista de Ejercicios</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse2" href="#collapse2"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">
                                            <!-- Normal Tabs -->
 <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                                <div class="tab-content">

                                    <div class="" id="tab1">

                                         <!-- START Row -->
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Listado</a></li>
  <li><a data-toggle="tab" href="#menu1">Crear Ejercicio</a></li>
</ul>
                                         <div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>Listado detallado de ejercicios</h3>
    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        
                        <div class="span12 widget lime">

                            
                            <section class="body">

                                <div class="body-inner no-padding">
<?php
if(isset($_GET['ses'])){ ?>
                                    <button onclick="add_ejercicios(<?php echo $_GET['ses'].','.$_GET['pac'].','.$_GET['pro'] ?>)">Agregar ejercicios a la sesion</button> <a href="../vistas/?id=ver_orden_interna&ord=<?php echo $_GET['ord'] ?>">  Volver a la orden</a>
<?php } ?>
                                    <table class="table table-bordered table-striped table-hover" id="tabla_ajax_ex">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Titulo del ejercicio</th>
                        <th>Descripcion</th>
                        <th>Creado</th>
<!--                        <th>Preguntas</th>-->
                        <th>Videos</th>
                        <th>Add Ejercicios</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody id="mostrar">
                    
                </tbody>
            </table>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Formulario de nuevo ejercicio</h3>
        <div class="control-group">
        <label class="control-label">Id</label>
        <div class="controls"><input type="text" id="ideje"  class="span12"  disabled ></div>
        <div class="control-group">
        <label class="control-label">Titulo del ejercicio.</label>
        <div class="controls"><input type="text" id="titulo"  class="span12"  required></div>
        <label></label><div class="controls"> </div>
        <label class="control-label">Descripcion del ejercicio.</label>
        <div class="controls"><input type="text" id="descripcion"  class="span12"  required></div>
        <label></label><div class="controls"> </div>
        <button type="button" id="guardar" onclick="guardar_eje();"><img src="../images/nuevo.png" width="15px"> Guardar</button>
       </div> 
  </div>

</div> 
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>

                        </div>
                    </div>

                            </section></div>
 <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registro de Videos e Imagenes</b></h4>
            </div>
              <div class="modal-body" id="tablaf">
                  <h3>Ejercicio <input type="text"  id="id_eje" style="width:40%" disabled/>
                  <input type="hidden"  id="tit" style="width:40%" disabled/>
                  <input type="hidden"  id="des" style="width:40%" disabled/></h3>
                  <table style="width:100%;">
                      <tr>
                          <td>Tipo Medio</td>
                          <td>Url</td>
                          <td>Opcion</td>
                      </tr>
                      <tr>
                          <td><select id="tipo" style="width:100%"><option value="video">video</option><option value="file">file</option></select></td>
                          <td id="tipox"><input type="text"  id="videox" style="width:100%"/></td>
                          <td><button onclick="mas_video();">+</button></td>
                      </tr>
                      <tbody id="mostrar_videos">
                          
                      </tbody>
                  </table>
                  
                <div id="msg"></div>
                
                <br />
                
            </div>
              <div class="modal-footer">
                    <input type="button" id="" class="btn btn-danger" value="Cerrar" data-dismiss="modal" aria-hidden="true"/>   
                </div>
          </div>
        </div>
      </div>
                                <div class="modal fade" id="modalPreguntas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registro de Preguntas</b></h4>
            </div>
              <div class="modal-body" id="tablaf">
                  <h3>Ejercicio: <input type="text"  id="id_ejep" style="width:40%" disabled/></h3>
                  <table style="width:100%">
                      <tr>
                          <td>Descripcion de la Pregunta</td>
                          <td><input type="text"  class="span12" id="pregunta" disabled/> 
                          <td><button onclick="add_pregunta()" class="btn btn-success">+</button></td>
                      
                      </tr>
                      </table>
                  <table style="width:100%">
                      <tr>
                          <td>Id</td>
                          <td>Descripcion de la pregunta</td>
                          <td>Eliminar</td>
                      </tr>
                      
                      <tbody id="mostrar_pregunta">
                          
                      </tbody>
                  </table>
                  
                <div id="msg"></div>
                
                <br />
                
            </div>
              <div class="modal-footer">
                    <input type="button" id="" class="btn btn-danger" value="Cerrar" data-dismiss="modal" aria-hidden="true"/>   
                </div>
          </div>
        </div>
      </div>
<script  language="JavaScript">



$(document).ready(function(){

  var counter = 0;

    $('#addrow').on('click', function () {
		
		 if (counter == 2) {$('#addrow').attr('disabled', true).prop('value', "Has alcanzado el límite de registros a crear");
		 $('#addrow2').attr('disabled', true).prop('value', "Has alcanzado el límite de registros a crear");
		 }
		 else{
        counter = $('#myTable tr').length - 2;
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td width="35%">'
 +'<input class="span12" type="text" id="tipo" name="tipo[]" value="VIDEO" readonly></td>';
  cols += '<td width="40%">'		
                 +'<input type="hidden" value="0" name="valor[]" id="valor"><input class="span12" type="text" id="video" name="video[]" /></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-danger"  value="-"></td>';
        newRow.append(cols);
        $("#myTable").append(newRow);
        counter++;
		 }
    });

/***/
 $('#addrow2').on('click', function () {
		
		 if (counter == 2) {$('#addrow').attr('disabled', true).prop('value', "Has alcanzado el límite de registros a crear");
		 $('#addrow2').attr('disabled', true).prop('value', "Has alcanzado el límite de registros a crear");
		 }
		 else{
        counter = $('#myTable tr').length - 2;
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td width="35%">'
                 +'<input class="span12" type="text" id="tipo" name="tipo[]" value="IMAGEN" readonly></td>';
       cols += '<td width="40%">'		
                 +'<input type="hidden" value="0" name="valor[]" id="valor"><input class="span12"  type="file" id="file" name="file[]" /></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-danger"  value="-"></td>';
        newRow.append(cols);
        $("#myTable").append(newRow);
        counter++;
		 }
    });	
/***/	
/*    $("table.order-list").on("change", 'input[name^="price"]', function (event) {   });*/


    $("#myTable").on("click", ".ibtnDel", function (event) {
		
		if(confirm('¿Desea eliminar esta fila?')){
			var ide = $(this).parents("tr").find('#valorid').val();
			$(this).closest("tr").remove();
			alert("Eliminado exitosamente");
			
		}
      
        counter -= 1
        $('#addrow').attr('disabled', false).prop('value', "+ VIDEO");
		$('#addrow2').attr('disabled', false).prop('value', "+ IMAGEN");
    });

	
	
	});//Fin 

</script>