$(function(){

       $("#dep").change(function () {
   		$("#dep option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../../combos/departamentos.php", { elegido: elegido }, function(data){
				$("#mun").html(data);
				
			});			
        });
   });
   $("#Salir").click(function(){
          window.close();
   });

});
function Empleados(){
    window.open('../../popup/empleados.php','Empleados','width=500, height=500')
    
}
function Almacenes(){
    window.open('../../popup/almacenes.php','Empleados','width=500, height=500')
    
}
function centro_costo(){
    window.open('../../popup/centro_c.php','Empleados','width=500, height=500')
    
}
function Usuarios(alm){
    window.open('../../popup/usuarios.php?alm='+alm,'Empleados','width=500, height=500')
    
}
function ListaOrdenes(){
     $.ajax({
				type: 'GET',
//				data: 'orden='+oi+'&causa='+causa+'&sw=4',
				url: '../vistas/lista_atenciones.php',
				success: function(data){
                                            $("#mostrar_contenido").html(data);
                                               
                                            
                                } 
			});
}



