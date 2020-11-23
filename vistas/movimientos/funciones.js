//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
       $('#mostrar').load('../vistas/movimientos/mostrar_tabla.php');
        $('#Guardar').on('click', function(){
		var mov = $('#mov').val(); 
                var save = $('#save').val();
			$.ajax({
				type: 'GET',
				url: 'acciones.php?mov='+mov+'&sw=9',
				success: function(data){
                                    if(save==='0'){
                                        alert('Se guardo con exito');
                                    }else{
                                        alert('ya este movimiento se ha guardado');
                                    }
                                     paginax(0,mov);
                                    
				}
			});
	});
                $('#Editar').on('click', function(){
		var mov = $('#mov').val(); 
                var grupo = $('#grupo').val();
                if(grupo==='Factura'){
			$.ajax({
				type: 'GET',
				url: 'acciones.php?mov='+mov+'&sw=10',
				success: function(data){
                                    
                                        alert('ya puede editar el documento');
                                   
                                     paginax(0,mov);
                                     $('#cod').attr('disabled', false); 
                                  $('#can').attr('disabled', false); 
                                    
				}
			});
                    }else{
                        alert('No puede editar este documento, solo puede editar Facturas de compras');
                        return false;
                    }
	});
     // 4- Buscar en la tabla
        $('#doc').change(function(){
		 MostrarBodegas(1);
	});
          $('#bode').change(function(){
		 MostrarBodegas(1);
	});
         $('#bodega').change(function(){
		 MostrarProductos();
	});
        $('#movimiento').change(function(){
		 MostrarProductos();
	});
        $('#producto').change(function(){
		 MostrarProductos();
	});
        $('#usuario').change(function(){
		 MostrarProductos();
	});
        $('#fi').change(function(){
		 MostrarProductos();
	});
        $('#ff').change(function(){
		 MostrarProductos();
	});
          $('#tipo').change(function(){
		 MostrarBodegas(1);
	});
        $('#estado').change(function(){
		 MostrarProductos();
	});
        $('#documento').change(function(){
		 MostrarProductos();
	});
        $('#reporte').change(function(){
		 MostrarProductos();
	});
        $('#st').change(function(){
		 MostrarProductos();
	});
        $('#con').change(function(){
		 MostrarProductos();
	});

        $('#buscar_fecha').click(function(){
              var fi = $('#fi').val(); 
              var ff = $('#ff').val();
              if(fi!=='' && ff!==''){
		 MostrarBodegas(1);
              }else{
                  alert('Seleccione el rango de fecha');
              }
	});
        $("#Nuevo").click(function(){
           limpiar_mov();
        });

           $("#Salir").click(function(){
          window.close();
   });
        $("#bod").change(function(){
               add_movimiento();
        });
        $("#agregar").click(function(){
                var cod = $('#cod').val();
                var can = $('#can').val();
                var costo = $('#costo').val();
                var mov = $('#mov').val();
                if(cod===''){
                    alert('Digite el codigo');
                    $('#cod').focus();
                    return false;
                }
                if(can===''){
                    alert('Digite la cantidad');
                    $('#can').focus();
                    return false;
                }
                if(costo===''){
                    alert('Digite el costo');
                    $('#costo').focus();
                    return false;
                }
               agregar_mov(mov);
        });
            $('#buscar').on('click',function(){
		     var cod = $('#bod').val();
	             if(cod==='2'){
                         window.open('../../popup/medicinas.php','med','width=400, height=400');
                     }else{
                         window.open('../../popup/insumos.php','med','width=400, height=400');
                     }
              });
});
function pasar_med(val1, val2, val3){
    $('#cod').val(val1);
    $('#prod').val(val2);
    $('#stock').val(val3);
    $('#can').focus();
    
}
function pasar(){
    window.opener.MostrarBodegas(1);
}
function ver_movimientos(id){
    window.open('../vistas/movimientos/?id='+id,'Mov','width=800, height=600');
}
//mostrar tablas
function MostrarBodegas(page){
var doc = $('#doc').val();
var tip = $('#tipo').val();
var bod = $('#bode').val();
var fi = $('#fi').val();
var ff = $('#ff').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&doc='+doc+'&tip='+tip+'&bod='+bod+'&fi='+fi+'&ff='+ff,
				url: '../vistas/movimientos/mostrar_tabla.php',
				success: function(data){
						$('#mostrar').html(data);		
				}
			});
		return false;
}
function BorrarBodega(codigo,sitio){
  var conf =  confirm("Desea Eliminar este Items?");
    if(conf){
        if(sitio == 'int'){
            var url = 'acciones.php';
        }else{
            var url = '../vistas/movimientos/acciones.php';
        }
		$.ajax({
				type: 'GET',
				data: 'codigo='+codigo+'&sw=3',
				url: url,
				success: function(data){
                                    
                                            if(data=='1'){
						alert('Registro eliminado con exito.');
                                            }else{
                                                alert('No se puede eliminar este registro.');
                                            }
                                            if(sitio == 'int'){
                                                pasar();
                                                Limpiar_c();
                                            }else{
                                                MostrarBodegas(1);
                                            }
                                } 
			});
                    }
		return false;
}
function add_movimiento(){
  var conf =  confirm("Desea Generar este movimiento?");
    if(conf){
        var gru =  $('#grupo').val();
        var doc =  $('#docx').val();
        var fec =  $('#fec').val();
        var tip =  $('#tip').val();
        var pro =  $('#pro').val();
        var use =  $('#use').val();
        var bod =  $('#bod').val();
		$.ajax({
				type: 'GET',
				data: 'gru='+gru+'&doc='+doc+'&fec='+fec+'&tip='+tip+'&pro='+pro+'&use='+use+'&bod='+bod+'&sw=6',
				url:  'acciones.php',
				success: function(data){
                                        $('#mov').val(data);
                                        $('#cod').attr('disabled', false).focus();
                                        $('#prod').attr('disabled', false);
                                        $('#can').attr('disabled', false);
                                        $('#bod').attr('disabled', true);       
                                } 
			});
                    }else{
                        $('#bod').val('');
                    }
		return false;
}
function delmov(id,ca,mov,cod){
  var conf =  confirm("Desea anular este items?");
    if(conf){
    var save = $('#save').val();
    var bod = $('#bod').val();
		$.ajax({
				type: 'GET',
				data: 'id='+id+'&can='+ca+'&mov='+mov+'&cod='+cod+'&bod='+bod+'&sw=8',
				url:  'acciones.php',
				success: function(data){
                                       
                                       MostrarMov(mov,bod,save);
                                } 
			});
                    }
		return false;
}

function ver_productos(){
   
    window.open('../vistas/movimientos/productos.php','Form','width=1000,height=600');
   
}
function imprimir(){
    var cod = $('#mov').val();
    var doc = $('#docx').val();
    window.open('../../reporte.php?id='+cod+'&imp='+doc,'Reporte','width=1000,height=600');
}
function Limpiar_c() {

                    $('#sw').val('0');
                    $('#cod').val('');
                    limpiar_alm();

}

function paginax(page,id){

		$.ajax({
				type: 'GET',
				data: 'page='+page+'&id='+id,
				url: 'paginacion.php',
				success: function(data){
                                    
                                                 
                                                 var array = eval(data);
			                        $('#paginacion').html(array[0]);
                                                 $('#docx').val(array[2]).attr('disabled', true);
                                                 $('#tip').val(array[3]).attr('disabled', true);
                                                 $('#use').val(array[4]).attr('disabled', true);
                                                 $('#fec').val(array[5]).attr('disabled', true);
                                                 $('#bod').val(array[6]).attr('disabled', true);
                                                 $('#pro').val(array[7]).attr('disabled', true);
                                                 $('#mov').val(array[1]).attr('disabled', true);
                                                 $('#grupo').val(array[8]).attr('disabled', true);
                                                 $('#save').val(array[9]).attr('disabled', true);
                                                 if(array[9]==='1'){
                                                 $('#cod').attr('disabled', true);
                                                 $('#prod').attr('disabled', true);
                                                 $('#can').attr('disabled', true);
                                                 $('#costo').attr('disabled', true);
                                                 }else{
                                                 $('#cod').attr('disabled', false);
                                                 $('#prod').attr('disabled', false);
                                                 $('#can').attr('disabled', false);
                                                 $('#costo').attr('disabled', false);
                                                 }
                                                 $('#Guardar').attr('disabled', true);
                                                 if(id===-1){
                                                     limpiar_mov();
                                                 }else{
                                                     MostrarMov(array[1],array[6],array[9]);
                                                 }
                                                
				}
			});
		return false;
            
}
function limpiar_mov(){

    		$('#mov').val('');
                $('#docx').val('').attr('disabled', false);
                $("#docx").attr('disabled', false).focus();
                $('#tip').val('1').attr('disabled', false); 
                $('#pro').val('').attr('disabled', false); 
                $('#bod').val('').attr('disabled', false); 
                $('#costo').val('').attr('disabled', false);
                 $('#grupo').attr('disabled', true).val('Factura');
                var f = $('#reg').val(); 
                 var u = $('#user').val();
                 $('#use').val(u); 
                $('#fec').val(f); 
                 $('#save').val('0'); 
                $('#detalles').html(''); 
                

}
function MostrarMov(id,bod,save){
		$.ajax({
				type: 'GET',
				data: 'idm='+id+'&bod='+bod+'&save='+save,
				url: 'mostrar_detalles.php',
				success: function(data){
						$('#detalles').html(data);		
				}
			});
		return false;
}
function MostrarProductos(){
    var bod = $('#bodega').val();
    var mov = $('#movimiento').val();
    var pro = $('#producto').val();
    var use = $('#usuario').val();
    var fi = $('#fi').val();
    var ff = $('#ff').val();
    var est = $('#estado').val();
    var doc = $('#documento').val();
    var rep = $('#reporte').val();
    var tip = $('#tipo').val();
    var st = $('#st').val();
    var con = $('#con').val();
    if(bod===''){
        alert('Seleccione la bodega');
        $('#bodega').focus();
        return false;
    }
    if(mov===''){
        $('#movimiento').focus();
        return false;
    }
    if(fi===''){
        $('#fi').focus();
        return false;
    }
        if(ff===''){
        $('#ff').focus();
        return false;
    }
		$.ajax({
				type: 'GET',
				data: 'mov='+mov+'&st='+st+'&con='+con+'&rep='+rep+'&tip='+tip+'&doc='+doc+'&est='+est+'&bod='+bod+'&pro='+pro+'&use='+use+'&fi='+fi+'&ff='+ff,
				url: 'movimiento_producto.php',
				success: function(data){
						$('#detalles_pro').html(data);	
                                                $('#imp').html('<button type="button" onclick="Imprimir()"> Descargar Excel</button>');
				}
			});
		return false;
}
function Imprimir(){
    var bod = $('#bodega').val();
    var mov = $('#movimiento').val();
    var pro = $('#producto').val();
    var use = $('#usuario').val();
    var fi = $('#fi').val();
    var ff = $('#ff').val();
    var est = $('#estado').val();
    var doc = $('#documento').val();
    var rep = $('#reporte').val();
    var tip = $('#tipo').val();
    var st = $('#st').val();
    var con = $('#con').val();
    window.open('exportar_excel.php?mov='+mov+'&con='+con+'&st='+st+'&rep='+rep+'&tip='+tip+'&doc='+doc+'&est='+est+'&bod='+bod+'&pro='+pro+'&use='+use+'&fi='+fi+'&ff='+ff,'Reporte','width=600,height=200');

}
function agregar_mov(movi){

    var cod = $('#cod').val();
    var can = $('#can').val();
    var costo = $('#costo').val();
    var use = $('#usen').val();
    var fec = $('#fec').val();
        var bod = $('#bod').val();
        var tip = $('#tip').val();
		$.ajax({
				type: 'GET',
				data: 'movi='+movi+'&can='+can+'&tip='+tip+'&costo='+costo+'&cod='+cod+'&use='+use+'&bod='+bod+'&fec='+fec+'&sw=7',
				url: 'acciones.php',
				success: function(d){
                                    alert(d);
                                    $('#cod').val('').focus();
                                    $('#prod').val('');
                                    $('#can').val('');
                                    $('#costo').val('');
                                    $('#stock').val('');
			            MostrarMov(movi,bod);	
				}
			});
		return false;
}

