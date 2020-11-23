<?php 
session_start();
if(isset($_SESSION['k_username'])){
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Curaciones</title>
	
        <link rel="stylesheet" href="../css/css_tablas.css" type="text/css" media="screen" />
	

</head>


<body>

	
	
	
	<section id="main" class="column">

		<div class="clear"></div>
             
                <fieldset>
			<header><h3 align="center"><b>SEGUIMIENTO DE HERIDAS</b></h3></header>
           

			
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

     
              $table = $table.'<tr>';
              $table = $table.'<td>'.'Visita'.'</td>';
              $table = $table.'<td>'.'Curación'.'</td>';
              $table = $table.'<td>'.'Localización'.'</td>';
              $table = $table.'<td>'.'Estadio'.'</td>';
              $table = $table.'<td>'.'Clarificación'.'</td>';
              $table = $table.'<td>'.'Dimensión'.'</td>';
              $table = $table.'<td>'.'Base de la Herida'.'</td>';
              $table = $table.'<td>'.'Caracteristica Tejido'.'</td>';
              $table = $table.'<td>'.'Exusado'.'</td>';
              $table = $table.'<td>'.'Cantidad Exusado'.'</td>';
              $table = $table.'<td>'.'Piel Circundante'.'</td>';
              $table = $table.'<td>'.'Piel Color'.'</td>';
               $table = $table.'<td>'.'Caract. Piel'.'</td>';
              $table = $table.'<td>'.'Piel Color'.'</td>';
              $table = $table.'<td>'.'Signos de Infeccion'.'</td>';
              $table = $table.'<td>'.'Olor'.'</td>';
              $table = $table.'<td>'.'Dolor'.'</td>';
             
              $table = $table.'</tr>';
             
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
        if($row["c1"]==''){$c1='';}else{$c1=$row["c1"].', ';}
                if($row["c2"]==''){$c2='';}else{$c2=$row["c2"].', ';}
                if($row["c3"]==''){$c3='';}else{$c3=$row["c3"].', ';}
                if($row["c4"]==''){$c4='';}else{$c4=$row["c4"].', ';}
                if($row["c5"]==''){$c5='';}else{$c5=$row["c5"].' ';}
$sql2 = "SELECT * FROM actividad where Id=".$row["visita_numero"]."";
$fila2 =mysql_fetch_array(mysql_query($sql2));
$num_visita = $fila2["cant_ins"];
$table = $table.'<tr><td>Visita '.$num_visita.'</td><td>'.$row["curacion_no"].'</td>
    <td>'.$row["localizacion"].'</td>
        <td>'.$row["estadio"].'</td>
            <td>'.$row["clarificacion"].'</td>
                <td>'.$row["dimencion"].'</td>
                    <td>'.$row["base_herida"].'</td>
                        <td>'.$row["tejido"].'</td>
                            <td>'.$row["exusado"].'</td>
                                <td>'.$row["cant_exusado"].'</td>
                                    <td>'.$row["piel_circundante"].'</td>
                                        <td>'.$row["piel_color"].'</td><td>'.$c1.''.$c2.''.$c3.''.$c4.''.$c5.'</td>
                                            <td>'.$row["infeccion"].'</td>
                                                <td>'.$row["olor"].'</td>
                                                    <td>'.$row["dolor"].'</td>
              
                          </tr>';   
               
           
               
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