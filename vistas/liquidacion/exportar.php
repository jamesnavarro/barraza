<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$_GET['fi']."al".$_GET['ff'].".xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",true);
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Exportar a excel</title>
        <style>
            table {
                font-family: 'Arial';
                font-size: 13px;
            }
        </style>
         <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript" src="funciones.js"></script>
    </head>
    <body>
        <?php
        include '../../modelo/conexion.php';
        ?>
        <table class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                <th>Liq.</th>
                                <th>Orden</th>
                                <th>Paciente</th>
                                <th>Profesional</th>
                                <th>Atencion</th>
                                <th>Pend.</th> 
                                <th>Cant.</th> 
                                <th>Valor</th> 
                                <th>Total</th>
                                <th>Fecha inicial</th>
                                <th>Fecha Final</th>
                                <th>Fecha Registro</th>
                            </thead>
                            <?php
        $sqld = mysql_query('SELECT * FROM liquidaciones a, usuarios b where a.usuario=b.usuario and a.fecha_registro between "'.$_GET['fi'].'" and "'.$_GET['ff'].'" ');
        $a=date("H:i").':00';
        $cont=0;
        $sum = 0;
        $sum2 = 0;
        
	while($row=mysql_fetch_array($sqld))
	{       
            $pa = mysql_query("select * from actividad where orden_servicio='".$row["orden"]."' limit 1 ");
            $p = mysql_fetch_array($pa);
            $paciente = substr($p['Subject'],12);
            $cont = $cont + 1;  
            echo '<tr><td>'.$row["id_liq"].'</td>'
                   . '<td>'.$row["orden"].'</td>'
                   . '<td>'.$paciente.'</td>
                      <td>'.$row["nombre"].' '.$row["apellido"].'</td>'
                   . '<td>'.$row["atencion"].'</font></td>'
                   . '<td>'.$row["pendientes"].'</font></td>'
                   . '<td>'.$row["cantidad"].'</font></td>'
                   . '<td>'.$row["valor"].'</font></td>
                      <td>'.$row["total"].'</td><td>'.$row["fechain"].'</td>'
                   . '<td>'.$row["fechafi"].'</td>'
                   . '<td>'.$row["fecha_registro"].'</td></tr>';
                 
	}
			
                                    
                                    ?>
                              
                            </table>
    </body>
</html>
