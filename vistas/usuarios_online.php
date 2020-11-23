<?php 
$request=mysql_query('select count(*) from usuarios where estado_empleado="Activo" ');
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

                                <h4 class="title">Lista de Usuarios, Para enviar mensaje de click en el nombre</h4>

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
                                        <label class="control-label">Buscar usuario por nombre, cargo o por cedula</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <select  class="span8"  name="nombre" id="select2_1">
                                                 <option value=''>Seleccione el nombre...</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `usuarios`";                     
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
                                                           $consulta= "SELECT * FROM `usuarios`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cedula'];
                                                         
                                                         

                                                            echo"<option value=".$valor1.">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select>
                                                </div>
                                                <div class="span4">
                                                  
                                                    <select  name="fecha"  class="span8"   id="select2_3">
                                                    <option value=''>Cargo</option>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `usuarios`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cargo'];
                                                         
                                                         

                                                            echo"<option value=".$valor1.">".$valor1."</option>";
                                                            
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
                              

                                <ul class="nav nav-tabs">

                                    <li class="active"><a href="#tab1" data-toggle="tab"><span class="icon icone-eye-open"></span>Usuarios</a></li>

                                </ul>
                                
                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">

                                  

<?php
if($page>1){?>
	<a href="../vistas/?id=online&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=online&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=online&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=online&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

   
if(isset($_POST['nombre']) || isset($_POST['fecha']) || isset($_POST['user'])){
 $fecha = $_POST['fecha'];
 $request=mysql_query("SELECT * FROM usuarios where estado_empleado='Activo' and nombre like '%".$_POST['nombre']."%' and cedula like '%".$_POST['user']."%' and cargo like '%".$_POST['fecha']."%'");
}else{
$request=mysql_query("SELECT * FROM usuarios where  estado_empleado='Activo' order by online desc ".$limit);
  }
     
if($request){
//    echo'<hr>';
    ?>
    <table class="table table-bordered table-striped table-hover" id="">

             <thead >
            <tr BGCOLOR="#C3D9FF">
                        
            
             <th width="20%">Nombre Completo</th>
             <th width="10%">Telefono</th>
              <th class="hidden-phone">Cargo</th>
              <th class="hidden-phone">Area</th>
              <th class="hidden-phone">Correo</th>
               <th class="hidden-phone">Ultimo Acceso</th>
              <th class="hidden-phone">Online</th>
            
              </tr>
             </thead>
	
        <?php
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
           $on=mysql_query('select ip from control_ip where ip='.$row["id"].' ');
           $r=mysql_fetch_array($on);
           if($r["ip"]==$row["id"]){
               $led ='<img src="../imagenes/led.gif">';
           }else{
               $led ='<img src="../imagenes/ledrojo.gif">';
           }
           ?>
            <tr><td width="20%"><a href="../vistas/?id=msg&cod=<?php echo $row["id"] ?>&est"  target="_blank"  class="text" onClick="window.open(this.href, this.target, 'width=400,height=600'); return false;"><?php echo $row["nombre"].' '.$row["apellido"] ?><font></a></td>
                <td width="10%"><?php echo  $row["telefono"] ?><font></a></td>
               <td class="hidden-phone"><?php echo $row["cargo"] ?></font></td>
                    <td class="hidden-phone"><?php echo $row["area"] ?></font></td>
                    <td class="hidden-phone"><?php echo $row["email"] ?></font></td>
                    <td class="hidden-phone"><?php echo $row["ingreso"] ?></font></td>
                    <td class="hidden-phone"><?php echo $led ?></font></td></tr> 
      
	<?php    
}
?>
        
        
	</table>
        
<?php

        
     
}
?>
                                </div>

                            </section>

                        </div>

                        <!--/ END Datatable 2 -->

                    </div>

                    <!--/ END Row -->

                                    </div>

                                    <div class="tab-pane" id="tab2">

                                        <div class="row-fluid">

                        <!-- START Form Wizard -->

                     <?php 
   

 $request=mysql_query("SELECT * FROM prestamo a, clientes b where a.id_cliente=b.id_cliente");
    
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#E3EC7E">';
              $table = $table.'<th width="20%">'.'Nombre del Cliente'.'</th>';             
              $table = $table.'<th width="40%">'.'Direccion'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Prestamo'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Registrado por'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
 
            $table = $table.'<tr><td width="20%"><a href="../vistas/?id=det_clientes&cod='.$row['id_prestamo'].'">'.$row['nombres'].'</a></td><td width="10%">'.$row['direccion'].'</font></td><td width="10%">'.$row["valorprestamo"].'<font></a></td></td>
               <td class="hidden-phone">'.$row["user_reg_pre"].'</font></td></tr>';   
           
		
               
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        
     
}

       
                       ?>456
                       

                        <!--/ END Form Wizard -->

                    </div>

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
     if($_GET['del']==1){
          echo '<script lanquage="javascript">alert("Este Usuario no se puede Eliminar");location.href="../vistas/?id=list_user"</script>'; 
     }else{
         if($eliminar_conf=='Habilitado'){
                    $sql = "DELETE FROM usuarios WHERE id_user=".$_GET['del']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=list_user'";
echo "</script>";  
         }else{
             echo '<script lanquage="javascript">alert("Usted no esta autorizado para eliminar ningun usuario");location.href="../vistas/?id=list_user"</script>'; 
         }

     }

}

?>