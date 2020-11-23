<meta charset="utf-8"/>
	<title>systema Integral</title>
	
	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="../resources/style.css" />
<script language="javascript" type="text/javascript">
function pasaruser(){
    window.opener.user(document.getElementById('datos6').value);
    window.close();
}
</script>
<?php 

include "../modelo/conexion.php";
include_once '../vistas/Connection.php';
require '../modelo/consultar_permisos.php';

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
 $a=date("H:i").':00';
$request=Connection::runQuery('select count(*) from usuarios');
 
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
<body OnLoad="javascript:pasaruser();">
<article class="module width_full">
     <?php if(isset($_GET['codigo'])){
                     
                     $request=Connection::runQuery("select * from usuarios WHERE id=".$_GET['codigo']);
                     while($row=mysql_fetch_array($request))
	{     echo '<h3>Usuario Seleccionado :'.$row["nombre"].' '.$row["apellido"];
          
              $nnn = $row["usuario"];
              
           ?>
         

<input type="text" name="datos1" id="datos6" readonly value="<?php echo $nnn ?>" />



<a href="#" title="pasar valor" OnLoad="javascript:pasaruser();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }}else{ ?>
			<header><h3>Lista de usuarios</h3></header>
                        
                        
				<div class="module_content"> 
                                    <div>
                                    <h4>Busqueda de usuarios</h4>
                                    <fieldset>
                                        <form name="buscar" action="" method="post" enctype="multipart/form-data">
                                        <table>
                                            <tr>
                                                <td><label>Nombre :</label></td>
                                                <td><input name="bus_nombre"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Apellido :</label></td>
                                                <td><input name="bus_apellido"></td>
                                            </tr>
                                            <tr>
                                                <td><label>Identificador :</label></td>
                                                <td><input name="bus_identificador"></td>
                                            </tr>
                                            <tr>
                                                            <td><label>Cedula :</label></td>
                                                            <td><input name="est"></td>
                                                          </tr>
                                            <tr>
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
	<a href="../seleccion/usuario.php?page=1"><img src="../images/a1.png"></a>
	<a href="../seleccion/usuario.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../seleccion/usuario.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../seleccion/usuario.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
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
      $iden =$_POST["bus_identificador"];
      $color =$_POST["est"];
//$consulta= "select * from sis_contacto WHERE `nombre_cont`='".$_POST["bus_nombre"]."'";
$request=Connection::runQuery("select * from usuarios WHERE nombre LIKE '%".$nom."%' and apellido LIKE '%".$ape."%' and usuario LIKE '%".$iden."%' and cedula LIKE '%".$color."%' order by id asc ".$limit."");
if($request){
//    echo'<hr>';
    $table = '<table class="lista">';


               $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              $table = $table.'<th>'.'Cedula'.'</th>';
              $table = $table.'<th>'.'Identificador'.'</th>';
              $table = $table.'<th>'.'Cargo'.'</th>';
              $table = $table.'<th>'.'Email'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
             $table = $table.'<th>'.'Celular'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';


	
        
	//Por cada resultado pintamos una linea
//        require '../modelo/consulta_empresa.php';
	while($row=mysql_fetch_array($request))
	{       
         $table = $table.'<tr><td><a href="../seleccion/usuario.php?codigo='.$row["id"].'">'.$row["nombre"].' '.$row["apellido"].'</a></td>
                    <td>'.$row['cedula'].'</td><td>'.$row['usuario'].'</td>
                        <td>'.$row["cargo"].'</td>
                            <td>'.$row['email'].'</td><td>'.$row['telefono'].'</td>
                                <td>'.$row['celular'].'</td>
                                    <td><a href="../form_editar/formulario_editar_usuarios.php?codigo='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}
}else {
    

$request=Connection::runQuery('select * from usuarios order by id asc '.$limit);
if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

               $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
               $table = $table.'<th>'.'Cedula'.'</th>';
              $table = $table.'<th>'.'Identificador'.'</th>';
              $table = $table.'<th>'.'Cargo'.'</th>';
              $table = $table.'<th>'.'Email'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
             
              $table = $table.'<th>'.'Celular'.'</th>';
              
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
		$table = $table.'<tr><td><a href="../seleccion/usuario.php?codigo='.$row["id"].'">'.$row["nombre"].' '.$row["apellido"].'</a></td>
                   <td>'.$row['cedula'].'</td><td>'.$row['usuario'].'</td>
                        <td>'.$row["cargo"].'</td>
                            <td>'.$row['email'].'</td><td>'.$row['telefono'].'</td>
                                <td>'.$row['celular'].'</td>
                                    </tr>';
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
        
}}
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article><?php } ?>
</body>