<?php
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');

$dns = "mysql:host=localhost;dbname=softmed1_barraza";
$user = "softmed1_idb";
$pass = "jnavarro0318";

   $data = file_get_contents("php://input");
    $objData = json_decode($data);
    
    // ASIGNAR LOS VALORES A LA VARIABLE
    $id = $objData->use;

    
    // lIMPIAR LOS DATOS 
    $id = $_GET['use'];
try {
	$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		

	$query = $con->prepare('SELECT a.id_evento,a.estado,a.usuario,a.id_paciente,a.clasificacion,a.usuario,a.descripcion,a.asignado,a.clasificacion2,a.fecha_registro,b.nombres,b.apellidos,b.descripcion_enf,b.direccion1,b.barrio,b.celular,a.analisis FROM eventos a, pacientes b where a.id_paciente=b.id_paciente and a.usuario="'.$id.'" ');

		$query->execute();

		$registros = "[";

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
            if($result["estado"]=='Completado'){
			    $img = 'green';
			}else{
			    $img = 'red';
			}
                        $resultado = $con->prepare("select * from eventos_sub where id_evento='".$result["id_evento"]."' ");
                        $resultado->execute();
                        $r = $resultado->fetch();
                        
                        
                         if($r){
			    $dis = '';
			}else{
			    $dis = 'disabled';
			}
                        
			$registros .= '{"evento": "'.$result["id_evento"].'",'
                                . '"a": "'.$r["a"].'",'
                                . '"b": "'.$r["b"].'",'
                                . '"c": "'.$r["c"].'",'
                                . '"d": "'.$r["d"].'",'
                                . '"e": "'.$r["e"].'",'
                                . '"f": "'.$r["fe"].'",'
                                . '"g": "'.$r["g"].'",'
                                . '"h": "'.$r["h"].'",'
                                . '"analisis": "'.$r["des_analisis"].'",'
                                . '"impacto": "'.$r["impacto"].'",'
                                . '"probabilidad": "'.$r["probabilidad"].'",'
                                . '"acciones": "'.$r["acciones"].'",'
                                . '"fer": "'.$r["fecha_mod"].'",'
                                . '"color": "'.$img.'",
			"pacienteid": "'.$result["id_paciente"].'",
			"usuario": "'.$result["usuario"].'",
			"clasificacion": "'.$result["clasificacion"].'",
			"descripcion": "'.$result["descripcion"].'",
			"asignado": "'.$result["asignado"].'", 
			"clasificacion2": "'.$result["clasificacion2"].'",
			"fecha_registro": "'.$result["fecha_registro"].'",
			"estado": "'.$result["estado"].'",
			"paciente": "'.$result["nombres"].' '.$result["apellidos"].'",
			"enfermedad": "'.$result["descripcion_enf"].'",
			"direccion": "'.$result["direccion1"].'",
			"barrio": "'.$result["barrio"].'",
			"celular": "'.$result["celular"].'","boton": "'.$dis.'" }';
		}
		$registros .= "]";
		echo $registros;



} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};
