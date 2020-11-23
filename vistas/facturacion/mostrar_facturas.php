<?php
include '../../modelo/conexion.php';
if($_GET['numero']!=''){
	$numero = '  and numero_factura like "'.$_GET['numero'].'%" ';
}else{
	$numero = '';
}
if($_GET['est']==''){
	$numero = '  and estado = "" ';
}else{
	$numero = '  and estado = "OLD" ';
}

if($_GET['mes']!=''){
        if($_GET['dia']!=''){
            $dia = $_GET['dia'];
        }else{
            $dia = '';
        }
        $fec = $_GET['ano'].'-'.$_GET['mes'].'-'.$dia;
	$fecha = '  and fecha_registro like "'.$fec.'%" ';
}else{
	$fecha = '';
}
if($_GET['empresa']!=''){
	$empresa = '  and id_empresa like "'.$_GET['empresa'].'%" ';
}else{
	$empresa = '';
}
if($_GET['tipo']==0){
    $tipo = '';
}else{
    if($_GET['tipo']==1){
        $tipo='and cod_alquiler="alquiler" ';
    }else{
        if($_GET['tipo']==3){
           $tipo=' and cod_alquiler="ventas" ';
        }else{
           $tipo=' and cod_alquiler="" '; 
    }}
        } 
$request3=mysql_query("select count(*), sum(total) from facturas  where numero_factura!=0 ".$numero.' '.$fecha.' '.$empresa.' ');
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if($request3){
	$req = mysql_fetch_row($request3);
	$num_items = $req[0];
        $totalf = $req[1];
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
 

$request=mysql_query('select * from facturas  where numero_factura!=0 '.$numero.' '.$fecha.' '.$empresa.' order by numero_factura  desc '.$limit);

if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'# '.$_GET['t'].'*</th>';
              $table = $table.'<th>'.'Paciente'.'</th>';
              $table = $table.'<th>'.'Empresa'.'</th>';
              $table = $table.'<th>'.'Tipo'.'</th>';
              $table = $table.'<th>'.'Total'.'</th>';
              $table = $table.'<th>'.'Fecha de Registro'.'</th>';
              $table = $table.'<th>'.'Exp. Siigo'.'</th>';
               
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 
        $suma='';$cantidad=0;
	while($row=mysql_fetch_array($request))
	{     $cantidad += 1;
        
            
            if($row["id_paciente"]=='0'){
               if($row["cod_alquiler"]=='alquiler'){
                     $ver2='<a href="../vistas/?id=facturacion_bloque_alq&fact='.$row["numero_factura"].'&t='.$row["tipo"].'">';$tipo ='<font color="blue">Alquiler</font>';
                }else{
                     $ver2='<a href="../vistas/?id=facturacion_bloque&fact='.$row["numero_factura"].'&t='.$row["tipo"].'&est='.$row["estado"].'">';$tipo ='<font color="red">Atencion</font>';
                }
            }else{
                if($row["cod_alquiler"]=='alquiler'){
                        $ver2='<a href="../vistas/?id=facturacion_2&fact='.$row["numero_factura"].'&t='.$row["tipo"].'">';$tipo ='<font color="blue">Alquiler</font>';
                }else{
                    if($row["cod_alquiler"]=='ventas'){
                    $ver2='<a href="../vistas/?id=facturacion_v&fact='.$row["numero_factura"].'&t=FAC">';$tipo ='<font color="black">Ventas</font>';
                }else{
                        $ver2='<a href="../vistas/?id=facturacion_finalizada&fact='.$row["numero_factura"].'&t='.$row["tipo"].'">';$tipo ='<font color="red">Atencion</font>';
                }
                }
            }
           if($ver_prod='Habilitado'){
               if($row["id_paciente"]=='0'){
                   $ver='';
               }else{
                   $ver='<a href="../vistas/?id=ver_paciente&cod='.$row["id_paciente"].'">';
               }
               
           }else{$ver='';}
          
           $c='<a target="_blank" href="../php-mysql.php?imprimir='.$row["numero_factura"].'&t='.$row["tipo"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a>';
            $queryempresa = mysql_query("select nombre_emp from sis_empresa where rips='".$row["id_empresa"]."' ");
            $e = mysql_fetch_array($queryempresa);
            
             $querypea= mysql_query("select nombres,apellidos,apellido2,id_empresa from pacientes where id_paciente='".$row["id_paciente"]."' ");
            $p = mysql_fetch_array($querypea);
         
           //$error = mysql_query("UPDATE facturas SET id_empresa='".$p["id_empresa"]."' where id_paciente='".$row["id_paciente"]."' ") or die(mysql_error());
            
           $suma = $suma + $row["total"];
           $table = $table.'<tr><td>'.$ver2.''.$row["numero_factura"].'<font> </a></td>
               <td>'.$ver.''.$p["nombres"].' '.$p["apellidos"].' '.$p["apellido2"].' '.$row["id_empresa"].'</font></td>'
                   . '<td title="">'.$e["nombre_emp"].'<font></a></td>'
                   . '<td>'.$tipo.'<font></a></td>'
                   . '<td>'.number_format($row["total"]-$row["copagos"]).'<font></a></td>
               <td>'.$row["fecha_registro"].'<font></a></td>'
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
