<?php 

include "../modelo/conexion.php";
include_once 'Connection.php';
require '../modelo/consultar_permisos.php';

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
 $a=date("H:i").':00';
$request=Connection::runQuery('select count(*) from actividad where tarea=Actividad');
 
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
			<header><h3>Actividades</h3></header>
                        
                         <?php if($modulo_rT=='Tareas' && $listar_rT=='Habilitado'){ ?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="../vistas/mostrar_actividades.php" method="post" enctype="multipart/form-data">
                                     <div>
                                  
                                                <fieldset>
                                        
                                        <table>
                                            <tr>
                                                <td><label>Asunto:</label></td>
                                                <td><input name="asunto_bus" style="width:130px;"></td>
                                                <td><label id="b" class="">Asignado a:</label></td>
                                                            <td><select name="user" style="width:130px;height:20px;" id="d" class="">
                                                                     <option value=""></option>
                                                            <?php
                                                            include "modelo/conexion.php";
                                                            $consulta= "select * from usuarios order by id asc";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor=$fila['usuario'];
                                                         

                                                            echo"<option value='".$valor."'>".$valor."</option>";
                                                            
                                                            }
                                                            ?>

                                                            </select></td>
                                            </tr>
                                            <tr><td><label>Contacto:</label></td>
                                                           <td><input name="contacto_bus" style="width:130px;"></td>
                                                           
                                                           <td><label id="c" class="">estado:</label></td>
                                                           <td><select name="estado" style="width:130px;height:20px;" id="dA" class="">
                                                                <option value=""></option>
                                                               <option value="No iniciada">No iniciada</option>
                                                                   <option value="En proceso">En proceso</option>
                                                                   <option value="Completada">Completada</option>
                                                                   <option value="Pendiente">Pendiente</option>
                                                                   <option value="Aplazada">Aplazada</option>

                                                           </select></td>
                                                          </tr>
                                            
                                            <tr>
                                                <td><input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar"></td>
                                            </tr>
                                        </table>
                                       
                                        
                                    </fieldset>      
                                    
                                                        
				    </div> </form>
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../vistas/mostrar_actividades.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_actividades.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/mostrar_actividades.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_actividades.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
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
$con =$_POST["contacto_bus"];
$est =$_POST["estado"];
$use =$_POST["user"];
if($nom =='' && $con =='' && $est =='' && $use ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery("select * from actividad where tarea='Actividad' order by Id asc ".$limit);
}
if($con !='' && $nom =='' || $con !='' && $nom !='' || $con !='' && $est !='' || $con !='' && $est =='' || $con !='' && $use !='' || $con !='' && $use ==''){
    $request=Connection::runQuery("select a.* from actividad a, sis_contacto b where a.tarea='Actividad' and a.Subject LIKE '%".$nom."%' and b.nombre_cont LIKE '%".$con."%'
    and a.estado LIKE '%".$est."%' and a.user LIKE '%".$use."%' and a.id_contacto=b.id_contacto group by Id asc ".$limit);

}
if($con =='' && $nom !='' || $con =='' && $est !=''|| $con =='' && $use !=''){
$nom =$_POST["asunto_bus"];
$request=Connection::runQuery("select * from actividad  where tarea='Actividad' and Subject LIKE '%".$nom."%' and estado LIKE '%".$est."%' and user LIKE '%".$use."%' group by Id asc ".$limit);
}}
else{
$request=Connection::runQuery("select * from actividad where tarea='Actividad' order by Id asc ".$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

$table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Asunto'.'</th>';
//              $table = $table.'<th>'.'contacto'.'</th>';
              $table = $table.'<th>'.'Fecha Inicio'.'</th>';
              $table = $table.'<th>'.'Fecha Fin'.'</th>';
              $table = $table.'<th>'.'Prioridad'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
        
              $table = $table.'</tr>';
$table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
           if($modulo_rT=='Tareas' && $ver_rT=='Habilitado'){$ver='<a href="../seleccion/cargar.php?tarea='.$row["Id"].'">';}else{$ver='';}
          
           if(date("Y-m-d").' '.$a > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d").' '.$a <= $row['EndTime'] && date("Y-m-d").' '.'23:59:00' > $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d").' '.'23:59:00' < $row['EndTime']){$color='<font color="orange">';}
           
           
           $table = $table.'<tr><td>'.$ver.''.$color.''.$row["Subject"].'<font></a></td></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td><td>'.$color.''.$row['prioridad'].'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td>
                    </tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminar_a']))
    {
        $Codigo=$_GET['eliminar_a'];
        $sql = "DELETE FROM actividad WHERE Id='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Actividad Eliminada");location.href="../vistas/mostrar_actividades.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
