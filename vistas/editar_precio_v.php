<?php

include "../modelo/conexion.php";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
       
				<div class="module_content"> 
                               
                             Editar Precios de Ventas
            <hr>   
                                              <fieldset style="width:100%; float:center; margin-right: 3%;">
            <?php function formRegistro(){ ?>
         <form name="insertar" action="../vistas/editar_precio_v.php?cod=<?php echo $_GET['cod'] ?>" method="post" enctype="multipart/form-data">
                <table border="1">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Anexos</th>
                    </tr>
						
                                                           
                                                          
                                                                   <?php
                                                                   
                                                           $consulta= "select a.*, b.* from equipos_ventas a, productos b where a.cod_equipo=b.codigo and a.numero_orden_a='".$_GET['cod']."'";
                                                          
                                                            $result=  mysql_query($consulta);
                                                            $c = 0;
                                                            while($fila=  mysql_fetch_array($result)){
                                                              $c +=1;
                                                       
                                                            ?>	<tr>
                                                                <td><input type="hidden" name="codigo<?php echo $c ?>" value="<?php echo $fila['id_equipo_a'] ?>">
                                                                    <input type="text" name="nombre" value="<?php echo $fila['nombre'] ?>"></td>
                                                               <td><input type="text" name="precio<?php echo $c ?>" value="<?php echo $fila['precio_a'] ?>"></td>
                                                                <td><input type="text" name="anexo<?php echo $c ?>" value="<?php echo $fila['anexo'] ?>"></td>
                                                            <?php } ?>
                                                     </table>
             <input type="hidden" name="cantidad" value="<?php echo $c ?>">
                                                    
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn"  onclick="">
					<input type="button" value="Cerrar" onclick="javascript:window.opener.document.location.reload();self.close();"></form>
				 </fieldset></div>
                    
        <?php }
        if (isset($_POST["cantidad"])) {
	
	
	$n = $_POST["cantidad"];
        $c = 0;
        for($x=1; $x<=$n; $x=$x+1){
            $codigo = $_POST["codigo$x"];
	$precio = $_POST["precio$x"];
	$anexo = $_POST["anexo$x"];
	
        $sql = "UPDATE `equipos_ventas` SET  `precio_a`='".$precio."', `anexo`='".$anexo."' WHERE `id_equipo_a`='".$codigo."'";
                                mysql_query($sql) or die(mysql_error());
        }
				
                                
                                
                                
                                
echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
echo "</script>";
				?>
				
				<?php
			
		
	
}else{
	formRegistro();
}
        ?>

