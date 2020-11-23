 
$(function(){
     $("#mostrar_tabla").html(mostrar_barrio(1)); 
   
     $('#nombre_b').change(function(){
             mostrar_barrio(1);
     });   
});
 
function mostrar_barrio(page){
      var nomb = $("#nombre_b").val(); 
        $.ajax({
            type: 'GET',
            data: '&nombb='+nomb+'&page='+page,
            url: '../vistas/barrios/lista.php',
            success: function(resultado){
                 $("#mostrar_tabla").html(resultado);
            }
  }); 
}
function guardar_barrio(){ 
     var idbarrio = $("#id_barrio").val(); 
     var depar = $("#depar_barrio").val();
      var muni = $("#muni_barrio").val(); 
     var nomb = $("#nomb_barrio").val();
      var lati = $("#lati_barrio").val(); 
     var longi = $("#longi_barrio").val();
     
    if(depar===''){
         alert("departamento");
        $("#depar_barrio").focus();
        return false;
    }
     if(muni===''){
         alert("Municipio");
        $("#muni_barrio").focus();
        return false;
    }
      if(nomb===''){
         alert("Nombre del barrio");
        $("#nomb_barrio").focus();
        return false;
    }
       if(lati===''){
         alert("Latitud");
        $("#lati_barrio").focus();
        return false;
    }
       if(longi===''){
         alert("Longitud");
        $("#longi_barrio").focus();
        return false;
    }
    
   $("#btn_guardar").attr("disabled",true);
        $.ajax({
            type: 'GET',
            data: 'idbarriob='+idbarrio+'&deparb='+depar+'&munib='+muni+'&nombb='+nomb+'&latib='+lati+'&longib='+longi+'&sw=1',
            url: '../vistas/barrios/acciones.php', 
            success: function(resultado){
                $("#id_barrio").val(resultado); 
                alert("Se guardo con exito");
                $("#btn_guardar").attr("disabled",false);
                mostrar_barrio(1);
            }
           });
}

function limpiar_barrio(){
$("#id_barrio").val(''); 
$("#depar_barrio").val('');
$("#muni_barrio").val(''); 
$("#nomb_barrio").val('');
$("#lati_barrio").val(''); 
$("#longi_barrio").val('');

}

function nuevo(){
    limpiar_barrio();
}

function editar(id){
     $("#marcar1").attr("class","");
    $("#marcar2").attr("class","active");
     $.ajax({
        type: 'GET',
        data: 'id='+id+'&sw=2',  //
        url: '../vistas/barrios/acciones.php', //
        success: function(resultado){
  var p = eval(resultado);
 $("#id_barrio").val(p[0]);
 $("#depar_barrio").val(p[1]);
 $("#muni_barrio").val(p[2]); 
 $("#nomb_barrio").val(p[3]);
 $("#lati_barrio").val(p[4]); 
 $("#longi_barrio").val(p[5]);

 }
 });
}

function borrar(id){
     var c = confirm("Esta seguro de eliminar esta referencia?");
     if(c){
         $.ajax({
            type: 'GET',
            data: 'id='+id+'&sw=3',  //
            url: '../vistas/barrios/acciones.php', //
            success: function(resultado){
                alert("Se ha eliminado con exito");
                mostrar_barrio(1);
            }
           });
       }
}
 
 function cargarmun(){
     var depar = $("#depar_barrio").val(); // 
         $.ajax({
            type: 'GET',
            data: 'nombre='+depar+'&sw=4',  //
            url: '../vistas/barrios/acciones.php', //
            success: function(resultado){
                $("#muni_barrio").html(resultado);
            }
           }); 
}