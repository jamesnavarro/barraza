<?php 
session_start(); ?>
<?php include "../modelo/conexion.php";
$consul= "select * from sis_empresa where rips LIKE '%".$_SESSION['ide']."%'";                     
$resul=  mysql_query($consul);
while($fil=  mysql_fetch_array($resul)){
$no=$fil['nombre_emp'];
$id=$fil['id_empresa'];
}?>
<html><head><meta charset="utf-8"/>
	<title>systema Integral</title>
	
	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="../resources/style.css" />
       <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="../resources/style.css" />
        <script> 
var ventana_secundaria 

function abrirVentana(){  
ventana_secundaria = window.open("../vistas/contacto.php","miventana","width=500,height=410,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 

function cerrar() {window.close();}
	
	 
   
</script>
<script language="javascript" type="text/javascript">
function pasar(){
    window.opener.datos2(document.getElementById('datos3').value, document.getElementById('datos4').value, document.getElementById('datos5').value);
    window.close();
}
</script>
</head>
<body  onload="javascript:pasar();">
<?php 

include "../modelo/conexion.php";

require '../modelo/consultar_permisos.php';

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
 $a=date("H:i").':00';
$request=  mysql_query('SELECT a.count(*), b.* FROM alquiler a, precios_alquiler b WHERE b.id_empresa="'.$id.'" and a.id=b.id_alquiler group by a.id');
 
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
}$_SESSION['foi'] = $_POST;
?>

<article class="module width_full">
     <?php if(isset($_GET['codigo'])){
                     
                     $request=  mysql_query('SELECT a.*, b.* FROM alquiler a, precios_alquiler b WHERE b.id_empresa="'.$id.'" and a.id=b.id_alquiler and a.id="'.$_GET['codigo'].' group by a.id"');
                     while($row=mysql_fetch_array($request))
	{     echo '<h3>Equipo Seleccionado :'.$row["nombre"];
          
              $x = $row["codigo"];
              $y = $row["nombre"];
              $z = $row["precio_alquiler"];
              
           ?>
         

<input type="text" name="datos1" id="datos3" readonly value="<?php echo $y ?>" />
<input type="text" name="datos2" id="datos4" readonly value="<?php echo $x ?>" />
<input type="text" name="datos3" id="datos5" readonly value="<?php echo $z ?>" />



<a href="" title="pasar valor" onload="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
	<?php }}else{ ?>
			<header><h3>Lista de atenciones</h3></header>
                        
                        
				<div class="module_content"> 
                                    <div>
                                    <h4>Busqueda de atencion</h4>
                                    <fieldset>
                                        <form name="buscar" action="" method="post" enctype="multipart/form-data">
                                        <table>
                                            <tr>
                                                <td><label>Nombre de atencion :</label></td>
                                                <td><input name="bus_nombre"></td>
                                            </tr>
                                            <tr>
                                                <td><label>codigo de atencion:</label></td>
                                                <td><input name="bus_apellido"></td>
                                            </tr>
                                           
                                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar"></td>
                                            </tr>
                                        </table>
                                        </form>
                                        
                                    </fieldset>      
                                                
                                    
                                                        
				    </div>
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../seleccion/equipos.php?page=1"><img src="../images/a1.png"></a>
	<a href="../seleccion/equipos.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../seleccion/equipos.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../seleccion/equipos.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if (isset($_POST["bus_nombre"])) {
      $nom =$_POST["bus_nombre"];
      $ape =$_POST["bus_apellido"];
   
//$consulta= "select * from sis_contacto WHERE `nombre_cont`='".$_POST["bus_nombre"]."'";
$request=Connection::runQuery("SELECT a.*, b.* FROM alquiler a, precios_alquiler b WHERE b.id_empresa='".$id."' and a.id=b.id_alquiler and a.nombre LIKE '%".$nom."%' and a.codigo LIKE '%".$ape."%' order by a.id asc ".$limit."");
if($request){
//    echo'<hr>';
    $table = '<table class="lista">';


               $table = $table.'<thead>';
              $table = $table.'<tr>';
            $table = $table.'<th>'.'Nombre de atencion'.'</th>';
            $table = $table.'<th>'.'Tipo'.'</th>';
               $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'Precio x Empresa'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';


	
        
	//Por cada resultado pintamos una linea
//        require '../modelo/consulta_empresa.php';
	while($row=mysql_fetch_array($request))
	{       
      $table = $table.'<tr><td><a href="../seleccion/equipos.php?codigo='.$row["id"].'">'.$row["nombre"].'</a></td> <td>'.$row['tipo'].'</td>
                   <td>'.$row['codigo'].'</td>
                       <td>$'.$row['precio_alquiler'].'</td>
                                    </tr>';
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
}else {
    

$request=  mysql_query('SELECT a.*, b.* FROM alquiler a, precios_alquiler b WHERE b.id_empresa="'.$id.'" and a.id=b.id_alquiler group by a.id');
echo $_SESSION['ide'];
if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

               $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre de atencion'.'</th>';
              $table = $table.'<th>'.'Tipo'.'</th>';
               $table = $table.'<th>'.'Codigo'.'</th>';
               $table = $table.'<th>'.'Precio x Empresa'.'</th>';


              
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
		$table = $table.'<tr><td><a href="../seleccion/equipos.php?codigo='.$row["id"].'">'.$row["nombre"].'</a></td><td>'.$row['tipo'].'</td>
                   <td>'.$row['codigo'].'</td>
                                    <td>$ '.$row['precio_alquiler'].'</td></tr>';
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}}
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article><?php } ?>
</body></html>