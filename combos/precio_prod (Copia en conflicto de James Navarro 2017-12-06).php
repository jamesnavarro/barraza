<?php
session_start();

include "../modelo/conexion.php";


    $conE= 'SELECT b.precio_v FROM productos a, precios_ventas b  where a.id=b.id_venta and a.codigo="'.$_POST['elegido'].'" and b.id_empresa='.$_SESSION['id_emp_pro'].' ';
    $res=  mysql_query($conE) or die(mysql_error());
    $f=  mysql_fetch_array($res);
    $precio=$f['precio_v'];
    if($precio){
        $rpta= '<input type="text" name="precio" value="'.$precio.'" readonly  placeholder="Precio del producto" >';
    }else{
        $rpta= '<input type="text" name="precio" value="" required  placeholder="Precio del producto" >';
    }
	
echo $rpta;
?>