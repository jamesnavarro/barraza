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
        <title>Inventario de Medicamentos</title>
    </head>
    <body onLoad="cerrar()">
        <fieldset style="width:100%; float:center; margin-right: 3%;">
            <article class="module width_full">
                <header  onload="recargar()"><h3>Archivo # : <?php if(isset($_GET['orden'])){echo $_GET['orden'];} ?></h3></header>
                        <hr>
                        
                      
                      
                       <?php 

if(isset($_GET['orden'])) {  
    if($_SESSION["admin"] == 'Si'){
$request=Connection::runQuery('select d.*, a.numero_orden, a.rel_atencion, a.cantidad, b.nombre_medicamento, c.cantidad_med, c.id_visita, d.Subject from medicamentos_asig a, medicamentos b, cant_medicina c, actividad d where c.id_medicina=a.id and a.cod_med=b.codigo_int and c.id_visita=d.Id and a.rel_atencion='.$_GET['orden'].' order by Id');
    }
    else{
       $request=Connection::runQuery('select d.*, a.numero_orden, a.rel_atencion, a.cantidad, b.nombre_medicamento, c.cantidad_med, c.id_visita, d.Subject from medicamentos_asig a, medicamentos b, cant_medicina c, actividad d where a.asignado_a="'.$_SESSION['k_username'].'" and  c.id_medicina=a.id and a.cod_med=b.codigo_int and c.id_visita=d.Id and a.rel_atencion='.$_GET['orden'].' order by Id');
  
    }
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
           $table = $table.'<th>'.'Orden Interna'.'</th>';
           $table = $table.'<th>'.'Visita #'.'</th>';
            $table = $table.'<th>'.'Atencion'.'</th>';
              $table = $table.'<th>'.'Medicina'.'</th>';
              
              $table = $table.'<th>'.'Cantidad Usada'.'</th>';
               $table = $table.'<th>'.'Fecha Usada'.'</th>';
           $table = $table.'</tr>';

$table = $table.'</thead>';

	while($row=mysql_fetch_array($request))
	{       
               
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["cant_ins"].'</td><td>'.$row['Description'].'</td><td>'.$row['nombre_medicamento'].'</td><td>'.$row['cantidad_med'].'</td><td>'.$row['fecha_mod_ta'].'</td>';
               
	}
       
	$table = $table.'</table>';
        
	echo $table;
        
}}


                       ?>
		</article><a href="javascript:window.opener.document.location.reload();self.close()"> <input type="button" name="cerrar" value="Cerrar"></a>
		    </fieldset>
    </body>
</html>
