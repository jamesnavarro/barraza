//----------------------------------- Modulo de Clientes---------------------------
$(function() {
MostrarBloquedas(1);

        $('#interna').change(function(){
		MostrarBloquedas(1);
	});
        $('#estado').change(function(){
		MostrarAtenciones(1);
	}); 
        $('#empresa').change(function(){
		MostrarAtenciones(1);
	});
        $('#filas').change(function(){
		MostrarAtenciones(1);
	});
        
        $('#nombre').change(function(){
		MostrarAtenciones(1);
	});
         $('#apellido').change(function(){
		MostrarAtenciones(1);
	});
        $('#interna').change(function(){
		MostrarAtenciones(1);
	});
        $('#externa').change(function(){
		MostrarAtenciones(1);
	});
         $('#interno').change(function(){
		MostrarAtenciones(1);
	});
         $('#externo').change(function(){
		MostrarAtenciones(1);
	});
         $('#documento').change(function(){
		MostrarAtenciones(1);
	});
         $('#facturadas').change(function(){
		MostrarAtenciones(1);
	});
         $('#revisadas').change(function(){
		MostrarAtenciones(1);
	});
         $('#asignado').change(function(){
		MostrarAtenciones(1);
	});
        $('#mun').change(function(){
		MostrarAtenciones(1);
	});
        $('#bcov').change(function(){
		MostrarAtenciones(1);
	});
        $('#btom').change(function(){
		MostrarAtenciones(1);
	});
        $('#bres').change(function(){
		MostrarAtenciones(1);
	});
        $("#Nuevo").click(function(){
            Limpiar_us();
           
        });
        $("#ced").change(function(){
            var ced = $(this).val();
		Llenar_pac(ced);
           
        });
});

function MostrarAtenciones(page){
    
    var externa = $('#externa').val();
    var est = $('#estado').val();
    var doc = $('#documento').val();
    var fac = $('#facturadas').val();
    var nom = $('#nombre').val();
    var ape = $('#apellido').val();
    var asi = $('#asignado').val();
    var emp = $('#empresa').val();
    var desde = $('#desde').val();
    var hasta = $('#hasta').val();
    var rev = $('#revisadas').val();
    var interna = $('#interna').val();
    var bcov = $('#bcov').val();
    var btom = $('#btom').val();
    var bres = $('#bres').val();
     var mun = $('#mun').val();
    $.ajax({
        beforeSend:function(){
        if(est===0){
            $('#facturadas').val('activa');
        }
                             }
    });
       var admin = $('#permiso').val();

var filas = $('#filas').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&bcov='+bcov+'&btom='+btom+'&bres='+bres+'&mun='+mun+'&admin='+admin+'&desde='+desde+'&filas='+filas+'&hasta='+hasta+'&revisadas='+rev+'&user='+asi+'&facturadas='+fac+'&cedula='+doc+'&externa='+externa+'&interna='+interna+'&nombre='+nom+'&apellido='+ape+'&estado='+est+'&empresa='+emp,
				url: '../vistas/atenciones/mostrar_tabla.php',
                                beforeSend:function(){
                                    $('#cargar').html('<img src="../imagenes/spinner.gif">');
                                },
				success: function(data){

						$('#mostrar').html(data);
                                                $('#cargar').html('');
				}
			});
		return false;
}
// eliminar registros de la tabla
function cambiar_est(oi){
    var conf =  confirm("Desea Anular esta Orden este Items?");
    if(conf){
        var causa = prompt("Por que se anulo?");
        $.ajax({
				type: 'GET',
				data: 'orden='+oi+'&causa='+causa+'&sw=4',
				url: '../vistas/atenciones/acciones.php',
				success: function(data){
                                            $("#d"+oi).html(causa);
                                                alert('Se ha anulado con exito.'+data);
                                            
                                } 
			});
    }
}
function BorrarCliente(codigo,sitio){
  var conf =  confirm("Desea Eliminar este Items?");
    if(conf){
        if(sitio == 'int'){
            var url = 'acciones.php';
        }else{
            var url = '../vistas/atenciones/acciones.php';
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
                                                MostrarAtenciones(1);
                                            }
                                } 
			});
                    }
		return false;
}
function formulario_cl(id,emp){
   
    window.open('../vistas/atenciones/?id='+id+'&emp='+emp,'Form','width=900,height=650');
   
}
function pasar_empleado(val1, val2, val3, val4){
    $('#use').val(val1);
    $('#ced').val(val2);
    $('#tno').val(val3);
    $('#tap').val(val4);
    
}
function Llenar_pac(id){
    		$.ajax({
				type: 'POST',
                                url: 'consultar.php',
                                dataType:'json',
				data: 'id='+id,
				success: function(data){
						$('#ced').val(data[0]);
                                                if(id=='0'){
                                                   $("#ced").attr('disabled', true).focus();
                                                   Limpiar_us();
                                                   
                                                }else{
                                                    if(data[0] != null){
                                                      $("#ced").attr('disabled', true);
                                                      $('#sw').val(1);
                                                     
                                                    }else{
                                                         $('#ced').val(id);
                                                         $('#sw').val(0);
                                                         $('#nom').focus();
                                                          
                                                    }
                                                }
                                                $('#nom').val(data[1]);
                                                $('#dir').val(data[2]);
                                                $('#tel').val(data[3]);
                                                $('#fam').val(data[4]);
                                                $('#tfa').val(data[5]);
                                                $('#fin').val(data[6]);
                                                $('#fde').val(data[7]);
                                                $('#empresa').val(data[8]);
                                                $('#dep').val(data[9]);
                                                $('#mun').val(data[10]);
                                                $('#bar').val(data[10]);
                                                $('#est').val(data[11]);
                                                $('#obs').val(data[12]);
                                                $('#sub').val(data[13]);
                                                $('#no2').val(data[14]);
                                                $('#ape').val(data[15]);
                                                $('#ap2').val(data[16]);
                                                $('#cel').val(data[17]);
                                                $('#depo').val(data[18]);
                                                $('#enf').val(data[19]);
                                                

				}
			});
		return false;
}
function limpiar_atenciones(){
    $('#externa').val('');
    $('#estado').val('');
    $('#documento').val('');
    $('#facturadas').val('');
    $('#nombre').val('');
    $('#asignado').val('');
    $('#empresa').val('');
    $('#desde').val('');
    $('#hasta').val('');
    $('#revisadas').val('');
    $('#interna').val('');
                MostrarAtenciones(1);
              
}
function pagina(page,sw){
    var emp = $('#emp').val();
		$.ajax({
				type: 'POST',
				data: 'page='+page+'&emp='+emp,
				url: 'paginacion.php',
				success: function(data){
                                    var array = eval(data);
			                        $('#paginacion').html(array[0]);
                                                if(sw === 1){
						Llenar_pac(array[1]);
                                                }
				}
			});
		return false;
}
function list_user(){
     window.open('../vistas/a_usuarios.php','Form','width=900,height=650');
   
}
function profesional(u){
    $('#asignado').val(u);
    MostrarBloquedas(1);
}
function MostrarBloquedas(page){
    var interna = $('#interna').val();
    var externa = $('#externa').val();
    var fecha = $('#fecha').val();
    var usuario = $('#asignado').val();
    var atencion = $('#atencion').val();
    var paciente = $('#paciente').val();

		$.ajax({
				type: 'GET',
				data: 'page='+page+'&atencion='+atencion+'&paciente='+paciente+'&usuario='+usuario+'&externa='+externa+'&interna='+interna+'&fecha='+fecha+'&sw=5',
				url: '../vistas/atenciones/acciones.php',
                                beforeSend:function(){
                                    $('#cargar').html('<img src="../imagenes/spinner.gif">');
                                },
				success: function(data){
                                    console.log(data);
						$('#mostrar_bloqueadas').html(data);
                                                $('#cargar').html('');
				}
			});
		return false;
}
function pasar(oi,fv){
    $('#oi').val(oi);
    $('#fv').val(fv);
}
function update_orden(){
    var oi = $('#oi').val();
    var fv = $('#fv').val();
    if(fv==''){
        alert("Debes de digitar la fecha de vencimiento");
        return false;
    }
    		$.ajax({
				type: 'GET',
				data: 'oi='+oi+'&fv='+fv+'&sw=6',
				url: '../vistas/atenciones/acciones.php',
				success: function(data){
                                    alert("Se actualizo con exito "+data);
                                    MostrarBloquedas(1);
				}
			});
}