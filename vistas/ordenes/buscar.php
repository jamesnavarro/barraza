<?php
include "../../modelo/conexion.php";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Buscar Profesional por sector</title>
            <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
            <script> 
                function ver(page){
                    var barrio = $("#buscar").val();
                    var usuario = $("#usuario").val();

                    $("#load").html('<img src="../../images/spinner.gif"> Cargando..');
                    $.ajax({
				type: 'GET',
				data: 'barrio='+barrio+'&page='+page+'&usuario='+usuario+'&sw=4',
				url: 'acciones.php',
				success: function(data){
                                    
					$("#mostrar_tabla").html(data);
                                        $("#load").html('');
				}
			});
                }
                function sel(u){
 
                    window.opener.pasar_u(u);
                    window.close();
                   
                }
                </script>
    </head>
    <body>
        Buscar : <input type="text" id="buscar" value="<?php echo $_GET['secto']; ?>">
        Usuario :<select  class="span8"  name="nombre" id="usuario">
                                                 <option value=''>Seleccione el nombre...</option>
                                                                   
                                                                   <?php
                                                                  
                                                           $consulta= "SELECT usuario, nombre, apellido FROM `usuarios` where estado_empleado='Activo' order by nombre asc";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['nombre'].' '.$fila['apellido'];
                                                         
                                                         

                                                            echo"<option value=".$fila['usuario'].">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                            </select> <button onclick="ver(1)">Buscar</button> <span id="load"></span>
        <div id="mostrar_tabla">
            
        </div>

    </body>
</html>
