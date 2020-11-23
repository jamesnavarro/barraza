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
    <!--/ END META SECTION -->

    <!-- START STYLESHEET SECTION -->
    <!-- Stylesheet(Bootstrap) -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-responsive.min.css">
    <!--/ Stylesheet(Bootstrap) -->

    <!-- Stylesheet(Application) -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" id="base-color" href="css/color/lime.css"><!-- Base Theme Color -->
    <link rel="stylesheet" id="base-bg" href="css/background/bg1.css"><!-- Boxed Background -->
    <!--/ Stylesheet(Application) -->

    <!-- Stylesheet(Plugins) -->
    <link rel="stylesheet" href="assets/jui/css/jquery-ui-1.9.2.min.css">
    <link rel="stylesheet" href="assets/snippet/css/jquery.snippet.min.css">
    <link rel="stylesheet" href="assets/scrollbar/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="assets/icheck/css/jquery.icheck.min.css">
    <link rel="stylesheet" href="assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/minicolor/css/jquery.minicolors.min.css">
    <link rel="stylesheet" href="assets/wysiwyg/CLEditor/css/jquery.cleditor.min.css">
    <link rel="stylesheet" href="assets/formvalidation/validationengine/css/jquery.validationEngine.min.css">
    <link rel="stylesheet" href="assets/tagit/css/jquery.tagit.min.css">
    <link rel="stylesheet" href="assets/fullcalendar/css/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/prettyphoto/css/prettyphoto.min.css">
    <link rel="stylesheet" href="assets/datatable/css/dataTables-bootstrap.min.css">
    <link rel="stylesheet" href="assets/switch/css/bootstrapSwitch.min.css">
    <link rel="stylesheet" href="assets/daterangepicker/css/daterangepicker.min.css">
    <link rel="stylesheet" href="assets/bootstrap-fileupload/css/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="assets/gritter/css/jquery.gritter.min.css">
    <link rel="stylesheet" href="assets/themer/css/jquery.themer.min.css">
    <!--/ Stylesheet(Plugins) -->
    <!--/ END STYLESHEET SECTION -->

    <!-- START JAVASCRIPT SECTION - Load only modernizr script here -->
    <!-- Javascript(Modernizr) -->
    <script src="assets/modernizr/js/modernizr-2.6.2.min.js"></script>
    <!--/ Javascript(Modernizr) -->
    <!--/ END JAVASCRIPT SECTION -->
</head>
<body>
    <!-- START Template Wrapper -->
    <!-- If you want to enable the fixed header, just add `.fixed-header` class to the `#wrapper` div below -->
    <div id="wrapper">
        <!-- START Template Canvas -->
        <div id="canvas">
            <!-- START Themer -->
            <!-- You can remove this. For demo purpose only -->
            <div class="themer">
                <div class="header">
                    <span class=""></span>
                </div>
                <div class="body">
                    <div class="header">
                        <label>
                            <input type="checkbox" data-toggle="boxedlayout" value="boxed-layout"> Boxed Layout
                        </label>
                    </div>
                    <div class="header">
                        <label>
                            <input type="checkbox" data-toggle="fixedheader" value="fixed-header"> Fixed Header
                        </label>
                    </div>
                    <div class="header">
                        <label>
                            <input type="checkbox" data-toggle="fixedsidebar" value="fixed-sidebar"> Fixed Sidebar
                        </label>
                    </div>
                    <hr/>
                    <ul class="color">
                   
                    </ul>
                    <hr/>
                    <ul class="background">
                        <li class="bg1 active" data-style="bg1"></li>
                        <li class="bg2" data-style="bg2"></li>
                        <li class="bg3" data-style="bg3"></li>
                        <li class="bg4" data-style="bg4"></li>
                        <li class="bg5" data-style="bg5"></li>
                    </ul>
                </div>
            </div>
            <!--/ END Themer -->

            <!-- START Content -->
            <div class="container-fluid">
                <!-- START Row -->
                <div class="row-fluid">
                    <!-- START Login Widget Form -->
                    <p>&nbsp;</p>
                    
                    <form class="widget stacked teal widget-login" name="login" action="index_1.php?lost=ok" method="post">
                        <section class="body">
                            <div class="body-inner">
                               
                                
                                <!-- Avatar -->
                                <div class="">
                                    <span class="mask"></span>
                                    <img src="imagenes/crm.jpg">
                                 
                                </div><!--/ Avatar -->
                                <br>
                                <!-- Username -->
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="text" name="correo" placeholder="Email" class="span12" required><i class="icon-user input-icon"></i>
                                    </div>
                                </div><!--/ Username -->

                                <!-- Password -->
           
                                <div class="control-group">
                                    <div class="controls">
                                        
                                    </div>
                                </div><!--/ Checkbox -->

                                <!-- Register Link -->
                                <div class="control-group">
                                    <div class="controls">
                                        <a href="index.php">Regresar</a>
                                    </div>
                                </div><!--/ Register Link -->
                                  <!-- Register Link -->
                                <div class="control-group">
                                    <div class="controls">
                                       Restablece tu contraseña, por favor digita tu email
                                    </div>
                                </div><!--/ Register Link -->
                            </div>
                            <!-- Form Action -->
                            <!-- Place out form `.body-inner` -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                               
                            </div>
                            <!--/ Form Action -->
                        </section>
                    </form>
                    <!--/ END Login Widget Form -->
                  
                </div>
                <!--/ END Row -->
            </div>
            <!--/ END Content -->
            
        </div>
        <!--/ END Template Canvas -->
    </div>
    <!--/ END Template Wrapper -->

    </body>
    </html>
<?php
if(isset($_GET['lost'])){
    
    $correo = $_POST["correo"];
 include "modelo/conexion.php";   
    $sql1 = "SELECT * FROM usuarios where email='".$correo."'";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$b = $fila1["id_user"];
$email = $fila1["email"];
$user = $fila1["usuario"];
$c = $fila1["celular"];

if(isset($b)){
    echo $user. ', Dentro de unos momentos recibira un correo con la nueva Contraseña , Si no aparece en la bandeja de entrada
        verifique en correos no deseados Gracias .'; 

        $password= $b.'vd'.$c;
        $sql2 = "UPDATE `usuarios` SET `password`='".md5($password)."' WHERE  `usuario`='".$user."'";
        mysql_query($sql2);
        //espacio para enviar correo
             echo '<script lanquage="javascript">alert("Se ha envido un correo a la sgte direccion '.$_POST["correo"].',");location.href="index.php"</script>'; 

$nombre = 'Virtual Diseno';
$mail = 'virtualdiseno.com';


$header = 'From: ' . $mail . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$mensaje = "Este mensaje fue enviado por " . $nombre . " \r\n";
$mensaje .= "Su e-mail es: " . $email . " \r\n";
$mensaje .= "Su contraseña restablecida es: " . $password . " \r\n";
$mensaje .= "Enviado el " . date('d/m/Y', time());

$para = $email;
$asunto = 'Recuperacion de Password VD ';

mail($para, $asunto, utf8_decode($mensaje), $header);
     
        //fin de envio de correo
}else{
     echo '<script lanquage="javascript">alert("Este email no esta registrado en el sistema, por favor comunicate con el administrador del sistema '.$_POST["correo"].'");location.href="index.php"</script>'; 
}}