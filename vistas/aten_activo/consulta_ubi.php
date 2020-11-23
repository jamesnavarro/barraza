<?php
include '../../modelo/conexion.php';

//$p = array(0 => array('Brooklyn Museum', 40.671531, -73.963588),1 => array('Brooklyn Public Library, NY', 40.672587, -73.968146),2 =>array('Prospect Park Zoo, NY', 40.665588, -73.965336));

$query = mysql_query("SELECT b.barrio,b.lat,b.lng,b.nombres,b.apellidos FROM actividad a, pacientes b WHERE a.id_paciente=b.id_paciente AND a.id_contacto<98 and a.user like '%".$_POST['usuario']."%' and b.lat!='' and b.lng!='' GROUP BY a.orden_servicio ");

    $n = 0;
//   $p = array(
//   0 => array('Brooklyn Museum', 40.671531, -73.963588),
//   1 => array('Brooklyn Public Library, NY', 40.672587, -73.968146)
//   );
   
  $array2 = array();
   while ($fila = mysql_fetch_array($query)){
       $array = array();
       $array[] = $fila[0].' - '.$fila[3].' '.$fila[4];
       $array[] = $fila[1];
       $array[] = $fila[2];
       $array2[] = $array;
        $n ++;
    }
   $p = $array2; 
echo json_encode($p);
exit();


