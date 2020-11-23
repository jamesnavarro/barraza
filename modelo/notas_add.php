<?php 
session_start();
require("conexion.php");
$status = "";

 $id_contacto_n= $_POST["contacto"];
 $asunto_n= $_POST["asunto"];
 $nota_n= $_POST["desc"];
 $area= $_POST["area"];
  $user_n= $_POST["usuario"];
 $relacion_n= $_POST["relacionado"];
 $id_seleccion_n= $_POST["con"];
$user = $_SESSION['k_username'];
$registro = date("Y-m-d H:i:s");
 if(isset($_GET['cont'])){$id_cont =$_GET['cont'];}else{$id_cont='';}
 if(isset($_GET['paciente'])){$paciente =$_GET['paciente'];}else{$paciente='';}
$rutaEnServidor='archivos';
$rutaTemporal=$_FILES["archivo"]["tmp_name"];
$nombreImagen=$_FILES["archivo"]["name"];
$rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;
$rutaDestino2=$nombreImagen;
move_uploaded_file($rutaTemporal,$rutaDestino);

 
            
        if(isset($_GET['editar'])){
                 if($rutaDestino2!=''){$ruta = "`adjunto`='".$rutaDestino2."',";}else{$ruta="";}
                $sql = "UPDATE `sis_notas` SET `asunto_n` = '".$asunto_n."',`nota_n` = '".$nota_n."', `seleccion_n` = '".$relacion_n."',`id_seleccion_n` = '".$id_seleccion_n."', `asignado_n` = '".$user_n."', $ruta `mod_n` = '".$user."'  WHERE `id_nota` = ".$_GET["editar"]." and asignado_n='".$_SESSION['k_username']."' ;";
                
                mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la nota");location.href="../vistas/?id=ver_notas&cod='.$_GET['editar'].'"</script>'; 

        }else{


        $sql = "INSERT INTO `sis_notas` (`id_paciente`,`area_n`, `asunto_n`, `nota_n`, `seleccion_n`, `id_seleccion_n`, `asignado_n`, `fecha_creacion`, `id_contacto`, `adjunto`, `creado_n`, `mod_n`)";
        $sql.= "VALUES ('".$paciente."','".$area."', '".$asunto_n."', '".$nota_n."', '".$relacion_n."', '".$id_seleccion_n."', '".$user_n."', '".$registro."', '".$id_contacto_n."', '".$rutaDestino2."', '".$user."', '".$user."')";
	mysql_query($sql, $conexion);

            $status = "ok";
$s = "SELECT max(id_nota) FROM sis_notas";
$fi =mysql_fetch_array(mysql_query($s));
$maximo= $fi["max(id_nota)"];
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente la nota");location.href="../vistas/?id=ver_notas&cod='.$maximo.'"</script>'; 

        }
                    