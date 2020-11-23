<?php
include('../../modelo/conexion.php');
$idm = $_GET['idm'];
$bod = $_GET['bod'];
$save= $_GET['save'];
if($bod=='1'){
    $sql = mysql_query("SELECT *, (b.nombre_insumo) as nn, (b.id) as cod, (a.codigo) as cd FROM movimientos_items a, insumos b where a.codigo=b.codigo and a.id_mov=$idm ");
}else{
    $sql = mysql_query("SELECT *, (b.nombre_medicamento) as nn, (b.id_medicina) as cod, (a.codigo) as cd  FROM movimientos_items a, medicamentos b where a.codigo=b.codigo_int and a.id_mov=$idm ");
}

$item = 0;
if(mysql_num_rows($sql)>0){
while($mostrar = mysql_fetch_array($sql)){
$item = $item+1;
if($save==0){
    if($mostrar['estado_mov']=='Ok'){
    $del = '<img src="../../imagenes/cancelar.png" onclick="delmov('.$mostrar['id_mi'].','.$mostrar['cant'].','.$mostrar['id_mov'].','.$mostrar['cod'].');">';
    }else{
        $del = '';
    }
}else{
     $del = '';
}
echo '<tr>
<td>'.$mostrar['id_mi'].'</td>
<td>'.$mostrar['cd'].'</td>
<td>'.$mostrar['nn'].'</td>
<td>'.$mostrar['cant'].'</td><td>'.$mostrar['costo'].'</td><td>'.$mostrar['cant_disponible'].'</td>'
. '<td>'.$mostrar['usuario'].'</td><td>'.$mostrar['f_mod'].'</td><td>'.$del.' '.$mostrar['estado_mov'].'</td>'; ?>
<!--<td><img src="../images/listacontacto.png"  onClick="ver_movimientos('<?php echo $mostrar['id_mov']; ?>')"></td>-->
</tr>
<?php }
}else{
echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
}
      ?>
                        
