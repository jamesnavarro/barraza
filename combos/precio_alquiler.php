<?php
session_start();

include "../modelo/conexion.php";


    $conE= 'SELECT a.precio_alquiler FROM precios_alquiler a, alquiler b WHERE a.id_alquiler=b.id AND b.codigo="'.$_POST['elegido'].'" and a.id_empresa='.$_SESSION['id_emp_pro'].' ';
    $res=  mysql_query($conE) or die(mysql_error());
    $f=  mysql_fetch_array($res);
    $precio=$f['precio_alquiler'];
    if($precio){
        $rpta= '<input type="text" name="precio_alq" value="'.$precio.'" readonly  placeholder="Precio del producto" >';
        echo $precio;
    }else{
        $rpta= '<input type="text" name="precio_alq" value="" required  placeholder="Precio del producto" >';
        echo 0;
    }
	

?>