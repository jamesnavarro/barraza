<?php              
if(isset($_GET['fi'])){
                    $fi = $_GET['fi'];
                    $ff = $_GET['ff'];
                    include('../../modelo/conexion.php');
                    if($_GET['mes']!=''){
                         $colx = 'and a.fecha_registro between "'.$fi.'" and "'.$ff.'"';
                     }else{
                         $colx='';
                     }
                     if($_GET['ord']!=''){
                         $ord = ' and a.orden = "'.$_GET['ord'].'" ';
                     }else{
                         $ord='';
                     }
                     if($_GET['pro']!=''){
                         $pro = ' and concat(b.nombre," ",b.apellido) like "%'.$_GET['pro'].'%" ';
                     }else{
                         $pro='';
                     }
            }else{
                    $colx='';
                    $ord='';
            }
if(isset($_GET['page'])){

                    $page = $_GET['page'];
                   
            }else{
                    $page = 1;
                    
            }
            $request=mysql_query('SELECT * FROM liquidaciones a, usuarios b where a.usuario=b.usuario  '.$colx.' '.$ord.' '.$pro.' ');
            if($request){
                    $request = mysql_num_rows($request);
                    $num_items = $request;
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page); ?>
            <div style="float:left">
               <?php if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarLista(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarLista(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarLista(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarLista(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }echo 'Total de Registros: ('.$num_items.')' . $ord;
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?></div>

                        
                            <table class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                <th>Liq.</th>
                                <th>Orden</th>
                                <th>Profesional</th>
                                <th>Atencion </th>
                                <th>Pend.</th> 
                                <th>Cant.</th> 
                                <th>Valor</th> 
                                <th>Total</th>
                                <th>Fecha inicial</th>
                                <th>Fecha Final</th>
                                <th>Fecha Registro</th>
                            </thead>
                     
                                    <?php
                            
                                    $sqld = mysql_query('SELECT * FROM liquidaciones a, usuarios b where a.usuario=b.usuario '.$colx.' '.$ord.' '.$pro.' '.$limit);
        $a=date("H:i").':00';
        $cont=0;
        $sum = 0;
        $sum2 = 0;
        
	while($row=mysql_fetch_array($sqld))
	{       $cont = $cont + 1 ;
             
           echo '<tr><td>'.$row["id_liq"].'</font></td><td>'.$row["orden"].'</td>
              <td>'.$row["nombre"].' '.$row["apellido"].'</td> <td>'.$row["atencion"].'<br>'.$row["observacion"].'</td><td>'.$row["pendientes"].'</font></td><td>'.$row["cantidad"].'</font></td><td>'.number_format($row["valor"]).'</font></td>
                    
                        <td>'.number_format($row["total"]).'</td><td>'.$row["fechain"].'</td><td>'.$row["fechafi"].'</td>
                        <td>'.$row["fecha_registro"].'</td>
</tr>';
                 
	}
			
                                    
                                    ?>
                              
                            </table>
                        
