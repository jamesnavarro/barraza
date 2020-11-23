<?php 
session_start();
include "../modelo/conexion.php";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

$request=mysql_Query('select count(*) from enfermedades');
 
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
}
$_SESSION['formu'] = $_POST;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
	<title>Sistema Integral</title>
        <link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
        <link href="../vistas/doc.ico" type="image/x-icon" rel="shortcut icon" />
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="../js/ajax.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
        <link rel="stylesheet" type="text/css" href="../resources/style.css" />
        <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <script>
        $(document).ready(function(){
	 $('#tabla').dataTable();
        });
        </script>
        <script language="javascript" type="text/javascript">
        function pasar_enfermedad(){
        window.opener.enfermedad_add(document.getElementById('datos1').value, document.getElementById('datos2').value);
        window.close();
        }
        </script>
        <style>
.CSSTableGenerator {
	margin:0px;padding:0px;
	width:100%;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:11px;
	-webkit-border-bottom-left-radius:11px;
	border-bottom-left-radius:11px;
	
	-moz-border-radius-bottomright:11px;
	-webkit-border-bottom-right-radius:11px;
	border-bottom-right-radius:11px;
	
	-moz-border-radius-topright:11px;
	-webkit-border-top-right-radius:11px;
	border-top-right-radius:11px;
	
	-moz-border-radius-topleft:11px;
	-webkit-border-top-left-radius:11px;
	border-top-left-radius:11px;
}.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.CSSTableGenerator tr:last-child td:last-child {
	-moz-border-radius-bottomright:11px;
	-webkit-border-bottom-right-radius:11px;
	border-bottom-right-radius:11px;
}
.CSSTableGenerator table tr:first-child td:first-child {
	-moz-border-radius-topleft:11px;
	-webkit-border-top-left-radius:11px;
	border-top-left-radius:11px;
}
.CSSTableGenerator table tr:first-child td:last-child {
	-moz-border-radius-topright:11px;
	-webkit-border-top-right-radius:11px;
	border-top-right-radius:11px;
}.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:11px;
	-webkit-border-bottom-left-radius:11px;
	border-bottom-left-radius:11px;
}.CSSTableGenerator tr:hover td{
	
}
.CSSTableGenerator tr:nth-child(odd){ background-color:#aad4ff; }
.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }.CSSTableGenerator td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:center;
	padding:4px;
	font-size:10px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
		background:-o-linear-gradient(bottom, #005fbf 5%, #005fbf 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #005fbf) );
	background:-moz-linear-gradient( center top, #005fbf 5%, #005fbf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#005fbf");	background: -o-linear-gradient(top,#005fbf,005fbf);

	background-color:#005fbf;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:12px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.CSSTableGenerator tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #005fbf 5%, #005fbf 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #005fbf) );
	background:-moz-linear-gradient( center top, #005fbf 5%, #005fbf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#005fbf");	background: -o-linear-gradient(top,#005fbf,005fbf);

	background-color:#005fbf;
}
.CSSTableGenerator tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
        </style>
    </head>
    <body  onload="javascript:pasar_enfermedad();">
        <article class="module width_full">
            <header><h3>CIE 10</h3></header>
               <?php if(isset($_GET['cod'])){
                $request=mysql_Query("select * from enfermedades WHERE codigo_enf like '%".$_GET['cod']."%'");
                while($row=mysql_fetch_array($request)){
                echo '<h3>Medicamento seleccionado :'.$row["descripcion"].'';
                $nnn = $row["descripcion"];
                $ii = $row["codigo_enf"];
                ?>
                <input type="text" name="datos1" id="datos1" readonly value="<?php echo $nnn ?>" />
                <input type="text" name="datos2" id="datos2" readonly value="<?php echo $ii ?>" />
                <input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>
                <?php }}else{ ?>
		<div class="module_content">
                <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                  
                        <table class="CSSTableGenerator" >
                            <tr>
                                <td><label>Descripcion:</label></label><td><input name="nombre" style="width:130px;" value=""></td>                       
                            </tr>
                            <tr>
                                <td><label>Codigo:</label><td><input name="codigo" style="width:130px;" value=""></td>                     

                            </tr>
                            <tr>
                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn"> <td><input type="reset" value="Limpiar">
                                <input type="button" name="cerrar" value="Cerrar"  onclick="window.close();"></td>                       
                            </tr>
                        </table>
                           
                </form>                                                    
            </div> 
            <hr>  
                <font color="red">Búsqueda Digitada:</font><?php if(isset($_POST["nombre"])){if($_POST["nombre"]!=''){echo '<b> Descrippcion:</b><font color="green">'.$_POST["nombre"].'</font>';}} if(isset($_POST["codigo"])){if($_POST["codigo"]!=''){echo '<b> Codigo:</b><font color="green">'.$_POST["codigo"].'</font>';}} ?>
            <hr>
           
               <table >
                    <tr>
                        <td>
                            <?php
                            if($page>1){?>
                            <a href="../vistas/agregar_enfermedad.php?page=1"><img src="../images/a1.png"></a>
                            <a href="../vistas/agregar_enfermedad.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
                            <?php
                            }else{
                            ?><img src="../images/ant.png"><?php
                            }
                            ?>
                            (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                            <?php
                            if($page<$last_page){?>
                            <a href="../vistas/agregar_enfermedad.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
                            <a href="../vistas/agregar_enfermedad.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
                            <?php
                            }else{
                            ?><img src="../images/nex.png"> <?php
                            }
                            ?>
                            <?php
                            $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                            if(isset($_POST["nombre"])){
                            $nom =$_POST["nombre"];
                            $ape =$_POST["codigo"];
                            if($nom =='' && $ape ==''){
                            echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
                            $request=mysql_Query('select * from enfermedades order by codigo_enf asc '.$limit);
                            }
                            if($nom !='' || $ape !=''){
                            $request=mysql_Query("select * from enfermedades WHERE descripcion LIKE '%".$nom."%' and codigo_enf LIKE '%".$ape."%' order by id_enfermedad");
                            $paginas=mysql_Query("select count(*) from enfermedades WHERE descripcion LIKE '%".$nom."%' and codigo_enf LIKE '%".$ape."%' order by id_enfermedad");
                            $_SESSION['page'] = $paginas;
                            }
                            }
                            else{
                            $request=mysql_Query('select * from enfermedades order by codigo_enf asc '.$limit);
                            }
                            if($request){
                            $table = '<table class="CSSTableGenerator">';
                            $table = $table.'<tr class=”modo1″>';
                            $table = $table.'<td>'.'Codigo'.'</td>';
                            $table = $table.'<td>'.'Descripcion'.'</td>';
                            $table = $table.'<td>'.'Sexo'.'</td>';
                            $table = $table.'<td>'.'Lim. inferior'.'</td>';
                            $table = $table.'<td>'.'Lim. Superior'.'</td>';
                            $table = $table.'</tr>';
                            while($row=mysql_fetch_array($request))
                            {     
                            $ver='<a href="../vistas/agregar_enfermedad.php?cod='.$row["codigo_enf"].'">';
                            $table = $table.'<tr><td>'.$ver.''.$row["codigo_enf"].'</a></td><td>'.$row["descripcion"].'</td>
                            <td>'.$row["sexo"].'</td><td>'.$row["lim_inf"].'</td><td>'.$row["lim_sup"].'</td>
                            </tr>';
                            }
                            $table = $table.'</table>';
                            echo $table;
                            }}
                            ?>
                        </td>
                    </tr> 
                </table> 
             
         </article>
    </body>
</html>
