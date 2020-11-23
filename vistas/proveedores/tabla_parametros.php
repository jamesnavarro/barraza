<?php
include '../../modelo/conexion.php';
if(isset($_GET['page'])){
           include('../../modelo/conexion.php');
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
            $request=mysql_query('SELECT count(*) FROM operaciones ');
            if($request){
                    $request = mysql_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;

            $last_page = ceil($num_items/$rows_by_page);

            
              ?>          

    <?php
                if($page>1){?>
                        <img src="../images/at1.png"  onclick="mostrar_parametros(1)" style="cursor: pointer;">
                        <img src="../images/at2.png"  onclick="mostrar_parametros(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/at1.png"> <img src="../images/at2.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/sig1.png"  onclick="mostrar_parametros(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/sig2.png" onclick="mostrar_parametros(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/sig1.png">  <img src="../images/sig2.png"><?php
                }?>
<?php
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Descripcion</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   
                                    $sql = mysql_query("SELECT * FROM  operaciones order by descripcion asc ".$limit);
			$item = 0;
			if(mysql_num_rows($sql)>0){
				while($fila = mysql_fetch_array($sql)){
					  $valor1=$fila['id_operaciones'];
                                          $valor2=$fila['descripcion'];

					echo '<tr>
<td>'.$valor2.'</td>'; ?>
<td><img src="../imagenes/modificar.png"  onClick="EditarParametro(<?php echo $valor1; ?>)">
</tr>
				<?php }
			}else{
				echo '<tr><td colspan="2">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                                   