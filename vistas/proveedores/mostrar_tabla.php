<?php
if(isset($_GET['nombre'])){
                    include('../../modelo/conexion.php');
                    $colx = 'and nombre like "%'.$_GET['nombre'].'%" ';
            }else{
                    $colx='';
            }
if(isset($_GET['page'])){
           include('../../modelo/conexion.php');
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
            $request=mysql_query('SELECT count(*) FROM proveedors  where tipo="Proveedor" '.$colx.' ');
            if($request){
                    $request = mysql_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

            
            
                if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarProveedors(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarProveedors(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarProveedors(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarProveedors(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr  BGCOLOR="#C3D9FF">
                                        <th>NIT / C.C</th>
                                        <th>Nombre del Proveedor</th>
                                        <th>Telefonos</th>
                                        <th>Email</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($_GET['nombre'])){
                                        $col = 'and nombre like "%'.$_GET['nombre'].'%" ';
                                    }else{
                                        $col = '';
                                    }
                                    $sql = mysql_query("SELECT * FROM proveedors where tipo='Proveedor' $col ".$limit);
			$item = 0;
			if(mysql_num_rows($sql)>0){
				while($mostrar = mysql_fetch_array($sql)){
					$item = $item+1;
					echo '<tr>
<td>'.$mostrar['nitcc'].'</td>
<td>'.$mostrar['nombre'].'</td>
<td>'.$mostrar['telefono'].'</td>
<td>'.$mostrar['email1'].'</td>'; ?>
                                <td><img src="../imagenes/modificar.png" class="btn"  onClick="formulario_pr('<?php echo $mostrar['nitcc']; ?>')"></td></tr>
				<?php }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                        
