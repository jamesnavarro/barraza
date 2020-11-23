<?php
include('../../modelo/conexion.php');

//
?>
<H3>Reporte Detallado</H3>
<table class="table table-bordered table-condensed table-hover">
                               <thead>
                                   <?php if($_GET["usu"]==''){ ?>
                                     <tr bgcolor="#ecf0f5">
                                        <th>Item</th>
                                        <th>Usuario</th>
                                        <th>Fecha de Reporte</th>
                                        <th>Estados</th> 
                                        <th>Promedio</th> 
                                    </tr>
                                   
                                   <?php }else{ ?>
                                    <tr bgcolor="#ecf0f5">
                                        <th>Item</th>
                                        <th>Usuario</th>
                                        <th>Fecha de registro</th>
                                        <th>Orden Interna</th> 
                                        <th>Promedio</th> 
                                    </tr>
                                   <?php } ?>
                                </thead>
                                <tbody>
                            <?php
                            if($_GET["usu"]==''){
                                 $query = mysql_query("SELECT fecha_reg_ta,orden_servicio,a.user, b.nombre,b.apellido,a.estado, SUM(efectivo), COUNT(efectivo), (SUM(efectivo) / COUNT(efectivo)) AS promedio FROM actividad a, usuarios b WHERE a.user=b.usuario AND b.estado_empleado='Activo' AND fecha_reg_ta BETWEEN '".$_GET["f1"]."' AND '".$_GET["f2"]."' AND id_contacto>=98  GROUP BY b.usuario ORDER BY promedio DESC ");
                            }else{
                            $query = mysql_query("SELECT fecha_reg_ta,orden_servicio,a.user, b.nombre,b.apellido,a.estado, SUM(efectivo), COUNT(efectivo), (SUM(efectivo) / COUNT(efectivo)) AS promedio FROM actividad a, usuarios b WHERE a.user=b.usuario and a.user='".$_GET['usu']."' AND b.estado_empleado='Activo' AND fecha_reg_ta BETWEEN '".$_GET["f1"]."' AND '".$_GET["f2"]."' AND id_contacto>=98  GROUP BY a.orden_servicio ORDER BY promedio DESC ");
                            }
                            $c = 0;
                            $label = array();
                             $color = array();
                             $b = array();
                             $suma1=0;
                             $suma2=0;
                            while ($row = mysql_fetch_array($query)) {
                                
                                 if($_GET["usu"]==''){
                                     $label[$c] = $row['user'];
                                     $estado = $row['estado'];
                                    $fecha = $_GET['f1'].' al '.$_GET['f2']; 
                                 }else{
                                     $label[$c] = $row['orden_servicio'];
                                     $estado = $row['orden_servicio'];
                                      
                                       $fecha = $row['fecha_reg_ta'];
                                 } 
                                
                                $b[$c] = $row['promedio'];
                                $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                                $color[$c] = ('#'.$rand);
                                
                                $c++;
                                
                                 $suma1 +=$row['SUM(efectivo)'];
                                 $suma2 +=$row['COUNT(efectivo)'];
                                    echo '<tr>'
                                   . '<td>'.$c.'</td>'
                                   . '<td>'.$row['nombre'].' '.$row['apellido'].'</td>'
                                   . '<td>'.$fecha.'</td>'
                                   . '<td>'.$estado.'</td>'
                                   . '<td>'.number_format($row['promedio']).'%</td>';
                                 
                            }
                            $pro = $suma1 / $suma2;
                            echo '<tr><td>'.$c.'</td><td></td><td></td><td>Promedio</td><td>'.number_format($pro).'%</td>';
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
					label: 'Comparacion x Usuarios'
				}],
				labels: <?php echo $p[0] ?>
                            },
    options: {}
});
</script>