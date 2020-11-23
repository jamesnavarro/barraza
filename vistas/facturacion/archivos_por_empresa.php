<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if(isset($_GET['codigo'])){$_SESSION['orde']=$_GET['codigo'];}

$request=mysql_query('SELECT count(*), c.rips, c.nombre_emp, c.simbolo_emp FROM facturas a, pacientes b, sis_empresa c where a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa="'.$_GET['codigo'].'"');
 
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
}
$_SESSION['formur'] = $_POST;

$data = $_SESSION['formur']; ?>

<form  class="span12 widget shadowed dark form-horizontal bordered" name="buscarA" action="../vistas/imprimir_archivos.php?codigo=<?php echo $request[1].'&emp='.$request[3] ?>" method="post" enctype="multipart/form-data" target="_blank">
           		
                   
                        <header><h4 class="title">Facturas de la empresa :<font color="blue"><?php echo $request[1].' '.$request[2] ?></font></h4></header>
                        
                
				<div class="module_content">
         
                                  
                                


<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["factura1"])){
$fact1 =$_POST["factura1"];
$fact2 =$_POST["factura2"];


if($fact1 =='' && $fact2 =='' ){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=mysql_query("SELECT a.*,(a.fecha_registro) as t, b.*, c.* FROM facturas a, pacientes b, sis_empresa c where  a.pago_pendiente='No' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='".$_GET['codigo']."'  ".$limit);
}

if($fact1 !='' || $fact2 !=''){

$request=mysql_query("select a.*,(a.fecha_registro) as t, b.*, c.* from facturas a, pacientes b, sis_empresa c WHERE  a.pago_pendiente='No' and a.numero_factura >='".$fact1."' and a.numero_factura <='".$fact2."'  and a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='".$_GET['codigo']."' ".$limit);
$request2=mysql_query('select a.*,(a.fecha_registro) as t, b.*, c.*, count(a.numero_factura) from facturas a, pacientes b, sis_empresa c where  a.pago_pendiente="No" and a.numero_factura >= '.$fact1.' and a.numero_factura <= '.$fact2.' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='.$_GET['codigo'].'');

while($row=mysql_fetch_array($request2))
	{ 
    $idus=$row['count(a.numero_factura)'];
}

}
}
else{
$request=mysql_query("SELECT a.*,(a.fecha_registro) as t, b.*, c.* FROM facturas a, pacientes b, sis_empresa c where a.pago_pendiente='No' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='".$_GET['codigo']."'  ".$limit);

}

if($request){
 ?>
      
         <table class="table table-bordered table-striped table-hover" id="">
                <tr>
                    <td><label>Desde:</label><td><input type="text" name="desde"  style="width:50px;height:20px;"  value="<?php if(isset($_POST["factura1"])){echo $_POST["factura1"]; } ?>">
                    <td><label>Hasta : </label><td><input type="text" name="hasta"  style="width:50px;height:20px;"  value="<?php if(isset($_POST["factura2"])){echo $_POST["factura2"]; } ?>"></td>
                    <td>Facturas por bloques <select name="bloque"><option value="No">No</option><option value="Si">Si</option></select></td>
                </tr>
                <tr>
                 
                    <td>
                    <label>regimen :</label><td><select name="regimen" style="width:180px;">
                                                                   <option value="">--Seleccione--</option>
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
                    <td colspan="2">Con diagnostico? <select name="dia"><option value="No">No</option><option value="Si">Si</option></select></td>
                    <td><input type="submit" name="buscar" value="Generar Archivos" class="alt_btn"></td>
                </tr>
                
            </table> 
                                                <?php
                                                      if(isset($idus)){
            echo '<label> Total de Facturas : </label><input type="text" name="cant"  style="width:20px;height:20px;"  value="'.$idus.'">';
        }else{
            echo '<label> Total de Facturas : </label><input type="text" name="cant"  style="width:20px;height:20px;"  value="'.$num_items.'">';
        }
        if($page>1){?><br>
	<a href="../vistas/?id=archivos&codigo=<?php echo $_GET['codigo'] ?>&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=archivos&codigo=<?php echo $_GET['codigo'] ?>&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=archivos&codigo=<?php echo $_GET['codigo'] ?>&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=archivos&codigo=<?php echo $_GET['codigo'] ?>&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>
        <?php
   
    $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
               $table = $table.'<th>'.'Factura.'.'</th>';
              $table = $table.'<th>'.'Orden Int.'.'</th>';
              $table = $table.'<th>'.'Paciente'.'</th>';
               $table = $table.'<th>'.'Total'.'</th>';
              $table = $table.'<th>'.'Fecha'.'</th>';
              
      

              $table = $table.'</tr>';
              $table = $table.'</thead>';
 
     $cont='';
	while($row=mysql_fetch_array($request))
	{     
       $cont = $cont + 1;
       if($row["cod_alquiler"]!=''){
           $ver='<a href="../vistas/?id=facturacion_2&fact='.$row["numero_factura"].'">';
       }else{
           $ver='<a href="../vistas/?id=facturacion_finalizada&fact='.$row["numero_factura"].'">';
       }
               
           
          
           
           
           $table = $table.'<tr><td>'.$ver.''.$row['numero_factura'].'</font></td><td>'.$ver.''.$row["orden_int"].'<font></a></td><td>'.$row["nombres"].' '.$row["apellidos"].'<font></a></td>
               <td>'.$row["total"].'<font></a></td><td>'.$row["t"].'</font></td>';
	}
        $table = $table.'</table>';
        echo $table;
        
        
       
}
?>
           
            <?php
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM sis_empresa WHERE id_empresa='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro de la Empresa Eliminada");location.href="../vistas/mostrar_empresas.php"</script>'; 
    }
    

   if(isset($_GET['cod']))
    {
    if(isset($_POST["cant"]))
    {
   $n = $_POST["cant"];
   for($x=1; $x<=$n; $x=$x+1){ 
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.open('../php-mysql.php?imprimir=".$_POST["valor$x"]."')";
        echo "</script>";        
   }
}}                      
?>

                                               
                        
				</div>
                       
		</article>
 </form>