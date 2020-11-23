$(function() {
    	$('#tabla').dataTable();
        $('#tabla2').dataTable();
        $('#tabla3').dataTable();
        $('#tabla4').dataTable();
        $('#tabla5').dataTable();
        $('#tabla6').dataTable();
        //tablas asignadas para las ordenes
        $('#tabla7').dataTable();
        $('#tabla8').dataTable();
        $('#tabla9').dataTable();
        $('#tabla10').dataTable();
        $("#orden_ext").change(function () {
            var oe =  $("#orden_ext").val();
            var archivo =  $("#archivo").val();
            $.ajax({
				type: 'GET',
				data: 'oe='+oe+'&archivo='+archivo,
				url:  '../vistas/ordenes/consultar.php',
				success: function(data){
                                    if(data!==''){
                                            $('#ver').html('<a href="../vistas/?id=ver_orden_interna&ord='+data+'"><img src="../imagenes/cancelar.png"> Ya esta orden externa existe pulse aqui para ver</a>');
                                            $('#boton_enviar').attr('disabled', true);
                                    }else{
                                             $('#ver').html('<img src="../imagenes/ok.png">');
                                             $('#boton_enviar').attr('disabled', false);
                                    }
                                }
			});
        });
    $("#area").change(function () {
   		$("#area option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../combos/usuario.php", { elegido: elegido }, function(data){
				$("#user").html(data);
				
			});			
        });
   });
       $("#estado").change(function () {
   		$("#estado option:selected").each(function () {
                         est=$(this).val();
                         if(est===''){
			   $("#facturadas").val('');
                         }else{
                             $("#facturadas").val('activa');
                         }
						
        });
   });
          $("#revisadas").change(function () {
   		$("#revisadas option:selected").each(function () {
                         rev=$(this).val();
                         if(rev===''){
			     $("#facturadas").val('');
                             $("#estado").val('');
                         }else {
                             $("#facturadas").val('activa');
                             $("#estado").val('99');
                         }
						
        });
   });
           
     $("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../combos/precio_prod.php", { elegido: elegido }, function(data){
				$("#precio").html(data);
				
			});			
        });
   });
      $("#select2_1").change(function () {
   		$("#select2_2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../combos/enfermedades.php", { elegido: elegido }, function(data){
				$("#valor3").html(data);
				
			});			
        });
   });
	// Parametros para el combo2
	$("#relacionado").change(function () {
   		$("#relacionado option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../combos/relacionado.php", { elegido: elegido }, function(data){
				$("#select2_2").html(data);
			});			
        });
   });

$("#ciudad").change(function () {
   		$("#ciudad option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/ciudades.php", { elegidoc: elegidoc }, function(data){
				$("#municipio").html(data);
				
			});			
        });
   });
   $("#ciudadx").change(function () {
   		$("#ciudadx option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../combos/ciudades_1.php", { elegidoc: elegidoc }, function(data){
				$("#municipiox").html(data);
				
			});			
        });
   });

   $("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {		
				car=$(this).val();
				$.post("../combos/select_1.php", { car: car }, function(data){
				$("#regimen_car").html(data);
				
			});			
        });
   });
   $("#select2_1").change(function () {
   		$("#select2_1 option:selected").each(function () {		
				car2=$(this).val();
				$.post("../combos/select_2.php", { car2: car2 }, function(data){
				$("#tipo_car").html(data);
				
			});			
        });
   });
     $("#medicina").change(function () {
   		$("#medicina option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../combos/cant_medicamento.php", { elegido: elegido }, function(data){
				$("#medicinar").html(data);
				
			});			
        });
   });
   $("#insumo").change(function () {
   		$("#insumo option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../combos/cant_insumos.php", { elegido: elegido }, function(data){
				$("#insumor").html(data);
				
			});			
        });
   });
   
                        $("#insumo").keyup(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/buscar_insumos.php", { elegido2: elegido2 }, function(data){
				$("#total_ins").html(data);
				
			});			
                        });
                        
                        $("#medicamentos").keyup(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/buscar_medicamentos.php", { elegido2: elegido2 }, function(data){
				$("#total_med").html(data);
				
			});			
                        });
                        
                        $("#atenciones").keyup(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/buscar_atenciones.php", { elegido2: elegido2 }, function(data){
				$("#total_ate").html(data);
				
			});			
                        });
                        
                        $("#enfermedades").keyup(function () {
			//alert($(this).val());
				elegido2=$(this).val();
				$.post("../combos/buscar_enfermedades.php", { elegido2: elegido2 }, function(data){
				$("#total_enf").html(data);
				
			});			
                        });
                        $("#combo1").change(function () {
   		$("#combo1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_insumos.php", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				$("#combo3").html("");
			});			
        });
   })
});

	// Parametros para e combo1
   $("#combo3").change(function () {
   		$("#combo3 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_medicina.php", { elegido: elegido }, function(data){
				$("#combo4").html(data);
				$("#combo5").html("");
			});			
        });
   });


	// Parametros para e combo1
   $("#combo5").change(function () {
   		$("#combo5 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_equipo.php", { elegido: elegido }, function(data){
				$("#combo6").html(data);
				$("#combo7").html("");
			});			
        });
   });

	// Parametros para e combo1
   $("#combo7").change(function () {
   		$("#combo7 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_lab.php", { elegido: elegido }, function(data){
				$("#combo8").html(data);
				$("#combo9").html("");
			});			
        });
   });
	// Parametros para e combo1
   $("#combo9").change(function () {
   		$("#combo9 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/add_ventas.php", { elegido: elegido }, function(data){
				$("#combo10").html(data);
				$("#combo11").html("");
			});			
        });


});
function doScroll(){
    if (window.name) window.scrollTo(0, window.name);
}
function datos2(val3, val4, val5){
    
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
    document.getElementById('valor5').value = val5;
}
function enfermedad_add(val30, val40){
    
    document.getElementById('valor30').value = val30;
    document.getElementById('valor40').value = val40;
}
function enfermedad_add2(val31, val41){
    
    document.getElementById('valor31').value = val31;
    document.getElementById('valor41').value = val41;
}
function datos(val1, val2, val3){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
}
function datos3(val1, val2, val3){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
}
function datos4(val1, val2, val3){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
}
function datos5(val1, val2, val3){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
    document.getElementById('valor3').value = val3;
}
function user(val6){
    document.getElementById('valor6').value = val6;
    
}
function dato(val7, val8){
    document.getElementById('valor7').value = val7;
    document.getElementById('valor8').value = val8;
}
function datos2(val3, val4, val5){
    
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
    document.getElementById('valor5').value = val5;
}
function aten(x, y){
    document.getElementById('num1').value = x;
    document.getElementById('num2').value = y;
}
