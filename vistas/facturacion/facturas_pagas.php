<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
$request=mysql_query('select count(*) from facturas where factura_anulada!=0');
//require '../modelo/consultar_campana.php';
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 10;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}$_SESSION['t'] = $_POST;
?>
<!doctype html>
<html lang="en">

<head>

</head>

                
		<article class="module width_full">
			<header><h3>lista de facturas anuladas</h3></header>
                        
                
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                  
                                
                                        
                                        <table class="table table-bordered table-striped table-hover" id="">
                                             <tr>
                                               
                                            
                                            <td><label># Factura:</label><input name="factura" style="width:130px;height:20px;"></td>
                                                </tr>
                                                
                                              
                                            
                                            <tr>
                                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar"></td>
                                                <td></td>
                                              
                                               
                                            </tr>
                                        </table>
                                        
                                        
                                 
                                    
                                                        
				    </div></form>
                                  
                          
            <?php
if($page>1){?>
	<a href="../vistas/?id=facturas_null&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=facturas_null&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=facturas_null&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=facturas_null&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["factura"]) || isset($_POST["orden_int"]) || isset($_POST["orden_ext"]) || isset($_POST["documento"])){
$nom =$_POST["factura"];

if($nom ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>'; 

$request=mysql_query('select * from facturas a, pacientes b, ordenes c where  a.factura_anulada!=0 and a.id_paciente=b.id_paciente and a.orden_int=c.id '.$limit);
}

if($nom !=''){
$request=mysql_query('select * from facturas a, pacientes b where a.factura_anulada="'.$nom.'" and a.id_paciente=b.id_paciente order by a.fecha_registro desc '.$limit);
}}
else{

$request=mysql_query('select * from facturas a, pacientes b where a.factura_anulada!=0 and a.id_paciente=b.id_paciente order by a.fecha_registro desc '.$limit);
}

if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'# Factura'.'</th>';
              $table = $table.'<th>'.'# Orden Int.'.'</th>';
              $table = $table.'<th>'.'Orden Ext.'.'</th>';
              $table = $table.'<th>'.'Paciente'.'</th>';
              $table = $table.'<th>'.'Anulada?'.'</th>';
              $table = $table.'<th>'.'Total'.'</th>';
              $table = $table.'<th>'.'Fecha de Registro'.'</th>';
            
               $table = $table.'<th>'.'Imprimir'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
            if($row["cod_alquiler"]==''){$ver2='<a href="../vistas/?id=facturacion_finalizada&fact='.$row["factura_anulada"].'">';}else{$ver2='<a href="../vistas/?id=facturacion_2&fact='.$row["factura_anulada"].'">';}
           if($ver_prod=='Habilitado'){$ver='<a href="../vistas/?id=ver_paciente&cod='.$row["id_paciente"].'">';}else{$ver='';}
           
            if($row["cod_alquiler"]==''){
                $c='<a target="_blank" href="../php-mysql.php?imprimir='.$row["factura_anulada"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a>';
            }ELSE{
                $c='<a target="_blank" href="../imprimir_alquiler.php?imprimir='.$row["factura_anulada"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a>';
            }
        
           $table = $table.'<tr><td>'.$ver2.''.$row["factura_anulada"].'<font></a></td><td>'.$ver2.''.$row["orden_int"].'<font></a></td><td>'.$row["orden_ext"].'<font></a></td>
               <td>'.$ver.''.$row["nombres"].' '.$row["apellidos"].'</font></td></td><td>'.$row["pago_pendiente"].'<font></a></td><td>'.$row["total"].'<font></a></td>
               <td>'.$row["fecha_registro"].'<font></a></td>
                 
                           <td>'.$c.'</td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM facturas WHERE id_facturas='$Codigo'";
        mysql_query($sql);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/facturas_pagas.php"</script>'; 
    }
    
                         
                         
?>

                                               
                                  </fieldset>   
				</div>
                       
		</article>

