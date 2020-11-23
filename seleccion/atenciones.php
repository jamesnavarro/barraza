<?php 
session_start();
include '../modelo/conexion.php';  ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Atenciones</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"><!-- Base Theme Color -->
    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"><!-- Boxed Background -->
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
    <script>
        $(document).ready(function(){
	 $('#tabla').dataTable();
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
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Lista de atenciones <?php echo $_SESSION['ide'].'' ?></h4>

                            </header>

                            <section id="collapse1" class="body collapse in">                      
                                <div class="body-inner">
                                   
                            <div class="tabbable" style="margin-bottom: 25px;">

                        

                                <div class="tab-content">

                                    <div class="" id="tab1">

                                         <!-- START Row -->

                    <div class="row-fluid">

                        <!-- START Datatable 2 -->

                        <div class="span12 widget lime">

                            

                            <section class="body">

                                <div class="body-inner no-padding">


<?php
$consul= "select * from sis_empresa where rips LIKE '".$_SESSION['ide']."'";                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$no=$fil['nombre_emp'];
$id=$fil['id_empresa'];
}
if(isset($_GET['codigo'])){
                     
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
      
	<?php }}else{
    echo 'id:'.$id;
$requestr=mysql_query('SELECT a.*, b.* FROM atenciones a, precios_atenciones b WHERE b.id_empresa="'.$id.'" and a.id_atencion=b.id_atencion group by a.id_atencion ');

if($requestr){
//    echo'<hr>';
    $table = '<table  class="table table-bordered table-striped table-hover" id="tabla">';

               $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre de atencionx'.'</th>';
               $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';

	while($rowr=mysql_fetch_array($requestr))
	{       
                
		$table = $table.'<tr><td><a href="../seleccion/atenciones.php?codigo='.$rowr["id_atencion"].'">'.$rowr["nombre_atencion"].'</a></td>
                   <td>'.$rowr['codigo_atencion'].'</td>
                                 </tr>';
               
	}
   
	$table = $table.'</table>';
        
	echo $table;
        
}
        }
?>
  
                                </div>

                            </section>

                        </div>

                    </div>

                                    </div>


                                </div>

                            </div><!--/ Normal Tabs -->

                                </div>

                            </section>

                        </div>

                    </div>

                            </section></div>
<?php
if(isset($_GET['add'])){

    if(isset($_POST["cant"]))
    {
        $n = $_POST["cant"];
        $c = 0;
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["id$x"])){
                $c += 1;
                include "../modelo/conexion.php";
  
        
            
                $sql = "INSERT INTO `producto_rep_ad` (`id_ref_ad`, `id_p`)";
            $sql.= "VALUES ('".$_POST["id$x"]."', '".$_GET['cod']."')";
            mysql_query($sql, $conexion);

            }
          
            }   
          
                        
 echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
echo "</script>";

            }}


?>
     <?php require '../vistas/script.php';  ?>
</body>
</html>