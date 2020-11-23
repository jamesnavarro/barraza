<?php

if(isset($_SESSION["id_user"])){
$consul1="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Tareas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resul1=  mysql_query($consul1);
while($fila=  mysql_fetch_array($resul1)){
$id_tar=$fila['id'];
$id_roles_tar=$fila['id_roles'];
$modulo_tar=$fila['modulo'];
$acceso_tar=$fila['acceso'];
$eliminar_tar=$fila['eliminar'];
$editar_tar=$fila['editar'];
$exportar_tar=$fila['exportar'];
$importar_tar=$fila['importar'];
$crear_tar=$fila['listar'];
$ver_tar=$fila['ver'];
                          
 }}
if(isset($_SESSION["id_user"])){
$consultaC="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Llamadas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultC=  mysql_query($consultaC);
while($fila=  mysql_fetch_array($resultC)){
$id_lla=$fila['id'];
$id_roles_lla=$fila['id_roles'];
$modulo_lla=$fila['modulo'];
$acceso_lla=$fila['acceso'];
$eliminar_lla=$fila['eliminar'];
$editar_lla=$fila['editar'];
$exportar_lla=$fila['exportar'];
$importar_lla=$fila['importar'];
$crear_lla=$fila['listar'];
$ver_lla=$fila['ver'];
                          
 }}
 if(isset($_SESSION["id_user"])){
$consultaT="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Reuniones' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultT=  mysql_query($consultaT);
while($fila=  mysql_fetch_array($resultT)){
$id_rT=$fila['id'];
$id_roles_reu=$fila['id_roles'];
$modulo_reu=$fila['modulo'];
$acceso_reu=$fila['acceso'];
$eliminar_reu=$fila['eliminar'];
$editar_reu=$fila['editar'];
$exportar_reu=$fila['exportar'];
$importar_reu=$fila['importar'];
$crear_reu=$fila['listar'];
$ver_reu=$fila['ver'];
                          
 }}
  if(isset($_SESSION["id_user"])){
$consultaL="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]."  and b.area='CRM' and b.modulo='Notas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultL=  mysql_query($consultaL);
while($fila=  mysql_fetch_array($resultL)){
$id_est=$fila['id'];
$id_roles_not=$fila['id_roles'];
$modulo_not=$fila['modulo'];
$acceso_not=$fila['acceso'];
$eliminar_not=$fila['eliminar'];
$editar_not=$fila['editar'];
$exportar_not=$fila['exportar'];
$importar_not=$fila['importar'];
$crear_not=$fila['listar'];
$ver_not=$fila['ver'];
                          
 }}
   if(isset($_SESSION["id_user"])){
$consultaR="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Contactos' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultR=  mysql_query($consultaR);
while($fila=  mysql_fetch_array($resultR)){
$id_mat=$fila['id'];
$id_roles_con=$fila['id_roles'];
$modulo_con=$fila['modulo'];
$acceso_con=$fila['acceso'];
$eliminar_con=$fila['eliminar'];
$editar_con=$fila['editar'];
$exportar_con=$fila['exportar'];
$importar_con=$fila['importar'];
$crear_con=$fila['listar'];
$ver_con=$fila['ver'];
                          
 }}
    if(isset($_SESSION["id_user"])){
$consultaN="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Empresa' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultN=  mysql_query($consultaN);
while($fila=  mysql_fetch_array($resultN)){
$id_pre=$fila['id'];
$id_roles_emp=$fila['id_roles'];
$modulo_emp=$fila['modulo'];
$acceso_emp=$fila['acceso'];
$eliminar_emp=$fila['eliminar'];
$editar_emp=$fila['editar'];
$exportar_emp=$fila['exportar'];
$importar_emp=$fila['importar'];
$crear_emp=$fila['listar'];
$ver_emp=$fila['ver'];
                           
 }}
     if(isset($_SESSION["id_user"])){
$consultaCAM="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Incidencias' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultCAM=  mysql_query($consultaCAM);
while($fila=  mysql_fetch_array($resultCAM)){
$id_lin=$fila['id'];
$id_roles_inc=$fila['id_roles'];
$modulo_inc=$fila['modulo'];
$acceso_inc=$fila['acceso'];
$eliminar_inc=$fila['eliminar'];
$editar_inc=$fila['editar'];
$exportar_inc=$fila['exportar'];
$importar_inc=$fila['importar'];
$crear_inc=$fila['listar'];
$ver_inc=$fila['ver'];
                          
 }}
     if(isset($_SESSION["id_user"])){
$consultaPR="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Casos' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultPR=  mysql_query($consultaPR);
while($fila=  mysql_fetch_array($resultPR)){
$id_act=$fila['id'];
$id_roles_cas=$fila['id_roles'];
$modulo_cas=$fila['modulo'];
$acceso_cas=$fila['acceso'];
$eliminar_cas=$fila['eliminar'];
$editar_cas=$fila['editar'];
$exportar_cas=$fila['exportar'];
$importar_cas=$fila['importar'];
$crear_cas=$fila['listar'];
$ver_cas=$fila['ver'];
                         
 }}
     if(isset($_SESSION["id_user"])){
$consultaIN="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Oportunidades' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultIN=  mysql_query($consultaIN);
while($fila=  mysql_fetch_array($resultIN)){
$id_inc=$fila['id'];
$id_roles_cor=$fila['id_roles'];
$modulo_cor=$fila['modulo'];
$acceso_cor=$fila['acceso'];
$eliminar_cor=$fila['eliminar'];
$editar_cor=$fila['editar'];
$exportar_cor=$fila['exportar'];
$importar_cor=$fila['importar'];
$crear_cor=$fila['listar'];
$ver_cor=$fila['ver'];
                          
 }}
     if(isset($_SESSION["id_user"])){
$consultaCA="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Campañas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultCA=  mysql_query($consultaCA);
while($fila=  mysql_fetch_array($resultCA)){
$id_cas=$fila['id'];
$id_roles_can=$fila['id_roles'];
$modulo_can=$fila['modulo'];
$acceso_can=$fila['acceso'];
$eliminar_can=$fila['eliminar'];
$editar_can=$fila['editar'];
$exportar_can=$fila['exportar'];
$importar_can=$fila['importar'];
$crear_can=$fila['listar'];
$ver_can=$fila['ver'];
                      
 }}
     if(isset($_SESSION["id_user"])){
$consultaCL="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Productos' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultCL=  mysql_query($consultaCL);
while($fila=  mysql_fetch_array($resultCL)){
$id_rCL=$fila['id'];
$id_roles_prod=$fila['id_roles'];
$modulo_prod=$fila['modulo'];
$acceso_prod=$fila['acceso'];
$eliminar_prod=$fila['eliminar'];
$editar_prod=$fila['editar'];
$exportar_prod=$fila['exportar'];
$importar_prod=$fila['importar'];
$crear_prod=$fila['listar'];
$ver_prod=$fila['ver'];
                          
 }}
     if(isset($_SESSION["id_user"])){
$consultaEM="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Proyectos' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultEM=  mysql_query($consultaEM);
while($fila=  mysql_fetch_array($resultEM)){
$id_rEM=$fila['id'];
$id_roles_proy=$fila['id_roles'];
$modulo_proy=$fila['modulo'];
$acceso_proy=$fila['acceso'];
$eliminar_proy=$fila['eliminar'];
$editar_proy=$fila['editar'];
$exportar_proy=$fila['exportar'];
$importar_proy=$fila['importar'];
$crear_proy=$fila['listar'];
$ver_proy=$fila['ver'];
                          
 }}
      if(isset($_SESSION["id_user"])){
$consulta0="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Configuracion' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$result0=  mysql_query($consulta0);
while($fila=  mysql_fetch_array($result0)){
$id_rO=$fila['id'];
$id_roles_conf=$fila['id_roles'];
$modulo_conf=$fila['modulo'];
$acceso_conf=$fila['acceso'];
$eliminar_conf=$fila['eliminar'];
$editar_conf=$fila['editar'];
$exportar_conf=$fila['exportar'];
$importar_conf=$fila['importar'];
$crear_conf=$fila['listar'];
$ver_conf=$fila['ver'];
                          
 }}
       if(isset($_SESSION["id_user"])){
$consulta0="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Atenciones' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$result0=  mysql_query($consulta0);
while($fila=  mysql_fetch_array($result0)){
$id_rO=$fila['id'];
$id_roles_aten=$fila['id_roles'];
$modulo_aten=$fila['modulo'];
$acceso_aten=$fila['acceso'];
$eliminar_aten=$fila['eliminar'];
$editar_aten=$fila['editar'];
$exportar_aten=$fila['exportar'];
$importar_aten=$fila['importar'];
$crear_aten=$fila['listar'];
$ver_aten=$fila['ver'];
                          
 }}
       if(isset($_SESSION["id_user"])){
$consulta0="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Alquiler' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$result0=  mysql_query($consulta0);
while($fila=  mysql_fetch_array($result0)){
$id_rO=$fila['id'];
$id_roles_alq=$fila['id_roles'];
$modulo_alq=$fila['modulo'];
$acceso_alq=$fila['acceso'];
$eliminar_alq=$fila['eliminar'];
$editar_alq=$fila['editar'];
$exportar_alq=$fila['exportar'];
$importar_alq=$fila['importar'];
$crear_alq=$fila['listar'];
$ver_alq=$fila['ver'];
                          
 }}
       if(isset($_SESSION["id_user"])){
$consulta0="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Ventas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$result0=  mysql_query($consulta0);
while($fila=  mysql_fetch_array($result0)){
$id_rO=$fila['id'];
$id_roles_ven=$fila['id_roles'];
$modulo_ven=$fila['modulo'];
$acceso_ven=$fila['acceso'];
$eliminar_ven=$fila['eliminar'];
$editar_ven=$fila['editar'];
$exportar_ven=$fila['exportar'];
$importar_ven=$fila['importar'];
$crear_ven=$fila['listar'];
$ver_ven=$fila['ver'];
                          
 }}
 
        if(isset($_SESSION["id_user"])){
$consulta0="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Pacientes' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$result0=  mysql_query($consulta0);
while($fila=  mysql_fetch_array($result0)){
$id_rO=$fila['id'];
$id_roles_pac=$fila['id_roles'];
$modulo_pac=$fila['modulo'];
$acceso_pac=$fila['acceso'];
$eliminar_pac=$fila['eliminar'];
$editar_pac=$fila['editar'];
$exportar_pac=$fila['exportar'];
$importar_pac=$fila['importar'];
$crear_pac=$fila['listar'];
$ver_pac=$fila['ver'];
                          
 }}
        if(isset($_SESSION["id_user"])){
$consulta0="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Facturacion' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$result0=  mysql_query($consulta0);
while($fila=  mysql_fetch_array($result0)){
$id_rO=$fila['id'];
$id_roles_fac=$fila['id_roles'];
$modulo_fac=$fila['modulo'];
$acceso_fac=$fila['acceso'];
$eliminar_fac=$fila['eliminar'];
$editar_fac=$fila['editar'];
$exportar_fac=$fila['exportar'];
$importar_fac=$fila['importar'];
$crear_fac=$fila['listar'];
$ver_fac=$fila['ver'];
          

 }}
 
        if(isset($_SESSION["id_user"])){
$consulta0="SELECT a.id, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Documentacion' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$result0=  mysql_query($consulta0);
while($fila=  mysql_fetch_array($result0)){
$id_rO=$fila['id'];
$id_roles_doc=$fila['id_roles'];
$modulo_doc=$fila['modulo'];
$acceso_doc=$fila['acceso'];
$eliminar_doc=$fila['eliminar'];
$editar_doc=$fila['editar'];
$exportar_doc=$fila['exportar'];
$importar_doc=$fila['importar'];
$crear_doc=$fila['listar'];
$ver_doc=$fila['ver'];
                          
 }}
 
?>
