<?php
header("Access-Control-Allow-Origin: *");
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
    $name = $objData->valoracion;
    $price = $objData->tratamiento;
    $fecha = $objData->fecha;
    
    $pa = $objData->pa;
    $pulso = $objData->pulso;
    $fr = $objData->fr;
    $us = $objData->user;
    
    // lIMPIAR LOS DATOS 
    $id = trim($id);
    
    $pa = trim($pa);
    $pulso = trim($pulso);
    $fr = trim($fr);
    $us = trim($us);
    
    $name = stripslashes($name);
    $price = stripslashes($price);
    $fecha = stripslashes($fecha);
    $name = trim($name);
    $price = trim($price);
    $fecha = trim($fecha);
    $use = trim($us);
    if($name==''){
            $estado_t = 'No iniciada';
        }else{
            $estado_t = 'Completada';
        }
   
    $db = new PDO($dns, $user, $pass);

    if($db){
        //se consulta la info de actividad
        $result = $db->prepare("SELECT contador,acceso,orden_servicio,archivo,cod_aten,vdias,cant_ins,EndTime,positivo,negativo,cant,id_paciente,orden_externa FROM actividad where Id='".$id."'");
        $result->execute();
        $fi = $result->fetch();
        $contador = $fi["contador"];
        $acceso = $fi["acceso"];
        $a = $fi["orden_servicio"];
        $arc = $fi["archivo"];
        $codaten = $fi["cod_aten"];
        $vdias = $fi["vdias"]+1;
        $b = $fi["cant_ins"];
        $fechafin = $fi["EndTime"];
        $positivo = $fi["positivo"];
        $negativo = $fi["negativo"];
        $c = $fi["cant"];
        $paciente = $fi["id_paciente"];
        $oe = $fi["orden_externa"];
        //se verifica si en el archivo hay mas atenciones primero
        $result2 = $db->prepare("select count(orden_servicio) from actividad where archivo ='$arc' and cod_aten='$codaten' and user='".$use."'  and id_contacto<=98 and orden_servicio!='$a' and id_contacto!='' ");
        $result2->execute();
        $h = $result2->fetch();
        if($h[0]>0){
            $dados = array('mensaje' => "Debes de terminar primero las atenciones de la misma descripcion ");
                   echo json_encode($dados);
            
        }else{
            if($contador>=$vdias && $acceso==date("Y-m-d")){
               
               $dados = array('mensaje' => "Usted no puede ingresar mas de 2 atenciones diarias ");
                   echo json_encode($dados);
            }else{
                    if($fecha==date("Y-m-d")){
                        $puntos = 1;
                    }else{
                        $puntos = 0;
                    }

                    $sql = " UPDATE actividad SET urgente='No', puntos='".$puntos."', PA='".$pa."',PULSO='".$pulso."',FR='".$fr."', Valoracion='".$name."',inf_adicional='".$price."', estado='".$estado_t."', fecha_mod_ta='".$fecha."', registro='".date("Y-m-d")."' WHERE Id =".$id;
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
                     
                     // se suma las actividades completadas
                     $result3 = $db->prepare("SELECT sum(puntos) FROM actividad where orden_servicio='".$a."'");
                     $result3->execute();
                     $p = $result3->fetch();
                     $d = $c - $p[0];
                     $px = $d/$c;
                     $to = $px * 100;
                     $tx = 100 - $to;
                     // se actualiza los puntos de la atencion
                        $dias = $fi["vdias"]+1;
                        $fecha = date('Y-m-d');
                        $nuevafecha = strtotime( '+'.$dias.' day' , strtotime($fecha));
                        $vencimiento = date('Y-m-d' , $nuevafecha);
                        if($acceso==date("Y-m-d")){
                         $sql2 = "UPDATE `actividad` SET `efectivo`='".$tx."',`escore`='".$p[0]."',`vencimiento`='".$vencimiento."',`id_seleccionado`='".$b."', contador=contador+1, acceso='".date("Y-m-d")."' WHERE  `orden_servicio`='".$a."'";
                        
                        }else{
                            $sql2 = "UPDATE `actividad` SET `efectivo`='".$tx."',`escore`='".$p[0]."',`vencimiento`='".$vencimiento."',`id_seleccionado`='".$b."', contador=1, acceso='".date("Y-m-d")."' WHERE  `orden_servicio`='".$a."'";   
                        }
                     $query2 = $db->prepare($sql2);
                     $query2 ->execute();
                     //se saca el porcentaje total de la atencion
                     $result4 = $db->prepare("select sum(porcentaje) as total from actividad where estado='Completada' and orden_servicio='".$a."' ");
                     $result4->execute();
                     $fila = $result4->fetch();
                        $total=$fila['total'];
                        if($fechafin > date("Y-m-d")){
                            $pos = $total;
                            $neg = $negativo;
                        }else{
                            $pos = $positivo;
                            $neg = $total-$positivo;
                        }
                        $sql3 = "UPDATE `actividad` SET `id_contacto`='".$total."',`positivo`='".$pos."',`negativo`='".$neg."' WHERE `orden_servicio`='".$a."';";
                        $query3 = $db->prepare($sql3);
                        $query3 ->execute();
                        
                        //se actualiza las ordenes externas
                        $sql20 = "SELECT count(orden_externa) AS oe FROM actividad where `orden_externa`='".$oe."' limit 1";
                        $query4 = $db->prepare($sql20);
                        $query4 ->execute();
                        $fila20 = $query4->fetch();
                        $cont = $fila20["oe"];

                        $sql40 = "SELECT count(orden_externa) FROM actividad where estado='Completada' and `orden_externa`='".$oe."'";
                        $query5 = $db->prepare($sql40);
                        $query5 ->execute();
                        $fila40 = $query5->fetch();
                        $contc = $fila40["count(orden_externa)"];

                        $total = 100 * $contc / $cont;

                         $sql30 = "UPDATE `actividad` SET `por_ext`='".$total."' WHERE  `orden_externa`='".$oe."'";
                          $query6 = $db->prepare($sql30);
                          $query6 ->execute();

                         if($total > 98){
                             $sql31 = "UPDATE `actividad` SET `aviso`='Completada' WHERE  `orden_externa`='".$oe."'";
                             $query7 = $db->prepare($sql31);
                             $query7 ->execute();
                         }

                        $sql32 = "UPDATE `pacientes` SET `ultima_atencion`='".$fecha."' WHERE  `id_paciente`='".$paciente."'";
                        $query8 = $db->prepare($sql32);
                        $query8 ->execute();
                     
                        
                     
                }
         }
    }
   else{
          $dados = array('mensaje' => "Error, intente nuevamente.");
          echo json_encode($dados);
    };
