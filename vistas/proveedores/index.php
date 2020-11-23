<?php
   include '../../modelo/conexion.php';
   session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Registro</title>
<link href="../../css/estilo.css" rel="stylesheet">
<script src="../../js/jquery.js"></script>
<script src="funciones.js"></script>
    </head>
    <body onload="Llenar_cli('<?php echo $_GET['id'] ?>');pagina(1,0)">

        <div>
            <h3>Registro de Proveedores</h3>
        </div>
        <div>
                        <fieldset>
               <legend>Panel de Control</legend>
               <div  style="float:left">
                   <img src="../../images/save.png" class="panel" id="Guardar" title="Guardar Registro" data-toggle="tooltip">  <img src="../../images/borrar.png" class="panel"  id="Eliminar" title="Borrar Registro">  <img src="../../images/nuevo.png" class="panel"  id="Nuevo" title="Nuevo Registro">  <img src="../../images/printer.png" class="panel"  id="Imprimir" title="Imprimir Registro">  <img src="../../images/salir.png" class="panel"  id="Salir"title="Salir del Formulario">
               </div>
               <div id="paginacion"  style="float:right">

               </div>
            </fieldset>
            </div>
        <div>
            
      
            <fieldset>
                <form id="Form">
               <legend>Formulario</legend>
				<table class="tbl-registro" width="100%">
                	<tr>
                    	<td width="180">1.Nit / C.C: <b>*</b></td>
                        <td width="456"><input type="text" class="sp1" maxlength="11" id="nit" autofocus placeholder="900123987-1" value=""/> <input type="hidden" class="sp4" id="sw" placeholder="" value="0"/></td>
                        <tr>
                    	<td>2.Nombre Proveedor: <b>*</b></td>
                        <td><input type="text" class="sp1" id="nom"   placeholder="Razón Social "/></td>
                        <tr>
                    	<td>3.Direccion: </td>
                        <td><input type="text" class="sp1" id="dir"   placeholder=""/><td width="155">
                        <tr>
                    	<td>4.Departamento: </td>
                        <td><select  class="sp1"  name="ciudad" id="dep">
                         <?php
                               if(isset($_GET['cod'])){
                                   echo '<option value="'.$ciudad.'">'.$ciudad.'</option>';
                               }else{
                                   echo '<option value="">Seleccione el Departamento...</option>';}
                                        
                               $consulta= "SELECT * FROM `departamentos` group by nombre_dep";                     
                                $result=  mysql_query($consulta);
                                while($fila=  mysql_fetch_array($result)){
                                $valor1=$fila['cod_dep'];
                                 $valor2=$fila['nombre_dep'];

                               echo '<option value="'.$valor2.'">'.$valor2.'</option>';

                                }

                                ?>
                                            </select></td>
                        <tr>
                    	<td>5.Ciudad: </td>
                        <td><select  class="sp1"  name="municipio" id="mun">
                                 <option value="">Seleccione el Municipio...</option>     
                      <?php   if(isset($_GET['cod'])){
                          echo '<option value="'.$municipio.'">'.$municipio.'</option>';
                      
                      }else{
                          echo '<option value="">Seleccione el Municipio...</option>';
                          $consulta= "SELECT * FROM `departamentos` group by nombre_dep";                     
                                $result=  mysql_query($consulta);
                                while($fila=  mysql_fetch_array($result)){
                                $valor1=$fila['cod_mun'];
                                 $valor2=$fila['nombre_mun'];

                               echo '<option value="'.$valor2.'">'.$valor2.'</option>';
                                }
                      } ?>  
                            </select></td>
                        <tr>
                    	<td>6.Telefono: </td>
                        <td><input type="text" class="sp1"  id="tel"  autofocus placeholder=""/></td>
                        <tr>
                    	<td>7.Contacto: </td>
                        <td><input type="text" class="sp1"  id="con"  autofocus placeholder=""/></td>
                        <tr>
                    	<td>8.Tel. Contacto </td>
                        <td><input type="text" class="sp1" id="tco" maxlength="9" placeholder=""/></td>
                        <tr>
                    	<td>9.Email 1: <b>*</b></td>
                        <td><input type="text" class="sp1" id="em1"  placeholder=""/></td>
                        <tr>
                    	<td>10.Email 2: </td>
                        <td><input type="text" class="sp1" id="em2"  placeholder=""/></td>
                        <tr>
                    	<td>11.Banco: </td>
                        <td><input type="text" class="sp1" id="ban"  placeholder="Nombre del Banco"/></td>
                        <tr>
                    	<td>12.Numero de Cuenta: </td>
                        <td><input type="text" class="sp1" id="num"  placeholder="Numero de Cuenta"/></td>
                        <tr>
                    	<td>13.Observaciones: </td>
                        <td><textarea class="sp1" id="obs"></textarea>                          </textarea></td>
                    </tr>
                </table>
               </form>
                </fieldset>
            <span id="mensaje"></span>
              </div>
    </body>
</html>
