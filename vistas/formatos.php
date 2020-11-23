<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Formatos de descargas</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab3" data-toggle="tab"><span class="icon icone-eye-open"></span> Documentos</a></li>
                                  <?php   if($crear_doc=='Habilitado'){  ?>  <li class=""><a href="#tab4" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Documentos </a></li><?php } ?>
                                  
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab3">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
<?php
if(isset($_POST['orden'])){
    $request=mysql_query("SELECT * FROM formatos where nombre like '%".$_POST['orden']."%'");
}else{
$request=mysql_query("SELECT * FROM formatos ");
  } 
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Item'.'</th>';
                  $table = $table.'<th width="30%">'.'Nombre del Documento'.'</th>';
              $table = $table.'<th width="10%">'.'Ruta de Descarga'.'</th>';
              $table = $table.'<th width="10%">'.'Fecha de Registro'.'</th>';
              $table = $table.'<th width="10%">'.'Registrado por'.'</th>';
              $table = $table.'<th width="5%">'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{      
              
           if($eliminar_doc=='Habilitado'){ $del = '<a href="../vistas/?id=formatos&del='.$row['id'].'"><img src="../imagenes/eliminar.png"></a>'; }else{ $del = '';}
            $table = $table.'<tr><td width="5%">'.$row['id'].'</a></td>
               <td width="30%">'.$row['nombre'].'<font></a></td>'
                    . ' <td width="20%"><a href="../vistas/?download='.$row['ruta'].'"><img src="../imagenes/download.png"> '.$row['ruta'].'</a></td>
                    <td width="10%">'.$row['fecha'].'<font></a></td><td width="10%">'.$row['registrado_por'].'<font></a></td>'
                    . '<td width="5%">'.$del.'</td></tr>';   
      
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
                                    <div class="tab-pane" id="tab4">
                                        <div class="row-fluid">
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['cod'])){echo '../modelo/formato.php?editar='.$_GET['cod'].'';}else{echo '../modelo/formato.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                          
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Nombre del documento</label>
                                            <div class="controls"><input type="text" name="doc" value="" class="span8" placeholder="" required></div>
                                            
                                             <label></label><div class="controls"> </div>
                                              <label class="control-label">Adjunto:</label>
                                                <div class="controls">
                                                    <input type="file" name="archivo" id="archivo">  
                                                </div>
                                            <label></label><div class="controls"> </div>
                                             
                                            
                                           
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary"><?php if(isset($_GET['cod'])){echo 'Editar';}else{echo 'Agregar';} ?></button>
                                         <a href="../vistas/?id=unidades"><button type="button" class="btn">Cancelar</button></a>
                                    </div><!--/ Form Action -->
                                </div>
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
<?php
 if(isset($_GET['del'])){
$sql = "DELETE FROM formatos WHERE id=".$_GET['del']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=formatos'";
echo "</script>";
}