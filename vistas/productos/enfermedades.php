<?php $request2=mysql_query('select count(*) from enfermedades');if($request2){	$request2 = mysql_fetch_row($request2);	$num_items2 = $request2[0];}else{	$num_items2 = 0;}$rows_by_page2 = 30;$last_page2 = ceil($num_items2/$rows_by_page2);if(isset($_GET['page2'])){	$page2 = $_GET['page2'];}else{	$page2 = 1;}?>                               <div class="row-fluid">                        <!-- START Form Wizard -->                      <!-- START Widget Collapse -->                           <section class="body">                                <div class="body-inner">                        <div class="span12 widget dark stacked">                            <header>                                <h4 class="title">Enfermedades</h4>                                <!-- START Toolbar -->                                <ul class="toolbar pull-left">                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>                                </ul>                                <!--/ END Toolbar -->                            </header>                            <section id="collapse1" class="body collapse in">                                <div class="body-inner">                                                                               <!-- Normal Tabs -->                                                        <div class="tabbable" style="margin-bottom: 25px;">                                <ul class="nav nav-tabs">                                    <li class="<?php if(!isset($_GET['up'])){echo 'active';} ?>"><a href="#tab7" data-toggle="tab"><span class="icon icone-eye-open"></span>Lista</a></li>                                    <li class="<?php if(isset($_GET['up'])){echo 'active';} ?>"><a href="#tab8" data-toggle="tab"><span class="icon icone-pencil"></span> Agregar </a></li>                                                                  </ul>                                                                <br>                                <form method="post" action="">                                    <input type="text" name="buscar" class="span4" placeholder="Ingrese Codigo O Descripcion">                                    <button name="btnbuscar">Buscar</button>                                </form>                                <div class="tab-content">                                    <div class="tab-pane <?php if(!isset($_GET['up'])){echo 'active';} ?>" id="tab7">                                         <!-- START Row -->                    <div class="row-fluid">                        <!-- START Datatable 2 -->                        <div class="span12 widget lime">                                                        <section class="body">                                <div class="body-inner no-padding"><?phpif(isset($_GET['up'])){     $sql='select * from enfermedades where id_enfermedad="'.$_GET['up'].'"'; $fil =mysql_fetch_array(mysql_query($sql));        $nombre_medicamento= $fil["descripcion"];         $codigo= $fil["codigo_enf"];          $sexo= $fil["sexo"];           $sup= $fil["lim_sup"];            $inf= $fil["lim_inf"];        ?>                                                                       <?php}else{if($page2>1){?>	<a href="../vistas/?id=enfermedades&page2=1"><img src="../images/a1.png"></a>	<a href="../vistas/?id=enfermedades&page2=<?php echo $page2 - 1;?>"><img src="../images/a11.png"></a><?php}else{	?><img src="../images/ant.png"><?php}?>(Pagina <?php echo $page2;?> de <?php echo $last_page2;?>)<?phpif($page2<$last_page2){?>	<a href="../vistas/?id=enfermedades&page2=<?php echo $page2 + 1;?>"><img src="../images/p1.png"></a>	<a href="../vistas/?id=enfermedades&page2=<?php echo $last_page2;?>"><img src="../images/p11.png"></a><?php}else{	?><img src="../images/nex.png">  <?php}?><?php//Esta es la cadena limit que anexaremos a nuestra consulta$limit2 = 'LIMIT ' .($page2 - 1) * $rows_by_page2 .',' .$rows_by_page2;if(isset($_POST['btnbuscar'])){    $request_l=mysql_query("SELECT * FROM enfermedades where concat(codigo_enf,'',descripcion) like '%".$_POST['buscar']."%' ");}else{    $request_l=mysql_query("SELECT * FROM enfermedades ".$limit2);}   if($request_l){//    echo'<hr>';       $table = '<table class="table table-bordered table-striped table-hover" id="">';             $table = $table.'<thead >';              $table = $table.'<tr BGCOLOR="#C3D9FF">';              $table = $table.'<th width="5%">'.'Codigo'.'</th>';                        $table = $table.'<th width="20%">'.'Descripcion'.'</th>';              $table = $table.'<th width="5%">'.'Lim sup'.'</th>';              $table = $table.'<th width="5%">'.'Lim inf'.'</th>';              $table = $table.'<th width="5%">'.'Sexo'.'</th>';              $table = $table.'<th width="5%">'.'Acciones'.'</th>';              $table = $table.'</tr>';              $table = $table.'</thead>';	        	//Por cada resultado pintamos una linea        $total2=0;	while($row=mysql_fetch_array($request_l))	{                    $table = $table.'<tr><td width="5%">'.$row['codigo_enf'].'</a></td>'                    . '<td width="20%">'.$row['descripcion'].'</td>'                    . '<td width="5%">'.$row['lim_sup'].'</td>'                    . '<td width="10%">'.$row['lim_inf'].'</td>'                    . '<td width="10%">'.$row['sexo'].'</td>                              <td width="5%"><a href="../vistas/?id=enfermedades&up='.$row["id_enfermedad"].'""><img src="../imagenes/modificar.png"></a> <a href="../vistas/?id=enfermedades&del='.$row["id_enfermedad"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';                		               	} 	$table = $table.'</table>';        	echo $table;  }} ?>                                </div>                            </section>                        </div>                        <!--/ END Datatable 2 -->                    </div>                    <!--/ END Row -->                                    </div>                                    <div class="tab-pane <?php if(isset($_GET['up'])){echo 'active';} ?>" id="tab8">                                        <div class="row-fluid">    <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up'])){echo '../modelo/insertar_enfermedad.php?editar='.$_GET['up'].' ';}else{echo '../modelo/insertar_enfermedad.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                                                    <section class="body">                                <div class="body-inner">                                                                                <div class="control-group">                                                                                            <label></label><div class="controls"> </div>                                                                                      <label></label><div class="controls"> </div>                                               <label class="control-label">Nombre de la enfermedad</label>                                               <div class="controls"><input type="text" name="nombre" value="<?php if(isset($_GET['up'])){echo $nombre_medicamento;} ?>" class="span6" placeholder=" " required></div>                                             <label></label><div class="controls"> </div>                                               <label class="control-label">Codigo</label>                                               <div class="controls"><input type="text" name="codigo" value="<?php if(isset($_GET['up'])){echo $codigo;} ?>" class="span6" placeholder=" " required></div>                                               <label></label><div class="controls"> </div>                                               <label class="control-label">Limite superior</label>                                               <div class="controls"><input type="text" name="sup" value="<?php if(isset($_GET['up'])){echo $sup; }?>" class="span6" placeholder=" " required></div>                                               <label></label><div class="controls"> </div>                                               <label class="control-label">Limite inferior</label>                                               <div class="controls"><input type="text" name="inf" value="<?php if(isset($_GET['up'])){echo $inf; }?>" class="span6" placeholder=" " required></div>                                               <label></label><div class="controls"> </div>                                               <label class="control-label">Sexo</label>                                               <div class="controls"><select name="sexo">                                                                    <?php if (isset($_GET['up'])){ echo '<option value="'.$sexo.'">'.$sexo.'</option>';} ?>                                                                   <option value="H">Hombre</option>                                                                   <option value="M">Mujer</option>                                                                   <option value="A">Ambos</option>                                                               </select></div>                                     <div class="form-actions">                                                                                <?php if(isset($_GET['up'])){                                            if($editar_conf=='Habilitado'){                                               echo '<button type="submit" class="btn btn-primary">Guardar Cambios</button>';                                             }else{                                                echo '<button type="button" class="btn btn-primary">No tiene acceso para editar</button>';                                            }                                                                                     }else{                                            echo '<button type="submit" class="btn btn-primary">Guardar</button>';                                        } ?>                                                                                <a href="../vistas/?id=index"><button type="button" class="btn">Cancelar</button></a>                                    </div><!--/ Form Action -->                                </div>                            </section>                        </form>                        <!--/ END Form Wizard -->                    </div>                                    </div>                                </div>                            </div><!--/ Normal Tabs -->                                </div>                            </section>                        </div>                    </div> </section></div>                                 <?php    if(isset($_GET['del'])){$sql = "DELETE FROM enfermedades WHERE id_enfermedad=".$_GET['del']."";mysql_query($sql, $conexion);echo "<script language='javascript' type='text/javascript'>";echo "location.href='../vistas/?id=enfermedades'";echo "</script>";}                             