<?php
session_start();
include "../modelo/conexion.php";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

?>
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
  
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Evolucion segun el tratamiento</title>
        
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
                $cedula = $filaa["numero_doc"];
                $name = $filaa["nombres"].' '.$filaa["apellidos"];
                $empresa = $filaa["nombre_emp"];
                $desc = $filaa["descripcion_enf"];
                $enf = $filaa["enfermedad"];$edad = $filaa["edad"];
                 $user = $filaa["user"];
                 $pac = $filaa["id_paciente"];
                 $direccione=$filaa['direccion1'];
    $tel_oficina=$filaa['tel_1'].'-'.$filaa['tel_3'];
               
                      $dep = mysql_query("select * from departamentos where cod_dep=".$filaa['departamento']." ");
    $d = mysql_fetch_array($dep);
    $departamento = $d['nombre_dep'];
    $mun = mysql_query("select * from departamentos where cod_mun=".$filaa['municipio']." and   cod_dep=".$filaa['departamento']."");
    $m = mysql_fetch_array($mun);
    $municipio = $m['nombre_mun']; 
    
                $consulta= "select * from evolucion WHERE id_orden=".$_GET['cod']." ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_evolucio = $fila['id_evolucion'];    
}

  if(isset($id_evolucio) && !isset($_GET['editar'])){
    $prin = 'onload="window.print();"';
}else{
    $prin = '';
}
    ?>
<body <?php  echo $prin  ?>>
      
       
				<div class="module_content"> 
                                    <fieldset  style="height:850px; margin-left: 3%; margin-right: 3%;">
                                    <div>
                                        <div class="izq">
                                            <img src="../../imagenes/idb.png" width="150px">
                                        </div>
                                        <div class="med"><center>INTERNACION DOMICILIARIA BARRAZA.<BR>
                                            EVOLUCION MEDICA</center></div> 
                                    </div><br><br><br> 
                                
                                         <p><b>PACIENTE: </b><?php echo $name ?><span style="float:right;">Autorización N°.:<?php echo $orden_externa ?></span><BR>
                                    <b>CEDULA: </b><?php echo $cedula ?><BR>
                                    <b>EDAD: </b><?php echo $edad ?><BR>
                                    <b>DIRECCION: </b><?php echo $direccione ?> , TEL: <?php echo $tel_oficina ?> <span style="float:right;"><?php echo $municipio .' - '. $departamento; ?></span><BR>
                                    <b>DIAGNOSTICO: </b><?php echo $enf.' - '.$desc ?><BR>
                                     <b>ASEGURADORA: </b><?php echo $empresa ?></p>
                                             
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
$pac= $fila['id_paciente'];
}
if(isset($usuario)){
 $sqla = "SELECT * FROM usuarios where usuario='".$usuario."'";
                $filaa =mysql_fetch_array(mysql_query($sqla));
                $np= $filaa["nombre"].' '.$filaa["apellido"];
                $cargo= $filaa["cargo"];
                $firm= $filaa["ruta"];
                }}
if(isset($_GET['editar'])){
  if(!isset($_GET['ver'])){  
?>
                                    <article class="module width_full">
 <fieldset>
   <form name="insertar" action="<?php if(isset($id_evolucion)){echo '../vistas/evolucion.php?editar='.$id_evolucion.'&cod='.$_GET['cod'].'';}else{echo '../vistas/evolucion.php?cod='.$_GET['cod'].'';} ?>" method="post" enctype="multipart/form-data">
                <table>
                                                        <tr>
                                                           <td><label>Orden Interna : </label></td>
                                                           <td><input name="orden" readonly type="text" value="<?php echo $_GET["cod"] ?>"</td>
                                                        </tr>
							<tr>
                                                           <td><label>Fecha de Registro : </label></td>
                                                           <td><input name="fecha" class="" placeholder="2014-01-31" style="width:130px;height:20px;" value="<?php if(isset($fecha)){echo $fecha;}  ?>">
                                                                  </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Evolucion : </label></td>
                                                            <td><textarea name="motivo" style="width:200%;" rows="20"><?php if(isset($descripcion)){echo $descripcion;} ?></textarea></td>
                                                        
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
        </fieldset></article>
        <br> <center><font color="red">Por favor describa lo mas detalladamente la evolucion </font></center></div></div>

     
<?php
  }else{
      echo 'No hay datos registrados';
  }
}else{
if(isset($id_evolucion)){
    echo '<br><br> <p>Descripcion de la evolucion:</p><br><br>
        <div class="desc">'.strtoupper($descripcion).'<br><br>Fecha de registro: '.$fecha.'</div>';
    
    echo '<br><br><br><br><br><br><br><br>';
    echo '<table class="desc">
    <tr>
   <td><img src="../img_barraza/'.$firm.'" alt="firma del profesional"   width="80" height="60"></td>
   <td></td>
   
</tr>
        <tr>
   <td>________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
    if(isset($_GET['n'])){}else{
?><a title="Para editar esta evolucion por favor de click aqui en la estrella" href="../resumen/evolucion.php?cod=<?php echo $_GET['cod'] ?>&editar"><img src="../imagenes/estrella.png"></a>
    <?php } if($_SESSION['area']=='OFICINA'){ ?> <?php } ?><?php
}else{
    
if(!isset($_GET['ver'])){
    ?>
    <fieldset>
                                                  <form name="insertar" action="<?php if(isset($id_evolucion)){echo '../vistas/evolucion.php?editar='.$id_evolucion.'&cod='.$_GET['cod'].'';}else{echo '../vistas/evolucion.php?cod='.$_GET['cod'].'';} ?>" method="post" enctype="multipart/form-data">
                <table>
                                                        <tr>
                                                           <td><label>Orden Interna : </label></td>
                                                           <td><input name="orden" readonly type="text" value="<?php echo $_GET["cod"] ?>"</td>
                                                        </tr>
							<tr>
                                                           <td><label>Fecha de Registro : </label></td>
                                                           <td><input name="fecha" class="tcal" placeholder="2014-01-31" style="width:130px;height:20px;" value="<?php if(isset($fecha)){echo $fecha;}else{echo date("Y-m-d");}  ?>">
                                                                  </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Evolucion : </label></td>
                                                            <td><textarea name="motivo" style="width:200%;" rows="20"><?php if(isset($descripcion)){echo $descripcion;} ?></textarea></td>
                                                          
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<input type="button" value="Cancelar" onclick="window.close()"></form>
        </fieldset>
        <br> <center><font color="red">Por favor describa lo mas detalladamente la evolucion, por que al momento de guardar no podra ser editado  </font></center></div></div>
                    
        <?php 
        
                  }else{
        echo 'no existe ningun registro'; }
                                                            }}}
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
        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                  $sqlr.= "VALUES ('Evolucion registrada por ".$_SESSION['k_username']."  ', '".$_GET['cod']."', '".$_SESSION['k_username']."', 'Atenciones')";
                  mysql_query($sqlr);
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