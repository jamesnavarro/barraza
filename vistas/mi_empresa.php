<?php 
$consulta= "select * from inf_empresa";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_emp=  $fila['id_emp']; 
$nombre=$fila['nombre'];
$web_empe=$fila['web_emp'];
$siglas=$fila['siglas'];
$prop=$fila['gerente'];
$ni=$fila['nit_emp'];
$facti=$fila['factura_inicial'];
$factf=$fila['factura_final'];
$te1=$fila['telefono_1'];
$fax1=$fila['telefono_2'];
$cel_emp=$fila['telefono_3'];
$depa=$fila['dapartamento'];
$munici=$fila['municipio'];
$dire1=$fila['direccion'];
$emai1=$fila['email'];
$info=$fila['inf'];}
?>
<section id="main" class="column">
		<div class="clear"></div>
                <form name="insertar_empresa" action="../modelo/insertar_empresa.php" method="post" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>informacion de mi empresa</h3></header>
                        
                        
				<div class="module_content"> 
                            <h4 class="inf">Empresa :<?php 
                                        echo "$nombre";
                                        ?> </h4><br>
                                        <hr>
                                           <?php if($modulo_rE=='Empresa' && $editar_rE=='Habilitado'){ ?> <a href="../vistas/formulario_mi_empresa.php?codigo=<?php echo ($id_emp); ?>"> <input type="button" name="enviar" value="Editar" class="alt_btn"></a><?php ;} ?>
                                           <?php if($modulo_rE=='Empresa' && $eliminar_rE=='Habilitado'){ ?> <a href="../modelo/eliminar.php?emp=<?php echo ($id_emp); ?>"> <input type="button" name="enviar" value="Eliminar" class="alt_btn"></a><?php ;} ?>
                                        
                                        <hr><br>
                                        
                                       <fieldset style="width:100%; float:center; margin-right: 3%;">
                                     <fieldset style="width:48%; float:left; margin-right: 3%;"> 
                                                   <table>
							<tr>
                                                           <td><label>Nombre de la empresa : *</label></td>
                                                           <td><h3><?php
                                                           echo "$nombre";
                                                          
                                                           ?></h3></td>
                                                        </tr>
                                                       
                                                         <tr>
                                                           <td><label>Sitio Web :</label></td>
                                                           <td><a href="<?php echo "$web_empe"; ?>" target="_blank"> <?php echo "$web_empe"; ?></a></td>
                                                          </tr>
                                                          <tr>
                                                            <td><label>Siglas :</label></td>
                                                            <td><?php echo "$siglas"; ?></td>
                                                          </tr>
                                                       
                                                          <tr>
                                                           <td><label>Gerente :</label></td>
                                                            <td><?php echo "$prop"; ?></td>
                                                          </tr>
                                                         
                                                           <tr>
                                                             <td><label>Telefono :</label></td>
                                                             <td><?php echo "$te1"; ?></td>
                    
                                                             </tr>
                                                              
                                                                 <tr>
                                                                    <td><label>Fax :</label></td>
                                                                    <td><?php echo "$fax1"; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>Celular :</label></td>
                                                                    <td><?php echo "$cel_emp"; ?></td>
                                                                </tr>
                                                               
                                                               

                                                     </table>
                                        
						</fieldset>
                                        
						<fieldset style="width:48%; float:left;"> 
                                                    
                                                       <table>
                
                                                             

                                                                 <tr>
                                                                    <td><label>Nit:</label></td>
                                                                    <td><?php echo "$ni"; ?></td>
                                                                </tr>
                                                            
                                                                 <tr>
                    <td><label>Departamento:</label></td>
                    <td><?php if($depa!=''){
                                                            include "../modelo/conexion.php";
                                                            $consulta= "select * from departamentos WHERE cod_dep=".$depa." group by cod_dep";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cod_dep'];
                                                            $valor2=$fila['nombre_dep'];
                                                         

                                                           echo "$valor2";
                                                            
                                                            }}
                                                            ?></td>
                </tr>
                <tr>
                    <td><label>Municipio:</label></td>
                    <td><?php if($munici!=''){
                                                            include "../modelo/conexion.php";
                                                            $consulta= "select * from departamentos WHERE cod_mun=".$munici." and cod_dep=".$depa."";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cod_mun'];
                                                            $valor2=$fila['nombre_mun'];
                                                         

                                                            echo $valor2;
                                                            
                                                            }}
                                                            ?></td>
                </tr>
                                                                <tr>
                                                                    <td><label>Direccion:</label></td>
                                                                    <td><?php echo "$dire1"; ?></td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td><label>Email:</label></td>
                                                                    <td><?php echo "$emai1";',' ?></td>

                                                                </tr>
                                                                 

                                                              
                                                                
                                                                <tr>
                                                                    <td><label>Rango de facturacion:</label></td>
                                                                    <td><?php echo "$facti".' al '.$factf; ?></td>
                                                                </tr>
               
            </table>  
                                                        
						</fieldset></fieldset>
                                       <hr><br>
                                       <table> <tr>
                                                                    <td><label>Informacion Adicional:</label></td>
                                                                    <td><?php echo "$info"; ?></td>
                                                                </tr></table>
                                       
                       
		</article>
                    </form>
		
		
		
		
		<div class="spacer"></div>
                
           
              
	</section>
</body>

</html>
