//----------------------------------- Modulo de Clientes---------------------------
$(function() {
    $('#Add_Insumo').on('click',function(){
        var orden = $('#orden').val();
        var cod = $('#codi').val();
        var stock = $('#stock').val();
        var cant = $('#cant').val();
        var arc = $('#arc').val();
        var sw = $('#sw').val();
        var bod = $('#bod').val();
        var inv = $('#inv').val();
        var fac = $('#fac').val();
        $('#Add_Insumo').attr("disabled", true);
        $('#desc').html('<img src="../images/guardando.gif"> Guardando..');
        if(inv==='Si'){
        if(parseInt(cant)>parseInt(stock)){
            alert('La cantidad solicitada supera el stock actual');
            $('#cant').val('').focus();
            return false;
        }}
        if(cod==='' || cant===''){
            $('#msg').html('Llene todos los campos').show(200).delay(2500).hide(200);
            return false;
        }
        $.ajax({
                type: 'GET',
                data: 'cod='+cod+'&orden='+orden+'&bod='+bod+'&cant='+cant+'&inv='+inv+'&fac='+fac+'&arc='+arc+'&sw='+sw,
                url: '../vistas/ordenes/acciones.php',
                success: function(data){

                        if(data==='1'){
                            $('#msg').html('Se ingreso con exito').show(200).delay(2500).hide(200);
                        }else{
                            $('#msg').html('Se edito con exito').show(200).delay(2500).hide(200);
                        }
                        $('#codi').val('').focus();
                        $('#cant').val('');
                        $('#stock').val('');
                        $('#desc').html('');
                        if(sw==='0' || sw==='1'){
                             mostrar_insumos(arc); 
                        }else{
                             mostrar_medicamentos(arc); 
                        }
                       $('#Add_Insumo').attr("disabled", false);
                }
		});
        	
    });
             $('#codi').change(function(){
                var sw = $('#sw').val();
		var cod = $('#codi').val();
                if(sw==='0'){
                    var url = '../vistas/ordenes/consulta.php';
                }else{
                    var url = '../vistas/ordenes/consultam.php';
                }
			$.ajax({
				type: 'GET',
				data: 'cod='+cod+'',
                                dataType:'json',
				url: url,
				success: function(data){
					$('#stock').val(data[0]);
                                        $('#desc').html('Descripcion: '+data[1]);
				}
			});
		
	});
                     $('#buscar').on('click',function(){
		     var cod = $('#sw').val();
	             if(cod==='2'){
                         window.open('../popup/medicinas.php','med','width=400, height=400');
                     }else{
                         window.open('../popup/insumos.php','med','width=400, height=400');
                     }
                 });

});
function insumos_add(orden,archivo,t,m,f){
   $('#modalMed').modal({
			show:true,
			backdrop:'static'
		});
                $('#ins').focus();
                $('#orden').val(orden);
                $('#arc').val(archivo);
                $('#fac').val(f);
                if(f!==0){
                    $('#m').html('Recuerde Actualizar su factura si va a agregar mas productos');
                }else{
                    $('#m').html('<b bgcolor="red">Sin Facturar</b>');
                }
                tablas_all(t,m,f);
   
}
function medicinas_add(orden,archivo,t,m,f){
   $('#modalMed').modal({
			show:true,
			backdrop:'static'
		});
                $('#med').focus();
                $('#orden').val(orden);
                $('#arc').val(archivo);
                $('#fac').val(f); 
                if(f!==0){
                    $('#m').html('Recuerde Actualizar su factura si va a agregar mas productos');
                }else{
                     $('#m').html('<b bgcolor="red">Sin Facturar</b>');
                }
                tablas_all(t,m);
   
}
function mostrar_insumos(arc){
            $.ajax({
                type: 'GET',
                data: 'arc='+arc+'',
                url: '../funciones/insumos.php',
                success: function(data){
                        $('#lista_insumos').html(data);
                }
		});
}
function mostrar_medicamentos(arc){
            $.ajax({
                type: 'GET',
                data: 'arc='+arc+'',
                url: '../funciones/medicinas.php',
                success: function(data){
                        $('#lista_medicina').html(data);
                }
		});
}
function tablas_all(t,m){
            $.ajax({
                type: 'POST',
                url: '../vistas/ordenes/tablas.php',
                dataType:'json',
                data: 't='+t+'&m='+m,
                success: function(data){
                        $('#tabla_all').html(data[0]);
                        $('#bod').val(data[1]);
                        $('#inventario').html(data[2]);
                }
		});
}
function insumos_del(id, arc, orden,inv){
      var conf =  confirm("Desea Eliminar este Items?");
    if(conf){
            $.ajax({
                type: 'GET',
                data: 'arc='+arc+'&id='+id+'&inv='+inv+'&orden='+orden+'&sw=1',
                 url: '../vistas/ordenes/acciones.php',
                success: function(data){
                        mostrar_insumos(arc);
                }
		});
            }return false;
}
function medicinas_del(id, arc, orden,inv){
      var conf =  confirm("Desea Eliminar este Items?");
    if(conf){
            $.ajax({
                type: 'GET',
                data: 'arc='+arc+'&id='+id+'&inv='+inv+'&orden='+orden+'&sw=3',
                 url: '../vistas/ordenes/acciones.php',
                success: function(data){

                        mostrar_medicamentos(arc);
                }
		});
            }return false;
}
function insumos_up(cod, arc, orden,fac,inv){
    $('#modalMed').modal({
			show:true,
			backdrop:'static'
		});
                $('#orden').val(orden);
                $('#arc').val(arc);
                $('#cant').focus();
                $('#bod').val(1);
                $('#fac').val(fac);
                 if(inv===0){
                      $('#inventario').html('<input type="text"  id="inv" disabled value="Si" style="width:40px"/>');
                 }else{
                     $('#inventario').html('<input type="text"  id="inv" disabled value="No" style="width:40px"/>');
                 }
                $('#tabla_all').html('Cod. Insumo <input type="hidden" id="sw" value="0">');
                
           			$.ajax({
				type: 'GET',
				data: 'cod='+cod+'&arc='+arc,
                                dataType:'json',
				url: '../vistas/ordenes/consulta.php',
				success: function(data){
                                    
                                        $('#codi').val(data[2]);
					$('#stock').val(data[0]);
                                        
                                        $('#desc').html('Insumo a editar: '+data[1]);
                                        $('#msg').html('<b>Quite o Adicione la cantidad del insumo</b>');
				}
			});
}
function medicinas_up(cod, arc, orden,fac,inv){
    $('#modalMed').modal({
			show:true,
			backdrop:'static'
		});
                $('#orden').val(orden);
                $('#arc').val(arc);
                $('#cant').focus();
                $('#bod').val(2);
                $('#fac').val(fac);
                 if(inv===0){
                      $('#inventario').html('<input type="text"  id="inv" disabled value="Si" style="width:40px"/>');
                 }else{
                     $('#inventario').html('<input type="text"  id="inv" disabled value="No" style="width:40px"/>');
                 }
                $('#tabla_all').html('Cod. Medicamento <input type="hidden" id="sw" value="2">');
           			$.ajax({
				type: 'GET',
				data: 'cod='+cod+'&arc='+arc,
                                dataType:'json',
				url: '../vistas/ordenes/consultam.php',
				success: function(data){
                                    
                                        $('#codi').val(data[2]);
					$('#stock').val(data[0]);
                                        
                                        $('#desc').html('Insumo a editar: '+data[1]);
                                        $('#msg').html('<b>Quite o Adicione la cantidad del medicamento</b>');
				}
			});
}
function pasar_med(val1, val2, val3){
    $('#codi').val(val1);
    $('#desc').val(val2);
    $('#stock').val(val3);
    
}