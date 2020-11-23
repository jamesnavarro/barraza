<?php
session_start();

include "../modelo/conexion.php";
$rpta="";
if (isset($_POST["elegido"])) {

    $con= 'SELECT * FROM productos a, precios_ventas b  where a.id=b.id_venta and a.codigo="'.$_POST['elegido'].'" and b.id_empresa='.$_SESSION['id_emp_pro'].' ';
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){

    $precio=$f['precio_v'];
    
    
    $rpta= '<input type="text" name="precio" value="'.$precio.'" readonly  placeholder="Precio del producto" >';
    }
  	
}

	
echo $rpta;
?>