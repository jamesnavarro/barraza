<?php 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=auditoria.xls");
?>
<?php
include '../modelo/conexion.php';
                                                    
     $fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
$newfecha = date ( 'Y-m-d' , $nuevafecha );
?>
        
<?php
$est = $_GET['estado'];
$fer = $_GET['ano'].'-'.$_GET['mes'];
$request=mysql_query("SELECT * FROM actividad a, pacientes b where b.fecha_reg like '".$fer."%' and b.estado like '".$est."%' and a.id_paciente=b.id_paciente group by a.id_paciente order by a.EndTime desc ");

if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="" border="1">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="20%">'.'Nombre de Paciente'.'</th>'; 
              $table = $table.'<th width="8%">'.'Cedula'.'</th>';
              $table = $table.'<th width="30%">'.'Empresa'.'</th>';
              $table = $table.'<th width="8%">'.'Telefeno'.'</th>';
              $table = $table.'<th width="8%">'.'Celular'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Acudiente'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alta temprana'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Ultima Atencion..'.'</th>';
              $table = $table.'<th class="hidden-phone">Fecha de Ingreso</th>';
             
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=  mysql_fetch_array($request))
	{     $total2 +=1;  

$consulta2= "select * from sis_empresa WHERE  rips='".$row['id_empresa']."'";
$result2=  mysql_query($consulta2);
$fila=  mysql_fetch_array($result2);
$idempresa=$fila['id_empresa'];
$empresa=$fila['nombre_emp'];
$consulta3=  mysql_query("select EndTime from actividad WHERE  id_paciente=".$row['id_paciente']."  group by id_paciente, EndTime desc limit 1");
$u=  mysql_fetch_array($consulta3);
$cont=0;
          
            $table = $table.'<tr>
                <td width="20%">'.$row['nombres'].' '.$row['nombre2'].' '.$row['apellidos'].' '.$row['apellido2'].'</td> 
                <td width="8%">'.$row['numero_doc'].'<font></a></td>
                    <td width="30%">'.$empresa.'</td>
               <td class="hidden-phone">'.$row["tel_1"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["celular"].'</font></td><td class="hidden-phone">'.$row["nombre_acudiente"].'</font></td><td class="hidden-phone">'.$row["estado"].'</font></td>
                             <td class="hidden-phone">'.$u["EndTime"].'</font></td>'
                    . '<td>'.$row["fecha_reg"].'</td>
                               </tr>';   
      
        }
        
        
	$table = $table.'</table>';
      echo  '<br>Total de pacientes Registrado '.$total2.' ';
	echo $table;
       
      
        
     
}


?>
                                                
