    //----------------------------MODULO DE AUDITORES---------------------------
$(function() {
    	$('#NuevoCargo').on('click', function(){
		$('#modalCargo').modal({
			show:true,
			backdrop:'static',
		}); 
                
	});
     // 2- Insertar registro
     $('#cliente').change(function(){
         MostrarProc(1);
     });
     $('#bote').click(function(){
         MostrarFact(1);
     });
     $('#empresa').change(function(){
         MostrarFact(1);
     });
     $('#tipo').change(function(){
         MostrarFact(1);
     });
     $('#mes').change(function(){
         MostrarFact(1);
     });
     $('#rips').change(function(){
         
         MostrarFact(1);
     });
     $('#paci').change(function(){
         tabla();
     });
     $('#dia').change(function(){
         tabla();
     });
     $('#mes').change(function(){
         tabla();
     });
     $('#ced').change(function(){
         tabla();
     });
     
      $('#buscar_cargo').change(function(){
		MostrarProc(1);
	});
//        $('#fechauno').change(function(){
//		MostrarProcG(1);
//	});
//        $('#fechados').change(function(){
//		MostrarProcG(1);
//	});
//        $('#pro').change(function(){
//		MostrarProcG(1);
//	});
        $('#Guardar').on('click', function(){
                var id = $('#id').val();
		var nombre = $('#nom').val();
                var nit = $('#nit').val();
                var cod = $('#cod').val();
                var tel = $('#tel').val();
                var cli = $('#cli').val();
                var dir = $('#dir').val();
                var ema = $('#ema').val();
                var con = $('#con').val();
                var page = $('#page').val();
                var pc1 = $('#pc1').val();
                var pc2 = $('#pc2').val();
                var pc3 = $('#pc3').val();
                var ph1 = $('#ph1').val();
                var ph2 = $('#ph2').val();
                var ph3 = $('#ph3').val();
                var tp1 = $('#tp1').val();
                var tp2 = $('#tp2').val();
                var tp3 = $('#tp3').val();
                
		if(nombre.length>0){
			$.ajax({
				type: 'GET',
				url: '../vistas/facturasxempresas/acciones.php?nombre='+nombre+'&tel='+tel+'&tp1='+tp1+'&tp2='+tp2+'&tp3='+tp3+'&pc1='+pc1+'&pc2='+pc2+'&pc3='+pc3+'&ph1='+ph1+'&ph2='+ph2+'&ph3='+ph3+'&cli='+cli+'&dir='+dir+'&ema='+ema+'&con='+con+'&id='+id+'&cod='+cod+'&nit='+nit+'&sw=1',
				success: function(data){
                                    //alert(data);
                                    if(data == 'up'){
				          alert('Se edito con exito '+nombre+'');
			            }else{
				          alert('Se registro con exito '+data+'');
                                        }
                                          MostrarProc(page);
                                          limpiar();
                                          $('#modalCargo').modal('hide');
				}
			});
		}else{
			$('#mensaje').html('<p class="alert alert-warning">Espere!!, tiene que ingresar la descripcion.</p>');
		}
	});
        
     // 4- Buscar en la tabla
       
    
});
//mostrar tablas
function MostrarProc(page){
var nombre = $("#buscar_cargo").val();
var cli = $("#cliente").val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&cli='+cli+'&nombre='+nombre,
				url: '../vistas/facturasxempresas/mostrar_tabla.php',
				success: function(data){
						$('#mostrar').html(data);
						
				}
			});
		return false;
}
function generar_reporte(r){
        var f1 = $("#fechauno").val();
        var f2 = $("#fechados").val();
        if(f1===''){
            alert("Debes de escoger la fecha inicial");
            $("#fechauno").focus();
            return false;
        }
        if(f2===''){
            alert("Debes de escoger la fecha inicial");
            $("#fechados").focus();
            return false;
        }
        MostrarProcG(1);
}
function MostrarProcG(page){
    var f1 = $("#fechauno").val();
    var f2 = $("#fechados").val();
    var pro = $("#pro").val();
    $('#cargando').html('<img src="../images/guardando.gif"> Cargando.......');
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&f1='+f1+'&f2='+f2+'&pro='+pro,
				url: '../vistas/citas/mostrar_tabla_general.php',
				success: function(data){
						$('#mostrar').html(data);
                                                $("#cargando").html(""); 
						
                                                    $("#imp").html('<input type="button" value="Tiempo de Consulta" onclick="Imprimir_tiempo_gen();" class="btn btn-primary"/>');
                                                
				}
			});
		return false;
}
function MostrarFact(page){
var nombre = $("#empresa").val();
var cli = $("#cliente").val();
var rip = $("#rips").val();
var f1 = $("#f1").val();
var f2 = $("#f2").val();
var tipo = $("#tipo").val();

if(f1===''){
         alert("Debes digitar la fecha inicial");
         $("#f1").focus();
         return false;
             }
             if(f2===''){
         alert("Debes digitar la fecha final");
         $("#f1").focus();
         return false;
             }
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&cli='+cli+'&tipo='+tipo+'&rips='+rip+'&f1='+f1+'&f2='+f2+'&nombre='+nombre,
				url: '../vistas/reportes/lista_facturas.php',
                                beforeSend:function(){
                                    $("#busca").html('<img src="../images/spinner.gif"> Generando..');
                                },
				success: function(data){
						$('#mostrar_facturas').html(data);
                                                $("#busca").html('');
				}
			});
		return false;
}
function Consultas_items(id,nom){
    $('#controlador').html('<img src="../images/guardando.gif"> Cargando.......');
                $.ajax({
                type: 'GET',
                                data: 'emp='+id,
                url: '../vistas/facturasxempresas/lista_atencion.php',
                success: function(data){
                                    $('#titulo').html('Lista Consultas Externa sin facturar <input type="hidden"  id="empr" value="'+id+'" disabled><input type="text" id="nempr" value="'+nom+'" style="width:100%"  disabled>');
                    $('#controlador').html(data);
                                        $('#cargar').html('');
                                        numero_factura();
                }
            });   
}
function marcar(source) {
        checkboxes = document.getElementsByName('item'); //obtenemos todos los controles del tipo Input
        for (i=0;i<checkboxes.length;i++) { //recoremos todos los controles
                if (checkboxes[i].type === "checkbox") { //solo si es un checkbox entramos
                        checkboxes[i].checked = source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
            
        }
        }
        
}
function Facturar(){
    var emp = $("#empr").val();
        con = confirm("Esta seguro de Facturar estas consultas?");
    if(con){
        var tx = $("#pagos").val();
        var sub = $("#subpagos").val();
        var co = $("#copagos").val();
        var factura =  $("#factura").val();
   $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var precios = $("#precio"+id).val();
                                var copago = $("#copago"+id).val();
                                $.ajax({
				type: 'GET',
				data: 'id='+id+'&emp='+emp+'&fact='+factura+'&precio='+precios+'&copago='+copago+'&sw=13',
				url: '../vistas/facturasxempresas/acciones.php',
				success: function(){
                                    
                                } 
			});
		});
                $.ajax({
                            type: 'GET',
                            data: 'emp='+emp+'&factura='+factura+'&total='+tx+'&copago='+co+'&subpago='+sub+'&sw=15',
                            url: '../vistas/facturasxempresas/acciones.php',
                            success: function(){
                                alert("Se ha generado la factura No."+factura);
                                Listas_Facturas(1);
                            } 
                        });
                    }else{
                        return false;
                    }
}
function up_orden(){
    var emp = $("#empr").val();
    var nemp = $("#nempr").val();
        con = confirm("Esta seguro de Actualizar la Ordenes externas seleccionadas?");
    if(con){
        var tx = $("#pagos").val();
        var sub = $("#subpagos").val();
        var co = $("#copagos").val();
        var factura =  $("#factura").val();
   $("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                var precios = $("#precio"+id).val();
                                var copago = $("#copago"+id).val();
                                var oe = $("#oe"+id).val();
                                var pr = $("#pr"+id).val();
                                $.ajax({
				type: 'GET',
				data: 'id='+id+'&emp='+emp+'&fact='+factura+'&oe='+oe+'&pr='+pr+'&precio='+precios+'&copago='+copago+'&sw=16',
				url: '../vistas/facturasxempresas/acciones.php',
				success: function(){
                                    
                                } 
			});
		});
                alert("Se ha actualizado correctamente");
                Consultas_items(emp,nemp);
                    }else{
                        return false;
                    }
}

function imprimir_informe1(){
var n = $("#empresa").val();
var f1 = $("#f1").val();
var f2 = $("#f2").val();
var t = $("#tipo").val();
 window.open('../administrativo/informe_1_1.php?nombre='+n+'&tipo='+t+'&f1='+f1+'&f2='+f2,'Form','width=800,height=800');

}
function quitar(f,r){
    if(r!==0){
    $.ajax({
				type: 'GET',
                                data: 'fact='+f+'&sw=18',
				url: '../vistas/facturasxempresas/acciones.php',
				success: function(d){
                                    $("#"+f).html("0");
                                   //alert("Se quito la factura " + f);
                                } 
                            });
                        }else{
                            return false;
                        }
}
function Listas_Facturas2(page){
$('#controlador').html('<img src="../images/guardando.gif"> Cargando.......');
    			$.ajax({
				type: 'GET',
				url: '../vistas/facturas.php',
				success: function(data){
                                    $('#titulo').html('Lista de Facturas');
					$('#controlador').html(data);
                                        $('#cargar').html('');
				}
			});
}
function Imprimir_tiempo_gen(){
    var f1 = $("#fechauno").val();
    var f2 = $("#fechados").val();
    var pro = $("#pro").val();
        if(f1===''){
            alert("Debes de escoger la fecha inicial");
            $("#fechauno").focus();
            return false;
        }
        if(f2===''){
            alert("Debes de escoger la fecha inicial");
            $("#fechados").focus();
            return false;
        }
     window.open('../vistas/citas/tiempo_consulta_general.php?f1='+f1+'&f2='+f2+'&pro='+pro,'Form','width=1200,height=650');
}
function GenerarReporte(){
     var ano = $("#ano").val();
      var mes = $("#mes").val();
       var emp = $("#empresa").val();
        var usu = $("#usuario").val();
         var est = $("#estado").val();
    $.ajax({
				type: 'GET',
                                data:'ano='+ano+'&mes='+mes+'&emp='+emp+'&usu='+usu+'&est='+est,
				url: '../vistas/reportesate/reporte.php',
				success: function(data){
                                  
					$('#mostrar').html(data);
                                       
				}
			});
}
function GenerarReporteEfe(){
     var f1 = $("#f1").val();
      var f2 = $("#f2").val();
        var usu = $("#usuario").val();
         var est = $("#estado").val();
    $.ajax({
				type: 'GET',
                                data:'f1='+f1+'&f2='+f2+'&usu='+usu+'&est='+est,
				url: '../vistas/reportesate/reporte_efe.php',
				success: function(data){
                                  
					$('#mostrar_efe').html(data);
                                       
				}
			});
}