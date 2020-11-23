<?php
session_start();
include "../modelo/conexion.php";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

?>
<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Receta Medica</title>
              <style>
                  *{
                      font-family: "Times New Roman", Times, serif;
                  }
table.es{
    border-collapse: none;
    width: 100%;
    border: 0px solid black;
    font-size: 10px;
} 


p {

  font-size: 10px;
}
.desc {
    line-height: 10px;
  font-size: 10px;
  text-align: justify;
}
.izq{
    float: left;
}
.der{
    float: right;
}
.med{
    float: center;
    padding: 25px;
    font-size: 14px;
    font-weight: 900;
    
}
</style>
    </head><?php
    $sqla = "SELECT * FROM actividad a, pacientes b, sis_empresa c  where b.id_empresa=c.rips and a.id_paciente=b.id_paciente and a.orden_servicio='".$_GET["cod"]."'  group by Description";
                $filaa =mysql_fetch_array(mysql_query($sqla));
                $Description = $filaa["Description"];
                $orden_servicio = $filaa["orden_servicio"];
                $orden_externa = $filaa["orden_externa"];
                $cant = $filaa["cant"];
                $cedula = $filaa["numero_doc"];$edad = $filaa["edad"];
                $name = $filaa["nombres"].' '.$filaa["apellidos"];
                $empresa = $filaa["nombre_emp"];
                $desc = $filaa["descripcion_enf"];
                $enf = $filaa["enfermedad"];
                 $user = $filaa["user"];
                   $direccione=$filaa['direccion1'];
    $tel_oficina=$filaa['tel_1'].'-'.$filaa['tel_3'];
                 
             $dep = mysql_query("select * from departamentos where cod_dep=".$filaa['departamento']." ");
    $d = mysql_fetch_array($dep);
    $departamento = $d['nombre_dep'];
    $mun = mysql_query("select * from departamentos where cod_mun=".$filaa['municipio']." and   cod_dep=".$filaa['departamento']."");
    $m = mysql_fetch_array($mun);
    $municipio = $m['nombre_mun'];      
                
 $consulta= "select * from receta WHERE id_orden=".$_GET['cod']." ";
$result=  mysql_query($consulta);
$fila=  mysql_fetch_array($result);
$id_evolucio = $fila['id_receta'];    

if(isset($id_evolucio) && !isset($_GET['editar'])){
    $prin = 'onload="window.print();"';
}else{
    $prin = '';
}
    ?>
<body <?php  echo $prin  ?>>

         <fieldset  style="height:850px; margin-right: 3%;margin-left: 3%;">
				<div class="module_content"> 
                                    <div>
                                        <div class="izq">
                                            <img src="../imagenes/idb.png" width="150px">
                                        </div>
                                        <div class="med"><center>INTERNACION DOMICILIARIA BARRAZA<BR>
                                            RECETA MEDICA</center></div> 
                                    </div><br><br><br>
                                    <div>
                                        <p><b>PACIENTE: </b><?php echo $name ?><span style="float:right;">Autorización N°.:<?php echo $orden_externa ?></span><BR>
                                    <b>CEDULA: </b><?php echo $cedula ?><BR>
                                    <b>EDAD: </b><?php echo $edad ?><BR>
                                    <b>DIRECCION: </b><?php echo $direccione ?> , TEL: <?php echo $tel_oficina ?> <span style="float:right;"><?php echo $municipio .' - '. $departamento; ?></span><BR>
                                    <b>DIAGNOSTICO: </b><?php echo $enf.' - '.$desc ?><BR>
                                     <b>ASEGURADORA: </b><?php echo $empresa ?></p>
                                     <div>
                                 
            <?php 

            
            
            function formRegistro(){ 
                if (isset($_GET['cod']) ){
    $consulta= "select * from receta a, actividad b WHERE a.id_orden=b.orden_servicio and id_orden=".$_GET['cod']." ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_evolucion = $fila['id_receta'];    
$id_orden = $fila['id_orden'];
$fecha= $fila['fecha'];
$descripcion= $fila['descripcion'];
$usuario= $fila['user'];
$estado= $fila['estado_r'];
}
if(isset($usuario)){
 $sqla = "SELECT * FROM usuarios where usuario='".$usuario."'";
                $filaa =mysql_fetch_array(mysql_query($sqla));
                $np= $filaa["nombre"].' '.$filaa["apellido"];
$cargo= $filaa["cargo"];$firm= $filaa["ruta"];}
}
if(isset($_GET['editar'])){
?>


    <form name="insertar" action="<?php if(isset($id_evolucion)){echo '../resumen/receta.php?editar='.$id_evolucion.'&cod='.$_GET['cod'].'';}else{echo '../resumen/receta.php?cod='.$_GET['cod'].'';} ?>" method="post" enctype="multipart/form-data">
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
                                                            <td><label>Descripcion de la receta medica : </label></td>
                                                            <td><textarea name="motivo" style="width:500px;"  rows="10"><?php if(isset($descripcion)){echo $descripcion;} ?></textarea></td>
                                                          
                                                        </tr>
                 <?php if($_SESSION['admin']=='Si'){  ?>
                                                        <tr><td> <select name="estado" style="width:130px;height:20px;">
                                                                   <?php if(isset($estado)){ echo '<option value="'.$estado.'">'.$estado.'</option>';}else{echo '<option value="">Cambie el estado</option>';} ?>
                                                                   <option value="Revisado">Revisado</option>
                                                                   <option value="">No Revisado</option>
                                                         </select></td></tr>                                         
                                                        <tr>
                                                            <td>Coordinador se siguio esta atencion?</td>
                                                            <td> <select name="seguir" required>
                                                                    <option value="">Escoja...</option>
                                                                            <option value="Continua atencion">Continua con atenciones</option>
                                                                            <option value="No trae O.Ext.">No trae O.Ext.</option>
                                                                            <option value="Retirado">Retirado</option>
                                                                         </select></td>
                                                                         <?php } ?>   
                                                        </tr>
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
        <br> <center><font color="red"> </font></center></div></div>


<?php

}else{
if(isset($id_evolucion)){
    echo '<br><br><br><br> <div class="desc"><center>Descripcion de la receta medica:</center><br>
        '.$descripcion.'<br><br>Fecha de registro: '.$fecha.'</div>';
    
    echo '<br><br><br><br>';
    echo '<table class="es">
     <tr>
   <td><img src="../img_barraza/'.$firm.'" alt="firma del profesional"   width="120" height="60"></td>
   <td></td>
   
</tr>
        <tr>
   <td>________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   <td></td>
   
</tr>
<tr>
   <td>Firma del Profesional</td>
   <td></td>
   
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
?><a title="Para editar esta evolucion por favor de click aqui en la estrella" href="../resumen/receta.php?cod=<?php echo $_GET['cod'] ?>&editar"><img src="../imagenes/estrella.png"></a></h6><?php
}else{
    

    ?>
    <fieldset>
                                                  <form name="insertar" action="<?php if(isset($id_evolucion)){echo '../resumen/receta.php?editar='.$id_evolucion.'';}else{echo '../resumen/receta.php?cod='.$_GET['cod'].'';} ?>" method="post" enctype="multipart/form-data">
                <table>
                                                        <tr>
                                                           <td><label>Orden Interna : </label></td>
                                                           <td><input name="orden" readonly type="text" value="<?php echo $_GET["cod"] ?>"</td>
                                                        </tr>
							<tr>
                                                           <td><label>Fecha de Registro : </label></td>
                                                           <td><input name="fecha" class="tcal" style="width:130px;height:20px;" value="<?php if(isset($fecha)){echo $fecha;}else{echo date("Y-m-d");}  ?>">
                                                                  </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Receta Medica : </label></td>
                                                            <td><textarea name="motivo" style="width:200%;" rows="20"><?php if(isset($descripcion)){echo $descripcion;} ?></textarea></td>
                                                        <tr>
                                                            <td>Se requiere seguir con las atenciones?</td>
                                                                    <td>
                                                                        <select name="seguir">
                                                                            <option value="Si">Si</option>
                                                                            <option value="No">No</option>
                                                                         </select>
                                                                    </td>
                                                        </tr>
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
        <br> <center><font color="red">Por favor describa lo mas detalladamente la receta que se le va a dar al paciente  </font></center></div></div>
                    
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
                $sql = "UPDATE `receta` SET `fecha` = '".$fecha."',`descripcion` = '".$motivo."',`estado_r` = '".$_POST["estado"]."' WHERE `id_receta` = '".$_GET['editar']."'";
                mysql_query($sql, $conexion);
                mysql_query("update actividad set seguir='".$_POST["seguir"]."' where orden_servicio='".$_POST["orden"]."' ");
                   $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                  $sqlr.= "VALUES ('Receta modificada por ".$_SESSION['k_username']."  ', '".$_GET['cod']."', '".$_SESSION['k_username']."', 'Atenciones')";
                  mysql_query($sqlr);
            }else{
                $seguir = $_POST["seguir"];
                $sql = "INSERT INTO `receta` (`fecha`,`id_orden`, `descripcion`, `seguir`)";
        $sql.= "VALUES ('".$fecha."','".$orden."', '".$motivo."', '".$seguir."')";
        mysql_query($sql);
        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                  $sqlr.= "VALUES ('Receta registrada por ".$_SESSION['k_username']."  ', '".$_GET['cod']."', '".$_SESSION['k_username']."', 'Atenciones')";
                  mysql_query($sqlr);
                  mysql_query("update actividad set seguir='".$seguir."' where orden_servicio=$orden ");
            }
        
echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.MostrarAtenciones(1);window.close()";
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