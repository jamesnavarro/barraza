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
    $ida = $objData->ida;
    $orden = $objData->orden;
    $loca = $objData->loca;
    $esta = $objData->esta;
     $clari = $objData->clari;
     $dime1 = $objData->dime1;
      $dime2 = $objData->dime2;
      $dime3 = $objData->dime3;
      $base = $objData->base;
      $teji = $objData->teji;
      $exsu = $objData->exsu;
      $cantex = $objData->cantex;
      $pielcir = $objData->pielcir;
      $pielcolo = $objData->pielcolo;
      $signos = $objData->signos;
      $olor = $objData->olor;
      $dolor = $objData->dolor;
      $cara = $objData->cara;
    
    // lIMPIAR LOS DATOS 
    $ida = trim($ida);
    $orden = trim($orden);
    $loca = trim($loca);
    $esta = trim($esta);
    $clari = trim($clari);
    $dime1 = trim($dime1);
    $dime2 = trim($dime2);
    $dime3 = trim($dime3);
    $base = trim($base);
    $teji = trim($teji);
    $exsu = trim($exsu);
    $cantex = trim($cantex);
    $pielcir = trim($pielcir);
    $pielcolo = trim($pielcolo);
    $signos = trim($signos);
    $olor = trim($olor);
    $dolor = trim($dolor);
    $cara = trim($cara);
    $date = date("Y-m-d");

   $dimencion = $dime1.'x'.$dime2.'x'.$dime3;
    $db = new PDO($dns, $user, $pass);

    if($db){
    
 
        //se consulta la info de actividad
                    $sql2= "select count(*) from curaciones where id_visita=".$ida." and orden_interna=".$orden." ";
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
                        
                         $sql3 = "INSERT INTO `curaciones` (`id_visita`, `visita_numero`, `curacion_no`, `localizacion`, `estadio`, `clarificacion`, `dimencion`, `c1`, `c2`, `c3`, `c4`, `c5`, `base_herida`, `tejido`, `exusado`, `cant_exusado`,`piel_circundante`, `piel_color`, `infeccion`, `olor`, `dolor`, `orden_interna`) 
                         VALUES ('".$ida."', '".$ida."', '1', '".$loca."','".$esta."','".$clari."', '".$dimencion."', '".$cara."', '".$cara."', '".$cara."', '".$cara."', '".$cara."', '".$base."', '".$teji."', '".$exsu."', '".$cantex."', '".$pielcir."', '".$pielcolo."', '".$signos."', '".$olor."', '".$dolor."', '".$orden."') ";
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
