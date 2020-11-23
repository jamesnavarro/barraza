<?php 
$request=mysql_query('select count(*) from actividad where tarea="Tarea"');
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

                                <h4 class="title">Lista de Tareas</h4>

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
                                                 <option value=''>Seleccione el nombre...</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `datos`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['nombre'].' '.$fila['apellido'];
                                                         
                                                         

                                                            echo"<option value=".$valor1.">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select>
                                                </div>
                                                <div class="span4">
                                                    <select  name="user"  class="span8"   id="select2_2">
                                                    <option value=''>Cedula</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `datos`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['documento'];
                                                         
                                                         

                                                            echo"<option value=".$valor1.">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select>
                                                </div>
                                                <div class="span4">
                                                  
                                                    <select  name="fecha" class="span8" >
                                                        <option value="">Seleccione estado</option>
                                                        <option value="Con proceso">Con proceso</option>
                                                        <option value="Sin proceso">Sin proceso</option>
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

//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['nombre']) || isset($_POST['fecha']) || isset($_POST['user'])){
    $fecha = $_POST['fecha'];
    
    

    $request=mysql_query("SELECT * FROM datos where nombre like '%".$_POST['nombre']."%' and documento like '%".$_POST['user']."%' and estado like '%".$_POST['fecha']."%'");
}else{
$request=mysql_query("SELECT * FROM actividades where tarea='Tarea' ");
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Cerrado'.'</th>';             
              $table = $table.'<th width="15%">'.'Asunto'.'</th>';
              $table = $table.'<th width="15%">'.'Nombre Contacto'.'</th>';
              $table = $table.'<th width="30%">'.'Relacionado a'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Fecha de Inicio'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Asignado a.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Editar..'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Eliminar'.'</th>';
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
            $sql1 = "SELECT * FROM sis_contacto where id_contacto=".$row['id_contacto']."";
                $fila1 =mysql_fetch_array(mysql_query($sql1));
                $id_cliente = $fila1["id_contacto"];$nombre_cli = $fila1["nombre_cont"].' '.$fila1["apellido_cont"];
                include '../modelo/relacionado.php';
                if(isset($ver)){$ver = $ver;}else{$ver = '';}
            $table = $table.'<tr><td width="5%"><a href="../vistas/?id=add&cod='.$row['Id'].'"><img src="../imagenes/cerrar.png"></a></td>
                <td width="15%"><a href="../vistas/?id=ver_tarea&cod='.$row['Id'].'">'.$row['Subject'].'</font></td>
                  <td width="15%">'.$ver.'</td>
                    <td width="10%">'.$row["relacionado"].'</td>
               <td class="hidden-phone">'.$row["StartTime"].'</font></td><td class="hidden-phone">'.$row["user"].'</font></td>
                            <td class="hidden-phone"><a href="../vistas/?id=tarea&cod='.$row["Id"].'"><img src="../imagenes/modificar.png"></a></td>
                                <td class="hidden-phone"><a href="../vistas/?id=tareas&del='.$row["Id"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
      
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
     if($eliminar_tar!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=tareas"</script>'; 
}else{
$sql = "DELETE FROM actividades WHERE Id=".$_GET['del']." and user='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=tareas'";
echo "</script>";
}
 }
?>