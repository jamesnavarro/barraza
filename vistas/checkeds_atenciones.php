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
  date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
         $fecha = date("Y-m-d").' '.$hora;
            
                $sql = "INSERT INTO `precios_atenciones` (`id_atencion`, `id_empresa`, `precio`, `fecha_registro_pr`)";
            $sql.= "VALUES ('".$_POST["id$x"]."', '".$_GET['cod']."', '".$_POST["precio$x"]."', '".$fecha."')";
            mysql_query($sql, $conexion);

            }
          
            }   
          
                        
 echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
echo "</script>";

            }}else{


?>
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
    <title>IDB</title>
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
                <script type="text/javascript">
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>
</head>
<body>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Listado Insumos</h4>

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

                                    <form name="buscarA" action="../vistas/checkeds_atenciones.php?cod=<?php echo $_GET['cod'] ?>&add" method="post" enctype="multipart/form-data">
     <button type="submit"><img src="../imagenes/add.png"> Agregar</button> 
<?php
if(isset($_POST['producto'])){
 $request=mysql_query("SELECT * FROM producto a, sis_empresa b where producto like '%".$_POST['producto']."%' or referencia_p like '%".$_POST['producto']."%' or codigo like '%".$_POST['producto']."%' ");   
}else{
$request=mysql_query("SELECT * FROM `atenciones` ");
}
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
             $table = $table.'<th  width="10%">'.'Codigo'.'</th>';           
              $table = $table.'<th width="40%">'.'Descripción'.'</th>';   
              $table = $table.'<th width="20%">'.'Precio'.'</th>'; 
      
              $table = $table.'<th width="10%"><input type="checkbox" onclick="marcar(this);" /> Marcar/Desmarcar Todos</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $cont=0;
	while($row=mysql_fetch_array($request))
	{       
                  $cont=$cont+1;
                  $table = $table.'<tr>
                <td  width="10%">'.$row["codigo_atencion"].'</td>'
                          . '<td width="40%">'.$row['nombre_atencion'].'</a></td>
                  <td width="20%"><input type="text" name="precio'.$cont.'" style="width:80px"></td>
               <td width="10%"><input type="checkbox" value="'.$row["id_atencion"].'" name="id'.$cont.'"></td>
                   </tr>';   
     
	}
        
        
	$table = $table.'</table>';
        
	echo $table;
 
}?>
              <table>
                <tr>
                    <td><label><i></i></label> <input type="hidden" name="cant" readonly  style="width:20px;height:20px;"  value="<?php echo $cont; ?>"><button type="submit"><img src="../imagenes/add.png"> Agregar</button></td>
                </tr>
                
            </table>  

            </form> 
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

     <?php require '../vistas/script.php';  ?>
</body>
</html>
            <?php } ?>
