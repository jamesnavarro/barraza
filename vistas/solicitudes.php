<?php 
session_start();
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
$request=  mysql_query('select count(*) from receta where estado_r=""');
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
$requestn=  mysql_query('select count(*) from sis_notas  ');
 
if($requestn){
	$requestn = mysql_fetch_row($requestn);
	$num_itemsn = $requestn[0];
}else{
	$num_itemsn = 0;
}
$rows_by_pagen = 10;

$last_pagen = ceil($num_itemsn/$rows_by_pagen);

if(isset($_GET['pagen'])){
	$pagen = $_GET['pagen'];
}else{
	$pagen = 1;
}
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
	<script type="text/javascript" src="../js/tcal.js"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        

    


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
<body onload="<?php $das = $_SESSION['t'];if(!empty($das['options'])) echo $das['options']; ?>">
   <?php  include '../vistas/menu.php'; ?>
	
	<section id="main" class="column">

		<div class="clear"></div>
                
		<article class="module width_full">
			<header><h3>lista de Solicitudes hechas</h3></header>
                        
                         <?php  if($modulo_rCAM=='Campañas' && $listar_rCAM=='Habilitado'){?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="../vistas/solicitudes.php" method="post" enctype="multipart/form-data">
                                     <div>
                                  
                                                <fieldset>
                                        
                                        <table style="border:1px solid #000000;" bgcolor="afcae3">
                                             <tr>
                                               
                                            
                                            <td><label># ORDEN externa</label></td>
                                                <td><input name="orden" style="width:130px;height:20px;"></td>
                                                <td><label>Estado de la orden:</label></td>
                                                           <td><select name="estado" style="width:130px;height:20px;">
                                                                   <option value="">..Seleccione...</option>
                                                                   <option value="97">En proceso</option>
                                                                  
                                                                   <option value="99">Completada</option>

                                                               </select></td>
                                                </tr>
                                                
                                                 <tr>
                                                 <td><label># documento:</label></td>
                                                           <td><input name="documento" style="width:130px;height:20px;"></td>
                                                           <td><label>Facturadas :</label></td>
                                                           <td><select name="fact" style="width:130px;height:20px;">
                                                                   <option value="">..Seleccione...</option>
                                                                   <option value="Facturado">Facturado</option>
                                                                   <option value="activa">No Facturado</option>
                                                                   
                                                                   

                                                               </select></td>
                                                 </tr> 
                                                           <tr>
                                                 <td><label>Nombres:</label></td>
                                                           <td><input name="nombre" style="width:130px;height:20px;"></td>
                                                           <td><label>Ordenes Revisadas :</label></td>
                                                           <td><select name="facturas" style="width:130px;height:20px;">
                                                                   <option value="">..Seleccione...</option>
                                                                   <option value="Revisado">Revisadas</option>
                                                                   
                                                                   

                                                               </select></td>
                                                               
                                                           </tr> 
                                                           <tr>
                                                 <td><label>Apellidos:</label></td>
                                                           <td><input name="apellido" style="width:130px;height:20px;"></td>
                                                           <td><label>asignado a :</label></td>
                                                           <td><select name="archivo" style="width:130px;height:20px;">
                                                                   <option value="">..Seleccione..</option>
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `usuarios`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['usuario'];
                                                        
                                                         

                                                            echo"<option value='".$valor1."'>".$valor1."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></td>
                                                           </tr> 
                                                           <tr>
                                                               <td><label>Empresa :</label></td>
                                                               <td>
                                                                   <select name="empresa" style="width:150px;">
                                                                   
                                                          <option value="">Seleccione uno..</option>
                                                          <?php
                                                            include "../modelo/conexion.php";
                                                            $consulta= "select * from sis_empresa where cliente='Si'";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['rips'];
                                                            $valor2=$fila['nombre_emp'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                            
                                                            
                                                        </select>
                                                               </td>
                                                               <td><label>Fecha de ingreso Del :</label></td><td><input name="desde" type="text" class="tcal" value="" style="width:80px;"></td>
                                                           </tr>
                                            
                                            <tr>
                                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                    <input type="reset" value="Limpiar"></td><td><input name="oi" type="text" placeholder="Ord. Interna"  value="" style="width:80px;"></td>
                                                <td><label>Hasta :</label></td><td><input name="hasta" type="text" class="tcal" value="" style="width:80px;"></td>
                                              
                                               
                                            </tr>
                                        </table>
                                        
                                        
                                    </fieldset>      
                                    
                                                        
				    </div></form>
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../vistas/solicitudes.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/solicitudes.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/solicitudes.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/solicitudes.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
$sql1 = "SELECT count(*) as idcaso FROM receta where estado_r=''";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$s = $fila1["idcaso"];
?>
        <a href="" title="ver solicitudes de atenciones, de click aqui para ver">Solicitudes de ordenes internas(<font color="red"><?php echo $s ?></font>)</a>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["orden"])){
$nom =$_POST["nombre"];
$ape =$_POST["apellido"];
$doc =$_POST["documento"];
$ord =$_POST["orden"];
$est =$_POST["estado"];
$desde =$_POST["desde"];
$hasta =$_POST["hasta"];
$fac =$_POST["facturas"];
$arc =$_POST["archivo"];
$factura =$_POST["fact"];
$empresa =$_POST["empresa"];
$oi =$_POST["oi"];
if($oi =='' && $nom =='' && $ape =='' && $doc =='' && $ord =='' && $est =='' && $fac =='' && $desde =='' && $arc ==''&& $factura =='' && $empresa==""){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';

$request=Connection::runQuery('SELECT a.*, b.*, c.*, e.* FROM actividad a, pacientes b, ordenes c, receta e where a.orden_servicio=e.id_orden  and e.estado_r="" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id  group by orden_servicio '.$limit);
}

if($oi !='' ||$nom !='' || $ape !=''|| $doc !=''|| $ord !='' || $est !='' || $fac !='' || $desde !='' || $arc !='' || $factura !='' || $empresa!=''){
    if($est==""){$linea='';}else{if($est==99){$linea='a.id_contacto>=99 and ';}else{$linea='a.id_contacto<=98 and ';}}
    if($desde=='' && $hasta==''){$f='';}else{$f ='a.fecha_reg_ta>="'.$desde.'" and a.fecha_reg_ta<="'.$hasta.'" and ';}
$request=Connection::runQuery("SELECT a.*, b.*, c.*, e.* FROM actividad a, pacientes b, ordenes c, receta e where a.orden_servicio=e.id_orden and ".$f." ".$linea." a.prioridad like '%".$factura."%' and b.id_empresa like '".$empresa."%'  and a.orden_servicio like '".$oi."%' and a.Location like '%".$fac."%' and b.nombres like '%".$nom."%' and b.apellidos like '%".$ape."%' and b.numero_doc like '%".$doc."%' and a.orden_externa like '%".$ord."%' and a.archivo=c.id and a.id_paciente=b.id_paciente and a.user LIKE '%".$arc."%' group by a.orden_servicio");
}}
else{

$request=Connection::runQuery('SELECT a.*, b.*, c.*, e.* FROM actividad a, pacientes b, ordenes c, receta e where a.orden_servicio=e.id_orden and e.estado_r=""   and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio '.$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              $table = $table.'<th>'.'# Orden Externa'.'</th>';
              $table = $table.'<th>'.'Atencion'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
              $table = $table.'<th>'.'Porcentaje'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Revisados'.'</th>';
              $table = $table.'<th>'.'Facturado'.'</th>';
              $table = $table.'<th>'.'# Documento'.'</th>';
              $table = $table.'<th>'.'Nombres'.'</th>';
             $table = $table.'<th>'.'Fecha de ingreso'.'</th>';
              $table = $table.'<th>'.'Fecha Inicio/Fin'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';  
               
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 
$a=date("H:i").':00';
	while($row=mysql_fetch_array($request))
	{      
         if($row["Location"]=='Revisado'){$led = '<img src="../images/ok.png" alt="ver" height="10px" width="10px">';}else{
             if($row["est_motivo"]=='inactiva'){$led = '<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px">';}else{
           if($row["id_contacto"]>=99){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='<img src="../imagenes/pro.png" alt="ver" height="20px" width="20px">';}}} 
              $ver2='<a href="../vistas/detalle_ordenes_internas.php?ord='.$row["orden_servicio"].'">';
           $ver='<a href="../vistas/detalle_ordenes_externa.php?codigo='.$row["orden_externa"].'">';
          
           if($row["id_contacto"]!=''){$por='<td>'.$row["id_contacto"].' %<font></a></td>';}else{$por='<td>0 %</td>';}
          
           if(date("Y-m-d") > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d") == $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d") < $row['EndTime']){$color='<font color="black">';}
           if($row["id_contacto"]>98){$et ='Completado';}else{$et ='En Proceso';}
           if($row["prioridad"]=='activa'){$sa = 'No Facturado';}else{$sa =$row["prioridad"];}
           $table = $table.'<tr><td>'.$led.' '.$ver2.''.$row["orden_servicio"].'<font></a></td><td>'.$ver.''.$row["orden_externa"].'<font></a></td><td>'.$row["Description"].'<font></a></td><td>'.$row["cant"].'<font></a></td>'.$por.'</td><td>'.$ver2.''.$et.'<font></a></td><td>'.$row["Location"].'<font></a></td><td>'.$sa.'<font></a></td><td>'.$row["numero_doc"].'<font></a></td>
               <td><a href="../vistas/contacto_potencial.php?codigo='.$row["id_paciente"].'">'.$row["nombres"].' '.$row["apellidos"].'</a></td></td><td>'.$row["fecha_reg_ta"].'<font></a></td>
               <td>'.$color.''.$row["StartTime"].'<->'.$row["EndTime"].'<font></a></td><td>'.$row["user"].'<font></a></td>
                       </tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM ordenes WHERE id='$Codigo'";
        mysql_query($sql);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/ordenes.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
                    
	
		
		
		
		<div class="spacer"></div>
	</section>
             <?php include '../footer.php'; ?>

</body>

</html>