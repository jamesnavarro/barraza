<script>
    function modali(id){
        $("#rad").val(id);
        $.ajax({
                type:'POST',
                data:'rad='+id,
                url:'../vistas/casos/consultar_evento.php',
                success : function(req){
                    var p = eval(req);
                    console.log(req);
                    $("#a").val(p[2]);
                    $("#b").val(p[3]);
                    $("#c").val(p[4]);
                    $("#d").val(p[5]);
                    $("#e").val(p[6]);
                    $("#fe").val(p[7]);
                    $("#g").val(p[8]);
                    $("#h").val(p[9]);
                    $("#analisis").val(p[10]);
                    $("#impacto").val(p[11]);
                    $("#probabilidad").val(p[12]);
                    $("#acciones").val(p[13]);
                    $("#estado").val(p[14]);
                }
            });
    }
    function guardar(){
            var rad = $("#rad").val();
            var a = $("#a").val();
            var b = $("#b").val();
            var c = $("#c").val();
            var d = $("#d").val();
            var e = $("#e").val();
            var fe = $("#fe").val();
            var g = $("#g").val();
            var h = $("#h").val();
            var ana = $("#analisis").val();
            var imp = $("#impacto").val();
            var pro = $("#probabilidad").val();
            var acc = $("#acciones").val();
            var est = $("#estado").val();
            console.log(a+' - '+b+' - '+c+' - '+d);
            $.ajax({
                type:'POST',
                data:'rad='+rad+'&a='+a+'&b='+b+'&c='+c+'&d='+d+'&e='+e+'&fe='+fe+'&g='+g+'&h='+h+'&ana='+ana+'&imp='+imp+'&pro='+pro+'&acc='+acc+'&est='+est,
                url:'../vistas/casos/acciones.php',
                success : function(req){
                    alert(req);
                }
            });
    }
    
    </script>
  
<?php 
IF($_SESSION["area"]=='OFICINA'){
    $us = '';
}else{
    $us = ' and a.usuario="'.$_SESSION["k_username"].'" ';
}
if(isset($_POST['estado'])!=''){
    $estado = ' and a.estado = "'. $_POST['estado'].'" ';
}else{
    $estado = '';
}
if(isset($_POST['asunto'])!=''){
    $asunto = ' and a.clasificacion like "%'. $_POST['asunto'].'%" ';
}else{
    $asunto = '';
}
if(isset($_POST['paciente'])!=''){
    $paciente = ' and concat(b.nombres," ",b.apellidos) like "%'. $_POST['paciente'].'%" ';
}else{
    $paciente = '';
}
$request=mysql_query('select count(*) from eventos where asignado="acarranza" '.$us.' '.$estado.' '.$asunto.' '.$paciente.' ');
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

                                <h4 class="title">Lista de Eventos Adverso</h4>

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
                                                   <input  class="span8"  name="paciente" value="" placeholder="Buscar por nombre o cedula">
                                              
                                                </div>
                                                <div class="span4">
                                                    <select name="estado">
                                                        <option value="">Seleccione</option>
                                                        <option value="En proceso">En proceso</option>
                                                        <option value="Completado">Completado</option>
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
	<a href="../vistas/?id=casos&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=casos&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=casos&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=casos&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;



$request=mysql_query('SELECT a.id_evento,a.estado,a.usuario,a.id_paciente,a.clasificacion,a.usuario,a.descripcion,a.asignado,a.clasificacion2,a.fecha_registro,b.nombres,b.apellidos,b.descripcion_enf,b.direccion1,b.barrio,b.celular,a.analisis FROM eventos a, pacientes b where a.id_paciente=b.id_paciente '.$us.' '.$estado.' '.$asunto.' '.$paciente.' '.$limit);

     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Radicado'.'</th>'; 
               $table = $table.'<th width="30%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Clasificacion'.'</th>';
              $table = $table.'<th width="20%">'.'Paciente'.'</th>';
              $table = $table.'<th width="10%">'.'Tipo'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Reportado por'.'</th>';
              $table = $table.'<th>'.'Analisis de Riesgo..'.'</th>';
           
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{      
        if($_SESSION['area']=='OFICINA'){
            $dis = '';
        }else{
            $dis = 'disabled';
        }
            $table = $table.'<tr><td width="5%">'.$row['id_evento'].'</td>
                <td width="30%">'.$row['descripcion'].'</td><td width="10%">'.$row['clasificacion'].'</td>'
                    . '<td width="20%"><a href="../vistas/?id=ver_paciente&cod='.$row['id_paciente'].'">'.$row['nombres'].' '.$row['apellidos'].'<font></a></td>
                    <td width="10%">'.$row["clasificacion2"].'<font></a></td>
               <td class="hidden-phone">'.$row["estado"].'</font></td>
                   <td class="hidden-phone">'.$row["usuario"].'</font></td>
                                <td><button type="button" onclick="modali('.$row["id_evento"].')" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" '.$dis.'>Analizar</button></td>
                                    </tr>';   
      
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Analisis Adverso</h4>
      </div>
      <div class="modal-body">
            <div class="form-group">
      <label class="control-label col-sm-2" for="email">Radicado Evento</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="rad" placeholder="">
      </div>
    </div>

    <div class="form-group">  
        <label class="control-label col-sm-2" for="pwd">Factores Contribuyentes</label>
      <div>
        <div>
            <label>
               
                <select id="a">
                    <option value="No">No</option>
                    <option value="Si">Si</option>
                </select>
                Procesos o Tareas</label>
        </div>
          <div>
          <label>
             <select id="b">
                    <option value="No">No</option>
                    <option value="Si">Si</option>
                </select> Pacientes
          </label>
        </div>
          <div>
          <label><select id="c">
                    <option value="No">No</option>
                    <option value="Si">Si</option>
                </select> Cuidador</label>
        </div>
          <div>
          <label><select id="d">
                    <option value="No">No</option>
                    <option value="Si">Si</option>
                </select> Comunicación</label>
        </div>
          <div>
          <label><select id="e">
                    <option value="No">No</option>
                    <option value="Si">Si</option>
                </select> Formación y entrenamiento</label>
        </div>
          <div>
          <label><select id="fe">
                    <option value="No">No</option>
                    <option value="Si">Si</option>
                </select> Organización y estrategia</label>
        </div>
          <div>
          <label><select id="g">
                    <option value="No">No</option>
                    <option value="Si">Si</option>
                </select> Condiciones de trabajo</label>
        </div>
          <div>
          <label><select id="h">
                    <option value="No">No</option>
                    <option value="Si">Si</option>
                </select> Colaborador</label>
        </div>
      </div>
    </div>
              <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Analisis:</label>
      <div class="col-sm-10">          
          <textarea class="form-control" id="analisis"></textarea>
      </div>
    </div>
            <div class="form-group">
      <label class="control-label col-sm-2" for="email">Impacto</label>
      <div class="col-sm-10">
          <select class="form-control" id="impacto">
              <option value="">Seleccione</option>
               <option value="ALTO">ALTO</option>
                <option value="MEDIO">MEDIO</option>
                 <option value="BAJO">BAJO</option>
          </select>
      </div>
    </div>
          <div class="form-group">
      <label class="control-label col-sm-2" for="email">Probabilidad</label>
      <div class="col-sm-10">
          <select class="form-control" id="probabilidad">
              <option value="">Seleccione</option>
               <option value="ALTO">ALTO</option>
                <option value="MEDIO">MEDIO</option>
                 <option value="BAJO">BAJO</option>
          </select>
      </div>
    </div>
         <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Acciones de mejora:</label>
      <div class="col-sm-10">          
          <textarea class="form-control" id="acciones"></textarea>
      </div>
    </div> 
          
          
          <div class="form-group">
      <label class="control-label col-sm-2" for="email">Estado</label>
      <div class="col-sm-10">
          <select class="form-control" id="estado">
              <option value="">Seleccione</option>
               <option value="En proceso">En proceso</option>
                <option value="Completado">Completado</option>
          </select>
      </div>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
        <button type="button" class="btn btn-primary" onclick="guardar()">Guardar</button>
      </div>
    </div>

  </div>
</div>
<?php
 if(isset($_GET['del'])){
     if($eliminar_cas!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=casos"</script>'; 
}else{
$sql = "DELETE FROM eventos WHERE id_evento=".$_GET['del']." ";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=casos'";
echo "</script>";
}
 }
?>