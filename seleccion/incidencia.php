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

<article class="module width_full">
			<header><h3>incidencias</h3></header>
                        
                         <?php  if($modulo_rIN=='Incidencias' && $listar_rIN=='Habilitado'){ ?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                   
                                                <fieldset>
                                        
                                        <table>
                                             <tr>
                                                <td><label>Numero:</label></td>
                                                <td><input name="numero_caso" style="width:130px;height:20px;"></td>
                                            
                                            
                                                
                                                
                                                 <td><label id="c" class="">estado:</label></td>
                                                           <td><select name="estado" style="width:130px;height:20px;" id="dA" class="">
                                                                <option value=""></option>
                                                               <option value="Nuevo">Nuevo</option>
                                                                   <option value="Asignado">Asignado</option>
                                                                   <option value="Cerrado">Cerrado</option>
                                                                   <option value="Pendiente de informacion">Pendiente de informacion</option>
                                                                   <option value="Rechazado">Rechazado</option>
                                                                   <option value="Duplicado">Duplicado</option>

                                                           </select></td>
                                                
                                            </tr>
                                            <tr>
                                                <td><label>Asunto:</label></td>
                                                <td><input name="asunto_bus" style="width:130px;height:20px;"></td>
                                                      
                                            <td><label id="b" class="">Tipo : </label></td>
                                                            <td><select name="tipo_inc" id="d" class="" style="width:130px;height:20px;">
                                                                    <option value=""></option>
                                                                   <option value="Defecto">Defecto</option>
                                                                   <option value="Caracteristica">Caracteristica</option>
                                                                  
                                                                   
                                                               </select></td></tr><tr> 
                                                          
                                                           
                                                            <td><label>Asignado a:</label></td>
                                                            <td><select name="user" style="width:130px;height:20px;">
                                                                     <option value=""></option>
                                                            <?php
                                                            include "../modelo/conexion.php";
                                                            $consulta= "select * from usuarios order by id asc";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor=$fila['usuario'];
                                                         

                                                            echo"<option value='".$valor."'>".$valor."</option>";
                                                            
                                                            }
                                                            ?>

                                                            </select></td>
                                                            <td><label id="f" class="">prioridad:</label></td>
                                                           <td><select name="prioridad" style="width:130px;height:20px;" id="g" class="">
                                                                <option value=""></option>
                                                                   <option value="Alta">Alta</option>
                                                                   <option value="Media">Media</option>
                                                                   <option value="Baja">Baja</option>

                                                           </select></td>
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
	<a href="../vistas/mostrar_incidencia.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_incidencia.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/mostrar_incidencia.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_incidencia.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
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
$num =$_POST["numero_caso"];
$nom =$_POST["asunto_bus"];
$con =$_POST["tipo_inc"];
$est =$_POST["estado"];
$pri =$_POST["prioridad"];
$use =$_POST["user"];
if($nom =='' && $con =='' && $est =='' && $use =='' && $num =='' && $pri ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery("select * from sis_incidencias order by id_incidencia asc ".$limit);
}

if($nom !='' || $est !=''|| $use !=''|| $pri !=''|| $num !=''|| $con !=''){
$nom =$_POST["asunto_bus"];
$request=Connection::runQuery("select * from sis_incidencias where tipo_inc LIKE '%".$con."%' and asunto_inc LIKE '%".$nom."%' and id_incidencia LIKE '%".$num."%' and estado_inc LIKE '%".$est."%' and asignado_inc LIKE '%".$use."%' and prioridad_inc LIKE '%".$pri."%' group by id_incidencia asc ".$limit);
}}
else{
$request=Connection::runQuery("select * from sis_incidencias order by id_incidencia asc ".$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

                  $table = $table.'<thead>';
                  $table = $table.'<tr>';
                  $table = $table.'<th>'.'Num.'.'</th>';
                  $table = $table.'<th>'.'Asunto'.'</th>';
                  $table = $table.'<th>'.'Estado'.'</th>';
                  $table = $table.'<th>'.'Tipo'.'</th>';
                  $table = $table.'<th>'.'prioridad'.'</th>';
                  
                  $table = $table.'<th>'.'Usuario'.'</th>';
                
                  $table = $table.'</tr>';
                  $table = $table.'</thead>';
              
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
           if($modulo_rIN=='Incidencias' && $ver_rIN=='Habilitado'){$ver='<a href="../seleccion/cargar.php?inc='.$row["id_incidencia"].'">';}else{$ver='';}
          
         
          
           
           
           $table = $table.'<tr><td>'.$ver.''.$row["id_incidencia"].'<font></a></td></td>
               <td>'.$ver.''.$row["asunto_inc"].'</font></td><td>'.$row["estado_inc"].'</font></td><td>'.$row["tipo_inc"].'</font></td>
                   <td>'.$row['prioridad_inc'].'</font></td><td>'.$row['asignado_inc'].'</font></td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminar_i']))
    {
        $Codigo=$_GET['eliminar_i'];
        $sql = "DELETE FROM sis_incidencias WHERE id_incidencia='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_incidencia.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
