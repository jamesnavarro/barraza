<?php 
session_start();
require("conexion.php");
$status = "";
$orden= $_POST["doc"];
$user = $_SESSION['k_username'];

$rutaEnServidor='documentos';
$rutaTemporal=$_FILES["archivo"]["tmp_name"];
$nombreImagen=$_FILES["archivo"]["name"];
$rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;
$rutaDestino2=$nombreImagen;
move_uploaded_file($rutaTemporal,$rutaDestino);

 
            
        if(isset($_GET['editar'])){
                 if($rutaDestino2!=''){$ruta = "`ruta`='".$rutaDestino2."',";}else{$ruta="";}
                $sql = "UPDATE `formatos` SET  `nombre` = '".$orden."', $ruta `registrado_por` = '".$user."'  WHERE `id_nota` = ".$_GET["editar"]." and asignado_n='".$_SESSION['k_username']."' ;";            
                mysql_query($sql, $conexion);
                 echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente el documento");location.href="../vistas/?id=formatos"</script>'; 

        }else{


        $sql = "INSERT INTO `formatos` (`nombre`,`ruta`, `registrado_por`)";
        $sql.= "VALUES ('".$orden."','".$rutaDestino2."', '".$user."')";
	mysql_query($sql, $conexion);


            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente es documento");location.href="../vistas/?id=formatos"</script>'; 

        }
