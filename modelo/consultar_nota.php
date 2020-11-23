<?php
include "../modelo/conexion.php";

if(isset($_GET["cod"])){
$consulta= "select * from sis_notas WHERE  id_nota=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_no=$fila['id_nota'];
$asunto_no=$fila['asunto_n'];
$nota_no=$fila['nota_n'];
$area=$fila['area_n'];
$seleccion_no=$fila['seleccion_n'];
$id_seleccion_no=$fila['id_seleccion_n'];
$user_no=$fila['asignado_n'];
$fecha_r_no=$fila['fecha_creacion'];
$fecha_m_no=$fila['fecha_modificacion'];
$id_contacto_no=$fila['id_contacto'];
$id_paciente=$fila['id_paciente'];
$adjunto=$fila['adjunto'];
$reg=$fila['creado_n'];
$mod=$fila['mod_n'];
                                
}}
   include "../modelo/conexion.php";
                                                            
                                                                 
                                                             if($seleccion_no!=""){
                                                              if($seleccion_no=="Producto"){
                                                             $consul= "select * from producto where id_p=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $id=$fil['id_p'];
                                                             $nombre=$fil['producto'];
                                                             } 
                                                                
                                                                $ver = '<a href="../vistas/?id=ver_productos&cod='.$id_seleccion_no.'">'.$nombre.'</a>';
                                                             } 
                                                             if($seleccion_no=="Empresas"){
                                                             $consul= "select * from sis_empresa where id_empresa=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $id=$fil['id_empresa'];
                                                             $nombre=$fil['nombre_emp'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_empresa&cod='.$id_seleccion_no.'">'.$nombre.'</a>';
                                                             
                                                             } 
                                                            if($seleccion_no=="Incidencia"){
                                                             $consul= "select * from sis_incidencias where id_incidencia=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                         
                                                             $id=$fil['id_incidencia'];
                                                             $nombre=$fil['asunto_inc'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_incidencias&cod='.$id_seleccion_no.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                       
                                                         
                                                             if($seleccion_no=="Casos"){
                                                             $consul= "select * from sis_casos where id_caso=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                              $id=$fil['id_caso'];
                                                             $nombre=$fil['asunto_caso'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_casos&cod='.$id_seleccion_no.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             if($seleccion_no=="Contactos"){
                                                             $consul= "select * from sis_contacto where id_contacto=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $no=$fil['nombre_cont'];
                                                             $no1=$fil['apellido_cont'];
                                                          
                                                             $nombre=$fil['nombre_cont'].' '.$fil['apellido_cont'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_contacto&cod='.$id_seleccion_no.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             if($seleccion_no=="Contacto Potencial"){
                                                             $consul= "select * from sis_contacto_potencial where id_contacto_pot=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $no=$fil['nombre_cont'];
                                                             $no1=$fil['apellido_cont'];
                                                          
                                                             $nombre=$fil['nombre_cont'].' '.$fil['apellido_cont'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_contacto&cod='.$id_seleccion_no.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             if($seleccion_no=="Oportunidad"){
                                                             $consul= "select * from sis_oportunidades where id_oportunidad=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                              $id=$fil['id_oportunidad'];
                                                             $nombre=$fil['nombre_opo'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_opotunidades&cod='.$id_seleccion_no.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             if($seleccion_no=="Proyectos"){
                                                             $consul= "select * from sis_proyecto where id_proyecto=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                              $id=$fil['id_proyecto'];
                                                             $nombre=$fil['nombre_pro'];
                                                             } 
                                                             $ver = '<a href="../vistas/?id=ver_proyectos&cod='.$id_seleccion_no.'">'.$nombre.'</a>';
                                                             
                                                             }
                                                             
                                                             if($seleccion_no=="Nota"){
                                                             $consul= "select * from actividad where Id=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $no=$fil['Subject'];
                                                           
                                                             }
                                                             $ver = '<a href="../vistas/?id=ver_notas&cod='.$id_seleccion_no.'">'.$no.'</a>';
                                                             
                                                             } 
                                                             if($seleccion_no=="Pacientes"){
                                                             $consul= "select * from pacientes where id_paciente=".$id_seleccion_no;                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $no=$fil['nombres'].' '.$fil['apellidos'];
                                                           
                                                             }
                                                             $ver = '<a href="../vistas/?id=ver_notas&cod='.$id_seleccion_no.'">'.$no.'</a>';
                                                             
                                                             }
                                                             ?>
                                                                
                                                             <?php  }else{
                                                                 $ver = 'N/A';
                                                                 $id_r ='N/A';
                                                                 
                                                             }
                                                $sql1 = "SELECT * FROM pacientes where id_paciente=".$id_paciente."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente = $fila1["id_paciente"];$nombre_cli = $fila1["nombres"].' '.$fila1["apellidos"];
?>
