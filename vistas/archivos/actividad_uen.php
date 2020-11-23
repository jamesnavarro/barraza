<?php 

?>

<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">CREAR ACTIVIDAD (UEN)</h4>
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
                                            <input type="text" name="buscar" class="span4" placeholder="Digite Codigo O Descripcion De La Actividad">
                                            <button name="btnbuscar">Buscar</button>
                                        </form>
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
<?php


    $request=mysql_query("select count(*) from actividad_uen ");
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
    $sql='select * from actividad_uen where id_act = "'.$_GET['up'].'"';
    $fil =mysql_fetch_array(mysql_query($sql));
        $codigo= $fil["cod_act"];
        $descripcion= strtoupper($fil["nom_act"]);
        $estado_act = $fil['estado_act'];
        $costo = $fil['id_costo_a'];
        $area = $fil['id_area_a'];
        
    $sql1='select * from areas_uen where id_uen = "'.$area.'" ';
    $fil1 =mysql_fetch_array(mysql_query($sql1));
        $id_uen= $fil1["id_uen"];
        $cod_uen= strtoupper($fil1["cod_uen"]);
        $nom_uen = $fil1['nombre_uen'];      
      
    $sql2='select * from cont_centros_de_costo where id_costo = "'.$costo.'" ';
    $fil2 =mysql_fetch_array(mysql_query($sql2));
        $id_costo= $fil2["id_costo"];
        $cod_costo= strtoupper($fil2["cod_costo"]);
        $nom_costo = $fil2['nom_costo'];  
   }  
    
 ?>

                                      
  <?php  
if($page>1){?>
	<a href="../vistas/?id=actividad&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=actividad&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=actividad&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=actividad&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
?>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

    if(isset($_POST['btnbuscar'])){
        $request_ac=mysql_query("select * from actividad_uen a,cont_centros_de_costo b where a.id_costo_a = b.id_costo and concat(cod_act,'',nom_act) like '%".$_POST['buscar']."%'");
    }else{
        $request_ac=mysql_query("select * from actividad_uen a,cont_centros_de_costo b where a.id_costo_a = b.id_costo ".$limit);
    }
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';    
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="20%">'.'Nombre de la Actividad'.'</th>';
              $table = $table.'<th width="5%">'.'Costo'.'</th>';
              $table = $table.'<th width="20%">'.'Centro de Costo'.'</th>';
              $table = $table.'<th width="2%">'.'Estado'.'</th>';
              $table = $table.'<th width="2%">'.'Editar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t=0;
  while($row=mysql_fetch_array($request_ac))
  {       
 $t=$t+1;
if ($row['estado_act']== '1') {
  $estado='../imagenes/no.png';
}else{
  $estado='../imagenes/ok.png';
}


  if($editar=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up='';}
 if($eliminar=='Habilitado'){$del='&del='.$row['id_act'].'';}else{$del='';}
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>
            <td width="10%">'.$row['cod_act'].'</font></td>
            <td width="20%">'.strtoupper($row['nom_act']).'</font></td>
            <td width="5%">'.$row['cod_costo'].'</font></td>
            <td width="20%">'.$row['nom_costo'].'</font></td>
            <td width="2%"><img src='.$estado.'></font></td>
            <td width="2%"><a href="../vistas/?id=actividad&up='.$row['id_act'].'">'.$up.'</a> </td>';

           
    
               
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
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/insertar_actividad_uen.php'; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                              
                                          
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Codigo</label>
                                               <div class="controls"><input autofocus type="text" id="cod_act" autocomplete="off" name="codigo" <?php if (isset($_GET['up'])) {
                                              echo 'readonly';
                                            }else{
                                              echo '';
                                            } ?> value="<?php if(isset($_GET['up'])){echo $codigo;}  ?>" class="span2" placeholder="" minlength="6" maxlength="6" required>
                                                  
                                               </div>
                                               
                                               <div id="res_area">
                                               <label></label><div class="controls"> </div>
                                            <label class="control-label">Area(UEN)</label>
                                            <div class="controls">
                                                <table>
                                                    <tr>
                                                        <td width="100px">
                                                            <input type="text" placeholder="Codigo" readonly class="span12" value="<?php if(isset($_GET['up'])){ echo $cod_uen; } ?>" id="cod_area" name="cod_area">    
                                                        </td>
                                                        <td>
                                                            <input type="text" placeholder="Descripcion" readonly value="<?php if(isset($_GET['up'])){ echo $nom_uen; } ?>" id="des_area" name="des_area">
                                                            <input type="hidden" placeholder="Id" value="<?php if(isset($_GET['up'])){ echo $id_uen; } ?>" id="id_area" name="id_area">    
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                               <label></label><div class="controls"> </div>
                                            <label class="control-label">Costo</label>
                                            <div class="controls">
                                                <table>
                                                    <tr>
                                                        <td width="100px">
                                                            <input type="text" placeholder="Codigo" value="<?php if(isset($_GET['up'])){ echo $cod_costo; } ?>" readonly class="span12" id="cod_costo" name="cod_costo">    
                                                        </td>
                                                        <td>
                                                            <input type="text" placeholder="Descripcion" value="<?php if(isset($_GET['up'])){ echo $nom_costo; } ?>" readonly id="des_costo" name="des_costo">
                                                            <input type="hidden" placeholder="Id" value="<?php if(isset($_GET['up'])){ echo $id_costo; } ?>" id="id_costo" name="id_costo">    
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                             <label></label><div class="controls"> </div>
                                            <label class="control-label">Nombre y/o Descripcion</label>
                                            <div class="controls"><input type="text" autocomplete="off" name="nombre" value="<?php if(isset($_GET['up'])){echo $descripcion;}  ?>" class="span4" placeholder="" required></div>
                                             <label></label><div class="controls"> </div> 
                                            
                                                   
                                                   <label></label>
                                                  <div class="controls"> 
                                                      <input type="checkbox" name="estado" <?php if(isset($_GET['up'])){ if($estado_act =='1'){echo 'checked';} }  ?> value="1">
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
                                        <a href="../vistas/?id=actividad"><button type="button" class="btn">Cancelar</button></a>
                                    </div>
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




