<?php 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=auditoria_atenciones.xls");
?>
<?php
include '../modelo/conexion.php';
                                                    
     $fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
$newfecha = date ( 'Y-m-d' , $nuevafecha );
?>
        
<?php

$fer = $_GET['ano'].'/'.$_GET['mes'];
$request=mysql_query("SELECT *, count(cant) FROM actividad a, pacientes b where a.id_paciente=b.id_paciente and a.fecha_reg_ta like '".$fer."%' group by a.id_paciente order by count(a.cant) desc");
if($request){
    $table = '<table class="table table-bordered table-striped table-hover" id="">';

              $table = $table.'<thead>';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Items'.'</th>';
              $table = $table.'<th>'.'Pacientes'.'</th>';
              $table = $table.'<th>'.'Atencion'.'</th>';
              $table = $table.'<th>'.'Cantidad Atenciones'.'</th>';
               $table = $table.'<th>'.'Cantidad Ordenes'.'</th>';
              
             
              $table = $table.'<th>'.'Fecha de Registro'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $cont=0;
	while($row=mysql_fetch_array($request))
	{     
         $sub= mysql_query("SELECT * FROM `actividad` where id_paciente='".$row["id_paciente"]."' and fecha_reg_ta like '".$fer."%' group by orden_servicio");
            
             $ord = mysql_num_rows($sub);
         $cont = $cont + 1 ;
if($_GET['mes']=='01'){$mes = 'ENERO';}
if($_GET['mes']=='02'){$mes = 'FEBRERO';}
if($_GET['mes']=='03'){$mes = 'MARZO';}
if($_GET['mes']=='04'){$mes = 'ABRIL';}
if($_GET['mes']=='05'){$mes = 'MAYO';}
if($_GET['mes']=='06'){$mes = 'JUNIO';}
if($_GET['mes']=='07'){$mes = 'JULIO';}
if($_GET['mes']=='08'){$mes = 'AGOSTO';}
if($_GET['mes']=='09'){$mes = 'SEPTIEMBRE';}
if($_GET['mes']=='10'){$mes = 'OCTUBRE';}
if($_GET['mes']=='11'){$mes = 'NOVIEMBRE';}
if($_GET['mes']=='12'){$mes = 'DICIEMBRE';}

  $table = $table.'<tr><td>'.$cont.'<font></a></td>'
          . '<td>'.$row["nombres"].' '.$row["nombre2"].' '.$row["apellidos"].' '.$row["apellido2"].'</td>'
                    . '<td>'.$row["Description"].'</font></td>'
                    . '<td>'.$row["count(cant)"].'</font></td>'
           . '<td>'.$ord.'</font></td>'
                    . '<td>'.$mes.'</font></td>'
                    . '
                   
                       </tr>';   
               
           
               
	}
        
	$table = $table.'</table>';
        
	echo $table;

}   


?>
                                                
