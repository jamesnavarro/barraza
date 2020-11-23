<?php
session_start();
include "../modelo/conexion.php";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
	<script type="text/javascript" src="../js/tcal.js"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <script> 
var ventana_secundaria 

function abrirVentana(){  
ventana_secundaria = window.open("../vistas/contacto.php","miventana","width=500,height=410,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 

  function cerrar() 
	
	 window.close();
   
</script>
        <title>Estado de la orden</title>
    </head>
    <body>
       
				<div class="module_content"> 
                               
                                Estado de la orden
            <hr>   
                                              <fieldset style="width:100%; float:center; margin-right: 3%;">
            <?php function formRegistro(){ ?>
        <?php  
       include "../modelo/conexion.php";
       if(isset($_GET["cod"])){
           if($_SESSION['admin']=='Si'){
               $consulta= "select * from actividad WHERE  orden_servicio='".$_GET["cod"]."' group by orden_servicio";
           }else{
               $consulta= "select * from actividad WHERE  orden_servicio='".$_GET["cod"]."' and user='".$_SESSION['k_username']."' group by orden_servicio";
           }

$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$orden=$fila['orden_servicio'];
$estado=$fila['est_motivo'];
$motivo=$fila['desc_motivo'];
echo 'Orden # :'.$orden;' --';
if($estado=='inactiva'){echo '<font color="red">'.$motivo.', Estado:'.$estado.'</font>'; '\n';}else{echo '<font color="green">'.$motivo.', Estado:'.$estado.'</font>'; '\n';}
 echo '<br>';
       }}
       ?>
							
		   
                                   
                                    
                                     <br>
                       
					<input type="button" value="Cancelar" onclick="window.close()">
                                        <?php  ?><a href='../resumen/estado_orden.php?cod=<?php echo $_GET["cod"] ?>'><input type="button" name="cancelar" value="Editar"></a> 
				 </fieldset></div>
                    
        <?php }
        if (isset($_POST["estado"])) {
	
	$estado = $_POST["estado"];
	$motivo = $_POST["motivo"];
	
	// Hay campos en blanco
	if($estado==NULL|$motivo==NULL) {
		echo "<font color='red'>un campo esta vacio.</font>";
		formRegistro();
	}else{
		// �Coinciden las contrase�as?
		
				
				
                                
                                $sql = "UPDATE `ordenes` SET `estado_2`='".$estado."', `motivo`='".$motivo."' WHERE `id`='".$_GET['cod']."'";
       
                                mysql_query($sql) or die(mysql_error());
echo "<script language='javascript' type='text/javascript'>";
echo "window.close()";
echo "</script>";
				?>
				
				<?php
			
		
	}
}else{
	formRegistro();
}
        ?>
    </body>
</html>
