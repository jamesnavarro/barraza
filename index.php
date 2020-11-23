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
    <link rel="stylesheet" href="assets/wysiwyg/cleditor/css/jquery.cleditor.min.css">
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
        <link href="vistas/doc.ico" type="image/x-icon" rel="shortcut icon" />
    <!--/ Stylesheet(Plugins) -->
    <!--/ END STYLESHEET SECTION -->

    <!-- START JAVASCRIPT SECTION - Load only modernizr script here -->
    <!-- Javascript(Modernizr) -->
    <script src="assets/modernizr/js/modernizr-2.6.2.min.js"></script>
    <script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="js/funcion_global.js" type="text/javascript"></script>
    <script src="js/funciones.js" type="text/javascript"></script>
</head>
<body>
    <!-- START Template Wrapper -->
    <!-- If you want to enable the fixed header, just add `.fixed-header` class to the `#wrapper` div below -->
    <div id="wrapper">
        <!-- START Template Canvas -->
        <div id="canvas">
         

            <!-- START Content -->
            <div class="container-fluid">
                <!-- START Row -->
                <div class="row-fluid">
                    <!-- START Login Widget Form -->
                    <p>&nbsp;</p>
                    
                    <form class="widget stacked teal widget-login" name="login" action="validar.php" method="post">
                        <section class="body">
                            <div class="body-inner">
                               
                                
                                <!-- Avatar -->
                                <div class="">
                                    <span class="mask"><center><i>BIENVENIDOS A</i></center></span>
                                    <center><img src="imagenes/koalav2.png" style="width: 150px"></center>
                                    
                                 
                                </div><!--/ Avatar -->
                                <br>
                                <!-- Username -->
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="text" name="username" placeholder="Usuario" class="span12" autofocus autocomplete="off" required><i class="icon-user input-icon"></i>
                                    </div>
                                </div><!--/ Username -->

                                <!-- Password -->
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="password" name="password" placeholder="Password" class="span12" required><i class="icon-lock input-icon"></i>
                                    </div>
                                </div><!--/ Password -->

                                <!-- Checkbox -->
                                <div class="control-group">
                                    <div class="controls">
                                        
                                    </div>
                                </div><!--/ Checkbox -->

                                <!-- Register Link -->
                                <div class="control-group">
                                    <div class="controls">
<!--                                        <a href="index_1.php">¿Olvidaste la contraseña?</a>-->
                                    </div>
                                </div><!--/ Register Link -->
                            </div>
                            <!-- Form Action -->
                            <!-- Place out form `.body-inner` -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                                <button type="button" class="btn">Cancelar</button>
                            </div>
                           <div>
                                <span class="mask"><center><i>Licencia Exclusiva para</i></center></span>
                                      <center><img src="imagenes/idb.png" style="width: 150px"></center>
                            </div>
                        </section>
                        <input type="hidden" id="tok" name="tok">
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
