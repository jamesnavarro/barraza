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
<script src="../popup/consentimientos/funciones.js"></script>
<script language="javascript" type="text/javascript">
function pasar(){
   window.opener.pasar_consentimiento(document.getElementById('cod').value,document.getElementById('in').value);
   window.close();
}
</script>

         
</head>
<body onload="javascript:pasar();">
    <div>
        <h3>Consentimientos Informados</h3>
    </div>
                            


<?php

include "../modelo/conexion.php";
     if(isset($_GET['codigo'])){
                     
     $request2=mysql_query('SELECT * FROM consentimientos WHERE id_consentimiento="'.$_GET['codigo'].'"');
     while($row2=mysql_fetch_array($request2))
	{     
          
              $a = $row2["id_consentimiento"];



              
           ?>
    

    <input type="text" name="alm1" id="cod" readonly value="<?php echo $a ?>" />
     <input type="text" name="alm1" id="in" readonly value="<?php echo $_GET['in'] ?>" />


<a href="" title="pasar valor" onload="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
     <?php }

        }else{
         include '../modelo/conexion.php';
         ?>
Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Codigo o Descripcion"><input type="hidden" id="in" value="<?php echo $_GET['in'] ?>"><br>

<div class="datagrid" id="empleados">
    <?php        include '../popup/consentimientos/mostrar_tabla.php';  ?>
            
            
       </div>
                  
        <?php } ?>                    
</body>
</html>

         

                              
                                