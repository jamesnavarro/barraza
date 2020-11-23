<?php  
$requestn=Connection::runQuery('select count(*) from sis_notas  ');
 
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
 <TABLE border="1" class="module width_full">
                       
<COLGROUP>
<COL><COL align="char" char=".">

<TBODY>
<!--     <font color="red">hola</font>-->


<?php if($modulo_rT=='Tareas' && $acceso_rT=='Habilitado'){  ?>
<TR><TD>
     
                        
                        
				<div class="module_content">
                             
                                    
                                   
                                    <fieldset>
                                     <table>
                                          <header><h3>Ordenes internas </h3></header>
                                         <tr><td>
            <?phP if($page7>1){?>
	<a href="../vistas/mostrar_todo.php?page7=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_todo.php?page7=<?php echo $page7 - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page7;?> de <?php echo $last_page7;?>)
<?php
if($page7<$last_page7){?>
	<a href="../vistas/mostrar_todo.php?page7=<?php echo $page7 + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_todo.php?page7=<?php echo $last_page7;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit7 = 'LIMIT ' .($page7 - 1) * $rows_by_page7 .',' .$rows_by_page7;
 
//Hacemos la consulta con nuestros resultados

$a=date("H:i").':00';
if($_SESSION['admin']=='Si'){
if(isset($_GET['orden_emp'])){
    
   if($_GET['orden_emp']=='ordeni'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_servicio order by orden_servicio asc '.$limit7);} 
   if($_GET['orden_emp']=='porcentaje'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_servicio order by id_contacto asc '.$limit7);}
   if($_GET['orden_emp']=='atencioni'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_servicio order by Description asc '.$limit7);}
   if($_GET['orden_emp']=='user'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_servicio order by user asc '.$limit7);}
}else{
    $requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_servicio '.$limit7);
}
} 
else{
    if(isset($_GET['orden_emp'])){
         
   if($_GET['orden_emp']=='ordeni'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_servicio order by orden_interna asc '.$limit7);} 
 if($_GET['orden_emp']=='porcentaje'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_servicio order by id_contacto asc '.$limit7);}
   if($_GET['orden_emp']=='atencioni'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_servicio order by Description asc '.$limit7);}
   if($_GET['orden_emp']=='user'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_servicio order by user asc '.$limit7);}

}
else{
    $requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.est_motivo="activa" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_servicio asc ');
}
}

if($requestemp){
//    echo'<hr>';
    $table = '<table>';

$table = $table.'<thead>';
           $table = $table.'<tr>';
            $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_emp=ordeni"><font color="black">'.'Orden Interna'.'</font></a></th>';
              $table = $table.'<th>'.'Paciente'.'</th>';
              $table = $table.'<th>'.'Ord. Externa'.'</th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_emp=porcentaje"><font color="black">'.'Porcentaje'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_emp=atencioni"><font color="black">'.'Atencion'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_emp=user"><font color="black">'.'Asignado a'.'</font></a></th>';
              $table = $table.'<th>'.'Ver'.'</th>';
              $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       $count ='';
	while($row=mysql_fetch_array($requestemp))
	{       if($row["RecurringRule"]!='R'){
                   
          if($row["id_contacto"]!=''){if($row["id_contacto"]>98){$por='<td>100 %</td>';}else{$por='<td>'.$row["id_contacto"].' %<font></a></td>';}}else{$por='<td>0 %</td>';}
          if($row["id_contacto"]==0){
              $look ='<td><a href="../vistas/consulta.php?codigo='.$row["orden_servicio"].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>';
              $verx='<a href="../vistas/consulta.php?codigo='.$row["orden_servicio"].'">';
          }else{
            $look ='<td><a href="../vistas/detalle_ordenes_internas.php?ord='.$row["orden_servicio"].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>';
            $verx='<a href="../vistas/detalle_ordenes_internas.php?ord='.$row["orden_servicio"].'">';
          }
          
                 
           
           
           $count = $count + 1;
           if($row["Location"]=='Revisado'){$led = '<img src="../images/ok.png" alt="ver" height="10px" width="10px">';}else{
             if($row["est_motivo"]=='inactiva'){$led = '<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px">';}else{
           if($row["id_contacto"]>=99){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='<img src="../imagenes/pro.png" alt="ver" height="20px" width="20px">';}}} 
             if($row["prioridad"] != 'Facturado'){
                 if($_SESSION['k_username']=='admin'){
                     $table = $table.'<tr><td>'.$led.'</td><td>'.$verx.''.$row["orden_servicio"].'<font></a></td>
               <td>'.$row["nombres"].' '.$row["apellidos"].'<font></a></td><td>'.$row["orden_externa"].'<font></a></td>
               '.$por.'<td>'.$row["Description"].'</font></td>
                  <td>'.$row["user"].'</font></td>'.$look.'
                      </tr>'; 
                 }else{
                     if($row["Location"]!='Revisado'){
                         $table = $table.'<tr><td>'.$led.'</td><td>'.$verx.''.$row["orden_servicio"].'<font></a></td>
               <td>'.$row["nombres"].' '.$row["apellidos"].'<font></a></td><td>'.$row["orden_externa"].'<font></a></td>
               '.$por.'<td>'.$row["Description"].'</font></td>
                  <td>'.$row["user"].'</font></td>'.$look.'
                      </tr>'; 
                     }
                 }
                 
	       
         }
        }
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}

?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>   
        
<!--        <header><h3>Atenciones Médicas</h3></header>
                        
                       
				<div class="module_content">
                             
                                    
                                   
                                    <fieldset>
<table>
<tr><td>
<?phP if($pagex>1){?>
<a href="../vistas/mostrar_todo.php?pagex=1"><img src="../images/a1.png"></a>
<a href="../vistas/mostrar_todo.php?pagex=<?php echo $pagex - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $pagex;?> de <?php echo $last_pagex;?>)
<?php
if($pagex<$last_pagex){?>
<a href="../vistas/mostrar_todo.php?pagex=<?php echo $pagex + 1;?>"><img src="../images/p1.png"></a>
<a href="../vistas/mostrar_todo.php?pagex=<?php echo $last_pagex;?>"><img src="../images/p11.png"></a>
<?php
}else{
?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limitx = 'LIMIT ' .($pagex - 1) * $rows_by_pagex .',' .$rows_by_pagex;

//Hacemos la consulta con nuestros resultados

if($_SESSION["admin"] == 'Si'){
    if(isset($_GET['orden'])){
   if($_GET['ordenvm']=='asuntovm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" order by a.Subject asc '.$limitx);} 
   if($_GET['ordenvm']=='fecha_iniciovm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" order by a.StartTime asc '.$limitx);}
   if($_GET['ordenvm']=='fecha_finvm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" order by a.EndTime asc '.$limitx);}
   if($_GET['ordenvm']=='estadovm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" order by a.estado asc '.$limitx);}
   if($_GET['ordenvm']=='uservm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" order by a.user asc '.$limitx);}
   }
else{
     $requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" group by a.orden_servicio asc '.$limitx);
}}
     
     else{
   if(isset($_GET['orden'])){
   if($_GET['ordenvm']=='asuntovm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" and a.user="'.$_SESSION['k_username'].'" order by a.Subject asc '.$limitx);} 
   if($_GET['ordenvm']=='fecha_iniciovm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" and a.user="'.$_SESSION['k_username'].'" order by a.StartTime asc '.$limitx);}
   if($_GET['ordenvm']=='fecha_finvm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" and a.user="'.$_SESSION['k_username'].'" order by a.EndTime asc '.$limitx);}
   if($_GET['ordenvm']=='estadovm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" and a.user="'.$_SESSION['k_username'].'" order by a.estado asc '.$limitx);}
   if($_GET['ordenvm']=='uservm'){$requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" and a.user="'.$_SESSION['k_username'].'" order by a.user asc '.$limitx);}
  }
  else{
       $requestvm=Connection::runQuery('SELECT a.*, b.* FROM actividad a, ordenes b where a.archivo=b.id and b.estado_ord="En proceso" and a.tarea="Visita" and a.estado="No iniciada" and a.user="'.$_SESSION['k_username'].'" group by a.orden_servicio asc '.$limitx);
  }
     }
if(isset($_POST['mostrar'])){
    $requestvm=Connection::runQuery('SELECT * FROM actividad where tarea="Visita" and estado="No iniciada" and user="'.$_POST['mostrar'].'" group by a.orden_servicio asc '.$limitx);
}

if($requestvm){
//    echo'<hr>';
    $table = '<table>';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Orden Interna'.'</th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenvm=asuntovm"><font color="black">'.'Asunto'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenvm=fecha_iniciovm"><font color="black">'.'Fecha Inicio'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenvm=fecha_finvm"><font color="black">'.'Fecha Fin'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenvm=estadovm"><font color="black">'.'estado'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenvm=uservm"><font color="black">'.'Asignado a'.'</font></a></th>';
             $table = $table.'<th>'.'Ver'.'</th>';
             $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
        $a=date("H:i").':00'; echo $a;
	while($row=mysql_fetch_array($requestvm))
	{        if($row["est_motivo"]=='activa'){
           $ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["Id"].'&orden_servicio='.$row["archivo"].'">';
           $b='<td><a href="../form_editar/formulario_editar_proyecto.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>';
           if($_SESSION["admin"] == 'Si'){$c='<td><a href="../vistas/mostrar_todo.php?eliminar_tar='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td>';}else{$c='';}
            
           if(date("Y-m-d").' '.$a > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='';}
           if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="black">';}
            $look ='<td><a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["Id"].'&orden_servicio='.$row["archivo"].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>';
           $ver22='<a href="../vistas/detalle_ordenes.php?codigo='.$row["archivo"].'">';
            
            if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="Pendiente" || $row['estado']==NULL|| $row['estado']=="Planificada" ){ 
           $table = $table.'<tr><td>'.$ver22.''.$row['orden_servicio'].'</font></a></td><td>'.$ver.' '.$led.' '.$color.''.$row["Subject"].'<font></a></td></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td>'.$look.'</tr>'; 
        }}}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
if(isset($_GET['eliminar_tar']))
    {
        $Codigo=$_GET['eliminar_tar'];
        $sql = "DELETE FROM actividad WHERE Id='$Codigo'";
        mysql_query($sql);
       echo '<script lanquage="javascript">alert("Actividad Eliminada");location.href="../vistas/mostrar_todo.php"</script>'; 
    }
?>
       </td></tr> </table>
                                               
                                  </fieldset>   
				</div>
        -->
        
        
        
        
        
        <header><h3>Mis Actividades</h3></header>
                        
                       
				<div class="module_content">
                             
                                    
                                   
                                    <fieldset>
<table>
<tr><td>
<?phP if($page>1){?>
<a href="../vistas/mostrar_todo.php?page=1"><img src="../images/a1.png"></a>
<a href="../vistas/mostrar_todo.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
<a href="../vistas/mostrar_todo.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
<a href="../vistas/mostrar_todo.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

//Hacemos la consulta con nuestros resultados

if($_SESSION['k_username']=='admin'){
    if(isset($_GET['ordenac'])){
   if($_GET['ordenac']=='asuntoac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" order by Subject asc '.$limit);} 
   if($_GET['ordenac']=='fecha_inicioac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" order by StartTime asc '.$limit);}
   if($_GET['ordenac']=='fecha_finac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" order by EndTime asc '.$limit);}
   if($_GET['ordenac']=='prioridadac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" order by prioridad asc '.$limit);}
   if($_GET['ordenac']=='estadoac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" order by estado asc '.$limit);}
   if($_GET['ordenac']=='userac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad"  order by user asc '.$limit);}
} else {
    $requestac=Connection::runQuery('select * from actividad where tarea="Actividad" order by Id asc '.$limit);
}
}
else{
    if(isset($_GET['ordenac'])){
   if($_GET['ordenac']=='asuntoac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" and user="'.$_SESSION['k_username'].'" order by Subject asc '.$limit);} 
   if($_GET['ordenac']=='fecha_inicioac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" and user="'.$_SESSION['k_username'].'" order by StartTime asc '.$limit);}
   if($_GET['ordenac']=='fecha_finac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" and user="'.$_SESSION['k_username'].'" order by EndTime asc '.$limit);}
   if($_GET['ordenac']=='prioridadac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" and user="'.$_SESSION['k_username'].'" order by prioridad asc '.$limit);}
   if($_GET['ordenac']=='estadoac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad" and user="'.$_SESSION['k_username'].'" order by estado asc '.$limit);}
   if($_GET['ordenac']=='userac'){$requestac=Connection::runQuery('select * from actividad where tarea="Actividad"  and user="'.$_SESSION['k_username'].'" order by user asc '.$limit);}
} else {
    $requestac=Connection::runQuery('select * from actividad where tarea="Actividad" and user="'.$_SESSION['k_username'].'" order by Id asc '.$limit);
}
}
if(isset($_POST['mostrar'])){
    $requestac=Connection::runQuery('select * from actividad where tarea="Actividad" and user="'.$_POST['mostrar'].'" order by Id asc '.$limit);
}

if($requestac){
//    echo'<hr>';
    $table = '<table>';

$table = $table.'<thead>';
           $table = $table.'<tr>';
             $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenac=asuntoac"><font color="black">'.'Asunto'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenac=fecha_inicioac"><font color="black">'.'Fecha Inicio'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenac=fecha_finac"><font color="black">'.'Fecha Fin'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenac=prioridadac"><font color="black">'.'Prioridad'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenac=estadoac"><font color="black">'.'estado'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?ordenac=userac"><font color="black">'.'Asignado a'.'</font></a></th>';
              
              if($modulo_rT=='Tareas' && $editar_rT=='Habilitado'){
                  if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                   $table = $table.'<th>'.'Editar'.'</th>';  
              $table = $table.'<th>'.'Eliminar'.'</th>';
              }else{
                   $table = $table.'<th>'.'Editar'.'</th>';  
              
              }
              }else{
                  if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                     
              $table = $table.'<th>'.'Eliminar'.'</th>';
              }else{
                     
              
              }
              }
             
              $table = $table.'<th>'.''.'</th>';
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
        $a=date("H:i").':00'; echo $a;
	while($row=mysql_fetch_array($requestac))
	{       
           if($modulo_rT=='Tareas' && $ver_rT=='Habilitado'){$ver='<a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'" title="'.$row["Description"].'">';}else{$ver='';}
           if($modulo_rT=='Tareas' && $editar_rT=='Habilitado'){$b='<a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){$c='<a href="../vistas/mostrar_todo.php?eliminar_tar='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
           if(date("Y-m-d").' '.$a > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="black">';}
           
           if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="Pendiente" || $row['estado']==NULL|| $row['estado']=="Planificada" ){ 
           $table = $table.'<tr><td>'.$ver.''.$color.''.$row["Subject"].'<font></a></td></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td><td>'.$color.''.$row['prioridad'].'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td>
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>'; 
	}}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
if(isset($_GET['eliminar_tar']))
    {
        $Codigo=$_GET['eliminar_tar'];
        $sql = "DELETE FROM actividad WHERE Id='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Actividad Eliminada");location.href="../vistas/mostrar_todo.php"</script>'; 
    }
?>
       </td></tr> </table> <?php } ?>
                                               
                                  </fieldset>   
				</div>
    <?php if($modulo_rL=='Llamadasx' && $acceso_rL=='Habilitado'){  ?>                   
    <header><h3>Mis Llamadas</h3></header>
                        
                        
				<div class="module_content">
                             
                                    
                                   
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?phP if($page2>1){?>
	<a href="../vistas/mostrar_todo.php?page2=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_todo.php?page2=<?php echo $page2 - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page2;?> de <?php echo $last_page2;?>)
<?php
if($page2<$last_page2){?>
	<a href="../vistas/mostrar_todo.php?page2=<?php echo $page2 + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_todo.php?page2=<?php echo $last_page2;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit2 = 'LIMIT ' .($page2 - 1) * $rows_by_page2 .',' .$rows_by_page2;
 
//Hacemos la consulta con nuestros resultados
//$asunto='<a href="../vistas/mostrar_todo.php?codigo=Asunto">Asunto</a>';
//$a=date("H:i").':00'; echo $a;
if($_SESSION['k_username']=='admin'){
     if(isset($_GET['orden_llam'])){
   if($_GET['orden_llam']=='asuntollam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" order by Subject asc '.$limit2);} 
   if($_GET['orden_llam']=='fecha_iniciollam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada"  order by StartTime asc '.$limit2);}
   if($_GET['orden_llam']=='fecha_finllam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada"  order by duracion asc '.$limit2);}
   if($_GET['orden_llam']=='estadollam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" order by estado asc '.$limit2);}
   if($_GET['orden_llam']=='userllam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada"  order by user asc '.$limit2);}
}
 else {
    $requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" order by Id asc '.$limit2);
}
}
else{
     if(isset($_GET['orden_llam'])){
   if($_GET['orden_llam']=='asuntollam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" and user="'.$_SESSION['k_username'].'" order by Subject asc '.$limit2);} 
   if($_GET['orden_llam']=='fecha_iniciollam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" and user="'.$_SESSION['k_username'].'" order by StartTime asc '.$limit2);}
   if($_GET['orden_llam']=='fecha_finllam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" and user="'.$_SESSION['k_username'].'" order by duracion asc '.$limit2);}
   if($_GET['orden_llam']=='estadollam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" and user="'.$_SESSION['k_username'].'" order by estado asc '.$limit2);}
   if($_GET['orden_llam']=='userllam'){$requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" and user="'.$_SESSION['k_username'].'" order by user asc '.$limit2);}
}
else {
    $requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" and user="'.$_SESSION['k_username'].'" order by Id asc '.$limit2);
}
    }
    
if(isset($_POST['mostrar'])){
    $requestllam=Connection::runQuery('select * from actividad where tarea="Llamada" and user="'.$_POST['mostrar'].'" order by Id asc '.$limit2);
}

if($requestllam){
//    echo'<hr>';
    $table = '<table>';

$table = $table.'<thead>';
           $table = $table.'<tr>';
               $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_llam=asuntollam"><font color="black">'.'Asunto'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_llam=fecha_iniciollam"><font color="black">'.'Fecha Inicio'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_llam=fecha_finllam"><font color="black">'.'Duracion H/M'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_llam=estadollam"><font color="black">'.'Estado'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_llam=userllam"><font color="black">'.'Asignado a'.'</font></a></th>';
            
        if($modulo_rL=='Llamadas' && $editar_rL=='Habilitado'){
            if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                $table = $table.'<th>'.'Editar'.'</th>';
               $table = $table.'<th>'.'Eliminar'.'</th>';
            }else{
                $table = $table.'<th>'.'Editar'.'</th>';
               
            }
        }else{
            if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                
               $table = $table.'<th>'.'Eliminar'.'</th>';
            }else{
                
               
            }
        }
               
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($requestllam))
	{       
           if($modulo_rL=='Llamadas' && $ver_rL=='Habilitado'){$ver='<a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'">';}else{$ver='';}
           if($modulo_rL=='Llamadas' && $editar_rL=='Habilitado'){$b='<a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){$c='<a href="../vistas/mostrar_todo.php?eliminar_lla='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
           if(date("Y-m-d").' '.$a > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="black">';}
          
            if($row['estado']=="Planificada" || $row['estado']==NULL){ 
           
           $table = $table.'<tr><td>'.$ver.''.$color.''.$row["Subject"].'<font></a></td></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td>
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';
	}}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
if(isset($_GET['eliminar_lla']))
    {
        $Codigo=$_GET['eliminar_lla'];
        $sql = "DELETE FROM actividad WHERE Id='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_todo.php"</script>'; 
    }
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
   <?PHP } if($modulo_rR=='Reuniones' && $acceso_rR=='Habilitado'){  ?>
    <header><h3>Mis Reuniones</h3></header>
                        
                        
				<div class="module_content">
                             
                                    
                                   
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?phP if($page3>1){?>
	<a href="../vistas/mostrar_todo.php?page3=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_todo.php?page3=<?php echo $page3 - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page3;?> de <?php echo $last_page3;?>)
<?php
if($page3<$last_page3){?>
	<a href="../vistas/mostrar_todo.php?page3=<?php echo $page3 + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_todo.php?page3=<?php echo $last_page3;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit3 = 'LIMIT ' .($page3 - 1) * $rows_by_page3 .',' .$rows_by_page3;
 
//Hacemos la consulta con nuestros resultados

$a=date("H:i").':00'; echo $a;
if($_SESSION['k_username']=='admin'){
     if(isset($_GET['orden_reu'])){
   if($_GET['orden_reu']=='asuntoreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" order by Subject asc '.$limit3);} 
   if($_GET['orden_reu']=='fecha_inicioreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" order by StartTime asc '.$limit3);}
   if($_GET['orden_reu']=='fecha_finreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" order by EndTime asc '.$limit3);}
   if($_GET['orden_reu']=='prioridadreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" order by prioridad asc '.$limit3);}
   if($_GET['orden_reu']=='estadoreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" order by estado asc '.$limit3);}
   if($_GET['orden_reu']=='userreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" order by user asc '.$limit3);}
}
else 
{
    $requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" order by Id asc '.$limit3);
}
   }
   else {
        if(isset($_GET['orden_reu'])){
   if($_GET['orden_reu']=='asuntoreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" and user="'.$_SESSION['k_username'].'" order by Subject asc '.$limit3);} 
   if($_GET['orden_reu']=='fecha_inicioreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" and user="'.$_SESSION['k_username'].'" order by StartTime asc '.$limit3);}
   if($_GET['orden_reu']=='fecha_finreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" and user="'.$_SESSION['k_username'].'" order by EndTime asc '.$limit3);}
   if($_GET['orden_reu']=='prioridadreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" and user="'.$_SESSION['k_username'].'" order by prioridad asc '.$limit3);}
   if($_GET['orden_reu']=='estadoreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" and user="'.$_SESSION['k_username'].'" order by estado asc '.$limit3);}
   if($_GET['orden_reu']=='userreu'){$requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" and user="'.$_SESSION['k_username'].'" order by user asc '.$limit3);}
        }
else{
    $requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" and user="'.$_SESSION['k_username'].'" order by Id asc '.$limit3);
}
   }
if(isset($_POST['mostrar'])){
    $requestreu=Connection::runQuery('select * from actividad where tarea="Reunion" and user="'.$_POST['mostrar'].'" order by Id asc '.$limit3);
}
if($requestreu){
//    echo'<hr>';
    $table = '<table>';

$table = $table.'<thead>';
           $table = $table.'<tr>';
               $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_reu=asuntoreu"><font color="black">'.'Asunto'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_reu=fecha_inicioreu"><font color="black">'.'Fecha/Hora Inicio'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_reu=fecha_finreu"><font color="black">'.'Fecha/Hora Fin'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_reu=estadoreu"><font color="black">'.'Estado'.'</font></a></th>';
              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_reu=userreu"><font color="black">'.'Asignado a'.'</font></a></th>';
              
        if($modulo_rR=='Reuniones' && $editar_rR=='Habilitado'){
            if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                  $table = $table.'<th>'.'Editar'.'</th>';
               $table = $table.'<th>'.'Eliminar'.'</th>';
              }else{
                  $table = $table.'<th>'.'Editar'.'</th>';
               
              }
        }else{
            if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                 
               $table = $table.'<th>'.'Eliminar'.'</th>';
              }else{
                
               
              }
        }
              
              
           $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($requestreu))
	{       
           if($modulo_rR=='Reuniones' && $ver_rR=='Habilitado'){$ver='<a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'">';}else{$ver='';}
           if($modulo_rR=='Reuniones' && $editar_rR=='Habilitado'){$b='<a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){$c='<a href="../vistas/mostrar_todo.php?eliminar_re='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
           if(date("Y-m-d").' '.$a > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="black">';}
          
           
           if($row['estado']=="Planificada" || $row['estado']==NULL){ 
           $table = $table.'<tr><td>'.$ver.''.$color.''.$row["Subject"].'<font></a></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td>
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';  
	}}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
if(isset($_GET['eliminar_re']))
    {
        $Codigo=$_GET['eliminar_re'];
        $sql = "DELETE FROM actividad WHERE Id='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_todo.php"</script>'; 
    }
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
    <?PHP } if($_SESSION['admin'] == 'Si'){ ?>
    <?PHP if($_SESSION['k_username'] == 'admin'){ ?>
    <TD><header><h3>Archivo general del paciente</h3></header>
                        
                        
				<div class="module_content">
                             
                                    
                                   
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?phP if($page4>1){?>
	<a href="../vistas/mostrar_todo.php?page4=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_todo.php?page4=<?php echo $page4 - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page4;?> de <?php echo $last_page4;?>)
<?php
if($page4<$last_page4){?>
	<a href="../vistas/mostrar_todo.php?page4=<?php echo $page4 + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_todo.php?page4=<?php echo $last_page4;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit4 = 'LIMIT ' .($page4 - 1) * $rows_by_page4 .',' .$rows_by_page4;
 
//Hacemos la consulta con nuestros resultados

if($_SESSION['admin']=='Si'){
  $request4=Connection::runQuery('select a.*, b.*, c.user,(select sum(c.cant_med) as p from actividad c where c.archivo=a.id and c.estado="Completada") as por from ordenes a, pacientes b, actividad c where a.estado_ord="En proceso" and a.id_paciente=b.id_paciente and a.id_paciente=c.id_paciente group by a.id asc '.$limit4); 

}
else{
    $request4=Connection::runQuery('select a.*, b.*, c.user,(select sum(c.cant_med) as p from actividad c where c.archivo=a.id and c.estado="Completada")
    as por from ordenes a, pacientes b, actividad c where a.estado_ord="En proceso" and a.id_paciente=b.id_paciente and a.id_paciente=c.id_paciente  and c.user="'.$_SESSION['k_username'].'" group by a.id asc '.$limit4);
  
  }

if($request4){
//    echo'<hr>';
    $table = '<table>';

$table = $table.'<thead>';
           $table = $table.'<tr>';
           $table = $table.'<th>'.'Estado'.'</th>';
             if($_SESSION["admin"] == 'Si'){$table = $table.'<th>'.'Archivo'.'</th>';}
              $table = $table.'<th>'.'Atenciones a'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>'; 
              $table = $table.'<th>'.'Visitas Al'.'</th>';
              $table = $table.'<th>'.'Ver'.'</th>';
              
         
              
           $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       $p =0;
	while($row=mysql_fetch_array($request4))
	{      
           if($row['orden']==''){
            if($row['estado']=='Completada'){$p = $p + 1 ;}
           $ver2='<a href="../vistas/detalle_ordenes.php?codigo='.$row["id"].'">';
           if($modulo_rCL=='Clientes' && $ver_rCL=='Habilitado'){$ver='<a href="../vistas/detalle_ordenes.php?codigo='.$row["id"].'">';}else{$ver='';}
           if($_SESSION["admin"] == 'Si'){$b='<td><a href="../form_editar/formulario_editar_contacto_potencial.php?codigo='.$row["id_paciente"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>';}else{$b='';}
           if($_SESSION["admin"] == 'Si'){$c='<td><a href="../vistas/mostrar_todo.php?eliminar_cp='.$row["id_paciente"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td>';}else{$c='';}
           
           $look ='<td><a href="../vistas/detalle_ordenes.php?codigo='.$row["id"].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>';
          
           if($row["por"]>=97){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='<img src="../imagenes/pro.png" alt="ver" height="20px" width="20px">';}
           
            
            if($_SESSION["admin"] == 'Si'){if($row["por"]>=97 && $row["por"]<110){$t= '<td>100 %</td>';}else{$t='<td>'.$row["por"].' %</td>';}}else{$t='';}
            if($_SESSION["k_username"] == 'admin'){
                $table = $table.'<tr><td>'.$led.'</td><td>'.$row["id"].'</font></td><td>'.$ver.''.$row["nombres"].' '.$row["apellidos"].'<font></a></td>
              <td>'.$row["estado_ord"].'</font></td>'.$t.''.$look.'</tr>';
            }else{
                if($row['facturado']!='Revisado'){
                    $table = $table.'<tr><td>'.$led.'</td><td>'.$row["id"].'</font></td><td>'.$ver.''.$row["nombres"].' '.$row["apellidos"].'<font></a></td>
              <td>'.$row["estado_ord"].'</font></td>'.$t.''.$look.'</tr>';
                }
            }
           }
            
          
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}

?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
                                    </div>
    <?PHP  } if($modulo_rO=='Oportunidades' && $acceso_rO=='Habilitado'){  ?>
   
				</div>
        <?PHP } if($modulo_rCA=='Casos' && $acceso_rCA=='Habilitado'){  ?>
<!--                       <header><h3>Facturas Pendientes</h3></header>
                        
                        
				<div class="module_content">
                             
                                    
                                   
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?phP if($page>1){?>
	<a href="../vistas/mostrar_todo.php?page6=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_todo.php?page6=<?php echo $page6 - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page6;?> de <?php echo $last_page6;?>)
<?php
if($page6<$last_page6){?>
	<a href="../vistas/mostrar_todo.php?page6=<?php echo $page6 + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_todo.php?page6=<?php echo $last_page6;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit6 = 'LIMIT ' .($page6 - 1) * $rows_by_page6 .',' .$rows_by_page6;
 
//Hacemos la consulta con nuestros resultados


$request6=Connection::runQuery('select a.*, b.*, c.* from facturas a, pacientes b, ordenes c where a.pago_pendiente="Si" and a.id_paciente=b.id_paciente and a.orden_int=c.id '.$limit6);
if($request6){
//    echo'<hr>';
    $table = '<table class="lista">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'# Factura'.'</th>';
              $table = $table.'<th>'.'# Orden Int.'.'</th>';
              $table = $table.'<th>'.'# Orden Ext'.'</th>';
              $table = $table.'<th>'.'Paciente'.'</th>';
            
              $table = $table.'<th>'.'Total'.'</th>';
              $table = $table.'<th>'.'Fecha de Registro'.'</th>';

              $table = $table.'</tr>';
              $table = $table.'</thead>';
              
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request6))
	{     
            if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver2='<a href="../vistas/facturacion_1.php?fact='.$row["id"].'">';}else{$ver2='';}
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/contacto_potencial.php?codigo='.$row["id_paciente"].'">';}else{$ver='';}
           if($modulo_rCAM=='Campañas' && $editar_rCAM=='Habilitado'){$b='<a href="../vistas/reg_orden.php?codigo='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rCAM=='Campañas' && $eliminar_rCAM=='Habilitado'){$c='<a href="../vistas/facturas_pagas.php?eliminar='.$row["id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
            if($row["total"]>98 && $row["total"]<110){$t= 100;}else{$t=$row["total"];}
          
           
           
           $table = $table.'<tr><td>'.$ver2.''.$row["numero_factura"].'<font></a></td><td>'.$ver2.''.$row["orden_int"].'<font></a></td><td>'.$row["orden_ext"].'<font></a></td>
               <td>'.$ver.''.$row["nombres"].' '.$row["apellidos"].'</font></td></td><td>'.$t.'<font></a></td>
               <td>'.$row["fecha_registro"].'<font></a></td>
                   </tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}
if(isset($_GET['eliminar_ca']))
    {
        $Codigo=$_GET['eliminar_ca'];
        $sql = "DELETE FROM sis_casos WHERE id_caso='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_todo.php"</script>'; 
    }
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   -->
				</div>
                       <?PHP }  ?>
           <header><h3>Ordenes Externas </h3></header>
                        
                        
				<div class="module_content">
                             
                                    
                                   
                                    <fieldset>
                                     <table>
                                         <tr><td>
 

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta

 
//Hacemos la consulta con nuestros resultados

$a=date("H:i").':00';
if($_SESSION['admin']=='Si'){
if(isset($_GET['orden_emp'])){
    
   if($_GET['orden_emp']=='ordenie'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_externa order by orden_servicio asc ');} 
   if($_GET['orden_emp']=='porcentajee'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_externa order by id_contacto asc ');}
   if($_GET['orden_emp']=='atencioni'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_externa order by Description asc ');}
   if($_GET['orden_emp']=='user'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_externa order by user asc ');}
}else{
    $requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso"  group by a.orden_externa  ');
}
} 
else{
    if(isset($_GET['orden_emp'])){
         
   if($_GET['orden_emp']=='ordenie'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_externa order by orden_externa asc ');} 
 if($_GET['orden_emp']=='porcentajee'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_externa order by id_contacto asc ');}
   if($_GET['orden_emp']=='atencioni'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_externa order by Description asc ');}
   if($_GET['orden_emp']=='user'){$requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_externa order by user asc ');}

}
else{
    $requestemp=Connection::runQuery('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.est_motivo="activa" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id and c.estado_ord="En proceso" and a.user="'.$_SESSION['k_username'].'"  group by a.orden_externa asc ');
}
}

if($requestemp){
//    echo'<hr>';
    $table = '<table>';

$table = $table.'<thead>';
           $table = $table.'<tr>';
            $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Orden Externa'.'</font></th>';
              
              $table = $table.'<th>'.'Porcentaje'.'</font></a></th>';
//              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_emp=atencioni"><font color="black">'.'Atencion'.'</font></a></th>';
//              $table = $table.'<th><a href="../vistas/mostrar_todo.php?orden_emp=user"><font color="black">'.'Asignado a'.'</font></a></th>';
              $table = $table.'<th>'.'Ver'.'</th>';
              $table = $table.'</tr>';
$table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       $count ='';
	while($row=mysql_fetch_array($requestemp))
	{       
                   $look ='<td><a href="../vistas/detalle_ordenes_externa.php?codigo='.$row["orden_externa"].'"><img src="../imagenes/ojo.png" alt="ver" height="20px" width="20px"></a></td>';
            if($_SESSION['admin']=='Si'){$por='<td>'.$row["por_ext"].' %<font></a></td>'; }else{if($row["id_contacto"]!=''){if($row["id_contacto"]>98){$por='<td>100 %</td>';}else{$por='<td>'.$row["id_contacto"].' %<font></a></td>';}}else{$por='<td>0 %</td>';}}
                 
            if($_SESSION['admin']=='Si'){
                if($row["Location"]=='Revisado'){$led = '<img src="../images/ok.png" alt="ver" height="10px" width="10px">';}else{
                if($row["por_ext"] >=99){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='<img src="../imagenes/pro.png" alt="ver" height="20px" width="20px">';}}
            }else{
                if($row["Location"]=='Revisado'){$led = '<img src="../images/ok.png" alt="ver" height="10px" width="10px">';}else{
                if($row["id_contacto"] >=99){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='<img src="../imagenes/pro.png" alt="ver" height="20px" width="20px">';}}
            }
            
         
           $ver2='<a href="../vistas/detalle_ordenes_internas.php?ord='.$row["orden_externa"].'">';
           $verx='<a href="../vistas/detalle_ordenes_externa.php?codigo='.$row["orden_externa"].'">';
           $count = $count + 1;
           if($row["prioridad"] != 'Facturado'){
               if($_SESSION['k_username']=='admin'){
                   $table = $table.'<tr><td>'.$led.'</td><td>'.$verx.''.$row["orden_externa"].'<font></a></td>
               '.$por.' '.$look.' </tr>';  
               }else{
                   if($row["Location"]!='Revisado'){
                       $table = $table.'<tr><td>'.$led.'</td><td>'.$verx.''.$row["orden_externa"].'<font></a></td>
               '.$por.' '.$look.' </tr>';  
                   }
               }
                
	       
           }
          
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
if(isset($_GET['eliminar_em']))
    {
        $Codigo=$_GET['eliminar_em'];
        $sql = "DELETE FROM sis_empresa WHERE id_empresa='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_todo.php"</script>'; 
    }
    if(isset($_GET['eliminar_c']))
    {
        $Codigo=$_GET['eliminar_c'];
        $sql = "DELETE FROM sis_casos WHERE id_caso='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_todo.php"</script>'; 
    }
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>  
             <?PHP }  ?>

</TABLE>
<article class="module width_full">
			<header><h3>Notas</h3></header>
                        
                         <?php if($modulo_rN=='Notas' && $listar_rN=='Habilitado'){ ?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="../vistas/mostrar_notas.php" method="post" enctype="multipart/form-data">
                                     <div>
                                         
                              
                                    
                                                        
				    </div> </form>
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?php
if($pagen>1){?>
	<a href="../vistas/mostrar_todo.php?pagen=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_todo.php?pagen=<?php echo $pagen - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $pagen;?> de <?php echo $last_pagen;?>)
<?php
if($pagen<$last_pagen){?>
	<a href="../vistas/mostrar_todo.php?pagen=<?php echo $pagen + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_todo.php?pagen=<?php echo $last_pagen;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limitn = 'LIMIT ' .($pagen - 1) * $rows_by_pagen .',' .$rows_by_pagen;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["asunto_bus"])){
$nom =$_POST["asunto_bus"];
$con =$_POST["contacto_bus"];
$est =$_POST["estado"];
$use =$_POST["user"];

if($nom =='' && $con =='' && $est =='' && $use ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
if($_SESSION['k_username']=='admin'){ 
     $request=Connection::runQuery("select * from sis_notas  order by id_nota asc ".$limitn);
 }  else {
     $request=Connection::runQuery("select * from sis_notas  where asignado_n='".$_SESSION['k_username']."' order by id_nota asc ".$limitn);
 }
}
if($con !='' && $nom =='' || $con !='' && $nom !='' || $con !='' && $est !='' || $con !='' && $est =='' || $con !='' && $use !='' || $con !='' && $use ==''){
   if($_SESSION['k_username']=='admin'){
       $request=Connection::runQuery("select a.*, b.nombre_cont, b.apellido_cont from sis_notas a, sis_contacto b WHERE a.asunto_n LIKE '%".$nom."%' and b.nombre_cont LIKE '%".$con."%' and a.id_contacto=b.id_contacto group by id_nota");
   }else{
       $request=Connection::runQuery("select a.*, b.nombre_cont, b.apellido_cont from sis_notas a, sis_contacto b and a.user='".$_SESSION['k_username']."'  WHERE a.asunto_n LIKE '%".$nom."%' and b.nombre_cont LIKE '%".$con."%' and a.id_contacto=b.id_contacto group by id_nota");
    
   }
}
if($con =='' && $nom !='' || $con =='' && $est !=''|| $con =='' && $use !=''){
   if($_SESSION['k_username']=='admin'){ 
$nom =$_POST["asunto_bus"];
$request=Connection::runQuery("select * from sis_notas   and asunto_n LIKE '%".$nom."%' and estado_n LIKE '%".$est."%' and asignado_n LIKE '%".$use."%' group by id_nota asc ".$limitn);
}  else {
  $nom =$_POST["asunto_bus"];
$request=Connection::runQuery("select * from sis_notas  where asignado_n='".$_SESSION['k_username']."' and asunto_n LIKE '%".$nom."%' and estado_n LIKE '%".$est."%' and asignado_n LIKE '%".$use."%' group by id_nota asc ".$limitn);
  
}}}
else{
 if($_SESSION['k_username']=='admin'){ 
     $request=Connection::runQuery("select * from sis_notas order by id_nota asc ".$limitn);
 }  else {
     $request=Connection::runQuery("select * from sis_notas where asignado_n='".$_SESSION['k_username']."' order by id_nota asc ".$limitn);
 }



}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';
$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Asunto'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              
             
              $table = $table.'<th>'.'Asignado a'.'</th>';
               $table = $table.'<th>'.'Fecha de Registro'.'</th>';
             $table = $table.'<th>'.'Fecha de Respuesta'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';  
              $table = $table.'<th>'.'Eliminar'.'</th>';
//              $table = $table.'<th>'.''.'</th>';
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
           if($modulo_rN=='Notas' && $ver_rN=='Habilitado'){$ver='<a href="../vistas/mostrar_nota.php?codigo='.$row["id_nota"].'">';}else{$ver='';}
           if($modulo_rN=='Notas' && $editar_rN=='Habilitado'){$b='<a href="../form_editar/formulario_editar_notas.php?codigo='.$row["id_nota"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rN=='Notas' && $eliminar_rN=='Habilitado'){$c='<a href="../vistas/ordenes_internas.php?eliminarn='.$row["id_nota"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
       
           
           
           $table = $table.'<tr><td>'.$ver.''.$row["asunto_n"].'<font></a></td></td>
               <td>'.$row["estado_n"].'</font></td>
                   <td>'.$row['asignado_n'].'</font></td><td>'.$row['fecha_creacion'].'</font></td><td>'.$row['fecha_modificacion'].'</font></td>
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminarn']))
    {
        $Codigo=$_GET['eliminarn'];
        $sql = "DELETE FROM sis_notas WHERE id_nota='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Actividad Eliminada");location.href="../vistas/mostrar_todo.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>