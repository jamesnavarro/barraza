<?php 
include "../modelo/conexion.php";
 require '../modelo/consultar_permisos.php';

?>
<!doctype html>
<html lang="en">

<head>

          <script> 
var ventana_secundaria 

function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/pagos.php","miventana","width=500,height=200,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>
	<script> 
    function Down(fact){
        window.open('../vistas/archivo_siigo.php?f='+fact,'Form','width=500, height= 200');
    }
    </script>
</head>


<body onload="doScroll()" onunload="window.name=document.body.scrollTop">


            
            
<?php 
if(isset($_GET['fact'])){
$consulta3= "select * from facturas where numero_factura='".$_GET['fact']."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){
$id_factura=$fila['id_factura'];
$paciente=$fila['id_paciente'];
$num_fact=$fila['numero_factura'];
$forma_pago=$fila['forma_pago'];
$me=$fila['meses'];
$fv=$fila['fecha_ven'];
$inf=$fila['informacion'];
$fr=$fila['fecha_registro'];
$p=$fila['pago_pendiente'];
$arch=$fila['orden_int'];
$ord_ext=$fila['orden_ext'];
$valor=$fila['total'];
$copagos=$fila['copagos'];
$estado=$fila['estado'];
}}

if(isset($_GET['fact'])){
$consulta2= "select * from equipos_asig where numero_orden_a='".$arch."'";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$id_equipo_a=$fila['id_equipo_a'];
$cod_equipo=$fila['cod_equipo'];
}}

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
$consulta2= "select a.*, b.*, c.* from equipos_asig a, pacientes b, sis_empresa c, ordenes d where d.id='".$arch."' and d.id=a.numero_orden_a and d.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.id_equipo_a";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){

$orden_int=$fila['numero_orden_a'];
$orden_ext=$fila['rel_atencion'];
$nombre_seguro=$fila['nombre_emp'];
$nit_seguro=$fila['nit_emp'];
$telefono_seguro=$fila['tel_oficina_emp'];
$direccion_seguro=$fila['direccionr_emp'];
$nombre_paciente=$fila['nombres'].' '.$fila['nombre2'].' '.$fila['apellidos'].' '.$fila['apellido2'];
$cedula_paciente=$fila['numero_doc'];
$diagnostico=$fila['enfermedad'];
$enfermedad=$fila['descripcion_enf'];

}}
//////////


//////////


 ?>
		
		
		
		
		
		<article>
                <form name="insertar_empresa"  class="span12 widget shadowed dark form-horizontal bordered"  action="../modelo/editar_pago.php?editar=<?php echo $_GET['fact']; ?>" method="post" enctype="multipart/form-data">
	
                    <header><h4 class="title">Factura # : <?php echo $num_fact ?></h4>
                         <?php 
    if($editar_fac=='Habilitado'){ 
        ?>
                        <a href="../vistas/?id=facturacion_alquiler&fact=<?php echo $orden_int ?>&factura=<?php echo $_GET['fact'] ?>&estado=<?php echo $estado ?>"><img src="../imagenes/estrella.png"></a>
    <?php }  ?>
                      <a href="#" onclick="Down(<?php echo $_GET['fact'] ?>)"><img src="../imagenes/siigo.png"></a>
                        </header>
				<div class="module_content"> 
                           <br>
                                        <hr>
                                           <?php if($editar_prod=='Habilitado'){ ?> <a href="../vistas/?id=facturas"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php ;} ?>
                                          <a target="_blank" href="../imprimir_alquiler.php?imprimir=<?php echo $num_fact ?>&estado=<?php echo $estado ?>"><input type="button" name="bo" value="Imprimir"/> </a>                                    
                                        <hr><br>
                                       <hr><br>
                                       <?php if(isset($_GET['fact'])){  ?>
                                      <table class="table table-bordered table-striped table-hover" id=""> <tr>
                                                                    <td><label>Empresa:</label></td>
                                                                    <td><?php echo "$nombre_seguro"; ?></td>
                                                                    <td><label>Dirección:</label></td>
                                                                    <td><?php echo "$direccion_seguro"; ?></td>
                                                                </tr><tr>
                                                                    <td><label>Nit:</label></td>
                                                                    <td><?php echo "$nit_seguro"; ?></td>
                                                                    <td><label>Telefono:</label></td>
                                                                    <td><?php echo "$telefono_seguro"; ?></td>
                                                                </tr></table>
                                       <table class="table table-bordered table-striped table-hover" id=""><tr>
                                                                    <td><label>Paciente:</label></td>
                                                                    <td><?php echo "$nombre_paciente"; ?></td>
                                                                    
                                                                    <td><label># Documento:</label></td>
                                                                    <td><?php echo "$cedula_paciente"; ?></td>
                                                                    <td><label>Orden Externa:</label></td>
                                                                    <td><?php echo $ord_ext; ?></td>
                                                                </tr><tr>
                                                                    <td><label>Historia Clinica:</label></td>
                                                                    <td><?php echo ""; ?></td>
                                                                    <td><label>Diagnostico:</label></td>
                                                                    <td><?php echo "$enfermedad"; ?></td>
                                                                    <td><label>Archivo:</label></td>
                                                                    <td><?php echo "$orden_int"; ?></td>
                                                                </tr></table> <?php }if(isset($_GET['factura'])){ ?>
                                       <table class="table table-bordered table-striped table-hover" id=""><tr>
                                                                    <td><label>Cliente:</label></td>
                                                                    <td><?php echo "$cliente"; ?></td>
                                                                    
                                                                    <td><label>C.C ó Nit:</label></td>
                                                                    <td><?php echo "$numero_doc"; ?></td>
                                                                   
                                                                </tr><tr>
                                                                    <td><label>Telefeno:</label></td>
                                                                    <td><?php echo "$telefono"; ?></td>
                                                                    <td><label>Direccion:</label></td>
                                                                    <td><?php echo "$direccion"; ?></td>
                                                                   
                                                                </tr></table><?php } ?>
                                       <table class="table table-bordered table-striped table-hover" id=""><tr>
                                                                    <td><label>Forma de Pago:</label></td>
                                                                    <td><?php echo "$forma_pago"; ?> a <?php echo "$me"; ?> Mes(es)</td>
                                                                    <td><label></label></td>
                                                                    <td></td>
                                                                </tr><tr>
                                                                    <td><label>Fecha Vencimiento:</label></td>
                                                                    <td><?php echo "$fv"; ?></td>
                                                                    <td><label></label></td>
                                                                    <td><?php  if($p=='No'){
                                                                        if($_SESSION["admin"]=='Si'){   
                                                                    echo ' <input type="submit" name="crear" value="Anular"></a>';}} ?></td>
                                                                </tr></table>
                                       
                       
		
                    </form>
		
		
		
	
                 <?php 
    if(isset($_GET['fact'])){  ?>
        
	
			<header  onload="recargar()"><h3>Servicios prestados/elementos</h3></header>
                        <hr>
                       
               
                        <header><h3> </h3></header>
                       
<?php 
     if(isset($_GET['fact'])){              

$request2=mysql_query('select * from equipos_asig a, alquiler b where a.cod_equipo=b.codigo and a.facturado="'.$_GET['fact'].'"');

if($request2){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Orden externa'.'</th>';
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
        while($row=mysql_fetch_array($request2))
	{       
                $st2=$row['precio_a']*$row['cantidad']*$row['meses'];
                $t2=$t2+$st2;
		$table = $table.'<tr><td>'.$row["cod_equipo"].'</td>'
                        . '<td>'.$row["autorizacion"].'</td>'
                        . '<td>'.$row['nombre'].'</td>'
                        . '<td>'.$row['cantidad'].'</td>
                             <td>'.$row['meses'].'</td>
                                <td>'.$row['fecha_a'].'</td>
                                    <td>'.$row['fecha_f'].'</td><td>'.number_format($row['precio_a']).'</td><td>'.number_format($row['precio_a']*$row['cantidad']*$row['meses']).'</td></tr>';
               
	}
       
	$table = $table.'</table>';
        
	echo $table;
        $total=$t2;
        $iva=$total*0.16;
        $subto=$total-$iva;
}

?><table> 
<!--    <tr>
   
    <td><label>Subtotal:</label></td>
    <td>$ <?php echo number_format($subto); ?></td>

</tr>-->
<tr>
  
    <td><label>copagos:</label></td>
    <td>$ <?php echo number_format($copagos); ?></td>

</tr>
<tr>
  
    <td><label>Neto Pagar:</label></td>
    <td>$ <?php echo number_format($valor); ?></td>

</tr>
<tr>
  
    <td><label>Total Neto Pagar:</label></td>
    <td>$ <?php echo number_format($valor - $copagos); }?></td>

</tr>
</table>
		</article>
                <?php  }
    if(isset($_GET['factura'])){  ?>
                	<article class="module width_full">
			<header  onload="recargar()"><h3>Servicios prestados/elementos</h3></header>
                        <hr>
                       
               
                        <header><h3> </h3></header>
                       
<?php 
//     if(isset($_GET['fact'])){              
$request=Connection::runQuery('select * from venta_libre where numero_factura="'.$_GET['factura'].'"');
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

</tr></table>
		</article>
               <?php }
               

