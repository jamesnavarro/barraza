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
    </head>
    <body>
        
<h1>Indicadores Koala</h1>
<fieldset>
    <legend><h4>Atenciones x empresas año <?php echo $_GET['a'] ?></h4></legend>

<div id="dibujo3"></div>
<canvas id="myChart3"></canvas> 
<br><hr>
</fieldset>
<fieldset>
    <legend>Número total de pacientes atendió por empresa </legend>
    Empresa : 
    <select id="empresa" onchange="pacientes_empresas()">
        <option>Seleccione</option>
        <?php
        $query = mysql_query("select * from sis_empresa where cliente='Si'");
        while ($row = mysql_fetch_array($query)) {
            echo '<option value="'.$row['rips'].'">'.$row['nombre_emp'].'</option>';
        }
        
        
        ?>
    </select>
    <label>Año</label> <input type="number" id="ano" value="<?php echo date("Y") ?>"  onchange="pacientes_empresas()">

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
<?php
         $ano = $_GET['a'];
                   $query = mysql_query("select * from sis_empresa where cliente='Si'");
                   $a = array();
                   $b = array();
                   $c = 0;
                        while ($row = mysql_fetch_array($query)) {
                         $emp = $row['rips']; 
                         $query2 = mysql_query("SELECT a.id_paciente, fecha_reg_ta FROM pacientes a, actividad b WHERE a.id_paciente=b.id_paciente AND a.id_empresa='".$emp."' AND b.fecha_reg_ta LIKE '".$ano."%' GROUP BY orden_servicio ");
                          $num = mysql_num_rows($query2);
                          if($num>0){
                          $b[$c] = $num;
                          $a[$c] = $row['simbolo_emp']; 
                          $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                          $d[$c] = ('#'.$rand);
                          $c++;
                          }
                        
                    }
                    $p = array();
                    $p[0] = json_encode($a);
                    $p[1] = json_encode($b);
                    $p[2] = json_encode($d);
                  

?>
<script>

var ctx2 = document.getElementById('myChart3').getContext('2d');
var chart = new Chart(ctx2, {
    type: 'bar',
    data: 	
	{
				datasets: [{
					 data: <?php echo $p[1] ?>,
					backgroundColor: <?php echo $p[2] ?>,
					label: 'Comparacion x empresas'
				}],
				labels: <?php echo $p[0] ?>
                            },
    options: {}
});
</script>
</body>
</html>
