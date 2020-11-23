<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Medicinas</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../js/jquery.js"></script>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../popup/insumos/funciones.js"></script>
<script language="javascript" type="text/javascript">
function pasar(){
   window.opener.pasar_med(
   document.getElementById('codigo_int').value,
   document.getElementById('nombre').value,
   document.getElementById('stock').value);
   window.close();
}
</script>

         
</head>
<body onload="javascript:pasar();">
    <div>
        <h3>Lista de Insumos</h3>
    </div>
                            


<?php

include "../modelo/conexion.php";
     if(isset($_GET['codigo'])){
                     
     $request2=mysql_query('SELECT * FROM insumos WHERE codigo="'.$_GET['codigo'].'"');
     while($row2=mysql_fetch_array($request2))
	{     
          
              $a = $row2["codigo"];
              $b = $row2["nombre_insumo"];
              $c = $row2["cant_disponible"];


              
           ?>
    

    <input type="text" name="alm1" id="codigo_int" readonly value="<?php echo $a ?>" />
    <input type="text" name="alm2" id="nombre" readonly value="<?php echo $b ?>" />
    <input type="text" name="alm1" id="stock" readonly value="<?php echo $c ?>" />

<a href="" title="pasar valor" onload="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
     <?php }

        }else{
         include '../modelo/conexion.php';
         ?>
Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Cedula ó Nombre"><br>

<div class="datagrid" id="empleados">
    <?php        include '../popup/insumos/mostrar_tabla.php';  ?>
            
            
       </div>
                  
        <?php } ?>                    
</body>
</html>

         

                              
                                