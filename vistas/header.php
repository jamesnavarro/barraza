          
           <header id="header">
                <!-- START Logo -->
                <div class="logo hidden-phone hidden-tablet">
                    <a href="#">  <img src="../imagenes/koalav2.png" width="100px"> </a> 
                    
                </div>
<?php
$sql21 = "SELECT count(*) FROM seguimientos where user='".$_SESSION['k_username']."' and visto=0";
$fila21 =mysql_fetch_array(mysql_query($sql21));
$on= $fila21["count(*)"];
$sql2i= "SELECT count(*) FROM sis_incidencias where asignado_inc='".$_SESSION['k_username']."' and estado_inc!='Solucionado' ";
$fila2i =mysql_fetch_array(mysql_query($sql2i));
$in= $fila2i["count(*)"];
$sql2m = "SELECT count(*) FROM mensajes where visto=0 and id_receptor=".$_SESSION['id_user']." ";
$fila2m =mysql_fetch_array(mysql_query($sql2m));
$msg= $fila2m["count(*)"];

$sqlt = "SELECT count(*) FROM actividades where tarea='Tarea' and estado!='Completada' and user='".$_SESSION['k_username']."'  ";
$filat =mysql_fetch_array(mysql_query($sqlt));
$tar= $filat["count(*)"];

$sqll = "SELECT count(*) FROM actividades where tarea='Llamada' and estado!='Completada' and user='".$_SESSION['k_username']."'  ";
$filal =mysql_fetch_array(mysql_query($sqll));
$lla= $filal["count(*)"];

$sqlr = "SELECT count(*) FROM actividades where tarea='Reunion' and estado!='Completada' and user='".$_SESSION['k_username']."'  ";
$filar =mysql_fetch_array(mysql_query($sqlr));
$reu= $filar["count(*)"];
?>
                <!-- START Mobile Sidebar Toggler -->
                <a href="#" class="toggler" data-toggle="sidebar"><span class="icon icone-reorder"></span></a>
                <!--/ END Mobile Sidebar Toggler -->

                <!-- START Toolbar -->
                <ul class="toolbar" id="">
                  
                    <!-- START Task -->
                    <li class="task">
                        <a href="#" data-toggle="dropdown">
                            <span class="badge"><?php  if($msg!=0){echo $msg;} ?></span>
                            <span class="icon icone-group"></span>
                        </a>
                        <!-- START Dropdown Menu -->
                        <div class="dropdown-menu" role="menu">
                            <header>Mensajes Recibidos</header>
                            <ul class="body">
                                <?php
                                require '../modelo/conexion.php';
$consulta= "SELECT * FROM mensajes where visto=0 and id_receptor='".$_SESSION['id_user']."'  ";                     
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){



echo '<li><span class="avatar"><a href=""><img src="../img/avatar/avatar.png" alt=""></a></span>'; ?>
                             <a href="<?php echo '../vistas/?id=msg&cod='.$fila['id_emisor'].'&est' ?>"  target="_blank"  class="text" onClick="window.open(this.href, this.target, 'width=400,height=600'); return false;" >
                                   <?php     
                                         echo '<strong>'.$fila['contenido'].'</strong><br>Conectado desde el <br><small>'.$fila['reg'].'</small>
                                    </a>
                                   
                                </li>';

}
                     
                                ?>
                               
                            </ul>
    
                        </div>
                        <!--/ END Dropdown Menu -->
                    </li>
                    <!--/ END Task -->
  <!-- START Task -->
                    <li class="task">
                        <a href="#" data-toggle="dropdown">
                            <span class="badge"><?php  if($on!=0){echo $on;} ?></span>
                            <span class="icon icone-briefcase"></span>
                        </a>
                        <!-- START Dropdown Menu -->
                        <div class="dropdown-menu" role="menu">
                            <header>Seguimientos</header>
                            <ul class="body">
                                <?php
                                require '../modelo/conexion.php';
$consultas= "SELECT * FROM seguimientos where visto=0 and user='".$_SESSION['k_username']."'  ";                     
$resultss=  mysql_query($consultas);
while($fila=  mysql_fetch_array($resultss)){


                                echo '<li> <span class="icon iconm-bell-2"></span>
  
                                    <a href="../vistas/?id=ver_incidencias&cod='.$fila['id_incidencia'].'&cambiar" class="text">
                                        <strong>'.$fila['descripcion'].'</strong><br>Enviado a las '.$fila['fecha'].', enviado por: '.$fila['registrado_por'].'<br><small></small>
                                    </a>
                                 
                                </li>';

}
                     
                                ?>
                               
                            </ul>
    
                        </div>
                        <!--/ END Dropdown Menu -->
                    </li>
                    <!--/ END Task -->
                    <!-- START Notification -->
                    <li class="notification">
                        <a href="#" data-toggle="dropdown">
                            <span class="badge"><?php  if($in!=0){echo $in;} ?></span>
                            <span class="icon iconm-bell-2"></span>
                        </a>
                        <!-- START Dropdown Menu -->
                        <div class="dropdown-menu" role="menu">
                            <header>Novedades <small><?php  if($in!=0){echo $in;} ?> Nuevas</small></header>
                            <ul class="body">
                                                           <?php
                                require '../modelo/conexion.php';
                                $consulta= "SELECT * FROM sis_incidencias where asignado_inc='".$_SESSION['k_username']."' and estado_inc!='Solucionado'";                     
                                $result=  mysql_query($consulta);
                                while($fila=  mysql_fetch_array($result)){



                               
                                echo '<li> <span class="icon iconm-bell-2"></span>
  
                                    <a href="../vistas/?id=ver_incidencias&cod='.$fila['id_incidencia'].'" class="text">
                                        <strong>'.$fila['asunto_inc'].'</strong><br>Enviado a las '.$fila['fecha_registro_inc'].'<br><small></small>
                                    </a>
                                 
                                </li>';

}
                     
                                ?>
                                
                              
                            </ul>
                            <footer>
<!--                                <a href="#">Clear Notifications</a>-->
                            </footer>
                        </div>
                        <!--/ END Dropdown Menu -->
                    </li>
                    <!--/ END Notification -->

                    <!-- START Message -->
<!--                    <li class="message">
                        <a href="#" data-toggle="dropdown">
                            <span class="badge"><?php  if($on!=0){echo $on;} ?></span>
                            <span class="icon icone-briefcase"></span>
                        </a>
                         START Dropdown Menu 
                        <div class="dropdown-menu" role="menu">
                            <header>
                               Casos
                          
                               
                            </header>
                            <ul class="body">
                                 <?php
                                require '../modelo/conexion.php';
$consulta= "SELECT * FROM sis_casos where asignado_caso='".$_SESSION['k_username']."' and estado_caso!='Cerrado' ";                     
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){



echo '<li> <span class="icon icone-briefcase"></span>
  
                                    <a href="../vistas/?id=ver_casos&cod='.$fila['id_caso'].'" class="text">
                                        <strong>'.$fila['asunto_caso'].'</strong><br>Enviado a las '.$fila['fecha_registro_caso'].'<br><small></small>
                                    </a>
                                 
                                </li>';

}
                     
                                ?>
                               
                            </ul>
                        
                        </div>
                        / END Dropdown Menu 
                    </li>-->
                    <!--/ END Message -->
                   <!-- START Message -->
                    <li class="message">
                        <a href="#" data-toggle="dropdown">
                            <span class="badge"><?php  if($lla!=0){echo $lla;} ?></span>
                            <span class="icon icone-mobile-phone"></span>
                        </a>
                        <!-- START Dropdown Menu -->
                        <div class="dropdown-menu" role="menu">
                            <header>
                               Llamadas
                          
                               
                            </header>
                            <ul class="body">
                                 <?php
                                require '../modelo/conexion.php';
$consulta= "SELECT * FROM actividades where tarea='Llamada' and user='".$_SESSION['k_username']."' and estado!='Completada' ";                     
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){



echo '<li> <span class="icon icone-mobile-phone"></span>
  
                                    <a href="../vistas/?id=ver_llamada&cod='.$fila['Id'].'" class="text">
                                        <strong>'.$fila['Subject'].'</strong><br>Enviado a las '.$fila['fecha_reg_ta'].'<br><small></small>
                                    </a>
                                 
                                </li>';

}
                     
                                ?>
                               
                            </ul>
                        
                        </div>
                        <!--/ END Dropdown Menu -->
                    </li>
                    <!--/ END Message -->
                        <!-- START Message -->
                    <li class="message">
                        <a href="#" data-toggle="dropdown">
                            <span class="badge"><?php  if($reu!=0){echo $reu;} ?></span>
                            <span class="icon icone-map-marker"></span>
                        </a>
                        <!-- START Dropdown Menu -->
                        <div class="dropdown-menu" role="menu">
                            <header>
                               Reuniones
                          
                               
                            </header>
                            <ul class="body">
                                <?php
                                require '../modelo/conexion.php';
$consulta= "SELECT * FROM actividades where tarea='Reunion' and user='".$_SESSION['k_username']."' and estado!='Completada' ";                     
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){



echo '<li> <span class="icon icone-map-marker"></span>
  
                                    <a href="../vistas/?id=ver_reunion&cod='.$fila['Id'].'" class="text">
                                        <strong>'.$fila['Subject'].'</strong><br>Enviado a las '.$fila['fecha_reg_ta'].'<br><small></small>
                                    </a>
                                 
                                </li>';

}
                     
                                ?>
                               
                            </ul>
                        
                        </div>
                        <!--/ END Dropdown Menu -->
                    </li>
                    <!--/ END Message -->
                        <!-- START Message -->
                    <li class="message">
                        <a href="#" data-toggle="dropdown">
                            <span class="badge"><?php  if($tar!=0){echo $tar;} ?></span>
                            <span class="icon icone-dashboard"></span>
                        </a>
                        <!-- START Dropdown Menu -->
                        <div class="dropdown-menu" role="menu">
                            <header>
                               Tareas
                          
                               
                            </header>
                            <ul class="body">
                                 <?php
                                require '../modelo/conexion.php';
$consulta= "SELECT * FROM actividades where tarea='Tarea' and user='".$_SESSION['k_username']."' and estado!='Completada' ";                     
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){



echo '<li> <span class="icon icone-dashboard"></span>
  
                                    <a href="../vistas/?id=ver_tarea&cod='.$fila['Id'].'" class="text">
                                        <strong>'.$fila['Subject'].'</strong><br>Enviado a las '.$fila['fecha_reg_ta'].'<br><small></small>
                                    </a>
                                 
                                </li>';

}
                     
                                ?>
                               
                            </ul>
                        
                        </div>
                        <!--/ END Dropdown Menu -->
                    </li>
                    <!--/ END Message -->
                    <!-- START Profile -->
                    <li class="profile">
                        <a href="#" data-toggle="dropdown">
                             <span class="avatar">
                                 <?php
                                 if(isset($_SESSION["foto"])){
                                 if($_SESSION["foto"]==''){
                                     echo '<img src="../img/avatar/avatar.png" alt="">';
                                 }  else {
                                     echo '<img src="../fotos_barraza/'.$_SESSION["foto"].'" alt="" width="100%">';
                                 }
                                 }else{
                                   echo '<script lanquage="javascript">alert("Se ha actualizado el sistema, Ingrese de nuevo al sistema");location.href="../index.php"</script>';
                                 }
                                 ?>
                                 
                                 
                             </span>
                             <span class="text hidden-phone"><?php echo $_SESSION["nombre"] ?><span class="role"><?php echo $_SESSION["k_username"] ?></span></span>
                            <span class="arrow icone-caret-down"></span>
                        </a>
                        <!-- START Dropdown Menu -->
                        <div class="dropdown-menu" role="menu">
                             <header>
                                Mi Perfil 
                                <ul class="toolbar">
                                    <li><a href="../vistas/?id=user&cod=<?php  echo $_SESSION["id_user"]; ?>" class="btn btn-small"><span class="icon icone-pencil"></span></a></li>
                                </ul>
                            </header>
                           <ul class="body">
                                <li>
                                    <a href="../vistas/?id=cuenta&cod=<?php  echo $_SESSION["id_user"]; ?>" class="text"><span class="icon iconm-pencil-4"></span> Mi Cuenta</a>
                                    
                                </li>
                                <li>
                                    <?php if($_SESSION["admin"] == 'Si'){  ?><a href="../vistas/?id=mi_empresa" class="text"><span class="icon icone-copy"></span> Datos de la empresa</a><?php } ?>
                                    
                                </li>
                                
                            </ul>
                            <footer>
                                <a href="../salir.php" class="text"><span class="icon icone-off"></span>Salir</a>
                            </footer>
                        </div>
                        <!--/ END Dropdown Menu -->
                    </li>
                    <!--/ END Profile -->
                </ul>
                <!--/ END Toolbar -->
            </header>