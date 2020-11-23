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
        <title>Cambiar Contraseña</title>
    </head>
    <body>
       
				<div class="module_content"> 
                               
                                Cambiar Contraseña
            <hr>   
                                              <fieldset style="width:100%; float:center; margin-right: 3%;">
            <?php function formRegistro(){ ?>
         <form name="insertar" action="../vistas/form_contrasena.php" method="post" enctype="multipart/form-data">
                <table>
							<tr>
                                                           <td><label>Nueva Contraseña : </label></td>
                                                           <td><input type="password" name="password"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Confirmar Contraseña : </label></td>
                                                            <td><input type="password" name="password2"></td>
                                                          
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
				 </fieldset></div>
                    
        <?php }
        if (isset($_POST["password"])) {
	
	$password = $_POST["password"];
	$password2 = $_POST["password2"];
	
	// Hay campos en blanco
	if($password==NULL|$password2==NULL) {
		echo "un campo esta vacio.";
		formRegistro();
	}else{
		// �Coinciden las contrase�as?
		if($password!=$password2) {
			echo "Las contraseñas no coinciden";
			formRegistro();
		}
		else{
				
				
                                
                                $sql = "UPDATE `usuarios` SET `password` = '".md5($password)."'WHERE `usuarios`.`id` = '".$_SESSION["id_user"]."'";
       
                                mysql_query($sql) or die(mysql_error());
echo "<script language='javascript' type='text/javascript'>";
echo "window.close()";
echo "</script>";
				?>
				
				<?php
			}
		
	}
}else{
	formRegistro();
}
        ?>
    </body>
</html>
