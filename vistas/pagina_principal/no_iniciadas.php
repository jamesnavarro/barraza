<?php
$request=mysql_Query('select max(orden_servicio) from actividad');
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 20;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}$_SESSION['t'] = $_POST;
$requestn=mysql_Query('select count(*) from sis_notas  ');
 
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


if($page>1){?>
	<a href="../vistas/id=ordenes&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=ordenes&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=ordenes&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=ordenes&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
$sql1 = "SELECT count(*) as idcaso FROM receta where estado_r=''";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$s = $fila1["idcaso"];
?>
<a href="../vistas/?id=ordenes_s" title="ver solicitudes de atenciones, de click aqui para ver">Solicitudes de ordenes internas(<font color="red"><?php echo $s ?></font>)</a>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 

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

$request=  mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id   group by orden_servicio  '.$limit);
}

if($oi !='' ||$nom !='' || $ape !=''|| $doc !=''|| $ord !='' || $est !='' || $fac !='' || $desde !='' || $arc !='' || $factura !='' || $empresa!=''){
    if($est==""){$linea='';}else{if($est==99){$linea='a.id_contacto>=99 and ';}else{$linea='a.id_contacto<=98 and ';}}
    if($desde=='' && $hasta==''){$f='';}else{$f ='a.fecha_reg_ta>="'.$desde.'" and a.fecha_reg_ta<="'.$hasta.'" and ';}
$request=  mysql_query("SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where ".$f." ".$linea." a.prioridad like '%".$factura."%' and b.id_empresa like '".$empresa."%'  and a.orden_servicio like '".$oi."%' and a.Location like '%".$fac."%' and b.nombres like '%".$nom."%' and b.apellidos like '%".$ape."%' and b.numero_doc like '%".$doc."%' and a.orden_externa like '%".$ord."%' and a.archivo=c.id and a.id_paciente=b.id_paciente and a.user LIKE '%".$arc."%' group by a.orden_servicio");
}}
else{

$request=  mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.prioridad!="Facturado" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc '.$limit);
}
if($request){
//    echo'<hr>';
    $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'# O.I'.'</th>';
              $table = $table.'<th width="5%">'.'# O.E'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Atencion'.'</th>';
              $table = $table.'<th width="5%">'.'Cantidad'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Porcentaje'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Revisados'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Facturado'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'# Documento'.'</th>';
              $table = $table.'<th width="15%">'.'Nombres'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Fecha de ingreso'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Fecha Inicio/Fin'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Asignado a'.'</th>'; 
              $table = $table.'<th class="hidden-phone">'.'Firmas'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
$a=date("H:i").':00';
$tt=0;
	
                  while($row=mysql_fetch_array($request))
	   {       $tt = $tt + 1;
           if($row["Location"]=='Revisado'){$led = '<img src="../images/ok.png" alt="ver" height="10px" width="10px">';}else{
           if($row["est_motivo"]=='inactiva'){$led = '<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px">';}else{
           if($row["id_contacto"]>=99){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='<img src="../imagenes/pro.png" alt="ver" height="20px" width="20px">';}}} 
           $ver2='<a href="../vistas/?id=ver_orden_interna&ord='.$row["orden_servicio"].'">';
           $ver='<a href="../vistas/?id=ver_orden_externa&codigo='.$row["orden_externa"].'">';
          
           if($row["id_contacto"]!=''){$por='<td class="hidden-phone">'.number_format($row["id_contacto"]).' %<font></a></td>';}else{$por='<td class="hidden-phone">0 %</td>';}
          
           if(date("Y-m-d") > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d") == $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d") < $row['EndTime']){$color='<font color="black">';}
           if($row["id_contacto"]>98){$et ='Completado';}else{$et ='En Proceso';}
           if($row["urgente"]=='Si'){
                                            $ur = '<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px"> <b><font color="red">Urgente</font></b>';
                                        }else{
                                            $ur = '';
                                        }
           if($row["prioridad"]=='activa'){$sa = 'No Facturado';}else{$sa =$row["prioridad"];}
           $table = $table.'<tr><td width="5%">'.$led.' '.$ver2.''.$row["orden_servicio"].'<font></a></td><td width="5%">'.$ver.''.$row["orden_externa"].'<font></a><br>'.$ur.'</td><td class="hidden-phone">'.$row["Description"].'<font></a></td><td width="5%">'.$row["cant"].'<font></a></td>'.$por.'</td><td class="hidden-phone">'.$ver2.''.$et.'<font></a></td><td class="hidden-phone">'.$row["Location"].'<font></a></td><td class="hidden-phone">'.$sa.'<font></a></td><td class="hidden-phone">'.$row["numero_doc"].'<font></a></td>
               <td width="15%"><a href="../vistas/?id=ver_paciente&cod='.$row["id_paciente"].'">'.$row["nombres"].' '.$row["nombre2"].' '.$row["apellidos"].' '.$row["apellido2"].'</a></td><td class="hidden-phone">'.$row["fecha_reg_ta"].'<font></a></td>
               <td class="hidden-phone">'.$row["StartTime"].' al '.$row["EndTime"].'<font></a></td><td class="hidden-phone">'.$row["user"].'<font></a></td>
                   <td class="hidden-phone"><a href="../vistas/?id=firmas&oi='.$row["orden_servicio"].'"><img src="../imagenes/tarea.png"></a></td>    </tr>';  
           }
        
        
	$table = $table.'</table>';
	echo $table;
        echo 'Total de ordenes por mes '.$tt;
}
