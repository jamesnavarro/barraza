<?php 
$request=mysql_query('select count(*) from sis_empresa where cliente="Si" ');
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 20;

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

                                <h4 class="title">Lista de Empresas</h4>

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
                                                <div class="row-fluid">
                                                <input type="text" name="buscar" placeholder="Buscar Contacto" class="span4" value="<?php if(isset($_POST['buscar'])){echo $_POST['buscar']; } ?>">
                                                <button type="submit" name="btnbuscar">Buscar</button>
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
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
    if(isset($_POST['buscar'])){
        $request=mysql_query("SELECT * FROM sis_empresa where  cliente='Si' and concat(nombre_emp,'', municipio_emp,'', usuario) like '%".$_POST['buscar']."%'");
    }else{
        $request=mysql_query("SELECT * FROM sis_empresa where cliente='Si' ");
    }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="30%">'.'Nombre de la empresa'.'</th>'; 
              $table = $table.'<th class="hidden-phone">'.'Rips'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Telefeno'.'</th>';
                  $table = $table.'<th width="5%">'.'Historial de Ventas'.'</th>';
                   $table = $table.'<th width="5%">'.'Prod. Ventas'.'</th>';
              $table = $table.'<th width="5%">'.'Insumos'.'</th>';

              $table = $table.'<th width="5%">'.'Atenciones'.'</th>';
              $table = $table.'<th width="5%">'.'Equipos'.'</th>';
            
              $table = $table.'<th width="5%">'.'Editar..'.'</th>';
              $table = $table.'<th width="5%">'.'Eliminar'.'</th>';
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
            
               if($editar_emp=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up = '';}
if($eliminar_emp=='Habilitado'){$del= '<img src="../imagenes/eliminar.png">';}else{$del = '';} 
               if($crear_conf=='Habilitado'){$conf = '<img src="../images/enfermera1.png">';}else{$conf = '';}
if($crear_conf=='Habilitado'){$conf1= '<img src="../images/laboratorio1.png">';}else{$conf1 = '';} 
if($crear_conf=='Habilitado'){$conf2= '<img src="../images/insumos.png">';}else{$conf2 = '';} 
if($ver_conf=='Habilitado'){$conf3= '<img src="../imagenes/ventas.png">';}else{$conf3 = '';} 
if($ver_conf=='Habilitado'){$conf4= '<img src="../imagenes/sale.png">';}else{$conf4 = '';} 
            $table = $table.'<tr>
                <td width="30%"><a href="../vistas/?id=ver_empresa&cod='.$row['id_empresa'].'">'.$row['nombre_emp'].'</a></td> 
                <td class="hidden-phone">'.$row['rips'].'<font></a></td>
                   
               <td class="hidden-phone">'.$row["tel_oficina_emp"].'</font></td>'
                    . '<td width="5%"><a href="../vistas/?id=history&cod='.$row["id_empresa"].'">'.$conf3.'</a></td>
                        <td width="5%"><a href="../vistas/?id=precios_ventas&cod='.$row["id_empresa"].'">'.$conf4.'</a></td>
                    <td width="5%"><a href="../vistas/?id=precios_insumos&cod='.$row["id_empresa"].'">'.$conf2.'</a></td>'
                    . '<td width="5%"><a href="../vistas/?id=precios_atenciones&cod='.$row["id_empresa"].'">'.$conf.'</a></td>'
                    . '<td width="5%"><a href="../vistas/?id=precios_alquiler&cod='.$row["id_empresa"].'">'.$conf1.'</a></td>
                            <td><a href="../vistas/?id=empresa&cod='.$row["id_empresa"].'">'.$up.'</a></td>
                                <td><a href="../vistas/?id=empresas&del='.$row["id_empresa"].'">'.$del.'</a></td></tr>';   
      
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
     if($eliminar_emp!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=empresas"</script>'; 
}else{
$sql = "DELETE FROM sis_empresa WHERE id_empresa=".$_GET['del']." and usuario='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
 $a2 = '<a href="../vistas/?id=empresas">Empresa # '.$_GET['del'].'</a>';
         $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`) ";
            $sqlr.= "VALUES ('Se elimino una empresa', '".$a2."', '".$_SESSION['k_username']."')";
            mysql_query($sqlr, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=empresas'";
echo "</script>";
}
 }
?>