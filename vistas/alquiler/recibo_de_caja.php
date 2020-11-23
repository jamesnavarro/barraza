<?php 
include "../modelo/conexion.php";

require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if(isset($_GET["alq"])){
$consulta= "select a.*, b.* from equipos_asig a, alquiler b WHERE  a.cod_equipo=b.codigo and a.numero_orden_a=".$_GET["codigo"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id=$fila['id_equipo_a'];
$numero_orden=$fila['numero_orden_a'];
$cod_equipo=$fila['cod_equipo'];
$cantidad=$fila['cantidad'];
$precio_a=$fila['precio_a'];
$fecha_a=$fila['fecha_a'];
$fecha_f=$fila['fecha_f'];
$inf=$fila['inf'];
$fecha_reg=$fila['fecha_reg'];
$estado=$fila['estado'];
$meses=$fila['meses'];
$nombre_alq=$fila['nombre'];
$rel_atencion=$fila['rel_atencion'];
$autorizacion=$fila['autorizacion'];
$valor=$fila['precio_a'];

                                
 }}
$sql1 = "SELECT MAX(id_recibo) as id FROM recibo_caja";
$fila1 =mysql_fetch_array(mysql_query($sql1));

$id_n = $fila1["id"]+1;
?>
<!doctype html>
<html lang="en">




<body>

	
	<section id="main" class="column">

		<div class="clear"></div>
             
		<article class="module width_full">
			<header><h3 align="center">Recibo de caja # <?php echo $id_n ?></h3></header>
                        <font color="red">Aviso: (*)Indica un campo requerido</font>
                        <form name="insertar" action="../modelo/insertar_recibo.php" method="post" enctype="multipart/form-data">
				<div class="module_content"> 
                                    
                                   
					
					<input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<a href="../vistas/alquiler_proceso.php"><input type="button" value="Cancelar"></a>
				
                                        <br><br>
                                        <hr>
                                   <?php include "../modelo/conexion.php";
                                                             $consul= "select * from sis_empresa where rips LIKE '%".$empresar."%'";                     
                                                             $resul=  mysql_query($consul);
                                                             while($fil=  mysql_fetch_array($resul)){
                                                             $no=$fil['nombre_emp'];
                                                             $id=$fil['id_empresa'];
                                                             }
                                                             ?>
                                              <fieldset style="width:100%; float:center; margin-right: 3%;">
            
                <table>
							<tr>
                                                           <td><label>Nombre del Paciente :  <font color="red">*</font></label></td>
                                                           <td><input type="text" name="paciente" value="<?php  echo "$nombre".' '."$nombre2".' '."$apellido".' '."$apellido2"; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>No. de Identificación :  <font color="red">*</font></label></td>
                                                            <td><input type="text" name="numero" value="<?php echo "$numero_doc" ?>"></td>
                                                           <tr>
                                                           <td><label>Empresa que Remite :</label></td>
                                                           <td><input type="text" name="empresa" value="<?php echo $no ?>"></td>
                                                          </tr>
                                                          <tr>
                                                            <td><label>Valor a cancelar : <font color="red">*</font></label></td>
                                                            <td><input type="text" name="valor" value="<?php echo $precio_a  ?>"></td>
                                                          </tr>
                                                          <tr>
                                                            <td><label>descripción del Alquiler :</label></td>
                                                            <td><textarea style="width:90%;" rows="8" name="descripcion"><?php echo $nombre_alq  ?></textarea></td>
                                                          </tr>
                                                          
                                                          
                                                          
                                                     </table>
		    </fieldset>
                                   
                                    
                                     <hr><br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<a href="../vistas/alquiler_proceso.php"><input type="button" value="Cancelar"></a>
				</div>
                    </form>
		</article>
                    
		
		
		
		
		<div class="spacer"></div>
	</section>
              <?php include '../footer.php'; ?>

</body>

</html>
