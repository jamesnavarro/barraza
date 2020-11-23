<?php 
include '../modelo/conexion.php';
if($_GET['nombre']==''){
    $nom = '';
}else{
    $nom = $_GET['nombre'];
}

$request=mysql_query('select count(*) from usuarios  where concat(nombre," ",apellido," ",cargo) like "%'.$_GET['nombre'].'%" and estado_empleado="'.$_GET['estado'].'" ');
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 20;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
?> 
<?php
if($page>1){?>
<a href="javascript:void(0);" onclick="buscar(1)"><img src="../images/a1.png"></a>
	<a href="javascript:void(0);"  onclick="buscar(<?php echo $page - 1;?>)"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="javascript:void(0);"  onclick="buscar(<?php echo $page + 1;?>)"><img src="../images/p1.png"></a>
	<a href="javascript:void(0);"  onclick="buscar(<?php echo $last_page;?>)"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

echo 'Cantidad de Usuarios: '.$num_items;
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

$requests=mysql_query("SELECT * FROM usuarios where concat(nombre,' ',apellido,' ',cargo) like '%".$nom."%' and estado_empleado='".$_GET['estado']."' ".$limit);

if($requests){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
                        
            
              $table = $table.'<th width="20%">'.'Nombre Completo'.'</th>';
              $table = $table.'<th width="10%">'.'Telefono'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cargo'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Area.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Correo.'.'</th>';
             
              $table = $table.'<th class="hidden-phone">'.'Usuario'.'</th>';

              $table = $table.'<th class="hidden-phone">'.'Foto'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Firma'.'</th>';
              $table = $table.'<th></th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($requests))
	{       
 
            $table = $table.'<tr><td width="20%"><a href="../vistas/?id=user&cod='.$row['id'].'">'.$row["nombre"].' '.$row["apellido"].'<font></a></td><td width="10%">'.$row["telefono"].'<font></a></td>
               <td class="hidden-phone">'.$row["cargo"].'</font></td><td class="hidden-phone">'.$row["area"].'</font></td><td class="hidden-phone">'.$row["email"].'</font></td>'
                    . '<td class="hidden-phone">'.$row["usuario"].'</font></td>
                    <td class="hidden-phone"><img src="../fotos_barraza/'.$row["foto"].'" width="20px"></td>
                    <td class="hidden-phone"><img src="../img_barraza/'.$row["ruta"].'" width="30px"></td><td> <a href="../vistas/?id=list_user&del='.$row["id"].'"><img src="../imagenes/eliminar.png"></a></font></td></tr>';   
      
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        
     
}
?>
