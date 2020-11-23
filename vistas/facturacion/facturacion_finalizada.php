<?php 
include "../modelo/conexion.php";
 require '../modelo/consultar_permisos.php';
if(isset($_GET['copiar'])){
    
    $query = mysql_query("select * from actividad where relacionado=".$_GET['fact']." group by orden_servicio ");
    while($r = mysql_fetch_array($query)){
                $sql1 = "SELECT MAX(orden_servicio) as id FROM actividad";
                $fila1 =mysql_fetch_array(mysql_query($sql1));
                $orden = $fila1["id"]+1;
                $result = mysql_query("select * from actividad where orden_servicio='".$r['orden_servicio']."' ");
                while($c = mysql_fetch_array($result)){
                    
                mysql_query("INSERT INTO `actividad` (`obs`, `Subject`, `Location`, `Description`, `StartTime`, `EndTime`, `IsAllDayEvent`, `Color`, `RecurringRule`, `estado`, `prioridad`, `relacionado`, `id_seleccionado`, `id_contacto`, `id_empresa`, `user`, `tarea`, `duracion`, `aviso`, `fecha_reg_ta`, `fecha_mod_ta`, `id_paciente`, `orden_servicio`, `orden_externa`, `porcentaje`, `inf_adicional`, `precio_total`, `cant`, `cod_aten`, `PA`, `PULSO`, `FR`, `Valoracion`, `cant_med`, `cant_ins`, `anexo`, `archivo`, `est_motivo`, `desc_motivo`, `positivo`, `negativo`, `por_ext`, `editar`, `cada`, `vencimiento`, `firms`)"
                        . " VALUES ('".$c[1]."', '".$c[2]."', '".$c[3]."', '".$c[4]."', '".$c[5]."', '".$c[6]."', '".$c[7]."', '".$c[8]."', '".$c[9]."', '".$c[10]."', 'activa', '', '".$c[13]."', '".$c[14]."', '".$c[15]."', '".$c[16]."', '".$c[17]."', '".$c[18]."', '".$c[19]."', '".$c[20]."', '".$c[21]."', '".$c[22]."', '".$orden."', '".$c[24]."', '".$c[25]."', '".$c[26]."', '".$c[27]."', '".$c[28]."', '".$c[29]."', '".$c[30]."', '".$c[31]."', '".$c[32]."', '".$c[33]."', '".$c[34]."', '".$c[35]."', '".$c[36]."', '".$c[37]."', '".$c[38]."', '".$c[39]."', '".$c[40]."', '".$c[41]."', '".$c[42]."', '".$c[43]."', '".$c[44]."', '".$c[45]."', '".$c[46]."')");
                
                
                }   
                $insumos= mysql_query("select * from insumos_asignados where rel_atencion='".$r['orden_servicio']."' ");
                while($i = mysql_fetch_array($insumos)){
                    mysql_query("INSERT INTO `insumos_asignados` (`rel_atencion`, `numero_orden`, `cod_insumo`, `cantidad`, `cant_usada`, `cant_restante`, `sub_precio`, `fecha_asignacion`, `asignado_a`, `autorizacion`, `inf_adicional`, `fecha_registro`, `facturado`, `AfecInv`)"
                            . " VALUES ('".$orden."', '".$i[2]."', '".$i[3]."', '".$i[4]."', '".$i[5]."', '".$i[6]."', '".$i[7]."', '".$i[8]."', '".$i[9]."', '".$i[10]."', '".$i[11]."', '".$i[12]."', '', '".$i[14]."')");
                }
                echo '<script>alert("se copio '.$orden.'");</script>';
    }
    
}
?>
<!doctype html>
<html lang="en">

<head>
	<script> 
    function Down(fact){
        window.open('../vistas/archivo_siigo.php?f='+fact,'Form','width=500, height= 200');
    }
    </script>
          <script> 
var ventana_secundaria 

function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/pagos.php","miventana","width=500,height=200,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>
	
</head>
          
<?php 

$consulta= "select * from inf_empresa";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){

$web_emp=$fila['web_emp'];
$nombre_emp=$fila['nombre'];
$nit_emp=$fila['nit_emp'];
$tel_1=$fila['telefono_1'];
$tel_3=$fila['telefono_3'];
$fact_1=$fila['factura_inicial'];
$fact_2=$fila['factura_final'];
$dir_emp=$fila['direccion'];
$email_emp=$fila['email'];

}
if(isset($_GET['fact'])){
$consulta2= "select *, a.estado from actividad a, pacientes b, sis_empresa c where a.relacionado='".$_GET['fact']."' and a.tipo_factura='".$_GET['t']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.relacionado";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){

$orden_int=$fila['orden_servicio'];
$orden_ext=$fila['orden_externa'];
$nombre_seguro=$fila['nombre_emp'];
$nit_seguro=$fila['nit_emp'];
$telefono_seguro=$fila['tel_oficina_emp'];
$direccion_seguro=$fila['direccionr_emp'];
$nombre_paciente=$fila['nombres'].' '.$fila['nombre2'].' '.$fila['apellidos'].' '.$fila['apellido2'];
$cedula_paciente=$fila['numero_doc'];
$diagnostico=$fila['enfermedad'];
$enfermedad=$fila['descripcion_enf'];
$archivo=$fila['archivo'];
$rips=$fila['rips'];$id_empresa=$fila['id_empresa'];

}}
//////////

//////////

$resultf=  mysql_query("select * from facturas where numero_factura='".$_GET['fact']."' and tipo= '".$_GET['t']."' ");
$ffa=  mysql_fetch_array($resultf);

$id_fac=$ffa['id_factura'];
$_SESSION['idfact']=$id_fac;
$num_fact=$ffa['numero_factura'];
$forma_pago=$ffa['forma_pago'];
$me=$ffa['meses'];
$fv=$ffa['fecha_ven'];
$inf=$ffa['informacion'];
$fr=$ffa['fecha_registro'];
$p=$ffa['pago_pendiente'];

$copagos=$ffa['copagos'];
$fi=$ffa['fechai'];
$ff=$ffa['fechaf'];
$estad= $ffa['estado'];


 ?>		
<article class="module width_full">

<form name="insertar_empresa"  class="span12 widget shadowed dark form-horizontal bordered"  action="../modelo/editar_pago_1.php?editar=<?php echo $_GET['fact']; ?>&t<?php echo $_GET['t']; ?>" method="post" enctype="multipart/form-data">
    <header>
        <h4 class="title"><?php echo $_GET['t'] ?> # : <?php echo $_GET['fact'] ?></h4>
        <?php 
    if($editar_fac=='Habilitado'){ 
        ?>
        <a href="../vistas/?id=facturacion_autorizacion&factura=<?php echo $_GET['fact'] ?>&t=<?php echo $_GET['t'] ?>"><img src="../imagenes/estrella.png"></a>
        
        <?php 

    } ?>
        <a href="../vistas/?id=history&cod=<?php echo $id_empresa; ?>"  target="_blank"><img src="../imagenes/ventas.png"></a>
         <a href="#" onclick="Down(<?php echo $_GET['fact'] ?>)"><img src="../imagenes/siigo.png"></a>
         
    </header>
    <hr>                        
     <a href="../vistas/?id=facturas"> 
           <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a>
    <a target="_blank" href="../php-mysql.php?imprimir=<?php echo $_GET['fact'] ?>&t=<?php echo $_GET['t'] ?>&estado=<?php echo $estad ?>">
    <input type="button" name="bo" value="Imprimir"/> 
    </a>   
        <a href="../vistas/?id=facturacion_finalizada&fact=<?php echo ($_GET['fact']-1) ?>">  << Ant </a> Page  <a href="../vistas/?id=facturacion_finalizada&fact=<?php echo ($_GET['fact']+1) ?>">   Sig >> </a>
    <hr>
    <div class="module_content"> 

        <?php if(isset($_GET['fact'])){  ?>
    
        <table class="table table-bordered table-striped table-hover" id=""> 
            <tr>
                <td><label>Empresa:</label></td>
                <td><?php echo "$nombre_seguro"; ?></td>
                <td><label>Dirección:</label></td>
                <td><?php echo "$direccion_seguro"; ?></td>
            </tr>
            <tr>
                <td><label>Nit:</label></td>
                <td><?php echo "$nit_seguro"; ?></td>
                <td><label>Telefono:</label></td>
                <td><?php echo "$telefono_seguro"; ?></td>
            </tr>
        </table>
        <table class="table table-bordered table-striped table-hover" id=""> 
            <tr>
                <td><label>Paciente:</label></td>
                <td><?php echo "$nombre_paciente"; ?></td>
                <td><label># Documento:</label></td>
                <td><?php echo "$cedula_paciente"; ?></td>
                <td><label>archivo:</label></td>
                <td><?php echo "$orden_int"; ?></td>
            </tr>
            <tr>
                <td><label>Historia Clinica:</label></td>
                <td><?php echo ""; ?></td>
                <td><label>Diagnostico:</label></td>
                <td><?php echo "$enfermedad"; ?></td>
                <td></td>
                <td></td>
            </tr>
        </table> 
            
        <?php }if(isset($_GET['factura'])){ ?>
        <table class="table table-bordered table-striped table-hover" id="">
            <tr>
                <td><label>Cliente:</label></td>
                <td><?php echo "$cliente"; ?></td>
                <td><label>C.C ó Nit:</label></td>
                <td><?php echo "$numero_doc"; ?></td>
            </tr>
            <tr>
                <td><label>Telefeno:</label></td>
                <td><?php echo "$telefono"; ?></td>
                <td><label>Direccion:</label></td>
                <td><?php echo "$direccion"; ?></td>
            </tr>
        </table>
        <?php } ?>
        <table class="table table-bordered table-striped table-hover" id=""> 
            <tr>
                <td><label>Forma de Pago:</label></td>
                <td><?php echo "$forma_pago"; ?> a <?php echo "$me"; ?> Mes(es)</td>
                <td><label></label></td>
                <td></td>
            </tr>
            <tr>
                <td><label>Fecha Vencimiento:</label></td>
                <td><?php echo "$fv"; ?></td>
                <td><label></label></td>
                <td><?php  if($p=='No'){
                 ?>  &nbsp; (Fecha Inicial <?php echo $fi.', Fecha Final '.$ff;} ?></td>
            </tr>
        </table>
        <table class="table table-bordered table-striped table-hover" id="">
            <tr>
                <td>Informacion Adicional</td>
                <td><?php echo $inf; ?></td>
            </tr>
        </table>
    </div>    
</form>
    
		
		
		
		
		<div class="spacer"></div>
                 <?php 
    if(isset($_GET['fact'])){  ?>
        
	
			<header  onload="recargar()"><h4>Servicios prestados/elementos</h4></header>
                        <hr>

                       
<?php 
     if(isset($_GET['fact'])){              
$request=mysql_query('select *, max(cant_ins) as c, count(cant_ins) as t  from actividad where estado="Completada" and relacionado='.$_GET['fact'].' and tipo_factura="'.$_GET['t'].'" group by orden_servicio');

$request3=mysql_query('select a.*, b.* from insumos_asignados a, insumos b where  a.cant_usada!=0 and a.cod_insumo=b.codigo and a.facturado="'.$_GET['fact'].'"  ');
$request4=mysql_query('select a.*, b.* from medicamentos_asig a, medicamentos b where a.cod_med=b.codigo_int and a.facturado="'.$_GET['fact'].'"');
$request5=mysql_query('select a.*, b.* from laboratorio_asig a, laboratorio b where a.cod_lab=b.cod_lab and a.facturado="'.$_GET['fact'].'"');
$request6=mysql_query('select a.*, b.* from productos_vendidos a, productos b where a.cod_pro=b.codigo_interno and a.facturado="'.$_GET['fact'].'"');
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
             $table = $table.'<th>'.'Orden Int.'.'</th>';
             $table = $table.'<th>'.'Autorizacion'.'</th>';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'<th>'.'Anexo'.'</th>';
              $table = $table.'<th>'.'cantidad'.'</th>';
              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
              $table = $table.'<th>'.'Neto a Pagar.'.'</th>';
              
              
               
              
           $table = $table.'</tr>';

$table = $table.'</thead>';
	
        $copagos=0;
	//Por cada resultado pintamos una linea
        $t1=0;
	while($row=mysql_fetch_array($request))
	{      
            $query = mysql_query("select count(codigo_atencion) from atenciones where codigo_atencion='".$row["cod_aten"]."'  ");
            $c = mysql_fetch_row($query);
            if($c[0]==0){
                $led = '<img src="../imagenes/ledrojo.gif">';
            }else{
                $led = '';
            }
            $copagos +=$row['cuota_pagada'];
            //$led = '<img src="../imagenes/ledrojo.gif">';
                $st1=$row['precio_total']*$row['c'];
                $t1=$t1+$st1;
		$table = $table.'<tr><td>'.$row["orden_servicio"].$led.'</td><td>'.$row["orden_externa"].'</td><td>'.$row["cod_aten"].'</td><td>'.$row['Description'].'</td><td>'.$row['anexo'].'</td><td>'.$row['c'].
                        '</td><td>'.$row['precio_total'].'</td><td>'.number_format($row['precio_total']*$row['c']).'</td></tr>';
          
	}
        $t2=0;
        //mysql_query("update facturas set copagos='$copagos' where relacionado='".$_GET['fact']."' and estado=''  ");
        $t3=0;
        while($row=mysql_fetch_array($request3))
	{       
               $st3=$row['sub_precio']*$row['cant_usada'];
                $t3=$t3+$st3;
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_insumo"].'</td><td>'.$row['nombre_insumo'].'</td><td>'.$row["inf_adicional"].'</td><td>'.$row['cant_usada'].
                        '</td><td>'.$row['sub_precio'].'</td><td>'.number_format($row['sub_precio']*$row['cantidad']).'</td></tr>';
        
	}
        $t4=0;
        while($row=mysql_fetch_array($request4))
	{    
               $st4=$row['sub_precio_m']*$row['cantidad_usada'];
                $t4=$t4+$st4;
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_med"].'</td><td>'.$row['nombre_medicamento'].'</td><td>'.$row["info"].'</td><td>'.$row['cantidad_usada'].
                        '</td><td>'.$row['sub_precio_m'].'</td><td>'.number_format($row['sub_precio_m']*$row['cantidad_usada']).'</td></tr>';
       
	}
        $t5=0;
        while($row=mysql_fetch_array($request5))
	{     
               $st5=$row['precio_lab']*$row['cantidad'];
                $t5=$t5+$st5;
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_lab"].'</td><td>'.$row['nombre_lab'].'</td><td>'.$row["inf"].'</td><td>'.$row['cantidad'].
                        '</td><td>'.$row['precio_lab'].'</td><td>'.number_format($row['precio_lab']*$row['cantidad']).'</td></tr>';
     
	}
        $t6=0;
        while($row=mysql_fetch_array($request6))
	{       
               $st5=$row['precio_v']*$row['cantidad'];
                $t5=$t5+$st5;
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["codigo_interno"].'</td><td>'.$row['nombre'].'</td><td>'.$row["info"].'</td><td>'.$row['cantidad'].
                        '</td><td>'.$row['precio_v'].'</td><td>'.number_format($row['precio_v']*$row['cantidad']).'</td></tr>';
       
	}
	$table = $table.'</table>';
        
	echo $table;
        $total=$t1+$t2+$t3+$t4+$t5;
        $iva=$total*0.16;
        $subto=$total-$iva;
}

?><table> 
<!--    <tr>
   
    <td><label>Subtotal:</label></td>
    <td>$ <?php echo number_format($subto); ?></td>

</tr>
--><tr>
  
    <td><label>Copagos:</label></td>
    <td>$ <?php echo number_format($copagos); ?></td>

</tr>
<tr>
  
    <td><label>Total a Pagar:</label></td>
    <td>$ <?php echo number_format($total - $copagos); }?></td>

</tr></table>
                       
		
                <?php  }
    if(isset($_GET['factura'])){  ?>
                	
			<header  onload="recargar()"><h3>Servicios prestados/elementos</h3></header>
                        <hr>
                       

                        <header><h3> </h3></header>
                       
<?php 
//     if(isset($_GET['fact'])){              
$request=mysql_query('select * from venta_libre where numero_factura="'.$_GET['factura'].'"');
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

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
	while($row=mysql_fetch_array($request))
	{       
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

?><table> <tr>
   
    <td><label>Subtotal:</label></td>
    <td>$ <?php echo $subto; ?></td>

</tr><tr>
  
    <td><label>Iva 16%:</label></td>
    <td>$ <?php echo $iva; ?></td>

</tr><tr>
  
    <td><label>Total a Pagar:</label></td>
    <td>$ <?php echo $total; //}?></td>

</tr>

</table>

		</article>


               <?php }
