<?php
if(isset($_GET['nombre'])){
                    include('../../modelo/conexion.php');
                    $colx = 'where concat(id_consentimiento," ",descripcion) like "%'.$_GET['nombre'].'%" ';
            }else{
                    $colx='';
            }
if(isset($_GET['page'])){
           include('../../modelo/conexion.php');
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
$request=mysql_query('SELECT count(*) FROM consentimientos '.$colx.' ');
            if($request){
                    $request = mysql_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

            
            
                if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarEmpleados2(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarEmpleados2(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarEmpleados2(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarEmpleados2(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>ITEM</th>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($_GET['nombre'])){
                                        $col = 'where concat(id_consentimiento," ",descripcion) like "%'.$_GET['nombre'].'%" ';
                                    }else{
                                        $col = '';
                                    }
                                    $sql = mysql_query("SELECT * FROM consentimientos  $col ".$limit);
			$item = 0;
			if(mysql_num_rows($sql)>0){
				while($mostrar = mysql_fetch_array($sql)){
					$item = $item+1;
					echo '<tr>
<td>'.$item.'</td>
<td><a href="../popup/consentimientos.php?codigo='.$mostrar['id_consentimiento'].'&in='.$_GET['in'].'">'.$mostrar['id_consentimiento'].'</a></td>
<td><a href="../popup/consentimientos.php?codigo='.$mostrar['id_consentimiento'].'&in='.$_GET['in'].'">'.$mostrar['descripcion'].'</a></td>'; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                        
