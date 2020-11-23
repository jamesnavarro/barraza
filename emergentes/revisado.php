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

        <title>Terminar las Atenciones</title>
    </head>
    <body>
      
       
				<div class="module_content"> 
                               
                                Terminar las Atenciones
            <hr>   
                                              <fieldset style="width:100%; float:center; margin-right: 3%;">
            <?php function formRegistro(){
                      if(isset($_GET["codigo"])){
           if($_SESSION['admin']=='Si'){
               $consulta= "select * from actividad WHERE  orden_servicio='".$_GET["codigo"]."' group by orden_servicio";
           }else{
               $consulta= "select * from actividad WHERE  orden_servicio='".$_GET["codigo"]."' and user='".$_SESSION['k_username']."' group by orden_servicio";
           }

$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$orden=$fila['orden_servicio'];
$estado=$fila['Location'];
$motivo=$fila['RecurringRule'];
       }}
                ?>
         <form name="insertar" action="../emergentes/revisado.php?cod=<?php echo $_GET['codigo'] ?>" method="post" enctype="multipart/form-data">
                <table>
                                                        <tr>
                                                           <td><label>Orden Interna : </label></td>
                                                           <td><input name="orden" readonly type="text" value="<?php echo $_GET["codigo"] ?>"</td>
                                                        </tr>
							<tr>
                                                           <td><label>Estado : </label></td>
                                                           <td><select name="estado" style="width:130px;height:20px;">
                                                                  
                                                                   <?php  if($estado==''){echo '<option value="">..Seleccione..</option>';}else{echo ' <option value="'.$estado.'">'.$estado.'</option>';}  ?>
                                                                   <option value="Revisado">Revisado</option>

                                                               </select></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Observaciones : </label></td>
                                                            <td><textarea name="motivo" placeholder="Digite alguna observacion que se presente en esta orden interna" style="width:100%;" rows="8"><?php  if($estado!=''){echo $motivo;} ?></textarea></td>
                                                          
                                                          
                                                     </table>
		   Por favor seleccione el estado de revisado para terminar el proceso
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
				 </fieldset></div>
                    
        <?php }
        if (isset($_POST["estado"])) {
	
	$estado = $_POST["estado"];
	$motivo = $_POST["motivo"];
	$orden = $_POST["orden"];
	// Hay campos en blanco
	if($estado==NULL) {
		echo "<font color='red'>un campo esta vacio.</font>";
		formRegistro();
	}else{
           
		 $sql = "UPDATE `actividad` SET `Location`='".$estado."', `RecurringRule`='".$motivo."' WHERE `orden_servicio`='".$orden."'";
                 mysql_query($sql) or die(mysql_error());
                 
                  $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                  $sqlr.= "VALUES ('Esta atencion fue modificada por', '".$_POST['orden']."', '".$_SESSION['k_username']."', 'Atenciones')";
                  mysql_query($sqlr);
                  
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
