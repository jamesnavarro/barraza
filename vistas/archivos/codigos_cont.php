<script>
    $(document).ready(function(){
           $("#codigo_cont").keyup(function () {
                //alert($(this).val());
                elegido2=$(this).val();
                $.post("../combos/cod_contable.php", { elegido2: elegido2 }, function(data){
                $("#res_contable").html(data);

                });			
            });
    });
</script>
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">CREAR CODIGOS CONTABLES</h4>
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
                                    	if ($crear_conf == 'Habilitado'){
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


    $request=mysql_query("select count(*) from cont_codigos_contables ");
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
        $sql='select * from cont_codigos_contables where id_cod_cont="'.$_GET['up'].'"';
        $fil =mysql_fetch_array(mysql_query($sql));
            $codigo= $fil["cod_cod_cont"];
            $descripcion= strtoupper($fil["nom_cod_cont"]);
            $tributario = $fil['cod_tri_cod_cont'];
            $fiscal = $fil['desc_fiscal'];
            $niif = $fil['desc_niif'];
            $naturaleza = $fil['naturaleza'];
            $tipo_trm = $fil['tipo_trm'];
            $aneter = $fil['ane_tercero'];
            $anecos = $fil['ane_costo'];
            $aneret = $fil['ane_retencion'];
            $estado_cont = $fil['estado_cod_cont'];
            $cod_presupuesto = $fil['codigo_presupesto'];
            
            if($aneter == 0 && $anecos == 0 && $aneret == 0){
                $activo = 'checked';
            }  else {
                $activo = '';
            }
        }  
    
 ?>

                                      
  <?php  
if($page>1){?>
	<a href="../vistas/?id=codigos&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=codigos&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=codigos&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=codigos&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
?>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

    if(isset($_POST['btnbuscar'])){
        $request_ac=mysql_query("select * from cont_codigos_contables where concat(cod_cod_cont,'',nom_cod_cont) like '%".$_POST['buscar']."%'");
    }else{
        $request_ac=mysql_query("select * from cont_codigos_contables ".$limit);
    }
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';    
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="20%">'.'Nombre o Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Codigo Tributario'.'</th>';
              $table = $table.'<th width="2%">'.'Estado'.'</th>';
              $table = $table.'<th width="2%">'.'Editar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t=0;
  while($row=mysql_fetch_array($request_ac))
  {       
 $t=$t+1;
if ($row['estado_cod_cont']== '1') {
  $estado='../imagenes/no.png';
}else{
  $estado='../imagenes/ok.png';
}


  if($editar_conf=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up='';}
 if($eliminar_conf=='Habilitado'){$del='&del='.$row['id_cod_cont'].'';}else{$del='';}
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>
            <td width="10%">'.$row['cod_cod_cont'].'</font></td>
            <td width="20%">'.strtoupper($row['nom_cod_cont']).'</font></td>
            <td width="5%">'.$row['cod_tri_cod_cont'].'</font></td>
            <td width="2%"><img src='.$estado.'></font></td>
            <td width="2%"><a href="../vistas/?id=codigos&up='.$row['id_cod_cont'].'">'.$up.'</a> </td>';

           
    
               
  } 
  $table = $table.'</table>';
        
  echo $table;
  
}
 ?>
        <?php 
                                              $car = '1';
                                              $num = strlen($car);
                                              
                                              if($num==2){
                                                  $t = 0;
                                                  $x =  substr($car,0);
                                              }else{
                                                  if($num==3){
                                                 
                                                 $x =  substr($car,0,-1);
                                              }else{
                                                  $t = $num - 2;
                                                  $x = substr($car,0,-$t);
                                              }
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
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/insertar_codigos_cont.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                          
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Codigo</label>
                                               <div class="controls"><input type="text" autocomplete="off" id="codigo_cont" name="codigo" <?php if (isset($_GET['up'])) {
                                              echo 'readonly';
                                            }else{
                                              echo '';
                                            } ?> value="<?php if(isset($_GET['up'])){echo $codigo;}  ?>" class="span2" placeholder="" maxlength="9" required></div>
                                             <!-- Nombre -->
                                            <div id="res_contable">
                                                <label></label><div class="controls"> </div>
                                                <label class="control-label">Descripcion CONTABLE</label>
                                                <div class="controls">
                                                    <input type="text" autocomplete="off" name="nombre" value="<?php if(isset($_GET['up'])){echo $descripcion;}  ?>" class="span4" placeholder="" required>
                                                </div>
                                                   <label></label><div class="controls"> </div>
                                                <label class="control-label">Descripcion FISCAL</label>
                                                <div class="controls">
                                                    <input type="text" autocomplete="off" name="fiscal" value="<?php if(isset($_GET['up'])){echo $fiscal;}  ?>" class="span4" placeholder="" required>
                                                </div>
                                                  <label></label><div class="controls"> </div>
                                                <label class="control-label">Descripcion NIIF</label>
                                                <div class="controls">
                                                    <input type="text" autocomplete="off" name="niif" value="<?php if(isset($_GET['up'])){echo $niif;}  ?>" class="span4" placeholder="" required>
                                                </div>
                                           
                                             
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Naturaleza</label>
                                            <div class="controls">
                                                <select name="naturaleza">
                                                    <?php
                                                        if(isset($_GET['up'])){
                                                            if($naturaleza == 1){ ?>
                                                                <option value="<?php echo $naturaleza; ?>">1-Debito</option>
                                                                <option value="2">2-Credito</option>
                                                                <option value="3">3-Anexo Tercero</option>
                                                            <?php }else if($naturaleza == 2){ ?>
                                                                <option value="<?php echo $naturaleza; ?>">2-Credito</option>
                                                                <option value="1">1-Debito</option>
                                                                <option value="3">3-Anexo Tercero</option>
                                                            <?php }else{ ?>
                                                                <option value="<?php echo $naturaleza; ?>">3-Anexo Tercero</option>
                                                                <option value="1">1-Debito</option>
                                                                <option value="2">2-Credito</option>
                                                            <?php }
                                                        }else{ ?>
                                                                
                                                                <option value="1">1-Debito</option>
                                                                <option value="2">2-Credito</option>
                                                                <option value="3">3-Anexo Tercero</option>
                                                        <?php }
                                                    ?>
                                                   
                                                </select>
                                            </div> 
                                            
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Tipo T.R.M</label>
                                            <div class="controls">
                                                <select name="tipotrm">
                                                    <?php
                                                         if(isset($_GET['up'])){ ?>
                                                                <option value="<?php echo $naturaleza; ?>">0-Ninguno</option>
                                                                
                                                            <?php 
                                                        }else{ ?>
                                                           
                                                                <option value="0">0-Ninguno</option>
    
                                                        <?php }
                                                    ?>
                                                </select>
                                            </div> 
                                            <!-- Consecutivo -->
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Codigo Tributario</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="cod_tributario" value="<?php if(isset($_GET['up'])){echo $tributario;}  ?>" class="span4" placeholder="" required>
                                            </div>
                                            <label></label><div class="controls"> </div>    
                                            <label class="control-label">Codigo Presupuesto</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="cod_presupuesto" value="<?php if(isset($_GET['up'])){echo $cod_presupuesto;}  ?>" class="span4" placeholder="" required>
                                            </div>
                                            <label></label><div class="controls"> </div>  
                                             <!-- Observacion -->
                                            <div class="controls">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" <?php if (isset($_GET['up'])){if($aneter > 0){echo 'checked';}} ?> value="1" name="aneter">1- Anexos de Tercero
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" <?php if (isset($_GET['up'])){if($anecos > 0){echo 'checked';}} ?> value="2" name="anecos">2- Anexos de Costo
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" <?php if (isset($_GET['up'])){if($aneret > 0){echo 'checked';}} ?> value="3" name="aneret">3- Anexos de Retencion
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" <?php if (isset($_GET['up'])){echo $activo; } ?> value="4" name="estado">4-Cuenta Inactiva
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                             <label></label><div class="controls"> </div>  
                                          
                                            
                                           
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                       <?php
                                    		if (isset($_GET['up'])) {
                                    			if ($editar_conf == 'Habilitado') { ?>
                                        <button type="submit" class="btn btn-primary" name="Editar"><?php if(isset($_GET['up'])){echo 'Actualizar';}else{echo 'Agregar';} ?></button>
	                                    		<?php
												}
                                    		} else {
                                    			if ($crear_conf == 'Habilitado') {?>
	                                    			<button type="submit" class="btn btn-primary"><?php if(isset($_GET['up'])){echo 'Actualizar';}else{echo 'Agregar';} ?></button>
	                                    		<?php
                                    			}
                                    		}
                                    	?>
                                        <a href="../vistas/?id=codigos"><button type="button" class="btn">Cancelar</button></a>
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







