<?php 
$request=mysql_query('select count(*) from sis_contacto where tipo="Potencial"');
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

                                <h4 class="title">Lista de clientes Potenciales</h4>

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
                                                 <option value=''>Seleccione el contacto...</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `sis_contacto`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1e=$fila['nombre_cont'].' '.$fila['apellido_cont'];
                                                         $valor2e=$fila['id_contacto'];
                                                         

                                                            echo"<option value=".$valor1e.">".$valor1e."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select>
                                                </div>
                                                <div class="span4">
                                                    <select  name="empresa"  class="span8"   id="select2_2">
                                                    <option value=''>Buscar por Ciudad</option>
                                                                   
                                                                      <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `departamentos`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1c=$fila['nombre_mun'];
                                                         
                                                         

                                                            echo"<option value=".$valor1c.">".$valor1c."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select>
                                                </div>
                                                <div class="span4">
                                                  
                                                   <select  name="user"  class="span8"   id="select2_2">
                                                    <option value=''>Usuario</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `usuarios`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1u=$fila['id_user'];
                                                            $valor2u=$fila['usuario'];
                                                         

                                                            echo"<option value=".$valor2u.">".$valor2u."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select>
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
	<a href="../vistas/?id=contactos_p&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=contactos_p&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=contactos_p&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=contactos_p&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['empresa']) || isset($_POST['nombre']) || isset($_POST['user'])){
   
    
    

    $request=mysql_query("SELECT * FROM sis_contacto where tipo='Potencial' and  municipio like '%".$_POST['empresa']."%' and nombre_cont like '%".$_POST['nombre']."%' and usuario like '%".$_POST['user']."%'");
}else{
$request=mysql_query("SELECT * FROM sis_contacto where tipo='Potencial' ".$limit);
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="20%">'.'Nombre de Contacto'.'</th>'; 
              $table = $table.'<th width="20%">'.'Cargo'.'</th>';
              $table = $table.'<th width="10%">'.'Empresa'.'</th>';
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
$consulta2= "select * from sis_empresa WHERE  id_empresa=".$row['id_empresa']."";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idempresa=$fila['id_empresa'];
$empresa=$fila['nombre_emp'];
}}
                
            $table = $table.'<tr>
                <td width="10%"><a href="../vistas/?id=ver_contacto&cod='.$row['id_contacto'].'">'.$row['nombre_cont'].' '.$row['apellido_cont'].'</a></td> 
                <td width="20%">'.$row['cargo'].'<font></a></td>
                    <td width="10%"><a href="../vistas/?id=ver_empresa&cod='.$idempresa.'">'.$empresa.'<font></a></td>
               <td class="hidden-phone">'.$row["tel_oficina"].'</font></td><td class="hidden-phone">'.$row["celular"].'</font></td><td class="hidden-phone">'.$row["usuario"].'</font></td>
                            <td><a href="../vistas/?id=contacto&cod='.$row['id_contacto'].'"><img src="../imagenes/modificar.png"></a></td>
                                <td><a href="../vistas/?id=contactos&del='.$row['id_contacto'].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
      
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
$sql = "DELETE FROM sis_contacto WHERE id_contacto=".$_GET['del']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=contactos'";
echo "</script>";
}

?>