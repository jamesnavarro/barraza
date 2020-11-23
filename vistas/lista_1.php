<script> 
    $(function() {
        $("#mostrar").load(buscar(1));
    });
    function buscar(page){
    var nom = $("#buscar").val();
    var est = $("#estado").val();
              $.ajax({
				type: 'GET',
				data: 'nombre='+nom+'&estado='+est+'&page='+page,
				url:  '../vistas/lista_usuarios.php',
				success: function(data){
                                    $("#mostrar").html(data);
                                }
			});
}
</script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Lista de Usuarios</h4>

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
                
                                    <div class="control-group">
                                        <label class="control-label">Buscar usuario por nombre, cargo o por cedula</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <input type="text" id="buscar" placeholder="Buscar usuario">
                                                </div>
                                                <div class="span4">
                                                    <select  id="estado">
                                                        <option value="Activo">Activo</option>
                                                        <option value="No Activo">No Activo</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="span4">
                                                    <button onclick="buscar(1);">Buscar</button>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                   
                                  <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                             
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

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

                                    <div class="tab-pane" id="tab2">

                                        <div class="row-fluid">

                        <!-- START Form Wizard -->

                     <?php 
   

 $request=mysql_query("SELECT * FROM prestamo a, clientes b where a.id_cliente=b.id_cliente");
    
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#E3EC7E">';
              $table = $table.'<th width="20%">'.'Nombre del Cliente'.'</th>';             
              $table = $table.'<th width="40%">'.'Direccion'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Prestamo'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Registrado por'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
 
            $table = $table.'<tr><td width="20%"><a href="../vistas/?id=det_clientes&cod='.$row['id_prestamo'].'">'.$row['nombres'].'</a></td><td width="10%">'.$row['direccion'].'</font></td><td width="10%">'.$row["valorprestamo"].'<font></a></td></td>
               <td class="hidden-phone">'.$row["user_reg_pre"].'</font></td></tr>';   
           
		
               
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        
     
}

       
                       ?>456
                       

                        <!--/ END Form Wizard -->

                    </div>

                                    </div>

                                    

                                </div>

                            </div><!--/ Normal Tabs -->

                                        

                                </div>

                              

                            </section>

                        </div>

                                    

<!--                                    Insumos-->



                      

                    </div>

  

                            </section></div>
<?php
 if(isset($_GET['del'])){
     if($_GET['del']==1){
          echo '<script lanquage="javascript">alert("Este Usuario no se puede Eliminar");location.href="../vistas/?id=list_user"</script>'; 
     }else{
         if($eliminar_conf=='Habilitado'){
                    $sql = "DELETE FROM usuarios WHERE id_user=".$_GET['del']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=list_user'";
echo "</script>";  
         }else{
             echo '<script lanquage="javascript">alert("Usted no esta autorizado para eliminar ningun usuario");location.href="../vistas/?id=list_user"</script>'; 
         }

     }

}

?>