<?php

if(isset($_GET['page'])){
           include('../../modelo/conexion.php');
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
$request=mysql_query('SELECT count(*) FROM movimientos ');
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
                    $boton = $boton.'<img src="../../images/pr2.png"  onclick="paginax(1,0)" style="cursor: pointer;"> ';
                    $boton = $boton.' <img src="../../images/pr1.png"  onclick="paginax('.$page.' - 1,0)" style="cursor: pointer;">';
                
                }else{
                    $boton = $boton.'<img src="../../images/pr2.png"> <img src="../../images/pr1.png"> ';
                }
                     $boton = $boton.' ';
                if($page<$last_page){
                    $boton = $boton.'<img src="../../images/n1.png"  onclick="paginax('.$page.' + 1,0)" style="cursor: pointer;">';
                    $boton = $boton.' <img src="../../images/n2.png"  onclick="paginax('.$last_page.',0)" style="cursor: pointer;">';
                }else{
                        $boton = $boton.'<img src="../../images/n1.png"> <img src="../../images/n2.png">';
                }
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
if($_GET['id']=='0'){
     $sql = mysql_query("SELECT * FROM movimientos order by id_mov asc ".$limit);
}else{
     $sql = mysql_query("SELECT * FROM movimientos where id_mov=".$_GET['id']." ");
}

 $r = mysql_fetch_array($sql);
$idm =  $r['id_mov'];
 $doc =  $r['orden_servicio'];
  $tip =  $r['id_operaciones'];
   $use =  $r['id_usuario'];
    $fec =  $r['fecha_mov'];
     $bod =  $r['id_bod'];
     $pro =  $r['id_pro'];
     $gru =  $r['grupo'];
      $save =  $r['save'];

    $array = array(
        0 => $boton,
        1 => $idm,
        2 => $doc,
        3 => $tip,
        4 => $use,
        5 => $fec,
        6 => $bod,
        7 => $pro,
        8 => $gru,
        9 => $save
            );

    echo json_encode($array);
