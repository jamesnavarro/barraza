<?php
session_start();
include "../modelo/conexion.php";
 require '../modelo/consultar_paciente.php';
 require '../modelo/consultar_permisos.php';
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" http-equiv="REFRESH"/>
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
                <header  onload="recargar()"><h3>Paciente : <?php if(isset($_GET['pac'])){echo $_GET['pac'];} ?></h3></header>
                        <hr>
                        
                      
                      
                       <?php 

if(isset($_GET['orden'])) {  
    if($_SESSION["admin"] == 'Si'){
$request=mysql_query('select * from actividad where estado="Completada" and archivo='.$_GET['orden'].' group by orden_servicio');
    }else{
     $request=mysql_query('select * from actividad where user="'.$_SESSION['k_username'].'" and estado="Completada" and archivo='.$_GET['orden'].' group by orden_servicio');   
}}
if(isset($_GET['orden_externa'])) {  
    if($_SESSION["admin"] == 'Si'){
$request=mysql_query('select * from actividad where estado="Completada" and orden_externa="'.$_GET['orden_externa'].'" group by orden_servicio');
    }else{
     $request=mysql_query('select * from actividad where user="'.$_SESSION['k_username'].'" and estado="Completada" and orden_externa='.$_GET['orden_externa'].' group by orden_servicio');   
}}
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
              $table = $table.'<th>'.'Detalle de Atenciones'.'</th>';
              $table = $table.'<th>'.'Detalle de Curaciones'.'</th>';
              $table = $table.'<th>'.'Detalle de Insumos'.'</th>';
              $table = $table.'<th>'.'Detalle de Medicamentos'.'</th>';
              $table = $table.'</tr>';

$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                if($row['estado']=="Completada" || $row['estado']=="Aplazada"){
                   if($row['est_motivo']=='activa'){$b='<a href="../vistas/resumen_atenciones_por_orden.php?orden='.$row["orden_servicio"].'&pac='.$_GET['pac'].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a>';}else{$b='No activado';}
                   $c='<a href="../vistas/curacion_heridas_1.php?orden='.$row["orden_servicio"].'&pac='.$_GET['pac'].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a>';
                   $d='<a href="../vistas/resumen_detalles.php?orden='.$row["orden_servicio"].'&pac='.$_GET['pac'].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a>';
                   $e='<a href="../vistas/resumen_detalles_1.php?orden='.$row["orden_servicio"].'&pac='.$_GET['pac'].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a>';
		$table = $table.'<tr><td>'.$row["orden_servicio"].'</td><td>'.$row["orden_externa"].'</td><td>'.$row["user"].'</td><td>'.$row["cant_ins"].'</td><td>'.$row['Description'].'</td><td>'.$b.'</td><td>'.$c.'</td><td>'.$d.'</td><td>'.$e.'</td>';
                
                }
               
	}
       
	$table = $table.'</table>';
        
	echo $table;
        
}


                       ?>
		</article>
		    </fieldset>
    </body>
</html>
