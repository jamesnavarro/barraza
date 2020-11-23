<?php
include('../../modelo/conexion.php');
session_start();
// sw = 
// 0 Insertar
// 1 Actualizar
// 2 Mostrar
// 3 Eliminar
switch ($_GET['sw']) {
        case 0:

                    $cod = $_GET['cod'];
                    $bod = $_GET['bod'];
                    $obs = $_GET['obs'];
                    $est = $_GET['est'];

                    
                    $comprobar = mysql_num_rows(mysql_query("SELECT * FROM bodegas WHERE codigo_bod = '".$cod."'"));
                    if($comprobar == 0){
                    $ok = mysql_query("INSERT INTO bodegas "
                            . "(`codigo_bod`,"
                            . " `bodega`,"
                            . " `estado_bod`,"
                            . " `Observacion`)"
                            . "VALUES('$cod', "
                            . "'$bod','$est','$obs') ") or die(mysql_error());
                    echo $ok;
                    
                    }else{
                            echo 'existe';
                    }
            break;
        case 1:

                    $cod = $_GET['cod'];
                    $bod = $_GET['bod'];
                    $obs = $_GET['obs'];
                    $est = $_GET['est'];

                    $ok = mysql_query("update bodegas set "
                            . "bodega='".$bod."',"
                            . "estado_bod='".$est."',"
                            . "Observacion='".$obs."'  where codigo_bod='".$cod."' ");
                    mysql_error();
                    echo $ok+1;
           break;
        case 2:
                   include 'mostrar_tabla.php';
           break;
        case 3:
                    $cod = $_GET['codigo'];
                    $resultado = mysql_query("DELETE FROM bodegas WHERE codigo_bod ='".$cod."' ");
                    echo $resultado;
        break;
        case 4:
                    $cod = $_GET['id'];
                    $resultado = mysql_query("DELETE FROM grupos_caja WHERE id_gg ='".$cod."' ");
                    echo $resultado;
        break;
        case 5:
                    $cod = $_GET['id'];
                    $resultado = mysql_query("update grupos_caja set est_cu='".$_GET['est']."' WHERE id_gg ='".$cod."' ");
                    echo $resultado;
        break;
       case 6:
           $gru = $_GET['gru'];
           $doc = $_GET['doc'];
           $fec = $_GET['fec'];
           $tip = $_GET['tip'];
           $pro = $_GET['pro'];
           $use = $_GET['use'];
           $bod = $_GET['bod'];
            $sqlm = "INSERT INTO `movimientos` (`id_operaciones`,`id_usuario`, `orden_servicio`, `fecha_mov`, `id_bod`, `grupo`, `id_pro`) ";
                       $sqlm.= "VALUES ('$tip', '".$use."', '".$doc."', '".$fec."', '$bod','$gru','$pro')";
                       mysql_query($sqlm);
                       $mas = mysql_query("select max(id_mov) from movimientos");
                       $m = mysql_fetch_array($mas);
                       echo $id_mov = $m['max(id_mov)'];
        break;
           case 7:

           $fec = $_GET['fec'];
           $can = $_GET['can'];
           $cod = $_GET['cod'];
           $use = $_GET['use'];
           $bod = $_GET['bod'];
           $mov = $_GET['movi'];
           $tip = $_GET['tip'];
           $costo = $_GET['costo'];
           $sqlmi = "INSERT INTO `movimientos_items` (`id_mov`,`codigo`, `cant`,`estado_mov`,`usuario`,`f_reg`,`costo`) ";
           $sqlmi.= "VALUES ('$mov', '".$cod."', '".$can."', 'Ok', '".$use."', '".$fec."', '".$costo."')";
           mysql_query($sqlmi);
           
           $pro = mysql_query("select * from movimientos_items where codigo='".$cod."' order by id_mi desc limit 1 ");
           $c = 0;$costo = 0;
           while($p =  mysql_fetch_array($pro)){
               $costo += $p['costo'];
               $c += 1;
           }
        
           $promedio = $costo / $c;
           if($tip==5){
               if($bod=='1'){
                   $act_inv = "UPDATE `insumos` SET  `cant_disponible` = '".$can."' WHERE `codigo` = '".$cod."'";
                  echo $ver = mysql_query($act_inv, $conexion) or die(mysql_error());
               }else{
                   $act_inv = "UPDATE `medicamentos` SET  `cant_disponible` = '".$can."' WHERE `codigo_int` = '".$cod."'";
                   echo $ver = mysql_query($act_inv, $conexion) or die(mysql_error());
               }
           }else{
               if($tip==1 || $tip==4){
                   $s = '+';
               }else{
                   $s = '-';
               }
               if($bod=='1'){
                   $act_inv = "UPDATE `insumos` SET  `cant_disponible` = `cant_disponible` '$s' '$can', `costo_ins`='$promedio' WHERE `codigo` = '".$cod."'";
                  echo $ver = mysql_query($act_inv, $conexion) or die(mysql_error());
               }else{
                   $act_inv = "UPDATE `medicamentos` SET  `cant_disponible` = `cant_disponible` '$s' '$can', `costo_med`='$promedio' WHERE `codigo_int` = '".$cod."'";
                   echo $ver = mysql_query($act_inv, $conexion) or die(mysql_error());
               }
           }
           
        break;
           case 8:

           $id = $_GET['id'];
           $can = $_GET['can'];
           $cod = $_GET['cod'];
           $bod = $_GET['bod'];
           if($bod=='1'){
                   $act_inv = "UPDATE `insumos` SET  `cant_disponible` = `cant_disponible`-'".$can."' WHERE `id` = '".$cod."'";
                   mysql_query($act_inv, $conexion) or die(mysql_error());
           }else{
                   $act_inv = "UPDATE `medicamentos` SET  `cant_disponible` = `cant_disponible`-'".$can."' WHERE `id_medicina` = '".$cod."'";
                   mysql_query($act_inv, $conexion) or die(mysql_error());
           }

            $sql = "update movimientos_items set estado_mov='Anulado', usuario='".$_SESSION['k_username']."' WHERE id_mi='".$id."' ";
            $ok = mysql_query($sql, $conexion) or die(mysql_error());
        break;
        
         case 9:

           $id = $_GET['mov'];
            $sql = "update movimientos set save='1' WHERE id_mov='".$id."' ";
            echo $ok = mysql_query($sql, $conexion) or die(mysql_error());
        break;
        case 10:

           $id = $_GET['mov'];
            $sql = "update movimientos set save='0' WHERE id_mov='".$id."' ";
            echo $ok = mysql_query($sql, $conexion) or die(mysql_error());
        break;
        
}

?>