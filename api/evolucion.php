<?php
session_start();
header("Access-Control-Allow-Origin:http://localhost:8100");
header("Content-Type: application/x-www-form-urlencoded");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    //PARAMETROS DE LA BASE DE DATOS 
$dns = "mysql:host=localhost;dbname=softmed1_barraza";
$user = "softmed1_idb";
$pass = "jnavarro0318";

    //RECUPERAR DATOS DEL FORMULARIO
    $data = file_get_contents("php://input");
    $objData = json_decode($data);
    
    // ASIGNAR LOS VALORES A LA VARIABLE
    $ord = $objData->ordi;
    $fecha = $objData->fecha;
    $evolucion = $objData->evolucion;
    
    $ord = trim($ord);
    $fecha = trim($fecha);
    $evolucion = trim($evolucion);

   
    $db = new PDO($dns, $user, $pass);
   
    if($db){
        $sql = "select id_orden from evolucion where id_orden='".$ord."' ";
        $query = $db->prepare($sql);
        $query ->execute();
        $r = $query->fetch();
        if($r['id_orden']==''){
            $sql3 = "INSERT INTO `evolucion`(`id_orden`, `descripcion`, `fecha`) VALUES ('".$ord."', '".$evolucion."', '".$fecha."') ";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                        $dados = array('mensaje' => "Los datos se guardaron con exito.");
                        echo json_encode($dados);
        }else{
            $sql3 = "UPDATE `evolucion` SET `descripcion`='".$evolucion."' WHERE `id_orden`='".$ord."' ;";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                        $dados = array('mensaje' => "Los datos se editaron con exito");
                        echo json_encode($dados);
        }
        
  
    }
   else{
          $datos = array('mensaje' => "Error, intente nuevamente");
          echo json_encode($datos);
    };

    ?>