<?php 
include "../modelo/conexion.php";
 require '../modelo/consultar_permisos.php';
$sql1 = "SELECT MAX(numero_factura) as id FROM facturas where estado=''";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $factura = $fila1["id"]+1;
?>
<!doctype html>
<html lang="en">

<head>

       <script> 
var ventana_secundaria 


function editar(){  
ventana_secundaria = window.open("../vistas/editar_precio_alq.php?cod=<?php echo $_GET['factura'] ?>","miventana","width=500,height=200,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>
	
</head>
<article class="module width_full">
    <form name="insertar_empresa" class="span12 widget shadowed dark form-horizontal bordered"  action="<?php if(isset($_GET['factura'])){echo '../modelo/c_f_1.php';}else{echo '../modelo/insertar_factura_1.php?cod='.$_GET['fact'].'';} ?>" method="post" enctype="multipart/form-data">
      
<?php 
if(isset($_GET['fact'])){
$consulta2= "select * from equipos_asig where numero_orden_a='".$_GET['fact']."'";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){

$orden_i=$fila['rel_atencion'];
$cod_equipo=$fila['cod_equipo'];
}}

if(isset($_GET['factura'])){
$consulta2= "select * from facturas where numero_factura='".$_GET['factura']."'";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$inf=$fila['informacion'];
$cp=$fila['copagos'];
$registro=$fila['fecha_registro'];
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
$consulta2= "select a.*, b.*, c.* from equipos_asig a, pacientes b, sis_empresa c, ordenes d where a.numero_orden_a=d.id and a.numero_orden_a='".$_GET['fact']."' and d.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.rel_atencion";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idpac=$fila['id_paciente'];
$orden_int=$fila['numero_orden_a'];
$orden_ext=$fila['autorizacion'];
$fi=$fila['fecha_a'];
$ff=$fila['fecha_f'];
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

                
		
        <header><h4 class="title">Facturacion</h4></header>
                        
                        
				<div class="module_content"> 
                           <br>
                                        <hr>
                                           
                                        Factura # : <input type="text" readonly name="factura" value="<?php if(isset($_GET['factura'])){echo $_GET['factura']; }else{if($factura==1){echo $fact_1;}else{echo $factura;}}  ?>">
                                                                               Reemplazar por <select name="cambio">
    <option value="1">Cambiar por</option>
    <?php
    $sql2 = "SELECT MAX(numero_factura) as ida FROM facturas where estado=''";
        $fil =mysql_fetch_array(mysql_query($sql2));
        $fact = $fil["ida"]+1;
        echo ' <option value="'.$fact.'">'.$fact.'</option>';
        echo ' <option value="0">Anular</option>';
    ?>
   
</select>
                                        <hr><br>
                                       
                                       <hr><br>
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
                                      <table class="table table-bordered table-striped table-hover" id=""> <tr>
                                                                    <td><label>Paciente:</label></td>
                                                                    <td><?php echo "$nombre_paciente"; ?></td>
                                                                    
                                                                    <td><label># Documento:</label></td>
                                                                    <td><?php echo "$cedula_paciente"; ?></td>
                                                                    <td><label>Orden Externa:</label></td>
                                                                    <td><input type="text" readonly name="orden_ext" value="<?php echo $orden_ext; ?>"></td>
                                                                </tr><tr>
                                                                    <td><label>Paciente # :</label></td>
                                                                    <td><input type="text" readonly name="paciente" value="<?php echo $idpac; ?>"></td>
                                                                    <td><label>Diagnostico:</label></td>
                                                                    <td><?php echo "$enfermedad"; ?></td>
                                                                    <td><label>Archivo:</label></td>
                                                                    <td><input type="text" readonly name="orden_int" value="<?php echo "$orden_int"; ?>"></td>
                                                                </tr></table>
                                      <table class="table table-bordered table-striped table-hover" id=""> <tr>
                                                                    <td><label>Forma de Pago:</label></td>
                                                                    <td><select name="forma_pago" >
                                                                    <option label="" value="Credito">Crédito</option>
                                                                    <option label="" value="Contado">Contado</option>
                                                                    <option label="" value="Cheque">Cheque</option>
                                                                    
                                                                    
                                                                    </select></td>
                                                                    
                                                                    <td><label>Fecha Vencimiento:</label><input type="text" name="fecha_venc" class="tcal"></td>
                                                                    <td><label>Fecha Registro:</label><input type="text" name="fechar" class="tcal" value="<?php echo $registro;?>"></td>
                                                                    
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
                                                                    <td><label>Fecha Inicio:</label><input type="text" name="fechai" class="tcal" value="<?php echo $fi; ?>"></td>
                                                                    <td><label>Fecha Final:</label><input type="text" name="fechaf" class="tcal" value="<?php echo $ff;?>"></td>
                                                               
                                                                </tr></table><label>Pago Pendiente:</label><input type="checkbox" name="pendiente" value="Si">
                                                                  <table class="table table-bordered table-striped table-hover" id=""> <tr>
                                                                    <td><label>Informacion Adicional:</label></td>
                                                                    <td><textarea style="width:90%;" rows="2" name="info"></textarea></td>
                                                                    
                                                                   
                                                                </tr></table>
                                       <input type="submit" name="enviar" value="Guardar" class="alt_btn"> <?php if($editar_prod=='Habilitado'){ ?> <a href="../vistas/detalle_ordenes.php?codigo=<?php echo $_GET['fact']; ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php ;} ?>
                                       
                       
	
                  
		
		
		
		
		<div class="spacer"></div>
                
        
		
			<header  onload="recargar()"><h3>Servicios prestados/elementos</h3></header>
                        <hr>
                       
               
<!--                        <header><h3> <a target="_blank" href="../php-mysql.php?imprimir=<?php echo $_GET['fact'] ?>"><input type="submit" name="bo" value="Imprimir"/> </a></h3></header>
                       -->
<?php 
     if(isset($_GET['fact'])){              
$request2=mysql_query('select a.*, b.* from equipos_asig a, alquiler b where a.cod_equipo=b.codigo and a.facturado="'.$_GET['factura'].'"');
if($request2){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'<th>'.'Anexos'.'</th>';
              $table = $table.'<th>'.'cantidad'.'</th>';
              $table = $table.'<th>'.'Meses'.'</th>';
              $table = $table.'<th>'.'Fecha de Inicio'.'</th>';
              $table = $table.'<th>'.'Fecha Final'.'</th>';
              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
              $table = $table.'<th>'.'Neto a Pagar.'.'</th>';
               $table = $table.'<th>'.'Editar.'.'</th>';
           $table = $table.'</tr>';

$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        
        $t2=0;
        while($row=mysql_fetch_array($request2))
	{       
                $st2=$row['precio_a']*$row['cantidad']*$row['meses'];
                $t2=$t2+$st2;
		$table = $table.'<tr><td>'.$row["cod_equipo"].'</td>
                    <td>'.$row['nombre'].'</td><td>'.$row['anexo'].'</td>
                        <td>'.$row['cantidad'].'</td>
                            <td>'.$row['meses'].'</td>
                                <td>'.$row['fecha_reg'].'</td>
                                    <td>'.$row['fecha_f'].'</td>
                                        <td>'.$row['precio_a'].'</td>
                                            <td>'.$row['precio_a']*$row['cantidad']*$row['meses'].'</td>
                                                <td><input type="button" name="cancelar" value="Editar" onclick="editar()"></td>
                                    </tr>';
               
	}
       
	$table = $table.'</table>';
        
	echo $table;
        $total=$t2;
        $iva=$total*0.16;
        $subto=$total-$iva;
}
//////////////insertar factura en la base de datos


?><table> 
    <tr>
<!--   
    <td><label>Subtotal:</label></td>
    <td>$ <input type="text" readonly name="subtotal" value="<?php echo $subto; ?>"></td>

</tr>-->
<tr>
  
    <td><label>Copagos:</label></td>
    <td>$ <input type="text" name="copagos" value=""></td>

</tr>
<tr>
  
    <td><label>Total a Pagar:</label></td>
    <td>$ <input type="text" readonly name="total" value="<?php echo $total; }?>"></td>

</tr></table>
		</article>
            
               
              
  </form>

