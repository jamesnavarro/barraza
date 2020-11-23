<?php 
require '../modelo/consulta_ordenes.php';
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$sql1 = "SELECT MAX(orden_servicio) as id_inc FROM actividad";
$fila1 =mysql_fetch_array(mysql_query($sql1));

$max = $fila1["id_inc"]+1;
 $consulta= "select a.*, b.* from actividad a, pacientes b where a.orden_servicio='".$_GET['ord']."' and a.id_paciente=b.id_paciente GROUP BY orden_externa";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$name=$fila['nombres'].' '.$fila['apellidos'];  
 $id=$fila['id_paciente'];
}
?>

<script> 
var ventana_secundaria 

function abrirVentana(){  
ventana_secundaria = window.open("../vistas/form_actividades.php","miventana","width=500,height=480,menubar=no") 
} 
function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/form_contacto_potencial.php","miventana","width=850,height=400,menubar=no") 
} 
function abrirVentana2(){  
ventana_secundaria = window.open("../vistas/form_oportunidades.php","miventana","width=500,height=520,menubar=no") 
}
function abrirVentana3(){  
ventana_secundaria = window.open("../vistas/form_caso.php","miventana","width=500,height=540,menubar=no") 
}
function abrirVentana4(){  
ventana_secundaria = window.open("../vistas/form_incidencia.php?cod=<?php echo $idc ?>","miventana","width=500,height=620,menubar=no") 
}
function abrirVentana5(){  
ventana_secundaria = window.open("../vistas/form_contacto.php?codigo=<?php echo $idc ?>","miventana","width=500,height=420,menubar=no") 
}
function abrirVentana6(){  
ventana_secundaria = window.open("../vistas/form_proyecto.php?codigo=<?php echo $idc ?>","miventana","width=500,height=420,menubar=no") 
}


function doScroll(){
    if (window.name) window.scrollTo(0, window.name);
}

</script>

    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>


<script language='javascript'>
function det_atenciones()
{
catPaises = window.open('../vistas/resumen_atenciones_por_orden.php?orden=<?php echo $_GET['ord'] ?>&pac=<?php echo $name ?>', 'contacto', 'width=1000,height=600');
}

function fecha()
{
catPaises = window.open('../vistas/fecha.php?orden=<?php echo $_GET['ord'] ?>', 'contacto', 'width=500,height=300');
}

function doScroll(){
    if (window.name) window.scrollTo(0, window.name);
}
function detalles()
{
catPaises = window.open('../vistas/resumen_detalles.php?orden=<?php echo $_GET["ord"] ?>', 'contacto', 'width=1200,height=600');
}
function detalles2()
{
catPaises = window.open('../vistas/resumen_detalles_1.php?orden=<?php echo $_GET["ord"] ?>', 'contacto', 'width=1000,height=600');
}
function detalles3()
{
catPaises = window.open('../vistas/curacion_heridas_1.php?orden=<?php echo $_GET["ord"] ?>', 'contacto', 'width=1000,height=600');
}
function consulta()
{
catPaises = window.open('../controlador/historial_consulta.php?codigo=<?php echo $_GET["ord"] ?>', 'contacto', 'width=800,height=600');
}
function evolucion()
{
catPaises = window.open('../vistas/evolucion.php?cod=<?php echo $_GET["ord"] ?>', 'contacto', 'width=800,height=600');
}
function receta()
{
catPaises = window.open('../vistas/receta.php?cod=<?php echo $_GET["ord"] ?>', 'contacto', 'width=800,height=600');
}
function revisado()
{
catPaises = window.open('../vistas/revisado.php?codigo=<?php echo $_GET["ord"] ?>', 'contacto', 'width=500,height=300');
}
</script>
  <script> 
var ventana_secundaria 

function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/estado_orden.php?cod=<?php  echo $_GET["ord"] ?>","miventana","width=500,height=400,menubar=no") 
} 
function abrirVentana11(){  
ventana_secundaria = window.open("../vistas/view_estado.php?cod=<?php  echo $_GET["ord"] ?>","miventana","width=500,height=400,menubar=no") 
} 
function autorizacion(){  
ventana_secundaria = window.open("../vistas/add_orden.php?cod=<?php  echo $_GET["ord"] ?>","miventana","width=500,height=200,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>


</head>
<?php

$consultar= "select count(cod_aten) as total from actividad where orden_servicio='".$_GET['ord']."' group by cod_aten";
$resultr=  mysql_query($consultar);
$t='';
while($fila=  mysql_fetch_array($resultr)){
$to=$fila['total'];
$t = $t + 1;
 }

////////////////////////////////////
$consulta= "select sum(porcentaje) as total from actividad where estado='Completada' and orden_servicio='".$_GET['ord']."' ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$total=$fila['total'];  
 $sql = "UPDATE `actividad` SET `id_contacto`='".$total."' WHERE `orden_servicio`='".$_GET['ord']."';";
 mysql_query($sql);
 } 
 
 
 ///////////////////////
 $consulta3= "select * from actividad where orden_servicio='".$_GET['ord']."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){ 
$cant=$fila['cant'];
$servicio=$fila['orden_servicio'];
$archivo=$fila['archivo'];
 }
 //////////////////////////////
 $consulta2= "select * from actividad where orden_servicio='".$_GET['ord']."'";
$result2=  mysql_query($consulta2);
while($fila2=  mysql_fetch_array($result2)){
$user=$fila2['user'];                               
 } 
 ?>

<body onload="doScroll()" onunload="window.name=document.body.scrollTop">

	<section id="main" class="column">
		<div class="clear"></div>
                
		<article class="module width_full">
                  <h4 class="inf">Orden Interna  :<?php 
                                        echo $_GET['ord'].' ';
                                       
                                        ?> (Paciente :<a href="../vistas/contacto_potencial.php?codigo=<?php echo $id; ?>"><?php 
                                        echo "$name";
                                       
                                        ?> </a>) <input type="button" name="cancelar" value="Anamnesis" onclick="consulta()"> <input type="button" name="cancelar" value="Evolucion Final" onclick="evolucion()"> <input type="button" name="cancelar" value="Receta Medica" onclick="receta()"></h4>
                    <br>

             </article>
<!--               <article class="module width_full">
                   <?php
                   if($_SESSION["admin"] == 'Si'){  ?><table>
                       
                       <tr>
                           <td><form action="../modelo/add_user_insumos.php?orden=<?php echo $orden_interna ?>" method="post" name="fcontacto">Asignado a: <input type="text" name="usuario" readonly id="valor6" style="width:130px;height:20px;" value="<?php if(isset($user)){echo $user;} ?>"/>
                                                                <a href='javascript: usuario()'><input type="button" name="cancelar" value="Seleccionar"></a> <input type="submit" name="cancelar" value="Asignar"></form></td>
                       </tr>
                   </table><?php  } ?>

		</article>-->
                    <article class="module width_full">
                        <header><h3>atenciones </h3>
                            <?php if($_SESSION["admin"] == 'Si'){  ?><input name="revisado" type="button" onclick="revisado()" value="Revisado?"><?php }  ?></header>
                        <header><h3>
                            <?php if($_SESSION["admin"] == 'Si'){  ?> 
 <input type="button" name="cancelar" value="Editar Fecha" onclick="fecha()">  <input type="button" name="cancelar" value="Detalle de Atenciones" onclick="det_atenciones()">  <?php } ?> <a href='../vistas/?id=add_atenciones&cod=<?php  echo $archivo ?>'><input type="button" name="cancelar" value="Archivo Principal"></a>
                             <a target="_blank" href="../php-mysql_1.php?imprimir=<?php echo $_GET['ord'] ?>&user=<?php echo $user ?>"><input type="button" name="bo" value="Ins y Med Entregados"/> </a>
                          <input type="button" name="cancelar" value="Det. Insumos" onclick="detalles()">
                       <input type="button" name="cancelar" value="Det. Medicamentos" onclick="detalles2()">
                            <input type="button" name="cancelar" value="Det. Curaciones" onclick="detalles3()">
                            
                            <input type="button" name="crear" title="Terminar las atenciones por algun motivo" value="Estado" onclick="abrirVentana11()">
                            <input type="button" name="crear" title="Terminar las atenciones por algun motivo" value="Suspender" onclick="abrirVentana1()"> 
                            </header></h3>
                           
                        </header>
                       
                       <?php if($_SESSION["admin"] == 'Si'){  ?>
<!--<form action="" method="post" name="fcontacto">
    <header><h3><input type="submit" name="bpr" value="Nuevo"/></h3></header>
                       </form> -->
<?php }
   
     if($_SESSION["admin"] == 'Si'){
$request=mysql_query("select a.*, b.* from actividad a, ordenes b where b.id=a.archivo and a.orden_servicio='".$_GET['ord']."' order by a.cant_ins");
     }else{
      $request=mysql_query("select a.*, b.* from actividad a, ordenes b where a.user='".$_SESSION['k_username']."' and b.id=a.archivo  and a.orden_servicio='".$_GET['ord']."' order by a.cant_ins");
    
     }
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#6D96D0">';
              $table = $table.'<th>'.'Atencion'.'</th>';
              
              $table = $table.'<th>'.'# Orden Ext.'.'</th>';
              $table = $table.'<th>'.'Visita #'.'</th>';
              $table = $table.'<th>'.'Fecha Inicial'.'</th>';
              $table = $table.'<th>'.'Fecha Final'.'</th>';
              $table = $table.'<th>'.'Realizado el Dia'.'</th>';
              
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Porcentaje(%)'.'</th>';
              $table = $table.'<th>'.'Cant.'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
                
           
          if($ver_proy=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["Id"].'&orden_servicio='.$_GET["ord"].'">';}else{$ver='';}
           if( $editar_proy=='Habilitado'){$b='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($_SESSION["admin"] == 'Si'){if($eliminar_proy=='Habilitado'){$c='<a href="../vistas/detalle_ordenes.php?eliminar_act='.$row["id_empresa"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}}else{$c='';}
           
           if($row['estado']=='Completada'){$color='<font color="green">';}
           if($row['estado']=='No iniciada'){$color='<font color="red">';}
           
          
           if($_SESSION["admin"] == 'Si'){$precio= '<td>$ '.$color.''.$row['precio_total'].'</font></td>'; }else{$precio='';}
           
          
               $var= $row['porcentaje'];
            $table = $table.'<tr><td>'.$ver.''.$color.''.$row['Description'].'</font></td><td>'.$ver.''.$color.''.$row['orden_externa'].'</font></td><td>'.$ver.''.$color.''.$row["cant_ins"].'<font></a></td></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td><td>'.$color.''.$row["fecha_mod_ta"].'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td><td>'.$color.''.number_format($var).'%</font></td>
                       <td>'.$color.''.$row['cant'].'</font></td></tr>';   
           
		
               
	}
        
        
	$table = $table.'</table>';
        
	echo $table;
        
        $requestx=mysql_query('select count(*) from actividad where orden_servicio="'.$_GET['ord'].'"');
        $requestx = mysql_fetch_row($requestx);
	$num_itemsx = $requestx[0];
        $total2=$num_itemsx*$total2;
        
     
}

       
                       ?>

                        <?php 
                        if($total==NULL){echo'<img src="../imagenes/0.png" alt="ver">';}
                        if($total>=1 && $total<=10){echo'<img src="../imagenes/1.png" alt="ver">';}
                        if($total>=11 && $total<=20){echo'<img src="../imagenes/2.png" alt="ver">';}
                        if($total>=21&& $total<=30){echo'<img src="../imagenes/3.png" alt="ver">';}
                        if($total>=31&& $total<=40){echo'<img src="../imagenes/4.png" alt="ver">';}
                        if($total>=41&& $total<=50){echo'<img src="../imagenes/5.png" alt="ver">';}
                        if($total>=51&& $total<=60){echo'<img src="../imagenes/6.png" alt="ver">';}
                        if($total>=61&& $total<=70){echo'<img src="../imagenes/7.png" alt="ver">';}
                        if($total>=71&& $total<=80){echo'<img src="../imagenes/8.png" alt="ver">';}
                        if($total>=81&& $total<=90){echo'<img src="../imagenes/9.png" alt="ver">';}
                        if($total>=91&& $total<=100){echo'<img src="../imagenes/10.png" alt="ver">';}?>
 <?php if($total==''){echo 0;}else{echo $total;} ?> % Completada
                       
		</article>
		 
                  
                <article class="module width_full">
                    <header  onload="recargar()"><h3>Insumos </h3> <a target="_blank" href="../insumos_asig.php?imp=<?php echo $_GET['ord'] ?>">Imprimir</a></header>
                        
<?php 

    
if($_SESSION["admin"] == 'Si'){
$request=mysql_query("SELECT a.*, b.*, c.*, max(d.fecha_mod_ta), min(d.fecha_mod_ta) FROM insumos_asignados a, insumos b, ordenes c, actividad d WHERE  d.orden_servicio=a.rel_atencion and c.id=a.numero_orden and a.cod_insumo=b.codigo and a.rel_atencion='".$_GET['ord']."'  group by id_ia");
}else{
   $request=mysql_query("SELECT a.*, b.*, c.*, max(d.fecha_mod_ta), min(d.fecha_mod_ta) FROM insumos_asignados a, insumos b, ordenes c, actividad d WHERE  d.orden_servicio=a.rel_atencion and a.asignado_a='".$_SESSION['k_username']."' and c.id=a.numero_orden and a.cod_insumo=b.codigo and a.rel_atencion='".$_GET['ord']."'  group by id_ia");
 
}
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#E3EC7E">';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Nombre Insumo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
               $table = $table.'<th>'.'Cant. usadas'.'</th>';
                $table = $table.'<th>'.'Cant. Restante'.'</th>';
              if($_SESSION["admin"] == 'xx'){$table = $table.'<th>'.'Precio x Unid.'.'</th>';}else {'<th></th>';}
              $table = $table.'<th>'.'Rango de fecha Utilizadas.'.'</th>';
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
           $total1= $total1 + $subtotal;
            $table = $table.'<tr><td>'.$row['rel_atencion'].'<font></a></td>
               <td>'.$row["cod_insumo"].'</font></td><td>'.$row["nombre_insumo"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td> <td>'.$row['cant_usada'].'</font></td> <td>'.$row['cant_restante'].'</font></td>'.$precio.'<td>'.$row['min(d.fecha_mod_ta)'].' al '.$row['max(d.fecha_mod_ta)'].'</font></td><td>'.$row['asignado_a'].'</font></td><td>'.$c.'</td></tr>';
           
            
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total1;
}

       
                       ?>  
		</article>
                <article class="module width_full">
			<header  onload="recargar()"><h3>medicamentos </h3></header>
                       
                        
<?php 
 
    if($_SESSION["admin"] == 'Si'){
$request=mysql_query("SELECT a.*, (a.id) as i, b.*, c.* FROM medicamentos_asig a, medicamentos b, ordenes c WHERE c.id=a.numero_orden  and a.cod_med=b.codigo_int and a.rel_atencion='".$_GET['ord']."'  group by a.id");
    }else{
      $request=mysql_query("SELECT a.*, (a.id) as i, b.*, c.* FROM medicamentos_asig a, medicamentos b, ordenes c WHERE a.asignado_a='".$_SESSION['k_username']."' and c.id=a.numero_orden  and a.cod_med=b.codigo_int and a.rel_atencion='".$_GET['ord']."'  group by a.id");
   
    }
if($request){
//    echo'<hr>';
     $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#E3EC7E">';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
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
                
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id"].'">';}else{$ver='';}
           if($modulo_rPR=='Proyectos' && $editar_rPR=='Habilitado'){$b='<a href="../form_editar/form_medicina.php?editar='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($_SESSION["admin"] == 'Si'){if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../modelo/eliminar.php?medicinas='.$row["i"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}}
           
        
          if($_SESSION["admin"] == 'xx'){$precio= '<td>$ '.$row['sub_precio_m'].'</font></td>'; }else{$precio='';}
           
            $subtotal =$row['cantidad'] *$row['sub_precio_m'] ;
            if($_SESSION["admin"] == 'xx'){$r='<td>$ '.$subtotal.'</font></td>';}else {$r='';}
            $total3= $total3 + $subtotal;
            $table = $table.'<tr><td>'.$row['rel_atencion'].'<font></a></td>
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
<!--                <article class="module width_full">
			<header  onload="recargar()"><h3>equipos de soporte</h3></header>
                        
                        
<?php 
          
$request=mysql_query("SELECT a.*, b.*, c.* FROM equipos_asig a, alquiler b, ordenes c WHERE c.id=a.numero_orden_a and a.cod_equipo=b.codigo and a.rel_atencion='".$_GET['ord']."'  group by a.id_equipo_a");

if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#E3EC7E">';
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
		</article> -->
                     
                
                <article class="module width_full">
			<header  onload="recargar()"><h3>Laboratorios</h3></header>
                      
                        
<?php 
             
$request=mysql_query("SELECT a.*, b.*, c.* FROM laboratorio_asig a, laboratorio b, ordenes c WHERE c.id=a.numero_orden_lab  and a.cod_lab=b.cod_lab and a.rel_atencion='".$_GET['ord']."'  group by a.id_lab_a");

if($request){
//    echo'<hr>';
    $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#E3EC7E">';
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
                <article class="module width_full">
			<header  onload="recargar()"><h3>Ventas</h3></header>
                        
   <?php 
          
$request=mysql_query("SELECT a.*, b.*, c.* FROM productos_vendidos a, productos b, ordenes c WHERE c.id=a.numero_orden_v  and a.cod_pro=b.codigo_interno and a.rel_atencion='".$_GET['ord']."'  group by a.id_venta");

if($request){
    $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#E3EC7E">';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
       
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Equipo'.'</th>';
          
              $table = $table.'<th>'.'Cantidad'.'</th>';
              
              $table = $table.'<th>'.'Fecha Asig.'.'</th>';
             
              
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total=0;
	while($row=mysql_fetch_array($request))
	{       
                
          if($modulo_rPR=='Proyectos' && $eliminar_rPR=='Habilitado'){$c='<a href="../vistas/detalle_ordenes.php?eliminar_v='.$row["id_venta"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
        
          
           
            $subtotal1 =$row['cantidad'] *$row['precio'] ;
            $total= $total + $subtotal1;
            $table = $table.'<tr><td>'.$row["rel_atencion"].'<font></a></td></td>
               <td>'.$row["codigo_interno"].'</font></td><td>'.$row["nombre"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['fecha_a'].'</font></td>
               
                           <td>'.$c.'</td></tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
        
}

        if(isset($_GET['eliminar_v']))
    {
        $Codigo=$_GET['eliminar_v'];
        $sql = "DELETE FROM productos_vendidos WHERE id_venta='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/detalle_ordenes.php?codigo='.$orden_interna.'"</script>'; 
    }
                       ?>                     
<?php 
   if(isset($_GET['eliminar_act']))
    {
        $Codigo=$_GET['eliminar_act'];
        $sql = "DELETE FROM actividad WHERE id_empresa='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/detalle_ordenes.php?codigo='.$orden_interna.'"</script>'; 
    }
?>    
		</article>
                <?php } ?>
		<div class="spacer"></div>
	</section>
             

</body>

