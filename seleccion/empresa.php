<?php 

include "../modelo/conexion.php";
include_once 'Connection.php';
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$request=Connection::runQuery('select count(*) from sis_empresa');
 
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

?>

<article class="module width_full">
			<header><h3>empresas</h3></header>
                        
                         <?php if($modulo_rE=='Empresa' && $listar_rE=='Habilitado'){ ?>
				<div class="module_content">
                             
                                    <form name="buscarA" action="" method="post" enctype="multipart/form-data">
                                    
                                    <fieldset style="width:100%; float:center; margin-right: 3%;"> 
                                    
                                                <fieldset style="width:48%; float:left; margin-right: 3%;">
                                                                                                               
                                        
                                                <div><label>nombre:</label>
                                                <input name="nombre" style="width:130px;"></div><br>
                                                <div><label>teléfono oficina:</label>
                                                <input name="telefono" style="width:130px;"></div><br>
                                                <div><label>dir. facturación:</label>
                                                <input name="direccion" style="width:130px;"></div><br>
                                                
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
                                           
                                                          
                                            <input type="submit" name="buscar" value="Buscar" class="alt_btn">
                                                <input type="reset" value="Limpiar">
                                            
                                        
                                        
                                    </fieldset>
                                            
                                    <fieldset style="width:48%; float:center;"  id="dA" class="hide">
                                        
                                                <div><label>propietario:</label>
                                                <input name="propietario" style="width:130px;"></div><br>
                                                <div><label>departamento:</label>
                                                <input name="departamento" style="width:130px;"></div><br>
                                                <div><label>municipio:</label>
                                                <input name="municipio" style="width:130px;"></div><br>
                                                <div><label>tipo:</label>
                                                 <select style="width:130px;" name="tipo">
                                                            <option value="" title=""></option>
                                                            <option value="Analista" title="Analyst">Analista</option>
                                                            <option value="Competidor" title="Competitor">Competidor</option>
                                                            <option value="Cliente" title="Customer">Cliente</option>
                                                            <option value="Integrador" title="Integrator">Integrador</option>
                                                            <option value="Inversor" title="Investor">Inversor</option>
                                                            <option value="Partner" title="Partner">Partner</option>
                                                            <option value="Prensa" title="Press">Prensa</option>
                                                            <option value="Prospecto" title="Prospect">Prospecto</option>
                                                            <option value="Revendedor" title="Reseller">Revendedor</option>
                                                            <option value="Otro" title="Other">Otro</option>
                                                         </select></div><br>
                                                <div><label>industria:</label>
                                                <select style="width:130px;" name="industria">
								<option value="" title=""></option>
                                                                <option value="Textil" title="Apparel">Textil</option>
                                                                <option value="Banca" title="Banking">Banca</option>
                                                                <option value="Biotecnología" title="Biotechnology">Biotecnología</option>
                                                                <option value="Química" title="Chemicals">Química</option>
                                                                <option value="Comunicaciones" title="Communications">Comunicaciones</option>
                                                                <option value="Construcción" title="Construction">Construcción</option>
                                                                <option value="Consultoría" title="Consulting">Consultoría</option>
                                                                <option value="Educación" title="Education">Educación</option>
                                                                <option value="Electronica" title="Electronics">Electronica</option>
                                                                <option value="Energía" title="Energy">Energía</option>
                                                                <option value="Ingeniería" title="Engineering">Ingeniería</option>
                                                                <option value="Entretenimiento" title="Entertainment">Entretenimiento</option>
                                                                <option value="Medio ambiente" title="Environmental">Medio ambiente</option>
                                                                <option value="Finanzas" title="Finance">Finanzas</option>
                                                                <option value="Gobierno" title="Government">Gobierno</option>
                                                                <option value="Sanidad" title="Healthcare">Sanidad</option>
                                                                <option value="Caridad" title="Hospitality">Caridad</option>
                                                                <option value="Seguros" title="Insurance">Seguros</option>
                                                                <option value="Maquinaria" title="Machinery">Maquinaria</option>
                                                                <option value="Fabricación" title="Manufacturing">Fabricación</option>
                                                                <option value="Medios de comunicación" title="Media">Medios de comunicación</option>
                                                                <option value="Sin ánimo de lucro" title="Not For Profit">Sin ánimo de lucro</option>
                                                                <option value="Ocio" title="Recreation">Ocio</option>
                                                                <option value="Minoristas" title="Retail">Minoristas</option>
                                                                <option value="Envíos" title="Shipping">Envíos</option>
                                                                <option value="Tecnología" title="Technology">Tecnología</option>
                                                                <option value="Telecomunicaciones" title="Telecommunications">Telecomunicaciones</option>
                                                                <option value="Transporte" title="Transportation">Transporte</option>
                                                                <option value="Servicios públicos" title="Utilities">Servicios públicos</option>
                                                                <option value="Otro" title="Other">Otro</option>
                                                         </select></div><br>
                                                
                                                
                                                
                                           
                                                          
                                            
                                            
                                        
                                        
                                    </fieldset>
                                                        
				     <br><br></fieldset><br>
                                     </form>
                                    <fieldset style="width:100%; float:center; margin-right: 3%;">
                                     <table>
                                         <tr><td>
            <?php
if($page>1){?>
	<a href="../vistas/seleccionar.php?selec=Cuenta&page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/seleccionar.php?selec=Cuenta&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/seleccionar.php?selec=Cuenta&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/seleccionar.php?selec=Cuenta&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
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
$tel =$_POST["telefono"];
$dir =$_POST["direccion"];
$use =$_POST["user"];
$pro =$_POST["propietario"];
$dep =$_POST["departamento"];
$mun =$_POST["municipio"];
$tip =$_POST["tipo"];
$ind =$_POST["industria"];
if($nom =='' && $tel =='' && $dir =='' && $use =='' && $pro =='' && $dep =='' && $mun =='' && $tip =='' && $ind ==''){
    echo '<font color="red">por favor llene los campos vacios para una busqueda optimizada</font>';
$request=Connection::runQuery('select * from sis_empresa order by id_empresa asc '.$limit);
}

if($nom !='' || $tel !='' || $dir !='' || $use !='' || $pro !='' || $dep !='' || $mun !='' || $tip !='' || $ind !=''){

$request=Connection::runQuery("select * from sis_empresa WHERE nombre_emp LIKE '%".$nom."%' and tel_oficina_emp LIKE '%".$tel."%' and direccione_emp LIKE '%".$dir."%' and departameto_emp LIKE '%".$dep."%' and municipio_emp LIKE '%".$mun."%' and tipo_emp LIKE '%".$tip."%' and industria_emp LIKE '%".$ind."%' and usuario LIKE '%".$use."%' order by id_empresa asc ".$limit);
}
}
else{
$request=Connection::runQuery('select * from sis_empresa order by id_empresa asc '.$limit);
}

if($request){
//    echo'<hr>';
    $table = '<table class="lista">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Empresa'.'</th>';
              $table = $table.'<th>'.'Ciudad'.'</th>';
              $table = $table.'<th>'.'Telefono'.'</th>';
              $table = $table.'<th>'.'Usuario'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
 

	while($row=mysql_fetch_array($request))
	{     
           if($modulo_rE=='Empresa' && $ver_rE=='Habilitado'){$ver='<a href="../seleccion/cargar.php?select='.$row["id_empresa"].'">';}else{$ver='';}
    
           $table = $table.'<tr><td>'.$ver.''.$row["nombre_emp"].'<font></a></td></td>
               <td>'.$row["municipio_emp"].'</font></td><td>'.$row["tel_oficina_emp"].'</font></td><td>'.$row['usuario'].'</font></td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}
if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM sis_empresa WHERE id_empresa='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Reunion Eliminada");location.href="../vistas/mostrar_empresas.php"</script>'; 
    }
    
                         }  else {
                           echo '<font color="red">No tiene acceso a esta área. Contacte con el Administrador de su sitio web para obtenerlo.</font>';  
}
                         
?>
       </td></tr> </table> 
                                               
                                  </fieldset>   
				</div>
                       
		</article>
