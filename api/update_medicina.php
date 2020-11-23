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
    $id = $objData->ida;
    $resta = $objData->resta;
    $usadas = $objData->usadas;
    $gastar = $objData->gastar;
     $id_visita = $objData->visita;
    
    // lIMPIAR LOS DATOS 
    $id = trim($id);
    $resta = trim($resta);
    $usadas = trim($usadas);
    $gastar = trim($gastar);
    
   
    $db = new PDO($dns, $user, $pass);

    if($db){
        if($gastar>$resta){
                 $dados = array('mensaje' => "La cantidad supera a la restante.");
                 echo json_encode($dados);
        }else{
            
        
        //se consulta la info de actividad
                    $sql2= "select count(*) from cant_medicina where id_visita=".$id_visita." and id_medicina=".$id." ";
                    $query2 = $db->prepare($sql2);
                    $query2 ->execute();
                    $fi = $query2->fetch();
                    $cx=$fi['count(*)'];  

                    if($cx!=0){
                    
                        $sql3 = "UPDATE `cant_medicina` SET `cantidad_med`='".$gastar."' WHERE `id_medicina`='".$id."' and id_visita='".$id_visita."';";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                    
                    }else{
                        
                         $sql3 = "INSERT INTO `cant_medicina`(`id_visita`, `cantidad_med`, `id_medicina`) VALUES ('".$id_visita."', '".$gastar."', '".$id."') ";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                        
                    }
                    
                    $sql = "UPDATE `medicamentos_asig` SET `cantidad_usada`=cantidad_usada+'".$gastar."', `cantidad_rest`=cantidad_rest-'".$gastar."' WHERE `id`='".$id."';";
                    $query = $db->prepare($sql);
                    $query ->execute();
                    
                    if(!$query){
                               $dados = array('mensaje' => "No es posible editar los datos");
                               echo json_encode($dados);
                     }
                     else{
                               $dados = array('mensaje' => "Los datos se editaron con exito.");
                              echo json_encode($dados);
                     }
                    }
                    


        
    }
   else{
          $dados = array('mensaje' => "Error, intente nuevamente.");
          echo json_encode($dados);
    };
