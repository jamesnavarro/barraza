<?php 
if(isset($_GET['arc'])){
    include "../modelo/conexion.php";
    session_start();
    $orden_interna = $_GET['arc'];
}else{
    include "../modelo/conexion.php";
    $orden_interna = $orden_interna;
}
 
 if($_SESSION["area"] == 'OFICINA'){
$request=mysql_query("SELECT a.*, (a.id) as i, b.*, c.*,a.facturado FROM medicamentos_asig a, medicamentos b, ordenes c WHERE c.id=a.numero_orden  and a.cod_med=b.codigo_int and a.numero_orden='".$orden_interna."'  group by a.id");
    }else{
      $request=mysql_query("SELECT a.*, (a.id) as i, b.*, c.* FROM medicamentos_asig a, medicamentos b, ordenes c WHERE a.asignado_a='".$_SESSION['k_username']."' and c.id=a.numero_orden  and a.cod_med=b.codigo_int and a.numero_orden='".$orden_interna."'  group by a.id");
   
    }
if($request){
//    echo'<hr>';
      $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'# Orden Interna'.''.$orden_interna.'</th>';
              $table = $table.'<th>'.'Cod'.' '.$_SESSION["area"].'</th>';
              $table = $table.'<th>'.'Nombre Insumo'.'</th>';
              $table = $table.'<th>'.'Cant. Asig.'.'</th>';
              $table = $table.'<th>'.'Cant. Usadas.'.'</th>';
              $table = $table.'<th>'.'Cant. Rest.'.'</th>';
              if($_SESSION["admin"] == 'xx'){$table = $table.'<th>'.'$ Precio x Unid.'.'</th>'; }else {'<th></th>';}
              $table = $table.'<th>'.'Fecha Asig.'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              if($_SESSION["admin"] == 'xx'){ $table = $table.'<th>'.'$ Subtotal'.'</th>'; }else {'<th></th>';}
              if($_SESSION["area"] == 'OFICINA'){$table = $table.'<th>'.'Editar'.'</th>'; }else {'<th></th>';}
              if($_SESSION["area"] == 'OFICINA'){$table = $table.'<th>'.'Eliminar'.'</th>'; }else {'<th></th>';}
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total3=0;
	while($row=mysql_fetch_array($request))
	{       
            if($row["facturado"]=='nada'){
               $fact = 0;
           }else{
               $fact = $row["facturado"];
           }
           if($_SESSION["area"] == 'OFICINA'){$b='<a href="javascript:void(0);" onclick="medicinas_up('.$row["i"].','.$orden_interna.','.$row['rel_atencion'].','.$fact.','.$row['AfecInv'].')"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($_SESSION["area"] == 'OFICINA'){$c='<a href="javascript:void(0);" onclick="medicinas_del('.$row["i"].','.$orden_interna.','.$row['rel_atencion'].','.$row['AfecInv'].')"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}

        
          if($_SESSION["admin"] == 'xx'){$precio= '<td>$ '.$row['sub_precio_m'].'</font></td>'; }else{$precio='';}
           if($row['cantidad_rest']==0){
               $c='';
           }else{
               $c=$c;
           }
            $subtotal =$row['cantidad'] *$row['sub_precio_m'] ;
            if($_SESSION["admin"] == 'xx'){$r='<td>$ '.$subtotal.'</font></td>';}else {$r='';}
            $total3= $total3 + $subtotal;
            $table = $table.'<tr><td>'.$row['rel_atencion'].'<font></a></td>
               <td>'.$row["cod_med"].'</font></td><td>'.$row["nombre_medicamento"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td><td>'.$row['cantidad_usada'].'</font></td><td>'.$row['cantidad_rest'].'</font></td>'.$precio.'<td>'.$row['fecha_asig'].'</font></td><td>'.$row['asignado_a'].'</font></td>
                '.$r.' 
                         <td>'.$b.'</td>  <td>'.$c.'</td></tr>';
           
		
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total3;
}

       
                       ?>
