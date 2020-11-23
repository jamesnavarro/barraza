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
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../js/jquery.js"></script>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../popup/servicios/funciones.js"></script>
<script language="javascript" type="text/javascript">
function pasar(cod,desc,valor){
   window.opener.pasar_atencion(cod,desc,valor);
   window.close();
}
</script>

         
</head>
<body>
    <div>
        <h3>Lista de servicios</h3>
    </div>
<?php
include "../modelo/conexion.php";
         ?>
Buscar:<input type="text" id="buscar" autofocus placeholder="Buscar Servicio" value="">
Tipo <select id="tipo">
<option value="3">Servicios</option>
<option value="1">Procedimiento</option>
<option value="2">Consulta</option>
                                                               </select><br>
<div class="datagrid" id="empleados">
    <?php       
//    include '../popup/atenciones/mostrar_tabla.php';
    ?>
            
            
       </div>
                 
</body>
</html>

         

                              
                                