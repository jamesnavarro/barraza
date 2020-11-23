<?php 
session_start();
include "../modelo/conexion.php";
include_once 'Connection.php';
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if(isset($_GET['codigo'])){$_SESSION['orde']=$_GET['codigo'];}

$request=Connection::runQuery('SELECT count(*) FROM facturas a, pacientes b, sis_empresa c where a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa="'.$_GET['codigo'].'"');
 
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 15;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
$_SESSION['formur'] = $_POST;

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
        
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    
    <script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1").change(function () {
   		$("#combo1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/combo1.php", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				$("#combo3").html("");
			});			
        });
   })
	// Parametros para el combo2
	$("#combo2").change(function () {
   		$("#combo2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("combo2.php", { elegido: elegido }, function(data){
				$("#combo3").html(data);
			});			
        });
   })
});
</script>
<style type="text/css">
            .show { display: block;  }
            .hide { display: none; }
     </style>
<script type="text/javascript">
           
            function mostrarbusqueda() {
                var select = document.getElementById('d');
                select.className = 'show';
            }
            function ocultarbusqueda() {
                var select = document.getElementById('d');
                select.className = 'hide';
            }
            function mostrarbusquedaA() {
                var select = document.getElementById('dA');
                select.className = 'show';
            }
            function ocultarbusquedaA() {
                var select = document.getElementById('dA');
                select.className = 'hide';
            }
            function mostrarlabelA() {
                var select = document.getElementById('b');
                select.className = 'show';
            }
            function ocultarlabelA() {
                var select = document.getElementById('b');
                select.className = 'hide';
            }
            function mostrarlabel() {
                var select = document.getElementById('c');
                select.className = 'show';
            }
            function ocultarlabel() {
                var select = document.getElementById('c');
                select.className = 'hide';
            }
        </script>
        <script language='javascript'>
function contacto()
{
catPaises = window.open('../vistas/form_contacto.php', 'contacto', 'width=500,height=600');
}
function seleccionar()
{
catPaises = window.open('../vistas/seleccionar.php', 'contacto', 'width=1000,height=600');
}
function usuario()
{
catPaises = window.open('../seleccion/usuario.php', 'contacto', 'width=1000,height=600');
}
</script>
<script language="javascript" type="text/javascript">
function datos(val1, val2){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
}
function user(val6){
    document.getElementById('valor6').value = val6;
    
}
function datos2(val3, val4, val5){
    
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
    document.getElementById('valor5').value = val5;
   
}
</script>
</head>


<?php 

$data = $_SESSION['formur']; ?>
<body onload="<?php $data = $_SESSION['formur'];if(!empty($data['options'])) echo $data['options']; ?>">
  <?php  include '../vistas/menu.php'; ?>
	<section id="main" class="column">

		<div class="clear"></div>
                
		
                    <article class="module width_full">
			<header><h3>Descargar archivos de la empresa :<font color="blue"><?php 
                        include "../modelo/conexion.php";
                        $consulta1= "select * from sis_empresa WHERE  id_empresa='".$_GET["codigo"]."'";
$result=  mysql_query($consulta1);
while($fila=  mysql_fetch_array($result)){
$id_e=$fila['nombre_emp'];}
                        echo $id_e ?></font></h3></header>
                        
                         <?php if($modulo_rE=='Empresa' && $listar_rE=='Habilitado'){ ?>
				<div class="module_content">
                             
                                   
                                    <fieldset style="width:100%; float:center; margin-right: 3%;"> 
                                     <fieldset style="width:48%; float:left; margin-right: 3%;">
                                        
                                         <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                  
                                                <fieldset>
                                        
                                        <table>
                                             <tr>
                                               
                                            
                                            <td><label># Factura del mes:</label><select name="factura" style="width:100px;height:20px;">
                                                    <option value="<?php if(isset($_POST["factura"])){echo $_POST["factura"];}else{echo date("Y-%"); } ?>"><?php if(isset($_POST["factura"])){if($_POST["factura"]== date("Y-01")){echo 'Enero';}
                                                    if($_POST["factura"]== date("Y-02")){echo 'Febrero';}
                                                    if($_POST["factura"]== date("Y-03")){echo 'Marzo';}
                                                    if($_POST["factura"]== date("Y-04")){echo 'Abril';}
                                                    if($_POST["factura"]== date("Y-05")){echo 'Mayo';}
                                                    if($_POST["factura"]== date("Y-06")){echo 'Junio';}
                                                    if($_POST["factura"]== date("Y-07")){echo 'Julio';}
                                                    if($_POST["factura"]== date("Y-08")){echo 'Agosto';}
                                                    if($_POST["factura"]== date("Y-09")){echo 'Septiembre';}
                                                    if($_POST["factura"]== date("Y-10")){echo 'Octubre';}
                                                    if($_POST["factura"]== date("Y-11")){echo 'Noviembre';}
                                                    if($_POST["factura"]== date("Y-12")){echo 'Diciembre';}
                                                    }else{ echo 'Todas';} ?></option>
                                                                   
                                                                   <option value="<?php echo date("Y-01") ?>">Enero</option>
                                                                   <option value="<?php echo date("Y-02") ?>">Febrero</option>
                                                                   <option value="<?php echo date("Y-03") ?>">Marzo</option>
                                                                   <option value="<?php echo date("Y-04") ?>">Abril</option>
                                                                   <option value="<?php echo date("Y-05") ?>">Mayo</option>
                                                                   <option value="<?php echo date("Y-06") ?>">Junio</option>
                                                                   <option value="<?php echo date("Y-07") ?>">Julio</option>
                                                                   <option value="<?php echo date("Y-08") ?>">Agosto</option>
                                                                   <option value="<?php echo date("Y-09") ?>">Septiembre</option>
                                                                   <option value="<?php echo date("Y-10") ?>">Octubre</option>
                                                                   <option value="<?php echo date("Y-11") ?>">Noviembre</option>
                                                                   <option value="<?php echo date("Y-12") ?>">Diciembre</option>
                                                                   <option value="<?php echo date("Y-%") ?>">Todas</option>
                                                                   
                                                               </select></td>
                                                </tr>
                                              
                                            
                                            <tr>
                                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar"></td>
                                                
                                              
                                               
                                            </tr>
                                        </table>
                                        
                                        
                                    </fieldset>      
                                    
                                                        
				    </div></form>
                                        
                                        
                                    </fieldset>
                                            
                                  
                                                        
				     <br><br></fieldset><br>
                                     
                                    <fieldset style="width:100%; float:center; margin-right: 3%;">
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../vistas/facturas_por_empresa.php?codigo=<?php echo $_GET['codigo'] ?>&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/facturas_por_empresa.php?codigo=<?php echo $_GET['codigo'] ?>&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/facturas_por_empresa.php?codigo=<?php echo $_GET['codigo'] ?>&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/facturas_por_empresa.php?codigo=<?php echo $_GET['codigo'] ?>&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["factura"])){
$fact1 =$_POST["factura"];



if($fact1 ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery("SELECT a.*,(a.fecha_registro) as t, b.*, c.* FROM facturas a, pacientes b, sis_empresa c where  a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='".$_GET['codigo']."'  ".$limit);
}

if($fact1 !=''){

$request=Connection::runQuery("select a.*,(a.fecha_registro) as t, b.*, c.* from facturas a, pacientes b, sis_empresa c WHERE a.fecha_registro like '".$fact1."%' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='".$_GET['codigo']."' ");
$request2=Connection::runQuery('select a.*,(a.fecha_registro) as t, b.*, c.*, count(a.numero_factura) from facturas a, pacientes b, sis_empresa c where a.fecha_registro like "'.$fact1.'%" and a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='.$_GET['codigo'].'');

while($row=mysql_fetch_array($request2))
	{ 
    $idus=$row['count(a.numero_factura)'];
}

}
}
else{
$request=Connection::runQuery("SELECT a.*,(a.fecha_registro) as t, b.*, c.* FROM facturas a, pacientes b, sis_empresa c where a.id_paciente=b.id_paciente and b.id_empresa=c.rips and c.id_empresa='".$_GET['codigo']."'  ".$limit);

}

if($request){
 ?>
        <form name="buscarA" action="../vistas/imprimir_archivos.php?codigo=<?php echo $_GET["codigo"] ?>" method="post" enctype="multipart/form-data">
           
             <input type="submit" name="buscar" value="Descargar" class="alt_btn">
                
                
             
        <?php
         if(isset($idus)){
            echo '<label> Total de Facturas : </label><input type="text" name="cant"  style="width:20px;height:20px;"  value="'.$idus.'">';
        }else{
            echo '<label> Total de Facturas : </label><input type="text" name="cant"  style="width:20px;height:20px;"  value="'.$num_items.'">';
        }
    $table = '<table class="lista">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
               $table = $table.'<th>'.'Factura.'.'</th>';
              $table = $table.'<th>'.'Orden Int.'.'</th>';
              $table = $table.'<th>'.'Paciente'.'</th>';
               $table = $table.'<th>'.'Total'.'</th>';
              $table = $table.'<th>'.'Fecha'.'</th>';
              $table = $table.'<th>'.'Descargar'.'</th>';
      

              $table = $table.'</tr>';
              $table = $table.'</thead>';
 
     $cont='';
	while($row=mysql_fetch_array($request))
	{     
       $cont = $cont + 1;
       if($row["cod_alquiler"]!=''){
           $ver='<a href="../vistas/facturacion_2.php?fact='.$row["numero_factura"].'">';
       }else{
           $ver='<a href="../vistas/facturacion_finalizada.php?fact='.$row["numero_factura"].'">';
       }
               
           
          
           
           
           $table = $table.'<tr><td>'.$ver.''.$row['numero_factura'].'</font></td><td>'.$ver.''.$row["orden_int"].'<font></a></td><td>'.$row["nombres"].' '.$row["apellidos"].'<font></a></td>
               <td>'.$row["total"].'<font></a></td><td>'.$row["t"].'</font></td><td><a href="../vistas/imprimir_archivos.php?codigo='.$_GET["codigo"].'&factura='.$row["numero_factura"].'">Descargar</a></td>';
	}
        $table = $table.'</table>';
        echo $table;
        
        
       
}
?>
            </form>
            <?php
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM sis_empresa WHERE id_empresa='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro de la Empresa Eliminada");location.href="../vistas/mostrar_empresas.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
   if(isset($_GET['cod']))
    {
    if(isset($_POST["cant"]))
    {
   $n = $_POST["cant"];
   for($x=1; $x<=$n; $x=$x+1){ 
       
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.open('../php-mysql.php?imprimir=".$_POST["valor$x"]."')";
        echo "</script>";        
   }
}}                      
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
