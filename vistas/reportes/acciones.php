<?php
include('../../modelo/conexion.php');
session_start();
if(isset($_SESSION['k_username'])){ 
switch ($_GET['sw']) {
        case 0:
                  $emp = $_GET['emp'];
                  $ano = $_GET['ano'];
                 
                  $query = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."%' ");
                  $r = mysql_fetch_array($query);
                  
                  $queryt = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp'  ");
                  $t = mysql_fetch_array($queryt);
                  
                  
                  
                   $query_ene = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-01%' ");
                  $ene1 = mysql_fetch_array($query_ene);
                  
                   $query_ene2 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-02%' ");
                  $ene2 = mysql_fetch_array($query_ene2);
                  
                   $query_ene3 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-03%' ");
                  $ene3 = mysql_fetch_array($query_ene3);
                  
                   $query_ene4 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-04%' ");
                  $ene4 = mysql_fetch_array($query_ene4);
                  
                   $query_ene5 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-05%' ");
                  $ene5 = mysql_fetch_array($query_ene5);
                  
                   $query_ene6 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-06%' ");
                  $ene6 = mysql_fetch_array($query_ene6);
                  
                   $query_ene7 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-07%' ");
                  $ene7 = mysql_fetch_array($query_ene7);
                  
                   $query_ene8 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-08%' ");
                  $ene8 = mysql_fetch_array($query_ene8);
                  
                   $query_ene9 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-09%' ");
                  $ene9 = mysql_fetch_array($query_ene9);
                  
                   $query_ene10 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-10%' ");
                  $ene10 = mysql_fetch_array($query_ene10);
                  
                  $query_ene11 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-11%' ");
                  $ene11 = mysql_fetch_array($query_ene11);
                  
                  $query_ene12 = mysql_query("select count(id_paciente) from pacientes where id_empresa='$emp' and fecha_reg like '".$ano."-12%' ");
                  $ene12 = mysql_fetch_array($query_ene12);
                  
                  $p = array();
                  $p[0] = 'Cantidad de Pacientes registrado en el '.$ano.': '.$r[0].' , total hasta la fecha :'.$t[0].' ';
                  $p[1] = $ene1[0];
                  $p[2] = $ene2[0];
                  $p[3] = $ene3[0];
                  $p[4] = $ene4[0];
                  $p[5] = $ene5[0];
                  $p[6] = $ene6[0];
                  $p[7] = $ene7[0];
                  $p[8] = $ene8[0];
                  $p[9] = $ene9[0];
                  $p[10] = $ene10[0];
                  $p[11] = $ene11[0];
                  $p[12] = $ene12[0];
                  $p[13] = ''.$t[0];
                  
                  
                  
                  echo json_encode($p);
                  
                    
     
            break;
        case 1:
            $emp = $_GET['emp'];
                  $ano = $_GET['ano'];
                 
                  $query = mysql_query("SELECT a.id_paciente, fecha_reg_ta FROM pacientes a, actividad b WHERE a.id_paciente=b.id_paciente AND a.id_empresa='".$emp."' AND b.fecha_reg_ta LIKE '".$ano."%' GROUP BY orden_servicio ");
                  
                  $num = mysql_num_rows($query);
                  $c = 1;
                  $a1 = 0;
                  $a2 = 0;
                  $a3 = 0;
                  $a4 = 0;
                  $a5 = 0;
                  $a6 = 0;
                  $a7 = 0;
                  $a8 = 0;
                  $a9 = 0;
                  $a10 = 0;
                  $a11 = 0;
                  $a12 = 0;
                  while ($r = mysql_fetch_array($query)) {
                      $c++;
                      $fecha = substr($r[1],0,7);
                      $dia = $ano."/01";
                      if($fecha == $dia){
                           $a1++;
                      }
                      $dia = $ano."/02";
                      if($fecha == $dia){
                          $a2++;
                      }
                      $dia = $ano."/03";
                      if($fecha == $dia){
                          $a3++;
                      }
                      $dia = $ano."/04";
                      if($fecha == $dia){
                          $a4++;
                      }
                      $dia = $ano."/05";
                      if($fecha == $dia){
                          $a5++;
                      }
                      $dia = $ano."/06";
                      if($fecha == $dia){
                          $a6++;
                      }
                      $dia = $ano."/07";
                      if($fecha == $dia){
                          $a7++;
                      }
                      $dia = $ano."/08";
                      if($fecha == $dia){
                          $a8++;
                      }
                      $dia = $ano."/09";
                      if($fecha == $dia){
                          $a9++;
                      }
                      $dia = $ano."/10";
                      if($fecha == $dia){
                          $a10++;
                      }
                      $dia = $ano."/11";
                      if($fecha == $dia){
                          $a11++;
                      }
                      $dia = $ano."/12";
                      if($fecha == $dia){
                          $a12++;
                      }
                      
                      
                  }
                  
                  
                  $p = array();
                  $p[0] = 'Cantidad de atenciones en el '.$ano.': '.$num.'   codigo empresa: '.$fecha.'  ';
                  $p[1] = $a1;
                  $p[2] = $a2;
                  $p[3] = $a3;
                  $p[4] = $a4;
                  $p[5] = $a5;
                  $p[6] = $a6;
                  $p[7] = $a7;
                  $p[8] = $a8;
                  $p[9] = $a9;
                  $p[10] = $a10;
                  $p[11] = $a11;
                  $p[12] = $a12;
//                  $p[13] = ''.$t[0];
                  
                  
                  
                  echo json_encode($p);
           
           break;
        case 2:
            $ano = $_GET['ano'];
                   $query = mysql_query("select * from sis_empresa where cliente='Si'");
                   $a = array();
                   $b = array();
                   $c = 0;
                        while ($row = mysql_fetch_array($query)) {
                         $emp = $row['rips']; 
                         $query2 = mysql_query("SELECT a.id_paciente, fecha_reg_ta FROM pacientes a, actividad b WHERE a.id_paciente=b.id_paciente AND a.id_empresa='".$emp."' AND b.fecha_reg_ta LIKE '".$ano."%' GROUP BY orden_servicio ");
                  
                          $b[$c] = $num = mysql_num_rows($query2);
                          $a[$c] = $row['nombre_emp']; 
                          $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                          $d[$c] = ('#'.$rand);
                          $c++;
                        
                    }
                    $p = array();
                    $p[0] = json_encode($a);
                    $p[1] = json_encode($b);
                    $p[2] = json_encode($d);
                    echo json_encode($p);
           break;
        case 3:
            $ano = $_GET['ano'];
            $mes = $_GET['mes'];
            $emp = $_GET['emp'];
            $usu = $_GET['usu'];
            if($mes==0){
                $fecha = $ano;
            }else{
                $fecha = $ano.'-'.$mes;
            }
            if($usu==''){
                $usuario = '';
            }else{
                $usuario = ' and b.user="'.$usu.'" ';
            }
            
            
            $query = mysql_query("SELECT * FROM pacientes a, actividad b WHERE a.id_paciente=b.id_paciente AND a.id_empresa like '%".$emp."%' $usuario AND b.StartTime LIKE '".$fecha."%'  GROUP BY orden_servicio order by b.StartTime asc ");
                  
             $num = mysql_num_rows($query);
             $table = '<table><tr>'
                     . '<th>ORDEN</th>'
                     . '<th>PROFESIONAL</th>'
                     . '<th>PACIENTE</th>'
                     . '<th>FECHA INICIO</th>'
                     . '<th>EVOLUCION</th>'
                     . '<th>DIAS TRANCURRIDO</th>';   
             while ($r = mysql_fetch_array($query)) {
                 
                 $datetime1 = date_create($r['StartTime']);
                $datetime2 = date_create($r['fecha_mod_ta']);
                $interval = date_diff($datetime1, $datetime2);
                $dias = $interval->format('%R%a días');
                if($r['fecha_mod_ta']==''){
                    $dt = 'Sin evolucionar';
                }else{
                    $dt = $dias;
                }
                
               $table = $table.'<tr>'
                       . '<td>'.$r['orden_servicio'].'</td>'
                       . '<td>'.$r['user'].'</td>'
                       . '<td>'.$r['Subject'].'</td>'
                       . '<td>'.$r['StartTime'].'</td>'
                       . '<td>'.$r['fecha_mod_ta'].'</td>'
                       . '<td>'.$dt.'</td>';     
             }
             echo $table;
                  
        break;
        case 4:
           
            break;
       
}
}else{
    echo 'x';
}
?>