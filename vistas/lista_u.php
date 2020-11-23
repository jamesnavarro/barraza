<?php 
include '../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){

     $ba= $_GET['ba_us'];
     $c= $_GET['cius'];
     $p= $_GET['munu'];
     $page= $_GET['page'];
   
            $request = mysql_query('SELECT count(*) FROM  barrios where municipio_b="'.$p.'" and nombre_barrio like "%'.$ba.'%" ');

            if($request){
                    $request = mysql_fetch_row($request) or die(mysql_error());
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
 
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../images/at1.png"  onclick="mostrar_barr_usuario(1)" style="cursor: pointer;">
                        <img src="../images/at2.png"  onclick="mostrar_barr_usuario(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
               }else{
                        ?><img src="../images/at1.png"> <img src="../images/at2.png">
                            <?php } ?>
                 (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 20px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/sig1.png"  onclick="mostrar_barr_usuario(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/sig2.png" onclick="mostrar_barr_usuario(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/sig1.png"> <img src="../images/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Registros: '.$num_items;     
                ?>
                     
                        
<div class="table-responsive"> 
         <table class="table">
              <?php
                 $query3 = mysql_query('SELECT * FROM  barrios where municipio_b="'.$p.'" and nombre_barrio like "%'.$ba.'%" '.$limit);
             ?>
             <tr></tr>
    <tr class="bg-info">
                 <tr class="bg-info">
                     <th><label>CIUDAD</label></th>
                     <th><label>NOMBRE DEL BARRIO</label></th>
                 </tr>
                 <tr></tr>
                 <?php
                  while($f = mysql_fetch_array($query3)){
                      $nombre="'".$f['nombre_barrio']."'";
                  echo '<tr> '
                      . '<td align="center">'.$f['municipio_b'].'</td>'
                      . '<td align="center"><a href="#" onclick="seleccionar_u('.$nombre.');">'.$f['nombre_barrio'].'</a></td>';
                  }
                 ?>     
             </table>        
   
    </div>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
