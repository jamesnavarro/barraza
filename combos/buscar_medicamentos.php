<?php
include "../modelo/conexion.php";

$request2=mysql_query('select count(*) from medicamentos');
if($request2){
	$request2 = mysql_fetch_row($request2);
	$num_items2 = $request2[0];
}else{
	$num_items2 = 0;
}
$rows_by_page2 = 30;
$last_page2 = ceil($num_items2/$rows_by_page2);
if(isset($_GET['page2'])){
	$page2 = $_GET['page2'];
}else{
	$page2 = 1;
}

if($_POST["elegido2"] == ''){
    if($page2>1){?>
	<a href="../vistas/?id=medicamentos&page2=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=medicamentos&page2=<?php echo $page2 - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page2;?> de <?php echo $last_page2;?>)
<?php
if($page2<$last_page2){?>
	<a href="../vistas/?id=medicamentos&page2=<?php echo $page2 + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=medicamentos&page2=<?php echo $last_page2;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}
?>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit2 = 'LIMIT ' .($page2 - 1) * $rows_by_page2 .',' .$rows_by_page2;

$request_l=mysql_query("SELECT * FROM medicamentos ".$limit2);

}else{
    $request_l=mysql_query("SELECT * FROM medicamentos WHERE concat(codigo,'',nombre_medicamento) like '%".$_POST["elegido2"]."%'");
}

if($request_l){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Codigo'.'</th>';          
              $table = $table.'<th width="20%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'Concentracion'.'</th>';
              $table = $table.'<th width="5%">'.'Forma'.'</th>';
              $table = $table.'<th width="5%">'.'Precio'.'</th>';
              $table = $table.'<th width="5%">'.'Acciones'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request_l))
	{       
 
            $table = $table.'<tr><td width="5%">'.$row['codigo'].'</a></td>'
                    . '<td width="20%">'.$row['nombre_medicamento'].'</td>'
                    . '<td width="5%">'.$row['concentracion'].'</td>'
                    . '<td width="10%">'.$row['forma'].'</td>'
                    . '<td width="10%">'.number_format($row['precio_med']).'</td>
                              <td width="5%"><a href="../vistas/?id=medicamentos&up='.$row["id_medicina"].'""><img src="../imagenes/modificar.png"></a> <a href="../vistas/?id=medicamentos&del='.$row["id_medicina"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
  
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}  
?>
        
 
	
