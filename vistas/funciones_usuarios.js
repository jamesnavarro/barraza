//----------------------------------- Modulo de Clientes---------------------------

$(function(){
     $("#mostrar_tabla").html(mostrar_barr_usuario(1));
   
       $('#barrio_usuario').change(function(){
             mostrar_barr_usuario(1); 
     });  
});
function mostrar_barr_usuario(page){
     var ba_u= $("#barrio_usuario").val();
      var ciu= $("#dept").val();
       var mun= $("#munp").val();

        $.ajax({
            type: 'GET',
            data: 'ba_us='+ba_u+'&cius='+ciu+'&munu='+mun+'&page='+page,
            url: '../vistas/lista_u.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
           }); 
}

function barrio_usuario(){
  var depa = $("#ciudadx").val();
  var muni = $("#municipiox").val(); 
  window.open('../vistas/buscar_barrio.php?dept='+depa+'&munp='+muni, 'barrio_u', 'width=500,height=600');
}

function seleccionar_u(nombre){
    window.opener.obtener_barrio_u(nombre);
    window.close();
}

function obtener_barrio_u(nombre){
  $("#bar_usuario").val(nombre);
}
 
