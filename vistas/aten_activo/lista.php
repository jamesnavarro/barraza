<?php 
include '../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){ 
 
      $barrio= $_GET['barrio'];
           $usuario= $_GET['usuario'];
           $page= $_GET['page'];
           $sin= $_GET['sin'];
           if($usuario==''){
               $user = '';
               $boton = '';
           }else{
               $user = ' and a.user="'.$usuario.'" ';
               $boton = '<button onclick="mostrar_mapa()">Mostrar Mapa</button>';
           }
           if($sin==''){
               $bar = '';
           }else if($sin=='sin'){
               $bar = ' and b.barrio="" ';
           }else{
                $bar = ' and b.barrio!="" ';
           }
            $request = mysql_query("SELECT COUNT(a.id_paciente),a.estado, b.nombres,b.apellidos, b.numero_doc,b.estado,a.orden_servicio,b.barrio,a.user,a.id_paciente, b.lat,b.lng
            FROM actividad a, pacientes b WHERE a.id_paciente=b.id_paciente AND a.id_contacto<98 and b.barrio like '%".$barrio."%' $user $bar GROUP BY a.orden_servicio ");
            if($request){
                    $request = mysql_num_rows($request);
                    $num_items = $request;
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                         <img src="../images/a1.png" onclick="ver(1)" style="cursor: pointer;">
                         <img src="../images/a11.png" onclick="ver(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../images/a1.png"> <img src="../images/a11.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="ver(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="ver(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/p1.png"> <img src="../images/p11.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items.'   | '.$boton; 
    ?> 
<div class="table-responsive">  
    
    <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
  <table class="table table-hover">
    <tr class="bg-info">
        <th style="background-color: #99ccff">Cantidad</th>
        <th style="background-color: #99ccff">Paciente</th> 
        <th style="background-color: #99ccff">Orden Servicio</th>
        <th style="background-color: #99ccff">Profesional</th>
        <th style="background-color: #99ccff">Cargo</th>
        <th style="background-color: #99ccff">Barrio</th>
        <th style="background-color: #99ccff">Direccion</th>
        <th style="background-color: #99ccff">Latitud</th>
        <th style="background-color: #99ccff">Longitud</th>
        <th style="background-color: #99ccff">Mapa</th>
     
    </tr>
   
    <?php
 
    $query = mysql_query("SELECT COUNT(a.id_paciente),a.estado, b.nombres,b.apellidos, b.numero_doc,b.estado,a.orden_servicio,b.barrio,a.user,a.id_paciente, b.direccion1, b.departamento, b.municipio, b.lat, b.lng
            FROM actividad a, pacientes b WHERE a.id_paciente=b.id_paciente AND a.id_contacto<98 and b.barrio like '%".$barrio."%' $user $bar GROUP BY a.orden_servicio order by orden_servicio desc ".$limit );

  
    while ($fila = mysql_fetch_array($query)){
     $que = mysql_query("select nombre, apellido, cargo from usuarios where usuario='".$fila[8]."' ");
     $u = mysql_fetch_row($que);
     $ubicacion = "'".$fila['direccion1']."'";
        echo '<tr>' 
        . '<td>'.$fila[0].'</td>'
        . '<td>'.$fila[2].' '.$fila[3].'</td>'
        . '<td><a href="../vistas/?id=ver_orden_interna&ord='.$fila[6].'" target="_blank">'.$fila[6].'</a></td>'
                . '<td>'.$u[0].' '.$u[1].'</td>'
       . '<td>'.$u[2].'</td>'
       . '<td><input type="hidden" id="dep'.$fila[6].'"  value="'.$fila['departamento'].'">'
                . '<input type="hidden" id="mun'.$fila[6].'"  value="'.$fila['municipio'].'">'
                . '<input type="text" id="bar'.$fila[6].'" onchange="editar_pac('.$fila[6].','.$fila[9].')" value="'.$fila[7].'" style="width:100px"></td>'
       
       . '<td><input type="text" id="dir'.$fila[6].'" onchange="editar_pac('.$fila[6].','.$fila[9].')" value="'.$fila['direccion1'].'" style="width:150px" title="ej:Cra. 49c #79-184 ó Cl. 79 #49C-54">'
                . '<td><input type="text" id="lat'.$fila[6].'" onchange="editar_pac('.$fila[6].','.$fila[9].')" value="'.$fila[13].'" style="width:50px">'
                . '<td><input type="text" id="lng'.$fila[6].'" onchange="editar_pac('.$fila[6].','.$fila[9].')" value="'.$fila[14].'" style="width:50px">'
                . '<td> '
                . '<button onclick="pasar_ubi('.$fila[6].','.$fila[9].')" data-toggle="modal" data-target="#myModal">Ver</button></td>';
    }
    
    ?>
     
  </table> 
</div> 
  </div>
                        
                        
                        
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
