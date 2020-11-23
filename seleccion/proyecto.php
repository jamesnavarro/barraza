<?php 

include "../modelo/conexion.php";
include_once 'Connection.php';
require '../modelo/consultar_permisos.php';

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$request=Connection::runQuery('select count(*) from sis_incidencias');
 
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
<article class="module width_full">
			<header><h3>proyectos</h3></header>
                        
                         <?php  if($modulo_rPR=='Proyectos' && $listar_rPR=='Habilitado'){?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                        
                                                <fieldset>
                                        
                                        <table>
                                             <tr>
                                               
                                            
                                            <td><label>nombre:</label></td>
                                                <td><input name="asunto_bus" style="width:130px;height:20px;"></td>
                                                
                                                
                                                 <td><label id="c" class="">estado:</label></td>
                                                           <td><select name="estado" style="width:130px;height:20px;" id="dA" class="">
                                                                <option value=""></option>
                                                               <option value="Borrador">Borrador</option>
                                                                   <option value="En Revicion">En Revisión</option>
                                                                   <option value="Publicado">Publicado</option>

                                                           </select></td>
                                                           
                                                
                                            </tr>
                                            <tr>
                                                <td><label>Fecha Inicio : </label></td>
                                                            <td><input type="text" name="fecha_inicio" class="tcal" style="width:70px;height:20px;" ></td>
                                                          
                                                        
                                            <td><label id="b" class="">prioridad : </label></td>
                                                            <td><select name="prioridad" id="d" class="" style="width:130px;height:20px;">
                                                                    <option value=""></option>
                                                                   <option value="Alta">Alta</option>
                                                                   <option value="Media">Media</option>
                                                                   <option value="Baja">Baja</option>
                                                                  
                                                                   
                                                               </select></td></tr><tr> 
                                                          
                                                             <td><label>Fecha Fin :</label></td>
                                                            <td><input type="text" name="fecha_fin" class="tcal" style="width:70px;height:20px;" ></td>
                                                        
                                                          </tr>
                                            
                                            <tr>
                                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar"></td>
                                                <td></td>
                                                <td></td>
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
	<a href="../vistas/mostrar_proyectos.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_proyectos.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/mostrar_proyectos.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_proyectos.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["asunto_bus"])){

$nom =$_POST["asunto_bus"];
$tip =$_POST["estado"];
$emp =$_POST["fecha_inicio"];
$eta =$_POST["fecha_fin"];
$use =$_POST["prioridad"];
if($nom =='' && $tip =='' && $use =='' && $emp =='' && $eta ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery("select * from sis_proyecto order by id_proyecto asc ".$limit);
}

if($nom !='' || $eta !=''|| $use !=''|| $tip !=''|| $emp !=''){
$request=Connection::runQuery("select * from sis_proyecto WHERE nombre_pro LIKE '%".$nom."%' and fecha_inicial LIKE '%".$emp."%' and fecha_final LIKE '%".$eta."%' and estado_pro LIKE '%".$tip."%' and prioridad_pro LIKE '%".$use."%'");

}}
else{
$request=Connection::runQuery("select * from sis_proyecto order by id_proyecto asc ".$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              $table = $table.'<th>'.'Fecha Inicio'.'</th>';
              $table = $table.'<th>'.'Fecha Fin'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
           
              $table = $table.'</tr>';
              $table = $table.'</thead>';

 

	while($row=mysql_fetch_array($request))
	{     
           if($modulo_rPR=='Proyectos' && $ver_rPR=='Habilitado'){$ver='<a href="../seleccion/cargar.php?pro='.$row["id_proyecto"].'">';}else{$ver='';}
           
          
           
           
           $table = $table.'<tr><td>'.$ver.''.$row["nombre_pro"].'<font></a></td></td>
               <td>'.$row["fecha_inicial"].'</font></td><td>'.$row["fecha_final"].'</font></td>
                   <td>'.$row['estado_pro'].'</font></td><td>'.$row['usuario'].'</font></td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminar_pr']))
    {
        $Codigo=$_GET['eliminar_pr'];
        $sql = "DELETE FROM sis_proyecto WHERE id_proyecto='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_proyecto.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
