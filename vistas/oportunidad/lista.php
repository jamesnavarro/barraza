<?php 
$request=mysql_query('select count(*) from sis_oportunidades');
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
?>  <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Lista de Oportunidades</h4>

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
                              <form class="" action="" method="post" id="" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Buscar</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <select name="numero" class="span6"> 
                                               <option value="">Seleccione el tipo</option> 
                                                <option value="negocios_existentes">Negocios existentes</option> 
                                                <option value="nuevos_negocios">Nuevos negocios</option> 
                                                
                                          </select>
                                                </div>
                                               <div class="span4">
                                                    <select  class="span8"  name="empresa" id="select2_1">
                                                 <option value=''>Seleccione la empresa...</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `sis_empresa`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1e=$fila['nombre_emp'];
                                                         $valor2e=$fila['id_empresa'];
                                                         

                                                            echo"<option value=".$valor1e.">".$valor1e."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select>
                                                </div>
                                                <div class="span4">
                                                  <input name="asunto" type="text" placeholder="digite el asunto">
                                                    <input type="submit" class="btn" name="Buscar" value="Buscar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </form><!--/ Help Text -->
 <br>
                            <div class="tabbable" style="margin-bottom: 25px;">
                              

                                
                                <div class="tab-content">

                                    <div class="" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php
if($page>1){?>
	<a href="../vistas/?id=oportunidades&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=oportunidades&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=oportunidades&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=oportunidades&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['numero']) || isset($_POST['empresa']) || isset($_POST['asunto'])){
   
    
    

    $request=mysql_query("SELECT * from sis_oportunidades a, sis_empresa b WHERE a.id_empresa=b.id_empresa and  nombre_emp like '%".$_POST['empresa']."%' and a.nombre_opo like '%".$_POST['asunto']."%' and a.tipo_opo like '%".$_POST['numero']."%'");
}else{
$request=mysql_query("select * from sis_oportunidades a, sis_empresa b WHERE a.id_empresa=b.id_empresa ".$limit);
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="20%">'.'Nombre de la Oportunidad'.'</th>';             
              $table = $table.'<th width="20%">'.'Empresa'.'</th>';
              $table = $table.'<th width="20%">'.'Etapas de Ventas'.'</th>';
              $table = $table.'<th width="10%">'.'Cantidad'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Fecha de Cierre'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Usuario'.'</th>';
              $table = $table.'<th>'.'Editar..'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{      
    
            $table = $table.'<tr><td width="20%"><a href="../vistas/?id=ver_oportunidades&cod='.$row['id_oportunidad'].'">'.$row['nombre_opo'].'</a></td>
                <td width="20%"><a href="../vistas/?id=ver_empresa&cod='.$row['id_empresa'].'">'.$row['nombre_emp'].'</a></td><td width="20%">'.$row['etapas_opo'].'</td>
                    <td width="10%">$ '.number_format($row["cantidad"]).'<font></a></td>
               <td class="hidden-phone">'.$row["fecha_opo"].'</font></td>
                   <td class="hidden-phone">'.$row["asignado_opo"].'</font></td>
                                <td><a href="../vistas/?id=oportunidad&cod='.$row["id_oportunidad"].'"><img src="../imagenes/modificar.png"></a></td>
                                    <td><a href="../vistas/?id=oportunidades&del='.$row["id_oportunidad"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
      
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
     if($eliminar_opo!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=oportunidades"</script>'; 
}else{
$sql = "DELETE FROM sis_oportunidades WHERE id_id_oportunidad=".$_GET['del']." and asignado_opo='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=oportunidades'";
echo "</script>";
 }}

?>