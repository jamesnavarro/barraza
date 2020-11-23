<header> <form action="" method="post" name="fcontacto">

                    <input type="submit" name="boton" value="Nueva Tarea"/> <input type="submit" name="reunion" value="Programar Reunion"/> <input type="submit" name="llamada" value="Programar Llamada"/>
                </form> </header>
<table>
<tr><td>
        <?php 
$a=date("H:i").':00';
$req11=Connection::runQuery('(select * from actividad where tarea="Actividad" and relacionado="Cuenta" and id_seleccionado='.$id_empresa.')') ;
$req12=Connection::runQuery('(select *  from actividad where tarea="Reunion" and relacionado="Cuenta" and id_seleccionado='.$id_empresa.')') ;
$req13=Connection::runQuery('(select * from actividad where tarea="Llamada" and relacionado="Cuenta" and id_seleccionado='.$id_empresa.')') ;

if($req11){
//    echo'<hr>';
    $table = '<table class="lista1">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Asunto'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
             
              $table = $table.'<th>'.'Fecha vencimiento'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'<th>'.''.'</th>';
              $table = $table.'<th>'.''.'</th>';
               
              
           $table = $table.'</tr>';

$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        if($modulo_rT=='Tareas' && $listar_rT=='Habilitado'){
	while($row=mysql_fetch_array($req11))
	{  
            
            
            if($modulo_rT=='Tareas' && $ver_rT=='Habilitado'){
                if($modulo_rT=='Tareas' && $editar_rT=='Habilitado'){
                if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                     if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['EndTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                                    if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['EndTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['EndTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }} 
            }else{
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['EndTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';}
                        if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['EndTime'].'  '.$row['hora_v_ta'].':'.$row['minuto_v_ta'].''.$row['meridiano_v_ta'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['EndTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';
                                    }} 
            }
            }else{
                if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['EndTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                                if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['EndTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                           
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['EndTime'].'</td><td>'.$row['user'].'</td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }} 
            }else{
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                     if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['EndTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            
                                </td><td>
                                    </td></tr>';}
                                  if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['EndTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            
                                </td><td>
                                    </td></font></tr>';}
                                   if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['EndTime'].'</td><td>'.$row['user'].'</td><td>
                            
                                </td><td>
                                    </td></tr>';
                                    }} 
            }
            }
            }else{
              if($modulo_rT=='Tareas' && $editar_rT=='Habilitado'){
                if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                     if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['EndTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                                 if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['EndTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                   if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['EndTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }} 
            }else{
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['EndTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';}
                          if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['EndTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_actividad.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['EndTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_actividad.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';
                                    }} 
            }
            }else{
                if($modulo_rT=='Tareas' && $eliminar_rT=='Habilitado'){
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['EndTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                           
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                    if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['EndTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['EndTime'].'</td><td>'.$row['user'].'</td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?elimt='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }} 
            }else{
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['EndTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            
                                </td><td>
                                    </td></tr>';}
                     if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['EndTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            
                                </td><td>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['EndTime'].'</td><td>'.$row['user'].'</td><td>
                            
                                </td><td>
                                    </td></tr>';
                                    }} 
            }
            }  
            }
           
           
           
               
	}}
        if($modulo_rR=='Reuniones' && $listar_rR=='Habilitado'){
        while($row=mysql_fetch_array($req12))
	{       
             
            
             if($modulo_rR=='Reuniones' && $ver_rR=='Habilitado'){
                  if($modulo_rR=='Reuniones' && $editar_rR=='Habilitado'){
                 if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                            if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }}
             }else{
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';}
                         if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></font></tr>';}
                                   if(date("Y-m-d").' '.'23:59:00'< $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';
                                    }} 
             }
             }else{
                 if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                     if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                           
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }}
             }else{
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                           
                                </td><td>
                                    </td></tr>';}
                if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            
                                </td><td>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_reunion.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            
                                </td><td>
                                    </td></tr>';
                                    }} 
             }
             }
             }else{
                  if($modulo_rR=='Reuniones' && $editar_rR=='Habilitado'){
                 if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                   if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }}
             }else{
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../vistas/mostrar_toda_act.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';}
                if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></font></tr>';}
                                   if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_reunion.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';
                                    }} 
             }
             }else{
                 if($modulo_rR=='Reuniones' && $eliminar_rR=='Habilitado'){
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font>></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                           
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
               if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?elimr='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }}
             }else{
                if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            
                                </td><td>
                                    </td></tr>';}
              if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                       
                                </td><td>
                                    </td></font></tr>';}
                                   if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            
                                </td><td>
                                    </td></tr>';
                                    }} 
             }
             }
             }  
            
               
	}}
        if($modulo_rL=='Llamadas' && $listar_rL=='Habilitado'){
        while($row=mysql_fetch_array($req13))
	{        
            
             
             
             if($modulo_rL=='Llamadas' && $ver_rL=='Habilitado'){
                 if($modulo_rL=='Llamadas' && $editar_rL=='Habilitado'){
                 if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                       if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){ $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                   if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }}
             }else{
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';}
                 if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){ $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['StartTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';
                                    }}
             }
             }else{
                 if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){ $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            
                                </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                   if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            <img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px" title="Deshabilitado">    </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }}
             }else{
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'"><font color="red">'.$row["Subject"].'</font></a></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                           
                                </td><td>
                                    </td></tr>';}
                if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){ $table = $table.'<tr><td><a href="../vistas/mostrar_llamada.php?codigo='.$row["Id"].'"><font color="green">'.$row["Subject"].'</font></a></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                          
                                </td><td>
                                    </td></font></tr>';}
                                   if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td><a href="../vistas/mostrar_toda_act.php?codigo='.$row["Id"].'">'.$row["Subject"].'</a></td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            
                                </td><td>
                                    </td></tr>';
                                    }}
             }
             }
             }else{
                 if($modulo_rL=='Llamadas' && $editar_rL=='Habilitado'){
                 if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                 if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){ $table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }}
             }else{
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';}
                if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){ $table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                            <a href="../form_editar/formulario_editar_llamada.php?codigo='.$row["Id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>
                                </td><td>
                                    </td></tr>';
                                    }}
             }
             }else{
                 if($modulo_rL=='Llamadas' && $eliminar_rL=='Habilitado'){
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            <img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px" title="Deshabilitado">
                                </td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';}
                 if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){ $table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td><a href="../modelo/eliminar.php?eliml='.$row["Id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>
                                    </td></tr>';
                                    }}
             }else{
                 if($row['estado']=="No iniciada" || $row['estado']=="En proceso" || $row['estado']=="En proceso" || $row['estado']=="Pendiente"|| $row['estado']=="Planificada"){
                   
                    if(date("Y-m-d").' '.$a > $row['EndTime']){
		$table = $table.'<tr><td><font color="red">'.$row["Subject"].'</font></td><td><font color="red">'.$row['estado'].
                        '</font></td><td><font color="red">'.$row['StartTime'].'</font></td><td><font color="red">'.$row['user'].'</font></td><td>
                            
                                </td><td>
                                    </td></tr>';}
                if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){ $table = $table.'<tr><td><font color="green">'.$row["Subject"].'</font></td><td><font color="green">'.$row['estado'].
                        '</font></td><td><font color="green">'.$row['StartTime'].'</font></td><td><font color="green">'.$row['user'].'</font></td><td>
                            
                                </td><td>
                                    </td></font></tr>';}
                                    if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){
                                        $table = $table.'<tr><td>'.$row["Subject"].'</td><td>'.$row['estado'].
                        '</td><td>'.$row['StartTime'].'</td><td>'.$row['user'].'</td><td>
                      
                                </td><td>
                                    </td></tr>';
                                    }}
             }
             }
             }
                
               
	}}
        $table = $table.'</table>';
        
	echo $table;
}
                    
?> </td></tr> </table>
