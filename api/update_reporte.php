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
    $orden = $objData->ordeni;
    $fecha = $objData->fecha;
    $estado = $objData->estado;
    $descripcion = $objData->descripcion;
     $solucion = $objData->solucion;
      $usuario = $objData->usuario;
       $fuente = $objData->fuente;
        $categoria = $objData->categoria;
    
    // lIMPIAR LOS DATOS 
    $orden = trim($orden);
    $fecha = trim($fecha);
    $estado = trim($estado);
    $descripcion = trim($descripcion);
    $solucion = trim($solucion);

    $fuente = trim($fuente);
    $categoria = trim($categoria);

    $date = date("Y-m-d");
    if($solucion==''){
        $est = 'Reportado';
    }else{
        $est = 'Solucionado';
    }
   
    $db = new PDO($dns, $user, $pass);

    if($db){
        if($gastar>$resta){
                 $dados = array('mensaje' => "La cantidad supera a la restante.");
                 echo json_encode($dados);
        }else{
            
        
        //se consulta la info de actividad
                    $sql2= "select count(*) from reportes where id_orden=".$orden." ";
                    $query2 = $db->prepare($sql2);
                    $query2 ->execute();
                    $fi = $query2->fetch();
                    $cx=$fi['count(*)'];  

                    if($cx!=0){
                    
                        $sql3 = "UPDATE `reportes` SET `fuente`='".$fuente."',`categoria`='".$categoria."',`asignado_r`='".$usuario."',`descripcion`='".$descripcion."', solucion='".$solucion."',estado='$est' WHERE `id_orden`='".$orden."';";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                        $dados = array('mensaje' => "Los datos se editaron con exito.");
                        echo json_encode($dados);
                              
                    
                    }else{
                        $date = date("Y-m-d");
                        
                         $sql3 = "INSERT INTO `reportes`(`fuente`,`categoria`,`id_orden`, `descripcion`, `estado`,`f_reg`,`asignado_r`) VALUES ('".$fuente."','".$categoria."','".$orden."', '".$descripcion."', '".$est."', '".$date."', '".$usuario."') ";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                        $dados = array('mensaje' => "Los datos se registraron con exito.");
                              echo json_encode($dados);
                        
                    }
                   $sql4 = "UPDATE `actividad` SET `incidencia`='1' WHERE `orden_servicio`='".$orden."';";
                        $query4 = $db->prepare($sql4);
                        $query4 ->execute();
                   
                    }
                    


        
    }
   else{
          $dados = array('mensaje' => "Error, intente nuevamente.");
          echo json_encode($dados);
    };
