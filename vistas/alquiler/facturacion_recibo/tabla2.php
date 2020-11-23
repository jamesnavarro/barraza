<?php 
include '../vistas/alquiler/facturacion_recibo/consulta.php';
 ?>
<?php 
if(isset($_GET['fact'])){  
?>
        <article class="module width_full">
            <?php 
                if(isset($_GET['fact'])){              
                    $request2=  mysql_query('select a.*, b.* from equipos_asig a, alquiler b where a.cod_equipo=b.codigo and a.numero_orden_a="'.$arch.'"');
                    if($request2){
                        $table = '<table class="table table-bordered table-striped table-hover" id="">';
                        $table = $table.'<thead>';
                        $table = $table.'<tr>';
                        $table = $table.'<th>'.'Codigo'.'</th>';
                        $table = $table.'<th>'.'Descripcion'.'</th>';
                        $table = $table.'<th>'.'cantidad'.'</th>';
                        $table = $table.'<th>'.'Meses'.'</th>';
                        $table = $table.'<th>'.'Fecha de Inicio'.'</th>';
                        $table = $table.'<th>'.'Fecha Final'.'</th>';
                        $table = $table.'<th>'.'Precio x Unid.'.'</th>';
                        $table = $table.'<th>'.'Neto a Pagar.'.'</th>';
                        $table = $table.'</tr>';
                        $table = $table.'</thead>';
                        //Por cada resultado pintamos una linea
                        $t2=0;
                        while($row=mysql_fetch_array($request2)){       
                            $st2=$row['precio_a']*$row['cantidad']*$row['meses'];
                            $t2=$t2+$st2;
                            $table = $table.'<tr><td>'.$row["cod_equipo"].'</td><td>'.$row['nombre'].'</td><td>'.$row['cantidad'].
                            '</td>
                            <td>'.$row['meses'].'</td>
                            <td>'.$row['fecha_a'].'</td>
                            <td>'.$row['fecha_f'].'</td><td>'.$row['precio_a'].'</td><td>'.$row['precio_a']*$row['cantidad']*$row['meses'].'</td></tr>';
                        }
                        $table = $table.'</table>';
                        echo $table;
                        $total=$t2;
                        $iva=$total*0.16;
                        $subto=$total-$iva;
                    }
            ?>
            <br>
            <table class="table table-bordered table-striped table-hover" id="">
                <tr>
                    <td><label>Pago Realizado:</label></td>
                    <td>$ <?php echo $copagos; ?></td>

                </tr>
                <tr>
                    <td><label>Neto Pagar:</label></td>
                    <td>$ <?php echo $valor; ?></td>
                </tr>
                <tr>
                    <td><label>Total Neto Pagar:</label></td>
                    <td>$ <?php echo $valor - $copagos; }?></td>
                </tr>
            </table>
	</article>
    <?php  
}
    if(isset($_GET['factura'])){  ?>
        <article class="module width_full">
            <?php            
            $request=  mysql_query('select * from venta_libre where numero_factura="'.$_GET['factura'].'"');
            if($request){
                $table = '<table class="table table-bordered table-striped table-hover" id="">';
                $table = $table.'<thead>';
                $table = $table.'<tr>';
                $table = $table.'<th>'.'Codigo'.'</th>';
                $table = $table.'<th>'.'Descripcion'.'</th>';
                $table = $table.'<th>'.'cantidad'.'</th>';
                $table = $table.'<th>'.'Precio x Unid.'.'</th>';
                $table = $table.'<th>'.'Neto a Pagar.'.'</th>';
                $table = $table.'</tr>';
                $table = $table.'</thead>';
                //Por cada resultado pintamos una linea
                 $t1=0;
                while($row=mysql_fetch_array($request)){       
                    $st1=$row['precio']*$row['cantidad'];
                    $t1=$t1+$st1;
                    $table = $table.'<tr><td>'.$row["codigo"].'</td><td>'.$row['descripcion'].'</td><td>'.$row['cantidad'].
                    '</td><td>'.$row['precio'].'</td><td>'.$row['precio']*$row['cantidad'].'</td></tr>';
                }
                $table = $table.'</table>';
                echo $table;
                $total=$t1;
                $iva=$total*0.16;
                $subto=$total-$iva;
            }
            ?>
            <table class="table table-bordered table-striped table-hover" id=""> 
                <tr>
                    <td><label>Subtotal:</label></td>
                    <td>$ <?php echo $subto; ?></td>
                </tr>
                <tr>
                    <td><label>Iva 16%:</label></td>
                    <td>$ <?php echo $iva; ?></td>
                </tr>
                <tr>
                    <td><label>Total a Pagar:</label></td>
                    <td>$ <?php echo $total; //}?></td>
                </tr>
            </table>
	</article>
    <?php 
    }