//----------------------------------- Modulo de Clientes---------------------------
$(function() {
     // 2- Insertar registro
        $('#Guardar').on('click', function(){

		var ced = $('#ced').val();  
                var nom = $('#nom').val(); 
                var no2 = $('#no2').val();
                var ape = $('#ape').val();
                var ap2 = $('#ap2').val();
                var dir = $('#dir').val(); 
                var dep = $('#dep').val(); 
                var mun = $('#mun').val(); 
                var tel = $('#tel').val(); 
                var cel = $('#cel').val();
                var fam = $('#fam').val(); 
                var tfa = $('#tfa').val(); 
                var bar = $('#bar').val();
                var fin = $('#fin').val(); 
                var fde = $('#fde').val(); 
                var emp = $('#empresa').val();
                var est = $('#est').val();
                var depo = $('#depo').val();
                var sub = $('#sub').val();
                var enf = $('#enf').val();
                var obs = $('#obs').val();
                var sw = $('#sw').val();
               
           
		if(emp.length>0 && est.length>0 && nom.length>0 && ape.length>0 && ap2.length>0 && ced.length>0 && tel.length>0 && fam.length>0 && tfa.length>0 && dir.length>0){
			$.ajax({
				type: 'GET',
				url: 'acciones.php?ced='+ced+'&nom='+nom+'&no2='+no2+'&ape='+ape+'&ap2='+ap2+'&dir='+dir+'&bar='+bar+'&dep='+dep+'&mun='+mun+'&tel='+tel+'&cel='+cel+'&fam='+fam+'&tfa='+tfa+'&fin='+fin+'&fde='+fde+'&emp='+emp+'&est='+est+'&depo='+depo+'&sub='+sub+'&enf='+enf+'&obs='+obs+'&sw='+sw,
				success: function(data){

                                    if(data === 'existe'){
						$('#mensaje').html('<span class="alert alert-danger">Espere!!, Ya este Paciente existe en la base de datos.</span>').show(200).delay(2500).hide(200);
					}else{
                                            if(data == '1'){
                                                $('#mensaje').html('<span class="alert alert-success">Se Registro con exito.</span>').show(200).delay(2500).hide(200);
                                               limpiar_usu();
                                               pasar();
                                               $('#sw').val(1);
                                               $('#ced').val('').focus();
                                            }else if(data == '2'){
                                                $('#mensaje').html('<span class="alert alert-success">Se edito Con exito.</span>').show(200).delay(2500).hide(200);
                                                pasar();
                                            }else{
                                                $('#mensaje').html('<span class="alert alert-danger">No se pudo registrar.</span>').show(200).delay(2500).hide(200);
                                            }
                                        }
				}
			});
                       
		}else{
			$('#mensaje').html('<span class="alert alert-danger">Lene todos los campos obligatorios.</span>').show(200).delay(2500).hide(200);
		}
	});
        $('#GuardarSub').on('click', function(){
               
		var ced = $('#ced').val();  
                var nom = $('#nom').val(); 
                var no2 = $('#no2').val();
                var ape = $('#ape').val();
                var ap2 = $('#ap2').val();
                var dir = $('#dir').val(); 
                var dep = $('#dep').val(); 
                var mun = $('#mun').val(); 
                var tel = $('#tel').val(); 
                var cel = $('#cel').val();
                var fam = $('#fam').val(); 
                var tfa = $('#tfa').val(); 
                var fin = $('#fin').val(); 
                var fde = $('#fde').val(); 
                var emp = $('#empresa').val();
                var est = $('#est').val();
                var depo = $('#depo').val();
                var sub = $('#sub').val();
                var enf = $('#enf').val();
                var obs = $('#obs').val();
                var sw = $('#sw').val();
                var alta = $('#alta').val();
                var doc = $('#doc').val();
                var regi = $('#regi').val();
                var tipo = $('#tipo').val();
                var sexo = $('#sexo').val();
                var naci = $('#naci').val();
                var civi = $('#civi').val();
                var ocup = $('#ocup').val();
                var bar = $('#bar').val();
                var email = $('#email').val();
                var pare = $('#pare').val();
                var aco2 = $('#aco2').val();
                var tela = $('#tela').val();
                var par2 = $('#par2').val();
                var enf2 = $('#enf2').val();
                var obs2 = $('#obs2').val();
                var prof = $('#prof').val();
                 var zon = $('#zona').val();
                 var cont = $('#cont').val();
                 var cov = $('#cov').val();
                 var obscov = $('#obscov').val();
                 
                var cadena = dir;
                 if(/#/.test(cadena)){
                     alert('En el campo direccion no permite el caracter # ');
                     return false;
                 }
                 if(cont===''){
                     alert("Digite e numero de contracto si es para municipio o barranquilla");
                     $("#cont").focus();
                     return false;
                     
                 }
		if(zon.length>0 && naci.length>0 && doc.length>0 && est.length>0 && nom.length>0 && ape.length>0 && ap2.length>0 && ced.length>0 && tel.length>0 && dir.length>0 && emp.length>0){
			$.ajax({
				type: 'GET',
				url: 'acciones.php?ced='+ced+'&cov='+cov+'&obscov='+obscov+'&cont='+cont+'&zona='+zon+'&alta='+alta+'&doc='+doc+'&regi='+regi+'&tipo='+tipo+'&sexo='+sexo+'&naci='+naci+'&civi='+civi+'&ocup='+ocup+'&email='+email+'&pare='+pare+'&aco2='+aco2+'&tela='+tela+'&par2='+par2+'&enf2='+enf2+'&obs2='+obs2+'&prof='+prof+'&nom='+nom+'&no2='+no2+'&ape='+ape+'&ap2='+ap2+'&dir='+dir+'&bar='+bar+'&dep='+dep+'&mun='+mun+'&tel='+tel+'&cel='+cel+'&fam='+fam+'&tfa='+tfa+'&fin='+fin+'&fde='+fde+'&emp='+emp+'&est='+est+'&depo='+depo+'&sub='+sub+'&enf='+enf+'&obs='+obs+'&sw='+sw,
				success: function(data){
                                    if(data === 'x'){
                                        window.close();
                                    }
                                    if(data === 'existe'){
						$('#mensaje').html('<span class="alert alert-danger">Espere!!, Ya este Paciente existe en la base de datos.</span>').show(200).delay(2500).hide(200);
					}else{
                                            if(data == '1'){
                                                $('#mensaje').html('<span class="alert alert-success">Se Registro con exito.</span>').show(200).delay(2500).hide(200);
                                               limpiar_usu();
                                               pasar();
                                               $('#sw').val(1);
                                               $('#ced').val('').focus();
                                            }else if(data == '2'){
                                                $('#mensaje').html('<span class="alert alert-success">Se edito Con exito.</span>').show(200).delay(2500).hide(200);
                                                pasar();
                                            }else{
                                                $('#mensaje').html('<span class="alert alert-danger">No se pudo registrar.</span>').show(200).delay(2500).hide(200);
                                            }
                                        }
				}
			});
                       
		}else{
			$('#mensaje').html('<span class="alert alert-danger">LLene todos los campos obligatorios.</span>').show(200).delay(2500).hide(200);
		}
	});
     // 4- Buscar en la tabla
        $('#buscar_cliente').change(function(){
		MostrarClientes(1);
	});
        $('#apellido').change(function(){
		MostrarClientes(1);
	});
        $('#estado').change(function(){
		MostrarClientes(1);
	}); 
        $('#empresa').change(function(){
		MostrarClientes(1);
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
		Llenar_pac(ced);
           
        });
              $("#dep").change(function () {
   		$("#dep option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../../combos/ciudades_2.php", { elegidoc: elegidoc }, function(data){
				$("#mun").html(data);
				
			});			
        });
   });
   
         $('#subida').submit(function(){

		var comprobar = $('#foto').val().length;

		if(comprobar>0){		

			var formulario = $('#subida');	
			var datos = formulario.serialize();		
			var archivos = new FormData();			
			var url = '../vistas/clientes/subir_foto.php';		
			for (var i = 0; i < (formulario.find('input[type=file]').length); i++) { 			

               	        archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));		 

      		 	}	
			$.ajax({			
				url: url+'?'+datos,			
				type: 'POST',			
				contentType: false, 			
            	                data: archivos,			
               	                processData:false,
                                beforeSend : function (){
                                    $('#msg2').html('<img width="100px" src="../../images/guardando.gif">');
                                },
				success: function(data){
                                        $('#foto').focus();
                                        $('#foto').val('');
                                        $('#msg2').html(data);
                                        console.log(data);
					return false;
				}
			});
			return false;
		}else{
			alert('Error ! debes de llenar todos los campos necesario, para poder cargar los codigos');
			return false;
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
//mostrar tablas
function enfermedad()
{
      window.open('../../vistas/agregar_enfermedad.php', 'contacto', 'width=500,height=600');
}
function enfermedad2()
{
      window.open('../../vistas/agregar_enfermedad2.php', 'contacto', 'width=500,height=600');
}
function enfermedad2x()
{
      window.open('../vistas/agregar_enfermedad2.php', 'contacto', 'width=500,height=600');
}
function enfermedad_add(val30, val40){
    
    document.getElementById('obs').value = val30;
    document.getElementById('enf').value = val40;
}
function enfermedad_add2(val30, val40){
    
    document.getElementById('obs2').value = val30;
    document.getElementById('enf2').value = val40;
}
function MostrarClientes(page){
    var nombre = $('#buscar_cliente').val();
    var apellido = $('#apellido').val();
    var estado = $('#estado').val();
    var empresa = $('#empresa').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&nombre='+nombre+'&apellido='+apellido+'&estado='+estado+'&empresa='+empresa,
				url: '../vistas/clientes/mostrar_tabla.php',
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
function formulario_subcov(id,emp){
    window.open('../vistas/clientes/index_covid.php?id='+id+'&emp='+emp,'Form','width=900,height=650');
}
function pasar_empleado(val1, val2, val3, val4){
    $('#use').val(val1);
    $('#ced').val(val2);
    $('#tno').val(val3);
    $('#tap').val(val4);
    
}
function Llenar_pac(id){
    
    if(id!=='0'){

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
                                                 $('#cov').val(data[41]);
                                                 $('#obscov').val(data[42]);
                                                 ver_condiciones(data[0]);
                                                 ver_encuesta(data[0]);

				}
			});
                    }
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
function add_encuenta(){
    var idenc = $('#idenc').val();
    var ced = $('#ced').val();
    var enc1 = $('#enc1').val();
    var enc2 = $('#enc2').val();
    var enc3 = $('#enc3').val();
    var enc4 = $('#enc4').val();
    var enc5 = $('#enc5').val();
    var enc6 = $('#enc6').val();
    var enc7 = $('#enc7').val();
    var enc8 = $('#enc8').val();
    var enc9 = $('#enc9').val();
    var enc10 = $('#enc10').val();
    var enc11 = $('#enc11').val();
    var enc12 = $('#enc12').val();
    var enc13 = $('#enc13').val();
    var enc14 = $('#enc14').val();
    var enc15 = $('#enc15').val();
    var enc16 = $('#enc16').val();
    var enc17 = $('#enc17').val();
    var enc18 = $('#enc18').val();
    
    var enc19 = $('#enc19').val();
    var enc20 = $('#enc20').val();
    var enc21 = $('#enc21').val();
    var enc22 = $('#enc22').val();
    var enc23 = $('#enc23').val();
    if(ced==''){
        alert('debe de llenar el numero de documento');
        return false;
    }
    $.ajax({
				type: 'GET',
				data: 'ced='+ced+'&idenc='+idenc+'&enc1='+enc1+'&enc2='+enc2+'&enc3='+enc3+'&enc4='+enc4+'&enc5='+enc5+'\
                        &enc6='+enc6+'&enc7='+enc7+'&enc8='+enc8+'&enc9='+enc9+'&enc10='+enc10+'&enc11='+enc11+'&enc12='+enc12+'&enc13='+enc13+'\
&enc14='+enc14+'&enc15='+enc15+'&enc16='+enc16+'&enc17='+enc17+'&enc18='+enc18+'&enc19='+enc19+'&enc20='+enc20+'&enc21='+enc21+'&enc22='+enc22+'&enc23='+enc23+'&sw=8',
				url: 'acciones.php',
				success: function(data){
                                    var p = eval(data);
                                   alert("Se guardo con exito"+p[1]);
                                   $('#idenc').val(p[0]);
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
function ver_encuesta(ced){
    
    $.ajax({
				type: 'GET',
				data: 'ced='+ced+'&sw=9',
				url: 'acciones.php',
				success: function(data){
                                    var p = eval(data);
			                var idcon = $('#idenc').val(p[0]);
                                       
                                        var enc1 = $('#enc1').val(p[2]);
                                        var enc2 = $('#enc2').val(p[3]);
                                        var enc3 = $('#enc3').val(p[4]);
                                        var enc4 = $('#enc4').val(p[5]);
                                        var enc5 = $('#enc5').val(p[6]);
                                        var enc6 = $('#enc6').val(p[7]);
                                        var enc7 = $('#enc7').val(p[8]);
                                        var enc8 = $('#enc8').val(p[9]);
                                        var enc9 = $('#enc9').val(p[10]);
                                        var enc10 = $('#enc10').val(p[11]);
                                        var enc11 = $('#enc11').val(p[12]);
                                        var enc12 = $('#enc12').val(p[13]);
                                        var enc13 = $('#enc13').val(p[14]);
                                        var enc14 = $('#enc14').val(p[15]);
                                        var enc15 = $('#enc15').val(p[16]);
                                        var enc16 = $('#enc16').val(p[17]);
                                        var enc17 = $('#enc17').val(p[18]);
                                        var enc18 = $('#enc18').val(p[19]);
                                        var enc19 = $('#enc19').val();
                                        var enc20 = $('#enc20').val();
                                        var enc21 = $('#enc21').val();
                                        var enc22 = $('#enc22').val();
                                        var enc23 = $('#enc23').val();
				}
			});
}
function impc(){
    var idcon = $('#ced').val();
     window.open('reporte_condiciones.php?ced='+idcon+'','Imprimir','width=900,height=650');
   
}
function impe(){
    var idcon = $('#idenc').val();
     window.open('reporte_condiciones_1.php?ced='+idcon+'','Imprimir','width=900,height=650');
   
}