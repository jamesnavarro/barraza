<?php 

?>

<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">CREAR FOLIOS</h4>
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
                                            <input type="text" name="buscar" class="span4" placeholder="Digite Codigo O Descripcion">
                                            <button name="btnbuscar">Buscar</button>
                                        </form>
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
<?php


    $request=mysql_query("select count(*) from cont_folios ");
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
    $sql='select * from cont_folios where id_folio="'.$_GET['up'].'"';
    $fil =mysql_fetch_array(mysql_query($sql));
        $codigo= $fil["cod_folio"];
        $descripcion= strtoupper($fil["nom_folio"]);
        $consecutivo= strtoupper($fil["cons_folio"]);
        $columna = $fil['col_folio'];
        $estado_folio = $fil['estado_folio'];
}  
    
?>

                                      
  <?php  
if($page>1){?>
	<a href="../vistas/?id=folios&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=folios&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=folios&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=folios&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
?>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

    if(isset($_POST['btnbuscar'])){
        $request_ac=mysql_query("SELECT * FROM cont_folios where concat(cod_folio,'',nom_folio) like '%".$_POST['buscar']."%'");
    }else{
        $request_ac=mysql_query("SELECT * FROM cont_folios ".$limit);
    }
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';    
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="20%">'.'Nombre / Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Consecutivo'.'</th>';
              $table = $table.'<th width="20%">'.'Columna'.'</th>';
              $table = $table.'<th width="2%">'.'Estado'.'</th>';
              $table = $table.'<th width="2%">'.'Editar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t=0;
  while($row=mysql_fetch_array($request_ac))
  {       
 $t=$t+1;
if ($row['estado_folio']== '1') {
  $estado='../imagenes/no.png';
}else{
  $estado='../imagenes/ok.png';
}


    if($editar=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up='';}
    if($eliminar=='Habilitado'){$del='&del='.$row['id_folio'].'';}else{$del='';}
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>
            <td width="10%">'.$row['cod_folio'].'</font></td>
            <td width="20%">'.strtoupper($row['nom_folio']).'</font></td>
            <td width="5%">'.$row['cons_folio'].'</font></td>
            <td width="20%">'.$row['col_folio'].'</font></td>
            <td width="2%"><img src='.$estado.'></font></td>
            <td width="2%"><a href="../vistas/?id=folios&up='.$row['id_folio'].'">'.$up.'</a> </td>';

           
    
               
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
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/insertar_folios.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                          
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Codigo</label>
                                               <div class="controls"><input type="text" id="cod_folio" autocomplete="off" name="codigo" <?php if (isset($_GET['up'])) {
                                              echo 'readonly';
                                            }else{
                                              echo '';
                                            } ?> value="<?php if(isset($_GET['up'])){echo $codigo;}  ?>" class="span2" placeholder="" maxlength="4" required></div>
                                               <div id="res_folio">
                                            <label></label><div class="controls"> </div>
                                            <label class="control-label">Nombre y/o Descripcion</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="nombre" value="<?php if(isset($_GET['up'])){echo $descripcion;}  ?>" class="span4" placeholder="" required>
                                            </div>
                                            
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Consecutivo</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="cons" value="<?php if(isset($_GET['up'])){echo $consecutivo;}  ?>" class="span4" placeholder="" required>
                                            </div>
                                            
                                            <label></label><div class="controls"> </div> 
                                            <label class="control-label">Columna</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="columna" value="<?php if(isset($_GET['up'])){echo $columna;}  ?>" class="span3" placeholder="" required>
                                            </div>
                                            
                                                   <label></label>
                                                  <div class="controls"> 
                                                      <input type="checkbox" name="estado" <?php if(isset($_GET['up'])){ if($estado_folio =='1'){echo 'checked';} }  ?> value="1">
                                                      <label>Folio Inactivo</label>
                                                  </div>
                                                 
                                            
                                           
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
                                        <a href="../vistas/?id=folios"><button type="button" class="btn">Cancelar</button></a>
                                    </div>
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





