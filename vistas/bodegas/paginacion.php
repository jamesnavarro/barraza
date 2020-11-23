<?php

if(isset($_GET['page'])){
           include('../../modelo/conexion.php');
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
$request=mysql_query('SELECT count(*) FROM bodegas ');
            if($request){
                    $request = mysql_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 1;

            $last_page = ceil($num_items/$rows_by_page);

            $boton = '';
            
                if($page>1){ 
                    $boton = $boton.'<img src="../../images/pr2.png"  onclick="pagina(1,1)" style="cursor: pointer;"> ';
                    $boton = $boton.' <img src="../../images/pr1.png"  onclick="pagina('.$page.' - 1,1)" style="cursor: pointer;">';
                
                }else{
                    $boton = $boton.'<img src="../../images/pr2.png"> <img src="../../images/pr1.png"> ';
                }
                     $boton = $boton.' ';
                if($page<$last_page){
                    $boton = $boton.'<img src="../../images/n1.png"  onclick="pagina('.$page.' + 1,1)" style="cursor: pointer;">';
                    $boton = $boton.' <img src="../../images/n2.png"  onclick="pagina('.$last_page.',1)" style="cursor: pointer;">';
                }else{
                        $boton = $boton.'<img src="../../images/n1.png"> <img src="../../images/n2.png">';
                }
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
 $sql = mysql_query("SELECT * FROM bodegas order by id_bodega asc ".$limit);
 $r = mysql_fetch_array($sql);
$cedula =  $r['codigo_bod'];
 
    $array = array(0 => $boton,1 => $cedula);

    echo json_encode($array);
