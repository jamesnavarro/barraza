
<?php
if($page>1){?>
	<a href="../vistas/?id=recibo_de_caja&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=recibo_de_caja&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=recibo_de_caja&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=recibo_de_caja&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>
        <form action="" method="post">
            <input type="text" class="span8" name="buscar" value="<?php if(isset($_POST['buscar'])){echo $_POST['buscar'];}   ?>" placeholder="Digite el nombre del paciente, numero de recibo ">
            <input type="submit" name="enviar" value="Buscar Paciente"><input type="submit" name="recibo" value="Buscar Recibo">
        </form>
<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["buscar"])){
$nom =$_POST["buscar"];


if($nom ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';

    $request=  mysql_query("select a.*, b.* from recibo_caja a, pacientes b where a.id_paciente=b.id_paciente order by a.id_recibo desc ".$limit);

}else{
    if(isset($_POST["recibo"])){
        $request=  mysql_query("select * from recibo_caja a, pacientes b where a.id_paciente=b.id_paciente and a.numero_recibo='".$nom."' ");
  
    }else{
$request=  mysql_query("select * from recibo_caja a, pacientes b where a.id_paciente=b.id_paciente and CONCAT(b.nombres, ' ',b.apellidos, ' ',b.numero_doc) LIKE '%".$nom."%' ");
    }}}
else{
 
     $request=  mysql_query("select a.*, b.* from recibo_caja a, pacientes b where a.id_paciente=b.id_paciente  order by a.id_recibo desc ".$limit);

}

if($request){
//    echo'<hr>';
        $table = '<table class="table table-bordered table-striped table-hover" id="">';
        $table = $table.'<thead>';
        $table = $table.'<tr>';
        $table = $table.'<th>'.'No. Recibo'.'</th>';
        $table = $table.'<th>'.'Tipo de Recibo'.'</th>';
        $table = $table.'<th>'.'Cedula del Paciente'.'</th>';
        $table = $table.'<th>'.'Nombre del Paciente'.'</th>';
        $table = $table.'<th>'.'Pagos Realizados'.'</th>';
         $table = $table.'<th>'.'Total'.'</th>';
            $table = $table.'<th>'.'Saldo Pendiente'.'</th>';
        $table = $table.'<th>'.'Fecha de Registro'.'</th>';
        $table = $table.'<th>'.'Imprimir'.'</th>';
        $table = $table.'</tr>';
        $table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
            if($row["cod_alquiler"]=='atenciones'){
                $ver='<a href="../vistas/?id=facturacion_recibo_atenciones&fact='.$row["numero_recibo"].'">';
                 $c='<a target="_blank" href="../imprimir_recibo_aten.php?imprimir='.$row["numero_recibo"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a>';

            }else{
           if($row["cod_alquiler"]=='ventas'){
                $ver='<a href="../vistas/?id=facturacion_recibo_ventas&fact='.$row["numero_recibo"].'">';
                 $c='<a target="_blank" href="../imprimir_recibo_ven.php?imprimir='.$row["numero_recibo"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a>';

            }else{
           $ver='<a href="../vistas/?id=facturacion_recibo&fact='.$row["numero_recibo"].'">';
            $c='<a target="_blank" href="../imprimir_recibo.php?imprimir='.$row["numero_recibo"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a>';

            }
            }
          
           $table = $table.'<tr><td>'.$ver.''.$row["numero_recibo"].'<font></a></td><td>'.$row["cod_alquiler"].'</td></td>
               <td>'.$ver.''.$row["numero_doc"].'<font></a></td><td>'.$row["nombres"].' '.$row["apellidos"].'</font></td>'
                   . '<td>'.number_format($row['copagos']).'</td>'
                   . '<td>'.number_format($row['total']).'</td>'
                   . '<td>'.number_format($row['total']-$row['copagos']).'</td>'
                   . '<td>'.$row['fecha_registro'].'</font></td>
                   
                           <td>'.$c.'</td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminar_a']))
    {
        $Codigo=$_GET['eliminar_a'];
        $sql = "DELETE FROM actividad WHERE Id='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Actividad Eliminada");location.href="../vistas/mostrar_actividades.php"</script>'; 
}
 
                                              
?>
