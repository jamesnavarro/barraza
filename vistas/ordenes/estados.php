<?php
if($_SESSION['area']=='OFICINA'){
   $requestl=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_contacto="" and a.prioridad!="Facturado" and a.Location="" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc ');  
 }  else {
       $requestl=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.user="'.$_SESSION['k_username'].'" and  a.id_contacto="" and a.prioridad!="Facturado"  and a.Location="" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc ');  
 
}$noi = mysql_num_rows($requestl);
    if($_SESSION['area']=='OFICINA'){
    $requestenp=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_contacto>0 and a.id_contacto<98 and a.prioridad!="Facturado" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc ');   
    }else{
          $requestenp=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.user="'.$_SESSION['k_username'].'" and  a.id_contacto>0 and a.id_contacto<98 and a.prioridad!="Facturado" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc ');   
   
    }
    $enp = mysql_num_rows($requestenp);
     if($_SESSION['area']=='OFICINA'){
    $requestf=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.id_contacto>98 and a.Location="" and a.prioridad!="Facturado" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc ');
     }  else {
           $requestf=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.user="'.$_SESSION['k_username'].'" and  a.id_contacto>98 and a.Location="" and a.prioridad!="Facturado" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc ');
    
}$sin = mysql_num_rows($requestf);
     if($_SESSION['area']=='OFICINA'){
    $requestg=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.Location!="" and a.prioridad!="Facturado" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc ');
     }  else {
          $requestg=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, ordenes c where a.user="'.$_SESSION['k_username'].'" and  a.Location!="" and a.prioridad!="Facturado" and a.id_paciente=b.id_paciente and c.id_paciente=b.id_paciente and a.archivo=c.id group by orden_servicio desc ');
   
}$fac = mysql_num_rows($requestg);

    ?>


<?php if($_SESSION['area']=='OFICINA'){ ?>
Ordenes No iniciada (<font color="red"><?php echo $noi; ?></font>)
Ordenes En Proceso (<font color="red"><?php echo $enp; ?></font>)
Sin Revisar (<font color="red"><?php echo $sin; ?></font>)
Por Facturar (<font color="red"><?php echo $fac; ?></font>)
<?php }else{ ?>
<a href="../vistas/?id=ordenes&no-iniciada">Ordenes No iniciada (<font color="red"><?php echo $noi; ?></font>)</a> 
<a href="../vistas/?id=ordenes&en-proceso">Ordenes En Proceso (<font color="red"><?php echo $enp; ?></font>)</a>
<a href="../vistas/?id=ordenes&completadas">Sin Revisar (<font color="red"><?php echo $sin; ?></font>)</a>


<?php } ?>
