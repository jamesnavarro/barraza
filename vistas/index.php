<?php
session_start();
include "../modelo/conexion.php";
if(isset($_SESSION['k_username'])){
include "../modelo/consultar_permisos.php";
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
    if(isset($_GET['download'])){
$filename = $_GET['download'];
 // Ahora guardamos otra variable con la ruta del archivo
 $file = "../documentos/".$filename;
 // Aquí, establecemos la cabecera del documento
 header("Content-Description: Descargar imagen");
 header("Content-Disposition: attachment; filename=$filename");
 header("Content-Type: application/force-download");
 header("Content-Length: " . filesize($file));
 header("Content-Transfer-Encoding: binary");
 readfile($file);
 echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=formatos'";
echo "</script>"; 
    }
if(isset($_GET['oi'])){
    $_SESSION['oi'] = $_GET['oi'];
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
    <link rel="stylesheet" href="../assets/wysiwyg/cleditor/css/jquery.cleditor.min.css">
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
<!--    <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
    <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>-->
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
<!--    <script src="../js/ajax.js" type="text/javascript"></script>-->
    <script src="../js/funcion_global.js" type="text/javascript"></script>
    <script src="../js/funciones.js" type="text/javascript"></script>
    <link href="../vistas/doc.ico" type="image/x-icon" rel="shortcut icon" />
</head>
<body>
    <input type="hidden" id="tok" value="<?php echo $_SESSION['token']; ?>">
    <div id="wrapper" class="boxed-layout">
        <!-- START Template Canvas -->
        <div id="canvas">

            <div class="themer">
                <div class="header">
                   
                </div>
                
            </div>

            <?php     
  function usuarios_activos()
{
   $ip = $_SESSION['id_user'];
   $ahora = time();
   $limite = $ahora-5*60;
   $ssql = "delete from control_ip where fecha < ".$limite;
   mysql_query($ssql);
   $ssql = "select ip, fecha from control_ip where ip = '$ip'";
   $result = mysql_query($ssql);
   if (mysql_num_rows($result) != 0) $ssql = "update control_ip set fecha = ".$ahora." where ip = '$ip'";
   else $ssql = "insert into control_ip (ip, fecha) values ('$ip', $ahora)";
   mysql_query($ssql);
   $ssql = "select ip from control_ip";
   $result = mysql_query($ssql);
   while($usuarios = mysql_fetch_array($result)){
       $us = $usuarios['ip'];
   }
   mysql_free_result($result);
   return $us;
}
usuarios_activos();
            function dif($h1,$h2){
$h=((strtotime($h1)-strtotime($h2)))/3600;
$m=intval((($h)-intval($h))*60);
$s=intval((((($h)-intval($h))*60)-$m)*60);
return (intval($h)<10?'0'.intval($h):intval($h)).':'.($m<10?'0'.$m:$m).':'.($s<10?'0'.$s:$s);
}  
if($_GET['id']!='msg'){ 
                  include '../vistas/header.php'; 
                  include '../vistas/menu.php';
}
  
                  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                  $NumeroDeDias = 1;   
                  ?>


            <section id="main">
                <?php  if($_GET['id']!='msg'){  ?>
                <div class="navbar navbar-static-top">
                    <div class="navbar-inner">
                        <!-- Breadcrumb -->
                        <ul class="breadcrumb">
                            <li><a href="../vistas/?id=index">Pagina Principal</a> <span class="divider"></span></li>
                            <li class=""><a href="../vistas/?id=online">Lista de Usuarios</a> <span class="divider"></span></li>
<?php IF($_SESSION["area"]=='OFICINA'){  ?><li class=""><a href="../vistas/?id=pacientes_p">Alta Temprana <font color="red">(0)</font></a> <span class="divider"></span></li><?php } ?>
  
<?php IF($_SESSION["admin"]=='Si'){ ?> <a href="javascript:registros()"><img src="../imagenes/registros.png" title="registro de modificaciones"></a> <?php } ?>

                        </ul>
                        <!--/ Breadcrumb -->

                        <!-- Daterange Picker -->
                        <div id="reportrange" class="pull-right hidden-phone">
                            <span class="icon icon-calendar"></span>
                            <span id="rangedate"><?php echo "Hoy es ".$dias[date('w')].", ". date("Y-m-d");  ?></span><span class="caret"></span>
                        </div>
                        <!--/ Daterange Picker -->
                    </div>
                </div><?php  }  ?>
                <div class="container-fluid">
                    <?php  if($_GET['id']!='msg'){  ?>
                    <MARQUEE BGCOLOR="#FFFF00">
                    <?php
                    $cumple = mysql_query("select * from usuarios where estado_empleado='Activo' and descripcion!=''");
                    while($f = mysql_fetch_array($cumple)){
                         $nfecha = substr($f['descripcion'],-5,9);
                        if(date("m-d")==$nfecha) {
                            echo '<img src="../imagenes/cumple.png">Hoy es el cumpleaños de '.$f['nombre'].' '.$f['apellido'].'. Cel:'.$f['celular'].' ';
                        }
                    }
                     $cumplep = mysql_query("select * from pacientes where estado='ACTIVO'");
                    while($f = mysql_fetch_array($cumplep)){
                        $nfecha = substr($f['fecha_nacimiento'],-5,9);
                        if(date("m-d")==$nfecha) {
                            echo '<img src="../imagenes/cumple.png">Hoy es el cumpleaños del paciente  '.$f['nombres'].' '.$f['apellidos'].'.  ';
                        }
                
                    }
                 
                    
                    ?>
                  </MARQUEE>
                    <MARQUEE BGCOLOR="#FFFF00">
                    <?php
                   
                    
                    $noticias = mysql_query("select * from noticias where estado='Publicado'");
                    while($f = mysql_fetch_array($noticias)){
                        echo '<img src="../imagenes/noticia.png"> '.$f['noticia'];
                    }
                    
                    ?>
                  </MARQUEE>
                    <?php } ?>
                    <div class="row-fluid">
                    
                        
                        <?php 
                      
                        include '../controlador/index.php'; ?>
                       <div id="div1">

                        <?php
                             include '../vistas/mensajes.php';

                        $consultam= "SELECT * FROM mensajes where visto=0 and id_receptor='".$_SESSION['id_user']."'  ";                     
$resultm=  mysql_query($consultam);
while($fila=  mysql_fetch_array($resultm)){

                        echo '<div id="div3" class="gritter-data hidden" data-time="9000">';
                        echo '<span class="title"> Tienes un nuevo Mensaje</span>';
                        echo '<span class="text">Msg: '.$fila['contenido'].' enviado a las '.$fila['reg'].' </span>';
                         echo '</div>';
                      
}

                        ?>
                    <?php

?>
                   </div>
                    </div>

                </div>


            </section>

            <footer id="footer">
                <p>Desarrollado por Virtual Diseño S.A.S <?php echo date("Y-m-d H:m:s") ?></p>
                <a href="#" class="totop"><span class="icon icone-angle-up"></span></a>

            </footer>

        </div>

    </div>

<?php require '../vistas/script.php';  ?>
    <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
</body>
</html>
<?php  }else {header("location:../index.php");}  ?>