<?php 
session_start();
include "../modelo/conexion.php";
require '../modelo/insertar_precio_alquiler.php';
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>systema Integral</title>
	
	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
         <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="../resources/style.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
        <script src="../js/mostrarmenu_1.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <script language="javascript">
            
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1_1").change(function () {
   		$("#combo1_1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/combo1_1.php", { elegido: elegido }, function(data){
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
<script language='javascript'>
function contacto()
{
catPaises = window.open('../vistas/form_contacto.php', 'contacto', 'width=500,height=600');
}
function seleccionar()
{
catPaises = window.open('../vistas/seleccionar.php', 'contacto', 'width=1000,height=600');
}
function usuario()
{
catPaises = window.open('../seleccion/usuario.php', 'contacto', 'width=1000,height=600');
}
function atenciones()
{
catPaises = window.open('../seleccion/atenciones.php', 'contacto', 'width=1000,height=600');
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
function datos2(val3, val4, val5){
    
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
    document.getElementById('valor5').value = val5;
}
</script>
</head>


<body>
   <?php  include '../vistas/menu.php'; ?>
	
	<section id="main" class="column">

		<div class="clear"></div>
             
                <article class="module width_full">
			<header><h3>Alquiler de equipos</h3></header>
                        <font color="red">Aviso: (*)Indica un campo requerido</font>
                        <fieldset style="width:90%; float:center; margin-right: 5%;">
            <form name="insertar" action="<?php if (isset($_GET['codigo'])){echo "../modelo/editar_precio_alquiler.php?editar=".$_GET['codigo']."";}else{echo '../modelo/insertar_precio_alquiler.php';} ?>" method="post" enctype="multipart/form-data">
                <table>
							<tr>
                                                            <td><label>equipo: *</label></td>
                                                            <td> <select name="equipo">
                                                             <?php if(isset($idate)){ echo '<option value="'.$idate.'">'.$na.'</option>';} ?>
                                                          <option value="">Seleccione uno..</option>
                                                          <?php
                                                            include "modelo/conexion.php";
                                                            $consulta= "select * from alquiler";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['id'];
                                                            $valor2=$fila['nombre'];
                                                            $valor3=$fila['tipo'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2.' - ('.$valor3.")</option>";
                                                            
                                                            }
                                                            ?>
                                                            
                                                            
                                                        </select></td></tr>
                                                        <tr>
                                                            <td><label>nombre de la empresa :</label></td>
                                                            <td> <select name="empresa">
                                                                    <?php if(isset($idate)){ echo '<option value="'.$idemp.'">'.$ne.'</option>';} ?>
                                                          <option value="">Seleccione uno..</option>
                                                          <?php
                                                            include "modelo/conexion.php";
                                                            $consulta= "select * from sis_empresa where cliente='Si'";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['id_empresa'];
                                                            $valor2=$fila['nombre_emp'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                            
                                                            
                                                        </select></td></tr>
                                                        <tr>
                                                           <td><label>precio: <font color="red"> *</font> $</label></td>
                                                           <td><input type="text" name="precio" style="width:130px;" value="<?php if (isset($_GET['codigo'])){echo $pr;} ?>"/></td>
                                                        </tr>
                                                          
                                                         
                                                          <tr><td><input type="submit" name="enviar" value="Guardar" class="alt_btn" onclick="">
					                          <input type="reset" value="Limpiar"></td></tr>
                                                          
                                                     </table></form>
		    </fieldset>
                    
		</article>
                
                <article class="module width_full">
			<header><h3>lista de equipos de alquiler</h3></header>
                        <hr>
                        
<?php 
$request=mysql_query("SELECT * FROM alquiler");
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Numero'.'</th>';
              $table = $table.'<th>'.'Nombre de Atención'.'</th>';
              $table = $table.'<th>'.'Código'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id"].'">';}else{$ver='';}
           if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){$b='<a href="../vistas/alquiler.php?codigo='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../vistas/alquiler.php?eliminar='.$row["id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           

          
          
           
            $table = $table.'<tr><td>'.$row["id"].'<font></a></td></td>
               <td>'.$row["nombre"].'</font></td><td>'.$row["codigo"].'</font></td>
                   
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';   
               
           
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
                                                              if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM atenciones WHERE id_atencion='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/atenciones.php"</script>'; 
    }   
}
?>
                      
		</article> 
		
		
		
		<div class="spacer"></div>
	</section>
                <?php include '../footer.php'; ?>

</body>

</html>
