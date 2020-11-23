//----------------------------------- Modulo de Almacenes---------------------------
$(function() {

     // 4- Buscar en la tabla
        $('#buscar_empleado').change(function(){
		var nombre = $(this).val();
		if(nombre.length>0){
			$.ajax({
				type: 'GET',
				data: 'nombre='+nombre+'',
				url: '../popup/medicinas/mostrar_tabla.php',
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
		$.ajax({
				type: 'GET',
				data: 'page='+page,
				url: '../popup/medicinas/mostrar_tabla.php',
				success: function(data){
						$('#empleados').html(data);
						
				}
			});
		return false;
}