<table>
<tr><td>



                       <?php 


$requestA=Connection::runQuery('(select * from actividad where tarea="Actividad" and id_contacto='.$idc.')');
$requestB=Connection::runQuery('(select * from actividad where tarea="Reunion" and id_contacto='.$idc.') union (select * from actividad where tarea="Reunion" and relacionado="Contacto" and id_seleccionado='.$idc.')');
$requestC=Connection::runQuery('(select * from actividad where tarea="Llamada" and id_contacto='.$idc.')  union (select * from actividad where tarea="Llamada" and relacionado="Contacto" and id_seleccionado='.$idc.')');
$requestD=Connection::runQuery('(select * from sis_notas where id_contacto='.$idc.') union (select * from sis_notas where seleccion_n="Contacto" and id_seleccion_n='.$idc.')');

if($requestA){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Asunto'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
             
              $table = $table.'<th>'.'Fecha Modificacion'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
               
              
           $table = $table.'</tr>';

$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       if($modulo_rT=='Tareas' && $listar_rT=='Habilitado'){
	while($row=mysql_fetch_array($requestA))
	{       
                
                
                if($modulo_rT=='Tareas' && $ver_rT=='Habilitado'){
                    if($modulo_rT=='Tareas' && $editar_rT=='Habilitado'){
                    if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                    if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td><a href="../modelo/eliminar.php?elimit='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                }else{
                    if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td>
                    </td></tr>';}
                }
                }else{
                    if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                    if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td><a href="../modelo/eliminar.php?elimit='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                }else{
                    if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td>
                    </td></tr>';}
                }
                }
                }else{
                    if($modulo_rT=='Tareas' && $editar_rT=='Habilitado'){
                    if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                    if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td><a href="../modelo/eliminar.php?elimit='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                }else{
                    if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td>
                    </td></tr>';}
                }
                }else{
                    if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                    if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td><a href="../modelo/eliminar.php?elimit='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                }else{
                    if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td>
                    </td></tr>';}
                }
                }
                }
                    
         }}
         if($modulo_rR=='Reuniones' && $listar_rR=='Habilitado'){
         while($row=mysql_fetch_array($requestB))
	{ 
             
             
             if($modulo_rR=='Reuniones' && $ver_rR=='Habilitado'){
                 if($modulo_rR=='Reuniones' && $editar_rR=='Habilitado'){
                 if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                 if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td><a href="../modelo/eliminar.php?elimir='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
             }else{
                 if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td>
                    </td></tr>';}
             }
             }else{
                 if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                 if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td><a href="../modelo/eliminar.php?elimir='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
             }else{
                 if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td>
                    </td></tr>';}
             }
             }
             }else{
                 if($modulo_rR=='Reuniones' && $editar_rR=='Habilitado'){
                 if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                 if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td><a href="../modelo/eliminar.php?elimir='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
             }else{
                 if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td>
                    </td></tr>';}
             }
             }else{
                 if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                 if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td><a href="../modelo/eliminar.php?elimir='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
             }else{
                 if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td>
                    </td></tr>';}
             }
             }
             }
                    
         }}
         if($modulo_rL=='Llamadas' && $listar_rL=='Habilitado'){
         while($row=mysql_fetch_array($requestC))
	{
                   
                   
                   if($modulo_rL=='Llamadas' && $ver_rL=='Habilitado'){
                       if($modulo_rL=='Llamadas' && $editar_rL=='Habilitado'){
                       if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                       if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td><a href="../modelo/eliminar.php?elimil='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                   }else{
                       if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td>
                    </td></tr>';}
                   }
                   }else{
                       if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                       if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td><a href="../modelo/eliminar.php?elimil='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                   }else{
                       if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_toda_act.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td>
                    </td></tr>';}
                   }
                   }
                   }else{
                       if($modulo_rL=='Llamadas' && $editar_rL=='Habilitado'){
                       if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                       if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td><a href="../modelo/eliminar.php?elimil='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                   }else{
                       if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td>
                    </td></tr>';}
                   }
                   }else{
                       if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                       if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td><a href="../modelo/eliminar.php?elimil='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                   }else{
                       if($row['estado']=="Completada" || $row['estado']=="Aplazada" || $row['estado']=="Realizada" || $row['estado']=="No Realizada" || $row['estado']=="Nota"){
                    $table = $table.'<tr><td>'.$row["Subject"].'</a></td><td>'.$row['estado'].
                    '</td><td>'.$row['fecha_mod_ta'].'</td><td>'.$row['user'].'</td><td>
                    
                    </td><td>
                    </td></tr>';}
                   }
                   }
                   }
                    
                    
                    }}
                    if($modulo_rN=='Notas' && $listar_rN=='Habilitado'){
                    while($row=mysql_fetch_array($requestD))
	{
                    
                    
                    if($modulo_rN=='Notas' && $ver_rN=='Habilitado'){
                        if($modulo_rN=='Notas' && $editar_rN=='Habilitado'){
                        if($modulo_rN=='Notas' && $eliminar_rN=='Habilitado'){
                        if($row['estado_n']=="Completada" || $row['estado_n']=="Aplazada" || $row['estado_n']=="Realizada" || $row['estado_n']=="No Realizada" || $row['estado_n']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_toda_act.php?codigo='.$row["id_nota"].'">'.$row["asunto_n"].'</a></td><td>'.$row['estado_n'].
                    '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td><td>
                    <a href="../vistas/mostrar_toda_act.php?codigo='.$row["id_nota"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td><a href="../modelo/eliminar.php?elimi='.$row["id_nota"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                    }else{
                        if($row['estado_n']=="Completada" || $row['estado_n']=="Aplazada" || $row['estado_n']=="Realizada" || $row['estado_n']=="No Realizada" || $row['estado_n']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_toda_act.php?codigo='.$row["id_nota"].'">'.$row["asunto_n"].'</a></td><td>'.$row['estado_n'].
                    '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td><td>
                    <a href="../vistas/mostrar_toda_act.php?codigo='.$row["id_nota"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td>
                    </td></tr>';}
                    }
                    }else{
                        if($modulo_rN=='Notas' && $eliminar_rN=='Habilitado'){
                        if($row['estado_n']=="Completada" || $row['estado_n']=="Aplazada" || $row['estado_n']=="Realizada" || $row['estado_n']=="No Realizada" || $row['estado_n']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_toda_act.php?codigo='.$row["id_nota"].'">'.$row["asunto_n"].'</a></td><td>'.$row['estado_n'].
                    '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td><td>
                    
                    </td><td><a href="../modelo/eliminar.php?elimi='.$row["id_nota"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                    }else{
                        if($row['estado_n']=="Completada" || $row['estado_n']=="Aplazada" || $row['estado_n']=="Realizada" || $row['estado_n']=="No Realizada" || $row['estado_n']=="Nota"){
                    $table = $table.'<tr><td><a href="../vistas/mostrar_toda_act.php?codigo='.$row["id_nota"].'">'.$row["asunto_n"].'</a></td><td>'.$row['estado_n'].
                    '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td><td>
                    
                    </td><td>
                    </td></tr>';}
                    }
                    }
                    }else{
                        if($modulo_rN=='Notas' && $editar_rN=='Habilitado'){
                        if($modulo_rN=='Notas' && $eliminar_rN=='Habilitado'){
                        if($row['estado_n']=="Completada" || $row['estado_n']=="Aplazada" || $row['estado_n']=="Realizada" || $row['estado_n']=="No Realizada" || $row['estado_n']=="Nota"){
                    $table = $table.'<tr><td>'.$row["asunto_n"].'</td><td>'.$row['estado_n'].
                    '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td><td>
                    <a href="../vistas/mostrar_toda_act.php?codigo='.$row["id_nota"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td><a href="../modelo/eliminar.php?elimi='.$row["id_nota"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                    }else{
                        if($row['estado_n']=="Completada" || $row['estado_n']=="Aplazada" || $row['estado_n']=="Realizada" || $row['estado_n']=="No Realizada" || $row['estado_n']=="Nota"){
                    $table = $table.'<tr><td>'.$row["asunto_n"].'</a></td><td>'.$row['estado_n'].
                    '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td><td>
                    <a href="../vistas/mostrar_toda_act.php?codigo='.$row["id_nota"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                    </td><td>
                    </td></tr>';}
                    }
                    }else{
                        if($modulo_rN=='Notas' && $eliminar_rN=='Habilitado'){
                        if($row['estado_n']=="Completada" || $row['estado_n']=="Aplazada" || $row['estado_n']=="Realizada" || $row['estado_n']=="No Realizada" || $row['estado_n']=="Nota"){
                    $table = $table.'<tr><td>'.$row["asunto_n"].'</a></td><td>'.$row['estado_n'].
                    '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td><td>
                    
                    </td><td><a href="../modelo/eliminar.php?elimi='.$row["id_nota"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                    </td></tr>';}
                    }else{
                        if($row['estado_n']=="Completada" || $row['estado_n']=="Aplazada" || $row['estado_n']=="Realizada" || $row['estado_n']=="No Realizada" || $row['estado_n']=="Nota"){
                    $table = $table.'<tr><td>'.$row["asunto_n"].'</a></td><td>'.$row['estado_n'].
                    '</td><td>'.$row['fecha_modificacion'].'</td><td>'.$row['asignado_n'].'</td><td>
                    
                    </td><td>
                    </td></tr>';}
                    }
                    }
                    }    
                    
	}}

	$table = $table.'</table>';
        
	echo $table;
        
}
                       
                       ?> </td></tr> </table>