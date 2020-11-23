
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">TERCEROS</h4>
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
                                            <input type="text" name="buscar" class="span4" placeholder="Digite Codigo O Descripcion De La Linea">
                                            <button name="btnbuscar">Buscar</button>
                                        </form>
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
<?php


    $request=mysql_query("select count(*) from cont_terceros ");
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
        $sql='select * from cont_terceros where id_ter = "'.$_GET['up'].'"';
        $fil =mysql_fetch_array(mysql_query($sql));
            $codigo= $fil["cod_ter"];
            $descripcion= strtoupper($fil["nom_ter"]);
            $documento = $fil['doc_ter'];
            $verificacion = $fil['digiver_ter'];
            $direccion = $fil['dir_ter'];
            $fijo = $fil['telfijo_ter'];
            $movil = $fil['telmovil_ter'];
            $ciudad = $fil['ciudad_ter'];
            $municipio = $fil['municipio_ter'];
            $pais = $fil['pais_ter'];
            $nacimiento = $fil['fecnac_ter'];
            $correo = $fil['correo_ter'];
            $contacto = $fil['cont_ter'];
            $estado_ter = $fil['estado_ter'];
            $especial = $fil['especial'];
            $fuente = $fil['fuente'];
            $ica = $fil['ica'];
            $iva = $fil['iva'];
            $cree = $fil['cree']; $id = $fil['id_ter'];
             $pal = $fil['pal'];
              $pvi = $fil['pvi'];
               $pac = $fil['pac'];$asesor = $fil['vendedor'];
               
        }  
    
 ?>

                                      
  <?php  
if($page>1){?>
	<a href="../vistas/?id=terceros&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=terceros&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=terceros&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=terceros&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
?>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

    if(isset($_POST['btnbuscar'])){
        $request_ac=mysql_query("select * from cont_terceros where concat(cod_ter,'',nom_ter) like '%".$_POST['buscar']."%'");
    }else{
        $request_ac=mysql_query("select * from cont_terceros ".$limit);
    }
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Items'.'</th>';
                   $table = $table.'<th width="5%">'.'Documento'.'</th>';
              $table = $table.'<th width="10%">'.'No. Doc'.'</th>';
              $table = $table.'<th width="20%">'.'Nombre o Descripcion'.'</th>';
         
              $table = $table.'<th width="5%">'.'Telefono'.'</th>';
              $table = $table.'<th width="2%">'.'Estado'.'</th>';
              $table = $table.'<th width="2%">'.'Editar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t=0;
  while($row=mysql_fetch_array($request_ac))
  {       
 $t=$t+1;
if ($row['estado_ter']== '1') {
  $estado='../imagenes/no.png';
}else{
  $estado='../imagenes/ok.png';
}


  if($editar=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up='';}
 if($eliminar=='Habilitado'){$del='&del='.$row['id_ter'].'';}else{$del='';}
            $table = $table.'<tr><td width="5%">'.$t.'</a></td>
                  <td width="5%">'.$row['doc_ter'].'</font></td>
            <td width="10%">'.$row['cod_ter'].'</font></td>
            <td width="20%">'.strtoupper($row['nom_ter']).'</font></td>
          
            <td width="5%">'.$row['telfijo_ter'].'</font></td>
            <td width="2%"><img src='.$estado.'></font></td>
            <td width="2%"><a href="../vistas/?id=terceros&up='.$row['id_ter'].'">'.$up.'</a> </td>';

           
    
               
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
                                            <form class="span12 widget shadowed dark form-horizontal bordered" action="../modelo/insertar_terceros.php" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                             <!-- Nombre -->
                                             <label></label><div class="controls"> </div>
                                               <label class="control-label">Identificacion</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="codigo" id="cod_ide" value="<?php if(isset($_GET['up'])){echo $codigo;}  ?>" placeholder="" maxlength="11" required>
                                                <input type="hidden" autocomplete="off" name="id" value="<?php if(isset($_GET['up'])){echo $id;}  ?>" readonly class="span2" placeholder="" maxlength="11" required>
                                            </div>
                                               
                                                    
                                                        <label></label><div class="controls"> </div>
                                               <label class="control-label">Codigo de Verificacion</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="verificacion" value="<?php if(isset($_GET['up'])){echo $verificacion;}  ?>" maxlength="1" class="span1" placeholder="" required>
                                            </div>
                                             <!-- Nombre -->
                                            <label></label><div class="controls"> </div>
                                            <label class="control-label">Nombre/Razon Social</label>
                                            <div class="controls"><input type="text" autocomplete="off" name="nombre" value="<?php if(isset($_GET['up'])){echo $descripcion;}  ?>" class="span4" placeholder="" required></div>
                                              <!-- Consecutivo -->
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Tipo de documento</label>
                                            <div class="controls">
                                                <select name="documento" id="lead_source" title='' tabindex="106" required >
                                                    <?php if(isset($_GET['up'])){
                                                        if($documento=='CC'){
                                                        echo '<option label="" value="CC">Cédula de Ciudadanía</option>';               
                                                    }else if ($documento=='NIT'){
                                                        ECHO '<option label="" value="NIT">Nit</option>';
                                                    }else if ($documento=='PA'){
                                                        echo '<option label="" value="PA">Pasaporte</option>';
                                                    }
                                                    else if ($documento=='CE'){
                                                        echo '<option label="" value="CE">Cédula de Extrangería</option>';
                                                    }
                                                    ?>
                                                    <option label="" value="CC">Cédula de Ciudadanía</option>
                                                    <option label="" value="PA">Pasaporte</option>
                                                    <option label="" value="CE">Cédula de Extrangería</option>
                                                    <option label="" value="NIT">Nit</option>
                                                    <?php
                                                    }else{ ?>
                                                    <option value="">Seleccione...</option>
                                                    <option label="" value="CC">Cédula de Ciudadanía</option>
                                                    <option label="" value="PA">Pasaporte</option>
                                                    <option label="" value="CE">Cédula de Extrangería</option>
                                                    <option label="" value="NIT">Nit</option>
                                                    <?php  }  ?>
                                                    
                                                </select>
                                            </div>
                                             <label></label><div class="controls"> </div>
                                             <label class="control-label">Direccion</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="direccion" value="<?php if(isset($_GET['up'])){echo $direccion;}  ?>" class="span2" placeholder="" required>
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                             <label class="control-label">Telefono Fijo / Fax</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="fijo" value="<?php if(isset($_GET['up'])){echo $fijo;}  ?>" class="span2" placeholder="" required>
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                             <label class="control-label">Telefono Movil</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="movil" value="<?php if(isset($_GET['up'])){echo $movil;}  ?>" class="span2" placeholder="" required>
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                             <label class="control-label">Departamento</label>
                                            <div class="controls">
                                                <select name="departamento" id="ciudad"  class="span4" required>                   
                                                    <?php 
                                                        if(isset($_GET['up'])){
                                                            $c = $ciudad;
                                                            $consulta1= "SELECT * FROM `departamentos` WHERE nombre_dep='".$c."' limit 1 ";  
                                                        $re = mysql_fetch_array(mysql_query($consulta1));  
                                                            echo "<option value='".$c."'>".$c."</option>";
                                                        }else{
                                                            echo "<option value=''>..Seleccione Departamento</option>"; 
                                                        } 
                                                        ?>    
                                                    <?php      
                                                        $consulta = "SELECT * FROM `departamentos` group by nombre_dep";  
                                                        $result=  mysql_query($consulta);                                
                                                        while($fila=  mysql_fetch_array($result)){                 
                                                            $valor1=$fila['cod_dep'];      
                                                            $valor2=$fila['nombre_dep'];      
                                                            echo"<option value='".$valor2."'>".$valor1."- ".$valor2."</option>";   
                                                        }                                                            
                                                    ?>  
                                                </select> 
                                            </div>
                                             <label></label><div class="controls"> </div> 
                                            <label class="control-label">Ciudad / Municipio</label>  
                                            <div class="controls">
                                                <select name="municipio"  id="municipio"  class="span4">         
                                                    <?php if(isset($_GET['up'])){
                                                         $consulta= "SELECT * FROM `departamentos` where  nombre_dep like '%".$ciudad."%' ";  
                                                        $result=  mysql_query($consulta);
                                                         echo "<option value='".$municipio."'>".$municipio."</option>";
                                                        while($fila=  mysql_fetch_array($result)){                 
                                                            $valor1=$fila['cod_mun'];      
                                                            $valor2=$fila['nombre_mun'];      
                                                            echo"<option value='".$valor2."'>".$valor1."- ".$valor2."</option>";   
                                                        }
                                                        
                                                       
                                                    }else{
                                                        echo "<option value=''>Seleccione.. </option>";
                                                    }
                                                    ?>    
                                                </select> 
                                            </div>
                                            <label></label><div class="controls"> </div> 
                                             <label class="control-label">Pais</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="pais" value="<?php if(isset($_GET['up'])){echo $pais;}  ?>" class="span2" placeholder="" required>
                                            </div>
                                             <label></label><div class="controls"> </div>
                                              <label class="control-label">Fecha de Nacimiento</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="nacimiento" value="<?php if(isset($_GET['up'])){echo $nacimiento;}  ?>" class="span2" placeholder="" >
                                            </div>
                                             <label></label><div class="controls"> </div>
                                              <label class="control-label">Correo Electronico</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="correo" value="<?php if(isset($_GET['up'])){echo $correo;}  ?>" class="span2" placeholder="" >
                                            </div>
                                             <label></label><div class="controls"> </div>
                                              <label class="control-label">Contacto</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="contacto" value="<?php if(isset($_GET['up'])){echo $contacto;}  ?>" class="span2" placeholder="" >
                                            </div>
                                              <label></label><div class="controls"> </div>
                                              <label class="control-label">Desc. Aluminio</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="pal" value="<?php if(isset($_GET['up'])){echo $pal;}  ?>" style="width:40px;" placeholder="" >%
                                            </div>
                                              <label></label><div class="controls"> </div>
                                              <label class="control-label">Desc. Vidrio</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="pvi" value="<?php if(isset($_GET['up'])){echo $pvi;}  ?>" style="width:40px;" placeholder="" >%
                                            </div>
                                              <label></label><div class="controls"> </div>
                                              <label class="control-label">Desc. Acero</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="pac" value="<?php if(isset($_GET['up'])){echo $pac;}  ?>" style="width:40px;" placeholder="" >%
                                            </div>
                                             <label></label><div class="controls"> </div>
                                                   
                                                   <label></label>
                                                     
                                                  <div class="controls"> 
                                                     
                                                      <input type="checkbox" name="estado" <?php if(isset($_GET['up'])){ if($estado_ter =='1'){echo 'checked';} }  ?> value="1">
                                                     <label>Estado Inactivo</label>
                                                      <input type="checkbox" name="especial" <?php if(isset($_GET['up'])){ if($especial =='1'){echo 'checked';} }  ?> value="1">
                                                     <label>Cliente Especial</label>
                                                      <input type="checkbox" name="fuente" <?php if(isset($_GET['up'])){ if($fuente =='1'){echo 'checked';} }  ?> value="1">
                                                     <label>No aplica RETEFTE</label>
                                                      <input type="checkbox" name="ica" <?php if(isset($_GET['up'])){ if($ica =='1'){echo 'checked';} }  ?> value="1">
                                                     <label>Retencion ICA</label>
                                                      <input type="checkbox" name="iva" <?php if(isset($_GET['up'])){ if($iva =='1'){echo 'checked';} }  ?> value="1">
                                                     <label>Retencion IVA</label>
                                                     <input type="checkbox" name="cree" <?php if(isset($_GET['up'])){ if($cree =='1'){echo 'checked';} }  ?> value="1">
                                                     <label>Retencion CREE</label>
                                                     
                                                  </div>
                                                   
                                                   <label class="control-label">Asesor</label>
                                            <div class="controls"><select name="vendedor"  <?php if(!isset($_GET['update']) && isset($_GET['cot'])){echo 'disabled';} ?> class="span4" required>    
                                                <?php 
     if(isset($_GET['up'])){echo "<option value='".$asesor."'>".$asesor."</option>";}else{ echo "<option value=''>Seleccione </option>";  }
      $consulta= "SELECT * FROM `usuarios` where area='Ventas'  order by nombre";   
      $result=  mysql_query($consulta); 
      while($fila=  mysql_fetch_array($result)){       
          $valor1=$fila['usuario'];  
          $valor2=$fila['nombre'].' '.$fila['apellido'];   
          echo"<option value='".$valor1."'>".strtoupper($valor2)."</option>";   
          }                                                       
          ?>       
                            </select></div>
                                                
                                           
                                    <!-- Form Action -->
	                                    	<!--<div id="res_tercero">-->
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
                                        <a href="../vistas/?id=terceros"><button type="button" class="btn">Cancelar</button></a>
	                                    		<!--</div>-->
	                                    		<!--/ Form Action -->      
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







