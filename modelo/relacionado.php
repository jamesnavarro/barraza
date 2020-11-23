<?php

if($row["relacionado"]=="Producto"){
$consul= "select * from producto where id_p=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_p'];
$nombre=$fil['producto'];
} 

$ver = '<a href="../vistas/?id=ver_productos&cod='.$id.'">'.$nombre.'</a>';
} 

if($row["relacionado"]=="Empresas"){
$consul= "select * from sis_empresa where id_empresa=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_empresa'];
$nombre=$fil['nombre_emp'];
} 
$ver = '<a href="../vistas/?id=ver_empresa&cod='.$id.'">'.$nombre.'</a>';

} 
if($row["relacionado"]=="Contactos"){
$consul= "select * from sis_contacto where id_contacto=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_contacto'];
$nombre=$fil['nombre_cont'].' '.$fil['apellido_cont'];
} 
$ver = '<a href="../vistas/?id=ver_contacto&cod='.$id.'">'.$nombre.'</a>';

} 
if($row["relacionado"]=="Contactos Potencial"){
$consul= "select * from sis_contacto where id_contacto=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_contacto'];
$nombre=$fil['nombre_cont'].' '.$fil['apellido_cont'];
} 
$ver = '<a href="../vistas/?id=ver_contacto&cod='.$id.'">'.$nombre.'</a>';

} 
if($row["relacionado"]=="Tarea"){
$consul= "select * from actividad where Id=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['Id'];
$nombre=$fil['Subject'];
} 
$ver = '<a href="../vistas/?id=ver_tarea&cod='.$id.'">'.$nombre.'</a>';

} 
if($row["relacionado"]=="Inicidencia"){
$consul= "select * from sis_incidencias where id_incidencia=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_incidencia'];
$nombre=$fil['asunto_inc'];
} 
$ver = '<a href="../vistas/?id=ver_inicidencias&cod='.$id.'">'.$nombre.'</a>';

}
if($row["relacionado"]=="Casos"){
$consul= "select * from sis_casos where id_caso=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_caso'];
$nombre=$fil['asunto_caso'];
} 
$ver = '<a href="../vistas/?id=ver_casos&cod='.$id.'">'.$nombre.'</a>';

}
if($row["relacionado"]=="Oportunidad"){
$consul= "select * from sis_oportunidades where id_oportunidad=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_oportunidad'];
$nombre=$fil['nombre_opo'];
} 
$ver = '<a href="../vistas/?id=ver_oportunidades&cod='.$id.'">'.$nombre.'</a>';

}
if($row["relacionado"]=="Nota"){
$consul= "select * from sis_notas where id_nota=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_nota'];
$nombre=$fil['asunto_n'];
} 
$ver = '<a href="../vistas/?id=ver_notas&cod='.$id.'">'.$nombre.'</a>';

}
if($row["relacionado"]=="Documento"){
$consul= "select * from sis_notas where id_nota=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$id=$fil['id_nota'];
$nombre=$fil['asunto_n'];
} 
$ver = '<a href="../vistas/?id=ver_notas&cod='.$id.'">'.$nombre.'</a>';

}
if($row["relacionado"]=="Pacientes"){
 $consul= "select * from pacientes where id_paciente=".$row["id_seleccionado"];                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
   $no=$fil['nombres'].' '.$fil['apellidos'];
} 
$ver = '<a href="../vistas/?id=ver_paciente&cod='.$row["id_seleccionado"].'">'.$no.'</a>';

}
?>
