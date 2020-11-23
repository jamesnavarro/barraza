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
    $rad = $objData->rad;
    $asunto = $objData->asunto;
    $estado = $objData->estado;
    $fecha = $objData->fecha;
     $hora = $objData->hora;
     $conclucion = $objData->conclucion;
      $usuario = $objData->usuario;
    
    // lIMPIAR LOS DATOS 
    $asunto = trim($asunto);
    $estado = trim($estado);
    $fecha = trim($fecha);
    $hora = trim($hora);
    $conclucion = trim($conclucion);
    $date = $fecha.' '.$hora;
   if($conclucion==''){
       $estado = 'No iniciada';
   }else{
        $estado = 'Completada';
   }
   
    $db = new PDO($dns, $user, $pass);

    if($db){
    
 
        //se consulta la info de actividad
                    $sql2= "select count(*) from actividades where Id=".$rad." ";
                    $query2 = $db->prepare($sql2);
                    $query2 ->execute();
                    $fi = $query2->fetch();
                    $cx=$fi['count(*)'];  

                    if($cx!=0){
                    
                        $sql3 = "UPDATE `actividades` SET `user`='".$usuario."',`Subject`='".$asunto."', StartTime='".$date."',Description='$conclucion',estado='$estado' WHERE `id_orden`='".$orden."';";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                        $dados = array('mensaje' => "Los datos se editaron con exito.");
                        echo json_encode($dados);
                              
                    
                    }else{
                        
                         $sql3 = "INSERT INTO `actividades`(`Subject`, `StartTime`, `EndTime`,`user`,`Description`,`estado`,`tarea`,`aviso`,`reg_user`) VALUES ('".$asunto."', '".$date."', '".$date."', '".$usuario."', '".$conclucion."','No iniciada','tarea','Si', '".$usuario."') ";
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
