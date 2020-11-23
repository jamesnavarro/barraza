<?php
include '../../modelo/conexion.php';
if($_GET['numero']!=''){
	$numero = '  and a.numero_factura like "'.$_GET['numero'].'%" ';
}else{
	$numero = '';
}
if($_GET['pac']!=''){
	$paciente = ' ';
}else{
	$paciente = '';
}
if($_GET['ape']!=''){
	$ape = ' ';
}else{
	$ape = '';
}
if($_GET['mes']!=''){
        if($_GET['dia']!=''){
            $dia = $_GET['dia'];
        }else{
            $dia = '';
        }
        $fec = $_GET['ano'].'-'.$_GET['mes'].'-'.$dia;
	$fecha = '  and a.fecha_registro like "'.$fec.'%" ';
}else{
	$fecha = '';
}
if($_GET['empresa']!=''){
	$empresa = ' and a.id_empresa like "'.$_GET['empresa'].'%" ';
}else{
	$empresa = '';
}
if($_GET['tipo']==0){
    $tipo = '';
}else{
    if($_GET['tipo']==1){
        $tipo='and a.cod_alquiler="alquiler" ';
    }else{
        if($_GET['tipo']==3){
           $tipo=' and a.cod_alquiler="ventas" ';
        }else{
           $tipo=' and a.cod_alquiler="" '; 
    }}
        }
$request=mysql_query('select count(*), sum(a.total) from facturas a, sis_empresa b where a.id_empresa!="" and  a.id_empresa=b.rips and a.factura_anulada=0 and a.pago_pendiente="No" and a.tipo in ("FAC") '.$numero.' '.$fecha.' '.$tipo.' '.$empresa.' '.$paciente.' '.$ape.' ');
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
        $totalf = $request[1];
}else{
	$num_items = 0;
}
$rows_by_page = 30;
$last_page = ceil($num_items/$rows_by_page);
if($_GET['page']){
	$page = $_GET['page'];
}else{
	$page = 1;
}
      if($page>1){?>
	<a href="javascript:void(0)"  onclick="facturas(1);"><img src="../images/a1.png"></a>
	<a href="javascript:void(0)" onclick="facturas(<?php echo $page - 1;?>);"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="javascript:void(0)" onclick="facturas(<?php echo $page + 1;?>);"><img src="../images/p1.png"></a>
	<a href="javascript:void(0)" onclick="facturas(<?php echo $last_page;?>);"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> 
        <?php
}
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
 

$request=mysql_query('select *, (a.fecha_registro) as fecha from facturas a, sis_empresa b where a.id_empresa!="" and a.id_empresa=b.rips and a.factura_anulada=0 and a.pago_pendiente="No"  '.$numero.' '.$fecha.' '.$tipo.' '.$empresa.' '.$paciente.' '.$ape.' order by a.numero_factura  desc '.$limit);

if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'# '.$_GET['t'].'*</th>';
              $table = $table.'<th>'.$_GET['empresa'].'</th>';
              $table = $table.'<th>'.'Empresa'.'</th>';
              $table = $table.'<th>'.'Tipo'.'</th>';
              $table = $table.'<th>'.'Total'.'</th>';
              $table = $table.'<th>'.'Fecha de Registro'.'</th>';
              $table = $table.'<th>'.'Exp. Siigo'.'</th>';
               
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              
 
             
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 //$table = $table.'<tr><td colspan="8">select a.*, (a.fecha_registro) as fecha from facturas a, sis_empresa b where a.id_empresa=b.rips and a.factura_anulada=0 and a.pago_pendiente="No"  '.$numero.' '.$fecha.' '.$tipo.' '.$empresa.' '.$paciente.' '.$ape;
             
 
        $suma='';$cantidad=0;
	while($row=mysql_fetch_array($request))
	{     $cantidad += 1;
            
                    $ver2='<a href="../vistas/?id=facturacion_bloque&fact='.$row["numero_factura"].'&t='.$row["tipo"].'">';$tipo ='<font color="red">Atencion</font>';
            
            
           if($ver_prod='Habilitado'){$ver='<a href="../vistas/?id=ver_paciente&cod='.$row["id_paciente"].'">';}else{$ver='';}
          
           $c='<a target="_blank" href="../php-mysql.php?imprimir='.$row["numero_factura"].'&t='.$row["tipo"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a>';
            
         
         
           
           $suma = $suma + $row["total"];
           $table = $table.'<tr><td>'.$ver2.''.$row["numero_factura"].'<font></a></td>
               <td>-</td>'
                   . '<td>'.$row["nombre_emp"].'<font></a></td>'
                   . '<td>'.$tipo.'<font></a></td>'
                   . '<td>'.number_format($row["total"]-$row["copagos"]).'<font></a></td>
               <td>'.$row["fecha"].'<font></a></td>'
                   . '<td><a href="#" onclick="Down('.$row["numero_factura"].')">Descargar</a>
                   
                       
                           </tr>';
	}
        $table = $table.'</table>';
       echo $table;
        
}                      
?>

       
        
        <table>
                                            <tr>
                                                
                                           
                                                <td>Cantidad de Facturas :</td>
                                                <td> <?php echo number_format($num_items)  ?> | </td>
                                                <td> Total de Ventas :</td>
                                                <td>$ <?php echo number_format($totalf)  ?></td>
                                            </tr>
                                            
                                        </table>
