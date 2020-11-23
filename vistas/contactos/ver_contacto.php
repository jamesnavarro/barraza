<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_contacto.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Informacion del Contacto</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><b>Nombre del contacto:</b><?php  echo $nombre.' '. $apellido;  ?></li>
                                                <b>Empresa </b>:<?php
                                                 $sql1 = "SELECT * FROM sis_empresa where id_empresa=".$idemp."";
                                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                                $id_cliente = $fila1["id_empresa"];$nombre_cli = $fila1["nombre_emp"];
                                                 echo '<a href="../vistas/?id=ver_empresa&cod='.$id_cliente.'">'.$nombre_cli.'</a>';  ?>
                                                <li><b>Toma de Contacto:</b><?php  echo $toma;  ?></li>
                                                <li><b>Campaña :</b><?php  echo $camp;  ?> </li>
                                                <li><b>Cargo :</b><?php  echo $cargo;  ?></li>
                                                <li><b>Departamento :</b><?php  echo $departamento;  ?></li>
                                                 <b>Informa a :</b><?php echo '<a href="../vistas/?id=ver_contacto&cod='.$idinforma.'">'.$informa.'</a>'; ?>
                                                 
                                                 <li><b><?php  echo $llamar;  ?>llamar:</b></li>
                                                 <li><b>Asignado a :</b><?php  echo $user;  ?></li>
                                                 <li><b>Fecha de Modificacion:</b><?php  echo $registro_m;  ?></li>
                                                 
                                                 
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><b> Telefeno oficina:</b><?php  echo $tel1;  ?></li>
                                                <li><b>Movil:</b><?php  echo $movil;  ?></li>
                                                <li><b>Telefono casa:</b><?php  echo $tel1;  ?></li>
                                                <li><b>Telefeno Alt.:</b><?php  echo $tel2;  ?></li>
                                                <li><b>Fax:</b><?php  echo $fax;  ?></li>
                                                <li><b>Fecha de Cumpleaño:</b><?php  echo $fecha;  ?></li>
                                                
                                                <li><b>Asistente :</b><?php  echo $asistente;  ?></li>
                                                <li><b>tel. asistente:</b><?php  echo $tel_asist;  ?></li>
                                                 <li><b>Direccion Alt.:</b><?php  echo $dir2;  ?></li>
                                                <li><b>Fecha de Registro:</b><?php  echo $registro;  ?></li>
                                               
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                                 <li><b>Tipo de Contacto:</b><font color="blue"><?php  echo $tipo;  ?></font></li>
                                                 <li><b>Direccion Principal :</b><?php  echo $dir1;  ?></li>
                                                <li><b>Email </b>:<?php  echo $ema1;  ?></li>
                                
                                                <li><b>Detalle </b>:<?php  echo $inf;  ?></li>
                                                <?php 
                                                if($editar_con=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up = '';}
                                                if($eliminar_con=='Habilitado'){$del= '<img src="../imagenes/eliminar.png">';}else{$del = '';}
                                               
?>
                                                <a href="../vistas/?id=contacto&cod=<?php  echo $_GET["cod"];  ?>"><?php  echo $up;  ?></a>
                                                <a href="../vistas/?id=contactos&del=<?php  echo $_GET["cod"];  ?>"><?php  echo $del;  ?></a>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <img src="../imagenes/contactos.jpg">
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
 <?php
 if(isset($_GET['cod'])){
require '../vistas/contactos/actividades.php';
//require '../vistas/contactos/soporte.php';
//require '../vistas/contactos/otros.php';
 }
 ?>
