<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_alquiler.php';
require '../modelo/consultar_permisos.php';
$request=mysql_query('SELECT a.*, c.*, b.* FROM equipos_asig a, ordenes b, pacientes c WHERE c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$_GET["codigo"].' group by b.id desc');
$c =0;
while ($rt = mysql_fetch_array($request)){
    $c += 1;
}
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $c;
}else{
	$num_items = 0;
}
$rows_by_page = 12;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}$_SESSION['t'] = $_POST;
include "../modelo/conexion.php";
$ss = "SELECT * FROM pacientes where id_paciente='".$_GET['codigo']."'";
$fii =mysql_fetch_array(mysql_query($ss));
$name = $fii["nombres"].' '.$fii["apellidos"];
$esta = $fii["estado_pac"];
$retirado = $fii["retirado"];
$mot_retiro = $fii["motivo_ret"];
$estado_alq = $fii["estado_alq"];
$deposito = $fii["deposito_alq"];
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
<?php

?>

<?php $das = $_SESSION['t']; ?>
<body onload="<?php $das = $_SESSION['t'];if(!empty($das['options'])) echo $das['options']; ?>">
<article class="module width_full">
			<header><h3>Registro alquileres del Paciente <?php echo $name ?></h3></header>
                        
                 
				<div class="module_content">
                                    <form action="<?php echo '../vistas/?id=alquileres_pac&codigo='.$_GET['codigo'];   ?>" method="post">
                                        <select name="estado">
                                            <?php  if($estado_alq==''){echo '<option value="">Cambiar Estado</option>';}else{echo '<option value="'.$estado_alq.'">'.$estado_alq.'</option>';}    ?>
                                            
                                            <option value="Retirado">Retirado</option>
                                     
                                        </select><br>
                                        <input type="date" name="fecha_retiro" value="<?php echo $retirado;  ?>" placeholder="Fecha de retiro" required>Ultima Modificacion
                                        <br> <input type="text" name="deposito" value="<?php echo $deposito;  ?>" placeholder="Deposito"> Deposito
                                        <br>
                                        <textarea name="mot" placeholder="Digite el motivo de retiro de alquiler"><?php if($estado_alq!=''){echo $mot_retiro;}  ?></textarea>
                                   <input type="submit" name="actualizar" value="Actualizar"><br>
                                    </form>                         
                                   
                                     <table class="table table-bordered table-striped table-hover" id="">
                                         <tr><td>
            <?php
if($page>1){?>
        <a href="../vistas/?id=alquileres_pac&codigo=<?php echo $_GET["codigo"] ?>&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=alquileres_pac&codigo=<?php echo $_GET["codigo"] ?>&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=alquileres_pac&codigo=<?php echo $_GET["codigo"] ?>&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=alquileres_pac&codigo=<?php echo $_GET["codigo"] ?>&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
$request=mysql_query('SELECT a.*, c.*, b.* FROM equipos_asig a, ordenes b, pacientes c WHERE c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.id_paciente='.$_GET["codigo"].' group by b.id desc '.$limit);

if($request){
 
$table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Orden Interna.'.'</th>';
              $table = $table.'<th>'.'Autorizacion.'.'</th>';
//              $table = $table.'<th>'.'Paciente.'.'</th>';
//              $table = $table.'<th>'.'Regimen'.'</th>';

              $table = $table.'<th>'.'Mes de'.'</th>';
              
              $table = $table.'<th>'.'Rango de Fecha'.'</th>';
              $table = $table.'<th>'.'Meses'.'</th>';
               $table = $table.'<th>'.'Estado'.'</th>';
               $table = $table.'<th>'.'Pago'.'</th>';
    
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
               $table = $table.'</tr>';
$table = $table.'</thead>';
 $a=date("H:i").':00'; 
 $cont = 0;
 while($row=mysql_fetch_array($request))
	{    
     $cont = $cont + 1 ;
         $ver='<a href="../vistas/?id=add_detalle_alquiler&cod='.$row["id"].'&codigo_pac='.$_GET["codigo"].'">';
         if($editar_prod=='Habilitado'){$b='<a href="../vistas/detalle_ordenes_alquiler.php?codigo='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($eliminar_prod=='Habilitado'){$c='<a href="../vistas/alquiler_proceso_pac.php?eliminar='.$row["id"].'&codigo='.$_GET['codigo'].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
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
           
           if($row["estado_ord"] == 'En proceso'){$color='<font color="red">';}
           if($row["estado_ord"] == 'Completada'){$color='<font color="green">';}
       
           if($row["orden"] == 'Pendiente'){$led='<img src="../imagenes/led.gif" alt="ver" height="10px" width="10px">';}else{$led='';}
           
           if($row["autorizacion"]=='Pendiente'){$aut = '<font color="purple">Pendiente';}else{$aut = $row["autorizacion"];}
           $table = $table.'<tr><td>'.$color.''.$row["oi"].'<font></a></td><td>'.$led.' '.$ver.''.$aut.'</font></td>
               <td>'.$color.''.$m.'</font></td><td>'.$color.''.$row["fecha_a"].' al '.$row["fecha_f"].'</font></td>
                    <td>'.$color.''.$row["meses"].'<font></a></td><td>'.$color.''.$row["estado_ord"].'<font></a></td><td>'.$color.''.$row["facturado"].'<font></a></td>
                        </tr>';
	}
        $table = $table.'</table>';
        echo $table;
      
}
?>
        <form name="buscarA" action="../vistas/alquiler_proceso.php?cod=rep" method="post" enctype="multipart/form-data">
           
            <table>
                <tr>
                    <td><label><i>Total de Archivos: </i></label> <input type="text" name="cant"  style="width:20px;height:20px;"  value="<?php echo $cont; ?>"></td>
                </tr>
                
            </table>  

            </form>
            <?php

    
    

                         
?>
       </td></tr> </table> 
                                               
                                    
				</div>
                       
		</article>

             <?php 
             if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sqlx = "DELETE FROM ordenes WHERE id='$Codigo'";
         mysql_query($sqlx, $conexion);
         $sql = "DELETE FROM equipos_asig WHERE numero_orden_a='$Codigo'";
         mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/alquiler_proceso_pac.php?codigo='.$_GET['codigo'].'"</script>'; 
    }
                if(isset($_POST['actualizar']))
    {
     
       $sqlx = "UPDATE pacientes SET deposito_alq='".$_POST['deposito']."', estado_alq='".$_POST['estado']."', retirado='".$_POST['fecha_retiro']."', motivo_ret='".$_POST['mot']."' WHERE id_paciente=".$_GET['codigo'];
       mysql_query($sqlx, $conexion);
       echo '<script lanquage="javascript">alert("Se ha editado el estado del cliente");location.href="../vistas/?id=alquileres_pac&codigo='.$_GET['codigo'].'"</script>'; 
    }

