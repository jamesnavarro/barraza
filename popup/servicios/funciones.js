//----------------------------------- Modulo de Almacenes---------------------------
$(function() {
$('#empleados').load(MostrarEmpleados2(1));
     // 4- Buscar en la tabla
        $('#buscar').change(function(){
		MostrarEmpleados2(1);
	});
        $('#tipo').change(function(){
		MostrarEmpleados2(1);
	});
});

function MostrarEmpleados2(page){
   
    var nombre = $("#buscar").val();
    var tipo = $("#tipo").val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&nombre='+nombre+'&tipo='+tipo,
				url: '../popup/servicios/mostrar_tabla.php',
				success: function(data){
						$('#empleados').html(data);
						
				}
			});
		return false;
}
