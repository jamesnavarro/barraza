<?php 

// SUMAR EN FECHAS
$fecha = date('d-m-Y');
$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'd-m-Y' , $nuevafecha );

// substraer fechas 

//de  02/25/2014
$fecha = date("m/d/Y");
 $ano = substr($fecha ,-4);
$mes = substr($fecha,0,-8);
$dia = substr($fecha ,3,-5);
$dato1 = $ano.'-'.$mes.'-'.$dia;
//a 2013-02-20


//sumar minutos
$d = '10';
$fecha2 = date("H:i",$m=strtotime('+'.$d.' minutes'));


//listbox
$consulta= "SELECT * FROM `usuarios`'";                     
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$usuario=$fila['usuario'];
echo"<option value='".$usuario."'>".$usuario."</option>";
}

// maximo de un item

$sql1 = "SELECT MAX(Id) as id FROM actividad";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$idll1 = $fila1["id"];
echo "<script language='javascript' type='text/javascript'>";     
echo "location.href='../vistas/?id=ver_llamada&cod=".$idll1."'";
echo "</script>";

//mensajes

echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente la llamada");location.href="../vistas/?id=ver_llamada&cod='.$idll1.'"</script>';



        
        
?>