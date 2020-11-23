<?php
require_once 'headers.php';
require_once 'conector.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id'])){
            $id = " and id_contacto=".$_GET['id']." ";
        }else{
            $id = '';
        }
        $query = $con->query("select * from sis_contacto where estado like '%%' $id ");
            $datos= array();
            while($result = $query->fetch_assoc()){
                    $datos[] = $result;
            }
            echo (json_encode($datos));
}
if($_SERVER['REQUEST_METHOD']=='POST'){
     $data = json_decode(file_get_contents("php://input"));
      $query = $con->query("insert into sis_contacto(nombre_cont,apellido_cont,cargo,estado) "
              . "values ('".$data->nombre."','".$data->apellido."','".$data->cargo."','".$data->estado."') ");
      if($query){
          $data -> id = $con->insert_id;
           echo (json_encode($data));
      }else{
          
           echo (json_encode(array('stado'=>'error')));
      }
}
if($_SERVER['REQUEST_METHOD']=='PUT'){
    if(isset($_GET['id'])){
        $id = $con->real_escape_string($_GET['id']);
        $data = json_decode(file_get_contents("php://input"));
         $query = $con->query("update sis_contacto set nombre_cont='".$data->nombre."', apellido_cont='".$data->apellido."',estado='".$data->estado."' where id_contacto='$id' ");
      if($query){
           echo (json_encode(array('estado'=>'guardado')));
      }else{
           echo (json_encode(array('estado'=>'error')));
      }
         
    }else{
         echo (json_encode(array('estado'=>'sin datos')));
    }
}
if($_SERVER['REQUEST_METHOD']=='DELETE'){
     if(isset($_GET['id'])){
        $id = $con->real_escape_string($_GET['id']);
        $data = json_decode(file_get_contents("php://input"));
         $query = $con->query("delete from sis_contacto  where id_contacto='$id' ");
      if($query){
           echo (json_encode(array('estado'=>'eliminado')));
      }else{
           echo (json_encode(array('estado'=>'error')));
      }
         
    }else{
         echo (json_encode(array('estado'=>'sin datos')));
    }
}
