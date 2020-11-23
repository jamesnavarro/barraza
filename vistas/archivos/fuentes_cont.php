<?php 

?>

<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">CREAR FUENTES CONTABLES</h4>
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
                                    <li class="<?php if(!isset($_GET['up'])){echo 'active';}  ?>"><a href="#tab3" data-toggle="tab"><span class="icon icone-eye-open"></span> Items</a></li>
                                    <?php
                                    	if ($registrar == 'Habilitado'){
                                    		if (!isset($_GET['up'])) { ?>
                                    			<li class="<?php if(isset($_GET['up'])){echo 'active';}  ?>"><a href="#tab4" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar Items </a></li>
                                    		<?php
                                    		}
										}
										?>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane <?php if(!isset($_GET['up'])){echo 'active';}  ?>" id="tab3">
                                         <!-- START Row -->
                                        <form method="post" action="">
                                            <input type="text" name="buscar" class="span4" placeholder="Digite Codigo O Descripcion De La Fuente">
                                            <button name="btnbuscar">Buscar</button>
                                        </form>
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
<?php


    $request=mysql_query("select count(*) from cont_fuentes ");
if($request){
	$request = mysql_fetch_row($request);
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


    if(isset($_GET['up'])){
        $sql='select * from cont_fuentes where id_fuente="'.$_GET['up'].'"';
        $fil =mysql_fetch_array(mysql_query($sql));
            $codigo= $fil["cod_fuente"];
            $descripcion= strtoupper($fil["nom_fuente"]);
            $consecutivo = $fil['cons_fuente'];
            $obs_fuente = $fil['obs_fuente'];
            $estado_fuente = $fil['estado_fuente'];
        }  
    
 ?>

                                      
  <?php  
if($page>1){?>
	<a href="../vistas/?id=fuentes&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=fuentes&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=fuentes&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=fuentes&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
?>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

    if(isset($_POST['btnbuscar'])){
        $request_ac=mysql_query("select * from cont_fuentes where concat(cod_fuente,'',nom_fuente) like '%".$_POST['buscar']."%'");
    }else{
        $request_ac=mysql_query("select * from cont_fuentes ".$limit);
    }
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';    
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="20%">'.'Nombre o Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Consecutivo'.'</th>';
              $table = $table.'<th width="5%">'.'Observacion'.'</th>';
              $table = $table.'<th width="2%">'.'Estado'.'</th>';
              $table = $table.'<th width="2%">'.'Editar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t=0;
  while($row=mysql_fetch_array($request_ac))
  {       
 $t=$t+1;
if ($row['estado_fuente']== '1') {
  $estado='../imagenes/no.png';
}else{
  $estado='../imagenes/ok.png';
}


  if($editar=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up='';}
 if($eliminar=='Habilitado'){$del='&del='.$row['id_fuente'].'';}else{$del='';}
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>
            <td width="10%">'.$row['cod_fuente'].'</font></td>
            <td width="20%">'.strtoupper($row['nom_fuente']).'</font></td>
            <td width="5%">'.$row['cons_fuente'].'</font></td>
            <td width="20%">'.$row['obs_fuente'].'</font></td>
            <td width="2%"><img src='.$estado.'></font></td>
            <td width="2%"><a href="../vistas/?id=fuentes&up='.$row['id_fuente'].'">'.$up.'</a> </td>';

           
    
               
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
                                    <div class="tab-pane <?php if(isset($_GET['up'])){echo 'active';}  ?>" id="tab4">
                                        
                                        <div class="row-fluid">
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/insertar_fuentes_cont.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                          
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Codigo</label>
                                               <div class="controls"><input type="text" autocomplete="off" id="cod_fuentes" name="codigo" <?php if (isset($_GET['up'])) {
                                              echo 'readonly';
                                            }else{
                                              echo '';
                                            } ?> value="<?php if(isset($_GET['up'])){echo $codigo;}  ?>" class="span2" placeholder="" maxlength="4" required></div>
                                             <!-- Nombre -->
                                             <div id="res_fuentes1">
                                               <label></label><div class="controls"> </div>
                                            <label class="control-label">Nombre y/o Descripcion</label>
                                            <div class="controls"><input type="text" autocomplete="off" name="nombre" value="<?php if(isset($_GET['up'])){echo $descripcion;}  ?>" class="span4" placeholder="" required></div>
                                              <!-- Consecutivo -->
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Consecutivo</label>
                                            <div class="controls"><input type="text" autocomplete="off" name="consecutivo" value="<?php if(isset($_GET['up'])){echo $consecutivo;}  ?>" class="span4" placeholder="" required></div>
                                             <label></label><div class="controls"> </div>    
                                             <!-- Observacion -->
                                             <label></label><div class="controls"> </div>
                                            <label class="control-label">Observaciones</label>
                                            <div class="controls">
                                                <textarea name="observacion" class="span4" required>
                                                    <?php if(isset($_GET['up'])){echo $obs_fuente;}  ?>
                                                </textarea>    
                                            </div>
                                             <label></label><div class="controls"> </div>  
                                             
                                                   
                                                   <label></label>
                                                  <div class="controls"> 
                                                      <input type="checkbox" name="estado" <?php if(isset($_GET['up'])){ if($estado_fuente =='1'){echo 'checked';} }  ?> value="1">
                                                      <label>Desactivar</label>
                                                  </div>
                                                   
                                                  
                                            
                                           
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                       <?php
                                    		if (isset($_GET['up'])) {
                                    			if ($editar == 'Habilitado') { ?>
	                                    			<button type="submit" class="btn btn-primary"><?php if(isset($_GET['up'])){echo 'Actualizar';}else{echo 'Agregar';} ?></button>
	                                    		<?php
												}
                                    		} else {
                                    			if ($registrar == 'Habilitado') {?>
	                                    			<button type="submit" class="btn btn-primary"><?php if(isset($_GET['up'])){echo 'Actualizar';}else{echo 'Agregar';} ?></button>
	                                    		<?php
                                    			}
                                    		}
                                    	?>
                                        <a href="../vistas/?id=fuentes"><button type="button" class="btn">Cancelar</button></a>
                                    </div><!--/ Form Action -->
                                    </div>
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





