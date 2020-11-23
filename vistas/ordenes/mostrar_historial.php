<?php 
require '../modelo/consultar_empresa.php';
 require '../modelo/insertar_historial.php';
 require '../modelo/consultar_permisos.php';
 require '../modelo/consultar_paciente.php';

?>
<!doctype html>
<html lang="en">

<head>

    <script type="text/javascript" src="../js/tcal.js"></script>
   <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
	<script type="text/javascript" src="../js/tcal.js"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
	
 

<script type="text/javascript"> function recargar() { window.location.reload() } </script>
</head>

    <?php
 if(isset($_GET["orde"])){
$consulta= "select * from pacientes WHERE  id_paciente=".($idpa)."";
$result= mysql_query($consulta);
while($fila= mysql_fetch_array($result)){

$a=$fila['nombres'];
$b=$fila['apellidos'];
$c=$fila['nombre2'];
$d=$fila['apellido2'];
}}
 
 ?>
	

		<div class="clear"></div>
               
		<article class="module width_full">
                <form class="span12 widget shadowed dark form-horizontal bordered">  
			<header><h4 class="title">Historial Clinico</h4></header>
                        
                        
				<div class="module_content"> 
                            <h4 class="inf">Paciente :<a href="../vistas/?id=ver_paciente&cod=<?php echo ($idpa); ?>"><?php 
                                        if(isset($_GET["orde"])){echo $a.' '.$b.' '.$d;}else{echo $nombre.' '.$nombre2.' '.$apellido.' '.$apellido2;}
                                        ?></a>, (Historia Clinica :<?php 
                                        echo $motivo;
                                        ?>)</h4><br>
                                        <hr><?php if($_SESSION["admin"] == 'Si'){ if(isset($_GET['orde'])){  ?>
                                          <a href="../vistas/?id=historial_clinico&orde=<?php echo ($_GET['orde']); ?>"> <input type="button" name="enviar" value="Editar" class="alt_btn"></a><?php }else{
                                              echo '<a href="../vistas/?id=historial_clinico&orde='.$ooo.'"> <input type="button" name="enviar" value="Editar" class="alt_btn"></a>';
                                        }} ?>
                                           <?php ;
                                           if(isset($oo)){echo '<a href="../vistas/?id=add_atenciones&cod='.$oo.'"> <input type="button" name="enviar" value="Ir a Orden" class="alt_btn"></a>';}
                                           ?>
                                        
                                        
                                        <hr><br>
                                        
                                       
                                     
                                        
						  
                                                    
                                                    
                                                                                <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <header><h4>Historial Familiar</h4></header>
                                            <ul class="arrow">
                                                <li><b>Cancer:</b> <?php  echo $cancer1 ?> </li>
                                                <li><b>Diabetes:</b> <?php  echo $diabetes1 ?> </li>
                                                <li><b>Ataques Del Corazòn:</b> <?php  echo $ataques1 ?> </li>
                                                <li><b>Hipertenciòn:</b> <?php  echo $hipertencion ?> </li>
                                                <li><b>Emfermedades Renales:</b> <?php  echo $emfermedades ?> </li>
                                                <li><b>Tuberculosis:</b> <?php  echo $tuberculosis1 ?> </li>
                                                <li><b>Otras:</b> <?php  echo $otras ?> ,<b>Especifique:</b><?php  echo $especifique1 ?></li>
                                                
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <header><h4>Antecedentes Personales</h4></header>
                                            <ul class="arrow">
                                                <li><b>Alcohol:</b> <?php  echo $alcohol ?> </li>
                                                <li><b>Diabetes:</b> <?php  echo $diabetes ?> </li>
                                                <li><b>Hipertencion:</b> <?php  echo $hiper ?> </li>
                                                <li><b>Drogas:</b> <?php  echo $drogas ?> </li>
                                                <li><b>Tuberculosis:</b> <?php  echo $cancer1 ?> </li>
                                                <li><b>Otras:</b> <?php  echo $otras1 ?>, <b>especifique:</b> <?php  echo $especifique  ?>  </li>
                                                <li><b>Ataques Del Corazòn:</b> <?php  echo $ataques ?> </li>
                                                <li><b>Medicamentos:</b> <?php  echo $medicamentos ?> </li>
                                                <li><b>Cancer:</b> <?php  echo $cancer ?> </li>
                                                <li><b>Alergias:</b> <?php  echo $alergias ?>, <b>Descripciones: </b><?php  echo $cuales1?>, <?php  echo $cuales2?>, <?php  echo $cuales3?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <header><h4>EXAMENES COMPLEMENTARIOS</h4></header>
                                            <ul class="arrow">
                                                 
                                                 <li><b>Laboratorios:</b> <?php  echo $laboratorios ?> </li>
                                                 <li><b>DESCRIPCION:</b> <?php  echo $cuales4?>, <?php  echo $cuales5?>, <?php  echo $cuales6?> </li>
                                                 <li><b>Otros:</b> <?php  echo $cuales7?>, <?php  echo $cuales8?>, <?php  echo $cuales9?> </li>
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/traz.png">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                 
                     <hr><br>
                                        
                  <br>
                </form> 
                    <header>
                        <?php if($_SESSION['area']=='OFICINA'){ ?>
                        <a target="_blank" href="../imprimir_historial.php?imprimir=<?php if(isset($_GET['cod'])){echo $_GET['cod'];}if(isset($_GET['orde'])){echo $idpa;} ?>"> <input type="button" class="btn-danger" name="bo" value="Imprimir Antecedentes"/> </a>
                        <a target="_blank" href="../resumen_atenciones_1.php?imprimir=<?php if(isset($_GET['cod'])){echo $_GET['cod'];}if(isset($_GET['orde'])){echo $idpa;} ?>"> <input type="button" name="bo" class="btn-inverse" value="Detalle de Atenciones"/> </a>       
                        <a target="_blank" href="../resumen_evolucion.php?imprimir=<?php if(isset($_GET['cod'])){echo $_GET['cod'];}if(isset($_GET['orde'])){echo $idpa;} ?>"> <input type="button" name="bo" class="btn-info" value="Detalle de Evolucion"/> </a> 
                        <a target="_blank" href="../resumen_de_atenciones.php?imprimir=<?php if(isset($_GET['cod'])){echo $_GET['cod'];}if(isset($_GET['orde'])){echo $idpa;} ?>"> <input type="button" name="bo" class="btn-danger" value="Resumen de Atenciones"/> </a>
                        <?php } ?>
                    </header>
                    <br></article>
               
               
                  
		 <article class="module width_full">
                      <form class="span12 widget shadowed dark form-horizontal bordered" name="buscarA" action="" method="post" enctype="multipart/form-data">  
                     <header><h4 class="title">Historial de atenciones prestadas</h4></header>
                       
                                     <div>
                                  
                                           
                                        
                                         Fecha Inicial:<input id="datepicker1" name="f1" class="" placeholder="2014-01-01" style="width:130px;height:20px; ">
                                                
                                                
                                               
                                            
                                            Fecha Final:<input id="datepicker2" name="f2"  class=""  placeholder="2014-01-31" style="width:130px;height:20px;">
                                                
                                              
                                            
                                            
                                                <input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar">
                                        
                                        
                                       
                                    
                                                        
				    </div></form>
                        <hr>
                       </article> <article class="module width_full">
                        
<?php 
if(isset($_GET['cod'])){
    if(isset($_POST['f1'])){
$request=mysql_query("SELECT * FROM actividad where id_paciente='".$_GET['cod']."' and StartTime>='".$_POST['f1']."' and EndTime<='".$_POST['f2']."' and tarea='Visita' group by orden_servicio");
}else{
    $request=mysql_query("SELECT * FROM actividad where id_paciente='".$_GET['cod']."' and tarea='Visita' group by orden_servicio");
}


if($request){
//    echo'<hr>';
     ?>
        <form class="span12 widget shadowed dark form-horizontal bordered"  name="buscarA" action="../vistas/?id=mostrar_historial&cod=<?php echo $_GET['cod']  ?>&codi=all" method="post" enctype="multipart/form-data">
            
        <?php
}
    $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Orden Externa'.'</th>';
              $table = $table.'<th>'.'Orden Interna'.'</th>';
              
              $table = $table.'<th>'.'Descripcion de atencion'.'</th>';
              $table = $table.'<th>'.'Usuario'.'</th>';
              $table = $table.'<th>'.'Fecha Inicio'.'</th>';
              $table = $table.'<th>'.'Fecha Final'.'</th>';
              $table = $table.'<th>'.'Anamnesis'.'</th>';
              $table = $table.'<th>'.'Evolucion'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $cont=0;
	while($row=mysql_fetch_array($request))
	{       $cont= $cont + 1;
            $ver2='<a href="../vistas/resumen_atenciones_por_orden.php?orden='.$row["orden_servicio"].'&pac='.$nombre.' '.$apellido.'" target="_blank">';
            $look ='<td><a href="../vistas/mostrar_historial_1.php?cod='.$row["orden_servicio"].'&ver" target="_blank"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>';  
            $look2 ='<td><a href="../resumen/evolucion.php?cod='.$row["orden_servicio"].'&ver&n" target="_blank"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>'; 
            $table = $table.'<tr><td>'.$row["orden_externa"].'<font></a></td><td>'.$row["orden_servicio"].'<font></a></td><td>'.$ver2.$row["Description"].'<font></a></td>
                <td>'.$row["user"].'<font></a></td><td>'.$row["StartTime"].'<font></a></td><td>'.$row["EndTime"].'<font></a></td>'.$look.''.$look2.'
                    </tr>';   
               
           
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
   if(isset($idus)){
            echo '<label> Total de Facturas : </label><input type="text" name="cant"  style="width:20px;height:20px;"  value="'.$idus.'">';
        }else{
            echo '<label> Total de atenciones: </label><input type="text" name="cant"  style="width:20px;height:20px;"  value="'.$cont.'">';
        }
        
        echo '<input type="submit" name="buscar" value="Imprmir" class="alt_btn">';
        ?>
            </form>

<?php
}
if(isset($_GET['codi']))
    {
    if(isset($_POST["cant"]))
    {
   $n = $_POST["cant"];
   for($x=1; $x<=$n; $x=$x+1){ 
       if(isset($_POST["valor$x"])){
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.open('../resumen_atenciones.php?imprimir=".$_POST["valor$x"]."')";
        echo "</script>";        
   }}
}}

?>


                      
		</article> 
		


