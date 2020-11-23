<?php 
include "../modelo/conexion.php";
?>
<head>
    <script language="javascript">
function alquiler_new(page){
    var ano = $("#ano").val();
    var mes = $("#mes").val();
    var orden = $("#orden1").val();
    var nombre = $("#nombre").val();
    var apellido = $("#apellido").val();
    var regimen = $("#regimen").val();
    var esta = $("#estad").val();
    var documento = $("#documento").val();
    var empresa = $("#empresa").val();
    console.log(esta);
    $("#cargando").html('<img src="../../images/guardando.gif"> Cargando...');
    $.ajax({
        type:'GET',
        data:'page='+page+'&ano='+ano+'&mes='+mes+'&orde='+orden+'&nombre='+nombre+'&apellido='+apellido+'&regimen='+regimen+'&estado='+encodeURIComponent(esta)+'&documento='+documento+'&empresa='+empresa,
        url:'../vistas/alquiler/lista_alquiler.php',
        success: function(datos){
            $("#mostrar_alquiler").html(datos);
            $("#cargando").html('');
        }
    });
    
}
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
</head>

<body onload="alquiler_new(1)">

    <article class="module width_full">
	<header>
            <h3>Equipos Alquilados</h3>
        </header>
        <div class="module_content">
            
                <div>
                    <table class="table table-bordered table-striped table-hover" id="">
                        <tr>
                       
                            <td>
                                <input placeholder="No. Documento" id="documento" style="width:130px;height:20px;">
                            </td>
                            <td>
                                 
                                <select id="estad" style="width:180px;">
                                    
                                    <option value="Completada">Completada</option>
                                    <option value="">En proceso</option>
                                </select>
                            </td>
                        
                        </tr>
                        <tr>
                           
                                <td>
                                    <input placeholder="Nombre" id="nombre" style="width:130px;height:20px;">
                                </td>
                                <td>
                                   
                                
                                    <select id="regimen" style="width:180px;">
                                        <option value="">--Seleccione Regimen--</option>
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
                                </td>
                        </tr>
                        <tr>
                            <td>
                                <input placeholder="Apellido" id="apellido" style="width:130px;height:20px;">
                            </td>
                            <td>
                                <input placeholder="Año" id="ano" style="width:130px;height:20px;" value="<?php echo date("Y") ?>">
                                
                                 <select id="mes" style="width:130px;">
                                    <option value="<?php echo date("%") ?>">Cualquier Mes</option>
                                    <option value="<?php echo date("01") ?>">Enero</option>
                                    <option value="<?php echo date("02") ?>">Febrero</option>
                                    <option value="<?php echo date("03") ?>">Marzo</option>
                                    <option value="<?php echo date("04") ?>">Abril</option>
                                    <option value="<?php echo date("05") ?>">Mayo</option>
                                    <option value="<?php echo date("06") ?>">Junio</option>
                                    <option value="<?php echo date("07") ?>">Julio</option>
                                    <option value="<?php echo date("08") ?>">Agosto</option>
                                    <option value="<?php echo date("09") ?>">Septiembre</option>
                                    <option value="<?php echo date("10") ?>">Octubre</option>
                                    <option value="<?php echo date("11") ?>">Noviembre</option>
                                    <option value="<?php echo date("12") ?>">Diciembre</option>
                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                                <input placeholder="Autorizacion" id="orden1" style="width:130px;height:20px;">
                            </td>
                            <td>
                                
                                                    <select id="empresa" style="width:180px;">
                                                                   <option value="">..Empresa..</option>
                                                                   <?php
                                                           $consulta= "SELECT * FROM `sis_empresa` where cliente='Si'";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['rips'];
                                                            $valor2=$fila['nombre_emp'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select>
                                                </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="buscar" value="Buscar" class="alt_btn" onclick="alquiler_new(1)">
                                <input type="reset" value="Limpiar">
                            </td>
                            <td id="cargando"></td>
                        </tr>
                    </table>
                                        
                                        
                                 
                                    
                                                        
				    </div>
<form name="buscarA" action="../vistas/?id=all_alquiler_full&cod=rep" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-striped table-hover" id="">

             <thead >
             <tr BGCOLOR="#C3D9FF">
             <th>No.CC.</th>
             <th>Paciente.</th>
             <th>Regimen</th>
             <th>Ult. Orden</th>
             <th>Rango de Fecha</th>
             <th>Ultimo Mes</th>
             <th>Estado</th>
             <th>Facturado?</th>
             <th>Editar</th> 
             <th>Eliminar</th>
             <th>Repetir</th>
             </tr>
             </thead>
             <tbody id="mostrar_alquiler">
                 
             </tbody>


      
</table> 
            

            </form>
            <?php
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM equipos_asig WHERE id_equipo_a='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=all_alquiler_full"</script>'; 
    }
   
         

if(isset($_GET['cod'])){
    if(isset($_POST["cant"]))
    {
        $n = $_POST["cant"];
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["valor$x"])){
                include "../modelo/conexion.php";
                 $sql2 = "select * from ordenes WHERE id_paciente='".$_POST["valor$x"]."'  order by id desc limit 1";
                 $fila2 =mysql_fetch_array(mysql_query($sql2));
                 $fi = $fila2["fecha_registro"];
                 $ff = $fila2["fecha_final"];
                 $fecha_i = date("Y-m-d",strtotime("$fi + 1 month"));
                 $fecha_f = date("Y-m-d",strtotime("$ff + 1 month"));
                 $archi = $fila2["id"];
          
          $sqlw = "select max(oi) from ordenes";
        $fila =mysql_fetch_array(mysql_query($sqlw));
        $oi=$fila['max(oi)']+ 1;
          
        
    //se inserta una nueva orden de alquiler
        $esta = 'En proceso';
        $esta2 = 'En proceso';
        $motivo = 'Esta orden se encuentra en proceso';
        $facturado = 'No Facturado';
        $aut = 'Pendiente';
        
	$sql = "INSERT INTO `ordenes`(`oi`,`orden`,`id_paciente`, `fecha_registro`, `fecha_final`, `estado_ord`, `estado_2`, `motivo`, `facturado`)";
        $sql.= "VALUES ('".$oi."', '".$aut."','".$_POST["valor$x"]."','".$fecha_i."','".$fecha_f."','".$esta."','".$esta2."','".$motivo."','".$facturado."')";
        mysql_query($sql);
        
                  //Consulta del ultimo archivo
$sql1 = "SELECT MAX(id) as id_inc FROM ordenes";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$archivo_u = $fila1["id_inc"];



        //insertar equipos de soporte
$consulta4= "select * from equipos_asig WHERE  numero_orden_a='".$archi."'";
$result4=  mysql_query($consulta4);
while($fila=  mysql_fetch_array($result4)){

    

    $orden_externa_e='Pendiente';
    $cantidad_e=$fila['cantidad'];
    $cod_equipo=$fila['cod_equipo'];
    $precio_e=$fila['precio_a'];
    $meses=$fila['meses'];
    $fecha_e=date("Y-m-d");
    $f_i_e=$fila['fecha_a'];
    $f_f_e=$fila['fecha_f'];
    $factura = 'nada';
    $fecha_i_e = date("Y-m-d",strtotime("$f_i_e + 1 month"));
    $fecha_f_e = date("Y-m-d",strtotime("$f_f_e + 1 month"));
    $estado_e = 'alquilado';
    
    $sql4 = "INSERT INTO `equipos_asig`(`facturado`,`numero_orden_a`, `cod_equipo`, `cantidad`, `precio_a`, `fecha_a`, `fecha_f`, `rel_atencion`, `autorizacion`, `fecha_reg`, `estado_a`, `meses`)";
    $sql4.= "VALUES ('".$factura."','".$archivo_u."', '".$cod_equipo."', '".$cantidad_e."', '".$precio_e."', '".$fecha_i_e."', '".$fecha_f_e."', '".$archivo_u."', '".$orden_externa_e."', '".$fecha_e."', '".$estado_e."', '".$meses."')";
    mysql_query($sql4);
    }
        echo 'Los No de Guia de repetidos fueron :'.$_POST["valor$x"].' Archivo # :'.$archivo_u.' Orden Int. Alq. :'.$oi.'<br>';
       
        
            }         
        }     
    }
     echo '<a href="../vistas/?id=all_alquiler_full">Presione aqui para confirmar</a>';
}

?>

                                               
                                  </fieldset>   
				</div>
                       
		</article>
