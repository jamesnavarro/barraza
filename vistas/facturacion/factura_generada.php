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
	<title>systema Integral</title>
	
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

//////////".$_GET['fact']."
//if(isset($_GET['factura'])){
$consulta3= "select * from facturas where numero_factura='1601'";
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

}

 ?>
		
		
		
		
		
		<div class="clear"></div>
                <form name="insertar_empresa" action="../modelo/editar_pago.php" method="post" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Factura # : <?php echo $num_fact ?></h3></header>
                        
                        
				<div class="module_content"> 
                           <br>
                                        <hr>
                                           <?php if($modulo_rE=='Empresa' && $editar_rE=='Habilitado'){ ?> <a href="../vistas/mostrar_todo.php?codigo=<?php echo $_GET['fact']; ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php ;} ?>
                                          <a target="_blank" href="../php-mysql.php?imprimir=<?php echo $_GET['fact'] ?>"><input type="button" name="bo" value="Imprimir"/> </a>
                                        
                                        <hr><br>
                                        
                                       <fieldset style="width:100%; float:center; margin-right: 3%;">
                                        <?php                                           echo '';
                                        echo '<h3 align="center">'."$nombre_emp".'</h3>';
                                        echo '<h3 align="center">Nit : '."$nit_emp".'</h3>';
                                        echo '<h3 align="center">'."$dir_emp".'</h3>';
                                        echo '<h3 align="center">Tel :'."$tel_1".' '.$tel_3.'</h3>';
                                        
                                        echo '<h3 align="center">Web:'."$web_emp".'</h3>';
                                        echo '<h3 align="center">Email:'."$email_emp".'</h3>';
                                        echo '<h3 align="center">Factura Autorizada por la DIAN 20000129687 del'."$fact_1".' al '.$fact_2.'</h3>';
                                        ?>
                                       </fieldset>
                                       <hr><br>
                                       
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
                                                                   
                                                                </tr></table>
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
                
        
		<article class="module width_full">
			<header  onload="recargar()"><h3>Servicios prestados/elementos</h3></header>
                        <hr>
                       
               
                        <header><h3> </h3></header>
                       
<?php 
//     if(isset($_GET['fact'])){              
$request=Connection::runQuery('select * from venta_libre where numero_factura="1601"');
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
               <?php if($modulo_rIN=='Incidencias' && $listar_rIN=='Habilitado'){ ?>
                 <?php } if($modulo_rPR=='Proyectos' && $listar_rPR=='Habilitado'){?>
                         <?php } ?>
               
              
	</section>
               <?php include '../footer.php'; ?>

</body>

</html>
