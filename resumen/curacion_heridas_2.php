<?php 
session_start();
if(isset($_SESSION['k_username'])){
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if(isset($_GET['orden'])){
    $sql1 = "SELECT *, max(curacion_no) as no FROM curaciones where id_visita=".$_GET['codigo']."";
    $fila1 =mysql_fetch_array(mysql_query($sql1));
        $no = $fila1["no"]+1;
}else{
    $sql1 = "SELECT *, max(curacion_no) as no FROM curaciones where id_visita=".$_GET['codigo']."";
    $fila1 =mysql_fetch_array(mysql_query($sql1));
        $no = $fila1["no"]+1;
}

        
    if(isset($_GET['orden'])){
        $sql2 = "SELECT * FROM actividad where Id=".$_GET['codigo']."";
        $fila2 =mysql_fetch_array(mysql_query($sql2));
    $num_visita = $fila2["cant_ins"];}
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Curaciones</title>
	
	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
         <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="../resources/style.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
        <script src="../js/mostrarmenu_1.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>

</head>


<body>

	
	
	
	<section id="main" class="column">

		<div class="clear"></div>
             
                <fieldset>
			<header><h3 align="center"><b>SEGUIMIENTO DE HERIDAS</b></h3></header>
                          
                 <?php if(isset($_GET['ver']) || isset($_GET['orden'])){   ?>       
                        
            <form name="insertar" action="" method="post" enctype="multipart/form-data">
                <br>
                
                <table width="100%" ><tr>
                        <td></td><td nowrap><label><b>EVALUACION Y MANEJO DE LAS LESIONES DE PIEL</b></label></td>
                        <td nowrap><label><b>CURACIÓN No</b></label></td>
                        <td><input type="text" name="curacion_no" value="<?php echo $no ?>" style="width:70px;height:20px;background-color:white;"></td>
                    
                    
                    </tr>
                </table>
                <br>
                
                
      
                
                  
                
                 <table width="100%" border="0" style="border:1px solid #000000;">
                     <tr></tr><tr></tr><tr></tr>
                     
                     <tr><td></td><td nowrap><label>Relacionado con visita #</label>     
                   <input type="text" name="visita" readonly value="<?php echo $_GET['codigo'] ?>" style="width:70px;height:20px;background-color:white;"></td>
                    <td nowrap><label>Localizaciòn Anatomica</label> 
                   <input type="text" name="localizacion"  style="width:180px;height:20px;background-color:white;"></td></tr>
                     <tr></tr><tr></tr>
                   
                   <tr><td></td><td nowrap><label>Estadio</label> 
                   <select name="estadio" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="I">I</option>
                       <option value="II">II</option>
                       <option value="III">III</option>
                       <option value="IV">IV</option>
                       <option value="Inespecifica">Inespecifica</option>
                       </select></td>
                   <td nowrap><label>Cant. Del Exusado</label> 
                   <select name="cant_exusado" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Ausente">Ausente</option>
                       <option value="Baja">Baja</option>
                       <option value="Moderada">Moderada</option>
                       <option value="Abundante">Abundante</option>
                       
                       </select></td>   
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    
                    <tr><td></td><td nowrap><label>Clarificaciòn</label>  
                   <select name="clarificacion" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Quirúrgica">Quirúrgica</option>
                       <option value="Traumática">Traumática</option>
                       <option value="Presión">Presión</option>
                       <option value="Vascular">Vascular</option>
                       
                       </select></td>
                   <td nowrap><label>Piel Circundante</label> 
                   <select name="piel_circundante" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Integra">Integra</option>
                       <option value="Engrosada">Engrosada</option>
                       <option value="Macerada">Macerada</option>
                       <option value="Invaginada">Invaginada</option>
                       
                       </select></td>
                       
                       
                    </tr>
                    <tr></tr>
                    <tr></tr>
                     <tr><td></td><td nowrap><label>Dimensión</label> 
                   <select name="dimencion" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Largo">Largo</option>
                       <option value="Ancho">Ancho</option>
                       <option value="Profundidad">Profundidad</option>
                       
                       
                       </select></td>
                   <td nowrap><label>Piel Color</label>  
                   <select name="piel_color" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Oscura">Oscura</option>
                       <option value="Pálida">Pálida</option>
                       <option value="Rosada">Rosada</option>
                        
                       
                       </select></td>
                       
                       
                    </tr>
                    <tr></tr>
                    <tr></tr>
                      <tr><td></td><td nowrap><label>Base De la Herida</label>    
                   <select name="base_herida" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Túnel">Túnel</option>
                       <option value="Cavitada">Cavitada</option>
                       <option value="Fistula">Fistula</option>
                       <option value="Plana">Plana</option>
                       
                       
                       </select></td>
                   <td nowrap><label>Signos De Infección</label> 
                   <select name="infeccion" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Induración">Induración</option>
                       <option value="Calor">Calor</option>
                       <option value="Eritema">Eritema</option>
                       <option value="Edema">Edema</option>
                       <option value="Dolor">Dolor</option>
                        
                       
                       </select></td>
                       
                       
                    </tr>
                    <tr></tr>
                    <tr></tr>
                     <tr><td></td><td nowrap><label>Característica Tejido</label>
                   <select name="tejido" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Epitelial">Epitelial</option>
                       <option value="Granulación">Granulación</option>
                       <option value="Esfacelo">"Esfacelo</option>
                       <option value="Necròtico">Necròtico</option>
                       
                       
                       </select></td>
                   <td nowrap><label>Olor</label>    
                   <select name="olor" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Ausente">Ausente</option>
                       <option value="Fetido">Fetido</option>
        
                       </select></td>
                       
                       
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr><td></td><td nowrap><label>Exusado</label>   
                   <select name="exusado" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       <option value="Seroso">Seroso</option>
                       <option value="Sanguinolento">Sanguinolento</option>
                       <option value="Purulento">Purulento</option>
                       <option value="Ninguna">Ninguna</option>
                       
                       
                       </select></td>
                   <td nowrap><label>Dolor (Escala 1-10)</label>      
                   <select name="dolor" style="width:50%;height:20px;">
                       <option value="Ninguna">Seleccione uno..</option>
                       
                       <option value="0">0</option>
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                       <option value="4">4</option>
                       <option value="5">5</option>
                       <option value="6">6</option>
                       <option value="7">7</option>
                       <option value="8">8</option>
                       <option value="9">9</option>
                       <option value="10">10</option>
        
                       </select></td>
                       
                       
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td></td><td></td>
                        <td NOWRAP><input type="button" name="enviar" value="CANCELAR" style='width:50%; height:25px' class="alt_btn" onclick="window.close()"> <input type="submit" name="enviar" value="GUARDAR" style='width:50%; height:25px' class="alt_btn" onclick=""></td></tr>
                     
                     <tr></tr><tr></tr>
                   
           
                    
                </table
              
</form>

			<?php  } ?>
                        <hr>
                        
                <?php 
 if(isset($_GET['orden'])){
     $request=mysql_query("SELECT * FROM curaciones where orden_interna='".$_GET['orden']."'");
 }else{
   $request=mysql_query("SELECT * FROM curaciones where id_visita='".$_GET['codigo']."'");  
 }               

if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Atencion'.'</th>';
              $table = $table.'<th>'.'Curación'.'</th>';
              $table = $table.'<th>'.'Localización'.'</th>';
              $table = $table.'<th>'.'Estadio'.'</th>';
              $table = $table.'<th>'.'Clarificación'.'</th>';
              $table = $table.'<th>'.'Dimensión'.'</th>';
              $table = $table.'<th>'.'Base de la Herida'.'</th>';
              $table = $table.'<th>'.'Caracteristica Tejido'.'</th>';
              $table = $table.'<th>'.'Exusado'.'</th>';
              $table = $table.'<th>'.'Cantidad Exusado'.'</th>';
              $table = $table.'<th>'.'Piel Circundante'.'</th>';
              $table = $table.'<th>'.'Piel Color'.'</th>';
              $table = $table.'<th>'.'Signos de Infeccion'.'</th>';
              $table = $table.'<th>'.'Olor'.'</th>';
              $table = $table.'<th>'.'Dolor'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
            if(isset($_GET['orden'])){    
         $c='<a href="../vistas/curacion_heridas.php?eliminar='.$row["id_curacion"].'&codigo='.$_GET["codigo"].'&orden='.$_GET["orden"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';
            }
$table = $table.'<tr><td>'.$row["visita_numero"].'</td><td>'.$row["curacion_no"].'</td>
    <td>'.$row["localizacion"].'</td>
        <td>'.$row["estadio"].'</td>
            <td>'.$row["clarificacion"].'</td>
                <td>'.$row["dimencion"].'</td>
                    <td>'.$row["base_herida"].'</td>
                        <td>'.$row["tejido"].'</td>
                            <td>'.$row["exusado"].'</td>
                                <td>'.$row["cant_exusado"].'</td>
                                    <td>'.$row["piel_circundante"].'</td>
                                        <td>'.$row["piel_color"].'</td>
                                            <td>'.$row["infeccion"].'</td>
                                                <td>'.$row["olor"].'</td>
                                                    <td>'.$row["dolor"].'</td>
              
                           <td>'.$c.'</td></tr>';   
               
           
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
   
}

if (isset($_POST["curacion_no"])){
    if($_POST['localizacion']==''){
                echo '<script lanquage="javascript">alert("Por favor digite la localización de la herida");location.href="../vistas/curacion_heridas.php?codigo="'.$_GET['codigo'].'"&orden="'.$_GET['orden'].'""</script>';

    }else{
	$id_visita= $_GET["codigo"];
        $orden= $_GET["orden"];
        $visita = $_POST["visita"];
        $curacion_no = $_POST["curacion_no"];
        $localizacion = $_POST["localizacion"];
        $estadio = $_POST["estadio"];
        $clarificacion = $_POST["clarificacion"];
        $dimencion = $_POST["dimencion"];
        $base_herida = $_POST['base_herida'];
        $tejido = $_POST['tejido'];
        $exusado = $_POST['exusado'];
        $cant_exusado = $_POST['cant_exusado'];
        $piel_circundante = $_POST['piel_circundante'];
        $piel_color = $_POST['piel_color'];
        $infeccion = $_POST['infeccion'];
        $olor = $_POST['olor'];
        $dolor = $_POST['dolor'];
           $sql = "INSERT INTO `curaciones` (`id_visita`, `visita_numero`, `curacion_no`, `localizacion`, `estadio`, `clarificacion`, `dimencion`, `base_herida`, `tejido`, `exusado`, `cant_exusado`,`piel_circundante`, `piel_color`, `infeccion`, `olor`, `dolor`, `orden_interna`)";

        $sql.= "VALUES ('".$id_visita."','".$visita."', '".$curacion_no."','".$localizacion."', '".$estadio."', '".$clarificacion."', '".$dimencion."', '".$base_herida."','".$tejido."', '".$exusado."', '".$cant_exusado."', '".$piel_circundante."', '".$piel_color."', '".$infeccion."', '".$olor."', '".$dolor."', '".$orden."')";

	mysql_query($sql);

	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/curacion_heridas.php?codigo=".$_GET['codigo']."&orden=".$_GET['orden']."'";
        echo "</script>";
        
    }
}
 if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $C=$_GET['codigo'];
        $O=$_GET['orden'];
        $sql = "DELETE FROM curaciones WHERE id_curacion='$Codigo'";
        mysql_query($sql);
       echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/curacion_heridas.php?codigo=".$_GET['codigo']."&orden=".$_GET['orden']."'";
        echo "</script>";
    }
    if(isset($_GET['orden'])){ 
?>
    <a target="_blank" href="../resumen_curaciones.php?imprimir=<?php echo $_GET['orden'] ?>"> <img src="../imagenes/imp.png" alt="ver" height="30px" width="30px"> </a><?php } ?>         
		</fieldset>
 <div class="spacer"></div>
	</section>
             

</body>

</html>
<?php   }else {header("location:../index.php");}  ?>