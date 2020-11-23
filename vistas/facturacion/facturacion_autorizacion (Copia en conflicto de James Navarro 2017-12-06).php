<?php 
include "../modelo/conexion.php";
 require '../modelo/consultar_permisos.php';

        
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
$consulta2= "select a.*, b.*, c.*, max(a.fecha_mod_ta), min(a.fecha_mod_ta) from actividad a, pacientes b, sis_empresa c where a.orden_externa='".$_GET['fact']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.orden_externa";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idpac=$fila['id_paciente'];
$archivo=$fila['archivo'];
$orden_ext=$fila['orden_externa'];
$nombre_seguro=$fila['nombre_emp'];
$nit_seguro=$fila['nit_emp'];
$telefono_seguro=$fila['tel_oficina_emp'];
$direccion_seguro=$fila['direccionr_emp'];
$nombre_paciente=$fila['nombres'].' '.$fila['nombre2'].' '.$fila['apellidos'].' '.$fila['apellido2'];
$cedula_paciente=$fila['numero_doc'];
$diagnostico=$fila['enfermedad'];
$enfermedad=$fila['descripcion_enf'];
$fechain=$fila['fecha_reg_ta'];
$fechaini=$fila['StartTime'];
$fmax=$fila['max(a.fecha_mod_ta)'];
$fmin=$fila['min(a.fecha_mod_ta)'];

}}
if(isset($_GET['factura'])){
$consulta2= "select a.*, b.*, c.*, max(a.fecha_mod_ta), min(a.fecha_mod_ta) from actividad a, pacientes b, sis_empresa c where a.relacionado='".$_GET['factura']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.orden_externa";
$result2=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result2)){
$idpac=$fila['id_paciente'];
$archivo=$fila['archivo'];
$orden_ext=$fila['orden_externa'];
$nombre_seguro=$fila['nombre_emp'];
$nit_seguro=$fila['nit_emp'];
$telefono_seguro=$fila['tel_oficina_emp'];
$direccion_seguro=$fila['direccionr_emp'];
$nombre_paciente=$fila['nombres'].' '.$fila['nombre2'].' '.$fila['apellidos'].' '.$fila['apellido2'];
$cedula_paciente=$fila['numero_doc'];
$diagnostico=$fila['enfermedad'];
$enfermedad=$fila['descripcion_enf'];
$fechain=$fila['fecha_reg_ta'];
$fechaini=$fila['StartTime'];
$fmax=$fila['max(a.fecha_mod_ta)'];
$fmin=$fila['min(a.fecha_mod_ta)'];
$id_empresa=$fila['id_empresa'];
$_SESSION['ide']=$fila['rips'];
}}
if(isset($_GET['factura'])){
    if($_GET['factura']>3000){
$consulta2= mysql_query("select * from facturas where numero_factura=".$_GET['factura']."");
$f=  mysql_fetch_array($consulta2);
$inf=$f['informacion'];
$cp=$f['copagos'];
$registro=$f['fecha_registro'];
    }else{
        $consulta2= mysql_query("select * from recibo_caja where numero_recibo=".$_GET['factura']."");
$f=  mysql_fetch_array($consulta2);
$inf=$f['informacion'];
$cp=$f['copagos'];
$registro=$f['fecha_registro'];
    }
}

 ?>
		
	  <script> 
var ventana_secundaria 


function editar(){  
ventana_secundaria = window.open("../vistas/editar_precio_atenciones.php?cod=<?php echo $_GET['factura'] ?>","miventana","width=600,height=800,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
function buscar_codigo(it){
    $("#sel").val(it);
    window.open("../seleccion/atenciones.php","atenciones","width=800 , height=600");
}
function datos2(des,cod,pre){
    var it = $("#sel").val();
    $("#ate"+it).val(cod);
    $("#de"+it).html(des);
    $("#pre"+it).val(pre);
}
</script>	
		
                <article class="module width_full">
                    <header><h3 align="center"><a href="../vistas/?id=facturacion_autorizacion&factura=<?php echo ($_GET['factura']-1) ?>">  << Ant </a> EDITAR-FACTURA  <a href="../vistas/?id=facturacion_autorizacion&factura=<?php echo ($_GET['factura']+1) ?>">   Sig >> </a></h3></header>
                    <header><h3>Servicios prestados/elementos <input type="text" id="sel" style="width: 40px"></h3>
                    <a href="../vistas/?id=history&cod=<?php echo $id_empresa; ?>"  target="_blank"><img src="../imagenes/ventas.png"> Historial de Ventas</a>
        </header>
                        <hr>
                       
    <form name="insertar_empresa" action="../modelo/editar_precio.php?factura=<?php echo $_GET['factura'] ?>" method="post" enctype="multipart/form-data">           
<!--                        <header><h3> <a target="_blank" href="../php-mysql.php?imprimir=<?php echo $_GET['fact'] ?>"><input type="submit" name="bo" value="Imprimir"/> </a></h3></header>
                       -->
<?php
echo '<input type="submit" name="cancelar" value="Editar Precios">';
     if(isset($_GET['fact'])){              
$request=mysql_query('select *, max(cant_ins) as c, count(cant_ins) as t from actividad where estado="Completada" and orden_externa="'.$_GET['fact'].'" group by orden_servicio');

$request3=mysql_query('select a.*, b.* from insumos_asignados a, insumos b where a.cod_insumo=b.codigo and a.autorizacion="'.$_GET['fact'].'"');
$request4=mysql_query('select a.*, b.* from medicamentos_asig a, medicamentos b where a.cod_med=b.codigo_int and a.autorizacion="'.$_GET['fact'].'"');
$request5=mysql_query('select a.*, b.* from laboratorio_asig a, laboratorio b where a.cod_lab=b.cod_lab and a.autorizacion="'.$_GET['fact'].'"');
$request6=mysql_query('select a.*, b.* from productos_vendidos a, productos b where a.cod_pro=b.codigo_interno and a.autorizacion="'.$_GET['fact'].'"');
     }
      if(isset($_GET['factura'])){              
$request=mysql_query('select *, max(cant_ins) as c, count(cant_ins) as t from actividad where estado="Completada" and relacionado="'.$_GET['factura'].'" group by orden_servicio');

$request3=mysql_query('select a.*, b.* from insumos_asignados a, insumos b where a.cod_insumo=b.codigo and a.facturado="'.$_GET['factura'].'"');
$request4=mysql_query('select a.*, b.* from medicamentos_asig a, medicamentos b where a.cod_med=b.codigo_int and a.facturado="'.$_GET['factura'].'"');
$request5=mysql_query('select a.*, b.* from laboratorio_asig a, laboratorio b where a.cod_lab=b.cod_lab and a.facturado="'.$_GET['factura'].'"');
$request6=mysql_query('select a.*, b.* from productos_vendidos a, productos b where a.cod_pro=b.codigo_interno and a.facturado="'.$_GET['factura'].'"');
     }
     if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Orden Interna.'.'</th>';
              $table = $table.'<th>'.'Orden Externa.'.'</th>';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'<th>'.'Anexos'.'</th>';
              $table = $table.'<th>'.'cantidad'.'</th>';
              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
              $table = $table.'<th>'.'Neto a Pagar.'.'</th>';
            
           $table = $table.'</tr>';

$table = $table.'</thead>';
	
     
        $t1=0;
        $c1=0;
	while($row=mysql_fetch_array($request))
	{       
            $c1 +=1;
                $st1=$row['precio_total']*$row['c'];
                $t1=$t1+$st1;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
               $table = $table.'<tr><td><a href="../vistas/?id=ver_orden_interna&ord='.$row["orden_servicio"].'" target="_blank">'.$row["orden_servicio"].'</a></td>'
                       . '<td><input type="hidden" name="id'.$c1.'" value="'.$row['Id'].'">'
                       . '<input type="text" style="width:100px" name="oe'.$c1.'"  value="'.$row["orden_externa"].'" readonly></td>'
                       . '<td><input type="text" style="width:100px" name="ate'.$c1.'" id="ate'.$c1.'" value="'.$row["cod_aten"].'" onclick="buscar_codigo('.$c1.')"></td>'
                       . '<td>'.$row['Description'].'</td><td><input type="text" name="anexo'.$c1.'" value="'.$row['anexo'].'"></td><td>'.$row['c'].
                        '</td><td><input type="text" id="pre'.$c1.'" name="precio'.$c1.'" value="'.$row['precio_total'].'" style="width:100px" >'
                       . '<input type="hidden" name="id'.$c1.'" value="'.$row['Id'].'">'
                       . '<input type="hidden" name="tipo'.$c1.'" value="atencion"></td><td>'.$st1.'</td>
                            </tr>';
             
	}
        $t2=0;
    
        $t3=0;
        $c2 = $c1;
        while($row=mysql_fetch_array($request3))
	{       
            $c2 +=1;
               $st3=$row['sub_precio']*$row['cant_usada'];
                $t3=$t3+$st3;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
                if($row['cant_usada']!=0){

		$table = $table.'<tr><td></td><td>'.$row["autorizacion"].'</td>'
                        . '<td><input type="text" style="width:100px" name="ate'.$c2.'" value="'.$row["cod_insumo"].'" readonly></td>'
                        . '<td>'.$row['nombre_insumo'].'</td>'
                        . '<td><input type="text" name="anexo'.$c2.'" value="'.$row["inf_adicional"].'"></td><td>'.$row['cant_usada'].
                        '</td><td><input type="text" name="precio'.$c2.'" value="'.$row['sub_precio'].'" style="width:100px"></td>'
                        . '<td>'.$row['sub_precio']*$row['cant_usada'].''
                        . '<input type="hidden" name="id'.$c2.'" value="'.$row['id_ia'].'">'
                        . '<input type="hidden" name="tipo'.$c2.'" value="insumo"></td></tr>';
               
                }
	}
        $t4=0;
        $c3=$c2;
        while($row=mysql_fetch_array($request4))
	{     $c3 +=1;
               if($row['cantidad_usada']!=0){
               $st4=$row['sub_precio_m']*$row['cantidad_usada'];
                $t4=$t4+$st4;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
                          $table = $table.' ';
		$table = $table.'<tr><td></td><td>'.$row["autorizacion"].'</td>'
                        . '<td><input type="text" style="width:100px" name="ate'.$c3.'" value="'.$row["cod_med"].'" readonly></td>'
                        . '<td>'.$row['nombre_medicamento'].'</td>'
                        . '<td><input type="text" name="anexo'.$c3.'" value="'.$row["info"].'"></td><td>'.$row['cantidad_usada'].
                        '</td><td><input type="text" name="precio'.$c3.'" value="'.$row['sub_precio_m'].'" style="width:100px"></td><td>'.$row['sub_precio_m']*$row['cantidad_usada'].''
                        . '<input type="hidden" name="id'.$c3.'" value="'.$row['id'].'">'
                        . '<input type="hidden" name="tipo'.$c3.'" value="medicina"></td></tr>';
          
                
                }
	}
        $t5=0;
        while($row=mysql_fetch_array($request5))
	{       
               $st5=$row['precio_lab']*$row['cantidad'];
                $t5=$t5+$st5;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
		$table = $table.'<tr><td></td><td>'.$row["autorizacion"].'</td>'
                        . '<td><input type="text" style="width:100px" name="ate'.$c1.'" value="'.$row["cod_lab"].'" readonly></td>'
                        . '<td>'.$row['nombre_lab'].'</td><td>'.$row["inf"].'</td><td>'.$row['cantidad'].
                        '</td><td>'.$row['precio_lab'].'</td><td>'.$row['precio_lab']*$row['cantidad'].'</td><td><a href="../form_editar/precios.php?laboratorio='.$row["id_lab_a"].''.$f.'"><img src="../imagenes/guardar.gif" alt="ver" height="20px" width="20px"></a></td></tr>';
               
	}
        $t6=0;
        while($row=mysql_fetch_array($request6))
	{       
               $st6=$row['precio']*$row['cantidad'];
                $t6=$t6+$st6;
                if(isset($_GET['factura'])){$f='&factura='.$_GET['factura'].'';}else{$f='';}
		$table = $table.'<tr><td></td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_pro"].'</td><td>'.$row['nombre'].'</td><td>'.$row["info"].'</td><td>'.$row['cantidad'].
                        '</td><td>'.$row['precio'].'</td><td>'.$row['precio']*$row['cantidad'].'</td></tr>';
               
	}
	$table = $table.'</table>';
        
	echo $table;
        $total=$t1+$t2+$t3+$t4+$t5+$t6;
        $iva=$total*0.16;
        $subto=$total-$iva;
}
?><input type="text" readonly value="<?php echo $c3  ?>" name="cant">
    </form>                  
                       <?php
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
     <?php  ?><table class="table table-bordered table-striped table-hover" id="">
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
                
                <form name="insertar_empresa" action="<?php echo '../modelo/c_f.php'; ?>" method="post" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Facturacion</h3></header>
                        
                        
				<div class="module_content"> 
                           <br>
                                        <hr>
                                           
                                        Factura # : <input type="text"  name="factura" value="<?php
                                        include "../modelo/conexion.php";
$sql1 = "SELECT MAX(numero_factura) as ida FROM facturas";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $factura = $fila1["ida"]+1;
        if(isset($_GET['factura'])){echo $_GET['factura'];}else{if($factura==1){echo $fact_1;}else{echo $factura;}}  ?>">
              Reemplazar por <select name="cambio">
    <option value="">Cambiar por</option>
    <?php
    $sql2 = "SELECT MAX(numero_factura) as ida FROM facturas";
        $fil =mysql_fetch_array(mysql_query($sql2));
        $fact = $fil["ida"]+1;
        echo ' <option value="'.$fact.'">'.$fact.'</option>';
             echo ' <option value="0">Anular</option>';
    ?>
   
</select>                          
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
                                       <table class="table table-bordered table-striped table-hover" id=""><tr>
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
                                                                    <td><input type="text" readonly name="orden_ext" value="<?php echo "$orden_ext"; ?>"></td>
                                                                </tr><tr>
                                                                    <td><label>Paciente # :</label></td>
                                                                    <td><input type="text" readonly name="paciente" value="<?php echo $idpac; ?>"></td>
                                                                    <td><label>Diagnostico:</label></td>
                                                                    <td><?php echo "$enfermedad"; ?></td>
                                                                    <td><label>Archivo:</label></td>
                                                                    <td><input type="text" readonly name="orden_int" value="<?php echo "$archivo"; ?>"></td>
                                                                </tr></table>
                                    <table class="table table-bordered table-striped table-hover" id=""><tr>
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
                                                                    <td> <label>Fecha Inicio:</label><input type="text" name="fechai" class="tcal" value="<?php echo $fmin; ?>"></td>
                                                                    <td><input type="checkbox" name="pendiente" value="No">
                                                                   
                                                                    <label>Fecha Final:</label><input type="text" name="fechaf" class="tcal" value="<?php echo $fmax;?>"></td>
                                                               
                                                                </tr></table>
                                       <table class="table table-bordered table-striped table-hover" id=""><tr>
                                                                    <td><label>Informacion Adicional:</label></td>
                                                                    <td><textarea style="width:90%;" rows="2" name="info"><?php if(isset($inf)){ echo $inf;} ?></textarea></td>
                                                                    
                                                                   
                                                                </tr></table>
                                          
                       <table class="table table-bordered table-striped table-hover" id="">
<!--    <tr>
   
    <td><label>Subtotal:</label></td>
    <td>$ <input type="text" readonly name="subtotal" value="<?php echo $subto; ?>"></td>

</tr>-->
<tr>
  
    <td><label>Copagos:</label></td>
    <td>$ <input type="text" name="copagos" value="<?php echo $cp; ?>"></td>

</tr>
<tr>
    <td align="right"><label>Total Neto a Pagar:</label></td>
    <td>$ <input type="text" readonly name="total" value="<?php echo $total; ?>"></td>

</tr>
                       <tr>
  
    <td align="right"><label>Saldo Pendiente:</label></td>
    <td>$ <input type="text" readonly name="saldo" value="<?php echo $total-$cp; ?>"></td>

</tr></table>
                                       <input type="submit" name="enviar" value="Guardar" class="alt_btn"> <?php if(isset($_GET['factura'])){ ?> <a href="../vistas/facturas_todas.php"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php ;}else{ ?> <a href="../vistas/detalle_ordenes.php?codigo=<?php echo $_GET['fact']; ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php } ?>
                                   
		</article></form>
