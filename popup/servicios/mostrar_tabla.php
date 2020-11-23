<?php
include('../../modelo/conexion.php');
if(isset($_GET['page'])){
           
                    $page = $_GET['page'];
       
            }else{
                    $page = 1;

            }
            $tipo = $_GET['tipo'];
$request=mysql_query('SELECT count(*) FROM atenciones WHERE tipo="'.$tipo.'" and concat(nombre_atencion," ",codigo_atencion) like "%'.$_GET['nombre'].'%"  ');
            if($request){
                    $request = mysql_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

            
            
                if($page>1){?>
                        <img src="../images/at1.png"  onclick="MostrarEmpleados2(1)" style="cursor: pointer;">
                        <img src="../images/at2.png"  onclick="MostrarEmpleados2(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/at2.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/sig2.png"  onclick="MostrarEmpleados2(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/sig1.png" onclick="MostrarEmpleados2(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/sig2.png">  <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>ITEM</th>
                                        <th>Codigo</th>
                                        
                                        <th>Descripcion</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $sql = mysql_query("SELECT * FROM atenciones WHERE tipo='$tipo' and concat(nombre_atencion,' ',codigo_atencion) like '%".$_GET['nombre']."%'  ".$limit);
			$item = 0;
			if(mysql_num_rows($sql)>0){
				while($mostrar = mysql_fetch_array($sql)){
					$item = $item+1;
                                        $cod = "'".$mostrar['codigo_atencion']."'";
                                        $nom = "'".$mostrar['nombre_atencion']."'";
                                        $val = $mostrar['valor'];
                                       
					echo '<tr><td>'.$item.'</td><td><a href="#" onclick="pasar('.$cod.','.$nom.','.$val.')">'.$mostrar['codigo_atencion'].'</a></td>'
                                                . '<td>'.$mostrar['nombre_atencion'].'</td><td>'.$mostrar['valor'].'</td>'; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                        
