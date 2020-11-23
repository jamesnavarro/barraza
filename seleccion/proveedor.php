<?php 
session_start();
include "../modelo/conexion.php";
include_once '../vistas/Connection.php';
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$request=Connection::runQuery('select count(*) from proveedores');
 
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
$_SESSION['formu'] = $_POST;
?>
<!DOCTYPE html>
<html>
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
    window.opener.datos2(document.getElementById('datos3').value, document.getElementById('datos4').value);
    window.close();
}
</script>
      
    </head>
    <body OnLoad="javascript:pasar();">
        
        <article class="module width_full">
			<header><h3>Proveedores</h3></header>
                        
                 <?php if(isset($_GET['cod'])){
                     
                     $request=Connection::runQuery("select * from proveedores WHERE id_pro=".$_GET['cod']);
                     while($row=mysql_fetch_array($request))
	{     echo '<h3>nombre seleccionado :'.$row["nombre_p"].'';
          
              $nnn = $row["nombre_p"];
              $ii = $row["id_pro"];
           ?>
         

<input type="text" name="datos3" id="datos3" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos4" id="datos4" readonly value="<?php echo $ii ?>" />


<a self.location.href="javascript:pasar();" title="pasar valor" OnLoad="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }}else{ ?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                        
                                  </div> 
                                               <fieldset style="width:100%; float:center; margin-right: 3%;"> 
                                            <fieldset style="width:48%; float:left; margin-right: 3%;">
                                        
                                        
                                                <div><label>nombre de proveedor:</label>
                                                <input name="nombre" style="width:130px;" value=""></div><br>
                                                
                                                
                                               
                                           
                                                          
                                            <input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar">
                                            
                                        
                                        
                                    </fieldset>
                                            
                                    
                                    
    </form>                                                    
</div> </fieldset><br><hr>  <font color="red">Búsqueda Digitada:</font><?php if(isset($_POST["nombre"])){if($_POST["nombre"]!=''){echo '<b> ,nombre:</b><font color="green">'.$_POST["nombre"].'</font>';}}





?><hr><br>
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../seleccion/proveedor.php?page=1"><img src="../images/a1.png"></a>
	<a href="../seleccion/proveedor.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/seleccion/proveedor.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../seleccion/proveedor.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
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

if($nom ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery('select * from proveedores order by nombre_p asc '.$limit);
}
if($nom !=''){
    $request=Connection::runQuery("select * from proveedores WHERE nombre_p LIKE '%".$nom."%' order by id_pro asc ".$limit."");

}
}
else{
$request=Connection::runQuery('select * from proveedores order by nombre_p asc '.$limit);
}

if($request){
   

    
    $table = '<table class="lista">';

 $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre del proveedor'.'</th>';
        
              $table = $table.'<th>'.'Telefono'.'</th>';
              $table = $table.'<th>'.'Contacto'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
           
           $ver='<a href="../seleccion/proveedor.php?cod='.$row["id_pro"].'">';
     
           $table = $table.'<tr><td>'.$ver.''.$row["nombre_p"].'
               </td><td>'.$row["telefono_p"].'</font></td><td>'.$row["contacto"].'</font></td>
                       </tr>';
         
         
	}
        $table = $table.'</table>';
       
            echo $table;
        
        
        

}


                 }
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
    </body>
</html>
