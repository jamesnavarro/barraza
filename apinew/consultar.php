<?php
require_once 'headers.php';
require_once 'conector.php';

if($_SERVER['REQUEST_METHOD']=='GET'){
 
        $query = $con->query("select * from sis_contacto where concat(nombre_cont,' ',apellido_cont) like '%".$_GET['id']."%' ");
            $datos= array();
            while($result = $query->fetch_assoc()){
                    $datos[] = $result;
            }
            echo (json_encode($datos));
}
if($_SERVER['REQUEST_METHOD']=='POST'){
     $data = json_decode(file_get_contents("php://input"));
     $usuario = $data->usuario;
     $clave = $data->clave;
      $query = $con->query("SELECT usuario FROM `usuarios` where usuario='$usuario' and password='$clave' ");
      if($query){
           echo (json_encode(array('estado'=>'1')));
      }else{
           echo (json_encode(array('estado'=>'0')));
      }
}