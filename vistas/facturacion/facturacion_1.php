<?php 
session_start();
include "../modelo/conexion.php";
 require '../modelo/consultar_permisos.php';
include_once 'Connection.php';

?>
<!doctype html>
<html lang="en">

<head>
	        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>Sistema Integral</title>
	
	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="../resources/style.css" />
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


<body onload="doScroll()" onunload="window.name=document.body.scrollTop" oncontextmenu="return false" onselectstart="return false" ondragstart="return false" oncopy="return false">
 <?php  include '../vistas/menu.php'; ?>
	<section id="main" class="column">

            
            
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
$consulta2= "select a.*, b.*, c.* from ordenes a, pacientes b, sis_empresa c where a.id='".$_GET['fact']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.id";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){

$orden_int=$fila['id'];
$orden_ext=$fila['orden'];
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
if(isset($_GET['fact'])){
$consulta3= "select * from facturas where orden_int='".$_GET['fact']."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){
if($fila["cod_alquiler"]==''){
$id_fac=$fila['id_factura'];
$_SESSION['idfact']=$id_fac;
$num_fact=$fila['numero_factura'];
$forma_pago=$fila['forma_pago'];
$me=$fila['meses'];
$fv=$fila['fecha_ven'];
$inf=$fila['informacion'];
$fr=$fila['fecha_registro'];
$p=$fila['pago_pendiente'];
}
}}

//////////
if(isset($_GET['factura'])){
$consulta3= "select * from facturas where numero_factura='".$_GET['factura']."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){

$id_fac=$fila['id_factura'];
$_SESSION['idfact']=$id_fac;
$num_fact=$fila['numero_factura'];
$forma_pago=$fila['forma_pago'];
$me=$fila['meses'];
$fv=$fila['fecha_ven'];
$inf=$fila['informacion'];
$fr=$fila['fecha_registro'];
$p=$fila['pago_pendiente'];
$cliente=$fila['nombre_cliente'];
$numero_doc=$fila['numero_documento'];
$direccion=$fila['direccion_cli'];
$telefono=$fila['telefono_cli'];

}}

 ?>
		
		
		
		
		
		<div class="clear"></div>
                <form name="insertar_empresa" action="../modelo/editar_pago.php" method="post" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Factura # : <?php echo $num_fact ?></h3>
                            <a href="../vistas/facturacion.php?fact=<?php echo $_GET['fact'] ?>&factura=<?php echo $num_fact ?>"><img src="../imagenes/estrella.png"></a></header>
                        
                        
				<div class="module_content"> 
                           <br>
                                        <hr>
                                           <?php if($modulo_rE=='Empresa' && $editar_rE=='Habilitado'){ ?> <a href="../vistas/mostrar_todo.php?codigo=<?php echo $_GET['fact']; ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php ;} ?>
                                          <a target="_blank" href="../php-mysql.php?imprimir=<?php echo $_GET['fact'] ?>"><input type="button" name="bo" value="Imprimir"/> </a>
                                        
                                        <hr><br>
                                      
                                       <hr><br>
                                       <?php if(isset($_GET['fact'])){  ?>
                                       <table> <tr>
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
                                       <table> <tr>
                                                                    <td><label>Paciente:</label></td>
                                                                    <td><?php echo "$nombre_paciente"; ?></td>
                                                                    
                                                                    <td><label># Documento:</label></td>
                                                                    <td><?php echo "$cedula_paciente"; ?></td>
                                                                    <td><label>archivo:</label></td>
                                                                    <td><?php echo "$orden_int"; ?></td>
                                                                </tr><tr>
                                                                    <td><label>Historia Clinica:</label></td>
                                                                    <td><?php echo ""; ?></td>
                                                                    <td><label>Diagnostico:</label></td>
                                                                    <td><?php echo "$enfermedad"; ?></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr></table> <?php }if(isset($_GET['factura'])){ ?>
                                       <table> <tr>
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
                                       <table> <tr>
                                                                    <td><label>Forma de Pago:</label></td>
                                                                    <td><?php echo "$forma_pago"; ?> a <?php echo "$me"; ?> Mes(es)</td>
                                                                    <td><label></label></td>
                                                                    <td></td>
                                                                </tr><tr>
                                                                    <td><label>Fecha Vencimiento:</label></td>
                                                                    <td><?php echo "$fv"; ?></td>
                                                                    <td><label>Pago Pendiente:</label></td>
                                                                    <td><?php echo "$p"; if($p=='Si'){
          echo ' <input type="submit" name="crear" value="Pagar"></a>';} ?></td>
                                                                </tr></table>
                                       
                       
		</article>
                    </form>
		
		
		
		
		<div class="spacer"></div>
                 <?php 
    if(isset($_GET['fact'])){  ?>
        
		<article class="module width_full">
			<header  onload="recargar()"><h3>Servicios prestados/elementos</h3></header>
                        <hr>

                       
<?php 
     if(isset($_GET['fact'])){              
$request=Connection::runQuery('select *, max(cant_ins) as c from actividad where estado="Completada" and archivo="'.$_GET['fact'].'"  group by orden_servicio');
$request2=Connection::runQuery('select a.*, b.* from equipos_asig a, alquiler b where a.cod_equipo=b.codigo and a.numero_orden_a="'.$_GET['fact'].'"');
$request3=Connection::runQuery('select a.*, b.* from insumos_asignados a, insumos b where a.cod_insumo=b.codigo and a.numero_orden="'.$_GET['fact'].'"');
$request4=Connection::runQuery('select a.*, b.* from medicamentos_asig a, medicamentos b where a.cod_med=b.codigo_int and a.numero_orden="'.$_GET['fact'].'"');
$request5=Connection::runQuery('select a.*, b.* from laboratorio_asig a, laboratorio b where a.cod_lab=b.cod_lab and a.numero_orden_lab="'.$_GET['fact'].'"');
$request6=Connection::runQuery('select a.*, b.* from productos_vendidos a, productos b where a.cod_pro=b.codigo_interno and a.numero_orden_v="'.$_GET['fact'].'"');
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
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
	
        
	//Por cada resultado pintamos una linea
        $t1=0;
	while($row=mysql_fetch_array($request))
	{       if($row['prioridad']!='Facturado'){
                $st1=$row['precio_total']*$row['c'];
                $t1=$t1+$st1;
		$table = $table.'<tr><td>'.$row["orden_servicio"].'</td><td>'.$row["orden_externa"].'</td><td>'.$row["cod_aten"].'</td><td>'.$row['Description'].'</td><td>'.$row['anexo'].'</td><td>'.$row['c'].
                        '</td><td>'.$row['precio_total'].'</td><td>'.$row['precio_total']*$row['c'].'</td></tr>';
        }  
	}
        $t2=0;
        while($row=mysql_fetch_array($request2))
	{       if($row['facturado']!='Facturado'){
                $st2=$row['precio_a']*$row['cantidad'];
                $t2=$t2+$st2;
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_equipo"].'</td><td>'.$row['nombre'].'</td><td>'.$row["inf"].'</td><td>'.$row['cantidad'].
                        '</td><td>'.$row['precio_a'].'</td><td>'.$row['precio_a']*$row['cantidad'].'</td></tr>';
        }
	}
        $t3=0;
        while($row=mysql_fetch_array($request3))
	{       if($row['facturado']!='Facturado'){
               $st3=$row['sub_precio']*$row['cant_usada'];
                $t3=$t3+$st3;
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_insumo"].'</td><td>'.$row['nombre_insumo'].'</td><td>'.$row["inf_adicional"].'</td><td>'.$row['cant_usada'].
                        '</td><td>'.$row['sub_precio'].'</td><td>'.$row['sub_precio']*$row['cantidad'].'</td></tr>';
        }
	}
        $t4=0;
        while($row=mysql_fetch_array($request4))
	{       if($row['facturado']!='Facturado'){
               $st4=$row['sub_precio_m']*$row['cantidad_usada'];
                $t4=$t4+$st4;
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_med"].'</td><td>'.$row['nombre_medicamento'].'</td><td>'.$row["info"].'</td><td>'.$row['cantidad_usada'].
                        '</td><td>'.$row['sub_precio_m'].'</td><td>'.$row['sub_precio_m']*$row['cantidad_usada'].'</td></tr>';
        }
	}
        $t5=0;
        while($row=mysql_fetch_array($request5))
	{       if($row['facturado']!='Facturado'){
               $st5=$row['precio_lab']*$row['cantidad'];
                $t5=$t5+$st5;
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_lab"].'</td><td>'.$row['nombre_lab'].'</td><td>'.$row["inf"].'</td><td>'.$row['cantidad'].
                        '</td><td>'.$row['precio_lab'].'</td><td>'.$row['precio_lab']*$row['cantidad'].'</td></tr>';
        }
	}
        $t6=0;
        while($row=mysql_fetch_array($request6))
	{       if($row['facturado']!='Facturado'){
               $st5=$row['precio_v']*$row['cantidad'];
                $t5=$t5+$st5;
		$table = $table.'<tr><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["codigo_interno"].'</td><td>'.$row['nombre'].'</td><td>'.$row["info"].'</td><td>'.$row['cantidad'].
                        '</td><td>'.$row['precio_v'].'</td><td>'.$row['precio_v']*$row['cantidad'].'</td></tr>';
        }
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
    <td>$ <?php echo $subto; ?></td>

</tr><tr>
  
    <td><label>Iva 16%:</label></td>
    <td>$ <?php echo $iva; ?></td>

</tr>-->
<tr>
  
    <td><label>Total a Pagar:</label></td>
    <td>$ <?php echo $total; }?></td>

</tr></table>
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
               <?php }if($modulo_rIN=='Incidencias' && $listar_rIN=='Habilitado'){ ?>
                 <?php } if($modulo_rPR=='Proyectos' && $listar_rPR=='Habilitado'){?>
                         <?php } ?>
               
              
	</section>
               <?php include '../footer.php'; ?>

</body>

</html>
