<?php 
session_start();
include "../modelo/conexion.php";
 require '../modelo/consultar_permisos.php';
include_once 'Connection.php';
$sql1 = "SELECT MAX(numero_factura) as id FROM facturas  where estado=''";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $factura = $fila1["id"]+1;
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
    <script type="text/javascript" src="../js/tcal.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
<script> 
var ventana_secundaria 

function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/estado_orden.php?cod=<?php  echo $orden_interna ?>","miventana","width=500,height=400,menubar=no") 
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
if(isset($_GET['fact'])){
$consulta2= "select a.*, b.*, c.* from actividad a, pacientes b, sis_empresa c where a.archivo='".$_GET['fact']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.archivo";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idpac=$fila['id_paciente'];
$orden_int=$fila['archivo'];
$orden_ext=$fila['orden_externa'];
$nombre_seguro=$fila['nombre_emp'];
$nit_seguro=$fila['nit_emp'];
$telefono_seguro=$fila['tel_oficina_emp'];
$direccion_seguro=$fila['direccionr_emp'];
$nombre_paciente=$fila['nombres'].' '.$fila['nombre2'].' '.$fila['apellidos'].' '.$fila['apellido2'];
$cedula_paciente=$fila['numero_doc'];
$diagnostico=$fila['enfermedad'];
$enfermedad=$fila['descripcion_enf'];
$fechai=$fila['fecha_reg_ta'];

}}


 ?>
		
		
		
		
		
		<div class="clear"></div>
                <article class="module width_full">
                    <header><h3 align="center">PRE-FACTURA</h3></header>
			<header><h3>Servicios prestados/elementos</h3></header>
                        <hr>
                       
               
<!--                        <header><h3> <a target="_blank" href="../php-mysql.php?imprimir=<?php echo $_GET['fact'] ?>"><input type="submit" name="bo" value="Imprimir"/> </a></h3></header>
                       -->
<?php 
     if(isset($_GET['fact'])){              
$request=Connection::runQuery('select *, max(cant_ins) as c from actividad where estado="Completada" and archivo="'.$_GET['fact'].'" group by cod_aten');
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
              $table = $table.'<th>'.'Orden Externa.'.'</th>';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'<th>'.'Anexos'.'</th>';
              $table = $table.'<th>'.'cantidad'.'</th>';
              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
              $table = $table.'<th>'.'Neto a Pagar.'.'</th>';
              $table = $table.'<th>'.'Editar.'.'</th>';
           $table = $table.'</tr>';

$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t1=0;
	while($row=mysql_fetch_array($request))
	{       if($row['prioridad']!='Facturado'){
                $st1=$row['precio_total']*$row['c'];
                $t1=$t1+$st1;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
                
		$table = $table.'<tr><td>'.$row["orden_externa"].'</td><td>'.$row["cod_aten"].'</td><td>'.$row['Description'].'</td><td>'.$row['anexo'].'</td><td>'.$row['c'].
                        '</td><td>'.$row['precio_total'].'</td><td>'.$row['precio_total']*$row['c'].'</td>
                            <td><a href="../form_editar/precios_1.php?atencion='.$row["Id"].''.$f.'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                }
	}
        $t2=0;
        while($row=mysql_fetch_array($request2))
	{       if($row['facturado']!='Facturado'){
                $st2=$row['precio_a']*$row['cantidad']*$row['meses'];
                $t2=$t2+$st2;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
		$table = $table.'<tr><td>'.$row["autorizacion"].'</td><td>'.$row["cod_equipo"].'</td><td>'.$row['nombre'].'</td><td>'.$row["inf"].'</td><td>'.$row['cantidad']*$row['meses'].
                        '</td><td>'.$row['precio_a'].'</td><td>'.$row['precio_a']*($row['cantidad']*$row['meses']).'</td><td><a href="../form_editar/precios_1.php?equipo='.$row["id_equipo_a"].''.$f.'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
        }
	}
        $t3=0;
        while($row=mysql_fetch_array($request3))
	{       if($row['facturado']!='Facturado'){
               $st3=$row['sub_precio']*$row['cant_usada'];
                $t3=$t3+$st3;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
                if($row['cant_usada']!=0){
		$table = $table.'<tr><td>'.$row["autorizacion"].'</td><td>'.$row["cod_insumo"].'</td><td>'.$row['nombre_insumo'].'</td><td>'.$row["inf_adicional"].'</td><td>'.$row['cant_usada'].
                        '</td><td>'.$row['sub_precio'].'</td><td>'.$row['sub_precio']*$row['cant_usada'].'</td><td><a href="../form_editar/precios_1.php?insumo='.$row["id_ia"].''.$f.'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
        }}
	}
        $t4=0;
        while($row=mysql_fetch_array($request4))
	{     if($row['facturado']!='Facturado'){
               if($row['cantidad_usada']!=0){
               $st4=$row['sub_precio_m']*$row['cantidad_usada'];
                $t4=$t4+$st4;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
		$table = $table.'<tr><td>'.$row["autorizacion"].'</td><td>'.$row["cod_med"].'</td><td>'.$row['nombre_medicamento'].'</td><td>'.$row["info"].'</td><td>'.$row['cantidad_usada'].
                        '</td><td>'.$row['sub_precio_m'].'</td><td>'.$row['sub_precio_m']*$row['cantidad_usada'].'</td><td><a href="../form_editar/precios_1.php?medicina='.$row["id"].''.$f.'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
        }}
	}
        $t5=0;
        while($row=mysql_fetch_array($request5))
	{       if($row['facturado']!='Facturado'){
               $st5=$row['precio_lab']*$row['cantidad'];
                $t5=$t5+$st5;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
		$table = $table.'<tr><td>'.$row["autorizacion"].'</td><td>'.$row["cod_lab"].'</td><td>'.$row['nombre_lab'].'</td><td>'.$row["inf"].'</td><td>'.$row['cantidad'].
                        '</td><td>'.$row['precio_lab'].'</td><td>'.$row['precio_lab']*$row['cantidad'].'</td><td><a href="../form_editar/precios_1.php?laboratorio='.$row["id_lab_a"].''.$f.'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
        }
	}
        $t6=0;
        while($row=mysql_fetch_array($request6))
	{       
            if($row['facturado']!='Facturado'){
               $st6=$row['precio']*$row['cantidad'];
                $t6=$t6+$st6;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
		$table = $table.'<tr><td>'.$row["autorizacion"].'</td><td>'.$row["cod_pro"].'</td><td>'.$row['nombre'].'</td><td>'.$row["info"].'</td><td>'.$row['cantidad'].
                        '</td><td>'.$row['precio'].'</td><td>'.$row['precio']*$row['cantidad'].'</td><td><a href="../form_editar/precios_1.php?venta='.$row["id_venta"].''.$f.'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
            }
	}
	$table = $table.'</table>';
        
	echo $table;
        $total=$t1+$t2+$t3+$t4+$t5+$t6;
        $iva=$total*0.16;
        $subto=$total-$iva;
}
//////////////insertar factura en la base de datos
if (isset($_GET['editar'])){
	$precio = $_POST["precio"];
       
      
       $sql = "UPDATE `actividad` SET `precio_total`='".$precio."' WHERE `Id`='".$_GET['editar']."';";
      
       mysql_query($sql);
       $status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/facturacion.php?fact=".$_GET['fact']."'";
        echo "</script>";
    }

?>
     <?php } ?><table>
<!--    <tr>
   
    <td><label>Subtotal:</label></td>
    <td>$ <input type="text" readonly name="subtotal" value="<?php echo $subto; ?>"></td>

</tr><tr>
  
    <td><label>Iva 16%:</label></td>
    <td>$ <input type="text" readonly name="iva" value="<?php echo $iva; ?>"></td>

</tr>-->
<tr>
  
    <td><label>Total a Pagar:</label></td>
    <td>$ <input type="text" readonly name="total" value="<?php echo $total; ?>"></td>

</tr></table>
                       
		</article>
                
                <form name="insertar_empresa" action="<?php if($_SESSION["k_username"] == 'admin'){echo '../modelo/insertar_factura.php';}else{if(isset($_GET['factura'])){echo '../modelo/c_f.php';}else{echo '../modelo/insertar_pre_factura.php';}} ?>" method="post" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Facturacion</h3></header>
                        
                        
				<div class="module_content"> 
                           <br>
                                        <hr>
                                           
                                        Factura # : <input type="text" readonly name="factura" value="<?php if(isset($_GET['factura'])){echo $_GET['factura'];}else{if($factura==1){echo $fact_1;}else{echo $factura;}}  ?>">
                                        
                                        <hr><br>
                                        
<!--                                       <fieldset style="width:100%; float:center; margin-right: 3%;">
                                        <?php                                           echo '';
                                        echo '<h3 align="center">'."$nombre_emp".'</h3>';
                                        echo '<h3 align="center">Nit : '."$nit_emp".'</h3>';
                                        echo '<h3 align="center">'."$dir_emp".'</h3>';
                                        echo '<h3 align="center">Tel :'."$tel_1".' '.$tel_3.'</h3>';
                                        
                                        echo '<h3 align="center">Web:'."$web_emp".'</h3>';
                                        echo '<h3 align="center">Email:'."$email_emp".'</h3>';
                                        echo '<h3 align="center">Factura Autorizada por la DIAN 20000129687 del'."$fact_1".' al '.$fact_2.'</h3>';
                                        ?>
                                       </fieldset>-->
                                       <hr><br>
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
                                                                    <td><input type="text" readonly name="orden_ext" value="<?php echo "$orden_ext"; ?>"></td>
                                                                </tr><tr>
                                                                    <td><label>Paciente # :</label></td>
                                                                    <td><input type="text" readonly name="paciente" value="<?php echo $idpac; ?>"></td>
                                                                    <td><label>Diagnostico:</label></td>
                                                                    <td><?php echo "$enfermedad"; ?></td>
                                                                    <td><label>Archivo:</label></td>
                                                                    <td><input type="text" readonly name="orden_int" value="<?php echo "$orden_int"; ?>"></td>
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
                                                                    <td><input type="checkbox" name="pendiente" value="Si">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label>Fecha Inicio:</label><input type="text" name="fechai" class="tcal" value="<?php echo $fechai; ?>">
                                                                    <label>Fecha Final:</label><input type="text" name="fechaf" class="tcal" value="<?php echo date("Y/m/d");?>"></td>
                                                               
                                                                </tr></table>
                                       <table> <tr>
                                                                    <td><label>Informacion Adicional:</label></td>
                                                                    <td><textarea style="width:90%;" rows="2" name="info"></textarea></td>
                                                                    
                                                                   
                                                                </tr></table>
                                          
                       <table>
<!--    <tr>
   
    <td><label>Subtotal:</label></td>
    <td>$ <input type="text" readonly name="subtotal" value="<?php echo $subto; ?>"></td>

</tr><tr>
  
    <td><label>Iva 16%:</label></td>
    <td>$ <input type="text" readonly name="iva" value="<?php echo $iva; ?>"></td>

</tr>-->
                           <tr>
  
    <td><label>Copagos:</label></td>
    <td>$ <input type="text" name="copagos" value=""></td>

</tr>
<tr>
  
    <td align="right"><label>Total a Pagar:</label></td>
    <td>$ <input type="text" readonly name="total" value="<?php echo $total; ?>"></td>

</tr></table>
                                        <input type="submit" name="enviar" value="Guardar" class="alt_btn"> <?php if($modulo_rE=='Empresa' && $editar_rE=='Habilitado'){ ?> <a href="../vistas/detalle_ordenes.php?codigo=<?php echo $_GET['fact']; ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php ;} ?>
                                   
		</article></form>
                  
		
		
		
		
		<div class="spacer"></div>
                
        
		
             
               
              
	</section>
     <?php  include '../footer.php'; ?>

</body>

</html>
