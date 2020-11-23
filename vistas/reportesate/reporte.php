<?php
include('../../modelo/conexion.php');
if($_GET['mes']!=''){
    $fechax = $_GET['ano'].'-'.$_GET['mes'];
}else{
    $fechax = $_GET['ano'];
}
if($_GET['emp']==''){
    $empresa = '';
}else{
    $empresa = ' and rips="'.$_GET['emp'].'" ';
}
if($_GET['emp']==''){
    $empresa_act = '';
}else{
    $empresa_act = ' and b.id_empresa="'.$_GET['emp'].'" ';
}
//
?>
<H3>Reporte Detallado</H3>
<table class="table table-bordered table-condensed table-hover">
                               <thead>
                                    <tr bgcolor="#ecf0f5">
                                        <th>Item</th>
                                        <th>Empresa</th>
                                        <th>Fecha de Reporte</th>
                                        <th>Estados</th> 
                                        <th>Cantidad</th> 
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                            $query = mysql_query("select * from sis_empresa where cliente='Si' $empresa ");
                            $c = 0;
                            $label = array();
                             $color = array();
                             $b = array();
                            while ($row = mysql_fetch_array($query)) {
                                 $result = mysql_query("SELECT orden_servicio,a.estado FROM actividad a, pacientes b WHERE a.id_paciente=b.id_paciente AND a.StartTime LIKE '".$fechax."%' and b.id_empresa like '%".$row['rips']."%' and a.user like '%".$_GET['usu']."%' and a.estado like '%".$_GET['est']."%' group by orden_servicio  ");
//                                 $can = mysql_fetch_array($result);
                                 $detalle = '<ul>';
                                 $acc=0;$bcc=0;$ccc=0;$d=0;
                                 while($x = mysql_fetch_array($result)){
                                     if($x['estado']=='No iniciada'){
                                         $acc++;
                                     }else if($x['estado']=='Completada'){
                                         $bcc++;
                                     }else{
                                         $ccc++;
                                     }
                                    
                                 }
                                  $detalle .= '<li>No iniciada...: '.$acc;
                                  $detalle .= '<li>Completada..: '.$bcc;
                                  $detalle .= '<li>Anulada.........: '.$ccc;
                                 $detalle .= '</ul>';
                                 $can  = mysql_num_rows($result);
                                 if($can!=0){
                                $label[$c] = $row['nombre_emp'];
                                $b[$c] = $can;
                                $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                                $color[$c] = ('#'.$rand);
                                
                                $c++;
                                
                                 
                                    echo '<tr>'
                                   . '<td>'.$c.'</td>'
                                   . '<td>'.$row['nombre_emp'].'</td>'
                                   . '<td>'.$fechax.'</td>'
                                   . '<td>'.$detalle.'</td>'
                                   . '<td>'.$can.'</td>';
                                 }
                            }
                            $p[0] = json_encode($label);
                            $p[1] = json_encode($b);
                            $p[2] = json_encode($color);


                            ?>
                            </tbody>
                                                       </table>
<hr>
<canvas id="myChart3"></canvas>
                        
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