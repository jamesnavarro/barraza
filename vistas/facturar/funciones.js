//----------------------------------- Modulo de Clientes---------------------------
function up_orden(id){
    var emp = $("#empr").val();
    var nemp = $("#nempr").val();

        var tx = $("#pagos").val();
        var sub = $("#subpagos").val();
        var co = $("#copagos").val();
        var factura =  $("#factura").val();
        var precios = $("#precio"+id).val();
        var copago = $("#copago"+id).val();
        //var copagos = $("#copagos").val();
        var cod = $("#co"+id).val();
        var de = $("#de"+id).val();
        var oe = $("#oe"+id).val();
        var pr = $("#pr"+id).val();
        var cop = $("#cop"+id).val();
        var c = confirm("Esta seguro de hacer este cambio?");
        if(c){
                        $.ajax({
				type: 'GET',
				data: 'id='+id+'&cod='+cod+'&emp='+emp+'&de='+de+'&cop='+cop+'&fact='+factura+'&oe='+oe+'&pr='+pr+'&precio='+precios+'&copago='+copago+'&sw=0',
				url: '../vistas/facturar/acciones.php',
				success: function(){
                                     alert("Se ha actualizado correctamente");
                                     MostrarEm();
                                } 
			});
                    }
}
// eliminar registros de la tabla
function BorrarCliente(codigo,sitio){
  var conf =  confirm("Desea Eliminar este Items?");
    if(conf){
        if(sitio == 'int'){
            var url = 'acciones.php';
//        }else{
            var url = '../vistas/clientes/acciones.php';
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
function formulario_cl(id,emp){
   
    window.open('../vistas/clientes/?id='+id+'&emp='+emp,'Form','width=900,height=650');
   
}
function formulario_sub(id,emp){
   
    window.open('../vistas/clientes/index_full.php?id='+id+'&emp='+emp,'Form','width=900,height=650');
   
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
                                                      
                                                     if(data[8]==='p' || data[8]==='P'){
                                                          $('#sw').val(1);
                                                     }else{
                                                          $('#sw').val(5);
                                                      }
                                                    }else{
                                                         $('#ced').val(id);
                                                         if(data[8]==='p' || data[8]==='P'){
                                                          $('#sw').val(0);
                                                     }else{
                                                          $('#sw').val(4);
                                                      }
                                                         $('#nom').focus();
                                                          
                                                    }
                                                }
                                                $('#nom').val(data[1]);
                                                $('#dir').val(data[2]);
                                                $('#tel').val(data[3]);
                                                $('#fam').val(data[4]);
                                                $('#tfa').val(data[5]);
                                                $('#fde').val(data[6]);
                                                $('#fin').val(data[7]);
                                                $('#empresa').val(data[8]);
                                                
                                                $('#dep').val(data[9]);
                                                $('#mun').val(data[10]);
                                                $('#bar').val(data[35]);
                                                $('#est').val(data[11]);
                                                $('#obs').val(data[12]);
                                                $('#sub').val(data[13]);
                                                $('#no2').val(data[14]);
                                                $('#ape').val(data[15]);
                                                $('#ap2').val(data[16]);
                                                $('#cel').val(data[17]);
                                                $('#depo').val(data[18]);
                                                $('#enf').val(data[19]);
                                                $('#uat').val(data[20]);
                                                $('#ual').val(data[21]);
                                                $('#regi').val(data[22]);
                                                $('#tipo').val(data[23]);
                                                $('#sexo').val(data[24]);
                                                $('#naci').val(data[25]);
                                                 $('#civi').val(data[26]);
                                                  $('#ocup').val(data[27]);
                                                  $('#aco2').val(data[28]);
                                                  $('#tela').val(data[29]);
                                                  $('#par2').val(data[30]);
                                                  $('#pare').val(data[31]);
                                                  $('#enf2').val(data[32]);
                                                  $('#obs2').val(data[33]);
                                                  $('#prof').val(data[34]);
                                                  $('#email').val(data[36]);
                                                $('#doc').val(data[37]);
                                                $('#edad').val(data[38]);
                                                $('#zona').val(data[39]);
                                                 $('#cont').val(data[40]);
                                                 ver_condiciones(data[0]);

				}
			});
	
}
function limpiar_usu(){
    var em =  $('#emp').val();
    if(em==='p'){
        $('#sw').val(0);
    }else{
        $('#sw').val(4);
    }
                $("#ced").attr('disabled', false);
                $('#ced').val('').focus();
                $('#nom').val(''); 
                $('#no2').val('');
                $('#uat').val('');
                $('#ual').val('');
                $('#ape').val('');
                $('#ap2').val('');
                $('#dir').val(''); 
                $('#dep').val(''); 
                $('#mun').html('<option value="">Seleccione</option>'); 
                $('#tel').val(''); 
                $('#cel').val('');
                $('#fam').val(''); 
                $('#tfa').val(''); 
                $('#fin').val(''); 
                $('#fde').val(''); 
                $('#empresa').val('');
                $('#est').val('Activo');
                $('#depo').val('');
                $('#sub').val('');
                $('#enf').val('');
                $('#obs').val('');
                
                $('#regi').val('');
                $('#tipo').val('');
                $('#doc').val('');
                $('#sexo').val('');
                $('#naci').val('');
                $('#civi').val('');
                $('#ocup').val('');
                $('#bar').val('');
                $('#email').val('');
                $('#pare').val('');
                $('#par2').val('');
                $('#aco2').val('');
                $('#tela').val('');
                $('#enf2').val('');
                $('#obs2').val('');
                $('#prof').val('');
                
              
}
function pagina(page,sw){
    var emp = $('#emp').val();
		$.ajax({
				type: 'GET',
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
function add_condiciones(){
    var idcon = $('#idcon').val();
    var ced = $('#ced').val();
    var con1 = $('#cond1').val();
    var obs1 = $('#obser1').val();
    var con2 = $('#cond2').val();
    var obs2 = $('#obser2').val();
    var con3 = $('#cond3').val();
    var obs3 = $('#obser3').val();
    var con4 = $('#cond4').val();
    var obs4 = $('#obser4').val();
    var con5 = $('#cond5').val();
    var obs5 = $('#obser5').val();
    var con6 = $('#cond6').val();
    var obs6 = $('#obser6').val();
    var con7 = $('#cond7').val();
    var obs7 = $('#obser7').val();
    var con8 = $('#cond8').val();
    var obs8 = $('#obser8').val();
    var con9 = $('#cond9').val();
    var obs9 = $('#obser9').val();
    var con10 = $('#cond10').val();
    var obs10 = $('#obser10').val();
    var con11 = $('#cond11').val();
    var obs11 = $('#obser11').val();
    var prof = $('#profx').val();
    $.ajax({
				type: 'GET',
				data: 'ced='+ced+'&idcon='+idcon+'&prof='+prof+'&con1='+con1+'&obs1='+obs1+'&con2='+con2+'&obs2='+obs2+'&con3='+con3+'&obs3='+obs3+'&con4='+con4+'&obs4='+obs4+'&con5='+con5+'&obs5='+obs5+'&con6='+con6+'&obs6='+obs6+'&con7='+con7+'&obs7='+obs7+'&con8='+con8+'&obs8='+obs8+'&con9='+con9+'&obs9='+obs9+'&con10='+con10+'&obs10='+obs10+'&con11='+con11+'&obs11='+obs11+'&sw=6',
				url: 'acciones.php',
				success: function(data){
                                   alert("Se guardo con exito");
                                   $('#idcon').val(data);
				}
			});
    
}
function ver_condiciones(ced){
    
    $.ajax({
				type: 'GET',
				data: 'ced='+ced+'&sw=7',
				url: 'acciones.php',
				success: function(data){
                                    var p = eval(data);
			                var idcon = $('#idcon').val(p[0]);
                                       
                                        var con1 = $('#cond1').val(p[3]);
                                        var obs1 = $('#obser1').val(p[4]);
                                        var con2 = $('#cond2').val(p[5]);
                                        var obs2 = $('#obser2').val(p[6]);
                                        var con3 = $('#cond3').val(p[7]);
                                        var obs3 = $('#obser3').val(p[8]);
                                        var con4 = $('#cond4').val(p[9]);
                                        var obs4 = $('#obser4').val(p[10]);
                                        var con5 = $('#cond5').val(p[11]);
                                        var obs5 = $('#obser5').val(p[12]);
                                        var con6 = $('#cond6').val(p[13]);
                                        var obs6 = $('#obser6').val(p[14]);
                                        var con7 = $('#cond7').val(p[15]);
                                        var obs7 = $('#obser7').val(p[16]);
                                        var con8 = $('#cond8').val(p[17]);
                                        var obs8 = $('#obser8').val(p[18]);
                                        var con9 = $('#cond9').val(p[19]);
                                        var obs9 = $('#obser9').val(p[20]);
                                        var con10 = $('#cond10').val(p[21]);
                                        var obs10 = $('#obser10').val(p[22]);
                                        var con11 = $('#cond11').val(p[23]);
                                        var obs11 = $('#obser11').val(p[24]);
                                        var prof = $('#profx').val(p[2]); 
				}
			});
}
function impc(){
    var idcon = $('#ced').val();
     window.open('reporte_condiciones.php?ced='+idcon+'','Imprimir','width=900,height=650');
   
}