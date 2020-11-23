//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
     // 2- Insertar registro
        $('#Guardar').on('click', function(){

		var cod = $('#cod').val();  
                var bod = $('#bod').val(); 
                var obs = $('#obs').val(); 
                var est = $('#est').val(); 
                var sw = $('#sw').val();
//                var nal = $('#nal').val();
 
		if(bod.length>0 && est.length>0){
			$.ajax({
				type: 'GET',
				url: 'acciones.php?cod='+cod+'&bod='+bod+'&obs='+obs+'&est='+est+'&sw='+sw,
				success: function(data){

                                    if(data === 'existe'){
						$('#mensaje').html('<p class="alert alert-danger">Espere!!, Ya este registro existe en la base de datos.</p>');
					}else{
                                            if(data === '1'){
                                                alert('Se registro con exito '+bod+'');
                                               Limpiar_c();
                                               pasar();
                                               $('#ced').val('').focus();
                                            }else if(data === '2'){
                                                alert('Se edito con exito');
                                                pasar();
                                                
                                            }else{
                                                alert('No se pudo registrar, verifique haber llenado todos los campos'+data);
                                            }
                                        }
				}
			});
		}else{
			alert('Espere!!, tiene que ingresar todos los datos obligatorios.');
		}
	});
     // 4- Buscar en la tabla
        $('#buscar_caja').change(function(){
		var nombre = $(this).val();
		if(nombre.length>0){
			$.ajax({
				type: 'GET',
				data: 'nombre='+nombre+'&sw=2',
				url: '../vistas/bodegas/acciones.php',
				success: function(data){
					$('#mostrar').html(data);
				}
			});
		}else{
			 MostrarBodegas(1);
		}
	});

        $('#Eliminar').click(function(){
		var cod = $('#cod').val();
		BorrarBodega(cod,'int');
	});
        $("#Nuevo").click(function(){
            Limpiar_c();
        });

           $("#Salir").click(function(){
          window.close();
   });
});

function pasar(){
    window.opener.MostrarBodegas(1);
}
//mostrar tablas
function MostrarBodegas(page){

		$.ajax({
				type: 'GET',
				data: 'page='+page,
				url: '../vistas/bodegas/mostrar_tabla.php',
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
            var url = '../vistas/bodegas/acciones.php';
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
function formulario_bod(id){

    window.open('../vistas/bodegas/?id='+id,'Form','width=700,height=400');
   
}
function Llenar_bod(id){
    		$.ajax({
				type: 'POST',
                                url: 'consultar.php',
                                dataType:'json',
				data: 'id='+id,
				success: function(data){

                                                if(id=='0'){
                                                    Limpiar_c();
                                                   $("#cod").attr('disabled', false).focus();
                                                }else{
                                                    if(data[0] != null){
                                                      $("#cod").attr('disabled', true);
                                                    }else{
                                                         $('#cod').val(id);
                                                         $('#sw').val(0);
                                                         $('#bod').focus();
                                                    }
                                                }
                                                $('#cod').val(id);
                                                $('#obs').val(data[4]);
                                                $('#est').val(data[3]);
                                                $('#bod').val(data[2]);
                                                $('#sw').val(1);
				}
			});
		return false;
}
function Limpiar_c() {

                    $('#sw').val('0');
                    $('#cod').val('');
                    limpiar_alm();

}
function limpiar_alm(){
    		$('#alm').val('');
                $('#nal').val('');
                $("#cod").attr('disabled', false).focus();
                $('#bod').val(''); 
                $('#ccc').val(''); 
                $('#ncc').val(''); 
                $('#obs').val(''); 
                $('#est').val(''); 
}
function pagina(page,sw){
		$.ajax({
				type: 'GET',
				data: 'page='+page,
				url: 'paginacion.php',
				success: function(data){
                                    var array = eval(data);
			                        $('#paginacion').html(array[0]);
                                                if(sw === 1){
						Llenar_bod(array[1]);
                                                }
				}
			});
		return false;
}