<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$request=mysql_query('select count(*) from sis_empresa where cliente="Si"');
 
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
$_SESSION['formur'] = $_POST;
?>
<?php 

$data = $_SESSION['formur']; ?>
                
		
                    <article class="module width_full">
			<header><h3>Generar Archivos planos por empresas</h3></header>
                        
                      
				<div class="module_content">
                             

                                 
            <?php
if($page>1){?>
	<a href="../vistas/?id=rips&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/?id=rips&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/?id=rips&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/?id=rips&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["nombre"])){
$nom =$_POST["nombre"];
$tel =$_POST["telefono"];
$dir =$_POST["direccion"];
$use =$_POST["user"];
$pro =$_POST["propietario"];
$dep =$_POST["departamento"];
$mun =$_POST["municipio"];
$tip =$_POST["tipo"];
$cli ='Si';

if($nom =='' && $tel =='' && $dir =='' && $use =='' && $pro =='' && $dep =='' && $mun =='' && $tip ==''&& $cli ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=mysql_query('select * from sis_empresa where cliente="Si" order by id_empresa asc '.$limit);
}

if($nom !='' || $tel !='' || $dir !='' || $use !='' || $pro !='' || $dep !='' || $mun !='' || $tip !=''|| $cli !=''){

$request=mysql_query("select * from sis_empresa WHERE cliente LIKE '%".$cli."%' and nombre_emp LIKE '%".$nom."%' and tel_oficina_emp LIKE '%".$tel."%' and direccione_emp LIKE '%".$dir."%' and departameto_emp LIKE '%".$dep."%' and municipio_emp LIKE '%".$mun."%' and tipo_emp LIKE '%".$tip."%' and rips LIKE '%".$use."%' order by id_empresa asc ".$limit);
}
}
else{
$request=mysql_query('select * from sis_empresa where cliente="Si" order by id_empresa asc '.$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Rips'.'</th>';
              $table = $table.'<th>'.'Empresa'.'</th>';
               $table = $table.'<th>'.'Afiliado'.'</th>';
              $table = $table.'<th>'.'Tipo'.'</th>';
              $table = $table.'<th>'.'Ciudad'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
      

              $table = $table.'</tr>';
              $table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
           if($ver_prod=='Habilitado'){$ver='<a href="../vistas/?id=archivos&codigo='.$row["id_empresa"].'">';}else{$a='';}
           if($editar_prod=='Habilitado'){$b='<a href="../form_editar/formulario_editar_empresa.php?codigo='.$row["id_empresa"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($eliminar_prod=='Habilitado'){$c='<a href="../vistas/mostrar_empresas.php?eliminar='.$row["id_empresa"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
           
          
           
           
           $table = $table.'<tr><td>'.$row['rips'].'</font></td><td>'.$ver.''.$row["nombre_emp"].'<font></a></td><td>'.$row["cliente"].'<font></a></td></td><td>'.$row['tipo_emp'].'</font></td>
               <td>'.$row["municipio_emp"].'</font></td><td>'.$row["tel_oficina_emp"].'</font></td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM sis_empresa WHERE id_empresa='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro de la Empresa Eliminada");location.href="../vistas/mostrar_empresas.php"</script>'; 
    }
    
                        
                         
?>
       
				</div>
                       
		</article>
