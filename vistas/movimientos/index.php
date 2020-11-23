<?php
   include '../../modelo/conexion.php';
session_start();
include('../../modelo/consultar_permisos.php');
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
    <body onload="paginax(1,<?php echo $_GET['id'] ?>)">
        <div>
            <h3>Registro de Movimientos</h3>
        </div>
        <div>
             <fieldset>
               <legend>Panel de Control</legend>
               <div  style="float:left">
                   <?php if($crear_can == 'Habilitado'){ ?><img src="../../images/save.png" class="panel" id="Guardar" title="Guardar Registro"><?php } ?>
                   <?php if($editar_can == 'Habilitado'){ ?><img src="../../images/editar.png" class="panel"  id="Editar" title="Editar Registro"> <?php } ?>
                   <?php if($crear_can == 'Habilitado'){ ?><img src="../../images/nuevo.png" class="panel"  id="Nuevo" title="Nuevo Registro"> <?php }?>
                   <img src="../../images/printer.png" class="panel"  onclick="imprimir()" title="Imprimir Registro"> 
                   <img src="../../images/salir.png" class="panel"  id="Salir"title="Salir del Formulario">
               </div>
               <div id="paginacion"  style="float:right">

               </div>
               <div id="cedula"></div>
            </fieldset>
            </div>
        <div>
            <fieldset>
   
               <legend>Formulario</legend>
				<table class="tbl-registro" width="100%">
                                    <tr>
                                        <td>Grupo </td>
                                        <td><select id="grupo">
                                                <option value="Factura">Factura</option>
                                                <option value="Orden">Orden Interna</option>
                                            </select></td>
                                        <td>Consecutivo </td>
                                        <td><input type="text" id="mov" class="sp4" value="" /> <select id="save"class="sp2">
                                                <option value="0">Sin Guardar</option>
                                                <option value="1">Guadado</option>
                                            </select></td>
                                    </tr>
                                                    	<tr>
                    	<td width="180px">Orden /Factura: <b>*</b></td>
                        <td><input type="text" class="sp3" id="docx" /></td>
                        <td>Fecha de Registro:<td> <input type="text" id="fec" class="sp3"  value="<?php echo date('Y-m-d'); ?>" disabled/></td>
                        <tr>
                    	<td>Tipo de Movimiento: </td>
                        <td><select id="tip" class="sp2">
                                <?php
                                echo '<option value="">Selecciones</option>';
                                if($_SESSION['k_username']=="admin"){
                                    $query = mysql_query('select * from operaciones');
                                }else{
                                    $query = mysql_query('select * from operaciones where id_operaciones!=5 ');
                                }
                                
                                while($q = mysql_fetch_array($query)){
                                    if($q['id_operaciones']='5' && $_SESSION['k_username']=='admin'){
                                         echo '<option value="'.$q['id_operaciones'].'">'.$q['descripcion'].'</option>';
                                    }else{
                                         echo '<option value="'.$q['id_operaciones'].'">'.$q['descripcion'].'</option>';
                                    }
                                }
                                ?>
                            </select></td>
                            <td>Proveedor: </td>
                        <td><select id="pro" class="sp2">
                                <?php
                                echo '<option value="">Selecciones</option>';
                                $queryp = mysql_query('select * from proveedors');
                                while($q = mysql_fetch_array($queryp)){
                                    echo '<option value="'.$q['id'].'">'.$q['nombre'].'</option>';
                                }
                                ?>
                            </select></td>
                            <tr>
                    	<td>Registrado por: <b>*</b></td>
                        <td><select id="use" class="sp2" disabled>
                                <?php
                                echo '<option value="'.$_SESSION['id_user'].'">'.$_SESSION['nombre'].'</option>';
                                $queryu = mysql_query('select * from usuarios order by nombre');
                                while($q = mysql_fetch_array($queryu)){
                                    echo '<option value="'.$q['id'].'">'.$q['nombre'].' '.$q['apellido'].'</option>';
                                }
                                ?>
                            </select></td>
                            <td>Bodega: </td>
                        <td><select id="bod" class="sp2">
                                <?php
                                echo '<option value="">Selecciones</option>';
                                $queryb = mysql_query('select * from bodegas');
                                while($q = mysql_fetch_array($queryb)){
                                    echo '<option value="'.$q['id_bodega'].'">'.$q['codigo_bod'].' '.$q['bodega'].'</option>';
                                }
                                ?>
                            </select></td>
                       
                </table>

                </fieldset>
                        <fieldset>
   
               <legend>Detalles</legend>
               <div class="datagrid">
               <table>
                    <thead>
                                     <tr  BGCOLOR="#C3D9FF">
                                        <th>Items</th>
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Cant.</th>
                                        <th>Costo Und.</th>
                                        <th>Stock</th>
                                        <th>User</th>
                                        <th>Fecha Mod.</th>
                                        <th>Estado</th>
                                    </tr>
                                    <tr>
                                        <td><img src="../../imagenes/buscar.png" style="cursor: pointer" id="buscar"></td>
                                        <td><input type="text" style="width: 100%" id="cod" disabled></td>
                                        <td><input type="text" style="width: 100%" id="prod" disabled></td>
                                        <td><input type="text" style="width: 50%" id="can" disabled></td>
                                        <td><input type="text" style="width: 90%" id="costo" ></td>
                                        <td><input type="text" style="width: 50%" disabled id="stock"></td>
                                        <td><input type="hidden" style="width: 100%" disabled value="<?php echo $_SESSION['id_user'] ?>" id="user"><input type="text" id="usen" disabled style="width: 100%" value="<?php echo $_SESSION['k_username'] ?>"></td>
                                        <td><input type="text" style="width: 100%" disabled value="<?php echo date("Y-m-d") ?>" id="reg"></td>
                                        <td><img src="../../imagenes/add.png" style="cursor: pointer" id="agregar"></td>
                                    </tr>
                                </thead>
                                <tbody id="detalles">
                                    
                                </tbody>
               </table>
                   </div>
                </fieldset>
              </div>
    </body>
</html>
