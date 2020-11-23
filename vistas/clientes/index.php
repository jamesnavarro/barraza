<!DOCTYPE html>
<?php
   include '../../modelo/conexion.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Registro de Pacientes Particulares</title>
            <link href="../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../css/estilo.css" rel="stylesheet">
<script src="../../js/jquery.js"></script>
<script src="../../js/funcion_global.js"></script>
<script src="funciones.js"></script>
<script src="../../js/bootstrap.min.js"></script>
    </head>
    <body onload="Llenar_pac('<?php echo $_GET['id'] ?>');pagina(1,'<?php echo $_GET['emp'] ?>');">
        <div>
            <h3>Registro de Pacientes Particulares</h3>
        </div>
        <div   class="border"> 

            <div  style="float:left">
                   <img src="../../images/save.png" class="panel" id="Guardar" title="Guardar Registro"  data-toggle="tooltip">  <img src="../../images/borrar.png" class="panel"  id="Eliminar" title="Borrar Registro"  data-toggle="tooltip">  <img src="../../images/nuevo.png" class="panel"  id="Nuevo" title="Nuevo Registro"  data-toggle="tooltip">  <img src="../../images/printer.png" class="panel"  id="Imprimir" title="Imprimir Registro"  data-toggle="tooltip">  <img src="../../images/salir.png" class="panel"  id="Salir"title="Salir del Formulario"  data-toggle="tooltip">
               </div>
               <div id="paginacion"  style="float:right">

               </div>

            </div>
 
   <hr>
            
            <div  class="border">
            <fieldset>
                <form id="Form">
                    <legend>Formulario de Pacientes <input id="emp" type="text" class="span1" readonly value="<?php echo $_GET['emp'] ?>">
                    <span id="mensaje"></span></legend>
				<table class="tbl-registro" width="100%">
                	<tr>
                            <td width="180px">C.C: <b>*</b></td>
                        <td><input type="text" class="sp1" maxlength="11" id="ced" placeholder="" value=""/> <input type="hidden" class="sp4" id="sw" placeholder="" value="0"/></td>
                        <td></td><td></td>
                        <tr>
                    	<td>Primer Nombre: <b>*</b></td>
                        <td><input type="text" class="sp1" id="nom"  autofocus placeholder=""/></td>
                    	<td>Segundo Nombre: </td>
                        <td><input type="text" class="sp1" id="no2"   placeholder=""/></td>
                        <tr>
                    	<td>Primer Apellido: <b>*</b></td>
                        <td><input type="text" class="sp1" id="ape"   placeholder=""/></td>
                    	<td>Segundo Apellido: <b>*</b></td>
                        <td><input type="text" class="sp1" id="ap2"   placeholder=""/></td>
                        <tr>
                    	<td>Direccion: <b>*</b></td>
                        <td><input type="text" class="sp1" id="dir"   placeholder=""/></td>
                    	<td>Barrio: </td>
                        <td><input type="text" class="sp1" id="bar"   placeholder=""/></td>
                        <tr>
                    	<td>Departamento: </td>
                        <td><select  class="sp1"  name="ciudad" id="dep">
                         <?php
                               echo '<option value="">Seleccione el Departamento...</option>';
                                        
                               $consulta= "SELECT * FROM `departamentos` group by nombre_dep";                     
                                $result=  mysql_query($consulta);

                                while($fila=  mysql_fetch_array($result)){
                                $valor1=$fila['cod_dep'];
                                 $valor2=$fila['nombre_dep'];

                               echo '<option value="'.$valor1.'">'.$valor2.'</option>';

                                }
                                
                                ?>
                                            </select>
                        </td>
                    	<td>Ciudad: </td>
                        <td><select  class="sp1"  name="municipio" id="mun">  
                      <?php   
                          echo '<option value="">Seleccione el Municipio...</option>';
                          $consulta2= "SELECT * FROM `departamentos` group by nombre_dep";                     
                                $result2=  mysql_query($consulta);
                                while($fila=  mysql_fetch_array($result2)){
                                    $valor3=$fila['id'];
                                $valor1=$fila['cod_mun'];
                                 $valor2=$fila['nombre_mun'];

                               echo '<option value="'.$valor3.'">'.$valor2.'</option>';
                                }
                       ?>  
                            </select></td>
                        <tr>
                    	<td>Telefono: <b>*</b></td>
                        <td><input type="text" class="sp1"  id="tel"  autofocus placeholder=""/></td>
                        <td>Celular: </td>
                        <td><input type="text" class="sp1"  id="cel"  autofocus placeholder=""/></td>
                        <tr>
                    	<td>Nombre del Familiar: <b>*</b></td>
                        <td><input type="text" class="sp1"  id="fam"  autofocus placeholder=""/></td>
                    	<td>Tel. Familiar <b>*</b></td>
                        <td><input type="text" class="sp1" id="tfa" maxlength="9" placeholder=""/></td>
                        <tr>
                    	<td>Fecha de Ingreso: </td>
                        <td><input type="text" class="sp1" id="fin"  placeholder=""/></td>
                    	<td>Fecha de Modificacion: </td>
                        <td><input type="text" class="sp1" id="fde"  placeholder=""/></td>
                        <tr>
                    	<td>Empresa de Salud: </td>
                        <td><select id="empresa" title="Seleccione la empresa de salud" data-toggle="tooltip"  class="sp1">
                                                        <option value="P">PARTICULAR</option>
                                                        <?php
                                                           $query = mysql_query("select * from sis_empresa where cliente='Si' and rips='P' ");
                                                           while($s = mysql_fetch_array($query)){
                                                               echo '<option value="'.$s['rips'].'">'.$s['nombre_emp'].'</option>';
                                                           }
                                                        ?>
                                                    </select></td>
                                                    <td>Estado: <b>*</b></td>
                        <td><select id="est" class="sp1">
                                <option value="Activo">Activo</option>
                                <option value="No Activo">No Activo</option>
                            </select></td>
                        <tr>
                    	<td>Deposito: </td>
                        <td><input type="text" class="sp1" id="depo"  placeholder=""/></td>
                        <td>SubCodigo</td>
                        <td><input type="text" class="sp1" id="sub"  placeholder=""/></td>
                        <tr>
                        <td>Codigo Enfermedad: </td>
                        <td><input type="text" class="sp3" id="enf"  placeholder=""/><img src="../../images/buscar.png" onclick="enfermedad();"></td>
                    	<td>Descripcion de enfermedad: </td>
                        <td><input type="text" class="sp1" id="obs" data-toggle="tooltip" title="Descripcion de la enferemedad"/></td>
                    </tr>
                     <tr>
                        <td>Ultima Atención: </td>
                        <td><input type="text" class="sp1" disabled id="uat" data-toggle="tooltip" title="Fecha de ultima atencion prestada"/></td>
                    	<td>Ultimo Alquiler: </td>
                        <td><input type="text" class="sp1" disabled id="ual" data-toggle="tooltip" title="Fecha de ultimo alquiler"/></td>
                    </tr>
                </table>
               </form>
                <b>Los campos que tienen * son obligatorios, este formulario es solo para particulares</b>
                </fieldset>
            
              </div>

    </body>
</html>
