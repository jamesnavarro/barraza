<body>
       
				<div class="module_content"> 
                               
                                Adicionar Orden externa
            <hr>   
                                              <fieldset style="width:100%; float:center; margin-right: 3%;">
            <?php function formRegistro(){ ?>
         <form name="insertar" action="../vistas/?id=add_atenciones&cod=<?php echo $_GET['cod'] ?>" method="post" enctype="multipart/form-data">
                <table>
							<tr>
                                                           <td><label>Orden Interna : </label></td>
                                                           <td><select name="estado" style="width:130px;height:30px;">
                                                                   <?php
                                                                   include "../modelo/conexion.php";
                                                           $consulta= "SELECT * FROM `actividad` WHERE archivo='".$_GET['cod']."' group by orden_servicio";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['orden_servicio'];
                                                            $valor2=$fila['orden_servicio'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Adicionar Autorizacion : </label></td>
                                                            <td><input type="text" name="orden" value=""></td>
                                                          
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn"  onclick="">
					<input type="button" value="Cerrar" onclick="javascript:window.opener.document.location.reload();self.close();"></form>
				 </fieldset></div>
                    
        <?php }
        if (isset($_POST["estado"])) {
	
	$estado = $_POST["estado"];
	$motivo = $_POST["orden"];
	
	// Hay campos en blanco
	if($estado==NULL|$motivo==NULL) {
		echo "<font color='red'>un campo esta vacio.</font>";
		formRegistro();
	}else{
		// �Coinciden las contrase�as?
		
				
				
                                
                                $sql = "UPDATE `actividad` SET  `orden_externa`='".$motivo."' WHERE `orden_servicio`='".$estado."' and `archivo`='".$_GET['cod']."'";
                                mysql_query($sql) or die(mysql_error());
                                
                                $sql1 = "UPDATE `insumos_asignados` SET  `autorizacion`='".$motivo."' WHERE `rel_atencion`='".$estado."' and `numero_orden`='".$_GET['cod']."'";
                                mysql_query($sql1) or die(mysql_error());
                                
                                $sql2 = "UPDATE `medicamentos_asig` SET  `autorizacion`='".$motivo."' WHERE `rel_atencion`='".$estado."' and `numero_orden`='".$_GET['cod']."'";
                                mysql_query($sql2) or die(mysql_error());
                                
                                $sql3 = "UPDATE `equipos_asig` SET  `autorizacion`='".$motivo."' WHERE `rel_atencion`='".$estado."' and `numero_orden_a`='".$_GET['cod']."'";
                                mysql_query($sql3) or die(mysql_error());
                                
                                $sql4 = "UPDATE `laboratorio_asig` SET  `autorizacion`='".$motivo."' WHERE `rel_atencion`='".$estado."' and `numero_orden_lab`='".$_GET['cod']."'";
                                mysql_query($sql4) or die(mysql_error());
                                
                                $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES (' ".$_SESSION['k_username']." adiciono Ord Ext. a la Ord Int  $estado ', '".$_GET['cod']."', '".$_SESSION['k_username']."', 'Archivo General')";
mysql_query($sqlr);
 echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=add_atenciones&cod=".$_GET["cod"]."'";
     
        echo "</script>";
				?>
				
				<?php
			
		
	}
}else{
	formRegistro();
}
        ?>
    </body>
