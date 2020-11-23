<?php

if($row["seleccion_n"]=="Producto"){
$consul= "select * from producto where id_p=".$row["id_seleccion_n"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_p'];
$nombre=$fil['producto'];
} 

$ver = '<a href="../vistas/?id=ver_productos&cod='.$id.'">'.$nombre.'</a>';
} 

if($row["seleccion_n"]=="Empresas"){
$consul= "select * from sis_empresa where id_empresa=".$row["id_seleccion_n"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_empresa'];
$nombre=$fil['nombre_emp'];
} 
$ver = '<a href="../vistas/?id=ver_empresa&cod='.$id.'">'.$nombre.'</a>';

} 
if($row["seleccion_n"]=="Contactos"){
$consul= "select * from sis_contacto where id_contacto=".$row["id_seleccion_n"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_contacto'];
$nombre=$fil['nombre_cont'].' '.$fil['apellido_cont'];
} 
$ver = '<a href="../vistas/?id=ver_contacto&cod='.$id.'">'.$nombre.'</a>';

} 
if($row["seleccion_n"]=="Contactos Potencial"){
$consul= "select * from sis_contacto where id_contacto=".$row["id_seleccion_n"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_contacto'];
$nombre=$fil['nombre_cont'].' '.$fil['apellido_cont'];
} 
$ver = '<a href="../vistas/?id=ver_contacto&cod='.$id.'">'.$nombre.'</a>';

} 
if($row["seleccion_n"]=="Tarea"){
$consul= "select * from actividad where Id=".$row["id_seleccion_n"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['Id'];
$nombre=$fil['Subject'];
} 
$ver = '<a href="../vistas/?id=ver_tarea&cod='.$id.'">'.$nombre.'</a>';

} 
if($row["seleccion_n"]=="Inicidencia"){
$consul= "select * from sis_incidencias where id_incidencia=".$row["id_seleccion_n"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_incidencia'];
$nombre=$fil['asunto_inc'];
} 
$ver = '<a href="../vistas/?id=ver_inicidencias&cod='.$id.'">'.$nombre.'</a>';

}
if($row["seleccion_n"]=="Casos"){
$consul= "select * from sis_casos where id_caso=".$row["id_seleccion_n"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_caso'];
$nombre=$fil['asunto_caso'];
} 
$ver = '<a href="../vistas/?id=ver_casos&cod='.$id.'">'.$nombre.'</a>';

}
if($row["seleccion_n"]=="Oportunidad"){
$consul= "select * from sis_oportunidades where id_oportunidad=".$row["id_seleccion_n"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_oportunidad'];
$nombre=$fil['nombre_opo'];
} 
$ver = '<a href="../vistas/?id=ver_oportunidades&cod='.$id.'">'.$nombre.'</a>';

}
if($row["seleccion_n"]=="Nota"){
$consul= "select * from sis_notas where id_nota=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_nota'];
$nombre=$fil['asunto_n'];
} 
$ver = '<a href="../vistas/?id=ver_notas&cod='.$id.'">'.$nombre.'</a>';

}
if($row["seleccion_n"]=="Documento"){
$consul= "select * from sis_notas where id_nota=".$row["id_seleccion_n"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_nota'];
$nombre=$fil['asunto_n'];
} 
$ver = '<a href="../vistas/?id=ver_notas&cod='.$id.'">'.$nombre.'</a>';

}
?>
