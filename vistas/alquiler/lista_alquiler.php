<?php
include "../../modelo/conexion.php";
$ano = $_GET['ano'];
$mes = $_GET['mes'];
$orden = $_GET['orde'];
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$regimen = $_GET['regimen'];
$estado = $_GET['estado'];
$documento = $_GET['documento'];
$empresa = $_GET['empresa'];
$fecha = $ano.'-'.$mes;
if($estado==''){
    $estado='En proceso';
}else{
    $estado='Completada';
}
$requestp=mysql_query('SELECT b.id_paciente FROM equipos_asig a, ordenes b, pacientes c WHERE c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.estado_ord="'.$estado.'" and b.fecha_registro like "'.$fecha.'%" and c.nombres like "%'.$nombre.'%" and c.apellidos like "%'.$apellido.'%" and c.numero_doc like "%'.$documento.'%"  and c.id_empresa like "%'.$empresa.'%" and c.regimen like "%'.$regimen.'%"  and a.autorizacion like "'.$orden.'%"  group by b.id_paciente ');

$c = mysql_num_rows($requestp);
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if($requestp){
	$num_items = $c;
}else{
	$num_items = 0;
}
$rows_by_page = 20;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
echo '<tr><td colspan="11">';
if($page>1){?>
<a href="javascript:void(0);" onclick="alquiler_new(1)"><img src="../images/a1.png"></a>
	<a href="javascript:void(0);" onclick="alquiler_new(<?php echo $page - 1;?>)"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="javascript:void(0);" onclick="alquiler_new(<?php echo $page + 1;?>)"><img src="../images/p1.png"></a>
	<a href="javascript:void(0);" onclick="alquiler_new(<?php echo $last_page;?>)"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
echo 'Cantidad de registro: '.$c;
?>
</td></tr>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
$request=mysql_query('SELECT *, max(b.fecha_registro) as a, max(b.fecha_final) as b FROM equipos_asig a, ordenes b, pacientes c WHERE c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.estado_ord ="'.$estado.'" and b.fecha_registro like "'.$fecha.'%" and c.nombres like "%'.$nombre.'%" and c.apellidos like "%'.$apellido.'%" and c.numero_doc like "%'.$documento.'%"  and c.id_empresa like "%'.$empresa.'%" and c.regimen like "%'.$regimen.'%"  and a.autorizacion like "'.$orden.'%"  group by b.id_paciente  order by a desc '.$limit);
 $cont = 0;
 $table='';
 while($row=mysql_fetch_array($request))
	{    
     $cont = $cont + 1 ;
         $ver='<a href="../vistas/?id=alquileres_pac&codigo='.$row["id_paciente"].'">';
         $b='<a href="../form_editar/formulario_editar_alquiler.php?codigo='.$row["id_equipo_a"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';
         $c='<a href="../vistas/alquiler_proceso.php?eliminar='.$row["id_equipo_a"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';
            
           
           $color='';
           if($row["orden"] =='Pendiente'){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='';}
            if($row["regimen"]==''){$r= "Sin Asignar";}
           if($row["regimen"]=='1'){$r= "Contributivo";}
            if($row["regimen"]=='2'){$r= "Subsidiado";}
            if($row["regimen"]=='3'){$r="Vinculado";}
            if($row["regimen"]=='4'){$r= "Particular";}
            if($row["regimen"]=='5'){$r= "Otro";}
            if($row["regimen"]=='7'){$r= "Desplazado con afilación al regimen Contributivo";}
            if($row["regimen"]=='8'){$r="Desplazado con afilación al regimen Subsidiado";}
            if($row["regimen"]=='9'){$r= "Desplazado no asegurado";}
            if($row["regimen"]=='NO APLICA'){$r=$row["regimen"];}
            $mes = $row["a"];
             $t = substr("$mes",-5, 2);
             if($t == date("01")){$m = 'Enero';}
             if($t == date("02")){$m = 'Febrero';}
             if($t == date("03")){$m = 'Marzo';}
             if($t == date("04")){$m = 'Abril';}
             if($t == date("05")){$m = 'Mayo';}
             if($t == date("06")){$m = 'Junio';}
             if($t == date("07")){$m = 'Julio';}
             if($t == date("08")){$m = 'Agosto';}
             if($t == date("09")){$m = 'Septiembre';}
             if($t == date("10")){$m = 'Octubre';}
             if($t == date("11")){$m = 'Noviembre';}
             if($t == date("12")){$m = 'Diciembre';}
            
           if($row["autorizacion"]=='Pendiente'){$aut = '<font color="purple">Pendiente';}else{$aut = $row["autorizacion"];}
           $table = $table.'<tr>'
                            . '<td>'.$color.''.$row["numero_doc"].'</td>'
                            . '<td>'.$ver.''.$color.''.$row["nombres"].' '.$row["apellidos"].' '.$row["apellido2"].'<font></a></td>'
                            . '<td>'.$color.''.$r.'</td>'
                            . '<td>'.$row["autorizacion"].'</td>'
                            . '<td>'.$color.''.$row["a"].' al '.$row["b"].'</td>'
                            . '<td>'.$m.'</td>'
                            . '<td>'.$row["estado_ord"].'</td>'
                            . '<td>'.$color.''.$row["facturado"].'</td>'
                            . '<td>'.$b.'</td>'
                            . '<td>'.$c.'</td>'
                            . '<td><input type="checkbox" name="valor'.$cont.'" value="'.$row["id_paciente"].'"></td></tr>';
}
$table = $table.'<tr><td colspan="11" style="text-align:right"><i>Total de Archivos: </i><input type="text" name="cant"  style="width:20px;height:20px;"  value="'.$cont.'"><input type="submit" name="buscar" value="Repetir" class="alt_btn">';

echo $table;