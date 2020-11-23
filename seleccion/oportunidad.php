<?php 

include "../modelo/conexion.php";
include_once 'Connection.php';
require '../modelo/consultar_permisos.php';

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$request=Connection::runQuery('select count(*) from sis_oportunidades');
 
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
			<header><h3>oportunidades</h3></header>
                        
                         <?php if($modulo_rO=='Oportunidades' && $listar_rO=='Habilitado'){ ?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                     
                                                <fieldset>
                                        
                                        <table>
                                            <tr>
                                                <td><label>Nombre Oportunidad:</label></td>
                                                <td><input name="bus_oportunidad" style="width:130px;height:20px;"></td>
                                            </tr>
                                            <tr>
                                                           <td><label>tipos :</label></td>
                                                           <td><select name="tipo_opo" style="width:130px;height:20px;">
                                                                   <option value=""></option>
                                                                   <option value="Negocios existente">Negocios existente</option>
                                                                   <option value="Nuevo negocio">Nuevo negocio</option>
                                                                   
                                                               </select></td>
                                                               <td><label id="dA" class="">Etapas de ventas :</label></td>
                                                           <td><select name="etapa" style="width:130px;height:20px;" id="d" class="">
                                                                   <option value=""></option>
                                                                   <option value="No iniciada">Prospecto</option>
                                                                   <option value="En proceso">Calificacion</option>
                                                                   <option value="Completada">Necesita Analisis</option>
                                                                   <option value="Pendiente">Propuesta de Valor</option>
                                                                   <option value="Aplazada">Id. tomadores de Decisionesa</option>
                                                                   <option value="Aplazada">Analisis de percepción</option>
                                                                   <option value="Aplazada">Propuesta/Presupuesto</option>
                                                                   <option value="Aplazada">Negociación</option>
                                                                   <option value="Aplazada">Ganado</option>
                                                                   <option value="Aplazada">Perdido</option>
                                                               </select></td>
                                                          </tr>
                                            <tr>
                                                <td><label>Empresa :</label></td>
                                                <td><select name="bus_empresa_opo" style="width:130px;height:20px;">
                                                        <option value=""></option>
                                                        <?php
                                                        include "../modelo/conexion.php";
                                                        $consulta= "select id_empresa, nombre_emp from sis_empresa order by id_empresa asc";                     
                                                        $result=  mysql_query($consulta);
                                                        while($fila=  mysql_fetch_array($result)){
                                                          $valor=$fila['nombre_emp'];
                                                          $precio=$fila['id_empresa'];
                                 
                                                          echo"<option value='".$valor."'>".$valor."</option>";
                                                                                      }
                                                             ?>
                                                    </select></td>
                                                     <td><label id="b" class="">Asignado a:</label></td>
                                                            <td><select name="user" style="width:130px;height:20px;" id="c" class="">
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
	<a href="../vistas/mostrar_oportunidades.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_oportunidades.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/mostrar_oportunidades.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_oportunidades.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png"> <?php
}
?>

<?php
//Esta es la cadena limit que anexaremos a nuestra consulta
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 
//Hacemos la consulta con nuestros resultados
if(isset($_POST["bus_oportunidad"])){

$nom =$_POST["bus_oportunidad"];
$tip =$_POST["tipo_opo"];
$emp =$_POST["bus_empresa_opo"];
$eta =$_POST["etapa"];
$use =$_POST["user"];
if($nom =='' && $tip =='' && $use =='' && $emp =='' && $eta ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery("select * from sis_oportunidades order by id_oportunidad asc ".$limit);
}

if($nom !='' || $eta !=''|| $use !=''|| $tip !=''|| $nom !=''){

$request=Connection::runQuery("select a.*, b.nombre_emp from sis_oportunidades a, sis_empresa b WHERE a.nombre_opo LIKE '%".$nom."%' and a.tipo_opo LIKE '%".$tip."%' and b.nombre_emp LIKE '%".$emp."%' and a.id_empresa=b.id_empresa");
}}
else{
$request=Connection::runQuery("select * from sis_oportunidades order by id_oportunidad asc ".$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';
$table = $table.'<thead>';
       $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
             
              $table = $table.'<th>'.'Etapa de Ventas'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
              $table = $table.'<th>'.'Fecha de Cierre'.'</th>';
              $table = $table.'<th>'.'Usuario'.'</th>';
            
//              $table = $table.'<th>'.''.'</th>';
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
           if($modulo_rO=='Oportunidades' && $ver_rO=='Habilitado'){$ver='<a href="../seleccion/cargar.php?oport='.$row["id_oportunidad"].'">';}else{$ver='';}
           
         
          
           
           
           $table = $table.'<tr><td>'.$ver.''.$row["nombre_opo"].'<font></a></td></td>
               <td>'.$ver.''.$row["etapas_opo"].'</font></td><td>'.$row["cantidad"].'</font></td><td>'.$row["fecha_opo"].'</font></td>
                   <td>'.$row['asignado_opo'].'</font></td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminar_op']))
    {
        $Codigo=$_GET['eliminar_op'];
        $sql = "DELETE FROM sis_oportunidades WHERE id_oportunidad='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_oportunidades.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
