<?php
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I')); //2016 // 2012 //
include "../modelo/conexion.php";

if(isset($_SESSION['k_username'])){
    if(isset($_POST['xxx'])){
        if(isset($_POST['a'])){
               $requestZ=mysql_query('SELECT count(*), id_paciente FROM pacientes where numero_doc="'.$_POST['xxx'].'"  '); 
             $r2 = mysql_fetch_array($requestZ);
             if($r2['count(*)']!=0){
                echo '<script lanquage="javascript">alert("Se encontro con exito");location.href="../vistas/?id=ver_paciente&cod='.$r2['id_paciente'].' "</script>';
		
             }else{
                 echo '<script lanquage="javascript">alert("No hay registros de este documento");location.href="../vistas/?id=paciente"</script>';
              

		
             }
        }else{
            $requesty=mysql_query('SELECT count(*) FROM actividad a, pacientes b, ordenes c where a.orden_servicio='.$_POST['xxx'].' and  a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc '); 
             $r = mysql_fetch_array($requesty);
             if($r['count(*)']!=0){
                echo '<script lanquage="javascript">alert("Se encontro una orden interna");location.href="../vistas/?id=ver_orden_interna&ord='.$_POST['xxx'].' "</script>';
		
             }else{
                 $requestZ=mysql_query('SELECT count(*) FROM actividad a, pacientes b, ordenes c where a.orden_externa="'.$_POST['xxx'].'" and  a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc '); 
             $r2 = mysql_fetch_array($requestZ);
             if($r2['count(*)']!=0){
                echo '<script lanquage="javascript">alert("Se encontro una orden interna");location.href="../vistas/?id=ver_orden_externa&codigo='.$_POST['xxx'].' "</script>';
		
             }else{
                 echo '<script lanquage="javascript">alert("No hay registro de esta orden ");location.href="../vistas/?id=ordenes&no-iniciada"</script>';
              

		
             }
             
             }
             }
    }else{
          if($_GET['id']=='sesionesx')               {include '../vistas/telerehab/sesionn.php';}
       if($_GET['id']=='preguntas')               {include '../vistas/telerehab/preguntas.php';}
     if($_GET['id']=='ejercicios')               {include '../vistas/telerehab/ejercicios.php';}
         if($_GET['id']=='tratamientos')               {include '../vistas/telerehab/tratamientos_ws.php';}
    if($_GET['id']=='user')                     {if($_SESSION["admin"]=='Si')        {include '../vistas/usuarios.php';}                             else{include '../vistas/denied.php';}}
    if($_GET['id']=='liquidacion')                     {if($_SESSION["admin"]=='Si')        {include '../vistas/liquser.php';}                             else{include '../vistas/denied.php';}}
    if($_GET['id']=='liquidacion_total')        {if($_SESSION["admin"]=='Si')        {include '../vistas/liq_atenciones_lista.php';}                             else{include '../vistas/denied.php';}}
     if($_GET['id']=='liquidaciones')                     {if($_SESSION["admin"]=='Si')        {include '../vistas/liq_atenciones.php';}                             else{include '../vistas/denied.php';}}
    if($_GET['id']=='llamada')                  {if($crear_lla=='Habilitado')        {include '../vistas/llamadas/llamadas.php';}                    else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_llamada')              {if($ver_lla=='Habilitado')          {include '../vistas/llamadas/ver_llamada.php';}                 else{include '../vistas/denied.php';}}
    
    if($_GET['id']=='llamadas')                 {if($acceso_lla=='Habilitado')       {include '../vistas/llamadas/lista.php';}                       else{include '../vistas/denied.php';}}
    if($_GET['id']=='reunion')                  {if($crear_reu=='Habilitado')        {include '../vistas/reunion/reuniones.php';}                    else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_reunion')              {if($ver_reu=='Habilitado')          {include '../vistas/reunion/ver_reunion.php';}                  else{include '../vistas/denied.php';}}
    if($_GET['id']=='reuniones')                {if($acceso_reu=='Habilitado')       {include '../vistas/reunion/lista.php';}                        else{include '../vistas/denied.php';}}
    if($_GET['id']=='tarea')                    {if($crear_tar=='Habilitado')        {include '../vistas/tareas/actividad.php';}                     else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_tarea')                {if($ver_tar=='Habilitado')          {include '../vistas/tareas/ver_tarea.php';}                     else{include '../vistas/denied.php';}}
    if($_GET['id']=='tareas')                   {if($acceso_tar=='Habilitado')       {include '../vistas/tareas/lista.php';}                         else{include '../vistas/denied.php';}}
    if($_GET['id']=='clientes')                 {if($crear_pro=='Habilitado')        {include '../vistas/form_crm/contacto.php';}                    else{include '../vistas/denied.php';}}
    if($_GET['id']=='clientes_p')               {if($crear_pro=='Habilitado')        {include '../vistas/form_crm/clientes_potenciales.php';}        else{include '../vistas/denied.php';}}
    
    if($_GET['id']=='empresa')                  {if($crear_emp=='Habilitado')        {include '../vistas/empresa/empresa.php';}                      else{include '../vistas/denied.php';}}
    if($_GET['id']=='empresas')                 {if($acceso_emp=='Habilitado')       {include '../vistas/empresa/lista.php';}                        else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_empresa')              {if($ver_emp=='Habilitado')          {include '../vistas/empresa/ver_empresa.php';}                  else{include '../vistas/denied.php';}}
    if($_GET['id']=='contacto')                 {if($crear_con=='Habilitado')        {include '../vistas/contactos/contacto.php';}                   else{include '../vistas/denied.php';}}
    
    if($_GET['id']=='contactos')                {if($acceso_con=='Habilitado')       {include '../vistas/contactos/lista.php';}                      else{include '../vistas/denied.php';}}
    if($_GET['id']=='contactos_p')              {if($acceso_con=='Habilitado')       {include '../vistas/contactos/lista_1.php';}                    else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_contacto')             {if($ver_con=='Habilitado')          {include '../vistas/contactos/ver_contacto.php';}               else{include '../vistas/denied.php';}}
    if($_GET['id']=='list_user')                {if($_SESSION["admin"]=='Si')        {include '../vistas/lista_1.php';}                              else{include '../vistas/denied.php';}}
    
    if($_GET['id']=='nota')                     {if($crear_not=='Habilitado')        {include '../vistas/notas/notas.php';}                          else{include '../vistas/denied.php';}}      
    if($_GET['id']=='ver_notas')                {if($ver_not=='Habilitado')          {include '../vistas/notas/ver_nota.php';}                       else{include '../vistas/denied.php';}}
    if($_GET['id']=='notas')                    {if($acceso_not=='Habilitado')       {include '../vistas/notas/lista.php';}                          else{include '../vistas/denied.php';}}
    if($_GET['id']=='caso')                     {if($crear_cas=='Habilitado')        {include '../vistas/casos/casos.php';}                          else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_casos')                {if($ver_cas=='Habilitado')          {include '../vistas/casos/ver_casos.php';}                      else{include '../vistas/denied.php';}}
    if($_GET['id']=='casos')                    {if($acceso_cas=='Habilitado')       {include '../vistas/casos/lista.php';}                          else{include '../vistas/denied.php';}}
    if($_GET['id']=='incidencia')               {if($crear_inc=='Habilitado')        {include '../vistas/incidencias/incidencias.php';}              else{include '../vistas/denied.php';}}
    
    if($_GET['id']=='ver_incidencias')          {if($ver_inc=='Habilitado')          {include '../vistas/incidencias/ver_incidencias.php';}          else{include '../vistas/denied.php';}}
    if($_GET['id']=='incidencias')              {if($acceso_inc=='Habilitado')       {include '../vistas/incidencias/lista.php';}                    else{include '../vistas/denied.php';}}
    if($_GET['id']=='incidencias_ok')              {if($acceso_inc=='Habilitado')       {include '../vistas/incidencias/lista_1.php';}                    else{include '../vistas/denied.php';}}
    
    if($_GET['id']=='oportunidad')              {if($crear_opo=='Habilitado')        {include '../vistas/oportunidad/oportunidades.php';}            else{include '../vistas/denied.php';}}
    if($_GET['id']=='oportunidades')            {if($acceso_opo=='Habilitado')       {include '../vistas/oportunidad/lista.php';}                    else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_oportunidades')        {if($ver_opo=='Habilitado')          {include '../vistas/oportunidad/ver_oportunidades.php';}        else{include '../vistas/denied.php';}}
    
    if($_GET['id']=='campana')                  {if($crear_can=='Habilitado')        {include '../vistas/campana/campanas.php';}                     else{include '../vistas/denied.php';}}
    if($_GET['id']=='campanas')                 {if($acceso_can=='Habilitado')       {include '../vistas/campana/lista.php';}                        else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_campanas')             {if($ver_can=='Habilitado')          {include '../vistas/campana/ver_campanas.php';}                 else{include '../vistas/denied.php';}}
    if($_GET['id']=='proyecto')                 {if($crear_proy=='Habilitado')       {include '../vistas/proyecto/proyectos.php';}                   else{include '../vistas/denied.php';}}
    if($_GET['id']=='proyectos')                {if($acceso_proy=='Habilitado')      {include '../vistas/proyecto/lista.php';}                       else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_proyectos')            {if($ver_proy=='Habilitado')         {include '../vistas/proyecto/ver_proyectos.php';}               else{include '../vistas/denied.php';}}
    
    if($_GET['id']=='tarea_proyecto')           {if($ver_proy=='Habilitado')         {include '../vistas/proyecto/ver_t_proyectos.php';}             else{include '../vistas/denied.php';}}
    if($_GET['id']=='tareas_proyectos')         {if($ver_proy=='Habilitado')         {include '../vistas/proyecto/lista_tareas.php';}                else{include '../vistas/denied.php';}}
    if($_GET['id']=='producto')                 {if($crear_prod=='Habilitado')       {include '../vistas/productos/productos.php';}                  else{include '../vistas/denied.php';}}
    if($_GET['id']=='productos')                {if($acceso_prod=='Habilitado')      {include '../vistas/productos/lista.php';}                      else{include '../vistas/denied.php';}}
    if($_GET['id']=='movimientos')                {if($acceso_can=='Habilitado')  {include '../vistas/movimientos.php';}          else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_productos')            {if($ver_prod=='Habilitado')         {include '../vistas/productos/ver_productos.php';}              else{include '../vistas/denied.php';}}
    if($_GET['id']=='rol')                      {if($_SESSION["admin"]=='Si')        {include '../vistas/rol.php';}                                  else{include '../vistas/denied.php';}}
    if($_GET['id']=='areas')                    {if($acceso_conf=='Habilitado')      {include '../vistas/areas.php';}                                else{include '../vistas/denied.php';}}
    if($_GET['id']=='codigos')                 {if($acceso_conf=='Habilitado')      {include '../vistas/archivos/codigos_cont.php';}                else{include '../vistas/denied.php';}}
    if($_GET['id']=='reporte_atenciones')     {if($acceso_conf=='Habilitado')      {include '../vistas/reportesate/index.php';}                else{include '../vistas/denied.php';}}
    if($_GET['id']=='msg')                                                           {include '../vistas/mensajes/index.php';}
    if($_GET['id']=='online')                                                        {include '../vistas/usuarios_online.php';}
    if($_GET['id']=='redactar')                 {if($acceso_cor=='Habilitado')        {include '../vistas/correo/redactar.php';}                      else{include '../vistas/denied.php';}}  
    if($_GET['id']=='recibidos')                 {if($acceso_cor=='Habilitado')        {include '../vistas/correo/recibidos.php';}                      else{include '../vistas/denied.php';}}  
    if($_GET['id']=='enviados')                 {if($acceso_cor=='Habilitado')        {include '../vistas/correo/enviados.php';}                      else{include '../vistas/denied.php';}}  
    if($_GET['id']=='eliminados')                 {if($acceso_cor=='Habilitado')        {include '../vistas/correo/eliminados.php';}                      else{include '../vistas/denied.php';}}  
    if($_GET['id']=='noticias')                 {if($_SESSION["admin"]=='Si')        {include '../vistas/noticias.php';}                             else{include '../vistas/denied.php';}}
    if($_GET['id']=='paciente')                 {if($crear_pac=='Habilitado')        {include '../vistas/pacientes/paciente.php';}                   else{include '../vistas/denied.php';}}
    if($_GET['id']=='pacientes')                {if($acceso_pac=='Habilitado')       {include '../vistas/clientes.php';}                      else{include '../vistas/denied.php';}}
    if($_GET['id']=='pacientes_p')              {if($acceso_pac=='Habilitado')       {include '../vistas/pacientes/lista_p.php';}                    else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_paciente')             {if($ver_pac=='Habilitado')          {include '../vistas/pacientes/ver_paciente.php';}               else{include '../vistas/denied.php';}}
    if($_GET['id']=='add_orden')                {if($crear_aten=='Habilitado')       {include '../vistas/ordenes/crear_atencion.php';}               else{include '../vistas/denied.php';}}
    if($_GET['id']=='add_alquiler')             {if($crear_alq=='Habilitado')        {include '../vistas/alquiler/crear_alquiler.php';}              else{include '../vistas/denied.php';}}
    if($_GET['id']=='recibo_de_caja')           {if($crear_alq=='Habilitado')        {include '../vistas/recibos/index.php';}                     else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_recibo')       {if($crear_alq=='Habilitado')        {include '../vistas/alquiler/facturacion_recibo.php';}          else{include '../vistas/denied.php';}}
    if($_GET['id']=='recibo_de_alquiler')       {if($crear_alq=='Habilitado')        {include '../vistas/alquiler/recibo_de_caja.php';}              else{include '../vistas/denied.php';}}
    if($_GET['id']=='ordenes')                  {if($acceso_aten=='Habilitado')      {include '../vistas/ordenes/ordenes.php';}                      else{include '../vistas/denied.php';}}
    if($_GET['id']=='ordenes_all')              {if($_SESSION["area"]=='OFICINA')      {include '../vistas/lista_atenciones.php';}                      else{include '../vistas/denied.php';}}
    if($_GET['id']=='ordenes_block')            {if($_SESSION["area"]=='OFICINA')      {include '../vistas/atenciones/bloqueadas.php';}                      else{include '../vistas/denied.php';}}
    if($_GET['id']=='ordenes_s')                {if($acceso_aten=='Habilitado')      {include '../vistas/ordenes/solicitudes.php';}                  else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_orden_interna')        {if($ver_aten=='Habilitado')         {include '../vistas/ordenes/detalle_oi.php';}                   else{include '../vistas/denied.php';}}
    if($_GET['id']=='add_atenciones')           {if($crear_aten=='Habilitado')       {include '../vistas/ordenes/add_atenciones.php';}               else{include '../vistas/denied.php';}}
    if($_GET['id']=='historial_paciente')       {if($ver_aten=='Habilitado')         {include '../controlador/historial_paciente.php';}              else{include '../vistas/denied.php';}}
    if($_GET['id']=='historial_clinico')        {if($ver_aten=='Habilitado')         {include '../vistas/ordenes/historial_clinico.php';}            else{include '../vistas/denied.php';}}
    if($_GET['id']=='mostrar_historial')        {if($ver_aten=='Habilitado')         {include '../vistas/ordenes/mostrar_historial.php';}            else{include '../vistas/denied.php';}}
    if($_GET['id']=='ver_orden_externa')        {if($ver_aten=='Habilitado')         {include '../vistas/ordenes/detalle_ordenes_externa.php';}      else{include '../vistas/denied.php';}}
    if($_GET['id']=='llenar_atencion')          {if($ver_aten=='Habilitado')         {include '../vistas/ordenes/llenar_atencion.php';}              else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_recibo_caja')          {if($ver_fac=='Habilitado')         {include '../vistas/alquiler/facturacion_recibo_caja.php';}              else{include '../vistas/denied.php';}}
     if($_GET['id']=='reporte_efectividad')     {if($acceso_conf=='Habilitado')      {include '../vistas/reportesate/index_e.php';}                else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_recibo_atenciones')          {if($ver_fac=='Habilitado')         {include '../vistas/facturacion/recibo_atenciones.php';}              else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_recibo_ventas')          {if($ver_fac=='Habilitado')         {include '../vistas/facturacion/recibo_ventas.php';}              else{include '../vistas/denied.php';}}
        if($_GET['id']=='auditoria')          {if($ver_pac=='Habilitado')         {include '../vistas/pacientes/auditor.php';}              else{include '../vistas/denied.php';}}
        if($_GET['id']=='ubicacion')          {if($ver_pac=='Habilitado')         {include '../vistas/aten_activo/index.php';}              else{include '../vistas/denied.php';}}
    if($_GET['id']=='aud_atenciones')          {if($ver_pac=='Habilitado')         {include '../vistas/pacientes/atenciones.php';}              else{include '../vistas/denied.php';}}
     if($_GET['id']=='aud_atenc')          {if($ver_pac=='Habilitado')         {include '../vistas/pacientes/atenciones_pacientes.php';}              else{include '../vistas/denied.php';}}
    if($_GET['id']=='barrios')             {if($acceso_alq=='Habilitado')       {include '../vistas/barrios/index.php';}            else{include '../vistas/denied.php';}}
    if($_GET['id']=='reporte_alq')             {if($acceso_alq=='Habilitado')       {include '../vistas/alquiler/reportes.php';}            else{include '../vistas/denied.php';}}
    if($_GET['id']=='add_detalle_alquiler')     {if($crear_alq=='Habilitado')        {include '../vistas/alquiler/detalle_ordenes_alquiler.php';}    else{include '../vistas/denied.php';}}
    if($_GET['id']=='all_alquiler')             {if($acceso_alq=='Habilitado')       {include '../vistas/alquiler/alquiler_proceso.php';}            else{include '../vistas/denied.php';}}
    if($_GET['id']=='all_alquiler_full')        {if($acceso_alq=='Habilitado')       {include '../vistas/alquiler/alquiler_terminado.php';}          else{include '../vistas/denied.php';}}
    if($_GET['id']=='alquileres_pac')           {if($acceso_alq=='Habilitado')       {include '../vistas/alquiler/alquiler_proceso_pac.php';}        else{include '../vistas/denied.php';}}
    if($_GET['id']=='alquiler_prod')            {if($acceso_alq=='Habilitado')       {include '../vistas/alquiler/alquiler_de_productos.php';}       else{include '../vistas/denied.php';}}
    if($_GET['id']=='editar_alq')               {if($editar_alq=='Habilitado')       {include '../vistas/alquiler/editar_alquiler.php';}             else{include '../vistas/denied.php';}}
    if($_GET['id']=='add_detalle_venta')        {if($acceso_ven=='Habilitado')      {include '../vistas/ventas/detalle_ordenes_ventas.php';}        else{include '../vistas/denied.php';}}
    
    if($_GET['id']=='ventas')                   {if($acceso_ven=='Habilitado')       {include '../vistas/ventas/ventas.php';}                        else{include '../vistas/denied.php';}}
    if($_GET['id']=='ventas_no')                   {if($acceso_ven=='Habilitado')       {include '../vistas/ventas/ventas_facturadas.php';}                        else{include '../vistas/denied.php';}}
    if($_GET['id']=='add_ventas')               {if($crear_ven=='Habilitado')        {include '../vistas/ventas/crear_ventas.php';}                  else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturas')                 {if($acceso_fac=='Habilitado')       {include '../vistas/facturacion/facturas_todas.php';}           else{include '../vistas/denied.php';}}
     if($_GET['id']=='facturas_empresa')        {if($acceso_fac=='Habilitado')       {include '../vistas/facturar/index.php';}           else{include '../vistas/denied.php';}}
      if($_GET['id']=='facturas_empresa_alq')        {if($acceso_fac=='Habilitado')       {include '../vistas/facturar/index_alq.php';}           else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_finalizada')   {if($ver_fac=='Habilitado')          {include '../vistas/facturacion/facturacion_finalizada.php';}   else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_bloque')   {if($ver_fac=='Habilitado')          {include '../vistas/facturacion/facturacion_bloque.php';}   else{include '../vistas/denied.php';}}
     if($_GET['id']=='facturacion_bloque_alq')   {if($ver_fac=='Habilitado')          {include '../vistas/facturacion/facturacion_bloque_alq.php';}   else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_v')            {if($ver_fac=='Habilitado')          {include '../vistas/facturacion/facturacion_v.php';}            else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_2')            {if($ver_fac=='Habilitado')          {include '../vistas/facturacion/facturacion_2.php';}            else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_ventas')       {if($editar_fac=='Habilitado')       {include '../vistas/facturacion/facturacion_ventas.php';}       else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_alquiler')     {if($editar_fac=='Habilitado')       {include '../vistas/facturacion/facturacion_alquiler.php';}     else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturacion_autorizacion') {if($editar_fac=='Habilitado')       {include '../vistas/facturacion/facturacion_autorizacion.php';} else{include '../vistas/denied.php';}}
    if($_GET['id']=='facturas_null')            {if($acceso_fac=='Habilitado')       {include '../vistas/facturacion/facturas_pagas.php';}           else{include '../vistas/denied.php';}}
    if($_GET['id']=='rips')                     {if($acceso_fac=='Habilitado')       {include '../vistas/ordenes/archivos.php';}                     else{include '../vistas/denied.php';}}
    if($_GET['id']=='archivos')                 {if($acceso_fac=='Habilitado')       {include '../vistas/facturacion/archivos_por_empresa.php';}     else{include '../vistas/denied.php';}}
        if($_GET['id']=='bodegas')                 {if($acceso_prod=='Habilitado')       {include '../vistas/bodegas.php';}     else{include '../vistas/denied.php';}}
    if($_GET['id']=='medicamentos')             {if($acceso_prod=='Habilitado')      {include '../vistas/productos/medicamentos.php';}               else{include '../vistas/denied.php';}}
    if($_GET['id']=='insumos')                  {if($acceso_prod=='Habilitado')      {include '../vistas/productos/insumos.php';}                    else{include '../vistas/denied.php';}}
    if($_GET['id']=='prod_alquiler')            {if($acceso_prod=='Habilitado')      {include '../vistas/productos/equipos.php';}                    else{include '../vistas/denied.php';}}
    if($_GET['id']=='atenciones')               {if($acceso_prod=='Habilitado')      {include '../vistas/productos/atenciones.php';}                 else{include '../vistas/denied.php';}}
    if($_GET['id']=='enfermedades')             {if($acceso_prod=='Habilitado')      {include '../vistas/productos/enfermedades.php';}               else{include '../vistas/denied.php';}}
    if($_GET['id']=='precios_atenciones')       {if($acceso_prod=='Habilitado')      {include '../vistas/empresa/precios_atenciones.php';}           else{include '../vistas/denied.php';}}
    if($_GET['id']=='precios_alquiler')         {if($acceso_prod=='Habilitado')      {include '../vistas/empresa/precios_alquiler.php';}             else{include '../vistas/denied.php';}}
    if($_GET['id']=='precios_insumos')         {if($acceso_prod=='Habilitado')      {include '../vistas/empresa/precios_insumos.php';}             else{include '../vistas/denied.php';}}
    if($_GET['id']=='precios_ventas')         {if($acceso_prod=='Habilitado')      {include '../vistas/empresa/precios_ventas.php';}             else{include '../vistas/denied.php';}}
        if($_GET['id']=='proveedores')         {if($acceso_prod=='Habilitado')      {include '../vistas/proveedores.php';}             else{include '../vistas/denied.php';}}
    if($_GET['id']=='incidencias_at')           {if($acceso_inc=='Habilitado')       {include '../vistas/reportes/incidencias.php';}                 else{include '../vistas/denied.php';}}
    if($_GET['id']=='modificaciones')           {if($_SESSION["admin"]=='Si')        {include '../vistas/modificaciones.php';}                       else{include '../vistas/denied.php';}}
    if($_GET['id']=='autorizacion')             {if($crear_aten=='Habilitado')       {include '../vistas/autorizacion.php';}                         else{include '../vistas/denied.php';}}
    if($_GET['id']=='history')             {if($ver_conf=='Habilitado')       {include '../vistas/facturacion/historial.php';}                         else{include '../vistas/denied.php';}}
    if($_GET['id']=='mostrar_autorizacion')             {if($crear_aten=='Habilitado')       {include '../vistas/mostrar_autorizacion.php';}                         else{include '../vistas/denied.php';}}  
    if($_GET['id']=='mi_calendario')            {echo  '<iframe src="../sample.php"  height="900" width="100%"></iframe>';}
    if($_GET['id']=='all_calendario')           {echo  '<iframe src="../sample.php"  height="900" width="100%"></iframe>';}
    if($_GET['id']=='index'){include '../vistas/inicio.php';}
     if($_GET['id']=='cuenta'){include '../vistas/empleado.php';}
     if($_GET['id']=='hoy'){include '../vistas/atenciones_hoy.php';}
         if($_GET['id']=='mi_empresa')           {if($_SESSION["admin"]=='Si')        {include '../vistas/formulario_mi_empresa.php';}                       else{include '../vistas/denied.php';}}
        if($_GET['id']=='formatos'){if($acceso_doc=='Habilitado')       {include '../vistas/formatos.php';}                         else{include '../vistas/denied.php';}}
    if($_GET['id']=='firmas'){if($_SESSION["area"]=='OFICINA'){echo  '<iframe src="http://localhost/documentos/vistas/?oi='.$_GET['oi'].'&user='.$_SESSION['k_username'].' "  height="900" width="100%"></iframe>';}}
    }}else {header("location:../index.php");}

