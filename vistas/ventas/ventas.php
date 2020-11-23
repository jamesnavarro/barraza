<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_alquiler.php';
require '../modelo/consultar_permisos.php';
$request=mysql_query('select count(*) from ordenes where oi!=0 and estado_ord!="Completada" and estado_a="Pedido"');
//require '../modelo/consultar_campana.php';
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 30;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}$_SESSION['t'] = $_POST;
?>
<head>
        
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});

    </script>
    
    <script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1").change(function () {
   		$("#combo1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/combo1.php", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				$("#combo3").html("");
			});			
        });
   })
	// Parametros para el combo2
	$("#combo2").change(function () {
   		$("#combo2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("combo2.php", { elegido: elegido }, function(data){
				$("#combo3").html(data);
			});			
        });
   })
});
</script>

<style type="text/css">
            .show { display: block;  }
            .hide { display: none; }
     </style>
<script type="text/javascript">
           
            function mostrarbusqueda() {
                var select = document.getElementById('d');
                select.className = 'show';
                var select = document.getElementById('dA');
                select.className = 'show';
                 var select = document.getElementById('b');
                select.className = 'show';
                 var select = document.getElementById('c');
                select.className = 'show';
                var select = document.getElementById('f');
                select.className = 'show';
                var select = document.getElementById('g');
                select.className = 'show';
            }
            function ocultarbusqueda() {
                var select = document.getElementById('d');
                select.className = 'hide';
                var select = document.getElementById('dA');
                select.className = 'hide';
                var select = document.getElementById('b');
                select.className = 'hide';
                 var select = document.getElementById('c');
                select.className = 'hide';
                var select = document.getElementById('f');
                select.className = 'hide';
                var select = document.getElementById('g');
                select.className = 'hide';
            }
           
        </script>
<script type="text/javascript"> function recargar() { window.location.reload() } </script>
</head>


<?php $das = $_SESSION['t']; ?>
<article class="module width_full">
    <div class="module_content">
         <form  class="span12 widget shadowed dark form-horizontal bordered" name="buscarA" action="" method="post" enctype="multipart/form-data">
            <header>
                <h4 class="title">productos vendidos</h4>
            </header>
            <div>
                <table class="table table-bordered table-striped table-hover" id="">
                    <tr>
                        <td>
                            <input placeholder="No. Documento" name="documento" style="width:130px;height:20px;">
                        </td>
                        <td>
                            <select name="estado" style="width:180px;">
                                <option value="">Seleccione Estado</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Completada">Completada</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input placeholder="Nombre" name="nombre" style="width:130px;height:20px;">
                        </td>
                        <td>
                            <select name="regimen" style="width:180px;">
                                <option value="">Seleccione Regimen</option>
                                <option value="1">Contributivo</option>
                                <option value="2">Subsidiado</option>
                                <option value="4">Particular</option>
                                <option value="3">Vinculado</option>
                                <option value="5">Otro</option>
                                <option value="7">Desplazado con afilacion al regimen contributivo</option>
                                <option value="8">Desplazado con afilacion al regimen subsidiado</option>
                                <option value="9">Desplazado no asegurado</option>
                                <option value="No aplica">No aplica</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input placeholder="Apellido" name="apellido" style="width:130px;height:20px;">
                        </td>
                        <td>
                            <select name="empresa" style="width:300px;">
                                <option value="">Seleccione La Empresa</option>
                                <?php
                                require '../modelo/conexion.php';
                                $consulta= "SELECT * FROM `sis_empresa` where cliente='Si'";                     
                                $result=  mysql_query($consulta);
                                while($fila=  mysql_fetch_array($result)){
                                $valor1=$fila['rips'];
                                $valor2=$fila['nombre_emp'];
                                echo"<option value='".$valor1."'>".$valor2."</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input placeholder="Autorizacion" name="orden1" style="width:130px;height:20px;">
                        </td>
                        <td>                        
                            <select name="ano" style="width:100px;">
                                <option value="%">Año</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                            </select>
                            <select name="mes" style="width:100px;">
                                <option value="%">Mes</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="factura" style="width:180px;">
                                <option value="">Estado Facturacion</option>
                                <option value="Facturado">Facturado</option>
                                <option value="No Facturado">No Facturado</option>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                       <td>
                        <input type="submit" name="buscar" value="Buscar" class="alt_btn">
                        <input type="reset" value="Limpiar">
                        </td> 
                    </tr>
                </table>
            </div>
        </form>
                                     <table class="table table-bordered table-striped table-hover" id="">
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../vistas/?id=ventas&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=ventas&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=ventas&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=ventas&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["nombre"])){
$nom =$_POST["nombre"];
$ape =$_POST["apellido"];
$reg =$_POST["regimen"];
$emp =$_POST["empresa"];
$doc =$_POST["documento"];
$orden =$_POST["orden1"];
$estado =$_POST["estado"];
$mes =$_POST["ano"].'-'.$_POST["mes"];
$fact = $_POST["factura"];
$ano = $_POST["ano"];
if($nom =='' && $ape =='' && $reg =='' && $doc =='' && $orden =='' && $estado =='' && $mes =='' && $emp =='' && $fact ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';

$request=mysql_query('SELECT a.*, c.*, b.* FROM equipos_ventas a, ordenes b, pacientes c WHERE c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.estado_ord="En proceso" and estado_a="Pedido" group by b.id  '.$limit);
}

if($nom !='' || $ape !=''|| $reg !=''|| $doc !=''|| $orden !=''|| $estado !=''|| $mes !=''|| $emp !=''|| $fact !=''){
    $request=mysql_query("SELECT a.*, b.*, c.* FROM equipos_ventas a, ordenes b, pacientes c WHERE b.facturado LIKE '".$fact."%' and c.id_empresa LIKE '".$emp."%' and a.fecha_a LIKE '%".$mes."%' and b.estado_ord LIKE '%".$estado."%' and a.autorizacion LIKE '%".$orden."%' and c.nombres LIKE '%".$nom."%' and c.apellidos LIKE '%".$ape."%' and c.numero_doc LIKE '%".$doc."%' and c.regimen LIKE '%".$reg."%'  and b.id=a.numero_orden_a and  c.id_paciente=b.id_paciente and estado_a='Pedido' group by b.id ");
}}
else{

$request=mysql_query('SELECT a.*, c.*, b.* FROM equipos_ventas a, ordenes b, pacientes c WHERE b.facturado="Facturado" and c.id_paciente=b.id_paciente and b.id=a.numero_orden_a  and estado_a="Pedido" group by b.id   '.$limit);
}

if($request){
    ?>
         <form name="buscarA" action="../vistas/?id=ventas&codi=facturar" method="post" enctype="multipart/form-data">
        <?php
 
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
             $table = $table.'<thead>';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Archivo.'.'</th>';
              $table = $table.'<th>'.'Orden Interna'.'</th>';
              $table = $table.'<th>'.'Autorizacion.'.'</th>';
              $table = $table.'<th>'.'Paciente.'.'</th>';
              $table = $table.'<th>'.'Regimen'.'</th>';
              $table = $table.'<th>'.'Rango de Fecha'.'</th>';
              $table = $table.'<th>'.'Meses'.'</th>';
               $table = $table.'<th>'.'Estado'.'</th>';
               $table = $table.'<th>'.'llamada?'.'</th>';
               $table = $table.'<th>'.'Estado de Facturacion'.'</th>';
                $table = $table.'<th>'.'Ver'.'</th>';
               $table = $table.'<th>'.'Eliminar'.'</th>';
               $table = $table.'<th>'.'Facturar'.'</th>';
               $table = $table.'<th>'.'Recibo'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
               $table = $table.'</tr>';
$table = $table.'</thead>';
 $a=date("H:i").':00'; 
 $cont = 0;
 while($row=mysql_fetch_array($request))
	{    
     $cont = $cont + 1 ;
     $look ='<td><a href="../vistas/?id=add_detalle_venta&cod='.$row["numero_orden_a"].'&codigo_pac='.$row["id_paciente"].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>';
         $ver='<a href="../vistas/?id=add_detalle_venta&cod='.$row["numero_orden_a"].'&codigo_pac='.$row["id_paciente"].'">';
         $b='<a href="../form_editar/formulario_editar_alquiler.php?codigo='.$row["id_equipo_a"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';
          $c='<a href="../vistas/?id=ventas&eliminar='.$row["numero_orden_a"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';
            
           if(date("Y-m-d") > $row['fecha_f']){$color='<font color="red">';
           include "../modelo/conexion.php";
                $sqlr = "UPDATE `ordenes` SET `estado_ord`='Completada' WHERE `id`='".$row["numero_orden_a"]."';";
         mysql_query($sqlr);
           }
           if(date("2013-m-d") == $row['fecha_f']){$color='<font color="green">';}
           if(date("2013-m-d") < $row['fecha_f']){$color='<font color="black">';}
           if(date("2013-m-d") == $row['fecha_f']){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='';}
           if(date("2014-m-d") == $row['fecha_f']){$color='<font color="green">';}
           if(date("2014-m-d") < $row['fecha_f']){$color='<font color="black">';}
           if(date("2014-m-d") == $row['fecha_f']){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='';}
            if($row["regimen"]==''){$r= "Sin Asignar";}
           if($row["regimen"]=='1'){$r= "Contributivo";}
            if($row["regimen"]=='2'){$r= "Subsidiado";}
            if($row["regimen"]=='3'){$r="Vinculado";}
            if($row["regimen"]=='4'){$r= "Particular";}
            if($row["regimen"]=='5'){$r= "Otro";}
            if($row["regimen"]=='7'){$r= "Desplazado con afilación al regimen Contributivo";}
            if($row["regimen"]=='8'){$r="Desplazado con afilación al regimen Subsidiado";}
            if($row["regimen"]=='9'){$r= "Desplazado no asegurado";}
            if($row["regimen"]=='No Aplica'){echo "$regimen";}
            $mes = $row["fecha_a"];
             $t = substr("$mes",-5, 2);
             if($t == date("01")){$m = 'Enero';}
             if($t == date("02")){$m = 'Febrero';}
             if($t == date("03")){$m = 'Marzo';}
             if($t == date("04")){$m = 'Abril';}
             if($t == date("05")){$m = 'Mayo';}
             if($t == date("06")){$m = 'Junio';}
             if($t == date("07")){$m = 'Julio';}
             if($t == date("08")){$m = 'Agosto';}
             if($t == date("09")){$m = 'Septiembre';}
             if($t == date("10")){$m = 'Octubre';}
             if($t == date("11")){$m = 'Noviembre';}
             if($t == date("12")){$m = 'Diciembre';}
            
             if($row["facturado"]!='Facturado'){$check = '<input type="checkbox" name="valor'.$cont.'" value="'.$row["numero_orden_a"].'">';
             $check2 = '<input type="checkbox" name="valor2'.$cont.'" value="'.$row["numero_orden_a"].'">';
             }else{$check='';$check2='';}
           if($row["autorizacion"]=='Pendiente'){$aut = '<font color="purple">Pendiente';}else{$aut = $row["autorizacion"];}
           $table = $table.'<tr><td>'.$color.''.$row["numero_orden_a"].'<font></a></td><td>'.$row["oi"].'<font></a></td><td>'.$ver.''.$aut.'</font></td><td>'.$ver.''.$led.''.$color.''.$row["nombres"].' '.$row["apellidos"].' '.$row["apellido2"].'<font></a></td><td>'.$color.''.$r.'</font></td>
               <td>'.$color.''.$row["fecha_a"].' al '.$row["fecha_f"].'</font></td>
                    <td>'.$color.''.$m.'<font></a></td><td>'.$color.''.$row["estado_ord"].'<font></a></td><td>'.$color.''.$row["llamada"].'<font></a></td><td>'.$color.''.$row["facturado"].'<font></a></td>
                           '.$look.'<td>'.$c.'</td><td>'.$check.'</td><td>'.$check2.'</td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
      
}
?>
       
           
            <table>
                <tr>
                    <td><label><i>Total de Ordenes: </i></label> <input type="text" name="cant"  style="width:20px;height:20px;"  value="<?php echo $cont; ?>"><input type="submit" name="buscar" value="Facturar" class="alt_btn"></td>
                </tr>
                
            </table>  

            </form>
            <?php
        if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sqlx = "DELETE FROM ordenes WHERE id='$Codigo'";
         mysql_query($sqlx, $conexion);
         $sql = "DELETE FROM equipos_ventas WHERE numero_orden_a='$Codigo'";
         mysql_query($sql, $conexion);
        $a2 = '<a href="../vistas/?id=ventas">Archivo de venta # '.$_GET['cod'].'</a>';
         $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`) ";
            $sqlr.= "VALUES ('Se elimino un archivo de venta', '".$a2."', '".$_SESSION['k_username']."')";
            mysql_query($sqlr, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=ventas"</script>'; 
    }
    
    

function valorEnLetras($x) 
{ 
if ($x<0) { $signo = "menos ";} 
else      { $signo = "";} 
$x = abs ($x); 
$C1 = $x; 

$G6 = floor($x/(1000000));  // 7 y mas 

$E7 = floor($x/(100000)); 
$G7 = $E7-$G6*10;   // 6 

$E8 = floor($x/1000); 
$G8 = $E8-$E7*100;   // 5 y 4 

$E9 = floor($x/100); 
$G9 = $E9-$E8*10;  //  3 

$E10 = floor($x); 
$G10 = $E10-$E9*100;  // 2 y 1 


$G11 = round(($x-$E10)*100,0);  // Decimales 
////////////////////// 

$H6 = unidades($G6); 

if($G7==1 AND $G8==0) { $H7 = "Cien "; } 
else {    $H7 = decenas($G7); } 

$H8 = unidades($G8); 

if($G9==1 AND $G10==0) { $H9 = "Cien "; } 
else {    $H9 = decenas($G9); } 

$H10 = unidades($G10); 

if($G11 < 10) { $H11 = "0".$G11; } 
else { $H11 = $G11; } 

///////////////////////////// 
    if($G6==0) { $I6=" "; } 
elseif($G6==1) { $I6="Millón "; } 
         else { $I6="Millones "; } 
          
if ($G8==0 AND $G7==0) { $I8=" "; } 
         else { $I8="Mil "; } 
          
$I10 = "Pesos "; 
$I11 = "ML. "; 

$C3 = $signo.$H6.$I6.$H7.$H8.$I8.$H9.$H10.$I10.$I11; 

return $C3; //Retornar el resultado 

} 

function unidades($u) 
{ 
    if ($u==0)  {$ru = " ";} 
elseif ($u==1)  {$ru = "Un ";} 
elseif ($u==2)  {$ru = "Dos ";} 
elseif ($u==3)  {$ru = "Tres ";} 
elseif ($u==4)  {$ru = "Cuatro ";} 
elseif ($u==5)  {$ru = "Cinco ";} 
elseif ($u==6)  {$ru = "Seis ";} 
elseif ($u==7)  {$ru = "Siete ";} 
elseif ($u==8)  {$ru = "Ocho ";} 
elseif ($u==9)  {$ru = "Nueve ";} 
elseif ($u==10) {$ru = "Diez ";} 

elseif ($u==11) {$ru = "Once ";} 
elseif ($u==12) {$ru = "Doce ";} 
elseif ($u==13) {$ru = "Trece ";} 
elseif ($u==14) {$ru = "Catorce ";} 
elseif ($u==15) {$ru = "Quince ";} 
elseif ($u==16) {$ru = "Dieciseis ";} 
elseif ($u==17) {$ru = "Decisiete ";} 
elseif ($u==18) {$ru = "Dieciocho ";} 
elseif ($u==19) {$ru = "Diecinueve ";} 
elseif ($u==20) {$ru = "Veinte ";} 

elseif ($u==21) {$ru = "Veintiun ";} 
elseif ($u==22) {$ru = "Veintidos ";} 
elseif ($u==23) {$ru = "Veintitres ";} 
elseif ($u==24) {$ru = "Veinticuatro ";} 
elseif ($u==25) {$ru = "Veinticinco ";} 
elseif ($u==26) {$ru = "Veintiseis ";} 
elseif ($u==27) {$ru = "Veintisiente ";} 
elseif ($u==28) {$ru = "Veintiocho ";} 
elseif ($u==29) {$ru = "Veintinueve ";} 
elseif ($u==30) {$ru = "Treinta ";} 

elseif ($u==31) {$ru = "Treintayun ";} 
elseif ($u==32) {$ru = "Treintaydos ";} 
elseif ($u==33) {$ru = "Treintaytres ";} 
elseif ($u==34) {$ru = "Treintaycuatro ";} 
elseif ($u==35) {$ru = "Treintaycinco ";} 
elseif ($u==36) {$ru = "Treintayseis ";} 
elseif ($u==37) {$ru = "Treintaysiete ";} 
elseif ($u==38) {$ru = "Treintayocho ";} 
elseif ($u==39) {$ru = "Treintaynueve ";} 
elseif ($u==40) {$ru = "Cuarenta ";} 

elseif ($u==41) {$ru = "Cuarentayun ";} 
elseif ($u==42) {$ru = "Cuarentaydos ";} 
elseif ($u==43) {$ru = "Cuarentaytres ";} 
elseif ($u==44) {$ru = "Cuarentaycuatro ";} 
elseif ($u==45) {$ru = "Cuarentaycinco ";} 
elseif ($u==46) {$ru = "Cuarentayseis ";} 
elseif ($u==47) {$ru = "Cuarentaysiete ";} 
elseif ($u==48) {$ru = "Cuarentayocho ";} 
elseif ($u==49) {$ru = "Cuarentaynueve ";} 
elseif ($u==50) {$ru = "Cincuenta ";} 

elseif ($u==51) {$ru = "Cincuentayun ";} 
elseif ($u==52) {$ru = "Cincuentaydos ";} 
elseif ($u==53) {$ru = "Cincuentaytres ";} 
elseif ($u==54) {$ru = "Cincuentaycuatro ";} 
elseif ($u==55) {$ru = "Cincuentaycinco ";} 
elseif ($u==56) {$ru = "Cincuentayseis ";} 
elseif ($u==57) {$ru = "Cincuentaysiete ";} 
elseif ($u==58) {$ru = "Cincuentayocho ";} 
elseif ($u==59) {$ru = "Cincuentaynueve ";} 
elseif ($u==60) {$ru = "Sesenta ";} 

elseif ($u==61) {$ru = "Sesentayun ";} 
elseif ($u==62) {$ru = "Sesentaydos ";} 
elseif ($u==63) {$ru = "Sesentaytres ";} 
elseif ($u==64) {$ru = "Sesentaycuatro ";} 
elseif ($u==65) {$ru = "Sesentaycinco ";} 
elseif ($u==66) {$ru = "Sesentayseis ";} 
elseif ($u==67) {$ru = "Sesentaysiete ";} 
elseif ($u==68) {$ru = "Sesentayocho ";} 
elseif ($u==69) {$ru = "Sesentaynueve ";} 
elseif ($u==70) {$ru = "Setenta ";} 

elseif ($u==71) {$ru = "Setentayun ";} 
elseif ($u==72) {$ru = "Setentaydos ";} 
elseif ($u==73) {$ru = "Setentaytres ";} 
elseif ($u==74) {$ru = "Setentaycuatro ";} 
elseif ($u==75) {$ru = "Setentaycinco ";} 
elseif ($u==76) {$ru = "Setentayseis ";} 
elseif ($u==77) {$ru = "Setentaysiete ";} 
elseif ($u==78) {$ru = "Setentayocho ";} 
elseif ($u==79) {$ru = "Setentaynueve ";} 
elseif ($u==80) {$ru = "Ochenta ";} 

elseif ($u==81) {$ru = "Ochentayun ";} 
elseif ($u==82) {$ru = "Ochentaydos ";} 
elseif ($u==83) {$ru = "Ochentaytres ";} 
elseif ($u==84) {$ru = "Ochentaycuatro ";} 
elseif ($u==85) {$ru = "Ochentaycinco ";} 
elseif ($u==86) {$ru = "Ochentayseis ";} 
elseif ($u==87) {$ru = "Ochentaysiete ";} 
elseif ($u==88) {$ru = "Ochentayocho ";} 
elseif ($u==89) {$ru = "Ochentaynueve ";} 
elseif ($u==90) {$ru = "Noventa ";} 

elseif ($u==91) {$ru = "Noventayun ";} 
elseif ($u==92) {$ru = "Noventaydos ";} 
elseif ($u==93) {$ru = "Noventaytres ";} 
elseif ($u==94) {$ru = "Noventaycuatro ";} 
elseif ($u==95) {$ru = "Noventaycinco ";} 
elseif ($u==96) {$ru = "Noventayseis ";} 
elseif ($u==97) {$ru = "Noventaysiete ";} 
elseif ($u==98) {$ru = "Noventayocho ";} 
else            {$ru = "Noventaynueve ";} 
return $ru; //Retornar el resultado 
} 

function decenas($d) 
{ 
    if ($d==0)  {$rd = "";} 
elseif ($d==1)  {$rd = "Ciento ";} 
elseif ($d==2)  {$rd = "Doscientos ";} 
elseif ($d==3)  {$rd = "Trescientos ";} 
elseif ($d==4)  {$rd = "Cuatrocientos ";} 
elseif ($d==5)  {$rd = "Quinientos ";} 
elseif ($d==6)  {$rd = "Seiscientos ";} 
elseif ($d==7)  {$rd = "Setecientos ";} 
elseif ($d==8)  {$rd = "Ochocientos ";} 
else            {$rd = "Novecientos ";} 
return $rd; //Retornar el resultado 
}
if(isset($_GET['codi'])){
    if(isset($_POST["cant"]))
    {
        $n = $_POST["cant"];
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["valor$x"])){
                include "../modelo/conexion.php";
                $sqlr = "UPDATE `ordenes` SET `facturado`='Facturado' WHERE `id`='".$_POST["valor$x"]."';";
         mysql_query($sqlr);
         
        
       //se consulta el id del paciente  
$sql2 = "select * from ordenes WHERE id='".$_POST["valor$x"]."'";
$fila2 =mysql_fetch_array(mysql_query($sql2));
$paciente = $fila2["id_paciente"];
                 
$sql2p = "select * from pacientes WHERE id_paciente='".$paciente."'";
$pa =mysql_fetch_array(mysql_query($sql2p));
$emp = $pa["id_empresa"];
        
                  //Consulta del ultima factura
$sql1 = "SELECT MAX(numero_factura) as id_inc FROM facturas where tipo='FAC' and estado='' ";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$factura = $fila1["id_inc"]+1;
//consultamos todos los datos de los equipos asignado
$sql13 = "SELECT * FROM equipos_ventas WHERE numero_orden_a='".$_POST["valor$x"]."' limit 1";
$fila13 =mysql_fetch_array(mysql_query($sql13));
$fi = $fila13["fecha_a"];
$fv = $fila13["fecha_f"];
$autorizacion = $fila13["autorizacion"];
                  //Consulta el total de los equipos asignados
$sql11 = "SELECT sum(precio_a) as total FROM equipos_ventas WHERE numero_orden_a='".$_POST["valor$x"]."'";
$fila11 =mysql_fetch_array(mysql_query($sql11));
$total = $fila11["total"];



        $orden_int = $_POST["valor$x"];
        $orden_ext = $autorizacion;
        $forma_pago = '';
        $meses = '';
       $pago_pendiente = 'No';        
        $fecha_venc = date("Y-m-d",strtotime("$fi + 1 month"));
        $info = '';
//        $subtotal = $_POST["subtotal"];
//	$iva = $_POST["iva"];
 
        $copagos = 0;
        $fecha_reg= date("Y-m-d");

                
       
$cambio = valorEnLetras($total); 


    //se guarda la factura


    $alquiler= 'ventas';
   	$sql = "INSERT INTO `facturas`(`id_empresa`,`tipo`,`copagos`,`cod_alquiler`, `fechai`, `fechaf`,`letras`,`numero_factura`, `id_paciente`, `orden_int`, `orden_ext`, `forma_pago`, `meses`, `pago_pendiente`, `fecha_ven`, `total`, `informacion`, `fecha_registro`)";

        $sql.= "VALUES ('".$emp."','FAC','".$copagos."','".$alquiler."','".$fi."', '".$fv."','".$cambio."','".$factura."', '".$paciente."', '".$orden_int."', '".$orden_ext."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$fecha_venc."', '".$total."', '".$info."', '".$fecha_reg."')";
	mysql_query($sql);
    
    echo 'La Orden No. :'.$_POST["valor$x"].' ha sido Facturada, El No. de Factura es :'.$factura.'<br>';
       
        
            } 
                        if(isset($_POST["valor2$x"])){
                include "../modelo/conexion.php";
                $sqlr = "UPDATE `ordenes` SET `facturado`='Facturado' WHERE `id`='".$_POST["valor2$x"]."';";
         mysql_query($sqlr);
         
        
       //se consulta el id del paciente  
$sql2 = "select * from ordenes WHERE id='".$_POST["valor2$x"]."'";
$fila2 =mysql_fetch_array(mysql_query($sql2));
$paciente = $fila2["id_paciente"];
                 

        
                  //Consulta del ultima factura
$sql1 = "SELECT MAX(numero_recibo) as id_inc FROM recibo_caja";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$factura = $fila1["id_inc"]+1;
//consultamos todos los datos de los equipos asignado
$sql13 = "SELECT * FROM equipos_ventas WHERE numero_orden_a='".$_POST["valor2$x"]."' limit 1";
$fila13 =mysql_fetch_array(mysql_query($sql13));
$fi = $fila13["fecha_a"];
$fv = $fila13["fecha_f"];
$autorizacion = $fila13["autorizacion"];
                  //Consulta el total de los equipos asignados
$sql11 = "SELECT sum(precio_a) as total FROM equipos_ventas WHERE numero_orden_a='".$_POST["valor2$x"]."'";
$fila11 =mysql_fetch_array(mysql_query($sql11));
$total = $fila11["total"];



        $orden_int = $_POST["valor2$x"];
        $orden_ext = $autorizacion;
        $forma_pago = '';
        $meses = '';
       $pago_pendiente = 'No';        
        $fecha_venc = date("Y-m-d",strtotime("$fi + 1 month"));
        $info = '';
//        $subtotal = $_POST["subtotal"];
//	$iva = $_POST["iva"];
 
        $copagos = 0;
        $fecha_reg= date("Y-m-d");

                
       
$cambio = valorEnLetras($total); 


    //se guarda la factura


    $alquiler= 'ventas';
   	$sql = "INSERT INTO `recibo_caja`(`copagos`,`cod_alquiler`, `fechai`, `fechaf`,`letras`,`numero_recibo`, `id_paciente`, `orden_int`, `orden_ext`, `forma_pago`, `meses`, `pago_pendiente`, `fecha_ven`, `total`, `informacion`, `fecha_registro`)";

        $sql.= "VALUES ('".$copagos."','".$alquiler."','".$fi."', '".$fv."','".$cambio."','".$factura."', '".$paciente."', '".$orden_int."', '".$orden_ext."', '".$forma_pago."', '".$meses."', '".$pago_pendiente."', '".$fecha_venc."', '".$total."', '".$info."', '".$fecha_reg."')";
	mysql_query($sql);
    
    echo 'La Orden No. :'.$_POST["valor2$x"].' ha sido Facturada, El No. de Recibo | Factura es :'.$factura.'<br>';
       
        
            } 
        }     
    }
     echo '<a href="../vistas/?id=ventas">Presione aqui para confirmar el recibo</a>';
}

?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
