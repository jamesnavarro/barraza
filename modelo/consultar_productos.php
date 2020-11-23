<?php
 if(isset($_GET['cod'])){
 $sql='select * from productos where id="'.$_GET['cod'].'"';
 $fil =mysql_fetch_array(mysql_query($sql));
        $id_p= $fil["id"];
        $producto= $fil["nombre"];
        $codigo= $fil["codigo"];
        $linea= $fil["tipo"];
        $referencia= $fil["codigo_interno"];
         $registro= $fil["f_registro"];
         $precio= $fil["precio"];
 }
?>
