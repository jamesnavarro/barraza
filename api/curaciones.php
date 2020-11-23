<?php
session_start();
header("Access-Control-Allow-Origin: https://172.16.0.40");
header('Content-Type: text/html; charset=utf-8');

$dns = "mysql:host=localhost;dbname=softmed1_barraza";
$user = "softmed1_idb";
$pass = "jnavarro0318";

   $data = file_get_contents("php://input");
    $objData = json_decode($data);
    
    // ASIGNAR LOS VALORES A LA VARIABLE
    $id = $objData->name;

    
    // lIMPIAR LOS DATOS 
    $id = $_GET['use'];
    $ord = $_GET['ord'];
try {
	$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		

	$query = $con->prepare("SELECT * FROM curaciones where orden_interna='".$ord."'");

		$query->execute();

		$registros = "[";

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$registros .= '{"visita": "'.$result["id_visita"].'","localizacion": "'.$result["localizacion"].'","estadio": "'.$result["estadio"].'","clarificacion": "'.$result["clarificacion"].'","dimension": "'.$result["base_herida"].'","tejido": "'.$result["tejido"].'","exusado": "'.$result["exusado"].'",  ';
			$registros .= '"cant_exusado": "'.$result["cant_exusado"].'","piel_circundante": "'.$result["piel_circundante"].'",';
			$registros .= '"piel_color": "'.$result["piel_color"].'","infeccion": "'.$result["infeccion"].'","": "'.$result["olor"].'","dolor": "'.$result["dolor"].'","cara": "'.$result["c2"].'","registro": "'.$result["registro"].'" }';
		}
		$registros .= "]";
		echo $registros;



} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};
