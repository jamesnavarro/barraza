<!--<meta content="120" http-equiv="REFRESH"> </meta>-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="page-header line1">
                    <h4>Mi Pagina Principal<small>*En esta pagina muestra el resumen de las actividades pendientes</small></h4>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <form class="span12 widget stacked widget-message teal">
                <header>
                    <h4 class="title"><span class="icone-phone"></span> Mis Llamadas</h4>
                        <ul class="toolbar pull-right">
                            <li><a href="../vistas/?id=llamadas" class="link"><span class="icon icone-list"></span></a></li>
                            <li>
                                <a href="" class="link" data-toggle="dropdown"><span class="icon icone-phone"></span></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="../vistas/?id=llamada"><span class="icon icone-pencil"></span> Nueva Llamada</a></li>
                                </ul>
                            </li>
                        </ul>
                </header>
                <section class="body">
                    <div class="body-inner">
                        <div class="scroll-content">
                            <div class="body-inner no-padding">
                                <?php
                                $request=mysql_query("SELECT * FROM actividades where tarea='Llamada' and estado!='Completada' and user='".$_SESSION['k_username']."' ");
                                if($request){
                                $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
                                $table = $table.'<thead >';
                                $table = $table.'<tr BGCOLOR="#C3D9FF">';
                                $table = $table.'<th width="5%">'.'Cerrar'.'</th>';             
                                $table = $table.'<th width="20%">'.'Asunto'.'</th>';
                                $table = $table.'<th width="10%">'.'Duracion'.'</th>';
                                $table = $table.'<th width="20%">'.'Fecha Inicio'.'</th>';
                                $table = $table.'<th  width="10%">'.'Usuario'.'</th>';
                                $table = $table.'<th  width="5%"></th>';
                                $table = $table.'</tr>';
                                $table = $table.'</thead>';
                                //Por cada resultado pintamos una linea
                                $total2=0;
                                while($row=mysql_fetch_array($request))
                                {       
                                if(date("Y-m-d H:i:s") > $row['EndTime']){$color='<font color="red">';}
                                if(date("Y-m-d H:i:s")<= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
                                if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="black">';}
                                $table = $table.'<tr>'
                                . '<td width="5%"><a href="../vistas/?id=llamada&cod='.$row['Id'].'&Completada"><img src="../imagenes/cerrar.gif"></a></td>'
                                . '<td width="20%"><a href="../vistas/?id=ver_llamada&cod='.$row['Id'].'">'.$row["Subject"].'<font></a></td>'
                                . '<td  width="10%">'.$row["duracion"].' Min</font></td>'
                                . '<td  width="20%">'.$color.''.$row["StartTime"].'</font></td>'
                                . '<td  width="10%">'.$row["user"].'</font></td>'
                                . '<td  width="5%"> <a href="../vistas/?id=index&del='.$row["Id"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
                                }
                                $table = $table.'</table>';
                                echo $table;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
        <div class="row-fluid">
            <form class="span12 widget stacked widget-message teal">
                <header>
                    <h4 class="title">
                        <span class="icon icone-coffee"></span> Mis Reuniones
                    </h4>
                        <ul class="toolbar pull-right">
                            <li><a href="../vistas/?id=reuniones" class="link"><span class="icon icone-list"></span></a></li>
                            <li><a href="../vistas/?id=reunion" class="link" data-toggle="dropdown"><span class="icon icone-coffee"></span></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><span class="icon icone-pencil"></span> Agregar Reunion</a></li>
                                </ul>
                            </li>
                        </ul>
                </header>
                <section class="body">
                    <div class="body-inner" id="demo2">
                        <div class="scroll-content">
                            <div class="body-inner no-padding">
                                <?php
                                $request=mysql_query("SELECT * FROM actividades where tarea='Reunion' and estado!='Completada' and user='".$_SESSION['k_username']."' ");
                                if($request){
                                $table = '<table class="table table-bordered table-striped table-hover" id="tabla3">';
                                $table = $table.'<thead >';
                                $table = $table.'<tr BGCOLOR="#C3D9FF">';
                                $table = $table.'<th width="5%">'.'Cerrar'.'</th>';             
                                $table = $table.'<th width="20%">'.'Asunto'.'</th>';
                                $table = $table.'<th width="10%">'.'Duracion'.'</th>';
                                $table = $table.'<th width="20%">'.'Fecha Inicio'.'</th>';
                                $table = $table.'<th  width="10%">'.'Usuario'.'</th>';
                                $table = $table.'<th  width="5%"></th>';
                                $table = $table.'</tr>';
                                $table = $table.'</thead>';
                                //Por cada resultado pintamos una linea
                                $total2=0;
                                while($row=mysql_fetch_array($request))
                                {       
                                if(date("Y-m-d H:i:s") > $row['EndTime']){$color='<font color="red">';}
                                if(date("Y-m-d H:i:s")<= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
                                if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="black">';}
                                $table = $table.'<tr>'
                                . '<td width="5%"><a href="../vistas/?id=reunion&cod='.$row['Id'].'&Completada"><img src="../imagenes/cerrar.gif"></a></td>'
                                . '<td width="20%"><a href="../vistas/?id=ver_reunion&cod='.$row['Id'].'">'.$row["Subject"].'<font></a></td>'
                                . '<td  width="10%">'.$row["duracion"].' Min</font></td>'
                                . '<td  width="20%">'.$color.''.$row["StartTime"].'</font></td>'
                                . '<td  width="10%">'.$row["user"].'</font></td>'
                                . '<td  width="5%"> <a href="../vistas/?id=index&del='.$row["Id"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
                                }
                                $table = $table.'</table>';
                                echo $table;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
        <div class="row-fluid">
            <form class="span12 widget stacked widget-message teal">
                <header>
                    <h4 class="title">
                        <span class="icon  icone-briefcase"></span> Mis Casos Abiertos
                    </h4>
                        <ul class="toolbar pull-right">
                            <li><a href="../vistas/?id=casos" class="link"><span class="icon icone-list"></span></a></li>
                            <li><a href="../vistas/?id=caso" class="link" data-toggle="dropdown"><span class="icon icone-briefcase"></span></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><span class="icon icone-pencil"></span> Agregar Reunion</a></li>
                                </ul>
                            </li>
                        </ul>
                </header>
                <section class="body">
                    <div class="body-inner" id="demo2">
                        <div class="scroll-content">
                            <div class="body-inner no-padding">
                                <?php
                                $request=mysql_query("SELECT * FROM sis_casos a, sis_empresa b where a.id_empresa=b.id_empresa and asignado_caso='".$_SESSION['k_username']."' ");
                                if($request){
                                $table = '<table class="table table-bordered table-striped table-hover" id="tabla4">';
                                $table = $table.'<thead >';
                                $table = $table.'<tr BGCOLOR="#C3D9FF">';
                                $table = $table.'<th width="5%">'.'Radicado'.'</th>';             
                                $table = $table.'<th width="20%">'.'Asunto'.'</th>';
                                $table = $table.'<th width="10%">'.'Prioridad'.'</th>';
                                $table = $table.'<th class="hidden-phone">'.'Estado'.'</th>';
                                $table = $table.'<th class="hidden-phone">'.'Asignado a'.'</th>';
                                $table = $table.'<th>'.'Editar..'.'</th>';
                                $table = $table.'<th>'.'Eliminar'.'</th>';
                                $table = $table.'</tr>';
                                $table = $table.'</thead>';
                                //Por cada resultado pintamos una linea
                                $total2=0;
                                while($row=mysql_fetch_array($request))
                                {      
                                $table = $table.'<tr><td width="5%"><a href="../vistas/?id=ver_casos&cod='.$row['id_caso'].'">'.$row['id_caso'].'</a></td>
                                <td width="20%"><a href="../vistas/?id=ver_casos&cod='.$row['id_caso'].'">'.$row['asunto_caso'].'</a></td>
                                <td width="10%">'.$row["prioridad_caso"].'<font></a></td>
                                <td class="hidden-phone">'.$row["estado_caso"].'</font></td>
                                <td class="hidden-phone">'.$row["asignado_caso"].'</font></td>
                                <td><a href="../vistas/?id=caso&cod='.$row["id_caso"].'"><img src="../imagenes/modificar.png"></a></td>
                                <td><a href="../vistas/?id=casos&delc='.$row["id_caso"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
                                }
                                $table = $table.'</table>';
                                echo $table;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
        <div class="row-fluid">
            <form class="span12 widget stacked widget-message teal">
                <header>
                    <h4 class="title"><span class="icon icone-edit"></span> Mis Tareas</h4>
                    <ul class="toolbar pull-right">
                        <li><a href="../vistas/?id=tareas" class="link"><span class="icon icone-list"></span></a></li>
                        <li><a href="#" class="link" data-toggle="dropdown"><span class="icon icone-edit"></span></a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="../vistas/?id=tarea"><span class="icon icone-pencil"></span> Agregar Tarea</a></li>
                            </ul>
                        </li>
                    </ul>
                </header>
                <section class="body">
                    <div class="body-inner" id="demo2">
                        <div class="scroll-content">
                            <div class="body-inner no-padding">
                                <?php
                                $request=mysql_query("SELECT * FROM actividades where tarea='Tarea' and estado!='Completada' and user='".$_SESSION['k_username']."' ");
                                if($request){
                                $table = '<table class="table table-bordered table-striped table-hover" id="tabla5">';
                                $table = $table.'<thead >';
                                $table = $table.'<tr BGCOLOR="#C3D9FF">';
                                $table = $table.'<th width="5%">'.'Cerrar'.'</th>';             
                                $table = $table.'<th width="20%">'.'Asunto'.'</th>';
                                $table = $table.'<th width="20%">'.'Fecha Inicio'.'</th>';
                                $table = $table.'<th width="20%">'.'Fecha Final'.'</th>';
                                $table = $table.'<th  width="10%">'.'Usuario'.'</th>';
                                $table = $table.'<th  width="5%"></th>';
                                $table = $table.'</tr>';
                                $table = $table.'</thead>';
                                //Por cada resultado pintamos una linea
                                $total2=0;
                                while($row=mysql_fetch_array($request))
                                {       
                                if(date("Y-m-d H:i:s") > $row['EndTime']){$color='<font color="red">';}
                                if(date("Y-m-d H:i:s")<= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
                                if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="black">';}
                                $table = $table.'<tr>'
                                . '<td width="5%"><a href="../vistas/?id=tarea&cod='.$row['Id'].'&Completada"><img src="../imagenes/cerrar.gif"></a></td>'
                                . '<td width="20%"><a href="../vistas/?id=ver_tarea&cod='.$row['Id'].'">'.$row["Subject"].'<font></a></td>'
                                . '<td  width="20%">'.$color.''.$row["StartTime"].'</font></td>'
                                . '<td  width="20%">'.$color.''.$row["EndTime"].'</font></td>'
                                . '<td  width="10%">'.$row["user"].'</font></td>'
                                . '<td  width="5%"> <a href="../vistas/?id=index&del='.$row["Id"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
                                }
                                $table = $table.'</table>';
                                echo $table;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
        <div class="row-fluid">
            <form class="span12 widget stacked widget-message teal">
                <header>
                    <h4 class="title"><span class="icon icone-star-empty"></span> Mis Empresas</h4>
                    <ul class="toolbar pull-right">
                        <li><a href="../vistas/?id=empresas" class="link"><span class="icon icone-list"></span></a></li>
                        <li><a href="" class="link" data-toggle="dropdown"><span class="icon icone-star-empty"></span></a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="../vistas/?id=empresa"><span class="icon icone-pencil"></span> Agregar Empres</a></li>
                            </ul>
                        </li>
                    </ul>
                </header>
                <section class="body">
                    <div class="body-inner" id="demo2">
                        <div class="scroll-content">
                            <div class="body-inner no-padding">
                                <?php
                                $request=mysql_query("SELECT * FROM sis_empresa where cliente='Si' ");
                                if($request){
                                $table = '<table class="table table-bordered table-striped table-hover" id="tabla6">';
                                $table = $table.'<thead >';
                                $table = $table.'<tr BGCOLOR="#C3D9FF">';
                                $table = $table.'<th width="80%">'.'Nombre de la empresa'.'</th>'; 
                                $table = $table.'<th width="20%">'.'Telefeno'.'</th>';
                                $table = $table.'</tr>';
                                $table = $table.'</thead>';
                                //Por cada resultado pintamos una linea
                                $total2=0;
                                while($row=mysql_fetch_array($request))
                                {       
                                $table = $table.'<tr>
                                <td width="80%"><a href="../vistas/?id=ver_empresa&cod='.$row['id_empresa'].'">'.$row['nombre_emp'].'</a></td> 
                                <td width="20%">'.$row["tel_oficina_emp"].'</font></td>
                                </tr>';   
                                }
                                $table = $table.'</table>';
                                if($acceso_emp=='Habilitado'){
                                echo $table;
                                }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
                <!--/ END Content -->
<?php
if(isset($_GET['del'])){
if($eliminar_tar!='Habilitado'){
echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=index"</script>'; 
}else{
if($eliminar_lla!='Habilitado'){
echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=index"</script>'; 
}else{
if($eliminar_reu!='Habilitado'){
echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=index"</script>'; 
}else{
$sql = "DELETE FROM actividades WHERE Id=".$_GET['del']." and user='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=index'";
echo "</script>";
}}}
}
if(isset($_GET['delo'])){
if($eliminar_opo!='Habilitado'){
echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=index"</script>'; 
}else{
$sql = "DELETE FROM sis_oportunidades WHERE id_id_oportunidad=".$_GET['delo']." and asignado_opo='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=index'";
echo "</script>";
}}
 if(isset($_GET['delc'])){
if($eliminar_cas!='Habilitado'){
echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=index"</script>'; 
}else{
$sql = "DELETE FROM sis_casos WHERE id_caso=".$_GET['delc']."  and asignado_caso='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=index'";
echo "</script>";
}
}
if(isset($_GET['dele'])){
if($eliminar_emp!='Habilitado'){
echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=index"</script>'; 
}else{
$sql = "DELETE FROM sis_empresa WHERE id_empresa=".$_GET['dele']." and usuario='".$_SESSION['k_username']."'";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=index'";
echo "</script>";
}
}