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
<script src="../../vistas/movimientos/funciones.js"></script>
    </head>
    <body>
        <div>
            <h3>Movimientos de Productos</h3>
        </div>
        <div>
            
            <fieldset>
   
               <legend>Formulario</legend>
				<table class="tbl-registro" width="100%">
                        <tr>
                             <td>Bodega: <b>*</b></td>
                        <td><select id="bodega" class="sp2">
                                <?php
                                echo '<option value="">Seleccione</option>';
                                $queryb = mysql_query('select * from bodegas');
                                while($q = mysql_fetch_array($queryb)){
                                    echo '<option value="'.$q['id_bodega'].'">'.$q['codigo_bod'].' '.$q['bodega'].'</option>';
                                }
                                ?>
                            </select></td>
                    	<td>Tipo de Movimiento: <b>*</b></td>
                        <td><select id="movimiento" class="sp2">
                                <?php
                                echo '<option value="">Seleccione</option>';
                                $query = mysql_query('select * from operaciones');
                                while($q = mysql_fetch_array($query)){
                                    echo '<option value="'.$q['id_operaciones'].'">'.$q['id_operaciones'].' - '.$q['descripcion'].'</option>';
                                }
                                ?>
                            </select>   </td>
                        <td rowspan="4"><span id="imp"></span></td>
                        <tr>
                            <td>Producto : </td>
                        <td><input type="text" id="producto" class="sp2"  value=""/></td>
                        
                    	<td>Registrado por: </td>
                        <td><input type="text" id="usuario" class="sp2"  value=""/></td>
                           
                                                        	<tr>
                    	<td width="180px">Rango de fecha </td>
                        <td><input type="date" id="fi" class="sp2"  value=""/></td>
                        <td>Hasta:<td> <input type="date" id="ff" class="sp2"  value=""/></td>
                        <tr>
                            <td>Estado</td>
                                    <td>
                                        <select id="estado">
                                     
                                            <option value="Ok">Ok</option>
                                            <option value="Anulado">Anulado</option>
                                        </select>
                                    </td>
                                      <td>Documento</td>
                                    <td>
                                        <input type="text" id="documento" class="sp2"  value=""/>
                                    </td>
                        </tr>
                        <tr>
                            <td>Reporte por</td>
                                    <td>
                                        <select id="reporte">
                                            <option value="Und">Detalle Und</option>
                                            <option value="Agrupado">Agrupado</option>
                                            
                                        </select>
                                    </td>
                                    <td><select id="st">
                                            <option value="1">Con Movimientos</option>
                                            <option value="0">Todos</option>
                                            
                                        </select></td>
                                    <td><select id="con">
                                            <option value="1">Con Stock</option>
                                            <option value="0">Sin Stock</option>
                                            
                                        </select></td>
                        </tr>
                </table>

                </fieldset>
                        <fieldset>
   
               <legend>Detalles</legend>
               <div class="datagrid">
               <table>
                    <thead>
                                     <tr  BGCOLOR="#C3D9FF">
                                        <th># Mov.</th>
                                        <th>Doc.</th>
                                        <th>Tipo</th>
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Costo.</th>
                                        <th>Cant.</th>
                                        <th>Stock</th>
                                        <th>User</th>
                                        <th>Fecha Mod.</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="detalles_pro">
                                    
                                </tbody>
               </table>
                   </div>
                </fieldset>
              </div>
    </body>
</html>
