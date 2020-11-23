<?php
session_start();
include "../modelo/conexion.php";
include_once 'Connection.php';
 require '../modelo/consulta_contacto.php';
 require '../modelo/consulta_empresa.php';
 require '../modelo/consultar_permisos.php';
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!DOCTYPE html>
<html>
    <head>
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
                <header  onload="recargar()"><h3>Historial de : <?php if(isset($_GET['codigo_contacto'])){echo $_SESSION['nombre'];} if(isset($_GET['codigo_empresa'])){ echo $_SESSION['nombre_emp'];} ?></h3></header>
                        <hr>
                        
                      
                      
                       <?php 

if(isset($_GET['codigo_contacto'])) {                    
$request=Connection::runQuery('select * from actividad where tarea="Actividad" and id_contacto='.$_GET['codigo_contacto']);
$request2=Connection::runQuery('select * from actividad where tarea="Reunion" and id_contacto='.$_GET['codigo_contacto']);
$request3=Connection::runQuery('select * from actividad where tarea="Llamada" and id_contacto='.$_GET['codigo_contacto']);
$request4=Connection::runQuery('select * from sis_notas where id_contacto='.$_GET['codigo_contacto']);
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Asunto'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
             
              $table = $table.'<th>'.'Fecha Modificacion'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              
              
               
              
           $table = $table.'</tr>';

$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                if($row['estado']=="Completada" || $row['estado']=="Aplazada"){
		$table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['Description'].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td></tr>';}
               
	}
        while($row=mysql_fetch_array($request2))
	{       
                if($row['estado']=="Realizada" || $row['estado']=="No Realizada"){
		$table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['Description'].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td></tr>';}
               
	}
        while($row=mysql_fetch_array($request3))
	{       
                if($row['estado']=="Realizada" || $row['estado']=="No Realizada"){
		$table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['Description'].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td></tr>';}
               
	}
         while($row=mysql_fetch_array($request4))
	{       
                if($row['estado_n']=="Nota"){
		$table = $table.'<tr><td>'.$row["asunto_n"].'</td><td>'.$row['nota_n'].'</td><td>'.$row['estado_n'].
                        '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td></tr>';}
               
	}
	$table = $table.'</table>';
        
	echo $table;
        
}
}if(isset($_GET['codigo_empresa'])) {                    
$request=Connection::runQuery('select * from actividad where tarea="Actividad" and id_empresa='.$_GET['codigo_empresa']);
$request2=Connection::runQuery('select * from actividad where tarea="Reunion" and id_empresa='.$_GET['codigo_empresa']);
$request3=Connection::runQuery('select * from actividad where tarea="Llamada" and id_empresa='.$_GET['codigo_empresa']);
$request4=Connection::runQuery('select * from sis_notas where id_empresa='.$_GET['codigo_empresa']);
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Asunto'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
             
              $table = $table.'<th>'.'Fecha Modificacion'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              
              
               
              
           $table = $table.'</tr>';

$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                if($row['estado']=="Completada" || $row['estado']=="Aplazada"){
		$table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['Description'].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td></tr>';}
               
	}
        while($row=mysql_fetch_array($request2))
	{       
                if($row['estado']=="Realizada" || $row['estado']=="No Realizada"){
		$table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['Description'].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td></tr>';}
               
	}
        while($row=mysql_fetch_array($request3))
	{       
                if($row['estado']=="Realizada" || $row['estado']=="No Realizada"){
		$table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['Description'].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td></tr>';}
               
	}
         while($row=mysql_fetch_array($request4))
	{       
                if($row['estado_n']=="Nota"){
		$table = $table.'<tr><td>'.$row["asunto_n"].'</td><td>'.$row['nota_n'].'</td><td>'.$row['estado_n'].
                        '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td></tr>';}
               
	}
	$table = $table.'</table>';
        
	echo $table;
        
}
}

                       ?>
		</article><a href="javascript:window.opener.document.location.reload();self.close()"> <input type="button" name="cerrar" value="Cerrar"></a>
		    </fieldset>
    </body>
</html>
