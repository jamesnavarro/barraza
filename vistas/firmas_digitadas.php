<?php
session_start();
include "../modelo/conexion.php";
 require '../modelo/consultar_paciente.php';

 require '../modelo/consultar_permisos.php';
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
  
?>
<!DOCTYPE html>
<html>
    <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<style>
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #FFFFFF;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 1px;
}
table.blueTable tbody td {
  font-size: 11px;
  font-weight: bold;
  color: #333333;
}
table.blueTable tr:nth-child(even) {
  background: #FFFFFF;
}
table.blueTable td:nth-child(even) {
  background: #FFFFFF;
}
table.blueTable thead {
  background: #B0ACB7;
  background: -moz-linear-gradient(top, #c4c1c9 0%, #b8b4be 66%, #B0ACB7 100%);
  background: -webkit-linear-gradient(top, #c4c1c9 0%, #b8b4be 66%, #B0ACB7 100%);
  background: linear-gradient(to bottom, #c4c1c9 0%, #b8b4be 66%, #B0ACB7 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 14px;
  font-weight: bold;
  color: #212121;
  text-align: left;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 11px;
  font-weight: normal;
  color: #FFFFFF;
  background: #FFFFFF;
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 11px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #FFFFFF;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
.enca{
    font-size: 11px;
}
    </style>
    <script type="text/javascript">

</script>
        <title>INTERNACION DOMICILIARIA BARRAZA</title>
    </head>
    <body onLoad="cerrar()">
    <?php
    $sqla = "SELECT * FROM actividad where orden_servicio='".$_GET["oi"]."'  group by orden_servicio";
                $filaa = mysql_fetch_array(mysql_query($sqla));
                $Description = $filaa["Description"];
                $orden_servicio = $filaa["orden_servicio"];
                $orden_externa = $filaa["orden_externa"];
                $cant = $filaa["cant"];  $user = $filaa["user"];
                
                $result = mysql_query("select * from pacientes where id_paciente='".$filaa["id_paciente"]."' ");
                $p = mysql_fetch_array($result);
                
                $result2 = mysql_query("select * from sis_empresa where rips='".$p["id_empresa"]."' ");
                $e = mysql_fetch_array($result2);
                
                $result3 = mysql_query("select * from usuarios where usuario='".$filaa["user"]."' ");
                $u = mysql_fetch_array($result3);
    ?>
        
        <fieldset style="width:100%; float:center; margin-right: 3%;">
            <article class="module width_full">
                <header><h3><center>Planilla de Asistencia</center></h3></header>
                <div class="enca">
                <?php
                    echo '<b>Paciente: </b>'.$p["nombres"].' '.$p["nombre2"].' '.$p["apellidos"].' '.$p["apellido2"].'<br>';
                    echo '<b>Afiliado a: </b>'.$e["nombre_emp"].'<br>';
                    echo '<b>Profesional: '.$u["nombre"].''.$u["apellido"].'</b><br>';
                    echo '<b>Cantidad de visitas: </b>'.$cant.'<br>';
                
                
                ?>
                    </div>
                <hr>
                        
                      
                      
                       <?php 

if(isset($_GET['oi'])) {  
  
$request=mysql_query('select * from actividad where estado="Completada" and orden_servicio='.$_GET['oi']);
   
if($request){
//    echo'<hr>';
       $table = '<table class="blueTable">';
             $table = $table.'<thead >';
              $table = $table.'<tr>';
              $table = $table.'<th style="width:40px">'.'Visita'.'</th>';
              $table = $table.'<th style="width:60px">'.'Orden Interna'.'</th>';
              $table = $table.'<th style="width:60px">'.'Autorizacion'.'</th>';
              $table = $table.'<th style="width:80px">'.'Fecha de Visita'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'<th style="width:120px">'.'Atendido Por'.'</th>';
              $table = $table.'<th style="width:120px">'.'Firmado Por'.'</th>';
              $table = $table.'<th style="width:120px;text-align:center">'.'Firma'.'</th>';
             
              $table = $table.'</tr>';
$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
		$table = $table.'<tr><td>'.$row["cant_ins"].'</td>'
                        . '<td>'.$row["orden_servicio"].'</td>'
                         . '<td>'.$row["orden_externa"].'</td>'
                        . '<td>'.$row['fecha_mod_ta'].'</td>'
                        . '<td>'.$row['Subject'].'<br>'.$row['Description'].'</td>'
                        . '<td>'.$row['user'].'</td>'
                        . '<td>'.$row['quien'].'</td>'
                        . '<td><img src="'.$row['firmadigital'].'" width="80px"></td>';
                
                
               
	}
       
	$table = $table.'</table>';
        
	echo $table;
        
}}


                       ?>
		</article>
		    </fieldset>
    </body>
</html>