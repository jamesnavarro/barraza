<?php
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');

$dns = "mysql:host=localhost;dbname=softmed1_barraza";
$user = "softmed1_idb";
$pass = "jnavarro0318";

   $data = file_get_contents("php://input");
    $objData = json_decode($data);
    


    
    // lIMPIAR LOS DATOS   32679   
    $usuario = $_GET['use'];
try {
	$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}		
$query4 = $con->prepare("select Subject,Id from actividades where estado!='Completada' and user='".$usuario."' and StartTime like '".date("Y-m-d")."%' ");
		$query4->execute();
$registros = "[";
		while($f = $query4->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$nfecha = $f['Subject'];
                     
                         
			$registros .= '{"noticias": "Actividad de Hoy: '.$f['Subject'].' ", "imagen": "tarea.png","boton": "Completar","ida": '.$f['Id'].' }';
             
                        
		}
	$query = $con->prepare("select * from noticias where estado='Publicado'");

		$query->execute();

		

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$registros .= '{"noticias": "'.$result["noticia"].'","imagen": "noticia.png","boton": "","ida": "" }';
		}
		
		$query3 = $con->prepare("select * from usuarios where estado_empleado='Activo' and descripcion  like '%".date("m-d")."%' ");
		$query3->execute();
		while($f = $query3->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
		      
                         
			$registros .= '{"noticias": "Hoy cumple : '.$f['nombres'].' '.$f['apellidos'].' ", "imagen": "cumple.png","boton": "","ida": "" }';
             
                        
		}
		
		$query2 = $con->prepare("select * from pacientes where estado='ACTIVO' and fecha_nacimiento like '%".date("m-d")."%' ");
		$query2->execute();

		while($f = $query2->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$nfecha = substr($f['fecha_nacimiento'],-5,9);
                     
                         
			$registros .= '{"noticias": "Cumpleaños del Paciente: '.$f['nombres'].' '.$f['apellidos'].' ", "imagen": "cumple.png","boton": "","ida": "" }';
             
                        
		}
                
                
		
		$registros .= "]";
		echo $registros;



} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};
