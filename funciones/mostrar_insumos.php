<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
$request=mysql_query('select count(*) from insumos');
//require '../modelo/consultar_campana.php';
 date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 10;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}$_SESSION['t'] = $_POST;
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>sistema Integral</title>

	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="../resources/style.css" />
    <script type="text/javascript" src="../js/tcal.js"></script>
    
    
	
	
	
        <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
	<script type="text/javascript" src="../js/tcal.js"></script>
	
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
    


<style type="text/css">
            .show { display: block;  }
            .hide { display: none; }
     </style>

<script type="text/javascript"> function recargar() { window.location.reload() } </script>
</head>



<body>
   
	
	<section id="main" class="column">

		<div class="clear"></div>
                
		<article class="module width_full">
			<header><h3>insumos</h3></header>
                        
                         <?php  if($modulo_rCAM=='Campañas' && $listar_rCAM=='Habilitado'){?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                  
                                                <fieldset>
                                        
                                        <table>
                                             <tr>
                                               
                                            
                                            <td><label>nombre:</label></td>
                                                <td><input name="nombre" style="width:130px;height:20px;"></td>
                                                </tr>
                                                 <tr>
                                                 <td><label>codigo:</label></td>
                                                           <td><input name="codigo" style="width:130px;height:20px;"></td>
                                                           </tr> 
                                            
                                            <tr>
                                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar"></td>
                                                <td></td>
                                              
                                               
                                            </tr>
                                        </table>
                                        
                                        
                                    </fieldset>      
                                    
                                                        
				    </div></form>
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../funciones/mostrar_insumos.php?page=1"><img src="../images/a1.png"></a>
	<a href="../funciones/mostrar_insumos.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../funciones/mostrar_insumos.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../funciones/mostrar_insumos.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
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
$cod =$_POST["codigo"];



if($nom =='' && $cod ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';

$request=mysql_query('select * from insumos order by id asc '.$limit);
}

if($nom !='' || $cod !=''){
$request=mysql_query("select * from insumos where nombre_insumo LIKE '%".$nom."%' and codigo LIKE '%".$cod."%' group by id asc ".$limit);
}}
else{

$request=mysql_query('select * from insumos order by id asc '.$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';  
               $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
         
           if($modulo_rCAM=='Campañas' && $editar_rCAM=='Habilitado'){$b='<a href="../vistas/insumos.php?codigo='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($modulo_rCAM=='Campañas' && $eliminar_rCAM=='Habilitado'){$c='<a href="../vistas/mostrar_insumos.php?eliminar='.$row["id"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
            
         
          
           
           
           $table = $table.'<tr><td>'.$row["nombre_insumo"].'<font></a></td></td>
               <td>'.$row["codigo"].'</font></td>
   
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM insumos WHERE id='$Codigo'";
        mysql_query($sql);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_insumos.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
                    
		
		
		
		
		<div class="spacer"></div>
	</section>
           
</body>

</html>
