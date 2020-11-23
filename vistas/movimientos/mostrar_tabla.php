<?php
include('../../modelo/conexion.php');
session_start();
include('../../modelo/consultar_permisos.php');
if(isset($_GET['doc'])){
              if($_GET['tip']!=''){ $tip = ' and a.id_operaciones='.$_GET['tip'].' '; }else{$tip = ''; }
              if($_GET['bod']!=''){ $bod = ' and a.id_bod='.$_GET['bod'].' '; }else{$bod = ''; }
              if($_GET['fi']!='' && $_GET['ff']!=''){ $fe = ' and a.fecha_mov>='.$_GET['fi'].' and a.fecha_mov<='.$_GET['ff'].' '; }else{$fe = ''; }
              $colx = 'and a.orden_servicio like "%'.$_GET['doc'].'%"  '.$tip.' '.$bod.' '.$fe.' ';
            }else{
                    $colx='';
            }
if(isset($_GET['page'])){
           include('../../modelo/conexion.php');
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
$request=mysql_query('SELECT * FROM movimientos a, usuarios b, bodegas c, operaciones d where a.id_operaciones=d.id_operaciones and a.id_bod=c.id_bodega and a.id_usuario=b.id '.$colx.' ');
                if($request){
                        $num_items = mysql_num_rows($request);;
                }else{
                        $num_items = 0;
                }
              $rows_by_page = 10;

              $last_page = ceil($num_items/$rows_by_page);
                ?>
<div style="float: left">
<?php
                if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarBodegas(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarBodegas(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarBodegas(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarBodegas(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?></div><div style="float: right">
                    
                    <?php if($ver_can == 'Habilitado'){ ?><input type="button" class="btn-primary" value="Nuevo Moviemiento" onclick="ver_movimientos(-1)"><?php } ?>
                    <?php if($crear_can == 'Habilitado'){ ?><input type="button" class="btn-primary" value="Mov. de Productos" onclick="ver_productos()"><?php } ?>
                </div>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                     <tr  BGCOLOR="#C3D9FF">
                                        <th>Consecutivo</th>
                                        <th>N° Orden / Factura</th>
                                        <th>Tipo Movimiento</th>
                                         <th>Bodega</th>
                                         <th>Registrado</th>
                                         <th>Fecha Reg.</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($_GET['doc'])){
                                        if($_GET['tip']!=''){ $tip = ' and a.id_operaciones='.$_GET['tip'].' '; }else{$tip = ''; }
                                        if($_GET['bod']!=''){ $bod = ' and a.id_bod='.$_GET['bod'].' '; }else{$bod = ''; }
                                        if($_GET['fi']!='' && $_GET['ff']!=''){ $fe = ' and a.fecha_mov>="'.$_GET['fi'].'" and a.fecha_mov<="'.$_GET['ff'].'" '; }else{$fe = ''; }
                                        $col = 'and a.orden_servicio like "%'.$_GET['doc'].'%" '.$tip.' '.$bod.' '.$fe.' ';
                                    }else{
                                        $col = '';
                                    }
                                    
                                    $sql = mysql_query("SELECT * FROM movimientos a, usuarios b, bodegas c, operaciones d where a.id_operaciones=d.id_operaciones and a.id_bod=c.id_bodega and a.id_usuario=b.id  $col order by id_mov desc ".$limit);
			$item = 0;
			if(mysql_num_rows($sql)>0){
				while($mostrar = mysql_fetch_array($sql)){
                                    if($mostrar['save']=='1'){
                                        $color = '<img src="../imagenes/led.gif">';
                                    }else{
                                         $color = '<img src="../imagenes/ledrojo.gif">';
                                    }
					$item = $item+1;
					echo '<tr>
                                                    <td>'.$mostrar['id_mov'].'</td>
                                                    <td>'.$mostrar['orden_servicio'].'</td>
                                                    <td>'.$mostrar['id_operaciones'].'- '.$mostrar['descripcion'].'</td>'
                                                . '<td>'.$mostrar['id_bod'].'- '.$mostrar['bodega'].'</td><td>'.$mostrar['nombre'].' '.$mostrar['apellido'].'</td><td>'.$mostrar['fecha_mov'].'</td>'; ?>
<td><?php echo $color; ?> <img src="../images/listacontacto.png"  onClick="ver_movimientos('<?php echo $mostrar['id_mov']; ?>')"></td>
</tr>
				<?php }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>'.$col;
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                        
