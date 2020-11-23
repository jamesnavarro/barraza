<?php
header("Access-Control-Allow-Origin:http://localhost:8100");
header("Content-Type: application/x-www-form-urlencoded");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    
    //PARAMETROS DE LA BASE DE DATOS 
  $dns = "mysql:host=localhost;dbname=softmedi_barraza";
$user = "softmedi_idb";
$pass = "jnavarro2018";

    //RECUPERAR DATOS DEL FORMULARIO
    $data = file_get_contents("php://input");
    $objData = json_decode($data);
    
    // ASIGNAR LOS VALORES A LA VARIABLE
    $name = $objData->name;
    $price = $objData->price;
    
    // lIMPIAR LOS DATOS 
    $name = stripslashes($name);
    $price = stripslashes($price);
    $name = trim($name);
    $price = trim($price);
    
   
    $db = new PDO($dns, $user, $pass);
   
    if($db){
        $sql = "select * from usuarios where usuario='".$name."' and password='".md5($price)."'";
        $query = $db->prepare($sql);
        $query ->execute();
        $r = $query->fetch();
        if(!$r){
                   $datos = array('mensaje' => "0");
                   echo json_encode($datos);
                   $_SESSION['usuario'] = $name;
         }
        else{
                   $datos = array('mensaje' => $r['usuario']);
                  echo json_encode($datos);
         };
    }
   else{
          $datos = array('mensaje' => "Error, intente nuevamente");
          echo json_encode($datos);
    };

    ?>