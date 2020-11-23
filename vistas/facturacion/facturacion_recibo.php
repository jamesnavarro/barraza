<?php 
session_start();
include "../modelo/conexion.php";
 require '../modelo/consultar_permisos.php';
include_once 'Connection.php';

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
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


<body onload="doScroll()" onunload="window.name=document.body.scrollTop">
 <?php  include '../vistas/menu.php'; ?>
	<section id="main" class="column">

            
            
<?php 
if(isset($_GET['fact'])){
$consulta3= "select * from recibo_caja where numero_recibo='".$_GET['fact']."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){

$paciente=$fila['id_paciente'];
$num_fact=$fila['numero_recibo'];
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

$orden_int=$fila['id_equipo_a'];
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
		
		
		
		
		
		<div class="clear"></div>
                <form name="insertar_empresa" action="../modelo/editar_pago.php" method="post" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Recibo de Caja No : <?php echo $num_fact ?></h3></header>
                        
                        
				<div class="module_content"> 
                           <br>
                                        <hr>
                                           <?php if($modulo_rE=='Empresa' && $editar_rE=='Habilitado'){ ?> <a href="../vistas/mostrar_todo.php?codigo=<?php echo $_GET['fact']; ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php ;} ?>
                                          <a target="_blank" href="../imprimir_recibo.php?imprimir=<?php echo $num_fact ?>"><input type="button" name="bo" value="Imprimir"/> </a>
                                        
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
                       
               
                        <header><h3> </h3></header>
                       
<?php 
     if(isset($_GET['fact'])){              

$request2=Connection::runQuery('select a.*, b.* from equipos_asig a, alquiler b where a.cod_equipo=b.codigo and a.numero_orden_a="'.$arch.'"');

if($request2){
//    echo'<hr>';
    $table = '<table class="lista1">';

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
        while($row=mysql_fetch_array($request2))
	{       
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

?><table> 
<!--    <tr>
   
    <td><label>Subtotal:</label></td>
    <td>$ <?php echo $subto; ?></td>

</tr>-->
<tr>
  
    <td><label>copagos:</label></td>
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
