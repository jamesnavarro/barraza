<?php
include "../modelo/conexion.php";

$consulta= "select * from actividades WHERE  Id=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_lla=$fila['Id'];
$asunto_lla=$fila['Subject'];
$lugar=$fila['Location'];
$fecha_inicio_lla=$fila['StartTime'];
$fecha_vencimiento_lla=$fila['EndTime'];
$duracion=$fila['duracion'];
$aviso_lla=$fila['aviso'];
$descripcion_lla=$fila['Description'];
$estado_lla=$fila['prioridad'];
$estado_2_lla=$fila['estado'];
$asignado_lla=$fila['user'];
$relacion_lla=$fila['relacionado'];
$id_seleccionado_lla=$fila['id_seleccionado'];
$id_contacto_lla =$fila['id_contacto'];
$id_paciente =$fila['id_paciente'];
$id_empresa_lla=$fila['id_empresa'];
$fecha_registro_lla=$fila['fecha_reg_ta'];
$fecha_registro_mod_lla=$fila['fecha_mod_ta'];
$area_act=$fila['area_act'];
$reg_user=$fila['reg_user'];
$mod_user=$fila['mod_user'];

            $ano = substr($fecha_inicio_lla, 0,4);
            $mes = substr($fecha_inicio_lla,5,-12);
            $dia = substr($fecha_inicio_lla ,8,-9);
            $hour = substr($fecha_inicio_lla ,11,-3);
            
            $date = $mes.'/'.$dia.'/'.$ano;
            
            $ano2 = substr($fecha_vencimiento_lla, 0,4);
            $mes2 = substr($fecha_vencimiento_lla,5,-12);
            $dia2 = substr($fecha_vencimiento_lla ,8,-9);
            $hour2 = substr($fecha_vencimiento_lla ,11,-3);
            
            $date2 = $mes2.'/'.$dia2.'/'.$ano2;
                                
 }

                                                             include "../modelo/conexion.php";
                                                            
                                                                 
                                                             if($relacion_lla!=""){
                                                             if($relacion_lla=="Producto"){
                                                             $consul= "select * from producto where id_p=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $id=$fil['id_p'];
                                                             $nombre=$fil['producto'];
                                                             } 
                                                                
                                                                $ver = '<a href="../vistas/?id=ver_productos&cod='.$id_seleccionado_lla.'">'.$nombre.'</a>';
                                                             } 
                                                             if($relacion_lla=="Empresas"){
                                                             $consul= "select * from sis_empresa where id_empresa=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $id=$fil['id_empresa'];
                                                             $nombre=$fil['nombre_emp'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_empresa&cod='.$id_seleccionado_lla.'">'.$nombre.'</a>';
                                                             
                                                             } 
                                                         
                                                             if($relacion_lla=="Incidencia"){
                                                             $consul= "select * from sis_incidencias where id_incidencia=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                         
                                                             $id=$fil['id_incidencia'];
                                                             $nombre=$fil['asunto_inc'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_incidencias&cod='.$id_seleccionado_lla.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                       
                                                         
                                                             if($relacion_lla=="Casos"){
                                                             $consul= "select * from sis_casos where id_caso=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                              $id=$fil['id_caso'];
                                                             $nombre=$fil['asunto_caso'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_casos&cod='.$id_seleccionado_lla.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             if($relacion_lla=="Contactos"){
                                                             $consul= "select * from sis_contacto where id_contacto=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $no=$fil['nombre_cont'];
                                                             $no1=$fil['apellido_cont'];
                                                             $id=$fil['id_contacto'];
                                                             $nombre=$fil['nombre_cont'].' '.$fil['apellido_cont'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_contacto&cod='.$id_seleccionado_lla.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             if($relacion_lla=="Contacto Potencial"){
                                                             $consul= "select * from sis_contacto_potencial where id_contacto_pot=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $no=$fil['nombre_cont'];
                                                             $no1=$fil['apellido_cont'];
                                                            $id=$fil['id_contacto'];
                                                             $nombre=$fil['nombre_cont'].' '.$fil['apellido_cont'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_contacto&cod='.$id_seleccionado_lla.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             if($relacion_lla=="Oportunidad"){
                                                             $consul= "select * from sis_oportunidades where id_oportunidad=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                              $id=$fil['id_oportunidad'];
                                                             $nombre=$fil['nombre_opo'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_oportunidades&cod='.$id_seleccionado_lla.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             if($relacion_lla=="Proyectos"){
                                                             $consul= "select * from sis_proyecto where id_proyecto=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                              $id=$fil['id_proyecto'];
                                                             $nombre=$fil['nombre_pro'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_proyectos&cod='.$id_seleccionado_lla.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             
                                                             if($relacion_lla=="Nota"){
                                                             $consul= "select * from actividad where Id=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $no=$fil['Subject'];
                                                           
                                                             }
                                                             $ver = '<a href="../vistas/?id=ver_notas&cod='.$id_seleccionado_lla.'">'.$no.'</a>';
                                                             
                                                             }
                                                              if($relacion_lla=="Pacientes"){
                                                             $consul= "select * from pacientes where id_paciente=".$id_seleccionado_lla;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $no=$fil['nombres'].' '.$fil['apellidos'];
                                                           
                                                             }
                                                             $ver = '<a href="../vistas/?id=ver_paciente&cod='.$id_seleccionado_lla.'">'.$no.'</a>';
                                                             
                                                             }
                                                             }else{
                                                                 $ver = 'N/A';
                                                                 $id_r ='N/A';
                                                                 
                                                             }
?>

