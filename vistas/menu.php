<script> 
    function generar(fact){
        window.open('../vistas/rango.php','Form','width=1000, height= 900');
    }
     function indicadores(){
         var c = prompt("Que año deseas consultar?");
         if(c==''){
             alert("Debes de digitar el año");
             return false;
         }
        window.open('../vistas/reportes/?a='+c,'Form','width=800, height= 500');
    }
    function indicadores2(){ 
        window.open('../vistas/reportes/diastranscurridos.php?a=','Form','width=1000, height= 500');
    }
    </script> 
<aside id="sidebar">
                <!-- START Sidebar Content -->
                <div class="sidebar-content">
                   
                    <!-- START Tab Content -->
                    <div class="tab-content">
                        <!-- START Tab Pane(menu) -->
                        <div class="tab-pane active" id="tab-menu">
                            <!-- START Sidebar Menu -->
                            <nav id="nav" class="accordion">
                                <ul id="navigation">
                                    <img src="../imagenes/idb.png" width="200">
                                   <?php  if($_SESSION['area']=='OFICINA'){ ?>
                                   <form class="" action="" method="post" id="" enctype="multipart/form-data">
                                       <input type="text" name="xxx" value="" required placeholder="Orden Interna ó C.C" class="span2"><input name="a" title="Checked aqui para buscar por cedula"  type="checkbox" value="1">
                                   
                                   </form><?php } ?>
                                    
                                    <?php if($acceso_aten == 'Habilitado'){ ?>
                                            <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu1">
                                            <span class="icon icon-th"></span>
                                            <span class="text">Ordenes Internas</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu1" class="<?php  if($_GET['id']=='ver_orden_interna' || $_GET['id']=='ordenes_block' || $_GET['id']=='llenar_atencion' || $_GET['id']=='add_atenciones' || $_GET['id']=='add_orden' || $_GET['id']=='ordenes'|| $_GET['id']=='ordenes_all'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=add_orden"><span class="icon icone-angle-right"></span> Ingresar Atencion</a></li>
                                            <?php  if($_SESSION['area']=='OFICINA'){ ?>
                                            <li class=""><a href="../vistas/?id=ordenes_all"><span class="icon icone-angle-right"></span> Lista de Ordenes </a></li>
                                            <li class=""><a href="../vistas/?id=ordenes_block"><span class="icon icone-angle-right"></span> Ordenes Bloqueadas </a></li>
                                            <li class=""><a href="../vistas/?id=barrios"><span class="icon icone-angle-right"></span> Conf Barrios </a></li>
                                            <li class=""><a href="../vistas/?id=ubicacion"><span class="icon icone-angle-right"></span> Ordenes x Ubicacion </a></li>
                                            <?php }else{ ?>
                                            <li class=""><a href="../vistas/?id=ordenes&no-iniciada"><span class="icon icone-angle-right"></span> Lista de Ordenes </a></li>
                                            <?php } ?>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                        <?php } ?>
                                  
                                    <?php if($_SESSION['area']=='OFICINA'){ ?>
                                    
                                    <?php if($acceso_alq == 'Habilitado'){ ?>
                                        <li class="accordion-group ">
                                            <a data-toggle="collapse" data-parent="#navigation" href="#submenu2">
                                                <span class="icon icon-th"></span>
                                                <span class="text">Alquileres</span>
                                                <span class="arrow icone-caret-down"></span>
                                            </a>
                                            <!-- START Submenu Menu -->
                                            <ul id="submenu2" class="<?php  if($_GET['id']=='alquiler_prod' || $_GET['id']=='all_alquiler_full' || $_GET['id']=='all_alquiler' || $_GET['id']=='add_alquiler' || $_GET['id']=='add_detalle_alquiler' || $_GET['id']=='alquileres_pac'){echo 'collapse in';}else{echo 'collapse';}  ?>">

                                                <li class=""><a href="../vistas/?id=add_alquiler"><span class="icon icone-angle-right"></span> Ingresar Alquiler</a></li>
                                                <li class=""><a href="../vistas/?id=all_alquiler"><span class="icon icone-angle-right"></span> Alquileres en proceso</a></li>
                                                <li class=""><a href="../vistas/?id=all_alquiler_full"><span class="icon icone-angle-right"></span> Alquileres Completados</a></li>
                                                <li class=""><a href="../vistas/alquiler/reportes.php" target="_blank"><span class="icon icone-angle-right"></span> Seguimientos de Alquileres</a></li>
                                            </ul>
                                            <!--/ END Submenu Menu -->
                                        </li>   
                                    <?php } ?>
                                    
                                    <?php if ($acceso_ven == 'Habilitado'){ ?>
                                        <li class="accordion-group ">
                                            <a data-toggle="collapse" data-parent="#navigation" href="#submenu3">
                                                <span class="icon icon-th"></span>
                                                <span class="text">Ventas</span>
                                                <span class="arrow icone-caret-down"></span>
                                            </a>
                                            <!-- START Submenu Menu -->
                                            <ul id="submenu3" class="<?php  if($_GET['id']=='ventas_no' ||$_GET['id']=='add_ventas' || $_GET['id']=='ventas' || $_GET['id']=='add_detalle_venta'  ){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                              <li class=""><a href="../vistas/?id=add_ventas"><span class="icon icone-angle-right"></span> Ingresar Ventas</a></li>
                                                <li class=""><a href="../vistas/?id=ventas_no"><span class="icon icone-angle-right"></span> Ventas sin Facturar</a></li>
                                            <li class=""><a href="../vistas/?id=ventas"><span class="icon icone-angle-right"></span> Ventas Facturadas</a></li>

                                            </ul>
                                            <!--/ END Submenu Menu -->
                                        </li>
                                    <?php } ?>
                                    
                                    
                                    <?php if ($acceso_fac == 'Habilitado'){ ?>
                                        <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu4">
                                            <span class="icon icon-th"></span>
                                            <span class="text">Facturas</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu4" class="<?php  if($_GET['id']=='liquidaciones' ||$_GET['id']=='liquidacion' ||$_GET['id']=='liquidacion_total' ||$_GET['id']=='recibo_de_caja' ||$_GET['id']=='archivos' ||$_GET['id']=='rips' ||$_GET['id']=='facturas_null' ||$_GET['id']=='facturacion_autorizacion' || $_GET['id']=='facturas' || $_GET['id']=='det_factura_at' || $_GET['id']=='det_factura_ve' || $_GET['id']=='det_factura_al' || $_GET['id']=='facturacion_v'|| $_GET['id']=='facturacion_2'|| $_GET['id']=='facturacion_finalizada'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                          <li class=""><a href="../vistas/?id=facturas"><span class="icon icone-angle-right"></span> Todas las Facturas</a></li>
                                            <li class=""><a href="../vistas/?id=facturas_null"><span class="icon icone-angle-right"></span> Facturas Anuladas</a></li>
                                            <li class=""><a href="../vistas/?id=facturas_empresa"><span class="icon icone-angle-right"></span> Facturar x Empresas</a></li>
<!--                                            <li class=""><a href="../vistas/?id=facturas_empresa"><span class="icon icone-angle-right"></span> Facturar Alq x Empresas</a></li>-->
                                            <li class=""><a href="../vistas/?id=rips"><span class="icon icone-angle-right"></span> Generar RIPS</a></li>
                                                  <li class=""><a href="../vistas/?id=recibo_de_caja"><span class="icon icone-angle-right"></span> Recibo de Caja</a></li>
                                                  <li class=""><a href="#" onclick="generar();"><span class="icon icone-angle-right"></span> Archivos de Siigo</a></li>
                                       <li class=""><a href="../vistas/?id=liquidacion" onclick=""><span class="icon icone-angle-right"></span> Usuarios a Liquidar</a></li>
                                       <li class=""><a href="../vistas/?id=liquidacion_total" onclick=""><span class="icon icone-angle-right"></span> Liquidacion de Atenciones</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu47">
                                            <span class="icon icon-print"></span>
                                            <span class="text">Auditorias</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu47" class="<?php  if($_GET['id']=='aud_atenc' ||$_GET['id']=='auditoria' ||$_GET['id']=='aud_atenciones'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                          <li class=""><a href="../vistas/?id=aud_atenciones"><span class="icon icone-angle-right"></span> Auditoria de Atenciones</a></li>
                                            <li class=""><a href="../vistas/?id=auditoria"><span class="icon icone-angle-right"></span> Pacientes Ingresados</a></li>
                                    <li class=""><a href="../vistas/?id=aud_atenc"><span class="icon icone-angle-right"></span> Atenciones x Pacientes</a></li>
                                        <li class=""><a href="../vistas/?id=hoy"><span class="icon icone-angle-right"></span> Ordenes Ingresadas hoy</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <?php } ?>
                                    
                                    <?php } ?>
                                    <?php
                                        $requests=mysql_query("SELECT count(*) FROM correos a, correos_para b, usuarios c where b.visto=0 and c.id=a.id_de and a.id_correo=b.id_correo and b.id_user=".$_SESSION['id_user']." and b.visto!=2 order by a.id_correo desc ");
                                        $re = mysql_fetch_array($requests);
                                        if($_SESSION['admin']=='Si'){
                                        $request_l=mysql_query("SELECT count(*) FROM reportes where estado='Reportado' ");
                                        }else{
                                          $request_l=mysql_query("SELECT count(*) FROM reportes where estado='Reportado' and asignado_m='".$_SESSION['k_username']."'");  
                                        }
                                        $ca = mysql_fetch_array($request_l);
                                        ?>
                                    
                                    
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu19">
                                            <span class="icon icone-envelope-alt"></span>
                                            <span class="text">Correo Interno IDB (<font color="red"><?php echo $re['count(*)']; ?></font>)</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        
                                        <ul id="submenu19" class="<?php  if($_GET['id']=='redactar' || $_GET['id']=='recibidos' || $_GET['id']=='enviados' || $_GET['id']=='eliminados' || $_GET['id']=='ordenes'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=redactar"><span class="icon iconm-pencil-4"></span> Redactar</a></li>
                                            <li class=""><a href="../vistas/?id=recibidos"><span class="icon icon-eye-open"></span> Recibidos (<font color="red"><?php echo $re['count(*)']; ?></font>)</a> </li>
                                            <li class=""><a href="../vistas/?id=enviados"><span class="icon icone-exchange"></span> Enviados</a></li>
                                            <li class=""><a href="../vistas/?id=eliminados"><span class="icon icon-trash"></span> Eliminados</a></li>
                                           
                                            
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu5">
                                            <span class="icon icone-book"></span>
                                            <span class="text">Actividades</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu5" class="<?php  if($_GET['id']=='ver_tarea' ||$_GET['id']=='ver_llamada' ||$_GET['id']=='ver_reunion' ||$_GET['id']=='ver_notas' || $_GET['id']=='llamada' || $_GET['id']=='reunion' || $_GET['id']=='tarea' || $_GET['id']=='nota' || $_GET['id']=='llamadas' || $_GET['id']=='reuniones' || $_GET['id']=='tareas' || $_GET['id']=='notas'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <?php if($acceso_lla == 'Habilitado'){ ?>
                                                <li class=""><a href="../vistas/?id=llamada"><span class="icon icone-angle-right"></span>Nueva Llamada</a></li>
                                            <?php } ?>
                                                
                                            <?php if ($acceso_reu == 'Habilitado'){ ?> 
                                                <li class=""><a href="../vistas/?id=reunion"><span class="icon icone-angle-right"></span>Nueva Reunion</a></li>
                                            <?php } ?>
                                                
                                            <?php if ($acceso_tar == 'Habilitado'){ ?> 
                                                <li class=""><a href="../vistas/?id=tarea"><span class="icon icone-angle-right"></span>Nueva Tarea</a></li>
                                            <?php } ?>
                                                
                                            <?php if ($acceso_not == 'Habilitado'){ ?> 
                                                <li class=""><a href="../vistas/?id=nota"><span class="icon icone-angle-right"></span>Nueva Nota</a></li>
                                            <?php } ?>
                                                
                                            <?php if ($acceso_lla == 'Habilitado'){ ?> 
                                                <li class=""><a href="../vistas/?id=llamadas"><span class="icon icone-angle-right"></span>Llamadas</a></li>
                                            <?php } ?>
                                            
                                            <?php if ($acceso_reu == 'Habilitado'){ ?> 
                                                <li class=""><a href="../vistas/?id=reuniones"><span class="icon icone-angle-right"></span>Reuniones</a></li>
                                            <?php } ?>
                                                
                                            <?php if ($acceso_tar == 'Habilitado'){ ?> 
                                                <li class=""><a href="../vistas/?id=tareas"><span class="icon icone-angle-right"></span>Tareas</a></li>
                                            <?php } ?>
                                            
                                            <?php if ($acceso_not == 'Habilitado'){ ?> 
                                                <li class=""><a href="../vistas/?id=notas"><span class="icon icone-angle-right"></span>Notas</a></li>
                                            <?php } ?>
                                            
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <?php if ($acceso_con == 'Habilitado'){ ?>
                                        <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu6">
                                            <span class="icon icon-folder-open"></span>
                                            <span class="text">Contactos</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu6" class="<?php  if($_GET['id']=='ver_paciente' ||$_GET['id']=='pacientes' ||$_GET['id']=='paciente' ||$_GET['id']=='contactos_p' ||$_GET['id']=='contacto' ||$_GET['id']=='contactos' ||$_GET['id']=='empresa' ||$_GET['id']=='empresas' || $_GET['id']=='ver_empresa' || $_GET['id']=='ver_contacto'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                              <?php if($_SESSION['area']=='OFICINA'){ ?><li class=""><a href="../vistas/?id=pacientes&ok"><span class="icon icone-angle-right"></span>Lista Pacientes</a></li>  <?php } ?>
                                                                                      
                                             <li class=""><a href="../vistas/?id=contacto"><span class="icon icone-angle-right"></span> Nuevo Contacto</a></li>
                                            <li class=""><a href="../vistas/?id=contactos"><span class="icon icone-angle-right"></span> Contactos</a></li>
                                            <li class=""><a href="../vistas/?id=empresa"><span class="icon icone-angle-right"></span> Nueva Empresa</a></li>
                                            <li class=""><a href="../vistas/?id=empresas"><span class="icon icone-angle-right"></span> Empresas</a></li>
                                          
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <?php } ?>
                                    
                                    
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu7">
                                            <span class="icon icone-briefcase"></span>
                                            <span class="text">Soporte (<font color="red"><?php echo $ca['count(*)']; ?></font>)</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu7" class="<?php  if($_GET['id']=='incidencias_at' ||$_GET['id']=='caso' ||$_GET['id']=='ver_casos' ||$_GET['id']=='casos' ||$_GET['id']=='incidencia' ||$_GET['id']=='incidencias' || $_GET['id']=='ver_incidencias'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <?php if($acceso_aten == 'Habilitado'){ ?>
                                                <li class=""><a href="../vistas/?id=incidencias_at"><span class="icon icone-angle-right"></span>Reportes de Atenciones (<font color="red"><?php echo $ca['count(*)']; ?></font>)</a></li>
                                            <?php } ?>
                                                
                                            <?php if($acceso_cas == 'Habilitado'){ ?>
                                                <li class=""><a href="../vistas/?id=caso"><span class="icon icone-angle-right"></span>Nuevo Caso</a></li>
                                            <?php } ?>
                                                
                                            <?php if($acceso_cas == 'Habilitado'){ ?>
                                                <li class=""><a href="../vistas/?id=casos"><span class="icon icone-angle-right"></span>Casos</a></li>
                                            <?php } ?>
                                                
                                            <?php if($acceso_inc == 'Habilitado'){ ?>
                                                <li class=""><a href="../vistas/?id=incidencia"><span class="icon icone-angle-right"></span>Nueva Novedad</a></li>
                                            <?php } ?>
                                                
                                            <?php if($acceso_inc == 'Habilitado'){ ?>
                                                <li class=""><a href="../vistas/?id=incidencias"><span class="icon icone-angle-right"></span>Novedades en procesos</a></li>
                                            <?php } ?>
                                                <?php if($acceso_inc == 'Habilitado'){ ?>
                                                <li class=""><a href="../vistas/?id=incidencias_ok"><span class="icon icone-angle-right"></span>Novedades Solucionadas</a></li>
                                            <?php } ?>
                                           
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                     <?php if($acceso_can == 'Habilitado'){ ?>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu8">
                                            <span class="icon icone-wrench"></span>
                                            <span class="text">Inventario</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>

                                        <ul id="submenu8" class="<?php  if($_GET['id']=='proveedores' ||$_GET['id']=='movimientos' || $_GET['id']=='bodegas'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=proveedores"><span class="icon icone-angle-right"></span>Proveedores</a></li>
                                            <li class=""><a href="../vistas/?id=bodegas"><span class="icon icone-angle-right"></span>Bodegas</a></li>
                                            <li class=""><a href="../vistas/?id=movimientos"><span class="icon icone-angle-right"></span>Lista de Movimientos</a></li>

                                          
                                        </ul>

                                    </li>
                                     <?php } ?>
<!--                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu9">
                                            <span class="icon icone-money"></span>
                                            <span class="text">Oportunidades</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                         START Submenu Menu 
                                        <ul id="submenu9" class="<?php  if($_GET['id']=='oportunidades' ||$_GET['id']=='oportunidad' ||$_GET['id']=='ver_oportunidades'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=oportunidad"><span class="icon icone-angle-right"></span>Nueva Oportunidades</a></li>
                                            <li class=""><a href="../vistas/?id=oportunidades"><span class="icon icone-angle-right"></span>Oportunidades</a></li>
                                            
                                          
                                        </ul>
                                        / END Submenu Menu 
                                    </li>-->
<!--                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu10">
                                            <span class="icon icon-tasks"></span>
                                            <span class="text">Campañas</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                         START Submenu Menu 
                                        <ul id="submenu10" class="<?php  if($_GET['id']=='campana' ||$_GET['id']=='campanas' ||$_GET['id']=='ver_campanas'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=campana"><span class="icon icone-angle-right"></span>Nueva Campaña</a></li>
                                            <li class=""><a href="../vistas/?id=campanas"><span class="icon icone-angle-right"></span>Campañas</a></li>
                                            
                                          
                                        </ul>
                                        / END Submenu Menu 
                                    </li>-->
<?php if($_SESSION['area']=='OFICINA'){ ?>
                        
                                <?php if($acceso_prod == 'Habilitado'){ ?>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu11">
                                            <span class="icon icon-shopping-cart"></span>
                                            <span class="text">Productos</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu11" class="<?php  if($_GET['id']=='prod_alquiler' ||$_GET['id']=='enfermedades' ||$_GET['id']=='atenciones' ||$_GET['id']=='producto' ||$_GET['id']=='productos' ||$_GET['id']=='ver_productos'||$_GET['id']=='medicamentos'||$_GET['id']=='insumos'||$_GET['id']=='equipos'){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=producto"><span class="icon icone-angle-right"></span>Nuevo Producto</a></li>
                                            <li class=""><a href="../vistas/?id=productos"><span class="icon icone-angle-right"></span>Productos en Ventas</a></li>
                                            <li class=""><a href="../vistas/?id=prod_alquiler"><span class="icon icone-angle-right"></span>Productos en Alquiler</a></li>
                                            <li class=""><a href="../vistas/?id=insumos"><span class="icon icone-angle-right"></span>Insumos</a></li>
                                            <li class=""><a href="../vistas/?id=medicamentos"><span class="icon icone-angle-right"></span>Medicamentos</a></li>
                                          <li class=""><a href="../vistas/?id=atenciones"><span class="icon icone-angle-right"></span>Atenciones</a></li>
                                           <li class=""><a href="../vistas/?id=enfermedades"><span class="icon icone-angle-right"></span>Enfermedades</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                <?php } ?>
                                    
<?php } ?>
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu12">
                                            <span class="icon icon-calendar"></span>
                                            <span class="text">Calendario</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu12" class="<?php  if($_GET['id']=='mi_calendario' ||$_GET['id']=='all_calendario' ){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=mi_calendario"><span class="icon icone-angle-right"></span>Mi Calendario</a></li>
                                            <li class=""><a href="../vistas/?id=all_calendario"><span class="icon icone-angle-right"></span>Calendario de todos</a></li>
                                            
                                          
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    <?php if($_SESSION['area']=='OFICINA'){ ?>
                                   
                                    <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu13">
                                            <span class="icon icon-user"></span>
                                            <span class="text">Administrador</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu13" class="<?php  if($_GET['id']=='noticias' ||$_GET['id']=='modificaciones' ||$_GET['id']=='areas' ||$_GET['id']=='user' ||$_GET['id']=='list_user' ||$_GET['id']=='rol' ){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="../vistas/?id=user"><span class="icon icone-angle-right"></span>Nuevo Usuario</a></li>
                                            <li class=""><a href="../vistas/?id=list_user"><span class="icon icone-angle-right"></span>Usuarios</a></li>
                                            <li class=""><a href="../vistas/?id=rol"><span class="icon icone-angle-right"></span> Roles</a></li>
                                            <li class=""><a href="../vistas/?id=noticias"><span class="icon icone-angle-right"></span> Publicar Noticias</a></li>
                                            <li class=""><a href="../vistas/?id=modificaciones"><span class="icon icone-angle-right"></span> Registro de modificaciones</a></li>
                                            <li class=""><a href="../vistas/?id=areas"><span class="icon icone-angle-right"></span>Area de trabajo</a></li>
                                            <li class=""><a href="../vistas/?id=codigos"><span class="icon icone-angle-right"></span>Cuentas Contables</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    
                                     <li class="accordion-group ">
                                        <a data-toggle="collapse" data-parent="#navigation" href="#submenu14">
                                            <span class="icon icon-search"></span>
                                            <span class="text">Indicadores</span>
                                            <span class="arrow icone-caret-down"></span>
                                        </a>
                                        <!-- START Submenu Menu -->
                                        <ul id="submenu14" class="<?php  if($_GET['id']=='ordblo' ||$_GET['id']=='ordevo' ||$_GET['id']=='pacemp' ){echo 'collapse in';}else{echo 'collapse';}  ?>">
                                            <li class=""><a href="#reporte1" onclick="indicadores()"><span class="icon icone-angle-right"></span>Pacientes x Empresa</a></li>
                                            <li class=""><a href="../vistas/?id=reporte_efectividad"><span class="icon icone-angle-right"></span>Reporte de Efectividad</a></li>
                                            <li class=""><a href="../vistas/?id=reporte_atenciones"><span class="icon icone-angle-right"></span> Reporte de atenciones</a></li>
                                            <li class=""><a href="#reporteOportunidades"  onclick="indicadores2()"><span class="icon icone-angle-right"></span> Atenciones Oportunas</a></li>
                                        </ul>
                                        <!--/ END Submenu Menu -->
                                    </li>
                                    
                                    <?php } ?>
                                    <?php if ($acceso_doc == 'Habilitado'){ ?>
                                        <li class="accordion-group ">
                                            <a data-toggle="collapse" data-parent="#navigation" href="#submenu15">
                                                <span class="icon icone-cogs"></span>
                                                <span class="text">Documentacion</span>
                                                <span class="arrow icone-caret-down"></span>
                                            </a>
                                            <!-- START Submenu Menu -->
                                            <ul id="submenu15" class="<?php  if($_GET['id']=='at' ||$_GET['id']=='formatos' ||$_GET['id']=='gestion'){echo 'collapse in';}else{echo 'collapse';}  ?> ">

                                                <li class=""><a href="../vistas/?id=formatos"><span class="icon icone-angle-right"></span>Descarga de Formatos</a></li>
                                            </ul> 
                                    
                                        </li> 
                                    <?php } ?>
                                    
                                        <h5>
                                         <?php 
                                         include '../vistas/en_linea.php'; ?>
                                        </h5>
                                    <!--/ END Menu -->

                                 


                                    
                                    
                                    <!-- START Menu Divider -->
<!--                                    <li class="divider">Other Stuff</li>-->
                                    <!--/ END Menu Divider -->
                                </ul>
                                
                            </nav>
                          
                        </div>
                 
                    </div>
                    <!--/ END Tab Content -->
                </div>
                <!--/ END Sidebar Content -->
            </aside>