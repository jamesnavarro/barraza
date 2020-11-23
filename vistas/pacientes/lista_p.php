<?php 
$request=mysql_query('select count(*) from pacientes where alta="No Vinculado"');
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
?>  <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Lista de Pacientes</h4>

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
                                                    <select  class="span8"  name="nombre" id="select2_1">
                                                 <option value=''>Seleccione el paciente...</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `pacientes` where alta='No Vinculado'";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1e=$fila['nombres'].' '.$fila['apellidos'].' '.$fila['apellido2'];
                                                            $valor2e=$fila['id_paciente'];
                                                         

                                                            echo"<option value=".$valor2e.">".$valor1e."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select>
                                                </div>
                                                <div class="span4">
                                                    <select  name="empresa"  class="span8"   id="select2_2">
                                                    <option value=''>Buscar por empresa</option>
                                                                   
                                                                      <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `sis_empresa`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1c=$fila['nombre_emp'];
                                                         $rips=$fila['rips'];
                                                         

                                                            echo"<option value=".$rips.">".$valor1c."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select>
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
	<a href="../vistas/?id=pacientes_p&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=pacientes_p&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=pacientes_p&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=pacientes_p&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['empresa']) || isset($_POST['nombre']) || isset($_POST['user'])){
   
    if($_POST['nombre']==""){
          $request=mysql_query("SELECT * FROM pacientes where id_empresa='".$_POST['empresa']."'  ");
    }else{
          $request=mysql_query("SELECT * FROM pacientes where id_paciente=".$_POST['nombre']."  ");
    }
        
    

  
}else{
$request=mysql_query("SELECT * FROM pacientes where alta='No Vinculado' ".$limit);
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="20%">'.'Nombre de Contacto'.'</th>'; 
              $table = $table.'<th width="8%">'.'Enfermedad'.'</th>';
              $table = $table.'<th width="30%">'.'Empresa'.'</th>';
              $table = $table.'<th width="8%">'.'Telefeno'.'</th>';
              $table = $table.'<th width="8%">'.'Celular'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Acudiente'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alta temprana'.'</th>';
            
              $table = $table.'<th class="hidden-phone">'.'Editar..'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Eliminar'.'</th>';
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       

$consulta2= "select * from sis_empresa WHERE  rips='".$row['id_empresa']."'";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idempresa=$fila['id_empresa'];
$empresa=$fila['nombre_emp'];
} if($editar_pac=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up = '';}
           if($eliminar_pac=='Habilitado'){$del= '<img src="../imagenes/eliminar.png">';}else{$del = '';}
                
            $table = $table.'<tr>
                <td width="20%"><a href="../vistas/?id=ver_paciente&cod='.$row['id_paciente'].'">'.$row['nombres'].' '.$row['nombre2'].' '.$row['apellidos'].' '.$row['apellido2'].'</a></td> 
                <td width="8%">'.$row['enfermedad'].'<font></a></td>
                <td width="30%"><a href="../vistas/empresa/?id=ver_empresa&cod='.$row['id_empresa'].'">'.$empresa.'</a></td>
                <td class="hidden-phone">'.$row["tel_1"].'</font></td><td class="hidden-phone">'.$row["celular"].'</font></td><td class="hidden-phone">'.$row["nombre_acudiente"].'</font></td><td class="hidden-phone">'.$row["alta"].'</font></td>
                <td><a href="../vistas/?id=paciente&cod='.$row['id_paciente'].'">'.$up.'</a></td>
                <td><a href="../vistas/?id=paciente&del='.$row['id_paciente'].'">'.$del.'</a></td></tr>';   
      
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
$sql = "DELETE FROM pacientes WHERE id_paciente=".$_GET['del']."";
mysql_query($sql, $conexion);
$a2 = '<a href="../vistas/?id=pacientes_p&cod='.$_GET["del"].'">Paciente potencial # '.$_GET['del'].'</a>';
         $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`) ";
            $sqlr.= "VALUES ('Se elimino un paciente potencial', '".$a2."', '".$_SESSION['k_username']."')";
            mysql_query($sqlr, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=pacientes_p'";
echo "</script>";
}
 }
?>