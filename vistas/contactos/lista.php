<?php 
$request=mysql_query('select count(*) from sis_contacto  where tipo="Contactado"');
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

                                <h4 class="title">Lista de contactos</h4>

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
                                                <input type="text" name="buscar" placeholder="Buscar Contacto" class="span4" value="<?php if(isset($_POST['buscar'])){echo $_POST['buscar']; } ?>">
                                                <button type="submit" name="btnbuscar">Buscar</button>
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
	<a href="../vistas/?id=contactos&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=contactos&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=contactos&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=contactos&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
    if(isset($_POST['btnbuscar'])){
        $request=mysql_query("SELECT * FROM sis_contacto where tipo='Contactado' and  concat(municipio,'',nombre_cont,'',usuario) like '%".$_POST['buscar']."%'");
    }else{
        $request=mysql_query("SELECT * FROM sis_contacto where tipo='Contactado' ".$limit);
    }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="20%">'.'Nombre de Contacto'.'</th>'; 
              $table = $table.'<th width="10%">'.'Cargo'.'</th>';
              $table = $table.'<th width="20%">'.'Empresa'.'</th>';
              $table = $table.'<th width="10%">'.'Telefeno'.'</th>';
              $table = $table.'<th width="10%">'.'Celular'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Usuario'.'</th>';
            
              $table = $table.'<th class="hidden-phone">'.'Editar..'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Eliminar'.'</th>';
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
            if($row['id_empresa']==0){
     $idempresa='';
$empresa='';
 }else{
 
$consulta2= "select * from sis_empresa WHERE  id_empresa='".$row['id_empresa']."'";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idempresa=$fila['id_empresa'];
$empresa=$fila['nombre_emp'];
}}
if($editar_con=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up = '';}
if($eliminar_con=='Habilitado'){$del= '<img src="../imagenes/eliminar.png">';}else{$del = '';}
                
            $table = $table.'<tr>
                <td width="10%"><a href="../vistas/?id=ver_contacto&cod='.$row['id_contacto'].'">'.$row['nombre_cont'].' '.$row['apellido_cont'].'</a></td> 
                <td width="10%">'.$row['cargo'].'<font></a></td>
                    <td width="20%"><a href="../vistas/?id=ver_empresa&cod='.$idempresa.'">'.$empresa.'<font></a></td>
               <td class="hidden-phone">'.$row["tel_oficina"].'</font></td><td class="hidden-phone">'.$row["celular"].'</font></td><td class="hidden-phone">'.$row["usuario"].'</font></td>
                            <td><a href="../vistas/?id=contacto&cod='.$row['id_contacto'].'">'.$up.'</a></td>
                                <td><a href="../vistas/?id=contactos&del='.$row['id_contacto'].'">'.$del.'</a></td></tr>';   
      
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

                    </div>

  

                            </section></div>
<?php
 if(isset($_GET['del'])){
     if($eliminar_con!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=contactos"</script>'; 
}else{
$sql = "DELETE FROM sis_contacto WHERE id_contacto=".$_GET['del']."  and usuario='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=contactos'";
echo "</script>";
}
 }
?>