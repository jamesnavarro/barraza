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
    $codigo = $objData->codigo;
    $paciente = $objData->paciente;
    $estado = $objData->estado;
    $tipo = $objData->tipo;
     $clasificacion = $objData->clasificacion;
     $fecha = $objData->fecha;
      $descripcion = $objData->descripcion;
      $usuario = $objData->user;
    
    // lIMPIAR LOS DATOS 
    $codigo = trim($codigo);
    $paciente = trim($paciente);
    $estado = trim($estado);
    $tipo = trim($tipo);
    $clasificacion = trim($clasificacion);
    $descripcion = trim($descripcion);
    $date = date("Y-m-d");

   
    $db = new PDO($dns, $user, $pass);

    if($db){
    
 
        //se consulta la info de actividad
                    $sql2= "select count(*) from eventos where id_evento=".$codigo." ";
                    $query2 = $db->prepare($sql2);
                    $query2 ->execute();
                    $fi = $query2->fetch();
                    $cx=$fi['count(*)'];  

                    if($cx!=0){
                    
                        $sql3 = "UPDATE `eventos` SET `descripcion`='".$descripcion."',`clasificacion2`='".$tipo."', clasificacion='".$clasificacion."', estado='".$estado."' WHERE `id_evento`='".$codigo."';";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                        $dados = array('mensaje' => "Los datos se editaron con exito.");
                        echo json_encode($dados);
                              
                    
                    }else{
                        
                         $sql3 = "INSERT INTO `eventos`(`id_paciente`, `usuario`, `clasificacion`,`descripcion`,`asignado`,`clasificacion2`,`fecha_registro`,`estado`,`analisis`) 
                         VALUES ('".$paciente."', '".$usuario."', '".$clasificacion."', '".$descripcion."','acarranza','".$tipo."','".$date."', '".$estado."','0') ";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                        $dados = array('mensaje' => "Los datos se registraron con exito.");
                              echo json_encode($dados);
                        
                    }

                   
        
    }
   else{
          $dados = array('mensaje' => "Error, intente nuevamente.");
          echo json_encode($dados);
    }
