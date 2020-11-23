<?php
include "../modelo/conexion.php";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
	<script type="text/javascript" src="../js/tcal.js"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <title>Nuevo Proyecto</title>
        
    </head>
    <body onLoad="cerrar()">
<form name="insertar" action="../modelo/insertar_insumos_asig.php" method="post" enctype="multipart/form-data">
				<div class="module_content"> 
                               
                                   <font color="red">Aviso: (*)Indica un campo requerido</font>
                                              <fieldset style="width:100%; float:center; margin-right: 3%;">
             <input type="submit" name="enviar" value="Guardar">
					
                                        <a href="../vistas/detalle_ordenes.php?codigo=<?php echo $orden_interna ?>"><INPUT TYPE="button" VALUE="Cancelar"></a>
                                        <br>             
                <table>                                <tr>
                                                           <td><label># orden :<font color="red"> *</font> </label></td>
                                                           <td><input type="text" readonly name="orden" style="width:130px;height:20px;" value="<?php echo $orden_interna ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>codigo del insumo : <font color="red"> *</font></label></td>
                                                            <td>
                                                                <input type="text" name="insumo2" id="valor2" style="width:90px;height:20px;"/>
                                                                <a href='javascript: insumos()'><input type="button" name="cancelar" value="Seleccionar"></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>precio : <font color="red"> *</font></label></td>
                                                            <td> 
                                                                <input type="text" name="precio" id="valor3"  style="width:150px;height:20px;"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>descripcion : </label></td>
                                                            <td><input type="text" name="insumo" id="valor1" style="width:280px;height:20px;"/> 
                                                                </td>
                                                        </tr>
                                                        
                                                          <tr>
							<tr>
                                                           <td><label>cantidad asignada :<font color="red"> *</font> </label></td>
                                                           <td><input type="text" name="numero" style="width:130px;height:20px;"></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><label>Fecha de entrega :<font color="red"> *</font> </label></td>
                                                            <td><input type="text" name="fecha_inicial" class="tcal" style="width:70px;height:20px;" value="<?php  echo date("Y-m-d") ?>"></td>
                                                           
                                                           <tr>
                                                            <td><label>Asignado a :<font color="red"> *</font></label></td>
                                                            <td><input type="text" name="usuario" readonly id="valor6" style="width:130px;height:20px;" value="<?php if(isset($user)){echo $user;} ?>"/>
                                                                <a href='javascript: usuario()'><input type="button" name="cancelar" value="Seleccionar"></a></td>
                                                          </tr>
                                                         <tr>
                                                            <td><label>nombre del paciente : <font color="red"> *</font></label></td>
                                                            <td><input type="text" name="name" id="valor1" readonly style="width:130px;height:20px;" value="<?php echo "$nombre".' '."$apellido"; ?>"/>
                                                                <input type="text" name="paciente" readonly id="valor2" style="width:2px;height:2px;" value="<?php echo $idp ?>"/>
                                                                </td></tr>
                                                          <tr>
                                                            <td><label>informacion adicional :</label></td>
                                                            <td><textarea style="width:90%;" rows="3" name="descripcion" id="valor3"></textarea></td>
                                                          </tr>     
                                                     </table>
                                        <input type="submit" name="enviar" value="Guardar">
					<a href="../vistas/detalle_ordenes.php?codigo=<?php echo $orden_interna ?>"><INPUT TYPE="button" VALUE="Cancelar"></a>
		    </fieldset>
                                   
                                    
                                     <hr><br>
             
				</div>
                    </form>
                    
    </body>
</html>
