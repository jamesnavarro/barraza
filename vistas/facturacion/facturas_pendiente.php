<?php 
session_start();
include "../modelo/conexion.php";
include_once 'Connection.php';
require '../modelo/consultar_permisos.php';
$request=Connection::runQuery('select count(*) from facturas where pago_pendiente="Si"');
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
	<title>Sistema Integral</title>

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
<script type="text/javascript">
           
            function mostrarbusqueda() {
                var select = document.getElementById('d');
                select.className = 'show';
                var select = document.getElementById('dA');
                select.className = 'show';
                 var select = document.getElementById('b');
                select.className = 'show';
                 var select = document.getElementById('c');
                select.className = 'show';
                var select = document.getElementById('f');
                select.className = 'show';
                var select = document.getElementById('g');
                select.className = 'show';
            }
            function ocultarbusqueda() {
                var select = document.getElementById('d');
                select.className = 'hide';
                var select = document.getElementById('dA');
                select.className = 'hide';
                var select = document.getElementById('b');
                select.className = 'hide';
                 var select = document.getElementById('c');
                select.className = 'hide';
                var select = document.getElementById('f');
                select.className = 'hide';
                var select = document.getElementById('g');
                select.className = 'hide';
            }
           
        </script>
<script type="text/javascript"> function recargar() { window.location.reload() } </script>
</head>


<?php $das = $_SESSION['t']; ?>
<body onload="<?php $das = $_SESSION['t'];if(!empty($das['options'])) echo $das['options']; ?>">
   <?php  include '../vistas/menu.php'; ?>
	
	<section id="main" class="column">

		<div class="clear"></div>
                
		<article class="module width_full">
			<header><h3>lista de facturas pendientes por pagar</h3></header>
                        
                         <?php  if($modulo_rCAM=='Campañas' && $listar_rCAM=='Habilitado'){?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                  
                                                <fieldset>
                                        
                                        <table>
                                             <tr>
                                               
                                            
                                            <td><label># Factura:</label><input name="factura" style="width:130px;height:20px;"></td>
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
	<a href="../vistas/facturas_pendiente.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/facturas_pendiente.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/facturas_pendiente.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/facturas_pendiente.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["factura"]) || isset($_POST["orden_int"]) || isset($_POST["orden_ext"]) || isset($_POST["documento"])){
$nom =$_POST["factura"];

if($nom ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>'; 

$request=Connection::runQuery('select a.*, b.*, c.* from facturas a, pacientes b, ordenes c where a.pago_pendiente="Si" and a.id_paciente=b.id_paciente and a.orden_int=c.id '.$limit);
}

if($nom !=''){
$request=Connection::runQuery('select a.*, b.*, c.* from facturas a, pacientes b, ordenes c where a.numero_factura like "'.$nom.'" and a.pago_pendiente="Si" and a.id_paciente=b.id_paciente and a.orden_int=c.id '.$limit);
}}
else{

$request=Connection::runQuery('select a.*, b.*, c.* from facturas a, pacientes b, ordenes c where a.pago_pendiente="Si" and a.id_paciente=b.id_paciente and a.orden_int=c.id '.$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'# Factura'.'</th>';
              $table = $table.'<th>'.'# Archivo.'.'</th>';
              $table = $table.'<th>'.'Facturado'.'</th>';
              $table = $table.'<th>'.'Paciente'.'</th>';
              $table = $table.'<th>'.'Pago Pendiente?'.'</th>';
              $table = $table.'<th>'.'Total'.'</th>';
              $table = $table.'<th>'.'Fecha de Registro'.'</th>';
              $table = $table.'<th>'.'Imprimir'.'</th>';  
             
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
            if($row["cod_alquiler"]==''){$ver2='<a href="../vistas/facturacion_finalizada.php?fact='.$row["numero_factura"].'">';}else{$ver2='<a href="../vistas/facturacion_2.php?fact='.$row["cod_alquiler"].'">';}
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../vistas/contacto_potencial.php?codigo='.$row["id_paciente"].'">';}else{$ver='';}
           if($modulo_rCAM=='Campañas' && $editar_rCAM=='Habilitado'){$b='<a href="../vistas/reg_orden.php?codigo='.$row["id"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           $c='<a target="_blank" href="../php-mysql.php?imprimir='.$row["numero_factura"].'"><img src="../imagenes/imp.png" alt="ver" height="20px" width="20px"></a>';
         
          
           
           
           $table = $table.'<tr><td>'.$ver2.''.$row["numero_factura"].'<font></a></td><td>'.$ver2.''.$row["orden_int"].'<font></a></td><td>'.$row["facturado"].'<font></a></td>
               <td>'.$ver.''.$row["nombres"].' '.$row["apellidos"].'</font></td></td><td>'.$row["pago_pendiente"].'<font></a></td><td>'.$row["total"].'<font></a></td>
               <td>'.$row["fecha_registro"].'<font></a></td>
                    
                           <td>'.$c.'</td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM facturas WHERE id_facturas='$Codigo'";
        mysql_query($sql);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/facturas_pagas.php"</script>'; 
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
             <?php include '../footer.php'; ?>

</body>

</html>
