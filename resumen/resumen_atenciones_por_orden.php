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
        <title>INTERNACION DOMICILIARIA BARRAZA</title>
    </head>
    <body onLoad="cerrar()">
    <?php
    $sqla = "SELECT * FROM actividad where orden_servicio='".$_GET["orden"]."'  group by Description";
                $filaa =mysql_fetch_array(mysql_query($sqla));
                $Description = $filaa["Description"];
                $orden_servicio = $filaa["orden_servicio"];
                $orden_externa = $filaa["orden_externa"];
                $cant = $filaa["cant"];
    ?>
        
        <fieldset>
            <article class="module width_full">
                <header  onload="recargar()"><h3>PACIENTE : <?php if(isset($_GET['pac'])){echo $_GET['pac'];} ?> <br> Atencion:  <?php if(isset($_GET['pac'])){echo $Description;} ?>, Cant:<?php if(isset($_GET['pac'])){echo $cant;} ?>  </h3></header>
                        <header  onload="recargar()"><h3> Autorizacion: <?php if(isset($_GET['pac'])){echo $orden_externa;} ?>, Orden Interna:<?php if(isset($_GET['pac'])){echo $orden_servicio;} ?></h3></header><hr>
                        
                      
                      
                       <?php 

if(isset($_GET['orden'])) {  
  
$request=mysql_query('select * from actividad where estado="Completada" and orden_servicio='.$_GET['orden']);
   
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
             
              
              
              $table = $table.'<th>'.'Visita'.'</th>';
           
              $table = $table.'<th>'.'Fecha de Visita'.'</th>';
             
              $table = $table.'<th>'.'Tratamiento Y Valoracion'.'</th>';
              
             
              $table = $table.'</tr>';
$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $firma = '';
	while($row=mysql_fetch_array($request))
	{       
            $firma = $row["firmadigital"];
                if($row['estado']=="Completada" || $row['estado']=="Aplazada"){
                   if($row['est_motivo']=='activa'){$b='<a href="../form_editar/formulario_editar_proyecto.php?codigo='.$row["Id"].'&pac='.$_GET['pac'].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='No activado';} 
                   $c='<a href="../vistas/curacion_heridas.php?codigo='.$row["Id"].'&orden='.$row["orden_servicio"].'&ver=ok"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a>';
		$table = $table.'<tr><td>'.$row["cant_ins"].'</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['Valoracion'].'.<BR> VALORACION: '.$row['inf_adicional'].'</td>';
                
                }
               
	}
       
	$table = $table.'</table>';
        echo $table;
       
        
	
        
}}


                       ?><a target="_blank" href="../resumen_atenciones.php?imprimir=<?php echo $_GET['orden'] ?>"> <img src="../imagenes/imp.png" alt="ver" height="30px" width="30px"> </a>
                       | Imprimir con firma: <a target="_blank" href="../vistas/reporte.php?imprimir=<?php echo $_GET['orden'] ?>"> <img src="../imagenes/imp.png" alt="ver" height="30px" width="30px"> </a>
		</article>
		    </fieldset>
    </body>
</html>