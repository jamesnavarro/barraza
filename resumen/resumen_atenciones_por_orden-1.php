<?php
session_start();
include "../modelo/conexion.php";
include_once 'Connection.php';
 require '../modelo/consulta_contacto_potencial.php';
 require '../modelo/consulta_empresa.php';
 require '../modelo/consultar_permisos.php';
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
         <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="../resources/style.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
        <script src="../js/mostrarmenu_1.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
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
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
        <title>Resumen</title>
    </head>
    <body onLoad="cerrar()">
        
        <fieldset style="width:100%; float:center; margin-right: 3%;">
            <article class="module width_full">
                <header  onload="recargar()"><h3>Paciente : <?php if(isset($_GET['pac'])){echo $_GET['pac'];} ?> <a target="_blank" href="../resumen_atenciones.php?imprimir=<?php echo $_GET['orden'] ?>"> <img src="../imagenes/imp.png" alt="ver" height="30px" width="30px"> </a></h3></header>
                        <hr>
                        
                      
                      
                       <?php 

if(isset($_GET['orden'])) {  
  
$request=Connection::runQuery('select * from actividad where estado="Completada" and orden_servicio='.$_GET['orden']);
   
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Orden Int'.'</th>';
              $table = $table.'<th>'.'Orden Ext'.'</th>';
              $table = $table.'<th>'.'Usuario'.'</th>';
              $table = $table.'<th>'.'Visita'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Fecha de Visita'.'</th>';
              $table = $table.'<th>'.'PA'.'</th>';
              $table = $table.'<th>'.'PULSO'.'</th>';
              $table = $table.'<th>'.'FR'.'</th>';
              $table = $table.'<th>'.'Valoracion'.'</th>';
              $table = $table.'<th>'.'Tratamiento'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Curaciones'.'</th>';
              $table = $table.'</tr>';
$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                if($row['estado']=="Completada" || $row['estado']=="Aplazada"){
                   if($row['est_motivo']=='activa'){$b='<a href="../form_editar/formulario_editar_proyecto.php?codigo='.$row["Id"].'&pac='.$_GET['pac'].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='No activado';} 
                   $c='<a href="../vistas/curacion_heridas.php?codigo='.$row["Id"].'&orden='.$row["orden_servicio"].'&ver=ok"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a>';
		$table = $table.'<tr><td>'.$row["orden_servicio"].'</td><td>'.$row["orden_externa"].'</td><td>'.$row["user"].'</td><td>'.$row["cant_ins"].'</td><td>'.$row['Description'].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['PA'].'</td><td>'.$row['PULSO'].'</td><td>'.$row['FR'].'</td><td>'.$row['Valoracion'].'</td><td>'.$row['inf_adicional'].'</td><td>'.$b.'</td><td>'.$c.'</td>';
                
                }
               
	}
       
	$table = $table.'</table>';
        
	echo $table;
        
}}


                       ?>
		</article>
		    </fieldset>
    </body>
</html>