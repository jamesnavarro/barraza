<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=movimientos.xls");
?>
<!DOCTYPE html>
<html>
<body>
<table>
                    <thead>
                                     <tr  BGCOLOR="#C3D9FF">
                                        <th># Mov.</th>
                                        <th>Doc.</th>
                                        <th>Tipo</th>
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Costo.</th>
                                        <th>Cant.</th>
                                        <th>Stock</th>
                                        <th>User</th>
                                        <th>Fecha Mod.</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                 <?php
include('../../modelo/conexion.php');
$mov = $_GET['mov'];
$bod = $_GET['bod'];
$pro= $_GET['pro'];
$use= $_GET['use'];
$fi= $_GET['fi'];
$ff= $_GET['ff'];
$est= $_GET['est'];
$doc= $_GET['doc'];
$rep= $_GET['rep'];
$tip= $_GET['tip'];
$st= $_GET['st'];
$con= $_GET['con'];
if($st==1){
if($mov!=''){$m = ' and c.id_operaciones='.$mov.' ';}else{$m = '';}
if($use!=''){$u = ' and a.usuario like "%'.$use.'%" ';}else{$u = '';}
if($fi!='' && $ff!=''){$f = ' and a.f_mod>="'.$fi.' 01:00:00" and a.f_mod<="'.$ff.' 23:00:00" ';}else{$f = '';}
if($bod=='1'){
    if($pro!=''){$p = ' and b.nombre_insumo like "%'.$pro.'%" ';}else{$p = '';}
    if($rep=='Agrupado'){
           $grupo = ' group by nombre_insumo asc';
    }else{
           $grupo = '';
    }
    $sql = mysql_query("SELECT *, (b.nombre_insumo) as nn, (b.id) as cod,(a.codigo) as cd FROM movimientos_items a, insumos b, movimientos c where c.orden_servicio like '%$doc%' and a.estado_mov like '%$est%' and a.id_mov=c.id_mov and a.codigo=b.codigo $m $p $u $f $grupo ");
}else{
    if($rep=='Agrupado'){
           $grupo = ' group by nombre_medicamento asc';
    }else{
           $grupo = ' ';
    }
    if($pro!=''){$p = ' and b.nombre_medicamento like "%'.$pro.'%" ';}else{$p = '';}
    $sql = mysql_query("SELECT *, (b.nombre_medicamento) as nn, (b.id_medicina) as cod,(a.codigo) as cd FROM movimientos_items a, medicamentos b , movimientos c where  c.orden_servicio like '%$doc%' and  a.estado_mov like '%$est%' and  a.id_mov=c.id_mov and a.codigo=b.codigo_int $m $p $u $f $grupo ");
}

$item = 0;
if(mysql_num_rows($sql)>0){
    $c = 0; $s = 0;
while($mostrar = mysql_fetch_array($sql)){
$item = $item+1;
$c +=$mostrar['cant'];
$s +=1;
    if($rep=='Agrupado'){
           $con = mysql_query("select sum(cant), costo from movimientos_items a, movimientos c where  a.id_mov=c.id_mov and a.codigo='".$mostrar['cd']."' $f $m ");
           $re = mysql_fetch_array($con);
           $cant = $re['sum(cant)'];
           $costo = $re['costo'];
           $est = 'Mix';
    }else{
            $cant = $mostrar['cant'];
            $est = $mostrar['estado_mov'];
            $costo = $mostrar['costo'];
    }
    
echo '<tr>
<td>'.$mostrar['id_mov'].'</td>
<td>'.$mostrar['orden_servicio'].'</td>
<td>'.$mostrar['id_operaciones'].'</td>
<td>'.$mostrar['cd'].'</td>
<td>'.$mostrar['nn'].'</td>
    <td>'.$costo.'</td>
<td>'.$cant.'</td><td>'.$mostrar['cant_disponible'].'</td>'
. '<td>'.$mostrar['usuario'].'</td><td>'.$mostrar['f_mod'].'</td><td> '.$mostrar['estado_mov'].'</td>'; ?>
</tr>

<?php }
echo '<tr><td>'.$s.'</td><td>-</td><td>-</td><td>-</td><td>-</td><td>'.$c.'</td><td></td><td>-</td><td>-</td><td>-</td></tr>';
}else{
echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
}
}  else {
    if($fi!='' && $ff!=''){$f = ' and a.f_mod>="'.$fi.' 01:00:00" and a.f_mod<="'.$ff.' 23:00:00" ';}else{$f = '';}
    if($mov!=''){$m = ' and c.id_operaciones='.$mov.' ';}else{$m = '';}
    if($use!=''){$u = ' and a.usuario like "%'.$use.'%" ';}else{$u = '';}
    if($con=='1'){$can = ' and cant_disponible!=0 ';}else{$can = ' and cant_disponible=0 ';}
    if($bod=='1'){
        //insumos
        if($pro!=''){$p = ' b.nombre_insumo like "%'.$pro.'%" ';}else{$p = '';}
            $sql = mysql_query("SELECT *,(codigo) as cd, (nombre_insumo) as nn FROM insumos  where nombre_insumo like '%".$pro."%' $can ");
    }else{
        //medicamentos
            $sql = mysql_query("SELECT *,(codigo_int) as cd, (nombre_medicamento) as nn FROM medicamentos  where nombre_medicamento like '%".$pro."%' $can  ");
    }
    //tabla
    $item = 0;
if(mysql_num_rows($sql)>0){
    $c = 0; $s = 0;
while($mostrar = mysql_fetch_array($sql)){
$item = $item+1;
$c +=$mostrar['cant'];
$s +=1;

           $con = mysql_query("select *, sum(cant) from movimientos_items a, movimientos c where  a.id_mov=c.id_mov and a.codigo='".$mostrar['cd']."' $f $m $u ");
           $re = mysql_fetch_array($con);
           $cant = $re['sum(cant)'];
           $est = 'Mix';

    
echo '<tr>
<td>'.$re['id_mov'].'</td>
<td>'.$re['orden_servicio'].'</td>
<td>'.$re['id_operaciones'].'</td>
    
<td>'.$mostrar['cd'].'</td>
<td>'.$mostrar['nn'].'</td>
<td>'.$re['costo'].'</td>
<td>'.$cant.'</td><td>'.$mostrar['cant_disponible'].'</td>'
. '<td>'.$re['usuario'].'</td><td>'.$re['f_mod'].'</td><td> '.$re['estado_mov'].'</td>'; ?>
</tr>

<?php }
echo '<tr><td>'.$s.'</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>'.$c.'</td><td></td><td>-</td><td>-</td><td>-</td></tr>';
}else{
echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
}
    
}
      ?>
  </table>
</body>
</html>
                        
