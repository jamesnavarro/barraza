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
    $id = $objData->name;

    
    // lIMPIAR LOS DATOS 
    $id = $_GET['use'];
    $ord = $_GET['ord'];
try {
	$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		

	$query = $con->prepare("SELECT *,(a.id) as idm FROM medicamentos_asig a, medicamentos b, ordenes c WHERE a.asignado_a='".$id."' and c.id=a.numero_orden  and a.cod_med=b.codigo_int and a.rel_atencion='".$ord."'  group by a.id");

		$query->execute();

		$registros = "[";

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$registros .= '{"concentracion": "'.$result["concentracion"].'","forma": "'.$result["forma"].'","id": "'.$result["idm"].'","AfecInv": "'.$result["AfecInv"].'","cod_insumo": "'.$result["codigo"].'","nombre_insumo": "'.$result["nombre_medicamento"].'","cantidad": "'.$result["cantidad"].'",  ';
			$registros .= '"cant_usada": "'.$result["cantidad_usada"].'","cant_restante": "'.$result["cantidad_rest"].'",';
			$registros .= '"rel_atencion": "'.$result["rel_atencion"].'" }';
		}
		$registros .= "]";
		echo $registros;



} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};
