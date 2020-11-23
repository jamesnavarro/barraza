<?php 
include "../../modelo/conexion.php";
if(isset($_GET['exportar'])){
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte.xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>IDB</title>
    <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
      <link href="../../vistas/doc.ico" type="image/x-icon" rel="shortcut icon" />
      <script> 
        function mostrar_reportes(){
            var documento = $("#documento").val();
            var nombre = $("#nombre").val();
            var apellido = $("#apellido").val();
            var empresa = $("#empresa").val();
            var ano = $("#ano").val();
            var orden = $("#orden").val();
            var estado = $("#estado").val();
            var regimen = $("#regimen").val();
            $("#cargando").html('<img src="../../images/guardando.gif"> Cargando...');
            $.ajax({
                type:'GET',
                data:'regimen='+regimen+'&documento='+documento+'&nombre='+nombre+'&apellido='+apellido+'&empresa='+empresa+'&ano='+ano+'&orden='+orden+'&estado='+estado,
                url:'reportes_listado.php',
                success:function(datos){
                    $("#mostrar_listado").html(datos);
                    $("#cargando").html('');
                }
            });
        }
        function exportar(){
            var documento = $("#documento").val();
            var nombre = $("#nombre").val();
            var apellido = $("#apellido").val();
            var empresa = $("#empresa").val();
            var ano = $("#ano").val();
            var orden = $("#orden").val();
            var estado = $("#estado").val();
            var regimen = $("#regimen").val();
            $("#cargando").html('<img src="../../images/guardando.gif"> Cargando...');
            window.open("reportes_listado_exp.php?regimen="+regimen+"&documento="+documento+"&nombre="+nombre+"&apellido="+apellido+"&empresa="+empresa+"&ano="+ano+"&orden="+orden+"&estado="+estado,"","");
      
    
        }
      </script>
      <style>
          .james {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.james table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.james tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.james table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.james table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.james tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.james tr:hover td{
	
}
.james tr:ntd-child(odd){ background-color:#cfd4fc; }
.james tr:ntd-child(even)    { background-color:#ffffff; }.james td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:3px;
	font-size:10px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.james tr:last-child td{
	border-width:0px 1px 0px 0px;
}.james tr td:last-child{
	border-width:0px 0px 1px 0px;
}.james tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.james tr:first-child td{
		background:-o-linear-gradient(bottom, #6675ff 5%, #6675ff 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #6675ff), color-stop(1, #6675ff) );
	background:-moz-linear-gradient( center top, #6675ff 5%, #6675ff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#6675ff", endColorstr="#6675ff");	background: -o-linear-gradient(top,#6675ff,6675ff);

	background-color:#6675ff;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:9px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.james tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #6675ff 5%, #6675ff 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #6675ff), color-stop(1, #6675ff) );
	background:-moz-linear-gradient( center top, #6675ff 5%, #6675ff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#6675ff", endColorstr="#6675ff");	background: -o-linear-gradient(top,#6675ff,6675ff);

	background-color:#6675ff;
}
.james tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.james tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
      </style>
</head>
<body onload="mostrar_reportes();">

    <article class="module width_full">
	<header>
            <h3>Equipos Alquilados x</h3>
            
        </header>
        <div class="module_content">
            <div action=""  method="post">
                <div>
                    <table class="table table-bordered table-striped table-hover" id="">
                        <tr>
                       
                            <td>
                                <input placeholder="No. Documento" id="documento" style="width:130px;height:20px;">
                            </td>
                            <td>
                                 <select id="empresa" style="width:150px;">
                                                                   
                                                          <option value="">Empresa..</option>
                                                          <?php
                                               
                                                            $consulta= "select rips,nombre_emp from sis_empresa where cliente='Si'";                     
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
                                <input placeholder="Año" id="ano" value="<?php echo date("Y") ?>" style="width:130px;height:20px;">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input placeholder="Autorizacion" id="orden" style="width:130px;height:20px;">
                            </td>
                            <td><select id="estado" style="width:130px;">
                            
                                    <option value="">Con alquiler</option>
                                    <option value="Retirado">Retirado</option>
                                    
                                </select></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="buscar" value="Buscar" class="alt_btn" onclick="mostrar_reportes(1)">
                                <input type="reset" value="Limpiar"> 
                               
<!--                                    <button onclick="exportar()">Exportar Excel</button>-->
                        
                            </td>
                            <td id="cargando"></td>
                        </tr>
                    </table>
                                        
                                        
                                 
                                    
                                                        
				    </div></div>
<form action="../alquiler/reportes.php?cod=rep" method="post">
              
<table class="table table-bordered table-striped table-hover" id="">
                                         <tr><td>


<table class="james" border="1" cellpadding="0" cellspacing="0">

     
             <tr BGCOLOR="#C3D9FF">
             <td>Fecha Ingreso.</td>
             <td>Documento.</td>
             <td>Paciente.</td>
             <td>Deposito.</td>
             <td>Equipos.</td>
             <td>Regimen</td>
             <td>Enero</td>
             <td>Febrero</td>
             <td>Marzo</td>
             <td>Abril</td>
             <td>Mayo</td>
             <td>Junio</td>
             <td>Julio</td>
             <td>Agosto</td>
             <td>Septiembre</td>
             <td>Octubre</td>
             <td>Novienbre</td>
             <td>Diciembre</td>
              <td>E</td>
               <td>R</td>
             </tr>
              <tbody id="mostrar_listado">
                  <tr><td colspan="20"> <img src="../../images/guardando.gif"> 
              </tbody>
        </table>
      

        

            <table>
                
                
            </table>  

       </td></tr> </table> 
</form>       
                                  </fieldset>   
				</div>
                       
		</article>
</body>
</html>

          
            <?php
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM equipos_asig WHERE id_equipo_a='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=all_alquiler_full"</script>'; 
    }
   
?>
<?php
if(isset($_GET["cod"])){
  
   
    if(isset($_POST["cant"]))
    {
        $n = $_POST["cant"];
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["valor$x"])){
                include "../../modelo/conexion.php";
                 $sql2 = "select * from ordenes WHERE id_paciente='".$_POST["valor$x"]."' and oi!=0  order by id desc limit 1";
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
    $idp=$fila['id_paciente'];
    $precio_e=$fila['precio_a'];
    $meses=$fila['meses'];
    $fecha_e=date("Y-m-d");
    $f_i_e=$fila['fecha_a'];
    $f_f_e=$fila['fecha_f'];
    $factura = 'nada';
    $fecha_i_e = date("Y-m-d",strtotime("$f_i_e + 1 month"));
    $fecha_f_e = date("Y-m-d",strtotime("$f_f_e + 1 month"));
    $estado_e = 'alquilado';
    
    $sql4 = "INSERT INTO `equipos_asig`(`id_paciente`, `facturado`,`numero_orden_a`, `cod_equipo`, `cantidad`, `precio_a`, `fecha_a`, `fecha_f`, `rel_atencion`, `autorizacion`, `fecha_reg`, `estado_a`, `meses`)";
    $sql4.= "VALUES ('".$idp."', '".$factura."','".$archivo_u."', '".$cod_equipo."', '".$cantidad_e."', '".$precio_e."', '".$fecha_i_e."', '".$fecha_f_e."', '".$archivo_u."', '".$orden_externa_e."', '".$fecha_e."', '".$estado_e."', '".$meses."')";
    mysql_query($sql4);
    }
        echo 'Los No de Guia de repetidos fueron :'.$_POST["valor$x"].' Archivo # :'.$archivo_u.' Orden Int. Alq. :'.$oi.'<br>';
       
        
            }         
        }     
    }
     echo '<a href="../alquiler/reportes.php">Presione aqui para confirmar</a>';
}