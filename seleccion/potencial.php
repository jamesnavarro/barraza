<?php 

include "../modelo/conexion.php";
include_once 'Connection.php';
require '../modelo/consultar_permisos.php';

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$request=Connection::runQuery('select count(*) from sis_contacto_potencial');
 
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
			<header><h3>contactos potenciales</h3></header>
                        
                         <?php if($modulo_rCL=='Clientes' && $listar_rCL=='Habilitado'){ ?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                     <div>
                                       
                                      </div> 
                                               <fieldset style="width:100%; float:center; margin-right: 3%;"> 
                                            <fieldset style="width:48%; float:left; margin-right: 3%;">
                                        
                                        
                                                <div><label>nombre:</label>
                                                <input name="nombre" style="width:130px;" value=""></div><br>
                                                <div><label>apellidos:</label>
                                                <input name="apellido" style="width:130px;"></div><br>
                                               <div><label>toma de contacto:</label>
                                                <select name="toma_contacto" id="lead_source" title='' tabindex="106"  style="width:130px;" >
                                                                    <option label="" value=""></option>
                                                                    <option label="Llamada en Frío" value="Llamada en Frío">Llamada en Frío</option>
                                                                    <option label="Cliente Existente" value="Cliente Existente">Cliente Existente</option>
                                                                    <option label="Auto Generado" value="Auto Generado">Auto Generado</option>
                                                                    <option label="Empleado" value="Empleado">Empleado</option>
                                                                    <option label="Partner" value="Partner">Partner</option>
                                                                    <option label="Relaciones Públicas" value="Relaciones Públicas">Relaciones Públicas</option>
                                                                    <option label="Correo Directo" value="Correo Directo">Correo Directo</option>
                                                                    <option label="Conferencia" value="Conferencia">Conferencia</option>
                                                                    <option label="Exposición" value="Exposición">Exposición</option>
                                                                    <option label="Sitio Web" value="Sitio Web">Sitio Web</option>
                                                                    <option label="Recomendación" value="Recomendación">Recomendación</option>
                                                                    <option label="Email" value="Email">Email</option>
                                                                    <option label="Campaña" value="Campaña">Campaña</option>
                                                                    <option label="Otro" value="Otro">Otro</option>
                                                                    </select></div><br>
                                                
                                               
                                           
                                                          
                                            <input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar">
                                            
                                        
                                        
                                    </fieldset>
                                            
                                    <fieldset style="width:48%; float:center;"  id="dA" class="">
                                        
                                                <div><label>estado:</label>
                                               <select name="estado" style="width:130px;">
                                                   <option value=""></option>
                                                                   <option value="Nuevo">Nuevo</option>
                                                                   <option value="Asignado">Asignado</option>
                                                                   <option value="En proceso">En proceso</option>
                                                                   <option value="Convertido">Convertido</option>
                                                                   <option value="Reciclado">Reciclado</option>
                                                                   <option value="Muerto">Muerto</option>
                                                                   
                                                               
                                                               </select></div><br>
                                                
                                               
                                                 <div><label>asignado a:</label>
                                                <select name="user" style="width:130px;">
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

                                                            </select></div><br>
                                                
                                                
                                                
                                           
                                                          
                                            
                                            
                                        
                                        
                                    </fieldset> 
                                    
    </form>                                                    
</div> </fieldset><br><hr>  <font color="red">Búsqueda Digitada:</font><?php if(isset($_POST["nombre"])){if($_POST["nombre"]!=''){echo '<b> ,nombre:</b><font color="green">'.$_POST["nombre"].'</font>';}}

if(isset($_POST["apellido"])){if($_POST["apellido"]!=''){echo '<b> ,apellido:</b><font color="green">'.$_POST["apellido"].'</font>';}}
if(isset($_POST["cargo"])){if($_POST["cargo"]!=''){echo '<b> ,cargo:</b><font color="green">'.$_POST["cargo"].'</font>';}}
if(isset($_POST["empresa"])){if($_POST["empresa"]!=''){echo '<b> ,empresa:</b><font color="green">'.$_POST["empresa"].'</font>';}}
if(isset($_POST["user"])){if($_POST["user"]!=''){echo '<b> ,usuario:</b><font color="green">'.$_POST["user"].'</font>';}}
if(isset($_POST["toma_contacto"])){if($_POST["toma_contacto"]!=''){echo '<b> ,toma de contacto:</b><font color="green">'.$_POST["toma_contacto"].'</font>';}}


?><hr><br>
                                    <fieldset>
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../vistas/mostrar_clientespotencial.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/mostrar_clientespotencial.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/mostrar_clientespotencial.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/mostrar_clientespotencial.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
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
$ape =$_POST["apellido"];
$car =$_POST["estado"];
$use =$_POST["user"];
$tom =$_POST["toma_contacto"];
if($nom =='' && $ape =='' && $car =='' && $use =='' && $tom ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery('select * from sis_contacto_potencial order by id_contacto_pot asc '.$limit);
}
if($nom !='' || $ape !='' || $car !='' || $use !='' || $tom !=''){
    $request=Connection::runQuery("select * from sis_contacto_potencial WHERE nombre_pot LIKE '%".$nom."%' and apellido_pot LIKE '%".$ape."%' and estado LIKE '%".$car."%' and toma_contacto_pot LIKE '%".$tom."%' and usuario LIKE '%".$use."%' order by id_contacto_pot asc ".$limit."");
    
}
}
else{
$request=Connection::runQuery('select * from sis_contacto_potencial order by id_contacto_pot asc '.$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              $table = $table.'<th>'.'Referido por'.'</th>';

              $table = $table.'<th>'.'Toma de Contacto'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
              $table = $table.'<th>'.'Email'.'</th>';
              $table = $table.'<th>'.'Registrado por'.'</th>';
          
               
              
           $table = $table.'</tr>';
$table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
           if($modulo_rCL=='Clientes' && $ver_rCL=='Habilitado'){$ver='<a href="../seleccion/cargar.php?cont_pot='.$row["id_contacto_pot"].'">';}else{$ver='';}
          
          
           
           
           $table = $table.'<tr><td>'.$ver.''.$row["nombre_pot"].' '.$row["apellido_pot"].'<font></a></td>
               <td>'.$row["referido_por"].'</font></td><td>'.$row["toma_contacto_pot"].'</font></td>
                   <td>'.$row['tel_oficina_pot'].'</font></td><td>'.$row['email1_pot'].'</font></td><td>'.$row['usuario'].'</font></td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminar_pot']))
    {
        $Codigo=$_GET['eliminar_pot'];
        $sql = "DELETE FROM sis_contacto_potencial WHERE id_contacto_pot='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/mostrar_clientespotencial.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>