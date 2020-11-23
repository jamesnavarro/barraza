<?php 
session_start();
include "../modelo/conexion.php";
 require '../modelo/consultar_permisos.php';
include_once 'Connection.php';
$sql1 = "SELECT MAX(numero_factura) as id FROM facturas where estado=''";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $factura = $fila1["id"]+1;
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
    <script type="text/javascript" src="../js/tcal.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
<script language='javascript'>
function contacto()
{
window.open('../vistas/form_pacientes_1.php', 'contacto', 'width=500,height=600');
}
function seleccionar()
{
catPaises = window.open('../vistas/seleccionar.php', 'contacto', 'width=1000,height=600');
}
function usuario()
{
catPaises = window.open('../seleccion/usuario.php', 'contacto', 'width=1000,height=600');
}
function atenciones()
{
catPaises = window.open('../seleccion/atenciones.php', 'contacto', 'width=1000,height=600');
}
</script>
<script language="javascript" type="text/javascript">
function datos(val1, val2, val3, val4, val5){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
    document.getElementById('valor5').value = val5;
}
function user(val6){
    document.getElementById('valor6').value = val6;
    
}

</script>
	
</head>


<body onload="doScroll()" onunload="window.name=document.body.scrollTop">
 <?php  include '../vistas/menu.php'; ?>
    <form name="insertar_empresa" action="../modelo/insertar_venta.php" method="post" enctype="multipart/form-data">
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
$idpac=$fila['id_paciente'];
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


 ?>
		
		
		
		
		
		<div class="clear"></div>
                
		<article class="module width_full">
			<header><h3>Facturacion</h3></header>
                        
                        
				<div class="module_content"> 
                           <br>
                                        <hr>
                                           
                                          Factura # : <input type="text" readonly name="factura" value="<?php if($factura==1){echo $fact_1;}else{echo $factura;}  ?>">
                                        
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
                                                                    <td><label>Nombre Cliente:</label></td>
                                                                    <td><input type="text"  name="cliente" id="valor1" onclick="contacto()"><input type="hidden"  name="paciente" id="valor2"></td>
                                                                    
                                                                    <td><label>C.C ó Nit:</label></td>
                                                                    <td><input type="text" id="valor3"  name="documento" id="valor3"></td>
                                                                    
                                                                    
                                                                </tr><tr>
                                                                    <td><label>Telefono :</label></td>
                                                                    <td><input type="text" name="telefono" id="valor4"></td>
                                                                    <td><label>Dirección:</label></td>
                                                                    <td><input type="text" name="direccion" id="valor5"></td>
                                                                </tr></table>
                                       <table> <tr>
                                                                    <td><label>Forma de Pago:</label></td>
                                                                    <td><select name="forma_pago" >
                                                                    <option label="" value="Credito">Crédito</option>
                                                                    <option label="" value="Contado">Contado</option>
                                                                    <option label="" value="Cheque">Cheque</option>
                                                                    
                                                                    
                                                                    </select></td>
                                                                    
                                                                    <td><label>Fecha Vencimiento:</label></td>
                                                                    <td><input type="text" name="fecha_venc" class="tcal"> (aaaa-mm-dd), Ej: 2013-01-08</td>
                                                                    
                                                                </tr><tr>
                                                                    <td><label>meses:</label></td>
                                                                    <td><select name="meses" >
                                                                   <option value="00" SELECTED DEFAULT>00</option>
                                                                   <option value="01">01</option>
                                                                   <option value="02">02</option>
                                                                   <option value="03">03</option>
                                                                   <option value="04">04</option>
                                                                   <option value="05">05</option>
                                                                   <option value="06">06</option>
                                                                   <option value="07">07</option>
                                                                   <option value="08">08</option>
                                                                   <option value="09">09</option>
                                                                   <option value="10">10</option>
                                                                   <option value="11">11</option>
                                                                   <option value="12">12</option>
                                                                    
                                                                    
                                                                    </select></td>
                                                                    <td><label>Pago Pendiente:</label></td>
                                                                    <td><input type="checkbox" name="pendiente" value="Si"></td>
                                                               
                                                                </tr></table>
                                                                <table> <tr>
                                                                    <td><label>Informacion Adicional:</label></td>
                                                                    <td><textarea style="width:90%;" rows="2" name="info"></textarea></td>
                                                                    
                                                                   
                                                                </tr></table>
                                
                                       <input type="submit" name="enviar" value="Guardar" class="alt_btn"> <?php if($modulo_rE=='Empresa' && $editar_rE=='Habilitado'){ ?> <a href="../vistas/detalle_ordenes.php?codigo=<?php echo $_GET['fact']; ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php ;} ?>
                                       
                       
		</article>
                  
		
		
		
		
		<div class="spacer"></div>
                
        
		<article class="module width_full">
			<header  onload="recargar()"><h3>Servicios prestados/elementos</h3></header>
                        <hr>
                       
               
<!--                        <header><h3> <a target="_blank" href="../php-mysql.php?imprimir=<?php echo $_GET['fact'] ?>"><input type="submit" name="bo" value="Imprimir"/> </a></h3></header>
                       -->
<?php 
     if(isset($factura)){              
$request=Connection::runQuery('select * from venta_libre where numero_factura="'.$factura.'"');

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
//////////////insertar factura en la base de datos


?><table> <tr>
   
    <td></td>
    <td></td>

</tr><tr>
  
    <td></td>
    <td></td>

</tr><tr>
  
    <td><label>Total a Pagar:</label></td>
    <td>$ <input type="text" readonly name="total" value="<?php echo $total; }?>"></td>

</tr></table>
		</article>
               <?php if($modulo_rIN=='Incidencias' && $listar_rIN=='Habilitado'){ ?>
                 <?php } if($modulo_rPR=='Proyectos' && $listar_rPR=='Habilitado'){?>
                         <?php } ?>
               
              
	</section>  </form>
               <?php include '../footer.php'; ?>

</body>

</html>
