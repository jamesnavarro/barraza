<?php 
$request=mysql_query('select count(*) from sis_campana');
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

                                <h4 class="title">Lista de Campañas</h4>

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
                                                    <input name="asunto" type="text" placeholder="Digite el numero de radicado">
                                                </div>
                                              
                                                <div class="span4">
                                                
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
	<a href="../vistas/?id=campanas&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=campanas&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=campanas&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=campanas&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['asunto'])){
   
    
    

    $request=mysql_query("SELECT * FROM sis_campana  where nombre_cam like '%".$_POST['asunto']."%' ");
}else{
$request=mysql_query("SELECT * FROM sis_campana ".$limit);
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="20%">'.'Campaña'.'</th>';             
              $table = $table.'<th width="10%">'.'Estado'.'</th>';
              $table = $table.'<th width="10%">'.'Tipo'.'</th>';
              $table = $table.'<th width="10%">'.'Fecha Inicio'.'</th>';
              $table = $table.'<th width="10%">'.'Fecha Fin'.'</th>';
             
              $table = $table.'<th class="hidden-phone">'.'Usuario'.'</th>';
              $table = $table.'<th>'.'Editar..'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{      
    
            $table = $table.'<tr><td width="20%"><a href="../vistas/?id=ver_campanas&cod='.$row['id_campana'].'">'.$row['nombre_cam'].'</a></td>
                <td width="10%">'.$row['estado_cam'].'</a></td><td width="10%">'.$row['tipo_cam'].'</td>
                    <td width="10%">'.$row["fecha_inicio_cam"].'<font></a></td>
               <td width="10%">'.$row["fecha_fin_cam"].'</font></td>
                   <td class="hidden-phone">'.$row["asignado_cam"].'</font></td>
                                <td><a href="../vistas/?id=campana&cod='.$row["id_campana"].'"><img src="../imagenes/modificar.png"></a></td>
                                    <td><a href="../vistas/?id=campanas&del='.$row["id_campana"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
      
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
     if($eliminar_can!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=campanas"</script>'; 
}else{
$sql = "DELETE FROM sis_campana WHERE id_campana=".$_GET['del']." and asignado_cam='".$_SESSION['k_username']."'  ";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=campanas'";
echo "</script>";
 }}

?>