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
        <title>Terminar las Atenciones</title>
    </head>
    <body>
      
       
				<div class="module_content"> 
                               
                                Terminar las Atenciones
            <hr>   
                                              <fieldset style="width:100%; float:center; margin-right: 3%;">
            <?php function formRegistro(){ 
$esd = mysql_query("select * from actividad where orden_servicio=".$_GET['cod']."  group by orden_servicio"); 
$e = mysql_fetch_array($esd);

                ?>
                                                  
         <form name="insertar" action="../resumen/estado_orden.php?cod=<?php echo $_GET['cod'] ?>&x" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                       <td><label>Orden Interna : </label></td>
                       <td><input name="orden" readonly type="text" value="<?php echo $_GET["cod"] ?>"</td>
                    </tr>
                    <tr>
                       <td><label>Estado : </label></td>
                       <td><select name="estado" style="width:130px;height:20px;">


                               <?php if($e['est_motivo']=='activa'){ echo '<option value="">..Seleccione..</option><option value="inactiva">Inactiva</option>';}else{echo '<option value="'.$e['est_motivo'].'">'.$e['est_motivo'].'</option>';}  ?>
                               <?php if($_SESSION["admin"] == 'Si'){  ?><option value="activa">Activa</option><?php } ?>

                           </select></td>
                    </tr>
                    <tr>
                        <td><label>Motivo : </label></td>
                        <td><textarea name="motivo" style="width:100%;" rows="8"><?php echo $e['desc_motivo'];  ?></textarea></td>
                    <tr>
                        <td>Porcentaje</td>
                        <td><input type="text" name="por" value="<?php echo $e['id_contacto'];  ?>"></td>

                 </table>  
          <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
                         <?php if($_SESSION["area"] == 'OFICINA'){  ?>                                                 
                                                  <br>
       <form name="insertar" action="../resumen/estado_orden.php?cod=<?php echo $_GET['cod'] ?>&up" method="post" enctype="multipart/form-data">
        <table>
            <tr><td>Activar edicion</td>
            <td><select name="ed" style="width:50px;height:20px;">


                   <?php if($e['editar']=='0'){ echo '<option value="0">0</option><option value="1">1</option>';}else{echo '<option value="0">0</option><option value="1">1</option>';}  ?>


               </select>
            </td></tr>
            <tr><td>Editar Fecha Limite</td>
                <td><input type="text" name="vence" value="<?php  echo $e['vencimiento'];  ?>"> formato de fecha <?php echo date("Y-m-d"); ?></td></tr>
                                                      </table>
      <input type="submit" name="enviar" value="Activar Edicion" class="alt_btn">
                                                    
</form><?php }  ?>
				 </fieldset></div>
                    
        <?php }
        if (isset($_GET["x"])) {
	
	$estado = $_POST["estado"];
	$motivo = $_POST["motivo"];
	$orden = $_POST["orden"];$ed = $_POST["ed"];$por = $_POST["por"];
	// Hay campos en blanco
	if($estado=='' || $motivo=='') {
		echo "<font color='red'>un campo esta vacio.</font>";
		formRegistro();
	}else{

		 $sql = "UPDATE `actividad` SET `est_motivo`='".$estado."', `desc_motivo`='".$motivo."', `editar`='".$ed."', `id_contacto`='".$por."' WHERE `orden_servicio`='".$orden."'";
       
                                mysql_query($sql) or die(mysql_error());
echo "<script language='javascript' type='text/javascript'>";
echo "window.close()";
echo "</script>";
				?>
				
				<?php
		//e10adc3949ba59abbe56e057f20f883e
		
	}
}else{
	formRegistro();
}
        if (isset($_GET["up"])){

            $ed = $_POST["ed"];
$nuevafecha = strtotime( '+1 day' , strtotime($fecha));
$vencimiento = date('Y-m-d' , $nuevafecha);
	$sql = "UPDATE `actividad` SET `vencimiento`='".$_POST["vence"]."', `editar`='".$ed."', contador=0 WHERE `orden_servicio`='".$_GET['cod']."'";
         mysql_query($sql) or die(mysql_error());
 echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
echo "</script>";

}
        ?>
    </body>
</html>
