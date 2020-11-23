<?php 
$request=mysql_query('select count(*) from productos');
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 30;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
?> 
<script> 
    $(document).ready(function(){
        
    });
    function cuentas(c){
        window.open('../popup/cuentas.php?in='+c,'Form','width=400 , height=400');
    }
    function pasar_cuenta(cod,i){
        $("#cuenta"+i).val(cod);
    }
    </script>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Listado Productos Creados</h4>

                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>

                                <!--/ END Toolbar -->

                            </header>

                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                      <!-- Help Text -->
                              <form class="" action="" method="post" id="" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Buscar</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <input name="producto" class="span12" type="text" placeholder="Puede Buscar por Nombre, Codigo ó Referencia">
                                                </div>
                                               
                                                <div class="span4">
                                                 
                                                    <input type="submit" class="btn" name="Buscar" value="Buscar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </form><!--/ Help Text -->
                                </div>
                                <div class="body-inner">

                                   

                                            <!-- Normal Tabs -->

                            

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
	<a href="../vistas/?id=productos&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=productos&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=productos&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=productos&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>
  <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../vistas/?id=productos&act' ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
  
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
if(isset($_POST['producto'])){
 $request=mysql_query("SELECT * FROM productos where nombre like '%".$_POST['producto']."%' or codigo_interno like '%".$_POST['producto']."%' or codigo like '%".$_POST['producto']."%' ");   
}else{
$request=mysql_query("SELECT * FROM productos ".$limit);
}
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
             
              $table = $table.'<th width="5%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="20%">'.'Producto'.'</th>';
              $table = $table.'<th  width="5%">'.'Referencia'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Linea'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Costo'.'</th>';
               $table = $table.'<th width="15%">'.'Cod. Siigo'.'</th>';
               $table = $table.'<th width="15%">'.'Cod. Contable'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
               $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;$c = 0;
	while($row=mysql_fetch_array($request))
	{       $c +=1;

             $x = '<a href="../vistas/?id=add_fac&cod='.$row['id'].'"><img src="../imagenes/ojo.png"></a>';
            $table = $table.'<tr>
                <td width="5%">'.$row['codigo'].'</td><td width="20%"><a href="../vistas/?id=ver_productos&cod='.$row['id'].'">'.$row['nombre'].'</a></td>
                    <td  width="5%">'.$row["codigo_interno"].'<font></a></td>'
                    . '<td  class="hidden-phone">'.$row["tipo"].'</td>'
                    . '<td  class="hidden-phone">$ '.number_format($row["precio"]).'</td>
                        <td><input type="text" name="siigo'.$c.'" id="siigo'.$c.'" value="'.$row["codsiigo"].'"  style="width:120px">
               <td width="15%"><input type="hidden" name="id'.$c.'" value="'.$row["id"].'"><input type="text" name="cuenta'.$c.'" id="cuenta'.$c.'" value="'.$row["cuenta"].'"  style="width:80px"> <img src="../imagenes/buscar.png" onclick="cuentas('.$c.')"><td><a href="../vistas/?id=producto&cod='.$row['id'].'"><img src="../imagenes/modificar.png"></a></td>
                   <td class="hidden-phone"><a href="../vistas/?id=productos&del='.$row['id'].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
     
	}
        
        
	$table = $table.'</table>';
        
	echo $table.'<input type="text" name="can" value="'.$c.'" readonly> <input type="submit" value="Actualizar">';
 
        }?></form>
                                </div>

                            </section>

                        </div>

                    </div>

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
     if($eliminar_prod!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=productos"</script>'; 
}else{
$sql = "DELETE FROM productos WHERE id=".$_GET['del']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=productos'";
echo "</script>";
}
 }
    if(isset($_GET['act'])){
       $can = $_POST['can'];
       for($i = 1; $i<=$can; $i++){
           $cuenta = $_POST['cuenta'.$i];
           $siigo = $_POST['siigo'.$i];
           $id = $_POST['id'.$i];
           mysql_query("update productos set cuenta='$cuenta',codsiigo='$siigo' where id=$id ");
                 
       }
        echo '<script>alert("Se ha actualizado las cuentas. ");location.href="../vistas/?id=productos"</script>';
     
   }
?>

