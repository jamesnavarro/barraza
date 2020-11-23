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
    $ord = $_GET['ord'];
try {
	$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		

	$query = $con->prepare("SELECT * FROM insumos_asignados a, insumos b, ordenes c WHERE a.asignado_a='".$id."' and c.id=a.numero_orden and a.cod_insumo=b.codigo and a.rel_atencion='".$ord."'  group by id_ia");

		$query->execute();

		$registros = "[";

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$registros .= '{"id_ia": "'.$result["id_ia"].'","AfecInv": "'.$result["AfecInv"].'","cod_insumo": "'.$result["cod_insumo"].'","nombre_insumo": "'.$result["nombre_insumo"].'","cantidad": "'.$result["cantidad"].'",  ';
			$registros .= '"cant_usada": "'.$result["cant_usada"].'","cant_restante": "'.$result["cant_restante"].'",';
			$registros .= '"rel_atencion": "'.$result["rel_atencion"].'" }';
		}
		$registros .= "]";
		echo $registros;



} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};
