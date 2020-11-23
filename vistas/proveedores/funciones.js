//----------------------------------- Modulo de Clientes---------------------------
$(function() {
        	$('#NuevoMov').on('click', function(){
		$('#modalMov').modal({
			show:true,
			backdrop:'static',
		});
                MostrarMov(1);
	});
            $("#dep").change(function () {
   		$("#dep option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../../combos/ciudades_1.php", { elegidoc: elegidoc }, function(data){
				$("#mun").html(data);
				
			});			
        });
   });
   $("#Salir").click(function(){
          window.close();
   });
        $('#Guardar').on('click', function(){
		var nit = $('#nit').val();  
                var nom = $('#nom').val(); 
                var dir = $('#dir').val(); 
                var dep = $('#dep').val(); 
                var mun = $('#mun').val(); 
                var tel = $('#tel').val(); 
                var con = $('#con').val(); 
                var tco = $('#tco').val(); 
                var em1 = $('#em1').val(); 
                var em2 = $('#em2').val(); 
                var obs = $('#obs').val();
                var ban = $('#ban').val();
                var num = $('#num').val();
                var sw = $('#sw').val();

		if(nom.length>0 && nit.length>0 && tel.length>0 && em1.length>0){
			$.ajax({
				type: 'GET',
				url: 'acciones.php?nit='+nit+'&ban='+ban+'&num='+num+'&nom='+nom+'&dir='+dir+'&dep='+dep+'&mun='+mun+'&tel='+tel+'&con='+con+'&tco='+tco+'&em1='+em1+'&em2='+em2+'&obs='+obs+'&sw='+sw,
				success: function(data){
                                    if(data === 'existe'){
						$('#mensaje').html('<p class="alert alert-danger">Espere!!, Ya este cliente existe en la base de datos.</p>');
					}else{
                                            if(data == '1'){
                                                alert('Se registro con exito '+nom+'');
                                               limpiar_usu();
                                               pasar();
                                               $('#sw').val(1);
                                               $('#cod').val('').focus();
                                            }else if(data == '2'){
                                                alert('Se Edito con exito');
                                                pasar();
                                            }else{
                                                alert('No se pudo registrar, verifique haber llenado todos los campos');
                                            }
                                        }
				}
			});
                       
		}else{
			alert('Espere!!, tiene que ingresar todos los datos.');
		}
	});
       $('#Add_Mov').on('click', function(){
		var mov = $('#mov').val();  
                var idm = $('#idm').val();
                var sw = $('#sw').val();
		if(mov.length>0){
			$.ajax({
				type: 'GET',
				url: '../vistas/proveedores/acciones.php?mov='+mov+'&idm='+idm+'&sw='+sw,
				success: function(data){
                                    if(data === 'existe'){
						$('#mensajem').html('<p class="alert alert-danger">Ya esta descripcion existe.</p>');
					}else{
                                            if(data == '1'){
                                                alert('Se registro con exito '+mov+'');
                                               $('#mov').val('').focus();
                                               $('#sw').val(5);
                                               MostrarMov(1);
                                            }else if(data == '2'){
                                                alert('Se Edito con exito');
                                                $('#mov').val('').focus();
                                                 $('#sw').val(4);
                                                  $('#idm').val('');
                                                MostrarMov(1);
                                            }else{
                                                alert('No se pudo registrar, verifique haber llenado todos los campos');
                                            }
                                        }
				}
			});
                       
		}else{
			alert('Espere!!, tiene que ingresar todos los datos.');
		}
	});
     // 4- Buscar en la tabla
        $('#buscar_cliente').change(function(){
		var nombre = $(this).val();
		if(nombre.length>0){
			$.ajax({
				type: 'GET',
				data: 'nombre='+nombre+'&sw=2',
				url: '../vistas/proveedores/acciones.php',
				success: function(data){
					$('#mostrar').html(data);
				}
			});
		}else{
			 MostrarClientes(1);
		}
	});
        $('#nit').change(function(){
		var cod = $(this).val();
		Llenar_cli(cod);
	});  
        $('#Eliminar').click(function(){
		var cod = $('#nit').val();
		BorrarCliente(cod,'int');
	});
        $("#Nuevo").click(function(){
            Limpiar_us();
           
        });
        $("#ced").change(function(){
            var ced = $(this).val();
		if(ced.length>0){
			$.ajax({
				type: 'POST',
                                url: 'consultar_ced.php',
                                dataType:'json',
				data: 'id='+ced,
				success: function(data){
                                    
					$('#use').val(data[0]);
                                        $('#tno').val(data[1]);
                                        $('#tap').val(data[2]);
				}
			});
		}else{
			$('#use').val('');
                        $('#tno').val('');
                        $('#tap').val('');
		}
           
        });
});
function pasar(){
    window.opener.MostrarClientes(1);
}
function Limpiar_us() {
    $.ajax({	
            url: 'ultimo.php',
            success: function(data){
                    $('#cod').val(data);
                    $('#sw').val('0');
                    limpiar_usu();
            }
	});
}
function MostrarMov(page){
		$.ajax({
				type: 'GET',
				data: 'page='+page,
				url: '../vistas/proveedores/tabla_parametros.php',
				success: function(data){
						$('#lista_mov').html(data);
						
				}
			});
		return false;
}
//mostrar tablas
function MostrarClientes(page){
    var nombre = $('#buscar_cliente').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&nombre='+nombre,
				url: '../vistas/proveedores/mostrar_tabla.php',
				success: function(data){
						$('#mostrar').html(data);
						
				}
			});
		return false;
}
// eliminar registros de la tabla
function BorrarCliente(codigo,sitio){
  var conf =  confirm("Desea Eliminar este Items?");
    if(conf){
        if(sitio == 'int'){
            var url = 'acciones.php';
        }else{
            var url = '../vistas/proveedores/acciones.php';
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
                                                limpiar_usu();
                                            }else{
                                                MostrarClientes(1);
                                            }
                                } 
			});
                    }
		return false;
}
function formulario_pr(id){
   
    window.open('../vistas/proveedores/?id='+id,'Form','width=600,height=650');
   
}
function pasar_empleado(val1, val2, val3, val4){
    $('#use').val(val1);
    $('#ced').val(val2);
    $('#tno').val(val3);
    $('#tap').val(val4);
    
}
function Llenar_cli(id){
    		$.ajax({
				type: 'POST',
                                url: 'consultar.php',
                                dataType:'json',
				data: 'id='+id,
				success: function(data){
						$('#nit').val(data[0]);
                                                if(id=='0'){
                                                   $("#nit").attr('disabled', true).focus();
                                                   Limpiar_us();
                                                }else{
                                                    if(data[0] != null){
                                                      $("#nit").attr('disabled', true);
                                                      $('#sw').val(data[12]);
                                                    }else{
                                                         $('#nit').val(id);
                                                         $('#sw').val(0);
                                                         $('#nom').focus();
                                                    }
                                                }
                                                $('#nom').val(data[1]);
                                                $('#dir').val(data[2]);
                                                $('#tel').val(data[3]);
                                                $('#con').val(data[4]);
                                                $('#tco').val(data[5]);
                                                $('#em1').val(data[6]);
                                                $('#em2').val(data[7]);
                                                $('#obs').val(data[8]);
                                                $('#dep').val(data[9]);
                                                $('#mun').val(data[10]);
                                                $('#ban').val(data[14]);
                                                $('#num').val(data[15]);
                                                

				}
			});
		return false;
}
function EditarParametro(id){
    		$.ajax({
				type: 'POST',
                                url: '../vistas/proveedores/consultar_ced.php',
                                dataType:'json',
				data: 'id='+id,
				success: function(data){
						$('#idm').val(data[0]);
                                                $('#mov').val(data[1]);
                                                $('#sw').val(5);
                                                
				}
			});
		return false;
}
function limpiar_usu(){
                $('#nom').val(''); 
                $('#nit').attr('disabled', false);
                $('#nit').val(''); 
                $('#dir').val(''); 
                $('#dep').val(''); 
                $('#mun').val(''); 
                $('#tel').val(''); 
                $('#con').val(''); 
                $('#tco').val(''); 
                $('#obs').val('');
                $('#em1').val(''); 
                $('#em2').val(''); 
                $('#use').val(''); 
                $('#tno').val(''); 
                $('#ced').val('');
                
              

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
						Llenar_cli(array[1]);
                                                }
				}
			});
		return false;
}