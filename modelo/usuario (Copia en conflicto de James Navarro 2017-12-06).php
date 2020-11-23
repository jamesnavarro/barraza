<?php

session_start();
require("conexion.php");
$status = "";

            $u_user= $_POST["user"];
            $u_clave= md5($_POST["clave"]);
            $u_nombre= $_POST["nombre"];
            $u_apellido= $_POST["apellido"];
            $u_cedula= $_POST["cedula"];
            $u_email= $_POST["email"];
            $u_admin= $_POST["admin"];
            $u_cargo= $_POST["cargo"];
            $u_area= $_POST["area"];
            $u_telefono= $_POST["telefono"];
            $u_celular= $_POST["celular"];
            $u_direccion= $_POST["direccion"];
            $u_ciudad= $_POST["ciudad"];
            $u_municipio= $_POST["municipio"];
            $u_sede= $_POST["sede"];
            $u_estado= $_POST["estado"];
            $rol= $_POST["rol"];
            $cumple= $_POST["cumple"];
              $bar= $_POST["bar_usuario"];
            $rutaEnServidor='img_barraza';
            $rutaTemporal=$_FILES["imagen"]["tmp_name"];
            $nombreImagen=$_FILES["imagen"]["name"];

            if($nombreImagen==''){
                $rutaDestino='';
                $rutaDestino2='';
            }else{
                 $rutaDestino='../'.$rutaEnServidor.'/'.$u_user.'.png';
                 $rutaDestino2 = $u_user.'.png';
            }

            move_uploaded_file($rutaTemporal,$rutaDestino);
            
            $rutaEnServidor1='fotos_barraza';
            $rutaTemporal1=$_FILES["foto"]["tmp_name"];
            $nombreImagen1=$_FILES["foto"]["name"];

            if($nombreImagen1==''){
                $rutaDestino1='../'.$rutaEnServidor1.'/'.$nombreImagen1;
                $rutaDestino3=$nombreImagen1;
            }else{
                 $rutaDestino1='../'.$rutaEnServidor1.'/'.$u_cedula.''.$nombreImagen1;
                 $rutaDestino3 = $u_cedula.''.$nombreImagen1;
            }

            move_uploaded_file($rutaTemporal1,$rutaDestino1);

        if(isset($_GET['editar'])){
            
            if($rutaDestino2!=''){$ruta = "`ruta`='".$rutaDestino2."',";}else{$ruta="";}
            if($rutaDestino3!=''){$ruta1 = "`foto`='".$rutaDestino3."',";}else{$ruta1="";}
            
            if($_POST["clave"]==''){
                $sql = "UPDATE `usuarios` SET ".$ruta." ".$ruta1." `id_roles` = '".$rol."',"
                        . " `usuario` = '".$u_user."',"
                        . " `cedula` = '".$u_cedula."',"
                        . " `email` = '".$u_email."',"
                        . " `administrador` = '".$u_admin."',"
                        . " `nombre` = '".$u_nombre."',"
                        . " `apellido` = '".$u_apellido."',"
                        . " `estado_empleado` = '".$u_estado."',"
                        . " `descripcion` = '".$cumple."',"
                        . " `cargo` = '".$u_cargo."',"
                        . " `area` = '".$u_area."',"
                        . " `telefono` = '".$u_telefono."',"
                        . " `celular` = '".$u_celular."',"
                        . " `direccion` = '".$u_direccion."',"
                        . " `ciudad` = '".$u_ciudad."',"
                        . " `municipio` = '".$u_municipio."',"
                        . " `barrio_u` = '".$bar."',"
                        . " `sede` = '".$u_sede."' WHERE `id` =  ".$_GET["editar"].";";
             
            }else{
                $sql = "UPDATE `usuarios` SET ".$ruta." ".$ruta1." `id_roles` = '".$rol."',"
                        . " `usuario` = '".$u_user."',"
                        . " `cedula` = '".$u_cedula."',"
                        . " `email` = '".$u_email."',"
                        . " `administrador` = '".$u_admin."',"
                        . " `descripcion` = '".$cumple."',"
                        . " `password` = '".$u_clave."',"
                        . " `nombre` = '".$u_nombre."',"
                        . " `apellido` = '".$u_apellido."',"
                        . " `estado_empleado` = '".$u_estado."',"
                        . " `cargo` = '".$u_cargo."',"
                        . " `area` = '".$u_area."',"
                        . " `telefono` = '".$u_telefono."',"
                        . " `celular` = '".$u_celular."',"
                        . " `direccion` = '".$u_direccion."',"
                        . " `ciudad` = '".$u_ciudad."',"
                        . " `municipio` = '".$u_municipio."',"
                        . " `barrio_u` = '".$bar."',"
                        . " `sede` = '".$u_sede."' WHERE `id` =  ".$_GET["editar"].";";
             
            }
            
                
            
             mysql_query($sql, $conexion);
             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente el usuario '.$nombreImagen.' ");location.href="../vistas/?id=user&cod='.$_GET['editar'].'"</script>'; 
        }else{
  $sql21 = "SELECT count(id), id FROM usuarios where cedula=".$_POST['cedula'];
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $existe= $fila21["count(id)"];
            $id= $fila21["id"];
            if($existe==0){


            $sql = "INSERT INTO `usuarios` (`foto`,`ruta`,`id_roles`, `usuario`, `password`, `cedula`, `email`, `administrador`, `nombre`, `apellido`, `estado_empleado`, `cargo`, `area`, `telefono`, `celular`, `direccion`, `ciudad`, `municipio`, `sede`)";
            $sql.= "VALUES ('".$rutaDestino3."','".$rutaDestino2."','".$rol."', '".$u_user."', '".$u_clave."', '".$u_cedula."', '".$u_email."', '".$u_admin."', '".$u_nombre."', '".$u_apellido."', '".$u_estado."', '".$u_cargo."', '".$u_area."', '".$u_telefono."', '".$u_celular."', '".$u_direccion."', '".$u_ciudad."', '".$u_municipio."', '".$u_sede."');";
            mysql_query($sql, $conexion);

            $status = "ok";
            $sql21 = "SELECT max(id) FROM usuarios";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
            $max= $fila21["max(id)"];

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente la Pagina");location.href="../vistas/?id=user&cod='.$max.'"</script>'; 
            }else{
                echo '<script lanquage="javascript">alert("El usuario ya existe en la base de datos");location.href="../vistas/?id=user&cod='.$id.'"</script>'; 
                
            }
        }

        
     


?>



	
      
       
    
  
