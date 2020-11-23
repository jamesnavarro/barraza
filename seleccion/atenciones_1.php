<?php 
session_start(); ?>
<head>
    <!-- START META SECTION -->
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>IDB</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"><!-- Base Theme Color -->
<!--    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"> Boxed Background -->
    <link rel="stylesheet" href="../assets/jui/css/jquery-ui-1.10.3.min.css">
    <link rel="stylesheet" href="../assets/snippet/css/jquery.snippet.min.css">
    <link rel="stylesheet" href="../assets/scrollbar/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="../assets/icheck/css/jquery.icheck.min.css">
    <link rel="stylesheet" href="../assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="../assets/minicolor/css/jquery.minicolors.min.css">
    <link rel="stylesheet" href="../assets/wysiwyg/CLEditor/css/jquery.cleditor.min.css">
    <link rel="stylesheet" href="../assets/formvalidation/validationengine/css/jquery.validationEngine.min.css">
    <link rel="stylesheet" href="../assets/tagit/css/jquery.tagit.min.css">
    <link rel="stylesheet" href="../assets/fullcalendar/css/fullcalendar.min.css">
    <link rel="stylesheet" href="../assets/prettyphoto/css/prettyphoto.min.css">
    <link rel="stylesheet" href="../assets/datatable/css/dataTables-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/switch/css/bootstrapSwitch.min.css">
    <link rel="stylesheet" href="../assets/daterangepicker/css/daterangepicker.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-fileupload/css/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="../assets/gritter/css/jquery.gritter.min.css">
    <link rel="stylesheet" href="../assets/themer/css/jquery.themer.min.css">
    <script src="../assets/modernizr/js/modernizr-2.6.2.min.js"></script>
<!-- indispensable para cargar municipios-->
    <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
    <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
    <link href="../vistas/doc.ico" type="image/x-icon" rel="shortcut icon" />

 <script>
$(document).ready(function(){
	$('#tabla').dataTable();
        $('#tabla2').dataTable();
        $('#tabla3').dataTable();
        $('#tabla4').dataTable();
        $('#tabla5').dataTable();
        $('#tabla6').dataTable();
        //tablas asignadas para las ordenes
        $('#tabla7').dataTable();
        $('#tabla8').dataTable();
        $('#tabla9').dataTable();
        $('#tabla10').dataTable();
});
</script>

<script language="javascript" type="text/javascript">
function pasar(){
    window.opener.datos2(document.getElementById('datos1').value, document.getElementById('datos2').value, document.getElementById('datos3').value);
    window.close();
}
</script>
</head>
<body onload="javascript:pasar();">
    <section id="main">
      <div class="container-fluid">
                    <!-- START Row -->
                    <div class="row-fluid">
<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
 $a=date("H:i").':00';
$request=mysql_query('select count(*) from atenciones');
 
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 10;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}$_SESSION['foi'] = $_POST;
?>
<?php include "../modelo/conexion.php";
$consul= "select * from sis_empresa where rips LIKE '%".$_SESSION['ide']."%'";                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$no=$fil['nombre_emp'];
$id=$fil['id_empresa'];
}
?>

     <?php if(isset($_GET['codigo'])){
                     
                     $request=mysql_query('SELECT a.*, b.* FROM atenciones a, precios_atenciones b WHERE b.id_empresa="'.$id.'" and a.id_atencion=b.id_atencion and a.id_atencion="'.$_GET['codigo'].' group by a.id_atencion"');
                     while($row=mysql_fetch_array($request))
	{     echo '<h3>atencion Seleccionada :'.$row["nombre_atencion"];
          
              $x = $row["codigo_atencion"];
              $y = $row["nombre_atencion"];
              $z = $row["precio"];
              
           ?>
    

<input type="text" name="datos1" id="datos1" readonly value="<?php echo $y ?>" />
<input type="text" name="datos2" id="datos2" readonly value="<?php echo $x ?>" />
<input type="text" name="datos3" id="datos3" readonly value="<?php echo $z ?>" />



<a href="" title="pasar valor" onload="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
	<?php }}else{ ?>
			<header><h3>Lista de atenciones</h3></header>
                        
             
                                    <div>
                                    <h4>Busqueda de atencion</h4>
                             
                                                
                                    
                                                        
				    </div>
                                    <div class="row-fluid">
    <section class="body">
        <div class="body-inner">
                                    
            <?php
if($page>1){?>
	<a href="../seleccion/atenciones.php?page=1"><img src="../images/a1.png"></a>
	<a href="../seleccion/atenciones.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../seleccion/atenciones.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../seleccion/atenciones.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if (isset($_POST["bus_nombre"])){
      $nom =$_POST["bus_nombre"];
      $ape =$_POST["bus_apellido"];
   
//$consulta= "select * from sis_contacto WHERE `nombre_cont`='".$_POST["bus_nombre"]."'";
$request=mysql_query("SELECT a.*, b.* FROM atenciones a, precios_atenciones b WHERE b.id_empresa='".$id."' and a.id_atencion=b.id_atencion and a.nombre_atencion LIKE '%".$nom."%' and a.codigo_atencion LIKE '%".$ape."%' order by a.id_atencion asc ".$limit."");
if($request){
//    echo'<hr>';
    $table = '<table class="lista">';


               $table = $table.'<thead>';
              $table = $table.'<tr>';
            $table = $table.'<th>'.'Nombre de atencion'.'</th>';
               $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Precio x Empresa'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';


	
        
	//Por cada resultado pintamos una linea
//        require '../modelo/consulta_empresa.php';
	while($row=mysql_fetch_array($request))
	{       
      $table = $table.'<tr><td><a href="../seleccion/atenciones.php?codigo='.$row["id_atencion"].'">'.$row["nombre_atencion"].'</a></td>
                   <td>'.$row['codigo_atencion'].'</td>
                       <td>$'.$row['precio'].'</td>
                                    </tr>';
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
}else {
    

$request=mysql_query('SELECT a.*, b.* FROM atenciones a, precios_atenciones b WHERE b.id_empresa="'.$id.'" and a.id_atencion=b.id_atencion group by a.id_atencion '.$limit);

if($request){
//    echo'<hr>';
    $table = '<table  class="table table-bordered table-striped table-hover" id="tabla7">';

               $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre de atencion'.'</th>';
               $table = $table.'<th>'.'Codigo'.'</th>';
               $table = $table.'<th>'.'Precio x Empresa'.'</th>';


              
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
		$table = $table.'<tr><td><a href="../seleccion/atenciones.php?codigo='.$row["id_atencion"].'">'.$row["nombre_atencion"].'</a></td>
                   <td>'.$row['codigo_atencion'].'</td>
                                    <td>$ '.$row['precio'].'</td></tr>';
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}

        }
?>
        </div>
   </section>
        </div>                                       
          </div></div>                
				</div>
                       
		</section><?php } ?>

<?php require '../vistas/script.php';  ?>
</body>
</html>