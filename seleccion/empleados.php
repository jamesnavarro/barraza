<?php 

include "../modelo/conexion.php";
include_once 'Connection.php';
require '../modelo/consultar_permisos.php';

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
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

 <article class="module width_full">
			<header><h3>contactos</h3></header>
                        
                 <?php if(isset($_GET['cod'])){
                     
                     $request=Connection::runQuery("select * from usuarios WHERE id=".$_GET['cod']);
                     while($row=mysql_fetch_array($request))
	{     echo '<h3>nombre seleccionado :'.$row["nombre"].' '.$row["apellido"].'';
          
              $nnn = $row["nombre"].' '.$row["apellido"];
              $ii = $row["id"];
           ?>
         <form name="formu">

<input type="text" name="datos1" id="datos1" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos2" id="datos2" readonly value="<?php echo $ii ?>" />

</form>
<a href="#" title="pasar valor" onClick="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }}else{ ?>
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
                                                <div><label>cargo:</label>
                                                <input name="cargo" style="width:130px;"></div><br>
                                                
                                               
                                           
                                                          
                                            <input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar">
                                            
                                        
                                        
                                    </fieldset>
                                            
                                    <fieldset style="width:48%; float:center;">
                                        
                                                <div><label>empresa:</label>
                                              <input name="empresa" style="width:130px;" value=""></div><br>
                                                <div><label>campaña:</label>
                                                <select name="campaña"  style="width:130px;">
                                                        <option label="" value=""></option>
                                                        <?php
                                                        include "../modelo/conexion.php";
                                                        $consulta= "select * from sis_campana order by id_campana asc";                     
                                                        $result=  mysql_query($consulta);
                                                        while($fila=  mysql_fetch_array($result)){
                                                          $nom=$fila['nombre_cam'];
                                                          $id = $fila['id_campana'];
                                                          
                                                         
                                 
                                                          echo"<option value='".$id."'>".$nom."</option>";
                                                                                      }
                                                             ?>
                                                    </select></div><br>
                                            
                                                 <div><label>asignado a:</label>
                                                <select name="user" style="width:130px;">
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
	<a href="../vistas/seleccionar.php?selec=Contacto&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/seleccionar.php?selec=Contacto&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/seleccionar.php?selec=Contacto&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/seleccionar.php?selec=Contacto&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
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
$car =$_POST["cargo"];
$use =$_POST["user"];
$emp =$_POST["empresa"];
$cam =$_POST["campaña"];
$tom =$_POST["toma_contacto"];
if($nom =='' && $ape =='' && $car =='' && $use =='' && $emp =='' && $cam =='' && $tom ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery('select * from usuarios order by id asc '.$limit);
}
if($nom !='' || $ape !='' || $car !='' || $use !='' || $emp !='' || $cam !='' || $tom !=''){
    $request=Connection::runQuery("select * from usuarios WHERE nombre LIKE '%".$nom."%' and apellido LIKE '%".$ape."%' and cargo LIKE '%".$car."%' and usuario LIKE '%".$use."%' order by id asc ".$limit."");

}
}
else{
$request=Connection::runQuery('select * from usuarios order by id asc '.$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

 $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Nombre'.'</th>';
              if(isset($_POST['empresa'])){
                  if($_POST['empresa']==""){$table = $table.'<th></th>';}else{
                  $table = $table.'<th>'.'Empresa'.'</th>';}}else{$table = $table.'<th></th>';}
                 
              $table = $table.'<th>'.'Cargo'.'</th>';
              $table = $table.'<th>'.'Email'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
              $table = $table.'<th>'.'Registrado por'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
           if($modulo_rC=='Contacto' && $ver_rC=='Habilitado'){$ver='<a href="../seleccion/cargar.php?contacto='.$row["id"].'">';}else{$ver='';}
          
          if(isset($row["nombre"])){$d='<td>'.$row['nombre'].'</font></td>';}else{$d='<td></td>';}

           
           
           $table = $table.'<tr><td>'.$ver.''.$row["nombre"].' '.$row["apellido"].'<font></a></td>'.$d.'
               <td>'.$row["cargo"].'</font></td><td>'.$row["email"].'</font></td>
                   <td>'.$row['telefono'].'</font></td><td>'.$row['usuario'].'</font></td>
                       </tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}

if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM sis_contacto WHERE id_contacto='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Reunion Eliminada");location.href="../vistas/mostrar_contactos.php"</script>'; 
    }
                 }
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
