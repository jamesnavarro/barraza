<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include "../modelo/conexion.php";
$result = mysql_query('select * from archivos where orden_interna>4479');
$c = 0;
while($r = mysql_fetch_array($result)){
    $c +=1;
    $sqlr = "UPDATE `actividad` SET `firms` = '1' WHERE `orden_servicio` = '".$r['orden_interna']."'";
    mysql_query($sqlr, $conexion);  
}
echo 'Se actualizo: '.$c;
        ?>
    </body>
</html>
