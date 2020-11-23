<?php 
if(isset($_SESSION['k_username'])){
include "../modelo/conexion.php";
require '../modelo/consulta_empresa.php';
 require '../modelo/insertar_historial.php';
 require '../modelo/consultar_permisos.php';
 require '../modelo/consulta_contacto_potencial.php';
include_once 'Connection.php';

?>
<!doctype html>
<html lang="en">

<head>
   <style>
body {
    background-color: #D3EDF0;
}

article {
    background-color: #F5F6F6;
}

p {
    background-color: rgb(255,0,255);
}
</style>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
<script> 
var ventana_secundaria 

function abrirVentana(){  
ventana_secundaria = window.open("../vistas/form_actividades_empresa.php","miventana","width=500,height=480,menubar=no") 
} 

function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/form_contacto_potencial.php","miventana","width=850,height=400,menubar=no") 
} 
function abrirVentana2(){  
ventana_secundaria = window.open("../vistas/form_oportunidades.php","miventana","width=500,height=520,menubar=no") 
}
function abrirVentana3(){  
ventana_secundaria = window.open("../vistas/form_caso.php","miventana","width=500,height=540,menubar=no") 
}
function abrirVentana4(){  
ventana_secundaria = window.open("../vistas/form_incidencia.php?codigo_co=<?php echo $idc ?>","miventana","width=500,height=620,menubar=no") 
}
function abrirVentana5(){  
ventana_secundaria = window.open("../vistas/form_contacto.php?codigo=<?php echo $idc ?>","miventana","width=500,height=420,menubar=no") 
}
function abrirVentana6(){  
ventana_secundaria = window.open("../vistas/form_proyecto.php?codigo=<?php echo $idc ?>","miventana","width=500,height=420,menubar=no") 
}
function abrirVentana7(){  
ventana_secundaria = window.open("../vistas/resumen_historial.php?codigo_empresa=<?php echo $id_empresa ?>","miventana","width=500,height=420,menubar=no") 
}

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>
<script type="text/javascript"> function recargar() { window.location.reload() } </script>
 <script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1").change(function () {
   		$("#combo1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/combo1.php", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				$("#combo3").html("");
			});			
        });
   })
	// Parametros para el combo2
	$("#combo2").change(function () {
   		$("#combo2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("combo2.php", { elegido: elegido }, function(data){
				$("#combo3").html(data);
			});			
        });
   })
});
function doScroll(){
    if (window.name) window.scrollTo(0, window.name);
}
</script>
<script language='javascript'>
function contacto()
{
catPaises = window.open('../vistas/form_contacto.php', 'contacto', 'width=500,height=600');
}
function empresa()
{
catPaises = window.open('../vistas/form_empresa.php', 'contacto', 'width=500,height=600');
}
function seleccionar()
{
catPaises = window.open('../vistas/seleccionar.php', 'contacto', 'width=1000,height=600');
}
function usuario()
{
catPaises = window.open('../seleccion/usuario.php', 'contacto', 'width=1000,height=600');
}
function enfermedad()
{
catPaises = window.open('../vistas/agregar_enfermedad.php', 'contacto', 'width=500,height=600');
}
</script>
<script language="javascript" type="text/javascript">
function datos(val1, val2){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
}
function user(val6){
    document.getElementById('valor6').value = val6;
    
}
function dato(val7, val8){
    document.getElementById('valor7').value = val7;
    document.getElementById('valor8').value = val8;
}
function datos2(val3, val4, val5){
    
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
    document.getElementById('valor5').value = val5;
}
</script>
</head>


<body onload="doScroll()" onunload="window.name=document.body.scrollTop">
 <?php  include '../vistas/menu.php'; 
 if(isset($_GET["orde"])){
$consulta= "select * from pacientes WHERE  id_paciente=".($idpa)."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){



$a=$fila['nombres'];
$b=$fila['apellidos'];
$c=$fila['nombre2'];
$d=$fila['apellido2'];
}}
 
 ?>
	<section id="main" class="column">
		
		
		
		
		
		
		
		
		<div class="clear"></div>
                
		<article class="module width_full">
			<header><h3>Historial Clinico</h3></header>
                        
                        
				<div class="module_content"> 
                            <h4 class="inf">Paciente :<a href="../vistas/?id=ver_paciente&cod=<?php echo ($idpa); ?>"><?php 
                                        if(isset($_GET["orde"])){echo $a.' '.$c;}else{echo $nombre.' '.$apellido;}
                                        ?></a>, (Historia Clinica :<?php 
                                        echo $motivo;
                                        ?>)</h4><br>
                                        <hr><?php if($_SESSION["admin"] == 'Si'){ if(isset($_GET['orde'])){  ?>
                                          <a href="../vistas/?id=historial_clinico&orde=<?php echo ($_GET['orde']); ?>"> <input type="button" name="enviar" value="Editar" class="alt_btn"></a><?php }else{
                                              echo '<a href="../vistas/?id=historial_clinico&orde='.$ooo.'"> <input type="button" name="enviar" value="Editar" class="alt_btn"></a>';
                                        }} ?>
                                           <?php ;
                                           if(isset($oo)){echo '<a href="../vistas/?id=detalle_ordenes&cod='.$oo.'"> <input type="button" name="enviar" value="Ir a Orden" class="alt_btn"></a>';}
                                           ?>
                                        
                                        
                                        <hr><br>
                                        
                                       <fieldset style="width:100%; float:center; margin-right: 3%;">
                                     
                                        
						  
                                                    <header><h3>Historial Familiar</h3></header>
                                                       <table>
                
                                                                 <tr>
                                                                    <td><label>Cancer:</label><?php  echo $cancer1 ?> </td>
                                                                    
                                                                    <td><label>Diabetes:</label><?php  echo $diabetes1  ?></td>
                                                                </tr>
                                                            
                                                                 <tr>
                                                                   <td><label>Ataques Del Corazòn:</label><?php  echo $ataques1 ?></td>
                                                                     <td><label>Hipertenciòn:</label><?php  echo $hipertencion  ?> </td>
                                                                  </tr>
                                                                  
                                                                   <tr>
                                                                   <td><label>Emfermedades Renales:</label><?php  echo $emfermedades  ?></td>
                                                                   <td><label>Tuberculosis:</label><?php  echo $tuberculosis1  ?> </td>
                                                                   </tr>
                                                                   
                                                                   <tr>
                                                                  <td><label>Otras:</label><?php  echo $otras  ?></td>
                                                                      <td><label>Especifique:</label><?php  echo $especifique1 ?> </td>
                                                                    </tr>
                
                                                               
               
            </table>  
                                                        
						</fieldset>
                                       </fieldset>
                                        
                                        
                                        <fieldset style="width:100%; float:center; margin-right: 3%;">
                                     <fieldset style="width:100%; float:center; margin-right: 3%;"> 
                                                    <header><h3>Antecedentes Personales</h3></header>
                                                    
                                                       <table>
                
                                                                 <tr>
                                                                    <td><label>Alcohol:</label><?php  echo $alcohol  ?> </td>
                                                                    <td><label>Diabetes:</label><?php  echo $diabetes  ?> </td>
                                                                    <td></td>
                                                                </tr>
                                                            
                                                                 <tr>
                                                                   <td><label>Tabaco:</label><?php  echo $tabaco ?></td>
                                                                     <td><label>Hipertencion:</label><?php  echo $hiper  ?> </td>
                                                                     <td></td>
                                                                  </tr>
                                                                  
                                                                   <tr>
                                                                   <td><label>Drogas:</label><?php  echo $drogas  ?></td>
                                                                   <td><label>Tuberculosis:</label><?php  echo $tuberculosis?> </td>
                                                                   <td></td>
                                                                   </tr>
                                                                   
                                                                   <tr>
                                                                       <td><label>Otras:</label><?php  echo $otras1 ?></td>
                                                                  
                                                                      <td><label>especifique:</label><?php  echo $especifique  ?> </td>
                                                                      <td></td>
                                                                    </tr>
                                                                    
                                                                     <tr>
                                                                  <td><label>Ataques Del Corazòn:</label><?php  echo $ataques  ?></td>
                                                                      <td><label>Medicamentos:</label> <?php  echo $medicamentos  ?></td>
                                                                      <td></td>
                                                                    </tr>
                                                                    
                                                                     <tr>
                                                                  <td><label>Emfermedades:</label><?php  echo $emfermedades1 ?></td>
                                                                  <td><label>Cancer:</label><?php  echo $cancer  ?></td>
                                                                  <td></td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td><label>Alergias:</label><?php  echo $alergias  ?> </td>
                                                                  
                                                                  <td><label>DESCRIPCION:</label><?php  echo $cuales1?>, <?php  echo $cuales2?>, <?php  echo $cuales3?> </td>
                                                                  <td></td>
                                                                    </tr>
                
                                                               
               
            </table>  
                                                        
						</fieldset>
                                           
                                           
                                                        
						</fieldset>
                                       
                                       
                                       
                                       
                                             
                                                        
						 
                                           
                                      <fieldset style="width:100%; float:center; margin-right: 3%;">
                                     <fieldset style="width:100%; float:center; margin-right: 3%;"> 
                                                    <header><h3>EXAMENES COMPLEMENTARIOS</h3></header>
                                                    
                                                       <table>
                
                                                                 <tr>
                                                                    <td><label>Laboratorios:</label><?php  echo $laboratorios?> </td>
                                                                
                                                                    <td></td>
                                                                </tr>
                                                                 <tr>
                                                                    <td><label>DESCRIPCION:</label> <?php  echo $cuales4?>, <?php  echo $cuales5?>, <?php  echo $cuales6?></td>
                                                                
                                                                    <td></td>
                                                                </tr>
                                                                 <tr>
                                                                    <td><label>Otros:</label><?php  echo $otros?> </td>
                                                                
                                                                    <td></td>
                                                                </tr>
                                                            
                                                            
                                                            
                                                                 <tr>
                                                                   <td><label>DESCRIPCION:</label><?php  echo $cuales7?>, <?php  echo $cuales8?>, <?php  echo $cuales9?></td>
                                                                     
                                                                     <td></td>
                                                                  </tr>
                                                                                                                                                                         
               
            </table>  
                                                        
						</fieldset>
                                                   
                                                    
                                                        
						</fieldset>
                     <hr><br>
                                        
                  <br>
                  <header><a target="_blank" href="../imprimir_historial.php?imprimir=<?php if(isset($_GET['codigo'])){echo $_GET['codigo'];}if(isset($_GET['orde'])){echo $idpa;} ?>"> <input type="button" name="bo" value="Imprimir Antecedentes"/> </a>
              <a target="_blank" href="../resumen_atenciones_1.php?imprimir=<?php if(isset($_GET['codigo'])){echo $_GET['codigo'];}if(isset($_GET['orde'])){echo $idpa;} ?>"> <input type="button" name="bo" value="Imprimir Atenciones"/> </a> </header>      
		 <a target="_blank" href="../resumen_evolucion.php?imprimir=<?php if(isset($_GET['codigo'])){echo $_GET['codigo'];}if(isset($_GET['orde'])){echo $idpa;} ?>"> <input type="button" name="bo" value="Imprimir Evolucion"/> </a> </header> </article>
               
               
                   
		 <article class="module width_full">
			<header><h3>Historial de atenciones prestadas</h3></header>
                        <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                  
                                                <fieldset>
                                        
                                       Fecha Inicial:<input name="f1" class="tcal" style="width:130px;height:20px;">
                                                
                                                
                                               
                                            
                                            Fecha Final:<input name="f2"  class="tcal" style="width:130px;height:20px;">
                                                
                                              
                                            
                                            
                                                <input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar">
                                        
                                        
                                    </fieldset>      
                                    
                                                        
				    </div></form>
                        <hr>
                        
<?php 
if(isset($_GET['codigo'])){
$request=mysql_query("SELECT * FROM actividad where id_paciente='".$_GET['codigo']."' and tarea='Visita' group by orden_servicio");
}
if(isset($_POST['f1'])){
$request=mysql_query("SELECT * FROM actividad where id_paciente='".$_GET['codigo']."' and StartTime>='".$_POST['f1']."' and EndTime<='".$_POST['f2']."' and tarea='Visita' group by orden_servicio");
}
if($request){
//    echo'<hr>';
     ?>
        <form name="buscarA" action="../vistas/mostrar_historial.php?cod=<?php echo $_GET['codi']  ?>&cod1=all" method="post" enctype="multipart/form-data">
            
        <?php
}
    $table = '<table class="lista1">';

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
               $table = $table.'<th>'.'Imprimir'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $cont=0;
	while($row=mysql_fetch_array($request))
	{       $cont= $cont + 1;
            $ver2='<a href="../vistas/resumen_atenciones_por_orden.php?orden='.$row["orden_servicio"].'&pac='.$nombre.' '.$apellido.'" target="_blank">';
            $look ='<td><a href="../controlador/historial_consulta.php?codigo='.$row["orden_servicio"].'" target="_blank"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>';  
            $look2 ='<td><a href="../vistas/evolucion.php?cod='.$row["orden_servicio"].'" target="_blank"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>'; 
            $table = $table.'<tr><td>'.$row["orden_externa"].'<font></a></td><td>'.$row["orden_servicio"].'<font></a></td><td>'.$ver2.$row["Description"].'<font></a></td>
                <td>'.$row["user"].'<font></a></td><td>'.$row["StartTime"].'<font></a></td><td>'.$row["EndTime"].'<font></a></td>'.$look.''.$look2.'
                    <td><input type="checkbox" name="valor'.$cont.'" value="'.$row["orden_servicio"].'"></td></tr>';   
               
           
               
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

if(isset($_GET['cod']))
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
		
		
		
		<div class="spacer"></div>
                
         
              
	</section>

               <?php include '../footer.php'; ?>

</body>

</html>
<?php   }else {header("location:../index.php");}  ?>