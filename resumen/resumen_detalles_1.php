<?php
session_start();
include "../modelo/conexion.php";
 require '../modelo/consultar_paciente.php';
 require '../modelo/consultar_empresa.php';
 require '../modelo/consultar_permisos.php';
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!DOCTYPE html>
<html>
    <head>
      
	<link rel="stylesheet" href="../css/css_tablas.css" type="text/css" media="screen" />
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
        <title>Inventario de Insumos</title>
    </head>
    <body>
        <fieldset>
            <article class="module width_full">
                <header  onload="recargar()"><h3>Archivo # : <?php if(isset($_GET['orden'])){echo $_GET['orden'];} ?></h3></header>
                        <hr>
                        
                      
                      
                       <?php 

if(isset($_GET['orden'])) {     
    if($_SESSION["admin"] == 'Si'){
$request=mysql_query('select d.*, a.numero_orden, a.rel_atencion, a.cantidad, b.nombre_insumo, c.cantidad_ins, c.id_visita, d.Subject from insumos_asignados a, insumos b, cant_insumos c, actividad d where c.id_insumo=a.id_ia and a.cod_insumo=b.codigo and c.id_visita=d.Id and a.rel_atencion='.$_GET['orden'].' order by d.orden_servicio');
    }else{
      $request=mysql_query('select d.*, a.numero_orden, a.rel_atencion, a.cantidad, b.nombre_insumo, c.cantidad_ins, c.id_visita, d.Subject from insumos_asignados a, insumos b, cant_insumos c, actividad d where a.asignado_a="'.$_SESSION['k_username'].'" and c.id_insumo=a.id_ia and a.cod_insumo=b.codigo and c.id_visita=d.Id and a.rel_atencion='.$_GET['orden'].' order by d.orden_servicio');
   
    }
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';


           $table = $table.'<tr>';
           $table = $table.'<td>'.'Orden Interna'.'</td>';
            $table = $table.'<td>'.'Visita #'.'</td>';
            $table = $table.'<td>'.'Atencion'.'</td>';
              $table = $table.'<td>'.'Insumos'.'</td>';
              
              $table = $table.'<td>'.'Cantidad Usada'.'</td>';
              $table = $table.'<td>'.'Fecha asignada'.'</td>';
 $table = $table.'</tr>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
               
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row['cant_ins'].'</td><td>'.$row['Description'].'</td><td>'.$row['nombre_insumo'].'</td><td>'.$row['cantidad_ins'].'</td><td>'.$row['fecha_mod_ta'].'</td>';
               
	}
       
	$table = $table.'</table>';
        
	echo $table;
        
}}


                       ?>
		</article><a href="javascript:window.opener.document.location.reload();self.close()"> <input type="button" name="cerrar" value="Cerrar"></a>
		    </fieldset>
    </body>
</html>
