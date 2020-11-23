<?php
session_start();
include "../modelo/conexion.php";
if(isset($_SESSION['k_username'])){
if(isset($_GET['archivo'])){
$filename = $_GET['archivo'];
 // Ahora guardamos otra variable con la ruta del archivo
 $file = "../archivos/".$filename;
 // Aquí, establecemos la cabecera del documento
 header("Content-Description: Descargar imagen");
 header("Content-Disposition: attachment; filename=$filename");
 header("Content-Type: application/force-download");
 header("Content-Length: " . filesize($file));
 header("Content-Transfer-Encoding: binary");
 readfile($file);
 echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_hv&cod=".$_GET['cod']."'";
echo "</script>"; 
    }
  
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <!-- START META SECTION -->
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CRM</title>
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
</head>
<body>
    <div id="wrapper" class="boxed-layout">
        <!-- START Template Canvas -->
        <div id="canvas">

            <div class="themer">
                <div class="header">
                   
                </div>
                
            </div>

            <?php 
                  include '../vistas/header.php'; 
                
                  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                  $NumeroDeDias = 1; 
                  ?>


    
                <!-- START Bootstrap Navbar -->
                
              
                    <!-- START Row -->
                   
                        <!-- START Page/Section header -->
                        <?php
                        
                        echo '<h3>Contacto : '.$_GET['nombre'].'</h3>';
                        $request=mysql_query("SELECT * FROM actividad where id_contacto=".$_GET['cod']." and estado='Completada' ");
  
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              
              $table = $table.'<th width="2%"></th>';
           
              $table = $table.'<th width="30%">'.'Asunto'.'</th>';
              
              $table = $table.'<th width="10%">'.'Estado'.'</th>';
              $table = $table.'<th  width="10%">'.'Fecha de Inicio'.'</th>';
              $table = $table.'<th width="10%">'.'Fecha de Vencimiento'.'</th>';
              $table = $table.'<th width="10%">'.'Asignado a.'.'</th>';
         

              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
            $sql1 = "SELECT * FROM clientes where id_cli=".$row['id_contacto']."";
                $fila1 =mysql_fetch_array(mysql_query($sql1));
                $id_cliente = $fila1["id_cli"];$nombre_cli = $fila1["nombre_cli"];
                if($row['tarea']=='Tarea'){
                    $icon='<img src="../imagenes/tarea.png">';$ver ='tarea';
                }else if($row['tarea']=='Llamada'){
                    $icon='<img src="../imagenes/1.png">';$ver ='llamada';
                }else if($row['tarea']=='Reunion'){
                    $icon='<img src="../imagenes/reuniones.png">';$ver ='reunion';
                }else{
                    $icon='<img src="../imagenes/nota.png">';$ver ='nota';
                }
            $table = $table.'<tr>
                <td width="2%">'.$icon.'</td>
                    
                        <td width="30%">'.$row["Subject"].', <b>Desc: </b><i>'.$row["Description"].'</i></td>
                   
                
                    <td width="10%">'.$row["tarea"].': '.$row["estado"].'<font></a></td>
               <td width="10%">'.$row["StartTime"].'</font></td><td width="10%">'.$row["EndTime"].'</font></td><td width="10%">'.$row["user"].'</font></td>
                          </tr>';   
      
	}
        
        
	$table = $table.'</table>';
        
	echo $table;
      
} 
                        ?>
   
                       
   

            <footer id="footer">
                <p>Desarrollado por Virtual Diseño S.A.S</p>
                <a href="#" class="totop"><span class="icon icone-angle-up"></span></a>

            </footer>

        </div>

    </div>

<?php require '../vistas/script.php';  ?>
</body>
</html>
<?php  }else {header("location:../index.php");}  ?>