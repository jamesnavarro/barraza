<!DOCTYPE html>
<?php
   include '../../modelo/conexion.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Registro</title>
<link href="../../css/estilo.css" rel="stylesheet">
<script src="../../js/jquery.js"></script>

<script src="../../vistas/bodegas/funciones.js"></script>
    </head>
    <body onload="Llenar_bod('<?php echo $_GET['id'] ?>');pagina(1,0)">
        <div>
            <h3>Registro de Bodegas</h3>
        </div>
        <div>
             <fieldset>
               <legend>Panel de Control</legend>
               <div  style="float:left">
                   <img src="../../images/save.png" class="panel" id="Guardar" title="Guardar Registro">  <img src="../../images/borrar.png" class="panel"  id="Eliminar" title="Borrar Registro">  <img src="../../images/nuevo.png" class="panel"  id="Nuevo" title="Nuevo Registro">  <img src="../../images/printer.png" class="panel"  id="Imprimir" title="Imprimir Registro">  <img src="../../images/salir.png" class="panel"  id="Salir"title="Salir del Formulario">
               </div>
               <div id="paginacion"  style="float:right">

               </div>
               <div id="cedula">
                   
               </div>
            </fieldset>
            </div>
        <div>
            <fieldset>
                <form id="Form">
               <legend>Formulario</legend>
				<table class="tbl-registro" width="100%">
                                                    	<tr>
                    	<td width="180px">2.Codigo Bodega: <b>*</b></td>
                        <td><input type="text" class="sp1" maxlength="4" id="cod" placeholder="" value=""/> <input type="hidden" class="sp4" id="sw" placeholder="" value="0"/></td>
                        <tr>
                    	<td>3.Nombre de la Bodega: </td>
                        <td><input type="text" class="sp1" id="bod"  placeholder="Nombre de la bodega"/></td>
                        <tr>
                    	<td>13.Observaciones: </td>
                        <td><textarea id="obs" cols="50"></textarea></td>
                            <tr>
                    	<td>14.Estado: <b>*</b></td>
                        <td><select id="est" class="sp1">
                                <option value="">Seleccione estado</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select></td>
                       
                </table>
               </form>
                </fieldset>
            <span id="mensaje"></span>
              </div>
    </body>
</html>
