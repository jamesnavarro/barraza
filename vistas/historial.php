<?php 
include "../modelo/conexion.php";
 require '../modelo/consultar_permisos.php';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=historial_ventas.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!doctype html>
<html lang="en">

<head>
	
</head>
<body onload="window.close();">       
<?php 

//////////

//////////
if(isset($_GET['cod'])){
$consulta3= "select * from sis_empresa where id_empresa='".$_GET['cod']."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){

$nombre=$fila['nombre_emp'];
$rips=$fila['rips'];

}}

 ?>
		
		
		
		
<article class="module width_full">
<form name="insertar_empresa"  class="span12 widget shadowed dark form-horizontal bordered"  action="" method="post" enctype="multipart/form-data">
    <header>
        <h4 class="title">Historial de Ventas : <?php echo $nombre.' Rips: '.$rips; ?></h4>
       
    </header>
    <hr>                        

    <?php
$request3=mysql_query('select a.*, b.* from insumos_asignados a, insumos b, ordenes c, pacientes d where a.numero_orden=c.id and c.id_paciente=d.id_paciente and a.cant_usada!=0 and a.cod_insumo=b.codigo and a.facturado!="" and d.id_empresa="'.$rips.'"');
$request4=mysql_query('select a.*, b.* from medicamentos_asig a, medicamentos b, ordenes c, pacientes d  where  a.numero_orden=c.id and c.id_paciente=d.id_paciente and a.cod_med=b.codigo_int and a.facturado!="" and d.id_empresa="'.$rips.'"');
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Fact N°.'.'</th>';
             $table = $table.'<th>'.'Orden Int.'.'</th>';
             $table = $table.'<th>'.'Autorizacion'.'</th>';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'<th>'.'Anexo'.'</th>';
              $table = $table.'<th>'.'cantidad'.'</th>';
              $table = $table.'<th>'.'Precio x Unid.'.'</th>';
              $table = $table.'<th>'.'Neto a Pagar.'.'</th>';
              
              
               
              
           $table = $table.'</tr>';

$table = $table.'</thead>';
  $t3=0;
        while($row=mysql_fetch_array($request3))
    {       
               $st3=$row['sub_precio']*$row['cant_usada'];
                $t3=$t3+$st3;
        $table = $table.'<tr><td>'.$row["facturado"].'</td><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_insumo"].'</td><td>'.$row['nombre_insumo'].'</td><td>'.$row["inf_adicional"].'</td><td>'.$row['cant_usada'].
                        '</td><td>'.$row['sub_precio'].'</td><td>'.$row['sub_precio']*$row['cantidad'].'</td></tr>';
        
    }
        $t4=0;
        while($row=mysql_fetch_array($request4))
    {    
               $st4=$row['sub_precio_m']*$row['cantidad_usada'];
                $t4=$t4+$st4;
        $table = $table.'<tr><td>'.$row["facturado"].'</td><td>'.$row["rel_atencion"].'</td><td>'.$row["autorizacion"].'</td><td>'.$row["cod_med"].'</td><td>'.$row['nombre_medicamento'].'</td><td>'.$row["info"].'</td><td>'.$row['cantidad_usada'].
                        '</td><td>'.$row['sub_precio_m'].'</td><td>'.$row['sub_precio_m']*$row['cantidad_usada'].'</td></tr>';
       
    }
    $table = $table.'</table>';
        
    echo $table;
    ?>
    </div>    
</form>
    </body> 
</html>
		
		
		
		
		