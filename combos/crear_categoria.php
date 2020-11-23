<?php
include "../modelo/conexion.php";
$rpta="";

   if($_POST['elegidoc']=='1'){
        $con= "SELECT * FROM `categorias`";
        $res=  mysql_query($con);
        $rpta= $rpta.'<select name="categoria"><option value="">Seleccione</option>';
        while($f=  mysql_fetch_array($res)){

        $c=$f['categoria'];
        $rpta= $rpta.'<option value="'.$c.'">'.$c.'</option>';
        }
        $rpta= $rpta.'</select>';
   }else{
       $rpta= $rpta.'<input type="text" name="categoria" value="">';
   }
   
echo $rpta;