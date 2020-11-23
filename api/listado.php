<?php
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');

$dns = "mysql:host=localhost;dbname=softmedi_barraza";
$user = "softmedi_idb";
$pass = "jnavarro2018";

   $data = file_get_contents("php://input");
    $objData = json_decode($data);
    
    // ASIGNAR LOS VALORES A LA VARIABLE
    $id = $objData->name;

    
    // lIMPIAR LOS DATOS 
    $id = $_GET['use'];
try {
	$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		

	$query = $con->prepare('SELECT incidencia,orden_servicio,Description,Subject,cant,a.id_contacto,EndTime,fecha_ven,b.descripcion_enf,b.celular,b.direccion1,b.barrio,concat(nombres," ",apellidos) as pa,b.id_paciente FROM actividad a, pacientes b, ordenes c where a.user="'.$id.'" and  a.id_contacto="" and a.Location="" and a.prioridad!="Facturado" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc ');

		$query->execute();

		$registros = "[";

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
                        if($result["incidencia"]=='0'){
			    $img = 'white';
			}else{
			    $img = 'red';
			}
                        
			$registros .= '{"color": "'.$img.'","orden_servicio": "'.$result["orden_servicio"].'","enfermedad": "'.$result["descripcion_enf"].'","celular": "'.$result["celular"].'","direccion": "'.$result["direccion1"].'","barrio": "'.$result["barrio"].'",  ';
			$registros .= '"Description": "'.$result["Description"].'","paciente": "'.$result["pa"].'", "pacienteid": "'.$result["id_paciente"].'", ';
			$registros .= '"Subject": "'.$result["Subject"].'", "cant": "'.$result["cant"].'", "id_contacto": "'.$result["id_contacto"].'", "EndTime": "'.$result["EndTime"].'", "fecha_ven": "'.$result["fecha_ven"].'" }';
		}
		$registros .= "]";
		echo $registros;



} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};
