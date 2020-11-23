<?PHP
include "modelo/conexion.php";
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor. AIzaSyDZme3vCUL_qsOQRdoAZKUgqQVTAg5HLfA  https://*softmediko.com/*
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>MAPA</title>
        <script src="assets/modernizr/js/modernizr-2.6.2.min.js"></script>
    <script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="js/funciones.js?v=2.0" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADYc11LQqiFIMqboLe4ED36dJBvDzu9Ow"></script>
        <script>
            function ver_mapa(){
                var usuario = $("#usuario").val();
                    $.ajax({    
                        type: 'POST',
                        data: 'usuario='+usuario,
                        url: 'vistas/aten_activo/consulta_ubi.php',
                        success: function(data){
                             var p = eval(data);
                             initMap(p);

                        }
                    });
            }
            
function initMap(datos) {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);
        
    // Multiple markers location, latitude, and longitude
    var markers = datos;
    console.log(datos);
    console.log(markers);
//      $.ajax({    
//        type: 'POST',
//        url: 'vistas/aten_activo/consulta_ubi.php',
//        success: function(data){
//            var markers = eval(data);
//            alert(markers);
//        } 
//    });
    // Info window content
    var infoWindowContent = '';
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}
// Load initialize function
google.maps.event.addDomListener(window, 'load', ver_mapa);

</script>
<style>
#mapCanvas {
    width: 100%;
    height: 600px;
}
</style>
    </head>
    <body onload="">
        <div id="mapCanvas">
            Cargando mapa internacion barraza....
        </div>
        Ubicacion de <input type="text" id="usuario" value="<?php echo $_GET['usuario']; ?>"> por atencion <button onclick="ver_mapa()">Buscar</button>
        <?php
        // put your code here
        ?>
    </body>
</html>
