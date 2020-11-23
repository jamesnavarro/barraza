<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$sql1 = "SELECT MAX(orden_servicio) as id_inc FROM actividad";
$fila1 =mysql_fetch_array(mysql_query($sql1));

$max = $fila1["id_inc"]+1;

?>

<!doctype html>
<html lang="en">
<?php

$consultar= "select count(cod_aten) as total from actividad where `orden_externa`='".$_GET['codigo']."' group by cod_aten";
$resultr=  mysql_query($consultar);
$t='';
while($fila=  mysql_fetch_array($resultr)){
$to=$fila['total'];
$t = $t + 1;
 }
////////////////////////////////////
$consulta= "select a.*, b.* from actividad a, pacientes b where a.orden_externa='".$_GET['codigo']."' and a.id_paciente=b.id_paciente GROUP BY orden_externa";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$name=$fila['nombres'].' '.$fila['apellidos'];  
$archivo = $fila['archivo'];
$fact = $fila['relacionado'];
}
 
 
 
 ///////////////////////
 $consulta3= "select * from actividad where `orden_externa`='".$_GET['codigo']."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){ 
$cant=$fila['cant'];
$servicio=$fila['orden_servicio'];
$archivo=$fila['archivo'];
 }
 //////////////////////////////
 $consulta2= "select * from actividad where `orden_externa`='".$_GET['codigo']."'";
$result2=  mysql_query($consulta2);
while($fila2=  mysql_fetch_array($result2)){
$user=$fila2['user'];     
$total3=$fila2['por_ext'];
 } 
 
 
 ?>
<script>
function det_atenciones(){  
ventana_secundaria = window.open("../vistas/resumen_atenciones.php?orden_externa=<?php  echo $_GET["codigo"] ?>&pac=<?php  echo $name ?>","miventana","width=1300,height=600,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>
<body onload="doScroll()" onunload="window.name=document.body.scrollTop">

	
		<div class="clear"></div>
                
		<article class="module width_full">
                  <h4 class="inf">Detalles de la Autorizacion  :<?php 
                                        echo $_GET['codigo'].' ';
                                        echo '(Paciente : ' .$name.')';
                                        ?> </h4><br>
                                        

             </article>
<input type="button" name="cancelar" value="Detalle de Atenciones" onclick="det_atenciones()">
                            <?php if($fact ==''){
                            if($_SESSION["admin"] == 'Si'){  ?> 
 <?php } ?>  <a href='../vistas/?id=add_atenciones&cod=<?php  echo $archivo ?>'><input type="button" name="cancelar" value="Archivo Pincipal"></a>
  
                            <?php if($_SESSION["admin"] == 'Si'){ if ($total3>=99){echo '<a href="../vistas/facturacion_autorizacion.php?fact='.$_GET['codigo'].'"><input type=image src="../imagenes/facturar.gif" width="60" height="20"></a>';}}}else{ ?>
                            <a href='../vistas/facturacion_finalizada.php?fact=<?php echo $fact ; ?>'><input type="button" name="cancelar" value="Ver Factura"></a> <?php } ?>
                    <article class="module width_full">
			
                           <table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">ATENCIONES</font></th></tr></table> 
                          
                       
                       <?php if($_SESSION["admin"] == 'Si'){  ?>
<!--<form action="" method="post" name="fcontacto">
    <header><h3><input type="submit" name="bpr" value="Nuevo"/></h3></header>
                       </form> -->
<?php }
    
     if($_SESSION["admin"] == 'Si'){
$request=mysql_query("select a.*, b.* from actividad a, ordenes b where b.id=a.archivo and a.orden_externa='".$_GET['codigo']."' order by a.Id");
     }else{
      $request=mysql_query("select a.*, b.* from actividad a, ordenes b where a.user='".$_SESSION['k_username']."' and b.id=a.archivo  and a.orden_externa='".$_GET['codigo']."' order by a.Id");
    
     }
if($request){
//    echo'<hr>';
    $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Orden Interna'.'</th>';
              
              $table = $table.'<th>'.'Atencion'.'</th>';
              
              
              $table = $table.'<th>'.'Visita #'.'</th>';
              $table = $table.'<th>'.'Fecha Inicial'.'</th>';
              $table = $table.'<th>'.'Fecha Final'.'</th>';
              $table = $table.'<th>'.'Realizado el Dia'.'</th>';
              
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Porcentaje(%)'.'</th>';
              
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total1=0;
        $por = 0;
	while($row=mysql_fetch_array($request))
	{       
                
           
          if($ver_prod=='Habilitado'){$ver='<a href="../vistas/?id=llenar_atencion&codigo='.$row["Id"].'&orden_servicio='.$row["orden_servicio"].'">';}else{$ver='';}
           if($editar_prod=='Habilitado'){$b='<a href="../vistas/?id=llenar_atencion&codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($_SESSION["admin"] == 'Si'){if( $eliminar_prod=='Habilitado'){$c='<a href="../vistas/detalle_ordenes.php?eliminar_act='.$row["id_empresa"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}}else{$c='';}
           
           if($row['estado']=='Completada'){$color='<font color="green">';}
           if($row['estado']=='No iniciada'){$color='<font color="red">';}
           
          
           if($_SESSION["admin"] == 'Si'){$precio= '<td>$ '.$color.''.$row['precio_total'].'</font></td>'; }else{$precio='';}
           if($row['estado']=='Completada'){$por = $por + 1;}
            $total1= $total1 + 1;
               $var= $row['porcentaje'];
            $table = $table.'<tr><td>'.$color.''.$row['orden_servicio'].'</font></td><td>'.$ver.''.$color.''.$row["cant_ins"].'<font></a></td><td>'.$ver.''.$color.''.$row['Description'].'</font></td></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td><td>'.$color.''.$row["fecha_mod_ta"].'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td><td>'.$color.''.$var.'%</font></td>
                       </tr>';   
           
		
               
	}
        
        
	$table = $table.'</table>';
        
	echo $table;
        
        $total = 100 * $por / $total1;
      
    if($_SESSION["admin"]=='Si'){    
 for($x=1; $x<=$total1; $x=$x+1){ 
     include "../modelo/conexion.php";
         $sql2 = "UPDATE `actividad` SET `por_ext`='".$total."' WHERE  `orden_externa`='".$_GET["codigo"]."'";
         mysql_query($sql2);
    }}
 
 }

       
                       ?>

       <div class="progress progress-striped active"><div class="bar" style="width: <?php if($total==''){echo 0;}else{echo $total;} ?>%"></div> </div>
 <?php if($total==''){echo 0;}else{echo number_format($total);} ?> % Completada 
                       
		</article>
		 
                  
                <article class="module width_full">
			
                        <table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">INSUMOS</font></th></tr></table>  
                        
<?php 

       
if($_SESSION["admin"] == 'Si'){
$request=mysql_query("SELECT a.*, b.*, c.*, max(d.fecha_mod_ta), min(d.fecha_mod_ta) FROM insumos_asignados a, insumos b, ordenes c, actividad d WHERE  d.orden_servicio=a.rel_atencion and c.id=a.numero_orden and a.cod_insumo=b.codigo and a.rel_atencion='".$_GET['codigo']."'  group by id_ia");
}else{
   $request=mysql_query("SELECT a.*, b.*, c.* FROM insumos_asignados a, insumos b, ordenes c WHERE a.asignado_a='".$_SESSION['k_username']."' and c.id=a.numero_orden and a.cod_insumo=b.codigo and a.autorizacion='".$_GET['codigo']."'  group by id_ia");
 
}
if($request){
//    echo'<hr>';
    $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              $table = $table.'<th>'.'# Orden Externa'.'</th>';
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Nombre Insumo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
               $table = $table.'<th>'.'Cant. usadas'.'</th>';
                $table = $table.'<th>'.'Cant. Restante'.'</th>';
              if($_SESSION["admin"] == 'xx'){$table = $table.'<th>'.'Precio x Unid.'.'</th>';}else {'<th></th>';}
              $table = $table.'<th>'.'Fecha Asig.'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              
              if($_SESSION["admin"] == 'Si'){$table = $table.'<th>'.'Eliminar'.'</th>';}else {'<th></th>';}
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total1= 0;
	while($row=mysql_fetch_array($request))
	{       
                
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id_ia"].'">';}else{$ver='';}
           if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){$b='<a href="../form_editar/formulario_editar_proyecto.php?codigo='.$row["id_ia"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
            if($_SESSION["admin"] == 'Si'){if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../modelo/eliminar.php?insumos='.$row["id_ia"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}}else{$c='';}
           
        
           if($_SESSION["admin"] == 'xx'){$precio= '<td>$ '.$row['sub_precio'].'</font></td>'; }else{$precio='';}
           
           $subtotal=$row['autorizacion'];
           if($_SESSION["admin"] == 'xx'){$g='<td>$ '.$subtotal.'</font></td>';}else {$g='<td></td>';}
         
            $table = $table.'<tr><td>'.$row['rel_atencion'].'<font></a></td><td>'.$row['autorizacion'].'<font></a></td>
               <td>'.$row["cod_insumo"].'</font></td><td>'.$row["nombre_insumo"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td> <td>'.$row['cant_usada'].'</font></td> <td>'.$row['cant_restante'].'</font></td>'.$precio.'<td>'.$row['fecha_asignacion'].'</font></td><td>'.$row['asignado_a'].'</font></td><td>'.$c.'</td></tr>';
           
            
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
    
}

       
                       ?>  
		</article>
                <article class="module width_full">
			<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">MEDICAMENTOS</font></th></tr></table>  
                       
                        
<?php 
  
    if($_SESSION["admin"] == 'Si'){
$request=mysql_query("SELECT a.*, (a.id) as i, b.*, c.* FROM medicamentos_asig a, medicamentos b, ordenes c WHERE c.id=a.numero_orden  and a.cod_med=b.codigo_int and a.autorizacion='".$_GET['codigo']."'  group by a.id");
    }else{
      $request=mysql_query("SELECT a.*, (a.id) as i, b.*, c.* FROM medicamentos_asig a, medicamentos b, ordenes c WHERE a.asignado_a='".$_SESSION['k_username']."' and c.id=a.numero_orden  and a.cod_med=b.codigo_int and a.autorizacion='".$_GET['codigo']."'  group by a.id");
   
    }
if($request){
//    echo'<hr>';
 $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
               $table = $table.'<th>'.'# Orden Ext.'.'</th>';
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Nombre Insumo'.'</th>';
              $table = $table.'<th>'.'Cant. Asig.'.'</th>';
              $table = $table.'<th>'.'Cant. Usadas.'.'</th>';
              $table = $table.'<th>'.'Cant. Rest.'.'</th>';
              if($_SESSION["admin"] == 'xx'){$table = $table.'<th>'.'$ Precio x Unid.'.'</th>'; }else {'<th></th>';}
              $table = $table.'<th>'.'Fecha Asig.'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              if($_SESSION["admin"] == 'xx'){ $table = $table.'<th>'.'$ Subtotal'.'</th>'; }else {'<th></th>';}
              if($_SESSION["admin"] == 'Si'){$table = $table.'<th>'.'Eliminar'.'</th>'; }else {'<th></th>';}
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total3=0;
	while($row=mysql_fetch_array($request))
	{       
                
           if($ver_can=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id"].'">';}else{$ver='';}
           if($editar_can=='Habilitado'){$b='<a href="../form_editar/form_medicina.php?editar='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($_SESSION["admin"] == 'Si'){if($eliminar_prod=='Habilitado'){$c='<a href="../modelo/eliminar.php?medicinas='.$row["i"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}}
           
        
          if($_SESSION["admin"] == 'xx'){$precio= '<td>$ '.$row['sub_precio_m'].'</font></td>'; }else{$precio='';}
           
            $subtotal =$row['cantidad'] *$row['sub_precio_m'] ;
            if($_SESSION["admin"] == 'xx'){$r='<td>$ '.$subtotal.'</font></td>';}else {$r='';}
            $total3= $total3 + $subtotal;
            $table = $table.'<tr><td>'.$row['rel_atencion'].'<font></a></td><td>'.$row['autorizacion'].'<font></a></td>
               <td>'.$row["cod_med"].'</font></td><td>'.$row["nombre_medicamento"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['cantidad_usada'].'</font></td><td>'.$row['cantidad_rest'].'</font></td>'.$precio.'<td>'.$row['fecha_asig'].'</font></td><td>'.$row['asignado_a'].'</font></td>
                '.$r.' 
                           <td>'.$c.'</td></tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total3;
}

       
                       ?>
                        <?php if($_SESSION["admin"] == 'Si'){ ?>
		</article>
                <article class="module width_full">
			<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">EQUIPOS DE SOPORTE</font></th></tr></table>  
                        
                        
<?php 
             
$request=mysql_query("SELECT a.*, b.*, c.* FROM equipos_asig a, alquiler b, ordenes c WHERE c.id=a.numero_orden_a and a.cod_equipo=b.codigo and a.autorizacion='".$_GET['codigo']."'  group by a.id_equipo_a");

if($request){
//    echo'<hr>';
 $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
             
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Equipo'.'</th>';
              $table = $table.'<th>'.'Tipo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
//              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
 
              $table = $table.'<th>'.'Fecha Inicial'.'</th>';
               $table = $table.'<th>'.'Fecha Final'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total4=0;
	while($row=mysql_fetch_array($request))
	{       
                
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id"].'">';}else{$ver='';}
           if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){$b='<a href="../form_editar/form_medicina.php?editar='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../modelo/eliminar.php?equipo='.$row["id_equipo_a"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
        
          
           
            $subtotal =$row['cantidad'] *$row['precio_a'] ;
            $total4= $total4 + $subtotal;
            $table = $table.'<tr><td>'.$row["rel_atencion"].'<font></a></td>
               <td>'.$row["cod_equipo"].'</font></td><td>'.$row["nombre"].'</font></td><td>'.$row["tipo"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['fecha_a'].'</font></td><td>'.$row['fecha_f'].'</font></td>
               
                           <td>'.$c.'</td></tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total4;
}

       
                       ?> 
		</article> 
                     
                
                <article class="module width_full">
			<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">LABORATORIOS</font></th></tr></table>  
                      
                        
<?php 
         
$request=mysql_query("SELECT a.*, b.*, c.* FROM laboratorio_asig a, laboratorio b, ordenes c WHERE c.id=a.numero_orden_lab  and a.cod_lab=b.cod_lab and a.autorizacion='".$_GET['codigo']."'  group by a.id_lab_a");

if($request){
//    echo'<hr>';
   $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
        
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Equipo'.'</th>';
          
              $table = $table.'<th>'.'Cantidad'.'</th>';
//              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
              $table = $table.'<th>'.'Fecha Asig.'.'</th>';
            
//               $table = $table.'<th>'.'Subtotal $'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total=0;
	while($row=mysql_fetch_array($request))
	{       
                
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id"].'">';}else{$ver='';}
           if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){$b='<a href="../form_editar/form_medicina.php?editar='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../modelo/eliminar.php?lab='.$row["id_lab_a"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
        
          
           
            $subtotal1 =$row['cantidad'] *$row['precio_lab'] ;
            $total= $total + $subtotal1;
            $table = $table.'<tr><td>'.$row["rel_atencion"].'<font></a></td></td>
               <td>'.$row["cod_lab"].'</font></td><td>'.$row["nombre_lab"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['fecha_lab'].'</font></td>
               
                           <td>'.$c.'</td></tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
       
        
}

       
                       ?>
		</article>
     
                <?php } ?>
		
	

</body>

</html>