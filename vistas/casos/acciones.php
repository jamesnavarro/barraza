<?php

include '../../modelo/conexion.php';

$rad = $_POST['rad'];
$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];
$d = $_POST['d'];
$e = $_POST['e'];
$fe = $_POST['fe'];
$g = $_POST['g'];
$h = $_POST['h'];
$ana = $_POST['ana'];
$imp = $_POST['imp'];
$pro = $_POST['pro'];
$acc = $_POST['acc'];
$est = $_POST['est'];

$ver = mysql_query("select count(id_evento) from eventos_sub where id_evento='$rad' ");
$f = mysql_fetch_array($ver);
echo $f[0];
if($f[0]==0){
    
    mysql_query("insert into eventos_sub (id_evento,a,b,c,d,e,fe,g,h,des_analisis,impacto,probabilidad, acciones,estado_evento)"
            . " values ('$rad','$a','$b','$c','$d','$e','$fe','$g','$h','$ana','$imp','$pro','$acc','$est')");
    mysql_query("update eventos set estado='$est' where id_evento='$rad' ");
}else{
    
    mysql_query("update eventos_sub set a='$a',b='$b',c='$c',d='$d',e='$e',fe='$fe',g='$g',h='$h',des_analisis='$ana',impacto='$imp',probabilidad='$pro',acciones='$acc',estado_evento='$est' where id_evento='$rad'  ");
    mysql_query("update eventos set estado='$est' where id_evento='$rad' ");
    
}




