<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_caso.php';
header('Content-type: application/vnd.ms-word');
 header("Content-Disposition: attachment; filename=acta_".$_GET['cod'].".doc");
 header("Pragma: no-cache");
 header("Expires: 04");
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
    <title>Casos</title>
    <meta name="description" content="">
    <style>
        table{
              border-collapse: collapse; 
              border:1px #000 solid;
        }
        hgroup{
              border-collapse: collapse; 
              border:1px #000 solid;
        }
          
    </style>
   
</head>
<body>
    <h3 align="center">ACTA DE REUNION</h3>
    <hr><ul>
           
        <li>Radicado N° <?php echo $_GET['cod'] ?></li>
        <li>Asunto Tratado: <?php echo $asunto_cas ?></li>
        <li>Lugar:  <?php echo $prioridad_cas ?></li>
        <li>Fecha:  <?php echo $fecha_registro_caso ?></li>
        
    </ul>
   
    <hr>
     <h3 align="center">1. ASISTENTES</h3>
    <table border="1">
       
        <tr><th width="250px">NOMBRES</th><th width="100px">CARGOS</th><th width="100px">FIRMAS</th>
        <tr><td width="250px"><?php echo $tipo_cas ?></td><td width="100px"></td><td width="150px"></td>
         <tr><td><?php echo $tipo_cas2 ?></td><td width="50%"></td><td width="250px"></td>
         <tr><td><?php echo $tipo_cas3 ?></td><td width="50%"></td><td width="250px"></td>
        </table>
    <br>
     <h3 align="center">2. OBSERVACIONES</h3>
     <p align="justify"><?php echo $descripcion_cas ?></p>
      <br>
     <h3 align="center">3. COMPROMISOS</h3>
     <p align="justify"><?php echo $resolucion_cas ?></p>
</body>
</html>
