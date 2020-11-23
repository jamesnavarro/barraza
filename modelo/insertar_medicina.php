<?php
session_start();
require("conexion.php");
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

    if (isset($_POST["nombre"])&& isset($_POST["codigo"])){
if ($_POST["nombre"] == "" && $_POST["codigo"] == "") {
     echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/?id=medicamentos"</script>';
}else{
    if (isset($_GET['editar'])){
	$nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $concentracion = $_POST["concentracion"];
        $forma = $_POST["forma"];
         $precio = $_POST["precio"];
        
       $fecha_mod_p = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
     
       
      
       $sql = "UPDATE `medicamentos` SET `nombre_medicamento`='".$nombre."',`codigo`='".$codigo."',`concentracion`='".$concentracion."',`forma`='".$forma."',`precio_med`='".$precio."',`f_modificacion`='".$fecha_mod_p."' WHERE `id_medicina`='".$_GET['editar']."';";
      
       mysql_query($sql);
              $con= "SELECT * FROM medicamentos WHERE `id_medicina`='".$_GET['editar']."'";
$res=  mysql_query($con);
$f=  mysql_fetch_array($res);
$nombre=$f['nombre_medicamento'];
$codigo=$f['codigo'];
$concentracion=$f['concentracion'];
$forma=$f['forma'];
$precio=$f['precio_med'];

       $status = "ok";
         echo '<script lanquage="javascript">alert("Datos actualizados:'.$nombre.', codigo:'.$codigo.', Concentracion :'.$forma.', Forma :'.$forma.' , Precio modificado :'.$precio.'");location.href="../vistas/?id=medicamentos"</script>';
    }else{
	
	$nombre = $_POST["nombre"];
        $codigo = $_POST["codigo"];
        $concentracion = $_POST["concentracion"];
        $forma = $_POST["forma"];
        $precio = $_POST["precio"];
        $fecha_registro_p = date("Y-m-d").' '.$hora;
       $fecha_mod_p = date("Y-m-d").' '.$hora;
       
	$sqla = "SELECT max(id_medicina) FROM medicamentos";
        $filaa =mysql_fetch_array(mysql_query($sqla));
        $max = $filaa["max(id_medicina)"]+1;
        $codi= $_POST["codigo"].'-'.$max;

	$sql = "INSERT INTO medicamentos(`codigo`, `nombre_medicamento`, `concentracion`, `forma`, `precio_med`, `f_modificacion`, `f_registro`, `codigo_int`)";

        $sql.= "VALUES ('".$codigo."','".$nombre."', '".$concentracion."','".$forma."','".$precio."', '".$fecha_registro_p."', '".$fecha_mod_p."', '".$codi."')";

	mysql_query($sql);

	$status = "ok";
         echo "<script language='javascript' type='text/javascript'>";
      
        echo "location.href='../vistas/?id=medicamentos'";
      
        echo "</script>";
        
        
    }}}
?>
 