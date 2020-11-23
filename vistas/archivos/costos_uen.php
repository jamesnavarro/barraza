<?php 

?>

<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">CREAR CENTROS DE COSTOS</h4>
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


    $request=mysql_query("select count(*) from cont_centros_de_costo ");
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
    $sql='select * from cont_centros_de_costo a,areas_uen b where a.id_area_uen = b.id_uen and a.id_costo="'.$_GET['up'].'"';
    $fil =mysql_fetch_array(mysql_query($sql));
        $codigo= $fil["cod_costo"];
        $descripcion= strtoupper($fil["nom_costo"]);
        $unidad= strtoupper($fil["distri_costo"]);
        $estado_uen = $fil['estado_costo'];
        $id_area = $fil['id_area_uen'];
        $id_uen = $fil['id_uen'];
        $nombre_uen = $fil['nombre_uen'];
        $cod_uen = $fil['cod_uen'];

      

   }  
    
 ?>

                                      
  <?php  
if($page>1){?>
	<a href="../vistas/?id=costos&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=costos&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=costos&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=costos&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
?>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

    if(isset($_POST['btnbuscar'])){
        $request_ac=mysql_query("SELECT * FROM cont_centros_de_costo a,areas_uen b where a.id_area_uen = b.id_uen and concat(cod_costo,'',nom_costo) like '%".$_POST['buscar']."%'");
    }else{
        $request_ac=mysql_query("SELECT * FROM cont_centros_de_costo a,areas_uen b where a.id_area_uen = b.id_uen ".$limit);
    }
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';    
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="20%">'.'Centro de Costo'.'</th>';
              $table = $table.'<th width="5%">'.'UEN'.'</th>';
              $table = $table.'<th width="20%">'.'Unidad Estrategica'.'</th>';
              $table = $table.'<th width="5%">'.'Distribucion'.'</th>';
              $table = $table.'<th width="2%">'.'Estado'.'</th>';
              $table = $table.'<th width="2%">'.'Editar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t=0;
  while($row=mysql_fetch_array($request_ac))
  {       
 $t=$t+1;
if ($row['estado_costo']== '1') {
  $estado='../imagenes/no.png';
}else{
  $estado='../imagenes/ok.png';
}


  if($editar=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up='';}
 if($eliminar=='Habilitado'){$del='&del='.$row['id_costo'].'';}else{$del='';}
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>
            <td width="10%">'.$row['cod_costo'].'</font></td>
            <td width="20%">'.strtoupper($row['nom_costo']).'</font></td>
            <td width="5%">'.$row['cod_uen'].'</font></td>
            <td width="20%">'.$row['nombre_uen'].'</font></td>
            <td width="5%">'.$row['distri_costo'].'</font></td>
            <td width="2%"><img src='.$estado.'></font></td>
            <td width="2%"><a href="../vistas/?id=costos&up='.$row['id_costo'].'">'.$up.'</a> </td>';

           
    
               
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
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/insertar_costos_uen.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                          
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Codigo</label>
                                               <div class="controls"><input type="text" autocomplete="off" id="cod_costo" name="codigo" <?php if (isset($_GET['up'])) {
                                              echo 'readonly';
                                            }else{
                                              echo '';
                                            } ?> value="<?php if(isset($_GET['up'])){echo $codigo;}  ?>" class="span2" placeholder="" minlength="4" maxlength="4" required></div>
                                               <div id="res_area">
                                             <label></label><div class="controls"> </div>
                                            <label class="control-label">Area (UEN)</label>
                                            <div class="controls">
                                                <table>
                                                    <tr>
                                                        <td width="100px">
                                                            <input type="text" readonly placeholder="Codigo" value="<?php if(isset($_GET['up'])){ echo $cod_uen; } ?>" class="span12" id="cod_area" name="cod_area"> 
                                                        </td>
                                                        <td>
                                                            <input type="text" readonly value="<?php if(isset($_GET['up'])){ echo $nombre_uen; } ?>" placeholder="Descripcion" id="des_area" name="des_area">
                                                            <input type="hidden" value="<?php if(isset($_GET['up'])){ echo $id_uen; } ?>" placeholder="Id" id="des_area" name="id_area">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                             <label></label><div class="controls"> </div>
                                            <label class="control-label">Nombre y/o Descripcion</label>
                                            <div class="controls"><input type="text" autocomplete="off" name="nombre" value="<?php if(isset($_GET['up'])){echo $descripcion;}  ?>" class="span4" placeholder="" required></div>
                                             <label></label><div class="controls"> </div>                                     
                                            <label></label><div class="controls"> </div>
                                            <label class="control-label">Distribucion</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="distribucion" value="<?php if(isset($_GET['up'])){echo $unidad;}  ?>" class="span1" placeholder="0.00" required> %
                                            </div>
         
                                                   
                                                   <label></label>
                                                  <div class="controls"> 
                                                      <input type="checkbox" name="estado" <?php if(isset($_GET['up'])){ if($estado_uen =='1'){echo 'checked';} }  ?> value="1">
                                                      <label>Estado Inactivo</label>
                                                    
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
                                        <a href="../vistas/?id=costos"><button type="button" class="btn">Cancelar</button></a>
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




