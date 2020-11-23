<?php 
session_start();
include "../modelo/conexion.php";
include_once 'Connection.php';
require '../modelo/consultar_alquiler.php';
require '../modelo/consultar_permisos.php';
$request=Connection::runQuery('select count(*) from equipos_asig where estado="alquilado"');
//require '../modelo/consultar_campana.php';
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
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
}$_SESSION['t'] = $_POST;
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>sistema Integral</title>

	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="../resources/style.css" />
    <script type="text/javascript" src="../js/tcal.js"></script>
    
    
	
	
	
        <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
	<script type="text/javascript" src="../js/tcal.js"></script>
	
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        
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
</script>

<style type="text/css">
            .show { display: block;  }
            .hide { display: none; }
     </style>
<script type="text/javascript">
           
            function mostrarbusqueda() {
                var select = document.getElementById('d');
                select.className = 'show';
                var select = document.getElementById('dA');
                select.className = 'show';
                 var select = document.getElementById('b');
                select.className = 'show';
                 var select = document.getElementById('c');
                select.className = 'show';
                var select = document.getElementById('f');
                select.className = 'show';
                var select = document.getElementById('g');
                select.className = 'show';
            }
            function ocultarbusqueda() {
                var select = document.getElementById('d');
                select.className = 'hide';
                var select = document.getElementById('dA');
                select.className = 'hide';
                var select = document.getElementById('b');
                select.className = 'hide';
                 var select = document.getElementById('c');
                select.className = 'hide';
                var select = document.getElementById('f');
                select.className = 'hide';
                var select = document.getElementById('g');
                select.className = 'hide';
            }
           
        </script>
<script type="text/javascript"> function recargar() { window.location.reload() } </script>
</head>


<?php $das = $_SESSION['t']; ?>
<body onload="<?php $das = $_SESSION['t'];if(!empty($das['options'])) echo $das['options']; ?>">
   <?php  include '../vistas/menu.php'; ?>
	
	<section id="main" class="column">

		<div class="clear"></div>
                
		<article class="module width_full">
			<header><h3>equipos alquilados</h3></header>
                        
                         <?php  if($modulo_rCAM=='Campañas' && $listar_rCAM=='Habilitado'){?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="../vistas/alquiler_proceso.php" method="post" enctype="multipart/form-data">
                                     <div>
                                  
                                                <fieldset>
                                        
                                        <table>
                                             <tr>
                                               
                                            
                                            <td nowrap><label>nombre : <input name="nombre" style="width:130px;height:20px;"></label></td>
                                                <td nowrap><label>apellido : <input name="apellido" style="width:130px;height:20px;"></label></td>
                                                </tr>
                                                 <tr>
                                                 <td  nowrap><label>regimen :<select name="regimen" style="width:220px;">
                                                                   <option value="">--Seleccione--</option>
                                                                   <option value="1">Contributivo</option>
                                                                   <option value="2">Subsidiado</option>
                                                                   <option value="4">Particular</option>
                                                                   <option value="3">Vinculado</option>
                                                                   <option value="5">Otro</option>
                                                                   <option value="7">Desplazado con afilacion al regimen contributivo</option>
                                                                   <option value="8">Desplazado con afilacion al regimen subsidiado</option>
                                                                   <option value="9">Desplazado no asegurado</option>
                                                                   <option value="No aplica">No aplica</option>
                                                                   
                                                                   
                                                               </select></label></td>
                                                           
                                                    <td nowrap><label># documento : <input name="documento" style="width:130px;height:20px;"></label></td>
                                            </tr>
                                            
                                            <tr>
                                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar"></td>
                                                <td></td>
                                              
                                               
                                            </tr>
                                        </table>
                                        
                                        
                                    </fieldset>      
                                    
                                                        
				    </div></form>
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../vistas/alquiler_proceso.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/alquiler_proceso.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/alquiler_proceso.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/alquiler_proceso.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["nombre"])){
$nom =$_POST["nombre"];
$ape =$_POST["apellido"];
$reg =$_POST["regimen"];
$doc =$_POST["documento"];

if($nom =='' && $ape =='' && $reg =='' && $doc ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';

$request=Connection::runQuery('SELECT a.*, b.*, c.* FROM equipos_asig a, alquiler b, pacientes c, ordenes d WHERE c.id_paciente=d.id_paciente and a.numero_orden_a=d.id and a.estado="alquilado" and a.cod_equipo=b.codigo order by a.id_equipo_a asc '.$limit);
}

if($nom !='' || $ape !=''|| $reg !=''|| $doc !=''){
    $request=Connection::runQuery("SELECT a.*, b.*, c.* FROM equipos_asig a, alquiler b, pacientes c, ordenes d WHERE c.nombres LIKE '%".$nom."%' and c.apellidos LIKE '%".$ape."%' and c.numero_doc LIKE '%".$doc."%' and regimen LIKE '%".$reg."%' and c.id_paciente=d.id_paciente and a.numero_orden_a=d.id and a.estado='alquilado' and a.cod_equipo=b.codigo order by a.id_equipo_a");
}}
else{

$request=Connection::runQuery('SELECT a.*, b.*, c.* FROM equipos_asig a, alquiler b, pacientes c, ordenes d WHERE c.id_paciente=d.id_paciente and a.numero_orden_a=d.id and a.estado="alquilado" and a.cod_equipo=b.codigo order by a.id_equipo_a asc '.$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              
              $table = $table.'<th>'.'Paciente.'.'</th>';
              $table = $table.'<th>'.'Regimen'.'</th>';
              $table = $table.'<th>'.'Descripcion de Equipo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
              
              $table = $table.'<th>'.'Rango de Fecha'.'</th>';
              $table = $table.'<th>'.'Meses'.'</th>';
               $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';  
               $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
               $table = $table.'</tr>';
$table = $table.'</thead>';
 $a=date("H:i").':00'; echo $a;
 while($row=mysql_fetch_array($request))
	{    
         $ver='<a href="../vistas/alquiler_de_productos.php?codigo='.$row["id_equipo_a"].'">';
         if($modulo_rCAM=='Campañas' && $editar_rCAM=='Habilitado'){$b='<a href="../form_editar/formulario_editar_alquiler.php?codigo='.$row["id_equipo_a"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rCAM=='Campañas' && $eliminar_rCAM=='Habilitado'){$c='<a href="../vistas/aquiler_proceso.php?eliminar='.$row["id_equipo_a"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
           if(date("Y-m-d") > $row['fecha_f']){$color='<font color="red">';}
           if(date("Y-m-d") == $row['fecha_f']){$color='<font color="green">';}
           if(date("Y-m-d") < $row['fecha_f']){$color='<font color="black">';}
           if(date("Y-m-d") == $row['fecha_f']){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='';}
            if($row["regimen"]==''){$r= "Sin Asignar";}
           if($row["regimen"]=='1'){$r= "Contributivo";}
            if($row["regimen"]=='2'){$r= "Subsidiado";}
            if($row["regimen"]=='3'){$r="Vinculado";}
            if($row["regimen"]=='4'){$r= "Particular";}
            if($row["regimen"]=='5'){$r= "Otro";}
            if($row["regimen"]=='7'){$r= "Desplazado con afilación al regimen Contributivo";}
            if($row["regimen"]=='8'){$r="Desplazado con afilación al regimen Subsidiado";}
            if($row["regimen"]=='9'){$r= "Desplazado no asegurado";}
            if($row["regimen"]=='No Aplica'){echo "$regimen";}
           
           $table = $table.'<tr><td>'.$ver.''.$led.''.$color.''.$row["nombres"].' '.$row["apellidos"].'<font></a></td><td>'.$r.'</font></td><td>'.$ver.''.$color.''.$row["nombre"].'<font></a></td>
               <td>'.$row["cantidad"].'</font></td><td>'.$row["fecha_a"].' al '.$row["fecha_f"].'</font></td>
                    <td>'.$row["meses"].'<font></a></td><td>'.$row["estado"].'<font></a></td><td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM equipos_asig WHERE id_equipo_a='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/alquiler_proceso.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
                    
		
		
		
		
		<div class="spacer"></div>
	</section>
             <?php include '../footer.php'; ?>

</body>

</html>
