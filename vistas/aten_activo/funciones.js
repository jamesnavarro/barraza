 
$(function(){
    
     $("#mostrar_tabla").html(ver(1)); 
   
     $('#buscar').change(function(){
             ver(1);
     });   
      $('#usuario').change(function(){
             ver(1);
     });
});
 
 function ver(page){
                    var barrio = $("#buscar").val();
                    var usuario = $("#usuario").val();
                    var all = $("#all").val();
                     var sin = $("#sin_barrio").val();
                    $("#load").html('<img src="../images/spinner.gif"> Cargando..');
                    $.ajax({
				type: 'GET',
				data: 'barrio='+barrio+'&page='+page+'&usuario='+usuario+'&all='+all+'&sin='+sin,
				url: '../vistas/aten_activo/lista.php',
				success: function(data){
					$("#mostrar_tabla").html(data);
                                        $("#load").html('');
				}
			});
                }
     function editar_pac(ord,idp){
                    var barrio = $("#bar"+ord).val();
                    var dir = $("#dir"+ord).val();
                    var lat = $("#lat"+ord).val();
                    var lng = $("#lng"+ord).val();
                    $.ajax({
				type: 'GET',
				data: 'barrio='+barrio+'&dir='+encodeURIComponent(dir)+'&lat='+lat+'&lng='+lng+'&id_p='+idp,
				url: '../vistas/aten_activo/modelo.php',
				success: function(data){
                                 
					$("#msg").html("<b>Se guardo con exito</b> "+data).show(200).delay(2500).hide(200);
                                        
				}
			});
                }  
               
 function pasar_ubi(co,id){
    var dep = $("#dep"+co).val();
    var mun = $("#mun"+co).val();
    var dir = $("#dir"+co).val();
    $.ajax({    
        type: 'POST',
        data: 'dep='+dep+'&mun='+mun,
        url: '../vistas/aten_activo/mostrar_dep.php',
        success: function(data){
            
            $("#search").val(dir+', '+data);
            mapa.getCoords(co,id);
            
             
            
        }
    });
    
}               
 function ingresar(id){
     
     createWindow("../vistas/buscar.php?dep=0&mun=0&barrio=&all=todos=", 500, 600);
}
 function mostrar_mapa(){
     var u = $("#usuario").val();
     createWindow("../mapa.php?usuario="+u, 1200, 700);
}
function obtener_barrio(nombre){
    
}
function createWindow(src, width, height){
    var win = window.open(src, "_new", "width="+width+",height="+height+",status=no");
    win.addEventListener("resize", function(){
        console.log("Resized");
		win.resizeTo(width, height);
    });
}
 
    
mapa = {
 map : false, 
 marker : false,

 initMap : function() {
 
 // Creamos un objeto mapa y especificamos el elemento DOM donde se va a mostrar.
 
 mapa.map = new google.maps.Map(document.getElementById('mapa'), {
   center: {lat: 11.0004538, lng: -74.8110951},
   scrollwheel: false,
   zoom: 14,
   zoomControl: true,
   rotateControl : false,
   mapTypeControl: true,
   streetViewControl: false,
 });
 
 // Creamos el marcador
 mapa.marker = new google.maps.Marker({
 position: {lat: 11.0004538, lng: -74.8110951},
 draggable: true 
 });
 
 // Le asignamos el mapa a los marcadores.
  mapa.marker.setMap(mapa.map);
 
 },

// función que se ejecuta al pulsar el botón buscar dirección
getCoords : function(d,id)
{
  // Creamos el objeto geodecoder
 var geocoder = new google.maps.Geocoder();
 
 address = document.getElementById('search').value;
 if(address!='')
 {
  // Llamamos a la función geodecode pasandole la dirección que hemos introducido en la caja de texto.
 geocoder.geocode({ 'address': address}, function(results, status)  
 {
   if (status == 'OK')
   {
// Mostramos las coordenadas obtenidas en el p con id coordenadas
   document.getElementById("coordenadas").innerHTML='Coordenadas:   '+results[0].geometry.location.lat()+', '+results[0].geometry.location.lng();
   $("#lat"+d).val(results[0].geometry.location.lat());
    $("#lng"+d).val(results[0].geometry.location.lng());
// Posicionamos el marcador en las coordenadas obtenidas
editar_pac(d,id);
   mapa.marker.setPosition(results[0].geometry.location);
// Centramos el mapa en las coordenadas obtenidas
   mapa.map.setCenter(mapa.marker.getPosition());
   agendaForm.showMapaEventForm();
   
   }
  });
 }
 }
}