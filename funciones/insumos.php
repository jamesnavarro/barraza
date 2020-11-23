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
    
    if(isset($_GET['edt_ins'])){
    $query= "select a.*, b.* from insumos_asignados a, insumos b where a.cod_insumo=b.codigo and a.id_ia=".$_GET['edt_ins']."";                     
    $resultado=  mysql_query($query);
    while($rows=  mysql_fetch_array($resultado)){
        $codigo=$rows['codigo'];
        $nombre_insumo=$rows['nombre_insumo'];
        $cantidad=$rows['cantidad'];
        $cant_usada=$rows['cant_usada'];
        $cant_restante=$rows['cant_restante'];
        $rel_atencion=$rows['rel_atencion'];
        $precio=$rows['sub_precio'];
    }                                               
       }
     } 

    //$_SESSION['o']= $idp;     
if($_SESSION["area"] == 'OFICINA'){
$request=mysql_query("SELECT b.id ,a.*, b.*, c.*, a.facturado FROM insumos_asignados a, insumos b, ordenes c WHERE c.id=a.numero_orden and a.cod_insumo=b.codigo and a.numero_orden='".$orden_interna."'  group by id_ia");
}else{
   $request=mysql_query("SELECT b.id ,a.*, b.*, c.* FROM insumos_asignados a, insumos b, ordenes c WHERE a.asignado_a='".$_SESSION['k_username']."' and c.id=a.numero_orden and a.cod_insumo=b.codigo and a.numero_orden='".$orden_interna."'  group by id_ia");
 
}
if($request){
//    echo'<hr>';
      $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'# Orden Interna'.'</th>';
              $table = $table.'<th>'.'Cod'.'</th>';
              $table = $table.'<th>'.'Nombre Insumo'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
               $table = $table.'<th>'.'Cant. usadas'.'</th>';
                $table = $table.'<th>'.'Cant. Restante'.'</th>';
              if($_SESSION["admin"] == 'xx'){$table = $table.'<th>'.'Precio x Unid.'.'</th>';}else {'<th></th>';}
              $table = $table.'<th>'.'Fecha Asig.'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              if($_SESSION["area"] == 'OFICINA'){$table = $table.'<th>'.'Editar'.'</th>';}else {'<th></th>';}
              if($_SESSION["area"] == 'OFICINA'){$table = $table.'<th>'.'Eliminar'.'</th>';}else {'<th></th>';}
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $total1= 0;
	while($row=mysql_fetch_array($request))
	{       
              if($row["facturado"]=='nada'){
               $fact = 0;
           }else{
               $fact = $row["facturado"];
           }
           if($_SESSION["area"] == 'OFICINA'){
               $b='<a href="javascript:void(0);" onclick="insumos_up('.$row["id_ia"].','.$orden_interna.','.$row['rel_atencion'].','.$fact.','.$row['AfecInv'].')"><img src="../imagenes/modificar.png" title="solo se puede editar la cantidad" alt="ver" height="20px" width="20px"></a>';
               
           }else{$b='';}
           
            if($_SESSION["area"] == 'OFICINA'){$c='<a href="javascript:void(0);" onclick="insumos_del('.$row["id_ia"].','.$orden_interna.','.$row['rel_atencion'].','.$row['AfecInv'].')"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           
        
           if($_SESSION["admin"] == 'xx'){$precio= '<td>$ '.$row['sub_precio'].'</font></td>'; }else{$precio='';}
           
           $subtotal=$row['autorizacion'];
           if($_SESSION["admin"] == 'xx'){$g='<td>$ '.$subtotal.'</font></td>';}else {$g='<td></td>';}
           $total1= $total1 + $subtotal;
           if($row['cant_restante']==0){
               $c='';
           }else{
               $c=$c;
           }
            $table = $table.'<tr><td>'.$row['rel_atencion'].'<font></a></td>
               <td>'.$row["cod_insumo"].'</font></td><td>'.$row["nombre_insumo"].'</font></td>
                   <td>'.$row['cantidad'].'</font></td> <td>'.$row['cant_usada'].'</font></td> '
                    . '<td>'.$row['cant_restante'].'</font></td>'.$precio.'<td>'.$row['fecha_asignacion'].'</font></td>'
                    . '<td>'.$row['asignado_a'].'</font></td><td>'.$b.'</td><td>'.$c.'</td></tr>';  
	}
        
	$table = $table.'</table>';
        
	echo $table;
//        echo 'Neto a Pagar = '.$total1;
}

       
                       ?>
