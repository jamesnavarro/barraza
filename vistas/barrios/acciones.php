<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['idbarriob'];
            $dep_b=$_GET['deparb'];
            $mun_b=$_GET['munib'];
            $nomb_b=$_GET['nombb'];
            $lat_b=$_GET['latib'];
            $long_b=$_GET['longib'];
        
            if($id==''){
                $ver=mysql_query("insert into barrios (`departamendo_b`,`municipio_b`,`nombre_barrio`,`latitud`,`longitud`) values ('$dep_b','$mun_b','$nomb_b','$lat_b','$long_b')") or die(mysql_error());
                
                $query = mysql_query("select max(id_barrio) from barrios");
                $m = mysql_fetch_array($query);
                $ultimo = $m['max(id_barrio)'];
                echo $ultimo;
            }
            else{
                mysql_query("update barrios set departamendo_b='$dep_b',municipio_b='$mun_b',nombre_barrio='$nomb_b',latitud='$lat_b',longitud='$long_b' where id_barrio='$id'");
                echo $id;
            }
        
          
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysql_query("SELECT * FROM barrios where id_barrio='$id'"); //consultA modificada por navabla
                 $fila = mysql_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_barrio']; 
                 $p[1]=$fila['departamendo_b'];
                 $p[2]=$fila['municipio_b']; 
                 $p[3]=$fila['nombre_barrio'];
                 $p[4]=$fila['latitud']; 
                 $p[5]=$fila['longitud'];
        
        
            echo json_encode($p); 
            exit();
            
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysql_query("delete from categoria_costo where id_catecos='$id' ");
            break;
           case 4: 
             $id=$_GET['nombre'];
             $consulta = mysql_query("SELECT * FROM `departamentos` where nombre_dep='$id'");
                            while($f = mysql_fetch_array($consulta)){ 
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
                            }
            
            break;
        
}

