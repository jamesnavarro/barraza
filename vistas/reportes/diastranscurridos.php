<?php
include "../../modelo/conexion.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"> 
        <title>Reportes</title>
        <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="../../js/chart.js?v=3"></script>
        <style>
            .body{
                size: 10px;
            }
        </style>
    </head>
    <body>
        
<h1>Indicadores Koala</h1>

<fieldset>
    <legend>Días transcurrido desde la fecha de inicio vs fecha evolucion </legend>
    Profesional : 
    <select id="usuario" style="width:200px">
        <option value="">Seleccione</option>
        <?php
        $query2 = mysql_query("select * from usuarios where estado_empleado='Activo'");
        while ($row = mysql_fetch_array($query2)) {
            echo '<option value="'.$row['usuario'].'">'.$row['nombre'].' '.$row['apellido'].'</option>';
        }
        
        
        ?>
    </select>
    Empresa : 
    <select id="empresa" style="width:170px">
        <option value="">Seleccione</option>
        <?php
        $query = mysql_query("select * from sis_empresa where cliente='Si'");
        while ($row = mysql_fetch_array($query)) {
            echo '<option value="'.$row['rips'].'">'.$row['nombre_emp'].'</option>';
        }
        
        
        ?>
    </select>
    <label>Año</label> <input type="number" id="ano" value="<?php echo date("Y") ?>"  style="width:50px">
    <select id="mes" style="width:50px">
        <option value="0">Todos</option>
        <?php
          for($i=1;$i<=12;$i++){
              $num = str_pad($i, 2, "0", STR_PAD_LEFT);
              echo '<option value="'.$num.'">'.$num.'</option>';
          }
        ?>
    </select>
    <button  onclick="BuscarDias()">Consultar</button> 
<h4>Pacientes Registrado x año</h4>
<div id="mostrar_reporte1"></div>
<div id="dibujo"></div>
<hr>
<br>
<h4>Atenciones x año</h4>
<div id="mostrar_reporte2"></div>
<div id="dibujo2"></div>
</fieldset>
<hr>
<br>


<br>
<script src="funciones.js?<?php echo rand(1,100) ?>"></script>
</body>
</html>
