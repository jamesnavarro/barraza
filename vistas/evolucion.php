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
        <title>Evolucion segun el tratamiento</title>
    </head><?php
    $sqla = "SELECT * FROM actividad a, pacientes b, sis_empresa c  where b.id_empresa=c.rips and a.id_paciente=b.id_paciente and a.orden_servicio='".$_GET["cod"]."'  group by Description";
                $filaa =mysql_fetch_array(mysql_query($sqla));
                $Description = $filaa["Description"];
                $orden_servicio = $filaa["orden_servicio"];
                $orden_externa = $filaa["orden_externa"];
                $cant = $filaa["cant"];
                $cedula = $filaa["numero_doc"];
                $name = $filaa["nombres"].' '.$filaa["apellidos"];
                $empresa = $filaa["nombre_emp"];
                $desc = $filaa["descripcion_enf"];
                $enf = $filaa["enfermedad"];
                 $user = $filaa["user"];
                 
               
                
                $consulta= "select * from evolucion WHERE id_orden=".$_GET['cod']." ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_evolucio = $fila['id_evolucion'];    
}
    ?>
    <body <?php if(isset($id_evolucio)){?>title="Para sacar una copia impresa por favor presione en el teclado Ctrl + p"<?php } ?>>
      
       
				<div class="module_content"> 

                                    <center><header><h5>INTERNACION DOMICILIARIA BARRAZA<BR>
                                            EVOLUCION FINAL</h5></header></center>  
                                
                                     <?php echo '<h6><table border="1">
                                    <tr>
                                    <td>PACIENTE: '.$name.'</td>
                                    <td>C.C:'.$cedula.   '</td>
                                    <td>Autorizacion No.'.$orden_externa.'</td> 
                                    </tr>
                                    <tr>
                                    <td>DIAGNOSTICO: '.$desc.'</td>
                                    <td>CODIGO: '.$enf.'</td>
                                    
                                        <td></td> 
                                    </tr>
                                    <tr>
                                    <td>EMPRESA: '.$empresa.'</td>
                                    <td>Usuario :'.$user.'</td>
                                        <td></td> 
                                    </tr>
                                    <tr>
                                    <td>ATENCION:'.$Description.   '</td>
                                    <td>Cantidad de Atenciones: '.$cant.'</td> 
                                    <td></td>  
                                    </tr>
                                    </table></h6>' ;  ?>
                                             
            <?php 

            
            
            function formRegistro(){ 
                if (isset($_GET['cod']) ){
    $consulta= "select * from evolucion a, actividad b WHERE a.id_orden=b.orden_servicio and id_orden=".$_GET['cod']." ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_evolucion = $fila['id_evolucion'];    
$id_orden = $fila['id_orden'];
$fecha= $fila['fecha'];
$descripcion= $fila['descripcion'];
$usuario= $fila['user'];
}
 $sqla = "SELECT * FROM usuarios where usuario='".$usuario."'";
                $filaa =mysql_fetch_array(mysql_query($sqla));
                $np= $filaa["nombre"].' '.$filaa["apellido"];
                $cargo= $filaa["cargo"];
}
if(isset($_GET['editar'])){
?>

 <fieldset style="width:100%; float:center; margin-right: 3%;">
                                                  <form name="insertar" action="<?php if(isset($id_evolucion)){echo '../vistas/evolucion.php?editar='.$id_evolucion.'';}else{echo '../vistas/evolucion.php?cod='.$_GET['cod'].'';} ?>" method="post" enctype="multipart/form-data">
                <table>
                                                        <tr>
                                                           <td><label>Orden Interna : </label></td>
                                                           <td><input name="orden" readonly type="text" value="<?php echo $_GET["cod"] ?>"</td>
                                                        </tr>
							<tr>
                                                           <td><label>Fecha de Registro : </label></td>
                                                           <td><input name="fecha" class="tcal" style="width:130px;height:20px;" value="<?php if(isset($fecha)){echo $fecha;}  ?>">
                                                                  </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Evolucion : </label></td>
                                                            <td><textarea name="motivo" style="width:200%;" rows="20"><?php if(isset($descripcion)){echo $descripcion;} ?></textarea></td>
                                                          
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
        <br> <center><font color="red">Por favor describa lo mas detalladamente la evolucion </font></center></div></div>


<?php

}else{
if(isset($id_evolucion)){
    echo '<br><br> <h6><p>Descripcion de la evolucion:<br><br>
        '.$descripcion.'<br><br>Fecha de registro: '.$fecha.'</p>';
    
    echo '<br><br><br><br>';
    echo '<table>
    <tr>
   <td><img src="../'.$usuario.'.jpg" alt="firma del profesional"   width="80" height="60"></td>
   <td></td>
   
</tr>
        <tr>
   <td>________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   <td>________________________</td>
   
</tr>
<tr>
   <td>Firma del Profesional</td>
   <td>Firma del acudiente o paciente</td>
   
</tr>
<tr>
   <td>'.$np.'</td>
   <td></td>
   
</tr>
<tr>
   <td>'.$cargo.'</td>
   <td></td>
   
</tr>
</table>';
?><a title="Para editar esta evolucion por favor de click aqui en la estrella" href="../vistas/evolucion.php?cod=<?php echo $_GET['cod'] ?>&editar"><img src="../imagenes/estrella.png"></a></h6><?php
}else{
    

    ?>
    <fieldset style="width:100%; float:center; margin-right: 3%;">
                                                  <form name="insertar" action="<?php if(isset($id_evolucion)){echo '../vistas/evolucion.php?editar='.$id_evolucion.'';}else{echo '../vistas/evolucion.php?cod='.$_GET['cod'].'';} ?>" method="post" enctype="multipart/form-data">
                <table>
                                                        <tr>
                                                           <td><label>Orden Interna : </label></td>
                                                           <td><input name="orden" readonly type="text" value="<?php echo $_GET["cod"] ?>"</td>
                                                        </tr>
							<tr>
                                                           <td><label>Fecha de Registro : </label></td>
                                                           <td><input name="fecha" class="tcal" style="width:130px;height:20px;" value="<?php if(isset($fecha)){echo $fecha;}  ?>">
                                                                  </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Evolucion : </label></td>
                                                            <td><textarea name="motivo" style="width:200%;" rows="20"><?php if(isset($descripcion)){echo $descripcion;} ?></textarea></td>
                                                          
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
        <br> <center><font color="red">Por favor describa lo mas detalladamente la evolucion, por que al momento de guardar no podra ser editado  </font></center></div></div>
                    
        <?php }}}
        if (isset($_POST["fecha"])) {
	
	$fecha = $_POST["fecha"];
	$motivo = $_POST["motivo"];
	$orden = $_POST["orden"];
	// Hay campos en blanco
	if($fecha==NULL|$motivo==NULL) {
		echo "<font color='red'>un campo esta vacio.</font>";
		formRegistro();
	}else{
            if(isset($_GET['editar'])){
                $sql = "UPDATE `evolucion` SET `fecha` = '".$fecha."',`descripcion` = '".$motivo."' WHERE `id_evolucion` = '".$_GET['editar']."'";
                mysql_query($sql, $conexion);
                
                $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                  $sqlr.= "VALUES ('Evolucion modificada por ".$_SESSION['k_username']."  ', '".$_GET['cod']."', '".$_SESSION['k_username']."', 'Atenciones')";
                  mysql_query($sqlr);
            }else{
                $sql = "INSERT INTO `evolucion` (`fecha`,`id_orden`, `descripcion`)";
        $sql.= "VALUES ('".$fecha."','".$orden."', '".$motivo."')";
        mysql_query($sql);
            }
        
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