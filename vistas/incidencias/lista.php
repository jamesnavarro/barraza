<?php 
$request=mysql_query('select count(*) from sis_incidencias where estado_inc="En proceso" ');
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
function interval_date2($init,$finish)
{
    //formateamos las fechas a segundos tipo 1374998435
    $diferencia = strtotime($finish) - strtotime($init);
 
    //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
    //floor devuelve el número entero anterior, si es 5.7 devuelve 5
    if($diferencia < 60){
        $tiempo =  floor($diferencia) . " segundos";
    }else if($diferencia > 60 && $diferencia < 3600){
        $tiempo =  floor($diferencia/60) . " minutos'";
    }else if($diferencia > 3600 && $diferencia < 86400){
        $tiempo =  floor($diferencia/3600) . " horas";
    }else if($diferencia > 86400 && $diferencia < 2592000){
        $tiempo =  floor($diferencia/86400) . " días";
    }else if($diferencia > 2592000 && $diferencia < 31104000){
        $tiempo =  floor($diferencia/2592000) . " meses";
    }else if($diferencia > 31104000){
        $tiempo =  floor($diferencia/31104000) . " años";
    }else{
        $tiempo = "Error";
    }
    return $tiempo;
}
?>  <div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Lista de Novedades</h4>

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
                                               
                                                   
                                              
                                                    <select  class="span2"  name="categoria" id="">
                                                 <option value=''>Categoria...</option>
                                                 <option value="Queja">Queja</option> 
                                                <option value="Reclamo Atencion">Reclamo</option> 
                                                <option value="Sugerencia">Sugerencia</option> 
                                                <option value="Felicitaciones">Felicitaciones</option> 
                                                <option value="Demanda de Peticion">Demanda de Peticion</option>
                                                <option value="Tutelas">Tutelas</option> 
                                            </select>
                                                   <select  class="span1"  name="ano" id="">
                                                 <option value=''>Año...</option>
                                                 <option value="2015" <?php if(date("Y")==2015){echo 'selected'; } ?>>2015</option> 
                                                <option value="2016" <?php if(date("Y")==2016){echo 'selected'; } ?>>2016</option> 
                                                <option value="2017" <?php if(date("Y")==2017){echo 'selected'; } ?>>2017</option> 
                                                <option value="2018" <?php if(date("Y")==2018){echo 'selected'; } ?>>2018</option> 
                                                <option value="2019" <?php if(date("Y")==2019){echo 'selected';}  ?>>2019</option>
                                                <option value="2020" <?php if(date("Y")==2020){echo 'selected'; } ?>>2020</option> 
                                            </select>
                                                <select  class="span1"  name="mes" id="">
                                                 <option value=''>Mes...</option>
                                                <option value="02" <?php if(date("m")==02){echo 'selected'; } ?>>02</option> 
                                                <option value="03" <?php if(date("m")==03){echo 'selected'; } ?>>03</option> 
                                                <option value="04" <?php if(date("m")==04){echo 'selected'; } ?>>04</option> 
                                                <option value="05" <?php if(date("m")==05){echo 'selected'; } ?>>05</option>
                                                <option value="06" <?php if(date("m")==06){echo 'selected'; } ?>>06</option> 
                                                <option value="07" <?php if(date("m")==07){echo 'selected'; } ?>>07</option> 
                                                <option value="08" <?php if(date("m")==08){echo 'selected'; } ?>>08</option> 
                                                <option value="09" <?php if(date("m")==09){echo 'selected'; } ?>>09</option> 
                                                <option value="10" <?php if(date("m")==10){echo 'selected'; } ?>>10</option> 
                                                <option value="11" <?php if(date("m")==11){echo 'selected'; } ?>>11</option> 
                                                <option value="12" <?php if(date("m")==12){echo 'selected'; } ?>>12</option> 
                                            </select>
                                                
                                                
                                               
                                                  <input name="asunto" class="span4"  type="text" placeholder="digite el asunto, Nombre del Paciente, registrado por">
                                                    <input type="submit" class="btn" name="Buscar" value="Buscar">
                                              
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
   
if(isset($_POST['numero']) || isset($_POST['empresa']) || isset($_POST['asunto'])){
   
    
    
$dates = $_POST['ano'].'-'.$_POST['mes'];
    $request=mysql_query("SELECT * FROM sis_incidencias a, pacientes b where a.id_paciente=b.id_paciente and a.estado_inc='En proceso' and concat(asunto_inc,' ',registrado_por,' ',nombres,' ',apellidos) like '%".$_POST['asunto']."%' and a.categoria_inc like '%".$_POST['categoria']."%' and a.fecha_registro_inc like '%".$dates."%'");
}else{
$request=mysql_query("SELECT * FROM sis_incidencias a, pacientes b where a.id_paciente=b.id_paciente and a.estado_inc='En proceso' ");
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Radicado'.'</th>';  
               $table = $table.'<th width="10%">'.'Categoria'.'</th>';  
              $table = $table.'<th width="20%">'.'Asunto'.'</th>';
              $table = $table.'<th width="30%">'.'Paciente'.'</th>';
              $table = $table.'<th width="10%">'.'Prioridad'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Registrado por'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Fecha de Reg.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Asignado a'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Tiempo de Respuesta'.'</th>';
              $table = $table.'<th>'.'Editar..'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{      
            $result = mysql_query("select * from pacientes where id_paciente=".$row['id_paciente']." ");
            $cons = mysql_fetch_array($result);
            if($row["fecha_mod_reg"]==''){
              $tiempo33 = '<font color="red">Sin Resolver</font>';
           
          }else{
              $tiempo33 = interval_date2($row['fecha_registro_inc'],$row['fecha_mod_reg']);
          }
            $table = $table.'<tr><td width="5%"><a href="../vistas/?id=ver_incidencias&cod='.$row['id_incidencia'].'">'.$row['id_incidencia'].'</a></td>
                <td width="10%">'.$row["categoria_inc"].'<font></a></td>
                <td width="20%"><a href="../vistas/?id=ver_incidencias&cod='.$row['id_incidencia'].'">'.$row['asunto_inc'].'</a></td><td width="20%"><a href="../vistas/?id=ver_paciente&cod='.$cons['id_paciente'].'">'.$cons['nombres'].' '.$cons['apellidos'].'</a></td>
                    '
                    . '<td width="10%">'.$row["prioridad_inc"].'<font></a></td>
               <td class="hidden-phone">'.$row["estado_inc"].'</font></td>
                   <td class="hidden-phone">'.$row["fecha_registro_inc"].'</font></td>
                   <td class="hidden-phone">'.$row["registrado_por"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["asignado_inc"].'</font></td><td class="hidden-phone">'.$tiempo33.'</font></td>
                                <td><a href="../vistas/?id=incidencia&cod='.$row["id_incidencia"].'"><img src="../imagenes/modificar.png"></a></td>
                                    <td><a href="../vistas/?id=incidencias&del='.$row["id_incidencia"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
      
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
     if($eliminar_inc!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=incidencias"</script>'; 
}else{
$sql = "DELETE FROM sis_incidencias WHERE id_incidencia=".$_GET['del']." and asignado_inc='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=incidencias'";
echo "</script>";
}
 }
?>