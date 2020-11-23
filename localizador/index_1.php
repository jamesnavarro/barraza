<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Geolocalizador web</title>
<link href="css/reset.css" rel="stylesheet" />
<link href="css/main.css" rel="stylesheet"  media="screen" />
<script src="jquery-1.11.1.min.js" type="text/javascript"></script>
</head>
<body>
	<div id="container">
		<div id="errorjs" style="color:red;font-size:25px;margin-top:30px;"></div>
		<h1>Geolocalizador <em> de usuarios </em></h1>
		<h2>Haz click en el siguiente bot&oacute;n para localizarte</h2>
		<button id="btn">¡Local&iacute;zame!</button>
	</div>
    <div>
        Lat:<input type="text" id="lat">
        <br>Lon<input type="text" id="lon">
    </div>
</body>
<script type="text/javascript">
	//funcion autoejecutable para obtener las coordenadas con HTML Geolocation API
	(function(){
		//capa para mostrar las coordenadas (definida tambien en el HTML)
		var errorjs=document.getElementById('errorjs');
		//verificamos si el navegador soporta Geolocation API de HTML5
		if(navigator.geolocation){
			//intentamos obtener las coordenadas del usuario
			navigator.geolocation.getCurrentPosition(function(objPosicion){
				//almacenamos en variables la longitud y latitud
				var iLongitud=objPosicion.coords.longitude, iLatitud=objPosicion.coords.latitude;


				//pasamos las variables por ajax
				$("#btn").on( 'click', function () {
				    $.ajax({
				        type: 'post',
				        url: 'localizado.php',
				        data: 'long='+iLongitud+'&lat='+iLatitud,
				        success: function( data ) {
				            document.write( data );
                                          
				        }
				    });
				    errorjs.innerHTML='<img src="load.gif" />';
				});


			},function(objError){
				//manejamos los errores devueltos por Geolocation API
				switch(objError.code){
					//no se pudo obtener la informacion de la ubicacion
					case objError.POSITION_UNAVAILABLE:
						errorjs.innerHTML='La informaci&oacute;n de tu posici&oacute;n no es posible';
					break;
					//timeout al intentar obtener las coordenadas
					case objError.TIMEOUT:
						errorjs.innerHTML="Tiempo de espera agotado";
					break;
					//el usuario no desea mostrar la ubicacion
					case objError.PERMISSION_DENIED:
						errorjs.innerHTML='Necesitas permitir tu localizaci&oacute;n';
					break;
					//errores desconocidos
					case objError.UNKNOWN_ERROR:
						errorjs.innerHTML='Error desconocido';
					break;
				}
			});
		}else{
			//el navegador del usuario no soporta el API de Geolocalizacion de HTML5
			errorjs.innerHTML='Tu navegador no soporta la Geolocalizaci&oacute;n en HTML5';
		}
	})();
</script>
</html>