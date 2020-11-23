    //----------------------------MODULO DE AUDITORES---------------------------
$(function() {
    // 1. Mostrar formulario emergente
    MostrarProc(1);
    
        $('#buscar_recibo').keyup(function(){
		MostrarProc(1);
	});
        $('#buscar_cedula').keyup(function(){
		MostrarProc(1);
	});
        $('#buscar_nombre').keyup(function(){
		MostrarProc(1);
	});
        $('#buscar_estado').keyup(function(){
		MostrarProc(1);
	});
        $('#buscar_fecha').change(function(){
		MostrarProc(1);
	});
        $('#buscar_usuario').keyup(function(){
		MostrarProc(1);
	});
        $('#cedula').change(function(){
		buscar_cedula();
	});
        $('#cantidad0').change(function(){
            var can = $("#cantidad0").val();
            var pre = $("#valor0").val();
            var tot = can * pre;
            $("#total0").val(tot);
		$('#agregar').focus();
	});
         $('#valor0').change(function(){
            var can = $("#cantidad0").val();
            var pre = $("#valor0").val();
            var tot = can * pre;
            $("#total0").val(tot);
		$('#agregar').focus();
	});
        $('#codigo0').change(function(){
		buscar_atencion();
	});
        $('#documento0').change(function(){
		$("#cantidad0").focus();
	});
        $('#pagar').change(function(){
            calculo();
	});
        $('#forma').change(function(){
            $("#pagar").focus();
	});
    
});
function calculo(){
            var tot = $("#total").val();
            var pag = $("#pagar").val();
            if(parseInt(tot)>parseInt(pag)){
                alert("El pago es menor al total");
                $("#pagar").focus();
                return false;
            }
            var tot = parseFloat(pag) - parseFloat(tot);
            $("#cambio").val(tot);
            $('#guardar').focus();
}
//mostrar tablas
function MostrarProc(page){
    var rec = $("#buscar_recibo").val();
    var ced = $("#buscar_cedula").val();
    var nom = $("#buscar_nombre").val();
    var est = $("#buscar_estado").val();
    var fec = $("#buscar_fecha").val();
    var use = $("#buscar_usuario").val();

		$.ajax({
				type: 'GET',
				data: 'page='+page+'&rec='+rec+'&ced='+ced+'&nom='+nom+'&est='+est+'&fec='+fec+'&use='+use,
				url: '../vistas/recibos/mostrar_tabla.php',
				success: function(data){
						$('#mostrar_tabla').html(data);
						
				}
			});
		return false;
}

// mostrar formularios de editar
function save(x){
    var idp = $("#id_paciente").val();
    var recibo = $("#recibo").val();
    var forma = $("#forma").val();
    var observacion = $("#observacion").val();
    var orden = $("#orden").val();
    var estado = $("#estado").val();
    var total = $("#total").val();
    var pag = $("#pagar").val();
    var cam = $("#cambio").val();
    if(idp==''){
        alert("Debes de digitar el numero de cedula");
        $("#cedula").focus();
        return false;
    }
    if(recibo!==''){
        if(forma==''){
        alert("Debes de seleccionar la forma de pago");
        $("#forma").focus();
        return false;
    }
    }
    
    var c = confirm("Esta de seguro de generar el recibo de caja?");
    if(c){
		$.ajax({
				type: 'GET',
				data: 'recibo='+recibo+'&idp='+idp+'&pag='+pag+'&cam='+cam+'&forma='+forma+'&observacion='+observacion+'&orden='+orden+'&estado='+estado+'&total='+total+'&sw=0',
				url: '../vistas/recibos/acciones.php',
				success: function(data){
                                    var p = eval(data);
                                    $("#recibo").val(p[0]);
                                    $("#estado").val(p[3]);
                                    $("#fecha").val(p[1]);
                                    $("#usuario").val(p[2]);
                                    console.log(p[4]);
                                    if(p[3]==='En proceso'){
                                       $("#codigo0").attr("disabled", false);
                                       $("#descripcion0").attr("disabled", false);
                                       $("#cantidad0").attr("disabled", false);
                                       $("#documento0").attr("disabled", false);
                                       $("#valor0").attr("disabled", false);
                                       $("#total0").attr("disabled", false);
                                       $("#imprimir").attr("disabled", true);
                                       $("#agregar").attr("disabled", false);
                                       $("#continuar").attr("disabled", true);
                                       $("#guardar").attr("disabled", false);
                                       $("#pagar").attr("disabled", false);
                                       $("#cambio").attr("disabled", false);
                                       
                                    }else{
                                       $("#codigo0").attr("disabled", true);
                                       $("#descripcion0").attr("disabled", true);
                                       $("#documento0").attr("disabled", true);
                                       $("#cantidad0").attr("disabled", true);
                                       $("#valor0").attr("disabled", true);
                                       $("#total0").attr("disabled", true);
                                        $("#continuar").attr("disabled", true);
                                       $("#agregar").attr("disabled", true);
                                       $("#imprimir").attr("disabled", false);
                                       $("#guardar").attr("disabled", true);
                                       $("#pagar").attr("disabled", true);
                                       $("#cambio").attr("disabled", true);
                                    }
                                    mostrar_item();
                                    MostrarProc(1);
					
				}
			});
                    }
}
function save_item(){
    var cod = $("#codigo0").val();
    var des = $("#descripcion0").val();
    var can = $("#cantidad0").val();
    var pre = $("#valor0").val();
    var tot = $("#total0").val();
    var rec = $("#recibo").val();
    var doc = $("#documento0").val();
    if(cod==''){
        alert("Debes de digitar el codigo del servicio");
        $("#codigo0").focus();
        return false;
    }
    if(can==''){
        alert("Debes de digitar la cantidad");
        $("#cantidad0").focus();
        return false;
    }
		$.ajax({
				type: 'GET',
				data: 'cod='+cod+'&doc='+doc+'&des='+des+'&can='+can+'&pre='+pre+'&tot='+tot+'&rec='+rec+'&sw=2',
				url: '../vistas/recibos/acciones.php',
				success: function(data){
                                    mostrar_item();
                                    $("#codigo0").val('');
                                    $("#descripcion0").val('');
                                    $("#cantidad0").val('');
                                    $("#valor0").val('');
                                    $("#total0").val('');
                                    $("#documento0").val('');
                                
                                    $("#codigo0").focus();
				}
			});
}
function mostrar_item(){
    var rec = $("#recibo").val();
    var est = $("#estado").val();
    $.ajax({
				type: 'GET',
				data: 'rec='+rec+'&est='+est+'&sw=3',
				url: '../vistas/recibos/acciones.php',
				success: function(data){
                                    $("#mostrar_recibo").html(data);	
				}
			});
}
// eliminar registros de la tabla
function borrar(codigo){
  var conf =  confirm("Desea Eliminar este Items?");
    if(conf){
		$.ajax({
				type: 'GET',
				data: 'codigo='+codigo+'&sw=4',
				url: '../vistas/recibos/acciones.php',
				success: function(data){
                                        mostrar_item();        
                                        alert('Se elimino un registro cn exito');
                                } 
			});
                    }
		return false;
}
function buscar_cedula(){
    var cedula = $("#cedula").val();
    $.ajax({
        type:'POST',
        data:'id='+cedula,
        url:'../vistas/pacientes/consultar.php',
        success : function(d){
            var p = eval(d);
            $("#id_paciente").val(p[43]);
            $("#paciente").val(p[40]);
            if(p[43]=='' || p[43]==null){
                formulario_sub(0,'PART');
            }    
        }
    });
}
function formulario_sub(id,emp){
    window.open('../vistas/clientes/?id=0&emp=0','Form','width=900,height=650');
}
function Buscar_atencion(){
    window.open('../popup/servicios.php','Form','width=600,height=550');
}
function pasar_atencion(cod,desc,valor){
    $("#codigo0").val(cod);
    $("#descripcion0").val(desc);
    $("#valor0").val(valor);
    $("#cantidad0").focus();
}
function buscar_atencion(){
    var cod = $("#codigo0").val();
    $.ajax({
        type:'GET',
        data:'cod='+cod+'&sw=1',
        url:'../vistas/recibos/acciones.php',
        success : function(d){
            var p = eval(d);
                $("#codigo0").val(p[0]);
                $("#descripcion0").val(p[1]);
                $("#valor0").val(p[2]);
                $("#documento0").focus();

            
            
        }
    });
}
function formulario(rec){

    if(rec!==0){
        $.ajax({
        type:'GET',
        data:'rec='+rec+'&sw=5',
        url:'../vistas/recibos/acciones.php',
        success : function(d){
            var p = eval(d);
                $("#id_paciente").val(p[9]);
                $("#recibo").val(p[0]);
                $("#forma").val(p[3]);
                $("#observacion").val(p[4]);
                $("#orden").val(p[5]);
                $("#estado").val(p[8]);
                $("#usuario").val(p[7]);
                $("#fecha").val(p[6]);
                $("#paciente").val(p[2]);
                $("#cedula").val(p[1]);
                $("#pagar").val(p[10]);
                $("#cambio").val(p[11]);
                 if(p[8]=='En proceso'){
                      $("#codigo0").attr("disabled", false);
                                       $("#codigo0").attr("disabled", false);
                                       $("#descripcion0").attr("disabled", false);
                                       $("#cantidad0").attr("disabled", false);
                                       $("#valor0").attr("disabled", false);
                                       $("#total0").attr("disabled", false);
                                       $("#imprimir").attr("disabled", true);
                                       $("#agregar").attr("disabled", false);
                                       $("#continuar").attr("disabled", true);
                                       $("#guardar").attr("disabled", false);
                                       $("#pagar").attr("disabled", false);
                                       
                                       $("#documento0").attr("disabled", false);
                                       
                                    }else{
                                       $("#codigo0").attr("disabled", true);
                                       $("#descripcion0").attr("disabled", true);
                                       $("#cantidad0").attr("disabled", true);
                                       $("#valor0").attr("disabled", true);
                                       $("#total0").attr("disabled", true);
                                       $("#continuar").attr("disabled", true);
                                       $("#agregar").attr("disabled", true);
                                       $("#imprimir").attr("disabled", false);
                                       $("#guardar").attr("disabled", true);
                                       $("#pagar").attr("disabled", true);
                                   
                                       $("#documento0").attr("disabled", true);
                                    }
                mostrar_item();
    
        }
    });
}else{
    limpiar();
}
}
function limpiar(){
        $("#id_paciente").val('');
        $("#recibo").val('');
        $("#forma").val('');
        $("#observacion").val('');
        $("#orden").val('');
        $("#estado").val('');
        $("#usuario").val('');
        $("#fecha").val('');
        $("#paciente").val('');
        $("#cedula").val('');
        $("#pagar").val('');
        $("#cambio").val('');
        $("#mostrar_recibo").html('');
        $("#agregar").attr("disabled", true);
        $("#continuar").attr("disabled", false);
}
function imprimir(){
    var rec = $("#recibo").val();
    window.open("../imprimir_recibo_ven.php?imprimir="+rec,"Imprimir","width=1000, height=600");
}
function reporte(){
    var rec = $("#recibo").val();
    window.open("../imprimir_recibo_ven.php?imprimir="+rec,"Imprimir","width=1000, height=600");
}
