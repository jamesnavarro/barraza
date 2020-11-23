<?php 
session_start();
require("conexion.php");
$status = "";

 $a2= $_POST["2"];
 $a3= $_POST["3"];
 $a4= $_POST["4"];
 $a104= $_POST["104"];
  $a20= $_POST["20"];
 $a6= $_POST["6"];
 $a7= $_POST["7"];

 $a12= $_POST["12"];
 $a13= $_POST["13"];
 $a15= $_POST["15"];
 $a18= $_POST["18"];

 $obs= $_POST["105"];

$rutaEnServidor='archivos';
$rutaTemporal=$_FILES["archivo"]["tmp_name"];
$nombreImagen=$_FILES["archivo"]["name"];
$rutaDestino='../'.$rutaEnServidor.'/'.$nombreImagen;
$rutaDestino2=$nombreImagen;
move_uploaded_file($rutaTemporal,$rutaDestino);

 
            
        if(isset($_GET['editar'])){
                 if($rutaDestino2!=''){$ruta = "`archivo`='".$rutaDestino2."',";}else{$ruta="";}
                $sql = "UPDATE `informacion` SET `cedula` = '".$a20."',`estado` = '".$a104."', `obs` = '".$obs."',`fecha` = '".$a2."', `empleo` = '".$a3."', `codigo` = '".$a4."', $ruta `nombres` = '".$a6."', `apellidos` = '".$a7."', `telefono` = '".$a12."', `celular` = '".$a13."', `correo` = '".$a18."', `profesion` = '".$a15."' WHERE `id_info` = ".$_GET["editar"].";";
                
                mysql_query($sql, $conexion);

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion de la hoja de vida de '.$a6.' '.$a7.'");location.href="../vistas/?id=hv"</script>'; 

        }else{


            $sql = "INSERT INTO `informacion` (`obs`,`fecha`, `empleo`, `codigo`, `estado`, `archivo`, `cedula`, `nombres`, `apellidos`, `telefono`, `celular`, `correo`, `profesion`, `user`) ";
            $sql.= "VALUES ('".$obs."', '".$a2."', '".$a3."', '".$a4."', '".$a104."', '".$rutaDestino2."', '".$a20."', '".$a6."', '".$a7."', '".$a12."', '".$a13."', '".$a18."', '".$a15."', '".$_SESSION['k_username']."')";
            mysql_query($sql, $conexion);

            $status = "ok";
$s = "SELECT max(id_info) FROM informacion";
$fi =mysql_fetch_array(mysql_query($s));
$maximo= $fi["max(id_info)"];
   

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente el archivo de la hoja de vida");location.href="../vistas/?id=add_hv&cod='.$maximo.'"</script>'; 

        }
                    