<?php 
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));


 $con= "select a.archivo,b.nombres,b.apellidos,b.apellido2,a.RecurringRule,a.Location,a.id_paciente,a.user from actividad a, pacientes b where a.id_paciente=b.id_paciente and a.orden_servicio='".$_GET['ord']."'  GROUP BY orden_servicio";
$r=  mysql_query($con);
$f=  mysql_fetch_array($r);
$archi=$f['archivo'];
$name=$f['nombres'].' '.$f['apellidos'].' '.$f['apellido2'];
$estado=$f['Location'];
$motivo=$f['RecurringRule'];
 $id=$f['id_paciente'];
 $archivo=$f['archivo'];
$user=$f['user'];

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
catPaises = window.open('../resumen/resumen_atenciones_por_orden.php?orden=<?php echo $_GET['ord'] ?>&pac=<?php echo $name ?>', 'contacto', 'width=1000,height=600');
}
function medidas()
{
catPaises = window.open('../controlador/test_medidas.php?cod=<?php echo $_GET["ord"] ?>', 'contacto', 'width=800,height=600');
}
function fecha()
{
catPaises = window.open('../resumen/fecha.php?orden=<?php echo $_GET['ord'] ?>', 'contacto', 'width=500,height=300');
}

function doScroll(){
    if (window.name) window.scrollTo(0, window.name);
}
function detalles()
{
catPaises = window.open('../resumen/resumen_detalles.php?orden=<?php echo $_GET["ord"] ?>', 'contacto', 'width=1200,height=600');
}
function detalles2()
{
catPaises = window.open('../resumen/resumen_detalles_1.php?orden=<?php echo $_GET["ord"] ?>', 'contacto', 'width=1000,height=600');
}
function detalles3()
{
catPaises = window.open('../resumen/curacion_heridas_1.php?orden=<?php echo $_GET["ord"] ?>', 'contacto', 'width=1000,height=600');
}
function consulta(id,cod)
{
catPaises = window.open('../controlador/historial_consulta.php?cod='+cod+'&pac='+id, 'contacto', 'width=800,height=600');
}
function evolucion()
{
catPaises = window.open('../resumen/evolucion.php?cod=<?php echo $_GET["ord"] ?>', 'contacto', 'width=800,height=600');
}
function receta()
{
catPaises = window.open('../resumen/receta.php?cod=<?php echo $_GET["ord"] ?>', 'contacto', 'width=800,height=600');
}
function revisado()
{
catPaises = window.open('../emergentes/revisado.php?codigo=<?php echo $_GET["ord"] ?>', 'contacto', 'width=500,height=300');
}
</script>
  <script> 
var ventana_secundaria 

function abrirVentana1(){  
ventana_secundaria = window.open("../resumen/estado_orden.php?cod=<?php  echo $_GET["ord"] ?>","miventana","width=500,height=400,menubar=no") 
} 
function abrirVentana11(){  
ventana_secundaria = window.open("../resumen/view_estado.php?cod=<?php  echo $_GET["ord"] ?>","miventana","width=500,height=400,menubar=no") 
} 
function autorizacion(){  
ventana_secundaria = window.open("../resumen/add_orden.php?cod=<?php  echo $_GET["ord"] ?>","miventana","width=500,height=200,menubar=no") 
} 
function reasignar(){  
ventana_secundaria = window.open("../resumen/reasignar.php?orden=<?php  echo $archi ?>&pac=<?php  echo $name ?>","miventana","width=700,height=400,menubar=no") 
} 
function cerrarVentana(){ 
ventana_secundaria.close() 
} 

</script>
<div class="row-fluid">
                        <!-- START Form Wizard -->
<?php  
                                        $req2=mysql_query('select count(id_orden) from reportes where id_orden='.$_GET['ord'].' and estado="Reportado" ');
                                        $re = mysql_fetch_row($req2);
                                        $req3=mysql_query('select count(id_orden) from evolucion where id_orden='.$_GET['ord'].'  ');
                                        $ev = mysql_fetch_array($req3);
                                        $req4=mysql_query('select count(id_paciente) from motivo_consulta where id_paciente='.$id.'  ');
                                        $mc = mysql_fetch_array($req4);
                                        $req5=mysql_query('select count(id_orden) from receta where id_orden='.$_GET['ord'].'  ');
                                        $rc = mysql_fetch_array($req5);
                                        if($re[0]!=0){
	                                echo '<i>Reportes en esta Orden: '.$num_inc = $re[0].'</i> <img src="../imagenes/ledrojo.gif">';
                                        }
                                        if($ev['count(id_orden)']==0){
                                            $e = '<img src="../imagenes/llenar.gif" width="16" height="16"/>';
                                        }  else {
                                            $e ='';  
                                        }
                                         if($mc['count(id_paciente)']==0){
                                            $m = '<img src="../imagenes/llenar.gif" width="16" height="16"/>';
                                        }  else {
                                            $m ='';  
                                        }
                                        if($rc['count(id_orden)']==0){
                                            $r = '<img src="../imagenes/llenar.gif" width="16" height="16"/>';
                                        }  else {
                                            $r ='';  
                                        }

                                        ?>
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Orden Interna: <?php echo $_GET['ord']  ?></h4>
                                
                                <button type="button" onclick="consulta(<?php echo $id.','.$_GET['ord']; ?>)"><?php echo $m; ?> Anamnesis</button>
                                <button type="button" name="cancelar" onclick="evolucion()"><?php echo $e; ?> Evolucion Final</button>
                                <button type="button"  onclick="receta()"><?php echo $r; ?> Receta Medica</button>
                           
                                 <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   (Paciente :<a href="../vistas/?id=ver_paciente&cod=<?php echo $id; ?>"><?php 
                                        echo "$name";
                                       
                                        ?> </a>)
                                        
                                        <b> </b>
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                              
                                <div class="tab-content">
                                    
                                    <div class="tab-pane active" id="tab8">
                                        <div class="row-fluid">
<!--atenciones------------------------------------------------------------------------------------------>
 <article class="module width_full">
     <?php
if($estado!='Revisado'){
////////////////////////////////////
$consulta= "select sum(porcentaje) as total from actividad where estado='Completada' and orden_servicio='".$_GET['ord']."' ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$total=$fila['total'];  
 $sql = "UPDATE `actividad` SET `id_contacto`='".$total."' WHERE `orden_servicio`='".$_GET['ord']."';";
 mysql_query($sql);
 } 
}
 

 ?>
                        <header>  
                            <?php if($_SESSION["area"] == 'OFICINA'){ if($estado!='Revisado'){  ?><input name="revisado" type="button" onclick="revisado()" value="Revisado"><?php }else{echo '<img src="../imagenes/ok.png"> <input name="revisado" type="button" onclick="revisado()" value="Revisado">';}}  ?></header>
                        <header><h3>
                            <?php if($_SESSION["area"] == 'OFICINA'){  ?> 
 <input type="button" name="cancelar" value="Editar Fecha" onclick="fecha()">  <input type="button" name="cancelar" value="Detalle de Atenciones" onclick="det_atenciones()">  <?php } ?> <a href='../vistas/?id=add_atenciones&cod=<?php  echo $archivo ?>'><input type="button" name="cancelar" value="Archivo Principal"></a>
                             <a target="_blank" href="../php-mysql_1.php?imprimir=<?php echo $_GET['ord'] ?>&user=<?php echo $user ?>"><input type="button" name="bo" value="Ins y Med Entregados"/> </a>
                          <input type="button" name="cancelar" value="Det. Insumos" onclick="detalles()">
                       <input type="button" name="cancelar" value="Det. Medicamentos" onclick="detalles2()">
                            <input type="button" name="cancelar" value="Det. Curaciones" onclick="detalles3()">
                            <?php IF($_SESSION["area"]=='OFICINA'){  ?><input type="button" title="Aqui puede reasignar una orden a otro usuario"  name="as" value="Reasignar" onclick="reasignar()"><?php } ?>
                            <input type="button" name="crear" title="Terminar las atenciones por algun motivo" value="Estado" onclick="abrirVentana11()">
                            <input type="button" name="crear" title="Terminar las atenciones por algun motivo" value="Suspender" onclick="abrirVentana1()"> 
                            </header></h3>
                           
                     <table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">ATENCIONES</font></th></tr></table> 
                       
                       <?php if($_SESSION["area"] == 'OFICINA'){  ?>
<!--<form action="" method="post" name="fcontacto">
    <header><h3><input type="submit" name="bpr" value="Nuevo"/></h3></header>
                       </form> -->
<?php }
   
     if($_SESSION["area"] == 'OFICINA'){
      $request=mysql_query("select a.Id,a.estado,vencimiento,id_contacto,cant,Subject,Description,user,fecha_reg_ta,StartTime,EndTime,fecha_mod_ta,registro,puntos,urgente,cada,cant_ins,fecha_mod_ta,estado,orden_externa,orden_servicio,porcentaje from actividad a where  a.orden_servicio='".$_GET['ord']."' order by a.cant_ins");
     }else{
      $request=mysql_query("select a.Id,a.estado,vencimiento,id_contacto,cant,Subject,Description,user,fecha_reg_ta,StartTime,EndTime,fecha_mod_ta,registro,puntos,urgente,cada,cant_ins,fecha_mod_ta,estado,orden_externa,orden_servicio,porcentaje from actividad a where a.user='".$_SESSION['k_username']."'  and a.orden_servicio='".$_GET['ord']."' order by a.cant_ins");
      
     }
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>Urgente</th>';
              $table = $table.'<th>'.'Atencion'.'</th>';
              
              $table = $table.'<th>'.'# Orden Ext.'.'</th>';
              $table = $table.'<th>'.'Visita #'.'</th>';
                $table = $table.'<th>'.'Ir Cada'.'</th>';
              $table = $table.'<th>'.'Realizado el Dia'.'</th>';
              $table = $table.'<th>'.'Fecha Registro...'.'</th>';
              $table = $table.'<th>'.'Puntaje'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Porcentaje(%)'.'</th>';
              $table = $table.'<th>'.'Can.'.'</th>';
              $table = $table.'<th>'.'P.R'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $as=0;$total2=0;$vence = ''; $f1 = '';$f2='';$c=0;$e=0;
        $contador = 0;
        $ultimo = '';
	while($row=mysql_fetch_array($request))
	{       
                $contador = $contador + 1;
           
          if($ver_proy=='Habilitado'){$ver='<a href="../vistas/?id=llenar_atencion&codigo='.$row["Id"].'&orden_servicio='.$_GET["ord"].'">';}else{$ver='';}
           if( $editar_proy=='Habilitado'){$b='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($_SESSION["area"] == 'OFICINA'){if($eliminar_proy=='Habilitado'){$c='<a href="../vistas/detalle_ordenes.php?eliminar_act='.$row["id_empresa"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}}else{$c='';}
           
           if($row['estado']=='Completada'){$color='<font color="green">';}
           
           if($row['estado']=='No iniciada'){$color='<font color="red">';}
           
           $ver = $ver;
//           if($row['vencimiento']=='0000-00-00'){
//               $ver = $ver;
//           }else{
//               if($row['id_contacto']==''){
//                   if($_SESSION["cargo"]=='MEDICO GENERAL' || $_SESSION["cargo"]=='MEDICO' || $_SESSION["cargo"]=='NUTRICIONISTA'){
                       if($_SESSION["area"] == 'OFICINA'){
                              $ver = $ver;
                       }else{
                           if($row['vencimiento']=='0000-00-00'){
                               if($row['id_contacto']==''){
                                   if($_SESSION["cargo"]=='MEDICO GENERAL' || $_SESSION["cargo"]=='MEDICO' || $_SESSION["cargo"]=='NUTRICIONISTA'){
                                       $ver = $ver;
                                   }else{
                                    if($row['StartTime']==date("Y-m-d")){
                                         $ver = $ver;
                                    }else{
                                        $ver = '';
                                    }
                                   }
                               }else{
                                         $ver = '';
                               }
              
                       }else{
                           if($row['vencimiento']<=date("Y-m-d")){
                             $ver = $ver;//quitar modificacion  a '' ojo james
                           }else{
                             $ver = $ver;
                           }
                       }
                       
                       
                       }
                       if($contador==1){
                           $ver = $ver;
                       }else{
                           if($ultimo!=''){
                               $ver = $ver;
                           }else{
                               $ver = '';
                           }
                       }
                       $ultimo = $row["fecha_mod_ta"];
                       
//                   }else{
//                       if($row['StartTime']==date("Y-m-d")){
//                          $ver = $ver;
//                       }else{
//                          $ver = '';
//                       }
//                   }
//
//                   }else{
//                       if(date("Y-m-d") >= $row['vencimiento']){
//                          $ver = '';
//                       }else{
//                          $ver = $ver;
//                       }
//                   }
//           }
          
           if($_SESSION["area"] == 'OFICINA'){$precio= '<td>$ '.$color.''.$row['precio_total'].'</font></td>'; }else{$precio='';}
     if($row['vencimiento']=='0000-00-00'){
          $vence = $row['vencimiento'];
     }else{
            $fecha = $row['vencimiento'];
            $nuevafecha = strtotime( '-1 day' , strtotime($fecha));
            $vencimiento = date('Y-m-d' , $nuevafecha);
             $vence = $vencimiento;
     }
     if($row["registro"]!=''){
     if($row["puntos"]==1){
         $i = '<img src="../images/feliz.png">';
     }else{
         $i = '<img src="../images/triste.png">';
     }}else{
         $i='';
     } 
     if($row["urgente"]=='Si'){
        $ur = $row["urgente"].'<img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px"> <b><font color="red">Urgente</font></b>';
    }else{
        $ur = ''.$row["urgente"];
    }
$f1 = $row["StartTime"];$f2=$row["EndTime"];
          $as = $row['user'];
               $var= $row['porcentaje'];
            $table = $table.'<tr><td>'.$ur.'<td>'.$ver.''.$color.''.$row['Description'].'</font></td>' 
                    . '<td>'.$ver.''.$color.''.$row['orden_externa'].'</font></td>'
                    . '<td>'.$ver.''.$color.''.$row["cant_ins"].'<font></a></td>
                        <td>'.$row["cada"].' Dias</a></td>
               '
                    . '<td>'.$color.''.$row["fecha_mod_ta"].'</font></td>
                        <td>'.$row["registro"].'</font></td><td style="text-align:center">'.$i.'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td><td>'.$color.''.number_format($var).'%</font></td>
                       <td>'.$color.''.$row['cant'].'</font></td><td title="Esta columna es para saber si se hizo la prueba del covid-19">'.$color.''.$row['prueba_realizada'].'</font></td></tr>';   
           
		$e += $row["puntos"];
                $c = $row['cant'];
               
	}
        $d = $c - $e;
        $p = $d/$c;
        $to = $p * 100;
        $tx = 100 - $to;
        
	$table = $table.'</table>';
        if(date("Y-m-d")>$f2){
            $rojo = ' <img src="../imagenes/ledrojo.gif" alt="ver" height="10px" width="10px"> <font color="red">Esta Orden caduco</font>';
        }else{
            $rojo = '';
        }
        echo '<font color="red"><i>NOTA: Fecha Limite de modificar las atenciones hasta el '.$vence.'</i></font> (Fecha de inicio: '.$f1.' - Fecha Final: '.$f2.')'. $rojo;
        echo '<b>   Efectividad: '.  number_format($tx).'%</b>';
	echo $table;
        
//        $requestx=mysql_query('select count(*) from actividad where orden_servicio="'.$_GET['ord'].'"');
//        $requestx = mysql_fetch_row($requestx);
//	$num_itemsx = $requestx[0];
//        $total2=$num_itemsx*$total2;
        
     
}

      
                       ?>

 
 <div class="progress progress-striped active"><div class="bar" style="width: <?php if($total==''){echo 0;}else{echo $total;} ?>%"></div> </div>
 <?php if($total==''){echo 0;}else{echo number_format($total);} ?> % Completada 
 
		</article>
<!--fin de atenciones----------------------------------------------------------------------------------->
<!--INSUMOS--------------------------------------------------------------------------------------------->

    <article class="module width_full">
                   
                        <table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">INSUMOS   </font></th></tr></table> <a target="_blank" href="../insumos_asig.php?imp=<?php echo $_GET['ord'] ?>">Imprimir</a>
<?php 

    
if($_SESSION["area"] == 'OFICINA'){
$request=mysql_query("SELECT id_ia,sub_precio,autorizacion,rel_atencion,cod_insumo,nombre_insumo,cantidad,cant_usada,cant_restante,asignado_a, max(d.fecha_mod_ta), min(d.fecha_mod_ta) FROM insumos_asignados a, insumos b, ordenes c, actividad d WHERE  d.orden_servicio=a.rel_atencion and c.id=a.numero_orden and a.cod_insumo=b.codigo and a.rel_atencion='".$_GET['ord']."'  group by id_ia");
}else{
   $request=mysql_query("SELECT id_ia,sub_precio,autorizacion,rel_atencion,cod_insumo,nombre_insumo,cantidad,cant_usada,cant_restante,asignado_a, max(d.fecha_mod_ta), min(d.fecha_mod_ta) FROM insumos_asignados a, insumos b, ordenes c, actividad d WHERE  d.orden_servicio=a.rel_atencion and a.asignado_a='".$_SESSION['k_username']."' and c.id=a.numero_orden and a.cod_insumo=b.codigo and a.rel_atencion='".$_GET['ord']."'  group by id_ia");
 
}
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Nombre Insumo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
               $table = $table.'<th>'.'Cant. usadas'.'</th>';
                $table = $table.'<th>'.'Cant. Restante'.'</th>';
              if($_SESSION["admin"] == 'xx'){$table = $table.'<th>'.'Precio x Unid.'.'</th>';}else {'<th></th>';}
              $table = $table.'<th>'.'Rango de fecha Utilizadas.'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';

              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total1= 0;
	while($row=mysql_fetch_array($request))
	{       
                
           if($ver_prod=='Habilitado'){$ver='<a href="../vistas/mostrar_detalle_proyecto.php?codigo='.$row["id_ia"].'">';}else{$ver='';}
           if($editar_prod=='Habilitado'){$b='<a href="../form_editar/formulario_editar_proyecto.php?codigo='.$row["id_ia"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
    
           
        
           if($_SESSION["admin"] == 'xx'){$precio= '<td>$ '.$row['sub_precio'].'</font></td>'; }else{$precio='';}
           
           $subtotal=$row['autorizacion'];
           if($_SESSION["admin"] == 'xx'){$g='<td>$ '.$subtotal.'</font></td>';}else {$g='<td></td>';}
           $total1= $total1 + $subtotal;
            $table = $table.'<tr><td>'.$row['rel_atencion'].'<font></a></td>
               <td>'.$row["cod_insumo"].'</font></td><td>'.$row["nombre_insumo"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td> <td>'.$row['cant_usada'].'</font></td> <td>'.$row['cant_restante'].'</font></td>'.$precio.'<td>'.$row['min(d.fecha_mod_ta)'].' al '.$row['max(d.fecha_mod_ta)'].'</font></td><td>'.$row['asignado_a'].'</font></td></tr>';
           
            
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total1;
}

       
                       ?>  
		</article>
<!--FIN DE INSUMOS-------------------------------------------------------------------------------------->

<!--MEDICAMENTOS----------------------------------------------------------------------------------------->
<article class="module width_full"><BR>
		<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">MEDICAMENTOS   </font></th></tr></table> 
                       
                        
<?php 
 
    if($_SESSION["area"] == 'OFICINA'){
$request=mysql_query("SELECT *, (a.id) as i FROM medicamentos_asig a, medicamentos b, ordenes c WHERE c.id=a.numero_orden  and a.cod_med=b.codigo_int and a.rel_atencion='".$_GET['ord']."'  group by a.id");
    }else{
      $request=mysql_query("SELECT *, (a.id) as i FROM medicamentos_asig a, medicamentos b, ordenes c WHERE a.asignado_a='".$_SESSION['k_username']."' and c.id=a.numero_orden  and a.cod_med=b.codigo_int and a.rel_atencion='".$_GET['ord']."'  group by a.id");
   
    }
if($request){
//    echo'<hr>';
     $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
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
     
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total3=0;
	while($row=mysql_fetch_array($request))
	{       
                
           if($ver_prod=='Habilitado'){$ver='<a href="../vistas/?id=llenar_atencion&codigo='.$row["id"].'">';}else{$ver='';}
           if($editar_prod=='Habilitado'){$b='<a href="../form_editar/form_medicina.php?editar='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
          
        
          if($_SESSION["admin"] == 'xx'){$precio= '<td>$ '.$row['sub_precio_m'].'</font></td>'; }else{$precio='';}
           
            $subtotal =$row['cantidad'] *$row['sub_precio_m'] ;
            if($_SESSION["admin"] == 'xx'){$r='<td>$ '.$subtotal.'</font></td>';}else {$r='';}
            $total3= $total3 + $subtotal;
            $table = $table.'<tr><td>'.$row['rel_atencion'].'<font></a></td>
               <td>'.$row["cod_med"].'</font></td><td>'.$row["nombre_medicamento"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['cantidad_usada'].'</font></td><td>'.$row['cantidad_rest'].'</font></td>'.$precio.'<td>'.$row['fecha_asig'].'</font></td><td>'.$row['asignado_a'].'</font></td>
                '.$r.' 
                          </tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total3;
}

       
                       ?>
                        
		</article>
<!--FIN DE MEDICAMENTOS---------------------------------------------------------------------------------->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
<?php   include '../vistas/reportes/incidencias.php';  ?>

