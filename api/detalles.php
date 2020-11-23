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
    $use = $_GET['use'];
    $ord = $_GET['ord'];

try {

	$con = new PDO($dns, $user, $pass);
	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		

$query2 = $con->prepare('select * from reportes  where id_orden="'.$ord.'" ');

$query2->execute();
$res = $query2->fetch();
$inc_desc = $res['descripcion'];
$inc_solu = $res['solucion'];
$inc_fech = date('d/m/Y',strtotime($res['f_reg']));
$inc_est = $res['estado'];
$fuente = $res['fuente'];
$categoria = $res['categoria'];


	$query = $con->prepare('select a.orden_servicio,a.Description,a.Id,a.Valoracion,a.inf_adicional,a.user,a.Subject,a.cant,a.cant_ins,a.estado,a.PA,a.PULSO,a.FR,a.fecha_mod_ta from actividad a, ordenes b where a.user="'.$use.'" and b.id=a.archivo  and a.orden_servicio="'.$ord.'" order by a.cant_ins ');

		$query->execute();
		$registros = "[";



while($result = $query->fetch()){

			if ($registros != "[") {

				$registros .= ",";

			}

			if($result["estado"]=='Completada'){

			    $estado = 'green';

			}else{

			    $estado = 'red';

			}
			$valo = trim($result["Valoracion"]);
			$valo = preg_replace("(\r\n)", "", $valo);
            $info = trim($result["inf_adicional"]);
			$info = preg_replace("(\r\n)", "", $info);
			$registros .= '{"fuente": "'.$fuente.'","categoria": "'.$categoria.'","inc_est": "'.$inc_est.'","inc_des": "'.$inc_desc.'","inc_sol": "'.$inc_solu.'","inc_fec": "'.$inc_fech.'","orden_servicio": "'.$result["orden_servicio"].'","color": "'.$estado.'",  ';

			$registros .= '"Description": "'.$result["Description"].'","Id": "'.$result["Id"].'","Valoracion": "'.$valo.'","inf_adicional": "'.$info.'","user": "'.$result["user"].'",';

			$registros .= '"Subject": "'.$result["Subject"].'", "cant": "'.$result["cant"].'", "cant_ins": "'.$result["cant_ins"].'", "estado": "'.$result["estado"].'", "PA": "'.$result["PA"].'", "PULSO": "'.$result["PULSO"].'", "FR": "'.$result["FR"].'", "FECHA": "'.$result["fecha_mod_ta"].'" }';

		}

		$registros .= "]";

		echo $registros;







} catch (Exception $e) {

	echo "Erro: ". $e->getMessage();

};

