<?php 
session_start();
include "../modelo/conexion.php";
require '../modelo/consultar_roles.php';
require '../modelo/consultar_permisos.php';
include_once 'Connection.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$request=Connection::runQuery('select count(*) from sis_notas');
 
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

?>
<!doctype html>
<html lang="en">

<head>

<!--        <SCRIPT LANGUAGE="JavaScript"> 
 Begin 
function popUp(URL) 
{ 
day = new Date(); 
id = day.getTime(); 
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1, scrollbars=1, location=1, statusbar=1, menubar=1, resizable=1, width=500, height=410, left = 312, top = 234 ');"); 
} 
function cerrarVentana(){ 
//la referencia de la ventana es el objeto window del popup. Lo utilizo para acceder al método close 
eval.close() 
}
// End </script> -->
<script> 
var ventana_secundaria 

function abrirVentana(){  
ventana_secundaria = window.open("../vistas/form_actividades.php","miventana","width=500,height=410,menubar=no") 
} 
function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/form_clientes_potenciales.php","miventana","width=800,height=410,menubar=no") 
}

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>
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
<script type="text/javascript"> function recargar() { window.location.reload() } </script>

</head>


<body>
  <?php  include '../vistas/menu.php'; ?>
	<section id="main" class="column">
		<div class="clear"></div>
                
		<article class="module width_full">
			<header><h3>Roles</h3></header>
                        
                        
				<div class="module_content">
                                        <h4 class="inf">Roles :<?php 
                                        echo "$nombre_ro";
                                        ?> </h4><br>
                                        

                                        <hr>
                                            <a href="../form_editar/formulario_editar_roles.php?codigo=<?php echo ($id_ro); ?>"> <input type="button" name="enviar" value="Editar" class="alt_btn"></a>
                                            <a href="../vistas/roles.php?eliminar=<?php echo ($id_ro); ?>"> <input type="button" name="enviar" value="Eliminar" class="alt_btn"></a>
                                        
                                        <hr><br>
                                    <fieldset style="width:80%; float:center;"> 
                                     
                                         
                                                   <table>
							<tr>
                                                           <th style="width: 80px"><label>nombre :</label></th>
                                                           <td><?php 
                                                           echo "$nombre_ro"; 
                                                           $_SESSION['id_r']=$id_ro;
                                                           ?></td>
                                                        </tr>
                                                          <tr>
                                                           <th style="width: 80px"><label>descripcion :</label></th>
                                                            <td><?php echo "$descripcion_ro";
                                                            ?></td>
                                                          </tr>
                                                         
                                                              
                 
                                                     </table>
                                        
						</fieldset>
                                        
						
                                      
                                    
                             
                                       <hr><br>
                        
                                      
                                    
				
                       
		</article>
                <article class="module width_full">
                    <br> <hr>
                                            <a href="../form_editar/editar_roles.php?codigo=<?php echo ($id_ro); ?>"> <input type="button" name="enviar" value="Editar" class="alt_btn"></a>
                                            <a href="../vistas/roles.php?eliminar=<?php echo ($id_ro); ?>"> <input type="button" name="enviar" value="Eliminar" class="alt_btn"></a>
                                        
                                        <hr><br>
<?php
include "../modelo/conexion.php";
$request=Connection::runQuery('select * from roles_accion where id_roles='.$id_ro.'');
if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'modulo'.'</th>';
              $table = $table.'<th>'.'Acceso'.'</th>';
              
              $table = $table.'<th>'.'Eliminar'.'</th>';
              
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Exportar'.'</th>';  
              $table = $table.'<th>'.'Importar'.'</th>';
              $table = $table.'<th>'.'Listar'.'</th>';
              $table = $table.'<th>'.'Ver'.'</th>';
              $table = $table.'<th>'.'Fecha Modificacion'.'</th>';
//              $table = $table.'<th>'.''.'</th>';
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
	$table = $table.'<tr><td>'.$row["modulo"].'</td><td>'.$row["acceso"].'</td><td>'.$row["eliminar"].'</td><td>'.$row['editar'].'</td><td>'.$row['exportar'].'</td><td>'.$row["importar"].'</td><td>'.$row["listar"].'</td><td>'.$row["ver"].'</td><td>'.$row["fecha_modificacion"].'</td></tr>';
               
	        
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
?> 
                    
                </article>
   
                <br>
            
		</div>
		
		
		<div class="spacer"></div>
	</section>
                <?php include '../footer.php'; ?>

</body>

</html>
