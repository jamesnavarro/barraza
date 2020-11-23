<?php 
require '../modelo/consultar_atencion.php';
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!doctype html>
<html lang="en">

<head>
<script> 
var ventana_secundaria 

function abrirVentana(){  
ventana_secundaria = window.open("../vistas/form_actividades.php","miventana","width=500,height=410,menubar=no") 
} 
function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/form_clientes_potenciales.php","miventana","width=800,height=410,menubar=no") 
}

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>
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
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
<script language='javascript'>

function curaciones()
{
catPaises = window.open('../resumen/curacion_heridas.php?codigo=<?php echo $_GET["codigo"] ?>&orden=<?php echo $_GET["orden_servicio"] ?>', 'contacto', 'width=1100,height=600');
}
function doScroll(){
    if (window.name) window.scrollTo(0, window.name);
}
</script>
<script type="text/javascript"> function recargar() { window.location.reload() } </script>

</head>

<?php include "../modelo/conexion.php";
$consulta= "select sum(porcentaje) as total from actividad where estado='Completada' and orden_servicio='".$_GET['orden_servicio']."' ";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$total=$fila['total'];  
 $sql = "UPDATE `actividad` SET `id_contacto`='".$total."' WHERE `orden_servicio`='".$_GET['orden_servicio']."';";
 mysql_query($sql);
 } 
 $sql= "select * from usuarios where usuario='".$_SESSION['k_username']."' ";
$respuesta=  mysql_query($sql);
while($fila=  mysql_fetch_array($respuesta)){
$cargo=$fila['cargo'];  

 } 
   if(isset($_GET['editar'])){
        $sql1= "SELECT a.*, b.*, c.* FROM  medicamentos b, cant_medicina a , medicamentos_asig c WHERE a.id_visita='".$_GET['codigo']."'  and a.id_medicina=c.id and b.codigo_int=cod_med and c.id='".$_GET['editar']."'";
$respuesta1=  mysql_query($sql1);
while($fila=  mysql_fetch_array($respuesta1)){
 $idmedicanmento=$fila['id'];    
$medicanmento=$fila['nombre_medicamento'];  
$cantidad_usada=$fila['cantidad_med']; 
$cantidad_rest=$fila['cantidad_rest']; 
 } 
 
 echo $idmedicanmento.' '.$medicanmento.'  '.$cantidad_usada.' '.$cantidad_rest;
   }     
       if(isset($_GET['editar_i'])){
        $sql1= "SELECT a.*, b.*, c.* FROM  insumos b, cant_insumos a , insumos_asignados c WHERE a.id_visita='".$_GET['codigo']."'  and a.id_insumo=c.id_ia and b.codigo=c.cod_insumo and c.id_ia='".$_GET['editar_i']."'";
$respuesta1=  mysql_query($sql1);
while($fila=  mysql_fetch_array($respuesta1)){
 $idinsumo=$fila['id_ia'];    
$insumo=$fila['nombre_insumo'];  
$cantidad_us=$fila['cantidad_ins']; 
$cantidad_re=$fila['cant_restante']; 
 } 
 
 echo $idinsumo.' '.$insumo.'  '.$cantidad_us.' '.$cantidad_re;
   }
?>
<body  onload="doScroll()" onunload="window.name=document.body.scrollTop">

	<div class="clear"></div>
                
		
                    
                  <article class="module width_full">
                    <table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">medicamentos a usar en esta atencion</font></th></tr></table> 
                        <header><form action="<?php if(isset($_GET['editar'])){echo '../modelo/editar_medicina_asig.php?codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'&editar='.$_GET['editar'].'';}else{echo '../modelo/editar_medicina_asig.php?codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'';} ?>" method="post" name="fcontacto">
                                <select name="insumo2" id="medicina" style="width:25%;">	
                                                          
                                                          <?php
                                                           if(isset($_GET['editar'])){echo"<option value='".$idmedicanmento."'>".$medicanmento."</option>";}else{echo '<option value="">Seleccione el medicamento</option>';
                                                            include "../modelo/conexion.php";
                                                            $or =$_SESSION['ord'];
                                                            $consulta= "SELECT a.*, b.nombre_medicamento, b.concentracion FROM medicamentos_asig a, medicamentos b where a.cantidad_rest!=0 and a.numero_orden='".$archivo."' and a.rel_atencion='".$orden_ser."' and a.cod_med=b.codigo_int";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['id'];
                                                            $valor2=$fila['nombre_medicamento'];
                                                            $valor3=$fila['concentracion'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2.' '.$valor3."</option>";
                                                            
                                                           }}
                                                            ?>

                                                            
                                                            
                                                        </select>
                                                       Cantidad Restante. : 
                                                       <textarea name="cantidad" id="medicinar" style="width:10%;" rows="1" readonly ><?php if(isset($_GET['editar'])){echo $cantidad_rest; } ?></textarea>
                                Cantidad a usar <input type="num" style="width:10%;" name="numero" value="<?php if(isset($_GET['editar'])){echo $cantidad_usada;} ?>">
                                <input type="submit" name="bosa" value="<?php if(isset($_GET['editar'])){echo 'Editar';}else{echo 'Agregar';} ?>"/></form></header>
                      <?php 
if(isset($_GET['codigo'])){
$request=mysql_query("SELECT a.*, sum(a.cantidad_med) as total, b.*, c.* FROM cant_medicina a , medicamentos b, medicamentos_asig c WHERE a.id_visita='".$_GET['codigo']."'  and a.id_medicina=c.id and b.codigo_int=cod_med group by a.id_medicina");
if($request){
//    echo'<hr>';
 $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Codigo'.'</th>';

          
              $table = $table.'<th>'.'Nombre del medicamento'.'</th>';
              $table = $table.'<th>'.'Cantidad Asig.'.'</th>';
              $table = $table.'<th>'.'Cantidad Usada'.'</th>';
              $table = $table.'<th>'.'Cantidad Restante'.'</th>';
             $table = $table.'<th>'.'Editar'.'</th>';
 //              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
            
            if($id_contacto<=99 || $up==1){
           $b='<a href="../vistas/?id=llenar_atencion&editar='.$row["id"].'&codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';
           $c='<a href="../vistas/?id=llenar_atencion&eliminar='.$row["id"].'&codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';
            }else{
                $b='';$c='';
            }

          
          
           
            $table = $table.'<tr><td>'.$row["cod_med"].'<font></a></td><td>'.$row["nombre_medicamento"].' '.$row["concentracion"].'<font></a></td>
               <td>'.$row["cantidad"].'</font></td><td>'.$row["cantidad_med"].'<font></a></td><td>'.$row["cantidad_rest"].'</font></td>
                   <td>'.$b.'</td>
                     </tr>';   
   
	}
        
	$table = $table.'</table>';
        
	echo $table;
        if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM cant_medicina WHERE id_cant='$Codigo'";
        mysql_query($sql, $conexion);
            echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=llenar_atencion&codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'"</script>'; 
    }   
}}


?>
		</article>
                <article class="module width_full">
                     	<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">insumos a usar en esta atencion</font></th></tr></table> 
			<header><form action="<?php if(isset($_GET['editar_i'])){echo '../modelo/editar_cant_insumos.php?codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'&editar_i='.$_GET['editar_i'].'';}else{echo '../modelo/editar_cant_insumos.php?codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'';} ?>" method="post" name="fcontacto">
                                <select name="insumo2" id="insumo" style="width:25%;">	
                                                      
                                                          <?php
                                                          if(isset($_GET['editar_i'])){echo"<option value='".$idinsumo."'>".$insumo."</option>";}else{echo '<option value="">Seleccione el medicamento</option>';
                                                            include "../modelo/conexion.php";
                                                            
                                                            $consulta= "SELECT a.*, b.* FROM insumos_asignados a, insumos b where a.cant_restante!=0 and a.numero_orden='".$archivo."'  and a.rel_atencion='".$orden_ser."' and a.cod_insumo=b.codigo";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['id_ia'];
                                                            $valor2=$fila['nombre_insumo'];
                                                           
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                          }}
                                                            ?>

                                                            
                                                            
                                                        </select>
                                                       Cantidad Restante. : 
                                                       <textarea name="cantidad" id="insumor" style="width:10%;" rows="1" readonly ><?php if(isset($_GET['editar_i'])){echo $cantidad_re; } ?></textarea>
                                Cantidad a usar <input type="text" style="width:10%;" name="numero" value="<?php if(isset($_GET['editar_i'])){echo $cantidad_us;} ?>">
                                <input type="submit" name="bosa" value="<?php if(isset($_GET['editar_i'])){echo 'Editar';}else{echo 'Agregar';} ?>"/></form></header>
                      <?php 
if(isset($_GET['codigo'])){
$request=mysql_query("SELECT a.*, sum(a.cantidad_ins) as total, b.*, c.* FROM cant_insumos a , insumos b, insumos_asignados c WHERE a.id_visita='".$_GET['codigo']."'  and a.id_insumo=c.id_ia and b.codigo=cod_insumo group by a.id_insumo");
if($request){
//    echo'<hr>';
   $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Codigo'.'</th>';

          
              $table = $table.'<th>'.'Nombre del insumo'.'</th>';
              $table = $table.'<th>'.'Cantidad Asig.'.'</th>';
              $table = $table.'<th>'.'Cantidad Usada'.'</th>';
              $table = $table.'<th>'.'Cantidad Restante'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
//              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
            if($id_contacto<=99 || $up==1){
           $b='<a href="../vistas/?id=llenar_atencion&editar_i='.$row["id_ia"].'&codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';
            }else{
                $b='';
            }
           if($eliminar_prod=='Habilitado'){$c='<a href="../vistas/reg_orden.php?eliminar='.$row["id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           

          
          
           
            $table = $table.'<tr><td>'.$row["cod_insumo"].'<font></a></td><td>'.$row["nombre_insumo"].'<font></a></td>
               <td>'.$row["cantidad"].'</font></td><td>'.$row["total"].'<font></a></td><td>'.$row["cant_restante"].'</font></td>
                   <td>'.$b.'</td>
                     </tr>';   
               
           
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM ordenes WHERE id='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/reg_orden.php"</script>'; 
    }   
}}


?>
		</article>
        <article class="module width_full">
			<table width="100%"><tr BGCOLOR="#4E8CCF"><th><font color="white">DETALLE DE LA ATENCION</font></th></tr></table> 
                        
                        
				<form name="insertar" action="../modelo/editar_atencion.php?cod=<?php echo $id_ta ?>" method="post" enctype="multipart/form-data">
				<div class="module_content"> 
                               
                                   
            
                <table class="table table-bordered table-striped table-hover" id="">
							<tr>
                                                           <td><label>visita : </label></td>
                                                           <td><input type="text" name="nombre" readonly value="<?php echo $asunto ?>"></td>
                                                        </tr>
                                                        <?php 
                                                           $t = substr("$fecha_inicio",0, -9);
                                                           $tt = substr("$fecha_vencimiento",0, -9);
                                                           $h = substr("$fecha_inicio",11, -6);
                                                           $m = substr("$fecha_inicio",14, -3);
                                                           $hh = substr("$fecha_vencimiento",11, -6);
                                                           $mm = substr("$fecha_vencimiento",14, -3);
                                                           $_SESSION['pasiente']=$orden_ser;
                                                            ?>
                                                           <tr><?php if($_SESSION["admin"] == 'Si'){ ?>
                                                           <td><label>Fecha Inicio :</label></td>
                                                           <td><input type="text" maxlength="8" name="fechai" required  style="width:100px;height:20px;" value="<?php echo $fecha_inicio ?>"/>
                                                                
                                                         </td>
                                                          </tr><?php  } ?>
                                                          
                                                          <tr>
                                                            <td><label>Realizado el día :</label></td>
                                                            <td><input type="text" name="fecha" required  id="datepicker2"  placeholder="Dia realizado" style="width:100px;height:20px;" value="<?php if(isset($registro_m)){echo $registro_m;}else{echo date("Y-m-d");} ?>"/>
                                                                <label>Hora</label><select name="hora"  style="width:100px;" required>
                                                                   <?PHP if(isset($duracion)){echo '<option value="'.$duracion.'">'.$duracion.'</option>';}  ?>
                                                                   <option value="01:00 AM">01:00 AM</option>
                                                                   <option value="01:15 AM">01:15 AM</option>
                                                                   <option value="01:30 AM">01:30 AM</option>
                                                                   <option value="01:45 AM">01:45 AM</option>
                                                                   <option value="02:00 AM">02:00 AM</option>
                                                                   <option value="02:15 AM">02:15 AM</option>
                                                                   <option value="02:30 AM">02:30 AM</option>
                                                                   <option value="02:45 AM">02:45 AM</option>
                                                                   <option value="03:00 AM">03:00 AM</option>
                                                                   <option value="03:15 AM">03:15 AM</option>
                                                                   <option value="03:30 AM">03:30 AM</option>
                                                                   <option value="03:45 AM">03:45 AM</option>
                                                                   <option value="04:00 AM">04:00 AM</option>
                                                                   <option value="04:15 AM">04:15 AM</option>
                                                                   <option value="04:30 AM">04:30 AM</option>
                                                                   <option value="04:45 AM">04:45 AM</option>
                                                                  <option value="05:00 AM">05:00 AM</option>
                                                                   <option value="05:15 AM">05:15 AM</option>
                                                                   <option value="05:30 AM">05:30 AM</option>
                                                                   <option value="05:45 AM">05:45 AM</option>
                                                                   <option value="06:00 AM">06:00 AM</option>
                                                                   <option value="06:15 AM">06:15 AM</option>
                                                                   <option value="06:30 AM">06:30 AM</option>
                                                                   <option value="06:45 AM">06:45 AM</option>
                                                                   <option value="07:00 AM">07:00 AM</option>
                                                                   <option value="07:15 AM">07:15 AM</option>
                                                                   <option value="07:30 AM">07:30 AM</option>
                                                                   <option value="07:45 AM">07:45 AM</option>
                                                                  <option value="08:00 AM">08:00 AM</option>
                                                                   <option value="08:15 AM">08:15 AM</option>
                                                                   <option value="08:30 AM">08:30 AM</option>
                                                                   <option value="08:45 AM">08:45 AM</option>
                                                                   <option value="09:00 AM">09:00 AM</option>
                                                                   <option value="09:15 AM">09:15 AM</option>
                                                                   <option value="09:30 AM">09:30 AM</option>
                                                                   <option value="09:45 AM">09:45 AM</option>
                                                                   <option value="10:00 AM">10:00 AM</option>
                                                                   <option value="10:15 AM">10:15 AM</option>
                                                                   <option value="10:30 AM">10:30 AM</option>
                                                                   <option value="10:45 AM">10:45 AM</option>
                                                                   <option value="11:00 AM">11:00 AM</option>
                                                                   <option value="11:15 AM">11:15 AM</option>
                                                                   <option value="11:30 AM">11:30 AM</option>
                                                                   <option value="11:45 AM">11:45 AM</option>
                                                                   <option value="12:00 M">12:00 M</option>
                                                                   <option value="12:15 PM">12:15 PM</option>
                                                                   <option value="12:30 PM">12:30 PM</option>
                                                                   <option value="12:45 PM">12:45 PM</option>
                                                                     <option value="01:00 PM">01:00 PM</option>
                                                                   <option value="01:15 PM">01:15 PM</option>
                                                                   <option value="01:30 PM">01:30 PM</option>
                                                                   <option value="01:45 PM">01:45 PM</option>
                                                                   <option value="02:00 PM">02:00 PM</option>
                                                                   <option value="02:15 PM">02:15 PM</option>
                                                                   <option value="02:30 PM">02:30 PM</option>
                                                                   <option value="02:45 PM">02:45 PM</option>
                                                                   <option value="03:00 PM">03:00 PM</option>
                                                                   <option value="03:15 PM">03:15 PM</option>
                                                                   <option value="03:30 PM">03:30 PM</option>
                                                                   <option value="03:45 PM">03:45 PM</option>
                                                                   <option value="04:00 PM">04:00 PM</option>
                                                                   <option value="04:15 PM">04:15 PM</option>
                                                                   <option value="04:30 PM">04:30 PM</option>
                                                                   <option value="04:45 PM">04:45 PM</option>
                                                                  <option value="05:00 PM">05:00 PM</option>
                                                                   <option value="05:15 PM">05:15 PM</option>
                                                                   <option value="05:30 PM">05:30 PM</option>
                                                                   <option value="05:45 PM">05:45 PM</option>
                                                                   <option value="06:00 PM">06:00 PM</option>
                                                                   <option value="06:15 PM">06:15 PM</option>
                                                                   <option value="06:30 PM">06:30 PM</option>
                                                                   
                                                                   
                                                               </select>
                                                              </td>
                                                          </tr>
                                                          
                                                        
                                                        <tr>
                                                           <td><label>Atencion prestada :</label></td>
                                                           <td><textarea name="descripcion" readonly style="width:90%;" rows="2"><?php if(isset($_POST['descripcion'])){echo $_POST['descripcion'];}else{echo $descripcion_act;} ?></textarea></td>
                                                          </tr>
                                                          
                                                          <tr>
                                                           <td><label>Signos Vitales:</label></td>
                                                           <td><b><font color="red">Observaciones : <?php  echo $obs ?></font></b></td>
                                                          </tr>
                                                           <tr>
                                                           <td><label>Visitar Cada:</label></td>
                                                           <td><b><font color="red"><input type="text" name="dias" readonly value="<?php  echo $dias ?>"> Dias</font></b></td>
                                                          </tr>
                                                           <tr>
                                                               
                                                           <td><label>PA:</label></td>
                                                           <td> <input type="text" name="PA" style="width:130px;height:20px;" value="<?php if(isset($_POST['PA'])){echo $_POST['PA'];}else{echo $pa;} ?>">  </td>
                                                           </tr>
                                                           <tr>
                                                            <td><label>PULSO:</label></td>
                                                            <td> <input type="text" name="PULSO" style="width:130px;height:20px;" value="<?php if(isset($_POST['PULSO'])){echo $_POST['PULSO'];}else{echo $pulso;} ?>"> </td>
                                                                 
                                                            </tr>    
                                                            <tr>
                                                            <td><label>FR:</label></td>
                                                            <td> <input type="text" name="FR" style="width:130px;height:20px;" value="<?php if(isset($_POST['FR'])){echo $_POST['FR'];}else{echo $fr;} ?>"> </td>      
                                                            </tr>  
                                                          
                                                            
                                                            </tr>    
                                                            <tr>
                                                            <td><label>Valoración:</label></td>
                                                            <td><textarea required name="Valoracion" style="width:90%;" rows="4"><?php if(isset($_POST['Valoracion'])){echo $_POST['Valoracion'];}else{echo $valoracion;} ?></textarea></td>     
                                                            </tr>  
                                                          
                                                          
                                                          <tr>
                                                           <td><label>Tratamiento Realizado :</label></td>
                                                           <td><textarea name="tratamiento" style="width:90%;" rows="4"><?php if(isset($_POST['tratamiento'])){echo $_POST['tratamiento'];}else{echo $tratamiento;} ?></textarea></td>
                                                          </tr>
                                                          <tr>
                                                           <td><label>Estado :</label></td>
                                                           <td><select name="estado" style="width:130px;">
                                                                   <option value="<?php if(isset($estado_act)){echo $estado_act;}?>"><?php if(isset($estado_act)){echo $estado_act;}?></option>
                                                                   <option value="No iniciada">No iniciada</option>
                                                                  
<!--                                                                   <option value="En proceso">En proceso</option>-->
                                                                   <option value="Completada">Completada</option>
<!--                                                                   <option value="Pendiente">Pendiente</option>
                                                                   <option value="Aplazada">Aplazada</option>-->
                                                               </select></td>
                                                           
                                                          </tr>
                                                          <tr>
                                                           <td><label>Prueba covid-19 realizada? :</label></td>
                                                           <td><select name="pru" style="width:130px;">
                                                                   <option value="<?php if(isset($pru)){echo $pru;}?>"><?php if(isset($pru)){echo $pru;}?></option>
                                                                   <option value="No">No</option>
                                                                  
<!--                                                                   <option value="En proceso">En proceso</option>-->
                                                                   <option value="Si">Si</option>
<!--                                                                   <option value="Pendiente">Pendiente</option>
                                                                   <option value="Aplazada">Aplazada</option>-->
                                                               </select></td>
                                                           
                                                          </tr>
                                                          <?php  if($cargo=='ENFERMERA'){  ?>
                                                            <?php if($id_contacto<=99 || $up==1){     ?>
                                                         <tr>
                                                             <td><label>Tiene Curaciones ?</label><a href='javascript: curaciones()'><input type="button" name="cancelar" value="Si.."></a> </td>
                                                              <td></td>
                                                          </tr>
                                                            <?php }} ?>
                                                          <?php  if($_SESSION['admin']=='Si'){  ?>
                                                         <tr>
                                                             <td><label>Tiene Curaciones ?</label><a href='javascript: curaciones()'><input type="button" name="cancelar" value="Si.."></a> </td>
                                                              <td></td>
                                                          </tr>
                                                          <?php } ?>
                                                     </table>
		    </fieldset>
                                   
                                    
                                     <hr><br>
                                     <?php if($id_contacto<=99){  ?>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
                                     <?php }else if($up==1){ ?>
                                         <input type="submit" name="enviar" value="Guardar" class="alt_btn">
                                     <?php } ?>
					 <a href="../vistas/?id=ver_orden_interna&ord=<?php echo $_GET['orden_servicio'] ?>"><INPUT TYPE="button" VALUE="Cancelar"></a>
				</div>
                    </form>

                                       <hr><br>
                                      
                        
                                      
                                    
				
                       
		</article>
                <br>
            
		</div>
	

</body>

</html>