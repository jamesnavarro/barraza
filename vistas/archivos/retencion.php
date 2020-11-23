
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">CREAR RETENCION EN LA FUENTE</h4>
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
                                            <input type="text" name="buscar" class="span4" placeholder="Digite Codigo O Descripcion De La Retencion">
                                            <button name="btnbuscar">Buscar</button>
                                        </form>
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
<?php


    $request=mysql_query("select count(*) from cont_retencion ");
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
        $sql='select * from cont_retencion where id_ret = "'.$_GET['up'].'"';
        $fil =mysql_fetch_array(mysql_query($sql));
            $codigo= $fil["cod_ret"];
            $descripcion= strtoupper($fil["nom_ret"]);
            $cuenta = $fil['cuenta_ret'];
            $porcentaje = $fil['por_ret'];
            $iva = $fil['iva_ret'];
            $estado_ret = $fil['estado_ret'];
            
        $con1= "SELECT * from cont_codigos_contables where id_cod_cont = '".$cuenta."'";
        $res1=  mysql_query($con1);
    
        $f1=  mysql_fetch_array($res1);
            $id_cont = $f1['id_cod_cont'];
            $cod_cont = $f1['cod_cod_cont'];
            $nom_cont = $f1['nom_cod_cont'];
        }  
    
 ?>

                                      
  <?php  
if($page>1){?>
	<a href="../vistas/?id=retencion&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=retencion&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=retencion&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=retencion&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
?>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

    if(isset($_POST['btnbuscar'])){
        $request_ac=mysql_query("select * from cont_retencion where concat(cod_ret,'',nom_ret) like '%".$_POST['buscar']."%'");
    }else{
        $request_ac=mysql_query("select * from cont_retencion ".$limit);
    }
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';    
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="20%">'.'Nombre o Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Cod. Cuenta'.'</th>';
              $table = $table.'<th width="5%">'.'Nom. Cuenta'.'</th>';
              $table = $table.'<th width="5%">'.'Porcentaje'.'</th>';
              $table = $table.'<th width="5%">'.'IVA'.'</th>';
              $table = $table.'<th width="2%">'.'Estado'.'</th>';
              $table = $table.'<th width="2%">'.'Editar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t=0;
  while($row=mysql_fetch_array($request_ac))
  {       
 $t=$t+1;
if ($row['estado_ret']== '1') {
  $estado='../imagenes/no.png';
}else{
  $estado='../imagenes/ok.png';
}

 $con1= "SELECT * from cont_codigos_contables where id_cod_cont = '".$row['cuenta_ret']."'";
        $res1=  mysql_query($con1);
    
        $f1=  mysql_fetch_array($res1);
            $id_cont = $f1['id_cod_cont'];
            $cod_cont = $f1['cod_cod_cont'];
            $nom_cont = $f1['nom_cod_cont'];

  if($editar=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up='';}
 if($eliminar=='Habilitado'){$del='&del='.$row['id_ret'].'';}else{$del='';}
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>
            <td width="10%">'.$row['cod_ret'].'</font></td>
            <td width="20%">'.strtoupper($row['nom_ret']).'</font></td>
            <td width="5%">'.$cod_cont.'</font></td>
            <td width="5%">'.$nom_cont.'</font></td>
            <td width="5%">'.$row['por_ret'].'</font></td>
            <td width="5%">'.$row['iva_ret'].'</font></td>
            <td width="2%"><img src='.$estado.'></font></td>
            <td width="2%"><a href="../vistas/?id=retencion&up='.$row['id_ret'].'">'.$up.'</a> </td>';

           
    
               
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
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/insertar_retencion.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                          
                                            <label></label><div class="controls"> </div>
                                            <label class="control-label">Codigo</label>
                                            <div class="controls"><input type="text" autofocus autocomplete="off" id="cod_ret" name="codigo" <?php if (isset($_GET['up'])) {
                                                echo 'readonly';
                                            }else{
                                                echo '';
                                            } ?> value="<?php if(isset($_GET['up'])){echo $codigo;}  ?>" class="span2"  placeholder="Codigo" maxlength="4" required></div>
                                             <!-- Nombre -->
                                             <div id="res_ret">
                                            <label></label><div class="controls"> </div>
                                            <label class="control-label">Nombre y/o Descripcion</label>
                                            <div class="controls"><input type="text" autocomplete="off" name="nombre" value="<?php if(isset($_GET['up'])){echo $descripcion;}  ?>" placeholder="Descripcion" class="span4" placeholder="" required></div>
                                              <!-- Consecutivo -->
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Codigo Cuenta</label>
                                            <div class="controls">
                                                <table>
                                                    <tr>
                                                        <td  width="100px">
                                                            <input type="text" id="cod_cont" value="<?php if(isset($_GET['up'])){echo $cod_cont;}?>" class="span12" name="cod_cont" placeholder="Codigo">
                                                        </td>
                                                        <td id="res_conta">
                                                            <input type="text" id="nom_cont" value="<?php if(isset($_GET['up'])){echo $nom_cont;}?>" name="desc_cont" placeholder="Descripcion">
                                                            <input type="hidden" id="id_cont" value="<?php if(isset($_GET['up'])){echo $id_cont;}?>" name="id_cont" placeholder="Id">
                                                            
                                                        </td>
                                                        <td>
                                                           <a href="../vistas/codigos.php"  target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/search.png"></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                             <label class="control-label">Porcentaje Ret.</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="porcentaje" value="<?php if(isset($_GET['up'])){echo $porcentaje;}  ?>" class="span2" placeholder="% Retencion" required>
                                            </div>
                                             <label></label><div class="controls"> </div>
                                             <label class="control-label">Porcentaje IVA</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="iva" value="<?php if(isset($_GET['up'])){echo $iva;}  ?>" class="span2" placeholder="% IVA" required>
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                             
                                                   
                                                  <div class="controls"> 
                                                      <input type="checkbox" name="estado" <?php if(isset($_GET['up'])){ if($estado_ret =='1'){echo 'checked';} }  ?> value="1">
                                                      <label>Desactivar</label>
                                                  </div>
                                             <label></label><div class="controls"> </div> 
                                             
                                                   
                                                  <div class="controls"> 
                                                      <input type="checkbox" name="" <?php if(isset($_GET['up'])){ if($estado_ret =='1'){echo 'checked';} }  ?> value="">
                                                      <label>Imprimir Certificado</label>
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
                                        <a href="../vistas/?id=retencion"><button type="button" class="btn">Cancelar</button></a>
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







