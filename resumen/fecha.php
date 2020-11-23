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
        <title>Extender Fecha de Atenciones</title>
    </head>
    <body>
      
       <?php
      

 
       ?>
       <div class="module_content"> 
                               
                                Modificar Fecha de Atenciones
            <hr>   
                                              <fieldset style="width:100%; float:center;">
            <?php function formRegistro(){ ?>
         <form name="insertar" action="../resumen/fecha.php?cod=<?php echo $_GET['orden'] ?>" method="post" enctype="multipart/form-data">
                <table>
                                                        <tr>
                                                           <td><label>Orden Interna : </label></td>
                                                           <td><input type="text" readonly  name="orden" value="<?php echo $_GET['orden'] ?>"></td>
                                                        </tr>
							<tr>
                                                           <td><label>Fecha Inicial : </label></td>
                                                           <td><input type="text" name="fi" value="<?php
                                                           $sql1 = "SELECT * FROM actividad where orden_servicio='".$_GET["orden"]."' group by orden_servicio";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $i = $fila1["StartTime"];
        $f = $fila1["EndTime"]; 
                                                           echo $i ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Fecha Final : </label></td>
                                                            <td><input type="text" name="ff" value="<?php echo $f ?>"></td>
                                                          
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
				 </fieldset></div>
                    
        <?php }
        if (isset($_POST["orden"])) {
	
	$orden = $_POST["orden"];
	$fi = $_POST["fi"];
	$ff = $_POST["ff"];
	// Hay campos en blanco
	if($fi==NULL|$ff==NULL) {
		echo "<font color='red'>un campo esta vacio.</font>";
		formRegistro();
	}else{
		// �Coinciden las contrase�as?
		$sql = "UPDATE `actividad` SET `StartTime`='".$fi."', `EndTime`='".$ff."' WHERE `orden_servicio`='".$orden."'";
       
                                mysql_query($sql) or die(mysql_error());
 echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
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