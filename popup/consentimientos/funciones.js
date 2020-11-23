//----------------------------------- Modulo de Almacenes---------------------------
$(function() {

     // 4- Buscar en la tabla
        $('#buscar_empleado').change(function(){
		var nombre = $(this).val();
                var fila = $('#in').val();
		if(nombre.length>0){
			$.ajax({
				type: 'GET',
				data: 'nombre='+nombre+'&in='+fila,
				url: '../popup/consentimientos/mostrar_tabla.php',
				success: function(data){
					$('#empleados').html(data);
				}
			});
		}else{
			 MostrarEmpleados2(1);
		}
	});
});

function MostrarEmpleados2(page){
    var fila = $('#in').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&in='+fila,
				url: '../popup/consentimientos/mostrar_tabla.php',
				success: function(data){
						$('#empleados').html(data);
						
				}
			});
		return false;
}