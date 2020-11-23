<script>
function compuestos(cot,cli,item,por,tipo){
    window.open("../vistas/?id=add_acc&cot="+cot+"&cli="+cli+"&mas="+item+"&por="+por+"&pagina=new_fac&tipo_cli="+tipo,"Compuestos","width=900 , height=700");
}
    function eliminar_prod(idcotizacion,cotizacion,cliente){
        var eliminar = confirm('Desea Eliminar Items?');
        if(eliminar){
            $.ajax({    
                type: 'GET',
                data: 'idcotizacion='+idcotizacion+'&cotizacion='+cotizacion+'&cliente='+cliente,
                url: '../modelo/eliminar_items.php',
                success: function(){
                     location.reload();
                }
               
            });
            
//            location.href=('../vistas/?id=new_fac&cot='+cotizacion+'&cli='+cliente);
        }else{
            return false;
        }
    }
    function pasar(cli,op,id_cot){
    	alert(cli + ' - ' + op + ' - ' + id_cot);
    	//window.opener.lista(cli,op,id_cot);
    }
    function lista(cli,op,id_cot){
    	$.ajax({
    		type: 'GET',
    		data: 'cli='+cli+'&op='+op+'&id_cot='+id_cot,
    		url: '../planeacion/vistas/form/listaproductosplaneacion.php',
    		success: function(data){
    			$("#ver").html(data);
    		}
    	});
    }
            function copiar(id_item,id_cot, cli){
                
            var con = confirm("Desea copiar este items?");
            if(con){
                var can = prompt("Cantidad a copiar");
                if(can===''){
                    alert("Debes digitar la cantidad a copiar");
                    return false;
                }
                $("#"+id_item+"").attr("disabled", true);
                
                $.ajax({
                        type: 'GET',
                        data: 'cli='+cli+'&copy='+id_item+'&cot='+id_cot+'&can='+can,
                        url: '../vistas/form/copiar_items.php',
                        success: function(data){
    			alert(data);
                        window.location.href='../vistas/?id=new_fac&cot='+id_cot+'&cli='+cli;
    		        }
                });
                  
            }
    }
    function quitar_items(){
        var cotizacion = $("#cotizacionx").val();
        var con = confirm("Desea eliminar los items seleccionados? " + cotizacion);
        if(con){
               $("input[name=item]:checked").each(function(){
		var id = $(this).attr("id");
             $.ajax({    
                type: 'GET',
                data: 'idcotizacion='+id+'&cotizacion='+cotizacion,
                url: '../modelo/eliminar_items.php',
                success: function(){
                     //alert(id);
                }
               
            });
           });
           alert("se elimino con exito los items seleccionados");
           location.reload();
        }
    }
    var xye = 0;
    var tt = 0;
    function activar_boton(ct){
         var can = $("#cantidad_total").val();
          var ciu = $("#ciu").val();
           var cot = $("#cotizacionx").val();
           var gt = $("#gt").val();
        xye = parseInt(xye) + parseInt(ct);
        console.log(xye);
        $("#rep").html("Generando "+xye+" de "+can);

        if(parseInt(can)===parseInt(xye)){
                       $("#btn_report").attr("disabled", false);
                       $("#btn_report").html('Generar Reporte');
                       xye = 0;
                       $("#rep").html("Ok");
                       window.open('../form/reporte_costos.php?cot='+cot+'&ciudad='+ciu+'&gt='+gt, 'Reporte_Total', 'width=1100, height=600');
                   }   
    }
        function reporte_items(){
        var con = confirm("Desea Generar el reporte de costos? ");
        if(con){
              var can = $("#cantidad_total").val();
       
              $("#btn_report").attr("disabled", true);
              $("#btn_report").html('<img src="../imagenes/load.gif"> Generando..');
              var c = 0;
               $("input[name=item2]:checked").each(function(){
                   c ++;
		var id = $(this).attr("id");
                var url = $("#ver"+id).val();
             $.ajax({    
                success: function(){
                   window.open(url, 'Reporte'+id, 'width=100, height=100');
                   
                }
               
            });
           });
           

        }
    }
    $(document).ready(function(){
        $("#ancho_max").change(function(){
            var an = $("#an_max").val();
            var ancho = $("#ancho_max").val();
            if(parseInt(ancho)>parseInt(an)){
                $("#msg").val("El ancho es mayor al standar "+an);
                $("#ancho_max").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg").val('');
                 $("#ancho_max").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#alto_max").change(function(){
            var an = $("#al_max").val();
            var ancho = $("#alto_max").val();
            if(parseInt(ancho)>parseInt(an)){
                 $("#msg2").val("El alto es mayor al standar "+an);
                 $("#alto_max").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg2").val('');
                 $("#alto_max").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#ancho2").change(function(){
            var an = $("#an_max2").val();
            var ancho = $("#ancho2").val();
            if(parseInt(ancho)>parseInt(an)){
                $("#msg3").val("El ancho es mayor al standar "+an);
                $("#ancho2").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg3").val('');
                 $("#ancho2").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#alto2").change(function(){
            var an = $("#al_max2").val();
            var ancho = $("#alto2").val();
            if(parseInt(ancho)>parseInt(an)){
                 $("#msg4").val("El alto es mayor al standar "+an);
                 $("#alto2").attr("style", "border-color:red;width: 70px;");
            }else{
                 $("#msg4").val('');
                  $("#alto2").attr("style", "border-color:black;width: 70px;");
            }
        });
        $("#color_alum").change(function(){
            var col = $("#color_alum").val();
            var cot = $("#cotizacionx").val();
            var con = confirm("Esta seguro de cambiar el color de aluminio para esta cotizacion");
            if(con){
            $.ajax({
    		type: 'POST',
                data: 'col='+col+'&cot='+cot+'&cli=0',
                url: '../modelo/act_cot_color.php',
                success: function(data){
                    alert("Se han actualizado los colores para esta cotizacion. "+data);
                	window.location.href='../vistas/?id=new_fac&cot='+cot+'&cli=0';
                }
    		});
            }else{
                $("#color_alum").val('').focus();
                return false;
            }
        });
    	$("#actualizar_list_prod").click(function(){
    		var cuerpo = $("#cuerpo").val();
    		var ladomm = $("#ladomm").val();
    		var boq = $("#BOQUETE").val();
    		var per = $("#PERFORACION").val();
    		var id_cot = $("#id_cot").val();
    		var op = $("#op").val();
    		var cli = $("#cli").val();
    		var id_cotizacion = $("#id_cotizacion").val();
    		if (boq == undefined) {
    			boq = 0;
    		}
    		if (per == undefined) {
    			per = 0;
    		}
    		//alert(id_cot + ' - ' + op + ' - ' + cli + ' - ' + id_cotizacion);
    		$.ajax({
    			type: 'POST',
                data: 'cuerpo='+cuerpo+'&ladomm='+ladomm+'&boq='+boq+'&per='+per+'&id_cot='+id_cot+'&op='+op+'&cli='+cli+'&id_cotizacion='+id_cotizacion,
                url: '../modelo/act_cot_sinvalores.php',
                success: function(data){
                	pasar(cli,op,id_cot);
                }
    		});
    	});

    	$("#add_vidrio").click(function() {
    		var id_cot = $("#id_cot_servicios").val();
    		var id_cli = $("#id_cli_servicios").val();
    		var servicio_hidden = $("#servicio_hidden").val();
    		var valor_servicio = $("#valor_servicio").val();
    		var id_vidrio_servicio = $("#vidrio_servicio_hidden").val();
    		var porcentaje_servicio_vidrio = $("#porcentaje_servicio_vidrio").val();
    		var ancho_vidrio_servicio = $("#ancho_vidrio_servicio").val();
    		var alto_vidrio_servicio = $("#alto_vidrio_servicio").val();
    		var id_espesor_servicio = $("#espesor_servicio_hidden").val();
    		var perforacion_vidrio_servicio = $("#perforacion").val();
    		var boquete_vidrio_servicio = $("#boquete").val();
    		var trae_vidrio = $("#trae_vidrio").val();
    		var cant_vidrio = $("#cant_vidrio").val();
    		//alert(id_cot + " - " + id_cli + " - " + servicio_hidden + " - " + id_vidrio_servicio + " - " + porcentaje_servicio_vidrio + " - " + ancho_vidrio_servicio + " - " + alto_vidrio_servicio + " - " + id_espesor_servicio + " - " + perforacion_vidrio_servicio + " - " + boquete_vidrio_servicio + " - " + cant_vidrio);
    		if (servicio_hidden.length == 0) {
    			$("#servicio_hidden").focus();
    			return false;
    		}
    		if (id_vidrio_servicio.length == 0) {
    			$("#vidrio_servicio").focus();
    			return false;
    		}
    		if (porcentaje_servicio_vidrio.length == 0) {
    			$("#porcentaje_servicio_vidrio").focus();
    			return false;
    		}
    		if (ancho_vidrio_servicio.length == 0) {
    			$("#ancho_vidrio_servicio").focus();
    			return false;
    		}
    		if (alto_vidrio_servicio.length == 0) {
    			$("#alto_vidrio_servicio").focus();
    			return false;
    		}
    		if (id_espesor_servicio.length == 0) {
    			$("#espesor_servicio").focus();
    			return false;
    		}
    		if (perforacion_vidrio_servicio.length == 0) {
    			$("#perforacion").focus();
    			return false;
    		}
    		if (boquete_vidrio_servicio.length == 0) {
    			$("#boquete").focus();
    			return false;
    		}
    		if (cant_vidrio.length == 0) {
    			$("#cant_vidrio").focus();
    			return false;
    		}
    		$.ajax({
    			type: "POST",
    			//url: "../modelo/cotizacion_1_servicios.php?tipo=vidrio&porcentaje_servicio_vidrio="+porcentaje_servicio_vidrio,
    			url: "../modelo/cotizacion_1_servicios.php",
    			data: "linea=Vidrio&cot="+id_cot+"&cli="+id_cli+"&servicio_hidden="+servicio_hidden+"&valor_servicio="+valor_servicio+"&ref="+id_vidrio_servicio+"&valor_vidrio_hidden="+valor_vidrio_hidden+"&ancho="+ancho_vidrio_servicio+"&trae_vidrio="+trae_vidrio+
    				  "&alto="+alto_vidrio_servicio+"&precio="+porcentaje_servicio_vidrio+"&cuerpo=0&hoja=1&pelicula=No Aplica&install=Si&vid="+id_espesor_servicio+"&per="+perforacion_vidrio_servicio+"&boq="+boquete_vidrio_servicio+"&cant="+cant_vidrio,
    			success: function(data) {
    				//alert(data);
    				$("#info_vidrios").html(data);
    				$("#vidrio_servicio_hidden").val("");
    				$("#referencia_vidrio_servicio_hidden").val("");
    				$("#valor_vidrio_hidden").val("");
    				$("#vidrio_servicio").val("");
    				$("#porcentaje_servicio_vidrio").val($("#porcentaje_servicio_vidrio option:first").val());
    				$("#ancho_vidrio_servicio").val("");
    				$("#alto_vidrio_servicio").val("");
    				$("#espesor_servicio_hidden").val("");
    				$("#espesor_servicio").val("");
    				$("#perforacion").val("");
    				$("#boquete").val("");
    				$("#trae_vidrio").val($("#trae_vidrio option:first").val());
    				$("#cant_vidrio").val("");
    			}
    		});
    	});
    	$("#add_accesorio").click(function() {
    		var id_cot = $("#id_cot_servicios").val();
    		var id_cli = $("#id_cli_servicios").val();
    		var servicio_hidden = $("#servicio_hidden").val();
    		var id_accesorio_servicio = $("#accesorio_servicio_hidden").val();
    		var valor_accesorio_hidden = $("#valor_accesorio_hidden").val();
    		var porcentaje_servicio_accesorio = $("#porcentaje_servicio_accesorio").val();
    		var ancho_accesorio_servicio = $("#ancho_accesorio_servicio").val();
    		var alto_accesorio_servicio = $("#alto_accesorio_servicio").val();
    		var color_aluminio = $("#color_aluminio").val();
    		var cant_accesorio = $("#cant_accesorio").val();
    		//alert(id_cot + " - " + id_accesorio_servicio);
    		if (servicio_hidden.length == 0) {
    			$("#servicio_hidden").focus();
    			return false;
    		}
    		if (id_accesorio_servicio.length == 0) {
    			$("#accesorio_servicio").focus();
    			return false;
    		}
    		if (porcentaje_servicio_accesorio.length == 0) {
    			$("#porcentaje_servicio_accesorio").focus();
    			return false;
    		}
    		if (ancho_accesorio_servicio.length == 0) {
    			$("#ancho_accesorio_servicio").focus();
    			return false;
    		}
    		if (alto_accesorio_servicio.length == 0) {
    			$("#alto_accesorio_servicio").focus();
    			return false;
    		}
    		if (color_aluminio.length == 0) {
    			$("#color_aluminio").focus();
    			return false;
    		}
    		if (cant_accesorio.length == 0) {
    			$("#cant_accesorio").focus();
    			return false;
    		}
    		$.ajax({
    			type: "POST",
    			url: "../modelo/agregar_servicios.php?tipo=accesorio",
    			data: "id_cot="+id_cot+"&id_cli="+id_cli+"&servicio_hidden="+servicio_hidden+"&id_accesorio_servicio="+id_accesorio_servicio+"&valor_accesorio_hidden="+valor_accesorio_hidden+"&porcentaje_servicio_accesorio="+porcentaje_servicio_accesorio+"&ancho_accesorio_servicio="+ancho_accesorio_servicio+
    				  "&alto_accesorio_servicio="+alto_accesorio_servicio+"&color_aluminio="+color_aluminio+"&cant_accesorio="+cant_accesorio,
    			success: function(data) {
    				$("#info_accesorios").html(data);
    				$("#accesorio_servicio_hidden").val("");
    				$("#valor_accesorio_hidden").val("");
    				$("#accesorio_servicio").val("");
    				$("#porcentaje_servicio_accesorio").val($("#porcentaje_servicio_accesorio option:first").val());
    				$("#ancho_accesorio_servicio").val("");
    				$("#alto_accesorio_servicio").val("");
    				$("#color_aluminio").val($("#color_aluminio option:first").val());
    				$("#cant_accesorio").val("");
    			}
    		});
    	});
    });
</script>
<script>
	function resetFields() {
    	$("#vidrio_servicio_hidden").val("");
    	$("#espesor_servicio_hidden").val("");
    	$("#accesorio_servicio_hidden").val("");
    }
	function infoTipoServicio(id_tipo_servicio, tipo_servicio, valor_tipo_servicio) {
		$("#cant_servicio").val("").focus();
		$("#servicio_hidden").val(id_tipo_servicio);
		$("#servicio").val(tipo_servicio).attr("readonly", true);;
		$("#valor_servicio").val(valor_tipo_servicio);
		$("#valor_servicio_hidden").val(valor_tipo_servicio);
		$("#cant_servicio").focus();
	}
            function nuevo_servicio(){
               $("#servicio_hidden").val('');
               $("#servicio").attr("readonly", false).val('').focus(); 
            }
            function calculo(){
               var und = $("#valor_servicio").val();
               var can = $("#cant_servicio").val();
               var ser = $("#servicio_hidden").val();
                if(ser===''){
                    $("#msgs").html(' x 40% de utilidad');
                     var tot = (und / 0.6) * can;
                }else{
                     var tot = parseInt(und) * parseInt(can);
                     $("#msgs").html('');
                }
            
           
            $("#total").val(tot);
    }
    $(function(){
        $('#cant_servicio').change(function(){
            calculo();
        });
        $('#valor_servicio').change(function(){
            calculo();
        });
    });
	function tipoServicio() {
		window.open('../combos/tipo_servicio.php', 'Servicios', 'width=800, height=800');
	}
	function infoTipoVidrio(referencia_vidrio, id_tipo_vidrio, tipo_vidrio) {
		//alert(referencia_vidrio + " - " + id_tipo_vidrio + " - " + tipo_vidrio);
		$("#vidrio_servicio_hidden").val(id_tipo_vidrio);
		$("#referencia_vidrio_servicio_hidden").val(referencia_vidrio);
		$("#vidrio_servicio").val(tipo_vidrio);
	}
	function tipoVidrio() {
		window.open('../vistas/lista_productos_servicios.php?linea=Vidrio', 'Vidrios', 'width=800, height=800');
	}
	function infoTipoEspesor(tipo_espesor, id_tipo_espesor) {
		//alert(tipo_espesor + " - " + id_tipo_espesor);
		$("#espesor_servicio_hidden").val(id_tipo_espesor);
		$("#espesor_servicio").val(tipo_espesor);
	}
	function tipoEspesor() {
		window.open('../combos/span_vidrio1_servicios.php', 'Espesores', 'width=800, height=800');
	}
	function infoTipoAccesorio(tipo_accesorio, id_tipo_accesorio, referencia_accesorio, medida_accesorio, valor_accesorio) {
		//alert(tipo_accesorio + " - " + id_tipo_accesorio + " - " + referencia_accesorio + " - " + medida_accesorio);
		$("#accesorio_servicio_hidden").val(id_tipo_accesorio);
		$("#accesorio_servicio").val(tipo_accesorio);
		$("#valor_accesorio_hidden").val(valor_accesorio);
	}
	function tipoAccesorio() {
		window.open('../vistas/materiales_servicios.php', 'Materiales', 'width=800, height=800');
	}
</script>
<?php
	$query_select_cot = mysql_query("SELECT * FROM cotizacion WHERE id_cot = '" . $_GET['cot'] . "'");
	$row_cot = mysql_fetch_array($query_select_cot);
	$express = $row_cot['express'];
	if (isset($_GET['up_1'])) {
		$sql21 = "SELECT * FROM referencia_acce WHERE id_ref_acce = " . $_GET['up_1'];
		$fila21 = mysql_fetch_array(mysql_query($sql21));
		$ref = $fila21["num_ref"];
		$des = $fila21["descripcion_a"];
		$cod = $fila21["codigo"];
		$cos = $fila21["costo_a"];
	}
?>  
 <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
                                <h4 class="title">Productos Cotizados y aprobados</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
 
                                <ul class="nav nav-tabs">
                                      <li class="active"><a href="#tab5" data-toggle="tab"><span class="icon icone-eye-open"></span> Lista</a></li>
                                 
 <?php    if($estado=='En proceso'){
     
     ?>  
                                  
<?php  if($crear_conf=='Habilitado'){echo '<li class=""><a href="#tab6" data-toggle="tab"><span class="icon icone-eye-open"></span> Agregar Producto</a></li>'
    . '<li class=""><a href="#tab7" data-toggle="tab"><span class="icon icone-eye-open"></span> Agregar servicios</a></li>'
        . '<li class=""><a href="#tab8" data-toggle="tab"><span class="icon icone-eye-open"></span> Venta Directa</a></li>'
        . '<li class=""><a href="#tab9" data-toggle="tab"><span class="icon icone-eye-open"></span> Venta De Kit de Accesorios</a></li>'
        . '';
              }  ?>
<?php   }else{
             
            
}
 if($_SESSION['area']=='Presupuesto' || $_SESSION['admin']=='Si'){
    echo ' <li class=""><a href="#tab10" data-toggle="tab"><span class="icon icone-eye-open"></span> Reportes Administrativo</a></li>';
 }
//include '../vistas/imprimir_reportes.php';
	//Codigo Agregado (Jaime)
	$query_total_item = mysql_query("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]."  order by c.fila asc");
	$row_total_item = mysql_num_rows($query_total_item);
 ?> 
          <form name="buscarA" action="../vistas/print.php" method="get"  target="_blank"  enctype="multipart/form-data">
                <div align="right">
                    <input style="width:30px;" type="hidden" name="cot" id="cotizacionx" value="<?php echo $_GET['cot']; ?>">
                    <input style="width:30px;" type="hidden" name="c" value="">
                    <input style="width:30px;" type="hidden" name="total_item" value="<?php echo $row_total_item; ?>" /><!--Codigo Agregado (Jaime)-->
                    <input style="width:30px;" type="number" name="col" value="<?php if(isset($_POST['col'])){echo $_POST['col'];}else{echo '7';} ?>">
                    <select name="ciudad"><?php if(isset($_POST['ciudad'])){echo '<option value="'.$_POST['ciudad'].'">'.$_POST['ciudad'].'</option>';} ?><option value="Barranquilla">Barranquilla</option><option value="Bogota">Bogota</option></select>
                    <button type="submit"><img src="../imagenes/print.png"> Imprimir PDF</button>   
                </div>
          </form>
			<?php
				if ($express == 1) { ?>
					<center><h3><font color="red">COTIZACIÓN EXPRESS!!</font></h3></center>
				<?php
				}
			?>
                                    <div align="right">
                                
                                        
                                        
                                       <a title="Reporte de utilidad" href="../vistas/costos.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;">
                                           <button type="button"> <img src="../imagenes/bars.png"> REPORTE UTILIDAD </button>
                                       </a>
                                       <a href="<?php echo '../vistas/reportes_orden_cot_2.php?cot='.$_GET['cot'].''; ?>">
                                           <button ><img src="../imagenes/file_excel.png" width="15px">Exportar</button>
                                       </a>
                                    
                                            <?php  

                                            
	if ($fila21["cr"] != 0) {
		if ($estado == 'Aprobado') {
			echo '<button><img src="../images/ok.png"> Aprobado</button>';
	?>
	<?php
    	}
	} else {
		if ($fila21["cp"] == 0) {
			echo '<b style="color:red">Cotizacion sin Registros.</b>';
		} else {
			echo '<b style="color:red">Este pedido se encuentra en produccion.</b>';
		}
	}
	?>
                                        <button><a target="_blank" href="../vistas/?id=send&cot=<?php echo $_GET['cot']; ?>&cli=<?php echo $_GET['cli'].'&tipo='.$tipo.' '; ?>"><img src="../imagenes/carta.jpg"> Enviar Email</a></button>
                                        <button onclick="window.open('form/asignar_huacal.php?cot=<?php echo $_GET["cot"];?>', 'Asignar', 'width=500, height=200');"><img src="../imagenes/add.png"> HUACAL</a></button>
                                     
                                       <?php
                                       if($estado=='Pedido por aprobar'){
                                        if($_SESSION["k_username"]=='FXIQUES' || $_SESSION["admin"]=='Si'){
                                            if($_GET['cli']!='11533'  && $_GET['cli']!='658'){
                                echo '<a href="../vistas/?id=new_fac&ped=ok&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'" title="cotizacion Revisada"><button type="button"> <img WIDTH=18 HEIGHT=18 src="../imagenes/images.jpg"> Generar Pedido</button></a>';
                                }}
                                       }
                                       if($estado=='En proceso'){
                                       if($_GET['cli']=='658'){
                                           $po = -50;
                                       }else{
                                           $po = $pal;
                                       }
                                           ?><button onclick="ver_cotizacion(<?php echo $_GET['cot']; ?>)">Cotizador de Vidrios</button>  <a title="Editor de porcentajes por item y general" href="../vistas/porcentajes.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli'].'&max='.$po; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1200,height=700'); return false;"><button type="button"><img src="../imagenes/edit_precio.png"> Editar Porcentajes.</button></a> <?php  }  ?> 
                                    <a href="../vistas/imagenes.php?cot=<?php echo $_GET['cot']; ?>&cli=<?php echo $_GET['cli'].''; ?>" title="Editar medidas las imagenes de los productos" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><button type="button"><img src="../imagenes/edit_imagen.png"> Editar Imagen</button></a>
                               <?php  if($estado=='En proceso'){  ?>  <?php echo '<a href="../vistas/?id=new_fac&congelar='.$row["id_cotizacion"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'" title="Congelar Cotizacion"><button type="button"><img src="../imagenes/guardar.jpg"> Congelar Cotizacion</button></a>';  ?>
                              <?php } ?>
                                   
                                </ul>
   
                                <div class="tab-content">
                                    <div class="tab-pane <?php if(!isset($_GET['up_serv']) && !isset($_GET['up_mat']) && !isset($_GET['up_k'])){echo 'active';}  ?>" id="tab5">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                   <div class="row-fluid">
                        <!-- START Form Wizard -->
                    
                            <section class="body">
                                 <?php  if($estado!='Aprobado'){  ?>  
                                <header style="background: yellow;"><center><h4 class="title">Productos cotizados (<?php echo 'Cotizacion No.'.$numero_cotizacion; ?>) <?php echo '    (<font color="red">V.'.$numero_cotizacion.'.'.$version.'</font>)'  ?></h4></center></header>
                                 <?php  }else{  ?>  
                                 <header style="background: yellow;"><center><h4 class="title">Lista de Pedidos Aprobados <?php  echo '(Pedido No.'. $orden_p.')'  ?></h4></center></header>
                                 <?php  }  ?>  
                                <div class="body-inner">
                                        
                                        <div class="control-group">
                                           <?php
                                           if(isset($_GET['up'])){
            $sql21 = ("SELECT * FROM producto a, cotizaciones c where   c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." and c.id_cotizacion=".$_GET['up']."");
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $linea_cot= $fila21["linea_cot"];
            $id_referencia= $fila21["id_p"];
            $producto= $fila21["producto"];
            $id_vidrio= $fila21["id_vidrio"];
            $id_vidrio2= $fila21["id_vidrio2"];
            $id_vidrio3= $fila21["id_vidrio3"];
            $id_vidrio4= $fila21["id_vidrio4"];
            $id_vidrio5= $fila21["id_vidrio5"];
            $id_vidrio6= $fila21["id_vidrio6"];
            $pelicula= $fila21["pelicula"];
            $id2_vidrio= $fila21["id2_vidrio"];
            $id2_vidrio2= $fila21["id2_vidrio2"];
            $id2_vidrio3= $fila21["id2_vidrio3"];
            $id2_vidrio4= $fila21["id2_vidrio4"];
            $id2_vidrio5= $fila21["id2_vidrio5"];
            
            $id3_vidrio= $fila21["id3_vidrio"];
            $id3_vidrio2= $fila21["id3_vidrio2"];
            $id3_vidrio3= $fila21["id3_vidrio3"];
            $id3_vidrio4= $fila21["id3_vidrio4"];
            $id3_vidrio5= $fila21["id3_vidrio5"];
            
            $id4_vidrio= $fila21["id4_vidrio"];
            $id4_vidrio2= $fila21["id4_vidrio2"];
            $id4_vidrio3= $fila21["id4_vidrio3"];
            $id4_vidrio4= $fila21["id4_vidrio4"];
            $id4_vidrio5= $fila21["id4_vidrio5"];
            $lado= $fila21["imagen"];$ladomm= $fila21["lado"];
            $laminas= $fila21["laminas"];
            $laminas2= $fila21["laminas2"];
            $laminas3= $fila21["laminas3"];
            $laminas4= $fila21["laminas4"];
            $traz_vid= $fila21["traz_vid"];
            $traz_vid2= $fila21["traz_vid2"];
            $traz_vid3= $fila21["traz_vid3"];
            $traz_vid4= $fila21["traz_vid4"];
            $cierre_cot = $fila21["cierre"];
            $ancho_cot= $fila21["ancho_c"];
            $aa= $fila21["ancho_abajo"];
            $alto_cot= $fila21["alto_c"];
             $ancho_temp= $fila21["ancho_temp"];
             $alto_temp= $fila21["alto_temp"];
            $cantidad_cot= $fila21["cantidad_c"];
            $por= $fila21["porcentaje"];
            $por_mp= $fila21["porcentaje_mp"];
            $ruta= $fila21["ruta"];
            $ruta2= $fila21["ruta2"];
            $color_ta= $fila21["color_ta"];
            $cuerpo= $fila21["cuerpo"];$tip= $fila21["tip"];
            $hoja= $fila21["hojas"];
            $pel= $fila21["rollo"];
            $desc= $fila21["desc"];
             $per= $fila21["per"];
              $boq= $fila21["boq"];
            $install= $fila21["install"];
            $obs= $fila21["observaciones"];
            $obs2= $fila21["observaciones2"];
            $modulo= $fila21["modulo"];
            $huacal= $fila21["huacal"];
                     $vert= $fila21["verticales"];
                        $ubica= $fila21["ubicacion_c"];
                        $adicional= $fila21["imagen_mas"];
              $hori= $fila21["horizontales"]; 
              $d1= $fila21["d1"];
              $duracion= $fila21["duracion"];
              $ancho_maximo= $fila21["ancho_maximo"];
              $alto_maximo= $fila21["alto_maximo"];
              $msg= $fila21["msg"];
              $msg2= $fila21["msg2"];
              $cantlam= $fila21["cantlam"];
              if($pvi==0 && $pal==0 && $pac==0){
              	if ($express == 1) {
              		$ppp = '<select name="desc" readonly  style="width: 60px;" id="descuento">
                                                      <option value="'.$desc.'">'.$desc.'</option>
                                                       <option value="0">0</option>
                                                   </select>';
              	} else {
              		$ppp =' <select name="desc" readonly  style="width: 60px;" id="descuento">
                                                      <option value="'.$desc.'">'.$desc.'</option>
                                                       <option value="0">0</option>
                                                       <option value="1">1</option>
                                                       <option value="2">2</option>
                                                       <option value="3">3</option>
                                                       <option value="4">4</option>
                                                       <option value="5">5</option>
                                                       <option value="6">6</option>
                                                       <option value="7">7</option>
                                                       <option value="8">8</option>
                                                       <option value="9">9</option>
                                                       <option value="10">10</option>

                                                       
                                                   </select>';
              	}
              }else{
                          if($linea_cot=='Vidrio'){
                              $ppp = '<input type="text" name="desc" value="'.$pvi.'" style="width: 70px;" >';
                          }else{
                              if($linea_cot=='Aluminio'){
                             $ppp = '<input type="text" name="desc" value="'.$pal.'" style="width: 70px;" >';
                              }else{
                             $ppp = '<input type="text" name="desc" value="'.$pac.'" style="width: 70px;" >';
                              }
              }   }                 
                                               ?>
                                             <?php 
                      $cons = mysql_fetch_array(mysql_query("select * from dolares order by id_dolar desc limit 1"));
                      $pd = $cons['precio_dolar'];
                     ?>
                                               <div class="row-fluid">
					<?php
						if (isset($_GET['check'])) { ?>
							<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo "../modelo/act_cot_sinvalores.php?id_cot=".$_GET['cot']."&id_cotizacion=".$_GET['up']."&op=".$_GET['op']."&cli=".$_GET['cli']; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
						<?php
						} else { ?>
							<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/cotizacion_1.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&editar='.$_GET['up'].'&tipo_cli='.$tipo.' '; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
						<?php
						}
					?>
                            <section class="body">
                                <div class="body-inner">
                                   <hr>
                                    <button type="submit" ><img src="../imagenes/guardar.jpg">Guardar Cambios</button>
                                     <a href="../vistas/?id=new_fac&cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']  ?>"><button type="button" ><img width="18px" height="18px" src="../imagenes/no.png">Cancelar</button></a>
                                     Dollar :$<input type="text" value="<?php echo $pd ?>" name="dolar" id="dolar" style="width:40px;" readonly="false">
                                     Notificaciones: <input type="text" value="<?php echo $msg ?>" name="msg" id="msg3" readonly="false"> <input type="text" value="<?php echo $msg2 ?>" name="msg2" id="msg4" readonly="false">
                                     <input type="hidden" value="<?php echo $cons['id_dolar'] ?>" name="id_dolar" style="width:40px;" >
                                     Ciudad : <input type="text" id="ciu" name="ciu" value="<?php echo $ciudadx ?>" readonly>
                                     <hr>
                                     <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <td>linea de produccion</td>
                                            <td><select name="linea" id="linea">
                                                    <?php if(isset($_GET['up'])){
                                                        echo "<option value='".$linea_cot."'>".$linea_cot."</option>";
                                                    
                                                    }else{
                                                        echo "<option value=''>.:Seleccione la linea:.</option>"; 
                                                        
                                                    } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta2= "SELECT * FROM `lineas`";                     
                                                            $result2=  mysql_query($consulta2);
                                                            while($fila=  mysql_fetch_array($result2)){
                                                            $valor1=$fila['linea'];
                                                           
                                                            $valor3=$fila['linea'];
                                                         
                                                            echo"<option value='".$valor1."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Instalacion:</td>
                                            <td> <select name="install"  style="width: 80px;">
                                                        <?php echo '<option value="'.$install.'">'.$install.'</option>';    ?>
                                                            <option value="Si">Si</option>    
                                                        <option value="No">No</option>
                                                         
                                                        </select></td>
                                        
                                                        <td rowspan="7" id="imagen"  style="width:30%"><div align="center"><?php if(isset($_GET['up'])){
                                                if($lado=='Derecho'){
                                                    echo '<img src="../producto/'.$ruta.'" width=120px heigth=120px>';
                                                }else{
                                                    echo '<img src="../producto/'.$ruta2.'" width=120px heigth=120px>';
                                                }
                                            } ?></div></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Referencia del producto</td>
                                            <td>
                                            <div id="busqueda"><a href="../vistas/lista_productos.php?linea=<?php echo $linea_cot; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"> <img src="../imagenes/pop.png"> Busqueda Avanzada</a></div>
                                                <input name="a" type="hidden" readonly id="refer"  value="<?php echo $fila21["referencia_p"]; ?>"><input name="b" readonly type="text" id="descr"  value="<?php echo $producto; ?>">
                                                <input type="hidden" readonly name="ref" id="codig" value="<?php echo $id_referencia; ?>">
                                                <input type="hidden" readonly  id="an_max2" value="<?php echo $ancho_maximo ?>">
                                                <input type="hidden" readonly  id="al_max2" value="<?php echo $alto_maximo; ?>">
                                                </td>
                                            <td>Descuento de Venta:</td>
                                            <td> <select name="precio"  style="width: 80px;" <?php if ($express == 1){ echo "readonly='readonly'";} ?> >
                                                        <?php echo '<option value="'.$por.'">'.$por.'</option>'; ?>
                                                        <?php
	                                                    	if ($express == 1) { ?>
	                                                    		<option value="p1">p1</option>
	                                                    	<?php
	                                                    	} else { ?>
	                                                    		<option value="p1">p1</option>
	                                                      		<option value="p2">p2</option>
	                                                         	<option value="p3">p3</option>
	                                                    	<?php
	                                                    	}
	                                                    ?>
                                                    </select></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Sentido</td>
                                            <td><select name="lado"  id="select2_1" style="width: 100%;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$lado.'">'.$lado.'</option>';} ?>                                                      
                                                            
                                                       <option value="N/A">N/A</option>
                                                        <option value="Derecho">Derecho</option>
                                                        <option value="Izquierdo">Izquierdo</option>
                                                </select></td>
                                            <td></td>
                                            <td><input type="hidden" readonly name="precio_mp" value="<?php echo $por_mp ?>"  style="width: 80px;">
                                                 </td>
                                        </tr>
                                         
                                        <tr>
                                            <td>Trazabilidad del vidrio
                                            
                                            </td>
                                            <td id="vidrios"> 
                                                   <?php if(isset($_GET['up'])){
                                                       if($traz_vid==0){
                                                      
                                                            echo "<input type='hidden'  name='traz_vid' id='valo1' value='".$traz_vid."'  required>"
                                                                    . "<input placeholder='Vidrio #1' autocomplete='off' type='text' name='xxx' id='valo2' value='Ya tiene'>"
                                                                    . "<input type='hidden' name='modulo' value='".$modulo."'  required> ";

                                                       }else{
                                                        $con= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid." ";
                                                        $res=  mysql_query($con);
                                                         while($f=  mysql_fetch_array($res)){
                                                        $idco=$f['id_p'];
                                                        $nombre1=$f['producto'];

                                                        }
                                                        $con2= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid2." ";
                                                        $res2=  mysql_query($con2);
                                                         while($f2=  mysql_fetch_array($res2)){
                                                        $idco2=$f2['id_p'];
                                                        $nombre2=$f2['producto'];

                                                        }
                                                       $con23= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid3." ";
                                                        $res23=  mysql_query($con23);
                                                         while($f2=  mysql_fetch_array($res23)){
                                                        $idco3=$f2['id_p'];
                                                        $nombre3=$f2['producto'];

                                                        }
                                                        $con24= "SELECT * FROM `producto` where linea='Vidrio' and id_p=".$traz_vid4." ";
                                                        $res24=  mysql_query($con24);
                                                         while($f2=  mysql_fetch_array($res24)){
                                                        $idco4=$f2['id_p'];
                                                        $nombre4=$f2['producto'];

                                                        }
                                                if($hoja >=1){
                                                echo "<input type='hidden' name='traz_vid' id='valo1' value='".$idco."'  required>"
                                                . "<input placeholder='Vidrio #1' type='text' value='".$nombre1."' name='xxx' id='valo2'  required onclick='vidrio()'><br> ";

                                                }if($hoja >=2){
                                                echo "<input type='hidden' name='traz_vid2' id='valo3' value='".$idco2."'  required>"
                                                . "<input type='text' placeholder='Vidrio #2' value='".$nombre2."' name='xxx' id='valo4'  required onclick='vidrio2()'><br> ";

                                                }if($hoja >=3){
                                                echo "<input type='hidden' name='traz_vid3' id='valo5' value='".$idco3."'  required>"
                                                . "<input type='text' placeholder='Vidrio #2' value='".$nombre3."' name='xxx' id='valo6'  required onclick='vidrio3()'><br> ";

                                                }if($hoja >=4){
                                                echo "<input type='hidden' name='traz_vid4' id='valo7' value='".$idco4."'  required>"
                                                . "<input type='text' placeholder='Vidrio #2' value='".$nombre4."' name='xxx' id='valo8'  required onclick='vidrio4()'><br> ";

                                                }
                                                       }

                                                      
      
                                                   } ?>
                                                 </td>
                                            <td>Con descuento de:</td>
                                            <td><?php  echo $ppp;  ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td># Laminas</td>
                                            <td> 
                                                <div  id="lam">
                                                    <?php if(isset($_GET['up'])){ 
                                                        if($laminas!=0){  ?>
                                                     <select name="laminas"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$laminas.'">'.$laminas.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                </select>
                                                    <?php }else{echo '<input type="text" name="laminas" value="0">';}?>
                                                </div>
                                                <div  id="lam2">
                                                    <?php if($laminas2!=0){  ?>
                                                     <select name="laminas2"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$laminas2.'">'.$laminas2.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                </select>
                                                    <?php } ?>
                                                </div>
                                                <div  id="lam3">
                                                    <?php if($laminas3!=0){  ?>
                                                     <select name="laminas3"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$laminas3.'">'.$laminas3.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                     
                                                </select>
                                                    <?php } ?>
                                                </div>
                                                <div  id="lam4">
                                                    <?php if($laminas4!=0){  ?>
                                                     <select name="laminas4"  style="width: 80px;" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$laminas4.'">'.$laminas4.'</option>';} ?>                                                      
                                                        <option value="1">1</option>    
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        
                                                </select>
                                                    <?php }} ?>
                                                </div>
                                           </td>
                                            <td>Tipo: </td>
                                            <td><input type="text" name="tip" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $tip;} ?>" placeholder="ej: PV-1"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Color y Espesor de vidrio</td>
                                            <td>
                                                <div  id="vid">
                                                    <?php
                                                    if($laminas==0) {  
                                                    
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid' id='valor2' value='0' required><input type='text' name='xxx' id='valor1' value='No tiene vidrio'  required>";
                                                        
                                                    }
                                                     }
                                                    if($laminas>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].' - ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid' id='valor2' value='".$id_vidrio."' required><input type='text' name='xxx' id='valor1' value='".$color_v."'  required onclick='atencion()'><br>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].' - ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid2' id='valor4' value='".$id_vidrio2."' required><input type='text' name='xxx' id='valor3' value='".$color_v2."'  required onclick='atencion2()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].' - ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid3' id='valor6' value='".$id_vidrio3."' required><input type='text' name='xxx' id='valor5' value='".$color_v3."'  required onclick='atencion3()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].' - ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid4' id='valor8' value='".$id_vidrio4."' required><input type='text' name='xxx' id='valor7' value='".$color_v4."'  required onclick='atencion4()'><br>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].' - ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid5' id='valor10' value='".$id_vidrio5."' required><input type='text' name='xxx' id='valor9' value='".$color_v5."'  required onclick='atencion5()'><br>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].' - ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid6' id='valor12' value='".$id_vidrio6."' required><input type='text' name='xxx' id='valor11' value='".$color_v6."'  required onclick='atencion6()'><br>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                            <div  id="vid2">
                                                <?php if($laminas2>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd' id='valor22' value='".$id2_vidrio."' required><input type='text' name='xxx' id='valor21' value='".$color_v."'  required onclick='atenciond()'><br>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas2>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd2' id='valor24' value='".$id2_vidrio2."' required><input type='text' name='xxx' id='valor23' value='".$color_v2."'  required onclick='atenciond2()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas2>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd3' id='valor26' value='".$id_vidrio3."' required><input type='text' name='xxx' id='valor25' value='".$color_v3."'  required onclick='atenciond3()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas2>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd4' id='valor28' value='".$id2_vidrio4."' required><input type='text' name='xxx' id='valor27' value='".$color_v4."'  required onclick='atenciond4()'><br>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas2>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd5' id='valor210' value='".$id2_vidrio5."' required><input type='text' name='xxx' id='valor29' value='".$color_v5."'  required onclick='atenciond5()'><br>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas2>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id2_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidd6' id='valor212' value='".$id2_vidrio6."' required><input type='text' name='xxx' id='valor211' value='".$color_v6."'  required onclick='atenciond6()'><br>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?></div>
                                                <div  id="vid3">
                                                     <?php if($laminas3>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt' id='valor32' value='".$id3_vidrio."' required><input type='text' name='xxx' id='valor31' value='".$color_v."'  required onclick='atenciont()'><br>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas3>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt2' id='valor34' value='".$id3_vidrio2."' required><input type='text' name='xxx' id='valor33' value='".$color_v2."'  required onclick='atenciont2()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas3>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt3' id='valor36' value='".$id3_vidrio3."' required><input type='text' name='xxx' id='valor35' value='".$color_v3."'  required onclick='atenciont3()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas3>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt4' id='valor38' value='".$id3_vidrio4."' required><input type='text' name='xxx' id='valor37' value='".$color_v4."'  required onclick='atenciont4()'><br>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas3>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt5' id='valor310' value='".$id3_vidrio5."' required><input type='text' name='xxx' id='valor39' value='".$color_v5."'  required onclick='atenciont5()'><br>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas3>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id3_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidt6' id='valor312' value='".$id3_vidrio6."' required><input type='text' name='xxx' id='valor311' value='".$color_v6."'  required onclick='atenciont6()'><br>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                                <div  id="vid4">
                                                     <?php if($laminas4>=1) {  
                                                    $sql = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio;
                                                    $fila =mysql_fetch_array(mysql_query($sql));
                                                    $color_v = $fila["color_v"].'- ('.$fila["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc' id='valor42' value='".$id4_vidrio."' required><input type='text' name='xxx' id='valor41' value='".$color_v."'  required onclick='atencionc()'><br>";
                                                        
                                                    }
                                                     }  
                                                     if($laminas4>=2) { 
                                                    $sql2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio2;
                                                    $fila2 =mysql_fetch_array(mysql_query($sql2));
                                                    $color_v2 = $fila2["color_v"].'- ('.$fila2["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc2' id='valor44' value='".$id4_vidrio2."' required><input type='text' name='xxx' id='valor43' value='".$color_v2."'  required onclick='atencionc2()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas4>=3) { 
                                                    $sql3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio3;
                                                    $fila3 =mysql_fetch_array(mysql_query($sql3));
                                                    $color_v3 = $fila3["color_v"].'- ('.$fila3["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc3' id='valor46' value='".$id4_vidrio3."' required><input type='text' name='xxx' id='valor45' value='".$color_v3."'  required onclick='atencionc3()'><br>";
                                                        
                                                    }
                                                      } 
                                                      if($laminas4>=4) {   
                                                    $sql4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio4;
                                                    $fila4 =mysql_fetch_array(mysql_query($sql4));
                                                    $color_v4 = $fila4["color_v"].'- ('.$fila4["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc4' id='valor48' value='".$id4_vidrio4."' required><input type='text' name='xxx' id='valor47' value='".$color_v4."'  required onclick='atencionc4()'><br>";
                                                        
                                                    }
                                                      }  
                                                      if($laminas4>=5) {  
                                                    $sql5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio5;
                                                    $fila5 =mysql_fetch_array(mysql_query($sql5));
                                                    $color_v5 = $fila5["color_v"].'- ('.$fila5["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vidc5' id='valor410' value='".$id4_vidrio5."' required><input type='text' name='xxx' id='valor49' value='".$color_v5."'  required onclick='atencionc5()'><br>";
                                                        
                                                    }
                                                     } 
                                                     if($laminas4>=6) {  
                                                    $sql6 = "SELECT * FROM tipo_vidrio where id_vidrio=".$id4_vidrio6;
                                                    $fila6 =mysql_fetch_array(mysql_query($sql6));
                                                    $color_v6 = $fila6["color_v"].'- ('.$fila6["espesor_v"].')mm';
                                                    if(isset($_GET['up'])){
                                                        
                                                        echo "<input type='hidden' name='vid6' id='valor412' value='".$id4_vidrio6."' required><input type='text' name='xxx' id='valor411' value='".$color_v6."'  required onclick='atencion6()'><br>";
                                                        
                                                    }
                                                           
                                                            ?>
                                                               
                                          
                                                    <?php }  ?>
                                                </div>
                                                </td>
                                            <td>Ubicacion</td>
                                            <td><textarea name="ubicacion" placeholder="digite la ubicacion de este producto"><?php if(isset($_GET['up'])){echo $ubica;} ?></textarea></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Pelicula Laminado</td>
                                            <td>
                                                <select id="pel" name="pel">
                                                    <?php if(isset($_GET['up'])){
                                                        $query2= "SELECT * FROM `referencias` where id_referencia in ($pel) ";                     
                                                            $resul2=  mysql_query($query2);
                                                            $f = mysql_fetch_array($resul2);
                                                            $valor1=$f['id_referencia'];
                                                            $valor2=$f['codigo'];
                                                            $valor3=$f['descripcion'];
                                                            $costo=$f['costo_mt'];
                                                         echo"<option value='".$valor1."'>".$valor2." - $".number_format($costo)." - ".$valor3."</option><option value=''>.:Seleccione</option>";
                                                            
                                                        
                                                    }else{
                                                        echo "<option value=''>.:Seleccione</option>"; 
                                                    
                                                    } ?>
                                                     <?php         
                                                           $query= "SELECT * FROM `referencias` where id_referencia in ('1107','1764','1765','1766') ";                     
                                                            $resul=  mysql_query($query);
                                                            while($fila=  mysql_fetch_array($resul)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['codigo'];
                                                            $valor3=$fila['descripcion'];
                                                            $costo=$fila['costo_mt'];
                                                            echo"<option value='".$valor1."'>".$valor2." - $".number_format($costo)." - ".$valor3."</option>";
                                                            }
                                                           
                                                            ?>
                                                </select>
                                            </td>
                                            <td>Cant. Lam </td>
                                            <td><input  type="number"  name="cantlam" style="width: 80px;" value="<?php if(isset($_GET['up'])){echo $cantlam;} ?>" placeholder=""></td>
                                        </tr>
                                        <tr>
                                            <td>Color del Aluminio</td>
                                            <td> <select name="alum"  required>
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$color_ta."'>".$color_ta."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Duracion del proyecto</td>
                                            <td><input  type="number"  name="duracion" style="width: 80px;" value="<?php if(isset($_GET['up'])){echo $duracion;} ?>" placeholder=""> dias</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tiene cierre?</td>
                                            <td><select name="cierre"  required>
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$cierre_cot."'>".$cierre_cot."</option>";}else{echo "<option value=''>.:Seleccione el tipo de Vidrio:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['color_a'];
                                                           
                                                        
                                                         
                                                            echo"<option value='".$valor1."'>".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select></td>
                                            <td>Observaciones</td>
                                            <td><textarea name="descripcion" placeholder="Comente las especificaciones de este producto"><?php if(isset($_GET['up'])){echo $obs;} ?></textarea></td>
                                            <td rowspan="4" id="areas"><?php
if (isset($_GET['up'])) {
   if($linea_cot!='Vidrio'){
  $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$id_referencia.'"';                     
$result=  mysql_query($consulta);
$cont = 0;
echo '<ul><li>Seleccion el Area de trazabilidad<br>';
while($fila=  mysql_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$cont= $cont + 1;
if($valor1==4){
       $input = '<input type="number" name="per" id="per" value="'.$per.'" style="width:40px">';
   }else{
       $input = '';
   }
   if($valor1==5){
       $input2 = '<input type="number" name="boq" id="boq" value="'.$boq.'" style="width:40px">';
   }else{
       $input2 = '';
   }
    echo "<input type='checkbox' checked name='cod$cont' value='".$valor1."'> - ".$valor1."- ".$valor2." ".$input." ".$input2."<br>";
    }
    echo '</ul></li>';
}}
?></td>
                                        </tr>
                                       
                                            <div id="hoja"> <input type="hidden" name="hoja" value="<?php  echo $hoja; ?>"></div>
                                            
                                        <tr>
                                            <td>Medidas</td>
                                            <td><input type="text" autocomplete="off" name="ancho" id="ancho2" value="<?php if(isset($_GET['up'])){echo $ancho_cot;} ?>" style="width: 70px;" placeholder="Ancho en mm" required <?php if(isset($_GET['check'])){ ?> readonly="readonly" <?php } ?>>
                                                X <input type="text" name="alto" id="alto2" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $alto_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required<?php if(isset($_GET['check'])){ ?> readonly="readonly" <?php } ?>></td>
                                            <td>Alto Cuerpo Fijo</td>
                                            <td><input type="text" autocomplete="off" name="cuerpo" id="cuerpo2" value="<?php if(isset($_GET['up'])){echo $cuerpo;} ?>" style="width: 70px;"  placeholder="Alto en mm" required</td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td><input type="text" name="cant" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $cantidad_cot;} ?>"  style="width: 60px;"  placeholder="Cantidad" required></td>
                                           <td>Ancho Cuerpo Fijo</td>
                                            <td><input type="text" autocomplete="off" name="ladomm" id="ladomm" value="<?php if(isset($_GET['up'])){echo $ladomm;} ?>" style="width: 70px;"  placeholder="Lado" required></td>
                                           
                                        </tr>
                                         <tr>
                                            <td>Medidas Totales con Compuestos</td>
                                             <td><input type="text" name="ancho_temp" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $ancho_temp;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required>
                                              X <input type="text" name="alto_temp" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $alto_temp;} ?>" style="width: 70px;"  placeholder="Alto en mm" required></td>
                                              
                                             <td>Lleva Pelicula ?</td>
                                            <td>
                                                <select name="pelicula">
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$pelicula."'>".$pelicula."</option>";} ?>
                                                    <option value="No Aplica">No Aplica</option>
                                                    <option value="Una Cara">Una Cara</option>
                                                    <option value="Doble Cara">Doble Cara</option>
                                                </select>
                                            </td>
                                            <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Lleva Huacal?</td>
                                            <td>
                                                <select name="huacal">
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$huacal."'>".$huacal."</option>";} ?>
                                                    
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Si es division de baño y tiene el ancho de abajo diferente de arriba digitelo:</td>
                                            <td> <input type="text" autocomplete="off" name="ancho_abajo" value="<?php if(isset($_GET['up'])){echo $aa;} ?>"  style="width: 70px;"  placeholder="Alto en mm" required></td>
                                             <td>Observaciones adicionales:</td>
                                            <td><textarea name="obs2" placeholder="Observacion adicional"><?php if(isset($_GET['up'])){echo $obs2;} ?></textarea></td>
                                            <td rowspan="3"><div id="areas_vid">trazabilidad
                                                <?php
if (isset($_GET['up'])) {
   
  $consulta= 'SELECT * FROM pt_procesos a, subproceso b where  a.id_subpro=b.id_subpro and a.id_proceso="'.$traz_vid.'"';                     
$result=  mysql_query($consulta);
$cont = 0;
echo '<ul><li>Seleccione el Area de trazabilidad de vidrio<br>';
while($fila=  mysql_fetch_array($result)){
$valor1=$fila['id_subpro'];
$valor2=$fila['nombre_subpro'];
$cont= $cont + 1;
if($valor1==4){
       $input = '<input type="number" name="per" id="'.$valor2.'" value="'.$per.'" style="width:40px">';
   }else{
       $input = '';
   }
   if($valor1==5){
       $input2 = '<input type="number" name="boq" id="'.$valor2.'" value="'.$boq.'" style="width:40px">';
   }else{
       $input2 = '';
   }
    echo "<input type='checkbox' checked name='cod$cont' value='".$valor1."'> - ".$valor1."- ".$valor2." ".$input." ".$input2."<br>";
    }
    echo '</ul></li>';
}
?></div>
                                                <div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                <label class="control-label">Imagen Opcional</label>
                                               
                                                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                                    <img src="<?php if(isset($_GET['up'])){if($adicional !=''){echo '../adicionales/'.$adicional;}else{echo '../imagenes/nofoto.png';}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                                <span class="btn btn-file"><span class="fileupload-new">Seleccione La Imagen</span>
                                                <span class="fileupload-exists">Cambiar</span><?php if(isset($_GET['up'])){echo '<input name="imagen" type="file" value="'.$adicional.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                               <a title="Eliminar imagen" href="../vistas/<?php echo '?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&up='.$_GET['up'].'&quitar'; ?>"><img src="../imagenes/cancelar.png"> </a>
                                               <i>Nota: Antes de hacer cualquier modificacion primero quite la imagen, si la quiere quitar.</i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Digite la cantidad de verticales y horizontales</td>
                                            <td>Verticales<input type="text" name="vert" value="<?php echo $vert; ?>"  style="width: 70px;">
                                                
                                            </td>
                                            <td>Horizontales</td>
                                            <td><input type="text" name="hori" value="<?php echo $hori; ?>"  style="width: 70px;"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td> <input type="checkbox" name="d1"  <?php if($d1!='0'){echo 'checked';}  ?> value="1">Automatico</td>
                                            <td></td><td></td>
                                        </tr>
                                    </table>
                                     <br>
                                     <hr>
                                     <div class="container">
                                         <h4>Compuestos Adicionales    <button type="button" onclick="compuestos(<?php echo $_GET["cot"] ?>,<?php echo $_GET["cli"] ?>,<?php echo $_GET["up"] ?>, '<?php echo $por ?>','<?php echo $tipo ?>')">Nuevo Compuesto</button></h4>
                                         <?php 
                                         
                                            $com=mysql_query("SELECT producto,id_p, codigo,ancho_c_sub,alto_c_sub FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET["up"]."");
                $compuesto ='<ul>';
                $up = '';
                while($cpt = mysql_fetch_array($com)){
                    
                    $compuesto = $compuesto.'<li>'.$cpt['producto'].' Med: '.$cpt['ancho_c_sub'].'x'.$cpt['alto_c_sub'].'</li>';
                }
                
                                 echo '<hr><br>'.$compuesto        
                                         ?>
                                     </div>
                                     
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div> 
                                        <?php     
                                           }else{
                                               ?>
                                
                                <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                <input type="text" name="buscar" class="span8" placeholder="Digite el tipo, referencia ó descripcion del producto"><button type="submit"><img src="../imagenes/buscar.png" height="40px"> Buscar</button>
                                </form>
                                <?php  if($estado=='En proceso'){  ?>
                                <select id="color_alum">
                                    <option value="">Seleccione el color de aluminio a cambiar</option>
                                    <?php
                                        $consulta62= "SELECT color_a FROM `tipo_aluminio` order by color_a asc";                     
                                        $result62=  mysql_query($consulta62);
                                        while($fila=  mysql_fetch_array($result62)){
                                        $valor3=$fila['color_a'];
                                        echo"<option value='".$valor3."'>".$valor3."</option>";
                                        }
                                    ?>
                                </select><?php  }  ?>
                                <button onclick="reporte_items()" id="btn_report">Generar Reporte de Costo Materia Prima</button>
                                <span id="rep">
                                </span>
                                
        <form name="buscarA" action="../vistas/?id=new_fac&cot=<?php echo $_GET['cot'] ?>&cli=<?php echo $_GET['cli'] ?>&por" method="post" enctype="multipart/form-data">
                                <?php
    
if(isset($_GET['cot'])){ 
  if(isset($_POST['buscar'])){   
      $request=mysql_query("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND  c.id_cot = " . $_GET["cot"] . " AND CONCAT(producto, referencia_p,tip) LIKE '%" . $_POST['buscar'] . "%' ORDER BY c.fila ASC ");
  }else{
      $request=mysql_query("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND  c.id_cot = " . $_GET["cot"] . " ORDER BY c.fila ASC ");
  }
  $table = "";
if($request){

       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Copy'.'</th>';
              $table = $table.'<th width="2%">'.'Tipo'.'</th>'; 
              $table = $table.'<th width="2%">'.'#'.'</th>'; 
              $table = $table.'<th width="7%">'.'Ref'.'</th>'; 
              $table = $table.'<th width="25%">'.'Producto'.'</th>';
              $table = $table.'<th width="9%">'.'Color Vid.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Ancho <br>(mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alto <br>(mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. <br>Total.'.'</th>';
              if($estado=='Aprobado'){$table = $table.'<th class="hidden-phone">'.'Cant. Pendiente'.'</th>';}
              $table = $table.'<th width="15%" style="text-align:center">Valores</th>';
//              $table = $table.'<th class="hidden-phone">'.'Precio Und.'.'</th>';     
//              $table = $table.'<th class="hidden-phone">'.'Descuento.'.'</th>';
//              $table = $table.'<th class="hidden-phone">'.'Precio + Desc .'.'</th>';
//              $table = $table.'<th class="hidden-phone">'.'Precio <br> Total.'.'</th>';
//              $table = $table.'<th class="hidden-phone">'.'Total+Iva.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'PV'.'</th>';
              //$table = $table.'<th class="hidden-phone">'.'PM'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'%.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Mas'.'</th>';
              $table = $table.'<th>'.'Upd.'.'</th>';
              $table = $table.'<th><button type="button" onclick="quitar_items();"><img src="../imagenes/eliminar.png"></button></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tacot =0;
        $cont =0;
	while($row=mysql_fetch_array($request))
	{    
                $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv1 =mysql_fetch_array(mysql_query($cons_vi));
                $cons_vir = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
                $fv2 =mysql_fetch_array(mysql_query($cons_vir));
                $cons_vir2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio3']." ";
                $fv3 =mysql_fetch_array(mysql_query($cons_vir2));
                $cons_vir3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio4']." ";
                $fv4 =mysql_fetch_array(mysql_query($cons_vir3));
                $cons_vir5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio5']." ";
                $fv5 =mysql_fetch_array(mysql_query($cons_vir5));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv21 =mysql_fetch_array(mysql_query($cons_vi2));
                $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio2']." ";
                $fv22 =mysql_fetch_array(mysql_query($cons_vi3));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv23 =mysql_fetch_array(mysql_query($cons_vi4));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv24 =mysql_fetch_array(mysql_query($cons_vi4));
                $cons_vi5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio4']." ";
                $fv25 =mysql_fetch_array(mysql_query($cons_vi5));
                
                $s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = '".$row["linea_cot"]."'";
                $fi3 = mysql_fetch_array(mysql_query($s3));
                $mult = $fi3["p"] / 100;
                //SE ADICIONA PORCENTAJES FIJOS DE DESCUENTO
//                                        $por_general = mysql_query("select (" . $row["porcentaje"] . ") FROM porcentaje_general ");
//                                        $pg = mysql_fetch_row($por_general);
//                                        $gen_desc = $pg[0] / 100;
                                        
                                        
            $comp=mysql_query("SELECT count(*) FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
            $cm1 = mysql_fetch_array($comp);
            $d = $cm1['count(*)'];
            
            $ac =mysql_query("SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_cotizacion"]."  ");
            $cm = mysql_fetch_array($ac);
            $mt = $cm['count(*)'];
            
              $ak =mysql_query("SELECT count(*) FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$row["id_cotizacion"]." and b.comp='1'  ");
            $ck = mysql_fetch_array($ak);
            $mtk = $ck['count(*)'];
            
            $as =mysql_query("SELECT count(*) FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and b.id_cot_mas=".$row["id_cotizacion"]." ");
            $cs = mysql_fetch_array($as);
            $mts = $cs['count(*)'];
            $compu =mysql_query("SELECT * FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
    $costo_sp = 0; $costo_fom_sp=0; 
    $costo_mp = 0;
          $costo_fom_mp = 0;
    while ($fila=mysql_fetch_array($compu)){
        
                 $sx = "SELECT (".$fila["porcentaje_sub"].") as p FROM porcentajes where area_por='".$fila["linea_cot_sub"]."'";
                $fix =mysql_fetch_array(mysql_query($sx));
                $multx= $fix["p"]/100;
                
          $costo_sp += $fila['valor_sp'];
          $costo_fom_sp += $fila['valor_fom_sp'];
          $costo_mp += $fila['valor_c_sub']/$multx;
          $costo_fom_mp += $fila['valor_fom_sub'];
          
    }
           $t = $d + $mt + $mtk + $mts;

            $pad = (($costo_mp* $row["cantidad_c"]));
           $tk = ($row["precio_material"])* $row["cantidad_c"];
           if($row['id_referencia']==1633){
            $a = $tk;
        }else{
           $a = ($row["valor_c"] / $mult) + $pad  + $tk;
//           $descuento = $a * $gen_desc;
//           $a = $a - $descuento;
        }
           
           

            
//            echo ($tk ) .'<br>';
            if($row["linea_cot"]=='Vidrio' || $row["linea_cot"]=='VIDRIO'){$d1 = 'Per:'.$row["per"].'<br>Boq:'.$row["boq"];}else{$d1 = 'Color Alum:'.$row["color_ta"];}
            $cont = $cont + 1;
          
            if($row["cuerpo"]!=0){$m = 'Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
            // modificar de este lado
                                
            $pu = ($a/$row["cantidad_c"]);
            $descpor = $pu *  $row["desc"]/100;
            $pud = $pu + $descpor;
             $descuento_g = ($row["descuento_g"] / 100) * $pud;
             $pudt = $pud - $descuento_g;
            $ptt = ($pudt) * $row["cantidad_c"];
            $tacot = $tacot + $ptt;
           
                     if($estado=='En proceso'){ 
                         $img_delx ='<input type="checkbox" name="item" id="'.$row["id_cotizacion"].'" value="">';
            if($editar_cot=='Habilitado'){$up = '&up='.$row["id_cotizacion"].'';}else{$up = '';}
            if($eliminar_cot=='Habilitado'){$del = '&del='.$row["id_cotizacion"].'&v='.$cont;}else{$del = '';}
            $img_up = '<button type="button"><img src="../imagenes/modificar.png"></button>'; 
            
            //$img_del ='<button type="button"  onclick="eliminar_prod('.$row['id_cotizacion'].','.$_GET['cot'].','.$_GET['cli'].')"><img src="../imagenes/eliminar.png" style="cursor:pointer"></button>';
            $copiar = '<button type="button" id="'.$row["id_cotizacion"].'" onclick="copiar('.$row["id_cotizacion"].','.$_GET["cot"].','.$_GET["cli"].');"><img src="../imagenes/copiar.png"></button>';
                     }else{
                $up = '';$del = '';$img_up = ''; $img_delx =''; $copiar ='';
            }
         if($crear_ped=='Habilitado'){$add = '';}else{$add = '';}
     $con2= "SELECT * FROM `producto` where id_p=".$row['traz_vid']." ";
$res2=  mysql_query($con2);
while($f8=  mysql_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];
}
if($row['traz_vid2']==0){
    $nombr2='';
}else{
$con22= "SELECT * FROM `producto` where id_p=".$row['traz_vid2']." ";
$res22=  mysql_query($con22);
while($f8r=  mysql_fetch_array($res22)){
$idco2=$f8r['id_p'];
$nombr2=$f8r['producto'];
}}
if($row['traz_vid3']==0){
    $nombr3='';
}else{
$con23= "SELECT * FROM `producto` where id_p=".$row['traz_vid3']." ";
$res23=  mysql_query($con23);
while($f8=  mysql_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];
}}
if($row['traz_vid4']==0){
    $nombr3='';
}else{
$con24= "SELECT * FROM `producto` where id_p=".$row['traz_vid4']." ";
$res24=  mysql_query($con24);
while($f8=  mysql_fetch_array($res24)){
$idco4=$f8['id_p'];
$nombr4=$f8['producto'];
}}
$v1 = $fv1['color_v'];
if($fv2['color_v']==''){$v2 = '';}else{$v2 = '+'.$fv2['color_v'];}
if($fv3['color_v']==''){$v3 = '';}else{$v3 = '+'.$fv3['color_v'];}
if($fv4['color_v']==''){$v4 = '';}else{$v4 = '+'.$fv4['color_v'];}
if($fv5['color_v']==''){$v5 = '';}else{$v5 = '+'.$fv5['color_v'];}
$v21 = $fv21['color_v'];
if($fv22['color_v']==''){$v22 = '';}else{$v22 = '+'.$fv22['color_v'];}
if($fv23['color_v']==''){$v23 = '';}else{$v23 = '+'.$fv23['color_v'];}
if($fv24['color_v']==''){$v24 = '';}else{$v24 = '+'.$fv24['color_v'];}
if($fv25['color_v']==''){$v25 = '';}else{$v25 = '+'.$fv25['color_v'];}
             $tip =$row['tip']; $tip2 =$row['fila'];
            if($row['id_vidrio']!=0 && $row['id_vidrio2']!=0){
                $vi = $v1.$v2.$v3.$v4.$v5.' - '.$nombr;
            }else{
                if($fv1['espesor_v']!='' && $row['producto']!=$nombr){
                 $vi = $fv1['color_v'].' '.$nombr;
                }else{
                 $vi = $fv1['color_v'];
                }
            }
                      
               if($row['cont_item']!='0'){
                $stilon = 'style="background-color:green;" title="¡Este item tiene notas!" ';
            
             }else{
                $stilon = '';
             
              }
                
            if($row['id2_vidrio']!=0 && $row['id2_vidrio2']!=0){
                $vi2 = $v21.$v22.$v23.$v24.$v25.' - '.$nombr2;
            }else{
                
                 $vi2 = $fv21['color_v'].' - '.$nombr2;
            }
               $sql21 = "SELECT * FROM referencia_mo where id_ref_mo=99 ";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
      if($row['pelicula']=='No Aplica'){
                $peli = '';
            }else{
                if($row['pelicula']=='Una Cara'){
                    $peli = ', + '.$fila21['descripcion_mo'];
                 }else{
                    $peli = ', + '.$fila21['descripcion_mo'].' ambos lados';
                      }
                   }
                 $iva3 = $ptt * ($sel_iva/100);
                 $tota = $ptt + $iva3;
                 $pdlr = "select * from dolares where id_dolar=".$row['id_dolar']."  ";
                 $fia =mysql_fetch_array(mysql_query($pdlr));
                 $precio_actual= $fia["precio_dolar"];
                
                if($row["valor_temp"]==0){
                    $w = '';
                }else{
                     $w = '<img src="../imagenes/warning.png" title="Advertencia tiene Precios ingresado manualmente">';
                }
                 if($row["especial"]==1){
                 if($ver_pro=='Habilitado'){
                    $ver = '<a href="../vistas/?id=ver_fac&ref='.$row["id_referencia"].'&cot='.$row["id_cotizacion"].'&cli='.$_GET["cli"].'&ped='.$_GET["cot"].'">';
                    }
                    else{$ver =''; }
                    }else{
                    if($ver_pro=='Habilitado'){
                     $ver = '<a href="../vistas/?id=ver_pro&l='.$row["imagen"].''
                        . '&mod='.$row["modulo"].'&per='.$row["per"].'&boq='.$row["boq"].'&ref='.$row["id_referencia"].''
                        . '&cot='.$_GET["cot"].'&idcot='.$row["id_cotizacion"].'&tv='.$row["traz_vid"].'&tv2='.$row["traz_vid2"].'&tv3='.$row["traz_vid3"].'&tv4='.$row["traz_vid4"].''
                        . '&aa='.$row["ancho_abajo"].'&ancho='.$row["ancho_c"].'&alto='.$row["alto_c"].''
                        . '&cant='.$row["cantidad_c"].'&vidrio='.$fv1["color_v"].'('.$fv1["espesor_v"].'mm)'
                        . '&id_v='.$row["id_vidrio"].'&id_v2='.$row["id_vidrio2"].'&id_v3='.$row["id_vidrio3"].'&id_v4='.$row["id_vidrio4"].'&id_v5='.$row["id_vidrio5"].'&id_v6='.$row["id_vidrio6"].''
                        . '&id2_v='.$row["id2_vidrio"].'&id2_v2='.$row["id2_vidrio2"].'&id2_v3='.$row["id2_vidrio3"].'&id2_v4='.$row["id2_vidrio4"].'&id2_v5='.$row["id2_vidrio5"].''
                        . '&id3_v='.$row["id3_vidrio"].'&id3_v2='.$row["id3_vidrio2"].'&id3_v3='.$row["id3_vidrio3"].'&id3_v4='.$row["id3_vidrio4"].'&id3_v5='.$row["id3_vidrio5"].''
                        . '&id4_v='.$row["id4_vidrio"].'&id4_v2='.$row["id4_vidrio2"].'&id4_v3='.$row["id4_vidrio3"].'&id4_v4='.$row["id4_vidrio4"].'&id4_v5='.$row["id4_vidrio5"].''
                        . '&cuerpo='.$row["cuerpo"].'&hojas='.$row["hojas"].'&ins='.$row["install"].''
                        . '&por='.$row["porcentaje_mp"].'&por_venta='.$row["porcentaje"].'&v='.$row["verticales"].''
                        . '&h='.$row["horizontales"].'&d1='.$row["d1"].'&dias='.$row["duracion"].'&lado='.$row["lado"].'&unidad='.$pu.'&descuento='.$descpor.'&ciudad='.$ciudadx.'">';
                        $wi = "'width=400,height=400'";
                        $om = 'onClick="window.open(this.href, this.target, '.$wi.'); return false;"';   
                        $ver_reporte = '../vistas/form/cotizacion_save_reporte.php?&l='.$row["imagen"].''
                        . '&mod='.$row["modulo"].'&per='.$row["per"].'&boq='.$row["boq"].'&ref='.$row["id_referencia"].''
                        . '&cot='.$_GET["cot"].'&idcot='.$row["id_cotizacion"].'&tv='.$row["traz_vid"].'&tv2='.$row["traz_vid2"].'&tv3='.$row["traz_vid3"].'&tv4='.$row["traz_vid4"].''
                        . '&aa='.$row["ancho_abajo"].'&ancho='.$row["ancho_c"].'&alto='.$row["alto_c"].''
                        . '&cant='.$row["cantidad_c"].'&vidrio='.$fv1["color_v"].'('.$fv1["espesor_v"].'mm)'
                        . '&id_v='.$row["id_vidrio"].'&id_v2='.$row["id_vidrio2"].'&id_v3='.$row["id_vidrio3"].'&id_v4='.$row["id_vidrio4"].'&id_v5='.$row["id_vidrio5"].'&id_v6='.$row["id_vidrio6"].''
                        . '&id2_v='.$row["id2_vidrio"].'&id2_v2='.$row["id2_vidrio2"].'&id2_v3='.$row["id2_vidrio3"].'&id2_v4='.$row["id2_vidrio4"].'&id2_v5='.$row["id2_vidrio5"].''
                        . '&id3_v='.$row["id3_vidrio"].'&id3_v2='.$row["id3_vidrio2"].'&id3_v3='.$row["id3_vidrio3"].'&id3_v4='.$row["id3_vidrio4"].'&id3_v5='.$row["id3_vidrio5"].''
                        . '&id4_v='.$row["id4_vidrio"].'&id4_v2='.$row["id4_vidrio2"].'&id4_v3='.$row["id4_vidrio3"].'&id4_v4='.$row["id4_vidrio4"].'&id4_v5='.$row["id4_vidrio5"].''
                        . '&cuerpo='.$row["cuerpo"].'&hojas='.$row["hojas"].'&ins='.$row["install"].''
                        . '&por='.$row["porcentaje_mp"].'&por_venta='.$row["porcentaje"].'&v='.$row["verticales"].''
                        . '&h='.$row["horizontales"].'&d1='.$row["d1"].'&dias='.$row["duracion"].'&lado='.$row["lado"].'&unidad='.$pu.'&descuento='.$descpor.'&ciudad='.$ciudadx.'" ';
                    
               $rep = $ver_reporte;
                    }
                    else{$ver =''; }
                    }
                $ref='';
                $noti='';
                $noti2='';
                if($row['id_referencia']==1633){$ref='<p style="color: red;"><b>HUACAL</b></p>';}else{$ref='<input type="hidden" id="it'.$row["id_cotizacion"].'" value="'.$tip.'"> '.$ver.''.$row['producto'].' '.$peli.', '.$row['observaciones'].', '.$m.','.$d1.', Cierre: '.$row["cierre"].', Inst: '.$row["install"].', Lam: '.$row["laminas"].' '.$noti.''.$noti2.' <br>'.$row["descripcion_rollo"].'<br>Se Cotizó con el Dollar a: $ '.$precio_actual.' </a>'
                        . '<button type="button" '.$stilon.' onclick="com('.$row["id_cotizacion"].')"> <b>?</b> </button>';}
                if($row['msg']!=''){$noti='<br><b> <font color="red">'.$row['msg'].' </b>';}else{$noti='';}
                if($row['msg2']!=''){$noti2='<br><b> <font color="red">'.$row['msg2'].' </b>';}else{$noti2='';}
                if($estado=='Aprobado'){$pen = '<td class="hidden-phone"><div align="center"><font color="red">'.$row["cant_restante"].'</font></td>';}else{$pen = '';}
                $ver_reportex = '<a href="'.$ver_reporte.'" '.$om.' target="_blank">';
                $table = $table.'<tr>'
. '<td> '.$copiar. ' '.$w.'</td>'
. '<td width="2%">'.$tip.'</td><td width="2%">'.$tip2.'</td>
<td width="7%">'.$row['codigo'].'</font></td>
<td width="25%">'.$ref.'<input type="checkbox" name="item2" id="'.$row["id_cotizacion"].'" value="" checked disabled></td>                     
<td width="9%">'.$vi.'<br>'.$vi2.'</td>
<td class="hidden-phone"><div align="center">'.$row["ancho_c"].'</div></td>
<td class="hidden-phone"><div align="center">'.$row["alto_c"].'</div></td>
<td class="hidden-phone"><div align="center">'.$row["cantidad_c"].'</div></td>'.$pen.'
<td class="hidden-phone"><div align="center"> 
<table style="font-size:13px">
<tr><td><b>Precio Und. $</b></td><td style="text-align:right">'.number_format($pu).'</td>
<tr><td><b>Descuento $</b></td><td style="text-align:right">'.number_format($descpor).'</td>
<tr><td><b>Precio + Desc $</b></td><td style="text-align:right">'.number_format($pudt).'</td>
<tr><td><b>Precio Total $</a></b></td><td style="text-align:right">'.number_format($ptt).'</td>
<tr><td><b>'.$ver_reportex.' T</a>otal+Iva $</b></td>'
                    . '<td style="text-align:right"><font color="red">'.number_format($tota).'</font>
                        <input type="hidden" id="ver'.$row["id_cotizacion"].'" value="'.$rep.'"></td>
</table>
</td>
<td class="hidden-phone">'.$row["porcentaje"].'</font></td>
<td class="hidden-phone">'.number_format($row["desc"],2,',','').'</a></td>'
. '<td><a title="Aqui puede adicionar alguna estructura o un material" href="../vistas/?id=add_acc&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'&mas='.$row["id_cotizacion"].'&por='.$row["porcentaje_mp"].'&pagina='.$_GET['id'].'&tipo_cli='.$tipo.'""><button type="button"><img src="../imagenes/puzzle_3.png">(<font color="red">'.$t.'</font>)</button></a></td>'
. '<td><a href="../vistas/?id=new_fac&cot='.$_GET["cot"].'&cli='.$_GET["cli"].''.$up.'""  >'.$img_up.'</a></td>
<td> '.$img_delx.'</td></tr>';   
       
	} 
	$table = $table.'</table>';
       }
	echo $table.'<br><hr>';
        
        ///  --------------------------------------------servicios-----------------------------------------
echo 'Item Totales: <input type="number" id="cantidad_total" value="'.$cont.'" disabled style="width:50px">';
        echo '<hr>';
        if($cont!=0){
     echo '<div align="right"><FONT color="red"><h5>TOTAL COT.: $'.number_format($tacot).'</h5></FONT></div>'
             . '<input type="hidden" id="to" value="'.$tacot.'">';} 
    
     
} 
    ?>
            <a title="Imprimir Servicios, Kits, Materiales" href="../vistas/service.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1000,height=600'); return false;"><button type="button"><img src="../imagenes/print.png"> Imprimir Servicios</button></a>
            
            <?php } 
                                           
            $request2=mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and id_cot_mas=0 ");
    
       if($request2){
//    echo'<hr>';
       $table2 = '<table class="table table-bordered table-striped table-hover" id="">';
             $table2 = $table2.'<thead >';
              $table2 = $table2.'<tr BGCOLOR="#C3D9FF">';
              $table2 = $table2.'<th width="5%">'.'Items'.'</th>';
              $table2 = $table2.'<th width="5%">'.'Codigo'.'</th>';
              $table2 = $table2.'<th width="40%">'.'Servicio'.'</th>';
			  $table2 = $table2.'<th width="40%">'.'Descripción del Servicio'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Pago Ins'.'</th>';
             
              $table2 = $table2.'<th width="10%">'.'Descuento'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Cantidad'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Total Pago Servicio'.'</th>';

           
              $table2 = $table2.'<th width="10%">'.'Costo Total'.'</th>';
              $table2 = $table2.'<th width="10%">Editar</th>';
              $table2 = $table2.'<th width="10%">Eliminar</th>';
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2s=0;
        $to_serv =0;
	while($row2=mysql_fetch_array($request2))
	{    
            
               $request_ac1=mysql_query("SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$row2["id_ref_mo"]);
               $tota=0;
	       while($row1=mysql_fetch_array($request_ac1))
	{       
            $por = 100;
            $tota = $tota + ($row2["valor_mo"]*$row1["porcentaje_ad"]/$por);  
            
	} 
            $pr = (100 - $row2["utilidad"]) / 100;
            $fr = ($row2["valor_mo"] + $tota) / $pr;
        
             $total2s= $total2s +  1;
             $des = ($row2['descuento_serv']/100) * $fr;
             $dd = ($fr + $des) * $row2["cantidad_serv"];
            
             $to_serv = $to_serv + $dd;
              if($estado=='En proceso'){ 
     if($editar_cot=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';}
     if($eliminar_cot=='Habilitado'){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}
     }else{
               $ver='';$del='';
             }
               $table2 = $table2.'<tr><td width="5%">'.$total2s.'</a></td><td width="5%">'.$row2['id_ref_mo'].'</font></td>'
                    . '<td width="40%"><a href="../vistas/?id=ver_gastos&cod='.$row2['id_ref_mo'].' ">'.$row2['descripcion_mo'].'</font></td>'
                    . '<td width="40%">' . $row2["obs_servicio"] . '</td>'
                    . '<td width="10%">'.$row2["referencia"].'</a></td>
                       <td width="10%">$'.number_format($fr).'</td>'
                    . '<td width="10%">'.$row2["descuento_serv"].'%</td>'
                    . '<td width="10%">'.$row2["cantidad_serv"].'</td><td width="10%">'.number_format($dd).'</td>'
                         . '<td width="10%">'.number_format(($dd)).'</td>'
                    . '<td width="10%"><a href="../vistas/?id=new_fac&up_serv='.$row2["id_cot_serv"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$ver.'</a> </td>
                        <td width="10%"> <a href="../vistas/?id=new_fac&del_serv='.$row2["id_cot_serv"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$del.'</a></td></tr>';   
           
		
               
	} 
	$table2 = $table2.'</table>';
        
	echo $table2.'<br><hr>';
         echo '<div align="right"><FONT color="red"><h5>TOTAL SERVICIOS.: $'.number_format($to_serv).'</h5></FONT></div>';
      

} 
$request3=mysql_query("SELECT * FROM referencias a, cotizaciones_materiales b where a.id_referencia=b.id_material and b.id_cotizacion=".$_GET['cot']." ");
    
if($request3){
//    echo'<hr>';
              $table2 = '<table class="table table-bordered table-striped table-hover" id="">';
              $table2 = $table2.'<thead >';
              $table2 = $table2.'<tr BGCOLOR="#C3D9FF">';
              $table2 = $table2.'<th width="5%">'.'Items'.'</th>';    
              $table2 = $table2.'<th width="5%">'.'Codigo'.'</th>'; 
              $table2 = $table2.'<th width="40%">'.'Descripcion de los materiales'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Medida (Ancho)'.'</th>';
			  $table2 = $table2.'<th width="10%">'.'Medida (Alto)'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Costo'.'</th>';   
              $table2 = $table2.'<th width="10%">'.'Acabado'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Descuento'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Valor Und'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Valor Total'.'</th>'; 
              $table2 = $table2.'<th width="10%">Editar</th>';
              $table2 = $table2.'<th width="10%">Eliminar</th>';
              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $to_mat =0;
             
	while($row21=mysql_fetch_array($request3))
	{       
             $acc_por = "SELECT (".$row21['pe'].") as p FROM porcentajes where area_por='MP' and grupo='".$row21["grupo"]."'";
             $fipa =mysql_fetch_array(mysql_query($acc_por));
             $porcacc= $fipa["p"]/100; 
             
             $acc_porv = "SELECT (".$row21['pe'].") as p FROM porcentajes where area_por='Aluminio' and division='Venta'";
             $fipav =mysql_fetch_array(mysql_query($acc_porv));
             $porcven= $fipav["p"]/100; 
              
             $total2= $total2 +  1;
             if($row21['med']==1){
                 $mt = 1;
             }else{
      
                 $mt = ($row21['med']/1000);
             }
            $au = (100 - $row21['aumento']) / 100;
            $prt3 = $row21["costo_mt"] / $au;
            $desm = ($row21['descuento_mat']/100) * ($prt3*$mt);
            $alum_porr = "SELECT costo_a,variable FROM tipo_aluminio where color_a='".$row21['color_ma']."'";
            $fia4 =mysql_fetch_array(mysql_query($alum_porr));
            $vc= $fia4["costo_a"];
            $perimetro = $row21["area"]/1000;
               if($perimetro=='0'){
                $valor_acabado = $vc;
               }else{
               $valor_acabado = $vc * $perimetro * ($row21["med"]/1000) * $row21["cantidad_mat"] ;
               }
             $ddm = (((($prt3*$mt + $desm+$valor_acabado) * $row21["cantidad_mat"]) / $porcacc)/$porcven);
             $to_mat = $to_mat + $ddm;
             if($estado=='En proceso'){ 
             if($editar_cot=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';}
             if($eliminar_cot=='Habilitado'){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}
             }else{
                 $ver='';$del='';
             }
             if($row21['color_ma']==''){
                 $cm = '';
             }else{
                 $cm = 'Color: '.$row21['color_ma'];
             }
             
             $table2 = $table2.'<tr><td width="5%">'.$porcacc.' '.$porcven.' - '.$au.'</a></td>'
                    . '<td width="5%">'.$row21['codigo'].'</font></td>'
                    . '<td width="40%">'.$row21['descripcion'].' '.$cm.'</font></td>'
                    . '<td width="10%">'.$row21["referencia"].'<font></a></td>'
                    . '<td width="10%">'.$row21["med"].'</td>
                       <td width="10%">' . $row21["med2"] . '</td>
                       <td width="10%">$'.number_format($prt3*$mt).'</td>'
                     . '<td width="10%">' .$valor_acabado. '</td>'
                    . '<td width="10%">'.$row21["descuento_mat"].'%</td>'
                    . '<td width="10%">'.$row21["cantidad_mat"].'</td>'
                    . '<td width="10%">'.number_format($ddm/$row21["cantidad_mat"]).'</td>'
                    . '<td width="10%">'.number_format($ddm).'</td>'
                    . '<td width="10%"><a href="../vistas/?id=new_fac&up_mat='.$row21["id_cot_mat"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$ver.'</a> </td>
                       <td width="10%"> <a href="../vistas/?id=new_fac&del_mat='.$row21["id_cot_mat"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$del.'</a></td></tr>';   
           
	} 
	      $table2 = $table2.'</table>';
        
	 echo $table2;
         echo '<div align="right"><FONT color="red"><h5>TOTAL MATERIALES.: $'.number_format($to_mat).'</h5></FONT></div>';

} 

$request4=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']."  and b.comp='0'");
    
if($request4){
//    echo'<hr>';
              $table4 = '<table class="table table-bordered table-striped table-hover" id="">';
              $table4 = $table4.'<thead >';
              $table4 = $table4.'<tr BGCOLOR="#C3D9FF">';
              $table4 = $table4.'<th width="5%">'.'Items'.'</th>';    
              $table4 = $table4.'<th width="5%">'.'Codigo'.'</th>'; 
              $table4 = $table4.'<th width="40%">'.'Descripcion del kit'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Referencia'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Medida'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Costo'.'</th>';   
              $table4 = $table4.'<th width="10%">'.'Descuento'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table4 = $table4.'<th width="10%">'.'Costo Total'.'</th>'; 
              $table4 = $table4.'<th width="10%">Editar</th>';
              $table4 = $table4.'<th width="10%">Eliminar</th>';
              $table4 = $table4.'</tr>';
              $table4 = $table4.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t2e=0;
        $to_k =0;
     
                
                
	while($row21k=mysql_fetch_array($request4))
	{       
                 $acc_por = "SELECT (".$row21k['por_k'].") as p FROM porcentajes where area_por='".$row21k["linea"]."'";
                 $fipa =mysql_fetch_array(mysql_query($acc_por));
                 $porcacc= $fipa["p"]/100; 
                 $t2e= $t2e + 1;
                 include '../modelo/suma_kit.php';
                 $desm = ($row21k['desc_k']/100) * ($totk);
                 $ddm = ((($totk) + $desm)) / $porcacc;
                 $to_k = $to_k + $ddm;
                 if($estado=='En proceso'){ 
                 if($editar_cot=='Habilitado'){$ver='<img src="../imagenes/modificar.png">';}else{$ver='';}
                 if($eliminar_cot=='Habilitado'){$del='<img src="../imagenes/eliminar.png">';}else{$del='';}
                 }else{
                 $ver='';$del='';
                 }
                 if($row21k['color_k']==''){
                 $ck = '';
                 }else{
                  $ck = 'Color: '.$row21k['color_k'];
                 }
                 $table4 = $table4.'<tr><td width="5%">'.$t2e.'</a></td><td width="5%">'.$row21k['codigo'].'</font></td><td width="40%">'.$row21k['producto'].' '.$ck.'</font></td><td width="10%">'.$row21k["referencia_p"].'<font></a></td><td width="10%">N/A</td>
                 <td width="10%">$'.number_format(($totk)/ $porcacc).'</td><td width="10%">'.$row21k["desc_k"].'%</td><td width="10%">'.$row21k["cantidad_k"].'</td><td width="10%">'.number_format($ddm).'</td>'
                    . '<td width="10%"><a href="../vistas/?id=new_fac&up_k='.$row21k["id_ck"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$ver.'</a> </td>
                       <td width="10%"> <a href="../vistas/?id=new_fac&del_k='.$row21k["id_ck"].'&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'">'.$del.'</a></td></tr>';   
              
	} 
	$table4 = $table4.'</table>';
        
	echo $table4;
        echo '<div align="right"><FONT color="red"><h5>TOTAL KIT.: $'.number_format($to_k).'</h5></FONT></div>';
         //echo '<div align="right"><FONT color="red"><h4>GRAN TOTAL.: $'.number_format($to_serv+$tacot+$to_mat+$to_k).'</h4></FONT></div>';
  
} 
          $gt_total = $tacot + $to_serv + $to_mat + $to_k;
          mysql_query("update cotizacion set costo_total='$gt_total' where id_cot='".$_GET["cot"]."' ");
          if($estado!='Aprobado'){                             
          ?>
          <table>
             <tr>
              <td><label><i>Total de Cotizaciones: </i></label> <input type="hidden" name="cant" readonly  style="width:20px;height:20px;"  value="<?php echo $cont; ?>">
                  <input type="text" name="gt" id="gt" disabled  style="width:90px;height:20px;"  value="<?php echo $gt_total; ?>"></td>
              </tr>   
          </table>  
            <?php } ?>
            </form>                                   
              </div>
            </section>
        
                      <!-- START Widget Collapse -->
                           </div>
                                
                                  <div class="row-fluid">
                        <!-- START Form Wizard -->
                       

                       
                      <!-- START Widget Collapse -->
                           </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                     <?php 
                      $cons = mysql_fetch_array(mysql_query("select * from dolares order by id_dolar desc limit 1"));
                      $pd = $cons['precio_dolar'];
                     ?>
        
                                    </div>
                                    <div class="tab-pane" id="tab6">
                                        <div class="row-fluid">
                                       <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo '../modelo/cotizacion_1.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&tipo_cli='.$tipo.''; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                           <script type="text/javascript">
                               function calculapeso() {
                                   var linea=document.getElementById('linea').value;
                                   if(linea=='Vidrio'){
                                     var env=document.getElementById('valor1').value;
                                   var temp = env.substring(0, 2);
                                   var espesor=parseInt(temp);
                                   var ancho=parseInt(document.getElementById('ancho_max').value);
                                   var alto=parseInt(document.getElementById('alto_max').value);
                                   var static=2.5;
                                   var cantidad=parseInt(document.getElementById('cant').value);
                                   var resultado=((ancho/1000)*(alto/1000)*(espesor)*(static))*cantidad;
                                   var temporal=parseFloat(document.getElementById('pesov').value);
                                   var listo=parseFloat(temporal+resultado).toFixed(2);
                                   $('#pesov').val(listo);
                                   }
                               }
                           </script>
                            <section class="body">
                                <div class="body-inner">
                                    <hr>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Agregar</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
                                     Dollar :$ <input type="text" value="<?php echo $pd ?>" name="dolar" style="width:40px;" readonly="false">
                                     Notificaciones: <input type="text" value="" name="msg" id="msg" readonly="false"> <input type="text" value="" name="msg2" id="msg2" readonly="false">
                                     <input type="hidden" value="<?php echo $cons['id_dolar'] ?>" name="id_dolar" style="width:40px;">
                                     <label>Peso Cotización: <input type="text" id="pesov" name="pesov" value="0Kgs" readonly> 
                                     Ciudad: <input type="text" id="ciu" name="ciu" value="<?php echo $ciudadx ?>" readonly></label>
                                     
                                     <hr>
                                     <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <td style="width:30%" >linea de produccion</td>
                                            <td><select name="linea" id="linea" onchange="">
                                                    <?php if(isset($_GET['up'])){
                                                        echo "<option value='".$linea_cot."'>".$linea_cot."</option>";
                                                    
                                                    }else{
                                                        echo "<option value=''>.:Seleccione la linea:.</option>"; 
                                                        
                                                    } ?>             
                                                        <?php
                                                            require '../modelo/conexion.php';
                                                            $consulta= "SELECT * FROM `lineas`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['linea'];                                                          
                                                            $valor3=$fila['linea'];                                                        
                                                            echo"<option value='".$valor1."'>".$valor3."</option>"; 
                                                            }
                                                            ?>
                                                             </select>
                                            <input type="hidden" name="pvi" value="<?php echo $pvi; ?>" id="pvi">
                                               <input type="hidden" name="pal" value="<?php echo $pal; ?>" id="pal">
                                               <input type="hidden" name="pac" value="<?php echo $pac; ?>" id="pac"></td>
                                            <td style="width:30%">Instalacion:</td>
                                            <td> <select name="install"  style="width: 80px;">
                                                        
                                                            <option value="Si">Si</option>    
                                                        <option value="No">No</option>
                                                         
                                                        </select></td>
                                        
                                            <td rowspan="7" id="imagen"  style="width:40%">Imagen del producto</td>
                                        </tr>
                                        <tr>
                                            <td>Referencia del producto</td>
                                            <td><div id="busqueda"></div>
                                                <input name="a" type="hidden" readonly id="refer">
                                                <input name="b" readonly type="text" id="descr">
                                                <input type="hidden" readonly name="ref" id="codig">
                                               <input type="hidden" readonly  id="an_max">
                                               <input type="hidden" readonly  id="al_max">
                                            </td>
                                            <td>Precio de Venta:</td>
                                            <td> <select name="precio"  style="width: 80px;" <?php if ($express == 1){ echo "readonly='readonly'";} ?> >
                                                    <?php
                                                    	if ($express == 1) { ?>
                                                    		<option value="p1">p1</option>
                                                    	<?php
                                                    	} else { ?>
                                                    		<option value="p1">p1</option>
                                                      		<option value="p2">p2</option>
                                                         	<option value="p3">p3</option>
                                                    	<?php
                                                    	}
                                                    ?>
                                                    </select></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Sentido</td>
                                            <td><select name="lado" id="select2_1"  style="width: 100%" required>                                                       
                                                        <?php if(isset($_GET['up'])){echo '<option value="'.$lado.'">'.$lado.'</option>';} ?>                                                      
                                                            
                                                        <option value="">Seleccione</option> 
                                                        <option value="N/A">N/A</option>
                                                        <option value="Derecho">Derecho</option>
                                                        <option value="Izquierdo">Izquierdo</option>
                                                        
                                                </select></td>
                                            <td>Precio de la materia prima:</td>
                                            <td>  <?php if($_SESSION['admin']=='Si'){   ?>
                                                <select name="precio_mp"  style="width: 80px;" <?php if ($express == 1){ echo "readonly='readonly'";} ?> >
                                                	<?php
                                                    	if ($express == 1) { ?>
                                                    		<option value="p1">p1</option>
                                                    	<?php
                                                    	} else { ?>
                                                    		<option value="p1">p1</option>
                                                      		<option value="p2">p2</option>
                                                         	<option value="p3">p3</option>
                                                    	<?php
                                                    	}
                                                    ?>
                                                        </select>
                                                <?php }else{  ?>
                                                <input type="text" readonly name="precio_mp" value="p1"  style="width: 80px;">
                                                 <?php } ?></td>
                                        </tr>
                                       
                                        <tr>
                                            <td>Trazabilidad del vidrio</td>
                                            <td id="vidrios"></td>
                                            <td>Con descuento de:</td>
                                            <td id="descuento">  
                                            <input type="text" name="desc" value="0"  style="width: 60px;" <?php if ($express == 1){ echo "readonly='readonly'";} ?>>%</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Laminas del Vidrio</td>
                                            <td>
                                            <div  id="lam"></div>
                                            <div  id="lam2"></div>
                                            <div  id="lam3"></div>
                                            <div  id="lam4"></div>
                                            </td>
                                            <td>Tipo:</td>
                                            <td><input type="text" name="tip" value="<?php if(isset($_GET['up'])){echo $tip;} ?>" placeholder="ej: PV-1"></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Color y Espesor del Vidrio</td>
                                            <td>
                                            <div  id="vid"></div>
                                            <div  id="vid2"></div>
                                            <div  id="vid3"></div>
                                            <div  id="vid4"></div>
                                            </td>
                                             <td>Ubicacion</td>
                                            <td><textarea name="ubicacion" placeholder="digite la ubicacion de este producto"><?php if(isset($_GET['up'])){echo $ubica;} ?></textarea></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Pelicula Laminado</td>
                                            <td>
                                                <select id="pel" name="pel">
                                                    <option value="">Seleccione</option>
                                                     <?php         
                                                           $query= "SELECT * FROM `referencias` where id_referencia in ('1107','1764','1765','1766') ";                     
                                                            $resul=  mysql_query($query);
                                                            while($fila=  mysql_fetch_array($resul)){
                                                            $valor1=$fila['id_referencia'];
                                                            $valor2=$fila['codigo'];
                                                            $valor3=$fila['descripcion'];
                                                            $costo=$fila['costo_mt'];
                       
                                                            echo"<option value='".$valor1."'>".$valor2." - $".number_format($costo)." - ".$valor3."</option>";
                                                            }
                                                           
                                                            ?>
                                                </select>
                                            </td>
                                            <td>Cant. Lam </td>
                                            <td><input  type="number"  name="cantlam" style="width: 40px;" value="0" placeholder=""></td>
                                        </tr>
                                        <tr>
                                            <td>Color del Aluminio</td>
                                            <td  id="alum"> <select name="alum"  required>
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$color_ta."'>".$color_ta."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                      
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                            <td>Duracion del proyecto</td>
                                            <td><input  type="number"  name="duracion" style="width: 80px;" value="<?php if(isset($_GET['up'])){echo $duracion;} ?>" placeholder=""> dias</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tiene cierre?</td>
                                            <td id="cierre"><select name="cierre"  required >
                                                    <?php if(isset($_GET['up'])){echo "<option value='".$cierre_cot."'>".$cierre_cot."</option>";}else{echo "<option value=''>.:Seleccione el tipo de Vidrio:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['color_a'];
                                                            echo"<option value='".$valor1."'>".$valor1."</option>";
                                                            }
                                                            ?>
                                            </select></td>
                                            <td>Observaciones</td>
                                            <td><textarea name="descripcion" placeholder="Comente las especificaciones de este producto"><?php if(isset($_GET['up'])){echo $obs;} ?></textarea></td>
                                            <td rowspan="3" id="areas">trazabilidad</td>
                                        </tr>
                                      
                                            <div id="hoja"> <input type="hidden" name="hoja" value=""></div>
                               
                                        <tr>
                                            <td>Medidas </td>
                                            <td><input type="text" name="ancho" id="ancho_max" onclick="validar();" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $ancho_cot;} ?>" style="width: 70px;"  placeholder="Ancho en mm" required> X 
                                                <input type="text" name="alto" id="alto_max" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $alto_cot;} ?>" style="width: 70px;"  placeholder="Alto en mm" required></td>
                                            <td>Medida Alto Cuerpo Fijo</td>
                                            <td><input type="text" name="cuerpo"  value="0"></td>
                                           
                                        </tr>
                                        <tr>
                                            <td>Cantidad</td>
                                            <td><input type="text" id="cant" name="cant" autocomplete="off" value="<?php if(isset($_GET['up'])){echo $cantidad_cot;} ?>"  style="width: 60px;"  placeholder="Cantidad" onchange="calculapeso();" required></td>
                                             <td>Medida Ancho Cuerpo Fijo</td>
                                            <td><input type="text" name="ladomm"  value="0"></td>
                                        </tr>
       
                                         <tr>
                                            <td>Medidas Totales con Compuestos</td>
                                             <td><input type="text" autocomplete="off" name="ancho_temp" value="<?php if(isset($_GET['up'])){echo $ancho_temp;} ?>" style="width: 70px;"  placeholder="Ancho en mm" >
                                              X <input type="text" autocomplete="off" name="alto_temp" value="<?php if(isset($_GET['up'])){echo $alto_temp;} ?>" style="width: 70px;"  placeholder="Alto en mm" ></td>
                                             <td>Lleva Pelicula ?</td>
                                            <td>
                                                <select name="pelicula">
                                                    <option value="No Aplica">No Aplica</option>
                                                    <option value="Una Cara">Una Cara</option>
                                                    <option value="Doble Cara">Doble Cara</option>
                                                </select>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Lleva Huacal?</td>
                                            <td>
                                                 <select name="huacal">
                                                 <option value=" "> </option> 
                                                 <option value="Si">Si</option>
                                                 <option value="No">No</option>
                                                 </select>
                                            </td>
                                            
                                        </tr>

                                        <tr>
                                            <td>Si es division de baño y tiene el ancho de abajo diferente de arriba digitelo:</td>
                                            <td><input type="text" name="ancho_abajo" value="0"></td>
                                            <td>Observaciones adicionales:</td>
                                            <td><textarea name="obs2" placeholder="Observacion adicional"><?php if(isset($_GET['up'])){echo $obs2;} ?></textarea></td>
                                            <td rowspan="2"><div id="areas_vid">trazabilidad</div>
                                          <div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                <label class="control-label">Imagen Opcional</label>
                                               
                                                <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                                    <img src="<?php if(isset($_GET['up'])){if($adicional !=''){echo '../adicionales/'.$adicional;}else{echo '../imagenes/nofoto.png';}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                                <span class="btn btn-file"><span class="fileupload-new">Seleccione La Imagen</span>
                                                <span class="fileupload-exists">Cambiar</span><?php if(isset($_GET['up'])){echo '<input name="imagen" type="file" value="'.$adicional.'" />';}else{echo '<input name="imagen" type="file" value="" />';} ?></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                                 
                                            </div></td>
                                        </tr>
                                        <tr>
                                            <td>Digite la cantidad de verticales y horizontales</td>
                                            <td><input type="text" name="vert" value="" PLACEHOLDER="Verticales" style="width: 70px;">
                                                X <input type="text" name="hori" value="" placeholder="Horizontales"  style="width: 70px;">
                                            </td>
                                            <td><input type="checkbox" name="d1"   value="1">Automatico</td>
                                            <td>
                                            </td>
                                            
                                        </tr>
                                        
                                    </table>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Agregar</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
      
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
<div class="tab-pane <?php if(isset($_GET['up_serv'])){echo 'active';}  ?>" id="tab7">
	<div class="row-fluid">
		<form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['up_serv'])){echo '../modelo/cotizacion_servicios.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&editar='.$_GET['up_serv'].' ';}else{echo '../modelo/cotizacion_servicios.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&tipo_cli='.$tipo.'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
			<section class="body">
				<div class="body-inner">                    
					<?php
						if (isset($_GET['up_serv'])) {
							$sql21 = "SELECT *
										FROM referencia_mo a, cotizaciones_servicios b
									   WHERE a.id_ref_mo = b.id_servicio
										 AND b.id_cot_serv = " . $_GET['up_serv'];
							$fila21 = mysql_fetch_array(mysql_query($sql21));
							$idcotsv = $fila21["id_cot_serv"];
							$id_sv = $fila21["id_ref_mo"];
							$cant_sv = $fila21["cantidad_serv"];
							$des_sv = $fila21["descripcion_mo"];
							$valor_sv = $fila21["valor_mo"];
							$valor_sv_total = $fila21["precio_servicio"];
							$observaciones_sv = $fila21["obs_servicio"];
							$ca = $fila21["cantidad_serv"];
							$dd = $fila21["descuento_serv"];
							$idfrm = $fila21["id_ref_mo"];
							$request_ac1 = mysql_query("SELECT * FROM gastos_serv a, referencia_admin c
														 WHERE a.id_administrativo = c.id_ref_ad
														   AND a.id_ref = " . $fila21["id_ref_mo"]);
                                                        $mn = mysql_query("select descripcion_mo from referencia_mo where id_ref_mo='$idfrm' ");
                                                        $m = mysql_fetch_row($mn);
                                                        $name=$m[0];
							$tota = 0;
							while ($row1 = mysql_fetch_array($request_ac1)) {
								$por = 100;
								$tota = $tota + ($fila21["valor_mo"] * $row1["porcentaje_ad"] / $por);
							}
							$pr = (100 - $fila21["utilidad"]) / 100;
							$fr = ($fila21["valor_mo"] + $tota) / $pr;
							$des = ($dd / 100) * $fr;
							$vv = ($fr + $des) * $fila21["cantidad_serv"];
						}
						if (isset($_GET['up_mat'])) {
							$sql21 = "SELECT *
										FROM referencias a, cotizaciones_materiales b
									   WHERE a.id_referencia = b.id_material
									     AND b.id_cot_mat = " . $_GET['up_mat'];
							$fila21 = mysql_fetch_array(mysql_query($sql21));
							$idmt = $fila21["id_referencia"];
							$ref = $fila21["referencia"];
							$des_mt = $fila21["descripcion"];
							$color_ma = $fila21["color_ma"];
							$camt = $fila21["cantidad_mat"];
							$ddmt = $fila21["descuento_mat"];
							$por_mp = $fila21["pe"];
							$observaciones_mat = $fila21["observaciones"];
							$med = $fila21["med"];
							$med2 = $fila21["med2"];
						}
						if (isset($_GET['up_k'])) {
							$sql21 = "SELECT *
										FROM producto a, cotizaciones_kit b
									   WHERE a.id_p = b.id_producto
									     AND b.id_ck = " . $_GET['up_k'];
							$fila21 = mysql_fetch_array(mysql_query($sql21));
							$idmt = $fila21["id_p"];
							$ref = $fila21["referencia_p"];
							$des_mt = $fila21["producto"];
							$color_k = $fila21["color_k"];
							$camt = $fila21["cantidad_k"];
							$ddmt = $fila21["desc_k"];
							$por_mp= $fila21["por_k"];
						}
					?>
					<div class="row-fluid">
						<br>
						 <input type="hidden" name="id_cot_servicios" id="id_cot_servicios" value="<?php echo $_GET['cot']; ?>" />
						 <input type="hidden" name="id_cli_servicios" id="id_cli_servicios" value="<?php echo $_GET['cli']; ?>" />
						 <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <th style="width:10%">Seleccionar Servicios</th>
                                            <td><input type="text" id="servicio_hidden" name="servicio_hidden" style="width:40px" readonly  value="<?php if(isset($_GET['up_serv'])){ echo $idfrm; } ?>" >
                                                <input type="text" id="servicio" name="servicio" style="width:240px" value="<?php if(isset($_GET['up_serv'])){ echo $name; } ?>" readonly>
                                                <button onclick="tipoServicio()" type="button"><img src="../imagenes/search.png"></button>
                                                <button onclick="nuevo_servicio()" type="button"> + </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Cantidad</th>
                                            <td><input type="text" name="cant_servicio" value="<?php if(isset($_GET['up_serv'])){ echo $cant_sv; } ?>"  style="width:40px" id="cant_servicio">  <span id="msgs"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Valor Und</th>
                                            <td><input type="text" name="valor_servicio" value="<?php if(isset($_GET['up_serv'])){ echo $valor_sv; } ?>"  style="width:80px" id="valor_servicio"></td>
                                        </tr>
                                        <tr>
                                            <th>Descuento (%)</th>
                                            <td><input type="text" name="porcentaje_servicio" value="0" id="porcentaje_servicio" style="width:40px">
                                               </td>
                                        </tr>
                                             <tr>
                                            <th>Valor Total</th>
                                            <td><input type="text" name="total" value="<?php if(isset($_GET['up_serv'])){ echo ($valor_sv*$cant_sv); } ?>"  style="width:80px" id="total"></td>
                                        </tr>
                                             <tr>
                                            <th>Observaciones</th>
                                            <td><textarea name="descripcion_servicio" id="descripcion_servicio" style="width:80%"><?php if(isset($_GET['up_serv'])){ echo ($observaciones_sv); } ?></textarea></td>
                                        </tr>
                                            </table>
                            <hr
                                     <hr>
						
						<button type="submit" ><img src="../imagenes/guardar.jpg"> Agregar</button>
						<button type="reset" onclick="resetFields()" ><img width="18px" height="18px" src="../imagenes/clear.png"> Limpiar</button>
						<a href="../vistas/?id=new_fac&cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']  ?>"><button type="button"><img width="18px" height="18px" src="../imagenes/no.png"> Cancelar</button></a>
						<hr>
					</div>
				<div class="control-group"></div>
			</section>
		</form>
		<!--/ END Form Wizard -->
	</div>
</div>
                                               <div class="tab-pane <?php if(isset($_GET['up_mat'])){echo 'active';}  ?>" id="tab8">
                                        <div class="row-fluid">
                                       <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(!isset($_GET['up_mat'])){echo '../modelo/cotizacion_materiales.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'';}else{echo '../modelo/cotizacion_materiales.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&editar='.$_GET['up_mat'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                        
                            <section class="body">
                                <div class="body-inner"> 
                                        <div class="row-fluid">
                                            <br>
                                            <table  class="table table-bordered table-striped table-hover">
                                                <tr>
                                                    <th style="width:10%">Seleccionar Material</th>
                                                    <td><input type="text" name="refe" id="valor1"  value="<?php if(isset($_GET['up_mat'])){ echo $des_mt; } ?>" placeholder="Descripcion del material">
                                                   <input type="hidden" name="ref" id="valor2"  value="<?php if(isset($_GET['up_mat'])){ echo $idmt; } ?>"><a href="../vistas/materiales.php?cot=<?php echo $_GET['cot']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"><img src="../imagenes/check.png"></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Referencia</th>
                                                    <td><input type="text" name="refer" id="valor3"  value="<?php if(isset($_GET['up_mat'])){ echo $ref; } ?>" placeholder="Referencia"></td>
                                                </tr>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <td><input type="text" name="cant" value="<?php if(isset($_GET['up_mat'])){ echo $camt; } ?>"></td>
                                                </tr>
                                                 <tr>
                                            <th>Color del Material</th>
                                            <td  id="alum"> <select name="color"  required>
                                                    <?php if(isset($_GET['up_mat'])){echo "<option value='".$color_ma."'>".$color_ma."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                           <?php
                                                           require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                               </select></td>
                                         
                                        </tr>
                                                <tr>
                                                    <th>Medida (Ancho)</th>
                                                    <td><input type="text" id="valor4" name="medida" value="<?php if(isset($_GET['up_mat'])){ echo $med; }else{echo '1';} ?>">Nota: Si es un perfil, digite la medida (Ancho).</td>
                                                </tr>
                                                 <tr>
                                                    <th>Medida (Alto)</th>
                                                    <td><input type="text" id="valor5" name="medida2" value="<?php if(isset($_GET['up_mat'])){ echo $med2; }else{echo '1';} ?>">Nota: Si es un perfil, digite la medida (Alto).</td>
                                                </tr>
                                                <tr>
                                                    <th>Descuento (%)</th>
                                                    <td>
                                                        <input type="text" name="desc" value="<?php if(isset($_GET['up_mat'])){ echo $ddmt; } ?>">
                                                        </td>
                                                </tr>
                                                <tr>
                                                	<th>Observaciones</th>
                                                	<td>
                                                		<textarea style="resize: none;" name="descripcion_materiales" id="descripcion_materiales" rows="3" class="span12"><?php if (isset($_GET['up_mat'])) { echo $observaciones_mat; } ?></textarea>
                                                	</td>
                                                </tr>
                                                <tr>
                                                    <th>Porcentaje Materia Prima %</th>
                                                    <td><select name="mp"  style="width: 80px;">
                                                       <?php if(isset($_GET['up_mat'])){echo "<option value='".$por_mp."'>".$por_mp."</option>";} ?>
                                                            <option value="p1">p1</option>    
                                                        <option value="p2">p2</option>
                                                         <option value="p3">p3</option>
                                                        </select></td>
                                                </tr>
                                            </table>
                                            <hr>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Agregar</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
                                     <hr>
                                      
                                     </div> 

                                    
                                    
                                    
                                    
                                    
                                        
                                    <div class="control-group"></div>
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                     <div class="tab-pane <?php if(isset($_GET['up_k'])){echo 'active';}  ?>" id="tab9">
                                        <div class="row-fluid">
                                       <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(!isset($_GET['up_k'])){echo '../modelo/cotizacion_kit.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'';}else{echo '../modelo/cotizacion_kit.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&editar='.$_GET['up_k'].'';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">                      
                            <section class="body">
                                <div class="body-inner">
                                        <div class="row-fluid">
                                            <br>
                                            <table class="table table-bordered table-striped table-hover">
                                                <tr>
                                                    <th style="width:10%">Seleccionar Kit</th>
                                                    <td><input type="text" name="refe" id="valor555"  value="<?php if(isset($_GET['up_k'])){ echo $des_mt; } ?>" placeholder="Descripcion del material">
                                                   <input type="hidden" name="ref" id="valor655"  value="<?php if(isset($_GET['up_k'])){ echo $idmt; } ?>"><a href="../vistas/kit.php?cot=<?php echo $_GET['cot']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=700'); return false;"><img src="../imagenes/check.png"></a></td>
                                                </tr>
                                                <tr>
                                                    <th>Referencia</th>
                                                    <td><input type="text" name="refer" id="valor755"  value="<?php if(isset($_GET['up_k'])){ echo $ref; } ?>" placeholder="Referencia"></td>
                                                </tr>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <td><input type="text" name="cant" value="<?php if(isset($_GET['up_k'])){ echo $camt; } ?>"></td>
                                                </tr>
                                                <tr>
                                            <th>Color del Kit</th>
                                            <td  id="alum"> <select name="color"  required>
                                                    <?php if(isset($_GET['up_k'])){echo "<option value='".$color_k."'>".$color_k."</option>";}else{echo "<option value=''>.:Seleccione el color:.</option>"; } ?>
                                                                   
                                                                   <?php
                                                                       require '../modelo/conexion.php';
                                                           $consulta6= "SELECT * FROM `tipo_aluminio`";                     
                                                            $result6=  mysql_query($consulta6);
                                                            while($fila=  mysql_fetch_array($result6)){
                                                            $valor1=$fila['id_ta'];
                                                           
                                                            $valor3=$fila['color_a'];
                                                         
                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                            </select></td>
                                         
                                        </tr>
                                                <tr>
                                                    <th>Descuento (%)</th>
                                                    <td>
                                                        <input type="text" name="desc" value="<?php if(isset($_GET['up_k'])){ echo $ddmt; } ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Porcentaje Materia Prima %</th>
                                                    <td><select name="mp"  style="width: 80px;">
                                                       <?php if(isset($_GET['up_k'])){echo "<option value='".$por_mp."'>".$por_mp."</option>";} ?>
                                                            <option value="p1">p1</option>    
                                                        <option value="p2">p2</option>
                                                         <option value="p3">p3</option>
                                                        </select></td>
                                                </tr>
                                            </table>
                                          <hr>
                                     <button type="submit" ><img src="../imagenes/guardar.jpg">Agregar</button>
                                     <button type="reset" ><img width="18px" height="18px" src="../imagenes/clear.png">Limpiar</button>
                                     <hr>
                                     </div>   
                                    <div class="control-group"></div>
                            </section>
                        </form>
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                            <div class="tab-pane" id="tab10">
                                        <div class="row-fluid">
                                   
                            <section class="body">
                                <div class="body-inner">
<!--                               //codigo aqui-->
                          <a title="Hoja de Costo Temporal" href="#" onClick="materia_prima()"><img src="../imagenes/hoja.png"> Costo de Materia Prima</a>
<?php if(isset($_POST['col'])){
    $filas = $_POST['col'];
}else{
    $filas = 6;
}  ?>
                                       <br><a title="Ver todas las dt en general" href="../vistas/hoja_presupuesto_1.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1000,height=600'); return false;"><img src="../imagenes/print.png"> Imprimir todas las dt</a> 
                                       <br><a title="Ver todas las dt en general" href="../vistas/hoja_materiales.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1000,height=600'); return false;"><img src="../imagenes/print.png"> Desgloses detallado</a> 
                                       <br><a title="Ver todas las dt en general" href="../vistas/hoja_materiales_1.php?cot=<?php echo $_GET['cot'].'&cli='.$_GET['cli']; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=1000,height=600'); return false;"><img src="../imagenes/print.png"> Desgloses Resumindo</a> 
                                       <br><a title="Reporte de utilidad" href="../vistas/costos.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/bars.png"> UTILIDAD DE TEMPLADO CON COSTO LISTA</a>
                                       <br><a title="Reporte de utilidad" href="../vistas/costosfom.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/bars.png"> UTILIDAD DE TEMPLADO CON COSTO CONTABLE COTIZADOS</a>
                                       <br><a title="Reporte de utilidad" href="../vistas/costos_actuales.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/bars.png"> UTILIDAD DE TEMPLADO CON COSTO CONTABLE ACTUALES</a>
                                       <br><a title="Reporte de utilidad" href="../vistas/costos_1.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/barsf.png"> UTILIDAD DE BOGOTA CON COSTO CONTABLE PARA BOGOTA</a>
                                       <br><a title="Reporte de utilidad" href="../vistas/costosfom_1.php?cot=<?php echo $_GET['cot'].'&col='.$filas; ?>" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/barsf.png"> UTILIDAD TEMPLADO VS COSTO CONTABLE PARA BOGOTA</a> <a title="Reporte de utilidad" href="../vistas/costosfom_1_excel.php?cot=<?php echo $_GET['cot'].'&col='.$filas.'&excel'; ?>"><img src="../imagenes/file_excel.png"></a>
            <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                  <div align="right">
                  <button type="submit"> Ordenar filas de :</button> <input style="width:30px;" type="number" name="col" value="<?php if(isset($_POST['col'])){echo $_POST['col'];}else{echo '7';} ?>">
                  </div>  
            </form>
                 </section>
                 </div>
                   </div>
                   </div>
                   </div><!--/ Normal Tabs -->
                   </div>
                  </section>
                    </div>
                    </div>
 </section></div><?php
 
 if(isset($_GET['del_1'])){
$sql = "DELETE FROM referencia_acce WHERE id_ref_acce=".$_GET['del_1']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=add_acc'";
echo "</script>";
}
if(isset($_GET['por'])){

    if(isset($_POST["cant"]))
    {
        $n = $_POST["cant"];
        
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["valor$x"])){
                include "../modelo/conexion.php";
                $sqlr = "UPDATE `cotizaciones` SET `fila`='".$_POST["fila$x"]."', `tip`='".$_POST["tip$x"]."', `desc`='".$_POST["valor$x"]."', porcentaje='".$_POST["por$x"]."' WHERE `id_cotizacion`='".$_POST["id$x"]."';";
                mysql_query($sqlr);
        
        
            }   
          
        } 
         
                  
                  $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                  $sqlr.= "VALUES ('Se Actualizaron los porcenjes de la cotizacion ', '".$_GET['cot']."', '".$_SESSION['k_username']."', 'Cotizacion')";
                  mysql_query($sqlr, $conexion);echo '<script lanquage="javascript">alert("Se ha Actualizado los porcentajes");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>'; 
}}
 if (isset($_GET['del_serv'])) {
		$sql = "DELETE FROM cotizaciones_servicios WHERE id_cot_serv = " . $_GET['del_serv'] . "";
		mysql_query($sql, $conexion);
		mysql_query("DELETE FROM info_servicios WHERE id_servicio = " .  $_GET['del_serv'] . "", $conexion);
		$res = 'SELECT * FROM cotizaciones a, producto b WHERE a.id_referencia = b.id_p AND a.id_cotizacion = ' . $_GET['cot'] . ' ';
		$f = mysql_fetch_array(mysql_query($res));
		$a = $f['producto'];       
		$sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
		$sqlr.= "VALUES ('Se elimino un servicio de ".$a." ', '".$_GET['cot']."', '".$_SESSION['k_username']."', 'Cotizacion')";
		mysql_query($sqlr, $conexion);          
		echo "<script language='javascript' type='text/javascript'>";
		echo "location.href='../vistas/?id=new_fac&cot=" . $_GET['cot'] . "&cli=" . $_GET['cli'] . " '";
		echo "</script>";
	}
  if (isset($_GET['del_vid'])) {
		$query_select_valor_delete = mysql_query("SELECT precio_unitario, id_servicio FROM info_servicios WHERE id_info_servicio = " . $_GET['del_vid']);
		$row_valor_delete = mysql_fetch_array($query_select_valor_delete);
		//echo "<script>alert('" . $row_valor_delete['id_servicio'] . "');</script>";
		mysql_query("UPDATE cotizaciones_servicios SET precio_accesorios = precio_accesorios - " . $row_valor_delete["precio_unitario"] . " WHERE id_cot_serv = " . $row_valor_delete["id_servicio"]);
		mysql_query("DELETE FROM info_servicios WHERE id_info_servicio = " . $_GET['del_vid']);
		echo "<script language='javascript' type='text/javascript'>";
		echo "location.href='../vistas/?id=new_fac&up_serv=" . $row_valor_delete["id_servicio"] . "&cot=" . $_GET['cot'] . "&cli=" . $_GET['cli'] . " '";
		echo "</script>";
	}
  if (isset($_GET['del_mat'])) {
		$sql = "DELETE FROM cotizaciones_materiales WHERE id_cot_mat = " . $_GET['del_mat'] . "";
		mysql_query($sql, $conexion);
		$sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
		$sqlr.= "VALUES ('Se elimino un suministro ', '" . $_GET['cot'] . "', '" . $_SESSION['k_username'] . "', 'Cotizacion')";
		mysql_query($sqlr, $conexion);
		echo "<script language='javascript' type='text/javascript'>";
		echo "location.href='../vistas/?id=new_fac&cot=" . $_GET['cot'] . "&cli=" . $_GET['cli'] . " '";
		echo "</script>";
	}
  if (isset($_GET['del_k'])) {
		$sql = "DELETE FROM cotizaciones_kit WHERE id_ck=" . $_GET['del_k'] . "";
		mysql_query($sql, $conexion);
		$sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
		$sqlr.= "VALUES ('Se elimino un kit ', '" . $_GET['cot'] . "', '" . $_SESSION['k_username'] . "', 'Cotizacion')";
		mysql_query($sqlr, $conexion);
		echo "<script language='javascript' type='text/javascript'>";
		echo "location.href='../vistas/?id=new_fac&cot=" . $_GET['cot'] . "&cli=" . $_GET['cli'] . " '";
		echo "</script>";
	}
   if(isset($_GET['copy'])){

                 $res = 'select *, a.laminas from cotizaciones a, producto b  where a.id_referencia=b.id_p and a.id_cotizacion='.$_GET['copy'].' ';
                 $row =mysql_fetch_array(mysql_query($res)); 
                 $sql2 = "INSERT INTO `cotizaciones` (`descuento_g`, `ancho_temp`, `alto_temp`, `valor_temp`, `valor_c_sp`,`valor_fom`,`valor_costob`,`valor_fomp`,`pelicula`, `precio_adicional`,`precio_material`,`modulo`, `observaciones2`,`an`, `al`, `fila`, `tip`, `imagen_mas`, `imagen`, `ancho_abajo`, `ubicacion_c`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`, `laminas`, `laminas2`, `laminas3`, `laminas4`, `install`, `id_vidrio2`, `id_vidrio3`, `id_vidrio4`, `id_vidrio5`, `id_vidrio6`,`tipo_c`, `duracion`, `horizontales`,`verticales`,`desc`, `observaciones`, `hojas`, `cuerpo`, `color_ta`, `porcentaje`, `porcentaje_mp`, `per`, `boq`, `cod_traz`, `linea_cot`, `id_cot`, `cierre`, `id_referencia`, `id_vidrio`, `ancho_c`, `alto_c`, `valor_c`, `cant_restante`, `cantidad_c`, `id_cliente`, `estado_c`, `registrado_por_c` , `d1`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`)";
                 $sql2.= "VALUES ('".$row['descuento_g']."', '".$row['ancho_temp']."','".$row['alto_temp']."','".$row['valor_temp']."','".$row['valor_c_sp']."','".$row['valor_fom']."','".$row['valor_costob']."','".$row['valor_fomp']."','".$row['pelicula']."', '".$row['precio_adicional']."','".$row['precio_material']."','".$row['modulo']."', '".$row['observaciones2']."','".$row['an']."','".$row['al']."','".$row['fila']."','".$row['tip']."','".$row['imagen_mas']."','".$row['imagen']."','".$row['ancho_abajo']."', '".$row['ubicacion_c']."', '".$row['traz_vid']."', '".$row['traz_vid2']."', '".$row['traz_vid3']."', '".$row['traz_vid4']."', '".$row['laminas']."', '".$row['laminas2']."', '".$row['laminas3']."', '".$row['laminas4']."', '".$row['install']."', '".$row['id_vidrio2']."', '".$row['id_vidrio3']."', '".$row['id_vidrio4']."', '".$row['id_vidrio5']."', '".$row['id_vidrio6']."','".$row['tipo_c']."', '".$row['duracion']."', '".$row['horizontales']."', '".$row['verticales']."','".$row['desc']."', '".$row['observaciones']."', '".$row['hojas']."', '".$row['cuerpo']."', '".$row['color_ta']."', '".$row['porcentaje']."', '".$row['porcentaje_mp']."', '".$row['per']."', '".$row['boq']."','".$row['cod_traz']."', '".$row['linea_cot']."', '".$_GET['cot']."', '".$row['cierre']."', '".$row['id_referencia']."', '".$row['id_vidrio']."', '".$row['ancho_c']."', '".$row['alto_c']."',  '".$row['valor_c']."',  '".$row['cantidad_c']."',  '".$row['cantidad_c']."', '".$row['id_cliente']."', 'En proceso', '".$_SESSION['k_username']."', '".$row['d1']."', '".$row['id2_vidrio']."', '".$row['id2_vidrio2']."', '".$row['id2_vidrio3']."', '".$row['id2_vidrio4']."', '".$row['id2_vidrio5']."', '".$row['id3_vidrio']."', '".$row['id3_vidrio2']."', '".$row['id3_vidrio3']."', '".$row['id3_vidrio4']."', '".$row['id3_vidrio5']."', '".$row['id4_vidrio']."', '".$row['id4_vidrio2']."', '".$row['id4_vidrio3']."', '".$row['id4_vidrio4']."', '".$row['id4_vidrio5']."')";
                 mysql_query($sql2, $conexion); 
                 $sql5 = "SELECT max(id_cotizacion) FROM cotizaciones";
                 $fila5 =mysql_fetch_array(mysql_query($sql5));
                 $maxcot= $fila5["max(id_cotizacion)"];
                      include "../modelo/conexion.php";
                     //se consultan los compuestos de esta referencia  -- parte de los materi prima
                 $request_acc=mysql_query("SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET["cot"]." and a.id_cot=".$_GET['copy']."  ");
                 while($row3=mysql_fetch_array($request_acc))
                 {   
                   $sql33 = "INSERT INTO `referencia_acce` (`cotizacion`, `num_ref`, `id_cot`, `cantidad_m`, `calcular`, `metro`, `yes`, `lado`, `med`)";
                   $sql33.= "VALUES ('".$_GET["cot"]."', '".$row3['num_ref']."', '".$maxcot."',  '".$row3['cantidad_m']."', '".$row3['calcular']."', '".$row3['metro']."', '".$row3['yes']."', '".$row3['lado']."', '".$row3['med']."')";
                   mysql_query($sql33, $conexion);

                 }
                
                 // se agrega los kit 
                 
                 $request_kit=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$_GET['copy']." and b.comp='1' ");
                 while($row5=mysql_fetch_array($request_kit))
                 {   
                     $sql3 = "INSERT INTO `cotizaciones_kit` (`id_producto`, `id_cot`, `cantidad_k`, `por_k`, `desc_k`, `id_prod_mas`, `color_k`, `comp`)";
                     $sql3.= "VALUES ('".$row5['id_producto']."', '".$_GET["cot"]."', '".$row5['cantidad_k']."', '".$row5['por_k']."',  '".$row3['desc_k']."', '".$maxcot."', '".$row5['color_k']."', '".$row5['comp']."')";
                     mysql_query($sql3, $conexion);

                 }
                 
                 // se agrega los compuesto
                  $request2=mysql_query("SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$_GET['copy']."");
                  while($row4=mysql_fetch_array($request2))
	          {  
                     $sql4 = "INSERT INTO `cotizaciones_sub` (`pelicula`, `valor_fom_sub`,`valor_sp`,`valor_fom_sp`,`imagen_adic`, `imagen_sub`,`laminas`,`laminas2`,`laminas3`,`laminas4`, `tipo_c_sub`, `install`, `horizontales`,`verticales`,`desc_sub`, `observaciones_sub`, `hojas_sub`, `cuerpo_sub`, `color_ta_sub`, `porcentaje_sub`, `porcentaje_mp_sub`, `per_sub`, `boq_sub`, `cod_traz_sub`, `linea_cot_sub`, `id_cot_sub`, `cierre_sub`, `id_referencia_sub`, `id_vidrio_sub`, `id_vidrio_sub2`, `id_vidrio_sub3`, `id_vidrio_sub4`, `id_vidrio_sub5`, `id_vidrio_sub6`, `ancho_c_sub`, `alto_c_sub`, `valor_c_sub`, `cantidad_c_sub`, `cant_restante`, `id_cliente_sub`, `estado_c_sub`, `registrado_por_c_sub`, `id_producto_cot`, `d1`, `id2_vidrio`, `id2_vidrio2`, `id2_vidrio3`, `id2_vidrio4`, `id2_vidrio5`, `id3_vidrio`, `id3_vidrio2`, `id3_vidrio3`, `id3_vidrio4`, `id3_vidrio5`, `id4_vidrio`, `id4_vidrio2`, `id4_vidrio3`, `id4_vidrio4`, `id4_vidrio5`, `traz_vid`, `traz_vid2`, `traz_vid3`, `traz_vid4`)";
                     $sql4.= "VALUES ('".$row4['pelicula']."','".$row4['valor_fom_sub']."','".$row4['valor_sp']."','".$row4['valor_fom_sp']."','".$row4['imagen_adic']."', '".$row4['imagen_sub']."', '".$row4['laminas']."', '".$row4['laminas2']."', '".$row4['laminas3']."', '".$row4['laminas4']."', '".$row4['tipo_c_sub']."', '".$row4['install']."','".$row4['horizontales']."', '".$row4['verticales']."','".$row4['desc_sub']."', '".$row4['observaciones_sub']."', '".$row4['hojas_sub']."', '".$row4['cuerpo_sub']."', '".$row4['color_ta_sub']."', '".$row4['porcentaje_sub']."', '".$row4['porcentaje_mp_sub']."', '".$row4['per_sub']."','".$row4['boq_sub']."', '".$row4['cod_traz_sub']."', '".$row4['linea_cot_sub']."', '".$_GET["cot"]."', '".$row4['cierre_sub']."', '".$row4['id_referencia_sub']."', '".$row4['id_vidrio_sub']."', '".$row4['id_vidrio_sub2']."', '".$row4['id_vidrio_sub3']."', '".$row4['id_vidrio_sub4']."', '".$row4['id_vidrio_sub5']."', '".$row4['id_vidrio_sub6']."', '".$row4['ancho_c_sub']."',  '".$row4['alto_c_sub']."',  '".$row4['valor_c_sub']."',  '".$row4['cantidad_c_sub']."', '".$row4['cantidad_c_sub']."', '".$row4['id_cliente_sub']."', '".$row4['estado_c_sub']."', '".$_SESSION['k_username']."', '".$maxcot."', '".$row4['d1']."', '".$row4['id2_vidrio']."', '".$row4['id2_vidrio2']."', '".$row4['id2_vidrio3']."', '".$row4['id2_vidrio4']."', '".$row4['id2_vidrio5']."', '".$row4['id3_vidrio']."', '".$row4['id3_vidrio2']."', '".$row4['id3_vidrio3']."', '".$row4['id3_vidrio4']."', '".$row4['id3_vidrio5']."', '".$row4['id4_vidrio']."', '".$row4['id4_vidrio2']."', '".$row4['id4_vidrio3']."', '".$row4['id4_vidrio4']."', '".$row4['id4_vidrio5']."', '".$row4['traz_vid']."', '".$row4['traz_vid2']."', '".$row4['traz_vid3']."', '".$row4['traz_vid4']."')";
                     mysql_query($sql4, $conexion);    
                  }
     echo '<script lanquage="javascript">alert("Se ha Copiado el items  con exito  ");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].' "</script>'; 
    
}   
 if(isset($_GET['ok'])){ 
     include '../modelo/conexion.php'; 
      $sql = "UPDATE `cotizaciones` SET `aprobado` = '1' WHERE `id_cot` = ".$_GET['cot']."";
      mysql_query($sql, $conexion);
      $sql5 = "SELECT max(orden) FROM cotizacion";
          $fila5 =mysql_fetch_array(mysql_query($sql5));
          $maxorden= $fila5["max(orden)"] + 1;
          $sql2 = "UPDATE `cotizacion` SET `estado` = 'Aprobado', orden=".$maxorden.", aprobado_por=".$_SESSION['k_username']." WHERE `id_cot` = ".$_GET['cot']."";
          mysql_query($sql2, $conexion); 
      echo '<script lanquage="javascript">alert("Se ha aprobado la cotizacion");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>'; 

      }
     if(isset($_GET['congelar'])){

     include '../modelo/conexion.php'; 
     $sql = "UPDATE `cotizacion` SET `estado` = 'Pedido por aprobar', `fecha_guardado` = '".$fecha_hoy."' WHERE `id_cot` = ".$_GET['cot']."";
     mysql_query($sql, $conexion); 
     echo '<script lanquage="javascript">alert("Se ha Guardado la cotizacion");location.href="../vistas/?id=new_fac&cot='.$_GET['cot'].'&cli='.$_GET['cli'].'"</script>'; 

}
      if(isset($_GET['quitar'])){
$sql = "UPDATE cotizaciones SET imagen_mas='' WHERE id_cotizacion=".$_GET['up']."";
mysql_query($sql, $conexion);
 $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                  $sqlr.= "VALUES ('Se elimino la imagen ', '".$_GET['cot']."', '".$_SESSION['k_username']."', 'Cotizacion')";
                  mysql_query($sqlr, $conexion);
                  
    echo "<script language='javascript' type='text/javascript'>";
    echo "location.href='../vistas/?id=new_fac&cot=".$_GET['cot']."&cli=".$_GET['cli']."&up=".$_GET['up']." '";
    echo "</script>";
}

if(isset($_GET['calcular'])){
       include '../modelo/conexion.php'; 
       $requestwe=mysql_query("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]."  ");
         
         while($rowxy = mysql_fetch_array($requestwe)){
             
            $requestw=mysql_query("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cot=".$_GET["cot"]." and c.id_cotizacion='".$rowxy['id_cotizacion']."'  order by c.fila asc ");
         
            while($rowxx = mysql_fetch_array($requestw)){
            $linea = $_POST["linea"] = $rowxx["linea_cot"];
            $ladomm = $_POST["ladomm"] = $rowxx["lado"];
            $dolar= $_POST["id_dolar"] = $rowxx["id_dolar"];
            $cot= $_GET["cot"];
            $tip= $_POST["tip"]= $rowxx["tipo_c"];
            $ref= $_POST["ref"]= $rowxx["id_referencia"];
            $cliente= $_GET["cli"];
            $tipo_cli= $rowxx["tipo_c"];
            $vid=  $_POST["vid"] = $rowxx["id_vidrio"];
            if(isset($rowxx["id2_vidrio"])){$vidd = $_POST["vidd"]= $rowxx["id2_vidrio"];}else{$vidd = '';}
            if(isset($rowxx["id3_vidrio"])){$vidt = $_POST["vidt"]= $rowxx["id3_vidrio"];}else{$vidt = '';}
            if(isset($rowxx["id4_vidrio"])){$vidc = $_POST["vidc"]= $rowxx["id4_vidrio"];}else{$vidc = '';}
            $cantidad= $_POST["cant"]= $rowxx["cantidad_c"];
            $ancho= $_POST['ancho']= $_POST["ancho"]= $rowxx["ancho_c"];$modulo= 0;
            $ancho_a= $_POST["ancho_abajo"]= $rowxx["ancho_abajo"];
            $aa= $_POST["ancho_abajo"]= $rowxx["ancho_abajo"];
            $alto= $_POST['alto']= $_POST["alto"]= $rowxx["alto_c"];
            $alto_temp= $_POST["alto_temp"]= $rowxx["alto_temp"];
            $ancho_temp= $_POST["ancho_temp"]= $rowxx["ancho_temp"];
            $traz_vid = $_POST["traz_vid"]= $rowxx["traz_vid"];
            if(isset($rowxx["traz_vid2"])){$traz_vid2 = $_POST["traz_vid2"]= $rowxx["traz_vid2"];}else{$traz_vid2 = '';}
            if(isset($rowxx["traz_vid3"])){$traz_vid3 = $_POST["traz_vid3"]= $rowxx["traz_vid3"];}else{$traz_vid3 = '';}
            if(isset($rowxx["traz_vid4"])){$traz_vid4 = $_POST["traz_vid4"]= $rowxx["traz_vid4"];}else{$traz_vid4 = '';}
            $cierre= $_POST["cierre"]= $rowxx["cierre"];
            $precio= $_POST["precio"]= $rowxx["porcentaje"];
            $precio_mp= $_POST["precio_mp"]= $rowxx["porcentaje_mp"];
            $duracion = $_POST["duracion"]= $rowxx["duracion"];
            $alum= $_POST["alum"]= $rowxx["color_ta"]; $lado= $_POST["lado"]= $rowxx["imagen"]; 
            $laminas=$_POST["laminas"]= $rowxx["laminas"];
            if(isset($rowxx["laminas2"])){$laminas2 = $_POST["laminas2"]= $rowxx["laminas2"];}else{$laminas2 = '';}
            if(isset($rowxx["laminas3"])){$laminas3 = $_POST["laminas3"]= $rowxx["laminas3"];}else{$laminas3 = '';}
            if(isset($rowxx["laminas4"])){$laminas4 = $_POST["laminas4"]= $rowxx["laminas4"];}else{$laminas4 = '';}
            $install= $_POST["install"]= $rowxx["install"];
             if(isset($rowxx["cuerpo"])){$cuerpo= $_POST["cuerpo"]= $rowxx["cuerpo"];}else{$cuerpo=0;};
             $hoja= $_POST["hoja"]= $rowxx["hojas"];
             $desc= $_POST["desc"]= $rowxx["desc"];
             if(isset($rowxx["verticales"])){$vert= $_POST["vert"]= $rowxx["verticales"];}else{$vert= 0;}
              if(isset($rowxx["horizontales"])){$hori= $_POST["hori"]= $rowxx["horizontales"];}else{$hori= 0;}
             $descripcion= $_POST["descripcion"]= $rowxx["observaciones"];$obs2= $_POST["obs2"]= $rowxx["observaciones2"];
            $ds= $_POST["d1"]= $rowxx["d1"];
          $altura_v_c = $rowxx["alto_c"] - $cuerpo;
            $estado = 'Cotizado';
            $pelicula = $_POST['pelicula']= $rowxx['pelicula'];
            if(isset($rowxx["id_vidrio2"])){$vid2 = $_POST["vid2"]= $rowxx["id_vidrio2"];}else{$vid2 = '';}
            if(isset($rowxx["id_vidrio3"])){$vid3 = $_POST["vid3"]= $rowxx["id_vidrio3"];}else{$vid3 = '';}
            if(isset($rowxx["id_vidrio4"])){$vid4 = $_POST["vid4"]= $rowxx["id_vidrio4"];}else{$vid4 = '';}
            if(isset($rowxx["id_vidrio5"])){$vid5 = $_POST["vid5"]= $rowxx["id_vidrio5"];}else{$vid5 = '';}
            if(isset($rowxx["id_vidrio6"])){$vid6 = $_POST["vid6"]= $rowxx["id_vidrio6"];}else{$vid6 = '';}
            if(isset($rowxx["id2_vidrio2"])){$vidd2 = $_POST["vidd2"]= $rowxx["id2_vidrio2"];}else{$vidd2 = '';}
            if(isset($rowxx["id2_vidrio3"])){$vidd3 = $_POST["vidd3"]= $rowxx["id2_vidrio3"];}else{$vidd3 = '';}
            if(isset($rowxx["id2_vidrio4"])){$vidd4 = $_POST["vidd4"]= $rowxx["id2_vidrio4"];}else{$vidd4 = '';}
            if(isset($rowxx["id2_vidrio5"])){$vidd5 = $_POST["vidd5"]= $rowxx["id2_vidrio5"];}else{$vidd5 = '';}
            if(isset($rowxx["id2_vidrio6"])){$vidd6 = $_POST["vidd6"]= $rowxx["id2_vidrio6"];}else{$vidd6 = '';}
            if(isset($rowxx["id3_vidrio2"])){$vidt2 = $_POST["vidt2"]= $rowxx["id3_vidrio2"];}else{$vidt2 = '';}
            if(isset($rowxx["id3_vidrio3"])){$vidt3 = $_POST["vidt3"]= $rowxx["id3_vidrio3"];}else{$vidt3 = '';}
            if(isset($rowxx["id3_vidrio4"])){$vidt4 = $_POST["vidt4"]= $rowxx["id3_vidrio4"];}else{$vidt4 = '';}
            if(isset($rowxx["id3_vidrio5"])){$vidt5 = $_POST["vidt5"]= $rowxx["id3_vidrio5"];}else{$vidt5 = '';}
            if(isset($rowxx["id3_vidrio6"])){$vidt6 = $_POST["vidt6"]= $rowxx["id3_vidrio6"];}else{$vidt6 = '';}
            if(isset($rowxx["id4_vidrio2"])){$vidc2 = $_POST["vidc2"]= $rowxx["id4_vidrio2"];}else{$vidc2 = '';}
            if(isset($rowxx["id4_vidrio3"])){$vidc3 = $_POST["vidc3"]= $rowxx["id4_vidrio3"];}else{$vidc3 = '';}
            if(isset($rowxx["id4_vidrio4"])){$vidc4 = $_POST["vidc4"]= $rowxx["id4_vidrio4"];}else{$vidc4 = '';}
            if(isset($rowxx["id4_vidrio5"])){$vidc5 = $_POST["vidc5"]= $rowxx["id4_vidrio5"];}else{$vidc5 = '';}
            if(isset($rowxx["id4_vidrio6"])){$vidc6 = $_POST["vidc6"]= $rowxx["id4_vidrio6"];}else{$vidc6 = '';}
   $sql='select * from producto where id_p="'.$rowxx["id_referencia"].'"';
$fil =mysql_fetch_array(mysql_query($sql));
$variable= $fil["tipo_vidrio"];
$altura= $rowxx["cuerpo"];
$altura_ventana = $rowxx["alto_c"] - $rowxx["cuerpo"];
$anchura= $rowxx["lado"];
$anchura_ventana = $rowxx["ancho_c"] - $rowxx["lado"];
$instal= $rowxx["install"];

//echo '<script>alert("alto:'.$alto.'  ancho:'.$ancho.'    altura cf:'.$altura.' altura ventana: '.$altura_ventana.'  anchura ventana: '.$anchura.' ancho cf: '.$anchura_ventana.'")</script>';

// aqui se suma todos los accesorios de la ventana --------------------------------------------
 $subcot=mysql_query("SELECT * FROM producto a, cotizaciones_sub c where c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$rowxx['id_cotizacion']."");
 $ta2 =0;$ta3 =0;
    
 while($rowc=mysql_fetch_array($subcot))
	{
                    $s3 = "SELECT (".$rowc["porcentaje_sub"].") as p FROM porcentajes where area_por='".$rowc["linea_cot_sub"]."'";
                    $fi3 =mysql_fetch_array(mysql_query($s3));
                    $mult2= $fi3["p"]/100;
                    $PB = $rowc["linea_cot_sub"].' Bogota';
                    $s33 = "SELECT (".$rowc["porcentaje_sub"].") as p FROM porcentajes where area_por='".$PB."'";
                    $fi33 =mysql_fetch_array(mysql_query($s33));
                    $mult3= $fi33["p"]/100;
                    
                    $suma2 = $rowc["valor_c_sub"];
                    $suma3 = ($rowc["valor_fom_sub"]);
              $a = $suma2 / $mult2;
              $a3 = $suma3;
      
            $ta2 = $ta2 + $a;
            $ta3 = $ta3 + $a3;
        }
//echo 'compuestos : '.$ta3.'<br>';

//fin de sua ----------------------------------------------------------------------------------
if($linea=='Vidrio'){
//    include '../modelo/suma_vidrios.php';
    include '../modelo/suma.php';
    $total = $totalx ;
     $totalfom = $totalxfom;
       $totalfom_sinp = $totalxfom_sinp;
}else{
  include '../modelo/suma.php';
  $total = $totalx;
  $totalfom = $totalxfom;
  $totalfom_sinp = $totalxfom_sinp;
}
//echo $totalxfom_sinp;

            $sql21 = "SELECT * FROM referencia_mo where id_ref_mo=99";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $request_ac1=mysql_query("SELECT * FROM gastos_serv a, referencia_admin c where a.id_administrativo=c.id_ref_ad and a.id_ref=".$fila21["id_ref_mo"]);
            $tota3=0;
            if($request_ac1){
	while($row1=mysql_fetch_array($request_ac1))
	{       
            $por = 100;
            $tota3 = $tota3 + ($fila21["valor_mo"]*$row1["porcentaje_ad"]/$por);     
            }  }
            $pr = (100 - $fila21["utilidad"]) / 100;
            $fr = (($fila21["valor_mo"] + $tota3) / $pr)*$cantidad;
            $mtr = ($rowxx["alto_c"]/1000)*($rowxx["ancho_c"]/1000);
         
            if($rowxx['pelicula']=='No Aplica'){
                $GT = $total;
          
            }else{
                if($rowxx['pelicula']=='Una Cara'){
                 
                      $tpel = $fr * $mtr;
                $GT = $total;
         
            }else{
                  $tpel = $fr * ($mtr*2);
                  $GT = $total ;

            }
            }
            $maxid = mysql_fetch_array(mysql_query("select max(id_dolar) from dolares"));
            $maxt = $maxid['max(id_dolar)'];
            
//           compuestos($rowxx["id_cot"],$rowxx["id_cotizacion"]);
//echo $totalxfom_sinp;
                  $sqlx = "UPDATE `cotizaciones` SET  `id_dolar`='".$maxt."',`valor_c`='".$GT."',`valor_c_sp`='".$totalx_sinp."', `valor_fom`='".$totalxfom."',`valor_fomp`='".$totalxfom_sinp."' WHERE `id_cotizacion` = ".$rowxx["id_cotizacion"].";";
                  mysql_query($sqlx, $conexion);

                  
                 $sqlq = "UPDATE `cotizaciones` SET  `p_act_sp`='".($GT)."',`p_act_cp`='".($totalx_sinp)."' WHERE `id_cotizacion` = ".$rowxx["id_cotizacion"].";";
                  mysql_query($sqlq, $conexion);

//             echo '<script lanquage="javascript">alert("Se ha Recalculado la cotizacion con p '.$totalxfom.' , sin p '.$totalxfom_sinp.' ");</script>'; 
//        
                  
         } 
         }
                echo '<script lanquage="javascript">alert("Se ha Recalculado la cotizacion");location.href="../vistas/?id=new_fac&cot='.$_GET["cot"].'&cli='.$_GET["cli"].'"</script>'; 
//    
}


?>