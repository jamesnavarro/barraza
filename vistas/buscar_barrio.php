<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>buscar por</title>
    
<!-- indispensable para cargar municipios-->
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
    <script src="../vistas/funciones_usuarios.js" type="text/javascript"></script>
  
</head>
<body>
<div>
     <input type="text" id="barrio_usuario" placeholder="nombre"/>
     <input type="hidden" id="dept" value="<?php echo $_GET['dept'] ?>"/>
     <input type="hidden" id="munp" value="<?php echo $_GET['munp'] ?>"/>
      
</div>
    <br>
 
      <div id="mostrar_tabla"> 
                       
      </div>                         
 
                     
                             
                 
</body>
</html>
        <?php require '../vistas/script.php';  ?>

         

                              
                                
